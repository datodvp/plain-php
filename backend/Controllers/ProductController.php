<?php

class ProductController extends Controller {
    public static function getAll() {
          
        $products = Product::all();
        
        echo $products;
    }

    public static function store() {

        $newProductRequest = json_decode(file_get_contents('php://input'), true);

        $product = Product::create($newProductRequest);
        
        echo json_encode($product);
    }

    public static function massDelete($id_list) {

        $result = Product::massDelete($id_list);

        echo $result;
    }
}

?>