<?php
require_once PATH."models/CategoryManager.php";


class CategoryController
{
    private $categoryManager;

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();
        $this->categoryManager->findAllCategories();
    }



    public function showCategories(){
        $categories = $this->categoryManager->getCategories();

        require "./views/categoriesView.php";
//        unset($_SESSION['alert']);
    }

    public function getCategoryForMovie($id)
    {
       return  $this->categoryManager->getCategoryNameById($id);

    }


    public function addCategoryValidation()
    {
        if ($_POST && isset($_POST['name']) && strlen(trim($_POST['name']))> 1){

            $this->categoryManager->addCategoryDb($_POST['name']);

            header("Location:".URL."categories");
        }
        else
            var_dump('Ajouter erreur');
    }

    public function updateCategory($id)
    {
        $category = $this->categoryManager->getCategoryById($id);
        require "./views/updateCategoryView.php";
    }

    public function updateCategoryValidation()
    {

        if ($_POST && isset($_POST['name']) && strlen(trim($_POST['name']))> 1){

            $this->categoryManager->addCategoryDb($_POST['name']);

            header("Location:".URL."categories");
        }else
            var_dump('Ajouter erreur');

    }

    public function createCategory()
    {
        $category = $this->categoryManager->getCategories();
        require "./views/createCategoryView.php";
    }

    public function deleteCategory($id)
    {
        //Oblige à passer par la methode POST pour supprimer un film bien que l'id soit envoyé par l'url
        if (isset($_POST['remove'])){
            $title =$this->categoryManager->getCategoryById($id)->getName();

            $this->categoryManager->deleteCategoryBd($id);

        }

//        $_SESSION['alert'] = [
//            "type" => "success",
//            "msg" => "Suppression de <strong>".$title."</strong> réalisé."
//        ];

        header("Location:".URL."categories");
    }
}