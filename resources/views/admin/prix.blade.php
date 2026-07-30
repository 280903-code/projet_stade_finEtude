@extends('layouts.app')

@section('title', 'Gestion des Prix - FootArena')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Gestion des Prix</h1>
        <p class="text-gray-600 mt-2">Définissez les tarifs par période</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form method="POST" action="{{ route('admin.prix.update') }}" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Prix Matin -->
                <div class="border border-gray-200 rounded-lg p-6 text-center">
                    <div class="text-yellow-500 text-5xl mb-4">
                        <i class="fas fa-sun"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Matin</h3>
                    <p class="text-gray-600 mb-4">8h00 - 12h00</p>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Prix (FCFA)</label>
                        <input type="number" 
                               name="prix_matin" 
                               value="{{ old('prix_matin', $terrain->prix_matin ?? 10000) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg text-center text-2xl font-bold @error('prix_matin') border-red-500 @enderror"
                               required>
                        @error('prix_matin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Prix Après-midi -->
                <div class="border border-gray-200 rounded-lg p-6 text-center">
                    <div class="text-orange-500 text-5xl mb-4">
                        <i class="fas fa-cloud-sun"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Après-midi</h3>
                    <p class="text-gray-600 mb-4">12h00 - 18h00</p>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Prix (FCFA)</label>
                        <input type="number" 
                               name="prix_apres_midi" 
                               value="{{ old('prix_apres_midi', $terrain->prix_apres_midi ?? 15000) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg text-center text-2xl font-bold @error('prix_apres_midi') border-red-500 @enderror"
                               required>
                        @error('prix_apres_midi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Prix Soir -->
                <div class="border border-gray-200 rounded-lg p-6 text-center">
                    <div class="text-indigo-500 text-5xl mb-4">
                        <i class="fas fa-moon"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Soir</h3>
                    <p class="text-gray-600 mb-4">18h00 - 22h00</p>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Prix (FCFA)</label>
                        <input type="number" 
                               name="prix_soir" 
                               value="{{ old('prix_soir', $terrain->prix_soir ?? 20000) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg text-center text-2xl font-bold @error('prix_soir') border-red-500 @enderror"
                               required>
                        @error('prix_soir')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    Ces prix seront appliqués automatiquement selon l'heure de la réservation. Les prix sont en FCFA (Franc CFA).
                </p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold">
                    <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection