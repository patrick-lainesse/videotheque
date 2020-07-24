/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 13/07/2020

Fonctions JavaScript responsables de l'affichage de code HTML pour les éléments Film.
*/

/** Fonction principale, qui vérifie la route désirée par la réponse de la requête et redirige vers la fonction
 *appropriée pour générer la vue appropriée.
 * @param {{route:String}} reponse  Type de requête retournée par le serveur
 * @param {{message:String}} reponse  Message retournée par le serveur
 * @param {{listeFilms:json}} reponse  Liste de films retournée par le serveur
 * */
const vue = function (reponse) {
    const route = reponse.route;
    switch (route) {
        case "enregistrer" :
        case "supprimer" :
        case "modifier" :
            message(reponse.message);
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
        default:
            message("Nous éprouvons présentement des problèmes, veuillez réessayer plus tard.");
    }
};

// TODO: Pas beau sur Chrome
/**
 * Affiche un tableau contenant l'information de tous les films et des boutons pour modifier ou supprimer.
 * @param listeJSON        Liste des films obtenus par la requête au serveur, en format JSON
 */
const afficherCatalogue = function (listeJSON) {
    // Cacher tout sauf le menu de navigation, puis réinitialiser le carousel
    cacherTout();
    let carousel = $('#carouselFilms');
    carousel.show();

    // Afficher chaque objet retouré par la requête SQL dans le carousel
    let taille = listeJSON.length;
    let carteFilm = "";

    /* Initialisation d'un map, qui permet de passer en paramètre des instances de la classe Film.js
     * dans la fonction du onclick qui fait apparaître le modal avec le preview du film.
     * Clé: le id de l'image à associer au onclick
     * Valeur: un objet DOM img */
    let mapImg = new Map();

    for (let i = 0; i < taille; i++) {

        // Convertir chacun des objets du tableau JSON en objet de la classe Film.js
        let filmCourant = new Film(listeJSON[i]);

        /* Crée un élément img du DOM pour y associer les informations à faire afficher dans le modal
         * qui apparaît au onclick sur l'image. */
        let idImg = "img" + filmCourant.id;
        let imgElement = document.createElement('img');
        imgElement.src = "images/" + filmCourant.image;
        imgElement.dataset.target = "modal1";
        imgElement.classList.add("modal-trigger");
        imgElement.onclick = function () {
            chargerModal(filmCourant);
        }
        mapImg.set(idImg, imgElement);

        // Code html de chacun des item à afficher dans le carousel
        carteFilm += '<div class="carousel-item film">';
        carteFilm += '<div class="card">';
        carteFilm += '<div id ="' + idImg + '" class="card-image">';
        carteFilm += '</div>';
        carteFilm += '<div class="card-content">';
        carteFilm += '<p class="gras">' + filmCourant.titre + '</p>'
            + filmCourant.sortie.substring(0, 4) + '<br>'
            + filmCourant.realisateur + '<br>'
            + filmCourant.categorie + '<br>'
            + filmCourant.prix + '$';
        carteFilm += '</div>';
        carteFilm += '</div>';
        carteFilm += '</div>';
    }

    // Ajouter le code du carousel à la page, puis insérer les tags img aux lignes correspondantes.
    carousel.html(carteFilm);

    for (let [cle, valeur] of mapImg) {
        let img = document.getElementById(cle);
        img.appendChild(valeur);
    }

    // Rafraîchir l'affichage du carousel
    $('.carousel').carousel({
        padding: 200
    });
}

/**
 * Affiche un tableau contenant l'information de tous les films et des boutons pour modifier ou supprimer.
 * @param listeJSON        Liste des films obtenus par la requête au serveur, en format JSON
 */
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
    let mapBoutons = new Map();

    for (let i = 0; i < taille; i++) {

        // Convertir chacun des objets du tableau JSON en film pour faciliter la lecture du code
        let filmCourant = new Film(listeJSON[i]);
        let proprietesFilm = [filmCourant.titre, filmCourant.realisateur, filmCourant.categorie, filmCourant.sortie, filmCourant.duree, filmCourant.prix + "$"];

        // Créer une case pour afficher chacune des propriétés du film
        tableauFilms += '<tr>';
        tableauFilms += '<td><img src="images/' + filmCourant.image + '" class="imgTable" alt="Affiche du film"></td>';
        for (let propriete of proprietesFilm) {
            tableauFilms += '<td>' + propriete + '</td>';
        }

        // Case du tableau où iront les boutons pour modifier / supprimer des films de la base de données
        let idTdAdmin = "admin" + filmCourant.id;
        tableauFilms += '<td id="' + idTdAdmin + '">';
        tableauFilms += '</td>';
        tableauFilms += '</tr>';

        // Création des boutons modifier et supprimer, puis ajout au map
        let boutonModifier = document.createElement('button');
        boutonModifier.classList.add("btn-small", "waves-effect", "waves-light", "darken-4", "green", "block");
        boutonModifier.innerHTML = 'Modifier<i class="material-icons right">create</i>';
        boutonModifier.onclick = function () {
            afficherFormulaire('Modifier', filmCourant);
        }

        let boutonSupprimer = document.createElement('button');
        boutonSupprimer.classList.add("btn-small", "waves-effect", "waves-light", "marginTop10", "darken-4", "red", "block");
        boutonSupprimer.innerHTML = 'Supprimer<i class="material-icons right">delete</i>';
        boutonSupprimer.onclick = function () {
            afficherFormulaire('Supprimer', filmCourant);
        }

        mapBoutons.set(idTdAdmin, [boutonModifier, boutonSupprimer]);
    }

    // Ajouter le code du tableau à la page, puis insérer les boutons modifier et supprimer aux lignes correspondantes
    $('#tableauAdmin').html(tableauFilms);

    let br = document.createElement('p');
    br.appendChild(document.createTextNode('<br>'));

    for (let [cle, valeur] of mapBoutons) {
        let td = document.getElementById(cle);
        td.appendChild(valeur[0]);
        td.appendChild(valeur[1]);
    }
}

