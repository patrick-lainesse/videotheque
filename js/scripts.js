// utilisé pour debugging, enlever lorsque le projet sera terminé
function test() {
    console.log("test");
}

// Todo: nettoyer les fonctions qui ne font que soumettre des formulaires invisibles
function admin() {
    document.getElementById('formAdmin').submit();
}

// Fonction appelée lorsqu'on clique sur le bouton "ajouter au panier" de la page qui liste les films
function ajoutFilm(formID) {
    document.getElementById(formID).submit();
}

function ajoutMembre() {
    document.getElementById('formMembre').submit();
}

function connecter() {
    document.getElementById('formConnecter').submit();
}

function enregistrer() {
    document.getElementById('formEnregistrer').submit();
}

function lister() {
    document.getElementById('formLister').submit();
}

function update() { // ??? à corriger avec header
    document.getElementById('formEnregistrer').submit();
}

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
 *************************************************************************************/

function validerNum(elem) {
    var num = document.getElementById(elem).value;
    var numRegExp = new RegExp("^[0-9]{1,4}$");
    if (num != "" && numRegExp.test(num))
        return true;
    return false;
}


/**
 * Vérifie que toutes les entrées des formulaires sont bien remplies
 * Pas nécessaire de valider le ID ou la catégorie car ils sont inaccesibles à l'utilisateur.
 * Le prénom n'est pas validé non plus pour les cas de noms d'artistes particuliers.
 * Image non validée car on pourrait ajouter un film sans image (avatar.jpg serait alors utilisé).
 *
 * @param $idMembre
 * @param $idFilm
 * @param $quantite
 * @requires $idMembre, $idFilm et $quantite sont des Number
 * @returns redirige vers la liste de films
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
    /*var instances = M.Sidenav.init(elems, options);*/     // ??? à enlever si utilise pas d'options
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

    // ??? pour rendre l'input de la date editable: https://stackoverflow.com/questions/35708106/how-to-make-the-materialize-date-picker-in-fact-pickadate-editable
    $('.datepicker').datepicker({
        editable: true,
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd', /*à arranger dd mmmm yyyy???*/
        i18n: {
            months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"]
        }
    });
});
