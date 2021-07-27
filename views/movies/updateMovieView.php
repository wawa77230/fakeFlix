<?php
ob_start()
?>
    <div class="form container">

        <form action="<?= URL?>films/updateValidation" method="post"  enctype="multipart/form-data" data-validate>
            <?php if (isset($_SESSION['alert'])):?>
                <div class="alert alert-<?=$_SESSION['alert']['type']?> text-center text-dark" role="alert">
                    <?=$_SESSION['alert']['msg']?>
                </div>
            <?php endif;?>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control bg-light" value="<?=$movie->getName()?>" id="name"  name="name" data-minlength="2">
            </div>
            <div class="form-group">

                <label for="rank">Note</label>
                <select class="form-control bg-light" id="rank" name="rank" data-requiredselect="-1">
                    <option value="-1" data-type="-1" >Veuillez sélectionner une année</option>
                    <?php for ($i= 0; $i <6; $i++):?>
                        <option value="<?= $i?>" <?php echo ($i == $movie->getRank()) ? 'selected' : ''; ?>><?= $i?></option>
                    <?php endfor;?>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Description</label>
                <textarea class="form-control bg-light" rows="3" id="description" name="description" data-minlength="100"><?=$movie->getDescription()?></textarea>
            </div>
            <div class="form-group">
                <label for="year">Année</label>
                <select class="form-control bg-light" id="year" name="year" data-requiredselect>
                    <option value="-1" data-type="-1">Veuillez sélectionner une année</option>
                    <?php for ($i= 1900; $i <= date("Y"); $i++):?>
                        <option value="<?= $i?>" <?php echo ($i == $movie->getYear()) ? 'selected' : ''; ?>><?= $i?></option>
                    <?php endfor;?>
                </select>
            </div>

            <div class="form-group">
                    <h3>Image :</h3>
                    <?php if($movie->getPicture()):?>
                        <img class="thumbnail" src="<?= URL ?>./public/img/movies/<?=$movie->getPicture()?>" alt="<?=$movie->getName()?>">
                    <?php endif;?>
            </div>
            <div class="form-group">
                <label for="image">Affiche</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="iframe">Lien Youtube</label>
                <input type="text" class="form-control bg-light" id="iframe" value="<?=$movie->getIframe()?>" name="iframe" data-minlength="10" >
            </div>

            <div class="form-group">
                <label for="category">Catégorie</label>
                <select class="form-control bg-light" id="category" name="categoryId" data-requiredselect="-1" >
                    <option value="-1" data-type="-1">Veuillez sélectionner une catégorie</option>
                    <?php foreach ($categories as $category):?>
                        <option value="<?= $category->getId()?>" <?php echo ($category->getId() === $movie->getCategoryId()) ? 'selected' : ''; ?>><?= $category->getName()?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <input type="text" hidden name="id" value="<?= $movie->getId() ?>">

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Modifier</button>
            </div>
        </form>

    </div>
<?php
$content = ob_get_clean();
$title = "Modification ".$movie->getName();
$h1 = "Modification ".$movie->getName();

$formValidator = "<script src='%spublic/js/form/FormValidator.class.js'></script>" ;
$formValidator = sprintf($formValidator,URL);

$scripts = [ $formValidator];

require "./views/templateView.php";
