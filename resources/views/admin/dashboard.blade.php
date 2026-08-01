@extends('layouts.app')

@section('title', 'Dashboard Admin - FootArena')

@section('content')
<div class="admin-dashboard">
    <!-- Header -->
    <div class="admin-header">
        <h1>DASHBOARD</h1>
        <p>Vue d'ensemble de votre plateforme</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Réservations</div>
            <div class="stat-value">{{ $totalReservations }}</div>
            <div class="stat-change positive">+12% ce mois</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-label">Revenus</div>
            <div class="stat-value">{{ number_format($revenus, 0, ',', ' ') }}</div>
            <div class="stat-change positive">FCFA</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-label">Utilisateurs</div>
            <div class="stat-value">{{ $totalUtilisateurs }}</div>
            <div class="stat-change positive">+5% ce mois</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-label">Ce mois</div>
            <div class="stat-value">{{ $reservationsMois }}</div>
            <div class="stat-change">réservations</div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Chart Section -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Évolution des réservations</h2>
            </div>
            <div class="chart-container">
                <canvas id="reservationsChart"></canvas>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Gestion</h2>
            </div>
            <div class="notification-list">
                <a href="{{ route('admin.utilisateurs') }}" class="notification-item">
                    <div class="notification-number">01</div>
                    <div class="notification-content">
                        <h3>Utilisateurs</h3>
                        <p>Gérer les comptes</p>
                    </div>
                    <span class="notification-arrow">→</span>
                </a>
                
                <a href="{{ route('admin.horaires') }}" class="notification-item">
                    <div class="notification-number">02</div>
                    <div class="notification-content">
                        <h3>Horaires</h3>
                        <p>Configurer les créneaux</p>
                    </div>
                    <span class="notification-arrow">→</span>
                </a>
                
                <a href="{{ route('admin.prix') }}" class="notification-item">
                    <div class="notification-number">03</div>
                    <div class="notification-content">
                        <h3>Tarifs</h3>
                        <p>Modifier les prix</p>
                    </div>
                    <span class="notification-arrow">→</span>
                </a>
                
                <a href="{{ route('admin.reservations') }}" class="notification-item">
                    <div class="notification-number">04</div>
                    <div class="notification-content">
                        <h3>Réservations</h3>
                        <p>Gérer les réservations</p>
                    </div>
                    <span class="notification-arrow">→</span>
                </a>
                
                <a href="{{ route('admin.messages') }}" class="notification-item">
                    <div class="notification-number">05</div>
                    <div class="notification-content">
                        <h3>Messages</h3>
                        <p>Boîte de réception</p>
                    </div>
                    <span class="notification-badge">{{ $messagesNonLus }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">Dernières Réservations</h2>
            <a href="{{ route('admin.reservations') }}" class="admin-card-link">Voir tout</a>
        </div>
        
        @if($dernieresReservations->count() > 0)
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Prix</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dernieresReservations as $reservation)
                            <tr>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->heure_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservation->heure_fin)->format('H:i') }}</td>
                                <td>{{ number_format($reservation->prix, 0, ',', ' ') }} FCFA</td>
                                <td>
                                    <span class="status-badge status-{{ $reservation->statut }}">
                                        @if($reservation->statut == 'confirmee') Confirmée
                                        @elseif($reservation->statut == 'en_attente') En attente
                                        @else Annulée
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Aucune réservation</h3>
                <p>Pour le moment</p>
            </div>
        @endif
    </div>
</div>

<!-- on insert Chart.js  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('reservationsChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels ?? []) !!},
                datasets: [{
                    label: 'Réservations',
                    data: {!! json_encode($chartData ?? []) !!},
                    borderColor: '#0a0a0a',
                    backgroundColor: 'rgba(26, 95, 26, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#1a5f1a',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#e6dfdf',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: '#ddd'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#ebebeb',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
</script>
@endsection
