/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 13/07/2020

Fonctions JavaScript qui relient le html aux requêtes faites au serveur par AJAX.
Utilisent FormData pour récupérer les données du formulaire de la page index, puis y ajoute l'attribut route pour
informer le contrôleur PHP du type de requête qui est envoyé.
Au retour de la réponse, redirige vers vue.js pour afficher les résultats à l'utilisateur. */

/**
 * Effectue une requête au serveur pour ajouter un nouveau film à la base de données.
 */
const enregistrer = function () {
    let formulaire = document.getElementById('formulaire');
    let formFilm = new FormData(formulaire);
    formFilm.append('route', 'enregistrer');
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
        fail: function (erreur) {
            message(erreur.message);
        }
    });
}

/**
 * Effectue une requête au serveur pour obtenir la liste de tous les films de la base de données.
 */
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
            vue(reponse);
        },
        fail: function (erreur) {
            message(erreur.message);
        }
    });
}

/**
 * Effectue une requête au serveur pour obtenir la liste des films correspondant à la catégorie sélectionnée.
 * @param categorie     Catégorie sélectionnée par l'utilisateur
 */
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
        fail: function (erreur) {
            message(erreur.message);
        }
    });
}

/**
 * Effectue une requête pour obtenir la liste de tous les films de la base de données et les faire afficher
 * avec des options d'administration (ajouter, supprimer, modifier).
 */
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
        fail: function (erreur) {
            message(erreur.message);
        }
    });
}

/**
 * Effectue une requête au serveur pour obtenir la liste des films de la base de données classée par date de sortie.
 */
const listerNouveautes = function () {
    let formFilm = new FormData();
    formFilm.append('route', 'listerNouveautes');
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
        fail: function (erreur) {
            message(erreur.message);
        }
    });
}

/**
 * Effectue une requête pour modifier un film dans la base de données.
 */
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
            vue(reponse);
        },
        fail: function (erreur) {
            message(erreur.message);
        }
    });
}

/**
 * Effectue une requête pour supprimer un film de la base de données.
 */
const supprimer = function () {
    //let formulaire = $('#formulaire');
    let formulaire = document.getElementById('formulaire');
    let formFilm = new FormData(formulaire);
    formFilm.append('route', 'supprimer');
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
        fail: function (erreur) {
            message(erreur.message);
        }
    });
}