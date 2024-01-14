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
        $query = "SELECT * FROM categorie order by createdAt , updatedAt desc ";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $categories = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category();

            $category->setId($row['categorieId']);
            $category->setName($row['categorieName']);
            $category->setImage($row['categorieImage']);

            array_push($categories, $category);
        }
        return $categories;
    }
    public function create(Category $category){
        $name = $category->getName();
        $categorieImage = $category->getImage();
        if($categorieImage == null){
            $categorieImage = "2922280_27002.jpg";
        }



        $stmt = $this->conn->prepare("INSERT INTO categorie (categorieName,categorieImage) VALUES (:name,:categorieImage)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':categorieImage', $categorieImage);
        $stmt->execute();
    }
    public function delete(Category $category){
        $id = $category->getId();
        $query = "DELETE FROM categorie WHERE categorieId = :Id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':Id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
    public function edit(Category $category)
    {
        $id = $category->getId();
        $name = $category->getName();
        $categorieImage = $category->getImage();


        $query = "UPDATE categorie SET categorieName = :name";

        if ($categorieImage !== null) {
            $query .= ", categorieImage = :image";
        }

        $query .= " WHERE categorieId = :id";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);

        if ($categorieImage !== null) {
            $statement->bindParam(':image', $categorieImage, PDO::PARAM_LOB);
        }

        $statement->execute();
    }

    public function countCateg() {
        $query = "SELECT COUNT(*) AS categCount FROM categorie";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result->categCount;
    }
    public function showLastThreeCategories()
    {
        $query = "SELECT * FROM categorie ORDER BY categorie.categorieId DESC LIMIT 6";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $categories = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category();

            $category->setId($row['categorieId']);
            $category->setName($row['categorieName']);
            $category->setImage($row['categorieImage']);

            array_push($categories, $category);
        }
        return $categories;
    }
}
