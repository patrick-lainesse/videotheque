<?php
/*
Nom: Patrick Lainesse
Matricule: 740302
Date: 13/07/2020

Code PHP du serveur qui reçoit les requêtes côté client, effectue des requêtes SQL à la base de données et retourne
en format JSON la réponse. Le code reçu contient une variable "route" dans POST qui permet d'identifier la requête
souhaitée. La réponse retournée par le serveur retourne également cette variable "route" pour que la réponse sache comment
générer la vue associée à la réponse.
*/

require_once("../includes/modele.inc.php");
$resultats = array();

$idFilm = 0;
$titre = "";
$sortie = "";
$realisateur = "";
$categorie = "";
$duree = 0;
$prix = 0;
$youtube = "";

const MESSAGE_ERREUR = 'Désolé, un problème côté serveur a empêché votre requête de se compléter. Veuillez réessayer plus tard.';

/**
 * Fonction principale du contrôleur, qui redirige vers la fonction appropriée selon le type de requête.
 */
$route = $_POST['route'];
switch ($route) {
    case "enregistrer":
        enregistrer();
        break;
    case "lister":
        lister();
        break;
    case "listerCategorie":
        listerCategorie();
        break;
    case "listerAdmin":
        listerAdmin();
        break;
    case "listerNouveautes":
        listerNouveautes();
        break;
    case "modifier" :
        modifier();
        break;
    case "supprimer":
        supprimer();
        break;
}

/**
 * Récupère les données transmises par AJAX et ajoute un nouveau film à la base de données.
 */
function enregistrer()
{
    global $resultats;
    recupererForm();

    try {
        // Instance de Modele pour téléverser l'image
        $modele = new Modele();

        $image = $modele->televerserImage("avatar.jpg", $GLOBALS['titre']);
        $requete = "INSERT INTO films VALUES(0,?,?,?,?,?,?,?,?)";

        // Nouvelle instance de Modele pour insérer dans la base de données
        $modele = new Modele($requete, array($GLOBALS['titre'], $GLOBALS['realisateur'], $GLOBALS['categorie'], $GLOBALS['duree'], $GLOBALS['prix'], $image, $GLOBALS['youtube'], $GLOBALS['sortie']));
        $modele->executer();
        $resultats['message'] = "Film bien enregistré.";
        $resultats['route'] = "enregistrer";
    } catch (Exception $e) {
        $resultats['message'] = MESSAGE_ERREUR;
    } finally {
        unset($modele);
    }
}

/**
 * Effectue une requête SQL pour obtenir la liste de tous les films et retourne la réponse en tableau JSON.
 */
function lister()
{
    global $resultats;
    $requete = "SELECT * FROM films";
    try {
        $modele = new Modele($requete, array());
        $stmt = $modele->executer();
        $resultats['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            // La case vide signifie ajouter à la fin du tableau.
            $resultats['listeFilms'][] = $ligne;
        }
        $resultats['route'] = "lister";
    } catch (Exception $e) {
        $resultats['message'] = MESSAGE_ERREUR;
    } finally {
        unset($modele);
    }
}

/**
 * Effectue une requête SQL pour obtenir les films correspondant à une catégorie et retourne la réponse en tableau JSON.
 */
function listerCategorie()
{
    global $resultats;
    $categorie = $_POST['categorie'];

    try {
        $requete = "SELECT * FROM films WHERE categorie=?";
        $modele = new Modele($requete, array($categorie));
        $stmt = $modele->executer();
        $resultats['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            // La case vide signifie ajouter à la fin du tableau.
            $resultats['listeFilms'][] = $ligne;
        }
        $resultats['route'] = "listerCategorie";
    } catch (Exception $e) {
        $resultats['message'] = MESSAGE_ERREUR;
    } finally {
        unset($modele);
    }
}

/**
 * Effectue une requête SQL pour obtenir la liste de tous les films et retourne la réponse en tableau JSON.
 */
