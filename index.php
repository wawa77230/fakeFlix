<?php

//Permet de repartir depuis la racine
define("URL",str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

define("PATH",__DIR__."/app/");

require_once PATH."class/UserSession.php";
require_once PATH."controllers/UsersController.php";

$user = new UserSession();
$userController = new UsersController();

try {
    if ($user->isAuthenticated()){
        require_once PATH.'controllers/HomeController.php';
        $homeController = new HomeController();

        if (empty($_GET['page'])){
            $homeController->showMoviesByCat();
        }
        else{

        $url = explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);

        require PATH.'controllers/MoviesController.php';
        require_once PATH."controllers/CategoryController.php";
        require_once PATH."controllers/UsersController.php";
        $moviesController = new MoviesController();
        $categoryController = new CategoryController();
        $usersController = new UsersController();

            switch ($url[0]){
                case "accueil":
                    //retirer accueil du chemin
                    $homeController->showMoviesByCat();
                    break;
                case "films":
                    if (empty($url[1])){
                        $moviesController->showMovies();
                    }elseif ($url[1] === "c"){
                        $moviesController->createMovie();
                    }elseif ($url[1] === "validation"){
                        $moviesController->addMovieValidation();
                    }elseif ($url[1] === "u"){
                        $moviesController->updateMovie($url[2]);
                    }elseif ($url[1] === "updateValidation"){
                        $moviesController->updateMovieValidation();
                    }
                    else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;
                case "categories":
                    if (empty($url[1])){
                        $categoryController->showCategories();
                    }elseif ($url[1] === "c"){
                        $categoryController->createCategory();
                    }elseif ($url[1] === "validation"){
                        $categoryController->addCategoryValidation();
                    }elseif ($url[1] === "u"){
                        $categoryController->updateCategory($url[2]);
                    }elseif ($url[1] === "updateValidation"){
                        $categoryController->updateCategoryValidation();
                    }
                    else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;

                case "categorie":
                    if (!empty($url[1]) && ctype_digit($url[1])){
                        $moviesController->showMoviesByCategorie($url[1]);
                    }
                    else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;

                case "film":
                     if (!empty($url[1]) && ctype_digit($url[1])){
                        $moviesController->showMovie($url[1]);
                     }
                     else {
                         throw  new Exception('La page n\'existe pas');
                     }
                    break;
                case "utilisateurs":
                    if (empty($url[1])){
                        $usersController->showUsers();
                    }else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;

                case "recherche":
                    $moviesController->search();
                    break;
                case "ajax":
                    if($url[1] === "movies"){

                        require_once PATH."controllers/MoviesControllerByAjax.php";
                        $moviesByAjax = new MoviesControllerByAjax();
                        if ($url[2] === "search"){
                            $moviesByAjax->search($url[3]);
                        }elseif ($url[2] === "query"){
                            $moviesByAjax->search($url[3]);
                        }elseif ($url[2] === "d" && $_POST){
                            $id = $_POST['id'];
                            $moviesController->deleteMovie($id);
                        }
                    }elseif ($url[1] === "users") {

                        require_once PATH."controllers/UsersControllerByAjax.php";
                        $usersByAjax = new UsersControllerByAjax();
                        if ($url[2] === "updateAdminStatus"){
                            $usersByAjax->changeAdminStatus();
                        }elseif ($url[2] === "updateIsBlockedStatus"){
                            $usersByAjax->changeIsBlockedStatus();
                        } elseif ($url[2] === "d" && $_POST){
                            $id = $_POST['id'];
                            $usersController->deleteUser($id);
                        }
                    }elseif ($url[1] === "categories") {

                        if ($url[2] === "d" && $_POST){
                            $id = $_POST['id'];
                            $categoryController->deleteCategory($id);
                        }
                    }

                    break;

                case "auth":
//
                        if ($url[1] === "logout"){
                        $user->kill();
                    }else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;

                default : throw  new Exception('La page n\'existe pas');

            }
        }
    }
    else {
        if (empty($_GET['page'])){
            $user->redirection();
        }
        else {
            $url = explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);

            switch ($url[0]){
                case "inscription":
                    if (empty($url[1])){
                        $user->singIn();
                    }
                    else if($url[1] === "creation"){
                        $userController->addUserValidation();
                        header("Location:".URL."connexion");
                    }
                    else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;

                case "connexion":
                    require 'views/loginView.php';
                    break;

//                case "accueil":
//                    $user->redirection();
//                    break;

                case "authentification":
                    if (empty($url[1])){
                        $user->connection();
                    }elseif ($url[1] === "login"){
                        $userController->authentification();
                    }else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;

                default : throw  new Exception('La page n\'existe pas');
            }
        }
    }
}
catch (Exception $e){
    $msg = $e->getMessage();
    require "views/errorView.php";
}