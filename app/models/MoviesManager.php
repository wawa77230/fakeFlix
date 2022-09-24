<?php

namespace App\Manager;

use App\Model\Movie;
use Exception;
use PDO;


class MoviesManager extends Database
{
    private array $movies; // Tableau des prestations

    public function addMovie($movie){
        $this->movies[] = $movie;
    }

    public function addMovieDb($name, $rank,$description, $year, $picture, $iframe, $categoryId )
    {
        $req= "
                INSERT INTO movies(name, `rank`, description, year, picture, iframe,categoryId)
                                    VALUES  (:name,:rank, :description, :year, :picture, :iframe, :categoryId)";
        $stmt = $this->getBdd()->prepare($req);
        $result = $stmt->execute([
            "name"=> $name,
            "rank"=> $rank,
            "description"=> $description,
            "year"=> $year,
            "picture"=> $picture,
            "iframe"=> $iframe,
            "categoryId"=> $categoryId,
        ]);
        $stmt->closeCursor();

        if ($result > 0){
            $movie = new Movie($this->getBdd()->lastInsertId(), $name, $rank, $description, $year, $picture, $iframe, $categoryId);
            $this->addMovie($movie);
        }
    }

    public function findAllMovies(){
        $req = $this->getBdd()->prepare("SELECT id, name, `rank`, description, year, picture, iframe, categoryId FROM movies");
        $req->execute();
        $movies = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($movies as $m){
            $m = new Movie($m['id'], htmlspecialchars($m['name']),$m['rank'],htmlspecialchars($m['description']),$m['year'],htmlspecialchars($m['picture']),htmlspecialchars($m['iframe']), $m['categoryId']);
            $this->addMovie($m);
        }
    }

    public function getMovies(): array
    {
        return $this->movies;
    }

    /**
     * @throws Exception
     */
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

    public function getMovieByCatId($id): array
    {

        //Si je devais faire la requete "classique"
        //$req = $this->getBdd()->prepare("SELECT id, name, rank, description, year, picture, iframe, categoryId FROM movies WHERE categoryId = :id");
        //$req->execute(["id" => $id]);
        //$movie = $req->fetch(PDO::FETCH_ASSOC);
        //$req->closeCursor();

        $movies = [];
        foreach ($this->movies as $movie){
            if ($movie->getCategoryId() === $id ){
                 $movies[] = $movie ;
            }
        }
        return $movies;

        throw new Exception("Le film n'existe pas");
    }

    public function getMovieWithNullCat()
    {

        //Si je devais faire la requete "classique"
        //$req = $this->getBdd()->prepare("SELECT id, name, rank, description, year, picture, iframe, categoryId FROM movies WHERE categoryId = null");
        //$req->execute();
        //$movies = $req->fetchAll(PDO::FETCH_ASSOC);
        //$req->closeCursor();

        $movies = [];
        foreach ($this->movies as $movie){
            if ($movie->getCategoryId() === null ){
                $movies[] = $movie ;
            }
        }
        return $movies;

        throw new Exception("Le film n'existe pas");
    }

    public function updateMovieBd($id,$name, $rank, $description, $year, $picture, $iframe, $categoryId)
    {
        $req ="UPDATE movies
               SET name = :name,
                   rank = :rank,
                   description = :description,
                   year = :year,
                   picture = :picture,
                   iframe = :iframe,
                   categoryId = :categoryId
               WHERE id = :id   ";
        $stmt= $this->getBdd()->prepare($req);
        $result = $stmt->execute([
            "name"=> $name,
            "rank"=> $rank,
            "description"=> $description,
            "year"=> $year,
            "picture"=> $picture,
            "iframe"=> $iframe,
            "categoryId"=> $categoryId,
            "id"=> $id
        ]);
        $stmt->closeCursor();

        if ($result > 0){
            $this->getMovieById($id)->setName($name);
            $this->getMovieById($id)->setRank($rank);
            $this->getMovieById($id)->setDescription($description);
            $this->getMovieById($id)->setYear($year);
            $this->getMovieById($id)->setPicture($picture);
            $this->getMovieById($id)->setIframe($iframe);
            $this->getMovieById($id)->setCategoryId($categoryId);
        }
    }

    public function deleteMovieBd($id)
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