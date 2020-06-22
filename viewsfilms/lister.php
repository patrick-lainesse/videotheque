<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

$requete = 'SELECT * FROM films';

// Requête SQL pour faire afficher tous les films et leurs informations dans un carousel
try {
    $listeFilms = mysqli_query($connexion, $requete);

    echo '<div class="carousel film">';

    while ($ligne = mysqli_fetch_object($listeFilms)) {
        // Todo: extraire le code du carousel dans un fichier html, et plutôt faire un include et remplir en utilisant les ID
        // Todo: pour le readme: printscreen du carousel en indiquant quel id va où
        ?>

        <div class="carousel-item film">
            <div class="card">
                <div class="card-image">
                    <?php
                    // Affiche du film
                    echo '<img src="../images/' . ($ligne->image)
                        . '" data-target="modal1" idFilm="' . ($ligne->id) . '" titre="' . ($ligne->titre)
                        . ' "hashYT="' . ($ligne->youtube) . '" class="modal-trigger" onclick="chargerModal.call(this)">';
                    ?>
                </div>
                <div class="card-content">
                    <!--Affiche le titre, réalisateur, prix, etc.-->
                    <?php echo '<p class="gras">' . ($ligne->titre) . '</p>' . ($ligne->realisateur) . '<br>' .
                        ($ligne->categorie) . '<br>' . ($ligne->prix) . '$';

                    // Affiche le bouton pour ajouter le film au panier si connecté en tant que membre
                    if (isset($_SESSION['usager']) && $_SESSION['role'] == 'membre') {
                        ?>
                        <form id="<?php echo($ligne->id); ?>" action="panierAjout.php" method="POST">
                            <div class="row">
                                <div class="input-field col offset-s4 s4">
                                    <input type="hidden" name="idFilm" value="<?php echo($ligne->id); ?>">
                                    <!--Le id est concatené deux fois pour le différencier du formID-->
                                    <input id="<?php echo ($ligne->id) . ($ligne->id); ?>" name="quantite"
                                           type="number" min="0" max="500" class="validate center-align">
                                    <!-- Todo: valider le max 500 par jscript et empêcher la requête si c'est le cas-->
                                    <label for="<?php echo ($ligne->id) . ($ligne->id); ?>">Qté</label>
                                </div>
                            </div>
                            <a class="waves-effect waves-light marginNeg darken-4 green btn-small"
                               onclick="ajoutFilm(<?php echo($ligne->id); ?>)">
                                <i class="material-icons left">shopping_cart</i>Ajouter</a>
                        </form>
                        <?php
                    }   // fin du if pour le bouton acheter le film ?>
                </div>
            </div>
        </div>
        <?php
    }   // fin du while qui ajoute chaque film de la db au carousel
    mysqli_free_result($listeFilms);
    echo '</div>';
} catch (Exception $e) {
    echo 'Problème de lecture dans la base de données.';
} finally {
    mysqli_close($connexion);
    include 'elementsHTML/modalYouTube.html';
}

include 'footer.html';