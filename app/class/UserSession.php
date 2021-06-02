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
        $_SESSION["user"] = ["id"=> $id,
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
        unset($_SESSION['alert']);

    }

    public function kill()
    {
        $_SESSION = [];
        session_destroy();
        header("Location:".URL."connexion");
    }
}