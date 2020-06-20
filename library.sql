-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 03:02 PM
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
  `shelfID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `copies`
--

INSERT INTO `copies` (`isbn`, `copyno`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`) VALUES
('1421515024 9781421515021 ', 1, '', '1421515024 9781421515021 -1', '', NULL, '', NULL, 'check'),
('1974713326 9781974713325 ', 1, '', '1974713326 9781974713325 -1', '', NULL, '', NULL, 'name'),
('9780141378541 0141378549 ', 1, '', '9780141378541 0141378549 -1', '', NULL, '', NULL, '2'),
('9780141378541 0141378549 ', 2, '', '9780141378541 0141378549 -2', '', 1590788689, '', 1593988709, '3'),
('9780141378541 0141378549 ', 3, '', '9780141378541 0141378549 -3', 'test', 1592999643, 'reserved', 1692600241, '1'),
('9789385990199 9385990195 ', 1, '', '9789385990199 9385990195 -1', 'manuu', 1592489455, 'issued', 1592489475, NULL),
('9789385990199 9385990195 ', 2, '', '9789385990199 9385990195 -2', '', 1592488356, '', 1592488376, '2'),
('9789385990199 9385990195 ', 3, '', '9789385990199 9385990195 -3', '', NULL, '', NULL, NULL);

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
(216, '9789385990199 9385990195 -1', 'user', 'manuu', 'issue', 1592489456, '9789385990199 9385990195 ', ''),
(217, '9789385990199 9385990195 -4', 'admin', '-', 'delete', 1592489842, '9789385990199 9385990195 ', 'oldID'),
(218, '-', 'admin', '-', 'update', 1592490731, '9789385990199 9385990195 ', 'oldID'),
(219, 'hrdh-1', 'admin', '-', 'add', 1592551474, 'hrdh', ''),
(220, '1421515024 9781421515021 -1', 'admin', '-', 'add', 1592551539, '1421515024 9781421515021 ', ''),
(221, '1421515024 9781421515021 -2', 'admin', '-', 'add', 1592551539, '1421515024 9781421515021 ', ''),
(222, '1974713326 9781974713325 -1', 'admin', '-', 'add', 1592551931, '1974713326 9781974713325 ', ''),
(223, 'hrdh-1', 'admin', '-', 'delete', 1592552047, 'hrdh', 'oldID'),
(224, '1974713326 9781974713325 -3', 'admin', '-', 'add', 1592552276, '1974713326 9781974713325 ', 'oldID'),
(225, '1974713326 9781974713325 -3', 'admin', '-', 'delete', 1592571998, '1974713326 9781974713325 ', 'oldID'),
(226, '1421515024 9781421515021 -2', 'admin', '-', 'delete', 1592572379, '1421515024 9781421515021 ', 'oldID'),
(227, '-', 'admin', '-', 'update', 1592598680, '1974713326 9781974713325 ', 'oldID'),
(228, '9780141378541 0141378549 -3', 'user', 'test', 'issue', 1592599643, '9780141378541 0141378549 ', ''),
(229, '9780141378541 0141378549 -3', 'user', 'test', 'issue', 1592600221, '9780141378541 0141378549 ', '');

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
(55, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', 'manu', 1592488115, 1592488242, NULL),
(56, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', 'manuu', 1592488119, 1592488242, NULL),
(57, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', 'test', 1592488264, NULL, NULL),
(58, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', 'test1', 1592488294, NULL, NULL),
(59, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -2', 'manuu', 1592488356, NULL, NULL),
(60, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -2', 'manu', 1592488368, NULL, NULL),
(61, '9789385990199 9385990195 ', '', '9789385990199 9385990195 -1', 'manuu', 1592489456, NULL, NULL),
(62, '9780141378541 0141378549 ', '', '9780141378541 0141378549 -3', 'test', 1592599643, NULL, NULL),
(63, '9780141378541 0141378549 ', '', '9780141378541 0141378549 -3', 'test', 1592600221, NULL, NULL);

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
('Naruto: Mission: Protect the Waterfall Village! (N', 'Masashi Kishimoto', 3, '', '', '', '', 'VIZ Media LLC', '200', '', 'http://books.google.com/books/content?id=B1FfR3KF4BEC&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2007-10-16', '1421515024 9781421515021 ', 4),
('changetitle', 'Jun Esaka', 2, 'Generalities', 'News media, journalism, publishing', 'In eastern Europe; In Soviet Union', '', 'VIZ Media LLC', '208', '', 'http://books.google.com/books/content?id=iuBUzQEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2020-10-06', '1974713326 9781974713325 ', 3),
('Matilda (Colour Edition)', 'Roald Dahl', 3, 'Philosophy and Psychology', 'Generalities', 'Kinds of persons in philosophy', '', 'Penguin UK', '212', 'INR 450.76', 'http://books.google.com/books/content?id=P6D7DAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2016-09-13', '9780141378541 0141378549 ', 4),
('Olympus', 'Devdutt Pattanaik', 5, 'Language', 'Linguistics', 'Linguistics', '', 'Random House India', '296', 'INR 448.62', 'http://books.google.com/books/content?id=QUWqDQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2016-09-20', '9789385990199 9385990195 ', 6),
('hrd', 'hdrh', 0, 'Philosophy and Psychology', 'Metaphysics', 'Ontology', '', '', '', '', '', '', 'hrdh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE `shelf` (
  `shelfID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shelf`
--

INSERT INTO `shelf` (`shelfID`) VALUES
('1'),
('2'),
('3'),
('check'),
('name'),
('test');

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
  ADD KEY `isbn` (`isbn`),
  ADD KEY `shelfID` (`shelfID`);

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
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`shelfID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `issued`
--
ALTER TABLE `issued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
  ADD CONSTRAINT `copies_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `main` (`isbn`) ON UPDATE CASCADE,
  ADD CONSTRAINT `copies_ibfk_2` FOREIGN KEY (`shelfID`) REFERENCES `shelf` (`shelfID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
