-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 09:41 AM
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
(1, 'Basis bundel clearsky', 'Deze 2 zonnepanelen worden bij u gratis geinstalleerd. Doormiddel van onze mooie techniek kunnen we ze voor weinig geld instaleren. Ze geven low-power maar met als u ze meer wilt kunt u ook nog altijd naar onze andere zonnepanelen kijken. ', 799.99, 'basispakket.png'),
(2, 'Sloppe bundel', 'Deze zonnepanelen zijn heel low budget ze geven het laagste wattpercentage. En worden ook niet geinstalleerd bij u. Deze zonnepanelen zijn dus voor echte paupers. Wilt u deze kopen contacteer ons of maak een afspraak.', 200.00, 'krotje.png'),
(3, 'luxe pakket', 'Deze 6 zonnepanelen zijn voor de echte luxepoezen door hun hoge percentage en hebben in totaal 6 jaar gerantie 1 jaar zonnepaneel. Deze zonnepanelen geven u de echt voordelen van de zon. En worden elk jaar bij u gecontrolleerd en gerepareerd wanneer u dat wilt.', 1500.00, 'gigazonnepaneel.png'),
(4, 'Koning\'s bundel', 'Met deze bundel heeft u unlimted zonnepanelen ze kunnen op elke plaats worden geplaatst in en rondom uw huis bijvoorbeeld op uw deur. Deze hebben netzoals het luxe pakket 1 jaar per zonnepaneel garantie en worden ook elk jaar gecontrolleerd of meerdere keren als u dat wilt. U kunt tot max 20 panelen toevoegen en we hebben nu ook dat een super stroom opzetter is ingebregepen dus wees er snel bij want OP = OP!', 3999.99, 'koningsbundel.png'),
(7, 'Max bundel', 'Bij deze bundel krijgt u een gratis Max bij inbegrepen zo kan u als u geen ruimte heeft deze jongen in de tuin plaatsen net als een tuinkabouter. Op zijn grote hoofd kunnen 5 zonnepanelen. Hij heeft ook een tas bij inbegrepen waar die een super high tech laptop in zit waar hij alle data op kan zien. Er is er maar 1 beschikbaar DUS WEES ER SNEL BIJ!!!', 1.00, 'max.jpg\r\n'),
(8, 'Martan bundel', 'Deze rare Aap (Volgens Max zie Max Bundel) Houd goed via zijn Linux alle data in de gaten als hij een probleem ziet komt hij zo snel mogelijk naar u toe en fix het meteen. Deze bundel is heel erg goedkoop dus wees er ook nog steeds snel bij want op is operde pop', 99999999.99, 'martan.jpg'),
(9, 'Juul bundel', 'Deze bundel is goed voor alles de Julian bundel kan met zijn alienware laptop zo naar u toe vliegen. Als u bijna geen stroom heeft geeft hij u licht met zijn laptop deze kan zo fel dat u voor een heel jaar stroom krijgt. Julian zelf heeft ook een groot voor hoofd daar kunt u in het uiterste geval ook nog uw zonnepanelen kwijt. Dit moet wel worden goedgekeurd door Julian dus maak een afspraak.', 999.99, 'juul.jpg'),
(10, 'Jelmer bundel', 'Deze bundel zorgt ervoor dat uw progamma gefixt kan worden. Als u een afspraak maakt komt Jelmer er meteen aan gecached. Hierbij maakt hij uw software meteen. Jelmer gebruikt wel veel ChatGPT dus het kan zo zijn dat niet alles meteen zal werken. Koop deze bundel meteen om een goed werkende software te houden nu met veel korting erop. Met vriendelijke groeten Jelmer de Leeuw.', 69.69, 'jelmer.jpg'),
(11, 'De Licht Bundel ', 'Deze bundel bevat een mooi powerbank met daarop een zaklamp en een zonnepaneel. Deze kan 1000Mah opnemen alleen het opladen gaat iets trager dan normaal. Koop deze snel want er is maar een beperkte voorraad aanwezig. ', 20.00, 'powerbank.png'),
(15, 'Kampvuurpaneel', 'Wilt u nu ook met warmte en licht zo snel mogelijk energie opwekken? Dat kan nu met het exclusieve kampvuurpaneel met dit paneel zorgt u er zo voor dat u alle extras mee pikt als het gaat om energie. Deze is speciaal hitte bestemdig gemaakt zodat die niet in de fik vliegt dus koop hem nu.', 1500.00, 'kampvuurpaneel.jpg'),
(16, 'Maanpaneel', 'Als u geen ruimte op het dak heeft koop dan het maanpaneel. Dit paneel geeft nog meer energie want de maan straalt ook een hoop licht uit. Dit zorgt voor nog meer stroom dan dat u van ons gewenst bent.', 1000000.00, 'Maanpaneel.png\n'),
(17, 'Hoesjepaneel', 'Heb jij nou ook altijd een lege telefoon. Nu niet meer met ons limeted edition telefoon hoesje. Dit hoesje zorgt ervoor dat jou telefoon altijd oplaad. Doormiddel van zonneenergie.', 50.00, 'hoesjepaneel.png\r\n'),
(18, 'Luckywheel', 'Kan je niet kiezen welk paneel je wilt? Koop dan nu deze bundel hiermee geven we je een random paneel voor een vaste prijs. Zo kan jij wel een zonnepaneel krijgen als je niet weet welke je moet nemen. Dus koop hem nu als je niet kan kiezen.', 999.00, 'luckywheel.png'),
(19, 'Give Away!!!!!!!!!!', 'Nu een Give Away voor dit mooie stuk zonnepaneel ter waarde van 100. Deze is limeted edition en kan allemaal verschillende panelen zijn met handtekening van heel clearsky. Koop hem nu', 150.00, 'giveawaypaneel.png');

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
  `phonenumber` int(10) NOT NULL,
  `place` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `admin` int(45) DEFAULT NULL,
  `can_login` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `adress`, `email`, `password`, `phonenumber`, `place`, `zipcode`, `admin`, `can_login`) VALUES
(1, 'admin', 'adminadmin', 'admin@gmail.com', '$2y$10$yUFY2OGdq6aIblEMMU3Uxu0j5lMEWV54paiyJogUIey60qyVsybsC', 505050505, 'bla bla', '6555kc', 0, 1),
(2, 'test', 'testtest', 'test@gmail.com', 'test', 0, '', '0', 0, 1),
(3, 'max', '', 'max@gmail.com', 'max', 0, '', '0000', 0, 1),
(38, '', '', '', '$2y$10$gPW9Klr9pA3bN.udWnvnxu7bj.ZE6LMH/h/ffTutR1s0CY90zn4v6', 0, '', '', 0, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
