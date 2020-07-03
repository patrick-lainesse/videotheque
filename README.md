# videotheque
Site web multipages d'achat de films implémentant le CRUD, écrit en PHP

## Technologies utilisées
- PHP
- mysqli
- Materializecss
- jQuery

## Copyright
- avatar.jpg: https://www.publicdomainpictures.net/en/view-image.php?image=210079&picture=question-mark
- Affiches de film: IMDB
- Previews de films: YouTube

## Installation
- Créer une base de données 'bdfilms' dans MySQL (CREATE DATABASE bdfilms;)
- Importer le fichier bd/bdfilms.sql (mysql -u nom_utilisateur -p bdfilms < bdfilms.sql)
- Vérifier et redéfinir si nécessaire les constantes dans le fichier bd/connexion.inc.php
- Vérifier et corriger si nécessaire le base href dans l'en-tête html du fichier header.php

## À propos des différents fichiers

### Général
- PHP: la navigation entre les différents fichiers se fait de manière relative (../, etc)
- Pour les liens html, images, js, css, etc., un base href est établi dans le header pour faciliter la portabilité du site

### header.php
- Contient un menu navbar qui devient un drawer en mode mobile
- Contient un modal qui apparaît au bas de l'écran pour se connecter
- L'option gestion apparaît lorsque connecté comme admin
- L'option panier apparaît lorsque connecté comme membre

### lister.php
- Les fiches des films s'affichent dans un carousel (Materializecss)
- Lors d'un clic sur un film, un modal (modal.html) s'affiche, contenant un preview de YouTube en iframe et les informations sur ce film
- Pour charger les bons vidéos de YouTube, le hash de l'URL du film sur YouTube doit être stocké dans la base de données. Par exemple: https://www.youtube.com/watch?v= **yrK1f4TsQfM**
- Lorsque connectés, une option s'ajoute aux membres pour leur permettre d'ajouter une certaine quantité d'un film à son panier d'achats
- La sélection d'une catégorie dans le menu de navigation ne fait qu'afficher les films de cette catégorie

### formAjoutFilm.php et formUpdate.php
- Le nom du réalisateur est stocké en un seul String dans la base de données, mais séparé en deux à l'aide des fonctions strpos et substr en PHP
- Lorsqu'un admin téléverse une image locale pour ajouter à la fiche d'un film, un preview s'affiche
- hash YouTube: voir ci-haut dans lister.php
- Les options "modifier" ou "effacer" un film préremplissent les formulaires à partir de données obtenues de la base de données 

### fonctionsAdmin.inc.php
- Le même fichier est utilisé pour gérer update et ajout de films
- Contient des clauses if pour vérifier d'où provient la requête

### fonctionsPanier.inc.php
- Gère toutes les fonctions / requêtes relatives au panier d'achats d'un membre
- Vérifie si un film est déjà présent avant de l'ajouter, et si oui, ajuste la quantité

### admin.php et lister.php
- Constituent la page d'accueil des membres connectés
- Selon l'option sélectionnée par le membre, renvoie aux pages gérant les formulaires et/ou les requêtes SQL

### Film.php
- Classe pour créer des objets films. Plus ou moins bien utilisée dans admin.php pour l'instant

## J'aurais aimé...
- Implémenter le YouTube API, pour automatiquement ajouter le preview des films sans avoir à stocker l'URL des vidéos
- Améliorer l'implémentation de la classe Film dans les différentes requêtes, mais cette matière et les notes de cours ont été rendues disponibles alors que j'étais déjà très avancé dans le projet. J'aimerais bien l'intégrer mieux dans la prochaine étape de développement du projet