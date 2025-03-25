<?php
session_start();

// Vérifier si l'ID du projet est passé dans l'URL
$projectId = $_GET['project_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectId = $_POST['project_id'] ?? null;
    $description = $_POST['description'] ?? null;
    $status = $_POST['status'] ?? null;

    echo "Project ID: " . htmlspecialchars($projectId) . "<br>";
    echo "Description: " . htmlspecialchars($description) . "<br>";
    echo "Status: " . htmlspecialchars($status) . "<br>";

    // Vérifier si les valeurs sont correctes
    if ($projectId && $description && $status) {
        // Code pour ajouter la tâche (par exemple, sauvegarder dans la base de données)
        echo "Les données sont valides.";
    } else {
        echo "Des données sont manquantes.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Tâche</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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
        h1 {
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-size: 1rem;
            color: #333;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: #4CAF50;
            outline: none;
        }
        textarea {
            height: 150px;
        }
        select {
            font-size: 1rem;
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
        <h1>Ajouter une Tâche pour le Projet #<?= htmlspecialchars($projectId) ?></h1>

        <form method="POST" action="tacheAction.php?action=addtask&project_id=<?= htmlspecialchars($projectId) ?>">
            <input type="hidden" name="project_id" value="<?= htmlspecialchars($projectId) ?>">

            <div class="form-group">
                <label for="description">Description de la tâche :</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="status">Statut de la tâche :</label>
                <select class="form-control" name="status" required>
                    <option value="pending">En attente</option>
                    <option value="in_progress">En cours</option>
                    <option value="completed">Terminée</option>
                </select>
            </div>

            <button type="submit" class="btn">Ajouter la Tâche</button>
        </form>
    </div>
</body>
</html>
