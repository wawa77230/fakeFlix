<?php

namespace App\Controller;

use App\Manager\MoviesManager;
use App\Manager\CategoryManager;

class HomeController
{
    private MoviesManager $moviesManager;
    private CategoryManager $categoryManager;

    public function __construct()
    {
        $this->moviesManager = new MoviesManager();
        $this->moviesManager->findAllMovies();
        $this->categoryManager = new CategoryManager();
        $this->categoryManager->findAllCategories();
    }

    public function showMoviesByCat(){
        $categories = $this->categoryManager->getCategories();
        $movies = $this->moviesManager;
        $moviesC = $this->moviesManager->getMovieWithNullCat();

        require "views/homeView.php";
    }
}