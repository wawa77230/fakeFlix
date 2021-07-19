<?php
ob_start();
?>
    <div class="text-center mt-5 container">
        <div class="container">
            <form action="recherche" method="get">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-light" id="submit" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                    <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']): ''?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" required>
                </div>
            </form>
        </div>

        <!-- Loader -->
        <div class="loader">
            <div class="point"></div>
            <div class="point"></div>
            <div class="point"></div>
        </div>

        <div id="result" class="mt-5">
        </div>

    </div>
<?php
$content =ob_get_clean();
$title = "Résultat | ".$_GET['search'];
$h1 = "Résultat : ".$_GET['search'];

$searchMovieByAjaxScript = "<script src='%spublic/js/ajax/searchMoviesByAjax.js'></script>";
$searchMovieByAjaxScript = sprintf($searchMovieByAjaxScript,URL);

$scripts = [$searchMovieByAjaxScript];

require "templateView.php";