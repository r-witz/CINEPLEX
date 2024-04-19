<?php

header('Content-Type: application/json');
require_once 'database/database.php';
require_once 'utils/bcrypt.php';

class LoginController {
    private $conn;
    private $bcrypt;

    public function __construct() {
        $this->conn = Database::getInstance();
        $this->bcrypt = new BcryptUtil();
    }

    public function loginUser() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            if (empty($data['email']) || empty($data['password'])) {
                http_response_code(400);
                echo json_encode(["message" => "All required fields must be provided"]);
                return;
            }

            $email = htmlspecialchars(strip_tags($data['email']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $password = htmlspecialchars(strip_tags($data['password']));

            if (!$email || !$password) {
                http_response_code(400);
                echo json_encode(["message" => "Invalid input data"]);
                return;
            }

            $query = "SELECT * FROM Users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $user = false;
            }

            if ($user) {
                if ($this->bcrypt->verify($password, $user['password'])) {
                    http_response_code(200);
                    echo json_encode(["message" => "User logged in successfully"]);
                } else {
                    http_response_code(401);
                    echo json_encode(["message" => "Password is incorrect"]);
                }
            } else {
                http_response_code(404);
                echo json_encode(["message" => "User not found"]);
            }            
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(["message" => "Error while registering user: " . $exception->getMessage()]);
        }
    }
}