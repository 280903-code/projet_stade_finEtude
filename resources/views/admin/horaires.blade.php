@extends('layouts.app')

@section('title', 'Gestion des Horaires - FootArena')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Gestion des Horaires</h1>
        <p class="text-gray-600 mt-2">Ajoutez et modifiez les horaires d'ouverture</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-4">Ajouter un horaire</h3>
                
                <form method="POST" action="{{ route('admin.horaire.store') }}" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Jour de la semaine *</label>
                        <select name="jour_semaine" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('jour_semaine') border-red-500 @enderror" required>
                            <option value="">Sélectionner</option>
                            <option value="lundi">Lundi</option>
                            <option value="mardi">Mardi</option>
                            <option value="mercredi">Mercredi</option>
                            <option value="jeudi">Jeudi</option>
                            <option value="vendredi">Vendredi</option>
                            <option value="samedi">Samedi</option>
                            <option value="dimanche">Dimanche</option>
                        </select>
                        @error('jour_semaine')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Heure début *</label>
                        <input type="time" name="heure_debut" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('heure_debut') border-red-500 @enderror" required>
                        @error('heure_debut')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Heure fin *</label>
                        <input type="time" name="heure_fin" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('heure_fin') border-red-500 @enderror" required>
                        @error('heure_fin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="disponible" value="1" checked class="w-4 h-4 text-green-700 border-gray-300 rounded focus:ring-green-700">
                            <span class="ml-2 text-gray-700">Disponible</span>
                        </label>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Raison de blocage (optionnel)</label>
                        <input type="text" name="raison_blocage" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('raison_blocage') border-red-500 @enderror">
                        @error('raison_blocage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold w-full">
                        <i class="fas fa-plus mr-2"></i> Ajouter
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-4">Horaires existants</h3>
                
                @if($horaires->count() > 0)
                    <div class="space-y-3">
                        @foreach($horaires as $horaire)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-bold text-lg capitalize">{{ $horaire->jour_semaine }}</h4>
                                        <p class="text-gray-600">
                                            {{ \Carbon\Carbon::parse($horaire->heure_debut)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($horaire->heure_fin)->format('H:i') }}
                                        </p>
                                        @if($horaire->raison_blocage)
                                            <p class="text-sm text-red-600 mt-1">
                                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $horaire->raison_blocage }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                            {{ $horaire->disponible ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $horaire->disponible ? 'Disponible' : 'Bloqué' }}
                                        </span>
                                        
                                        <form method="POST" action="{{ route('admin.horaire.delete', $horaire->id) }}" class="inline" onsubmit="return confirm('Supprimer cet horaire ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700">
                                                Supp
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-clock text-6xl text-gray-300 mb-4"></i>
                        <p class="text-xl text-gray-600">Aucun horaire défini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection