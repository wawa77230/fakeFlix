<?php
require_once "Database.php";
require_once "Movie.php";


class MoviesManagerByAjax extends Database
{
    private $movies; // Tableau des prestations

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
        foreach ($this->movies as $movie){
            if ($movie->getId() === $id){
                return $movie;
            }
        }

        throw new Exception("Le film n'existe pas");
    }

    public function getMovieByCatId($id)
    {
        $movies = [];
        foreach ($this->movies as $movie){
            if ($movie->getCategoryId() === $id){
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