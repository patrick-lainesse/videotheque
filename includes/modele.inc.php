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

    // le fichier par défaut est avatar
    function televerserImage($repertoire, $nomOriginal, $chaine)
    {
        $cheminDossier = "../$repertoire/";
        $nomPochette = sha1($chaine . time());

        // Par défaut, on associe le film à avatar.jpg
        $affiche = "avatar.jpg";

        // Si un fichier a été téléversé, remplacer l'image associée au film par celle téléversée
        if ($_FILES[$nomOriginal]['tmp_name'] !== "") {
            $tmp = $_FILES[$nomOriginal]['tmp_name'];
            $fichier = $_FILES[$nomOriginal]['name'];
            $extension = strrchr($fichier, '.');
            @move_uploaded_file($tmp, $cheminDossier . $nomPochette . $extension);
            // Enlever le fichier temporaire chargé
            @unlink($tmp); //effacer le fichier temporaire
            //Enlever l'ancienne pochette dans le cas de modifier
            $this->enleverFichier($repertoire, $affiche);
            $affiche = $nomPochette . $extension;
        }
        return $affiche;
    }
    /*function verserFichier($dossier, $inputNom, $fichierDefaut, $chaine){
        $cheminDossier="../$dossier/";
        $nomPochette=sha1($chaine.time());
        $pochette=$fichierDefaut;
        if($_FILES[$inputNom]['tmp_name']!==""){
            //Upload de la photo
            $tmp = $_FILES[$inputNom]['tmp_name'];
            $fichier= $_FILES[$inputNom]['name'];
            $extension=strrchr($fichier,'.');
            @move_uploaded_file($tmp,$cheminDossier.$nomPochette.$extension);
            // Enlever le fichier temporaire charg�
            @unlink($tmp); //effacer le fichier temporaire
            //Enlever l'ancienne pochette dans le cas de modifier
            $this->enleverFichier($dossier,$pochette);
            $pochette=$nomPochette.$extension;
        }
        return $pochette;
    }*/
}