<?php
namespace Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;
    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../core/Config.php';
            $dbConfig = $config['database'];

            try {
                $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset={$dbConfig['charset']}";
                self::$connection = new PDO(
                    $dsn,
                    $dbConfig['user'],
                    $dbConfig['password'],
                    $dbConfig['options']
                );
            } catch (PDOException $e) {
                throw new PDOException('Database connection error: ' . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
