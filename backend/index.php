<?php

include 'autoloader.php';

// This is MVC architecture and resembles LARAVEL framework, 
// if you are familiar with it, it will be easy to get to know the code.
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

Router::get('/', Controller::class, 'index'); // this is just index page for server  

Router::get('/api/products', ProductController::class, 'index');
Router::post('/api/products', ProductController::class, 'store');
Router::post('/api/products/delete', ProductController::class, 'massDelete')

?>