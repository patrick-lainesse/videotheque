<!--
Nom: Patrick Lainesse
Date: 13/07/2020

Code HTML de la Single Page Application. La plupart des éléments sont cachés pour être dévoilés par JavaScript selon
les fonctions désirées par l'utilisateur.
-->

<?php
// Tableau des catégories de films, utilisé pour générer du code html
const TABLEAU_CATEGORIES = array("Action", "Animation", "Comédie", "Drame", "Horreur", "Romance", "Science-fiction");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vidéothèque</title>

    <!--Importe Icônes Google-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Importe la police pour le titre de l'accueil-->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">

    <!--Base de références pour les liens lorsqu'en développement pour les différents liens des pages, pour faciliser une arborescence relative...-->
    <base href="http://localhost/videotheque/"/>

    <!--... TODO: à changer pour ceci sur le site de la DESI
    <base href="http://www-desi.iro.umontreal.ca/~lainessp/ift1147/videotheque/" />-->

    <!--Importe materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/styles.css"/>
    <link rel="icon"
          type="images/svg"
          href="images/videocam-24px.svg">
    <!--Indication d'optimisation pour mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Nécessaire de précharger ces scripts pour certains éléments graphiques du framework-->
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="films/Film.js"></script>
    <script type="text/javascript" src="films/requetes.js"></script>
    <script type="text/javascript" src="films/vue.js"></script>

</head>
<body>

<!-- Options du menu de choix par catégorie. MaterializeCSS fait référence à cette liste pour générer le dropdown un peu
     plus loin dans le code. -->
<ul id="dropdown1" class="dropdown-content black">
    <?php
    foreach (TABLEAU_CATEGORIES as $cat) {
        echo '<li><a class="white-text" onclick="listerCategorie(\'' . $cat . '\')">' . $cat . '</a></li>';
    }
    ?>
</ul>
<nav>
    <!--Menu du haut pour visionner le catalogue de films-->
    <div class="nav-wrapper black">
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-small-and-down black">
            <li><a href="" class="waves-effect waves-light">ACCUEIL</a></li>
            <li><a class="waves-effect waves-light" onclick="lister()">Nos films</a></li>
            <li><a class="waves-effect waves-light" onclick="listerNouveautes()">Nouveautés</a></li>
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">
                    Catégories<i class="material-icons right">arrow_drop_down</i>
                </a>
            </li>
        </ul>

        <!--Menu d'administration-->
        <ul class="right hide-on-small-and-down black">
            <li><a class="waves-effect waves-light red-text" onclick="listerAdmin()">Options d'administation</a></li>
        </ul>
    </div>
</nav>

<!--Menu qui remplace la navbar en mode mobile-->
<ul class="sidenav darken-4 grey" id="mobile-demo">
    <li><a href="" class="waves-effect waves-light white-text">ACCUEIL</a></li>
    <li><a class="waves-effect waves-light white-text" onclick="lister()">Nos films</a></li>
    <li><a class="waves-effect waves-light white-text" onclick="listerNouveautes()">Nouveautés</a></li>
    <li><a class="waves-effect waves-light red-text" onclick="listerAdmin()">Options d'administation</a></li>
</ul>

<!--Emplacement pour afficher des messages temporaires-->
<p id="zoneMessage" class="center-align red-text cache"></p>

<!--Emplacement pour afficher l'accueil de la page-->
<div id="accueil">
    <h1 class="videotheque text-darken-4 red-text">VIDÉOTHÈQUE</h1>
    <h4 class="center">LE contrepoids aux Netflix, Disney<br>et autres géants de ce monde.</h4>

    <div class="row center-align marginTop30">
        <a class="waves-effect waves-light btn darken-4 red" onclick="listerNouveautes()">Voir les nouveautés</a>
        <a class="waves-effect waves-light btn darken-4 red" onclick="lister()">Parcourir notre catalogue</a>
    </div>
</div>

<!--Emplacement pour afficher les listes de films-->
<div id="carouselFilms" class="carousel film cache"></div>

