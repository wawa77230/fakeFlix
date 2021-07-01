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

        $this->isAuthenticated();
    }

    public function isConnected()
    {
        if (!$this->isAuthenticated()){
            $this->connection();
        }
    }

    public function isAuthenticated()
    {
        if ($_SESSION["user"]["webSite"] === 'fakeFlix'){
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
            header("Location:".URL."authentification/login");
        }
        unset($_SESSION['alert']);

    }

    public function isAdmin():bool
    {
        if ($_SESSION["user"]["isAdmin"] && $_SESSION["user"]["webSite"] === 'fakeFlix'){
            return true;
        }
        return false;
    }

    public function singIn(){
        if (!$this->isAuthenticated()){
            header("Location:".URL."inscription");
        }else{
            header("Location:".URL."accueil");
        }
    }

    public function kill()
    {
        $_SESSION = [];
        session_destroy();
        header("Location:".URL."connexion");
    }
}