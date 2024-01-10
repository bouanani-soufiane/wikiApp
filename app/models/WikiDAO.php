<?php
require_once __DIR__.'./entities/Wiki.php';

class WikiDAO
{
    private $conn;
    private Wiki $wiki;
    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->wiki = new Wiki();
    }
    public function getWiki(): Wiki
    {
        return $this->wiki;
    }
    public function setWiki($wiki)
    {
        $this->wiki = $wiki;
        return $this;
    }
    public function create(Wiki $wiki){
        $wikiTitre = $wiki->getTitre();
        $description = $wiki->getDescription();
        $wikiContent = $wiki->getContent();
        $wikiImage = $wiki->getImage();
//        $idTag = $wiki->getTag()->getId();
        $idCategorie = $wiki->getCategory()->getId();
        $idUser = $wiki->getUser()->getId();

        $stmt = $this->conn->prepare("INSERT INTO wiki (wikiTitre, description, wikiContent, wikiImage, idCategorie, idUser) VALUES (:wikiTitre, :description, :wikiContent, :wikiImage, :idCategorie, :idUser)");

        $stmt->bindParam(':wikiTitre', $wikiTitre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':wikiContent', $wikiContent);
        $stmt->bindParam(':wikiImage', $wikiImage);
        $stmt->bindParam(':idCategorie', $idCategorie);
        $stmt->bindParam(':idUser', $idUser);

        $stmt->execute();
    }
    public function getLastWikiId($id)
    {
        $stmt = $this->conn->prepare("SELECT wikiId FROM `wiki` WHERE idUser = :id ORDER BY wikiId DESC LIMIT 1;");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['wikiId'] : null;
    }
    public function showWiki()
    {
        $stmt = $this->conn->prepare("SELECT wiki.*, categorie.categorieName FROM wiki LEFT JOIN categorie ON wiki.idCategorie = categorie.categorieId ORDER BY wiki.createdAt DESC;");
        $stmt->execute();
        $wikis = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new Wiki();
            $wiki->setId($row['wikiId']);
            $wiki->setTitre($row['wikiTitre']);
            $wiki->setDescription($row['description']);
            $wiki->setContent($row['wikiContent']);
            $wiki->setImage($row['wikiImage']);
            $wiki->setCreatedAt($row['createdAt']);
            $wiki->setIsArchived($row['isArchived']);
            $wiki->getCategory()->setName($row['categorieName']);
            array_push($wikis, $wiki);
        }
        return $wikis;
    }
    public function showSingleWiki($id)
    {
        $stmt = $this->conn->prepare("SELECT wiki.*, categorie.categorieName, user.userName FROM wiki LEFT JOIN categorie ON wiki.idCategorie = categorie.categorieId LEFT JOIN user ON wiki.idUser = user.userId WHERE wikiId = :id;");
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $wiki = new Wiki();
            $wiki->setId($row['wikiId']);
            $wiki->setTitre($row['wikiTitre']);
            $wiki->setDescription($row['description']);
            $wiki->setContent($row['wikiContent']);
            $wiki->setImage($row['wikiImage']);
            $wiki->setCreatedAt($row['createdAt']);
            $wiki->getCategory()->setName($row['categorieName']);
            $wiki->getUser()->setName($row['userName']);
            return $wiki;
        }
        return null;
    }
    public function update(Wiki $wiki){
        $wikiId = $wiki->getId();
        $wikiTitre = $wiki->getTitre();
        $description = $wiki->getDescription();
        $wikiContent = $wiki->getContent();
        $wikiImage = $wiki->getImage();
        $idCategorie = $wiki->getCategory()->getId();
        $idUser = $wiki->getUser()->getId();

        $query = "UPDATE wiki SET wikiTitre = :wikiTitre, description = :description, wikiContent = :wikiContent, wikiImage = :wikiImage, idCategorie = :idCategorie WHERE wikiId = :wikiId";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':wikiId', $wikiId, PDO::PARAM_INT);
        $statement->bindParam(':wikiTitre', $wikiTitre, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':wikiContent', $wikiContent, PDO::PARAM_STR);
        $statement->bindParam(':wikiImage', $wikiImage);
        $statement->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);

        $statement->execute();
    }
    public function delete($id){

        $query = "DELETE FROM wiki WHERE wikiId = :wikiId";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':wikiId', $id, PDO::PARAM_INT);
        $statement->execute();
    }
    public function archive($id){

        $query = "UPDATE wiki SET isArchived = 1 WHERE wikiId = :wikiId";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':wikiId', $id, PDO::PARAM_INT);
        $statement->execute();
    }
    public function countWiki() {
        $query = "SELECT COUNT(*) AS wikiCount FROM wiki";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result->wikiCount;
    }







}
