<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Code qui reçoit les données des formulaires pour modifier, supprimer ou ajouter un film à la base
de données, et effectue les requêtes à la base de données.
-->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;

// Peut être soit update ou enregistrer
$typeForm = $_POST['typeForm']; // TODO: changer pour que ce soit la valeur du bouton, 'action'

$idFilm = $_POST['idFilm'];
$titre = $_POST['titre'];
$realisateur = $_POST['prenom'] . " " . $_POST['nom'];
$categorie = $_POST['categorie'];
$duree = $_POST['duree'];
$prix = $_POST['prix'];

// TODO: popularité à éliminer
$popularite = 0;
$hashYT = $_POST['hashYT'];
// TODO: tester avec path absolu
$dossier = "../images/";        // S'assurer que le dossier qui recevra les images a 777 comme permissions

//TODO: implémenter des try-catch
if ($typeForm == "enregistrer") {
    $pochette = "avatar.jpg";
} elseif ($typeForm == "update" || $typeForm == 'effacer') {
    $requete = "SELECT image FROM films WHERE id=?";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("i", $idFilm);
    $stmt->execute();
    $result = $stmt->get_result();
    $ligne = $result->fetch_object();
    $pochette = $ligne->image;
}

if ($_FILES['pochette']['tmp_name'] !== "") {


    // Gestion du fichier image
    if ($typeForm == "update" || $typeForm == "effacer") {
        if ($pochette != "avatar.jpg" && $pochette != $_POST['image']) {    //TODO: quand il y avait pas d'image avant Notice: Undefined index: image in /opt/lampp/htdocs/videotheque/viewsfilms/enregistrer.php on line 39
            $rmPoc = '../images/' . $pochette;
            $tabFichiers = glob('../images/*');

            // Parcourir les images jusqu'à ce qu'on trouve l'ancienne image
            foreach ($tabFichiers as $fichier) {
                if (is_file($fichier) && $fichier == trim($rmPoc)) {
                    // enlever le fichier
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
    @unlink($tmp);  // Enlever le fichier temporaire chargé
    $pochette = $nomPochette . $extension;
}

if ($typeForm == 'enregistrer') {
    // TODO: s'assurer que le film ne s'ajoute pas si le formulaire n'est pas dûment rempli
    $requete = 'INSERT INTO films (id, titre, realisateur, categorie, duree, prix, popularite, image, youtube) VALUES (0,?,?,?,?,?,?,?,?)';
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("sssidiss", $titre, $realisateur, $categorie, $duree, $prix, $popularite, $pochette, $hashYT);
} elseif ($typeForm == 'update') {
    $requete = 'UPDATE films SET titre=?, realisateur=?, categorie=?, duree=?, prix=?, image=?, youtube=? WHERE id=?';
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("sssidssi", $titre, $realisateur, $categorie, $duree, $prix, $pochette, $hashYT, $idFilm);
} elseif ($typeForm == 'effacer') {
    $requete = 'DELETE from films where id=?';
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("i", $idFilm);
    // TODO: Notice: Undefined variable: nomPochette in /opt/lampp/htdocs/videotheque/viewsfilms/enregistrer.php on line 85
}

$stmt->execute();
echo "<p>Film " . $connexion->insert_id . " bien enregistré. " . $nomPochette . "</p>"; // ??? enlever nomPochette
// TODO: quand laissé field image vide: Notice: Undefined variable: nomPochette in /opt/lampp/htdocs/videotheque/viewsfilms/enregistrer.php on line 81
mysqli_close($connexion);
?>
<br><br>
<a href="lister.php">Retour à la page d'accueil</a><!--TODO: à changer-->

