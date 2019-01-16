<?php 
    class DBConnect{
        public static function connect(){
            $dbType   = 'mysql';
            $host     = '127.0.0.1';
            $dbName   = 'ysdb';
            $userName = 'root';
            $pwd      = '88888888';
        
            $dsn = "$dbType:host=$host;dbname=$dbName";
            try {
                $conn = new PDO($dsn, $userName, $pwd);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (PDOException $e) {
                return ;
            }
        }
    }
?>