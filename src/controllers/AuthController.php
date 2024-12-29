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
      'error' => $_SESSION['error'] ?? '', // Recuperar error de la sesión,
      'successMessage' => $_SESSION['successMessage'] ?? '', // Recuperar mensaje de la sesión,
    ];
    unset($_SESSION['successMessage'], $_SESSION['error']); // Limpiar mensaje después de cargarlo

    $this->render('auth/signIn', $layoutData);
  }
  public function showSignUp()
  {
    $layoutData = [
      'title' => 'Sign Up',
      'meta' => '<meta name="description" content="Sign up for your account">',
      'error' => $_SESSION['error'] ?? '', // Recuperar error de la sesión,
    ];
    unset($_SESSION['error']); // Limpiar error después de cargarlo
    $this->render('auth/signUp', $layoutData);
  }

  public function handleSignUp()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: signUp');
      exit;
    }

    $email = htmlspecialchars(trim(strtolower($_POST['email'])));
    $password = htmlspecialchars(trim($_POST['password']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));

    if (empty($email) || empty($password) || empty($firstName) || empty($lastName) || empty($phoneNumber)) {
      $_SESSION['error'] = 'All fields are required.';
      header('Location: signUp');
      exit;
    }

    $emailExist = User::checkEmail(strtolower($email));
    if ($emailExist) {
      $_SESSION['error'] = 'Email already exists.';
      header('Location: signUp');
      exit;
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $userId = User::create($email, $hashedPassword, $firstName, $lastName, $phoneNumber);
    if (!$userId) {
      $_SESSION['error'] = 'Error creating user.';
      header('Location: signUp');
      exit;
    }

    $_SESSION['successMessage'] = 'Registration successful. Please login.';
    header('Location: signIn');
    exit;
  }

  public function handleSignIn()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: signIn');
      exit;
    }

    $email = htmlspecialchars(trim(strtolower($_POST['email'])));
    $password = htmlspecialchars(trim($_POST['password']));

    if (empty($email) || empty($password)) {
      $_SESSION['error'] = 'All fields are required.';
      header('Location: signIn');
      exit;
    }

    try {
      $user = User::findByEmail($email);
      if (!$user) {
        $_SESSION['error'] = 'Invalid email.';
        header('Location: signIn');
        exit;
      }

      if (!password_verify($password, $user['password'])) {
        $_SESSION['error'] = 'Invalid email or password.';
        header('Location: signIn');
        exit;
      }

      unset($user['password']);
      $_SESSION['user'] = $user;
      header('Location: rooms');
    } catch (\Throwable $th) {
      throw $th->getMessage();
    }
    exit;
  }

  public function signOut()
  {
    unset($_SESSION['user']);
    session_destroy();
    header('Location: signIn');
  }
}
