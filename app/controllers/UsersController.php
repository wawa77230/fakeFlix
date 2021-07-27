<?php
require_once PATH."models/UserManager.php";
require_once PATH."class/UserSession.php";
require_once PATH."class/TemplatingTools.php";

class UsersController extends TemplatingTools
{
    private $userManager;
    private $userSession;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->userSession = new UserSession();
        $this->userManager->findAllUsers();
    }

    public function authentification(){

        if ($_POST){

            $email = $_POST['email'];
            $pwd = $_POST['pwd'];

            if ($this->userManager->findByEmailAndCheckPassword($email, $pwd)){

                $id = $this->userManager->findByEmailAndCheckPassword($email, $pwd)->getId();
                $firstName = $this->userManager->findByEmailAndCheckPassword($email, $pwd)->getFirstName();
                $lastName = $this->userManager->findByEmailAndCheckPassword($email, $pwd)->getLastName();
                $isAdmin = $this->userManager->findByEmailAndCheckPassword($email, $pwd)->getIsAdmin();
                $secret = $this->userManager->findByEmailAndCheckPassword($email, $pwd)->getSecret();

                $this->userSession->createUserSession($id, $firstName, $lastName, $email, $isAdmin, $secret );


                header("Location:".URL."accueil");
            }else{

                $this->flashBag('danger','Utilisateur inconnu !');

                //A supprimer quand redirection faite
                $this->userSession->redirection();

            }
        }else{
            $this->flashBag('danger','Un problème est survenu lors de votre authentification, veuillez réessayer ulterieurement.');
            //A supprimer quand redirection faite
            $this->userSession->redirection();

        }

        //Futur redirection pour toute situation
//        $this->userSession->redirection();
    }

    public function addUserValidation()
    {
        if(isset($_POST["firstName"]) && strlen(trim($_POST["firstName"]))>=2
            && isset($_POST["lastName"]) && strlen(trim($_POST["lastName"]))>=2
            && isset($_POST["email"]) && filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)
            && isset($_POST["pwd"]) && strlen($_POST["pwd"]) >= 8
            && isset($_POST["pwd-check"]) && $_POST["pwd-check"] == $_POST["pwd"]
        ){

            $firstName = trim($_POST["firstName"]) ;
            $lastName = trim($_POST["lastName"]) ;
            $email = trim($_POST["email"]) ;
            $password = trim($_POST["pwd"]);
            $password = password_hash($password,PASSWORD_DEFAULT);
            $isAdmin = 0;
            $createAt = date("Y-m-d H:i:s");
            $secret = password_hash(random_int(0,1000),PASSWORD_DEFAULT);

//
            $this->userManager->addUserDb($firstName, $lastName, $email, $password, $isAdmin, $secret, $createAt);
            $this->flashBag('success',$firstName, 'addUser');

        }else{
            $this->flashBag('danger','Un problème est survenu lors de la création de votre profil! Veuillez réessayer ulterieurement.');
        }

        $this->userSession->redirection();
    }
}