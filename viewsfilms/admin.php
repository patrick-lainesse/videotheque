<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Page d'accueil d'un administrateur, qui affiche la liste des films de la base de données et contient
des boutons pour chacun, permet de modifier un film ou de l'effacer de la base de données. Si un non
administrateur tente de se connecter à cette page, il sera redirigé vers l'index.
-->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;
?>
<div class="container">
    <div class="row">
        <h3 class="center-align">Options d'administration</h3>
    </div>
    <div class="row">
        <a href="/videotheque/viewsfilms/formulaires/formAjoutFilm.php"
           class="btn-small right waves-effect waves-light darken-4 green">
            Ajouter un film<i class="material-icons left">movie_filter</i>
        </a>
    </div>
    <table class="centered">
        <thead>
        <tr>
            <th>Affiche</th>
            <th>Film</th>
            <th>Réalisateur</th>
            <th>Catégorie</th>
            <th>Durée</th>
            <th>Prix</th>
            <th>Gestion</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
            include 'elementsHTML/tableRowAdmin.php';
            include 'Film.php';

            // S'asssurer que seuls les admin accèdent à la page
            if ($_SESSION['role'] != 'admin') {
                $message = urlencode("Vous devez être connecté en tant qu'administrateur pour accéder à cette page.");
                header('location:../index.php?Message=' . $message);
            }

            $requete = 'SELECT id, titre, realisateur, categorie, duree, prix, image, youtube from films';

            try {
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $reponse = $stmt->get_result();

                // Place les résultats dans un objet de la classe Film, puis sur une rangée de tableau
                while ($ligne = mysqli_fetch_object($reponse, Film::class)) {
                    tableRow($ligne);
                }
            } catch (Exception $e) {
                $message = urlencode("Erreur lors du chargement de la liste de films.");
                header('location:../index.php?Message=' . $message);
            } finally {
                $stmt->close();
                mysqli_close($connexion);
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";
