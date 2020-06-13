// utilisé pour debugging, enlever lorsque le projet sera terminé
function test() {
    console.log("test");
}

function lister(){
    document.getElementById('formLister').submit();
}


/*************************************************************************************
 *               FONCTIONS RELIÉES AUX ÉLÉMENTS GRAPHIQUES DES PAGES
 *************************************************************************************/

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
});


$(document).ready(function () {
    $('.sidenav').sidenav();

    $('.carousel').carousel({
        padding: 200
    });
});


$(".dropdown-trigger").dropdown({hover: false});


function chargerModal() {
    $('#modal1').modal();
}
