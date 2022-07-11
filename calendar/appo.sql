-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 12, 2019 at 02:51 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appo`
--

-- --------------------------------------------------------

--
-- Table structure for table `appo`
--

DROP TABLE IF EXISTS `appo`;
CREATE TABLE IF NOT EXISTS `appo` (
  `username` int(11) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tilte` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `detail` text NOT NULL,
  `color` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appo`
--

INSERT INTO `appo` (`username`, `id`, `tilte`, `date`, `starttime`, `endtime`, `detail`, `color`) VALUES
(11, 281, 'present', '2019-12-17', '07:00:00', '10:02:00', 'haha', 'ff8080'),
(11, 260, 'no', '2019-12-19', '01:00:00', '11:00:00', 'readbook', '000000');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(1, '1385995353'),
(1, '1386011064'),
(2, '1568876257'),
(4, '1570722751'),
(4, '1570722751'),
(10, '1571909575'),
(8, '1572141447'),
(11, '1572242649'),
(11, '1572850631'),
(11, '1572854402'),
(11, '1573029809'),
(11, '1574178996'),
(11, '1575791907'),
(11, '1575791922'),
(11, '1575791945'),
(11, '1575791978'),
(11, '1575791985'),
(11, '1575792011'),
(11, '1575890219'),
(11, '1576033873');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`) VALUES
(8, 'mildio', 'mon@gmail.com', 'e5930d9cd588d69abb302448111b6651aafabbca9d3774c4d8932e34554ab7acae93f47775e9a56b4d05bf9963989b5c4531a2a9ba765ea117a34dbe61031c19', '5d20e71c72a087b583f66129e235d2d827e401dcd2408eb9ee811901004b73a80a336eaacdfd7ce7158b7bd4562e37e8a99a188438b3683d27089b145c3a1eb5'),
(9, 'kunmhee', 'Monperya12@gmail.com', 'fe8aedf2c4756e46d0e74b9d1a5b6f5b737769bdfb7ea844d12dba0855167acc61bd1b66d5701e80d2d4d9e380b7028cd9ce580bc4129429727ff9306598ffc2', 'e65f61c8bb83dd3011d3c351ae72577db78c84f9b2bfcbc178ef09d3b019dc853d8780635913496d25b0b953d2f9e69d1789f002de7d216f53191ade2d1c8c07'),
(10, 'sfsefcwefwef', 'monmon@gmail.com', '735608739342a62e31a3b988880a7d5a91febc8f847058bfd5d05c9ca14504bc6f231f52e6d465b03c142f39ae28ffd20a711846b079892e3448eb7acc6aeb48', '6ed7310b9d4877186b24df68e3dd4ce5397509d87fc60af158f79951b73e53d925e037f8c9cff765f03867c716bd99448ab3f990d6bcf469b7f9e596688088f2'),
(11, 'asdfghjk', 'ken@gmail.com', 'faaefd0dc402d8cae72140d496681ee8c5ae3bb1edec4672ee3308c5666ee1aebb6778afa138a69254b8618a2440b293058e2b7800b0f83d260d6caaaef6b5e8', '4e49e53b197cbd022030c76021429a04bb5f269306a0016932dcdf0dbc42747cb60b012942da41dda0b69a8a04fe37f59034800c48d6298f2ad80ebda38017d3'),
(12, 'mondef', 'Monperya@gmail.com', '28f4d7719f038ec10bc01b78288a03ba1c1c7542b23309fd24de5659a340b79bf910ca8b76a79a7b6905b0a13b167e06ff5db69c123d8c3ac179861b001ced46', '96f60c2dc4e6957626bdd295ed28890693a6a5b152094fa40ea0b4dce7bf1c91681dc0a3e6be12d1145e18ab9a0b5a1d0fbe904568bd3f0c91a77839091ff0b0'),
(13, 'mildmon', 'liew@gmail.com', '9a236ce02fc266bf45921b264f0ba5b4ad58246e43ad022198ca1fefd9452548000699cf35bae6e13cc4063ed71caa3a72ed5d91dcfec97b8d8a31c82f76d904', '816c588288fe2865794e5d054368fe25e50800f7444166a1685304a073af513848b14e842a37d48bf70f0e4959d3f123c1b0f9dd4876e9f2485dd1db2225a8cf');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
