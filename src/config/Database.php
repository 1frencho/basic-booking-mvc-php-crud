<?php

namespace App\Config;

class Database
{
  private $host = "localhost";
  private $db_name = "your_database";
  private $username = "root";
  private $password = "";
  private $conn = null;

  public function getConnection()
  {
    try {
      $this->conn = new \PDO(
        "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
        $this->username,
        $this->password
      );
      $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      echo "Connection error: " . $e->getMessage();
    }
    return $this->conn;
  }
}