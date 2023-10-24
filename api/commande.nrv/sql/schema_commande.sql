-- Table PANIER
CREATE TABLE PANIER
(
    mailUser  VARCHAR(255),
    idSoiree  INT,
    nmbPlace  INT,
    typeTarif int,
    PRIMARY KEY (mailUser, IdSoiree)
);

-- Table COMMANDE
CREATE TABLE COMMANDE
(
    idCommande INT AUTO_INCREMENT PRIMARY KEY,
    mailUser VARCHAR(255),
    statut INT,
    total DECIMAL(10, 2)
);

-- Table BILLET
CREATE TABLE BILLET
(
    reference VARCHAR(255) PRIMARY KEY,
    idSoiree  INT,
    mailUser  VARCHAR(255),
    date      DATE,
    horaire   TIME,
    catTarif  VARCHAR(255)
);

-- Table COMMANDE2SOIREE
CREATE TABLE COMMANDE2SOIREE
(
    idCommande INT,
    idSoiree   INT,
    typeTarif  INT,
    nmbPlace   INT,
    PRIMARY KEY (idCommande, idSoiree),
    FOREIGN KEY (idCommande) REFERENCES COMMANDE (idCommande)
);
