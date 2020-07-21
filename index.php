<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 13/07/2020

TODO: Page d'accueil du site. C'est aussi ici que seront redirigés les usagers déconnectés ou tentant
de se connecter à des pages auxquelles il n'a pas accès, en affichant un message d'erreur.

Source: - Console.log à partir de PHP: https://stackify.com/how-to-log-to-console-in-php/
-->
<?php
// Tableau des catégories de films, utilisé pour générer du code html
// TODO: placer plutôt dans la classe Film.php
$tableauCategorie = array("Action", "Animation", "Comédie", "Drame", "Horreur", "Romance", "Science-fiction");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vidéothèque</title>

    <!--Importe Icônes Google-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Importe la police pour le titre de l'accueil-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Subrayada:wght@700&display=swap" rel="stylesheet">

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
    <!--TODO: plus nécessaire-->
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="films/Film.js"></script>
    <script type="text/javascript" src="films/requetes.js"></script>
    <script type="text/javascript" src="films/vue.js"></script>

</head>
<body>

<!-- Options du menu de choix par catégorie. MaterializeCSS fait référence à cette liste pour générer le dropdown un peu
     plus loin dans le code. -->
<ul id="dropdown1" class="dropdown-content black">
    <?php
    foreach ($tableauCategorie as $cat) {
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
            <!--TODO lister nouveautés + sur page d'accueil-->
            <li><a class="waves-effect waves-light" onclick="message('test')">Nouveautés</a></li>
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

<!--TODO: Menu qui remplace la navbar en mode mobile-->
<ul class="sidenav" id="mobile-demo">
    <li><a href="" class="waves-effect waves-light">ACCUEIL</a></li>
    <li><a class="waves-effect waves-light" onclick="lister()">Nos films</a></li>
    <?php
    if (isset($_SESSION['usager'])) {

        // afficher le courriel de l'usager connecté
        echo '<li>' . $_SESSION['usager'] . '</li>';

        // Options du menu dépendant du rôle de l'usager
        if ($_SESSION['role'] == 'admin') {
            echo '<li><a href="viewsfilms/admin.php" class="waves-effect waves-light red-text">Options d\'administation</a></li>';
        } else {
            echo '<li><a href="viewsfilms/panier.php" class="waves-effect waves-light" type="submit">Panier</a></li>';
        }

        echo '<li><a href="viewsfilms/deconnexion.php" class="waves-effect waves-light red">'
            . '<i class="material-icons left">exit_to_app</i>Se déconnecter</a></li>';

    } else {            // Si non connecté, afficher l'option pour se connecter
        ?>
        <!--Trigger du modal pour saisir courriel et mot de passe-->
        <li><a href="viewsfilms/formulaires/formAjoutMembre.php">
                <i class="material-icons left">person_add</i>
                Devenir membre</a></li>
        <li><a class="waves-effect waves-light modal-trigger" href="#modalConnexion" type="submit">
                <i class="material-icons left">vpn_key</i>Connexion</a></li>
        <?php
    } ?>
</ul>

<!--TODO: Emplacement pour afficher des messages temporaires-->
<p id="zoneMessage" class="center-align red-text cache"></p>

<!--Emplacement pour afficher l'accueil de la page-->
<div id="accueil">
    <h1 class="videotheque text-darken-4 red-text">VIDÉOTHÈQUE</h1>
    <h4 class="center">LE contrepoids aux Netflix, Disney<br>et autres géants de ce monde.</h4>

    <div class="row center-align marginTop30">
        <a href="viewsfilms/formulaires/formAjoutMembre.php" class="waves-effect waves-light btn darken-4 red">Devenir
            membre</a>
        <a href="viewsfilms/lister.php" class="waves-effect waves-light btn darken-4 red">Parcourir notre catalogue</a>
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
        <a class="btn-small right waves-effect waves-light darken-4 green" onclick="afficherFormulaire('enregistrer', null)">
            Ajouter un film<i class="material-icons left">movie_filter</i>
        </a>
    </div>
    <table class="centered">
        <thead>
        <tr><!--TODO: tableau constantes-->
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
        <tr><!--TODO: de trop?-->
        </tbody>
    </table>
</div>

<!--Emplacement où s'affiche le formulaire pour ajouter un nouveau film ou le modifier-->
<div id="divFormulaire" class="cache">
    <h5 id="titreFormulaire" class="white-text center"></h5>

    <img id="previewUpload" class="imagePreview">

    <div class="row margin50">
        <!--TODO form-->
        <!--<form class="col s6 offset-s3" id="formulaire" enctype="multipart/form-data"
              action="viewsfilms/fonctionsSQL/fonctionsAdmin.inc.php" method="POST" onsubmit="return valider()">-->
        <!--TODO: valider-->
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
                        $catLength = count($tableauCategorie);

                        for ($x = 0; $x < $catLength; $x++) {
                                echo '<option value="' . $tableauCategorie[$x] . '">' . $tableauCategorie[$x] . '</option>';
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
                    <label for="hashYT">Hash YouTube</label>
                    <!--TODO: un hint avec hover de souris pour infos sur ce qu'est le hash YouTube-->
                </div>
            </div>
            <div class="row">
                <button id="formBouton" class="btn waves-effect red darken-4">
                    <!--TODO: <button id="formBouton" class="btn waves-effect red darken-4" type="submit" name="action">-->
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>

<!--TODO: changer classes et style -->
<div id="contenu" style="position:absolute;top:25%;left:20%;"></div>

</body>
</html>