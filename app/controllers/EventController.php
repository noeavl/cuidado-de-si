<?php
require_once __DIR__ . '/../models/Event.php';
header('Content-Type: application/json');   
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
    public static function update(int $id)
    {

    }
    public static function status(int $id, $status)
    {
        if(Event::update($id,['status'=>$status])){
            echo json_encode([
                'success' => true,
                'message' => 'Evento actualizado correctamente',
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar el evento'
            ]);
        }
    }
}