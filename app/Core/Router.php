<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function add($method, $uri, $action)
    {
        $this->routes[strtoupper($method)][$uri] = $action;
    }

    public function dispatch($method, $uri)
    {
        $method = strtoupper($method);
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            [$controller, $method] = explode('@', $action);
            $controller = "App\\Controllers\\$controller";
            call_user_func([new $controller, $method]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
        }
    }
}
