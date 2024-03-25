-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 03:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashion_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$uhN9BGfIMdP/vugVwWA4l.T4hbu5QZR66RzkpR6lPR4ayMTh0gLDC');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `prodID` int(11) NOT NULL,
  `prodColor` varchar(255) NOT NULL,
  `prodSize` varchar(255) NOT NULL,
  `rating` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `orderID`, `userID`, `prodID`, `prodColor`, `prodSize`, `rating`) VALUES
(1, 1, 6, 40, 'red', 'small', 1.6),
(18, 6, 2, 31, 'red', 'small', 0.0),
(19, 6, 2, 32, 'red', 'small', 0.0),
(20, 7, 2, 1, 'red', 'small', 5.0),
(21, 8, 2, 4, 'blue', 'small', 0.0),
(22, 9, 2, 4, 'blue', 'small', 0.0),
(23, 10, 2, 34, 'blue', 'small', 4.9),
(24, 13, 8, 32, 'red', 'small', 0.0),
(25, 13, 8, 21, 'green', 'small', 0.0),
(26, 13, 8, 26, 'blue', 'medium', 0.0),
(27, 14, 2, 33, 'red', 'medium', 0.0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_name`, `order_date`) VALUES
(1, 2, 'Array', '2023-10-25 19:34:42'),
(2, 2, 'Array', '2023-11-27 23:25:34'),
(3, 2, 'Array', '2023-11-27 23:25:34'),
(4, 2, 'Array', '2023-11-27 23:25:34'),
(5, 2, 'Array', '2023-11-27 23:28:06'),
(6, 2, 'Array', '2023-11-27 23:28:06'),
(7, 2, 'Array', '2023-11-27 23:30:04'),
(8, 2, 'Array', '2023-11-28 02:12:00'),
(9, 2, 'Array', '2023-11-28 02:12:37'),
(10, 2, 'Array', '2023-11-28 02:13:43'),
(11, 8, 'Array', '2023-11-28 02:20:09'),
(12, 8, 'Array', '2023-11-28 02:20:09'),
(13, 8, 'Array', '2023-11-28 02:20:09'),
(14, 2, 'Array', '2023-11-28 02:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `popularity` int(11) DEFAULT 0,
  `viewed` int(11) DEFAULT 0,
  `search_count` int(11) DEFAULT 0,
  `rate_count` int(11) DEFAULT 0,
  `rate_average` decimal(10,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category`, `popularity`, `viewed`, `search_count`, `rate_count`, `rate_average`) VALUES
