<?php

include "includes/bdd.functions.php";


$pages = scandir('pages/');
if (isset($_GET['page']) && !empty($_GET['page'])) {
    if (in_array($_GET['page'].'.php',$pages)) {
        $page = $_GET['page'];
    } else {
        $page = 'error';
    }
} else {
    $page = "home";
}

$pages_functions = scandir('includes/pages_functions/');
if (in_array($page.'.functions.php',$pages_functions)) {
    include 'includes/pages_functions/'.$page.'.functions.php';
}


?>

<!doctype html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://kit.fontawesome.com/1a3a0ccf9e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/main.css">

    <title>Document</title>
</head>
<body class="">

<!-- SideNav Left -->
<?php require "includes/views/sidenav.php"?>

<div class="container">
    <?php include "pages/".$page.".php"; ?>
</div>

<!-- Footer -->
<?php require "includes/views/footer.php"?>

<script src="assets/js/sidenav.js" type="application/javascript"></script>

</body>
</html>
