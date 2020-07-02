<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Page d'accueil du site. C'est aussi ici que seront redirigés les usagers déconnectés ou tentant
de se connecter à des pages auxquelles il n'a pas accès, en affichant un message d'erreur.
-->
<?php
include "viewsfilms/header.php";
require_once "bd/connexion.inc.php";

// Afficher un message d'erreur s'il y a lieu
if (isset($_GET['Message'])) {
    echo '<p class="center-align red-text">' . $_GET['Message'] . '</p>';
}
?>
<h1 class="videotheque text-darken-4 red-text">VIDÉOTHÈQUE</h1>
<h4 class="center">LE contrepoids aux Netflix, Disney<br>et autres géants de ce monde.</h4>

<div class="row center-align marginTop30">
    <a href="viewsfilms/formulaires/formAjoutMembre.php" class="waves-effect waves-light btn darken-4 red">Devenir membre</a>
    <a href="viewsfilms/lister.php" class="waves-effect waves-light btn darken-4 red">Parcourir notre catalogue</a>
</div>
<?php
include "viewsfilms/footer.html";