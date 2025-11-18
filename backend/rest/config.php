<?php

// Set the reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config
{
   public static function DB_NAME()
   {
       return 'student_enrollment_db'; 
   }
   public static function DB_PORT()
   {
       return  3306;
   }
   public static function DB_USER()
   {
       return 'root';
   }
   public static function DB_PASSWORD()
   {
       return 'root';
   }
   public static function DB_HOST()
   {
       return '127.0.0.1';
   }
   public static function JWT_SECRET() {
       return 'your_key_string_key';
   }
}

/*
class Database {
   private static $host = 'localhost';
   private static $dbName = 'student_enrollment_db';
   private static $username = 'root';
   private static $password = 'root';
   private static $connection = null;


   public static function connect() {
       if (self::$connection === null) {
           try {
               self::$connection = new PDO(
                   "mysql:host=" . self::$host . ";dbname=" . self::$dbName,
                   self::$username,
                   self::$password,
                   [
                       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                   ]
               );
               //echo "Connection finished!";
           } catch (PDOException $e) {
               die("Connection failed: " . $e->getMessage());
           }
       }
       return self::$connection;
   }
}
   */
?>
