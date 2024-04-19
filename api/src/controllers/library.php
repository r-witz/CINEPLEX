<?php

header('Content-Type: application/json');
require_once 'database/database.php';

class LibraryController {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function getFilmsOfUser() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $userEmail = $data['user_email'];

            $query = "SELECT id FROM Users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $userEmail);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                http_response_code(404);
                echo json_encode(["message" => "User not found"]);
                return;
            }

            $userId = $user['id'];

            $query = "SELECT
                            f.id,
                            f.title,
                            f.plot,
                            f.image_name,
                            d.name AS director_name,
                            GROUP_CONCAT(DISTINCT a.name) AS actor_names,
                            GROUP_CONCAT(DISTINCT c.name) AS categories,
                            f.price
                        FROM
                            (SELECT film_id as id, title, plot, price, image_name, director_id
                            FROM Library
                            JOIN Films ON Films.id = Library.film_id
                            WHERE user_id = :user_id) f
                        JOIN Directors d ON f.director_id = d.id
                        JOIN Films_Actors fa ON f.id = fa.film_id
                        JOIN Actors a ON fa.actor_id = a.id
                        JOIN Films_Categories fc ON f.id = fc.film_id
                        JOIN Categories c ON fc.category_id = c.id
                        GROUP BY f.id;";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$films) {
                http_response_code(404);
                echo json_encode(["message" => "Library is empty"]);
            } else {
                http_response_code(200);
                echo json_encode($films);
            }
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(["message" => "Error while looking for films: " . $exception->getMessage()]);
        }
    }

    public function addCartToLibrary() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $userEmail = $data['user_email'];

            $query = "SELECT id FROM Users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $userEmail);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                http_response_code(404);
                echo json_encode(["message" => "User not found"]);
                return;
            }

            $userId = $user['id'];

            $query = "SELECT film_id FROM Carts WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            $film_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

            if (!$film_ids) {
                http_response_code(404);
                echo json_encode(["message" => "Cart is empty"]);
                return;
            }

            foreach ($film_ids as $film_id) {
                $query = "INSERT INTO Library (user_id, film_id) VALUES (:user_id, :film_id)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':user_id', $userId);
                $stmt->bindParam(':film_id', $film_id);
                $stmt->execute();
            }

            $query = "DELETE FROM Carts WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            http_response_code(200);
            echo json_encode(["message" => "Cart added to library"]);
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(["message" => "Error while looking for films: " . $exception->getMessage()]);
        }
    }
}