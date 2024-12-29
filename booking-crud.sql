-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2024 at 02:36 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking-crud`
--
CREATE DATABASE IF NOT EXISTS `booking-crud` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci;
USE `booking-crud`;

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE IF NOT EXISTS `account_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_spanish_ci NOT NULL,
  `role` enum('Admin','User') COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'User',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`id`, `email`, `password`, `role`, `created_at`) VALUES
(8, 'frenchoDev@gmail.com', '$2y$10$yfTBSE/SsPANiCVWik3Gh.niLvpO7gC3DO9wj8JWD10hnie6K8ZMu', 'Admin', '2024-12-28 20:34:35'),
(9, 'hola@gmail.com', '$2y$10$tA3d5Az4mgAREdGDzIf6eOsvs9XFpt/zNtZVxFtD9UThCN5yhiftS', 'User', '2024-12-28 20:39:10'),
(10, 'olapopa@gmail.com', '$2y$10$iPdeBS8SdqDX9txCmJikvOcqg1ZRqK/iv3WzQNMUVjOgPHA8Y3s8u', 'User', '2024-12-28 20:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_room` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('pending','cancelled','approved','ended') COLLATE utf8mb3_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb3_spanish_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb3_spanish_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb3_spanish_ci NOT NULL,
  `room_status` enum('hidden','public') COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'hidden',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_admin_creator` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_admin_creator` (`id_admin_creator`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `image_url`, `room_status`, `created_at`, `id_admin_creator`) VALUES
(1, 'Hotel Loca', 'Sisisisisisisisiisisis', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/b0/c1/4c/boutique-hotels.jpg?w=1200&h=-1&s=1', 'public', '2024-12-29 00:51:46', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `phone_number` varchar(15) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `first_name`, `last_name`, `phone_number`, `id_user`) VALUES
(7, 'Marcos', 'Alfaro', '18923719', 8),
(8, 'sjdiuajsd', 'jiodjaoisd', '12637812', 9),
(9, 'POPA', 'RODRÍGUEZ', '12783612', 10);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_id_room_reservation` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_user_reservation` FOREIGN KEY (`id_user`) REFERENCES `account_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_id_admin_creator` FOREIGN KEY (`id_admin_creator`) REFERENCES `account_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `fk_id_account_details` FOREIGN KEY (`id_user`) REFERENCES `account_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
