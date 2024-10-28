-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 01:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lexeatnaaaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `addproducts`
--

CREATE TABLE `addproducts` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addproducts`
--

INSERT INTO `addproducts` (`id`, `quantity`, `category`, `name`, `description`, `price`, `image`) VALUES
(2, 1, 'Heavy Meal', 'Sisig', '1htrrrthrh', 100, 'uploads/6716669b10dad_HD-wallpaper-backstreet-rookie-drama-kdrama-kim-yoo-jung-korea-saet-buyl.jpg'),
(3, 2, 'Heavy Meal', 'Tapsi', '2', 80, 'uploads/6716696ccfc03_93b779ff8167742c5aaa4538c3876c84.jpg'),
(4, 3, 'Drinks', 'Coke', '3', 20, 'uploads/6716645c0fcaf_1.webp'),
(5, 4, 'Add-ons', 'Rice', '4', 15, 'uploads/6716697a8f93c_7658359859b9c0096f5d40bb8d317e99.jpg'),
(6, 1, 'Heavy Meal', 'Cornsilog', '2', 60, 'uploads/67166f915d5b1_a2.jpg'),
(7, 2, 'Heavy Meal', 'Coke', '1htrrrthrh', 20, 'uploads/671774285c4e4_00352c745e82369c9355dada97943557.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Test', 'test@123.com', '463574745');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `customer_type` enum('registered','walk_in') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `total_price`, `customer_type`) VALUES
(1, 1, '2024-10-21 20:42:31', 20.00, 'registered'),
(2, 1, '2024-10-21 20:53:55', 20.00, 'walk_in'),
(3, NULL, '2024-10-21 20:55:04', 20.00, 'walk_in'),
(4, NULL, '2024-10-21 20:56:09', 20.00, 'walk_in'),
(5, NULL, '2024-10-21 20:56:20', 100.00, 'walk_in'),
(6, NULL, '2024-10-21 20:58:50', 80.00, 'walk_in'),
(13, NULL, '2024-10-21 21:07:22', 15.00, 'walk_in'),
(14, NULL, '2024-10-21 21:12:33', 35.00, 'walk_in'),
(15, NULL, '2024-10-21 21:15:38', 95.00, 'walk_in'),
(16, NULL, '2024-10-21 21:15:55', 115.00, 'walk_in'),
(17, NULL, '2024-10-21 21:18:23', 275.00, 'walk_in'),
(18, 1, '2024-10-21 21:18:30', 160.00, 'registered'),
(19, NULL, '2024-10-22 11:45:47', 455.00, 'walk_in');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_name`, `quantity`, `price`) VALUES
(15, 1, 'Sisig', 1, 100.00),
(16, 1, 'Tapsi', 1, 80.00),
(17, 1, 'Coke', 1, 20.00),
(18, 1, 'Cornsilog', 1, 60.00),
(19, 1, 'Rice', 1, 15.00),
(20, 5, 'Coke', 5, 20.00),
(21, 1, 'Coke', 1, 20.00),
(22, 2, 'Coke', 1, 20.00),
(23, 3, 'Coke', 1, 20.00),
(24, 4, 'Coke', 1, 20.00),
(25, 5, 'Sisig', 1, 100.00),
(26, 6, 'Coke', 1, 20.00),
(27, 6, 'Cornsilog', 1, 60.00),
(28, 13, 'Rice', 1, 15.00),
(29, 14, 'Rice', 1, 15.00),
(30, 14, 'Coke', 1, 20.00),
(31, 15, 'Coke', 1, 20.00),
(32, 15, 'Rice', 1, 15.00),
(33, 15, 'Cornsilog', 1, 60.00),
(34, 16, 'Sisig', 1, 100.00),
(35, 16, 'Rice', 1, 15.00),
(36, 17, 'Rice', 1, 15.00),
(37, 17, 'Sisig', 1, 100.00),
(38, 17, 'Cornsilog', 1, 60.00),
(39, 17, 'Tapsi', 1, 80.00),
(40, 17, 'Coke', 1, 20.00),
(41, 18, 'Tapsi', 1, 80.00),
(42, 18, 'Cornsilog', 1, 60.00),
(43, 18, 'Coke', 1, 20.00),
(44, 19, 'Coke', 1, 20.00),
(45, 19, 'Cornsilog', 1, 60.00),
(46, 19, 'Rice', 1, 15.00),
(47, 19, 'Sisig', 1, 100.00),
(48, 19, 'Tapsi', 3, 80.00),
(49, 19, 'Coke', 1, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addproducts`
--
ALTER TABLE `addproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addproducts`
--
ALTER TABLE `addproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
