<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Dashboard client
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Statistiques
        $reservationsFutures = $user->reservations()->futures()->count();
        $reservationsPassees = $user->reservations()->passees()->count();
        
        // Dernières réservations
        $dernieresReservations = $user->reservations()
                                      ->orderBy('created_at', 'desc')
                                      ->take(5)
                                      ->get();
        
        return view('client.dashboard', compact('user', 'reservationsFutures', 'reservationsPassees', 'dernieresReservations'));
    }

    /**
     * Toutes les réservations du client
     */
    public function reservations()
    {
        $reservations = Auth::user()->reservations()
                                ->orderBy('date_reservation', 'desc')
                                ->orderBy('heure_debut', 'desc')
                                ->paginate(10);
        
        return view('client.reservations', compact('reservations'));
    }

    /**
     * Réservations futures
     */
    public function reservationsFutures()
    {
        $reservations = Auth::user()->reservations()
                                    ->futures()
                                    ->paginate(10);
        
        return view('client.reservations-futures', compact('reservations'));
    }

    /**
     * Historique des réservations
     */
    public function historique()
    {
        $reservations = Auth::user()->reservations()
                                    ->passees()
                                    ->paginate(10);
        
        return view('client.historique', compact('reservations'));
    }

    /**
     * Annuler une réservation
     */
    public function annulerReservation($id)
    {
        $reservation = Reservation::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->whereIn('statut', ['en_attente', 'confirmee'])
                                  ->firstOrFail();
        
        $reservation->update([
            'statut' => 'annulee',
            'notes' => 'Annulé par le client',
        ]);
        
        return back()->with('success', 'Votre réservation a été annulée avec succès.');
    }

    /**
     * Profil utilisateur
     */
    public function profil()
    {
        return view('client.profil');
    }

    /**
     * Mettre à jour le profil
     */
    public function updateProfil(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ]);

        Auth::user()->update($validated);

        return back()->with('success', 'Votre profil a été mis à jour avec succès.');
    }

}
