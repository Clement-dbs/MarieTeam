
DROP TABLE IF EXISTS Secteur; 
CREATE TABLE Secteur (
    idSecteur INT AUTO_INCREMENT NOT NULL, 
    nomSecteur VARCHAR(30), 
    PRIMARY KEY (idSecteur)
);

DROP TABLE IF EXISTS Liaison; 
CREATE TABLE Liaison (
    CodeLiaison INT AUTO_INCREMENT NOT NULL, 
    Distance_en_Miles DECIMAL(5,2), 
    PortDepart VARCHAR(30), 
    PortArrive VARCHAR(30), 
    PRIMARY KEY (CodeLiaison),
    nomSecteur VARCHAR(30) REFERENCES Secteur (nomSecteur)
);

DROP TABLE IF EXISTS Tarif; 
CREATE TABLE Tarif (
    idTarif INT AUTO_INCREMENT NOT NULL, 
    Categorie VARCHAR(30), 
    TypeTarif VARCHAR(30), 
    periodeDebut DATE, 
    periodeFin DATE, 
    tarif DECIMAL(10,2), 
    PRIMARY KEY (idTarif)
);


DROP TABLE IF EXISTS traversees; 
CREATE TABLE traversees (
    id_Trav INT AUTO_INCREMENT NOT NULL, 
    id_Liaison INT, 
    Date_Trav DATE, 
    Heure TIME, 
    Bateau VARCHAR(30), 
    Places_A_Passager INT, 
    Places_B_Veh_inf_2m INT, 
    Place_C_Veh_sup_2m INT, 
    PRIMARY KEY (id_Trav),
    CodeLiaison INT REFERENCES Liaison (CodeLiaison)
);

DROP TABLE IF EXISTS client; 
CREATE TABLE client (
    idClient INT AUTO_INCREMENT NOT NULL, 
    Nom VARCHAR(30), 
    Adresse VARCHAR(30), 
    CodePostal INT, 
    Ville VARCHAR(30), 
    PRIMARY KEY (idClient)
);

DROP TABLE IF EXISTS reservation; 
CREATE TABLE  reservation (
    idResa INT AUTO_INCREMENT NOT NULL, 
    idClient INT, 
    Adultes INT,
    Junior INT,
    Enfant INT,
    Voiture INT,
    Fourgon INT,
    CampingCar INT,
    Camion INT,
    TarifTotal INT,
    PRIMARY KEY (idResa)
);


/* Jeu d'essaies

INSERT INTO liaison (CodeLiaison, Distance_en_Miles, PortDepart, PortArrive, nomSecteur) VALUES
(15, 8.3, 'Quiberon', 'Le Palais','Aix'),
(24, 9, 'Le Palais', 'Quiberon','Aix'),
(16, 8.0, 'Quiberon', 'Sauzon','Houat'),
(17, 7.9, 'Sauzon', 'Quiberon','Houat'),
(19, 23.7, 'Vannes', 'Le Palais','Houat'),
(11, 25.1, 'Le Palais', 'Vannes','Houat'),
(25, 8.8, 'Quiberon', 'Port St Gildas','Houat'),
(30, 8.8, 'Port St Gildas', 'Quiberon','Aix'),
(21, 7.7, 'Lorient', 'Port-Tudy','Houat'),
(22, 7.4, 'Port-Tudy', 'Lorient','Houat');



INSERT INTO secteur (nomSecteur) VALUES 
('Belle-Ile-en-Mer'), 
('Houat'),
('Aix'),
('Batz'),
('Bréhat'),
('Ile de Groix'),
('Molène'),
('Ouessant'),
('Sein'),
('Yeu'); 


INSERT INTO `tarif` (idTarif, Categorie, TypeTarif, periodeDebut, periodeFin, tarif) VALUES
(1,'A1', 'Adulte', '2023-09-01', '2024-06-15', 18.00),
(2,'A2', 'Junior ', '2023-09-01', '2024-06-15', 11.00),
(3,'A3', 'Enfant', '2023-09-01', '2024-06-15', 5.60),
(4,'B1', 'Voiture', '2023-09-01', '2024-06-15', 129.00),
(5,'C1', 'Fourgon', '2023-09-01', '2024-06-15', 189.00),
(6,'C2', 'CampingCar', '2023-09-01', '2024-06-15', 208.00),
(7,'C3', 'Camion', '2023-09-01', '2024-06-15', 268.00);

INSERT INTO `traversees`(`Heure`, `Bateau`, `Places_A_Passager`, `Places_B_Veh_inf_2m`, `Place_C_Veh_sup_2m`,`CodeLiaison`) VALUES 
('07:45','Kor Ant','238','11','2','15'),
('09:15','Ar Solen','276','5','1','17'),
('10:50','Al xi','250','3','0','17'),
('12:15','Luce isle','155','0','0','15'),
('14:30','Kor Ant','210','9','2','17'),
('16.45','Ar Solen','180','2','1','17'),
('18:15','Al xi','206','2','0','17'),
('19:45','Maellys','136','0','0','15');

*/