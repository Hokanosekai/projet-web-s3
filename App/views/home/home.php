<?php
    extract($data);
?>

<section class="w-full flex flex-col px-20 pt-4 pb-8 overflow-y-auto space-y-80 text-white h-screen">

    <div class="flex flex-row items-center mt-96 w-full justify-between">
        <div class="w-1/2">
            <h1 class="text-6xl mb-6">Retrouvez en ligne tous.tes vos
                <span class="typer" id="main" data-words="concerts,humouristes,expositions,pièces de théatre" data-delay="100" data-deleteDelay="1000" data-colors="#E84855,#8B5FBF,#F9DC5C,#397367"></span>
                <span class="cursor" data-owner="main"></span>
            </h1>
            <p class="text-xl">Réservez facilement vos billets pour les évènements à venir</p>
        </div>

        <div class="grid grid-cols-4 w-1/3 items-center justify-center relative text-8xl h-full">
            <i class="fas fa-palette"></i>
            <i class="fas fa-laugh-beam"></i>
            <i class="fas fa-guitar"></i>
            <i class="fas fa-theater-masks"></i>
        </div>
    </div>

    <div class="flex flex-row w-full items-center justify-between">
        <div class="flex flex-col w-1/2 pr-8 space-y-4">
            <div class="flex flex-row items-center w-full space-x-4">
                <i class="text-5xl fas fa-theater-masks"></i>
                <h2 class="text-xl">Pièces de théatre</h2>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias consequuntur corporis dolores earum et, ex fugit iusto, nisi provident quasi recusandae sint sunt. Assumenda consequuntur nihil nisi perspiciatis ullam.</p>
            <a class="px-4 py-3 bg-blue-4 rounded-lg w-28 text-center" href="<?= HOST ?>theatres">Voir plus</a>
        </div>

        <div class="flex flex-col w-1/3 rounded-2xl">
            <img class="h-60 rounded-t-2xl object-cover" src="<?= $piece->getImgPath() ?>" alt="">
            <div class="bg-grey-3 rounded-b-2xl py-4 px-4 flex flex-row items-center justify-between">
                <div class="flex flex-col">
                    <span class="uppercase"><?= $piece->getTitre() ?></span>
                    <span class="text-grey-4">Du <?= $piece->getDateStart() ?> au <?= $piece->getDateEnd()?></span>
                </div>
                <a class="px-3 py-2 bg-blue-4 rounded-lg" href="<?= HOST ?>evenement/id/<?= $piece->getId() ?>">Voir plus <i class="ml-2 fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="flex flex-row-reverse w-full items-center justify-between">
        <div class="flex flex-col w-1/2 pl-8 space-y-4">
            <div class="flex flex-row items-center w-full space-x-4">
                <i class="text-5xl fas fa-guitar"></i>
                <h2 class="text-xl">Concerts</h2>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias consequuntur corporis dolores earum et, ex fugit iusto, nisi provident quasi recusandae sint sunt. Assumenda consequuntur nihil nisi perspiciatis ullam.</p>
            <a class="px-4 py-3 bg-blue-4 rounded-lg w-28 text-center" href="<?= HOST ?>concerts">Voir plus</a>
        </div>

        <div class="flex flex-col w-1/3 rounded-2xl">
            <img class="h-60 rounded-t-2xl object-cover" src="<?= $concert->getImgPath() ?>" alt="">
            <div class="bg-grey-3 rounded-b-2xl py-4 px-4 flex flex-row items-center justify-between">
                <div class="flex flex-col">
                    <span class="uppercase"><?= $concert->getTitre() ?></span>
                    <span class="text-grey-4">Du <?= $concert->getDateStart() ?> au <?= $concert->getDateEnd()?></span>
                </div>
                <a class="px-3 py-2 bg-blue-4 rounded-lg" href="<?= HOST ?>evenement/id/<?= $concert->getId() ?>">Voir plus <i class="ml-2 fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="flex flex-row w-full items-center justify-between">
        <div class="flex flex-col w-1/2 pr-8 space-y-4">
            <div class="flex flex-row items-center w-full space-x-4">
                <i class="text-5xl fas fa-laugh-beam"></i>
                <h2 class="text-xl">Humours</h2>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias consequuntur corporis dolores earum et, ex fugit iusto, nisi provident quasi recusandae sint sunt. Assumenda consequuntur nihil nisi perspiciatis ullam.</p>
            <a class="px-4 py-3 bg-blue-4 rounded-lg w-28 text-center" href="<?= HOST ?>humours">Voir plus</a>
        </div>

        <div class="flex flex-col w-1/3 rounded-2xl">
            <img class="h-60 rounded-t-2xl object-cover" src="<?= $humour->getImgPath() ?>" alt="">
            <div class="bg-grey-3 rounded-b-2xl py-4 px-4 flex flex-row items-center justify-between">
                <div class="flex flex-col">
                    <span class="uppercase"><?= $humour->getTitre() ?></span>
                    <span class="text-grey-4">Du <?= $humour->getDateStart() ?> au <?= $humour->getDateEnd()?></span>
                </div>
                <a class="px-3 py-2 bg-blue-4 rounded-lg" href="<?= HOST ?>evenement/id/<?= $humour->getId() ?>">Voir plus <i class="ml-2 fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="flex flex-row-reverse w-full items-center justify-between">
        <div class="flex flex-col w-1/2 pl-8 space-y-4">
            <div class="flex flex-row items-center w-full space-x-4">
                <i class="text-5xl fas fa-palette"></i>
                <h2 class="text-xl">Expositions</h2>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias consequuntur corporis dolores earum et, ex fugit iusto, nisi provident quasi recusandae sint sunt. Assumenda consequuntur nihil nisi perspiciatis ullam.</p>
            <a class="px-4 py-3 bg-blue-4 rounded-lg w-28 text-center" href="<?= HOST ?>expositions">Voir plus</a>
        </div>

        <div class="flex flex-col w-1/3 rounded-2xl">
            <img class="h-60 rounded-t-2xl object-cover" src="<?= $exposition->getImgPath() ?>" alt="">
            <div class="bg-grey-3 rounded-b-2xl py-4 px-4 flex flex-row items-center justify-between">
                <div class="flex flex-col">
                    <span class="uppercase"><?= $exposition->getTitre() ?></span>
                    <span class="text-grey-4">Du <?= $exposition->getDateStart() ?> au <?= $exposition->getDateEnd()?></span>
                </div>
                <a class="px-3 py-2 bg-blue-4 rounded-lg" href="<?= HOST ?>evenement/id/<?= $exposition->getId() ?>">Voir plus <i class="ml-2 fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>