    -- Table LIEU
    CREATE TABLE LIEU
    (
        id             INT AUTO_INCREMENT PRIMARY KEY,
        nom            VARCHAR(255),
        adresse        VARCHAR(255),
        nbPlace        INT,
        nbPlaceAssis   INT,
        nmbPlaceDebout INT,
        image varchar(255)
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
        nbPlaceRestante INT,
        idLieu       INT,
        FOREIGN KEY (idLieu) REFERENCES LIEU (id)
    );

    -- Table STYLE
    CREATE TABLE STYLE
    (
        id           INT AUTO_INCREMENT PRIMARY KEY,
        nom          VARCHAR(255)
    );

    -- Table SPECTACLE
    CREATE TABLE SPECTACLE
    (
        id          INT AUTO_INCREMENT PRIMARY KEY,
        titre       VARCHAR(255),
        description TEXT,
        idStyle     INT,
        urlVideo    VARCHAR(255),
        image varchar(255),
        FOREIGN KEY (idStyle) REFERENCES STYLE (id)
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
        FOREIGN KEY (idSoiree) REFERENCES SOIREE (id),
        FOREIGN KEY (idCommande) REFERENCES COMMANDE (idCommande)
    );



