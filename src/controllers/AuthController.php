<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController
{
  // ---------------------------- VIEWS ------------------------------------------
  public function showSignIn()
  {
    $layoutData = [
      'title' => 'Sign In',
      'meta' => '<meta name="description" content="Log into your account">',
      // 'styles' => '<link rel="stylesheet" href="assets/css/output.css"/>',
      // 'scripts' => '<script src="scripts/home.js"></script>',
    ];
    $this->render('auth/signIn', $layoutData);
  }
  public function showSignUp()
  {
    $layoutData = [
      'title' => 'Sign Up',
      'meta' => '<meta name="description" content="Sign up for your account">',
    ];
    $this->render('auth/signUp', $layoutData);
  }
  // ---------------------------- REQUESTS --------------------------------------
  public function handleSignUp()
  {
    // Verifica que el método sea POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: signUp');
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = htmlspecialchars(trim($_POST['email']));
      $password = htmlspecialchars(trim($_POST['password']));
      $firstName = htmlspecialchars(trim($_POST['firstName']));
      $lastName = htmlspecialchars(trim($_POST['lastName']));
      $phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));

      $userId = User::create($email, $password, $firstName, $lastName, $phoneNumber);
      if (!$userId) {
        header('Location: ?error=true');
        exit;
      }
      header('Location: ?success=true&id=' . $userId);
      exit;
    }
  }
}
