-- Génération de données pour la table LIEU
INSERT INTO LIEU (Nom, Adresse, NbPlace, NbPlaceAssis, NmbPlaceDebout)
VALUES ('Salle de concert', '22 rue concert', 1000, 800, 200),
       ('Salle des fetes', '3 rue fete', 1500, 1200, 300),
       ('Théâtre', '7 rue theatre', 800, 600, 200),
       ('Salle de spectacle', '101 rue spectacle', 1200, 1000, 200),


INSERT INTO ARTISTE (Nom, Prénom, pseudo, idSpectacle)
SELECT CONCAT('Nom', FLOOR(RAND() * 100)),
       CONCAT('Prénom', FLOOR(RAND() * 100)),
       CONCAT('Pseudo', FLOOR(RAND() * 100)),
       FLOOR(RAND() * 10) + 1 -- L'id du spectacle associé (ajustez selon vos besoins)
FROM (SELECT 1 AS n
      UNION ALL
      SELECT 2 AS n
      UNION ALL
      SELECT 3 AS n
      UNION ALL
      SELECT 4 AS n
      UNION ALL
      SELECT 5 AS n
      UNION ALL
      SELECT 6 AS n
      UNION ALL
      SELECT 7 AS n
      UNION ALL
      SELECT 8 AS n) AS numbers LIMIT 80;
