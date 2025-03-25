<?php
session_start();// Démarrer la session (utile pour plus tard avec les utilisateurs)
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Système de gestion des projets</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        /* HEADER */
        .header {
            background-color: #1a2b44;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        .header img {
            height: 50px;
        }
        .header .title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 24px;
            font-weight: bold;
        }
        .header .contact-info a {
            color: white;
            margin-left: 1200px;
            text-decoration: none;
            background-color: #a82a24;
            padding: 5px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 20px;
            border: none;
            cursor: pointer;
        }
        .header .contact-info a:hover {
            background-color: #ff3f34;
        }

        /* IMAGE PRINCIPALE */
        .header-image {
            width: 100%;
            height: 400px;
            background-size: cover;
            background-position: center;
            background-image: url('/projets6/media/logo.png'); /* Image principale */
            margin: 0;
            padding: 0;
        }

        /* SECTION PRINCIPALE */
        .card-section {
            background-color: #8b3030;
            padding: 20px 0;
            margin: 0;
        }
        .card {
            text-align: center;
            transition: transform 0.3s;
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            margin: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 280px;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .card img {
            width: 50px;
            margin-bottom: 15px;
        }

        /* FOOTER */
        footer {
            background-color: #1a2b44;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        footer a {
            color: #bbb;
            text-decoration: none;
            transition: color 0.3s;
        }
        footer a:hover {
            color: #fff;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <div class="title">Gestion de projet</div>
    <div class="contact-info">
        <a href="#">Contact</a>
    </div>
</div>

<!-- IMAGE PRINCIPALE -->
<div class="header-image"></div>

<!-- SECTION PRINCIPALE -->
<div class="card-section">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Carte Admin -->
            <div class="col-md-4">
                <div class="card">
                    <img src="/projets6/media/iconadmin.jpg" alt="Admin" />
                    <h4>Admin</h4>
                    <p>Espace Administrateur</p>
                    <a href="loginadmin.php"><button class="btn btn-dark">Click Here</button></a>
                </div>
            </div>
            <!-- Carte Étudiant -->
            <div class="col-md-4">
                <div class="card">
                    <img src="/projets6/media/iconuser.jpg" alt="Étudiant" />
                    <h4>USER</h4>
                    <p>Espace utilisateur</p>
                    <a href="login.php"><button class="btn btn-dark">Click Here</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>INFO</h5>
                <a href="https://www.fsts.ac.ma">Faculté des sciences et technique de Settat</a><br>
            </div>
            <div class="col-md-4">
                <h5>Nous contacter</h5>
                <a href="#">Contact</a>
            </div>
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <a href="#">🔵 LinkedIn</a>
            </div>
        </div>
        <p class="mt-3">© 2025 - Faculté des sciences et technique de Settat. All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>
