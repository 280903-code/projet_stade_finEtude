<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Terrain;
use App\Models\Horaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Page de réservation avec calendrier
     */
    public function index()
    {
        $terrain = Terrain::where('actif', true)->first();
        
        if (!$terrain) {
            return redirect()->route('home')->with('error', 'Aucun terrain disponible pour le moment.');
        }
        
        // Récupérer les horaires de la semaine
        $horaires = Horaire::where('disponible', true)
                           ->orderBy('jour_semaine')
                           ->orderBy('heure_debut')
                           ->get()
                           ->groupBy('jour_semaine');
        
        return view('reservation.index', compact('terrain', 'horaires'));
    }

    /**
     * API pour récupérer les créneaux disponibles pour une date
     */
    public function getCreneaux(Request $request)
    {
        $date = $request->get('date');
        
        if (!$date) {
            return response()->json(['error' => 'Date requise'], 400);
        }
        
        // Récupérer le terrain
        $terrain = Terrain::where('actif', true)->first();
        
        if (!$terrain) {
            return response()->json(['error' => 'Aucun terrain disponible'], 400);
        }
        
        // Initialiser la variable pour le prix
        $prixMatin = $terrain->prix_matin;
        $prixApresMidi = $terrain->prix_apres_midi;
        $prixSoir = $terrain->prix_soir;
        
        // Récupérer les réservations existantes pour cette date
        $reservationsExistantes = Reservation::whereDate('date_reservation', $date)
                                             ->whereIn('statut', ['en_attente', 'confirmee'])
                                             ->get(['heure_debut', 'heure_fin', 'user_id']);
        
        // Générer des créneaux de 1h de 8h à 22h
        $creneaux = [];
        for ($heure = 8; $heure < 22; $heure++) {
            $heureDebut = sprintf('%02d:00:00', $heure);
            $heureFin = sprintf('%02d:00:00', $heure + 1);
            
            // Vérifier d'abord si ce créneau est réservé (par n'importe qui)
            $estReserve = $reservationsExistantes->contains(function ($reservation) use ($heureDebut, $heureFin) {
                return trim($reservation->heure_debut) === trim($heureDebut) &&
                       trim($reservation->heure_fin) === trim($heureFin);
            });
            
            // Si réservé, vérifier si c'est par l'utilisateur connecté
            if ($estReserve) {
                $estReserveParMoi = $reservationsExistantes->contains(function ($reservation) use ($heureDebut, $heureFin) {
                    return $reservation->user_id === Auth::id() &&
                           trim($reservation->heure_debut) === trim($heureDebut) &&
                           trim($reservation->heure_fin) === trim($heureFin);
                });
                
                if ($estReserveParMoi) {
                    $statut = 'reserve_moi';
                    $couleur = 'vert';
                    $label = 'Ma réservation';
                } else {
                    $statut = 'reserve_autre';
                    $couleur = 'rouge';
                    $label = 'Réservé';
                }
            } else {
                $statut = 'disponible';
                $couleur = 'blanc';
                $label = 'Disponible';
            }
            
            // Calculer le prix selon l'heure
            $prix = $this->calculerPrix($heureDebut, $prixMatin, $prixApresMidi, $prixSoir);
            
            $creneaux[] = [
                'heure_debut' => substr($heureDebut, 0, 5),
                'heure_fin' => substr($heureFin, 0, 5),
                'statut' => $statut,
                'couleur' => $couleur,
                'label' => $label,
                'prix' => $prix,
            ];
        }
        
        return response()->json($creneaux);
    }

    /**
     * Enregistrer une nouvelle réservation
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'date_reservation' => 'required|date|after_or_equal:today',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'prix' => 'required|numeric|min:0',
        ], [
            'date_reservation.required' => 'La date de réservation est obligatoire.',
            'date_reservation.after_or_equal' => 'La date de réservation ne peut pas être dans le passé.',
            'heure_debut.required' => 'L\'heure de début est obligatoire.',
            'heure_fin.required' => 'L\'heure de fin est obligatoire.',
            'heure_fin.after' => 'L\'heure de fin doit être après l\'heure de début.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre.',
        ]);

        // Vérifier si le créneau est déjà réservé
        $existingReservations = Reservation::whereDate('date_reservation', $validated['date_reservation'])
                                          ->whereIn('statut', ['en_attente', 'confirmee'])
                                          ->get();
        
        $dejaReserve = $existingReservations->contains(function ($reservation) use ($validated) {
            return trim($reservation->heure_debut) === trim($validated['heure_debut']) &&
                   trim($reservation->heure_fin) === trim($validated['heure_fin']);
        });

        if ($dejaReserve) {
            return back()->with('error', 'Ce créneau vient d\'être réservé. Veuillez choisir un autre créneau.')
                        ->withInput();
        }

        // Créer la réservation
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'date_reservation' => $validated['date_reservation'],
            'heure_debut' => $validated['heure_debut'],
            'heure_fin' => $validated['heure_fin'],
            'prix' => $validated['prix'],
            'statut' => 'en_attente',
            'notes' => null,
        ]);

        return redirect()->route('client.reservations.futures')
                        ->with('success', 'Votre réservation a été enregistrée avec succès ! En attente de confirmation.');
    }

    /**
     * Calculer le prix selon l'heure
     */
    private function calculerPrix($heure, $prixMatin, $prixApresMidi, $prixSoir)
    {
        $heure = Carbon::createFromFormat('H:i:s', $heure);
        
        // Matin: 8h-12h
        if ($heure->hour >= 8 && $heure->hour < 12) {
            return $prixMatin;
        }
        // Après-midi: 12h-18h
        elseif ($heure->hour >= 12 && $heure->hour < 18) {
            return $prixApresMidi;
        }
        // Soir: 18h-22h
        else {
            return $prixSoir;
        }
    }
}