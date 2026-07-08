<?php

class Utilisateur
{
    private ?int $idUtilisateur = null;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;
    private int $credits = 20;
    private string $pseudo;
    private string $telephone;
    private string $dateNaissance;
    private string $adresse;
    private string $codePostal;
    private string $ville;
    private ?string $photo = null;

    // --- Getters ---

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCredits(): int
    {
        return $this->credits;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getDateNaissance(): string
    {
        return $this->dateNaissance;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getCodePostal(): string
    {
        return $this->codePostal;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    // --- Setters ---

    public function setIdUtilisateur(int $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;
        return $this;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setCredits(int $credits): self
    {
        $this->credits = $credits;
        return $this;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function setDateNaissance(string $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;
        return $this;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;
        return $this;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;
        return $this;
    }
}