<?php
require_once PATH."models/CategoryManager.php";


class CategoryController extends TemplatingTools
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
        //Permet de supprimer les alertes gardées en session aprés les redirections du CRUD
        $this->removeFlashBag();
    }

    public function getCategoryForMovie($id)
    {
       return  $this->categoryManager->getCategoryNameById($id);

    }


    public function addCategoryValidation()
    {
        if ($_POST && isset($_POST['name']) && strlen(trim($_POST['name']))> 1){

            $this->categoryManager->addCategoryDb($_POST['name']);

            $this->flashBag('success',$_POST['name'], 'add');
            header("Location:".URL."categories");
        }
        else
            $this->flashBag('danger','Probléme rencontré lors de la validation !!');
            header("Location:".URL."categories/c");

    }

    public function updateCategory($id)
    {
        $category = $this->categoryManager->getCategoryById($id);

        require "./views/updateCategoryView.php";
        //Permet de supprimer les alertes gardées en session aprés les redirections du CRUD
        $this->removeFlashBag();
    }

    public function updateCategoryValidation()
    {

        if ($_POST && isset($_POST['name']) && strlen(trim($_POST['name']))> 1){

            $this->categoryManager->addCategoryDb($_POST['name']);

            $this->flashBag('success',$_POST['name'], 'update');

            header("Location:".URL."categories");
        }else
            $this->flashBag('danger', 'Erreur lors de la modification de'.$_POST['name'].'!');
            header("Location:".URL."categories/".$_POST['id']);
    }

    public function createCategory()
    {
        $category = $this->categoryManager->getCategories();

        require "./views/createCategoryView.php";
        //Permet de supprimer les alertes gardées en session aprés les redirections du CRUD
        $this->removeFlashBag();
    }

    public function deleteCategory($id)
    {
        //Oblige à passer par la methode POST pour supprimer un film bien que l'id soit envoyé par l'url
        if (isset($_POST['remove'])){
            $title =$this->categoryManager->getCategoryById($id)->getName();

            $this->categoryManager->deleteCategoryBd($id);
            $this->flashBag('success',$title, 'remove');
        }
        header("Location:".URL."categories");
    }
}