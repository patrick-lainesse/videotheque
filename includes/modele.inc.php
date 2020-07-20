<?php
require_once("connexion.inc.php");

class Modele
{
    private $requete;
    private $params;    // paramètres à injecter dans la requête SQL par bind_params TODO: Vraiment?
    private $connexion;

    // Constructeur avec valeurs par défaut à null
    function __construct($requete = null, $params = null)
    {
        $this->requete = $requete;
        $this->params = $params;
    }

    // TODO: Refactor: connexionSQL()
    function obtenirConnexion()
    {
        // TODO: À modifier pour installer sur un serveur réel
        $maConnexion = new Connexion("localhost", "root", "", "bdfilms");
        $maConnexion->connecter();
        return $maConnexion->getConnexion();
    }

    // TODO: Refactor: associerParams()
    function executer()
    {
        $this->connexion = $this->obtenirConnexion();
        $stmt = $this->connexion->prepare($this->requete);
        $stmt->execute($this->params);
        $this->deconnecter();
        return $stmt;
    }

    function deconnecter()
    {
        unset($this->connexion);
    }

    //TODO: enlever fichier
    /*function enleverFichier($dossier,$pochette){
        if($pochette!=="avatar.jpg"){
            $rmPoc="../$dossier/".$pochette;
            $tabFichiers = glob("../$dossier/*");
            //print_r($tabFichiers);
            // parcourir les fichier
            foreach($tabFichiers as $fichier){
                if(is_file($fichier) && $fichier==trim($rmPoc)) {
                    // enlever le fichier
                    unlink($fichier);
                    break;
                }
            }
        }
    }*/
    function supprimerImage($affiche)
    {
        if ($affiche != "avatar.jpg") {
            // TODO: mettre le dossier "images" en constante String?
            $rmPoc = '../../images/' . $affiche;
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

    // TODO: en-têtes
    //function televerserImage($repertoire, $ancienneImage, $titreOriginal)
    function televerserImage($ancienneImage, $titreTeleverse)
    {
        // TODO: remplacer par images ou String constant
        $cheminDossier = "../images/";
        $nomImage = sha1($titreTeleverse . time());

        // Par défaut, on associe le film à avatar.jpg
        $affiche = "avatar.jpg";

        // Si un fichier a été téléversé, remplacer l'image associée au film par celle téléversée
        if ($_FILES[$ancienneImage]['tmp_name'] !== "") {
            // Téléverser temporairement la nouvelle image
            // TODO: s'arranger pour que "formImage" reste lié au form par variable constante
            $tmp = $_FILES["formImage"]['tmp_name'];
            $fichier = $_FILES["formImage"]['name'];
            $extension = strrchr($fichier, '.');
            @move_uploaded_file($tmp, $cheminDossier . $nomImage . $extension);

            // Enlever le fichier temporaire chargé
            @unlink($tmp); //effacer le fichier temporaire

            //Enlever l'ancienne pochette dans le cas de modifier
            $this->supprimerImage($affiche);
            $affiche = $nomImage . $extension;
        }
        return $affiche;
    }
}