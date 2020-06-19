<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/header.php";
$chemin = $_SERVER['DOCUMENT_ROOT'] . "/videotheque/bd/connexion.inc.php";
require_once $chemin;
?>

    <div class="container">
        <div class="row">
            <h3>Votre panier
                <a class="waves-effect waves-light darken-4 red btn-small marginTop5 right"><i class="material-icons left">delete_forever
                    </i>Vider le panier</a></h3>
        </div>
        <table class="centered">
            <thead>
            <tr>
                <th>Affiche</th>
                <th>Film</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><img src="/videotheque/images/9a29205e93ecc929871e0b2b53d8ec2491c0a813.jpg" class="imgTable"></td>
                <td>Adaptation</td>
                <td>2</td>
                <td>6.99$</td>
                <td><a class="waves-effect waves-light darken-4 red btn-small"><i class="material-icons left">delete</i>Supprimer</a>
                </td>
            </tr>
            <tr>
                <td><img src="/videotheque/images/9a29205e93ecc929871e0b2b53d8ec2491c0a813.jpg" class="imgTable"></td>
                <td>Adaptation</td>
                <td>2</td>
                <td>6.99$</td>
                <td><a class="waves-effect waves-light darken-4 red btn-small"><i class="material-icons left">delete</i>Supprimer</a>
                </td>
            </tr>
            <tr>
                <td><img src="/videotheque/images/9a29205e93ecc929871e0b2b53d8ec2491c0a813.jpg" class="imgTable"></td>
                <td>Adaptation</td>
                <td>2</td>
                <td>6.99$</td>
                <td><a class="waves-effect waves-light darken-4 red btn-small"><i class="material-icons left">delete</i>Supprimer</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/videotheque/viewsfilms/footer.html";
