<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

$quantite = $_POST['quantite']; // ??? erreur lorsque déconnexion: Notice: Undefined index: quantite in /opt/lampp/htdocs/videotheque/viewsfilms/panierAjout.php on line 6
echo $_SESSION['idMembre'];

include 'footer.html';