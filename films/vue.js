/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 13/07/2020

Fonctions JavaScript responsables de l'affichage de code HTML.
*/

const vue = function (reponse) {
    const route = reponse.route;
    switch (route) {
        case "enregistrer" :
        case "supprimer" ://TODO
        case "modifier" :
            $('#messages').html(reponse.msg);//TODO
            setTimeout(function () {
                $('#messages').html("");
            }, 5000);
            break;
        case "lister" :
            afficherCatalogue(reponse.listeFilms);//TODO renommer les fonctions de manière plus parlante
            break;
        case "fiche" :
            afficherFiche(reponse);
            break;

    }
};

const afficherCatalogue = function (listeJSON) {
    // Cacher le message d'accueil de la page
    $('#accueil').hide();
    $('#carouselFilms').show();

    //let carouselItem = $('#carouselItem');
    $('#carouselFilms').html = "";

    //let image = document.createElement('img');
    //image.src = 'images/' + listeJSON[0].image + '" data-target="modal1 idFilm="' + listeJSON[0].id + '" titre="' + listeJSON[0].titre + '" hashYT="' + listeJSON[0].youtube + '" class="modal-trigger" onclick="chagerModal.call(this)">';

    /*$('#liste-image').html('<img src="images/' + listeJSON[0].image + '" data-target="modal1" idFilm="' + listeJSON[0].id + '" titre="' + listeJSON[0].titre + '" hashYT="' + listeJSON[0].youtube + '" class="modal-trigger" onclick="chagerModal.call(this)">');
    $('#card-content').html('<p class="gras">' + listeJSON[0].titre + '</p>' + listeJSON[0].realisateur + '<br>' + listeJSON[0].categorie + '<br>' + listeJSON[0].prix + '$');*/
    let taille = listeJSON.length;

    let carteFilm = "";

    for (let i = 0; i < taille; i++) {

        carteFilm += '<div class="carousel-item film">';
        carteFilm += '<div class="card">';
        carteFilm += '<div class="card-image">';
        carteFilm += '<img src="images/' + listeJSON[i].image
            + '" data-target="modal1" idFilm="' + listeJSON[i].id + '" titre="'
            + listeJSON[i].titre + '" hashYT="' + listeJSON[i].youtube
            + '" class="modal-trigger" onclick="chagerModal.call(this)">';
        carteFilm += '</div>';
        carteFilm += '<div class="card-content">';
        carteFilm += '<p class="gras">' + listeJSON[i].titre + '</p>'
            + listeJSON[i].realisateur + '<br>'
            + listeJSON[i].categorie + '<br>'
            + listeJSON[i].prix + '$';
        carteFilm += '</div>';
        carteFilm += '</div>';
        carteFilm += '</div>';

        //$('#liste-image').html('<img src="images/' + listeJSON[0].image + '" data-target="modal1" idFilm="' + listeJSON[0].id + '" titre="' + listeJSON[0].titre + '" hashYT="' + listeJSON[0].youtube + '" class="modal-trigger" onclick="chagerModal.call(this)">');
        //$('#card-content').html('<p class="gras">' + listeJSON[0].titre + '</p>' + listeJSON[0].realisateur + '<br>' + listeJSON[0].categorie + '<br>' + listeJSON[0].prix + '$');
    }
    $('#carouselFilms').html(carteFilm);

    // Rafraîchir l'affichage du carousel
    $('.carousel').carousel({
        padding: 200
    });


    // TODO: cliquer sur les films ne fait pas sortir les preview
}