<!--Modal dans lequel s'affiche le preview lors d'un clic sur un film-->
<div id="modal1" class="modal modalContent">
    <div class="modal-content">
        <h4 id='modalHeader'>Titre du film</h4>
        <iframe src="#" class='iframeYT' id="iframeYT" allowfullscreen></iframe>
    </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-teal btn-flat black white-text">Quitter</a>
    </div>
</div>

<!--Emplacement où s'affiche le tableau des films avec les options d'administration-->
<div id="divAdmin" class="container tableAdmin cache">
    <div class="row">
        <h3 class="center-align">Options d'administration</h3>
    </div>
    <div class="row">
        <a class="btn-small right waves-effect waves-light darken-4 green"
           onclick="afficherFormulaire('Enregistrer', null)">
            Ajouter un film<i class="material-icons left">movie_filter</i>
        </a>
    </div>
    <table class="centered">
        <thead>
        <tr>
            <th>Affiche</th>
            <th>Film</th>
            <th>Réalisateur</th>
            <th>Catégorie</th>
            <th>Date<br>de sortie</th>
            <th>Durée (min)</th>
            <th>Prix</th>
            <th>Gestion</th>
        </tr>
        </thead>
        <tbody id="tableauAdmin">
        </tbody>
    </table>
</div>

<!--Emplacement où s'affiche le formulaire pour supprimer, ajouter un nouveau film ou le modifier-->
<div id="divFormulaire" class="cache">
    <h5 id="titreFormulaire" class="white-text center"></h5>

    <img src="" id="previewUpload" class="imagePreview" alt="Aperçu de l'image">

    <div class="row margin50">
        <form class="col s6 offset-s3" id="formulaire">
            <div class="row">
                <div class="input-field col s3">
                    <input id="formIdFilm" name="formIdFilm" type="number" readonly>
                    <label for="formIdFilm">Identifiant</label>
                </div>
                <div class="input-field col s6">
                    <input id="formTitre" name="formTitre" type="text" class="validate">
                    <label for="formTitre">Titre</label>
                </div>
                <div class="input-field col s3">
                    <input type="text" class="datepicker" id="formSortie" name="formSortie">
                    <label for="formSortie">Date de sortie</label>
                </div>
            </div>
            <h5 class="white-text">Réalisateur</h5>
            <div class="row">
                <div class="input-field col s6">
                    <input id="formPrenom" name="formPrenom" type="text" class="validate">
                    <label for="formPrenom">Prénom</label>
                </div>
                <div class="input-field col s6">
                    <input id="formNom" name="formNom" type="text" class="validate">
                    <label for="formNom">Nom</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4 grey darken-4">
                    <select id="formCategorie" name="formCategorie">
                        <?php
                        foreach (TABLEAU_CATEGORIES as $cat) {
                            echo '<option value="' . $cat . '">' . $cat . '</option>';
                        }
                        ?>
                    </select>
                    <label for="formCategorie">Catégorie</label>
                </div>
                <div class="input-field col s4">
                    <input id="formDuree" name="formDuree" type="number" min="0" step="1" max="700" class="validate">
                    <label for="formDuree">Durée (en min)</label>
                </div>
                <div class="input-field col s4">
                    <input id="formPrix" name="formPrix" type="number" min="0" max="500" step="0.01" class="validate">
                    <label for="formPrix">Prix</label>
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field col s6">
                    <div class="btn waves-effect red darken-4">
                        <span>Image</span>
                        <!--source pour onchange: http://localhost/videotheque/viewsfilms/formulaires/formUpdate.php-->
                        <input type="file" id="formImage" name="formImage"
                               onchange="document.getElementById('previewUpload').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="file-path-wrapper">
                        <input id="filePathWrapper" class="file-path validate" type="text">
                    </div>
                </div>
                <div class="input-field col s6">
                    <input id="formHashYT" name="formHashYT" type="text" class="validate">
                    <label for="formHashYT">Hash YouTube</label>
                </div>
            </div>
            <div class="row">
                <button id="formBouton" class="btn waves-effect red darken-4">
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>