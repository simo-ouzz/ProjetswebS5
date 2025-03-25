<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Inclure le modèle Project
require_once '../app/models/Project.php';

$projectModel = new Project();
$projects = $projectModel->getAllProjects();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des projets</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #000;
            margin: 0;
            padding: 0;
        }

        /* HEADER */
        .header {
            background-color: #8b3030;
            padding: 15px 30px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
        }

        .header-buttons button {
            background-color: #ff5e57;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .header-buttons button:hover {
            background-color: #ff3f34;
        }

        /* TABLEAU */
        .container {
            margin: 30px auto;
            width: 90%;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            color: #000;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .table th, .table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        .table th {
            background-color: #8b3030;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        /* BOUTONS D'OPTIONS */
        .option-buttons button {
            margin-right: 5px;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
            color: #fff;
        }

        .btn-join {
            background-color: #28a745;
        }

        .btn-join:hover {
            background-color: #218838;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-detail {
            background-color: #007bff;
        }

        .btn-detail:hover {
            background-color: #0056b3;
        }

        /* BOUTON AJOUTER PROJET */
        .add-project-btn {
            background-color: #ff5e57;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .add-project-btn:hover {
            background-color: #ff3f34;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <h1>Liste des Projets</h1>
    <div class="header-buttons">
        <a href="profil.php"><button>Profil</button></a>
        <a href="logout.php"><button>Déconnexion</button></a>
    </div>
</div>

<!-- CONTENU -->
<div class="container">
    <!-- BOUTON AJOUTER PROJET -->
    <a href="projectAction.php?action=add" class="add-project-btn">+ Ajouter Projet</a>

    <!-- TABLEAU -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Résumé</th>
                <th>État</th>
                <th>ADMIN</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($projects)): ?>
                <tr>
                    <td colspan="6">Aucun projet trouvé.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($project['id']); ?></td>
                        <td><?php echo htmlspecialchars($project['title']); ?></td>
                        <td><?php echo htmlspecialchars($project['summary']); ?></td>
                        <td><?php echo htmlspecialchars($project['status']); ?></td>
                        <td><?php echo htmlspecialchars($project['admin']); ?></td>
                        <td class="option-buttons">
                            <a href="projectAction.php?action=join&id=<?php echo $project['id']; ?>" class="btn btn-success">Rejoindre</a>
                            <a href="projectAction.php?action=edit&id=<?php echo $project['id']; ?>" class="btn btn-warning">Éditer</a>
                            <a href="projectAction.php?action=detail&id=<?php echo $project['id']; ?>" class="btn btn-info">Détail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
