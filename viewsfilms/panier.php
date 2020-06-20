<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;
?>

    <div class="container">
        <div class="row">
            <h3>Votre panier
                <a class="waves-effect waves-light darken-4 green btn-small marginTop30 right"><i
                            class="material-icons left">delete_forever
                    </i>Vider le panier</a></h3><!--??? programmer-->
        </div>
        <table class="centered">
            <thead>
            <tr>
                <th>Affiche</th>
                <th>Film</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                include 'html_functions/panierTableRow.php';
                $idMembre = $_SESSION['idMembre'];
                //$requete = 'SELECT membres.idMembre, membres.courriel, connexion.mdp, connexion.role FROM membres INNER JOIN connexion ON membres.idMembre = connexion.idMembre WHERE membres.courriel=? AND connexion.mdp=?';
                $requete = 'SELECT films.image, films.titre, panier.quantite, films.prix FROM panier INNER JOIN films ON panier.idFilm = films.id WHERE panier.idMembre=?';
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("i", $idMembre);
                $stmt->execute();
                $reponse = $stmt->get_result();
                try {
                    // ??? gérer cas 0 résultats, probablement mettre la requête avant le bloc html
                    //$panier = mysqli_query($connexion, $stmt);???

                    $sousTotal = 0;

                    while ($ligne = mysqli_fetch_object($reponse)) {
                        //global $sousTotal;
                        $sousTotal += ($ligne->prix);
                        // fonction qui place les données dans une rangée du tableau
                        tableRow(($ligne->image), ($ligne->titre), ($ligne->quantite), ($ligne->prix));
                    }
                    //mysqli_free_result($);???
                } catch (Exception $e) {
                    echo 'Problème de lecture dans la base de données.';
                } finally {
                    mysqli_close($connexion);   //???
                }
                ?>
            </tbody>
        </table>
        <div class="right-align">
            <p><strong>Sous-total:</strong> <?php echo $sousTotal;?>$
                <br><strong>TVQ:</strong> <? echo $tvq = number_format($sousTotal * 0.09975, 2); ?>$
                <br><strong>TPS:</strong> <? echo $tps = number_format($sousTotal * 0.05, 2); ?>$
                <br><strong>Total:</strong> <? echo number_format($sousTotal + $tvq + $tps, 2); ?>$
            </p>
        </div>
    </div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";
