<?php
extract($data);
?>

<section class="container flex">
    <div class="navigate">
        <form action="" method="post">

            <input onChange="this.form.submit()" type="radio" id="all" name="type" value="0" <?= ($type == 0)? "checked": "" ?>>
            <label for="all">All</label>
            <input onChange="this.form.submit()" type="radio" id="theatres" name="type" value="<?= EvtTypes::THEATRE ?>" <?= ($type == EvtTypes::THEATRE)? "checked": "" ?>>
            <label for="theatres">Théatres</label>
            <input onChange="this.form.submit()" type="radio" id="concerts" name="type" value="<?= EvtTypes::CONCERT ?>" <?= ($type == EvtTypes::CONCERT)? "checked": "" ?>>
            <label for="concerts">Concerts</label>
            <input onChange="this.form.submit()" type="radio" id="expositions" name="type" value="<?= EvtTypes::EXPOSITION ?>" <?= ($type == EvtTypes::EXPOSITION)? "checked": "" ?>>
            <label for="expositions">Expositions</label>
            <input onChange="this.form.submit()" type="radio" id="humours" name="type" value="<?= EvtTypes::HUMOUR ?>" <?= ($type == EvtTypes::HUMOUR)? "checked": "" ?>>
            <label for="humours">Humours</label>

            <button type="submit" value="<?= $offset-3 ?>" name="offset" <?= ($offset-3 < 0)? "disabled": "" ?>><i class="fas fa-caret-left"></i></button>
            <button type="submit" value="<?= $offset+3 ?>" name="offset" <?= ($offset+3 >= $nb_evts)? "disabled": "" ?>><i class="fas fa-caret-right"></i></button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <td>Numéro</td>
                <td>Titre</td>
                <td>Type</td>
                <td>Delete</td>
                <td>Modify</td>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($evenements as $evenement) { ?>

                <tr>
                    <td><?= $evenement->getId() ?></td>
                    <td><?= $evenement->getTitre() ?></td>
                    <td><?= $evenement->getTypeName() ?></td>
                    <td><a href="<?= HOST ?>delete/id/<?= $evenement->getId() ?>"><i class="fas fa-trash"></i></a></td>
                    <td><a href="<?= HOST ?>edit/id/<?= $evenement->getId() ?>"><i class="fas fa-edit"></i></a></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>



</section>
