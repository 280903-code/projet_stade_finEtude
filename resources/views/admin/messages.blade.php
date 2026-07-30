@extends('layouts.app')

@section('title', 'Messages de Contact - FootArena')

@section('content')
<div class="admin-dashboard">
    <!-- Header -->
    <div class="admin-header">
        <h1>MESSAGES</h1>
        <p>Consultez les messages envoyés par les visiteurs</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-6">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Messages Table -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">Liste des Messages</h2>
        </div>
        
        @if($messages && $messages->count() > 0)
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr class="{{ !$message->lu ? 'bg-yellow-50' : '' }}">
                                <td class="font-bold">{{ $message->nom }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->telephone ?? 'Non renseigné' }}</td>
                                <td>
                                    <p class="max-w-md truncate">{{ $message->message }}</p>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="status-badge {{ $message->lu ? 'status-confirmee' : 'status-en_attente' }}">
                                        {{ $message->lu ? 'Lu' : 'Non lu' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex gap-2">
                                        @if(!$message->lu)
                                            <form method="POST" action="{{ route('admin.message.lu', $message->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="admin-action-btn" title="Marquer comme lu">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <a href="mailto:{{ $message->email }}" class="admin-action-btn admin-action-btn-secondary" title="Répondre">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                        
                                        <form method="POST" action="{{ route('admin.message.delete', $message->id) }}" class="inline" onsubmit="return confirm('Supprimer ce message ?')">
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
            @if($messages->hasPages())
                <div class="pagination">
                    {{ $messages->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Aucun message</h3>
                <p>Pour le moment</p>
            </div>
        @endif
    </div>
</div>
@endsection
