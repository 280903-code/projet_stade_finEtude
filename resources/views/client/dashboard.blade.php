@extends('layouts.app')

@section('title', 'Dashboard - FootArena')

@section('content')
<div class="client-dashboard">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">BONJOUR, <span class="highlight">{{ $user->name }}</span></h1>
            <p class="dashboard-subtitle">Bienvenue sur votre espace FootArena</p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stat-card stat-card-primary">
            <div class="stat-number">{{ $reservationsFutures }}</div>
            <div class="stat-label">À VENIR</div>
        </div>
        <div class="stat-card stat-card-secondary">
            <div class="stat-number">{{ $reservationsPassees }}</div>
            <div class="stat-label">PASSÉES</div>
        </div>
        <div class="stat-card stat-card-accent">
            <div class="stat-number">{{ $reservationsFutures + $reservationsPassees }}</div>
            <div class="stat-label">TOTAL</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="dashboard-content">
        <!-- Reservations Section -->
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">DERNIÈRES RÉSERVATIONS</h2>
                <a href="{{ route('client.reservations.futures') }}" class="section-link">
                    VOIR TOUT <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            @if($dernieresReservations->count() > 0)
                <div class="reservations-list">
                    @foreach($dernieresReservations as $reservation)
                        <div class="reservation-item reservation-item-{{ $reservation->statut }}">
                            <div class="reservation-date-box">
                                <div class="date-day">{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d') }}</div>
                                <div class="date-month">{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('M') }}</div>
                            </div>
                            <div class="reservation-details">
                                <div class="reservation-time">
                                    {{ \Carbon\Carbon::parse($reservation->heure_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservation->heure_fin)->format('H:i') }}
                                </div>
                                <div class="reservation-location">FootArena, Medina, Dakar</div>
                            </div>
                            <div class="reservation-status">
                                <span class="status-badge status-{{ $reservation->statut }}">
                                    @if($reservation->statut == 'confirmee') CONFIRMÉE
                                    @elseif($reservation->statut == 'en_attente') EN ATTENTE
                                    @else ANNULÉE
                                    @endif
                                </span>
                                <div class="reservation-price">{{ number_format($reservation->prix, 0, ',', ' ') }} FCFA</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <h3>AUCUNE RÉSERVATION</h3>
                    <p>Commencez par réserver votre premier créneau</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions Section -->
        <div class="content-section">
            <h2 class="section-title">ACTIONS RAPIDES</h2>
            <div class="quick-actions-grid">
                <a href="{{ route('reservation.index') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h3 class="action-title">Nouvelle Réservation</h3>
                </a>
                
                <a href="{{ route('client.reservations.futures') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <h3 class="action-title">Mes Réservations</h3>
                </a>
                
                <a href="{{ route('client.historique') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3 class="action-title">Historique</h3>
                </a>
                
                <a href="{{ route('client.profil') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h3 class="action-title">Mon Profil</h3>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
