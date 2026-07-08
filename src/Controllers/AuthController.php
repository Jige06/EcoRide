<?php

class AuthController extends Controller
{
    public function inscription()
    {
        $this->render('auth/inscription');
    }

    public function register()
    {
        if (!$this->isPost()) {
            $this->redirect('/inscription');
        }

        // Vérification du jeton CSRF avant tout traitement
        if (!$this->verifyCsrfToken($this->getPostData('csrf_token'))) {
            $_SESSION['error'] = "Requête invalide, veuillez réessayer.";
            $this->redirect('/inscription');
            return;
        }

        $nom = $this->getPostData('nom');
        $prenom = $this->getPostData('prenom');
        $email = $this->getPostData('email');
        $password = trim($_POST['password'] ?? '');
        $confirmPassword = trim($_POST['confirm_password'] ?? '');
        $pseudo = $this->getPostData('pseudo');
        $telephone = $this->getPostData('telephone');
        $dateNaissance = $this->getPostData('date_naissance');
        $adresse = $this->getPostData('adresse');
        $codePostal = $this->getPostData('code_postal');
        $ville = $this->getPostData('ville');

        // on vérifie que les champs ne soient pas vides
        if ((!empty($nom)) && (!empty($prenom)) && (!empty($email)) && (!empty($password)) && (!empty($confirmPassword)) &&
            (!empty($pseudo)) && (!empty($telephone)) && (!empty($dateNaissance)) && (!empty($adresse)) &&
            (!empty($codePostal)) && (!empty($ville))
        ) {

            // Vérification que les champs ne contiennent que des lettres
            $regexNom = '/^[a-zA-ZÀ-ÿ\- ]+$/';
            if (!preg_match($regexNom, $nom) || !preg_match($regexNom, $prenom) || !preg_match($regexNom, $ville)) {
                $_SESSION['error'] = "Le nom, prénom et ville ne doivent contenir que des lettres.";
                $this->redirect('/inscription');
                return;
            }

            // Vérification du format de l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "L'adresse email n'est pas valide.";
                $this->redirect('/inscription');
                return;
            }

            // Vérification que le code postal ne contient que 5 chiffres
            if (!preg_match('/^[0-9]{5}$/', $codePostal)) {
                $_SESSION['error'] = "Le code postal doit contenir 5 chiffres.";
                $this->redirect('/inscription');
                return;
            }

            // Vérification que le téléphone ne contient que 10 chiffres
            if (!preg_match('/^[0-9]{10}$/', $telephone)) {
                $_SESSION['error'] = "Le numéro de téléphone doit contenir 10 chiffres.";
                $this->redirect('/inscription');
                return;
            }

            // Vérification que le mot de passe a le bon format (sécurité)
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{10,}$/', $password)) {
                $_SESSION['error'] = "Le mot de passe doit contenir au moins 10 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
                $this->redirect('/inscription');
                return;
            }

            // Vérification que le mot de passe est indique à la 1ere saisi
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
                $this->redirect('/inscription');
                return;
            }

            $repository = new UtilisateurRepository();

            if ($repository->findByEmail($email) !== null) {
                $_SESSION['error'] = "Un compte existe déjà avec cet email";
                $_SESSION['prefill_email'] = $email;
                $this->redirect('/inscription');
                return;
            }

            if ($repository->findByPseudo($pseudo) !== null) {
                $_SESSION['error'] = "Un compte existe déjà avec ce pseudo";
                $_SESSION['prefill_pseudo'] = $pseudo;
                $this->redirect('/inscription');
                return;
            }

            $hash = password_hash($password, PASSWORD_BCRYPT);

            $utilisateur = new Utilisateur();
            $utilisateur->setNom($nom)
                ->setPrenom($prenom)
                ->setEmail($email)
                ->setPassword($hash)
                ->setPseudo($pseudo)
                ->setTelephone($telephone)
                ->setDateNaissance($dateNaissance)
                ->setAdresse($adresse)
                ->setCodePostal($codePostal)
                ->setVille($ville);

            $repository->create($utilisateur);

            $this->redirect('/connexion');
        } else {
            $_SESSION['error'] = "Tous les champs doivent être remplis";
            $this->redirect('/inscription');
        }
    }

    public function connexion()
    {
        $this->render('auth/connexion');
    }

    public function login()
    {
        if (!$this->isPost()) {
            $this->redirect('/connexion');
        }

        if (!$this->verifyCsrfToken($this->getPostData('csrf_token'))) {
            $_SESSION['error'] = "Requête invalide, veuillez réessayer.";
            $this->redirect('/connexion');
            return;
        }

        $email = $this->getPostData('email');
        $password = trim($_POST['password'] ?? '');

        if ((!empty($email)) && (!empty($password))) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "L'adresse email n'est pas valide.";
                $this->redirect('/connexion');
                return;
            }

            $repository = new UtilisateurRepository();
            $utilisateur = $repository->findByEmail($email);

            if ($utilisateur === null || !password_verify($password, $utilisateur->getPassword())) {
                $_SESSION['error'] = "Identifiants incorrects";
                $this->redirect('/connexion');
                return;
            }

            // Régénère l'identifiant de session pour empêcher toute fixation de session
            session_regenerate_id(true);

            $_SESSION['id_user'] = $utilisateur->getIdUtilisateur();
            $_SESSION['nom'] = $utilisateur->getNom();
            $_SESSION['prenom'] = $utilisateur->getPrenom();
            $_SESSION['email'] = $utilisateur->getEmail();

            $this->redirect('/');
            return;
        } else {
            $_SESSION['error'] = "Veuillez remplir les champs.";
            $this->redirect('/connexion');
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['success'] = "Vous avez été déconnecté avec succès.";
        $this->redirect('/');
    }
}