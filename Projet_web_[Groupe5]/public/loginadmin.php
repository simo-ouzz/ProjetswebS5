<?php
session_start();// Vérifier si l'utilisateur est déjà connecté en tant qu'admin
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: listeprojetuser.php'); // Rediriger vers la liste des projets si l'admin est déjà connecté
    exit();
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Remplacer les valeurs par celles de la base de données
    $admin_username = 'admin';  // Exemple de nom d'utilisateur
    $admin_password = 'admin123';  // Exemple de mot de passe (en texte clair, pour la démonstration)

    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username === $admin_username && $input_password === $admin_password) {
        // Si les identifiants sont corrects, démarrer la session et rediriger vers la page des projets
        $_SESSION['admin_logged_in'] = true;
        header('Location: liste_projets.php');
        exit();
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion Admin - Système de gestion des projets</title>
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
    <h2>Connexion Admin</h2>
    <?php
    // Afficher un message d'erreur si les identifiants sont incorrects
    if (isset($error_message)) {
        echo '<p style="color: #fff;">' . $error_message . '</p>';
    }
    ?>
    <form action="loginadmin.php" method="POST">
        <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required />
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
        <button type="submit" class="btn">Se connecter</button>
    </form>
</div>

</body>
</html>
