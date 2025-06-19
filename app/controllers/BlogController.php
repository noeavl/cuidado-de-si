<?php
require_once __DIR__ . '/../models/Blog.php';
header('Content-Type: application/json');   
class BlogController
{
    public static function index(){
        $blogs = Blog::all();
        echo json_encode([
            'success' => true,
            'message' => '¡Blogs obtenidos con exito!',
            'blogs' => $blogs
        ]);
    }
    public static function store($title,$description,$img){
        if(Blog::create($title,$description,$img)){
            echo json_encode([
                'success' => true,
                'message' => 'Blog creado correctamente!',
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
        if(Blog::update($id,['status'=>$status])){
            echo json_encode([
                'success' => true,
                'message' => 'Blog actualizado correctamente!',
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => '¡Error al actualizar el blog!'
            ]);
        }
    }
}