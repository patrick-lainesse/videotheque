<?php
function tableRow($film)
{
    ?>
    <tr>
        <form id="formUpdate" action="formUpdate.php" method="POST">    <!--TODO: form not allowed here-->
            <input type="hidden" id="typeForm" name="typeForm" value="update">
            <input type="hidden" name="idFilm" value="<?php echo $film->getId(); ?>">
            <td><img src="/videotheque/images/<?php echo $film->getImage(); ?>" class="imgTable"></td>
            <td><?php echo $film->getTitre(); ?></td>
            <td><?php echo $film->getRealisateur(); ?></td>
            <td><?php echo $film->getCategorie(); ?></td>
            <td><?php echo $film->getDuree(); ?></td>
            <td><?php echo $film->getPrix(); ?></td>
            <td><?php echo $film->boutonModifier(); ?><br>
                <?php echo $film->boutonDelete(); ?></td>
        </form>
    </tr>
    <?php
}