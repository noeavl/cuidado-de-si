<?php
require_once __DIR__ . '/../../infrastructure/Database.php';
use Core\Database;
class Blog
{
    public static function all()
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM blogs ORDER BY status DESC,id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function create($title,$description,$img){
        try{
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO blogs (title,description,img) VALUES (:title,:description,:img)");
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':img' => $img
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
            $allowedFields = ['title','description','img','status'];

            foreach($allowedFields as $field){
                if(isset($data[$field])){
                    $fields[] = $field . ' = :' . $field;
                    $params[':' . $field] = $data[$field];
                }
            }

            if(empty($fields)){
                return false;
            }

            $query = "UPDATE blogs SET " . implode(', ', $fields) . " WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute($params);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}