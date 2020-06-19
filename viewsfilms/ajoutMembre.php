<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;

$nomMembre = $_POST['prenomMembre'] . " " . $_POST['nomMembre'];
$ddn = $_POST['ddn'];
$courrielMembre = $_POST['courrielMembre'];
$mdpMembre = $_POST['mdpMembre'];

echo $ddn;
$requete = 'INSERT INTO membres (idMembre, courriel, nom, age) VALUES (0,?,?,?)';
$stmt = $connexion->prepare($requete);
$stmt->bind_param("sss", $courrielMembre, $nomMembre, $ddn);
$stmt->execute();

$idMembre = $connexion->insert_id;

$requete = 'INSERT INTO connexion (idConnexion, mdp, role, idMembre) VALUES (0,?,"membre",?)';
$stmt = $connexion->prepare($requete);
$stmt->bind_param("si", $mdpMembre, $idMembre);
$stmt->execute();
mysqli_close($connexion);
?>
<br><br>
<a href="lister.php">Retour à la page d'accueil</a><!--à changer???-->
