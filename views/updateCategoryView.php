<?php
ob_start()
?>
    <div class="form container">

        <form action="<?= URL?>categories/updateValidation" method="post" data-validate>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control bg-light" value="<?=$category->getName()?>" id="name"  name="name" data-minlength="2">
            </div>

            <input type="text" hidden name="id" value="<?= $category->getId() ?>">

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Modifier</button>
            </div>
        </form>

    </div>
<?php
$content = ob_get_clean();
$title = "Modification ".$category->getName();
$h1 = "Modification ".$category->getName();

$formValidator = "<script src='%spublic/js/form/FormValidator.class.js'></script>" ;
$formValidator = sprintf($formValidator,URL);

$scripts = [ $formValidator];

require "./views/templateView.php";
