-- Table UTILISATEUR
CREATE TABLE UTILISATEUR
(
    email    VARCHAR(255) PRIMARY KEY,
    mdp      VARCHAR(255),
    nom      VARCHAR(255),
    prenom   VARCHAR(255),
    typeUtil INT,
    refresh_token VARCHAR(255),
    refresh_token_expiration_date timestamp
);