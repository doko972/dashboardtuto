# La base

Projet Vierge avec breeze pour l'authentification et espero soft pour la partie crud

## Installation locale
### 1. Cloner le projet
```
git clone 'depot git'
cd 'depot git'

```
### 2. Installer les dépendances backend (PHP / Laravel)
### 2.1 Si vous avez une erreur c'est que php n'est pas déclaré dans les variables d'environnements (voir 2.2)
```
composer install
```
### 2.2 Attention si la version de php n'est pas correcte! Changez la variable d'environnement
```
Sysdm.cpl
```
### 2.2.1 Dans les propriété système => Paramètres systèmes avancés => Variables d'environnement
### 2.2.2 Dans Variables système => Path => Modifier (correspondant à votre version de PHP):
```
C:\wamp64\bin\php\php8.2
```
### 3. Installer les dépendances frontend
```
npm install
npm install sass --save-dev
```
### 3.1 Si vous n'avez pas installé Node.js (et donc npm):
```
Rendez-vous ici : https://nodejs.org/
```
### Et téléchargez Node.js LTS, puis vérifier l'installation
```
npm -v
```
### Si l'execution des scripts est désactivé sur le pc, la réactiver temporarirement pour executer l'installation de NPM
```
Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass
```
### 4. Copier le fichier .env
```
cp .env.example .env
```
### 5. Générer la clé d'application Laravel
```
php artisan key:generate
```
### 6. Configurer la base de données dans .env, puis :
```
php artisan migrate
```
## Lancer le projet en développement
### 1. Compiler les assets (Vite)
```
npm run dev
```
### 2. Démarrer le serveur Laravel
```
php artisan serve
```
## Configuration de Vite
(vite.config.js)
```
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
export default defineConfig({
plugins: [
laravel({
input: [
'resources/sass/app.scss',
'resources/js/app.js'
],
refresh: true,
}),
],
});
```
## reCAPTCHA Google
Le projet utilise le package anhskohbo/no-captcha pour protéger le formulaire de contact.
Installation avec Composer 2 :
```
composer require anhskohbo/no-captcha
```
Composer 2 est requis. Si votre serveur utilise encore Composer 1 :
```
php -r "copy('https://getcomposer.org/download/2.7.2/composer.phar', 'composer2');"
chmod +x composer2
```
```
mkdir -p ~/bin
mv composer2 ~/bin/composer
export PATH="$HOME/bin:$PATH"
```
```
composer --version
```

## Déploiement sur un serveur (Hostinger ou autre)
1. Mettre à jour les dépendances PHP avec Composer 2
```
php -d memory_limit=-1 ~/bin/composer update
```
2. Créer le lien symbolique vers storage
```
rm -rf public/storage
php artisan storage:link
```
3. Compiler les assets pour la production
```
npm run build
```

## Astuce : mémoire insuffisante sur certains serveurs
```
php -d memory_limit=-1 /usr/local/bin/composer1.phar require anhskohbo/no-captcha
```
## Routes utiles
Page d'accueil: /
Formulaire de contact: /#contact
Connexion utilisateur: /login
Tableau de bord admin: /admin/realizations
Gestion des utilisateurs: /admin/users

## Technologies utilisées
- Laravel 10
- Vite
- SASS
- Composer 2
- PHP 8.2
- Google reCAPTCHA v2
- MySQL
- Hébergement mutualisé (Hostinger)


# Contact
Développé par l'Atelier Normand du Web
? doko972@gmail.com
? [Atelier Normand du Web](https://ateliernormandduweb.fr/)
