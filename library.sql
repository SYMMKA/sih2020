-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2020 at 02:05 PM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `author` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `category` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `subCategory` text NOT NULL,
  `publisher` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pages` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `quantity` int(10) NOT NULL,
  `imgLink` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_of_publication` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isbn` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `issued` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
