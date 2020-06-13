<?php
include "header.html";
require_once("../bd/connexion.inc.php");
$reponse = "<div class=\"carousel film\">";
$requete = "SELECT * FROM films";
try {
    $listeFilms = mysqli_query($connexion, $requete);
    while ($ligne = mysqli_fetch_object($listeFilms)) {
        $reponse .= "<div class=\"carousel-item film\">";
        $reponse .= "<div class=\"card\">";
        $reponse .= "<div class=\"card-image\">";
        $reponse .= "<img src=\"../images/" . ($ligne->image) . "\" data-target=\"modal1\" class=\"modal-trigger\" onclick=\"chargerModal();\">";
        $reponse .= "</div>";
        $reponse .= "<div class=\"card-content\">";
        $reponse .= "<p class='gras'>" . ($ligne->titre) . "</p>" . ($ligne->realisateur) . "<br>" . ($ligne->categorie) . "<br>" . ($ligne->prix) . "$";
        $reponse .= "</div>";
        $reponse .= "</div>";
        $reponse .= "</div>";
    }
    mysqli_free_result($listeFilms);
} catch (Exception $e) {
    echo "Problème de lecture dans la base de données.";
} finally {
    $reponse .= "</div>";
    /*$reponse .= "<div id='previewYT'></div>";*/


    $reponse .= "<div id=\"modal1\" class=\"modal center\">";
    $reponse .= "<div class=\"modal-content\">";
    $reponse .= "<h4 id='test2'>Modal Header</h4>";
    $reponse .= "<iframe src=\"https://www.youtube.com/embed/nTfqKG--JwQ\" width=\"560\" height=\"315\" frameborder=\"0\" allowfullscreen></iframe>";
    $reponse .= "</div>";
    $reponse .= "<div class=\"modal-footer\">";
    $reponse .= "<a href=\"#\" class=\"modal-close waves-effect waves-green btn-flat\">Agree</a>";
    $reponse .= "</div>";
    $reponse .= "</div>";
    echo $reponse;
}
mysqli_close($connexion);

/*          <div class="card-action">
                <a href="#">This is a link</a>
            </div>
        </div>
    </div>*/
?>
<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>
</body>
</html>