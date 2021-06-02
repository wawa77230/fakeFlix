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

    public function createUserSession($id, $firstName, $lastName, $email, $isAdmin)
    {
        $_SESSION["user"] = ["id"=> $id,
            "firstName"=> $firstName,
            "lastName"=> $lastName,
            "email"=> $email,
            "isAdmin"=> $isAdmin,
        ];
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
        return isset($_SESSION["user"]);
    }

    public function isAdmin():bool
    {
        if ($_SESSION["user"]["isAdmin"]){
            return true;
        }
        return false;
    }
    public function connection()
    {
        if ($this->isAuthenticated()){
            header("Location:".URL."accueil");
        }
        require_once "views/loginView.php";
        unset($_SESSION['alert']);
    }

    public function kill()
    {
        $_SESSION = [];
        session_destroy();
        header("Location:".URL."authentification");
    }
}