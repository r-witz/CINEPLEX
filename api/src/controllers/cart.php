<?php

header('Content-Type: application/json');
require_once 'database/database.php';

class CartController {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function addToCart() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $userEmail = $data['user_email'];
            $filmId = $data['film_id'];

            $query = "SELECT id FROM Users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $userEmail);
            $stmt->execute();
            $userId = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userId) {
                http_response_code(404);
                echo json_encode(["message" => "User not found"]);
                return;
            }

            $userId = $userId['id'];

            $query = "SELECT id FROM Films WHERE id = :film_id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':film_id', $filmId);
            $stmt->execute();
            $film = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$film) {
                http_response_code(404);
                echo json_encode(["message" => "Film do not exist in the database"]);
                return;
            }

            $query = "SELECT id FROM Carts WHERE user_id = :user_id AND film_id = :film_id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':film_id', $filmId);
            $stmt->execute();
            $cart = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($cart) {
                http_response_code(400);
                echo json_encode(["message" => "Film already in cart"]);
                return;
            }

            $query = "INSERT INTO Carts (user_id, film_id) VALUES (:user_id, :film_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':film_id', $filmId);
            $stmt->execute();

            http_response_code(200);
            echo json_encode(["message" => "Film added to cart successfully"]);
            
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(["message" => "Error while registering user: " . $exception->getMessage()]);
        }
    }

    public function removeFromCart() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $userEmail = $data['user_email'];
            $filmId = $data['film_id'];

            $query = "SELECT id FROM Users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $userEmail);
            $stmt->execute();
            $userId = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userId) {
                http_response_code(404);
                echo json_encode(["message" => "User not found"]);
                return;
            }

            $userId = $userId['id'];

            $query = "SELECT id FROM Films WHERE id = :film_id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':film_id', $filmId);
            $stmt->execute();
            $film = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$film) {
                http_response_code(404);
                echo json_encode(["message" => "Film do not exist in the database"]);
                return;
            }

            $query = "SELECT id FROM Carts WHERE user_id = :user_id AND film_id = :film_id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':film_id', $filmId);
            $stmt->execute();
            $cart = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$cart) {
                http_response_code(400);
                echo json_encode(["message" => "Film not in cart"]);
                return;
            }

            $query = "DELETE FROM Carts WHERE user_id = :user_id AND film_id = :film_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':film_id', $filmId);
            $stmt->execute();

            http_response_code(200);
            echo json_encode(["message" => "Film removed from cart successfully"]);
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(["message" => "Error while registering user: " . $exception->getMessage()]);
        }
    }
}