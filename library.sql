-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 08:10 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `copies`
--

CREATE TABLE `copies` (
  `isbn` varchar(50) NOT NULL,
  `copyno` int(50) NOT NULL,
  `oldID` varchar(50) NOT NULL,
  `copyID` varchar(50) NOT NULL,
  `stud_ID` varchar(50) NOT NULL,
  `time` bigint(20) DEFAULT NULL,
  `status` text NOT NULL,
  `returnTime` bigint(20) DEFAULT NULL,
  `shelfID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `copies`
--

INSERT INTO `copies` (`isbn`, `copyno`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`) VALUES
('9780141378541 0141378549 ', 1, '', '9780141378541 0141378549 -1', '', 1590788539, '', 1590788559, 'shelfID'),
('9780141378541 0141378549 ', 2, '', '9780141378541 0141378549 -2', '', 1590788689, '', 1590788709, 'shelfID'),
('9780141378541 0141378549 ', 3, '', '9780141378541 0141378549 -3', '', 1590789026, '', 1590789046, 'shelfID'),
('9789385990199 9385990195 ', 1, '', '9789385990199 9385990195 -1', 'jftjtfg', 1591042803, 'issued', 1591042823, 'shelfID');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `copyID` varchar(50) NOT NULL,
  `user` text NOT NULL,
  `stud_ID` varchar(50) NOT NULL,
  `action` text NOT NULL,
  `time` bigint(20) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `oldID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `copyID`, `user`, `stud_ID`, `action`, `time`, `isbn`, `oldID`) VALUES
(104, '9789385990199 9385990195 -1', 'admin', '-', 'add', 1590696775, '9789385990199 9385990195 ', ''),
(105, '9789385990199 9385990195 -2', 'admin', '-', 'add', 1590696775, '9789385990199 9385990195 ', ''),
(106, '9789385990199 9385990195 -3', 'admin', '-', 'add', 1590696775, '9789385990199 9385990195 ', ''),
(107, '9780141378541 0141378549 -1', 'admin', '-', 'add', 1590696796, '9780141378541 0141378549 ', ''),
(108, '9780141378541 0141378549 -2', 'admin', '-', 'add', 1590696796, '9780141378541 0141378549 ', ''),
(109, '9780141378541 0141378549 -3', 'admin', '-', 'add', 1590696796, '9780141378541 0141378549 ', ''),
(110, '9780141378541 0141378549 -4', 'admin', '-', 'add', 1590696796, '9780141378541 0141378549 ', ''),
(111, '9789385990199 9385990195 -1', 'user', 'fnyt', 'issue', 1590697819, '9789385990199 9385990195 ', ''),
(112, '9789385990199 9385990195 -2', 'user', ',hj,', 'issue', 1590697969, '9789385990199 9385990195 ', ''),
(113, '9789385990199 9385990195 -1', 'user', '', 'issue', 1590698226, '9789385990199 9385990195 ', ''),
(114, '9789385990199 9385990195 -1', 'user', '', 'issue', 1590698234, '9789385990199 9385990195 ', ''),
(115, '9789385990199 9385990195 -3', 'user', '', 'issue', 1590698245, '9789385990199 9385990195 ', ''),
(116, '9789385990199 9385990195 -1', 'user', '', 'issue', 1590698250, '9789385990199 9385990195 ', ''),
(117, '', 'user', '', 'return', 1590698422, '', ''),
(118, '9789385990199 9385990195 -1', 'user', '', 'issue', 1590698422, '9789385990199 9385990195 ', ''),
(119, '', 'user', '', 'return', 1590698471, '', ''),
(120, '9789385990199 9385990195 -1', 'user', '', 'issue', 1590698471, '9789385990199 9385990195 ', ''),
(121, '', 'user', '', 'return', 1590698511, '', ''),
(122, '9789385990199 9385990195 -1', 'user', '', 'issue', 1590698511, '9789385990199 9385990195 ', ''),
(123, '', 'user', '', 'return', 1590698518, '', ''),
(124, '9789385990199 9385990195 -1', 'user', '', 'issue', 1590698518, '9789385990199 9385990195 ', ''),
(125, '9789385990199 9385990195 -1', 'user', 'fnyt', 'return', 1590698768, '9789385990199 9385990195 ', ''),
(126, '9789385990199 9385990195 -1', 'user', 'manuu', 'issue', 1590788256, '9789385990199 9385990195 ', ''),
(127, '9780141378541 0141378549 -1', 'user', '', 'issue', 1590788539, '9780141378541 0141378549 ', ''),
(128, '9780141378541 0141378549 -2', 'user', 'itrfy', 'issue', 1590788689, '9780141378541 0141378549 ', ''),
(129, '9780141378541 0141378549 -3', 'user', 'kfkcdkm', 'issue', 1590789026, '9780141378541 0141378549 ', ''),
(130, '9780141378541 0141378549 -1', 'user', '', 'return', 1590789413, '9780141378541 0141378549 ', ''),
(131, '9780141378541 0141378549 -2', 'user', 'itrfy', 'return', 1590789420, '9780141378541 0141378549 ', ''),
(132, '9789385990199 9385990195 -3', 'admin', '-', 'delete', 1590790269, '9789385990199 9385990195 ', 'oldID'),
(133, '9789385990199 9385990195 -2', 'user', ',hj,', 'return', 1590790285, '9789385990199 9385990195 ', ''),
(134, '9789385990199 9385990195 -1', 'user', 'manuu', 'return', 1590790786, '9789385990199 9385990195 ', ''),
(135, '9789385990199 9385990195 -2', 'user', 'hgsexh', 'issue', 1590790793, '9789385990199 9385990195 ', ''),
(136, '-', 'admin', '-', 'update', 1590790804, '9789385990199 9385990195 ', 'oldID'),
(137, '-', 'admin', '-', 'update', 1590790815, '9789385990199 9385990195 ', 'oldID'),
(138, '9789385990199 9385990195 -1', 'user', 'fawsf', 'issue', 1590791308, '9789385990199 9385990195 ', ''),
(139, '9789385990199 9385990195 -2', 'user', 'hgsexh', 'return', 1590791371, '9789385990199 9385990195 ', ''),
(140, '9789385990199 9385990195 -2', 'admin', '-', 'delete', 1590791375, '9789385990199 9385990195 ', 'oldID'),
(141, '-', 'admin', '-', 'update', 1590791394, '9789385990199 9385990195 ', 'oldID'),
(142, '9789385990199 9385990195 -1', 'user', 'fawsf', 'return', 1591042778, '9789385990199 9385990195 ', ''),
(143, '9789385990199 9385990195 -1', 'user', 'jftjtfg', 'issue', 1591042803, '9789385990199 9385990195 ', ''),
(144, '9780141378541 0141378549 -4', 'admin', '-', 'delete', 1591042813, '9780141378541 0141378549 ', 'oldID'),
(145, '9780141378541 0141378549 -3', 'user', 'kfkcdkm', 'return', 1591042819, '9780141378541 0141378549 ', '');

-- --------------------------------------------------------

--
-- Table structure for table `issued`
--

CREATE TABLE `issued` (
  `id` int(11) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `oldID` varchar(50) NOT NULL,
  `copyID` varchar(50) NOT NULL,
  `stud_ID` varchar(50) NOT NULL,
  `time` bigint(20) DEFAULT NULL,
  `returnTime` bigint(20) DEFAULT NULL,
  `star` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued`
