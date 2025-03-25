<?php
// app/core/Database.php

require_once __DIR__ . '/../../config/config.php';

class Database {
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Utilisation des constantes définies dans config.php
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
            $this->conn = new PDO($dsn, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Gestion des erreurs
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }

        return $this->conn;
    }
}
?>
