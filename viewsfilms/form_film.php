<?php
include "header.html";
?>
<h2 class="white-text center">Ajouter un film à la base de données</h2>
<div class="row margin50">
    <form class="col s6 offset-s3" id="formEnreg" enctype="multipart/form-data" action="enregistrer.php" method="POST">
        <!--onsubmit="return valider();"???-->
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
        <!--mettre un preview de l'image???-->
        <div class="row">
            <!--<form action="#" class="col s6">???-->
            <div class="file-field input-field col s6">
                <div class="btn">
                    <span>Image</span>
                    <input type="file" id="pochette" name="pochette">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <!--expliquer hash???-->
            <div class="input-field col s6">
                <input id="hashYT" name="hashYT" type="text" class="validate">
                <label for="hashYT">Hash YouTube</label>
            </div>
            <!--</form>-->
        </div>
        <div class="row">
            <button class="btn waves-effect waves-light" type="submit" name="action">Enregistrer
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>

<!--source avatar: https://www.publicdomainpictures.net/en/view-image.php?image=210079&picture=question-mark ???-->
