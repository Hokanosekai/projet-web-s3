<?php

use App\Utils\EvtTypes;

extract($data);

?>

<section id="section" class="flex flex-col w-full overflow-y-auto h-screen px-20 py-6 text-white space-y-8 justify-start <?= isset($_SESSION['notif'])? 'filter blur-lg' : '' ?>">

    <div class="grid grid-cols-3 gap-4 w-full h-52">
        <div class="bg-grey-3 p-4 rounded-lg flex flex-row items-center justify-between h-52">
            <div class="flex flex-col h-full w-2/3">
                <span class="text-2xl">Total Réservations</span>
                <div class="h-full flex flex-row items-center">
                    <span class="text-6xl"><?= $total_reservation ?></span>
                </div>
            </div>
            <div class="flex flex-row items-center justify-center h-full w-1/3">
                <p class="text-4xl align-middle text-center px-4 py-4 rounded-lg bg-yellow-1">🛒</p>
                <!--<i class="align-middle text-center text-4xl fas fa-shopping-cart px-2 py-2 h-16 w-16 rounded-lg bg-yellow-1 text-yellow-2"></i>-->
            </div>
        </div>
        <div class="bg-grey-3 p-4 rounded-lg flex flex-row items-center justify-between h-52">
            <div class="flex flex-col h-full w-2/3">
                <span class="text-2xl">Profits Total</span>
                <div class="h-full flex flex-row items-center">
                    <span class="text-6xl">€ <?= $total_price ?></span>
                </div>
            </div>
            <div class="flex flex-row items-center justify-center h-full w-1/3">
                <p class="text-4xl align-middle text-center px-4 py-4 rounded-lg bg-green-3">💵</p>
                <!--<i class="align-middle text-center text-4xl fas fa-euro-sign px-2 py-2 h-16 w-16 rounded-lg bg-green-3 text-green-1"></i>-->
            </div>
        </div>
        <div class="bg-grey-3 p-4 rounded-lg flex flex-row items-center justify-between h-52">
            <div class="flex flex-col h-full w-2/3">
                <span class="text-2xl">Total Utilisateurs</span>
                <div class="h-full flex flex-row items-center">
                    <span class="text-6xl"><?= $total_users ?></span>
                </div>
            </div>
            <div class="flex flex-row items-center justify-center h-full w-1/3">
                <p class="text-4xl align-middle text-center px-4 py-4 rounded-lg bg-blue-1">👥</p>
            </div>
        </div>
    </div>

    <div class="row-span-2 h-full flex flex-col space-y-3 chart-container" style="position: relative; height: 40%; width: 100%; display: flex; flex-direction: column">
        <span class="text-2xl">10 derniers jours</span>
        <canvas height="300" id="reservations_by_time"></canvas>
    </div>

    <form class="flex flex-col w-full row-span-2 space-y-5" action="" method="post">

        <h3 class="text-2xl">Dernières Réservations</h3>

        <div class="grid grid-cols-7 gap-12 justify-between">
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

            <button class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 text-xl <?= ($offset-10 < 0)? "opacity-40": "hover:bg-blue-4" ?>" type="submit" value="<?= $offset-10 ?>" name="offset" <?= ($offset-10 < 0)? "disabled": "" ?>>
                <!--<i class="fas fa-caret-left"></i>--> <p>◀️</p>
            </button>
            <button class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 text-xl <?= ($offset+10 >= $nb_resa)? "opacity-40": "hover:bg-blue-4" ?>" type="submit" value="<?= $offset+10 ?>" name="offset" <?= ($offset+10 >= $nb_resa)? "disabled": "" ?>>
                <!--<i class="fas fa-caret-right"></i>--> <p>▶️</p>
            </button>
        </div>

        <div class="grid grid-cols-6 w-full px-4 py-2 bg-grey-3 rounded-lg text-lg">
            <span>#ID</span>
            <span>Utilisateur</span>
            <span>Evenement</span>
            <span>Type</span>
            <span>Date</span>
            <span>Prix</span>
        </div>

        <div class="flex flex-col space-y-2">
            <?php foreach ($reservations as $reservation) { ?>
                <div class="grid grid-cols-6 w-full py-2 px-4 rounded-lg text-lg">
                    <span><?= $reservation->getId() ?></span>
                    <span><?= $reservation->getUser() ?></span>
                    <a href="<?= HOST ?>evenement/id/<?= $reservation->getEvenement() ?>"><?= $reservation->getEvenement() ?></a>
                    <a href="<?= HOST.$reservation->getType() ?>s"><?= $reservation->getType() ?></a>
                    <span><?= $reservation->getCreateAt() ?></span>
                    <div class="flex flex-row justify-between items-center">
                        <span><?= number_format($reservation->getPrix(), '2', ',', "") ?></span>
                        <a href="<?= HOST ?>reservation-delete/id/<?= $reservation->getId() ?>"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </form>

</section>


<script src="<?= ASSETS ?>js/dashboard.js"></script>
