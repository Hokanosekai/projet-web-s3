<?php



?>
<!doctype html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://kit.fontawesome.com/1a3a0ccf9e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/main.css">

    <title>Document</title>
</head>
<body>

<!-- SideNav Left -->
<?php require "includes/sidenav.php" ?>

<div class="container">
    <h1>Hello <?= $data['name'] ?></h1>
</div>

<!-- Footer -->
<?php require "includes/footer.php" ?>

<script src="js/sidenav.js" type="application/javascript"></script>

</body>
</html>