@extends('layouts.app')

@section('title', 'Connexion - FootArena')

@section('content')
<!-- Hero Section -->
<section class="reservation-hero">
    <div class="container text-center">
        <h1>Connexion</h1>
        <p>Connectez-vous à votre compte</p>
    </div>
</section>

<!-- Login Section -->
<section class="section">
    <div class="container-md">
        <div class="card">
            <div class="text-center mb-8">
                <i class="fas fa-user-circle text-6xl text-green mb-4"></i>
                <h2 class="font-bold text-3xl">Bienvenue</h2>
                <p class="text-gray mt-2">Connectez-vous pour réserver</p>
            </div>
            
            @if(session('error'))
                <div class="alert alert-error mb-6">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}"
                           class="form-input @error('email') border-red @enderror"
                           required
                           autofocus>
                    @error('email')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="form-input @error('password') border-red @enderror"
                           required>
                    @error('password')
                        <p class="text-red text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember"
                               class="w-4 h-4 text-green border-gray rounded">
                        <label for="remember" class="ml-2 text-sm text-gray">Se souvenir de moi</label>
                    </div>
                </div>
                
                <button type="submit" 
                        class="btn-primary w-full">
                    <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-gray">
                    Pas encore de compte ? 
                    <a href="{{ route('register') }}" class="text-green font-semibold">
                        S'inscrire
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection