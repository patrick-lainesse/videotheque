<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 13/07/2020

TODO: Page d'accueil du site. C'est aussi ici que seront redirigés les usagers déconnectés ou tentant
de se connecter à des pages auxquelles il n'a pas accès, en affichant un message d'erreur.

Source: - Console.log à partir de PHP: https://stackify.com/how-to-log-to-console-in-php/
-->
<?php
//include "viewsfilms/header.php";


// Afficher un message d'erreur s'il y a lieu
/*if (isset($_GET['Message'])) {
    echo '<p class="center-align red-text">' . $_GET['Message'] . '</p>';
}
*/
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
    <script type="text/javascript" src="films/requetes.js"></script>
    <script type="text/javascript" src="films/vue.js"></script>

</head>
<body>

<!-- TODO: MENTIONNER QUE C'EST À CETTE LISTE QUE FAIT APPEL MATERIALIZE.
Options du menu de choix par catégorie. Le choix est transmis à lister.php par la méthode GET -->
<ul id="dropdown1" class="dropdown-content black">
    <li><a class="white-text" href="viewsfilms/lister.php?categorie=Action">Action</a></li>
    <li><a class="white-text" href="viewsfilms/lister.php?categorie=Animation">Animation</a></li>
    <li><a class="white-text" href="viewsfilms/lister.php?categorie=Comédie">Comédie</a></li>
    <li><a class="white-text" href="viewsfilms/lister.php?categorie=Drame">Drame</a></li>
    <li><a class="white-text" href="viewsfilms/lister.php?categorie=Horreur">Horreur</a></li>
    <li><a class="white-text" href="viewsfilms/lister.php?categorie=Romance">Romance</a></li>
    <li><a class="white-text" href="viewsfilms/lister.php?categorie=Science-fiction">Science-fiction</a></li>
</ul>
<nav>
    <!--Menu général pour visionner le catalogue de films-->
    <div class="nav-wrapper black">
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down black">
            <!--TODO: appeler racine-->
            <li><a href="index.php" class="waves-effect waves-light">ACCUEIL</a></li>
            <li><a class="waves-effect waves-light" onclick="lister()">Nos films</a></li>
            <!--TODO-->
            <li><a class="waves-effect waves-light" onclick="lister();$('#contenu').show()">Nouveautés</a></li>
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Catégories<i class="material-icons right">arrow_drop_down</i></a>
            </li>
        </ul>

        <!--Menu qui s'affiche dépend du rôle de celui qui est connecté-->
        <ul class="right hide-on-med-and-down black black">
            <?php
            // Si connecté, afficher l'adresse couriel
            if (isset($_SESSION['usager'])) {

                // Afficher le courriel de l'usager connecté
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
                <li><a href="viewsfilms/formulaires/formAjoutMembre.php"><i class="material-icons left">person_add</i>
                        Devenir membre</a></li>
                <li><a class="waves-effect waves-light modal-trigger" href="#modalConnexion" type="submit">
                        <i class="material-icons left">vpn_key</i>Connexion</a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>

<?php
//include "formulaires/formConnexion.html";
?>

<!--TODO: Menu qui remplace la navbar en mode mobile-->
<ul class="sidenav" id="mobile-demo">
    <li><a href="index.php" class="waves-effect waves-light" type="submit">ACCUEIL</a></li>
    <li><a href="viewsfilms/lister.php" class="waves-effect waves-light">Nos films</a></li>
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

<div id="accueil">
    <h1 class="videotheque text-darken-4 red-text">VIDÉOTHÈQUE</h1>
    <h4 class="center">LE contrepoids aux Netflix, Disney<br>et autres géants de ce monde.</h4>

    <div class="row center-align marginTop30">
        <a href="viewsfilms/formulaires/formAjoutMembre.php" class="waves-effect waves-light btn darken-4 red">Devenir
            membre</a>
        <a href="viewsfilms/lister.php" class="waves-effect waves-light btn darken-4 red">Parcourir notre catalogue</a>
    </div>
</div>

<!--Emplacement où s'affichent les listes de films-->
<div id="carouselFilms" class="carousel film cache"></div>

<div id="modal1" class="modal modalContent">
    <div class="modal-content">
        <h4 id='modalHeader'>Titre du film</h4>
        <iframe src="#" class='iframeYT' id="iframeYT" allowfullscreen></iframe>
    </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-teal btn-flat black white-text">Quitter</a>
    </div>
</div>

<!--TODO-->
<div id="contenu" style="position:absolute;top:25%;left:20%;"></div>

</body>
</html>
<?php
/*<div id="carouselItem" class="carousel-item film">
        <div class="card">
            <div id="liste-image" class="card-image">
                <!--<img src="images/avatar.jpg" data-target="modal1" idFilm="1" titre="Adaptation" hashYT="test" class="modal-trigger" onclick="chagerModal.call(this)">-->
            </div>
            <div id="card-content" class="card-content">
            </div>
        </div>
    </div>*/