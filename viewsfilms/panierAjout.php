<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Fonction qui gère le clic sur "Ajouter au panier" de la page lister.php et ajoute
la quantité de films saisie à la base de données.
-->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

$quantite = $_POST['quantite']; // TODO: erreur lorsque déconnexion: Notice: Undefined index: quantite in /opt/lampp/htdocs/videotheque/viewsfilms/panierAjout.php on line 6
$idMembre = $_SESSION['idMembre'];
$idFilm = $_POST['idFilm'];

// TODO: mettre if pour vérifier si ce filmID est déjà dans le panier
$requete = 'INSERT INTO panier (idPanier, quantite, idMembre, idFilm) VALUES (0,?,?,?)';
$stmt = $connexion->prepare($requete);
$stmt->bind_param("iii", $quantite, $idMembre, $idFilm);
$stmt->execute();

// TODO: ne pas afficher / exécuter la requête si dépasse la qté max
// TODO: après exécution, tenter de rester sur la même page et le même modal, si possible
// TODO: enlever le message et simplement rediriger vers lister, ou alors faire un alert
echo 'Film ' . $_POST['idFilm'] . ' ajouté au panier du membre ' . $_SESSION['usager'] . ' : ' . $_SESSION['idMembre'];

include 'footer.html';