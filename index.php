<?php
require 'vendor/autoload.php';

use App\Controller\CategoryController;
use App\Controller\HomeController;
use App\Controller\MoviesController;
use App\Controller\MoviesControllerByAjax;
use App\Controller\UsersController;
use App\Controller\UsersControllerByAjax;
use App\Session\UserSession;

//Permet de repartir depuis la racine
define("URL",str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

const PATH = __DIR__ . "/app/";

$user = new UserSession();
$userController = new UsersController();

try {
    if ($user->isAuthenticated()){
        $homeController = new HomeController();

        if (empty($_GET['page'])){
            $homeController->showMoviesByCat();
        }
        else{

        $url = explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);

        $moviesController = new MoviesController();
        $categoryController = new CategoryController();
        $usersController = new UsersController();

            switch ($url[0]){
                case "accueil":
                    $homeController->showMoviesByCat();
                    break;
                case "films":
                    $user->controlAccess();
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
                    $user->controlAccess();
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
                    if (!empty($url[1]) && ctype_digit($url[1]) || $url[1] == 0){
                        $moviesController->showMoviesByCategorie($url[1]);
                    }
                    else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;

                case "film":
                    //var_dump($url);die();

                     if (!empty($url[1]) && ctype_digit($url[1])){

                        $moviesController->showMovie((int)$url[1]);
                     }
                     else {
                         throw  new Exception('La page n\'existe pas');
                     }
                    break;
                case "utilisateurs":
                    $user->controlAccess();
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

                        $moviesByAjax = new MoviesControllerByAjax();
                        if ($url[2] === "search"){
                            $moviesByAjax->search($url[3]);
                        }elseif ($url[2] === "query"){
                            $moviesByAjax->search($url[3]);
                        }elseif ($url[2] === "d" && $_POST){

                            $user->controlAccess();
                            $id = $_POST['id'];
                            $moviesController->deleteMovie($id);
                        }
                    }elseif ($url[1] === "users") {
                        $user->controlAccess();

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
                        $user->controlAccess();

                        if ($url[2] === "d" && $_POST){
                            $id = $_POST['id'];
                            $categoryController->deleteCategory($id);
                        }
                    }
                    break;

                case "auth":
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
                        $user->signUp();
                    }
                    else if($url[1] === "creation"){
                        $userController->addUserValidation();
                        }
                    else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;

                case "connexion":
                    require 'views/users/loginView.php';
                    unset($_SESSION['alert']);
                    break;

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