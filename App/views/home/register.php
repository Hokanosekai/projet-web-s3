<?php
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


<section class="flex flex-col px-20 space-y-8 items-center justify-center h-full w-full">
    <svg class="w-1/5 h-1/5" width="100%" height="100%" viewBox="0 0 721 130" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
        <g transform="matrix(1,0,0,1,-1545.43,-83.1929)">
            <g transform="matrix(2.1869,0,0,0.578396,5808.41,180.46)">
                <g transform="matrix(0.323564,0,0,1.22339,-2207.93,-828.618)">
                    <path d="M941.176,620.093C939.34,617.271 936.098,615.69 932.744,615.982C929.391,616.275 926.471,618.392 925.151,621.489C915.047,645.197 895.894,690.139 884.55,716.756C883.003,720.386 879.437,722.741 875.491,722.737C871.545,722.734 867.983,720.373 866.443,716.741C850.293,678.663 816.653,599.349 800.469,561.193C798.456,556.445 798.961,551.004 801.815,546.708C804.668,542.412 809.488,539.837 814.645,539.853C864.206,540.003 979.742,540.354 1029.41,540.504C1034.07,540.518 1038.34,543.078 1040.55,547.176C1042.76,551.274 1042.55,556.252 1040.01,560.15C1024.42,584.029 998.26,624.091 983.011,647.447C980.358,651.511 975.831,653.959 970.977,653.955C966.123,653.951 961.6,651.495 958.954,647.426C953.235,638.634 946.501,628.28 941.176,620.093ZM947.753,669.588C960.465,669.588 969.532,678.517 969.532,691.059C969.532,703.601 960.465,712.529 947.753,712.529C935.041,712.529 925.974,703.601 925.974,691.059C925.974,678.517 935.041,669.588 947.753,669.588Z" style="fill:rgb(40,91,230);"/>
                </g>
            </g>
            <g transform="matrix(2.1869,0,0,0.578396,5808.41,180.46)">
                <g transform="matrix(0.201689,0,0,0.691283,-1901.22,-850.582)">
                    <text x="101px" y="1281.41px" style="font-family:'ArialMT', 'Arial', sans-serif;font-size:376.113px;fill:rgb(40,91,230);">eb</text>
                    <text x="519.353px" y="1281.41px" style="font-family:'ArialMT', 'Arial', sans-serif;font-size:376.113px;fill:white;">t</text>
                    <text x="623.849px" y="1281.41px" style="font-family:'ArialMT', 'Arial', sans-serif;font-size:376.113px;fill:white;">icket</text>
                </g>
            </g>
        </g>
    </svg>
    <div class="flex flex-col bg-grey-3 rounded-xl h-3/5 w-1/3 text-white px-4 py-4 space-y-6">
        <div class="flex flex-col items-center space-y-2">
            <span class="text-3xl">Inscription</span>
            <span class="text-xl">Déjà un compte ? <a class="text-blue-4" href="<?= HOST ?>login">Se connecter</a></span>
        </div>

        <!--<div class="flex flex-col items-center">
            <?php /*if (!empty($errors)) {
                foreach ($errors as $error) { */?>
                    <p class="px-6 py-2 bg-red-1 rounded-lg"><?/*= $error */?></p>
                <?php /*}
            } */?>
        </div>-->

        <form class="flex flex-col flex-1 items-center space-y-4 w-full h-full justify-evenly" action="<?= HOST ?>register" method="post">

            <div class="flex flex-row items-center space-x-3 h-10 px-4 w-3/4 bg-grey-2 rounded-lg">
                <i class="fas fa-user"></i>
                <input class="outline-none h-full flex-1 bg-grey-2 pl-1" type="text" name="nom" id="" placeholder="Nom" required>
            </div>

            <div class="flex flex-row items-center space-x-3 h-10 px-4 w-3/4 bg-grey-2 rounded-lg">
                <i class="fas fa-user"></i>
                <input class="outline-none h-full flex-1 bg-grey-2 pl-1" type="text" name="prenom" id="" placeholder="Prénom" required>
            </div>

            <div class="flex flex-row items-center space-x-3 h-10 px-4 w-3/4 bg-grey-2 rounded-lg">
                <i class="fas fa-at"></i>
                <input class="outline-none h-full flex-1 bg-grey-2 pl-1" type="email" name="mail" id="" placeholder="E-Mail" required>
            </div>

            <div class="flex flex-row items-center space-x-3 h-10 px-4 w-3/4 bg-grey-2 rounded-lg">
                <i class="fas fa-key"></i>
                <input class="outline-none h-full flex-1 bg-grey-2 pl-1" type="password" name="password" id="" placeholder="Mot de passe" required>
            </div>

            <div class="flex flex-row items-center space-x-3 h-10 px-4 w-3/4 bg-grey-2 rounded-lg">
                <i class="fas fa-key"></i>
                <input class="outline-none h-full flex-1 bg-grey-2 pl-1" type="password" name="confirm_password" id="" placeholder="Confirmer Mot de passe" required>
            </div>


            <input class="rounded-lg bg-blue-4 py-2 px-4 text-white cursor-pointer hover:bg-white hover:text-blue-4" type="submit" value="S'enregistrer">
        </form>
    </div>
</section>
