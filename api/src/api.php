<?php

require_once 'controllers/login.php';
require_once 'controllers/register.php';
require_once 'controllers/library.php';
require_once 'controllers/cart.php';
require_once 'controllers/film.php';
require_once 'controllers/people.php';

class ApiRouter {
    public function processRequest() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uriSegments = explode('/', trim($uri, '/'));
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        switch ($uriSegments[0]) {
            case '':
                switch ($requestMethod) {
                    case 'GET':
                        echo json_encode(["message" => "Hello World !"]);
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Method not allowed"]);
                        break;
                }
                break;
            case 'login':
                switch ($requestMethod) {
                    case 'POST':
                        $login = new LoginController();
                        $login->loginUser();
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Method not allowed"]);
                        break;
                }
                break;
            case 'register':
                switch ($requestMethod) {
                    case 'POST':
                        $register = new RegisterController();
                        $register->registerUser();
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Method not allowed"]);
                        break;
                }
                break;
            case 'library':
                switch ($requestMethod) {
                    case 'GET':
                        $library = new LibraryController();
                        $library->getFilmsOfUser();
                        break;
                    case 'POST':
                        $library = new LibraryController();
                        $library->addCartToLibrary();
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Method not allowed"]);
                        break;
                }
                break;
            case 'cart':
                switch ($requestMethod) {
                    case 'POST':
                        $cart = new CartController();
                        $cart->addToCart();
                        break;
                    case 'DELETE':
                        $cart = new CartController();
                        $cart->removeFromCart();
                        break;
                    case 'GET':
                        $cart = new CartController();
                        $cart->getCart();
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Method not allowed"]);
                        break;
                }
                break;
            case 'film':
                switch ($requestMethod) {
                    case 'GET':
                        $film = new FilmController();
                        $film->getFilms($_GET);
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Method not allowed"]);
                        break;
                }
                break;
            case 'people':
                switch ($requestMethod) {
                    case 'GET':
                        $people = new PeopleController();
                        $people->getPeople($_GET);
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Method not allowed"]);
                        break;
                }
                break;
            default:
                http_response_code(404);
                echo json_encode(["message" => "The requested URL was not found on this server."]);
                break;
        }
    }
}
