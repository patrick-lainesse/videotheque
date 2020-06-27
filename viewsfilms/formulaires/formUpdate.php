<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Formulaire qui affiche les infos du film sélectionné par un admin et qui permet de mettre à jour
les informations d'un film.
-->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";

$num = $_POST['idFilm'];
$typeForm = $_POST['typeForm'];

function afficherForm($ligne)
{
    global $num;
    global $typeForm;

    if ($typeForm == 'update') {
        ?>
        <h5 class="white-text center">Modifier les informations pour le film <?php echo $num; ?></h5>
        <?php
    } elseif ($typeForm == 'effacer') {
        ?>
        <h5 class="white-text center">Voulez-vous bien supprimer le film <?php echo $num; ?> de la base de données?</h5>
        <?php
    }
    ?>
    <img id="previewUpload" src="../../images/<?php echo($ligne->image); ?>" class="imagePreview">
    <div class="row margin50">
        <form class="col s6 offset-s3" id="formUpdate" enctype="multipart/form-data"
              action="../fonctionsSQL/fonctionsAdmin.inc.php" method="POST" onsubmit="return valider()">
            <?php
            if ($typeForm == 'update') { ?>
                <input type="hidden" id="typeForm" name="typeForm" value="update">
                <?php
            } elseif ($typeForm == 'effacer') { ?>
                <input type="hidden" id="typeForm" name="typeForm" value="effacer">
                <?php
            }
            ?>
            <div class="row">
                <div class="input-field col s4">
                    <input id="idFilm" name="idFilm" type="number" value="<?php echo $num; ?>" readonly>
                    <label for="idFilm">Identifiant du film</label>
                </div>
                <div class="input-field col s8">
                    <input id="titre" name="titre" type="text" class="validate" value=" <?php echo($ligne->titre); ?>">
                    <label for="titre">Titre du film</label>
                </div>
            </div>
            <h5 class="white-text">Réalisateur</h5>
            <div class="row">
                <div class="input-field col s6">
                    <?php $charEspace = strpos(($ligne->realisateur), " "); ?>
                    <input id="prenom" name="prenom" type="text" class="validate"
                           value="<?php echo substr(($ligne->realisateur), 0, $charEspace); ?>">
                    <label for="prenom">Prénom</label>
                </div>
                <div class="input-field col s6">
                    <input id="nom" name="nom" type="text" class="validate"
                           value="<?php echo substr(($ligne->realisateur), $charEspace); ?>">
                    <label for="nom">Nom</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4 grey darken-4">
                    <select id="categorie" name="categorie">
                        <?php
                        // Préselection de la catégorie stockée dans la base de données
                        $categories = array("Action", "Animation", "Comédie", "Drame", "Horreur", "Romance", "Science-fiction");
                        $catLength = count($categories);

                        for ($x = 0; $x < $catLength; $x++) {
                            if ($categories[$x] === ($ligne->categorie)) {
                                echo '<option value="' . $categories[$x] . '" selected>' . $categories[$x] . '</option>';
                            } else {
                                echo '<option value="' . $categories[$x] . '">' . $categories[$x] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <label>Catégorie</label>
                </div>
                <div class="input-field col s4">
                    <input id="duree" name="duree" type="number" min="0" step="1" max="700" class="validate"
                           value="<?php echo($ligne->duree); ?>">
                    <label for="duree">Durée</label>
                </div>
                <div class="input-field col s4">
                    <input id="prix" name="prix" type="number" min="0" max="500" step="0.01" class="validate"
                           value="<?php echo($ligne->prix); ?>">
                    <label for="prix">Prix</label>
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field col s6">
                    <div class="btn waves-effect red darken-4">
                        <span>Image</span>
                        <!--source pour onchange: http://localhost/videotheque/viewsfilms/formulaires/formUpdate.php-->
                        <input type="file" id="pochette" name="pochette"
                               onchange="document.getElementById('previewUpload').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="input-field col s6">
                    <input id="hashYT" name="hashYT" type="text" class="validate"
                           value="<?php echo($ligne->youtube); ?>">
                    <label for="hashYT">Hash YouTube</label>
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect red darken-4" type="submit" name="action">
                    <?php
                    // Texte à afficher sur le bouton
                    if ($typeForm == 'update') {
                        echo 'Modifier';
                    }
                    if ($typeForm == 'effacer') {
                        echo 'Supprimer';
                    }
                    ?>
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
    <?php
}   // fin de la fonction afficherForm($ligne)

$requete = "SELECT * FROM films WHERE id=?";

try {
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("i", $num);
    $stmt->execute();
    $result = $stmt->get_result();
    $ligne = $result->fetch_object();
} catch (Exception $e) {
    $message = urlencode("Erreur lors de la modifications des données du film.");
    header('location:../../index.php?Message=' . $message);
} finally {
    $stmt->close();
    mysqli_close($connexion);
}
afficherForm($ligne);