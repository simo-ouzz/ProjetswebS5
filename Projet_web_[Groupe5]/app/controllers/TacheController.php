<?php
session_start();
require_once '../app/models/Taches.php';

class TacheController {

    // Afficher la liste des tâches pour un projet donné
    public function viewTasks($projectId) {
        $tacheModel = new Taches();
        $tasks = $tacheModel->getTasksByProjectId($projectId);
        
        require_once '../app/views/taskListView.php';
    }

    // Ajouter une tâche (avec user_id)
    public function addTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $projectId = $_POST['project_id'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            // Récupérer l'user_id de la session
            $userId = $_SESSION['user_id'];

            $tacheModel = new Taches();
            $tacheModel->addTask($projectId, $description, $status, $userId);

            header('/public/gestiontaches.php?project_id=' . $projectId); // Redirection vers la page de gestion des tâches
            exit();
        }

        require_once '../app/views/addTaskView.php';
    }

    // Modifier une tâche
    public function editTask($id) {
        $tacheModel = new Taches();
        $task = $tacheModel->getTaskById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = $_POST['description'];
            $status = $_POST['status'];

            $tacheModel->editTask($id, $description, $status);

            header('/public/gestiontaches.php?project_id=' . $task['project_id']);
            exit();
        }

        require_once '../app/views/editTaskView.php';
    }

    // Supprimer une tâche
    public function deleteTask($id) {
        $tacheModel = new Taches();
        $task = $tacheModel->getTaskById($id);

        $tacheModel->deleteTask($id);

        header('/public/gestiontaches.php?project_id=' . $task['project_id']);
        exit();
    }
}
?>
