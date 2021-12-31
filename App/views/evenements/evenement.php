<?php

use App\Utils\Utils;

extract($data);
?>

<?php

if (!empty($errors)) {
    foreach ($errors as $error) { ?>
        <div id="notif" onclick="this.classList.toggle('hidden')" class="absolute flex flex-col <?= isset($errors['succes'])? 'bg-green-2' : 'bg-red-2' ?> text-white cursor-pointer rounded-lg p-4 min-h-[24] w-1/4 z-10 left-1/2 top-0 mt-10 transform -translate-x-1/2 bac shadow-2xl filter drop-shadow-2xl content-between">
            <div class="flex flex-row justify-between items-start">
                <p class="text-2xl uppercase font-semibold"><?= isset($errors['succes'])? 'Success' : 'Error' ?></p>
                <i class="text-xl fas fa-times"></i>
            </div>
            <p class="text-xl"><?= $error ?></p>
        </div>
    <?php }
} ?>

<section class="flex flex-row pl-20 overflow-y-auto w-full text-white h-full space-x-20">

    <div class="flex flex-col py-6 w-4/5 space-y-8 h-full">
        
        <div class="flex flex-row w-full space-x-3 h-1/3">
            <img class="w-80 h-80 object-cover rounded-xl" src="<?= $evenement->getImgPath() ?>" alt="">
            
            <div class="flex flex-col just h-full justify-end space-y-2">
                <h2 class="text-4xl"><?= $evenement->getTitre() ?></h2>
                <a class="text-xl" href="#description">🗒️  Lire la description</a>
                <p class="text-xl">📆  Du <?= $evenement->getDateStart() ?> au <?= $evenement->getDateEnd()?></p>
                <a class="text-xl" href="#map">📌  <?= $evenement->getLieu() ?></a>
            </div>
        </div>
        
        <div class="flex flex-col space-y-2 h-1/3" id="description">
            <span class="text-xl uppercase">DESCRIPTION</span>

            <p><?= $evenement->getDescription() ?></p>
        </div>
        
        <div class="flex flex-col space-y-2 h-1/3" id="map">
            <span class="text-xl uppercase">C'EST PAR ICI !</span>
            <iframe
                    width="100%"
                    height="100%"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    src="https://www.google.com/maps/embed/v1/place?key=<?= API_KEY_GOOGLE_MAPS ?>&q=<?= $evenement->getLieu() ?>">
            </iframe>
        </div>
    </div>

    <form method="post" class="flex flex-col w-1/5 bg-grey-3 px-4 py-6 justify-between">

        <div class="flex flex-col space-y-6 w-full">
            <div class="flex flex-col space-y-3 w-full">
                <p class="text-2xl">Tarifs</p>

                <?php
                $i = 0;
                foreach ($prices as $price) { ?>
                    <div class="flex flex-col space-y-2" id="<?= $price->getId() ?>">
                        <div class="flex flex-row items-center justify-between">
                            <span><?= $price->getTitre() ?></span>
                            <span><?= number_format($price->getPrix(), 2, ',', ""); ?>€</span>
                        </div>

                        <div class="flex flex-row items-center w-full px-2 h-10 bg-grey-2 space-x-3 rounded-lg">
                            <input type="hidden" name="price_id_<?= $i ?>" value="<?= $price->getId() ?>">
                            <span class="cursor-pointer" onclick="totalPriceRemove(this.parentNode.querySelector('#price_<?= $price->getId() ?>'), <?= number_format($price->getPrix(), 2, '.', ""); ?>)"><i class="fas fa-minus"></i></span>
                            <input class="flex-1 bg-grey-2 h-full outline-none" onchange="" type="number" name="price_<?= $i ?>" id="price_<?= $price->getId() ?>" min="0" max="10" value="0">
                            <span class="cursor-pointer" onclick="totalPriceAdd(this.parentNode.querySelector('#price_<?= $price->getId() ?>'), <?= number_format($price->getPrix(), 2, '.', ""); ?>)"><i class="fas fa-plus"></i></span>
                        </div>
                    </div>
                <?php
                $i++;
                } ?>
            </div>

            <div class="flex flex-col space-y-3 w-full">
                <p class="text-2xl">Choisissez une date</p>
                <input class="bg-blue-4 h-10 text-center rounded-lg cursor-pointer outline-none" type="date" name="date" id="date" min="<?= Utils::unparseDate($evenement->getDateStart()) ?>" max="<?= Utils::unparseDate($evenement->getDateEnd()) ?>">
            </div>

            <div class="flex flex-col space-y-3 w-full">
                <p class="text-2xl">Choisissez une horaire</p>
                <select class="bg-blue-4 h-10 text-center rounded-lg cursor-pointer px-2  outline-none" name="hour" id="heure">
                    <option value="9">9h00</option>
                    <option value="10">10h00</option>
                    <option value="11">11h00</option>
                    <option value="12">12h00</option>
                    <option value="13">13h00</option>
                    <option value="14">14h00</option>
                    <option value="15">15h00</option>
                    <option value="18">16h00</option>
                    <option value="17">17h00</option>
                </select>
            </div>
        </div>


        <div class="flex flex-col space-y-6">
            <div class="flex flex-col space-y-3 w-full">
                <p class="text-2xl">Prix Total</p>
                <input readonly class="select-none text-xl bg-grey-2 h-10 px-2 text-center rounded-lg outline-none" type="text" name="price" id="price" value="0.00 €">
            </div>

            <input type="hidden" name="evt_id" value="<?= $evenement->getId() ?>">
            <input class="bg-blue-4 px-2 w-full py-2 rounded-lg text-center cursor-pointer" type="submit" name="send" value="Réserver">
        </div>
    </form>

    <script type="application/javascript">
        function totalPriceAdd(el, prix) {
            console.log(el.value)
            if (el.value > 9) return
            el.stepUp()
            const price = document.getElementById('price')
            let last_price = parseFloat(price.value.split(' ')[0])
            console.log(last_price, parseFloat(prix))
            price.value = `${(last_price + parseFloat(prix)).toFixed(2)} €`;
        }

        function totalPriceRemove(el, prix) {
            if (el.value < 1) return
            el.stepDown()
            const price = document.getElementById('price')
            const last_price = parseFloat(price.value.split(' ')[0])
            console.log(last_price, parseFloat(prix))
            price.value = `${(last_price - parseFloat(prix)).toFixed(2)} €`;
        }
    </script>

</section>