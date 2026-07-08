CREATE DATABASE IF NOT EXISTS DB_EcoRide;
USE DB_EcoRide;

CREATE TABLE ROLES(
   id_role INT AUTO_INCREMENT,
   libelle VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_role)
);

CREATE TABLE PREFERENCE(
   id_preference INT AUTO_INCREMENT,
   libelle VARCHAR(100) NOT NULL,
   PRIMARY KEY(id_preference)
);

CREATE TABLE MARQUE(
   id_marque INT AUTO_INCREMENT,
   libelle VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_marque)
);

CREATE TABLE UTILISATEUR(
   id_utilisateur INT AUTO_INCREMENT,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   password VARCHAR(255) NOT NULL,
   credits INT NOT NULL DEFAULT 20,
   pseudo VARCHAR(50) NOT NULL,
   telephone VARCHAR(10) NOT NULL,
   date_naissance DATE NOT NULL,
   adresse VARCHAR(50) NOT NULL,
   code_postal VARCHAR(50) NOT NULL,
   ville VARCHAR(50) NOT NULL,
   photo TEXT,
   PRIMARY KEY(id_utilisateur),
   UNIQUE(email),
   UNIQUE(pseudo)
);

CREATE TABLE VOITURE(
   id_voiture INT AUTO_INCREMENT,
   modele VARCHAR(50) NOT NULL,
   immatriculation VARCHAR(20) NOT NULL,
   couleur VARCHAR(50) NOT NULL,
   energie ENUM('électrique','essence','diesel','hybride') NOT NULL,
   date_premiere_immat DATE NOT NULL,
   nb_place INT NOT NULL,
   id_marque INT NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_voiture),
   UNIQUE(immatriculation),
   FOREIGN KEY(id_marque) REFERENCES MARQUE(id_marque),
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur)
);

CREATE TABLE COVOITURAGE(
   id_covoiturage INT AUTO_INCREMENT,
   date_depart DATE NOT NULL,
   heure_depart TIME NOT NULL,
   lieu_depart VARCHAR(50) NOT NULL,
   date_arrivee DATE NOT NULL,
   heure_arrivee TIME NOT NULL,
   lieu_arrivee VARCHAR(50) NOT NULL,
   statut ENUM('en_attente','en_cours','terminé','annulé') NOT NULL DEFAULT 'en_attente',
   nb_place_covoit INT NOT NULL,
   prix_pers DECIMAL(7,2) NOT NULL,
   id_voiture INT NOT NULL,
   PRIMARY KEY(id_covoiturage),
   FOREIGN KEY(id_voiture) REFERENCES VOITURE(id_voiture)
);

CREATE TABLE AVIS(
   id_avis INT AUTO_INCREMENT,
   commentaire TEXT NOT NULL,
   note INT NOT NULL,
   statut_avis ENUM('en_attente','validé','refusé') NOT NULL DEFAULT 'en_attente',
   id_utilisateur INT NOT NULL,
   id_covoiturage INT NOT NULL,
   PRIMARY KEY(id_avis),
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur),
   FOREIGN KEY(id_covoiturage) REFERENCES COVOITURAGE(id_covoiturage)
);

CREATE TABLE utilisateur_roles(
   id_utilisateur INT,
   id_role INT,
   PRIMARY KEY(id_utilisateur, id_role),
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur),
   FOREIGN KEY(id_role) REFERENCES ROLES(id_role)
);

CREATE TABLE utilisateur_covoiturage(
   id_utilisateur INT,
   id_covoiturage INT,
   PRIMARY KEY(id_utilisateur, id_covoiturage),
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur),
   FOREIGN KEY(id_covoiturage) REFERENCES COVOITURAGE(id_covoiturage)
);

CREATE TABLE utilisateur_preference(
   id_utilisateur INT,
   id_preference INT,
   PRIMARY KEY(id_utilisateur, id_preference),
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur),
   FOREIGN KEY(id_preference) REFERENCES PREFERENCE(id_preference)
);