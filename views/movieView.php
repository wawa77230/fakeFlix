<?php
//var_dump($user->isAuthenticated());

ob_start();
?>
    <div class="container row mt-5 mb-5 justify-content-between">
        <div class="col-4">
            <h1 class="text-center text-white"><?= $movie->getName()?></h1>
            <div class="row justify-content-around ">
                <p><?= $movie->getRank()?></p>
                <p><?= $movie->getYear()?></p>
                <p><?= $category->getCategoryForMovie($movie->getCategoryId())?></p>
            </div>
            <p class="description"><?= $movie->getDescription()?></p>
        </div>

        <div class="col-7">
            <iframe  width="100%" height="80%"
                    src="<?= $movie->getIframe()?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write;
                    encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>

            </iframe>
        </div>


    </div>
<?php
$content =ob_get_clean();
$title = $movie->getName();
require "templateView.php";