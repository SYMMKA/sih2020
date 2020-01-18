-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2020 at 12:20 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

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
  `title` text NOT NULL,
  `author` text NOT NULL,
  `category` text NOT NULL,
  `subCategory` text NOT NULL,
  `publisher` text NOT NULL,
  `pages` text NOT NULL,
  `price` text NOT NULL,
  `quantity` int(10) NOT NULL,
  `imgLink` text NOT NULL,
  `date_of_publication` text NOT NULL,
  `isbn` text NOT NULL,
  `issued` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `category`, `subCategory`, `publisher`, `pages`, `price`, `quantity`, `imgLink`, `date_of_publication`, `isbn`, `issued`) VALUES
(1, 'The Book of Mormon', 'Trey Parker,Robert Lopez,Matt Stone', 'Technology', 'Artificial Intelligence', 'Newmarket Press', '224', '', 1, 'http://books.google.com/books/content?id=aRdBLgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2012-11-06', '0062234943 9780062234940 ', 0),
(2, 'Core Python Programming', 'Chun', 'Technology', 'Programming', 'Pearson Education India', '1137', '', 1, 'http://books.google.com/books/content?id=VCX0KrcGQpcC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2006', '8131711889 9788131711880 ', 0),
(3, 'Mastering Visual Studio 2019', 'Kunal Chowdhury', 'Technology', 'Programming', 'Packt Publishing Ltd', '374', 'INR 683.21', 1, 'http://books.google.com/books/content?id=xbaoDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2019-08-09', '9781789536881 178953688X ', 0),
(4, 'Python Programming', 'John M. Zelle', 'Technology', 'Database Design', 'Franklin, Beedle & Associates, Inc.', '517', '', 1, 'http://books.google.com/books/content?id=aJQILlLxRmAC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2004', '9781887902991 1887902996 ', 0),
(5, 'Programming in C', 'Kochan abd', 'Technology', 'Artificial Intelligence', 'Pearson Education India', '564', '', 1, 'http://books.google.com/books/content?id=y3z1wm2Nd2IC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2005-09', '8131713512 9788131713518 ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `issued`
--

CREATE TABLE `issued` (
  `stud_name` text NOT NULL,
  `stud_email` text NOT NULL,
  `stud_id` text NOT NULL,
  `title` text NOT NULL,
  `author` text NOT NULL,
  `id` text NOT NULL,
  `issue_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
