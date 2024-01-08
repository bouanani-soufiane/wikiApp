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
        $query = "SELECT * FROM categorie";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $categories = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category();

            $category->setId($row['categorieId']);
            $category->setName($row['categorieName']);

            array_push($categories, $category);
        }
        return $categories;
    }

}
