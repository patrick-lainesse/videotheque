<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Page d'accueil du site. C'est aussi ici que seront redirigés les usagers déconnectés ou tentant
de se connecter à des pages auxquelles il n'a pas accès, en affichant un message d'erreur.
-->
<!--TODO: Gérer l'affichage de messages d'erreur-->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;
?>
<h1 class="center">Location de films</h1>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";