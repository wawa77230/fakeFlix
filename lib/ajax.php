<?php

require PATH."controllers/MoviesController.php";

if (isset($_POST['action']) && $_POST['action'] == "insertMovie"){
    var_dump($_POST);
    var_dump($_FILES);
    die();
    $movieController = new MoviesController();
    $movieController->addMovieValidation();
//    $backController->addBookingValidationByAjaxDb();
}