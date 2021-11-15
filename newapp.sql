-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2021 at 11:43 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newapp`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `fill_calendar` (`start_date` DATE, `end_date` DATE)  BEGIN
  DECLARE crt_date DATE;
  SET crt_date=start_date;
  WHILE crt_date < end_date DO
    INSERT INTO calendar VALUES(crt_date);
    SET crt_date = ADDDATE(crt_date, INTERVAL 1 DAY);
  END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE `adminusers` (
  `id` int(5) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Bhanuvidh', 'Mansinghani', 'bhanuvidh@skywavetechnologies.com', '05aa5cc7ee3ecd9397ce35edc7b4b3d3');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `datefield` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`datefield`) VALUES
('2021-01-01'),
('2021-01-02'),
('2021-01-03'),
('2021-01-04'),
('2021-01-05'),
('2021-01-06'),
('2021-01-07'),
('2021-01-08'),
('2021-01-09'),
('2021-01-10'),
('2021-01-11'),
('2021-01-12'),
('2021-01-13'),
('2021-01-14'),
('2021-01-15'),
('2021-01-16'),
('2021-01-17'),
('2021-01-18'),
('2021-01-19'),
('2021-01-20'),
('2021-01-21'),
('2021-01-22'),
('2021-01-23'),
('2021-01-24'),
('2021-01-25'),
('2021-01-26'),
('2021-01-27'),
('2021-01-28'),
('2021-01-29'),
('2021-01-30'),
('2021-01-31'),
('2021-02-01'),
('2021-02-02'),
('2021-02-03'),
('2021-02-04'),
('2021-02-05'),
('2021-02-06'),
('2021-02-07'),
('2021-02-08'),
('2021-02-09'),
('2021-02-10'),
('2021-02-11'),
('2021-02-12'),
('2021-02-13'),
('2021-02-14'),
('2021-02-15'),
('2021-02-16'),
('2021-02-17'),
('2021-02-18'),
('2021-02-19'),
('2021-02-20'),
('2021-02-21'),
('2021-02-22'),
('2021-02-23'),
('2021-02-24'),
('2021-02-25'),
('2021-02-26'),
('2021-02-27'),
('2021-02-28'),
('2021-03-01'),
('2021-03-02'),
('2021-03-03'),
('2021-03-04'),
('2021-03-05'),
('2021-03-06'),
('2021-03-07'),
('2021-03-08'),
('2021-03-09'),
('2021-03-10'),
('2021-03-11'),
('2021-03-12'),
('2021-03-13'),
('2021-03-14'),
('2021-03-15'),
('2021-03-16'),
('2021-03-17'),
('2021-03-18'),
('2021-03-19'),
('2021-03-20'),
('2021-03-21'),
('2021-03-22'),
('2021-03-23'),
('2021-03-24'),
('2021-03-25'),
('2021-03-26'),
('2021-03-27'),
('2021-03-28'),
('2021-03-29'),
('2021-03-30'),
('2021-03-31'),
('2021-04-01'),
('2021-04-02'),
('2021-04-03'),
('2021-04-04'),
('2021-04-05'),
('2021-04-06'),
('2021-04-07'),
('2021-04-08'),
('2021-04-09'),
('2021-04-10'),
('2021-04-11'),
('2021-04-12'),
('2021-04-13'),
('2021-04-14'),
('2021-04-15'),
('2021-04-16'),
('2021-04-17'),
('2021-04-18'),
('2021-04-19'),
('2021-04-20'),
('2021-04-21'),
('2021-04-22'),
('2021-04-23'),
('2021-04-24'),
('2021-04-25'),
('2021-04-26'),
('2021-04-27'),
('2021-04-28'),
('2021-04-29'),
('2021-04-30'),
('2021-05-01'),
('2021-05-02'),
('2021-05-03'),
('2021-05-04'),
('2021-05-05'),
('2021-05-06'),
('2021-05-07'),
('2021-05-08'),
('2021-05-09'),
('2021-05-10'),
('2021-05-11'),
('2021-05-12'),
('2021-05-13'),
('2021-05-14'),
('2021-05-15'),
('2021-05-16'),
('2021-05-17'),
('2021-05-18'),
('2021-05-19'),
('2021-05-20'),
('2021-05-21'),
('2021-05-22'),
('2021-05-23'),
('2021-05-24'),
('2021-05-25'),
('2021-05-26'),
('2021-05-27'),
('2021-05-28'),
('2021-05-29'),
('2021-05-30'),
('2021-05-31'),
('2021-06-01'),
('2021-06-02'),
('2021-06-03'),
('2021-06-04'),
('2021-06-05'),
('2021-06-06'),
('2021-06-07'),
('2021-06-08'),
('2021-06-09'),
('2021-06-10'),
('2021-06-11'),
('2021-06-12'),
('2021-06-13'),
('2021-06-14'),
('2021-06-15'),
('2021-06-16'),
('2021-06-17'),
('2021-06-18'),
('2021-06-19'),
('2021-06-20'),
('2021-06-21'),
('2021-06-22'),
('2021-06-23'),
('2021-06-24'),
('2021-06-25'),
('2021-06-26'),
('2021-06-27'),
('2021-06-28'),
('2021-06-29'),
('2021-06-30'),
('2021-07-01'),
('2021-07-02'),
('2021-07-03'),
('2021-07-04'),
('2021-07-05'),
('2021-07-06'),
('2021-07-07'),
('2021-07-08'),
('2021-07-09'),
('2021-07-10'),
('2021-07-11'),
('2021-07-12'),
('2021-07-13'),
('2021-07-14'),
('2021-07-15'),
('2021-07-16'),
('2021-07-17'),
('2021-07-18'),
('2021-07-19'),
('2021-07-20'),
('2021-07-21'),
('2021-07-22'),
('2021-07-23'),
('2021-07-24'),
('2021-07-25'),
('2021-07-26'),
('2021-07-27'),
('2021-07-28'),
('2021-07-29'),
('2021-07-30'),
('2021-07-31'),
('2021-08-01'),
('2021-08-02'),
('2021-08-03'),
('2021-08-04'),
('2021-08-05'),
('2021-08-06'),
('2021-08-07'),
('2021-08-08'),
('2021-08-09'),
('2021-08-10'),
('2021-08-11'),
('2021-08-12'),
('2021-08-13'),
('2021-08-14'),
('2021-08-15'),
('2021-08-16'),
('2021-08-17'),
('2021-08-18'),
('2021-08-19'),
('2021-08-20'),
('2021-08-21'),
('2021-08-22'),
('2021-08-23'),
('2021-08-24'),
('2021-08-25'),
('2021-08-26'),
('2021-08-27'),
('2021-08-28'),
('2021-08-29'),
('2021-08-30'),
('2021-08-31'),
('2021-09-01'),
('2021-09-02'),
('2021-09-03'),
('2021-09-04'),
('2021-09-05'),
('2021-09-06'),
('2021-09-07'),
('2021-09-08'),
('2021-09-09'),
('2021-09-10'),
('2021-09-11'),
('2021-09-12'),
('2021-09-13'),
('2021-09-14'),
('2021-09-15'),
('2021-09-16'),
('2021-09-17'),
('2021-09-18'),
('2021-09-19'),
('2021-09-20'),
('2021-09-21'),
('2021-09-22'),
('2021-09-23'),
('2021-09-24'),
('2021-09-25'),
('2021-09-26'),
('2021-09-27'),
('2021-09-28'),
('2021-09-29'),
('2021-09-30'),
('2021-10-01'),
('2021-10-02'),
('2021-10-03'),
('2021-10-04'),
('2021-10-05'),
('2021-10-06'),
('2021-10-07'),
('2021-10-08'),
('2021-10-09'),
('2021-10-10'),
('2021-10-11'),
('2021-10-12'),
('2021-10-13'),
('2021-10-14'),
('2021-10-15'),
('2021-10-16'),
('2021-10-17'),
('2021-10-18'),
('2021-10-19'),
('2021-10-20'),
('2021-10-21'),
('2021-10-22'),
('2021-10-23'),
('2021-10-24'),
('2021-10-25'),
('2021-10-26'),
('2021-10-27'),
('2021-10-28'),
('2021-10-29'),
('2021-10-30'),
('2021-10-31'),
('2021-11-01'),
('2021-11-02'),
('2021-11-03'),
('2021-11-04'),
('2021-11-05'),
('2021-11-06'),
('2021-11-07'),
('2021-11-08'),
('2021-11-09'),
('2021-11-10'),
('2021-11-11'),
('2021-11-12'),
('2021-11-13'),
('2021-11-14'),
('2021-11-15'),
('2021-11-16'),
('2021-11-17'),
('2021-11-18'),
('2021-11-19'),
('2021-11-20'),
('2021-11-21'),
('2021-11-22'),
('2021-11-23'),
('2021-11-24'),
('2021-11-25'),
('2021-11-26'),
('2021-11-27'),
('2021-11-28'),
('2021-11-29'),
('2021-11-30'),
('2021-12-01'),
('2021-12-02'),
('2021-12-03'),
('2021-12-04'),
('2021-12-05'),
('2021-12-06'),
('2021-12-07'),
('2021-12-08'),
('2021-12-09'),
('2021-12-10'),
('2021-12-11'),
('2021-12-12'),
('2021-12-13'),
('2021-12-14'),
('2021-12-15'),
('2021-12-16'),
('2021-12-17'),
('2021-12-18'),
('2021-12-19'),
('2021-12-20'),
('2021-12-21'),
('2021-12-22'),
('2021-12-23'),
('2021-12-24'),
('2021-12-25'),
('2021-12-26'),
('2021-12-27'),
('2021-12-28'),
('2021-12-29'),
('2021-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(5) NOT NULL,
  `Group_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `Group_name`) VALUES
