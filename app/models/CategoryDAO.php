<?php
require_once __DIR__ . './entities/Category.php';

class CategoryDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function showCategories(): array
    {
        $query = "SELECT * FROM categorie ORDER BY createdAt, updatedAt DESC";
        $statement = $this->conn->prepare($query);
        $statement->execute();

        $categories = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category();
            $category->setId($row['categorieId'])
                ->setName($row['categorieName'])
                ->setImage($row['categorieImage']);

            $categories[] = $category;
        }
        return $categories;
    }

    public function create(Category $category): void
    {
        $name = $category->getName();
        $image = $category->getImage() ?? "2922280_27002.jpg";

        $query = "INSERT INTO categorie (categorieName, categorieImage) VALUES (:name, :image)";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':image', $image);
        $statement->execute();
    }

    public function delete(Category $category): void
    {
        $id = $category->getId();

        $query = "DELETE FROM categorie WHERE categorieId = :id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function edit(Category $category): void
    {
        $id = $category->getId();
        $name = $category->getName();
        $image = $category->getImage();

        $query = "UPDATE categorie SET categorieName = :name";
        if ($image !== null) {
            $query .= ", categorieImage = :image";
        }
        $query .= " WHERE categorieId = :id";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        if ($image !== null) {
            $statement->bindParam(':image', $image, PDO::PARAM_STR);
        }
        $statement->execute();
    }

    public function countCateg(): int
    {
        $query = "SELECT COUNT(*) AS categCount FROM categorie";
        $statement = $this->conn->prepare($query);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_OBJ);
        return (int)$result->categCount;
    }

    public function showLastThreeCategories(): array
    {
        $query = "SELECT * FROM categorie ORDER BY categorieId DESC LIMIT 3";
        $statement = $this->conn->prepare($query);
        $statement->execute();

        $categories = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category();
            $category->setId($row['categorieId'])
                ->setName($row['categorieName'])
                ->setImage($row['categorieImage']);

            $categories[] = $category;
        }
        return $categories;
    }
}