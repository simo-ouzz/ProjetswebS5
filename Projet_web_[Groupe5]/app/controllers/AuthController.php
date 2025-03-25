<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclure le fichier de configuration de la base de données
require_once __DIR__ . '/../../config/config.php';

if (!isset($pdo)) {
    die("Erreur : La connexion à la base de données n'a pas été initialisée.");
}

class AuthController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Connexion utilisateur
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // ✅ Correction du chemin de redirection
                header("Location: /projets6/public/listeprojetuser.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect.";
                header("Location: /projets6/public/login.php");
                exit();
            }
        }
    }

    // Inscription utilisateur
    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = trim($_POST['full_name']);
            $email = trim($_POST['email']);
            $username = trim($_POST['username']);
            $fonction = trim($_POST['fonction']);
            $company = trim($_POST['company']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
                $_SESSION['error_message'] = "Les mots de passe ne correspondent pas.";
                header("Location: /projets6/public/signup.php");
                exit();
            }

            // Vérifier si l'utilisateur existe déjà
            $checkQuery = "SELECT id FROM users WHERE email = :email OR username = :username LIMIT 1";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute(['email' => $email, 'username' => $username]);
            if ($checkStmt->fetch()) {
                $_SESSION['error_message'] = "Cet email ou nom d'utilisateur est déjà utilisé.";
                header("Location: /projets6/public/signup.php");
                exit();
            }

            // Hash du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertion dans la base de données
            $query = "INSERT INTO users (full_name, email, username, fonction, company, password) 
                      VALUES (:full_name, :email, :username, :fonction, :company, :password)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'full_name' => $fullName,
                'email' => $email,
                'username' => $username,
                'fonction' => $fonction,
                'company' => $company,
                'password' => $hashedPassword
            ]);

            $_SESSION['success_message'] = "Inscription réussie. Connectez-vous !";
            header("/projets6/public/login.php");
            exit();
        }
    }

    // Déconnexion utilisateur
    public function logout() {
        session_destroy();
        header("Location: /projets6/public/login.php");
        exit();
    }
}

// ✅ Vérification de la connexion PDO
if (isset($pdo)) {
    $authController = new AuthController($pdo);
}
?>
