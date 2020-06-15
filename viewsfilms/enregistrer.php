<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;

// peut être soit update ou enregistrer
$typeForm = $_POST['typeForm'];

$titre = $_POST['titre'];
$realisateur = $_POST['prenom'] . " " . $_POST['nom'];
$categorie = $_POST['categorie'];
$duree = $_POST['duree'];
$prix = $_POST['prix'];
$popularite = 0;
$hashYT = $_POST['hashYT'];
$dossier = "../images/";        // s'assurer que le dossier qui recevra les images a 777 comme permissions
$nomPochette = sha1($titre . time());
$pochette = "avatar.jpg";

if ($_FILES['pochette']['tmp_name'] !== "") {
    //Upload de la photo
    $tmp = $_FILES['pochette']['tmp_name'];
    $fichier = $_FILES['pochette']['name'];
    $extension = strrchr($fichier, '.');
    @move_uploaded_file($tmp, $dossier . $nomPochette . $extension);
    // Enlever le fichier temporaire chargé
    @unlink($tmp); //effacer le fichier temporaire
    $pochette = $nomPochette . $extension;
}
//id	titre	realisateur	categorie	duree	prix	popularite	image	youtube
// tester valeurs par défaut, popularité diff et messages d'erreur pour le chmod != 777     ???
$requete = "INSERT INTO films (id, titre, realisateur, categorie, duree, prix, popularite, image, youtube) VALUES (0,?,?,?,?,?,?,?,?)";

$stmt = $connexion->prepare($requete);
$stmt->bind_param("sssidiss", $titre, $realisateur, $categorie, $duree, $prix, $popularite, $pochette, $hashYT);
$stmt->execute();
echo "<p>Film " . $connexion->insert_id . " bien enregistré. " . $nomPochette . "</p>"; // ??? enlever nomPochette
mysqli_close($connexion);
?>
<br><br>
<a href="lister.php">Retour à la page d'accueil</a><!--à changer???-->

