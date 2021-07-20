<?php
//var_dump($user->isAuthenticated());

ob_start();
?>
    <?php if ($_SESSION['user']['isAdmin']):?>
        <div class="col-1 align-self-end">
            <a href="<?=URL?>films/u/<?= $movie->getId()?>" class="btn btn-success">Modifier</a>
        </div>
    <?php endif;?>
    <div class="container row mt-5 mb-5 justify-content-between">
        <div class="col-5">
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
                    <p class="infos category"><?= $category->getName()?></p>
            </div>
            <p class="description mt-5"><?= $movie->getDescription()?></p>
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
$h1 = $movie->getName() ;
$content =ob_get_clean();
$title = $movie->getName();
require "templateView.php";