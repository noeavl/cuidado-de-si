<?php
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/EventController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/BlogController.php';

header('Content-Type: application/json');

$routes = [
    '/auth/login'        => function() { AuthController::login($_POST['data']['email'], $_POST['data']['password']); },
    '/auth/logout'       => function() { AuthController::logout(); },
    '/events/list'       => function() { EventController::index(); },
    '/events/status'     => function() { EventController::status($_POST['id'], $_POST['status']); },
    '/events/store'      => function() { EventController::store($_POST['data']['name'], $_POST['data']['place'], $_POST['data']['date'], $_POST['data']['banner']); },
    '/users/list'        => function() { UserController::index(); },
    '/users/store'       => function() { UserController::store($_POST['data']['name'], $_POST['data']['username'], $_POST['data']['email'], $_POST['data']['password'], $_POST['data']['role']); },
    '/users/update'      => function() { UserController::update($_POST['data']['id'], $_POST['data']['name'], $_POST['data']['username'], $_POST['data']['email'], $_POST['data']['password'] ?? null, $_POST['data']['role'], $_POST['data']['status']); },
    '/users/status'      => function() { UserController::status($_POST['id'], $_POST['status']); },
    '/users/check-email' => function() { UserController::checkEmail($_POST['email'], $_POST['excludeId']); },
    '/users/check-username' => function() { UserController::checkUsername($_POST['username'], $_POST['excludeId']); },
    '/users/find-by-id'  => function() { UserController::show($_GET['id']); },
    '/blogs/list'        => function() { BlogController::index(); },
    '/blogs/store'       => function() { BlogController::store($_POST['data']['title'], $_POST['data']['description'], $_POST['data']['img']); },
    '/blogs/status'      => function() { BlogController::status($_POST['id'], $_POST['status']); },
];

$request_uri = isset($_GET['REQUEST_URI']) ? $_GET['REQUEST_URI'] : (isset($_POST['REQUEST_URI']) ? $_POST['REQUEST_URI'] : '/');

if (isset($routes[$request_uri])) {
    $routes[$request_uri]();
} else {
    echo json_encode([
        'success' => false,
        'message' => '¡Ruta invalida!'
    ]);
}




