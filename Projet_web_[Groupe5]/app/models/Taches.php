<?php
require_once '../config/config.php';

class Taches {
    // Récupérer les tâches associées à un projet
    public function getTasksByProjectId($projectId) {
        $query = "SELECT * FROM taches WHERE project_id = ?";
        $stmt = $GLOBALS['pdo']->prepare($query);
        $stmt->execute([$projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une tâche par son ID
    public function getTaskById($taskId) {
        $query = "SELECT * FROM taches WHERE id = ?";
        $stmt = $GLOBALS['pdo']->prepare($query);
        $stmt->execute([$taskId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter une tâche (avec user_id)
    public function addTask($projectId, $description, $status, $userId) {
        $query = "INSERT INTO taches (project_id, description, status, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $GLOBALS['pdo']->prepare($query);
        $stmt->execute([$projectId, $description, $status, $userId]);
    }

    // Modifier une tâche
    public function editTask($taskId, $description, $status) {
        $query = "UPDATE taches SET description = ?, status = ? WHERE id = ?";
        $stmt = $GLOBALS['pdo']->prepare($query);
        $stmt->execute([$description, $status, $taskId]);
    }

    // Supprimer une tâche
    public function deleteTask($taskId) {
        $query = "DELETE FROM taches WHERE id = ?";
        $stmt = $GLOBALS['pdo']->prepare($query);
        $stmt->execute([$taskId]);
    }
}
?>
