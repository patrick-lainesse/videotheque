/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020
*/

function connecter() {
    document.getElementById('formConnecter').submit();
}

/*TODO: à changer si API*/
const chargerModal = function () {

    const modal = $("#modalHeader");
    const titre = $(this).attr('titre');
    const hashYT = $(this).attr('hashYT');
    modal.html(titre);
    $("#iframeYT").attr('src', "https://www.youtube.com/embed/" + hashYT);
    $('#modal1').modal();
}

/*************************************************************************************
 *               FONCTIONS DE VALIDATION DES FORMULAIRES
 *               (source: exemples sur Studium)
 *               La plupart des validations sont fournies par le framework Materialize
 *************************************************************************************/

/**
 * Vérifie que toutes les entrées des formulaires sont bien remplies.
 * Pas nécessaire de valider le idFilm ou la catégorie car ils sont inaccesibles à l'utilisateur.
 * Le prénom n'est pas validé non plus pour les cas de noms d'artistes particuliers.
 * Image non validée car on pourrait ajouter un film sans image (avatar.jpg serait alors utilisé).
 *
 * @returns true ou false pour empêcher le formulaire d'envoyer la requête
 */
function valider() {

    let titre = document.getElementById('titre').value;
    let nom = document.getElementById('nom').value;
    let duree = document.getElementById('duree').value;
    let prix = document.getElementById('prix').value;

    if (titre !== "" && nom !== "" && duree !== "" && prix !== "") {
        return true;
    } else {
        alert("Veuillez remplir convenablement tous les champs");
        return false;
    }
}

/*************************************************************************************
 *               FONCTIONS RELIÉES AUX ÉLÉMENTS GRAPHIQUES DES PAGES
 *************************************************************************************/

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
});

// initialisation des styles éléments importés par MaterializeCSS
$(document).ready(function () {
    $('.sidenav').sidenav();

    $('.carousel').carousel({
        padding: 200
    });

    $('select').formSelect();

    $('#modalConnexion').modal();

    $(".dropdown-trigger").dropdown({hover: false});

    // TODO: pour rendre l'input de la date editable: https://stackoverflow.com/questions/35708106/how-to-make-the-materialize-date-picker-in-fact-pickadate-editable
    $('.datepicker').datepicker({
        editable: true,
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd', /*à arranger dd mmmm yyyy???*/
        i18n: {
            months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"]
        }
    });
});
