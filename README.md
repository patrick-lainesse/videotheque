# videotheque
Site web multipages d'achat de films implémentant le CRUD.

## Technologies utilisées:
- PHP
- mysqli
- Materializecss
- jQuery

## À propos des différents fichiers

### Général
- PHP: Utilise $_SERVER['DOCUMENT_ROOT'] lors des inclusions de fichiers pour faciliter l'inclusion des header dans les fichiers situés à différents endroits dans la structre du site.
- css et js: Utilise un path absolu à partir du root du serveur pour la même raison.

### Header
- Contient un menu navbar qui devient un drawer en mode mobile
- Contient un modal qui apparaît au bas de l'écran pour se connecter
- L'option gestion apparaît lorsque connecté comme admin
- L'option panier apparaît lorsque connecté comme admin
- Les liens du header sont présentés à partir du root du projet pour qu'ils fonctionnent peu importe où est située la page. 

### lister.php
- Les fiches des films s'affichent dans un carousel (Materializecss).
- Lors d'un clic sur un film, un modal (modal.html) s'affiche, contenant un preview de YouTube en iframe et les informations sur ce film.
- Pour charger les bons vidéos de YouTube, le hash de l'URL du film sur YouTube doit être stocké dans la base de données. Par exemple: https://www.youtube.com/watch?v= **yrK1f4TsQfM**
- Lorsque connectés, une option s'ajoute aux membres pour leur permettre d'ajouter une certaine quantité d'un film à son panier d'achats

### formAjoutFilm.php et formUpdate.php
- Le nom du réalisateur est stocké en un seul String dans la base de données, mais séparé en deux à l'aide des fonctions strpos et substr en PHP.

### requetesSQL.php
- Le même fichier est utilisé pour gérer update et ajout de films.
- Contient des clauses if pour vérifier d'où provient la requête.

### fonctionsPanier.php
- Gère toutes les fonctions / requêtes relative au panier d'achats d'un membre
- Vérifie si un film est déjà présent avant de l'ajouter, et si oui, ajuste la quantité
