<?php

namespace App\Config;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class DBConnection
{
  // Método para conectarnos a la base de datos
  public static function connect()
  {
    try {
      // Cargar las variables de entorno
      $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
      $dotenv->load();

      // Obtener las credenciales de las variables de entorno
      $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8';
      $user = $_ENV['DB_USER'];
      $password = $_ENV['DB_PASSWORD'];

      // Crear instancia de PDO
      $pdo = new PDO($dsn, $user, $password);

      // Configurar atributos de PDO
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $pdo; // Retornar la conexión
    } catch (PDOException $e) {
      echo "Error trying to connect to the database: " . $e->getMessage();
      exit();
    }
  }
}
