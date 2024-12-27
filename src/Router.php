<?php

namespace App;

class Router
{
  private array $routes = [];
  private array $middlewares = [];
  private string $basePath;

  public function __construct()
  {
    // Detectar el subdirectorio base
    $this->basePath = '/booking-crud-php/public';
  }

  public function get($path, $callback, $middleware = [])
  {
    $this->routes['GET'][$path] = $callback;
    $this->middlewares['GET'][$path] = $middleware;
  }

  public function post($path, $callback, $middleware = [])
  {
    $this->routes['POST'][$path] = $callback;
    $this->middlewares['POST'][$path] = $middleware;
  }

  private function getPath()
  {
    $path = $_SERVER['REQUEST_URI'];
    // Remover el basePath de la URI
    $path = str_replace($this->basePath, '', $path);
    // Si la ruta está vacía, establecer como '/'
    $path = $path ?: '/';
    // Remover query strings
    $position = strpos($path, '?');
    if ($position !== false) {
      $path = substr($path, 0, $position);
    }
    // Remover trailing slash excepto para la ruta raíz
    $path = $path !== '/' ? rtrim($path, '/') : $path;
    return $path;
  }

  public function resolve()
  {
    $path = $this->getPath();
    $method = $_SERVER['REQUEST_METHOD'];

    // Debug para ayudar a identificar problemas
    // error_log("Path: " . $path);
    // error_log("Method: " . $method);
    // error_log("Available routes: " . print_r($this->routes, true));

    $callback = $this->routes[$method][$path] ?? null;
    $middleware = $this->middlewares[$method][$path] ?? [];

    if ($callback === null) {
      http_response_code(404);
      require_once __DIR__ . '/Views/404.php';
      return;
    }

    // Execute middleware
    foreach ($middleware as $middlewareClass) {
      $middlewareInstance = new $middlewareClass();
      if (!$middlewareInstance->handle()) {
        return;
      }
    }

    // Execute controller method
    if (is_array($callback)) {
      $controller = new $callback[0]();
      $method = $callback[1];
      echo $controller->$method();
    } else {
      echo $callback();
    }
  }
}
