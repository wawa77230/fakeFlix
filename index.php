<?php

//Permet de repartir depuis la racine
define("URL",str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "app/class/UserSession.php";
require_once "app/controllers/UsersController.php";
require_once "app/controllers/CategoryController.php";

$user = new UserSession();
$userController = new UsersController();
$categoryController = new CategoryController();

try {
    if ($user->isAuthenticated()){
        if (empty($_GET['page'])){
            require 'views/homeView.php';
//        $prestationController->showPrestations();
        }
        else{

        $url = explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);
        require './app/controllers/MoviesController.php';
        $moviesController = new MoviesController();

            switch ($url[0]){
                case "accueil":
                    require "views/homeView.php";
                    break;
                case "films":
                    if (empty($url[1])){
                        $moviesController->showMovies();
                        break;
                    }  else {
                        throw  new Exception('La page n\'existe pas');
                    }
                    break;
                case "film":
                     if (!empty($url[1]) && ctype_digit($url[1])){
                        $moviesController->showMovie($url[1]);
                        break;
                     }
                     else {
                         throw  new Exception('La page n\'existe pas');
                     }
                    break;
            }
        }
    }
    else {
            if (empty($_GET['page'])){
                require 'views/loginView.php';
//        $prestationController->showPrestations();
            }
            else {
                $url = explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);

                switch ($url[0]){
                case "inscription":
                    if (empty($url[1])){
                        $user->connection();
                        require 'views/singIn.php';
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
                        $userController->authentification();
                    }
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