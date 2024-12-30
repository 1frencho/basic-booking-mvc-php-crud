<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Middleware\AuthMiddleware;
use App\Controllers\RoomController;
use App\Controllers\BookingController;
use App\Controllers\UserController;


use App\Router;

$router = new Router();

// ---------------------------- VIEWS ------------------------------------------


// ---------------------------- ADMIN ------------------------------------------
$router->get('adminRoomManager', [RoomController::class, 'showRoomManager'], [[AuthMiddleware::class, 'handleAdmin']]);
$router->get('adminBookingsManager', [BookingController::class, 'showBookingManager'], [[AuthMiddleware::class, 'handleAdmin']]);
$router->get('adminUsersManager', [UserController::class, 'showUserManager'], [[AuthMiddleware::class, 'handleAdmin']]);

// ---------------------------- CLIENT ------------------------------------------
$router->get('myBookings', [BookingController::class, 'showMyBookings'], [[AuthMiddleware::class, 'handleAuthenticated']]);

// ---------------------------- PUBLIC ------------------------------------------
$router->get('/', [HomeController::class, 'index']);
$router->get('signIn', [AuthController::class, 'showSignIn']);
$router->get('signUp', [AuthController::class, 'showSignUp']);
$router->get('rooms', [RoomController::class, 'showPublicRooms']);



// ---------------------------- REQUESTS --------------------------------------
$router->post('signUp', [AuthController::class, 'handleSignUp']);
$router->post('signIn', [AuthController::class, 'handleSignIn']);
$router->get('signOut', [AuthController::class, 'signOut']);

$router->post('addRoom', [RoomController::class, 'addRoom'], [[AuthMiddleware::class, 'handleAdmin']]);
$router->post('updateRoom', [RoomController::class, 'updateRoom'], [[AuthMiddleware::class, 'handleAdmin']]); // PATCH

$router->post('createBooking', [BookingController::class, 'handleCreateBooking'], [[AuthMiddleware::class, 'handleAuthenticated']]);
$router->post('updateBookingStatusAdmin', [BookingController::class, 'handleUpdateBookingStatusAdmin'], [[AuthMiddleware::class, 'handleAdmin']]);
$router->post('updateBookingStatusClient', [BookingController::class, 'handleUpdateBookingStatusClient'], [[AuthMiddleware::class, 'handleAuthenticated']]);
$router->post('removeBookingClient', [BookingController::class, 'handleRemoveBookingClient'], [[AuthMiddleware::class, 'handleAuthenticated']]);


// ---------------------------- API PÚBLICA - OPCIONAL -----------------------------------
// -- Debería de aplicarse en el futuro: CORS - Token de acceso, para que sea privada...
$router->get('api/rooms', [RoomController::class, 'getRooms']);
$router->get('api/bookings', [BookingController::class, 'getBookings']);
$router->get('api/users', [UserController::class, 'getUsers']);
$router->get('api/myBookings', [BookingController::class, 'getMyBookings']);

$router->resolve();
