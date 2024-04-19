<?php

header('Content-Type: application/json');
require_once 'database/database.php';
require_once 'utils/bcrypt.php';

class RegisterController {
    private $conn;
    private $bcrypt;

    public function __construct() {
        $this->conn = Database::getInstance();
        $this->bcrypt = new BcryptUtil();
    }

    public function registerUser() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            if (empty($data['pseudo']) || empty($data['email']) || empty($data['password'])) {
                http_response_code(400);
                echo json_encode(["message" => "All required fields must be provided"]);
                return;
            }

            $pseudo = htmlspecialchars(strip_tags($data['pseudo']));
            $email = htmlspecialchars(strip_tags($data['email']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $password = htmlspecialchars(strip_tags($data['password']));

            if (!$pseudo || !$email || !$password) {
                http_response_code(400);
                echo json_encode(["message" => "Invalid input data"]);
                return;
            }

            $stmt = $this->conn->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                http_response_code(409);
                echo json_encode(["message" => "User already exists"]);
                return;
            }

            $hashedPassword = $this->bcrypt->hash($password);

            $stmt = $this->conn->prepare("INSERT INTO Users (pseudo, email, password) VALUES (:pseudo, :email, :password)");
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
            http_response_code(201);
            echo json_encode(["message" => "User registered successfully"]);
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(["message" => "Error while registering user: " . $exception->getMessage()]);
        }
    }
}