<?php
// app/models/Project.php

require_once __DIR__ . '/../core/Database.php'; 

class Project {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    // ✅ Récupérer tous les projets
    public function getAllProjects() {
        $query = "SELECT id, title, summary, status, admin FROM projects";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Ajouter un projet
    public function addProject($title, $summary, $status, $admin) {
        $query = "INSERT INTO projects (title, summary, status, admin) 
                  VALUES (:title, :summary, :status, :admin)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':summary', $summary);
        $stmt->bindParam(':status', $status);  // 🔥 Correction : s'assurer que le statut est bien inséré
        $stmt->bindParam(':admin', $admin);

        return $stmt->execute();
    }

    // ✅ Modifier un projet
    public function editProject($id, $title, $summary, $status, $admin) {
        $query = "UPDATE projects 
                  SET title = :title, summary = :summary, status = :status, admin = :admin
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':summary', $summary);
        $stmt->bindParam(':status', $status);  // 🔥 Correction : mise à jour correcte du statut
        $stmt->bindParam(':admin', $admin);

        return $stmt->execute();
    }

    // ✅ Récupérer un projet par ID
    public function getProjectById($id) {
        $query = "SELECT id, title, summary, status, admin FROM projects WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
