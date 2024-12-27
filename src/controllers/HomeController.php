<?php

namespace App\Controllers;

class HomeController extends BaseController
{
  public function index()
  {
    $layoutData = [
      'title' => 'Inicio',
      'meta' => '<meta name="description" content="Página principal">',
      // 'styles' => '<link rel="stylesheet" href="styles/home.css">',
      // 'scripts' => '<script src="scripts/home.js"></script>',
    ];
    $this->render('home/index', $layoutData);
  }
}
