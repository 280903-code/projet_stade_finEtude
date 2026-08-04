@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs - FootArena')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Gestion des Utilisateurs</h1>
        <p class="text-gray-600 mt-2">Gérez les comptes clients</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4">Utilisateur</th>
                        <th class="text-left py-3 px-4">Email</th>
                        <th class="text-left py-3 px-4">Rôle</th>
                        <th class="text-left py-3 px-4">Téléphone</th>
                        <th class="text-left py-3 px-4">Inscription</th>
                        <th class="text-left py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($utilisateurs as $utilisateur)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="bg-green-700 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-3">
                                        {{ substr($utilisateur->name, 0, 1) }}
                                    </div>
                                    <span class="font-semibold">{{ $utilisateur->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">{{ $utilisateur->email }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $utilisateur->role == 'admin' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $utilisateur->role == 'admin' ? 'Admin' : 'Client' }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                {{ $utilisateur->telephone ?? 'Non renseigné' }}
                            </td>
                            <td class="py-3 px-4">
                                {{ \Carbon\Carbon::parse($utilisateur->created_at)->format('d/m/Y') }}
                            </td>
                            <td class="py-3 px-4">
                                <form method="POST" action="{{ route('admin.utilisateur.role', $utilisateur->id) }}" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" onchange="this.form.submit()" class="text-sm border border-gray-300 rounded-lg px-2 py-1">
                                        <option value="client" {{ $utilisateur->role == 'client' ? 'selected' : '' }}>Client</option>
                                        <option value="admin" {{ $utilisateur->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>
                                
                                <form method="POST" action="{{ route('admin.utilisateur.delete', $utilisateur->id) }}" class="inline ml-2" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">
                                        Supp
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-4">
            {{ $utilisateurs->links() }}
        </div>
    </div>
</div>
@endsection