-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2018 at 12:46 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_menu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_item`
--

CREATE TABLE `food_item` (
  `slno` int(11) NOT NULL,
  `food_title` varchar(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `food_image` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `views_no` int(11) NOT NULL,
  `rating` double NOT NULL,
  `food_type` varchar(20) NOT NULL,
  `food_category` varchar(20) NOT NULL,
  `isavailable` tinyint(1) NOT NULL,
  `isdelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_item`
--

INSERT INTO `food_item` (`slno`, `food_title`, `description`, `food_image`, `price`, `views_no`, `rating`, `food_type`, `food_category`, `isavailable`, `isdelete`) VALUES
(6, 'Dosa', 'nice    ra\r\n                         \r\n                         \r\n                         \r\n                         \r\n                         \r\n                         \r\n                         \r\n                         \r\n                         \r\n                         \r\n                         \r\n                         \r\n                     ', 'android.jpg', 15, 0, 0, 'Veg', 'Appetizers', 1, 0),
(7, 'Biriyani', 'nice    \r\n                     ', 'Android-logo.png', 150, 0, 0, 'Non-Veg', 'Appetizers', 0, 0),
(8, 'Roti', 'nice    \r\n                         \r\n                         \r\n                     ', 'Blank Diagram - Page 1.png', 120, 0, 0, 'Veg', 'Appetizers', 1, 0),
(10, 'Rotiggg', 'wfe', 'Android-logo.png', 150, 0, 0, 'Veg', 'Appetizers', 1, 0),
(11, 'tttt', 'rf', 'Android-Oreo_0.png', 150, 0, 0, 'Veg', 'Appetizers', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `placed_order`
--

CREATE TABLE `placed_order` (
  `slno` int(11) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `table_id` varchar(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isActive` tinyint(1) NOT NULL,
  `amount` double NOT NULL,
  `bill_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bill_passed_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placed_order`
--

INSERT INTO `placed_order` (`slno`, `customer_name`, `table_id`, `order_date`, `isActive`, `amount`, `bill_date`, `bill_passed_by`) VALUES
(1, 'Jai', 't1', '2018-02-23 13:16:14', 0, 0, '0000-00-00 00:00:00', ''),
(2, 'Jai', 't3', '2018-02-24 04:46:56', 0, 0, '0000-00-00 00:00:00', ''),
(3, 'Jai', 't3', '2018-02-24 05:10:41', 0, 0, '0000-00-00 00:00:00', ''),
(4, 'Jai', 't3', '2018-02-24 05:20:37', 0, 0, '0000-00-00 00:00:00', ''),
(5, 'Jai', 't3', '2018-02-24 05:28:49', 0, 0, '0000-00-00 00:00:00', ''),
(6, 'Jai', 't3', '2018-02-24 07:28:04', 0, 0, '0000-00-00 00:00:00', ''),
(7, 'Jai', 't3', '2018-02-24 08:59:04', 0, 0, '0000-00-00 00:00:00', ''),
(8, 'Jai', 't3', '2018-02-24 18:57:50', 0, 0, '0000-00-00 00:00:00', ''),
(9, 'Jai', 't2', '2018-02-24 16:31:44', 0, 0, '0000-00-00 00:00:00', ''),
(10, 'Jai', 't2', '2018-02-24 16:36:12', 0, 0, '0000-00-00 00:00:00', ''),
(11, 'Jai', 't2', '2018-02-24 18:24:33', 0, 0, '0000-00-00 00:00:00', ''),
(12, 'Jai', 't2', '2018-02-24 18:57:10', 0, 0, '0000-00-00 00:00:00', ''),
(13, 'Jai', 't2', '2018-02-25 05:44:30', 0, 0, '0000-00-00 00:00:00', ''),
(14, 'Jai', 't2', '2018-02-25 10:09:33', 0, 0, '0000-00-00 00:00:00', ''),
(15, 'Jai', 't2', '2018-02-25 10:16:17', 0, 0, '0000-00-00 00:00:00', ''),
(16, 'Jai', 't2', '2018-02-25 10:30:44', 0, 0, '2018-02-25 10:30:44', ''),
(17, 'Jai', 't2', '2018-02-25 10:35:02', 0, 0, '2018-02-25 10:35:02', 'jai@mine.com'),
(18, 'Jai', 't2', '2018-02-25 10:59:27', 0, 0, '2018-02-25 10:59:27', 'c@c'),
(19, 'Jai', 't2', '2018-02-26 09:19:19', 0, 0, '2018-02-26 09:19:19', 'jai@mine.com'),
(20, 'Jai', 't2', '2018-02-26 09:23:26', 0, 0, '2018-02-26 09:23:26', 'jai@mine.com'),
(21, 'J', 't2', '2018-02-27 10:51:55', 0, 0, '2018-02-27 10:51:55', 'c@c');

