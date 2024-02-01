<?php

class Router {
    private $request_uri;
    private $request_method;
    
    public function __construct() {
        $this->request_uri  = $_SERVER['REQUEST_URI'];
        $this->request_method = $_SERVER['REQUEST_METHOD'];
    }

    public function handleRoute() {
        
        switch($this->request_uri){
            case '/':
                $this->index();
                break;
            case '/api/products':
                $this->products();
                break;
            case '/api/products/delete':
                $this->productsDelete();
                break;
            default: 
                $this->notFound();
                break;
        }
    }

    public function index() {
        echo 'This is PHP server <br/>';
    }

    public function products() {
        switch($this->request_method) {
            case 'GET':
                ProductController::getAll();
                break;
            case 'POST':
                ProductController::store();
                break;
        }
    }

    public function productsDelete() {
        switch($this->request_method){
            case 'POST':
                $json = json_decode(file_get_contents('php://input'), true);
                $id_list = $json['id_list'];

                ProductController::delete($id_list);
                break;
            default:
                echo '404 Not Found <br/>';
        }
    }

    public function notFound() {
        http_response_code(404);
        echo '404 Not Found <br/>';
    }
}

?>