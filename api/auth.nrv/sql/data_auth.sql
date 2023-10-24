-- Utilisateur 1 (typeUtil = 1)
INSERT INTO UTILISATEUR (email, mdp, nom, prénom, typeUtil)
VALUES ('user1@example.com',
        '$2y$10$3wAl6ybKMwcT0/g5BZZyS.Cv1WhaH/.WEJC.ttjQ8sJ1OjwsbhVsm',
        'user1',
        'User',
        1);

-- Utilisateur 2 (typeUtil = 1)
INSERT INTO UTILISATEUR (email, mdp, nom, prénom, typeUtil)
VALUES ('user2@example.com',
       '$2y$10$1u4bTOK4ndB47QBUf2wYMexB9QiaMTAYcdmPMIn6nzYfODN.nDzD2',
        'user2',
        'us3',
        1);

-- Utilisateur 3 (typeUtil = 1)
INSERT INTO UTILISATEUR (email, mdp, nom, prénom, typeUtil)
VALUES ('user3@example.com',
       '$2y$10$Hxg2aEnUZ2a2IvTZ1U1MOOoMwDM4Jy1q.PprwE25vlI51/9MBTEgC',
        'user3',
        'us3',
        1);

-- Utilisateur 4 (typeUtil = 2)
INSERT INTO UTILISATEUR (email, mdp, nom, prénom, typeUtil)
VALUES ('admin@example.com',
        '$2y$10$WD/NkRVy7lK8fMsqb63CGuarLfObcXDdCe/.gbH6Fx9SEyIwyd4qa',
        'admin',
        'adm',
        2);
