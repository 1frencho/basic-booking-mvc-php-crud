<?php

namespace App\Models;

use App\Config\Database;

class User
{
  private $conn;
  private $table = 'users';

  public function __construct()
  {
    $db = new Database();
    $this->conn = $db->getConnection();
  }

  public function findByEmail($email)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function create($data)
  {
    $query = "INSERT INTO " . $this->table . " (email, password, created_at) 
                 VALUES (:email, :password, NOW())";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT));

    return $stmt->execute();
  }
}
