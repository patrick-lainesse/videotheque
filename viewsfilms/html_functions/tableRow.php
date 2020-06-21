<?php
function tableRow($film)
{
    ?>
    <tr>
        <td><img src="/videotheque/images/<?php echo $film->getImage(); ?>" class="imgTable"></td>
        <td><?php echo $film->getTitre(); ?></td>
        <td><?php echo $film->getRealisateur(); ?></td>
        <td><?php echo $film->getCategorie(); ?></td>
        <td><?php echo $film->getDuree(); ?></td>
        <td><?php echo $film->getPrix(); ?></td>
        <td><?php echo $film->boutonModifier(); ?><br>
        <?php echo $film->boutonDelete(); ?></td>
    </tr>
    <?php
}