<?php
require_once("../includes/modele.inc.php");
$resultats = array();

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

// TODO: utiliser JSON object p
/**
 * Récupère les données transmises par AJAX et ajoute un nouveau film à la base de données.
 */
function enregistrer()
{
    global $resultats;
    $resultats['route'] = "enregistrer";

    $titre = $_POST['formTitre'];
    $sortie = $_POST['formSortie'];
    $realisateur = $_POST['formPrenom'] . ' ' . $_POST['formNom'];
    $categorie = $_POST['formCategorie'];
    $duree = $_POST['formDuree'];
    $prix = $_POST['formPrix'];
    // Todo: image nécessaire?
    //$image = $_POST['formImage'];
    $youtube = $_POST['formHashYT'];

    try {
        // Instance de Modele pour téléverser l'image
        $modele = new Modele();
        $image = $modele->televerserImage("avatar.jpg", $titre);
        $requete = "INSERT INTO films VALUES(0,?,?,?,?,?,?,?,?)";

        // Nouvelle instance de Modele pour insérer dans la base de données
        $modele = new Modele($requete, array($titre, $realisateur, $categorie, $duree, $prix, $image, $youtube, $sortie));
        $stmt = $modele->executer();
        $resultats['message'] = "Film bien enregistré."; //TODO: dans exception, message d'erreur
    } catch (Exception $e) {
        // TODO message erreur enregistrer
    } finally {
        unset($modele);
    }
}

/**
 * Effectue une requête SQL pour obtenir la liste de tous les films et retourne la réponse en tableau JSON.
 */
function lister()
{
    // TODO: test
    global $resultats;
    $resultats['route'] = "lister";
    $requete = "SELECT * FROM films";
    try {
        $modele = new Modele($requete, array());
        $stmt = $modele->executer();
        $resultats['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $resultats['listeFilms'][] = $ligne;
            // La case vide signifie ajouter à la fin du tableau.
        }
    } catch (Exception $e) {
        // TODO
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
    $resultats['route'] = "listerCategorie";
    $categorie = $_POST['categorie'];

    try {
        $requete = "SELECT * FROM films WHERE categorie=?";
        $modele = new Modele($requete, array($categorie));
        $stmt = $modele->executer();
        $resultats['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $resultats['listeFilms'][] = $ligne;
            // La case vide signifie ajouter à la fin du tableau.
        }
    } catch (Exception $e) {
        // TODO
    } finally {
        unset($modele);
    }
}

// TODO: pareil que lister()!
/**
 * Effectue une requête SQL pour obtenir la liste de tous les films et retourne la réponse en tableau JSON.
 */
function listerAdmin()
{
    global $resultats;
    $resultats['route'] = "listerAdmin";

    try {
        $requete = 'SELECT id, titre, realisateur, categorie, duree, prix, image, youtube, sortie from films';
        $modele = new Modele($requete, array());
        $stmt = $modele->executer();
        $resultats['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            // La case vide signifie ajouter à la fin du tableau.
            $resultats['listeFilms'][] = $ligne;
        }
    } catch (Exception $e) {
        // TODO message erreur admin
    } finally {
        unset($modele);
    }
}

/**
 * Récupère les données transmises par AJAX et modifie le film correspondant dans la base de données.
 */
function modifier()
{
    // TODO: Utiliser classe pour récupérer plus facilment
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
        //TODO: section messages
        $resultats['message'] = $titre . " bien modifié.";
    } catch (Exception $e) {
        // TODO msg erreur
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
        //if ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
        $ligne = $stmt->fetch(PDO::FETCH_OBJ);
        $modele->supprimerImage($ligne->image);
        $requete = 'DELETE FROM films WHERE id=?';
        $modele = new Modele($requete, array($idFilm));
        $modele->executer();
        // TODO: la route utilisée au retour??
        $resultats['route'] = "supprimer";
        $resultats['message'] = $ligne->titre . ' bien supprimé de la base de données.';
        /*} else {
            // TODO constante message erreur
            $resultats['message'] = "Un problème est survenu lors de l'exécution de la requête.";
        }*/
    } catch (Exception $e) {
        // TODO: gestion messages d'erreur
        $resultats['message'] = 'Une erreur est survenue lors de la requête.';
    } finally {
        unset($modele);
    }
}

echo json_encode($resultats);