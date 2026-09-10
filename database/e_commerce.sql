-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2026 at 09:52 PM
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
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `image`) VALUES
(1, 'Electronics', 'images/electronics.jpeg'),
(2, 'Bags', 'images/bags.jpeg'),
(3, 'Accessories', 'images/accessories.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `description`, `image`, `category_id`) VALUES
(1, 'Wireless Headpone', 1200.00, 'High quality wireless headphones', 'images/wirelessheadphone.jpg', 1),
(2, 'iphone 13 pro max', 35000.00, 'iphone with new features.', 'images/iphone13promax.jpg', 1),
(3, 'Earbuds', 2000.00, 'earbuds with Fast Charge, Clear Sound', 'images/airbods.jpg', 1),
(4, 'Laptop Bag', 1200.00, 'Simple and Comfortable laptop bag.', 'images/laptopbag.jpg', 2),
(5, 'Crossbody Bag', 600.00, 'Large Capacity and Stylish Crossbody Bag.', 'images/crossbodybag.jpg', 2),
(6, 'Backbag', 2000.00, 'Lightweight, Perfect for Daily Use and Travel', 'images/backbag.jpg', 2),
(7, 'Hand Chain', 200.00, 'Gold Plated Link with Finger Ring Bracelet.', 'images/handchain.jpg', 3),
(8, 'Rings', 600.00, 'Set of 6 stylish Golden rings.', 'images/rings.jpg', 3),
(9, 'Necklace', 2000.00, 'Yellow Gold Round Necklace with Shiny Stones', 'images/goldnecklace.jpg', 3),
(10, 'Golden Brooches', 500.00, 'Golden Ocean Brooch Set Seashell, Starfish and Sun.', 'images/goldbrouche.jpg', 3),
(11, 'Phone Cover', 300.00, 'Slim Liquid Silicone 3 Layers Full Covered Soft Gel Rubber.', 'images/phonecover.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `password`, `phone`) VALUES
(1, 'Malk', 'malknegm671@gmail.com', '$2y$10$kieOO/UxTrYjJHUWHrcDKOx5XkgEJjhMoBjy2C1gFLp2PinXvGNSW', '01025091908'),
(4, 'Malk', 'malk@gmail.com', '$2y$10$rrs3nk8T4F0q/ut/t8ctmOMRU7IBHam8Pi7iyCvUy9lSMTTUI5eJO', '01025091908'),
(6, 'malk', 'test@gmail.com', '$2y$10$keL7ooSmWTYLY4uh610dXut7BsVcbyWH9ED2yz5KTBTk.stk6JGOq', '01025091908');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
