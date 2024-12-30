<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Cargar variables de entorno desde .env solo si el archivo existe
if (file_exists(__DIR__ . '/../.env')) {
  $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
  $dotenv->load();
}

require_once __DIR__ . '/../src/router/web.routes.php';
