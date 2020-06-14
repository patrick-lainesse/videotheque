<?php
/*require_once("../bd/connexion.inc.php");
$reponse = "";
//$idFilm = $_POST['idFilm'];
$requete = "SELECT * FROM films WHERE id = ?";
$statement = $connexion->prepare($requete);
$i = 4;
$statement->bind_param("i", $i);
$statement->execute();
$resultat = $statement->get_result();

if(!$ligne = $resultat->fetch_object()){
    //echo "Film ".$idFilm." introuvable";       // changer ???
    mysqli_close($connexion);
    exit;
}
$titre = ($ligne->titre);
echo '<script type="text/javascript">remplirModal' . ($ligne->titre) . ';</script>';
//remplirModal(($ligne->titre));
//mysqli_close($connexion);



https://www.youtube.com/embed/nTfqKG--JwQ

*/?>
<div id="modal1" class="modal modalContent">
    <div class="modal-content">
        <h4 id='modalHeader'>Modal Header</h4>
        <iframe src="#" class='iframeYT' id="iframeYT" allowfullscreen></iframe>
    </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-teal btn-flat black white-text">Quitter</a>
    </div>
</div>
