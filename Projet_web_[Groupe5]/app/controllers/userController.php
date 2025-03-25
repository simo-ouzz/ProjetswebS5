<?php
// app/controllers/UserController.php
require_once '../config/config.php';

class UserController {
    public function profile() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
            header("Location: /login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            exit();
        }

        // Vérifier que 'user_id' existe dans la session avant d'utiliser
        if (!isset($_SESSION['user_id'])) {
            echo "ID utilisateur introuvable.";
            exit();
        }

        // Récupérer l'utilisateur connecté
        require_once '../app/models/User.php'; // Inclure le modèle User
        $userModel = new User();
        $user = $userModel->getUserData($_SESSION['user_id']);

        // Si l'utilisateur n'existe pas, afficher un message d'erreur
        if (!$user) {
            echo "Utilisateur introuvable.";
            exit();
        }

        // Inclure la vue pour afficher le profil de l'utilisateur
        require_once '../public/profil.php'; // Vue pour afficher le profil (fichier profil.php dans le dossier public)
    }
}
?>
