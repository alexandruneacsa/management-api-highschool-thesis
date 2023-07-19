-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 05, 2020 at 11:30 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myusers`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nume` varchar(30) NOT NULL,
  `prenume` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `centura` varchar(60) NOT NULL,
  `user` varchar(30) NOT NULL,
  `parola` varchar(40) NOT NULL,
  `data_adaugarii` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nume`, `prenume`, `email`, `centura`, `user`, `parola`, `data_adaugarii`) VALUES
(1, 'Neacsa', 'Alexandru', 'alexneacsa14@gmail.com', 'neagra', 'nalexandru', '123445fsdhf', '2020-03-05 10:25:54'),
(2, 'Florea', 'Rares', 'raresflorea67@gmail.com', 'alba', 'frares', 'qweasdzxc.', '2020-03-05 10:26:08'),
(3, 'Pop', 'Vlad', 'vladpop75@gmail.com', 'albastra', 'pvlad', 'qwerewdsf', '2020-03-05 10:26:29'),
(4, 'Zamfir', 'Razvan', 'razvanzamfir13@gmail.com', 'mov', 'zrazvan', '123ewdas', '2020-03-05 10:26:43'),
(5, 'Bacescu', 'Ionut', 'bace08@gmail.com', 'alba', 'baceunicat', '4c1cb83221247cb71dc78ddf0f16ffa4', '2020-03-05 11:29:48'),
(36, 'Neacsa', 'Eduard', 'aled7@gmail.com', 'alba', 'Edii', 'cc03e747a6afbbcbf8be7668acfebee5', '2020-03-05 11:29:56');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
