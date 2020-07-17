<?php
require_once("../includes/modele.inc.php");
$resultats = array();  // TODO: renommer

//Contrôleur    TODO
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
    case "enlever" :
        enlever();
        break;
    case "fiche" :
        fiche();
        break;
    case "modifier" :
        modifier();
        break;
}

// TODO: En-tête des fonctions
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

function listerAdmin()
{
    global $resultats;
    $resultats['route'] = "listerAdmin";

    try {
        $requete = 'SELECT id, titre, realisateur, categorie, duree, prix, image, youtube from films';
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

function modifier()
{
    global $resultats;
    $idFilm = $_POST['formIdFilm'];
    $titre = $_POST['formTitre'];
    $realisateur = $_POST['formPrenom'] . ' ' . $_POST['formNom'];
    $categorie = $_POST['formCategorie'];
    $duree = $_POST['formDuree'];
    $prix = $_POST['formPrix'];
    $titre = $_POST['formIdFilm'];
    //TODO: image controleur -> pochette
    $image = 'avatar.jpg';
    $youtube = $_POST['formHashYT'];

    try {
        //TODO Recuperer ancienne pochette
        /*$requette = "SELECT pochette FROM films WHERE idf=?";
        $unModele = new filmsModele($requette, array($idf));
        $stmt = $unModele->executer();
        $ligne = $stmt->fetch(PDO::FETCH_OBJ);
        $anciennePochette = $ligne->pochette;
        $pochette = $unModele->verserFichier("pochettes", "pochette", $anciennePochette, $titre);*/

        $requete = 'UPDATE films SET titre=?, realisateur=?, categorie=?, duree=?, prix=?, image=?, youtube=? WHERE id=?';
        $modele = new Modele($requete, array($titre, $realisateur, $categorie, $duree, $prix, $image, $youtube, $idFilm));
        // TODO: éléminer la variable stmt
        $stmt = $modele->executer();
        $resultats['route'] = "modifier";
        //TODO: section messages
        $resultats['msg'] = "Film bien modifie";
    } catch (Exception $e) {
        // TODO msg erreur
    } finally {
        unset($modele);
    }
}

echo json_encode($resultats);
/*$test = array(
    'employees' => array(
        array('firstName' => 'John', 'lastName' => 'Doe'),
        array('firstName' => 'Claude', 'lastName' => 'DoClaire')
    )
);

echo json_encode($test);*/