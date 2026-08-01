<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Horaire;
use App\Models\User;
use App\Models\MessageContact;
use App\Models\Terrain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Dashboard administrateur
     */
    public function dashboard()
    {
        // Statistiques générales
        $totalReservations = Reservation::count();
        $reservationsEnAttente = Reservation::where('statut', 'en_attente')->count();
        $reservationsConfirmees = Reservation::where('statut', 'confirmee')->count();
        $reservationsAnnulees = Reservation::where('statut', 'annulee')->count();
        
        // Revenus
        $revenus = Reservation::where('statut', 'confirmee')->sum('prix');
        
        // Réservations du mois en cours (basé sur date de réservation)
        $reservationsMois = Reservation::whereMonth('date_reservation', now()->month)
                                       ->whereYear('date_reservation', now()->year)
                                       ->where('statut', 'confirmee')
                                       ->count();
        
        // Nombre d'utilisateurs
        $totalUtilisateurs = User::where('role', 'client')->count();
        
        // Messages non lus
        $messagesNonLus = MessageContact::where('lu', false)->count();
        
        // Dernières réservations
        $dernieresReservations = Reservation::with('user')
                                            ->orderBy('created_at', 'desc')
                                            ->take(10)
                                            ->get();
        
        // Données pour le graphique - 30 derniers jours avec réservations confirmées
        $chartLabels = [];
        $chartData = [];
        
        // Récupérer les dates des 30 derniers jours avec des réservations confirmées
        $datesWithReservations = Reservation::where('statut', 'confirmee')
                                           ->whereDate('date_reservation', '>=', now()->subDays(30))
                                           ->orderBy('date_reservation')
                                           ->pluck('date_reservation')
                                           ->unique();
        
        if ($datesWithReservations->count() > 0) {
            foreach ($datesWithReservations as $date) {
                $chartLabels[] = \Carbon\Carbon::parse($date)->format('D d/m');
                $chartData[] = Reservation::whereDate('date_reservation', $date)
                                         ->where('statut', 'confirmee')
                                         ->count();
            }
        } else {
            // Si aucune réservation, afficher les 7 derniers jours
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $chartLabels[] = $date->format('D d/m');
                $chartData[] = 0;
            }
        }
        
        return view('admin.dashboard', compact(
            'totalReservations',
            'reservationsEnAttente',
            'reservationsConfirmees',
            'reservationsAnnulees',
            'revenus',
            'reservationsMois',
            'totalUtilisateurs',
            'messagesNonLus',
            'dernieresReservations',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Gestion des réservations
     */
    public function reservations(Request $request)
    {
        $query = Reservation::with('user');
        
        // pour filtré les reservations
        if ($request->has('statut') && $request->statut != '') {
            $query->where('statut', $request->statut);
        }
        
        if ($request->has('date_debut') && $request->date_debut != '') {
            $query->where('date_reservation', '>=', $request->date_debut);
        }
        
        if ($request->has('date_fin') && $request->date_fin != '') {
            $query->where('date_reservation', '<=', $request->date_fin);
        }
        
        $reservations = $query->orderBy('date_reservation', 'desc')
                              ->orderBy('heure_debut', 'desc')
                              ->paginate(20);
        
        return view('admin.reservations', compact('reservations'));
    }

    /**
     * Confirmer une réservation
     */
    public function confirmerReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['statut' => 'confirmee']);
        
        return back()->with('success', 'Réservation confirmée avec succès.');
    }

    /**
     * Annuler une réservation (admin)
     */
    public function annulerReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'statut' => 'annulee',
            'notes' => 'Annulé par l\'administrateur',
        ]);
        
        return back()->with('success', 'Réservation annulée avec succès.');
    }

    /**
     * Supprimer une réservation
     */
    public function supprimerReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        
        return back()->with('success', 'Réservation supprimée avec succès.');
    }

    /**
     * Gestion des horaires
     */
    public function horaires()
    {
        $horaires = Horaire::orderBy('jour_semaine')->orderBy('heure_debut')->get();
        return view('admin.horaires', compact('horaires'));
    }

    /**
     * Ajouter un horaire
     */
    public function storeHoraire(Request $request)
    {
        $validated = $request->validate([
            'jour_semaine' => 'required|string|in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'disponible' => 'boolean',
            'raison_blocage' => 'nullable|string|max:255',
        ]);

        Horaire::create($validated);

        return back()->with('success', 'Horaire ajouté avec succès.');
    }

    /**
     * Modifier un horaire
     */
    public function updateHoraire(Request $request, $id)
    {
        $horaire = Horaire::findOrFail($id);
        
        $validated = $request->validate([
            'jour_semaine' => 'required|string|in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'disponible' => 'boolean',
            'raison_blocage' => 'nullable|string|max:255',
        ]);

        $horaire->update($validated);

        return back()->with('success', 'Horaire modifié avec succès.');
    }

    /**
     * Supprimer un horaire
     */
    public function deleteHoraire($id)
    {
        $horaire = Horaire::findOrFail($id);
        $horaire->delete();
        
        return back()->with('success', 'Horaire supprimé avec succès.');
    }

    /**
     * Gestion des prix
     */
    public function prix()
    {
        $terrain = Terrain::where('actif', true)->first();
        return view('admin.prix', compact('terrain'));
    }

    /**
     * Mettre à jour les prix
     */
    public function updatePrix(Request $request)
    {
        $validated = $request->validate([
            'prix_matin' => 'required|numeric|min:0',
            'prix_apres_midi' => 'required|numeric|min:0',
            'prix_soir' => 'required|numeric|min:0',
        ]);

        $terrain = Terrain::where('actif', true)->first();
        
        if ($terrain) {
            $terrain->update($validated);
            return back()->with('success', 'Prix mis à jour avec succès.');
        }
        
        // Créer un terrain s'il n'existe pas
        $validated['nom'] = 'Terrain Principal';
        $validated['description'] = 'Terrain de footArena';
        $validated['adresse'] = 'Medina, Dakar, Sénégal';
        $validated['telephone'] = '+221 77 123 45 67';
        $validated['email'] = 'contact@footarena.sn';
        $validated['actif'] = true;
        
        Terrain::create($validated);
        
        return back()->with('success', 'Terrain et prix créés avec succès.');
    }

    /**
     * Gestion des utilisateurs
     */
    public function utilisateurs()
    {
        $utilisateurs = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.utilisateurs', compact('utilisateurs'));
    }

    /**
     * Modifier le rôle d'un utilisateur
     */
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'role' => 'required|string|in:client,admin',
        ]);

        $user->update($validated);

        return back()->with('success', 'Rôle modifié avec succès.');
    }

    /**
     * Supprimer un utilisateur
     */
    public function deleteUtilisateur($id)
    {
        $user = User::findOrFail($id);
        
        // Empêcher la suppression de soi-même
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }
        
        $user->delete();
        
        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }

    /**
     * Gestion des messages de contact
     */
    public function messages()
    {
        $messages = MessageContact::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.messages', compact('messages'));
    }

    /**
     * Marquer un message comme lu
     */
    public function marquerLu($id)
    {
        $message = MessageContact::findOrFail($id);
        $message->update(['lu' => true]);
        
        return back()->with('success', 'Message marqué comme lu.');
    }

    /**
     * Supprimer un message
     */
    public function deleteMessage($id)
    {
        $message = MessageContact::findOrFail($id);
        $message->delete();
        
        return back()->with('success', 'Message supprimé avec succès.');
    }
}