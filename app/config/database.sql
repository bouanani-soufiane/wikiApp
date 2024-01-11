CREATE TABLE `user` (
    `userId` int(11) NOT NULL AUTO_INCREMENT,
    `userName` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    `password` varchar(255) DEFAULT NULL,
    `role` enum('author','admin') DEFAULT NULL,
    PRIMARY KEY (`userId`)
);
CREATE TABLE `categorie` (
    `categorieId` int(11) NOT NULL AUTO_INCREMENT,
    `categorieName` varchar(255) DEFAULT NULL,
    `categorieImage` longblob DEFAULT NULL,
        PRIMARY KEY (`categorieId`)
);
CREATE TABLE `tag` (
    `tagId` int(11) NOT NULL AUTO_INCREMENT,
    `tagName` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`tagId`)
);

CREATE TABLE `wiki` (
    `wikiId` int(11) NOT NULL AUTO_INCREMENT,
    `wikiTitre` varchar(255) DEFAULT NULL,
    `description` varchar(500) DEFAULT NULL,
    `wikiContent` text DEFAULT NULL,
    `wikiImage` longblob DEFAULT NULL,
    `isArchived` tinyint(1) DEFAULT 0,
    `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
    `idCategorie` int(11) DEFAULT NULL,
    `idUser` int(11) DEFAULT NULL,
    PRIMARY KEY (`wikiId`),
    KEY `idCategorie` (`idCategorie`),
    KEY `idUser` (`idUser`),
    CONSTRAINT `wiki_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`categorieId`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `wiki_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE wikiTag
(
    pivotId int AUTO_INCREMENT PRIMARY KEY,
    tagId   int,
    wikiId  int,
    FOREIGN KEY (wikiId) REFERENCES wiki (wikiId) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (tagId) REFERENCES tag (tagId) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE VIEW wikiTagView AS
SELECT
    wiki.wikiId,
    wiki.wikiTitre,
    tag.tagId,
    tag.tagName
FROM
    wiki
        LEFT JOIN wikiTag ON wiki.wikiId = wikiTag.wikiId
        LEFT JOIN tag ON wikiTag.tagId = tag.tagId;
