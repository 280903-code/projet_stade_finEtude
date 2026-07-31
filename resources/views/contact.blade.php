@extends('layouts.app')

@section('title', 'Contact - FootArena')

@section('content')

<!-- HERO -->
<section class="contact-hero">
    <div class="container">
        <div class="hero-content">
            <h1>CONTACTEZ <span>NOUS</span></h1>
            <p>Nous sommes à votre écoute pour toute question</p>
        </div>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="contact-section">
    <div class="container">
        <div class="contact-container">
            <!-- Contact Info -->
            <div class="contact-info-wrapper">
                <h2>FootArena</h2>
                
                <div class="info-list">
                    <img src="{{ asset('img/stade.png') }}" alt="photo du stade" class="contact-image">
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <h2>Envoyez-nous un message</h2>
                
                @if(session('success'))
                    <div class="alert alert-success mb-6">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nom">Nom complet *</label>
                        <input type="text" 
                               name="nom" 
                               id="nom" 
                               value="{{ old('nom') }}"
                               required>
                        @error('nom')
                            <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="text" 
                               name="telephone" 
                               id="telephone" 
                               value="{{ old('telephone') }}">
                        @error('telephone')
                            <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea name="message" 
                                  id="message" 
                                  rows="3"
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        Envoyer
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- MAP SECTION -->
<section class="map-section">
    <div class="container">
        <h2 class="map-title">NOUS TROUVER</h2>
        <div class="map-grid">
            <div class="map-embed-wrapper">
                <iframe 
                    class="map-iframe"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15438.10110116672!2d-17.46050526002253!3d14.682861473010101!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xec1725f3676fa21%3A0x147bc7f1291d491!2zTcOpZGluYSwgRGFrYXI!5e0!3m2!1sfr!2ssn!4v1784871580465!5m2!1sfr!2ssn" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>
            <div class="map-contact-info">
                <div class="map-info-block">
                    <div class="map-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="map-info-text">
                        <span class="map-info-label">ADRESSE</span>
                        <p class="map-info-value">Medina, Dakar, Sénégal</p>
                    </div>
                </div>
                <div class="map-info-block">
                    <div class="map-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="map-info-text">
                        <span class="map-info-label">TÉLÉPHONE</span>
                        <p class="map-info-value">+221 77 123 45 67</p>
                    </div>
                </div>
                <div class="map-info-block">
                    <div class="map-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="map-info-text">
                        <span class="map-info-label">EMAIL</span>
                        <p class="map-info-value">contact@footarena.sn</p>
                    </div>
                </div>
                <div class="map-info-block">
                    <div class="map-info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="map-info-text">
                        <span class="map-info-label">HORAIRES</span>
                        <p class="map-info-value">Lun - Dim: 8h00 - 23h59</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SOCIAL SECTION -->
<section class="social-section">
    <div class="container">
        <h2>Suivez-nous</h2>
        <div class="social-links">
            <a href="#" class="social-link">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-link">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="social-link">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="#" class="social-link">
                <i class="fab fa-twitter"></i>
            </a>
        </div>
    </div>
</section>

@endsection
