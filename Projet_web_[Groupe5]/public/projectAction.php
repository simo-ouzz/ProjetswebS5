<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Inclure le modèle Project
require_once __DIR__ . '/../app/models/Project.php';  // Utiliser __DIR__ pour éviter les erreurs de chemin

$projectModel = new Project();

// Vérifier l'action demandée dans l'URL
$action = $_GET['action'] ?? 'list';  // Par défaut, l'action est 'list'

// Traiter l'action
if ($action == 'add') {
    // Ajouter un projet
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $status = $_POST['status'];
        $admin = $_POST['admin'];  // L'admin peut être modifié

        // Ajouter le projet à la base de données
        $projectModel->addProject($title, $summary, $status, $admin);
        header('Location: projectAction.php?action=list');  // Rediriger vers la liste des projets
        exit();
    }

    // Vérifier si la vue existe avant de l'inclure
    $viewFile = __DIR__ . '/../app/views/addProjectView.php';
    if (file_exists($viewFile)) {
        include $viewFile;
    } else {
        die("Erreur : La vue addProjectView.php est introuvable.");
    }

} elseif ($action == 'edit') {
    // Modifier un projet
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    if ($id) {
        // Récupérer les informations du projet à éditer
        $project = $projectModel->getProjectById($id);

        // Si le formulaire est soumis, mettre à jour le projet
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $summary = $_POST['summary'];
            $status = $_POST['status'];
            $admin = $_POST['admin']; // L'admin peut être modifié

            // Mettre à jour le projet dans la base de données
            $projectModel->editProject($id, $title, $summary, $status, $admin);
            header('Location: projectAction.php?action=list');  // Rediriger vers la liste des projets
            exit();
        }

        // Vérifier si la vue existe avant de l'inclure
        $viewFile = __DIR__ . '/../app/views/editProjectView.php';
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            die("Erreur : La vue editProjectView.php est introuvable.");
        }
    } else {
        header('Location: projectAction.php?action=list');
        exit();
    }

} elseif ($action == 'detail') {
    // Afficher les détails d'un projet
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    if ($id) {
        // Récupérer les informations du projet
        $project = $projectModel->getProjectById($id);

        // Vérifier si la vue existe avant de l'inclure
        $viewFile = __DIR__ . '/../app/views/projectDetailView.php';
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            die("Erreur : La vue projectDetailView.php est introuvable.");
        }
    } else {
        header('Location: projectAction.php?action=list');
        exit();
    }

} elseif ($action == 'list') {
    // Liste des projets
    $projects = $projectModel->getAllProjects();

    // Vérifier si la vue de la liste existe avant inclusion
    $viewFile = __DIR__ . '/../public/listeprojetuser.php'; // Correction ici vers le fichier liteprojetuser.php dans public
    if (file_exists($viewFile)) {
        include $viewFile;
    } else {
        die("Erreur : La vue liteprojetuser.php est introuvable.");
    }

} elseif ($action == 'join') {
    // Rejoindre un projet
    $projectId = $_GET['id'] ?? null;
    if ($projectId) {
        $userId = $_SESSION['user_id']; // L'ID de l'utilisateur est stocké dans la session

        // Vérifier si l'utilisateur a déjà rejoint ce projet
        $query = "SELECT COUNT(*) FROM taches WHERE project_id = ? AND user_id = ?";
        $stmt = $GLOBALS['pdo']->prepare($query);
        $stmt->execute([$projectId, $userId]);
        $isMember = $stmt->fetchColumn() > 0;

        if (!$isMember) {
            // Ajouter l'utilisateur à la table des tâches pour le projet
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $description = $_POST['description'];
                $status = $_POST['status'];  // Vous pouvez ajouter plus de champs si nécessaire

                // Insérer la tâche dans la table taches avec les détails
                $insertQuery = "INSERT INTO taches (project_id, user_id, description, status) VALUES (?, ?, ?, ?)";
                $stmtInsert = $GLOBALS['pdo']->prepare($insertQuery);
                $stmtInsert->execute([$projectId, $userId, $description, $status]);
            }
        }

        // Rediriger vers la page de gestion des tâches du projet
        header("Location: gestionTaches.php?project_id=" . $projectId);
        exit();
    } else {
        header('Location: projectAction.php?action=list');
        exit();
    }
} else {
    // Par défaut, afficher la liste des projets
    header('Location: projectAction.php?action=list');
    exit();
}
?>
