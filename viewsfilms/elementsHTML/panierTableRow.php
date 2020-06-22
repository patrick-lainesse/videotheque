<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Format d'affichage pour les informations d'un des films la liste qui s'affiche dans le panier
d'achat d'un membre (panier.php)
-->

<?php
// TODO: serait mieux de créer une classe film
// TODO: renommer en panierTableRow
// TODO: effacer ce fichier
function tableRow($affiche, $titre, $quantite, $prix)
{
    echo '<form id="supprimerDuPanier" action="../fonctionsSQL/fonctionsPanier.php" method="POST">';
    echo '<tr>';
    echo '<td><img src="/videotheque/images/' . $affiche . '" id="affiche" class="imgTable"></td>';
    echo '<td id="titre">' . $titre . '</td>';
    echo '<td id="quantite">' . $quantite . '</td>';
    echo '<td id="prix">' . $prix . '$</td>';
    // TODO: réaction au clic sur ce bouton
    echo '<td><a type="submit" class="waves-effect waves-light darken-4 red btn-small"><i class="material-icons left">delete</i>Supprimer</a></td>';
    echo '</tr>';
    echo '</form>';
}