-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2021 at 03:53 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_tbl`
--

CREATE TABLE `client_tbl` (
  `cli_id` int(11) NOT NULL,
  `cli_name` text NOT NULL,
  `cli_mail` text NOT NULL,
  `cli_amt` text NOT NULL,
  `cli_open_deposit` text NOT NULL,
  `cli_doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `cli_dom` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `cli_status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_tbl`
--

INSERT INTO `client_tbl` (`cli_id`, `cli_name`, `cli_mail`, `cli_amt`, `cli_open_deposit`, `cli_doc`, `cli_dom`, `cli_status`) VALUES
(1, 'Suraj Das', 'suraj@gmail.com', '9000', '1000', '2021-04-15 17:10:11', '2021-04-18 13:50:18', 'ACTIVE'),
(3, 'Amar Das', 'amar@gmail.com', '7501', '1000', '2021-04-15 17:17:19', '2021-04-18 07:36:53', 'ACTIVE'),
(20, 'Rohan ', 'rohan@gmail.com', '499', '1000', '2021-04-18 05:38:58', '2021-04-18 13:51:40', 'INACTIVE'),
(22, 'Mohan Kumar', 'mohan@gmail.com', '4000', '5000', '2021-04-18 13:49:56', '2021-04-18 13:50:18', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_tbl`
--

CREATE TABLE `transfer_tbl` (
  `trns_id` int(11) NOT NULL,
  `trns_amt` text NOT NULL,
  `trns_sender` text NOT NULL,
  `trns_receiver` text NOT NULL,
  `trns_msg` longtext NOT NULL,
  `trns_doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `trns_dom` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `trns_status` enum('SUCCESS','FAIL','NONE') NOT NULL DEFAULT 'NONE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer_tbl`
--

INSERT INTO `transfer_tbl` (`trns_id`, `trns_amt`, `trns_sender`, `trns_receiver`, `trns_msg`, `trns_doc`, `trns_dom`, `trns_status`) VALUES
(2, '1000', '1', '3', 'ttvvb vvcbvcb', '2021-04-17 07:40:02', '2021-04-18 07:36:35', 'SUCCESS'),
(3, '1000', '1', '3', 'sfsdfsdf sdfsdfds', '2021-04-17 07:42:00', '2021-04-18 07:36:35', 'SUCCESS'),
(4, '1000', '1', '3', ' sdfdsf sdfsdf sdfds fsdfdsfdsf', '2021-04-17 07:42:35', '2021-04-18 07:36:35', 'SUCCESS'),
(5, '4000', '1', '3', 'as dsa dsadsadsa', '2021-04-17 07:44:33', '2021-04-18 07:36:35', 'SUCCESS'),
(6, '1000', '3', '1', '', '2021-04-17 09:11:31', '2021-04-18 07:36:35', 'SUCCESS'),
(7, '1500', '3', '1', '', '2021-04-17 09:11:40', '2021-04-18 07:36:35', 'SUCCESS'),
(8, '501', '20', '1', 'abc', '2021-04-18 05:40:03', '2021-04-18 07:36:35', 'SUCCESS'),
(9, '2500', '3', '1', 'asd asdasdas', '2021-04-18 07:33:20', '2021-04-18 07:36:35', 'SUCCESS'),
(10, '500', '3', '1', 'asd asdsa', '2021-04-18 07:33:58', '2021-04-18 07:33:58', 'SUCCESS'),
(11, '1001', '1', '3', 'asd asdsad', '2021-04-18 07:36:52', '2021-04-18 07:36:53', 'SUCCESS'),
(12, '1000', '22', '1', 'fhg g', '2021-04-18 13:50:17', '2021-04-18 13:50:18', 'SUCCESS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_tbl`
--
ALTER TABLE `client_tbl`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indexes for table `transfer_tbl`
--
ALTER TABLE `transfer_tbl`
  ADD PRIMARY KEY (`trns_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_tbl`
--
ALTER TABLE `client_tbl`
  MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transfer_tbl`
--
ALTER TABLE `transfer_tbl`
  MODIFY `trns_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
