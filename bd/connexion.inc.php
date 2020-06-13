<?php
define("SERVEUR","localhost");
define("USAGER","root");
define("PASSE","");
define("BD","bdfilms");
$connexion = new mysqli(SERVEUR,USAGER,PASSE,BD);
if ($connexion->connect_errno) {
    echo "Problème de connexion à la base de données";
    exit();
}
