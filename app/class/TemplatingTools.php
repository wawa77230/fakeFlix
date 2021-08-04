<?php


class TemplatingTools
{

    protected function addImage($file,$dir){
        if (!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");

        if (!file_exists($dir)) mkdir($dir,07777);
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];

        if (!getimagesize($file['tmp_name']))
            throw new Exception("Le fichier n'est pas une image");
        if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" )
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if (file_exists($target_file))
            throw new Exception("Le fichier existe déjà");
        if ($file['size']> 500000)
            throw new Exception("Le fichier est trop gros");
        if (!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("L'ajout de l'image n'a pas fonctionné");
        else return ($random."_".$file['name']);

    }

    protected function flashBag($type, $message, $action =null ){

        switch ($type){
            case 'success':
                if ($action){
                    switch ($action){

                        case 'add':
                            $msg = "Ajout de <strong>".$message."</strong> réalisé.";
                            break;
                        case 'remove':
                            $msg = "Suppression de <strong>".$message."</strong> réalisée." ;
                            break;
                        case 'update':
                            $msg = "Modification de <strong>".$message."</strong> réalisée." ;
                            break;
                        case 'addUser':
                            $msg = "Bienvenue <strong>".$message."</strong> ! Vous pouvez à présent vous connecter." ;
                            break;
                    }
                }
                break;
            case 'danger':
                $msg = $message;
        }

        $_SESSION["alert"] = [
            "type"=> $type,
            "msg" => $msg
        ];
        return $_SESSION['alert'];
    }

    protected function removeFlashBag(){
        unset($_SESSION['alert']);
    }

    protected function cleanLink($iframe){

        //Suppression de touts les caractères avant le mot src
        $iframe = strstr($iframe,'src');
        //Suppression en debut de chaine de src et les guillemets ouvrant
        $iframe = substr($iframe,4);

        //Suppression de touts les caractères apres le premier espace
        $iframe = strstr($iframe,' ',true);
        //Suppression en fin de chaine de l'espace et les guillemets fermants
        $iframe = substr($iframe,0,-1);

        return $iframe;
    }

    protected function switch($value){
// Permute les valeurs checkbox
        switch ($value){
            case 0:
                $val = 1;
                break;
            case 1:
                $val = 0;
                break;
        }
        return $val;
    }
}