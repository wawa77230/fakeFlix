<?php
require_once PATH."models/UserManager.php";
require_once PATH."class/UserSession.php";

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

                $this->flagBag('success',$_POST['name'], 'addUser');

                //L'utilisateur peut se connecter avec ses nouveaux identifiants
            }else{
                $this->flagBag('danger',$_POST['name'], 'errorUser');
                //L'utilisateur est informé d'une mauvaise saisie ou que son compte n'existe pas
            }
        }
        $this->userSession->redirection();

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

//            var_dump($isAdmin);
//            die();
            $this->userManager->addUserDb($firstName, $lastName, $email, $password, $isAdmin, $secret, $createAt);

            //Si il n'y a pas d'erreur cet header sera renvoyé !!!!!!!!!!!!
            if (isset($_SESSION['alert'])){
                $this->userSession->redirection();
            }

        }

//        if ($_POST['hour'] === '#'? $_POST['hour']= '00': $_POST['hour'] )
//            if ($_POST['minute'] === '#'? $_POST['minute']= '00': $_POST['minute'] )
//                $duration = $_POST['hour'].':'.$_POST['minute'].':00';
//
//
//        $file = $_FILES['image'];
//        $directory = "public/images/";
//        $nameImage = $this->addImage($file, $directory);
//
//        $this->prestationManager->addPrestationDb($_POST['title'],$_POST['description'],$_POST['price'],$duration,$nameImage);

//        $_SESSION['alert'] = [
//            "type" => "success",
//            "msg" => "Ajout de <strong>".$_POST['title']."</strong> réalisé."
//        ];
//
//        header("Location:".URL."prestations");
    }

    public function showUsers(){
        $users = $this->userManager->getUsers();
        require "./views/usersListView.php";
//        unset($_SESSION['alert']);
    }

}