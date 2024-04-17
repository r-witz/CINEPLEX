<?php
require_once 'database.php';

class User {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function createUser($pseudo, $email, $password) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO Users (pseudo, email, password) VALUES (:pseudo, :email, :password)" );

            $pseudo = htmlspecialchars($pseudo);
            $email = htmlspecialchars($email);

            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error creating a user :" . $e->getMessage());
        }
    }
}