<?php
//var_dump($user->isAuthenticated());

ob_start();
?>
    <div class="container row mt-5 mb-5 justify-content-between">
        <div class="col-5">
            <h1 class="text-center text-white"><?= $movie->getName()?></h1>
            <div class="row justify-content-around  align-items-center">
                <div>
                    <?php for ($i =$movie->getRank(); $i > 0; $i-- ):?>
                        <span class="red-star">★</span>
                    <?php endfor;?>
                    <?php for ($j = 5 - $movie->getRank(); $j > 0; $j-- ):?>
                        <span class="grey-star">★</span>
                    <?php endfor;?>
                </div>
                    <p class="infos"><?= $movie->getYear()?></p>
                    <p class="infos category"><?= $category->getCategoryForMovie($movie->getCategoryId())?></p>
            </div>
            <p class="description"><?= $movie->getDescription()?></p>
        </div>

        <div class="col-7">
            <iframe
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