-- --------------------------------------------------------

--
-- Table structure for table `placed_order_items`
--

CREATE TABLE `placed_order_items` (
  `slno` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `process` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placed_order_items`
--

INSERT INTO `placed_order_items` (`slno`, `order_id`, `food_item_id`, `quantity`, `process`) VALUES
(3, 18, 6, 1, 0),
(4, 20, 6, 1, 1),
(5, 20, 7, 2, 1),
(6, 21, 7, 2, 1),
(7, 21, 8, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabs`
--

CREATE TABLE `tabs` (
  `slno` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `table_id` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `islogin` tinyint(1) NOT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `checkout_status` tinyint(1) NOT NULL,
  `water_req` tinyint(1) NOT NULL,
  `helper_req` tinyint(1) NOT NULL,
  `bowl_req` tinyint(1) NOT NULL,
  `isorder` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs`
--

INSERT INTO `tabs` (`slno`, `name`, `table_id`, `password`, `isactive`, `islogin`, `isdelete`, `checkout_status`, `water_req`, `helper_req`, `bowl_req`, `isorder`) VALUES
(18, 'Table1', 't1', '1234', 0, 0, 0, 0, 0, 0, 0, 0),
(19, 'Table2', 't2', '1234', 0, 1, 0, 0, 0, 0, 0, 0),
(20, 'Table3', 't3', '1234', 0, 1, 0, 0, 0, 0, 0, 0),
(21, 'Table4', 't4', '1234', 0, 0, 0, 0, 0, 0, 0, 0),
(22, 'Table5', 't5', '1234', 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `slno` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_type` varchar(20) NOT NULL,
  `isdelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`slno`, `user_name`, `mobile`, `email`, `password`, `create_date`, `user_type`, `isdelete`) VALUES
(1, 'Jai', 9000204595, 'jai@mine.com', '1234', '2018-02-19 10:28:25', 'Admin', 0),
(2, 'c', 9000204592, 'c@c', 'c', '2018-02-24 11:30:29', 'User', 0),
(3, 'a', 9000204592, 'a@a', 'A@b123456', '2018-02-24 11:28:31', 'Admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_item`
--
ALTER TABLE `food_item`
  ADD PRIMARY KEY (`slno`),
  ADD UNIQUE KEY `food_title` (`food_title`,`food_type`);

--
-- Indexes for table `placed_order`
--
ALTER TABLE `placed_order`
  ADD PRIMARY KEY (`slno`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `placed_order_items`
--
ALTER TABLE `placed_order_items`
  ADD PRIMARY KEY (`slno`) USING BTREE,
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_item_id` (`food_item_id`);

--
-- Indexes for table `tabs`
--
ALTER TABLE `tabs`
  ADD PRIMARY KEY (`slno`),
  ADD UNIQUE KEY `table_id` (`table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`slno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_item`
--
ALTER TABLE `food_item`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `placed_order`
--
ALTER TABLE `placed_order`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `placed_order_items`
--
ALTER TABLE `placed_order_items`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tabs`
--
ALTER TABLE `tabs`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `placed_order`
--
ALTER TABLE `placed_order`
  ADD CONSTRAINT `placed_order_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `tabs` (`table_id`) ON UPDATE CASCADE;

--
-- Constraints for table `placed_order_items`
--
ALTER TABLE `placed_order_items`
  ADD CONSTRAINT `placed_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `placed_order` (`slno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `placed_order_items_ibfk_2` FOREIGN KEY (`food_item_id`) REFERENCES `food_item` (`slno`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
