<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

En tête de chaque page. Contient un manu de navigation qui change selon qu'un usager est connecté ou
non, ainsi que le rôle de ce membre.
MaterializeCSS utilisé comme framework.
Sources:
- avatar.jpg: https://www.publicdomainpictures.net/en/view-image.php?image=210079&picture=question-mark
- Affiches de film: IMDB
- Previews de films: YouTube
-->
<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vidéothèque</title>

    <!--Importe Icônes Google-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Importe materialize.css-->
    <link type="text/css" rel="stylesheet" href="/videotheque/css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/videotheque/css/styles.css"/>
    <link rel="icon"
          type="images/svg"
          href="/videotheque/images/videocam-24px.svg">
    <!--Indication d'optimisation pour mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Nécessaire de précharger ces scripts pour certains éléments graphiques du framework-->
    <script type="text/javascript" src="/videotheque/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="/videotheque/js/materialize.min.js"></script>
    <script type="text/javascript" src="/videotheque/js/scripts.js"></script>

</head>
<body>

<!-- Options du menu de choix par catégorie. Le choix est transmis à lister.php par la méthode GET -->
<ul id="dropdown1" class="dropdown-content black">
    <li><a class="white-text" href="/videotheque/viewsfilms/lister.php?categorie=Action">Action</a></li>
    <li><a class="white-text" href="/videotheque/viewsfilms/lister.php?categorie=Animation">Animation</a></li>
    <li><a class="white-text" href="/videotheque/viewsfilms/lister.php?categorie=Comédie">Comédie</a></li>
    <li><a class="white-text" href="/videotheque/viewsfilms/lister.php?categorie=Drame">Drame</a></li>
    <li><a class="white-text" href="/videotheque/viewsfilms/lister.php?categorie=Horreur">Horreur</a></li>
    <li><a class="white-text" href="/videotheque/viewsfilms/lister.php?categorie=Romance">Romance</a></li>
</ul>

<nav>
    <!--Menu général pour visionner le catalogue de films-->
    <div class="nav-wrapper black">
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down black">
            <li><a href="/videotheque/index.php" class="waves-effect waves-light">ACCUEIL</a></li>
            <li><a href="/videotheque/viewsfilms/lister.php" class="waves-effect waves-light">Nos films</a></li>
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
                    echo '<li><a href="/videotheque/viewsfilms/admin.php" class="waves-effect waves-light red-text">Options d\'administation</a></li>';
                } else {
                    echo '<li><a href="/videotheque/viewsfilms/panier.php" class="waves-effect waves-light" type="submit">Panier</a></li>';
                }

                echo '<li><a href="/videotheque/viewsfilms/deconnexion.php" class="waves-effect waves-light red">'
                    . '<i class="material-icons left">exit_to_app</i>Se déconnecter</a></li>';

            } else {            // Si non connecté, afficher l'option pour se connecter
                ?>
                <!--Trigger du modal pour saisir courriel et mot de passe-->
                <li><a href="/videotheque/viewsfilms/formulaires/formAjoutMembre.php"><i class="material-icons left">person_add</i>
                        Devenir membre</a></li>
                <li><a class="waves-effect waves-light modal-trigger" href="#modalConnexion" type="submit">
                        <i class="material-icons left">vpn_key</i>Connexion</a></li>
                <?php
                /*include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/formulaires/formConnexion.html";*/
            }
            ?>
        </ul>
    </div>
</nav>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/formulaires/formConnexion.html";
?>

<!--Menu qui remplace la navbar en mode mobile-->
<ul class="sidenav" id="mobile-demo">
    <li><a href="/videotheque/index.php" class="waves-effect waves-light" type="submit">ACCUEIL</a></li>
    <li><a href="/videotheque/viewsfilms/lister.php" class="waves-effect waves-light">Nos films</a></li>
    <!--<li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Catégories<i class="material-icons right">arrow_drop_down</i></a>-->
    <!--TODO: Dropdown fonctionne pas en mobile-->
    <!--TODO: Menu ne semble pas pouvoir s'ouvrir en mode admin (formulaires update, etc)-->
    <?php
    if (isset($_SESSION['usager'])) {

        // afficher le courriel de l'usager connecté
        echo '<li>' . $_SESSION['usager'] . '</li>';

        // Options du menu dépendant du rôle de l'usager
        if ($_SESSION['role'] == 'admin') {
            echo '<li><a href="/videotheque/viewsfilms/admin.php" class="waves-effect waves-light red-text">Options d\'administation</a></li>';
        } else {
            echo '<li><a href="/videotheque/viewsfilms/panier.php" class="waves-effect waves-light" type="submit">Panier</a></li>';
        }

        echo '<li><a href="/videotheque/viewsfilms/deconnexion.php" class="waves-effect waves-light red">'
            . '<i class="material-icons left">exit_to_app</i>Se déconnecter</a></li>';

    } else {            // Si non connecté, afficher l'option pour se connecter
        ?>
        <!--Trigger du modal pour saisir courriel et mot de passe-->
        <li><a href="/videotheque/viewsfilms/formulaires/formAjoutMembre.php">
                <i class="material-icons left">person_add</i>
                Devenir membre</a></li>
        <li><a class="waves-effect waves-light modal-trigger" href="#modalConnexion" type="submit">
                <i class="material-icons left">vpn_key</i>Connexion</a></li>
        <!--TODO: créer une page connexion pour mobile ou faire fonctionner modal-->
        <?php
    } ?>
</ul>