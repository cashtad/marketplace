-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2024 at 08:54 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-store-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Electronics', 'Electronic gadgets and devices'),
(2, 'Clothing', 'Fashion and apparel'),
(3, 'Books', 'Literary works and publications');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `available` char(1) NOT NULL,
  `category_category_id` int(11) NOT NULL,
  `picture` varchar(300) DEFAULT NULL,
  `users_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `description`, `price`, `available`, `category_category_id`, `picture`, `users_user_id`) VALUES
(17, 'Camera', 'The best camera', 1000, 'Y', 1, 'application/uploads/659bee372e578_camera.png', 3),
(18, 'Bogatiy papa ', 'The best book ', 10, 'Y', 3, 'application/uploads/659bee8e5541a_119256.jpg', 3),
(19, 'Computer ', 'New office PC with processor i3-123012, integrated GPU, 8 GB of Ram', 400, 'N', 1, 'application/uploads/659bf33e99475_desktop-computer.jpg', 3),
(20, 'Hoodie', 'Blue hoodie maded with nice and soft materials', 20, 'Y', 2, 'application/uploads/659bf4077e79c_fcb87a43633c4f52b9c6fc59720e362e.webp', 3),
(21, 'T-Shirt Grey', 'Casual t-shirt 100% cotton', 10, 'Y', 2, 'application/uploads/659bf44d55522_KS0KS00210_P01_alternate1.webp', 3),
(22, 'Laptop Gaming', 'Asus ROG Strix G15 Gaming laptop', 1500, 'Y', 1, 'application/uploads/659bf4894fcc4_61BuT2yTQ6S._AC_SL1500_.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `item_lists`
--

CREATE TABLE `item_lists` (
  `item_list_id` int(11) NOT NULL,
  `amount` varchar(45) NOT NULL,
  `orders_order_id` int(11) NOT NULL,
  `items_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_lists`
--

INSERT INTO `item_lists` (`item_list_id`, `amount`, `orders_order_id`, `items_item_id`) VALUES
(8, '2', 14, 17),
(9, '1', 14, 18),
(10, '1', 15, 18),
(11, '1', 15, 17),
(12, '1', 15, 22),
(13, '1', 16, 20),
(14, '1', 16, 21),
(15, '1', 17, 20),
(16, '1', 17, 21),
(17, '1', 18, 20),
(18, '1', 18, 21);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `total_cost` varchar(45) DEFAULT NULL,
  `users_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `date_creation`, `status`, `total_cost`, `users_user_id`) VALUES
(14, '2024-01-08', 'Processing', '2010', 4),
(15, '2024-01-08', 'Processing', '2510', 9),
(16, '2024-01-08', 'Processing', '30', 4),
(17, '2024-01-08', 'Processing', '30', 4),
(18, '2024-01-08', 'Processing', '30', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `name`, `role`, `verified`, `address`, `city`, `registration_date`) VALUES
(1, 'john@example.com', '$2y$10$0Acq/fMCWeqz8gZYuMo/k.BM3UQ/c6ZdB4QYVMlokfV3OBXiRCs.2', 'John Doe', 1, 1, '123 Main St', 'City1', '2022-01-01'),
(2, 'jane@example.com', '$2y$10$TG0umPELQtDY/z39MDGHKOKZu1/BQMc6HqP4QRQPX2ssFPIqkYsqS', 'Jane Smith', 1, 1, '456 Oak St', 'City2', '2022-02-01'),
(3, 'bob@example.com', '$2y$10$pKUXJs4n09PyhI1o2vPc2ufRwrmXL09eBTiHdsGda508HnCnBrG2u', 'Bob Seller', 2, 1, '789 Pine St', 'City3', '2022-03-01'),
(4, 'lemalaxz2@gmail.com', '$2y$10$nNAW.PuroSzsp0TkgK/eZusUJaCr5P8RtWbc9wC8VNuWn1N/VIAeC', 'Leonid Malakhov', 1, 1, '', '', '2024-01-05'),
(5, 'cashtad@gmail.com', '$2y$10$ZmUJlmAk3FuLOEC8Wf508euxdylr9bRh5yd0wMbr/GkZ0JdbCXDNK', 'Leonid Chehov', 1, 1, '', '', '2024-01-05'),
(6, 'tets@test.test', '$2y$10$OQfg8sUsScEVNExjxPi..eRd2TGfjIUq00HfUW4Rjj09dbSzGtvRC', 'Leonid Test', 1, 1, NULL, NULL, '2024-01-05'),
(7, 'seller@test.com', '$2y$10$zf/9fEAmaXdv/ibl0RRqd.FUK3b6J4CbEVDuzSW8o7funHh1EtuRi', 'Seller test', 2, 1, '', '', '2024-01-05'),
(8, 'admin@gmail.com', '$2y$10$K44E2XwopyPP8d5py0CC6./NokkK1Zbv.CP/fRDaKtxufk7BMLBBe', 'Admin', 3, 1, NULL, NULL, '2024-01-05'),
(9, 'denis@gmail.com', '$2y$10$EalNmwgT5bdVMfnWiHq20OUmokL0Q3VdhpwLKRvIwongduSixXI.i', 'Denis Bebrin', 1, 1, NULL, NULL, '2024-01-08'),
(10, 'denis@gmail.com', '$2y$10$hcJXeqmtjfk5.uGl3k0Er.mt.uvELhc95jB/HoJFyrknyPtOlfQ.K', 'Denis Bebrin', 1, 1, NULL, NULL, '2024-01-08'),
(11, 'denis@gmail.com', '$2y$10$4teZLVzvW5SsDydjxghZS.81bqm7uCOclbAYGg4zD1mw84pmTmpAu', 'Denis Bebrin', 1, 1, NULL, NULL, '2024-01-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id_UNIQUE` (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_id_UNIQUE` (`item_id`),
  ADD KEY `item_category_fk` (`category_category_id`),
  ADD KEY `fk_items_users1_idx` (`users_user_id`);

--
-- Indexes for table `item_lists`
--
ALTER TABLE `item_lists`
  ADD PRIMARY KEY (`item_list_id`,`items_item_id`),
  ADD UNIQUE KEY `item_list_id_UNIQUE` (`item_list_id`),
  ADD KEY `fk_item_lists_orders_idx` (`orders_order_id`),
  ADD KEY `fk_item_lists_items1_idx` (`items_item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`,`users_user_id`),
  ADD UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  ADD KEY `fk_orders_users1_idx` (`users_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `item_lists`
--
ALTER TABLE `item_lists`
  MODIFY `item_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_category_fk` FOREIGN KEY (`category_category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `item_lists`
--
ALTER TABLE `item_lists`
  ADD CONSTRAINT `fk_item_lists_items1` FOREIGN KEY (`items_item_id`) REFERENCES `items` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_lists_orders` FOREIGN KEY (`orders_order_id`) REFERENCES `orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
