# videotheque
Single page application d'achat de films implémentant le CRUD, écrit en PHP

## Technologies utilisées
- PHP
- MySQL / MariaDB
- MaterializeCSS
- jQuery
- AJAX

## Copyright
- avatar.jpg: https://www.publicdomainpictures.net/en/view-image.php?image=210079&picture=question-mark
- Affiches de film: IMDB
- Previews de films: YouTube

## Installation
- Créer une base de données 'bdfilms' dans MySQL (CREATE DATABASE bdfilms;)
- S'assurer que l'encodage de la base de données soit bien "utf8mb4"
- Importer le fichier bd/bdfilms.sql (mysql -u nom_utilisateur -p bdfilms < bdfilms.sql)
- Vérifier et redéfinir si nécessaire les constantes dans le fichier includes/connexion.inc.php
- Vérifier et corriger si nécessaire le base href dans l'en-tête html du fichier index.php

## À propos des différents fichiers

### Général
- L'organisation du code est inspirée par le framework modèle-vue-contrôleur
- Pour les liens html, images, js, css, etc., un base href est établi pour faciliter la portabilité du site

### connexion.inc.php et modele.inc.php
- Classes php pour gérer la connexion à la base de données
- Dans modele, on retrouve également la gestion du stockage des images sur le serveur

### index.php
- Page d'accueil du site, la plupart des sections sont cachées et dévoilées par JavaScript selon la requête de l'utilisateur
- Les scripts sont chargés avant le reste du code, car il est nécessaire pour initialiser le dropdown du menu de navigation, entre autres

### requetes.js
- Code qui envoie les requêtes au serveur par AJAX
- FormData est utilisé pour récupérer les informations contenues dans le formulaire
- Un attribut 'route' est ajouté au FormData pour que le serveur puisse identifier de quel type de requête il s'agit
- Sur réception d'une réponse du serveur, il redirige vers vue.js pour générer la vue à afficher dans le navigateur 

### gestionFilms.php
- Code côté serveur qui recôit les requêtes du côté client
- Selon la requête, il effectue à son tour une requête au serveur SQL et retourne la réponse en format JSON
- Retourne également un attribut 'route' pour que vue.js sache quel type de requête faire afficher

### vue.js
- Identifie quel type de requête il doit afficher, puis redirige vers la fonction appropriée
- Utilise une classe JS (Film.js) pour générer des objets films et passer ces objets à d'autres fonctions de façon dynamique, pour l'affichage de boutons, le remplissage de formulaires, etc
- Les listes de films sont affichés dans un carousel
- Au clic d'une image dans un carousel, un modal s'affiche, présentant un preview du film sur YouTube
- Pour charger les bons vidéos de YouTube, le hash de l'URL du film sur YouTube doit être stocké dans la base de données. Par exemple: https://www.youtube.com/watch?v= **yrK1f4TsQfM**
- Le nom du réalisateur est stocké en un seul String dans la base de données, mais séparé en deux dans les formulaires
- Les options "modifier" ou "effacer" un film préremplissent les formulaires à partir de données obtenues de la base de données

## J'aurais aimé...
- Implémenter le YouTube API, pour automatiquement ajouter le preview des films sans avoir à stocker l'URL des vidéos
- Régler un problème d'accès à la base de données sur MySQL. Fonctionne convenablement avec MariaDB, plus de tests sont nécessaires pour déceler ce problème.