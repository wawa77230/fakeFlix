<?php
ob_start();
?>


<?php
$content =ob_get_clean();
$title = "Accueil";
$h1 = "Accueil";
require "templateView.php";