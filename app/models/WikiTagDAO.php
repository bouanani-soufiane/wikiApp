<?php
require_once __DIR__.'./entities/WikiTag.php';

class WikiTagDAO
{
    private $conn;
    private WikiTag $wikiTag;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->wikiTag = new WikiTag();
    }

    public function getWikiTag(): WikiTag
    {
        return $this->wikiTag;
    }

    public function setWikiTag(WikiTag $wikiTag): self
    {
        $this->wikiTag = $wikiTag;
        return $this;
    }

    public function create(WikiTag $wikiTag)
    {

        $idTag = $wikiTag->getTag()->getId();
        $idWiki = $wikiTag->getWiki()->getId();

        $stmt = $this->conn->prepare("INSERT INTO  wikitag (tagId,wikiId) VALUES (:tagId,:wikiId)");

        $stmt->bindParam(':tagId', $idTag);
        $stmt->bindParam(':wikiId', $idWiki);

        $stmt->execute();
    }
}