--

INSERT INTO `issued` (`id`, `isbn`, `oldID`, `copyID`, `stud_ID`, `time`, `returnTime`, `star`) VALUES
(34, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', 'fnyt', 1590697818, 1590698768, NULL),
(35, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -2', ',hj,', 1590697969, 1590790285, NULL),
(36, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', '', 1590698226, 1590698768, NULL),
(37, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', '', 1590698234, 1590698768, NULL),
(38, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -3', '', 1590698245, NULL, NULL),
(39, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', '', 1590698250, 1590698768, NULL),
(40, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', '', 1590698422, 1590698768, NULL),
(41, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', '', 1590698471, 1590698768, NULL),
(42, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', '', 1590698511, 1590698768, NULL),
(43, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', '', 1590698518, 1590698768, NULL),
(44, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', 'manuu', 1590788256, 1590790786, NULL),
(45, '9780141378541 0141378549 ', '', '9780141378541 0141378549 -1', '', 1590788539, 1590789413, NULL),
(46, '9780141378541 0141378549 ', '', '9780141378541 0141378549 -2', 'itrfy', 1590788689, 1590789420, NULL),
(47, '9780141378541 0141378549 ', '', '9780141378541 0141378549 -3', 'kfkcdkm', 1590789026, 1591042819, NULL),
(48, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -2', 'hgsexh', 1590790793, 1590791371, NULL),
(49, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', 'fawsf', 1590791308, 1591042778, NULL),
(50, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', 'jftjtfg', 1591042803, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main`
--

CREATE TABLE `main` (
  `title` varchar(50) NOT NULL,
  `author` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `Category1` text NOT NULL,
  `Category2` text NOT NULL,
  `Category3` text NOT NULL,
  `Category4` text NOT NULL,
  `publisher` text NOT NULL,
  `pages` text NOT NULL,
  `price` text NOT NULL,
  `imgLink` text NOT NULL,
  `date_of_publication` text NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `orgQuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`) VALUES
('Matilda (Colour Edition)', 'Roald Dahl', 3, 'Philosophy and Psychology', 'Generalities', 'Kinds of persons in philosophy', '', 'Penguin UK', '212', 'INR 450.76', 'http://books.google.com/books/content?id=P6D7DAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2016-09-13', '9780141378541 0141378549 ', 4),
('Olympus', 'Devdutt Pattanaik', 1, 'Generalities', 'Generalities and computer science', 'The book', '', 'Random House India', '296', 'INR 448.62', 'http://books.google.com/books/content?id=QUWqDQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2016-09-20', '9789385990199 9385990195 ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `id` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`id`, `sem`, `branch`, `isbn`) VALUES
(1, 3, 'Comps', '3-comps-1'),
(2, 4, 'Comps', '4-comps-1'),
(3, 3, 'Comps', '3-comps-2'),
(4, 3, 'Comps', '3-comps-3'),
(5, 4, 'Comps', '4-comps-2'),
(6, 4, 'IT', '4-it-1'),
(7, 4, 'IT', '4-it-2'),
(8, 5, 'IT', '5-IT-1'),
(9, 5, 'Extc', '5-extc-1'),
(10, 7, 'Elec', '7-Elec-1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `copies`
--
ALTER TABLE `copies`
  ADD PRIMARY KEY (`copyID`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued`
--
ALTER TABLE `issued`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `issued`
--
ALTER TABLE `issued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `copies`
--
ALTER TABLE `copies`
  ADD CONSTRAINT `copies_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `main` (`isbn`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
