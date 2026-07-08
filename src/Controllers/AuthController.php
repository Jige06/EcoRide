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
            if ($_POST['password'] !== $_POST['confirm_password']) {
                $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
                $this->redirect('/inscription');
                return;
            }

            $repository = new UtilisateurRepository();

            // Vérifie que l'email n'est pas déjà utilisé (utilise findByEmail)
            // Si l'email existe déjà, redirige vers /inscription avec un message d'erreur
            if ($repository->findByEmail($email) !== null) {
                $_SESSION['error'] = "Un compte existe déjà avec cet email";
                $_SESSION['prefill_email'] = $email;
                $this->redirect('/inscription');
                return;
            }
            // Vérifie que le pseudo n'est pas déjà utilisé (utilise findByPseudo)
            // Si le pseudo existe déjà, redirige vers /inscription avec un message d'erreur
            if ($repository->findByPseudo($pseudo) !== null) {
                $_SESSION['error'] = "Un compte existe déjà avec ce pseudo";
                $_SESSION['prefill_pseudo'] = $pseudo;
                $this->redirect('/inscription');
                return;
            }

            // Hash le mot de passe avec la fonction PHP appropriée
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
}
