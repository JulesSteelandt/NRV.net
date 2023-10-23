-- Table LIEU
CREATE TABLE LIEU
(
    id             INT PRIMARY KEY,
    Nom            VARCHAR(255),
    Adresse        VARCHAR(255),
    NbPlace        INT,
    NbPlaceAssis   INT,
    NmbPlaceDebout INT
);

-- Table SOIREE
CREATE TABLE SOIREE
(
    id           INT PRIMARY KEY,
    Nom          VARCHAR(255),
    Theme        VARCHAR(255),
    Date         DATE,
    horaireDebut TIME,
    tarifNormal  DECIMAL(10, 2),
    tarifReduit  DECIMAL(10, 2),
    idLieu       INT,
    FOREIGN KEY (idLieu) REFERENCES LIEU (id)
);

-- Table SPECTACLE
CREATE TABLE SPECTACLE
(
    id          INT PRIMARY KEY,
    Titre       VARCHAR(255),
    Description TEXT,
    style       VARCHAR(255),
    urlVidéo    VARCHAR(255)
);

-- Table ARTISTE
CREATE TABLE ARTISTE
(
    id          INT PRIMARY KEY,
    Nom         VARCHAR(255),
    Prénom      VARCHAR(255),
    pseudo      VARCHAR(255),
    idSpectacle INT,
    FOREIGN KEY (idSpectacle) REFERENCES SPECTACLE (id)
);

-- Table IMAGE
CREATE TABLE IMAGE
(
    image       VARCHAR(255) PRIMARY KEY,
    idLieu      INT,
    idSpectacle INT,
    FOREIGN KEY (idLieu) REFERENCES LIEU (id),
    FOREIGN KEY (idSpectacle) REFERENCES SPECTACLE (id)
);

-- Table CALENDRIER
CREATE TABLE CALENDRIER
(
    idSoiree         INT,
    idSpectacle      INT,
    horaireSpectacle TIME,
    PRIMARY KEY (idSoiree, idSpectacle),
    FOREIGN KEY (idSoiree) REFERENCES SOIREE (id),
    FOREIGN KEY (idSpectacle) REFERENCES SPECTACLE (id)
);

