<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Formulaire qui s'affiche quand un admin clique sur +Film, pour ajouter un film à la base de données.
-->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/videotheque/viewsfilms/header.php';
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;
?>
<h5 class="white-text center margin50">Ajouter un film à la base de données</h5>
<div class="row margin50">
    <form class="col s6 offset-s3" id="formEnreg" enctype="multipart/form-data" action="../fonctionsSQL/fonctionsAdmin.inc.php" method="POST" onsubmit="return valider()">
        <input type="hidden" id="typeForm" name="typeForm" value="enregistrer">
        <div class="row">
            <div class="input-field col s12">
                <input id="titre" name="titre" type="text" class="validate">
                <label for="titre">Titre du film</label>
            </div>
        </div>
        <h5 class="white-text">Réalisateur</h5>
        <div class="row">
            <div class="input-field col s6">
                <input id="prenom" name="prenom" type="text" class="validate">
                <label for="prenom">Prénom</label>
            </div>
            <div class="input-field col s6">
                <input id="nom" name="nom" type="text" class="validate">
                <label for="nom">Nom</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s4 grey darken-4">
                <select id="categorie" name="categorie">
                    <option value="Action">Action</option>
                    <option value="Animation">Animation</option>
                    <option value="Comédie">Comédie</option>
                    <option value="Drame">Drame</option>
                    <option value="Horreur">Horreur</option>
                    <option value="Romance">Romance</option>
                    <option value="Science-fiction">Science-fiction</option>
                </select>
                <label>Catégorie</label>
            </div>
            <div class="input-field col s4">
                <input id="duree" name="duree" type="number" min="0" step="1" max="700" class="validate">
                <label for="duree">Durée</label>
            </div>
            <div class="input-field col s4">
                <input id="prix" name="prix" type="number" min="0" max="500" step="0.01" class="validate">
                <label for="prix">Prix</label>
            </div>
        </div>
        <!--TODO: mettre un preview de l'image-->
        <div class="row">
            <div class="file-field input-field col s6">
                <div class="btn waves-effect red darken-4">
                    <span>Image</span>
                    <input type="file" id="pochette" name="pochette">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <!--TODO: expliquer hash ou implémenter le youtube api-->
            <div class="input-field col s6">
                <input id="hashYT" name="hashYT" type="text" class="validate">
                <label for="hashYT">Hash YouTube</label>
            </div>
        </div>
        <div class="row">
            <button class="btn waves-effect red darken-4" type="submit" name="action">Enregistrer
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>
