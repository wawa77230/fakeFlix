<?php


class UserSession
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public function createUserSession($id, $firstName, $lastName, $email, $isAdmin, $secret)
    {
        $_SESSION["user"] = [
            "webSite"=> 'fakeFlix',
            "id"=> $id,
            "firstName"=> $firstName,
            "lastName"=> $lastName,
            "email"=> $email,
            "isAdmin"=> $isAdmin
        ];

        if (isset($_POST['auto'])){
            setcookie('auth',$secret, time() + 364*24*3600, '/', null, false, true);
        }

        $this::isAuthenticated();
    }

    public function isAuthenticated()
    {
        if (isset($_SESSION["user"]) && $_SESSION["user"]["webSite"] === 'fakeFlix'){
            return isset($_SESSION["user"]);
        }else {
            return false;

        }

    }

    public function connection()
    {
        if ($this->isAuthenticated()){
            header("Location:".URL."accueil");
        }else{
            $this::redirection();
        }
    }

//    public function isAdmin():bool
//    {
//        if ($_SESSION["user"]["isAdmin"] && $_SESSION["user"]["webSite"] === 'fakeFlix'){
//            return true;
//        }else{
//            throw  new Exception('La page n\'existe pas');
//
////            return false;
//        }
//    }

    public function singIn(){
        if ($this->isAuthenticated()){
            header("Location:".URL."accueil");
        }else{
            require 'views/singIn.php';
        }
    }

    public function redirection(){

        if ($this->isAuthenticated()){
            header("Location:".URL."accueil");
        }else{
            header("Location:".URL."connexion");
            //        unset($_SESSION['alert']);
        }
        //Ajouter redirection si connecté
    }

    public function kill()
    {
        $_SESSION = [];
        session_destroy();
        $this::redirection();
    }
}