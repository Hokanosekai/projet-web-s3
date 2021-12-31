<?php
extract($data);
?>


<section class="flex flex-col overflow-y-auto w-full px-20 py-6 h-full text-white">

    <div class="h-2/5 w-full space-y-3 flex flex-col justify-center items-center py-4">
        <i class="text-6xl fas fa-guitar"></i>
        <h2 class="text-2xl">Concerts</h2>
    </div>

    <form method="post" action="#" class="hidden"></form>

    <div class="grid grid-cols-3 gap-4 py-4">
        <?php foreach ($evenements as $evt) { ?>
            <div class="flex flex-col w-full rounded-2xl">
                <img class="h-60 rounded-t-2xl object-cover" src="<?= $evt->getImgPath() ?>" alt="">
                <div class="bg-grey-3 rounded-b-2xl py-4 px-4 flex flex-row items-center justify-between">
                    <div class="flex flex-col">
                        <span class="uppercase"><?= $evt->getTitre() ?></span>
                        <span class="text-grey-4">Du <?= $evt->getDateStart() ?> au <?= $evt->getDateEnd()?></span>
                    </div>
                    <a class="px-3 py-2 bg-blue-4 rounded-lg" href="<?= HOST ?>evenement/id/<?= $evt->getId() ?>">Voir plus <i class="ml-2 fas fa-arrow-right"></i></a>
                </div>
            </div>


        <?php } ?>
    </div>

</section>