<?php

class Router {


    public static function get(string $path, $controller, $method) {
        self::handleRequest($path, $controller, $method, 'GET');
    }

    public static function post(string $path, $controller, $method) {
        self::handleRequest($path, $controller, $method, 'POST');
    }

    private static function handleRequest(string $path, $controller, $method, string $expected_method) {
        $current_path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $request_method = $_SERVER['REQUEST_METHOD'];

        if ($path !== $current_path || $request_method !== $expected_method) {
            return;
        }

        if (file_exists("Controllers/" . $controller . ".php")) {
            $newController = new $controller();
        } else {
            throw new Exception('Controller file not found');
        }

        if (method_exists($newController, $method)) {
            $newController->$method();
        } else {
            throw new Exception('Method not found in controller');
        }
    }

}

?>
