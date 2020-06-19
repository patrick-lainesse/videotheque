<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

$reponse = '<div class="carousel film">';
$requete = 'SELECT * FROM films';
try {
    $listeFilms = mysqli_query($connexion, $requete);

    while ($ligne = mysqli_fetch_object($listeFilms)) {
        $reponse .= '<div class="carousel-item film">';
        $reponse .= '<div class="card">';
        $reponse .= '<div class="card-image">';
        // commenter et faire afficher ID du film   ????
        $reponse .= '<img src="../images/' . ($ligne->image) . '" data-target="modal1" idFilm="' . ($ligne->id) . '" titre="' . ($ligne->titre) . '" hashYT="' . ($ligne->youtube) . '" class="modal-trigger" onclick="chargerModal.call(this)">';
        $reponse .= '</div>';
        $reponse .= '<div class="card-content">';
        $reponse .= '<p class="gras">' . ($ligne->titre) . '</p>' . ($ligne->realisateur) . '<br>' . ($ligne->categorie) . '<br>' . ($ligne->prix) . '$';
        $reponse .= '<form id="' . ($ligne->id) . '" action="panierAjout.php" method="POST">';
        $reponse .= '<div class="row">';
        $reponse .= '<input id="quantite" name="quantite" type="number" min="0" max="500" class="validate">';
        $reponse .= '<label for="quantite">Quantité</label>';
        $reponse .= '</div>';
        $reponse .= '<a class="waves-effect waves-light marginTop5 darken-4 green btn-small" onclick="ajoutFilm(' . ($ligne->id) . ')"><i class="material-icons left">shopping_cart</i>Ajouter</a>';
        $reponse .= '</form>';
        $reponse .= '</div>';
        $reponse .= '</div>';
        $reponse .= '</div>';
    }
    mysqli_free_result($listeFilms);
} catch (Exception $e) {
    echo 'Problème de lecture dans la base de données.';
} finally {
    $reponse .= '</div>';
    echo $reponse;
    mysqli_close($connexion);

    include 'modalYouTube.php';
}

include 'footer.html';