<?php

namespace App\Controller;

use App\Manager\MoviesManagerByAjax;

class MoviesControllerByAjax
{
    private MoviesManagerByAjax $moviesManager;

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