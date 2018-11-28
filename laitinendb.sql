-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 28.11.2018 klo 18:55
-- Palvelimen versio: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laitinendb`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `shortName` varchar(2) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Vedos taulusta `categories`
--

INSERT INTO `categories` (`ID`, `name`, `shortName`) VALUES
(1, 'desktop', 'dt'),
(2, 'laptop', 'lt'),
(3, 'tablet', 'tb'),
(4, 'accessories', 'ac');

-- --------------------------------------------------------

--
-- Rakenne taululle `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `model` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `make` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `location` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `owner` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `category` char(2) COLLATE latin1_general_ci NOT NULL,
  `serial` int(11) NOT NULL,
  `isReserved` tinyint(1) NOT NULL,
  `isOnLoan` tinyint(1) NOT NULL,
  `Reservations` int(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Vedos taulusta `device`
--

INSERT INTO `device` (`ID`, `name`, `model`, `make`, `description`, `location`, `owner`, `category`, `serial`, `isReserved`, `isOnLoan`, `Reservations`) VALUES
(1, 'd505 a', 'd505', 'Dell', 'i7-9700', 'tietie', 'cs', 'dt', 123456, 0, 0, 0),
(2, 'f105', 'F105', 'Logitech', 'Wireless Mouse', 'TieTie', 'cs', 'ac', 145648, 1, 0, 3),
(3, 'Samsung P50', 'P50', 'Samsung', '10.1\" Wifi Tablet', 'Jootie', 'mt', 'ac', 564584, 0, 0, 0),
(7, 'fdsaf', 'dsfwa', 'faease', 'ewfqf', 'fdqfeq', 'cs', 'dt', 12351, 0, 0, 0);

-- --------------------------------------------------------

--
-- Rakenne taululle `dhistory`
--

DROP TABLE IF EXISTS `dhistory`;
CREATE TABLE IF NOT EXISTS `dhistory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `reserveBegin` date NOT NULL,
  `reserveEnd` date NOT NULL,
  `loanBegin` date NOT NULL,
  `loanEnd` date NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `loans`
--

DROP TABLE IF EXISTS `loans`;
CREATE TABLE IF NOT EXISTS `loans` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `deviceID` int(11) NOT NULL,
  `begins` date NOT NULL,
  `ends` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE IF NOT EXISTS `owners` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `shortName` char(2) COLLATE latin1_general_ci NOT NULL,
  `name` char(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Vedos taulusta `owners`
--

INSERT INTO `owners` (`ID`, `shortName`, `name`) VALUES
(1, 'cs', 'Computer Science'),
(2, 'bi', 'Biology'),
(3, 'bc', 'Biochemistry'),
(4, 'mt', 'Mathematics');

-- --------------------------------------------------------

--
-- Rakenne taululle `reserves`
--

DROP TABLE IF EXISTS `reserves`;
CREATE TABLE IF NOT EXISTS `reserves` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `deviceID` int(11) NOT NULL,
  `begins` date NOT NULL,
  `ends` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `uhistory`
--

DROP TABLE IF EXISTS `uhistory`;
CREATE TABLE IF NOT EXISTS `uhistory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `reserveBegin` date NOT NULL,
  `reserveEnd` date NOT NULL,
  `loanBegin` date NOT NULL,
  `loanEnd` date NOT NULL,
  `deviceID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `phone` int(100) UNSIGNED NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`ID`, `name`, `address`, `username`, `password`, `phone`, `isAdmin`) VALUES
(1, 'Admin', 'Puijonsarventie 61 A5', 'admin', 'password', 12345, 1),
(2, 'Arto', 'Puijonsarventie 61 A5', 'kilf', 'salasana', 405274249, 0),
(5, 'Arto', 'Puijonsarventie 61 A5', 'poo', 'salasana', 405274249, 0),
(6, 'Arto', 'Puijonsarventie 61 A5', 'joo', 'salasana', 405274249, 0),
(7, 'pera', 'peratie', 'pera', 'salasana', 1234, 0),
(8, 'arto', 'puikkari', 'hhh', 'hhh', 1234, 0),
(9, '', '', 'ttt', 'ttt', 3143242, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
