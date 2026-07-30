@extends('layouts.app')

@section('title', 'Mon Profil - FootArena')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Mon Profil</h1>
        <p class="text-gray-600 mt-2">Gérez vos informations personnelles</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="flex items-center mb-8">
            <div class="bg-green-700 text-white rounded-full w-20 h-20 flex items-center justify-center text-3xl font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="ml-6">
                <h2 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
                <p class="text-gray-600">{{ Auth::user()->email }}</p>
                <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    Client
                </span>
            </div>
        </div>

        <form method="POST" action="{{ route('client.profil.update') }}" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Nom complet *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', Auth::user()->name) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-700 focus:border-transparent @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email *</label>
                    <input type="email" 
                           id="email" 
                           value="{{ Auth::user()->email }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100"
                           disabled>
                    <p class="text-sm text-gray-500 mt-1">L'email ne peut pas être modifié</p>
                </div>
            </div>

            <div>
                <label for="telephone" class="block text-gray-700 font-semibold mb-2">Téléphone</label>
                <input type="text" 
                       name="telephone" 
                       id="telephone" 
                       value="{{ old('telephone', Auth::user()->telephone) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-700 focus:border-transparent @error('telephone') border-red-500 @enderror">
                @error('telephone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="adresse" class="block text-gray-700 font-semibold mb-2">Adresse</label>
                <textarea name="adresse" 
                          id="adresse" 
                          rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-700 focus:border-transparent @error('adresse') border-red-500 @enderror">{{ old('adresse', Auth::user()->adresse) }}</textarea>
                @error('adresse')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                    <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection