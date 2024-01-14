<?php
require_once __DIR__ . './entities/Wiki.php';
require_once __DIR__ . './entities/WikiTag.php';

class WikiDAO {
    private PDO $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create(Wiki $wiki): bool {
        $wikiTitre = $wiki->getTitre();
        $description = $wiki->getDescription();
        $wikiContent = $wiki->getContent();
        $wikiImage = $wiki->getImage() ?? "2922280_27002.jpg";
        $idCategorie = $wiki->getCategory()->getId();
        $idUser = $wiki->getUser()->getId();

        $stmt = $this->conn->prepare("
            INSERT INTO wiki (wikiTitre, description, wikiContent, wikiImage, idCategorie, idUser) 
            VALUES (:wikiTitre, :description, :wikiContent, :wikiImage, :idCategorie, :idUser)
        ");

        $stmt->bindParam(':wikiTitre', $wikiTitre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':wikiContent', $wikiContent);
        $stmt->bindParam(':wikiImage', $wikiImage);
        $stmt->bindParam(':idCategorie', $idCategorie);
        $stmt->bindParam(':idUser', $idUser);

        $stmt->execute();
        return true;
    }

    public function showWiki(): array {
        $stmt = $this->conn->prepare("
            SELECT wiki.*, categorie.categorieName 
            FROM wiki 
            LEFT JOIN categorie ON wiki.idCategorie = categorie.categorieId 
            ORDER BY wiki.createdAt DESC
        ");
        $stmt->execute();

        $wikis = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new Wiki();
            $wiki->setId($row['wikiId'])
                ->setTitre($row['wikiTitre'])
                ->setDescription($row['description'])
                ->setContent($row['wikiContent'])
                ->setImage($row['wikiImage'])
                ->setCreatedAt($row['createdAt'])
                ->setIsArchived($row['isArchived'])
                ->getCategory()->setName($row['categorieName']);

            $wikis[] = $wiki;
        }
        return $wikis;
    }

    public function showLsatWikis(): array {
        $stmt = $this->conn->prepare("
            SELECT wiki.*, categorie.categorieName 
            FROM wiki 
            LEFT JOIN categorie ON wiki.idCategorie = categorie.categorieId 
            WHERE isArchived = 0 
            ORDER BY wiki.createdAt DESC 
            LIMIT 6
        ");
        $stmt->execute();

        $wikis = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new Wiki();
            $wiki->setId($row['wikiId'])
                ->setTitre($row['wikiTitre'])
                ->setDescription($row['description'])
                ->setContent($row['wikiContent'])
                ->setImage($row['wikiImage'])
                ->setCreatedAt($row['createdAt'])
                ->setIsArchived($row['isArchived'])
                ->getCategory()->setName($row['categorieName']);

            $wikis[] = $wiki;
        }
        return $wikis;
    }

    public function showSingleWiki(int $id): array {
        $stmt = $this->conn->prepare("
            SELECT wiki.*, categorie.categorieName, user.userName 
            FROM wiki 
            LEFT JOIN categorie ON wiki.idCategorie = categorie.categorieId 
            LEFT JOIN user ON wiki.idUser = user.userId 
            WHERE wikiId = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $wiki = new Wiki();
            $wiki->setId($row['wikiId'])
                ->setTitre($row['wikiTitre'])
                ->setDescription($row['description'])
                ->setContent($row['wikiContent'])
                ->setImage($row['wikiImage'])
                ->setCreatedAt($row['createdAt'])
                ->getCategory()->setName($row['categorieName'])
                ->getUser()->setName($row['userName'])
                ->getUser()->setId($row['idUser']);

            $stmt = $this->conn->prepare("SELECT * FROM wikiTagView WHERE wikiId = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $wikiTags = [];
            while ($tagsRow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $wikiTag = new WikiTag();
                $wikiTag->getTag()->setId($tagsRow['tagId'])
                    ->getTag()->setName($tagsRow['tagName'])
                    ->getWiki()->setId($row['wikiId']);

                $wikiTags[] = $wikiTag;
            }

            return [$wiki, $wikiTags];
        }

        return [];
    }

    public function update(Wiki $wiki): void {
        $wikiId = $wiki->getId();
        $wikiTitre = $wiki->getTitre();
        $description = $wiki->getDescription();
        $wikiContent = $wiki->getContent();
        $idCategorie = $wiki->getCategory()->getId();
        $wikiImage = $wiki->getImage();

        $query = "UPDATE wiki SET wikiTitre = :wikiTitre, description = :description, wikiContent = :wikiContent, idCategorie = :idCategorie";
        if ($wikiImage !== null) {
            $query .= ", wikiImage = :wikiImage";
        }
        $query .= " WHERE wikiId = :wikiId";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':wikiId', $wikiId, PDO::PARAM_INT);
        $statement->bindParam(':wikiTitre', $wikiTitre, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':wikiContent', $wikiContent, PDO::PARAM_STR);
        $statement->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
        if ($wikiImage !== null) {
            $statement->bindParam(':wikiImage', $wikiImage, PDO::PARAM_STR);
        }

        $statement->execute();
    }

    public function delete(int $id): void {
        $query = "DELETE FROM wiki WHERE wikiId = :wikiId";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':wikiId', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function archive(int $id): void {
        $query = "UPDATE wiki SET isArchived = 1 WHERE wikiId = :wikiId";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':wikiId', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function countWiki(): int {
        $query = "SELECT COUNT(*) AS wikiCount FROM wiki";
        $statement = $this->conn->prepare($query);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_OBJ);
        return (int)$result->wikiCount;
    }

    public function showWikiCateg(int $id): array {
        $stmt = $this->conn->prepare("
            SELECT wiki.*, categorie.categorieName 
            FROM wiki 
            LEFT JOIN categorie ON wiki.idCategorie = categorie.categorieId 
            WHERE categorie.categorieId = :id 
            ORDER BY wiki.createdAt DESC
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $wikis = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new Wiki();
            $wiki->setId($row['wikiId'])
                ->setTitre($row['wikiTitre'])
                ->setDescription($row['description'])
                ->setContent($row['wikiContent'])
                ->setImage($row['wikiImage'])
                ->setCreatedAt($row['createdAt'])
                ->setIsArchived($row['isArchived'])
                ->getCategory()->setName($row['categorieName']);

            $wikis[] = $wiki;
        }
        return $wikis;
    }

    public function showWikiAuthor(int $id): array {
        $stmt = $this->conn->prepare("
            SELECT wiki.*, categorie.categorieName 
            FROM wiki 
            LEFT JOIN categorie ON wiki.idCategorie = categorie.categorieId 
            WHERE idUser = :id 
            ORDER BY wiki.createdAt DESC
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $wikis = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new Wiki();
            $wiki->setId($row['wikiId'])
                ->setTitre($row['wikiTitre'])
                ->setDescription($row['description'])
                ->setContent($row['wikiContent'])
                ->setImage($row['wikiImage'])
                ->setCreatedAt($row['createdAt'])
                ->setIsArchived($row['isArchived'])
                ->getCategory()->setName($row['categorieName'])
                ->getUser()->setId($row['idUser']);

            $wikis[] = $wiki;
        }
        return $wikis;
    }

    public function searchWiki(string $wikiTitre): array {
        $stmt = $this->conn->prepare("
            SELECT DISTINCT wiki.*, user.*, categorie.* 
            FROM wiki 
            JOIN user ON wiki.idUser = user.userId 
            JOIN categorie ON wiki.idCategorie = categorie.categorieId 
            WHERE wiki.wikiTitre LIKE CONCAT('%', ?, '%') 
            OR categorie.categorieName LIKE CONCAT('%', ?, '%')
        ");
        $stmt->bindValue(1, $wikiTitre, PDO::PARAM_STR);
        $stmt->bindValue(2, $wikiTitre, PDO::PARAM_STR);
        $stmt->execute();

        $wikis = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new Wiki();
            $wiki->setId($row['wikiId'])
                ->setTitre($row['wikiTitre'])
                ->setDescription($row['description'])
                ->setImage($row['wikiImage'])
                ->getCategory()->setName($row['categorieName'])
                ->getCategory()->setImage($row['categorieImage'])
                ->getCategory()->setId($row['categorieId'])
                ->getUser()->setName($row['userName']);

            $wikis[] = $wiki;
        }
        return $wikis;
    }
}