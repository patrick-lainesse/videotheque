/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 13/07/2020

Fonctions JavaScript qui relient le html aux requêtes faites au serveur par AJAX
*/

function lister() {
    let formFilm = new FormData();
    formFilm.append('route', 'lister');
    $.ajax({
        type: 'POST',
        url: 'films/controleur.php',
        data: formFilm,
        // processData est nécessaire, sinon erreur dans la console:
        // "trying to append to an object that doesn't implement FormData"
        processData: false,
        contentType: false,
        dataType: 'json',
        //dataType: 'text',
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