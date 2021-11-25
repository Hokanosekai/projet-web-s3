<?php
extract($data);

var_dump($errors);
?>


<section class="container flex">

    <form action="" method="post" enctype="multipart/form-data" id="form">
        <label for="">Titre</label>
        <input type="text" name="title" id="title" value="<?= $evenement? $evenement->getTitre() : "" ?>"><br>
        
        <label for="">Description</label>
        <textarea name="description" id="" cols="30" rows="10"><?= $evenement? $evenement->getDescription() : "" ?></textarea><br>
        
        <label for="places">Nombres de Places</label>
        <input type="number" min="100" name="places" id="places" value="<?= $evenement? $evenement->getPlaces() : "" ?>"><br>
        
        <label for="lieu">Lieu</label>
        <input type="text" name="lieu" id="lieu" value="<?= $evenement? $evenement->getLieu() : "" ?>"><br>
        
        <label for="">Date de Début</label>
        <input type="date" name="date_start" id="date_start" value="<?= $evenement? Utils::unparseDate($evenement->getDateStart()) : "" ?>"><br>

        <label for="">Date de Fin</label>
        <input type="date" name="date_end" id="date_end" value="<?= $evenement? Utils::unparseDate($evenement->getDateEnd()) : "" ?>"><br>

        <label for="type">Type</label>
        <select name="type" id="type">
            <option value="<?= EvtTypes::THEATRE ?>" <?= $evenement? $evenement->getType() == EvtTypes::THEATRE? "selected" : "" : ""?> >Théatre</option>
            <option value="<?= EvtTypes::CONCERT ?>" <?= $evenement? $evenement->getType() == EvtTypes::CONCERT? "selected" : "" : ""?>>Concert</option>
            <option value="<?= EvtTypes::EXPOSITION ?>" <?= $evenement? $evenement->getType() == EvtTypes::EXPOSITION? "selected" : "" : ""?>>Exposition</option>
            <option value="<?= EvtTypes::HUMOUR ?>" <?= $evenement? $evenement->getType() == EvtTypes::HUMOUR? "selected" : "" : ""?>>Humour</option>
        </select><br>


        <label for="img">Image de fond</label>
        <input onchange="reloadImg()" type="file" name="img" id="img"><br>

        <input type="text" name="id" id="" hidden value="<?= $evenement? $evenement->getId() : "" ?>">

        <button type="submit" name="send"><?= $evenement? "Modifier" : "Créer" ?></button>
        <?php if ($evenement) { ?>
            <img src="<?= $evenement->getImgPath() ?>" alt="" id="img_t">
        <?php } ?>
    </form>
    
</section>

<script>
    function reloadImg() {

        var file = document.getElementById('img').files[0];
        var imgExist = document.getElementById('img_t');
        var form = document.getElementById('form')
        var reader  = new FileReader();
        // it's onload event and you forgot (parameters)
        reader.onload = function(e)  {
            if (imgExist) {
                imgExist.src = e.target.result;
            } else {
                var image = document.createElement("img");
                // the result image data
                image.src = e.target.result;
                image.id = "img_t"
                form.appendChild(image);
            }
        }
        // you have to declare the file loading
        reader.readAsDataURL(file);
    }
</script>
