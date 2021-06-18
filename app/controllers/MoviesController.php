<?php
require_once "./app/models/MoviesManager.php";


class MoviesController
{
    private $moviesManager;

    public function __construct()
    {
        $this->moviesManager = new MoviesManager();
        $this->moviesManager->findAllMovies();
    }

    public function showMovies(){
        $movies = $this->moviesManager->getMovies();

        require "./views/moviesView.php";
        unset($_SESSION['alert']);
    }

    public function showMovie($id)
    {
        $movie = $this->moviesManager->getMovieById($id);
        require_once "./app/controllers/CategoryController.php";
        $category = new CategoryController();
        require "./views/movieView.php";
    }

}