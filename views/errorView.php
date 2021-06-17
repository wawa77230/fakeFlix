<?php
ob_start();
?>
    <div class="text-center mt-5">
        <?= $msg?>
<!--        <a href="--><?//=URL?><!--accueil" class="button">Retour</a>-->
        <input type='button' value='Retour' name='bnom' onClick='javascript:history.back();'>
    </div>
<?php
$content =ob_get_clean();
$title = "Erreur";
$h1 = "Oupss !!!";
require "templateView.php";