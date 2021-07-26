<?php


class TemplatingTools
{

    public function addImage($file,$dir){
        if (!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");
//              $file['name']= null;

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

    public function flagBag($type, $message, $action =null ){

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



}