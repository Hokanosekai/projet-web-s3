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

    <link rel="stylesheet" href="<?= ASSETS ?>css/style.css">

    <title>Document</title>
</head>
<body class="bg-grey-1 flex flex-row w-full h-screen relative">

<?php if (isset($_SESSION['notif'])) {?>
    <div id="notif" onclick="removeNotif()" class="absolute flex flex-col <?= $_SESSION['notif']['status'] === 200? 'bg-green-2' : 'bg-red-2' ?> text-white cursor-pointer rounded-lg p-4 min-h-[24] w-1/4 z-10 left-1/2 top-1/3 transform -translate-x-1/2 bac shadow-2xl filter drop-shadow-2xl content-between">
        <div class="flex flex-row justify-between items-start">
            <p class="text-2xl uppercase font-semibold"><?= $_SESSION['notif']['status'] === 200? "Success" : "Error" ?></p>
            <i class="text-xl fas fa-times"></i>
        </div>
        <p class="text-xl"><?= $_SESSION['notif']['message'] ?></p>
    </div>
    <script>
        const removeNotif = () => {
            document.getElementById('section').classList.remove(...['filter', 'blur-lg'])
            document.getElementById('notif').classList.toggle('hidden')
        }
    </script>
<?php } ?>

<!-- SideNav Left -->
<?php include_once("includes/sidenav.dashboard.php") ?>

<?= /** @noinspection PhpUndefinedVariableInspection */ $contentPage ?>

<!-- Footer -->
<?php include_once("includes/footer.php") ?>

<!-- Import TyperJS for home page typing text animation -->
<script async src="https://unpkg.com/typer-dot-js@0.1.0/typer.js"></script>

</body>
    </html><?php
