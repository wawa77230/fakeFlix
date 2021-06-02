<?php

//Permet de repartir depuis la racine
define("URL",str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "app/class/UserSession.php";

$user = new UserSession();


try {
    if ($user->isAuthenticated()){
        if (empty($_GET['page'])){
            require 'views/homeView.php';
//        $prestationController->showPrestations();
        }
//        else{
//        $url = explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);

//            switch ($url[0]){
//                case "accueil":
//                    require "views/loginView.php";
//                    break;
//            }
//        }
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
                    require "views/singIn.php";
                    break;

//                    A modifier repétitif
                case "connection":
                    require 'views/loginView.php';
                    break;

                case "authentification":

                    if (empty($url[1])){
                        $user->connection();
                    }
                    else{
                        require "views/loginView.php";
                    }
//                      else if($url[1] === "login"){
//                    $userController->authentification();
//                }

                    break;
            }

        }
    }

}
catch (Exception $e){
    $msg = $e->getMessage();
    require "views/errorView.php";
}