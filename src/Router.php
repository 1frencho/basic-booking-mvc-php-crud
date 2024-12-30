<?php

namespace App;


class Router
{
  private array $routes = [];
  private array $middlewares = [];
  private string $basePath;

  public function __construct()
  {

    // Detectar el subdirectorio base desde las variables de entorno
    $this->basePath = $_ENV['BASE_PATH'] ?? '/public/';
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

    $callback = $this->routes[$method][$path] ?? null;
    $middleware = $this->middlewares[$method][$path] ?? [];

    if ($callback === null) {
      http_response_code(404);

      // Usar layout principal para renderizar la vista 404
      $viewPath = __DIR__ . '/views/404.php';
      $layoutPath = __DIR__ . '/views/layouts/main.php';

      if (file_exists($viewPath) && file_exists($layoutPath)) {
        // Generar contenido desde la vista
        ob_start();
        require $viewPath;

        $content = ob_get_clean();

        // Incluir el layout principal
        require $layoutPath;
      } else {
        // En caso de que falten archivos, renderizar un mensaje básico
        echo "404 - Página no encontrada.";
      }
      return;
    }

    // Ejecutar middlewares
    foreach ($middleware as $middlewareDefinition) {
      [$middlewareClass, $middlewareMethod] = $middlewareDefinition;
      $middlewareInstance = new $middlewareClass();

      if (method_exists($middlewareInstance, $middlewareMethod)) {
        if (!$middlewareInstance->$middlewareMethod()) {
          echo "Unauthorized";
          return;
        }
      } else {
        throw new \Exception("Middleware method {$middlewareMethod} does not exist in {$middlewareClass}");
      }
    }


    // Ejecutar controlador o callback
    if (is_array($callback)) {
      $controller = new $callback[0]();
      $method = $callback[1];
      echo $controller->$method();
    } else {
      echo $callback();
    }
  }
}