/**
 * Affiche un formulaire prérempli pour les requêtes effacer, modifier ou supprimer un film.
 * @param typeRequete   Type de formulaire à afficher (enregister, modifier ou supprimer)
 * @param unFilm        Objet de la classe Film.js
 */
const afficherFormulaire = function (typeRequete, unFilm) {

    let titre = $('#titreFormulaire');
    let bouton = $('#formBouton');
    let formulaire = $('#formulaire');

    cacherTout();
    $('#divFormulaire').show();

    // Afficher le titre et le bouton correspondant au type de requête
    switch (typeRequete) {
        case "Enregistrer":
            titre.html('Ajouter un nouveau film à la base de données');
            bouton.html(typeRequete + '<i class="material-icons right">send</i>');

            /* Vérifie que les champs sont bien remplis, puis envoie la requête par AJAX et retourne false pour empêcher
            le bouton d'effectuer un submit du formulaire. */
            formulaire.submit(function () {
                if (valider()) {
                    enregistrer();
                }
                return false;
            })
            break;
        case "Modifier":
            titre.html('Modifier les informations pour ' + unFilm.titre);
            preremplirFormulaire(unFilm);
            bouton.html(typeRequete + '<i class="material-icons right">create</i>');

            /* Vérifie que les champs sont bien remplis, puis envoie la requête par AJAX et retourne false pour empêcher
            le bouton d'effectuer un submit du formulaire */
            formulaire.submit(function () {
                if (valider()) {
                    modifier();
                }
                return false;
            });
            break;
        case "Supprimer":
            titre.html('Supprimer le film ' + unFilm.id + ' ?');
            preremplirFormulaire(unFilm);
            bouton.html(typeRequete + '<i class="material-icons right">delete</i>');

            // Envoie la requête par AJAX et retourne false pour empêcher le bouton d'effectuer un submit du formulaire
            formulaire.submit(function () {
                supprimer();
                return false;
            });
            break;
        default:
            message("Un problème est survenu. Veuillez réessayer plus tard.");
    }

    // Initialisation du style MaterializeCSS sur le datepicker
    $('.datepicker').datepicker({
        editable: true,
        yearRange: 100,
        setDefaultDate: true,
        format: 'yyyy-mm-dd',
        i18n: {
            months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"]
        }
    });

    // Réinitialiser l'affichage du framework MaterializeCSS
    M.updateTextFields();
    $('select').formSelect();
}

/**
 * Affiche des informations obtenues de la base de données dans les cases du formulaires.
 * @param unFilm    Objet de la classe Film.js
 */
const preremplirFormulaire = function (unFilm) {
    $('#previewUpload').attr("src", "images/" + unFilm.image);
    $('#formIdFilm').attr("value", unFilm.id);
    $('#formTitre').attr("value", unFilm.titre);
    $('#formSortie').attr("value", unFilm.sortie);

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
}

/**
 * Affiche un message en rouge dans la zone dédiée. Effectue un reload après 5 secondes pour éviter des problèmes
 * avec le cache des images dans l'affichage des listes.
 *
 * @param texte    Message en String à faire afficher
 */
const message = function (texte) {

    cacherTout();
    $('#accueil').show();

    let zoneMessage = $('#zoneMessage');

    zoneMessage.html(texte);
    zoneMessage.show();

    setTimeout(function () {
        zoneMessage.html("");
        // Reload pour éviter des problèmes avec le cache des images dans l'affichage des listes
        location.reload();
    }, 5000);
}

/**
 * Cache toutes les sections de la page sauf la navbar.
 */
const cacherTout = function () {
    $('#accueil').hide();
    $('#carouselFilms').hide();
    $('#divAdmin').hide();
    $('#divFormulaire').hide();
    $('#zoneMessage').hide();
}


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

    let titre = document.getElementById('formTitre').value;
    let nom = document.getElementById('formNom').value;
    let duree = document.getElementById('formDuree').value;
    let prix = document.getElementById('formPrix').value;

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
