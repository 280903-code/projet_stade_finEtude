<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FootArena - Terrain de Foot')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    
    <!-- Page Specific CSS -->
    @if(Request::is('/'))
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @endif
    
    @if(Request::is('reservation') || Request::is('reservation/*'))
        <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
    @endif
    
    @if(Request::is('contact'))
        <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    @endif
    
    @if(Request::is('login') || Request::is('register'))
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @endif
    
    @if(Request::is('admin/*'))
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @endif
    
    @if(Request::is('client/*'))
        <link rel="stylesheet" href="{{ asset('css/client.css') }}">
    @endif
    
    @yield('styles')
</head>
<body class="{{ Request::is('/') ? 'home-page' : '' }}">
    <!-- Navigation -->
    <nav class="nav" style="{{ Request::is('/') ? 'background: transparent; box-shadow: none; border-bottom: none;' : '' }}">
        <div class="nav-content">
            <div class="nav-logo">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <i class="fas fa-futbol text-green text-3xl"></i>
                    <span class="text-2xl font-bold text-green">FootArena</span>
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="nav-menu">
                <a href="{{ route('home') }}" class="nav-link">Accueil</a>
                <a href="{{ route('reservation.index') }}" class="nav-link">Réservation</a>
                <a href="{{ route('a-propos') }}" class="nav-link">À propos</a>
                <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                
                @guest
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </a>
                    <a href="{{ route('register') }}" class="nav-btn">Inscription</a>
                @else
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i> Admin
                        </a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="nav-link">
                            <i class="fas fa-user"></i> Mon Espace
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="nav-link text-red">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                @endguest
            </div>
            
            <!-- Mobile menu button -->
            <div>
                <button id="mobile-menu-button" class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu Backdrop -->
        <div id="mobile-menu-backdrop" class="mobile-menu-backdrop"></div>
        
        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu" class="mobile-menu-overlay">
            <div class="flex flex-col h-full">
                <div class="mobile-menu-header">
                    <span class="font-bold text-green">Menu</span>
                    <button id="mobile-menu-close" class="mobile-menu-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="mobile-menu-content">
                    <a href="{{ route('home') }}" class="mobile-menu-link">Accueil</a>
                    <a href="{{ route('reservation.index') }}" class="mobile-menu-link">Réservation</a>
                    <a href="{{ route('a-propos') }}" class="mobile-menu-link">À propos</a>
                    <a href="{{ route('contact') }}" class="mobile-menu-link">Contact</a>
                    
                    @guest
                        <a href="{{ route('login') }}" class="mobile-menu-link">Connexion</a>
                        <a href="{{ route('register') }}" class="mobile-menu-link font-semibold text-green">Inscription</a>
                    @else
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="mobile-menu-link">Admin</a>
                        @else
                            <a href="{{ route('client.dashboard') }}" class="mobile-menu-link">Mon Espace</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="mobile-menu-link text-red">Déconnexion</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid grid-4">
                <div class="col-span-2">
                    <div class="footer-logo">
                        <i class="fas fa-futbol"></i>
                        <span>FootArena</span>
                    </div>
                    <p class="footer-text">
                        Le meilleur terrain de mini-foot de la région. Réservez votre créneau en ligne et profitez d'une expérience de jeu exceptionnelle.
                    </p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-4">Liens Rapides</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{ route('reservation.index') }}">Réservation</a></li>
                        <li><a href="{{ route('a-propos') }}">À propos</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-4">Contact</h3>
                    <ul class="footer-contact">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Medina, Dakar, Sénégal</li>
                        <li><i class="fas fa-phone mr-2"></i> +221 77 123 45 67</li>
                        <li><i class="fas fa-envelope mr-2"></i> contact@minifoot.sn</li>
                        <li><i class="fas fa-clock mr-2"></i> 08h - 22h</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 FootArena. Tous droits réservés. Développé avec ❤️ au Sénégal</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
        
        function openMobileMenu() {
            mobileMenu.classList.add('open');
            mobileMenuBackdrop.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileMenu() {
            mobileMenu.classList.remove('open');
            mobileMenuBackdrop.classList.remove('open');
            document.body.style.overflow = '';
        }
        
        mobileMenuButton.addEventListener('click', openMobileMenu);
        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileMenuBackdrop.addEventListener('click', closeMobileMenu);
        
        // Close menu when clicking on a link
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
        
        // Auto-hide flash messages
        setTimeout(function() {
            $('.alert-success, .alert-error').fadeOut('slow');
        }, 5000);
        
        // Header scroll effect
        const nav = document.querySelector('.nav');
        const isHomePage = document.body.classList.contains('home-page');
        
        // Initialize immediately on page load
        if (isHomePage) {
            nav.classList.remove('scrolled');
        }
        
        window.addEventListener('scroll', function() {
            if (isHomePage) {
                if (window.scrollY > 50) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>