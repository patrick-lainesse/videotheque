<?php
require_once("connexion.inc.php");

class Modele
{
    private $requete;
    private $params;    // Tableau des paramètres à injecter dans la requête SQL par bind_params
    private $connexion;

    /**
     * Constructeur avec valeurs par défaut à null
     * @param String $requete        Requête SQL à faire exécuter au serveur de base de données
     * @param [] $params             Tableau de paramètres à injecter dans la requête SQL
     */
    function __construct($requete = null, $params = null)
    {
        $this->requete = $requete;
        $this->params = $params;
    }

    /**
     * Obtient la connexion au serveur SQL nécessaire pour effectuer une requête.
     */
    function connexionSQL()
    {
        // TODO: À modifier pour installer sur un serveur réel
        $maConnexion = new Connexion("localhost", "root", "", "bdfilms");
        $maConnexion->connecter();
        return $maConnexion->getConnexion();
    }

    function deconnecter()
    {
        unset($this->connexion);
    }

    /**
     * Associe les paramètres à la requête et l'exécute.
     */
    function executer()
    {
        $this->connexion = $this->connexionSQL();
        $stmt = $this->connexion->prepare($this->requete);
        $stmt->execute($this->params);
        $this->deconnecter();
        return $stmt;
    }


    /**
     * Renomme le fichier image téléversé par l'utilisateur et le déplace dans le dossier serveur. Fait appel à
     * supprimerImage si une affiche était déjà associée à ce film.
     * @param String $ancienneImage        Nom du fichier de l'ancienne image à supprimer
     * @param String $titreFilm            Titre du film du fichier téléversé par l'utilisateur
     * @return String $nouvelleImage       Nom généré pour la nouvelle image
     */
    function televerserImage($ancienneImage, $titreFilm)
    {
        $cheminDossier = "../images/";
        $nomGenere = sha1($titreFilm . time());
        $nouvelleImage = "avatar.jpg";

        // Si un fichier a été téléversé, remplacer l'image associée au film par celle téléversée
        if ($_FILES["formImage"]['tmp_name'] !== "") {

            // Téléverser temporairement la nouvelle image
            $tmp = $_FILES["formImage"]['tmp_name'];
            $fichierVerse = $_FILES["formImage"]['name'];
            $extension = strrchr($fichierVerse, '.');
            @move_uploaded_file($tmp, $cheminDossier . $nomGenere . $extension);

            // Enlever le fichier temporaire chargé
            @unlink($tmp); //effacer le fichier temporaire

            // Enlever l'ancienne affiche dans le cas de la fonction modifier()
            $this->supprimerImage($ancienneImage);
            $nouvelleImage = $nomGenere . $extension;
        }
        return $nouvelleImage;
    }

    /**
     * Parcourt le dossier images/ du serveur pour éliminer l'ancienne image associée à un film.
     * @param String $ancienneImage      Nom du fichier de l'ancienne image à supprimer.
     */
    function supprimerImage($ancienneImage)
    {
        if ($ancienneImage != "avatar.jpg") {
            $rmPoc = '../images/' . $ancienneImage;
            $tableauImages = glob('../images/*');

            // Parcourir les images jusqu'à ce qu'on trouve l'ancienne image
            foreach ($tableauImages as $fichier) {
                if (is_file($fichier) && $fichier == trim($rmPoc)) {
                    // Supprimer le fichier
                    unlink($fichier);
                    break;
                }
            }
        }
    }
}