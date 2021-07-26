<?php
ob_start();
?>

    <?php foreach ($categories as $category):?>

        <h3><?= $category->getName()?></h3>

        <div class="multiple-items">
            <?php foreach ($movies->getMovieByCatId($category->getId()) as $movie):?>
                <img src="./public/img/movies/<?= $movie->getPicture()?>" alt="<?= $movie->getName()?>" data-url="<?= URL ?>film/<?= $movie->getId()?>"/>
<!--                <img class="thumbnail" src="https://www.whats-on-netflix.com/wp-content/uploads/2015/11/ftwd-featured.jpg"/>-->
<!--                <img src="https://pmcdeadline2.files.wordpress.com/2014/06/house-of-cards-seaosn-2__140603234815.jpg"/>-->
<!--                <img src="http://www.underbellyofsunshine.com/wp-content/uploads/2015/04/Bojack%20Horseman.jpg"/>-->
<!--                <img src="http://www.themarysue.com/wp-content/uploads/2015/10/maxresdefault5.jpg"/>-->
<!--                <img src="https://i.ytimg.com/vi/Ymw5uvViqPU/maxresdefault.jpg"/>-->
<!--                <img src="http://media.comicbook.com/2016/07/daredevil-netflix-190285.jpg"/>-->
            <?php endforeach;?>
        </div>
    <?php endforeach;?>
<?php
$content =ob_get_clean();

$title = "Accueil";
$h1 = "Accueil";


$indexJsScript = "<script src='%spublic/js/home.js'></script>";
$indexJsScript = sprintf($indexJsScript ,URL);

$scripts = ["<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js'></script>",
            $indexJsScript];

require "templateView.php";

