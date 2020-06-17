<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;

function seConnecter()
{
    global $connexion;
    $courriel = $_POST['courriel'];
    $mdp = $_POST['mdp'];

    $requete = 'SELECT membres.courriel, connexion.mdp, connexion.role FROM membres INNER JOIN connexion ON membres.idMembre = connexion.idMembre WHERE membres.courriel=? AND connexion.mdp=?';
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("ss", $courriel, $mdp);
    $stmt->execute();
    $reponse = $stmt->get_result();

    if (!$ligne = $reponse->fetch_object()) {
        echo 'Mot de passe ou courriel erroné.<br>';
    } else {
        $_SESSION['usager'] = $courriel;

        if ($ligne->role == 'admin') {
            echo 'Admin';
        } else {
            echo 'Membre';
        }
    }
}

seConnecter();

include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";
