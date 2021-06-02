<?php
ob_start();
?>
<p>Hello</p>

<?php
$content =ob_get_clean();
//var_dump($_SESSION);
//var_dump($_COOKIE['auth']);
$title = "Accueil";
$h1 = "Accueil";
require "templateView.php";