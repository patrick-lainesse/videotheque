<!--Le stmt->close() effectue également un free_result: : https://stackoverflow.com/questions/19531195/stmt-close-vs-stmt-free-result-->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

// TODO: Empêcher l'accès à cette page lorsque non connecté
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
            include 'html_functions/tableRow.php';
            include 'Film.php'; // TODO tester sans ce include

            // s'asssurer que seuls les admin accèdent à la page
            if ($_SESSION['role'] != 'admin') {
                Header('location:index.php');
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
    <!--<div class="right-align">
        <p><strong>Sous-total:</strong> <?php /*echo $sousTotal; */?>$
            <br><strong>TVQ:</strong> <?/* echo $tvq = number_format($sousTotal * 0.09975, 2); */?>$
            <br><strong>TPS:</strong> <?/* echo $tps = number_format($sousTotal * 0.05, 2); */?>$
            <br><strong>Total:</strong> <?/* echo number_format($sousTotal + $tvq + $tps, 2); */?>$
        </p>
    </div>-->
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";
