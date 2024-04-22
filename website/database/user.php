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


    public function getUserByPseudo($pseudo) {
        $query = "SELECT * FROM Users WHERE pseudo = :pseudo LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

}
