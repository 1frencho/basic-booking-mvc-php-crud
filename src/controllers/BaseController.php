<?php

namespace App\Controllers;

class BaseController
{
  protected function render(string $viewPath, array $layoutData = [])
  {
    // Extraer las variables del layoutData para usar en el layout
    extract($layoutData);

    // Buffer de salida para capturar el contenido de la vista
    ob_start();
    require __DIR__ . "/../Views/{$viewPath}.php";
    $content = ob_get_clean();

    // Renderizar el layout principal con las variables extraídas
    require __DIR__ . '/../Views/layouts/main.php';
  }
}
