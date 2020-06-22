<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Formulaire pour saisir les informations des nouveaux membres.
-->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;
?>
<h3 class="white-text center">Entrez vos données personnelles</h3>
<div class="row margin50">
    <form class="col s6 offset-s3" id="formMembre" action="/videotheque/viewsfilms/ajoutMembre.php" method="POST">
        <!--onsubmit="return valider();"???-->
        <div class="row">
            <div class="input-field col s4">
                <input id="prenomMembre" name="prenomMembre" type="text" class="validate">
                <label for="prenomMembre">Prénom</label>
            </div>
            <div class="input-field col s4">
                <input id="nomMembre" name="nomMembre" type="text" class="validate">
                <label for="nomMembre">Nom</label>
            </div>
            <div class="input-field col s4">
                <input type="text" class="datepicker" id="ddn" name="ddn">
                <!--TODO: à faire: changer couleurs et langue dans preview-->
                <label for="ddn">Date de naissance</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="courrielMembre" name="courrielMembre" type="email" class="validate">
                <label for="courrielMembre">Courriel</label>
            </div>
            <div class="input-field col s6">
                <input id="mdpMembre" name="mdpMembre" type="password" class="validate">
                <label for="mdpMembre">Mot de passe</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s5 offset-s1">
                <a href="" class="modal-close waves-effect btn-flat red">Annuler</a><!--à changer???-->
                <a class="modal-close waves-effect btn-flat green" type="submit" onclick="ajoutMembre();">Se connecter</a><!--à changer???-->
            </div>
        </div>
    </form>
</div>
