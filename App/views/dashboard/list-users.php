<?php
extract($data)
?>


<form id="section" class="flex flex-col w-full space-y-5 py-6 px-20 text-white <?= isset($_SESSION['notif'])? 'filter blur-lg' : '' ?>" method="post" action="">

    <h3 class="text-2xl">Utilisateurs</h3>

    <div class="grid grid-cols-7 gap-12 justify-between">

        <label for="all" class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 cursor-pointer <?= ($type == 'all')? "bg-blue-4": "" ?> hover:bg-blue-4">
            <input class="invisible absolute w-full h-full" onChange="this.form.submit()" type="radio" id="all" name="type" value="all" <?= ($type == 'all')? "checked": "" ?>>
            All
        </label>

        <label for="resa" class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 cursor-pointer <?= ($type == 'resa')? "bg-blue-4": "" ?> hover:bg-blue-4">
            <input class="invisible absolute w-full h-full" onChange="this.form.submit()" type="radio" id="resa" name="type" value="resa" <?= ($type == 'resa')? "checked": "" ?>>
            Avec Réservation
        </label>

        <label for="admin" class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 cursor-pointer <?= ($type == 'admin')? "bg-blue-4": "" ?> hover:bg-blue-4">
            <input class="invisible absolute w-full h-full" onChange="this.form.submit()" type="radio" id="admin" name="type" value="admin" <?= ($type == 'admin')? "checked": "" ?>>
            Admin
        </label>

        <label for="user" class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 cursor-pointer <?= ($type == 'user')? "bg-blue-4": "" ?> hover:bg-blue-4">
            <input class="invisible absolute w-full h-full" onChange="this.form.submit()" type="radio" id="user" name="type" value="user" <?= ($type == 'user')? "checked": "" ?>>
            User
        </label>

        <div></div>

        <button class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 text-xl <?= ($offset-15 < 0)? "opacity-40": "hover:bg-blue-4" ?>" type="submit" value="<?= $offset-15 ?>" name="offset" <?= ($offset-15 < 0)? "disabled": "" ?>>
            <!--<i class="fas fa-caret-left"></i>--> <p>◀️</p>
        </button>
        <button class="flex flex-rows items-center justify-center rounded-lg relative px-4 py-2 bg-grey-4 text-xl <?= ($offset+15 >= $nb_users)? "opacity-40": "hover:bg-blue-4" ?>" type="submit" value="<?= $offset+15 ?>" name="offset" <?= ($offset+15 >= $nb_users)? "disabled": "" ?>>
            <!--<i class="fas fa-caret-right"></i>--> <p>▶️</p>
        </button>
    </div>

    <div class="grid grid-cols-6 w-full px-4 py-2 bg-grey-3 rounded-lg text-lg">
        <span>#ID</span>
        <span>Nom</span>
        <span>Prenom</span>
        <span>Mail</span>
        <span>Date</span>
        <span>Type</span>
    </div>

    <div class="flex flex-col space-y-2">
        <?php foreach ($users as $user) { ?>
            <div class="grid grid-cols-6 w-full py-2 px-4 rounded-lg text-lg">
                <span><?= $user->getId() ?></span>
                <span><?= $user->getNom() ?></span>
                <span><?= $user->getPrenom() ?></span>
                <span><?= $user->getMail() ?></span>
                <span><?= $user->getCreateAt() ?></span>
                <div class="flex flex-row justify-between items-center">
                    <span><?= $user->getType() ?></span>
                    <a href="<?= HOST ?>user-delete/id/<?= $user->getId() ?>"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
        <?php } ?>
    </div>

</form>

