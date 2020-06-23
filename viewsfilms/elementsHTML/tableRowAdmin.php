<!--
Nom: Patrick Lainesse
Matricule: 740302
Date: 22/06/2020

Format d'affichage pour les informations d'un des films la liste qui s'affiche dans la page d'accueil
d'un administrateur (admin.php)
-->
<?php
function tableRow($film)
{
    ?>
    <tr>
        <td><img src="/videotheque/images/<?php echo $film->getImage(); ?>" class="imgTable"></td>
        <td><?php echo $film->getTitre(); ?></td>
        <td><?php echo $film->getRealisateur(); ?></td>
        <td><?php echo $film->getCategorie(); ?></td>
        <td><?php echo $film->getDuree(); ?> min</td>
        <td><?php echo $film->getPrix(); ?>$</td>
        <td>
            <form id="formUpdate" action="../formulaires/formUpdate.php" method="POST">
                <input type="hidden" id="typeForm" name="typeForm" value="update">
                <input type="hidden" name="idFilm" value="<?php echo $film->getId(); ?>">
                <?php echo $film->boutonModifier(); ?><br>
            </form>
            <form id="formEffacer" action="../formulaires/formUpdate.php" method="POST">
                <input type="hidden" id="typeForm" name="typeForm" value="effacer">
                <input type="hidden" name="idFilm" value="<?php echo $film->getId(); ?>">
                <?php echo $film->boutonDelete(); ?>
            </form>
        </td>
    </tr>
    <?php
}