<?php

use App\Utils\EvtTypes;

extract($data);
?>

<form id="section" class="flex flex-col w-full space-y-5 py-6 px-20 text-white relative <?= isset($_SESSION['notif'])? 'filter blur-lg' : '' ?>" method="post" action="">


    <h3 class="text-2xl">Evenements</h3>

    <div class="grid grid-cols-7 gap-12 justify-between ">

        <label for="all" class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 cursor-pointer <?= ($type == 0)? "bg-blue-4": "" ?> hover:bg-blue-4">
            <input class="invisible absolute w-full h-full" onChange="this.form.submit()" type="radio" id="all" name="type" value="0" <?= ($type == 0)? "checked": "" ?>>
            All
        </label>

        <label for="theatres" class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 cursor-pointer <?= ($type == EvtTypes::THEATRE)? "bg-blue-4": "" ?> hover:bg-blue-4">
            <input class="invisible absolute w-full h-full" onChange="this.form.submit()" type="radio" id="theatres" name="type" value="<?= EvtTypes::THEATRE ?>" <?= ($type == EvtTypes::THEATRE)? "checked": "" ?>>
            Théatres
        </label>

        <label for="concerts" class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 cursor-pointer <?= ($type == EvtTypes::CONCERT)? "bg-blue-4": "" ?> hover:bg-blue-4">
            <input class="invisible absolute w-full h-full" onChange="this.form.submit()" type="radio" id="concerts" name="type" value="<?= EvtTypes::CONCERT ?>" <?= ($type == EvtTypes::CONCERT)? "checked": "" ?>>
            Concerts
        </label>

        <label for="expositions" class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 cursor-pointer <?= ($type == EvtTypes::EXPOSITION)? "bg-blue-4": "" ?> hover:bg-blue-4">
            <input class="invisible absolute w-full h-full" onChange="this.form.submit()" type="radio" id="expositions" name="type" value="<?= EvtTypes::EXPOSITION ?>" <?= ($type == EvtTypes::EXPOSITION)? "checked": "" ?>>
            Expositions
        </label>

        <label for="humours" class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 cursor-pointer <?= ($type == EvtTypes::HUMOUR)? "bg-blue-4": "" ?> hover:bg-blue-4">
            <input class="invisible absolute w-full h-full" onChange="this.form.submit()" type="radio" id="humours" name="type" value="<?= EvtTypes::HUMOUR ?>" <?= ($type == EvtTypes::HUMOUR)? "checked": "" ?>>
            Humours
        </label>

        <button class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 text-xl <?= ($offset-15 < 0)? "opacity-40": "hover:bg-blue-4" ?>" type="submit" value="<?= $offset-15 ?>" name="offset" <?= ($offset-15 < 0)? "disabled": "" ?>>
            <!--<i class="fas fa-caret-left"></i>--> <p>◀️</p>
        </button>
        <button class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 text-xl <?= ($offset+15 >= $nb_evts)? "opacity-40": "hover:bg-blue-4" ?>" type="submit" value="<?= $offset+15 ?>" name="offset" <?= ($offset+15 >= $nb_evts)? "disabled": "" ?>>
            <!--<i class="fas fa-caret-right"></i>--> <p>▶️</p>
        </button>
    </div>

    <div class="grid grid-cols-6 w-full px-4 py-2 bg-grey-3 rounded-lg text-lg">
        <span>#ID</span>
        <span class="col-span-2">Titre</span>
        <span>Type</span>
        <span>Date</span>
        <span>NB places</span>
    </div>

    <div class="flex flex-col space-y-2">
        <?php foreach ($evenements as $evt) { ?>
            <div class="grid grid-cols-6 w-full py-2 px-4 rounded-lg text-lg">
                <a href="<?= HOST ?>evenement/id/<?= $evt->getId() ?>"><?= $evt->getId() ?></a>
                <span class="col-span-2"><?= $evt->getTitre() ?></span>
                <a href="<?= HOST.$evt->getTypeName() ?>s"><?= $evt->getTypeName() ?></a>
                <span><?= $evt->getDateStart() ?> - <?= $evt->getDateEnd() ?></span>
                <div class="flex flex-row justify-between items-center">
                    <span><?= $evt->getPlaces() ?></span>
                    <div class="flex flex-rows items-center space-x-2">
                        <a href="<?= HOST ?>edit/id/<?= $evt->getId() ?>"><i class="fas fa-edit"></i></a>
                        <a href="<?= HOST ?>evenement-delete/id/<?= $evt->getId() ?>"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</form>
