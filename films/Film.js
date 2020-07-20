/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 16/07/2020

Film.js
Classe qui permet d'instancier des objets films en JavaScript à partir des tableaux json pour faciliter l'utilisation
des films à travers le code.*/

class Film {

    constructor({id, titre, realisateur, categorie, sortie, duree, prix, image, youtube} = []) {
        this.id = id;
        this.titre = titre;
        this.realisateur = realisateur;
        this.categorie = categorie;
        this.sortie = sortie;
        this.duree = duree;
        this.prix = prix;
        this.image = image;
        this.youtube = youtube;
    }

}