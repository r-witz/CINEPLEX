<?php

header('Content-Type: application/json');
require_once 'database/database.php';

class FilmController {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function getFilms($query_params) {
        try {
            $search = isset($query_params['search']) ? $query_params['search'] : '';

            $search = str_replace('+', ' ', $search);
            $search = preg_replace('/[^a-zA-Z0-9: \']/i', '', $search);
            $search = trim($search);
            $search = preg_replace('/\s+/', ' ', $search);
            $search = '%' . $search . '%';
            
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
                            (SELECT * FROM Films WHERE id IN (
                            SELECT id FROM Films
                            WHERE title LIKE :search
                            UNION
                            SELECT film_id FROM Films_Categories
                            WHERE category_id IN (SELECT id FROM Categories WHERE name LIKE :search)
                            UNION
                            SELECT film_id FROM Films_Actors
                            WHERE actor_id IN (SELECT id FROM Actors WHERE name LIKE :search)
                            UNION
                            SELECT id FROM Films
                            WHERE director_id IN (SELECT id FROM Directors WHERE name LIKE :search)
                            )) f
                        JOIN Directors d ON f.director_id = d.id
                        JOIN Films_Actors fa ON f.id = fa.film_id
                        JOIN Actors a ON fa.actor_id = a.id
                        JOIN Films_Categories fc ON f.id = fc.film_id
                        JOIN Categories c ON fc.category_id = c.id
                        GROUP BY f.id, d.name;";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':search', $search);
            $stmt->execute();
            $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($films)) {
                http_response_code(404);
                echo json_encode(["message" => "No films found"]);
            } else {
                http_response_code(200);
                echo json_encode($films);
            }
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(["message" => "Error while looking for films: " . $exception->getMessage()]);
        }
    }
}