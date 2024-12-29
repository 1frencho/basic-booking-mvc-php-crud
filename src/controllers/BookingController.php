<?php

namespace App\Controllers;

use App\Models\Booking;

class BookingController extends BaseController
{
  public function showBookingManager()
  {
    $layoutData = [
      'title' => 'Booking Manager | Admin',
      'meta' => '<meta name="description" content="Manage bookings">',
      // 'styles' => '<link rel="stylesheet" href="styles/bookingManager.css">',
      // 'scripts' => '<script src="scripts/bookingManager.js"></script>',
    ];
    $this->render('admin/bookingsManager', $layoutData);
  }

  public function showMyBookings()
  {
    $layoutData = [
      'title' => 'My Bookings',
      'meta' => '<meta name="description" content="My bookings">',
      // 'styles' => '<link rel="stylesheet" href="styles/myBookings.css">',
      // 'scripts' => '<script src="scripts/myBookings.js"></script>',
    ];
    $this->render('client/myBookings', $layoutData);
  }

  public function getBookings()
  {
    try {
      $bookings = Booking::getAll();
      $this->json($bookings);
    } catch (\Throwable $th) {
      $this->json(['error' => $th->getMessage()], 500);
    }
  }
  public function getMyBookings()
  {
    if (!isset($_SESSION['user'])) {
      $this->json(['error' => 'Unauthorized'], 401);
    }
    try {
      $bookings = Booking::getByUserId($_SESSION['user']['id']);
      $this->json($bookings);
    } catch (\Throwable $th) {
      $this->json(['error' => $th->getMessage()], 500);
    }
  }
}
