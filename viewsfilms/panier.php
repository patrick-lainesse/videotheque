<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Fonction qui effectue la requête SQL et affiche la liste du panier d'achat d'un membre
Note: Le stmt->close() effectue également un free_result
https://stackoverflow.com/questions/19531195/stmt-close-vs-stmt-free-result
-->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

// TODO: Empêcher l'accès à cette page lorsque non connecté, voir admin.php
?>

<div class="container">
    <div class="row">
        <h3>Votre panier
            <a class="waves-effect waves-light darken-4 green btn-small marginTop30 right"><i
                        class="material-icons left">delete_forever
                </i>Vider le panier</a></h3><!--TODO : programmer vider le panier-->
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
            include 'elementsHTML/panierTableRow.php';      // TODO: Enlever cette ligne

            // requête à la base de données pour obtenir le panier de l'usager connecté
            $idMembre = $_SESSION['idMembre'];
            $requete = 'SELECT films.id, films.image, films.titre, panier.quantite, films.prix FROM panier INNER JOIN films ON panier.idFilm = films.id WHERE panier.idMembre=?';

            try {
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("i", $idMembre);
                $stmt->execute();
                $reponse = $stmt->get_result();

                $sousTotal = 0;

                // place les résultats sur une rangée de tableau
                while ($ligne = mysqli_fetch_object($reponse)) {
                    $sousTotal += ($ligne->prix) * ($ligne->quantite);
                    // TODO: ça devrait pas être panierTableRow????
                    //tableRow(($ligne->image), ($ligne->titre), ($ligne->quantite), ($ligne->prix));
                    echo '<form action="fonctionsSQL/fonctionsPanier.php" method="POST">';
                    echo '<input type="hidden" name="fonction" value="supprimerFilmPanier">';
                    echo '<input type="hidden" name="idMembre" value="' . ($idMembre) . '">';
                    echo '<input type="hidden" name="idFilm" value="' . ($ligne->id) . '">';
                    echo '<tr>';
                    echo '<td><img src="/videotheque/images/' . ($ligne->image) . '" id="affiche" class="imgTable"></td>';
                    echo '<td>' . ($ligne->titre) . '</td>';
                    echo '<td>' . ($ligne->quantite) . '</td>';
                    echo '<td>' . ($ligne->prix) . '$</td>';
                    // TODO: réaction au clic sur ce bouton
                    echo '<td><button type="submit" class="waves-effect waves-light darken-4 red btn-small"><i class="material-icons left">delete</i>Supprimer</button></td>';
                    //echo '<td><a type="submit" class="waves-effect waves-light darken-4 red btn-small"><i class="material-icons left">delete</i>Supprimer</a></td>';
                    echo '</tr>';
                    echo '</form>';
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
    <div class="right-align">
        <p><strong>Sous-total:</strong> <?php echo $sousTotal; ?>$
            <br><strong>TVQ:</strong> <? echo $tvq = number_format($sousTotal * 0.09975, 2); ?>$
            <br><strong>TPS:</strong> <? echo $tps = number_format($sousTotal * 0.05, 2); ?>$
            <br><strong>Total:</strong> <? echo number_format($sousTotal + $tvq + $tps, 2); ?>$
        </p>
    </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";
