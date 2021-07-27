<?php

require_once PATH."models/MoviesManager.php";
require_once PATH."models/CategoryManager.php";

class HomeController
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

    public function showMoviesByCat(){
        $categories = $this->categoryManager->getCategories();
        $movies = $this->moviesManager;

        require "views/homeView.php";
    }
}