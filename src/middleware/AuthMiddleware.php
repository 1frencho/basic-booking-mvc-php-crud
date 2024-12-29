<?php

namespace App\Middleware;


class AuthMiddleware
{
  public function handleAdmin()
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
      $_SESSION['error'] = 'Unauthorized';
      header('Location: signIn');
      exit;
    }
    return true;
  }

  public function handleAuthenticated()
  {
    if (!isset($_SESSION['user'])) {
      $_SESSION['error'] = 'You need to have a client account to access.';
      header('Location: signIn');
      exit;
    }
    return true;
  }
}
