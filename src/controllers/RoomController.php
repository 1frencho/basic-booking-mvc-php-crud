<?php

namespace App\Controllers;

use App\Models\Room;

class RoomController extends BaseController
{
  public function showPublicRooms()
  {
    $layoutData = [
      'title' => 'Public Rooms',
      'meta' => '<meta name="description" content="Public rooms">',
      // 'styles' => '<link rel="stylesheet" href="styles/publicRooms.css">',
      // 'scripts' => '<script src="scripts/publicRooms.js"></script>',
    ];
    $this->render('home/rooms', $layoutData);
  }


  public function showRoomManager()
  {
    $layoutData = [
      'title' => 'Room Manager | Admin',
      'meta' => '<meta name="description" content="Manage rooms">',
      // 'styles' => '<link rel="stylesheet" href="styles/roomManager.css">',
      // 'scripts' => '<script src="scripts/roomManager.js"></script>',
    ];
    $this->render('admin/roomsManager', $layoutData);
  }


  public function getRooms()
  {
    try {
      $rooms = Room::getAll();
      $this->json($rooms);
    } catch (\Throwable $th) {
      $this->json(['error' => $th->getMessage()], 500);
    }
  }

  public function addRoom()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: signUp');
      exit;
    }

    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $image_url = htmlspecialchars(trim($_POST['image_url']));
    $room_status = htmlspecialchars(trim($_POST['room_status']));
    $price_per_night = htmlspecialchars(trim($_POST['price_per_night']));

    if (empty($name) || empty($description) || empty($image_url) || empty($room_status) || empty($price_per_night)) {
      $_SESSION['error'] = 'All fields are required.';
      header('Location: signUp');
      exit;
    }


    try {
      $roomId = Room::create($name, $description, $image_url, $room_status, $price_per_night);
      if (!$roomId) {
        $_SESSION['error'] = 'Error creating room.';
        header('Location: adminRoomManager');
        exit;
      }
      $_SESSION['successMessage'] = 'Room successfully created.';
      header('Location: adminRoomManager');
    } catch (\Throwable $th) {
      throw $th->getMessage();
    }
    exit;
  }
}
