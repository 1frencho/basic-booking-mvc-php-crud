<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new User();
  }

  public function showLogin()
  {
    require_once __DIR__ . '/../views/auth/login.php';
  }

  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      $user = $this->userModel->findByEmail($email);
      if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: /dashboard');
        exit;
      }

      header('Location: /login');
      exit;
    }
  }
}
