<?php

// Todo: utiliser le mot-clé use pour utiliser cette classe
class Film
{
    private $id;
    private $titre;
    private $realisateur;
    private $categorie;
    private $duree;
    private $prix;
    private $image;
    private $youtube;


    public function boutonDelete()
    {
        //echo '<a class="waves-effect waves-light marginTop10 darken-4 red btn-small"><i class="material-icons left">delete</i>Supprimer</a>';
        echo '<button class="btn-small waves-effect waves-light marginTop10 darken-4 red" type="submit" name="action" value="supprimer">Supprimer';
        echo '<i class="material-icons right">delete</i>';
        echo '</button>';
    }

    public function boutonModifier()
    {
        //echo '<a class="waves-effect waves-light darken-4 green btn-small"><i class="material-icons left">create</i>Modifier</a>';
        echo '<button class="btn-small waves-effect waves-light darken-4 green" type="submit" name="action" value="modifier">Modifier';
        echo '<i class="material-icons right">create</i>';
        echo '</button>';
    }

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