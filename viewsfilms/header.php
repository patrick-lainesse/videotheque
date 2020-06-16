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
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content black">
    <li><a href="#">Action</a></li>
    <li><a href="#">Drame</a></li>
    <li><a href="#">Horreur</a></li>        <!--ajouter les autres styles ???-->
    <!--<li class="divider"></li>-->
</ul>

<nav>
    <div class="nav-wrapper black">
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down black">
            <li><a type="submit" onclick="lister();">ACCUEIL</a></li>
            <li><a type="submit" onclick="lister();">Nos films</a></li>
            <li><a type="submit" onclick="enregistrer();">+ Film</a></li>
            <li><a href="/videotheque/">Modifier film</a></li>
            <!--<li><a type="submit" onclick="update();">Modifier film</a></li>-->
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Catégories<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
        <ul class="right black">
            <li><a href="/videotheque/test.html"><!--???-->
                <i class="material-icons left">person_add</i>
                Devenir membre
            </a></li>
            <li><a href="#">
                <i class="material-icons left">vpn_key</i>
                Connexion
            </a></li>
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li><a href="/videotheque/test.html">Sass</a></li>
    <li><a href="/videotheque/test.html">Components</a></li>
    <li><a href="/videotheque/test.html">Javascript</a></li>
    <li><a href="/videotheque/test.html">Mobile</a></li>
</ul>

<form id="formLister" action="/videotheque/viewsfilms/lister.php" method="POST">
</form>
<form id="formEnregistrer" action="/videotheque/viewsfilms/formAjoutFilm.php" method="POST">
</form>
<form id="formUpdate" action="/videotheque/viewsfilms/formUpdate.php" method="POST">
</form>
