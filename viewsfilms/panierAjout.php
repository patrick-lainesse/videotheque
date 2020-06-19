<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

$quantite = $_POST['quantite']; // ??? erreur lorsque déconnexion: Notice: Undefined index: quantite in /opt/lampp/htdocs/videotheque/viewsfilms/panierAjout.php on line 6
$idMembre = $_SESSION['idMembre'];
$idFilm = $_POST['idFilm'];
//echo $_SESSION['idMembre'];
//echo $_POST['idFilm'];

// mettre if pour vérifier si ce filmID est déjà dans le panier
$requete = 'INSERT INTO panier (idPanier, quantite, idMembre, idFilm) VALUES (0,?,?,?)';
$stmt = $connexion->prepare($requete);
$stmt->bind_param("iii", $quantite, $idMembre, $idFilm);
$stmt->execute();

// ??? ne pas afficher / exécuter la requête si dépasse la qté max
echo 'Film ' . $_POST['idFilm'] . ' ajouté au panier du membre ' . $_SESSION['usager'] . ' : ' . $_SESSION['idMembre'];

include 'footer.html';