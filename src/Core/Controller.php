<?php

abstract class Controller
{
    public function render($vue, $donnees = [])
    {
        // étape 1 : rendre les $donnees utilisables directement dans la vue
        extract($donnees);

        // étape 2 : include du header
        require_once(__DIR__ . '/../views/layout/header.php');

        // étape 3 : include de la vue demandée (celle passée en paramètre $vue)
        require_once(__DIR__ . "/../views/{$vue}.php");

        // étape 4 : include du footer
        require_once(__DIR__ . '/../views/layout/footer.php');
    }


    // Redirige l'utilisateur
    public function redirect(string $url)
    {
        header('Location: ' . $url);
        die();
    }

    public function verifyConnexion($url = "/connexion")
    {
        if (!isset($_SESSION['id_user'])) {
            $this->redirect($url);
            return;
        }
    }

    // Vérifie si la requête courante est une requête POST
    public function isPost(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
    }

    // Récupère et assainit une donnée POST (trim + htmlspecialchars)
    public function getPostData(string $key, $default = null)
    {
        if (!isset($_POST[$key])) {
            return $default;
        }

        return is_string($_POST[$key])
            ? htmlspecialchars(trim($_POST[$key]), ENT_QUOTES, 'UTF-8')
            : $_POST[$key];
    }

    // Génère (ou réutilise) un jeton CSRF stocké en session
    public function generateCsrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    // Vérifie la validité d'un jeton CSRF transmis par un formulaire
    public function verifyCsrfToken(?string $token): bool
    {
        return isset($_SESSION['csrf_token'])
            && $token !== null
            && hash_equals($_SESSION['csrf_token'], $token);
    }
}
