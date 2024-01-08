<?php
require_once __DIR__.'./entities/Category.php';

class CategoryDAO
{
    private $conn;
    private Category $category;
    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->category = new Category();
    }
    public function getCategory(): Category
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
    public function showCategories()
    {
        $query = "SELECT c.*, COUNT(w.wikiId) AS wikiCount FROM categorie AS c LEFT JOIN wiki AS w ON c.categorieId = w.idCategorie GROUP BY c.categorieId, c.categorieName;";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $categories = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category();
            $category->setId($row['categorieId']);
            $category->setName($row['categorieName']);
            $categories[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'wikiCount' => $row['wikiCount'],
            ];
        }
        return $categories;
    }
    public function create(Category $category){
        $name = $category->getName();
        $stmt = $this->conn->prepare("INSERT INTO categorie (categorieName) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
    public function delete(Category $category){
        $id = $category->getId();
        $query = "DELETE FROM categorie WHERE categorieId = :Id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':Id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
    public function edit(Category $category){
        $id = $category->getId();
        $name = $category->getName();

        $query = "UPDATE categorie SET categorieName = :name WHERE categorieId = :Id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':Id', $id, PDO::PARAM_INT);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->execute();
    }

}
