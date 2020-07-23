/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Fonctions JavaScript générales responsables de l'affichage de code HTML.
*/

/** Vérifie que le courriel entré est valide
 * Source: https://www.wired.com/2008/08/four-regular-expressions-to-check-email-addresses/
 * @return true ou false pour empêcher le formulaire d'envoyer la requête
 */
const chargerModal = function (film) {

    const modal = $("#modalHeader");
    const titre = film.titre;
    const youtube = film.youtube;
    modal.html(titre);
    $("#iframeYT").attr('src', "https://www.youtube.com/embed/" + youtube);
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
 * @return true ou false pour empêcher le formulaire d'envoyer la requête
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

/** Vérifie que le courriel entré est valide
 * Source: https://www.wired.com/2008/08/four-regular-expressions-to-check-email-addresses/
 * @return true ou false pour empêcher le formulaire d'envoyer la requête
 */
function validerMail() {

    let courriel = document.getElementById('courrielMembre').value;
    let mailRegExp = new RegExp('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}');

    return mailRegExp.test(courriel);
}

/*************************************************************************************
 *               FONCTIONS RELIÉES AUX ÉLÉMENTS GRAPHIQUES DES PAGES
 *************************************************************************************/

/** Charge le menu sidenav pour visionner le site en mobile
 * Source: https://www.wired.com/2008/08/four-regular-expressions-to-check-email-addresses/
 */
document.addEventListener('DOMContentLoaded', function () {
    const elems = document.querySelectorAll('.sidenav');
});

// Initialisation des styles éléments importés par MaterializeCSS
$(function () {
    $(".dropdown-trigger").dropdown({hover: false});
    $('.sidenav').sidenav();
})
