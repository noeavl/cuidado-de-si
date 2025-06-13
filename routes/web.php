<?php
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/EventController.php';

header('Content-Type: application/json');

$request_uri = isset($_GET['REQUEST_URI']) ? $_GET['REQUEST_URI'] : (isset($_POST['REQUEST_URI']) ? $_POST['REQUEST_URI'] : '/');

switch ($request_uri) {
    case '/auth/login':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            AuthController::login($_POST['data']['email'], $_POST['data']['password']);
        } else {
            echo json_encode([
                'success' => false,
                'message' => '¡Metodo invalido!'
            ]);
        }
        break;
    case '/auth/logout':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            AuthController::logout();
        }
        break;
    case '/events/list':
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            EventController::index();
        }
        break;
    case '/':
        echo json_encode([
            'success' => false,
            'message' => '¡Ruta invalida!'
        ]);
    default:
        break;
}