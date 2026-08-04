@extends('layouts.app')

@section('title', 'Accueil - FootArena')

@section('content')

<!-- Hero Section -->
<section class="hero">

    <div class="hero-bg">
        <img src="{{ asset('img/photo_accueil.jpeg') }}"
             alt="Terrain de football">
    </div>
    <div class="hero-overlay"></div>
    
    <!-- Content -->
    <div class="hero-content">
        <h1 class="hero-title">
            Bienvenue au <span class="text-yellow">FootArena</span>
        </h1>
        <p class="hero-subtitle">
            Le meilleur terrain des mini stades de Dakar. Réservez votre créneau en ligne et vivez une expérience de jeu exceptionnelle.
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

<section id="services" class="services-section">
    <div class="container">
        <h2 class="services-title">NOS SERVICES</h2>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-number">01</div>
                <div class="service-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="service-title">Horaires Flexibles</h3>
                <p class="service-desc">Ouvert 7j/7 de 8h à 00h. Réservez en ligne à tout moment.</p>
            </div>
            
            <div class="service-card">
                <div class="service-number">02</div>
                <div class="service-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="service-title">Terrain Sécurisé</h3>
                <p class="service-desc">Terrain éclairé et clôturé pour votre sécurité.</p>
            </div>
            
            <div class="service-card">
                <div class="service-number">03</div>
                <div class="service-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3 class="service-title">Équipements de Qualité</h3>
                <p class="service-desc">Gazon synthétique de dernière génération.</p>
            </div>
        </div>
    </div>
</section>


<section class="section">
    <div class="container">
        <div class="text-center mb-8-home">
            <h2 class="section-title">Horaires & Tarifs</h2>
            <p class="section-subtitle">Des prix adaptés à tous les budgets</p>
        </div>
        
        <div class="grid grid-3">
            <div class="card text-center" style="background: linear-gradient(rgba(0, 0, 0, 0.32), rgba(0, 0, 0, 0.4)), url('{{ asset('img/stade_matin.png') }}') center/cover; color: white; border: none;">
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
            
            <div class="card text-center" style="background: linear-gradient(rgba(0, 0, 0, 0.07), rgba(0, 0, 0, 0.11)), url('{{ asset('img/stade_midi.png') }}') center/cover; color: white; border: none;">
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
            
            <div class="card text-center" style="background: linear-gradient(rgba(0, 0, 0, 0.21), rgba(0, 0, 0, 0.33)), url('{{ asset('img/stade_soir.png') }}') center/cover; color: white; border: none;">
                <div class="text-yellow text-4xl mb-4">
                    <i class="fas fa-moon"></i>
                </div>
                <h3 class="card-title" style="color: white;">Soir</h3>
                <p class="text-gray-200 mb-4">18h - 00h</p>
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

<section class="section hero-gradient text-white">
    <div class="container text-center">
        <h2 class="section-title">Prêt à jouer ?</h2>
        <p class="text-xl mb-8-home text-gray-200">
            Réservez votre créneau maintenant et vivez une expérience de jeu exceptionnelle.
        </p>
        <a href="{{ route('reservation.index') }}" class="btn-yellow inline-block">
            <i class="fas fa-calendar-alt mr-2"></i> Réserver un créneau
        </a>
    </div>
</section>
@endsection