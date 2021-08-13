-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2021 at 01:19 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redping`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_street_name` varchar(32) NOT NULL,
  `location_city` varchar(32) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `adjacent_location_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_street_name`, `location_city`, `latitude`, `longitude`, `adjacent_location_id`) VALUES
(1, 'Panacan Rd.', 'Davao', 7.150200, 125.659767, '2,3'),
(2, 'Sasa Rd.', 'Davao', 7.148060, 125.660744, '1,3'),
(3, 'Daan Maharlika High Way', 'Davao', 7.148380, 125.659348, '1,2'),
(4, 'San Miguel St.', 'Davao City', 7.151790, 125.656738, '1');

-- --------------------------------------------------------

--
-- Table structure for table `my_pins`
--

CREATE TABLE `my_pins` (
  `location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `my_pins`
--

INSERT INTO `my_pins` (`location_id`, `user_id`, `time`) VALUES
(2, 4, '06:00:00'),
(3, 1, '11:23:00'),
(1, 1, '11:37:00'),
(3, 3, '19:47:00'),
(2, 5, '20:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `location` varchar(32) NOT NULL,
  `reading` int(11) NOT NULL,
  `warning` varchar(200) NOT NULL,
  `noti_status` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `location`, `reading`, `warning`, `noti_status`, `time`) VALUES
(1, 'Cabaguio Ave', 25, 'Unsafe for Taxi\'s aand smaller vehicles', 1, '11:13:00'),
(2, 'J.P. Laurel Avenue', 12, 'Unsafe for motor bikes and smaller vehicles', 1, '11:15:00'),
(3, 'Cabaguio Ave', 25, 'Unsafe for Taxi\'s aand smaller vehicles', 1, '11:16:00'),
(4, 'J.P. Laurel Avenue', 12, 'Unsafe for motor bikes and smaller vehicles', 1, '11:17:00'),
(5, 'Cabaguio Ave', 25, 'Unsafe for Taxi\'s aand smaller vehicles', 1, '11:17:00'),
(6, 'J.P. Laurel Avenue', 12, 'Unsafe for motor bikes and smaller vehicles', 1, '11:20:00'),
(7, 'J.P. Laurel Avenue', 12, 'Unsafe for motor bikes and smaller vehicles', 1, '11:22:00'),
(8, 'Cabaguio Ave', 25, 'Unsafe for Taxi\'s aand smaller vehicles', 1, '11:23:00'),
(9, 'J.P. Laurel Avenue', 12, 'Unsafe for motor bikes and smaller vehicles', 1, '11:28:00'),
(10, 'J.P. Laurel Avenue', 12, 'Unsafe for motor bikes and smaller vehicles', 1, '11:37:00'),
(11, 'Daan Maharlika High Way', 23, 'Unsafe for Taxi\'s aand smaller vehicles', 1, '19:47:00'),
(12, 'Sasa Rd.', 6, 'Road is clear, drive ahead', 1, '20:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `readings`
--

CREATE TABLE `readings` (
  `id` int(11) NOT NULL,
  `location_id` int(32) NOT NULL,
  `reading` int(32) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `readings`
--

INSERT INTO `readings` (`id`, `location_id`, `reading`, `date_time`) VALUES
(13, 1, 10, '2021-08-10 10:30:02'),
(14, 2, 23, '2021-08-10 10:30:02'),
(15, 3, 6, '2021-08-10 10:30:02'),
(16, 4, 13, '2021-08-10 10:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `middle_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `province` varchar(32) NOT NULL,
  `street` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `my_pins` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `middle_name`, `last_name`, `username`, `city`, `province`, `street`, `password`, `my_pins`) VALUES
(1, 'Ji', 'Soo', 'Park', 'Jihyo', 'Davao', 'Davel del Sur', 'Inigo st.', '123456', '1'),
(4, 'ds', 'ds', 'ds', 'admin', 'as', 'g', 'g', '123456', NULL),
(5, 'Eugene', 'Lucagbo', 'Cortes', 'Yujin', 'Davao City', 'Davao del Sur', 'Malagamot Rd.', '1234', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `readings`
--
ALTER TABLE `readings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `readings`
--
ALTER TABLE `readings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
