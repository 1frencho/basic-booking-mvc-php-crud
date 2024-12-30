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
      'error' => $_SESSION['error'] ?? '', // Recuperar error de la sesión,
      'successMessage' => $_SESSION['successMessage'] ?? '', // Recuperar mensaje de la sesión,
    ];
    unset($_SESSION['successMessage'], $_SESSION['error']); // Limpiar mensaje después de cargarlo
    $this->render('admin/bookingsManager', $layoutData);
  }

  public function showMyBookings()
  {
    $layoutData = [
      'title' => 'My Bookings',
      'meta' => '<meta name="description" content="My bookings">',
      // 'styles' => '<link rel="stylesheet" href="styles/myBookings.css">',
      // 'scripts' => '<script src="scripts/myBookings.js"></script>',
      'error' => $_SESSION['error'] ?? '', // Recuperar error de la sesión,
      'successMessage' => $_SESSION['successMessage'] ?? '', // Recuperar mensaje de la sesión,
    ];
    unset($_SESSION['successMessage'], $_SESSION['error']); // Limpiar mensaje después de cargarlo
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

  public function handleCreateBooking()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: rooms');
      exit;
    }

    // Validar que el usuario esté autenticado
    if (!isset($_SESSION['user'])) {
      $_SESSION['error'] = 'You must be logged in to make a booking.';
      header('Location: signIn');
      exit;
    }

    // Recuperar datos del formulario
    $idRoom = htmlspecialchars(trim($_POST['id_room']));
    $startDate = htmlspecialchars(trim($_POST['start_date']));
    $endDate = htmlspecialchars(trim($_POST['end_date']));

    if (empty($idRoom) || empty($startDate) || empty($endDate)) {
      $_SESSION['error'] = 'All fields are required';
      header('Location: rooms');
      exit;
    }

    $userId = $_SESSION['user']['id'];

    try {
      $status = 'pending'; // Estado inicial de la reserva
      $bookingId = Booking::create($userId, $idRoom, $startDate, $endDate, $status);

      if ($bookingId) {
        $_SESSION['successMessage'] = 'Booking created successfully.';
        header('Location: myBookings');
      } else {
        $_SESSION['error'] = 'Failed to create booking. Please try again.';
        header('Location: rooms');
      }
    } catch (\Throwable $th) {
      $_SESSION['error'] = 'An error occurred: ' . $th->getMessage();
      header('Location: rooms');
    }
    exit;
  }

  public function handleUpdateBookingStatusAdmin()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      $_SESSION['error'] = 'Invalid request method.';
      header('Location: adminBookingsManager');
      exit;
    }

    $bookingId = htmlspecialchars(trim($_POST['booking_id']));
    $status = htmlspecialchars(trim($_POST['status']));

    if (empty($bookingId) || empty($status)) {
      $_SESSION['error'] = 'Booking ID and status are required.';
      header('Location: adminBookingsManager');
      exit;
    }

    try {
      $updated = Booking::updateAdminStatus($bookingId, $status);
      if ($updated) {
        $_SESSION['successMessage'] = 'Booking status updated successfully.';
      } else {
        $_SESSION['error'] = 'Failed to update booking status.';
      }
    } catch (\Throwable $th) {
      $_SESSION['error'] = 'An error occurred: ' . $th->getMessage();
    }

    header('Location: adminBookingsManager');
    exit;
  }

  public function handleUpdateBookingStatusClient()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      $_SESSION['error'] = 'Invalid request method.';
      header('Location: myBookings');
      exit;
    }

    $bookingId = htmlspecialchars(trim($_POST['booking_id']));
    $status = htmlspecialchars(trim($_POST['status']));

    if (empty($bookingId) || empty($status)) {
      $_SESSION['error'] = 'Booking ID and status are required.';
      header('Location: myBookings');
      exit;
    }

    try {
      $updated = Booking::updateClientStatus($bookingId, $status, $_SESSION['user']['id']);
      if ($updated) {
        $_SESSION['successMessage'] = 'Booking status updated successfully.';
      } else {
        $_SESSION['error'] = 'Failed to update booking status.';
      }
    } catch (\Throwable $th) {
      $_SESSION['error'] = 'An error occurred: ' . $th->getMessage();
    }

    header('Location: myBookings');
    exit;
  }

  public function handleRemoveBookingClient()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      $_SESSION['error'] = 'Invalid request method.';
      header('Location: myBookings');
      exit;
    }

    $bookingId = htmlspecialchars(trim($_POST['booking_id']));

    if (empty($bookingId)) {
      $_SESSION['error'] = 'Booking ID is required.';
      header('Location: myBookings');
      exit;
    }

    try {
      $removed = Booking::removeForClient($bookingId, $_SESSION['user']['id']);
      if ($removed) {
        $_SESSION['successMessage'] = 'Booking removed successfully.';
      } else {
        $_SESSION['error'] = 'Failed to remove booking.';
      }
    } catch (\Throwable $th) {
      $_SESSION['error'] = 'An error occurred: ' . $th->getMessage();
    }

    header('Location: myBookings');
    exit;
  }
}
