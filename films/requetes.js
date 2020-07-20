/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 13/07/2020

Fonctions JavaScript qui relient le html aux requêtes faites au serveur par AJAX
*/

/*function enregistrer(){
    var formFilm = new FormData(document.getElementById('formEnregistrer'));
    formFilm.append('route','enregistrer');
    $.ajax({
        type : 'POST',
        url : 'films/controleur.php',
        data : formFilm, //$('#formEnreg').serialize();
        dataType : 'json', //text pour le voir en format de string
        //async : false,
        //cache : false,
        contentType : false,	// demande au navigateur de vérif si fichier et si oui, il base encode
        processData : false,	// Ces deux lignes pas nécessaires si pas de fichier: laisse déterminer quel est le content type de ce fichier, ref à enctype, sinon on recevra pas le fichier
        success : function (reponse){//alert(reponse);
            filmsVue(reponse);
        },
        fail : function (err){

        }
    });
}*/

const lister = function () {
    let formFilm = new FormData();
    formFilm.append('route', 'lister');
    $.ajax({
        type: 'POST',
        url: 'films/controleur.php',
        data: formFilm,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (reponse) {
            //TODO: alert(reponse.route);
            //alert(reponse.listeFilms[0].realisateur);
            vue(reponse);
        },
        fail: function (err) {
            //TODO:
            alert("erreur");
        }
    });
}

const listerCategorie = function (categorie) {
    let formFilm = new FormData();
    formFilm.append('route', 'listerCategorie');
    formFilm.append('categorie', categorie);
    $.ajax({
        type: 'POST',
        url: 'films/controleur.php',
        data: formFilm,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (reponse) {
            vue(reponse);
        },
        fail: function (err) {
            //TODO:
            alert("erreur");
        }
    });
}

const listerAdmin = function () {
    let formFilm = new FormData();
    formFilm.append('route', 'listerAdmin');
    $.ajax({
        type: 'POST',
        url: 'films/controleur.php',
        data: formFilm,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (reponse) {
            vue(reponse);
        },
        fail: function (err) {
            //TODO:
            alert("erreur");
        }
    });
}

const modifier = function () {
    let formulaire = document.getElementById('formulaire');
    let formFilm = new FormData(formulaire);
    formFilm.append('route', 'modifier');
    $.ajax({
        type: 'POST',
        url: 'films/controleur.php',
        data: formFilm,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (reponse) {
            //$('#divFormFiche').hide();
            //filmsVue(reponse);
            alert('modifié!');
            // TODO: pourquoi il alerte pas? L'image semble OK...
        },
        fail: function (err) {
            // TODO: si erreur
            alert("erreur");
        }
    });
}