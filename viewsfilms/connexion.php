<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Code qui reçoit les données du formulaire formConnexion et qui vérifie si le mot de passe correspond
à l'adresse courriel. Si oui, l'usager est redirigé soit vers son panier, soit vers la page d'admin.
Sinon, il est retourné à la page d'accueil.
-->
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
                header("location:admin.php?membre=.$courriel");
            } else {
                header("location:panier.php?membre=.$courriel");
            }
        }
    } catch (Exception $e) {
        $message = urlencode("Erreur de connexion au serveur, veuillez réessayer plus tard.");
        header("location:../index.php?Message=' . $message");
    }
}

seConnecter();

include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";
