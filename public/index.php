<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;

$router = new Router();
require_once __DIR__ . '/../src/Router/web.routes.php';
$router->resolve();
