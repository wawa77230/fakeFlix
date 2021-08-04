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
        require "./views/categories/categoriesListView.php";
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

        require "./views/categories/updateCategoryView.php";
        //Permet de supprimer les alertes gardées en session aprés les redirections du CRUD
        $this->removeFlashBag();
    }

    public function updateCategoryValidation()
    {

        if ($_POST && isset($_POST['name']) && strlen(trim($_POST['name']))> 1){

            $this->categoryManager->updateCategoryBd($_POST['id'] ,$_POST['name']);

            $this->flashBag('success',$_POST['name'], 'update');
            header("Location:".URL."categories");
        }else
            $this->flashBag('danger', 'Erreur lors de la modification de'.$_POST['name'].'!');
            header("Location:".URL."categorie/u/".$_POST['id']);
    }

    public function createCategory()
    {
        $category = $this->categoryManager->getCategories();

        require "./views/categories/createCategoryView.php";
        //Permet de supprimer les alertes gardées en session aprés les redirections du CRUD
        $this->removeFlashBag();
    }

    public function deleteCategory($id)
    {
        $this->categoryManager->deleteCategoryBd($id);
    }
}