@extends('layouts.app')

@section('title', 'Inscription - FootArena')

@section('content')
<!-- Hero Section -->
<section class="reservation-hero">
    <div class="container text-center">
        <h1>Inscription</h1>
        <p>Créez votre compte et réservez facilement</p>
    </div>
</section>

<!-- Register Section -->
<section class="section">
    <div class="container-md">
        <div class="card">
            <div class="text-center mb-8">
                <i class="fas fa-user-plus text-6xl text-green mb-4"></i>
                <h2 class="font-bold text-3xl">Créer un compte</h2>
                <p class="text-gray mt-2">Rejoignez FootArena</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="form-label">Nom complet *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           class="form-input @error('name') border-red @enderror"
                           required
                           autofocus>
                    @error('name')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}"
                           class="form-input @error('email') border-red @enderror"
                           required>
                    @error('email')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" 
                           name="telephone" 
                           id="telephone" 
                           value="{{ old('telephone') }}"
                           class="form-input @error('telephone') border-red @enderror">
                    @error('telephone')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="adresse" class="form-label">Adresse</label>
                    <textarea name="adresse" 
                              id="adresse" 
                              rows="3"
                              class="form-textarea @error('adresse') border-red @enderror">{{ old('adresse') }}</textarea>
                    @error('adresse')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password" class="form-label">Mot de passe *</label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="form-input @error('password') border-red @enderror"
                           required>
                    @error('password')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation"
                           class="form-input"
                           required>
                </div>
                
                <button type="submit" 
                        class="btn-primary w-full">
                    <i class="fas fa-user-plus mr-2"></i> S'inscrire
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-gray">
                    Déjà un compte ? 
                    <a href="{{ route('login') }}" class="text-green font-semibold">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection