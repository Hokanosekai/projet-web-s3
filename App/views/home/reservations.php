<?php
extract($data);
?>

<section class="flex flex-col px-20 py-6 h-full w-full text-white space-y-8 overflow-y-auto">
    <p class="text-3xl">Bonjour, <?= $_SESSION['user']['nom'] ?> <?= $_SESSION['user']['prenom'] ?></p>
    <?php if (sizeof($reservations) > 0) { ?>
        <div class="flex flex-col space-y-4">
            <?php foreach ($reservations as $reservation) { ?>

                <div id="<?= $reservation->getId() ?>" class="flex flex-col py-4 border-t-1 border-white">
                    <input type="hidden" name="open" id="checkbox_<?= $reservation->getId() ?>">
                    <div class="flex flex-row items-center justify-between text-2xl px-2">
                        <a href="<?= HOST ?>evenement/id/<?= $reservation->getEvenement()->getId() ?>"><?= $reservation->getEvenement()->getTitre() ?></a>
                        <p id="date_<?= $reservation->getId() ?>"><?= \App\Utils\Utils::parseDate($reservation->getDate()) ?></p>
                        <div class="flex flex-row items-center space-x-4">
                            <p><?= number_format($reservation->getPrix(), 2, '.', "")?> €</p>
                            <p onclick="develop('<?= $reservation->getId() ?>')" class="cursor-pointer select-none" id="arrow_<?= $reservation->getId() ?>">🔽</p>
                        </div>
                    </div>

                    <div id="details_<?= $reservation->getId() ?>" class="flex flex-col hidden px-2 pt-4 space-y-3">
                        <div class="flex flex-row h-60 space-x-3">
                            <img class="object-cover h-60 w-1/4 rounded-xl" src="<?= $reservation->getEvenement()->getImgPath() ?>" alt="">
                            <div class="flex flex-col h-full justify-end text-xl space-y-2 w-3/4">
                                <p>📆   Du <?= \App\Utils\Utils::parseDate($reservation->getEvenement()->getDateStart()) ?> au <?= \App\Utils\Utils::parseDate($reservation->getEvenement()->getDateEnd()) ?></p>
                                <p>📌   <?= $reservation->getEvenement()->getLieu() ?></p>
                                <div class="flex flex-col space-y-2">
                                    <p class="text-xl">🗒️  Description</p>
                                    <p class="pl-3"><?= strlen($reservation->getEvenement()->getDescription()) < 450? $reservation->getEvenement()->getDescription() : substr($reservation->getEvenement()->getDescription(), 0, 450)."..."?></p>
                                </div>
                            </div>

                        </div>
                        <div class="flex flex-col space-y-3">
                            <p class="text-2xl">Details de la réservation</p>
                            <p class="text-xl">Réservation pour le <?= \App\Utils\Utils::parseDate($reservation->getDate()) ?> à <?= $reservation->getHour() ?>h00 </p>

                            <div class="grid grid-cols-4 rounded-lg bg-grey-3 text-lg text-center px-4 py-2 w-full">
                                <span>Tarif</span>
                                <span>Nombres de places</span>
                                <span>Prix de la place</span>
                                <span>Total</span>
                            </div>

                            <div class="flex flex-col space-y-2">
                                <?php foreach ($reservation->getPrices() as $price) { ?>
                                    <div class="grid grid-cols-4 px-4 py-2 text-lg text-right w-full">
                                        <span class="text-left"><?= $price['price_titre'] ?></span>
                                        <span><?= $price['count'] ?></span>
                                        <span><?= number_format($price['price_price'], 2, '.', ",") ?> €</span>
                                        <span><?= number_format($price['total'], 2, '.', ",") ?> €</span>
                                    </div>
                                <?php } ?>
                                <div class="flex flex-row py-2 text-lg text-right items-center justify-end w-full">
                                    <span class="col-start-4 text-xl bg-grey-3 rounded-lg px-4 py-2">Total <?= number_format($reservation->getPrix(), 2, '.', "")?> €</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="flex flex-col space-y-8 items-center h-full justify-center w-full">
            <p class="text-8xl">😞</p>
            <!--<i class="text-8xl fas fa-shopping-cart"></i>-->
            <p class="text-4xl">Vous n'avez aucune réservations</p>
            <div class="flex flex-col space-y-3 items-center">
                <p class="text-xl">Réservez dès maintenants</p>
                <div class="flex flex-row space-x-6 items-center text-lg text-blue-4">
                    <a href="<?= HOST ?>theatres">Pièces de Théatres</a>
                    <a href="<?= HOST ?>concerts">Concerts</a>
                    <a href="<?= HOST ?>exposition">Expositions</a>
                    <a href="<?= HOST ?>humours">Humours</a>
                </div>
            </div>
        </div>
    <?php } ?>

</section>

<script type="application/javascript">
    function develop(id) {
        const arrowBtn = document.getElementById(`arrow_${id}`)
        const detailsSection = document.getElementById(`details_${id}`)
        const dateText = document.getElementById(`date_${id}`)
        const checkbox = document.getElementById(`checkbox_${id}`)

        detailsSection.classList.toggle('hidden')
        dateText.classList.toggle('invisible')

        if (checkbox.getAttribute("checked") === "checked") {
            checkbox.setAttribute("checked", "")
            arrowBtn.innerText = "🔽"
        } else {
            checkbox.setAttribute("checked", "checked")
            arrowBtn.innerText = "🔼"
        }


    }
</script>