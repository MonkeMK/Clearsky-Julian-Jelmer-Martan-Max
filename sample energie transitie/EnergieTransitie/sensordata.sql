-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 apr 2023 om 10:28
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `energy_trans`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sensordata`
--

CREATE TABLE `sensordata` (
  `ID` int(100) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sensor1` float NOT NULL,
  `Sensor2` float NOT NULL,
  `Sensor3` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `sensordata`
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

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `sensordata`
--
ALTER TABLE `sensordata`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `sensordata`
--
ALTER TABLE `sensordata`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
