<?php
require_once __DIR__ . '/../models/Event.php';
class EventController
{
    public static function index()
    {
        $events = Event::all();
        echo json_encode([
            'success' => true,
            'message' => '¡Eventos obtenidos con exito!',
            'events' => $events
        ]);
    }
    public static function store()
    {

    }
    public static function update()
    {

    }
    public static function status()
    {

    }
}