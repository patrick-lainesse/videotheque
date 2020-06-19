<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

$reponse = '<div class="carousel film">';
$requete = 'SELECT * FROM films';
try {
    $listeFilms = mysqli_query($connexion, $requete);

    while ($ligne = mysqli_fetch_object($listeFilms)) {
        // ??? extraire le code du carousel dans un fichier html, et plutôt faire un include et remplir en utilisant les ID
        // ??? pour le readme: printscreen du carousel en indiquant quel id va où
        $reponse .= '<div class="carousel-item film">';
        $reponse .= '<div class="card">';
        $reponse .= '<div class="card-image">';
        // commenter et faire afficher ID du film   ????
        $reponse .= '<img src="../images/' . ($ligne->image) . '" data-target="modal1" idFilm="' . ($ligne->id) . '" titre="' . ($ligne->titre) . '" hashYT="' . ($ligne->youtube) . '" class="modal-trigger" onclick="chargerModal.call(this)">';
        $reponse .= '</div>';
        $reponse .= '<div class="card-content">';
        $reponse .= '<p class="gras">' . ($ligne->titre) . '</p>' . ($ligne->realisateur) . '<br>' . ($ligne->categorie) . '<br>' . ($ligne->prix) . '$';

        // Afficher le bouton pour achter le film si connecté en tant que membre
        if (isset($_SESSION['usager']) && $_SESSION['role'] == 'membre') {
            $reponse .= '<form id="' . ($ligne->id) . '" action="panierAjout.php" method="POST">';
            $reponse .= '<div class="row">';
            $reponse .= '<div class="input-field col offset-s4 s4">';
            $reponse .= '<input type="hidden" name="idFilm" value="' . ($ligne->id) . '">';
            // Le id est concatené deux fois pour le différencier du formID
            $reponse .= '<input id="' . ($ligne->id) . ($ligne->id) . '" name="quantite" type="number" min="0" max="500" class="validate center-align">';
            // ??? valider le max 500 par jscript et empêcher la requête si c'est le cas
            $reponse .= '<label for="' . ($ligne->id) . ($ligne->id) . '">Qté</label>';
            $reponse .= '</div>';
            $reponse .= '</div>';
            $reponse .= '<a class="waves-effect waves-light marginNeg darken-4 green btn-small" onclick="ajoutFilm(' . ($ligne->id) . ')"><i class="material-icons left">shopping_cart</i>Ajouter</a>';
            $reponse .= '</form>';
        }
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