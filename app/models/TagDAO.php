<?php
require_once __DIR__ . './entities/Tag.php';

class TagDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function showTags(): array
    {
        $query = "SELECT * FROM tag ORDER BY tagId DESC";
        $statement = $this->conn->prepare($query);
        $statement->execute();

        $tags = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $tag = new Tag();
            $tag->setId($row['tagId'])
                ->setName($row['tagName']);

            $tags[] = $tag;
        }
        return $tags;
    }

    public function create(Tag $tag): bool
    {
        $name = $tag->getName();

        if ($this->verifyTag($name)) {
            $query = "INSERT INTO tag (tagName) VALUES (:name)";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':name', $name);

            return $statement->execute();
        }
        return false;
    }

    public function delete(Tag $tag): void
    {
        $id = $tag->getId();

        $query = "DELETE FROM tag WHERE tagId = :id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function edit(Tag $tag): void
    {
        $id = $tag->getId();
        $name = $tag->getName();

        $query = "UPDATE tag SET tagName = :name WHERE tagId = :id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->execute();
    }

    public function countTag(): int
    {
        $query = "SELECT COUNT(*) AS tagCount FROM tag";
        $statement = $this->conn->prepare($query);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_OBJ);
        return (int)$result->tagCount;
    }

    public function verifyTag(string $tagName): bool
    {
        $query = "SELECT * FROM tag WHERE tagName = :name";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':name', $tagName);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC) === false;
    }
}