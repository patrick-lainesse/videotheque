<?php
include "header.html";
require_once("../bd/connexion.inc.php");
$reponse = "<div class='carousel film'>";
$requete = "SELECT * FROM films";
try {
    $listeFilms = mysqli_query($connexion, $requete);
    while ($ligne = mysqli_fetch_object($listeFilms)) {
        $reponse .= "<div class='carousel-item film'>";
        $reponse .= "<div class='card'>";
        $reponse .= "<div class='card-image'>";
        $reponse .= '<img src="../images/' . ($ligne->image) . '" data-target="modal1" idFilm="' . ($ligne->id) . '" titre="' . ($ligne->titre) . '" hashYT="' . ($ligne->youtube) . '" class="modal-trigger" onclick="chargerModal.call(this)">';
        $reponse .= "</div>";
        $reponse .= "<div class='card-content'>";
        $reponse .= "<p class='gras'>" . ($ligne->titre) . "</p>" . ($ligne->realisateur) . "<br>" . ($ligne->categorie) . "<br>" . ($ligne->prix) . "$";
        $reponse .= "</div>";
        $reponse .= "</div>";
        $reponse .= "</div>";
    }
    mysqli_free_result($listeFilms);
} catch (Exception $e) {
    echo "Problème de lecture dans la base de données.";
} finally {
    $reponse .= "</div>";
    echo $reponse;
    mysqli_close($connexion);

    include 'modalYouTube.php';
}

include 'footer.html';