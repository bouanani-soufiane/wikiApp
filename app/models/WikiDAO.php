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

}
