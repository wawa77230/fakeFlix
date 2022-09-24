<?php

namespace App\Session;

use App\Utility\TemplatingTools;

class UserSession extends TemplatingTools
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function createUserSession($id, $firstName, $lastName, $email, $isAdmin, $secret, $isBlocked)
    {
        $_SESSION["user"] = [
            "webSite" => 'fakeFlix',
            "id" => $id,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "isAdmin" => $isAdmin,
            "isBlocked" => $isBlocked
        ];

        if (isset($_POST['auto'])) {
            setcookie('auth', $secret, time() + 364 * 24 * 3600, '/', null, false, true);
        }
        $this::isAuthenticated();
    }

    public function isAuthenticated(): bool
    {
        if (isset($_SESSION["user"]) && $_SESSION["user"]["webSite"] === 'fakeFlix') {
            return isset($_SESSION["user"]);
        } else {
            return false;
        }
    }

    public function connection()
    {
        if ($this->isAuthenticated()) {
            header("Location:" . URL . "accueil");
        } else {
            $this::redirection();
        }
    }

    public function signUp()
    {
        if ($this->isAuthenticated()) {
            header("Location:" . URL . "accueil");
        } else {
            require 'views/users/signUp.php';
            //Permet de supprimer les alertes gardées en session aprés les redirections du CRUD
            $this->removeFlashBag();
        }
    }

    public function redirection()
    {

        if ($this->isAuthenticated()) {
            header("Location:" . URL . "accueil");
        } else {
            header("Location:" . URL . "connexion");
        }
    }

    public function controlAccess()
    {
        //Si l'utilisateur n'est pas admin il sera redirigé vers une page d'erreur
        if (!$_SESSION["user"]['isAdmin']) {
            throw  new Exception('La page n\'existe pas');
        }
    }

    public function kill()
    {
        $_SESSION = [];
        session_destroy();
        $this::redirection();
    }
}