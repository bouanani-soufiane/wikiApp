<?php
require_once __DIR__.'./entities/Wiki.php';
require_once __DIR__.'./entities/WikiTag.php';

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


        return true;
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
    public function showLsatWikis()
    {
        $stmt = $this->conn->prepare("SELECT wiki.*, categorie.categorieName FROM wiki LEFT JOIN categorie ON wiki.idCategorie = categorie.categorieId where isArchived = 0  ORDER BY wiki.createdAt DESC limit 6;");
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
        // Fetch wiki details
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
            $wiki->getUser()->setId($row['idUser']);

            // Fetch wiki tags
            $stmt = $this->conn->prepare("SELECT * FROM wikiTagView WHERE wikiId = :id;");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $tagsRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $wikiTags = array();

            foreach ($tagsRows as $tagsRow) {
                $wikiTag = new WikiTag();
                $wikiTag->getTag()->setId($tagsRow['tagId']);
                $wikiTag->getTag()->setName($tagsRow['tagName']);
                $wikiTag->getWiki()->setId($row['wikiId']);
                array_push($wikiTags, $wikiTag);
            }

            return [$wiki, $wikiTags];
        }

        return null;
    }

    public function update(Wiki $wiki)
    {
        $wikiId = $wiki->getId();
        $wikiTitre = $wiki->getTitre();
        $description = $wiki->getDescription();
        $wikiContent = $wiki->getContent();
        $idCategorie = $wiki->getCategory()->getId();

        $query = "UPDATE wiki SET wikiTitre = :wikiTitre, description = :description, wikiContent = :wikiContent, idCategorie = :idCategorie";

        if ($wiki->getImage() !== null) {
            $query .= ", wikiImage = :wikiImage";
            $wikiImage = $wiki->getImage();
        }

        $query .= " WHERE wikiId = :wikiId";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':wikiId', $wikiId, PDO::PARAM_INT);
        $statement->bindParam(':wikiTitre', $wikiTitre, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':wikiContent', $wikiContent, PDO::PARAM_STR);
        $statement->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);

        if ($wiki->getImage() !== null) {
            $statement->bindParam(':wikiImage', $wikiImage);
        }

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


    public function showWikiCateg($id)
    {
        $stmt = $this->conn->prepare("SELECT wiki.*, categorie.categorieName FROM wiki LEFT JOIN categorie ON wiki.idCategorie = categorie.categorieId where categorie.categorieId = :id ORDER BY wiki.createdAt DESC;");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    public function searchWiki($wikiTitre){


        $stmt = $this->conn->prepare("
SELECT DISTINCT wiki.*, user.*, categorie.* FROM wiki JOIN user ON wiki.idUser = user.userId JOIN categorie ON wiki.idCategorie = categorie.categorieId WHERE wiki.wikiTitre LIKE CONCAT('%', ?, '%') OR categorie.categorieName LIKE CONCAT('%', ?, '%');


");
        $stmt->bindValue(1, $wikiTitre, PDO::PARAM_STR);
        $stmt->bindValue(2, $wikiTitre, PDO::PARAM_STR);
        $stmt->execute();

        $wikis = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new Wiki();
            $wiki->setId($row['wikiId']);
            $wiki->setTitre($row['wikiTitre']);
            $wiki->setDescription($row['description']);
            $wiki->setImage($row['wikiImage']);
            $wiki->getCategory()->setName($row['categorieName']);
            $wiki->getCategory()->setImage($row['categorieImage']);
            $wiki->getCategory()->setId($row['categorieId']);
            $wiki->getUser()->setName($row['userName']);
            array_push($wikis, $wiki);
        }
        return $wikis;
    }


}
