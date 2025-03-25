<?php
session_start();
require_once '../app/controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->signup();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription - Système de gestion des choix de PFE</title>
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

        /* FORMULAIRE D'INSCRIPTION */
        .signup-container {
            background-color: #8b3030;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }

        .signup-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #fcfbfb;
        }

        .signup-container .form-control,
        .signup-container select {
            background-color: #fff;
            color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            outline: none;
            appearance: none; /* Supprime la flèche par défaut */
        }

        .signup-container select {
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'><path fill='%23333' d='M4.5 6l3.5 4 3.5-4H4.5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
            cursor: pointer;
        }

        .signup-container .form-control:focus,
        .signup-container select:focus {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .signup-container .btn {
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

        .signup-container .btn:hover {
            background-color: #ff3f34;
        }

        .signup-container a {
            display: block;
            margin-top: 15px;
            color: #bbb;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .signup-container a:hover {
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

<div class="signup-container">
    <h2>Inscription</h2>
    <?php if (isset($_SESSION['error_message'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
    <?php endif; ?>

    
    <form action="signup.php" method="POST">
        <input type="text" name="full_name" class="form-control" placeholder="Nom complet" required />
        <input type="email" name="email" class="form-control" placeholder="Adresse email" required />
        <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required />
        
        <select name="fonction" class="form-control" required>
            <option value="" disabled selected>Fonction</option>
            <option value="Etudiant">Étudiant</option>
            <option value="Professionnel">Professionnel</option>
        </select>
        
        <input type="text" name="company" class="form-control" placeholder="Université ou société" required />
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirmer le mot de passe" required />
        <button type="submit" class="btn">S'inscrire</button>
    </form>
    <a href="login.php">Déjà un compte ? Se connecter</a>
</div>

</body>
</html>
