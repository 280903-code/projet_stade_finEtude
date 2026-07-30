@extends('layouts.app')

@section('title', 'Gestion des Réservations - FootArena')

@section('content')
<div class="admin-dashboard">
    <!-- Header -->
    <div class="admin-header">
        <h1>RÉSERVATIONS</h1>
        <p>Gérez toutes les réservations</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-6">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Filter Bar -->
    <div class="filter-bar">
        <form method="GET" action="{{ route('admin.reservations') }}" class="flex gap-4 flex-wrap w-full">
            <div class="flex-1 min-w-[200px]">
                <select name="statut" class="w-full">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmee" {{ request('statut') == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                    <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
            
            <div class="flex-1 min-w-[200px]">
                <input type="date" name="date_debut" value="{{ request('date_debut') }}" class="w-full">
            </div>
            
            <div class="flex-1 min-w-[200px]">
                <input type="date" name="date_fin" value="{{ request('date_fin') }}" class="w-full">
            </div>
            
            <button type="submit" class="admin-action-btn">
                <i class="fas fa-filter"></i> Filtrer
            </button>
        </form>
    </div>

    <!-- Reservations Table -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">Liste des Réservations</h2>
        </div>
        
        @if($reservations && $reservations->count() > 0)
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Prix</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-black text-white rounded-full flex items-center justify-center font-bold">
                                            {{ substr($reservation->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold">{{ $reservation->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $reservation->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
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
                                <td>
                                    <div class="flex gap-2">
                                        @if($reservation->statut == 'en_attente')
                                            <form method="POST" action="{{ route('admin.reservation.confirmer', $reservation->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="admin-action-btn" title="Confirmer">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($reservation->statut != 'annulee')
                                            <form method="POST" action="{{ route('admin.reservation.annuler', $reservation->id) }}" class="inline" onsubmit="return confirm('Annuler cette réservation ?')">
                                                @csrf
                                                <button type="submit" class="admin-action-btn admin-action-btn-warning" title="Annuler">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form method="POST" action="{{ route('admin.reservation.supprimer', $reservation->id) }}" class="inline" onsubmit="return confirm('Supprimer définitivement cette réservation ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-action-btn admin-action-btn-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($reservations->hasPages())
                <div class="pagination">
                    {{ $reservations->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Aucune réservation</h3>
                <p>Pour le moment</p>
            </div>
        @endif
    </div>
</div>
@endsection
