<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Page d'accueil d'un administrateur, qui affiche la liste des films de la base de données et contient
des boutons pour chacun, permet de modifier un film ou de l'effacer de la base de données. Si un non
administrateur tente de se connecter à cette page, il sera redirigé vers l'index.

Notes:
La fonction Le stmt->close() effectue également un free_result:
https://stackoverflow.com/questions/19531195/stmt-close-vs-stmt-free-result
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
            include 'elementsHTML/tableRow.php';
            include 'Film.php'; // TODO tester sans ce include

            // S'asssurer que seuls les admin accèdent à la page
            if ($_SESSION['role'] != 'admin') {
                Header('location:../index.php');
            }

            $requete = 'SELECT id, titre, realisateur, categorie, duree, prix, image, youtube from films';

            try {
                $stmt = $connexion->prepare($requete);
                //$stmt->bind_param("i", $idMembre);
                $stmt->execute();
                $reponse = $stmt->get_result();

                // place les résultats dans un objet de la classe Film, puis sur une rangée de tableau
                while ($ligne = mysqli_fetch_object($reponse, Film::class)) {
                    //tableRow(($ligne->image), ($ligne->titre), ($ligne->quantite), ($ligne->prix));
                    tableRow($ligne);
                }
            } catch (Exception $e) {
                echo 'Problème de lecture dans la base de données.';
            } finally {
                $stmt->close();     // effectue aussi un free_result()
                mysqli_close($connexion);
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";
