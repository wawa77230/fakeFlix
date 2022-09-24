<?php

namespace App\Manager;

use App\Manager\Database;
use App\Model\Movie;
use PDO;


class MoviesManagerByAjax extends Database
{
    private array $movies; // Tableau des prestations

    public function addMovie($movie){
        $this->movies[] = $movie;
    }

    public function findAllMoviesByName($query){

        $req = $this->getBdd()->prepare("SELECT id, name, `rank`, description, year, picture, iframe, categoryId
                                         FROM movies
                                         WHERE name  LIKE ?
                                          ");
        $req->execute(["$query%"]);
//        $req->execute(["%$query%"]);
        $movies = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($movies as $m){
            $m = new Movie($m['id'], htmlspecialchars($m['name']),$m['rank'],htmlspecialchars($m['description']),$m['year'],htmlspecialchars($m['picture']),htmlspecialchars($m['iframe']), $m['categoryId']);
            $this->addMovie($m);
        }
    }

    public function getMovies(){

        $movies = null;
        if (isset($this->movies)){
            foreach ($this->movies as $movie){
                $m = ["id" => $movie->getId(),
                      "name" => $movie->getName(),
                      "picture" => URL.'public/img/movies/'.$movie->getPicture()
                ];
                $movies[]= $m;
            }
        }
        return json_encode($movies);
    }

    public function getMovieById($id)
    {
        //Si je devais faire la requete "classique"
        //$req = $this->getBdd()->prepare("SELECT id, name, rank, description, year, picture, iframe, categoryId FROM movies WHERE id = :id");
        //$req->execute(["id" => $id]);
        //$movie = $req->fetch(PDO::FETCH_ASSOC);
        //$req->closeCursor();

        foreach ($this->movies as $movie){
            if ($movie->getId() === $id){
                return $movie;
            }
        }

        throw new Exception("Le film n'existe pas");
    }

    public function deletePrestationBd($id)
    {
        $req="DELETE FROM movies WHERE id = :idMovie";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':idMovie',$id,PDO::PARAM_INT);
        $result =$stmt->execute();
        $stmt->closeCursor();

        if ($result > 0){
            $movie =$this->getMovieById($id);
            unset($movie);
        }
    }
}