<?php
require_once __DIR__ . '/../app/controllers/EventController.php';


header('Content-Type: application/json');

$uploadMap = [
    'event_banner'   => ['EventController', 'uploadBanner'],
];


foreach ($uploadMap as $field => $handler) {
    if (isset($_FILES[$field])) {
        call_user_func([$handler[0], $handler[1]], $_FILES[$field]);
        exit;
    }
}


echo json_encode([
    'success' => false,
    'message' => 'No se recibió ningún archivo válido'
]);
exit;