(1, 'No Group');

-- --------------------------------------------------------

--
-- Table structure for table `item_sales`
--

CREATE TABLE `item_sales` (
  `sale_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `sale_quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_sales`
--

INSERT INTO `item_sales` (`sale_id`, `prod_id`, `date`, `sale_quantity`, `size`, `sale_price`) VALUES
(1, 1, '2021-11-15 16:34:43', 2, 12, 230);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(5) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Quantity` int(45) NOT NULL,
  `Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Name`, `Quantity`, `Price`) VALUES
(1, 'Shirt', 10, '350');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(5) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'Regular user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(45) NOT NULL,
  `group_id` int(45) NOT NULL,
  `token` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `role_id`, `group_id`, `token`) VALUES
(1, 'Bhanu', 'Mansinghani', 'bhanuvidh@skywavetechnologies.com', '30124f67b708b1893c62462a3b906a22', 1, 1, 1719982201),
(11, 'Arunvidh', 'Mansinghani', 'arun@gmail.com', '30124f67b708b1893c62462a3b906a22', 2, 1, 0),
(12, 'B', 'M', 'bhanu@skywavetechnologies.com', '30124f67b708b1893c62462a3b906a22', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminusers`
--
ALTER TABLE `adminusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_sales`
--
ALTER TABLE `item_sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminusers`
--
ALTER TABLE `adminusers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_sales`
--
ALTER TABLE `item_sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
