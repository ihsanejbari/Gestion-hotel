# ✦ Veloria House — Système de Gestion Hôtelière

> Application web de gestion hôtelière développée avec **Laravel 13** et **MySQL**, dans le cadre d'un projet académique.

---

## 📋 Description

**Veloria House** est une application de gestion hôtelière complète permettant à trois types d'utilisateurs (visiteur, client, administrateur) de gérer les chambres, réservations, paiements et avis d'un hôtel.

---

## ✨ Fonctionnalités

### 🌐 Visiteur (non connecté)
- Consulter les chambres disponibles
- Lire les avis des clients
- S'inscrire / se connecter

### 👤 Client (connecté)
- Dashboard personnel avec statistiques
- Consulter et réserver des chambres
- Gérer ses réservations
- Effectuer des paiements (carte, espèces, virement)
- Laisser des avis

### 🛡️ Administrateur
- Dashboard avec statistiques globales (chambres, réservations, clients, revenus)
- Gestion complète des chambres (CRUD + upload photo)
- Gestion des réservations (changer le statut)
- Modération des avis

---

## 🛠️ Technologies utilisées

| Technologie | Version |
|---|---|
| PHP | 8.5 |
| Laravel | 13.x |
| MySQL | 8.x |
| Bootstrap | 5.3 |
| Font Awesome | 6.4 |

---

## ⚙️ Installation

### Prérequis
- PHP >= 8.2
- Composer
- MySQL
- XAMPP (ou tout autre serveur local)

### Étapes

```bash
# 1. Cloner le projet
git clone https://github.com/ihsanejbari/Gestion-hotel.git
cd Gestion-hotel

# 2. Installer les dépendances
composer install

# 3. Copier le fichier d'environnement
cp .env.example .env

# 4. Générer la clé d'application
php artisan key:generate

# 5. Configurer la base de données dans .env
DB_DATABASE=gestion_hotel
DB_USERNAME=root
DB_PASSWORD=

# 6. Créer les tables
php artisan migrate

# 7. (Optionnel) Insérer des données de test
php artisan db:seed

# 8. Créer le lien de stockage pour les images
php artisan storage:link

# 9. Lancer le serveur
php artisan serve
```

L'application sera accessible sur `http://127.0.0.1:8000`

---

## 👥 Comptes de test

| Rôle | Email | Mot de passe |
|---|---|---|
| Administrateur | admin@hotel.com | admin1234 |
| Client | client1@gmail.com | client123 |

---

## 📁 Structure du projet

```
gestion-hotel/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── ClientController.php
│   │   └── GuestController.php
│   └── Models/
│       ├── User.php
│       ├── Chambre.php
│       ├── Reservation.php
│       ├── Paiement.php
│       └── Avis.php
├── resources/views/
│   ├── layouts/
│   │   ├── admin.blade.php
│   │   ├── client.blade.php
│   │   └── guest.blade.php
│   ├── admin/
│   ├── client/
│   └── guest/
└── routes/
    └── web.php
```

---

## 📸 Aperçu

### Page d'accueil
- Hero section avec photo plein écran
- Catalogue des chambres
- Avis clients

### Dashboard Admin
- Statistiques en temps réel
- Gestion CRUD des chambres
- Suivi des réservations

### Espace Client
- Interface sidebar élégante
- Réservation en ligne
- Suivi des paiements

---

## 🚀 Déploiement

Pour déployer en production :
1. Configurer les variables d'environnement (`APP_ENV=production`, `APP_DEBUG=false`)
2. Lancer `php artisan config:cache` et `php artisan route:cache`
3. S'assurer que le dossier `storage/` est accessible en écriture

---

## 👨‍💻 Auteur

**Ihsane Jbari**  
Projet académique — 2024/2025

---

## 📄 Licence

Ce projet est développé dans un cadre académique.
