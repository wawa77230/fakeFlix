<?php

namespace App\Controller;

use App\Manager\UserManagerByAjax;
use App\Utility\TemplatingTools;

class UsersControllerByAjax extends TemplatingTools
{
    private UserManagerByAjax $userManagerByAjax;

    public function __construct()
    {
        $this->userManagerByAjax = new UserManagerByAjax();
    }

    public function changeAdminStatus(){
        if (ctype_digit($_POST['id']) && ctype_digit($_POST['status']) ){
            //La valeur $_POST['status'] a envoyer doit etre l'opposé (booléen) de celui recu
            $newStatus = $this->switch($_POST['status']);

            $this->userManagerByAjax->updateAdminStatusUserBd($_POST['id'], $newStatus);

        }
    }

    public function changeIsBlockedStatus(){

        if (ctype_digit($_POST['id']) && ctype_digit($_POST['status'])){
            //La valeur $_POST['status'] a envoyer doit etre l'opposé (booléen) de celui recu
            $newStatus = $this->switch($_POST['status']);

            $this->userManagerByAjax->updateBlockedStatusUserBd($_POST['id'], $newStatus);
        }
    }

}