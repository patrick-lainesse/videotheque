<?php
require_once("../includes/modele.inc.php");
$resultats = array();

const MESSAGE_ERREUR = 'Désolé, un problème côté serveur a empêché votre requête de se compléter. Veuillez réessayer plus tard.';

/**
 * Fonction principale du contrôleur, qui redirige vers la fonction appropriée selon le type de requête.
 */
$route = $_POST['route'];
switch ($route) {
    case "enregistrer" :
        enregistrer();
        break;
    case "lister" :
        lister();
        break;
    case "listerCategorie" :
        listerCategorie();
        break;
    case "listerAdmin":
        listerAdmin();
        break;
    case "modifier" :
        modifier();
        break;
    case "supprimer" :
        supprimer();
        break;
}

/**
 * Récupère les données transmises par AJAX et ajoute un nouveau film à la base de données.
 */
function enregistrer()
{
    global $resultats;

    $titre = $_POST['formTitre'];
    $sortie = $_POST['formSortie'];
    $realisateur = $_POST['formPrenom'] . ' ' . $_POST['formNom'];
    $categorie = $_POST['formCategorie'];
    $duree = $_POST['formDuree'];
    $prix = $_POST['formPrix'];
    $youtube = $_POST['formHashYT'];

    try {
        // Instance de Modele pour téléverser l'image
        $modele = new Modele();

        $image = $modele->televerserImage("avatar.jpg", $titre);
        $requete = "INSERT INTO films VALUES(0,?,?,?,?,?,?,?,?)";

        // Nouvelle instance de Modele pour insérer dans la base de données
        $modele = new Modele($requete, array($titre, $realisateur, $categorie, $duree, $prix, $image, $youtube, $sortie));
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

// TODO: semble avoir un problème avec le nom d'image, remplacé par avatar même si non souhaité
/**
 * Récupère les données transmises par AJAX et modifie le film correspondant dans la base de données.
 */
function modifier()
{
    global $resultats;
    $idFilm = $_POST['formIdFilm'];
    $titre = $_POST['formTitre'];
    $sortie = $_POST['formSortie'];
    $realisateur = $_POST['formPrenom'] . ' ' . $_POST['formNom'];
    $categorie = $_POST['formCategorie'];
    $duree = $_POST['formDuree'];
    $prix = $_POST['formPrix'];
    $youtube = $_POST['formHashYT'];

    try {
        // Remplacer l'ancienne image sur le serveur
        $requete = "SELECT image FROM films WHERE id=?";
        $modele = new Modele($requete, array($idFilm));
        $stmt = $modele->executer();
        $ligne = $stmt->fetch(PDO::FETCH_OBJ);
        $ancienneImage = $ligne->image;
        $image = $modele->televerserImage($ancienneImage, $titre);

        $requete = 'UPDATE films SET titre=?, realisateur=?, categorie=?, duree=?, prix=?, image=?, youtube=?, sortie=? WHERE id=?';
        $modele = new Modele($requete, array($titre, $realisateur, $categorie, $duree, $prix, $image, $youtube, $sortie, $idFilm));
        $modele->executer();
        $resultats['route'] = "modifier";
        $resultats['message'] = $titre . " bien modifié.";
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

echo json_encode($resultats);