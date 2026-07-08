<?php

class UtilisateurRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function create(Utilisateur $utilisateur): bool
    {
        $sql = "INSERT INTO UTILISATEUR 
                (nom, prenom, email, password, pseudo, telephone, date_naissance, adresse, code_postal, ville)
                VALUES 
                (:nom, :prenom, :email, :password, :pseudo, :telephone, :date_naissance, :adresse, :code_postal, :ville)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'nom' => $utilisateur->getNom(),
            'prenom' => $utilisateur->getPrenom(),
            'email' => $utilisateur->getEmail(),
            'password' => $utilisateur->getPassword(),
            'pseudo' => $utilisateur->getPseudo(),
            'telephone' => $utilisateur->getTelephone(),
            'date_naissance' => $utilisateur->getDateNaissance(),
            'adresse' => $utilisateur->getAdresse(),
            'code_postal' => $utilisateur->getCodePostal(),
            'ville' => $utilisateur->getVille(),
        ]);
    }

    public function findByEmail($email) 
    {
        $sql = "SELECT utilisateur.* FROM utilisateur WHERE email= :email";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        
        if (!$user) {
            return null;
        }

        $utilisateur = new Utilisateur();
        $utilisateur->setIdUtilisateur($user['id_utilisateur']);
        $utilisateur->setNom($user['nom']);
        $utilisateur->setPrenom($user['prenom']);
        $utilisateur->setEmail($user['email']);
        $utilisateur->setPassword($user['password']);
        $utilisateur->setCredits($user['credits']);
        $utilisateur->setPseudo($user['pseudo']);
        $utilisateur->setTelephone($user['telephone']);
        $utilisateur->setDateNaissance($user['date_naissance']);
        $utilisateur->setAdresse($user['adresse']);
        $utilisateur->setCodePostal($user['code_postal']);
        $utilisateur->setVille($user['ville']);
        $utilisateur->setPhoto($user['photo']);
        return $utilisateur;
    }

    public function findByPseudo($pseudo)
    {
        $sql = "SELECT utilisateur.* FROM utilisateur WHERE pseudo = :pseudo";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['pseudo' => $pseudo]);
        $user = $stmt->fetch();

        if (!$user) {
            return null;
        }

        $utilisateur = new Utilisateur();
        $utilisateur->setIdUtilisateur($user['id_utilisateur']);
        $utilisateur->setNom($user['nom']);
        $utilisateur->setPrenom($user['prenom']);
        $utilisateur->setEmail($user['email']);
        $utilisateur->setPassword($user['password']);
        $utilisateur->setCredits($user['credits']);
        $utilisateur->setPseudo($user['pseudo']);
        $utilisateur->setTelephone($user['telephone']);
        $utilisateur->setDateNaissance($user['date_naissance']);
        $utilisateur->setAdresse($user['adresse']);
        $utilisateur->setCodePostal($user['code_postal']);
        $utilisateur->setVille($user['ville']);
        $utilisateur->setPhoto($user['photo']);
        return $utilisateur;
    }
}