(1, '1908', 'ROLEX', 1660.50, 'product1.jpg', 'Fashion accessories', 12, 2, 1, 1, 10.0),
(2, 'Cosmograph', 'ROLEX', 1219.00, 'product2.jpg', 'Fashion accessories', 3, 0, 17, 1, 7.0),
(3, 'Yacht-Master 42', 'ROLEX', 5680.99, 'Product3.jpg', 'Fashion accessories', 6, 0, 15, 0, 0.0),
(4, 'Sky-Dweller', 'ROLEX', 2129.00, 'Product4.jpg', 'Fashion accessories', 4, 0, 6, 0, 0.0),
(5, 'GMT-Master II', 'ROLEX', 5140.99, 'Product5.jpg', 'Fashion accessories', 0, 0, 15, 0, 0.0),
(6, 'Explorer 36', 'ROLEX', 1490.99, 'Product6.jpg', 'Fashion accessories', 0, 0, 5, 0, 0.0),
(7, 'Datejust 36', 'ROLEX', 4000.00, 'product7.jpg', 'Fashion accessories', 1, 0, 13, 0, 0.0),
(8, 'Day Date 40', 'ROLEX', 50000.00, 'product8.jpg', 'Fashion accessories', 6, 0, 12, 0, 0.0),
(9, 'Summit 3', 'Montblanc', 1200.00, 'product9.jpg\r\n', 'Fashion accessories', 0, 0, 1, 0, 0.0),
(10, '1858 Iced Tea', 'Montblanc', 1200.00, 'product10.jpg\r\n', 'Fashion accessories', 1, 0, 12, 0, 0.0),
(11, 'Rugged Revolt', 'Embrace the Adventure', 60.99, 'Shirt2.jpg', 'Mens Clothing', 0, 0, 1, 0, 0.0),
(12, 'Streetwise Nomad', ' City Vibes Only', 40.99, 'Shirt3.jpg', 'Mens Clothing', 0, 0, 12, 0, 0.0),
(13, 'Urban Maverick', 'Defying the Norm', 50.99, 'Shirt1.jpg', 'Mens Clothing', 4, 2, 19, 0, 0.0),
(14, 'Minds Unleashed', 'Unconventional Thinker', 30.99, 'Shirt4.jpg', 'Mens Clothing', 1, 0, 14, 0, 0.0),
(15, 'Gravity Igniter', 'Rise Above', 30.99, 'Shirt5.jpg', 'Mens Clothing', 0, 0, 13, 0, 0.0),
(16, 'Beyond Boundaries', 'Limitless Spirit', 30.99, 'Shirt6.jpg', 'Mens Clothing', 0, 0, 14, 0, 0.0),
(17, 'Chronicles of Courage', 'Fearless & Bold', 30.99, 'Shirt8.jpg', 'Mens Clothing', 1, 0, 12, 0, 0.0),
(18, 'Elysian Echo', 'Chase Your Dreams', 30.99, 'Shirt9.jpg', 'Mens Clothing', 1, 0, 12, 0, 0.0),
(19, 'Vivid Voyager', 'Roaming the Unknown', 30.99, 'Shirt10.jpg', 'Mens Clothing', 0, 0, 12, 0, 0.0),
(20, 'Nocturnal Nomad', 'Embrace the Night', 60.99, 'Shirt7.jpg', 'Mens Clothing', 0, 0, 11, 0, 0.0),
(21, 'Sapphire Serenity', 'Evening Gown Glam', 70.99, 'wShirt1.jpg', 'Womens Clothing', 2, 0, 17, 0, 0.0),
(22, 'Floral Whispers', 'Blossom Bloom Blouse', 70.99, 'wShirt2.jpg', 'Womens Clothing', 0, 0, 17, 0, 0.0),
(23, 'Dazzling Twilight', 'Velvet Visions Dress', 80.99, 'wShirt3.jpg', 'Womens Clothing', 0, 0, 11, 0, 0.0),
(24, 'Chic Cascade', 'Waterfall Ruffle Skirt', 70.99, 'wShirt4.jpg', 'Womens Clothing', 0, 0, 14, 0, 0.0),
(25, 'Moonlit Muse', 'Lace Overlay Romper', 70.99, 'wShirt5.jpg', 'Womens Clothing', 0, 0, 1, 0, 0.0),
(26, 'Radiant Reverie', 'Ethereal Maxi Dress', 70.99, 'wShirt6.jpg', 'Womens Clothing', 1, 0, 12, 0, 0.0),
(27, 'Lush Velvet Symphony', 'Midnight Jumpsuit', 100.99, 'wShirt7.jpg', 'Womens Clothing', 1, 0, 7, 0, 0.0),
(28, 'Mystic Mirage', 'Boho Chic Kimon', 90.99, 'wShirt8.jpg', 'Womens Clothing', 0, 0, 12, 0, 0.0),
(29, 'Whimsical Whirlwind', 'Tulle Twirl Skirt', 50.99, 'wShirt9.jpg', 'Womens Clothing', 0, 0, 12, 0, 0.0),
(30, 'Gilded Gardenia', 'Embroidered Elegance Top', 60.99, 'wShirt10.jpg', 'Womens Clothing', 0, 0, 11, 0, 0.0),
(31, 'Stealth Elegance', 'Midnight Explorer Tote', 200.99, 'Bag1.jpg', 'Bags', 13, 1, 13, 1, 9.0),
(32, 'Metro Maven', 'Cityscape Carryall', 200.99, 'Bag2.jpg', 'Bags', 22, 4, 12, 1, 9.4),
(33, 'Serenity Satchel', 'Zen-Inspired Organizer', 245.99, 'Bag3.jpg', 'Bags', 13, 5, 12, 1, 5.0),
(34, 'Retro Rendezvous', ' Vintage Vibes Backpack', 239.99, 'Bag4.jpg', 'Bags', 4, 1, 2, 1, 9.8),
(35, 'Azure Horizon', ' Oceanic Adventure Duffel', 230.99, 'Bag5.jpg', 'Bags', 15, 5, 11, 0, 0.0),
(36, 'Lunar Luxe', 'Celestial Chic Clutch', 220.99, 'Bag6.jpg', 'Bags', 1, 0, 11, 2, 3.0),
(37, 'Urban Nomad', 'Wanderlust Weekender', 289.99, 'Bag7.jpg', 'Bags', 3, 1, 13, 2, 3.5),
(38, 'Chronicle Carry', 'Timeless Traveler Bag', 269.99, 'Bag8.jpg', 'Bags', 1, 0, 11, 1, 6.6),
(39, 'Safari Chic', 'Exotic Expedition Tote', 270.99, 'Bag9.jpg', 'Bags', 1, 0, 12, 3, 3.2),
(40, 'Tech Trekker', 'Futuristic Functionality Messenger', 250.99, 'Bag10.jpg', 'Bags', 3, 0, 6, 4, 2.2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `address`) VALUES
(2, 'Test', '$2y$10$K/dV4ZKeVfPdozdYDF2GU.bWKvi9laB1ODTWOZ6pe2oCjiUsElFqW', 'Test test'),
(3, 'amirfaisal', '$2y$10$Q4FIjr0ERyjB8mZ1ImKtiupguQj376ZVOtxCfeLjfcpG73RWhcxb.', '100, Jalan Nowhere, United States of America, California, 41029, Malaysia'),
(4, 'PHPLogin', '$2y$10$jGd0oj54UK2Y3wpX/HW2pefWf4KG5JSnmjKpJszIJRjYUawcUFJky', 'Street:  391 Jalan Tesak\r\nCity:  Simpang Empat\r\nState/province/area:    Penang\r\nPhone number  604-5887363\r\nZip code  14120\r\nCountry  Malaysia'),
(5, 'Test2', '$2y$10$VIlnqhZTZkbHmcHvHjxV8ehvUnFxyDxPhBzT00oW3sCHW8Iy4r05y', 'testing'),
(6, 'tris', '$2y$10$TbiPWs78vFWkfGrgeqOwhuuW6SJRm3kQOwKVBKq3THxnJvDc03Afq', '10, JALAN 123'),
(7, 'lum', '$2y$10$7Mm4seEixvd1FfPx4Udn2uo6XWyT4aHMIvOjyP1XQ4LR0c71eiaMK', '10,jalan besar'),
(8, 'misswan', '$2y$10$Q0POgDXDKgrjlnoRiAJ.CeVsEqwhd06PaVDOFdYo5VGmlPiCAfLoi', 'Address');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
