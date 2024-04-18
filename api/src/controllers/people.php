<?php

header('Content-Type: application/json');
require_once 'database/database.php';

class PeopleController {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function getPeople($query_params) {
        try {
            $search = isset($query_params['search']) ? $query_params['search'] : '';

            $search = str_replace('+', ' ', $search);
            $search = preg_replace('/[^a-zA-Z0-9: \']/i', '', $search);
            $search = trim($search);
            $search = preg_replace('/\s+/', ' ', $search);
            $search = '%' . $search . '%';
            
            $query = "SELECT name, image_name FROM (SELECT name, image_name FROM Actors WHERE name LIKE :search UNION SELECT name, image_name FROM Directors WHERE name LIKE :search) AS result_table;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':search', $search);
            $stmt->execute();
            $people = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($people)) {
                http_response_code(404);
                echo json_encode(["message" => "No people found"]);
            } else {
                http_response_code(200);
                echo json_encode($people);
            }
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(["message" => "Error while looking for people: " . $exception->getMessage()]);
        }
    }
}