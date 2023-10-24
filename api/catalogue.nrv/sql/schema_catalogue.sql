-- Table LIEU
CREATE TABLE LIEU
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    nom            VARCHAR(255),
    adresse        VARCHAR(255),
    nbPlace        INT,
    nbPlaceAssis   INT,
    nmbPlaceDebout INT
);

-- Table SOIREE
CREATE TABLE SOIREE
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(255),
    theme        VARCHAR(255),
    date         DATE,
    horaireDebut TIME,
    tarifNormal  DECIMAL(10, 2),
    tarifReduit  DECIMAL(10, 2),
    idLieu       INT,
    FOREIGN KEY (idLieu) REFERENCES LIEU (id)
);

-- Table SPECTACLE
CREATE TABLE SPECTACLE
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    titre       VARCHAR(255),
    description TEXT,
    style       VARCHAR(255),
    urlVideo    VARCHAR(255)
);

-- Table ARTISTE
CREATE TABLE ARTISTE
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nom         VARCHAR(255),
    prenom      VARCHAR(255),
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


