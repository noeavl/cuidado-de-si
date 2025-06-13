<?php
require_once __DIR__ . '/../../infrastructure/Database.php';
use Core\Database;
class Event
{
    public static function all()
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM events ORDER BY status,id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}