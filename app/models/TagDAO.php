<?php
require_once __DIR__.'./entities/Tag.php';

class TagDAO
{
    private $conn;
    private Tag $tag;
    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->tag = new Tag();
    }
    public function getTag(): Tag
    {
        return $this->tag;
    }
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }
    public function showTags()
    {
        $query = "SELECT * FROM tag";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $tags = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $tag = new Tag();
            $tag->setId($row['tagId']);
            $tag->setName($row['tagName']);
            array_push($tags, $tag);
        }
        return $tags;
    }
    public function create(Tag $tag){
        $name = $tag->getName();
        $stmt = $this->conn->prepare("INSERT INTO tag (tagName) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
    public function delete(Tag $tag){
        $id = $tag->getId();
        $query = "DELETE FROM tag WHERE tagId = :Id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':Id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
