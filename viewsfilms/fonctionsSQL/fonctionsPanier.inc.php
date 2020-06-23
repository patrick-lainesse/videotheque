<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Requêtes qui s'appliquent au panier des membres.

Notes:
La fonction Le stmt->close() effectue également un free_result:
https://stackoverflow.com/questions/19531195/stmt-close-vs-stmt-free-result
-->
<?php
$chemin = $_SERVER['DOCUMENT_ROOT'] . '/videotheque/bd/connexion.inc.php';
require_once $chemin;

// TODO: enlever header ici???

// S'asssurer que seuls les membres connectés accèdent à ces fonctions
if (!isset($_SESSION['usager']) || $_SESSION['role'] != 'membre') {
    $message = urlencode("Vous devez être connecté en tant que membre pour accéder à cette page.");
    header('location:../index.php?Message=' . $message);
}

// Récupérer la fonction qui est désirée
$fonction = $_POST['fonction'];

switch ($fonction) {

    case 'supprimerFilmPanier':
        supprimerFilmPanier($_POST['idMembre'], $_POST['idFilm']);
        break;
    case 'ajoutFilmPanier':
        ajoutFilmPanier($_POST['idMembre'], $_POST['idFilm'], $_POST['quantite']);
        break;
    default:
        $message = urlencode("Problème côté serveur à effectuer la requête désirée.");
        header('location:../index.php?Message=' . $message);
}

/**
 * Ajoute le nombre de films passé en paramètre dans la table panier pour l'usager
 *
 * @param $idMembre
 * @param $idFilm
 * @param $quantite
 * @requires $idMembre, $idFilm et $quantite sont des Number
 * @returns redirige vers la liste de films
 */
function ajoutFilmPanier($idMembre, $idFilm, $quantite)
{
    global $connexion;

    // Vérifier si ce filmID est déjà dans le panier
    $requete = 'SELECT * FROM panier WHERE idMembre=? AND idFilm=?';
    try {
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("ii", $idMembre, $idFilm);
        $stmt->execute();
        $resultat = $stmt->get_result();
        $filmDejaLa = $resultat->fetch_array(MYSQLI_ASSOC);
    } catch (Exception $e) {
        $message = urlencode("Erreur lors de l'ajout à votre panier d'achats.");
        header('location:../index.php?Message=' . $message);
    } finally {
        $message = urlencode($filmDejaLa['idFilm']);
        header('location:../../index.php?Message=' . $message);
        $stmt->close();
    }

    // TODO: ne pas afficher / exécuter la requête si dépasse la qté max
    // Insérer les films ou mettre à jour la quantité dans le panier de l'usager
    try {
        if ($filmDejaLa['quantite'] > 0) {
            $requete = 'UPDATE panier SET quantite=? WHERE idPanier=?';
            $stmt = $connexion->prepare($requete);
            $quantite += $filmDejaLa['quantite'];
            $idPanier = $filmDejaLa['idPanier'];
            $stmt->bind_param("ii", $quantite, $idPanier);
        } else {
            $requete = 'INSERT INTO panier (idPanier, quantite, idMembre, idFilm) VALUES (0,?,?,?)';
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("iii", $quantite, $idMembre, $idFilm);
        }
        $stmt->execute();
    } catch (Exception $e) {
        $message = urlencode("Erreur lors de l'ajout à votre panier d'achats.");
        header('location:../index.php?Message=' . $message);
    } finally {
        $stmt->close();
        header('location: ../lister.php');
    }
}

/**
 * Supprime l'entrée correspondant aux paramètres dans la table panier de la base de données
 *
 * @param $idMembre (int)
 * @param $idFilm (int)
 * @requires $idMembre et $idFilm sont des Number
 * @returns redirige vers le panier
 */
function supprimerFilmPanier($idMembre, $idFilm)
{
    global $connexion;

    $requete = 'DELETE from panier WHERE idMembre=? AND idFilm=?';
    try {
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("ii", $idMembre, $idFilm);
        $stmt->execute();
    } catch (Exception $e) {
        $message = urlencode("Erreur lors de la suppresion du film de votre panier d'achats.");
        header('location:../index.php?Message=' . $message);
    } finally {
        mysqli_close($connexion);
        header('location: ../panier.php');
    }
}