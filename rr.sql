-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 06:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rr`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `idA` int(11) NOT NULL,
  `who` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `act` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `obj` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`idA`, `who`, `act`, `obj`, `info`, `dat`) VALUES
(29, 'Supermen', 'Added', '1997 Peugeot 406', '', '2020-02-17 03:01:47'),
(30, 'Supermen', 'Deleted', '1997 Peugeot 406', 'Picture', '2020-02-17 03:11:30'),
(33, 'Supermen', 'Deleted', '1997 Peugeot 406', 'Picture', '2020-02-17 03:24:54'),
(43, 'Huga', 'Updated', 'The Batmobile', NULL, '2020-02-17 13:54:03'),
(44, 'Huga', 'Updated', '1972 Ford E200 Econoline Van', NULL, '2020-02-17 13:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `idS` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `main` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`idS`, `name`, `src`, `main`) VALUES
(1, 'Bumblebee Camaro', 'Slike/rides/bumblebee1.jpg', 1),
(2, 'Bumblebee Camaro', 'Slike/rides/bumblebee2.jpg', NULL),
(3, 'Bumblebee Camaro', 'Slike/rides/bumblebee3.jpg', NULL),
(4, 'Bumblebee Camaro', 'Slike/rides/bumblebee3.jpg', NULL),
(5, 'Bumblebee Camaro', 'Slike/rides/bumblebee4.jpg', NULL),
(6, 'Aston Martin DB5', 'Slike/rides/astonMartin1.jpg', 1),
(7, 'Aston Martin DB5', 'Slike/rides/astonMartin2.jpg', NULL),
(8, 'Aston Martin DB5', 'Slike/rides/astonMartin3.jpg', NULL),
(9, 'Aston Martin DB5', 'Slike/rides/astonMartin4.jpg', NULL),
(10, 'Cybertruck', 'Slike/rides/cybertruck1.jpg', 1),
(11, 'Cybertruck', 'Slike/rides/cybertruck2.jpg', NULL),
(12, 'Cybertruck', 'Slike/rides/cybertruck3.jpg', NULL),
(13, 'Cybertruck', 'Slike/rides/cybertruck4.jpg', NULL),
(14, 'Cybertruck', 'Slike/rides/cybertruck5.jpg', NULL),
(15, '1981 DeLorean DMC-12', 'Slike/rides/delorean1.jpg', 1),
(16, '1981 DeLorean DMC-12', 'Slike/rides/delorean2.jpg', NULL),
(17, '1981 DeLorean DMC-12', 'Slike/rides/delorean3.jpg', NULL),
(18, '1981 DeLorean DMC-12', 'Slike/rides/delorean4.jpg', NULL),
(19, '1972 Ford E200 Econoline Van', 'Slike/rides/fordEconoline1.jpg', 1),
(20, '1972 Ford E200 Econoline Van', 'Slike/rides/fordEconoline2.jpg', NULL),
(21, '1972 Ford E200 Econoline Van', 'Slike/rides/fordEconoline3.jpg', NULL),
(22, '1972 Ford E200 Econoline Van', 'Slike/rides/fordEconoline4.jpg', NULL),
(23, '1972 Ford E200 Econoline Van', 'Slike/rides/fordEconoline5.jpg', NULL),
(24, 'Ford Anglia 105E Deluxe', 'Slike/rides/flyingFord1.jpg', 1),
(25, 'Ford Anglia 105E Deluxe', 'Slike/rides/flyingFord2.jpg', NULL),
(26, 'Ford Anglia 105E Deluxe', 'Slike/rides/flyingFord3.jpg', NULL),
(27, 'Ford Anglia 105E Deluxe', 'Slike/rides/flyingFord4.jpg', NULL),
(28, 'The Batmobile', 'Slike/rides/batmobile1.jpg', 1),
(29, 'The Batmobile', 'Slike/rides/batmobile2.jpg', NULL),
(30, 'The Batmobile', 'Slike/rides/batmobile3.jpg', NULL),
(31, 'The Batmobile', 'Slike/rides/batmobile4.jpg', NULL),
(57, '1997 Peugeot 406', 'Slike/rides/1581904907taxi2.jpg', NULL),
(58, '1997 Peugeot 406', 'Slike/rides/1581904907taxi3.jpg', NULL),
(60, '1997 Peugeot 406', 'Slike/rides/1581904907taxi1.jpg', 1),
(62, '1997 Peugeot 406', 'Slike/rides/1581906269taxi4.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rented`
--

