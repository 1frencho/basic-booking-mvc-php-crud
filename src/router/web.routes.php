<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Middleware\AuthMiddleware;

use App\Router;
use Dotenv\Dotenv;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();


$router = new Router();

// ---------------------------- VIEWS ------------------------------------------
$router->get('/', [HomeController::class, 'index']);
$router->get('/signIn', [AuthController::class, 'showSignIn']);
$router->get('/signUp', [AuthController::class, 'showSignUp']);
$router->get('/dashboard', [HomeController::class, 'dashboard'], [AuthMiddleware::class]);

// ---------------------------- REQUESTS --------------------------------------
$router->post('/signUp', [AuthController::class, 'handleSignUp']);
$router->post('/signIn', [AuthController::class, 'handleSignIn']);
$router->get('/signOut', [AuthController::class, 'signOut']);

$router->resolve();
