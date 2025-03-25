<?php
require_once '../app/controllers/TacheController.php';

$controller = new TacheController();

if ($_GET['action'] === 'addtask' && isset($_GET['project_id'])) {
    // Ajouter une tâche pour un projet spécifique
    $controller->addTask($_GET['project_id']);
    
    // Rediriger vers la page de gestion des tâches après l'ajout
    header('gestiontaches.php?project_id=' . $_GET['project_id']);
    exit();
} elseif ($_GET['action'] === 'edit' && isset($_GET['id'])) {
    // Modifier une tâche existante
    $controller->editTask($_GET['id']);
    
    // Rediriger vers la page de gestion des tâches après la modification
    $taskProjectId = $_GET['project_id'] ?? null; // Récupérer l'ID du projet pour la redirection
    if ($taskProjectId) {
        header('gestiontaches.php?project_id=' . $taskProjectId);
    } else {
        // Si l'ID du projet n'est pas trouvé, rediriger vers la page de gestion des tâches avec un ID par défaut
        header('gestiontaches.php');
    }
    exit();
} elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
    // Supprimer une tâche existante
    $controller->deleteTask($_GET['id']);
    
    // Rediriger vers la page de gestion des tâches après la suppression
    $taskProjectId = $_GET['project_id'] ?? null; // Récupérer l'ID du projet pour la redirection
    if ($taskProjectId) {
        header('gestiontaches.php?project_id=' . $taskProjectId);
    } else {
        // Si l'ID du projet n'est pas trouvé, rediriger vers la page de gestion des tâches avec un ID par défaut
        header('gestiontaches.php');
    }
    exit();
}
?>
