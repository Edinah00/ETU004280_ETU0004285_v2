CREATE DATABASE emprunt_objets;
USE emprunt_objets;

CREATE TABLE membre_empObj (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre VARCHAR(100),
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(255),
    image_profil VARCHAR(255)
);

CREATE TABLE categorie_objet_empObj (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

CREATE TABLE objet_empObj (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet_empObj(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre_empObj(id_membre)
);

CREATE TABLE images_objet_empObj (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES objet_empObj(id_objet)
);

CREATE TABLE emprunt_empObj (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet_empObj(id_objet),
    FOREIGN KEY (id_membre) REFERENCES membre_empObj(id_membre)
);


INSERT INTO categorie_objet_empObj (nom_categorie) VALUES 
('esthétique'), ('bricolage'), ('mécanique'), ('cuisine');

INSERT INTO membre_empObj (nom, date_naissance, genre, email, ville, mdp, image_profil)
VALUES 
('Alice', '2000-01-01', 'F', 'alice@example.com', 'Tana', 'alice123', 'alice.jpg'),
('Bob', '1998-06-15', 'H', 'bob@example.com', 'Majunga', 'bob123', 'bob.jpg'),
('Claire', '2001-03-20', 'F', 'claire@example.com', 'Fianara', 'claire123', 'claire.jpg'),
('David', '1995-12-05', 'H', 'david@example.com', 'Toamasina', 'david123', 'david.jpg');

-- Objets pour le membre 1
INSERT INTO objet_empObj (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),
('Peinture murale', 2, 1),
('Tournevis', 2, 1),
('Casserole', 4, 1),
('Bouilloire', 4, 1),
('Clé à molette', 3, 1),
('Lisseur', 1, 1),
('Perceuse', 2, 1),
('Mixeur', 4, 1),
('Casque de protection', 3, 1);

-- Objets pour le membre 2
INSERT INTO objet_empObj (nom_objet, id_categorie, id_membre) VALUES
('Trousse de maquillage', 1, 2),
('Marteau', 2, 2),
('Friteuse', 4, 2),
('Scie', 2, 2),
('Clé plate', 3, 2),
('Pinceau de maquillage', 1, 2),
('Four électrique', 4, 2),
('Pompe à vélo', 3, 2),
('Vernis', 1, 2),
('Visseuse', 2, 2);

-- Objets pour le membre 3
INSERT INTO objet_empObj (nom_objet, id_categorie, id_membre) VALUES
('Pied-de-biche', 2, 3),
('Robot cuisine', 4, 3),
('Outil de manucure', 1, 3),
('Rouleau de peinture', 2, 3),
('Tournevis étoile', 2, 3),
('Mixer à main', 4, 3),
('Coffret de maquillage', 1, 3),
('Crics', 3, 3),
('Pince multiprise', 3, 3),
('Gants de cuisine', 4, 3);

-- Objets pour le membre 4
INSERT INTO objet_empObj (nom_objet, id_categorie, id_membre) VALUES
('Fard à paupières', 1, 4),
('Perceuse sans fil', 2, 4),
('Casserole en inox', 4, 4),
('Kit réparation auto', 3, 4),
('Fer à repasser', 4, 4),
('Dégraissant moteur', 3, 4),
('Trousse d’outils', 2, 4),
('Palette de maquillage', 1, 4),
('Pompe hydraulique', 3, 4),
('Batteur électrique', 4, 4);


INSERT INTO emprunt_empObj (id_objet, id_membre, date_emprunt, date_retour)
VALUES 
(1, 2, '2025-07-01', '2025-07-10'),  -- Bob emprunte objet 1 (d’Alice)
(5, 3, '2025-07-02', '2025-07-12'),
(10, 4, '2025-07-03', '2025-07-13'),
(15, 1, '2025-07-04', '2025-07-14'),
(20, 2, '2025-07-05', '2025-07-15'),
(25, 3, '2025-07-06', '2025-07-16'),
(30, 4, '2025-07-07', '2025-07-17'),
(35, 1, '2025-07-08', '2025-07-18'),
(40, 2, '2025-07-09', '2025-07-19'),
(3, 3, '2025-07-10', '2025-07-20');


CREATE or replace view V_emprunt_obj as
select o.*,e.date_emprunt,e.date_retour,e.id_membre as emprunteur from objet_empObj o
join emprunt_empObj e on e.id_objet = o.id_objet ;

CREATE or replace view V_objet_categorie as
select o.*,c.nom_categorie from objet_empObj as o
join  categorie_objet_empObj as c
 on c.id_categorie=o.id_categorie;