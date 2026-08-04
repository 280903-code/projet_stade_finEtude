@extends('layouts.app')

@section('title', 'À Propos - FootArena')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection

@section('content')

<section class="about-hero">
    <div class="container">
        <div class="hero-content">
            <h1>À PROPOS DE <span>FOOTARENA</span></h1>
            <p>Le terrain de référence pour les passionnés de football à Dakar</p>
        </div>
    </div>
</section>

<section class="story-section">
    <div class="container">
        <div class="story-container">
            <div class="story-content">
                <h2>Notre Histoire</h2>
                <p>
                    <strong>FootArena</strong> est né d'une passion pour le football et la volonté de créer un espace moderne et convivial à Dakar.
                </p>
            </div>
            <div class="story-image">
                <div class="year-tag">2024</div>
                <img src="{{ asset('img/stade.png') }}" alt="Terrain FootArena">
            </div>
        </div>
    </div>
</section>

<section class="values-section">
    <div class="container">
        <div class="values-header">
            <h2>Nos Valeurs</h2>
        </div>
        <div class="values-grid">
            <div class="value-item" data-number="01">
                <div class="value-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Passion</h3>
                <p>Nous partageons l'amour du football avec chaque joueur qui franchit nos portes.</p>
            </div>
            <div class="value-item" data-number="02">
                <div class="value-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Convivialité</h3>
                <p>Un accueil chaleureux et une ambiance familiale pour tous nos visiteurs.</p>
            </div>
            <div class="value-item" data-number="03">
                <div class="value-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <h3>Excellence</h3>
                <p>Des installations modernes et entretenues pour garantir la meilleure expérience.</p>
            </div>
        </div>
    </div>
</section>

<section class="founder-section">
    <div class="container">
        <div class="founder-header">
            <h2>Le Fondateur</h2>
            <p>La vision derrière FootArena</p>
        </div>

        <div class="founder-container">
            <div class="founder-image-wrapper">
                <img src="{{ asset('img/fondBen.png') }}" alt="Fondateur FootArena" class="founder-image">
            </div>
            <div class="founder-info">
                <div class="founder-name">Elamine Ben ABDOU</div>
                <div class="founder-title">Fondateur et CEO</div>
                <div class="founder-description">
                    <p>Passionné de football depuis l'enfance, Elamine Ben ABDOU a créé FootArena en 2024 avec une vision simple : offrir aux amateurs de football à Dakar un espace moderne, sécurisé et convivial pour pratiquer leur sport favori.</p>
                    <p>Son engagement à l'excellence et à la satisfaction des clients a fait de FootArena le terrain de référence dans la région.</p>
                </div>
                <div class="founder-stats">
                    <div class="stat-item">
                        <div class="stat-number">2024</div>
                        <div class="stat-label">Année de création</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Passion</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Prêt à Jouer ?</h2>
            <p>Réservez votre terrain dès maintenant et profitez d'une expérience de football exceptionnelle.</p>
            <a href="{{ route('reservation.index') }}" class="cta-btn">
                Réserver maintenant
            </a>
        </div>
    </div>
</section>

@endsection