function listerAdmin()
{
    global $resultats;

    try {
        $requete = 'SELECT id, titre, realisateur, categorie, duree, prix, image, youtube, sortie from films';
        $modele = new Modele($requete, array());
        $stmt = $modele->executer();
        $resultats['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            // La case vide signifie ajouter à la fin du tableau.
            $resultats['listeFilms'][] = $ligne;
        }
        $resultats['route'] = "listerAdmin";
    } catch (Exception $e) {
        $resultats['message'] = MESSAGE_ERREUR;
    } finally {
        unset($modele);
    }
}

/**
 * Effectue une requête SQL pour obtenir la liste des films en ordre décroissant de date de sortie.
 */
function listerNouveautes()
{
    global $resultats;
    $requete = "SELECT * FROM films ORDER BY sortie DESC ";
    try {
        $modele = new Modele($requete, array());
        $stmt = $modele->executer();
        $resultats['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            // La case vide signifie ajouter à la fin du tableau.
            $resultats['listeFilms'][] = $ligne;
        }
        $resultats['route'] = "lister";
    } catch (Exception $e) {
        $resultats['message'] = MESSAGE_ERREUR;
    } finally {
        unset($modele);
    }
}

/**
 * Récupère les données transmises par AJAX et modifie le film correspondant dans la base de données.
 */
function modifier()
{
    global $resultats;
    recupererForm();

    try {
        // Remplacer l'ancienne image sur le serveur
        $requete = "SELECT image FROM films WHERE id=?";
        $modele = new Modele($requete, array($GLOBALS['idFilm']));
        $stmt = $modele->executer();
        $ligne = $stmt->fetch(PDO::FETCH_OBJ);
        $ancienneImage = $ligne->image;
        $nouvelleImage = $modele->televerserImage($ancienneImage, $GLOBALS['titre']);

        $requete = 'UPDATE films SET titre=?, realisateur=?, categorie=?, duree=?, prix=?, image=?, youtube=?, sortie=? WHERE id=?';
        $modele = new Modele($requete, array($GLOBALS['titre'], $GLOBALS['realisateur'], $GLOBALS['categorie'], $GLOBALS['duree'], $GLOBALS['prix'], $nouvelleImage, $GLOBALS['youtube'], $GLOBALS['sortie'], $GLOBALS['idFilm']));
        $modele->executer();

        $resultats['route'] = "modifier";
        $resultats['message'] = $GLOBALS['titre'] . " bien modifié.";
    } catch (Exception $e) {
        $resultats['message'] = MESSAGE_ERREUR;
    } finally {
        unset($modele);
    }
}

function supprimer()
{
    global $resultats;
    $idFilm = $_POST['formIdFilm'];

    try {
        $requete = "SELECT * FROM films WHERE id=?";
        $modele = new Modele($requete, array($idFilm));
        $stmt = $modele->executer();
        $ligne = $stmt->fetch(PDO::FETCH_OBJ);
        $modele->supprimerImage($ligne->image);
        $requete = 'DELETE FROM films WHERE id=?';
        $modele = new Modele($requete, array($idFilm));
        $modele->executer();
        $resultats['route'] = "supprimer";
        $resultats['message'] = $ligne->titre . ' bien supprimé de la base de données.';
    } catch (Exception $e) {
        $resultats['message'] = MESSAGE_ERREUR;
    } finally {
        unset($modele);
    }
}

function recupererForm()
{

    global $idFilm;
    if (isset($_POST['formIdFilm'])) {
        $idFilm = $_POST['formIdFilm'];
    }
    global $titre;
    $titre = $_POST['formTitre'];
    global $sortie;
    $sortie = $_POST['formSortie'];
    global $realisateur;
    $realisateur = $_POST['formPrenom'] . ' ' . $_POST['formNom'];
    global $categorie;
    $categorie = $_POST['formCategorie'];
    global $duree;
    $duree = $_POST['formDuree'];
    global $prix;
    $prix = $_POST['formPrix'];
    global $youtube;
    $youtube = $_POST['formHashYT'];
}

echo json_encode($resultats);