CREATE TABLE `rented` (
  `idRe` int(11) NOT NULL,
  `idR` int(11) NOT NULL,
  `idK` int(11) NOT NULL,
  `pDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `rPAdress` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `bonusP` int(11) DEFAULT NULL,
  `totalPrice` int(11) NOT NULL,
  `approved` int(11) DEFAULT NULL,
  `expired` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rented`
--

INSERT INTO `rented` (`idRe`, `idR`, `idK`, `pDate`, `rDate`, `rPAdress`, `bonusP`, `totalPrice`, `approved`, `expired`) VALUES
(14, 1, 1, '2020-02-15 05:11:15', '2020-02-28 21:22:00', 'Ssadasdas 12', 0, 114, 1, 1),
(22, 25, 1, '2020-02-17 15:40:13', '2020-02-24 21:00:00', 'Brace Jerkovic 78', 1, 368, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `idR` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `bonusP` text COLLATE utf8_unicode_ci NOT NULL,
  `bpPrice` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `percent` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`idR`, `name`, `description`, `bonusP`, `bpPrice`, `price`, `discount`, `percent`, `deleted`) VALUES
(1, '1981 DeLorean DMC-12', 'Originally fueled by radioactive plutonium, this Delorean was modified in 1955 to run on the electricity in a lightning bolt. Later a power plant was installed, allowing it to run on practically any available matter. Recycling matters.', 'Time travel module!', 420, 42, 40, 6, 0),
(2, '1972 Ford E200 Econoline Van', 'The Mystery Machine itself from Scooby Doo. It is powered by a 302CI V8 mated to an automatic transmission and features air conditioning and an AM-FM-CD player. The interior features disco lights, a couch, a table and even a ghost finder!', 'Comes with bonus scooby snacks!', 30, 40, 35, 6, 0),
(3, 'Ford Anglia 105E Deluxe', 'The Flying Ford Anglia that was enchanted by Arthur Weasley to fly, as well as to become invisible. It was also modified so that it could fit eight people, six trunks, two owls, and a rat comfortably.', 'Comes with two owls and a magic rat!', 42, 39, NULL, 6, 0),
(4, 'The Batmobile', 'The Batmobile is both a heavily armored tactical assault vehicle and a personalized custom-built pursuit and capture vehicle. Using the latest civilian performance technology, coupled with prototype military-grade hardware creates an imposing hybrid monster to prowl the streets.', 'Comes with the turbo boosted, back mounted jet thruster.', 500, 50, NULL, 7, 0),
(5, 'Tesla Cybertruck', 'The Tesla Cybertruck is an all-electric, battery-powered, light commercial vehicle in development by Tesla, but with our help you can rent this baby today! With range estimates of 250–500 miles (400–800 km) and an estimated 0–60  mph (0-100km) time of 2.9 seconds this beauty will leave you breathless!', 'Comes with the Cyberquad, neatly stored in the trunk!', 320, 68, NULL, 6, 0),
(6, 'Aston Martin DB5', 'The Aston Martin DB5 is a British luxury grand tourer (GT). Released in 1963, it was an evolution of the final series of DB4. Only a total of 25 were built, although this one is equipped with a series of gadgets that come with the Bonus package, which the vehicle offers.', 'Has several functional spy gadgets, including smoke screen, oil slick, revolving license plates,\r\nmachine guns and a rear bullet shield!', 350, 72, NULL, 8, 0),
(7, 'Bumblebee Camaro', 'It\'s a car, it\'s an Autobot, it\'s a Camaro.\r\nComes with a self driving option and voice recognition. No need to worry about people trying to steal it. Try not to spill anything inside since it won\'t take it kindly.\r\n\r\n\r\n\r\n\r\n\r\n', 'May transform itself from time to time to skip traffic jams.', 422, 41, 35, 6, 0),
(25, '1997 Peugeot 406', 'A white 1997 Peugeot 406, equipped with various racing modifications that are mechanically concealed, but we didn\'t conceal the engine sound so you\'ll be free to roam the streets just like it\'s \'98.', 'Aerodynamic wings and two NoS bottles, just in case.', 200, 45, NULL, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ridepic`
--

CREATE TABLE `ridepic` (
  `idRP` int(11) NOT NULL,
  `idS` int(11) NOT NULL,
  `idR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ridepic`
--

INSERT INTO `ridepic` (`idRP`, `idS`, `idR`) VALUES
(1, 19, 2),
(2, 20, 2),
(3, 21, 2),
(4, 22, 2),
(5, 23, 2),
(6, 15, 1),
(7, 16, 1),
(8, 17, 1),
(9, 18, 1),
(10, 6, 6),
(11, 7, 6),
(12, 8, 6),
(13, 9, 6),
(14, 4, 7),
(15, 5, 7),
(16, 1, 7),
(17, 3, 7),
(18, 2, 7),
(19, 24, 3),
(20, 25, 3),
(21, 26, 3),
(22, 27, 3),
(23, 10, 5),
(24, 11, 5),
(25, 12, 5),
(26, 13, 5),
(27, 14, 5),
(28, 28, 4),
(29, 29, 4),
(30, 30, 4),
(31, 31, 4),
(57, 57, 25),
(58, 58, 25),
(60, 60, 25),
(62, 62, 25);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `idU` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idU`, `name`) VALUES
(1, 'Admin'),
(2, 'Korisnik'),
(5, 'Super-Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idK` int(100) NOT NULL,
  `firstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `licence` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `idU` int(11) NOT NULL,
  `deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idK`, `firstName`, `lastName`, `email`, `pass`, `licence`, `phone`, `idU`, `deleted`) VALUES
(1, 'Huga', 'Buga', 'luka@gmail.com', '31346c1803fce5aac55d0f931eefc7a3', '000123122', '060123122', 1, NULL),
(10, 'Supermen', 'Skajdz', 'supermen@gmail.com', 'be4e011701005b945355041b288fa06f', '000123123', '+38162321321', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`idA`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`idS`);

--
-- Indexes for table `rented`
--
ALTER TABLE `rented`
  ADD PRIMARY KEY (`idRe`),
  ADD KEY `idR` (`idR`),
  ADD KEY `idK` (`idK`);

--
-- Indexes for table `ride`
--
ALTER TABLE `ride`
  ADD PRIMARY KEY (`idR`);

--
-- Indexes for table `ridepic`
--
ALTER TABLE `ridepic`
  ADD PRIMARY KEY (`idRP`),
  ADD KEY `idS` (`idS`),
  ADD KEY `idK` (`idR`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idU`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idK`),
  ADD KEY `idU` (`idU`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `idS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `rented`
--
ALTER TABLE `rented`
  MODIFY `idRe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `idR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ridepic`
--
ALTER TABLE `ridepic`
  MODIFY `idRP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `idU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idK` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rented`
--
ALTER TABLE `rented`
  ADD CONSTRAINT `rented_ibfk_1` FOREIGN KEY (`idR`) REFERENCES `ride` (`idR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rented_ibfk_2` FOREIGN KEY (`idK`) REFERENCES `user` (`idK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ridepic`
--
ALTER TABLE `ridepic`
  ADD CONSTRAINT `ridepic_ibfk_1` FOREIGN KEY (`idR`) REFERENCES `ride` (`idR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ridepic_ibfk_2` FOREIGN KEY (`idS`) REFERENCES `picture` (`idS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idU`) REFERENCES `role` (`idU`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
