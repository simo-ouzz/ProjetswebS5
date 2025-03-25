<?php
session_start();
require_once '../app/controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->login();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion - Système de gestion des choix de PFE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a2b44;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        /* FORMULAIRE DE CONNEXION */
        .login-container {
            background-color: #8b3030;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #fcfbfb;
        }

        .login-container .form-control {
            background-color: #fff;
            color: #333;
            border: none;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .login-container .btn {
            background-color: #ff5e57;
            color: #fff;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container .btn:hover {
            background-color: #ff3f34;
        }

        .login-container a {
            display: block;
            margin-top: 15px;
            color: #bbb;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .login-container a:hover {
            color: #fff;
        }

        /* ANIMATION */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Connexion</h2>
    
    <?php if (isset($_SESSION['error_message'])): ?>
        <p><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required />
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
        <button type="submit" class="btn">Se connecter</button>
    </form>
    <a href="signup.php">S'inscrire</a>
</div>

</body>
</html>
