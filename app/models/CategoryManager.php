<?php
require_once "Database.php";
require_once "Category.php";

class CategoryManager extends Database
{
    private $categories; // Tableau des prestations

    public function addCategory($category){
        $this->categories[] = $category;
    }

    public function addCategoryDb($name)
    {
        $req= " INSERT INTO categories(name)
                VALUES  (:name)";
        $stmt = $this->getBdd()->prepare($req);
        $result = $stmt->execute([
            "name"=> $name,
        ]);
        $stmt->closeCursor();

        if ($result > 0){
            $category = new Category($this->getBdd()->lastInsertId(), $name);
            $this->addCategory($category);
        }
    }

    public function findAllCategories(){
        $req = $this->getBdd()->prepare("SELECT id, name FROM categories");
        $req->execute();
        $categories = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($categories as $c){
            $c = new Category($c['id'], htmlspecialchars($c['name']));
            $this->addCategory($c);
        }
    }

    public function getCategories(){
        return $this->categories;
    }

    public function getCategoryById($id)
    {
        foreach ($this->categories as $category){
            if ($category->getId() === $id){
                return $category;
            }
        }

        throw new Exception("La catégorie n'existe pas");
    }

    public function getCategoryNameById($id)
    {
        foreach ($this->categories as $category){
            if ($category->getId() === $id){
                return $category->getName();
            }
        }

        throw new Exception("La catégorie n'existe pas");
    }



    public function updateCategoryBd($id,$name)
    {
        $req ="UPDATE categories
               SET name = :name
               WHERE id = :id   ";
        $stmt= $this->getBdd()->prepare($req);
        $result = $stmt->execute([
            "name"=> $name,
            "id"=> $id
        ]);
        $stmt->closeCursor();

        if ($result > 0){
            $this->getCategoryById($id)->setName($name);
        }
    }

    public function deleteCategoryBd($id)
    {

        $req="DELETE FROM categories WHERE id = :idCategory";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':idCategory',$id,PDO::PARAM_INT);
        $result =$stmt->execute();
        $stmt->closeCursor();

        if ($result > 0){
            $category =$this->getCategoryById($id);
            unset($category);
        }
    }
}