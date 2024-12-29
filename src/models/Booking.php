<?php

namespace App\Models;

use App\Config\DBConnection;

class Booking
{
  private static $table = 'bookings';

  public static function getAll()
  {
    $conn = DBConnection::connect();

    // Query con INNER JOIN para obtener datos relacionados
    $query = "
      SELECT 
        b.id AS booking_id,
        b.start_date,
        b.end_date,
        b.status AS booking_status,
        b.created_at AS booking_created_at,
        u.email AS user_email,
        ud.first_name AS user_first_name,
        ud.phone_number AS user_phone_number,
        r.id AS room_id,
        r.name AS room_name,
        r.room_status
      FROM " . self::$table . " b
      INNER JOIN account_details u ON b.id_user = u.id
      INNER JOIN user_details ud ON u.id = ud.id_user
      INNER JOIN rooms r ON b.id_room = r.id
      ORDER BY b.created_at DESC
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public static function getByUserId($id)
  {
    $conn = DBConnection::connect();

    // Query con INNER JOIN para un solo registro
    $query = "
      SELECT 
        b.id AS booking_id,
        b.start_date,
        b.end_date,
        b.status AS booking_status,
        b.created_at AS booking_created_at,
        u.email AS user_email,
        ud.first_name AS user_first_name,
        ud.phone_number AS user_phone_number,
        r.id AS room_id,
        r.name AS room_name,
        r.room_status
      FROM " . self::$table . " b
      INNER JOIN account_details u ON b.id_user = u.id
      INNER JOIN user_details ud ON u.id = ud.id_user
      INNER JOIN rooms r ON b.id_room = r.id
      WHERE b.id_user = :id
      ORDER BY b.created_at DESC
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public static function getById($id)
  {
    $conn = DBConnection::connect();

    // Query con INNER JOIN para un solo registro
    $query = "
      SELECT 
        b.id AS booking_id,
        b.start_date,
        b.end_date,
        b.status AS booking_status,
        b.created_at AS booking_created_at,
        u.email AS user_email,
        ud.first_name AS user_first_name,
        r.id AS room_id,
        r.name AS room_name,
        r.room_status
      FROM " . self::$table . " b
      INNER JOIN account_details u ON b.id_user = u.id
      INNER JOIN user_details ud ON u.id = ud.id_user
      INNER JOIN rooms r ON b.id_room = r.id
      WHERE b.id = :id
      LIMIT 1
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public static function create($id_user, $id_room, $start_date, $end_date, $status)
  {
    $conn = DBConnection::connect();
    $query = "
      INSERT INTO " . self::$table . " 
      (id_user, id_room, start_date, end_date, status) 
      VALUES (:id_user, :id_room, :start_date, :end_date, :status)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':id_room', $id_room);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->bindParam(':status', $status);
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
}
