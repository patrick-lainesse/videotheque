<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

// TODO: enlever header ici???

// S'asssurer que seuls les membres connectés accèdent à ces fonctions
if (!isset($_SESSION['usager']) || $_SESSION['role'] != 'membre') {
    $message = urlencode("Vous devez être connecté en tant que membre pour accéder à cette page.");
    header('location:../index.php?Message=' . $message);
}

// récupérer la fonction qui est désirée
$fonction = $_POST['fonction'];

switch ($fonction) {

    case 'supprimerFilmPanier':
        supprimerFilmPanier($_POST['idMembre'], $_POST['idFilm']);
        break;
}

/**
 * Supprime l'entrée correspondant aux paramètres dans la table panier de la base de données
 *
 * @param $idMembre (int)
 * @param $idFilm (int)
 * @requires $idMembre et $idFilm sont des Number
 * @returns redirige vers le panier
 */
function supprimerFilmPanier($idMembre, $idFilm) {

    global $connexion;

    $requete = 'DELETE from panier WHERE idMembre=? AND idFilm=?';
    try {
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("ii", $idMembre, $idFilm);
        $stmt->execute();
    } catch (Exception $e) {
        // TODO: changer les echo pour des redirections vers index avec msg d'erreur
        echo 'Problème de lecture dans la base de données.';
    } finally {
        mysqli_close($connexion);
        header('location: ../panier.php');
    }
}