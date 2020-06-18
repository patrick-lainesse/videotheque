// utilisé pour debugging, enlever lorsque le projet sera terminé
function test() {
    console.log("test");
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

function validerNum(elem){
    var num=document.getElementById(elem).value;
    var numRegExp=new RegExp("^[0-9]{1,4}$");
    if(num!="" && numRegExp.test(num))
        return true;
    return false;
}

function valider(){
    var num=document.getElementById('num').value;
    var titre=document.getElementById('titre').value;
    var duree=document.getElementById('duree').value;
    var res=document.getElementById('res').value;
    var numRegExp=new RegExp("^[0-9]{1,4}$");
    if(num!="" && titre!="" && duree!="" && res!="")
        if(numRegExp.test(num))
            return true;
    return false;
}
//Cas d'un button
/*
function valider(){
	var formEnreg=document.getElementById('formEnreg');
	var num=document.getElementById('num').value;
	var titre=document.getElementById('titre').value;
	var duree=document.getElementById('duree').value;
	var res=document.getElementById('res').value;
	var numRegExp=new RegExp("^[0-9]{1,4}$");
	if(num!="" && titre!="" && duree!="" && res!="")
		if(numRegExp.test(num))
			formEnreg.submit();
}
*/


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
});
