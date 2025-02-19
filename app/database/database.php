<?php

class Database 
{
    private static $pdo = null;

    public static function getConnection()
    {
        if (self::$pdo == null) {
            $host = getenv('DB_HOST');
            $dbname = getenv('DB_DATABASE');
            $username = getenv('DB_USERNAME');
            $password = getenv('DB_PASSWORD');
            
            try {
                self::$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                die("Error de conexión: " . $ex->getMessage());
            }            
        }
        return self::$pdo;
    }
}

