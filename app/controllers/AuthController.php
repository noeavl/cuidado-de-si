<?php
require_once __DIR__ . '/../models/User.php';
header('Content-Type: application/json');
class AuthController
{
    public static function login($email, $password)
    {
        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $user;
            echo json_encode([
                'success' => true,
                'message' => '¡Inicio de sesión exitoso!'
            ]);
            return;
        }
        echo json_encode([
            'success' => false,
            'message' => "¡Credenciales Incorrectas!"
        ]);
    }
    public static function logout()
    {
        session_start();
        session_destroy();
        echo json_encode([
            'success' => true,
            'message' => 'Sesión cerrada correctamente'
        ]);
    }
}