# MCD - Modèle Conceptuel des Données (Méthode Merise)
## Système de Réservation de Terrain - FootArena

---

## Entités et leurs Attributs

### 1. UTILISATEUR
- #id (Identifiant)
- nom
- email
- mot_de_passe
- role (client/admin)
- telephone
- adresse
- email_verifie_le
- created_at
- updated_at

### 2. TERRAIN
- #id (Identifiant)
- nom
- description
- adresse
- telephone
- email
- image
- prix_matin
- prix_apres_midi
- prix_soir
- horaire_ouverture
- horaire_fermeture
- actif
- created_at
- updated_at

### 3. RESERVATION
- #id (Identifiant)
- date_reservation
- heure_debut
- heure_fin
- prix
- statut (en_attente/confirmee/annulee)
- notes
- created_at
- updated_at

### 4. HORAIRE
- #id (Identifiant)
- jour_semaine
- heure_debut
- heure_fin
- disponible
- raison_blocage
- created_at
- updated_at

### 5. MESSAGE_CONTACT
- #id (Identifiant)
- nom
- email
- telephone
- message
- lu
- created_at
- updated_at

---

## Relations entre Entités

### Relation R1 : EFFECTUER
**Entre :** UTILISATEUR et RESERVATION
- Un UTILISATEUR effectue (0,n) RESERVATION
- Une RESERVATION est effectuée par (1,1) UTILISATEUR
- **Clé étrangère :** user_id dans RESERVATION

### Relation R2 : CONCERNER
**Entre :** TERRAIN et RESERVATION
- Un TERRAIN concerne (0,n) RESERVATION
- Une RESERVATION concerne (1,1) TERRAIN
- **Clé étrangère :** terrain_id dans RESERVATION

### Relation R3 : DISPOSER
**Entre :** TERRAIN et HORAIRE
- Un TERRAIN dispose de (0,n) HORAIRE
- Un HORAIRE appartient à (1,1) TERRAIN
- **Clé étrangère :** terrain_id dans HORAIRE

---

## Représentation Graphique du MCD

```
┌─────────────────────┐
│    UTILISATEUR      │
├─────────────────────┤
│ #id                 │
│ nom                 │
│ email               │
│ mot_de_passe        │
│ role                │
│ telephone           │
│ adresse             │
│ email_verifie_le    │
│ created_at          │
│ updated_at          │
└─────────┬───────────┘
          │
          │ 0,n
          │ EFFECTUER
          │ 1,1
          ↓
┌─────────────────────┐
│    RESERVATION      │
├─────────────────────┤
│ #id                 │
│ date_reservation    │
│ heure_debut         │
│ heure_fin           │
│ prix                │
│ statut              │
│ notes               │
│ user_id (FK)        │
│ terrain_id (FK)     │
│ created_at          │
│ updated_at          │
└─────────┬───────────┘
          │
          │ 1,1
          │ CONCERNER
          │ 0,n
          ↓
┌─────────────────────┐
│      TERRAIN        │
├─────────────────────┤
│ #id                 │
│ nom                 │
│ description         │
│ adresse             │
│ telephone           │
│ email               │
│ image               │
│ prix_matin          │
│ prix_apres_midi     │
│ prix_soir           │
│ horaire_ouverture   │
│ horaire_fermeture   │
│ actif               │
│ created_at          │
│ updated_at          │
└─────────┬───────────┘
          │
          │ 0,n
          │ DISPOSER
          │ 1,1
          ↓
┌─────────────────────┐
│      HORAIRE        │
├─────────────────────┤
│ #id                 │
│ jour_semaine        │
│ heure_debut         │
│ heure_fin           │
│ disponible          │
│ raison_blocage      │
│ terrain_id (FK)     │
│ created_at          │
│ updated_at          │
└─────────────────────┘

┌─────────────────────┐
│   MESSAGE_CONTACT   │
├─────────────────────┤
│ #id                 │
│ nom                 │
│ email               │
│ telephone           │
│ message             │
│ lu                  │
│ created_at          │
│ updated_at          │
└─────────────────────┘
```

---

## Dictionnaire des Données

