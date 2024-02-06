<?php

class ProductController extends Controller {


    public function index() {
          
        $products = Product::all();
        
        $this->jsonResponse($products);
    }

    public function store() {

        $requestBody = json_decode(file_get_contents('php://input'), true);

        $attributes = $requestBody;

        $result = Product::create($requestBody);

        if(isset($result->errors)) {
            return $this->jsonResponse($result, 'Validation error');
        }
        
        return $this->jsonResponse($result);
    }

    public function massDelete() {

        $requestBody = json_decode(file_get_contents('php://input'), true);

        $id_list = $requestBody['id_list'];

        $result = Product::massDelete($id_list);

        $products = Product::all();

        $this->jsonResponse($products, 'items removed');
    }
}

?>