<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;
// il faut rendre inaccessible lorsque non connecté comme admin???
?>
<div class="row margin50" id="divEffacer">
    <!--onSubmit="return validerNum('numF');" ??? à faire-->
    <form class="col s8 offset-s3" id="formEffacer" action="../formUpdate.php" method="POST">
        <input type="hidden" id="typeForm" name="typeForm" value="effacer">
        <h5>Entrez l'identifiant du film à effacer de la base de données</h5><br><br>
        <span onClick="rendreInvisible('divUpdate')">X</span><br><!--à faire ???-->
        <div class="row">
            <div class="input-field col s6">
                <input type="number" id="idFilmEffacer" name="idFilm" class="validate noWebkit"><br>
                <label for="idFilmEffacer">Numéro du film</label>
            </div>
        </div>
        <!--à faire: requête php pour validation du num du film pour afficher le titre du film, ainsi que validation input number ???-->
        <!--<input type="submit" value="Envoyer"><br>-->
        <div class="row">
            <button class="btn waves-effect red darken-4" type="submit" name="envoyer">Envoyer
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";