<?php
// ??? serait mieux de créer une classe film
function tableRow($affiche, $titre, $quantite, $prix)
{
    echo '<tr>';
    echo '<td><img src="/videotheque/images/' . $affiche . '" id="affiche" class="imgTable"></td>';
    echo '<td id="titre">' . $titre . '</td>';
    echo '<td id="quantite">' . $quantite . '</td>';
    echo '<td id="prix">' . $prix . '</td>';
    echo '<td><a class="waves-effect waves-light darken-4 red btn-small"><i class="material-icons left">delete</i>Supprimer</a></td>';
    echo '</tr>';
}