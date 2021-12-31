<?php
extract($data)
?>

<section class="overflow-y-auto w-full px-20 py-6 flex flex-col space-y-6 text-white">
    <div class="grid grid-cols-3 w-full rounded-lg gap-6">
        <div class="bg-grey-3 p-4 rounded-xl">
            <canvas id="users"></canvas>
        </div>
        <div class="bg-grey-3 p-4 rounded-xl">
            <canvas id="evenements"></canvas>
        </div>
        <div class="bg-grey-3 p-4 rounded-xl">
            <canvas id="reservations"></canvas>
        </div>
    </div>

    <div class="flex flex-row w-full space-x-6">
        <div class="flex flex-col bg-grey-3 rounded-lg p-4 w-1/2 space-y-2">
            <p class="text-4xl text-center">Types d'évenement le plus réservé</p>

            <?php foreach ($types as $type) { ?>
                <a class="text-xl text-center" href="<?= HOST.$type['name'] ?>s"><?= $type['name'] ?></a>
            <?php } ?>
        </div>
        <div class="flex flex-col bg-grey-3 rounded-lg p-4 w-1/2 space-y-2">
            <p class="text-4xl text-center">Evenements les plus réservé</p>

            <?php foreach ($evenements as $evt) { ?>
                <a class="text-xl text-center" href="<?= HOST ?>evenement/id/<?= $evt['id_evt'] ?>"><?= $evt['titre'] ?></a>
            <?php } ?>
        </div>
    </div>
</section>

<script src="<?= ASSETS ?>js/statistic.js"></script>
