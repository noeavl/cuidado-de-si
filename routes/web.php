<?php
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/EventController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';

header('Content-Type: application/json');

$request_uri = isset($_GET['REQUEST_URI']) ? $_GET['REQUEST_URI'] : (isset($_POST['REQUEST_URI']) ? $_POST['REQUEST_URI'] : '/');
switch ($request_uri) {
    case '/auth/login':
        AuthController::login($_POST['data']['email'], $_POST['data']['password']);
        break;
    case '/auth/logout':
        AuthController::logout();
        break;
    case '/events/list':
        EventController::index();
        break;
    case '/events/status':
        EventController::status($_POST['id'], $_POST['status']);
        break;
    case '/users/list':
        UserController::index();
        break;
    case '/users/store':
        UserController::store($_POST['data']['name'], $_POST['data']['username'], $_POST['data']['email'], $_POST['data']['password'], $_POST['data']['role']);
        break;
    case '/users/update':
        UserController::update($_POST['id'], $_POST['data']['name'], $_POST['data']['username'], $_POST['data']['email'], $_POST['data']['password'], $_POST['data']['role'], $_POST['data']['status']);
        break;
    case '/users/status':
        UserController::status($_POST['id'], $_POST['status']);
        break;
    case '/users/check-email':
        UserController::checkEmail($_POST['email'], $_POST['excludeId']);
        break;
    case '/users/check-username':
        UserController::checkUsername($_POST['username'], $_POST['excludeId']);
        break;
    case '/users/find-by-id':
        UserController::show($_GET['id']);
        break;
    
    case '/':
        echo json_encode([
            'success' => false,
            'message' => '¡Ruta invalida!'
        ]);
    default:
        break;
}