<?php

namespace App\Models;

use App\Config\DBConnection;

class User
{
  private static $table = 'account_details';
  private static $userDetailsTable = 'user_details';
  private static $defaultRole = 'User';

  public static function findByEmail($email)
  {
    $conn = DBConnection::connect();
    $query = "SELECT ad.id,
    ad.email,
    ad.role,
    ad.password,
    ad.created_at,
    ud.first_name,
    ud.last_name,
    ud.phone_number FROM " . self::$table . " ad 
    INNER JOIN " . self::$userDetailsTable . " ud
    on ad.id = ud.id_user"
      . " WHERE ad.email = :email LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  // public function create($data)
  public static function create($email, $password, $firstName, $lastName, $phoneNumber)
  {
    $conn = DBConnection::connect();
    // Crear datos de autenticación para el usuario
    $query = "INSERT INTO " . self::$table . " (email, password, role, created_at) VALUES (:email, :password, :role, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', self::$defaultRole);
    $stmt->execute();
    $userId = $conn->lastInsertId();

    // Insertar datos de usuario
    $query = "INSERT INTO " . self::$userDetailsTable
      . " (id_user, first_name, last_name, phone_number) 
    VALUES (:id_user, :first_name, :last_name, :phone_number)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_user', $userId);
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':phone_number', $phoneNumber);
    $stmt->execute();

    return $userId;
  }

  public static function checkEmail($email)
  {
    $conn = DBConnection::connect();
    $query = "SELECT email FROM " . self::$table . " WHERE email = :email LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result;
  }
}
