<?php
require_once __DIR__ . '/../../infrastructure/Database.php';
use Core\Database;
class Event
{
    public static function all()
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM events ORDER BY status DESC,id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function create($name,$place,$date,$banner){
        try{
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO events (name,place,date,banner) VALUES (:name,:place,:date,:banner)");
            $stmt->execute([
                ':name' => $name,
                ':place' => $place,
                ':date' => $date,
                ':banner' => $banner
            ]);
            return true;
        }catch(PDOException $e){
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