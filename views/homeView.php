<?php
ob_start();
?>
<?php if ($categories):?>
    <?php foreach ($categories as $category):?>
        <?php if ($movies->getMovieByCatId($category->getId())):?>

        <h3><a href="<?=URL?>categorie/<?= $category->getId()?>"><?= $category->getName()?></a></h3>

        <div class="multiple-items">
            <?php foreach ($movies->getMovieByCatId($category->getId()) as $movie):?>
                <img src="<?= URL ?>public/img/movies/<?= $movie->getPicture()?>" class="images" alt="<?= $movie->getName()?>" data-url="<?= URL ?>film/<?= $movie->getId()?>"/>
            <?php endforeach;?>
        </div>
        <?php endif;?>
    <?php endforeach;?>

    <?php if ($moviesC):?>
        <h3><a href="<?=URL?>categorie/0">Divers</a></h3>

        <div class="multiple-items">
            <?php foreach ($moviesC as $movie):?>
                <img src="<?= URL ?>public/img/movies/<?= $movie->getPicture()?>" class="images" alt="<?= $movie->getName()?>" data-url="<?= URL ?>film/<?= $movie->getId()?>"/>
            <?php endforeach;?>
        </div>
    <?php endif;?>
<?php endif;?>

<?php
$content =ob_get_clean();

$title = "Accueil";
$h1 = "Accueil";


$indexJsScript = "<script src='%spublic/js/home.js'></script>";
$indexJsScript = sprintf($indexJsScript ,URL);

$scripts = ["<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js'></script>",
            $indexJsScript];

$links = ["<link rel='stylesheet' type='text/css' href='//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css'/>"];


require "templateView.php";

