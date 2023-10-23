-- Table UTILISATEUR
CREATE TABLE UTILISATEUR
(
    email    VARCHAR(255) PRIMARY KEY,
    mdp      VARCHAR(255),
    nom      VARCHAR(255),
    prénom   VARCHAR(255),
    typeUtil VARCHAR(255)
);