<?php
require_once PATH."models/MoviesManager.php";
require_once PATH."models/CategoryManager.php";
require_once PATH."class/TemplatingTools.php";



class MoviesController extends TemplatingTools
{
    private $moviesManager;
    private $categoryManager;

    public function __construct()
    {
        $this->moviesManager = new MoviesManager();
        $this->moviesManager->findAllMovies();

        $this->categoryManager = new CategoryManager();
        $this->categoryManager->findAllCategories();

    }

    public function showMovies(){
        $movies = $this->moviesManager->getMovies();
        $categories = $this->categoryManager;

        require "./views/moviesView.php";
        //Permet de supprimer les alertes gardées en session aprés les redirections du CRUD
        $this->removeFlashBag();
    }

    public function showMoviesByCategorie($catId)
    {
        $categorieName = $this->categoryManager->getCategoryById($catId)->getName();
        $movies = $this->moviesManager->getMovieByCatId($catId);

        require "./views/movieByCategoryView.php";
    }

    public function showMovie($id)
    {
        $movie = $this->moviesManager->getMovieById($id);
        $category = $this->categoryManager->getCategoryById($movie->getCategoryId());
        require "./views/movieView.php";
    }

    public function addMovieValidation()
    {
        if ($_POST
            && isset($_POST['name']) && strlen(trim($_POST['name']))> 1
            && isset($_POST['rank']) && ctype_digit($_POST['rank'])
            && isset($_POST['description']) && strlen(trim($_POST['description']))>99
            && isset($_POST['year']) && ctype_digit($_POST['year'])
            && isset($_POST['iframe']) && strlen(trim($_POST['name']))>9
            && isset($_POST['categoryId']) && ctype_digit($_POST['categoryId'])
        ){

            $nameImage = null;
            $file = $_FILES['image'];

            //Si la taille de l'image est supérieur a 0, cela veut dire que l'utilisateur a chargé une image.
            if ($file['size'] >0){

                //Si il y une image
                $file = $_FILES['image'];
                $directory = "./public/img/movies/";
                $nameImage = $this->addImage($file, $directory);
            }

            $this->moviesManager->addMovieDb($_POST['name'],$_POST['rank'],$_POST['description'],$_POST['year'],$nameImage,$_POST['iframe'],$_POST['categoryId']);

            $this->flashBag('success',$_POST['name'], 'add');
            header("Location:".URL."films");

        }
        else
            $this->flashBag('danger','Probléme rencontré lors de la validation !!');
            header("Location:".URL."films/c");    }

    public function updateMovie($id)
    {
        $categories =$this->categoryManager->getCategories();
        $movie = $this->moviesManager->getMovieById($id);

        require "./views/movies/updateMovieView.php";
        //Permet de supprimer les alertes gardées en session aprés les redirections du CRUD
        $this->removeFlashBag();
    }

    public function updateMovieValidation()
    {

        if ( $_POST
            && isset($_POST['name']) && strlen(trim($_POST['name']))> 1
            && isset($_POST['rank']) && ctype_digit($_POST['rank'])
            && isset($_POST['description']) && strlen(trim($_POST['description']))>99
            && isset($_POST['year']) && ctype_digit($_POST['year'])
            && isset($_POST['iframe']) && strlen(trim($_POST['iframe']))>9
            && isset($_POST['categoryId']) && ctype_digit($_POST['categoryId'])
        ){


            //Récupere l'image
            $currentImage = $this->moviesManager->getMovieById($_POST['id'])->getPicture();
            $file = $_FILES['image'];

            //Si la taille de l'image est supérieur a 0, cela veut dire que l'utilisateur a chargé une nouvelle image.
            if ($file['size'] >0){
                //Suppression de l'ancienne image
                unlink("./public/img/movies/".$currentImage);
                $directory = "./public/img/movies/";
                $nameImage = $this->addImage($file, $directory);
            }else{
                $nameImage = $currentImage;
            }

            $this->moviesManager->updateMovieBd($_POST['id'],$_POST['name'],$_POST['rank'],$_POST['description'],$_POST['year'],$nameImage,$_POST['iframe'],$_POST['categoryId']);

            $this->flashBag('success',$_POST['name'], 'update');
            header("Location:".URL."films");
        }
        else
            $this->flashBag('danger', 'Erreur lors de la modification de'.$_POST['name'].'!');
            header("Location:".URL."films/".$_POST['id']);
    }

    public function createMovie()
    {
        $categories = $this->categoryManager->getCategories();

        require "./views/movies/createMovieView.php";
        //Permet de supprimer les alertes gardées en session aprés les redirections du CRUD
        $this->removeFlashBag();
    }

    public function deleteMovie($id)
    {
        //Oblige à passer par la methode POST pour supprimer un film bien que l'id soit envoyé par l'url
        if (isset($_POST['remove'])){
            $title =$this->moviesManager->getMovieById($id)->getName();

            $this->moviesManager->deleteMovieBd($id);
            $this->flashBag('success',$title, 'remove');
        }
        header("Location:".URL."films");
    }

    public function search(){
        //Les data sont renvoyés en ajax depuis le script searchMoviesByAjax.js
        require "./views/searchView.php";
    }
}