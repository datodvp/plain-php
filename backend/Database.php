<?php

class Database {
    private $host = "localhost";
    private $username = "dato";
    private $password = '123456';
    private $db_name = "products";
    private $connection;

    public static function getConnection(){
        $db = new self();
        
        $db->connection = null;

        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $db->connection = mysqli_connect(
                $db->host,
                $db->username,
                $db->password,
                $db->db_name
            );
        } catch(Exception $e){
            http_response_code(500);
            throw $e;
        }
        
        return $db->connection;
    }
}

?>