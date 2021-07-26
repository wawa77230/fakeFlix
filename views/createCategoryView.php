<?php
ob_start()
?>
    <div class="form container">
        <form action="<?= URL?>categories/validation" method="post"  data-validate>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control bg-light" id="name"  name="name" data-minlength="2" >
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Ajouter </button>
            </div>
        </form>

    </div>
<?php
$content = ob_get_clean();
$title = "Création nouvelle catégorie";
$h1 = "Création nouvelle catégorie";

$formValidator = "<script src='%spublic/js/form/FormValidator.class.js'></script>" ;
$formValidator = sprintf($formValidator,URL);

$scripts = [ $formValidator];

require "./views/templateView.php";
