<?php
require_once __DIR__ . '/../../infrastructure/Database.php';
use Core\Database;
class User
{
    public static function findByEmail($email)
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}