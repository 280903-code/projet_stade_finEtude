<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Page À propos
Route::get('/a-propos', [HomeController::class, 'aPropos'])->name('a-propos');

// Page Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Page Réservation (calendrier public)
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
Route::get('/reservation/creneaux', [ReservationController::class, 'getCreneaux'])->name('reservation.creneaux');

/*
|--------------------------------------------------------------------------
| Routes d'Authentification
|--------------------------------------------------------------------------
*/

// Inscription
Route::get('/inscription', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/inscription', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
    ->middleware('guest');

// Connexion
Route::get('/connexion', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/connexion', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// Déconnexion
Route::post('/deconnexion', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Routes Client (protégées par authentification)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Dashboard client
    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    
    // Mes réservations
    Route::get('/client/reservations', [ClientController::class, 'reservations'])->name('client.reservations');
    Route::get('/client/reservations/futures', [ClientController::class, 'reservationsFutures'])->name('client.reservations.futures');
    Route::get('/client/reservations/historique', [ClientController::class, 'historique'])->name('client.historique');
    
    // Créer une réservation
    Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
    
    // Annuler une réservation
    Route::post('/client/reservation/{id}/annuler', [ClientController::class, 'annulerReservation'])->name('client.reservation.annuler');
    
    // Profil utilisateur
    Route::get('/client/profil', [ClientController::class, 'profil'])->name('client.profil');
    Route::post('/client/profil/update', [ClientController::class, 'updateProfil'])->name('client.profil.update');
});

/*
|--------------------------------------------------------------------------
| Routes Administrateur (protégées par middleware admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Gestion des réservations
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations');
    Route::post('/reservation/{id}/confirmer', [AdminController::class, 'confirmerReservation'])->name('reservation.confirmer');
    Route::post('/reservation/{id}/annuler', [AdminController::class, 'annulerReservation'])->name('reservation.annuler');
    Route::delete('/reservation/{id}/supprimer', [AdminController::class, 'supprimerReservation'])->name('reservation.supprimer');
    
    // Gestion des horaires
    Route::get('/horaires', [AdminController::class, 'horaires'])->name('horaires');
    Route::post('/horaire/store', [AdminController::class, 'storeHoraire'])->name('horaire.store');
    Route::put('/horaire/{id}/update', [AdminController::class, 'updateHoraire'])->name('horaire.update');
    Route::delete('/horaire/{id}/delete', [AdminController::class, 'deleteHoraire'])->name('horaire.delete');
    
    // Gestion des prix
    Route::get('/prix', [AdminController::class, 'prix'])->name('prix');
    Route::post('/prix/update', [AdminController::class, 'updatePrix'])->name('prix.update');
    
    // Gestion des utilisateurs
    Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs');
    Route::put('/utilisateur/{id}/role', [AdminController::class, 'updateRole'])->name('utilisateur.role');
    Route::delete('/utilisateur/{id}/delete', [AdminController::class, 'deleteUtilisateur'])->name('utilisateur.delete');
    
    // Gestion des messages de contact
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
    Route::post('/message/{id}/lu', [AdminController::class, 'marquerLu'])->name('message.lu');
    Route::delete('/message/{id}/delete', [AdminController::class, 'deleteMessage'])->name('message.delete');
});