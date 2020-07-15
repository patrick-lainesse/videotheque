<?php
require_once("../includes/modele.inc.php");
$tabRes = array();  // TODO: renommer

//Contrôleur    TODO
$route = $_POST['route'];
switch ($route) {
    case "lister" :
        lister();
        break;
    case "enregistrer" :
        enregistrer();
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
            // case vide signifie ajouter à la fin du tableau
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
);*/

//echo json_encode($test);