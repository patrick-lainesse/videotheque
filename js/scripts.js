/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Sources:
    - Fonction readURL (upload d'images): https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
*/

function connecter() {
    document.getElementById('formConnecter').submit();
}

// Insère les liens vers les vidéos YouTube dans la liste des films
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

/* Vérifie que le courriel entré est valide
 * Source: https://www.wired.com/2008/08/four-regular-expressions-to-check-email-addresses/
 *
 * @returns true ou false pour empêcher le formulaire d'envoyer la requête
 */
function validerMail() {

    let courriel = document.getElementById('courrielMembre').value;
    let mailRegExp = new RegExp('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}');

    return mailRegExp.test(courriel);
}

/*************************************************************************************
 *               FONCTIONS RELIÉES AUX ÉLÉMENTS GRAPHIQUES DES PAGES
 *************************************************************************************/

// Affichage des preview des images lorsque téléchargées par l'administrateur dans les formulaires
// TODO: pas utilisé?
function myReadUrl(ref) {
    document.getElementById('previewUpload').src = window.URL.createObjectURL(ref.files[0]);
}

// Charger le menu sidenav pour visionner le site en mobile
document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
});

// Initialisation des styles éléments importés par MaterializeCSS
$(document).ready(function () {
    $('.sidenav').sidenav();

    //TODO: plus nécessaire $('select').formSelect();

    // TODO: à enlever pour remise TP, mais remettre si je continue de le développement
    // $('#modalConnexion').modal();

    $(".dropdown-trigger").dropdown({hover: false});
});
