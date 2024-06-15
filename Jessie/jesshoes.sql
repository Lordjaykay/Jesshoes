-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 12:14 PM
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
-- Database: `jesshoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'johndoe@gmail.com', '$2y$10$JHFh/g6iQHaXZLElqYI6AOm7eS0dokyse2/lN1CcAhe2U1gTfGHvO');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cart_data` text NOT NULL,
  `total_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `email`, `address`, `cart_data`, `total_amount`) VALUES
(4, 'John Doe', 'johndoe@gmail.com', 'Police Estate, Kurudu', 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"5\";s:12:\"product_name\";s:12:\"Addidas Shoe\";s:13:\"product_image\";N;s:12:\"product_size\";s:1:\"L\";s:13:\"product_price\";s:5:\"23000\";s:8:\"quantity\";i:1;}}', '23000'),
(5, 'Abc', 'abc@gmail.com', 'Abc, Nigeria', 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"6\";s:12:\"product_name\";s:8:\"Sneakers\";s:13:\"product_image\";N;s:12:\"product_size\";s:2:\"XL\";s:13:\"product_price\";s:5:\"20000\";s:8:\"quantity\";i:2;}}', '40000'),
(6, 'Abc', 'abc@gmail.com', 'Abc, Nigeria', 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"29\";s:12:\"product_name\";s:5:\"boots\";s:13:\"product_image\";N;s:12:\"product_size\";s:0:\"\";s:13:\"product_price\";s:5:\"30000\";s:8:\"quantity\";i:1;}}', '30000'),
(7, 'Abc', 'abc@gmail.com', 'Abc, Nigeria', 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"13\";s:12:\"product_name\";s:8:\"Sneakers\";s:13:\"product_image\";N;s:12:\"product_size\";s:0:\"\";s:13:\"product_price\";s:5:\"25000\";s:8:\"quantity\";i:1;}}', '25000');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_img`, `product_name`, `product_category`, `product_price`, `product_desc`) VALUES
(6, '1714469977shoe1.jpg.jpg', 'Sneakers', 'Sneakers', '20000', 'old school vans'),
(7, '1714470015shoe2.jpg.jpg', 'Another sneaker', 'Sneakers', '23000', 'Air force one pink'),
(8, '1714470081broque.jpg.jpg', 'Brogues', 'Brogues', '15200', 'Brown brogues'),
(9, '1714470128brq.jpg.jpg', 'Brogues', 'Brogues', '19999', 'Plain brogues\r\n'),
(10, '1714470242brq1.jpg.jpg', 'Brogues', 'Brogues', '25000', 'Spotted brogues\r\n'),
(11, '1714470283brq 2.jpg.jpg', 'Brogues', 'Brogues', '17999', 'PLain brown brogues'),
(12, '1714470325brq 3.jpg.jpg', 'Brogues', 'Brogues', '9900', 'Black and white brogues'),
(13, '1714470427sneak.jpg.jpg', 'Sneakers', 'Sneakers', '25000', 'Nike black and white airforce ones\\r\\n'),
(14, '1714470476af4.jpg.jpg', 'Sneakers', 'Sneakers', '17900', 'Orange nike Airmax'),
(15, '1714470648af3.jpg.jpg', 'sneakers', 'Sneakers', '15500', 'Black Spotted Nike Zoom'),
(16, '1714469065af2.jpg', 'sneakers', 'Sneakers', '13000', 'Lorem ipsum dolor sit amet'),
(17, '1714469117af1.jpg', 'sneakers', 'Sneakers', '15000', 'Lorem ipsum dolor sit amet'),
(18, '1714469322fb1.jpg', 'cleats', 'Cleats', '15000', 'Lorem ipsum dolor sit amet\r\n'),
(19, '1714469357fb2.jpg', 'cleats', 'Cleats', '40000', 'Lorem ipsum dolor sit amet\r\n'),
(20, '1714469410fb3.jpg', 'cleats', 'Cleats', '35000', 'Lorem ipsum dolor sit amet'),
(21, '1714469582fb4.jpg', 'cleats', 'Brogues', '19999', 'Lorem ipsum dolor sit amet'),
(22, '1714469869fb4.jpg', 'Cleats', 'Cleats', '25000', 'Lorem ipsum dolor sit amet'),
(23, '1714470752fb5.jpg', 'cleats', 'Cleats', '30000', 'Puma boot'),
(24, '1714470937h1.jpg', 'block heel', 'Block heels', '21500', 'Fang Kenneth Beautiful Ladies Block Heel Slippers-Black\r\n'),
(25, '1714470990h2.jpg', 'Block heels', 'Block heels', '22500', 'Elegant Ladies Block Heel Sandals'),
(26, '1714471060h4.jpg', 'block heels', 'Block heels', '21999', 'Lovely Ladies Vintage Block Heel Slippers'),
(27, '1714471167b1.jpg', 'boots', 'Boots', '15000', 'Brown boots'),
(28, '1714471200b3.jpg', 'boots', 'Boots', '25000', 'brown heel boot'),
(29, '1714471244b4.jpg', 'boots', 'Boots', '30000', 'Black heel boot'),
(30, '1714471340b9.jpg', 'boots', 'Boots', '23000', 'Martin boots for men - Black');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `address`, `phone`, `password`) VALUES
(1, 'John Doe', 'johndoe@gmail.com', 'Police Estate, Kurudu', '08002467990', '$2y$10$4nwUhj5Ub4VB2q3gfRcG3O/1weE.ysohtjaX/IhrSWGNLHVvbvr9G'),
(2, 'Abc', 'abc@gmail.com', 'Abc, Nigeria', '08134567890', '$2y$10$f5kq.rswtpMsJgjT7yEbNulOPcoR0CJ61Rd68Z/J0JVGrRgVyZsca');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
