<?php
ob_start();
?>
    <div class="text-center mt-5">
        <?= $msg?>
        <a href="<?=URL?>accueil" class="button">Retour</a>
    </div>
<?php
$content =ob_get_clean();
$title = "Erreur";
$h1 = "Oupss !!!";
require "templateView.php";