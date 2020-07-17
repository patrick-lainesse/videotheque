/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 13/07/2020

Fonctions JavaScript responsables de l'affichage de code HTML.
*/

const vue = function (reponse) {
    const route = reponse.route;
    switch (route) {
        case "enregistrer" ://TODO renommer les fonctions de manière plus parlante
        case "supprimer" ://TODO
        case "modifier" :
            $('#messages').html(reponse.msg);//TODO
            setTimeout(function () {
                $('#messages').html("");
            }, 5000);
            break;
        case "lister" :
            afficherCatalogue(reponse.listeFilms);
            break;
        case "listerCategorie" :
            afficherCatalogue(reponse.listeFilms);
            break;
        case "listerAdmin" :
            tableauAdmin(reponse.listeFilms);
            break;
        case "fiche" :  // TODO: éliminer
            afficherFiche(reponse);
            break;
        default://TODO: afficher message dans zone d'affichage
    }
};

const afficherCatalogue = function (listeJSON) {
    // Cacher tout sauf le menu de navigation, puis réinitialiser le carousel
    cacherTout();
    let carousel = $('#carouselFilms');
    carousel.show();

    // Afficher chaque objet retouré par la requête SQL dans le carousel
    let taille = listeJSON.length;
    let carteFilm = "";

    for (let i = 0; i < taille; i++) {

        carteFilm += '<div class="carousel-item film">';
        carteFilm += '<div class="card">';
        carteFilm += '<div class="card-image">';
        /* Associer les données nécessaires comme attributs de l'image, afin de les récupérer
         * au onclick pour afficher les informations de ce film dans le modal. */
        carteFilm += '<img src="images/' + listeJSON[i].image
            + '" data-target="modal1" idFilm="' + listeJSON[i].id + '" titre="'
            + listeJSON[i].titre + '" hashYT="' + listeJSON[i].youtube
            + '" class="modal-trigger" onclick="chargerModal.call(this)">';
        carteFilm += '</div>';
        carteFilm += '<div class="card-content">';
        carteFilm += '<p class="gras">' + listeJSON[i].titre + '</p>'
            + listeJSON[i].realisateur + '<br>'
            + listeJSON[i].categorie + '<br>'
            + listeJSON[i].prix + '$';
        carteFilm += '</div>';
        carteFilm += '</div>';
        carteFilm += '</div>';
    }

    carousel.html(carteFilm);

    // Rafraîchir l'affichage du carousel
    $('.carousel').carousel({
        padding: 200
    });
    // TODO: ajouter une colonne date de sortie à la table films
}


// TODO: devrait être un objet de la classe film qui soit passé en paramètre ici
const tableauAdmin = function (listeJSON) {

    // Afficher seulement la section du site nécessaire
    cacherTout();
    $('#divAdmin').show();

    let taille = listeJSON.length;
    let tableauFilms = "";

    /* Initialisation d'un map, qui permettra d'insérer les boutons "modifier" et "supprimer" dans le tableau
     * et de leur passer en paramètre des instances de la classe Film.
     * Clé: le id de la case où insérer le bouton
     * Valeur: un tableau contenant les boutons "modifier" et "supprimer" */
    let arrayBoutonsModifier = new Map();

    for (let i = 0; i < taille; i++) {

        // TODO: changer si finalement c'est un objet film qui est passé en paramètre
        let filmCourant = new Film(listeJSON[i]);
        let proprietesFilm = [filmCourant.titre, filmCourant.realisateur, filmCourant.categorie, filmCourant.duree + " min", filmCourant.prix + "$"];

        tableauFilms += '<tr>';
        tableauFilms += '<td><img src="images/' + filmCourant.image + '" class="imgTable"></td>';

        for (let propriete of proprietesFilm) {
            tableauFilms += '<td>' + propriete + '</td>';
        }

        // Case du tableau où iront les boutons pour modifier / supprimer des films de la base de données
        let tdAdmin = "admin" + filmCourant.id;
        tableauFilms += '<td id="' + tdAdmin + '">';
        tableauFilms += '</td>';
        tableauFilms += '</tr>';

        let boutonModifier = document.createElement('button');
        boutonModifier.classList.add("btn-small", "waves-effect", "waves-light", "darken-4", "green");
        boutonModifier.innerHTML = 'Modifier<i class="material-icons right">create</i>';
        boutonModifier.onclick = function () {
            afficherFormulaire('Modifier', filmCourant);
        }

        let boutonSupprimer = document.createElement('button');
        boutonSupprimer.classList.add("btn-small", "waves-effect", "waves-light", "marginTop10", "darken-4", "red");
        boutonSupprimer.innerHTML = 'Supprimer<i class="material-icons right">delete</i>';
        boutonSupprimer.onclick = function () {
            afficherFormulaire('Supprimer', filmCourant);
        }

        arrayBoutonsModifier.set(tdAdmin, [boutonModifier, boutonSupprimer]);
    }

    // Ajouter le code du tableau à la page, puis insérer les boutons modifier et supprimer aux lignes correspondantes
    $('#tableauAdmin').html(tableauFilms);

    for (let [cle, valeur] of arrayBoutonsModifier) {
        let td = document.getElementById(cle);
        td.appendChild(valeur[0]);
        td.appendChild(valeur[1]);
    }
}


