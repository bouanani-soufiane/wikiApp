CREATE TABLE `user` (
    `userId` int(11) NOT NULL AUTO_INCREMENT,
    `userName` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    `password` varchar(255) DEFAULT NULL,
    `role` enum('author','admin') DEFAULT NULL,
    PRIMARY KEY (`userId`)
)

CREATE TABLE `categorie` (
    `categorieId` int(11) NOT NULL AUTO_INCREMENT,
    `categorieName` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`categorieId`)
)
CREATE TABLE `tag` (
    `tagId` int(11) NOT NULL AUTO_INCREMENT,
    `tagName` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`tagId`)
)

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
    CONSTRAINT `wiki_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`categorieId`),
    CONSTRAINT `wiki_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`userId`)
)

CREATE TABLE wikiTag
(
    pivotId int auto_increment primary key,
    tagId   int,
    wikiId  int,
    FOREIGN KEY (wikiId) REFERENCES wiki (wikiId),
    FOREIGN KEY (tagId) REFERENCES tag (tagId)
);