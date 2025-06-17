<?php
require_once __DIR__ . '/../../infrastructure/Database.php';
use Core\Database;
class User
{
    public static function findByEmail($email, $excludeId = null)
    {
        try {
            $db = Database::getConnection();
            if($excludeId){
                $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND id != :excludeId");
                $stmt->execute([':email' => $email, ':excludeId' => $excludeId]);
            }else{
                $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
                $stmt->execute([':email' => $email]);
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function findByUsername($username, $excludeId = null)
    {
        try {
            $db = Database::getConnection();
            if($excludeId){
                $stmt = $db->prepare("SELECT * FROM users WHERE username = :username AND id != :excludeId");
                $stmt->execute([':username' => $username, ':excludeId' => $excludeId]);
            }else{
                $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
                $stmt->execute([':username' => $username]);
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function findById(int $id){
        try{
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return false;
        }
    }
    public static function all(){
        try{
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return false;
        }
    }
    public static function update(int $id,$data){
        try{
            $db = Database::getConnection();
            $fields = [];
            $params = [':id'=>$id];
            $allowedFields = ['name','username','email','password','role','status'];

            foreach($allowedFields as $field){
                if(isset($data[$field])){
                    if($field == 'password'){
                        $fields[] = $field . ' = :' . $field;
                        $params[':' . $field] = password_hash($data[$field], PASSWORD_DEFAULT);
                    }else{
                        $fields[] = $field . ' = :' . $field;
                        $params[':' . $field] = $data[$field];
                    }
                }
            }

            if(empty($fields)){
                return false;
            }

            $query = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute($params);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function create($name,$username,$email,$password,$role){
        try{
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO users (name,username,email,password,role) VALUES (:name,:username,:email,:password,:role)");
            $stmt->execute([
                ':name' => $name,
                ':username' => $username,
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':role' => $role
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}