-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2020 at 09:39 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `qty_item` int(11) NOT NULL,
  `price_item` float NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `item_id`, `invoice_no`, `qty_item`, `price_item`, `date_added`) VALUES
(1, 7, '316953', 1, 6.5, '2020-01-05'),
(2, 7, '316953', 1, 6.5, '2020-01-05'),
(3, 11, '316953', 1, 16, '2020-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `invoice_no`) VALUES
(1, '316953');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_price` float NOT NULL,
  `date_added` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`item_id`, `item_name`, `item_qty`, `item_price`, `date_added`) VALUES
(7, 'INDOMIE SMALL SIZE', 47, 6.5, '2019-07-11 15:42:36'),
(8, 'CHAMPAGNE', 0, 30, '2019-07-11 16:06:32'),
(9, 'DON SIMON', 0, 15, '2019-07-11 16:07:23'),
(10, 'DOVE SOAP', 28, 5, '2019-07-11 16:09:47'),
(11, 'MILO TIN', 6, 16, '2019-07-14 20:21:32'),
(12, 'TOOTH BRUSH', 10, 30, '2019-12-25 09:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_price` float NOT NULL,
  `sale_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`sale_id`, `item_id`, `invoice_no`, `item_qty`, `item_price`, `sale_date`) VALUES
(146, 9, '1', 1, 15, '2019-07-14'),
(148, 8, '3', 1, 30, '2019-07-14'),
(149, 9, '3', 1, 15, '2019-07-14'),
(150, 8, '3', 1, 30, '2019-07-14'),
(151, 9, '4', 1, 15, '2019-07-14'),
(152, 7, '5', 1, 6.5, '2019-07-14'),
(153, 11, '8', 1, 16, '2019-07-14'),
(154, 9, '8', 1, 15, '2019-07-14'),
(155, 8, '9', 5, 150, '2019-07-17'),
(156, 8, '9', 1, 30, '2019-07-17'),
(157, 8, '10', 1, 30, '2019-08-18'),
(158, 9, '10', 1, 15, '2019-08-18'),
(159, 8, '10', 1, 30, '2019-08-18'),
(160, 8, '11', 2, 60, '2019-09-07'),
(161, 8, '11', 1, 30, '2020-01-03'),
(163, 7, '12', 1, 6.5, '2020-01-03'),
(164, 7, '12', 1, 6.5, '2020-01-03'),
(165, 10, '263991', 2, 10, '2020-01-03'),
(166, 11, '13', 1, 16, '2020-01-03'),
(167, 7, '13', 1, 6.5, '2020-01-03'),
(169, 8, '427359', 1, 30, '2020-01-03'),
(170, 9, '427359', 1, 15, '2020-01-03'),
(172, 11, '427359', 1, 16, '2020-01-03'),
(173, 7, '427359', 1, 6.5, '2020-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplies`
--

CREATE TABLE `tbl_supplies` (
  `supplier_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_price` float NOT NULL,
  `the_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplies`
--

INSERT INTO `tbl_supplies` (`supplier_id`, `item_name`, `item_qty`, `item_price`, `the_date`) VALUES
(2, 'Cindy Rice', 6, 40, '2019-07-15'),
(4, 'INDOMIE SMALL SIZE', 50, 100, '2020-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp`
--

CREATE TABLE `tbl_temp` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty_item` int(11) NOT NULL,
  `price_item` float NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'Customer',
  `name` varchar(15) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `password`, `verified`) VALUES
(1, 'Administrator', 'Supervisor', 'admin', '$2y$10$MF3SU1fsOkBL/x72lyjlRuidrDDmmhL6Ht8NwHX0JubH2OUsNzxD.', 1),
(2, 'Customer', 'Kweku', 'user1', '$2y$10$APO8j4qQgvyJDKSLrfeUQOdn8UbSisuIFfnx6jkLqbpHRAWmeQu0O', 1),
(4, 'Administrator', 'Isaac Quarshie', 'ike', '$2y$10$9HjCW5SlNBROqrBeidYhf.Wd24pMhqdrKueJahuIZa3QhMvDsvyHC', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `tbl_supplies`
--
ALTER TABLE `tbl_supplies`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_temp`
--
ALTER TABLE `tbl_temp`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `tbl_supplies`
--
ALTER TABLE `tbl_supplies`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_temp`
--
ALTER TABLE `tbl_temp`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
