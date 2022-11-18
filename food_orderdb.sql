-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2022 at 10:44 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_orderdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `rbl_order`
--

DROP TABLE IF EXISTS `rbl_order`;
CREATE TABLE IF NOT EXISTS `rbl_order` (
  `id` int(10) NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `order_date` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`, `status`) VALUES
(39, 'no', 'hannah', 'c20ad4d76fe97759aa27a0c99bff6710', ''),
(40, 'no', 'hanna', '202cb962ac59075b964b07152d234b70', '1'),
(41, 'Ra', 'Thida', 'c20ad4d76fe97759aa27a0c99bff6710', '1'),
(42, 'admin', 'admin', '123', '1'),
(43, 'hhhhh', 'moooo', '202cb962ac59075b964b07152d234b70', '1'),
(45, 'no sana', 'sana', '202cb962ac59075b964b07152d234b70', '1'),
(13, 'No Hannah', 'Hannah', 'Hannah', '1'),
(14, 'No Hannah', 'Hannah', 'Hannah', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(19, 'Amok khmer', 'Food_Category_757.jpeg', 'Yes', 'Yes'),
(14, 'Thai egg', 'Food_Category_792.jpg', 'Yes', 'Yes'),
(18, 'Pizza', 'Food_Category_467.jfif', 'Yes', 'Yes'),
(17, 'cacaca', 'Food_Category_24.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

DROP TABLE IF EXISTS `tbl_food`;
CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `category_id` int(10) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(15, 'spaghetti', 'spaghetti ', '20.00', 'Food_name47.jpeg', 14, 'Yes', 'Yes'),
(14, 'Rice ', 'Fried Rice', '12.00', 'Food_Category_216.jpg', 14, 'Yes', 'Yes'),
(7, 'Khmer rice noodle ', 'Khmer Rice noodle with curry', '14.00', 'Food_Category_381.jpg', 12, 'Yes', 'Yes'),
(10, 'Lunch set for Family', 'Medium set of Khmer transitional food', '20.00', 'Food_Category_957.jpg', 13, 'Yes', 'Yes'),
(9, 'Fish grial', 'food', '23.00', 'Food_Category_240.jpg', 12, 'Yes', 'Yes'),
(12, 'Noodle', 'banabanaaa', '10.00', 'Food_Category_200.jpg', 14, 'Yes', 'Yes'),
(16, 'Food', 'Khmer tranditional ', '12.00', 'Food_name114.jpg', 17, 'yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(5) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(15) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(150) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(7, 'hannahaaa', '12.00', 1, '12.00', '2012-10-22 00:00:00', 'ordered', 'No sana', '12345678', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, Phnom Penh'),
(16, 'hannahaaa', '12.00', 1, '12.00', '2012-10-22 00:00:00', 'ordered', 'No Hannah', '12345678', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, singapore'),
(17, 'hannahaaa', '12.00', 1, '12.00', '2012-10-22 00:00:00', 'ordered', 'No Hannah', '12345678', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, singapore'),
(18, 'a;ldaksdfja;', '20.00', 1, '20.00', '2022-10-13 00:00:00', 'ordered', 'No Hannah', '98323722', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, Phnom Penh'),
(19, 'pancake', '14.00', 3, '42.00', '2022-10-13 01:21:16', 'ordered', 'Ra thida', '98323722', 'rathida508@gmail.com', 'Corner Street 105/Street 276, Phnom Penh'),
(20, 'Lunch set for Family', '20.00', 1, '20.00', '2022-10-13 02:13:10', 'ordered', 'No Hannah', '98323722', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, Phnom Penh'),
(21, 'spaghetti', '20.00', 1, '20.00', '2022-10-13 03:30:05', 'ordered', 'No Hannah', '98323722', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, Phnom Penh'),
(22, 'Noodle', '10.00', 1, '10.00', '2022-10-13 03:32:03', 'ordered', 'Met chakriya', '12345678', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, Phnom Penh'),
(23, 'spaghetti', '20.00', 1, '20.00', '2014-10-22 02:08:31', 'On Delivery', 'No Hannah2', '98323722', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, Phnom Penh'),
(24, 'spaghetti', '20.00', 1, '20.00', '2014-10-22 02:08:19', 'Deliverd', 'No Hannah', '98323722', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, Phnom Penh'),
(26, 'Khmer rice noodle ', '14.00', 1, '14.00', '2022-10-14 03:01:41', 'ordered', 'No Hannah', '98323722', 'nohannah508@gmail.com', 'Corner Street 105/Street 276, Phnom Penh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
