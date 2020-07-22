<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 21/07/2020

Classe qui permet d'instancier des objets films et ses attributs par des formulaires.
// TODO: manque un constructeur
-->
<?php

class Film
{
    private $id;
    private $titre;
    private $realisateur;
    private $categorie;
    private $sortie;
    private $duree;
    private $prix;
    private $image;
    private $youtube;

    const TABLEAU_CATEGORIES = array("Action", "Animation", "Comédie", "Drame", "Horreur", "Romance", "Science-fiction");

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getRealisateur()
    {
        return $this->realisateur;
    }

    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function getSortie()
    {
        return $this->sortie;
    }

    public function setSortie($sortie)
    {
        $this->sortie = $sortie;
    }

    public function getDuree()
    {
        return $this->duree;
    }

    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getYoutube()
    {
        return $this->youtube;
    }

    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;
    }

}