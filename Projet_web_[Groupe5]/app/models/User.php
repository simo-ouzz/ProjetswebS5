<?php
// app/models/User.php

require_once __DIR__ . '/../core/Database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    // Méthode de connexion
    public function login($username, $password) {
        // Requête pour vérifier les informations d'identification
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($query);

        // Lier les paramètres (les types doivent être 's' pour string)
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);

        // Exécuter la requête
        $stmt->execute();
        
        // Vérifier si un utilisateur a été trouvé
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Si un utilisateur a été trouvé, il retourne les informations
        if ($result) {
            return true; // Connexion réussie
        } else {
            return false; // Connexion échouée
        }
    }

    // Méthode pour créer un utilisateur
    public function create($username, $password) {
        // Requête pour insérer un nouvel utilisateur
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        // Lier les paramètres (les types doivent être 's' pour string)
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);

        // Exécuter la requête et retourner si l'exécution a réussi
        return $stmt->execute();
    }

    // Méthode pour obtenir les données de l'utilisateur
    public function getUserData($userId) {
        // Requête pour récupérer les données de l'utilisateur
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Lier le paramètre pour la requête
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        // Exécuter la requête
        $stmt->execute();

        // Retourner les résultats sous forme de tableau associatif
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si aucun utilisateur n'est trouvé, retourner false
        if (!$user) {
            return false;
        }

        return $user;
    }
}
?>
