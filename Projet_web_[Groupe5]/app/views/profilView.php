<?php
// Vérifier si l'utilisateur existe
if (!isset($user)) {
    echo "Utilisateur introuvable.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Utilisateur</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a2b44;
            color: #000;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .profile-card {
            background-color: #fff;
            padding: 30px;
            border: 2px solid #8b3030;
            border-radius: 8px;
            width: 600px;
            display: flex;
            align-items: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-image {
            text-align: center;
            margin-right: 30px;
        }

        .profile-image img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #8b3030;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .profile-details {
            flex: 1;
        }

        .profile-details p {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        .profile-details span {
            font-weight: 400;
            color: #555;
            margin-left: 10px;
            display: inline-block;
            min-width: 200px;
            border-bottom: 1px dashed #ccc;
        }

        .profile-label {
            font-weight: bold;
            color: #8b3030;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="profile-card">
    <!-- Partie profil (image + ID) -->
    <div class="profile-image">
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profil">
        <p><?php echo htmlspecialchars($user->id); ?></p>
    </div>

    <!-- Partie détails -->
    <div class="profile-details">
        <p><span class="profile-label">Nom Complet :</span><span><?php echo htmlspecialchars($user->full_name); ?></span></p>
        <p><span class="profile-label">Nom d'utilisateur :</span><span><?php echo htmlspecialchars($user->username); ?></span></p>
        <p><span class="profile-label">Université ou société :</span><span><?php echo htmlspecialchars($user->university_or_company); ?></span></p>
        <p><span class="profile-label">Adresse email :</span><span><?php echo htmlspecialchars($user->email); ?></span></p>
        <p><span class="profile-label">Rôle :</span><span><?php echo htmlspecialchars($user->role); ?></span></p>
    </div>
</div>

</body>
</html>
