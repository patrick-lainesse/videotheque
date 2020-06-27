<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Fonction qui reçoit les données du formulaire formAjoutMembre et qui ajoute un membre à la base de données.
Si l'ajout est réussi, le membre est alors connecté automatiquement.
-->
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

$message = urlencode("Votre compte a été créé avec succès. Veuillez vous connecter.");
header('location:../../index.php?Message=' . $message);
?>
