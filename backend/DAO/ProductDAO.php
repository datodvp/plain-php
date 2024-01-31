<?php

class ProductDAO {
    private $connection;

    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function getAll() {
        // $query = "SELECT * FROM products";

        // $result = mysqli_query($this->connection, $query);

        // if(!$result) {
        //     throw new Exception("Error executing query: " . mysqli_error($this->connection));
        // }

        // $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // mysqli_free_result($result);

        // mysqli_close($this->connection);

        // return $products;
    }

    public function add(BookProduct $product) {
        
    }
}

?>