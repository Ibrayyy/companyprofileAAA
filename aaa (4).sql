-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2024 at 01:53 PM
-- Server version: 8.2.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(8, 'banner3', 'banner3', 'banner3.jpg', '2024-12-14 06:58:16', '2024-12-14 06:58:16'),
(7, 'banner2', 'esd fiesta', 'banner2.jpg', '2024-12-14 06:57:48', '2024-12-14 06:57:48'),
(6, 'Banner1', 'diskon 11.11', 'banner1.jpg', '2024-12-14 06:56:34', '2024-12-14 06:56:34'),
(9, 'banner4', 'banner4', 'banner4.jpg', '2024-12-14 06:59:00', '2024-12-14 06:59:00'),
(11, 'banner 4', 'banner himti', 'logo himti.jpg', '2024-12-14 07:21:49', '2024-12-14 07:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(5, 'msi', 's', 'logoACER.png', '2024-12-14 07:25:52', '2024-12-14 07:25:52'),
(6, 'df', 'd', 'logoDF.png', '2024-12-14 07:26:02', '2024-12-14 07:26:02'),
(7, 'msi', 'msi', 'logoMSI.png', '2024-12-14 07:26:11', '2024-12-14 07:26:11'),
(8, 'tes', 'tes', 'logoTS.png', '2024-12-14 07:26:24', '2024-12-14 07:26:24'),
(9, 'predator', 'predator', 'logoPredator.png', '2024-12-14 07:26:36', '2024-12-14 07:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'yess', 'sas', '2024-12-02 15:49:46', '2024-12-13 07:28:55'),
(4, 'tes', 's', '2024-12-13 07:27:30', '2024-12-13 07:27:30'),
(5, 'Teuku Ardhi', NULL, '2024-12-13 07:56:47', '2024-12-13 07:56:47'),
(6, 'SSD', 'SSD SOLIDE STATE', '2024-12-13 08:42:55', '2024-12-13 08:42:55'),
(7, 'tes', 'nn', '2024-12-13 10:20:34', '2024-12-13 10:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  
  `stock_status` enum('Available','Out of Stock') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link_tokopedia` varchar(255) DEFAULT NULL,
  `link_blibli` varchar(255) DEFAULT NULL,
  `link_shopee` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `brand_id` (`brand_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `name`, `description`, `price`, `stock_status`, `image`, `link_tokopedia`, `link_blibli`, `link_shopee`, `created_at`, `updated_at`) VALUES
(5, 3, 2, 'Ardhi', 'aa', 143.00, 'Out of Stock', 'Haliaeetus_leucogaster_-Gippsland,_Victoria,_Australia-8.jpg', NULL, NULL, NULL, '2024-12-13 07:28:41', '2024-12-13 07:28:41'),
(6, 4, 6, 'COMPUTER', 'asdasd', 124000.00, 'Available', 'sniff.png', NULL, NULL, NULL, '2024-12-13 08:45:29', '2024-12-13 08:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `search_logs`
--

DROP TABLE IF EXISTS `search_logs`;
CREATE TABLE IF NOT EXISTS `search_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123', 'admin@gmail.com', '2024-12-13 07:55:00', '2024-12-13 07:55:00'),
(4, 'tes', 'tes123', 'tes@gmail.com', '2024-12-13 09:00:15', '2024-12-13 10:21:44'),
(5, 'ibraZaki', 'ardhi123', 'email@email', '2024-12-13 10:28:58', '2024-12-13 10:28:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
