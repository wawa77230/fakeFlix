<?php
ob_start();
?>


        <?php if ($movies):?>
        <div class="multiple-items">

            <?php foreach ($movies as $movie):?>
                <img src="<?= URL?>public/img/movies/<?= $movie->getPicture()?>" alt="<?= $movie->getName()?>" data-url="<?= URL ?>film/<?= $movie->getId()?>"/>
            <?php endforeach;?>
        </div>
        <?php else:?>
            <h5 class="text-center text-light">Aucun film trouvé</h5>
        <?php endif;?>
<?php
$content =ob_get_clean();

$title = "Résultat de la catégorie: ".$categorieName;
$h1 = "Résultat de la catégorie : ".$categorieName;


$indexJsScript = "<script src='%spublic/js/home.js'></script>";
$indexJsScript = sprintf($indexJsScript ,URL);

$scripts = ["<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js'></script>",
    $indexJsScript];

require "templateView.php";

