<?php
extract($data);
?>


<section class="container flex">

    <div class="header column">
        <i class="fas fa-guitar"></i>
        <h2>Concerts</h2>
    </div>

    <form method="post" action="#" class="filtre">

    </form>

    <div class="card-container column">
        <?php foreach ($evenements as $evt) { ?>
            <div class="card">
                <img src="<?= $evt->getImgPath() ?>" alt="">
                <div class="details">
                    <div class="info">
                        <span class="title"><?= $evt->getTitre() ?></span>
                        <span class="date">Du <?= $evt->getDateStart() ?> au <?= $evt->getDateEnd()?></span>
                    </div>
                    <a class="btn link" href="<?= HOST ?>evenement/id/<?= $evt->getId() ?>">Voir plus <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>


        <?php } ?>
    </div>

</section>