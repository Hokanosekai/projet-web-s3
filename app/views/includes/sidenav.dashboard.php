<?php

if (!empty($_GET['url'])) {
    $url = explode('/', $_GET['url']);
    $active = $url[0];
} else {
    $active = 'home';
}

?>

<div class="sidenav">
    <div class="logo">
        <div class="details">
            <svg width="100%" height="100%" viewBox="0 0 482 91" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                <g transform="matrix(1,0,0,1,-120.251,-543.885)">
                    <g transform="matrix(0.950434,0,0,0.514116,-10.3494,161.777)">
                        <g id="logo-text-blanc" serif:id="logo text blanc" transform="matrix(1.41721,0,0,1.94509,-30.7275,-1.44818)">
                            <g transform="matrix(0.791643,0,0,1,5.91687,46.1031)">
                                <text x="236.334px" y="419.562px" style="font-family:'OpenSans-SemiBold', 'Open Sans';font-weight:600;font-size:99.501px;fill:rgb(40,91,230);">e<tspan x="287.694px " y="419.562px ">b</tspan></text>
                            </g>
                            <g transform="matrix(0.791643,0,0,1,83.7716,46.1031)">
                                <text x="236.334px" y="419.562px" style="font-family:'OpenSans-SemiBold', 'Open Sans';font-weight:600;font-size:99.501px;fill:white;">T<tspan x="287.571px 310.338px 354.773px 406.788px 459.143px " y="419.562px 419.562px 419.562px 419.562px 419.562px ">icket</tspan></text>
                            </g>
                            <g transform="matrix(0.369404,0,0,0.497574,-176.606,114.236)">
                                <path d="M941.176,620.093C939.34,617.271 936.098,615.69 932.744,615.982C929.391,616.275 926.471,618.392 925.151,621.489C915.047,645.197 895.894,690.139 884.55,716.756C883.003,720.386 879.437,722.741 875.491,722.737C871.545,722.734 867.983,720.373 866.443,716.741C850.293,678.663 816.653,599.349 800.469,561.193C798.456,556.445 798.961,551.004 801.815,546.708C804.668,542.412 809.488,539.837 814.645,539.853C864.206,540.003 979.742,540.354 1029.41,540.504C1034.07,540.518 1038.34,543.078 1040.55,547.176C1042.76,551.274 1042.55,556.252 1040.01,560.15C1024.42,584.029 998.26,624.091 983.011,647.447C980.358,651.511 975.831,653.959 970.977,653.955C966.123,653.951 961.6,651.495 958.954,647.426C953.235,638.634 946.501,628.28 941.176,620.093Z" style="fill:rgb(40,91,230);"/>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
        <i class="fas fa-bars" id="btn-bars"></i>
    </div>

    <ul class="nav_list">
        <li>
            <a class="<?= $active == 'home'? 'active' : '' ?>" href="<?= HOST ?>home">
                <i class="fas fa-home"></i>
                <span class="link">Accueil</span>
            </a>
        </li>
        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['type'] == 'admin') { ?>
            <li>
                <a class="<?= $active == 'dashboard'? 'active' : '' ?>" href="<?= HOST ?>dashboard">
                    <i class="fas fa-th-large"></i>
                    <span class="link">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="<?= $active == 'list-users'? 'active' : '' ?>" href="<?= HOST ?>list-users">
                    <i class="fas fa-users-cog"></i>
                    <span class="link">Users</span>
                </a>
            </li>

            <li>
                <a class="<?= $active == 'list-evenements'? 'active' : '' ?>" href="<?= HOST ?>list-evenements">
                    <i class="far fa-list-alt"></i>
                    <span class="link">Evenements</span>
                </a>
            </li>

            <li>
                <a class="<?= $active == 'create'? 'active' : '' ?>" href="<?= HOST ?>create">
                    <i class="fas fa-plus"></i>
                    <span class="link">Add</span>
                </a>
            </li>

            <li>
                <a class="<?= $active == 'stats'? 'active' : '' ?>" href="<?= HOST ?>dashboard">
                    <i class="fas fa-chart-pie"></i>
                    <span class="link">Statistique</span>
                </a>
            </li>
        <?php } ?>
    </ul>

    <div class="profile">
        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {?>
            <div class="logged">
                <div class="details">
                    <img src="<?= ASSETS ?>images/default_user.jpg" alt="profileImg">
                    <div class="name_job">
                        <div class="name"><?= $_SESSION['user']['nom']." ". $_SESSION['user']['prenom'] ?></div>
                    </div>
                </div>
                <a href="<?= HOST ?>logout"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        <?php } else {?>
            <a href="<?= HOST ?>login">
                <i class="fas fa-user-circle"></i>
                <span class="link">Login</span>
            </a>
        <?php } ?>
    </div>
</div>