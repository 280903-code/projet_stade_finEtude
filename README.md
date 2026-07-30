# MiniFoot Pro - Application de Réservation de Terrain de Mini-Foot

## 📋 Description

Application web complète de réservation de terrain de mini-foot développée avec Laravel 11. Cette plateforme permet aux clients de consulter les disponibilités, réserver des créneaux horaires et gérer leurs réservations en ligne.

## 🎯 Objectif

Projet de fin d'études en Génie Logiciel - Application professionnelle prête pour la soutenance.

## 🛠️ Technologies Utilisées

- **Backend**: Laravel 11, PHP 8.2+
- **Base de données**: SQLite (facilement remplaçable par MySQL)
- **Frontend**: Blade Laravel, HTML5, CSS3, JavaScript
- **CSS Framework**: Tailwind CSS (via CDN)
- **Icons**: Font Awesome 6.4.0
- **Fonts**: Google Fonts (Poppins)

## ✨ Fonctionnalités

### 🏠 Espace Public
- **Page d'accueil** avec présentation du terrain, services, tarifs et avis clients
- **Page À propos** avec histoire, valeurs et avantages
- **Page Contact** avec formulaire de contact et informations
- **Système de réservation** interactif avec calendrier visuel

### 🔐 Authentification
- Inscription utilisateur
- Connexion/Déconnexion
- Gestion de profil
- Deux rôles: Client et Administrateur

### 👤 Espace Client
- Dashboard personnel avec statistiques
- Réservations futures et passées
- Annulation de réservation
- Modification du profil
- Système d'avis et notations

### ⚙️ Espace Administrateur
- Dashboard avec statistiques complètes
- Gestion des réservations (confirmer, annuler, supprimer)
- Gestion des horaires d'ouverture
- Gestion des prix par période (Matin, Après-midi, Soir)
- Gestion des utilisateurs (rôles, suppression)
- Modération des avis clients
- Consultation des messages de contact

### 🎨 Design
- Interface moderne et professionnelle
- Design responsive (ordinateur, tablette, mobile)
- Couleurs sportives (vert foncé, noir, blanc)
- Animations légères et transitions fluides
- Navigation intuitive

## 📊 Structure de la Base de Données

### Tables Principales
- **users** - Utilisateurs (clients et administrateurs)
- **terrains** - Informations du terrain et tarifs
- **horaires** - Créneaux horaires disponibles
- **reservations** - Réservations des clients
- **avis_clients** - Avis et notations
- **messages_contact** - Messages de contact

## 🚀 Installation et Configuration

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- SQLite (ou MySQL)
- Node.js et NPM (optionnel)

### Étapes d'Installation

1. **Cloner le projet**
```bash
cd app_reserv
```

2. **Installer les dépendances**
```bash
composer install
```

3. **Configurer le fichier .env**
```env
APP_NAME="MiniFoot Pro"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

4. **Créer la base de données SQLite**
```bash
touch database/database.sqlite
```

5. **Exécuter les migrations**
```bash
php artisan migrate
```

6. **Peupler la base de données**
```bash
php artisan db:seed
```

7. **Démarrer le serveur**
```bash
php artisan serve
```

8. **Accéder à l'application**
```
http://localhost:8000
```

## 👥 Comptes de Test

### Administrateur
- **Email**: admin@minifoot.sn
- **Mot de passe**: admin123
- **Accès**: Dashboard admin, gestion complète

### Client Test
- **Email**: client@test.com
- **Mot de passe**: client123
- **Accès**: Espace client, réservations

## 📁 Structure du Projet

```
app_reserv/
├── app/
│   ├── Models/              # Modèles Eloquent
│   │   ├── User.php
│   │   ├── Terrain.php
│   │   ├── Horaire.php
│   │   ├── Reservation.php
│   │   ├── MessageContact.php
│   │   └── AvisClient.php
│   └── Http/
│       ├── Controllers/     # Controllers
│       │   ├── HomeController.php
│       │   ├── ReservationController.php
│       │   ├── ClientController.php
│       │   ├── AdminController.php
│       │   └── ContactController.php
│       └── Middleware/
│           └── AdminMiddleware.php
├── database/
│   ├── migrations/          # Migrations
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/         # Layout principal
│       ├── auth/            # Login/Register
│       ├── client/          # Espace client
│       ├── admin/           # Espace admin
│       ├── reservation/     # Système de réservation
│       ├── home.blade.php
│       ├── a-propos.blade.php
│       └── contact.blade.php
├── routes/
│   └── web.php              # Routes de l'application
└── bootstrap/
    └── app.php              # Configuration des middlewares
```

## 🎨 Fonctionnalités Clés

### Système de Réservation
- Calendrier interactif avec sélection de date
- Créneaux horaires colorés:
  - 🟢 Vert: Disponible
  - 🔵 Bleu: Ma réservation
  - 🔴 Rouge: Réservé par un autre
- Calcul automatique des prix selon l'heure
- Prévention des doubles réservations
- Confirmation par email (à implémenter)

### Gestion des Prix
- **Matin (8h-12h)**: 10,000 FCFA
- **Après-midi (12h-18h)**: 15,000 FCFA
- **Soir (18h-22h)**: 20,000 FCFA

### Sécurité
- Protection CSRF sur tous les formulaires
- Validation des données
- Middleware d'authentification
- Middleware admin pour les routes sensibles
- Gestion des permissions par rôles

## 📱 Responsive Design

L'application est entièrement responsive et s'adapte à:
- 📱 Mobiles (320px+)
- 📱 Tablettes (768px+)
- 💻 Ordinateurs (1024px+)
- 🖥️ Écrans larges (1440px+)

## 🔧 Personnalisation

### Modifier les Tarifs
Via l'espace admin: **Admin > Gestion des Prix**

### Modifier les Horaires
Via l'espace admin: **Admin > Gestion des Horaires**

### Modifier les Informations du Terrain
Éditer le fichier `database/seeders/DatabaseSeeder.php` ou via le contrôleur AdminController

### Changer les Couleurs
Modifier les classes Tailwind dans `resources/views/layouts/app.blade.php`

## 📝 Notes de Développement

### Points Forts
- Architecture MVC propre et organisée
- Code commenté et maintenable
- Séparation des responsabilités
- Validation complète des formulaires
- Gestion des erreurs
- Messages flash pour le feedback utilisateur
- Pagination des listes
- Filtres et recherche (admin)

### Améliorations Possibles
- Intégration d'un système de paiement en ligne
- Envoi d'emails de confirmation
- Génération de QR Code pour les réservations
- Notifications push
- Application mobile native
- Système de notation avancé
- Statistiques graphiques avec Chart.js
- Export PDF des réservations

## 🐛 Dépannage

### Erreur de migration SQLite
```bash
# Vérifier que le fichier database.sqlite existe
touch database/database.sqlite
```

### Erreur de clé d'application
```bash
php artisan key:generate
```

### Permissions des dossiers
```bash
chmod -R 775 storage bootstrap/cache
```

## 📄 Licence

Projet éducatif - Génie Logiciel 2025

## 👨‍💻 Développement

Développé avec ❤️ au Sénégal

---

**Application prête pour la soutenance de licence en Génie Logiciel**