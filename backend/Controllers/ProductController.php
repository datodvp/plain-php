<?php

class ProductController extends Controller {


    public function index() {
          
        $products = Product::all();
        
        $this->jsonResponse($products);
    }

    public function store() {

        $requestBody = json_decode(file_get_contents('php://input'), true);

        $attributes = $requestBody;

        $product = Product::create($requestBody);
        
        $this->jsonResponse($product);
    }

    public function massDelete() {

        $requestBody = json_decode(file_get_contents('php://input'), true);

        $id_list = $requestBody['id_list'];

        $result = Product::massDelete($id_list);

        $this->jsonResponse($result);
    }
}

?>