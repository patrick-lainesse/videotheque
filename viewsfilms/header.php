<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

En tête de chaque page. Contient un manu de navigation qui change selon qu'un usager est connecté ou
non, ainsi que le rôle de ce membre.
MaterializeCSS utilisé comme framework.
-->
<?php
ob_start();     // TODO: fouiller davantage et commenter
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vidéothèque</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/videotheque/css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/videotheque/css/styles.css"/>
    <link rel="icon"
          type="images/svg"
          href="/videotheque/images/videocam-24px.svg">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <script type="text/javascript" src="/videotheque/js/jquery-3.5.1.min.js"></script>
    <!--remettre le min.js lorsque le développement sera terminé, et remettre les scripts à la fin du body ???-->
    <!--<script type="text/javascript" src="js/materialize.min.js"></script>-->
    <script type="text/javascript" src="/videotheque/js/materialize.js"></script>
    <script type="text/javascript" src="/videotheque/js/scripts.js"></script>
</head>
<body>

<!-- Options du menu de choix par catégorie -->
<ul id="dropdown1" class="dropdown-content black">
    <li><a href="#">Action</a></li>
    <li><a href="#">Animation</a></li>
    <li><a href="#">Comédie</a></li>
    <li><a href="#">Drame</a></li>
    <li><a href="#">Horreur</a></li>
    <li><a href="#">Romance</a></li>
</ul>

<nav>
    <!--menu général pour visionner le catalogue de films-->
    <div class="nav-wrapper black">
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down black">
            <li><a href="/videotheque/index.php" class="waves-effect waves-light" type="submit">ACCUEIL</a></li>
            <li><a href="/videotheque/viewsfilms/lister.php" class="waves-effect waves-light">Nos films</a></li>
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Catégories<i class="material-icons right">arrow_drop_down</i></a>
            </li>
        </ul>

        <!--le menu qui s'affiche dépend du rôle de celui qui est connecté-->
        <ul class="right black">
            <?php
            // Si connecté, afficher l'adresse couriel
            if (isset($_SESSION['usager'])) {

                // afficher le courriel de l'usager connecté
                echo '<li><a class="waves-effect waves-light">';
                echo $_SESSION['usager'];
                echo '</a></li>';

                // options exclusives aux admin
                if ($_SESSION['role'] == 'admin') {
                    echo '<li><a href="/videotheque/viewsfilms/admin.php" class="waves-effect waves-light red-text">Options d\'administation</a></li>';
                } else {
                    echo '<li><a href="/videotheque/viewsfilms/panier.php" class="waves-effect waves-light" type="submit">Panier</a></li>';
                }

                echo '<li><a href="/videotheque/viewsfilms/deconnexion.php" class="waves-effect waves-light red"><i class="material-icons left">exit_to_app</i>Se déconnecter</a></li>';

            } else {            // Si non connecté, afficher l'option pour se connecter
                ?>
                <!--Trigger du modal pour saisir courriel et mot de passe-->
                <li><a href="/videotheque/viewsfilms/formulaires/formAjoutMembre.php"><i class="material-icons left">person_add</i>
                        Devenir membre</a></li>
                <a class="waves-effect waves-light modal-trigger" href="#modalConnexion" type="submit">
                    <i class="material-icons left">vpn_key</i>Connexion</a></li>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/formulaires/formConnexion.html";
            }
            ?>
        </ul>
    </div>
</nav>

<!--TODO: recopier le code php pour générer ce menu-->
<ul class="sidenav" id="mobile-demo">
    <li><a href="/videotheque/test.html">Sass</a></li>
    <li><a href="/videotheque/test.html">Components</a></li>
    <li><a href="/videotheque/test.html">Javascript</a></li>
    <li><a href="/videotheque/test.html">Mobile</a></li>
</ul>
