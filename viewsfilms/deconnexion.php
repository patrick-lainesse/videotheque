<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Fonction qui déconnecte l'usager et le redirige vers la page d'accueil.
-->
<?php
session_start();
session_destroy();
header('Location: ../index.php');
