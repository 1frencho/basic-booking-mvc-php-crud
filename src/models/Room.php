<?php

namespace App\Models;

use App\Config\DBConnection;

class Room
{
  private static $table = 'rooms';
  private static $defaultStatus = 'hidden';

  public static function getAll()
  {
    $conn = DBConnection::connect();

    $query = "SELECT * FROM " . self::$table;
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public static function getAllPublic()
  {
    $conn = DBConnection::connect();

    $query = "SELECT * FROM " . self::$table . " WHERE room_status = 'public'";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public static function create($name, $description, $image_url, $room_status, $price_per_night, $id_admin_creator)
  {
    $conn = DBConnection::connect();
    $query = "INSERT INTO " . self::$table . " (name, description, image_url, room_status, price_per_night, id_admin_creator) VALUES (:name, :description, :image_url, :room_status, :price_per_night, :id_admin_creator)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image_url', $image_url);
    $stmt->bindParam(':room_status', $room_status);
    $stmt->bindParam(':price_per_night', $price_per_night);
    $stmt->bindParam(':id_admin_creator', $id_admin_creator);
    $stmt->execute();
    return $conn->lastInsertId();
  }

  public static function remove($id)
  {
    $conn = DBConnection::connect();
    $query = "DELETE FROM " . self::$table . " WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }

  public static function getById($id)
  {
    $conn = DBConnection::connect();

    $query = "SELECT * FROM " . self::$table . " WHERE id = :id LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public static function update($id, $name, $description, $image_url, $room_status, $price_per_night)
  {
    $conn = DBConnection::connect();
    $query = "UPDATE " . self::$table . " SET name = :name, description = :description, image_url = :image_url, room_status = :room_status, price_per_night = :price_per_night WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image_url', $image_url);
    $stmt->bindParam(':room_status', $room_status);
    $stmt->bindParam(':price_per_night', $price_per_night);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }
}
