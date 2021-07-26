<?php
require_once PATH."models/UserManagerByAjax.php";

class UsersControllerByAjax
{
    private $userManagerByAjax;

    public function __construct()
    {
        $this->userManagerByAjax = new UserManagerByAjax();
    }

    public function changeAdminStatus(){
        if (ctype_digit($_POST['id']) && ctype_digit($_POST['status']) ){
            //La valeur $_POST['status'] a envoyer doit etre l'opposé (booléen) de celui recu
            $this->userManagerByAjax->updateAdminStatusUserBd($_POST['id'], !$_POST['status']);

        }
    }

    public function changeIsBlockedStatus(){

        var_dump($_POST);
        if (($_POST['id']) && ($_POST['status']) ){
            var_dump('coucou');
            var_dump(!$_POST['status']);
                die();
            //La valeur $_POST['status'] a envoyer doit etre l'opposé (booléen) de celui recu
            $this->userManagerByAjax->updateBlockedStatusUserBd($_POST['id'], !$_POST['status']);
        }
    }

}