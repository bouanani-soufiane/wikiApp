<?php
require_once __DIR__ . './entities/WikiTag.php';

class WikiTagDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create(WikiTag $wikiTag): void
    {
        $idTag = $wikiTag->getTag()->getId();
        $idWiki = $wikiTag->getWiki()->getId();

        $stmt = $this->conn->prepare("INSERT INTO wikitag (tagId, wikiId) VALUES (:tagId, :wikiId)");
        $stmt->bindParam(':tagId', $idTag, PDO::PARAM_INT);
        $stmt->bindParam(':wikiId', $idWiki, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete(array $tagIds, int $idWiki): void
    {
        if (empty($tagIds)) {
            return;
        }

        $placeholders = implode(',', array_fill(0, count($tagIds), '?'));
        $query = "DELETE FROM wikitag WHERE wikiId = ? AND tagId IN ($placeholders)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $idWiki, PDO::PARAM_INT);
        foreach ($tagIds as $index => $tagId) {
            $stmt->bindValue($index + 2, $tagId, PDO::PARAM_INT);
        }

        $stmt->execute();
    }
}