<?php
require_once __DIR__ . '/../models/Event.php';
header('Content-Type: application/json');   
class EventController
{
    public static function index(){
        $events = Event::all();
        echo json_encode([
            'success' => true,
            'message' => '¡Eventos obtenidos con exito!',
            'events' => $events
        ]);
    }
    public static function store($name,$place,$date,$banner){
        if(Event::create($name,$place,$date,$banner)){
            echo json_encode([
                'success' => true,
                'message' => '¡Evento creado correctamente!',
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => '¡Error al crear el evento!'
            ]);
        }
    }
    public static function update(int $id)
    {

    }
    public static function status(int $id, $status)
    {
        if(Event::update($id,['status'=>$status])){
            echo json_encode([
                'success' => true,
                'message' => '¡Evento actualizado correctamente!',
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => '¡Error al actualizar el evento!'
            ]);
        }
    }
    public static function uploadBanner($file){
        $uploadDir  = __DIR__ . '/../../resources/images/events/';
        if(!is_dir($uploadDir)){
            mkdir($uploadDir, 0777, true);
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $safeName = uniqid('banner_',true).'.'.$ext;
        $uploadFile = $uploadDir . $safeName;
        if(move_uploaded_file($file['tmp_name'], $uploadFile)){
            echo $safeName;
        }
    }
    public static function deleteBanner($filename){
        $uploadDir  = __DIR__ . '/../../resources/images/events/';
        $file = $uploadDir . $filename;
        if(file_exists($file)){
            unlink($file);
        }
    }
}