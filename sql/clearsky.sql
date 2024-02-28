-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 08:46 AM
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
-- Database: `clearsky`
--

-- --------------------------------------------------------

--
-- Table structure for table `factuur`
--

CREATE TABLE `factuur` (
  `id` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'hakhalhalahf', 'gaagagagaagga', 4.00, 'zonnepaneel1.png'),
(3, 'keoekoekoekoekoekoe', 'keokeokeokewoekoek', 55.00, 'zonnepaneel1.png'),
(4, 'abcdefghahiha', 'akeokeokfeoakoaf', 22.00, 'zonnepaneel1.png'),
(5, 'masFf', 'max is een homo', 1.00, 'zonnepaneel1.png'),
(6, 'maxmama', 'max is een homo', 1.00, 'zonnepaneel1.png'),
(7, 'maxmam', 'max is een homo', 1.00, 'zonnepaneel1.png'),
(8, 'Martan is een aap ', 'geef een aap een goude ring en het blijft nogsteeds een lelijk ding ', 0.01, 'zonnepaneel1.png'),
(9, 'Martan is een aap ', 'geef een aap een goude ring en het blijft nogsteeds een lelijk ding ', 0.01, 'zonnepaneel1.png');

-- --------------------------------------------------------

--
-- Table structure for table `regel`
--

CREATE TABLE `regel` (
  `id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `factuur_id` int(11) NOT NULL,
  `groote` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sensordata`
--

CREATE TABLE `sensordata` (
  `ID` int(100) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sensor1` float NOT NULL,
  `Sensor2` float NOT NULL,
  `Sensor3` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensordata`
--

INSERT INTO `sensordata` (`ID`, `Date`, `Sensor1`, `Sensor2`, `Sensor3`) VALUES
(1, '2023-04-20 20:15:23', 1.1, 13, 26.8),
(2, '2023-04-20 20:15:23', 1, 10.6, 22.4),
(3, '2023-04-20 20:15:23', 1.8, 10.3, 26.1),
(4, '2023-04-20 20:15:23', 1.3, 12.9, 29.6),
(5, '2023-04-20 20:15:23', 1.5, 11.4, 27.8),
(6, '2023-04-20 20:15:23', 1.7, 11.8, 25.3),
(7, '2023-04-20 20:15:23', 1.1, 10.5, 20.9),
(8, '2023-04-20 20:15:23', 1.5, 12, 19.3),
(9, '2023-04-20 20:15:23', 1.5, 11.2, 22.6),
(10, '2023-04-20 20:15:23', 1.3, 12, 24.3),
(11, '2023-04-20 20:15:23', 1.6, 11.4, 19.8),
(12, '2023-04-20 20:15:23', 1.8, 11.1, 19.7),
(13, '2023-04-20 20:15:23', 2, 10.9, 24.2),
(14, '2023-04-20 20:15:23', 1.6, 11.2, 20.2),
(15, '2023-04-20 20:15:23', 1.3, 11.7, 23.2),
(16, '2023-04-20 20:15:23', 1.7, 11, 19.4),
(17, '2023-04-20 20:15:23', 1.2, 12, 21.7),
(18, '2023-04-20 20:15:23', 1.2, 10.1, 24.1),
(19, '2023-04-20 20:15:23', 1.9, 12.9, 21.6),
(20, '2023-04-20 20:15:23', 1, 12, 18.5),
(21, '2023-04-20 20:15:23', 1.5, 11.4, 20.6),
(22, '2023-04-20 20:15:23', 1.1, 13, 18.7),
(23, '2023-04-20 20:15:23', 1.1, 12, 26.9),
(24, '2023-04-20 20:15:23', 1.6, 12.8, 22.1),
(25, '2023-04-20 20:15:23', 1.3, 11.5, 25.8),
(26, '2023-04-20 20:15:23', 1.2, 10.1, 20.3),
(27, '2023-04-20 20:15:23', 1.3, 12, 18),
(28, '2023-04-20 20:15:23', 1.1, 10.4, 18.1),
(29, '2023-04-20 20:15:23', 2, 11.7, 27.6),
(30, '2023-04-20 20:15:23', 1.6, 10.8, 25.5),
(31, '2023-04-20 20:15:23', 1.5, 11.4, 29.4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phonenumber` int(7) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `admin` int(45) NOT NULL,
  `can_login` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `adress`, `email`, `password`, `phonenumber`, `zipcode`, `admin`, `can_login`) VALUES
(1, 'Jelmer', 'Jeltje de Bosch Kemperstraat 55', 'jelmerdeleeuw@gmail.com', 'AaapAaap', 627045329, '2401KC', 0, 1),
(2, 'Jelmer de Leeuw', 'Jeltje de Bosch Kemperstraat 55', 'jelmerdeleeuw@gmail.com', 'AaapAaap', 627045329, '2401KC', 0, 1),
(3, 'admin', 'admin admin', 'admin@gmail.com', 'admin', 0, 'adfafa', 1, 1),
(4, 'admin', 'admin admin', 'admin@gmail.com', 'admin', 0, 'jljl', 1, 1),
(5, 'admin', 'adminadmin', 'admin@gmail.com', 'admin', 66666, '2401fg', 1, 1),
(6, 'admin', 'adminadmin', 'admin@gmail.com', 'admin', 66666, '2401fg', 1, 1),
(7, '', '', '', '', 0, '', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `factuur`
--
ALTER TABLE `factuur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regel`
--
ALTER TABLE `regel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensordata`
--
ALTER TABLE `sensordata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `factuur`
--
ALTER TABLE `factuur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `regel`
--
ALTER TABLE `regel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sensordata`
--
ALTER TABLE `sensordata`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
