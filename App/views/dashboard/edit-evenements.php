<?php

use App\Utils\EvtTypes;
use App\Utils\Utils;

extract($data);

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


<form action="" method="post" id="form" class="flex flex-col w-full overflow-y-auto space-y-4 px-20 py-6 h-full text-white">

    <!--<div class="flex flex-col items-center">
        <?php /*if (!empty($errors)) {
            foreach ($errors as $error) { */?>
                <p class="px-6 py-2 bg-red-1 rounded-lg"><?/*= $error */?></p>
            <?php /*}
        } */?>
    </div>-->

    <div class="flex flex-row space-x-4 w-full">
        <div class="flex flex-col space-y-2 w-1/2">
            <label class="text-xl" for="title">Titre</label>
            <input class="bg-grey-3 rounded-lg px-2 h-10 outline-none" type="text" name="title" id="title" value="<?= $evenement? $evenement->getTitre() : "" ?>">
        </div>

        <div class="flex flex-col space-y-2 w-1/2">
            <label class="text-xl" for="type">Type</label>
            <select class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10" name="type" id="type">
                <option value="<?= EvtTypes::THEATRE ?>" <?= $evenement? $evenement->getType() == EvtTypes::THEATRE? "selected" : "" : ""?> >Théatre</option>
                <option value="<?= EvtTypes::CONCERT ?>" <?= $evenement? $evenement->getType() == EvtTypes::CONCERT? "selected" : "" : ""?>>Concert</option>
                <option value="<?= EvtTypes::EXPOSITION ?>" <?= $evenement? $evenement->getType() == EvtTypes::EXPOSITION? "selected" : "" : ""?>>Exposition</option>
                <option value="<?= EvtTypes::HUMOUR ?>" <?= $evenement? $evenement->getType() == EvtTypes::HUMOUR? "selected" : "" : ""?>>Humour</option>
            </select>
        </div>
    </div>

    <div class="flex flex-col space-y-2 w-full">
        <label class="text-xl" for="">Description</label>
        <textarea class="bg-grey-3 rounded-lg px-2 py-2 outline-none" name="description" id="" cols="30" rows="10"><?= $evenement? $evenement->getDescription() : "" ?></textarea><br>
    </div>

    <div class="flex flex-row space-x-4 w-full">
        <div class="flex flex-col space-y-4 w-1/2">
            <div class="flex flex-col space-y-2 w-full">
                <label class="text-xl" for="img">Image de fond</label>
                <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10" onchange="reloadImg()" value="<?= $evenement? $evenement->getImgPath() : "" ?>" type="text" name="img" id="img"><br>
            </div>

            <img class="w-full h-80 rounded-lg object-cover bg-grey-3" src="<?= $evenement? $evenement->getImgPath() : "" ?>" alt="" id="img_t">
        </div>

        <div class="flex flex-col space-y-8 w-1/2">
            <div class="flex flex-col space-y-2 w-full">
                <label class="text-xl" for="places">Nombres de Places</label>
                <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10" type="number" min="100" name="places" id="places" value="<?= $evenement? $evenement->getPlaces() : "" ?>"><br>
            </div>

            <div class="flex flex-col space-y-2 w-full">
                <label class="text-xl" for="lieu">Lieu</label>
                <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10" type="text" name="lieu" id="lieu" value="<?= $evenement? $evenement->getLieu() : "" ?>"><br>
            </div>

            <div class="flex flex-col space-y-2 w-full">
                <label class="text-xl" for="date_start">Date de Début</label>
                <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10" type="date" name="date_start" id="date_start" value="<?= $evenement? Utils::unparseDate($evenement->getDateStart()) : "" ?>"><br>
            </div>

            <div class="flex flex-col space-y-2 w-full">
                <label class="text-xl" for="date_end">Date de Fin</label>
                <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10" type="date" name="date_end" id="date_end" value="<?= $evenement? Utils::unparseDate($evenement->getDateEnd()) : "" ?>"><br>
            </div>
        </div>
    </div>

    <div class="flex flex-col space-y-3 w-1/3">
        <p class="text-2xl">Prix</p>

        <div id="prices" class="flex flex-col space-y-2 w-full">
            <?php if ($prices) {
                $i = 0;
                foreach ($prices as $price) { ?>
                    <div id="price<?= $i ?>" class="flex flex-row space-x-3 w-full ">
                        <input type="hidden" name="price<?= $i ?>_id" value="<?= $price->getId() ?>">
                        <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10 flex-1" placeholder="Name" value="<?= $price->getTitre() ?>" type="text" name="price<?= $i ?>_name" id="">
                        <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10 flex-1" value="<?= number_format($price->getPrix(), 2, '.', "") ?>" type="number" step="0.01" name="price<?= $i ?>_prix" id="">
                        <div id="btn_price<?= $i ?>" onclick="deletePrice('price<?= $i ?>')" class="flex flex-row items-center w-10 cursor-pointer justify-center">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                    </div>
                <?php $i++;
                }
            } ?> <!--/*else { */?>
                <div class="flex flex-row space-x-3 w-full">
                    <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10" placeholder="Name" type="text" name="price0_name" id="">
                    <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10" value="0,00 €" type="text" name="price0_prix" id="">
                </div>
            --><?php /*} */?>
        </div>

        <div id="btn_add_prices" onclick="addPrice()" class="w-full flex flex-row justify-center space-x-4 items-center px-4 py-2 cursor-pointer rounded-lg text-lg bg-grey-4 text-grey-3">
            <p>Ajouter un prix</p>
            <i class="fas fa-plus"></i>
        </div>

    </div>

    <input type="hidden" name="id" id="" value="<?= $evenement? $evenement->getId() : "" ?>">
    <input type="hidden" name="nb_price" id="nb_price" value="<?= $prices? sizeof($prices) : 0 ?>">

    <div class="flex flex-row space-y-2 w-full justify-end">
        <button class="bg-white rounded-lg py-2 px-4 text-xl text-blue-4" type="submit" name="send"><?= $evenement? "Modifier" : "Créer" ?></button>
    </div>

</form>

<script>

    var pricesContainer = document.getElementById('prices')

    function deletePrice(id) {
        const element = document.getElementById(id)
        element.innerHTML += `
            <input type="hidden" name="${id}_suppr" id="" value="true">
        `
        element.classList.add('hidden')
    }

    function addPrice() {
        const id = pricesContainer.childElementCount
        const t = parseInt(document.getElementById('nb_price').value) + 1
        console.log(t)
        document.getElementById('nb_price').value = t
        pricesContainer.innerHTML += `
            <div id="price${id}" class="flex flex-row space-x-3 w-full ">
                <input type="hidden" name="price${id}_id" value="0">
                <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10 flex-1" placeholder="Name" value="" type="text" name="price${id}_name" id="">
                <input class="bg-grey-3 rounded-lg px-2 py-2 outline-none h-10 flex-1" value="0" type="number" step="0.01" name="price${id}_prix" id="">
                <div id="btn_price${id}" onclick="deletePrice('price${id}')" class="flex flex-row items-center w-10 cursor-pointer justify-center">
                    <i class="fas fa-trash-alt"></i>
                </div>
            </div>
        `
    }

    function reloadImg() {
        var url = document.getElementById('img').value;
        var imgExist = document.getElementById('img_t');

        imgExist.src = url
    }
</script>
