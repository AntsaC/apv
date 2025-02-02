# Garage Management System

## 📌 Introduction
Ce projet est une simple application de gestion de garage

## 🛠️ Technologies Utilisées
- **Framework** : Laravel 11, starter kit Breeze
- **Langage** : PHP 8
- **Base de données** : MySQL (via Docker compose)
- **Gestion des dépendances** : Composer
- **Serveur de développement** : Artisan 

## 🚀 Installation Locale

### 1️⃣ Prérequis
Assurez-vous d'avoir installé les outils suivants sur votre machine :
- [Docker](https://www.docker.com/get-started)
- Docker compose
- [Composer](https://getcomposer.org/download/)
- [PHP 8](https://www.php.net/downloads.php)
- Extension Zip php pour l'import excel

### 2️⃣ Cloner le projet
```bash
git clone https://github.com/AntsaC/apv
cd apv
```

### 3️⃣ Installer les dépendances
Installation des dependendances composer
```bash
composer install
```
Installation des dependendances node
```bash
npm install && npm run build
```


### 5️⃣ Démarrer les services avec Docker
```bash
docker compose up -d
```

### 7️⃣ Configurer la base de données
Ajoutez les informations de connexion MySQL dans le fichier `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=0.0.0.0
DB_PORT=3306
DB_DATABASE=apv_app
DB_USERNAME=root
DB_PASSWORD=root
```
Puis exécutez les migrations :
```bash
php artisan migrate
```

### 8️⃣ Lancer le serveur local
```bash
composer run dev
```
Accédez à l'application sur : [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 📝 Licence
Ce projet est sous licence MIT. Vous êtes libre de l’utiliser et de le modifier.

---
