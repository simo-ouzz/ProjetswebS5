<?php
require_once '../app/controllers/TacheController.php';
require_once '../app/models/Taches.php';

$projectId = $_GET['project_id'];
$tacheModel = new Taches();
$taches = $tacheModel->getTasksByProjectId($projectId);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches</title>
    <link rel="stylesheet" href="styles.css">
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

    /* BOUTON AJOUTER TACHE */
    .add-task-btn {
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .add-task-btn:hover {
        background-color: #218838;
    }

    /* BOUTONS D'OPTIONS */
    .option-buttons a {
        margin-right: 10px;
        text-decoration: none;
        padding: 8px 16px;
        background-color: #ffc107;
        color: #000;
        border-radius: 5px;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .option-buttons a:hover {
        background-color: #e0a800;
    }

    .option-buttons a.delete {
        background-color: #dc3545;
        color: #fff;
    }

    .option-buttons a.delete:hover {
        background-color: #c82333;
    }
</style>
</head>
<body>
    <h1>Gestion des Tâches pour le Projet #<?= htmlspecialchars($projectId) ?></h1>
    
    <a href="addTaskView.php?project_id=<?= $projectId ?>" class="add-task-btn">Ajouter une Tâche</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Task Number</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($taches)): ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Aucune tâche à afficher</td>
                </tr>
            <?php else: ?>
                <?php foreach ($taches as $index => $tache): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($tache['description']) ?></td>
                        <td id="status-<?= $tache['id'] ?>"><?= htmlspecialchars($tache['status']) ?></td>
                        <td>
                            <button><a href="tacheAction.php?action=edit&id=<?= $tache['id'] ?>">Modifier</a></button>
                            <button><a href="tacheAction.php?action=delete&id=<?= $tache['id'] ?>" onclick="return confirm('Supprimer cette tâche ?');">Supprimer</a></button>
                            <button class="select-btn" onclick="updateStatus(<?= $tache['id'] ?>, 'in_progress')">Sélectionner</button>
                            <button class="done-btn" onclick="updateStatus(<?= $tache['id'] ?>, 'completed')">Terminer</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        function updateStatus(taskId, newStatus) {
            const statusCell = document.getElementById('status-' + taskId);
            const row = statusCell.closest('tr');

            if (newStatus === 'in_progress') {
                statusCell.innerText = 'En cours';
            } else if (newStatus === 'completed') {
                statusCell.innerText = 'Terminée';
                // Disable buttons when task is marked as completed
                row.querySelectorAll('button').forEach(btn => btn.disabled = true);
            }
        }
    </script>
</body>
</html>
