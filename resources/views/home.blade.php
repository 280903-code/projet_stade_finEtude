@extends('layouts.app')

@section('title', 'Accueil - FootArena')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <!-- Background Image -->
    <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=1920&h=1080&fit=crop"
             alt="Terrain de football">
    </div>
    
    <!-- Dark Overlay -->
    <div class="hero-overlay"></div>
    
    <!-- Content -->
    <div class="hero-content">
        <h1 class="hero-title">
            Bienvenue au <span class="text-yellow">FootArena</span>
        </h1>
        <p class="hero-subtitle">
            Le meilleur terrain de mini-foot de Dakar. Réservez votre créneau en ligne et vivez une expérience de jeu exceptionnelle.
        </p>
        <div class="hero-buttons">
            <a href="{{ route('reservation.index') }}" class="btn-yellow shadow-lg">
                <i class="fas fa-calendar-alt mr-2"></i> Réserver maintenant
            </a>
            <a href="#services" class="btn-secondary">
                Découvrir
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="section">
    <div class="container">
        <div class="text-center mb-8">
            <h2 class="section-title">Nos Services</h2>
            <p class="section-subtitle">Ce que nous vous proposons</p>
        </div>
        
        <div class="grid grid-3">
            <div class="card">
                <div class="text-center mb-4">
                    <i class="fas fa-clock text-5xl text-green"></i>
                </div>
                <h3 class="card-title text-center">Horaires Flexibles</h3>
                <p class="card-text text-center">
                    Ouvert 7j/7 de 8h à 22h. Réservez en ligne à tout moment.
                </p>
            </div>
            
            <div class="card">
                <div class="text-center mb-4">
                    <i class="fas fa-shield-alt text-5xl text-green"></i>
                </div>
                <h3 class="card-title text-center">Terrain Sécurisé</h3>
                <p class="card-text text-center">
                    Terrain éclairé et clôturé pour votre sécurité.
                </p>
            </div>
            
            <div class="card">
                <div class="text-center mb-4">
                    <i class="fas fa-trophy text-5xl text-green"></i>
                </div>
                <h3 class="card-title text-center">Équipements de Qualité</h3>
                <p class="card-text text-center">
                    Gazon synthétique de dernière génération.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Horaires et Prix Section -->
<section class="section">
    <div class="container">
        <div class="text-center mb-8">
            <h2 class="section-title">Horaires & Tarifs</h2>
            <p class="section-subtitle">Des prix adaptés à tous les budgets</p>
        </div>
        
        <div class="grid grid-3">
            <div class="card text-center" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=600&h=400&fit=crop') center/cover; color: white; border: none;">
                <div class="text-yellow text-4xl mb-4">
                    <i class="fas fa-sun"></i>
                </div>
                <h3 class="card-title" style="color: white;">Matin</h3>
                <p class="text-gray-200 mb-4">8h - 12h</p>
                <p class="text-4xl font-bold text-yellow">
                    @if($terrain)
                        {{ number_format($terrain->prix_matin, 0, ',', ' ') }} FCFA
                    @else
                        10 000 FCFA
                    @endif
                </p>
            </div>
            
            <div class="card text-center" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=600&h=400&fit=crop') center/cover; color: white; border: none;">
                <div class="text-yellow text-4xl mb-4">
                    <i class="fas fa-cloud-sun"></i>
                </div>
                <h3 class="card-title" style="color: white;">Après-midi</h3>
                <p class="text-gray-200 mb-4">12h - 18h</p>
                <p class="text-4xl font-bold text-yellow">
                    @if($terrain)
                        {{ number_format($terrain->prix_apres_midi, 0, ',', ' ') }} FCFA
                    @else
                        15 000 FCFA
                    @endif
                </p>
            </div>
            
            <div class="card text-center" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=600&h=400&fit=crop') center/cover; color: white; border: none;">
                <div class="text-yellow text-4xl mb-4">
                    <i class="fas fa-moon"></i>
                </div>
                <h3 class="card-title" style="color: white;">Soir</h3>
                <p class="text-gray-200 mb-4">18h - 22h</p>
                <p class="text-4xl font-bold text-yellow">
                    @if($terrain)
                        {{ number_format($terrain->prix_soir, 0, ',', ' ') }} FCFA
                    @else
                        20 000 FCFA
                    @endif
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section hero-gradient text-white">
    <div class="container text-center">
        <h2 class="section-title">Prêt à jouer ?</h2>
        <p class="text-xl mb-8 text-gray-200">
            Réservez votre créneau maintenant et vivez une expérience de jeu exceptionnelle.
        </p>
        <a href="{{ route('reservation.index') }}" class="btn-yellow inline-block">
            <i class="fas fa-calendar-alt mr-2"></i> Réserver un créneau
        </a>
    </div>
</section>
@endsection