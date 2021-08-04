<?php
ob_start();
?>
    <div class="text-center mt-5">
        <h1 class="grey"><?= $msg?></h1>
        <a href="#" onClick='javascript:history.back();' class="backlink">Retour</a>
    </div>
<?php
$content =ob_get_clean();
$title = "Erreur";
$h1 = "Oupss !!!";
require "templateView.php";