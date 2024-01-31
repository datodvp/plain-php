<?php

// require __DIR__ . '/../DAO/ProductDAO.php';
require __DIR__ . '/../Database.php';
require __DIR__ . '/../Models/Product.php';

class ProductController {
    public static function getAll() {
          
        $products = Product::all();
        
        echo $products;
    }

    public static function create() {

        $newProductRequest = json_decode(file_get_contents('php://input'), true);

        $product = Product::create($newProductRequest);
    }

    public static function delete($id_list) {

        $result = Product::delete($id_list);

        echo $result;
    }
}

?>