<?php
require_once __DIR__ . '/../models/User.php';
header('Content-Type: application/json');
class UserController
{
    public static function index()
    {
        $users = User::all();
        echo json_encode([
            'success' => true,
            'message' => 'Usuarios listados correctamente',
            'users' => $users
        ]);
    }
    public static function show($id){
        $user = User::findById($id);
        echo json_encode([
            'success' => true,
            'message' => 'Usuario encontrado correctamente',
            'user' => $user
        ]);
    }
    public static function store($name,$username,$email,$password,$role){
        if(User::create($name,$username,$email,$password,$role)){
            echo json_encode([
                'success' => true,
                'message' => 'Usuario creado correctamente',
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al crear el usuario'
            ]);
        }
    }
    public static function update($id, $name,$username,$email,$password = null,$role, $status){
        $data = [];
        if($password){
            $data = [
                'name'=>$name,
                'username'=>$username,
                'email'=>$email,
                'password'=>$password,
                'role'=>$role,
                'status'=>$status
            ];
        }else{
            $data = [
                'name'=>$name,
                'username'=>$username,
                'email'=>$email,
                'role'=>$role,
                'status'=>$status
            ];
        }

        if(User::update($id,$data)){
            echo json_encode([
                'success' => true,
                'message' => 'Usuario actualizado correctamente',
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar el usuario'
            ]);
        }
    }
    public static function status(int $id,$status)
    {
        if(User::update($id,['status'=>$status])){
            echo json_encode([
                'success' => true,
                'message' => 'Usuario actualizado correctamente',
            ]);
            $user = User::findById($id);
            session_start();
            if($_SESSION['user']['id'] == $id){
                $user = User::findById($id);
                if($user){
                    $_SESSION['user'] = $user;
                    if($status == 0){
                        session_destroy();
                    }
                }
            }
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar el usuario'
            ]);
        }
    }
    public static function checkEmail($email, $excludeId = null){
        $user = User::findByEmail($email, $excludeId);
        if($user){
            echo json_encode([
                'success' => true,
                'message' => 'El correo electrónico ya está en uso',
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'El correo electrónico no está en uso'
            ]);
        }
    }
    public static function checkUsername($username, $excludeId = null){
        $user = User::findByUsername($username, $excludeId);
        if($user){
            echo json_encode([
                'success' => true,
                'message' => 'El nombre de usuario ya está en uso',
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'El nombre de usuario no está en uso'
            ]);
        }
    }
}