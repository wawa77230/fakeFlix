<?php

//Permet de repartir depuis la racine
define("URL",str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

define("PATH",__DIR__."/app/");

require_once "app/class/UserSession.php";
require_once "app/controllers/UsersController.php";

$user = new UserSession();
$userController = new UsersController();

try {
    if (isset($user) && $user->isAuthenticated()){
        require_once './app/controllers/HomeController.php';
        $homeController = new HomeController();

        if (empty($_GET['page'])){
            $homeController->showMoviesByCat();
        }
        else{

        $url = explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);

        require './app/controllers/MoviesController.php';
        require_once "app/controllers/CategoryController.php";
        $moviesController = new MoviesController();
        $categoryController = new CategoryController();


            switch ($url[0]){
                case "accueil":
                    //retirer accueil du chemin
                    var_dump($_SESSION);
                    $homeController->showMoviesByCat();
                    break;
                case "films":
                    if (empty($url[1])){
                        $moviesController->showMovies();
                        break;
                    }elseif ($url[1] === "c"){
                        $moviesController->createMovie();
                    }elseif ($url[1] === "validation"){
                        $moviesController->addMovieValidation();
                    }elseif ($url[1] === "u"){
                        $moviesController->updateMovie($url[2]);
                    }elseif ($url[1] === "updateValidation"){
                        $moviesController->updateMovieValidation();
                    }elseif ($url[1] === "d"){
                        $moviesController->deleteMovie($url[2]);
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
                case 'ajax':
                    var_dump('coucou');
                    var_dump($_POST);
                    break;

                case "authentification":
                    if (empty($url[1])){
                        $user->connection();
                    }elseif ($url[1] === "logout"){
                        $user->kill();
                    }else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;
            }
        }
    }
    else {
            if (empty($_GET['page'])){
                require 'views/loginView.php';
            }
            else {
                $url = explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);

                switch ($url[0]){
                case "inscription":
                    if (empty($url[1])){
                        $user->singIn();
                    }
                    else if($url[1] === "create"){
                        $userController->addUserValidation();
                        header("Location:".URL."connexion");
                    }
                    else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;

//                    A modifier repétitif
                case "connexion":
                    require 'views/loginView.php';
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
//                      else if($url[1] === "login"){
//                    $userController->authentification();
//                }
            }

        }
    }


}
catch (Exception $e){
    $msg = $e->getMessage();
    require "views/errorView.php";
}