<?php
require_once PATH."models/MoviesManagerByAjax.php";

class MoviesControllerByAjax
{
    private $moviesManager;

    public function __construct()
    {
        $this->moviesManager = new MoviesManagerByAjax();
    }

    public function search($query){

        $query = trim(htmlspecialchars($query));
        $this->moviesManager->findAllMoviesByName($query);

        echo $this->moviesManager->getMovies();
    }

}