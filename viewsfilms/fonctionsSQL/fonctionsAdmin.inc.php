<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Code qui reçoit les données des formulaires pour modifier, supprimer ou ajouter un film à la base
de données, et effectue les requêtes à la base de données.
-->
<?php
require_once '../../bd/connexion.inc.php';

// Identifier s'il doit s'agir d'une requête update ou enregistrer
$typeForm = $_POST['typeForm'];

// Récupération des variables passées par POST
$titre = $_POST['titre'];
$realisateur = $_POST['prenom'] . " " . $_POST['nom'];
$categorie = $_POST['categorie'];
$duree = $_POST['duree'];
$prix = $_POST['prix'];
$hashYT = $_POST['hashYT'];
$dossier = "../../images/";        // Le dossier images doit avoir 777 comme permissions


if ($typeForm == "enregistrer") {
    $pochette = "avatar.jpg";
} elseif ($typeForm == "update" || $typeForm == 'effacer') {

    // $idFilm n'est passé que dans le cas d'un update ou d'un delete
    $idFilm = $_POST['idFilm'];
    // Récupérer une référence sur l'image associée au film dans le cas d'un update ou delete
    try {
        $requete = "SELECT image FROM films WHERE id=?";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("i", $idFilm);
        $stmt->execute();
        $result = $stmt->get_result();
        $ligne = $result->fetch_object();
        $pochette = $ligne->image;
    } catch (Exception $e) {
        $message = urlencode("Erreur lors de la recherche du film dans la base de données.");
        header('location:../../index.php?Message=' . $message);
    } finally {
        $stmt->close();
    }
}

// Gestion du fichier image sur le serveur
if ($typeForm == "update" || $typeForm == "effacer") {
    if ($pochette != "avatar.jpg") {
        $rmPoc = '../../images/' . $pochette;
        $tabFichiers = glob('../../images/*');

        // Parcourir les images jusqu'à ce qu'on trouve l'ancienne image
        foreach ($tabFichiers as $fichier) {
            if (is_file($fichier) && $fichier == trim($rmPoc)) {
                // Enlever le fichier
                unlink($fichier);
                break;
            }
        }
    }
}

$nomPochette = sha1($titre . time());

// Déplacer la photo dans le serveur
$tmp = $_FILES['pochette']['tmp_name'];
$fichier = $_FILES['pochette']['name'];
$extension = strrchr($fichier, '.');

@move_uploaded_file($tmp, $dossier . $nomPochette . $extension);
@unlink($tmp);  // Enlever du serveur le fichier temporaire chargé
$pochette = $nomPochette . $extension;


// Efectuer la requête SQL pour modifier la base de données
if ($typeForm == 'enregistrer') {
    $requete = 'INSERT INTO films (id, titre, realisateur, categorie, duree, prix, image, youtube) VALUES (0,?,?,?,?,?,?,?)';
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("sssidss", $titre, $realisateur, $categorie, $duree, $prix, $pochette, $hashYT);
} elseif ($typeForm == 'update') {
    $requete = 'UPDATE films SET titre=?, realisateur=?, categorie=?, duree=?, prix=?, image=?, youtube=? WHERE id=?';
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("sssidssi", $titre, $realisateur, $categorie, $duree, $prix, $pochette, $hashYT, $idFilm);
} elseif ($typeForm == 'effacer') {
    $requete = 'DELETE from films where id=?';
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("i", $idFilm);
}

$stmt->execute();
$stmt->close();
mysqli_close($connexion);
header('location:../admin.php');

