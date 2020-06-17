<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;

// peut être soit update ou enregistrer
$typeForm = $_POST['typeForm'];

$idFilm = $_POST['idFilm'];
$titre = $_POST['titre'];
$realisateur = $_POST['prenom'] . " " . $_POST['nom'];
$categorie = $_POST['categorie'];
$duree = $_POST['duree'];
$prix = $_POST['prix'];

// popularité à intégrer ???
$popularite = 0;
$hashYT = $_POST['hashYT'];
// tester avec path absolu ???
$dossier = "../images/";        // s'assurer que le dossier qui recevra les images a 777 comme permissions

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


    if ($typeForm == "update" || $typeForm == "effacer") {
        // Enlever l'ancienne image si elle a été changée
        if ($pochette != "avatar.jpg" && $pochette != $_POST['image']) {    //quand il y avait pas d'image avant???: Notice: Undefined index: image in /opt/lampp/htdocs/videotheque/viewsfilms/enregistrer.php on line 39
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
//id	titre	realisateur	categorie	duree	prix	popularite	image	youtube
// tester valeurs par défaut, popularité diff et messages d'erreur pour le chmod != 777     ???

if ($typeForm == 'enregistrer') {
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
    // Notice: Undefined variable: nomPochette in /opt/lampp/htdocs/videotheque/viewsfilms/enregistrer.php on line 85
}

//$stmt = $connexion->prepare($requete);
//$stmt->bind_param("sssidiss", $titre, $realisateur, $categorie, $duree, $prix, $popularite, $pochette, $hashYT);
$stmt->execute();
echo "<p>Film " . $connexion->insert_id . " bien enregistré. " . $nomPochette . "</p>"; // ??? enlever nomPochette
// quand laissé field image vide???: Notice: Undefined variable: nomPochette in /opt/lampp/htdocs/videotheque/viewsfilms/enregistrer.php on line 81
mysqli_close($connexion);
?>
<br><br>
<a href="lister.php">Retour à la page d'accueil</a><!--à changer???-->