const afficherFormulaire = function (typeRequete, unFilm) {

    let titre = $('#titreFormulaire');
    let bouton = $('#formBouton');
    let nouveauFilm;

    cacherTout();
    $('#divFormulaire').show();

    // Afficher le titre et le bouton correspondant au type de requête
    switch (typeRequete) {
        /*case "Enregistrer":
            titre.html('Ajouter un nouveau film à la base de données');
            bouton.html(typeRequete + '<i class="material-icons right">send</i>');
            bouton.onclick = function () {
                // TODO: valider, ici ou dans requête
                nouveauFilm = new Film($('#formIdFilm').val(),
                    $('#formTitre').val(),
                    $('#formPrenom').val() + ' ' + $('#formNom').val(),
                    $('#formCategorie').val(),
                    $('#formDuree').val(),
                    $('#formPrix').val(),
                    $('#formHashYT').val());
                enregistrer(nouveauFilm);
            }
            break;*/
        case "Modifier":
            titre.html('Modifier les informations pour le film ' + unFilm.id);
            bouton.html(typeRequete + '<i class="material-icons right">create</i>');
            $('#formulaire').submit(function () {
                // Envoyer la requête par AJAX et empêcher le bouton d'effectuer un submit du formulaire
                modifier();
                return false;
            });
            break;
        case "Supprimer":
            titre.html('Supprimer le film ' + unFilm.id + ' ?');
            bouton.html(typeRequete + '<i class="material-icons right">delete</i>');
            break;
        default://TODO: message d'erreur
    }

    // Préremplir le formulaire avec les données du film provenant de la base de données
    $('#previewUpload').attr("src", "images/" + unFilm.image);
    $('#formIdFilm').attr("value", unFilm.id);
    $('#formTitre').attr("value", unFilm.titre);

    let realisateur = unFilm.realisateur;
    let posEsapce = realisateur.indexOf(" ");
    let prenom = realisateur.substring(0, posEsapce);
    let nom = realisateur.substring(posEsapce + 1);
    $('#formPrenom').attr("value", prenom);
    $('#formNom').attr("value", nom);

    $('#formCategorie').val(unFilm.categorie);
    $('#formDuree').attr("value", unFilm.duree);
    $('#formPrix').attr("value", unFilm.prix);
    $('#filePathWrapper').attr("value", unFilm.image);
    $('#formHashYT').attr("value", unFilm.youtube);

    // Réinitialiser l'affichage du framework MaterializeCSS
    M.updateTextFields();
    $('select').formSelect();
}

const cacherTout = function () {
    $('#accueil').hide();
    $('#carouselFilms').hide();
    $('#divAdmin').hide();
    $('#divFormulaire').hide();
}
