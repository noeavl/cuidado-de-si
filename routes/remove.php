<?php
require_once __DIR__ . '/../app/controllers/EventController.php';

header('Content-Type: application/json');

$routes =[
    '/events/delete-banner' => function() { EventController::deleteBanner($_POST['filename']); },
];

$resquest_uri = isset($_POST['REQUEST_URI']) ? $_POST['REQUEST_URI'] : '/';

if(isset($routes[$resquest_uri])){
    $routes[$resquest_uri]();
}else{
    echo json_encode([
        'success' => false,
        'message' => 'Ruta invalida'
    ]);
}