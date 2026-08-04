@extends('layouts.app')

@section('title', 'Mes Réservations - FootArena')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Toutes mes Réservations</h1>
        <p class="text-gray-600 mt-2">Consultez l'historique complet de vos réservations</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($reservations->count() > 0)
        <div class="space-y-4">
            @foreach($reservations as $reservation)
                <div class="bg-white rounded-lg shadow-lg p-6 card-hover">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="flex items-start space-x-4 mb-4 md:mb-0">
                            <div class="text-green-700 text-4xl">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('l d F Y') }}
                                </h3>
                                <p class="text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ \Carbon\Carbon::parse($reservation->heure_debut)->format('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($reservation->heure_fin)->format('H:i') }}
                                </p>
                                <p class="text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    FootArena, Medina, Dakar
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-end space-y-2">
                            <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold
                                @if($reservation->statut == 'confirmee') bg-green-100 text-green-700
                                @elseif($reservation->statut == 'en_attente') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700
                                @endif">
                                @if($reservation->statut == 'confirmee')
                                    <i class="fas fa-check-circle mr-1"></i> Confirmée
                                @elseif($reservation->statut == 'en_attente')
                                    <i class="fas fa-clock mr-1"></i> En attente
                                @else
                                    <i class="fas fa-times-circle mr-1"></i> Annulée
                                @endif
                            </span>
                            <p class="text-2xl font-bold text-green-700">
                                {{ number_format($reservation->prix, 0, ',', ' ') }} FCFA
                            </p>
                            
                            @if($reservation->statut != 'annulee')
                                <form method="POST" action="{{ route('client.reservation.annuler', $reservation->id) }}" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-semibold mt-2">
                                        <i class="fas fa-times-circle mr-1"></i> Annuler
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    
                    @if($reservation->notes)
                        <div class="mt-4 bg-gray-50 rounded-lg p-3">
                            <p class="text-sm text-gray-600">
                                <strong>Note:</strong> {{ $reservation->notes }}
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $reservations->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
            <p class="text-xl text-gray-600 mb-6">Vous n'avez pas encore de réservations</p>
            <a href="{{ route('reservation.index') }}" class="btn-primary text-white px-6 py-3 rounded-lg inline-block">
                <i class="fas fa-plus-circle mr-2"></i> Réserver un créneau
            </a>
        </div>
    @endif
</div>
@endsection