<?php

namespace App\Config;

class Router {
    
    private array $routes = [];

    public function get(string $uri, string $controller, string $method): void
    {
        $this->routes['GET'][$uri] = ['controller' => $controller, 'method' => $method];
    }

    public function post(string $uri, string $controller, string $method): void
    {
        $this->routes['POST'][$uri] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch(): void
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri        = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri        = rtrim($uri, '/') ?: '/';

        if (!isset($this->routes[$httpMethod][$uri])) {
            http_response_code(404);
            echo json_encode(['status' => false, 'msg' => 'Rota não encontrada.', 'code' => 404]);
            return;
        }

        $route      = $this->routes[$httpMethod][$uri];
        $controller = new $route['controller']();
        $method     = $route['method'];

        $data = $httpMethod === 'POST' ? $_POST : [];
        $controller->$method($data);
    }
}
