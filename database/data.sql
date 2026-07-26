-- Jeu de données de test pour EcoRide
-- À exécuter après create_bdd.sql, sur une base vide
-- Mot de passe en clair pour tous les comptes de test : Password123!

SET NAMES utf8mb4;
USE DB_EcoRide;

INSERT INTO ROLES (libelle) VALUES
('passager'),
('chauffeur'),
('employe'),
('administrateur');

INSERT INTO PREFERENCE (libelle) VALUES
('Non-fumeur'),
('Fumeur'),
('Accepte les animaux'),
('N''accepte pas les animaux');

INSERT INTO MARQUE (libelle) VALUES
('Tesla'),
('BYD'),
('Honda'),
('Audi'),
('Renault'),
('Peugeot');

-- Le hash ci-dessous correspond au mot de passe "Password123!"
INSERT INTO UTILISATEUR (nom, prenom, email, password, credits, pseudo, telephone, date_naissance, adresse, code_postal, ville, photo) VALUES
('Dupont', 'Jean', 'jean.dupont@mail.fr', '$2b$10$dvfs.xTqG98zcSoJyFBNOOontnUIWCy92CWAOTlYOWpLpUHVXogDe', 20, 'JeanD', '0612345678', '1990-05-14', '12 rue de France', '06000', 'Nice', NULL),
('Curie', 'Marie', 'marie.curie@mail.fr', '$2b$10$dvfs.xTqG98zcSoJyFBNOOontnUIWCy92CWAOTlYOWpLpUHVXogDe', 15, 'MarieC', '0623456789', '1995-08-22', '25 promenade des Anglais', '06000', 'Nice', NULL),
('Martin', 'Paul', 'paul.martin@mail.fr', '$2b$10$dvfs.xTqG98zcSoJyFBNOOontnUIWCy92CWAOTlYOWpLpUHVXogDe', 20, 'PaulM', '0634567890', '1988-11-03', '8 avenue Jean Médecin', '06000', 'Nice', NULL),
('Leroy', 'Sophie', 'sophie.employe@ecoride.fr', '$2b$10$dvfs.xTqG98zcSoJyFBNOOontnUIWCy92CWAOTlYOWpLpUHVXogDe', 20, 'SophieL', '0645678901', '1985-02-19', '3 rue Gioffredo', '06000', 'Nice', NULL),
('Admin', 'Super', 'admin@ecoride.fr', '$2b$10$dvfs.xTqG98zcSoJyFBNOOontnUIWCy92CWAOTlYOWpLpUHVXogDe', 20, 'AdminEcoRide', '0656789012', '1980-01-01', '1 place Masséna', '06000', 'Nice', NULL);

-- Marques : 1=Tesla, 2=BYD, 3=Honda, 4=Audi, 5=Renault, 6=Peugeot
INSERT INTO VOITURE (modele, immatriculation, couleur, energie, date_premiere_immat, nb_place, id_marque, id_utilisateur) VALUES
('Model 3', 'AB-123-CD', 'Blanche', 'électrique', '2022-05-10', 4, 1, 1),
('208', 'EF-456-GH', 'Rouge', 'essence', '2019-03-15', 5, 6, 3);

INSERT INTO COVOITURAGE (date_depart, heure_depart, lieu_depart, date_arrivee, heure_arrivee, lieu_arrivee, statut, nb_place_covoit, prix_pers, id_voiture) VALUES
('2026-08-01', '08:00:00', 'Nice', '2026-08-01', '10:30:00', 'Marseille', 'en_attente', 3, 15.00, 1),
('2026-08-02', '09:00:00', 'Nice', '2026-08-02', '11:00:00', 'Cannes', 'en_attente', 4, 8.00, 2);

INSERT INTO AVIS (commentaire, note, statut_avis, id_utilisateur, id_covoiturage) VALUES
('Trajet impeccable, conducteur ponctuel et sympathique.', 5, 'validé', 2, 1),
('Bon voyage, léger retard au départ mais rien de grave.', 4, 'en_attente', 2, 2);

INSERT INTO utilisateur_roles (id_utilisateur, id_role) VALUES
(1, 1), -- Jean : passager
(1, 2), -- Jean : chauffeur
(2, 1), -- Marie : passager
(3, 2), -- Paul : chauffeur
(4, 3), -- Sophie : employe
(5, 4); -- Admin : administrateur

INSERT INTO utilisateur_covoiturage (id_utilisateur, id_covoiturage) VALUES
(2, 1), -- Marie participe au covoiturage 1
(2, 2); -- Marie participe au covoiturage 2

INSERT INTO utilisateur_preference (id_utilisateur, id_preference) VALUES
(1, 1), -- Jean : non-fumeur
(1, 3), -- Jean : accepte les animaux
(3, 2), -- Paul : fumeur
(3, 4); -- Paul : n'accepte pas les animaux