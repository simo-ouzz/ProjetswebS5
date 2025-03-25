<?php
// app/controllers/ProjectController.php
require_once '../config/config.php';
require_once '../app/models/Project.php';
require_once '../app/models/Taches.php'; // Ajout du modèle Taches

class ProjectController {

    // ✅ Afficher tous les projets
    public function listProjects() {
        if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
            header("Location: /");
            exit();
        }

        $projectModel = new Project();
        $projects = $projectModel->getAllProjects(); 

        require_once '../app/views/projectsView.php';
    }

    // ✅ Ajouter un projet
    public function addProject() {
        if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
            header("Location: /");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $summary = $_POST['summary'];
            $status = $_POST['status'];
            $admin = $_SESSION['username']; // 🔥 Prendre le NOM de l'admin depuis la session

            // Insérer le projet dans la base de données via le modèle
            $projectModel = new Project();
            $projectModel->addProject($title, $summary, $status, $admin);

            header('Location: projectAction.php?action=list');
            exit();
        }

        require_once '../app/views/addProjectView.php';
    }

    // ✅ Modifier un projet
    public function editProject($id) {
        if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
            header("Location: /");
            exit();
        }

        $projectModel = new Project();
        $project = $projectModel->getProjectById($id);

        if (!$project) {
            header('Location: projectAction.php?action=list');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $summary = $_POST['summary'];
            $status = $_POST['status'];
            $admin = $_SESSION['username']; // 🔥 Prendre le NOM de l'admin depuis la session

            // Mettre à jour le projet dans la base de données via le modèle
            $projectModel->editProject($id, $title, $summary, $status, $admin);

            header('Location: projectAction.php?action=list');
            exit();
        }

        require_once '../app/views/editProjectView.php';
    }

    // ✅ Afficher les détails d'un projet
    public function viewProject($id) {
        if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
            header("Location: /");
            exit();
        }

        $projectModel = new Project();
        $project = $projectModel->getProjectById($id);

        if (!$project) {
            header('Location: projectAction.php?action=list');
            exit();
        }

        require_once '../app/views/projectDetailView.php';
    }

    // ✅ Rejoindre un projet
    public function joinProject($id) {
        if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
            header("Location: /");
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $query = "INSERT INTO project_members (project_id, user_id) VALUES (?, ?)";
        $stmt = $GLOBALS['pdo']->prepare($query);
        $stmt->execute([$id, $user_id]);

        header('Location: projectAction.php?action=list');
        exit();
    }

    // ✅ Récupérer les tâches d'un projet
    public function getTasksByProjectId($projectId) {
        $taskModel = new Taches(); // Utilisation du modèle Taches
        return $taskModel->getTasksByProjectId($projectId);
    }
}
?>
