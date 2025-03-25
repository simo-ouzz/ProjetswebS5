<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Projet</title>
    <style>
        /* styles internes */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Détails du Projet</h2>
        <p><strong>Titre :</strong> <?= htmlspecialchars($project['title']) ?></p>
        <p><strong>Résumé :</strong> <?= htmlspecialchars($project['summary']) ?></p>
        <p><strong>État :</strong> <?= htmlspecialchars($project['status']) ?></p>
        <p><strong>Administrateur :</strong> <?= htmlspecialchars($project['admin']) ?></p>

        <a href="projectAction.php?action=list" class="btn btn-secondary">Retour à la liste des projets</a>
    </div>
</body>
</html>
