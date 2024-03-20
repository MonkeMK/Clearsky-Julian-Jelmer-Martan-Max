-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 08:40 AM
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
-- Table structure for table `afspraken`
--

CREATE TABLE `afspraken` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
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
(1, 'Basis bundel clearsky', 'twee zonnepanelen met lowpower omzet instalatie in huis. ', 799.99, 'basispakket.png'),
(2, 'Sloppe bundel', 'een zonnepaneel voor extreem kleine daken en een kleine omzetter.\r\n(koop een normaal huis jij loser)', 200.00, 'krotje.png'),
(3, 'luxe pakket', '6 panelen met keuze locatie op en rond het huis. Super omzetter inbegrepen', 1500.00, 'gigazonnepaneel.png'),
(4, 'Koning\'s bundel', 'Vrije keuze op locatie en bedekking naar keuze. tot een max van twintig panelen. Super omzetter inbegrepen.', 3999.99, 'koningsbundel.png'),
(7, 'Max bundel', 'Zonnepaneel wasser op laag niveau', 500.00, 'max.jpg\r\n'),
(8, 'Martan bundel', 'Aap dat alle zonnepanelen in de gaten houd qua status', 0.01, 'martan.jpg'),
(9, 'Juul bundel', 'extra oppervlakte voor uw zonnepanalen\r\n', 999.99, 'juul.jpg'),
(10, 'Jelmer bundel', 'De minst competente wasser maar hij kan alle taken in een voor je bijhouden', 69.69, 'jelmer.jpg'),
(11, 'De Licht Bundel ', 'Powerbank met zonnepaneel en een zaklamp.\r\n ', 20.00, 'powerbank.png');

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
(1, 'admin', 'adminadmin', 'admin@gmail.com', 'admin', 66666, '2401fg', 1, 1),
(11, 'max', 'maxmax', 'max@gmail.com', 'max', 0, '0000', 0, 1),
(13, 'test', 'testtest', 'test@gmail.com', 'test', 0, '0', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `afspraken`
--
ALTER TABLE `afspraken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `afspraken`
--
ALTER TABLE `afspraken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `afspraken`
--
ALTER TABLE `afspraken`
  ADD CONSTRAINT `afspraken_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
