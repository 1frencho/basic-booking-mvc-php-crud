<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
  public function showUserManager()
  {
    $layoutData = [
      'title' => 'User Manager | Admin',
      'meta' => '<meta name="description" content="Manage users">',
      // 'styles' => '<link rel="stylesheet" href="styles/userManager.css">',
      // 'scripts' => '<script src="scripts/userManager.js"></script>',
    ];
    $this->render('admin/usersManager', $layoutData);
  }

  public function getUsers()
  {
    try {
      $users = User::getAll();
      $this->json($users);
    } catch (\Throwable $th) {
      $this->json(['error' => $th->getMessage()], 500);
    }
  }
}
