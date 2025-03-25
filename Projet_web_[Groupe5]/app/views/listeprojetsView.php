<?php
session_start();
$projects = $_SESSION['projects'] ?? [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des projets</title>
</head>
<body>
    <h2>Liste des projets</h2>
    <a href="/projects/add">Ajouter un projet</a>
    <ul>
        <?php foreach ($projects as $project): ?>
            <li>
                <a href="/projects/<?= $project['id'] ?>">
                    <?= htmlspecialchars($project['name']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
