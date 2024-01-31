<?php

class Database {
    private $host = "localhost";
    private $db_name = "products";
    private $username = "root";
    private $password = "123456";
    private $connection;

    public static function getConnection(){
        $db = new self();
        
        $db->connection = null;

        try {
            $db->connection = mysqli_connect(
                $db->host,
                $db->username,
                $db->password,
                $db->db_name
            );
        } catch(\Exception $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        
        return $db->connection;
    }
}

?>