<?php
require_once "./app/models/CategoryManager.php";


class CategoryController
{
    private $categoryManager;

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();
        $this->categoryManager->findAllCategories();
    }

    public function showCategories(){
        $movies = $this->categoryManager->getCategories();

//        require "./views/moviesView.php";
//        unset($_SESSION['alert']);
    }

    public function getCategoryForMovie($id)
    {
       return $this->categoryManager->getCategoryById($id)->getName();

    }
}