<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;   /*à ajouter au readme???*/

$num = $_POST['idFilm'];

function afficherForm($ligne)
{
    global $num;

    $affiche = '<h3 class="white-text center">Modifier les informations pour le film ' . $num . '</h3>';
    // arranger responsive ???
    $affiche .= '<img src="../images/' . ($ligne->image) . '" class="floatLeft">';
    $affiche .= '<div class="row margin50">';
    $affiche .= '<form class="col s6 offset-s3" id="formUpdate" enctype="multipart/form-data" action="test.php" method="POST">';
    $affiche .= '<input type="hidden" id="typeForm" name="typeForm" value="update">';
    $affiche .= '<!--onsubmit="return valider();"???-->';
    $affiche .= '<div class="row">';
    $affiche .= '<div class="input-field col s12">';
    $affiche .= '<input id="titre" name="titre" type="text" class="validate" value="' . ($ligne->titre) . '">';
    $affiche .= '<label for="titre">Titre du film</label>';
    $affiche .= '</div>';
    $affiche .= '</div>';
    $affiche .= '<h5 class="white-text">Réalisateur</h5>';
    $affiche .= '<div class="row">';
    $affiche .= '<div class="input-field col s6">';
    $charEspace = strpos(($ligne->realisateur), " ");
    $affiche .= '<input id="prenom" name="prenom" type="text" class="validate" value="' . substr(($ligne->realisateur), 0, $charEspace) . '">';
    $affiche .= '<label for="prenom">Prénom</label>';
    $affiche .= '</div>';
    $affiche .= '<div class="input-field col s6">';
    $affiche .= '<input id="nom" name="nom" type="text" class="validate" value="' . substr(($ligne->realisateur), $charEspace) . '">';
    $affiche .= '<label for="nom">Nom</label>';
    $affiche .= '</div>';
    $affiche .= '</div>';
    $affiche .= '<div class="row">';
    $affiche .= '<div class="input-field col s4 grey darken-4">';
    /*??? à faire: https://stackoverflow.com/questions/3030604/php-pre-select-drop-down-option*/
    $affiche .= '<select id="categorie" name="categorie">';
    $affiche .= '<option value="Action">Action</option>';
    $affiche .= '<option value="Animation">Animation</option>';
    $affiche .= '<option value="Comédie">Comédie</option>';
    $affiche .= '<option value="Drame">Drame</option>';
    $affiche .= '<option value="Horreur">Horreur</option>';
    $affiche .= '<option value="Romance">Romance</option>';
    $affiche .= '<option value="Science-fiction">Science-fiction</option>';
    $affiche .= '</select>';
    $affiche .= '<label>Catégorie</label>';
    $affiche .= '</div>';
    $affiche .= '<div class="input-field col s4">';
    $affiche .= '<input id="duree" name="duree" type="number" min="0" step="1" max="700" class="validate" value="' . ($ligne->duree) . '">';
    $affiche .= '<label for="duree">Durée</label>';
    $affiche .= '</div>';
    $affiche .= '<div class="input-field col s4">';
    $affiche .= '<input id="prix" name="prix" type="number" min="0" max="500" step="0.01" class="validate" value="' . ($ligne->prix) . '">';
    $affiche .= '<label for="prix">Prix</label>';
    $affiche .= '</div>';
    $affiche .= '</div>';
    $affiche .= '<div class="row" > ';
    $affiche .= '<div class="file-field input-field col s6">';
    $affiche .= '<div class="btn waves-effect red darken-4">';
    $affiche .= '<span>Image</span>';
    $affiche .= '<input type="file" id="pochette" name="pochette">';
    $affiche .= '</div>';
    $affiche .= '<div class="file-path-wrapper">';
    $affiche .= '<input class="file-path validate" type="text">';
    $affiche .= '</div>';
    $affiche .= '</div>';
    $affiche .= '<div class="input-field col s6">';
    $affiche .= '<input id="hashYT" name="hashYT" type="text" class="validate" value="' . ($ligne->youtube) . '"> ';
    $affiche .= '<label for="hashYT">Hash YouTube</label>';
    $affiche .= '</div>';
    $affiche .= ' </div>';
    $affiche .= '<div class="row">';
    $affiche .= '<button class="btn waves-effect red darken-4" type="submit" name="action">Enregistrer';
    $affiche .= '<i class="material-icons right">send</i>';
    $affiche .= '</button>';
    $affiche .= '</div>';
    $affiche .= '</form>';
    $affiche .= '</div>';
    return $affiche;
}

$requete = "SELECT * FROM films WHERE id=?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("i", $num);
$stmt->execute();
$result = $stmt->get_result();
if (!$ligne = $result->fetch_object()) {
    echo "Film " . $num . " introuvable";
    mysqli_close($connexion);
    exit;
}
echo afficherForm($ligne);
mysqli_close($connexion);