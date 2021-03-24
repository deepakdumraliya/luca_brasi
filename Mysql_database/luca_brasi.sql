-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 02:36 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luca_brasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_auth`
--

CREATE TABLE `api_auth` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api_auth`
--

INSERT INTO `api_auth` (`id`, `username`, `password`) VALUES
(1, 'f352e3ad70988bbdc547ec437713cf18', 'f352e3ad70988bbdc547ec437713cf18');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `name`, `created`, `modified`) VALUES
(1, 'Saputara', '2021-03-24 11:26:19', '0000-00-00 00:00:00'),
(2, 'Goa', '2021-03-24 11:26:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `driving_day`
--

CREATE TABLE `driving_day` (
  `day_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `destincation_id` int(11) NOT NULL,
  `start_kilometer` int(11) NOT NULL,
  `end_kilometer` int(11) DEFAULT NULL,
  `mark` varchar(50) NOT NULL,
  `start_fuel_level` int(11) NOT NULL,
  `end_fuel_level` int(11) DEFAULT NULL,
  `start_timestamp` datetime NOT NULL,
  `end_timestamp` datetime DEFAULT NULL,
  `accident_status` tinyint(1) DEFAULT NULL,
  `day_step_status` int(11) DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driving_day`
--

INSERT INTO `driving_day` (`day_id`, `user_id`, `destincation_id`, `start_kilometer`, `end_kilometer`, `mark`, `start_fuel_level`, `end_fuel_level`, `start_timestamp`, `end_timestamp`, `accident_status`, `day_step_status`, `created`, `modified`) VALUES
(6, 1, 1, 25, 650, 'Hakuna matata', 51, 20, '2021-03-23 07:25:43', '2021-03-24 00:01:10', 1, 3, '2021-03-24 11:25:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fuel`
--

CREATE TABLE `fuel` (
  `fuel_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kilometer` int(11) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `fuel_amount` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `oil_status` tinyint(1) NOT NULL,
  `blue_tanked_status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuel`
--

INSERT INTO `fuel` (`fuel_id`, `day_id`, `user_id`, `kilometer`, `zipcode`, `fuel_amount`, `amount`, `oil_status`, `blue_tanked_status`, `created`, `modified`) VALUES
(2, 6, 1, 27, 'ABC132', 10, 50, 0, 0, '2021-03-24 11:24:28', '0000-00-00 00:00:00'),
(3, 6, 1, 30, 'ABC132', 5, 25, 1, 0, '2021-03-24 11:24:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `day_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message`, `status`, `day_id`, `created`, `modified`) VALUES
(1, 'Test Message', 0, 6, '2021-03-24 11:23:50', '0000-00-00 00:00:00'),
(3, 'Test Message', 0, 6, '2021-03-24 11:37:21', '0000-00-00 00:00:00'),
(4, 'Test Message', 0, 6, '2021-03-24 11:37:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car`
--

CREATE TABLE `tbl_car` (
  `car_id` int(11) NOT NULL,
  `car_noplate` varchar(15) NOT NULL,
  `make` varchar(25) NOT NULL,
  `model` varchar(35) NOT NULL,
  `year` year(4) NOT NULL,
  `color` varchar(20) NOT NULL,
  `rentalcompany` varchar(50) NOT NULL,
  `returndate` date NOT NULL,
  `fuel_type` varchar(10) DEFAULT NULL,
  `fuel_level` int(11) NOT NULL DEFAULT 0,
  `car_mileage` float NOT NULL,
  `countrycode` varchar(200) NOT NULL,
  `gpstrackingnumber` varchar(200) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_car`
--

INSERT INTO `tbl_car` (`car_id`, `car_noplate`, `make`, `model`, `year`, `color`, `rentalcompany`, `returndate`, `fuel_type`, `fuel_level`, `car_mileage`, `countrycode`, `gpstrackingnumber`, `created_timestamp`, `modified_timestamp`) VALUES
(7, 'UK21BB0880', 'AUDI', 'R8', 2014, 'Matt Black', 'SHONLIA', '2021-01-04', 'ELECTRIC', 61, 2, '', '', '2021-01-29 08:07:50', '0000-00-00 00:00:00'),
(18, 'MH905675', 'RAJENDRA', 'MVCRTION', 2019, 'Black', 'Sixty', '2021-02-15', 'CNG', 29, 5, '', '', '2021-02-08 03:51:55', '0000-00-00 00:00:00'),
(19, 'JH 85 UG 96', 'SUZUKI', 'dzire', 2019, 'Drake Blueee', 'Maruti', '2016-02-15', 'Petrol', 37, 34, '', '', '2021-02-12 23:05:34', '0000-00-00 00:00:00'),
(20, 'FK 85 JF 56 DF', 'HONS', 'AUDI', 2016, 'Drake Gray', 'R6', '2017-02-01', 'Petrol', 8, 12, 'landon', 'trackingnumbe', '2021-02-12 23:27:54', '0000-00-00 00:00:00'),
(22, 'UK21BB0889', 'marsadis', 'R8', 2014, 'Matt Black', 'SHONLIA', '2021-01-04', 'ELECTRIC', 45, 3, '', '', '2021-02-17 04:36:42', '0000-00-00 00:00:00'),
(23, 'MH90567512', 'RAJENDRA SHARMA', 'MVCRTION', 2019, 'Black', 'Sixty', '2021-02-15', 'CNG', 25, 4, '', '', '2021-02-17 04:36:42', '0000-00-00 00:00:00'),
(24, 'JH 85 UG 96', 'SUZUKIL', 'dzire', 2019, 'Drake Blueee', 'Maruti', '2016-02-15', 'Petrol', 43, 43, '', '', '2021-02-17 04:36:42', '0000-00-00 00:00:00'),
(25, 'FK 85 JF 57 DF', 'RAJ CHANDRA', 'HONDA', 2016, 'Drake Gray', 'R6', '2017-02-01', 'Desial', 46, 12, '', '', '2021-02-17 04:36:42', '0000-00-00 00:00:00'),
(26, 'FK 85 JF 58 DF', 'JENSI', 'EON', 2016, 'Drake Gray', 'R6', '2017-02-01', 'Desial', 52, 12, '', '', '2021-02-17 04:36:42', '0000-00-00 00:00:00'),
(31, 'KS-KP133', 'MERCEDES', 'Vito', 2021, 'White', 'Sixt', '2027-02-23', 'Diesel', 82, 50, '', '', '2021-02-23 10:42:45', '0000-00-00 00:00:00'),
(32, 'M-EY2254', 'VW', 'T6', 2019, 'Weiß', 'Sixt', '2022-01-01', 'Diesel', 62, 50, '', '', '2021-03-01 11:29:42', '0000-00-00 00:00:00'),
(33, 'WD65J4650', 'MINI', 'cooper', 2019, 'Red', 'Some Car Rental Company', '2021-03-06', 'Petrol', 20, 23, '', '', '2021-03-05 01:41:42', '0000-00-00 00:00:00'),
(34, 'WD80J5050', 'PORCHE', 'tycon', 2020, 'Grey', 'Some Car Rental Company', '2021-03-07', 'Elektrisch', 0, 25, '', '', '2021-03-05 08:18:09', '0000-00-00 00:00:00'),
(35, 'HH-IA-1915', 'FORD', 'Transit', 2020, 'Weiss', 'Sixt', '0000-00-00', 'Diesel', 44, 5754, '', '', '2021-03-17 09:10:11', '0000-00-00 00:00:00'),
(36, 'M-KS-111', 'MERCEDES', 'VITO', 2021, 'WEISS', 'SIXT', '0000-00-00', 'Diesel', 53, 210000, '', '', '2021-03-17 13:09:56', '0000-00-00 00:00:00'),
(42, '123454', 'MYCAR', 'mycar', 2021, 'Gdhdghg', 'Sixty', '2021-03-04', NULL, 0, 10, 'India', 'trackingnumber', '2021-03-22 05:37:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `driver_license_no` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `license_expiry_date` date DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `driver_license_no`, `dob`, `license_expiry_date`, `type_id`, `created_timestamp`, `modified_timestamp`) VALUES
(1, 'Jeet', 'Naik', 'Jeetnaik@gmail.com', 'f352e3ad70988bbdc547ec437713cf18', 'ABC1234', '1998-09-04', '2021-03-15', 0, '2021-03-23 16:08:32', '0000-00-00 00:00:00'),
(3, 'superadmin', 'superadmin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '', '0000-00-00', '0000-00-00', 1, '2021-03-24 15:26:26', NULL),
(6, 'Deepak', 'Dumraliya', 'deepak@gmail.com', '', '3214567', '2021-03-26', '2021-03-06', 0, '2021-03-24 16:52:09', NULL),
(8, 'Asdasd', 'Asdasd', 'asdasd@123', '', 'Dsadasd', '2021-03-03', '0000-00-00', 0, '2021-03-24 17:30:50', NULL),
(10, 'Test', 'Test', 'jeenaasdik@yopmail.com', '', '321456', '2021-03-04', '0000-00-00', 0, '2021-03-24 17:32:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_auth`
--
ALTER TABLE `api_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`);

--
-- Indexes for table `driving_day`
--
ALTER TABLE `driving_day`
  ADD PRIMARY KEY (`day_id`),
  ADD KEY `usert_reference` (`user_id`),
  ADD KEY `destincation_reference` (`destincation_id`);

--
-- Indexes for table `fuel`
--
ALTER TABLE `fuel`
  ADD PRIMARY KEY (`fuel_id`),
  ADD KEY `day_reference` (`day_id`),
  ADD KEY `deriver_reference` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `day` (`day_id`);

--
-- Indexes for table `tbl_car`
--
ALTER TABLE `tbl_car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_auth`
--
ALTER TABLE `api_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `driving_day`
--
ALTER TABLE `driving_day`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fuel`
--
ALTER TABLE `fuel`
  MODIFY `fuel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_car`
--
ALTER TABLE `tbl_car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driving_day`
--
ALTER TABLE `driving_day`
  ADD CONSTRAINT `destincation_reference` FOREIGN KEY (`destincation_id`) REFERENCES `destinations` (`destination_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usert_reference` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fuel`
--
ALTER TABLE `fuel`
  ADD CONSTRAINT `day_reference` FOREIGN KEY (`day_id`) REFERENCES `driving_day` (`day_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deriver_reference` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `day` FOREIGN KEY (`day_id`) REFERENCES `driving_day` (`day_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
