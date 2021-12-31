<?php

if (!empty($_GET['url'])) {
    $url = explode('/', $_GET['url']);
    $active = $url[0];
} else {
    $active = 'home';
}

?>

<div class="flex flex-col justify-between bg-grey-2 w-72 h-full">
    <div class="flex flex-col space-y-8 px-4 py-6">
        <div class="logo">
            <div class="details">
                <svg width="100%" height="100%" viewBox="0 0 721 130" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
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
            </div>
            <i class="hidden fas fa-bars" id="btn-bars"></i>
        </div>

        <div class="flex flex-col space-y-4 text-white text-xl">
            <a class="<?= $active == 'home'? 'bg-white text-blue-4' : '' ?> flex flex-row items-center py-3 px-4 rounded-xl space-x-3 hover:bg-white hover:text-blue-4" href="<?= HOST ?>home">
                <i class="fas fa-home"></i>
                <span class="link">Accueil</span>
            </a>
            <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['type'] == 'admin') { ?>
                <a class="<?= $active == 'dashboard'? 'bg-white text-blue-4' : '' ?> flex flex-row items-center py-3 px-4 rounded-xl space-x-3 hover:bg-white hover:text-blue-4" href="<?= HOST ?>dashboard">
                    <i class="fas fa-th-large"></i>
                    <span class="link">Dashboard</span>
                </a>
                <a class="<?= $active == 'list-users'? 'bg-white text-blue-4' : '' ?> flex flex-row items-center py-3 px-4 rounded-xl space-x-3 hover:bg-white hover:text-blue-4" href="<?= HOST ?>list-users">
                    <i class="fas fa-users-cog"></i>
                    <span class="link">Users</span>
                </a>
                <a class="<?= $active == 'list-evenements'? 'bg-white text-blue-4' : '' ?> flex flex-row items-center py-3 px-4 rounded-xl space-x-3 hover:bg-white hover:text-blue-4" href="<?= HOST ?>list-evenements">
                    <i class="far fa-list-alt"></i>
                    <span class="link">Evenements</span>
                </a>
                <a class="<?= $active == 'create'? 'bg-white text-blue-4' : '' ?> flex flex-row items-center py-3 px-4 rounded-xl space-x-3 hover:bg-white hover:text-blue-4" href="<?= HOST ?>create">
                    <i class="fas fa-plus"></i>
                    <span class="link">Add</span>
                </a>
                <a class="<?= $active == 'statistiques'? 'bg-white text-blue-4' : '' ?> flex flex-row items-center py-3 px-4 rounded-xl space-x-3 hover:bg-white hover:text-blue-4" href="<?= HOST ?>statistiques">
                    <i class="fas fa-chart-pie"></i>
                    <span class="link">Statistique</span>
                </a>
            <?php } ?>
        </div>
    </div>




    <div class="flex flex-row items-center text-lg text-white">
        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {?>
            <div class="flex flex-row justify-between items-center w-full py-6 px-4 bg-grey-3">
                <div class="flex flex-row items-center space-x-2">
                    <img class="w-10 rounded-lg" src="<?= ASSETS ?>images/default_user.jpg" alt="profileImg">
                    <div><?= $_SESSION['user']['nom']." ". $_SESSION['user']['prenom'] ?></div>
                </div>
                <a class="text-xl" href="<?= HOST ?>logout"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        <?php } else {?>
            <a class="w-full bg-blue-4 text-xl rounded-xl px-4 py-3 mx-4 mb-6 flex flex-row justify-center items-center space-x-3" href="<?= HOST ?>login">
                <i class="fas fa-user-circle"></i>
                <span>Login</span>
            </a>
        <?php } ?>
    </div>
</div>