| Code | Libellé | Type | Longueur | Description |
|------|---------|------|----------|-------------|
| ID_USR | Identifiant Utilisateur | INT | - | Clé primaire, auto-incrément |
| NOM_USR | Nom utilisateur | VARCHAR | 255 | Nom complet de l'utilisateur |
| EMAIL_USR | Email utilisateur | VARCHAR | 255 | Email unique pour connexion |
| MDP_USR | Mot de passe | VARCHAR | 255 | Mot de passe hashé |
| ROLE_USR | Rôle | VARCHAR | 20 | 'client' ou 'admin' |
| TEL_USR | Téléphone | VARCHAR | 20 | Numéro de téléphone |
| ADR_USR | Adresse | VARCHAR | 255 | Adresse postale |
| ID_TER | Identifiant Terrain | INT | - | Clé primaire, auto-incrément |
| NOM_TER | Nom du terrain | VARCHAR | 255 | Nom du terrain |
| DESC_TER | Description | TEXT | - | Description du terrain |
| ADR_TER | Adresse | VARCHAR | 255 | Adresse du terrain |
| TEL_TER | Téléphone | VARCHAR | 20 | Numéro de téléphone |
| EMAIL_TER | Email | VARCHAR | 255 | Email de contact |
| IMG_TER | Image | VARCHAR | 255 | Chemin de l'image |
| PM_TER | Prix matin | DECIMAL | 10,2 | Prix créneau matin (8h-12h) |
| PAM_TER | Prix après-midi | DECIMAL | 10,2 | Prix créneau après-midi (12h-18h) |
| PS_TER | Prix soir | DECIMAL | 10,2 | Prix créneau soir (18h-23h) |
| HO_TER | Horaire ouverture | TIME | - | Heure d'ouverture |
| HF_TER | Horaire fermeture | TIME | - | Heure de fermeture |
| ACT_TER | Actif | BOOLEAN | - | Terrain actif ou non |
| ID_RES | Identifiant Réservation | INT | - | Clé primaire, auto-incrément |
| DATE_RES | Date réservation | DATE | - | Date de la réservation |
| HD_RES | Heure début | TIME | - | Heure de début du créneau |
| HF_RES | Heure fin | TIME | - | Heure de fin du créneau |
| PRIX_RES | Prix | DECIMAL | 10,2 | Prix de la réservation |
| STAT_RES | Statut | VARCHAR | 20 | 'en_attente', 'confirmee', 'annulee' |
| NOTES_RES | Notes | TEXT | - | Notes additionnelles |
| ID_HOR | Identifiant Horaire | INT | - | Clé primaire, auto-incrément |
| JOUR_HOR | Jour de semaine | VARCHAR | 20 | 'lundi' à 'dimanche' |
| HD_HOR | Heure début | TIME | - | Heure de début |
| HF_HOR | Heure fin | TIME | - | Heure de fin |
| DISP_HOR | Disponible | BOOLEAN | - | Créneau disponible ou bloqué |
| RB_HOR | Raison blocage | VARCHAR | 255 | Raison si bloqué |
| ID_MSG | Identifiant Message | INT | - | Clé primaire, auto-incrément |
| NOM_MSG | Nom | VARCHAR | 255 | Nom de l'expéditeur |
| EMAIL_MSG | Email | VARCHAR | 255 | Email de l'expéditeur |
| TEL_MSG | Téléphone | VARCHAR | 20 | Téléphone de l'expéditeur |
| MSG_MSG | Message | TEXT | - | Contenu du message |
| LU_MSG | Lu | BOOLEAN | - | Message lu par l'admin |

---

## Contraintes d'Intégrité

### Contraintes d'Entité
- Chaque entité possède un identifiant unique (clé primaire)
- L'email de l'utilisateur doit être unique
- Le rôle de l'utilisateur doit être soit 'client' soit 'admin'
- Le statut de réservation doit être 'en_attente', 'confirmee' ou 'annulee'

### Contraintes de Référence
- user_id dans RESERVATION référence id dans UTILISATEUR
- terrain_id dans RESERVATION référence id dans TERRAIN
- terrain_id dans HORAIRE référence id dans TERRAIN

### Contraintes de Domaine
- Les prix doivent être positifs
- L'heure de fin doit être supérieure à l'heure de début
- La date de réservation ne peut pas être dans le passé
- Le jour_semaine doit être : 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'

---

## Règles de Gestion

### RG1 - Création de réservation
- Un utilisateur doit être connecté pour créer une réservation
- Un créneau ne peut être réservé que par un seul utilisateur à la fois
- Le prix est Calculé automatiquement selon l'heure (matin, après-midi, soir)

### RG2 - Gestion des réservations
- Une réservation peut être annulée par le client ou l'administrateur
- Une réservation doit être confirmée par l'administrateur
- Une réservation confirmée ne peut plus être modifiée

### RG3 - Gestion des horaires
- L'administrateur peut définir les horaires d'ouverture par jour
- Un horaire peut être bloqué avec une raison spécifique
- Les horaires bloqués ne sont pas disponibles à la réservation

### RG4 - Gestion des utilisateurs
- Seul un administrateur peut modifier le rôle d'un utilisateur
- Un utilisateur ne peut pas supprimer son propre compte
- L'email doit être unique dans le système

---

## Légende

- **#** : Identifiant (Clé primaire)
- **(FK)** : Clé étrangère
- **(0,n)** : Cardinalité minimale 0, maximale n
- **(1,1)** : Cardinalité minimale 1, maximale 1
- **VARCHAR** : Chaîne de caractères de longueur variable
- **TEXT** : Texte long
- **INT** : Entier
- **DECIMAL** : Nombre décimal
- **DATE** : Date
- **TIME** : Heure
- **BOOLEAN** : Booléen (vrai/faux)
