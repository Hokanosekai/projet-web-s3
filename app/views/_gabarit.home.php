<?php ?>
<!doctype html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Import FontAwesome for all icons -->
    <script src="https://kit.fontawesome.com/1a3a0ccf9e.js" crossorigin="anonymous"></script>

    <!-- Import Chart.js for chart on dashboard -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

    <!-- Import Axios to easily get data from website api -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="<?= ASSETS ?>css/main.css">

    <title>Document</title>
</head>
<body>

<!-- SideNav Left -->
<?php include_once("includes/sidenav.home.php") ?>

<?= /** @noinspection PhpUndefinedVariableInspection */ $contentPage ?>

<!-- Footer -->
<?php include_once("includes/footer.php") ?>

<!-- Import TyperJS for home page typing text animation -->
<script async src="https://unpkg.com/typer-dot-js@0.1.0/typer.js"></script>
<script src="<?= ASSETS ?>js/sidenav.js" type="application/javascript"></script>

</body>
</html>