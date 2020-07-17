<?php
require_once("../includes/modele.inc.php");
$tabRes = array();  // TODO: renommer

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
    global $tabRes;
    $tabRes['route'] = "lister";
    $requete = "SELECT * FROM films";
    try {
        $modele = new Modele($requete, array());
        $stmt = $modele->executer();
        $tabRes['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tabRes['listeFilms'][] = $ligne;
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
    global $tabRes;
    $tabRes['route'] = "listerCategorie";
    $categorie = $_POST['categorie'];

    try {
        $requete = "SELECT * FROM films WHERE categorie=?";
        $modele = new Modele($requete, array($categorie));
        $stmt = $modele->executer();
        $tabRes['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tabRes['listeFilms'][] = $ligne;
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
    global $tabRes;
    $tabRes['route'] = "listerAdmin";

    try {
        $requete = 'SELECT id, titre, realisateur, categorie, duree, prix, image, youtube from films';
        $modele = new Modele($requete, array());
        $stmt = $modele->executer();
        $tabRes['listeFilms'] = array();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tabRes['listeFilms'][] = $ligne;
            // La case vide signifie ajouter à la fin du tableau.
        }
    } catch (Exception $e) {
        // TODO
    } finally {
        unset($modele);
    }
}

echo json_encode($tabRes);
/*$test = array(
    'employees' => array(
        array('firstName' => 'John', 'lastName' => 'Doe'),
        array('firstName' => 'Claude', 'lastName' => 'DoClaire')
    )
);

echo json_encode($test);*/