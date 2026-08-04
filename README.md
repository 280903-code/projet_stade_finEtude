# FootArena - Système de Réservation de Terrain

Application web de gestion de réservations pour terrain de football, développée avec Laravel 11.

## Fonctionnalités

### Espace Public
- Page d'accueil avec présentation des services et tarifs
- Calendrier de réservation en temps réel
- Consultation des disponibilités sans connexion
- Formulaire de contact
- Page À propos

### Espace Client
- Dashboard avec statistiques personnelles
- Réservation de créneaux horaires
- Gestion des réservations (futures et historique)
- Annulation de réservations
- Modification du profil utilisateur

### Espace Administrateur
- Dashboard avec statistiques générales et graphiques
- Gestion des réservations (confirmation, annulation, suppression)
- Gestion des horaires d'ouverture
- Configuration des tarifs par créneau (matin, après-midi, soir)
- Gestion des utilisateurs et des rôles
- Réception et gestion des messages de contact

## Stack Technique

- **Backend**: Laravel 11 
- **Base de données**: SQLite (configurable pour MySQL/PostgreSQL)
- **Frontend**: Blade templates, CSS3, JavaScript
- **Styling**: CSS personnalisé
- **Icons**: Font Awesome 6
- **Authentification**: Laravel Breeze

## Structure des Routes

- `/` - Page d'accueil
- `/reservation` - Calendrier de réservation
- `/contact` - Formulaire de contact
- `/connexion` - Connexion
- `/inscription` - Inscription
- `/client/*` - Espace client (authentifié)
- `/admin/*` - Espace administrateur (admin)

## Gestion des Rôles

Le système utilise deux rôles :
- **client**: Accès à l'espace client et aux réservations
- **admin**: Accès complet au panneau d'administration

Les rôles sont gérés via le champ `role` dans la table `users`.

## Configuration des Tarifs

Les tarifs sont configurés dans la table `terrains` avec trois champs :
- `prix_matin`: Tarif pour les créneaux 8h-12h
- `prix_apres_midi`: Tarif pour les créneaux 12h-18h
- `prix_soir`: Tarif pour les créneaux 18h-00h


## Sécurité

- Protection CSRF sur tous les formulaires
- Validation des données
- Middleware d'authentification
- Middleware admin pour les routes sensibles
- Gestion des permissions par rôles

## Dépannage

### Erreur de migration SQLite
```bash
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

## Licence

Projet éducatif - Génie Logiciel