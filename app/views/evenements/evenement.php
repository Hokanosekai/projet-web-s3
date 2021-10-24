<?php
extract($data);
?>

<section class="container flex row">

    <div class="evenement-container">
        
        <div class="header">
            <img src="<?= $evenement->getImgPath() ?>" alt="">
            
            <div class="info">
                <h2 class="title"><?= $evenement->getTitre() ?></h2>
                <a href="#description"><i class="fas fa-file-alt"></i> Lire la description</a>
                <p><i class="fas fa-calendar-alt"></i> Du <?= $evenement->getDateStart() ?> au <?= $evenement->getDateEnd()?></p>
                <a href="#map"><i class="fas fa-map-marker-alt"></i> <?= $evenement->getLieu() ?></a>
                <div class="action">
                    <a href="<?= HOST ?>add-fav"></a><i class="far fa-heart"></i>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= HOST ?>"></a><i class="fas fa-share-alt"></i>
                </div>
            </div>
        </div>
        
        <div class="description" id="description">
            <span class="title">DESCRIPTION</span>

            <p><?= $evenement->getDescription() ?></p>
        </div>
        
        <div class="map" id="map">
            <span class="title">C'EST PAR ICI !</span>
            <iframe
                    width="100%"
                    height="80%"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    src="https://www.google.com/maps/embed/v1/place?key=<?= API_KEY_GOOGLE_MAPS ?>&q=<?= $evenement->getLieu() ?>">
            </iframe>
        </div>
    </div>

    <!--<div class="tarif-container">

        <div class="tarifs">
            <p>Tarifs</p>

            <div class="tarif">
                <span class="title">Etudiant</span>
                <span class="price">9,00€</span>
            </div>

            <a href="#reservation" class="btn rerservate">
                <i class="fas fa-ticket-alt"></i>
                <p>Voir les dates</p>
            </a>
        </div>

        <img src="<?/*= $evenement->getImgPath() */?>" alt="">
    </div>

    <div class="reservation" id="reservation">

    </div>-->

</section>