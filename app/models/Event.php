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
    public static function update($id, $data){
        try{
            $db = Database::getConnection();
            $fields = [];
            $params = [':id'=>$id];
            $allowedFields = ['name','place','date','banner','status'];

            foreach($allowedFields as $field){
                if(isset($data[$field])){
                    $fields[] = $field . ' = :' . $field;
                    $params[':' . $field] = $data[$field];
                }
            }

            if(empty($fields)){
                return false;
            }

            $query = "UPDATE events SET " . implode(', ', $fields) . " WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute($params);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}