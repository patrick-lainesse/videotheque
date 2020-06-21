<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;

function seConnecter()
{
    global $connexion;
    $courriel = $_POST['courriel'];
    $mdp = $_POST['mdp'];
    $requete = 'SELECT membres.idMembre, membres.courriel, connexion.mdp, connexion.role FROM membres INNER JOIN connexion ON membres.idMembre = connexion.idMembre WHERE membres.courriel=? AND connexion.mdp=?';

    try {
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("ss", $courriel, $mdp);
        $stmt->execute();
        $reponse = $stmt->get_result();

        if (!$ligne = $reponse->fetch_object()) {
            echo 'Mot de passe ou courriel erroné.<br>';
        } else {
            // s'affichera dans le header
            $_SESSION['usager'] = $courriel;
            // définiera les actions que pourra effectuer l'usager
            $_SESSION['role'] = $ligne->role;
            // pour faire des ajouts/suppresions dans le panier
            $_SESSION['idMembre'] = $ligne->idMembre;

            if ($ligne->role == 'admin') {
                Header("location:admin.php?membre=.$courriel");
            } else {
                Header("location:panier.php?membre=.$courriel");
            }
        }
    } catch (Exception $e) {
        echo 'Erreur de connexion au serveur, veuillez réessayer plus tard.';
        Header("location:../index.php");
    }
}

seConnecter();

include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";
