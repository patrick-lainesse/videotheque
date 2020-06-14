// utilisé pour debugging, enlever lorsque le projet sera terminé
function test() {
    console.log("test");
}

function lister() {
    document.getElementById('formLister').submit();
}

function enregistrer() {
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
});

$(".dropdown-trigger").dropdown({hover: false});
