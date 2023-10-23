-- Table PANIER
CREATE TABLE PANIER
(
    mailUser  VARCHAR(255),
    IdSoiree  INT,
    nmbPlace  INT,
    typeTarif VARCHAR(255),
    PRIMARY KEY (mailUser,IdSoiree)
);

-- Table COMMANDE
CREATE TABLE COMMANDE
(
    idCommande INT PRIMARY KEY,
    idUser     VARCHAR(255),
    statut     VARCHAR(255),
    total      DECIMAL(10, 2),
);

-- Table BILLET
CREATE TABLE BILLET
(
    Reference VARCHAR(255) PRIMARY KEY,
    idSoiree  INT,
    mailUser  VARCHAR(255),
    date      DATE,
    horaire   TIME,
    catTarif  VARCHAR(255),
);

-- Table COMMANDE2SOIREE
CREATE TABLE COMMANDE2SOIREE
(
    idCommande INT,
    idSoiree   INT,
    typeTarif  VARCHAR(255),
    nmbPlace   INT,
    PRIMARY KEY (idCommande, idSoiree),
    FOREIGN KEY (idCommande) REFERENCES COMMANDE (idCommande),
);
