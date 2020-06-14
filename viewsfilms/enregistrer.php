<?php
include "header.html";
require_once("../bd/connexion.inc.php");
$titre = $_POST['titre'];
$realisateur = $_POST['prenom'] . " " . $_POST['nom'];
$categorie = $_POST['categorie'];
$duree = $_POST['duree'];
$prix = $_POST['prix'];
$popularite = 0;
$hashYT = $_POST['hashYT'];
$dossier = "../images/";
$nomPochette = sha1($titre.time());
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
//INSERT INTO `films` (`id`, `titre`, `realisateur`, `categorie`, `duree`, `prix`, `popularite`, `image`, `youtube`) VALUES ('0', 'Lost in Translation', 'Sofia Coppola', 'Romance', '102', '10.99', '0', 'avatar.jpg', 'W6iVPCRflQM');
$requete = "INSERT INTO films (id, titre, realisateur, categorie, duree, prix, popularite, image, youtube) VALUES (0,?,?,?,?,?,?,?,?)";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("sssidiss", $titre,$realisateur, $categorie, $duree, $prix, $popularite, $pochette, $hashYT);
$stmt->execute();
echo "Film ".$connexion->insert_id." bien enregistré.";
mysqli_close($connexion);
?>
<br><br>
<a href="lister.php">Retour à la page d'accueil</a><!--à changer???-->

