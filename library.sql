-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 02:42 PM
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
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `userID` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`userID`, `password`, `fname`, `lname`) VALUES
('admin1', '456', 'admin', 'dummy'),
('manu21', '123', 'Manu', 'Naik');

-- --------------------------------------------------------

--
-- Table structure for table `copies`
--

CREATE TABLE `copies` (
  `bookID` int(50) NOT NULL,
  `copyNO` int(50) NOT NULL,
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

INSERT INTO `copies` (`bookID`, `copyNO`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`) VALUES
(21, 1, '', '21 - 1', 'check', 1592832594, 'issued', 1592832614, '2'),
(21, 2, '', '21 - 2', 'test', 1592832395, 'issued', 1592832415, NULL),
(22, 1, '', '22 - 1', '', 1592833226, '', 1592833246, NULL),
(22, 2, '', '22 - 2', '', NULL, '', NULL, '3'),
(22, 3, '', '22 - 3', '', NULL, '', NULL, '2'),
(22, 4, '', '22 - 4', '', NULL, '', NULL, NULL),
(25, 1, '', '25 - 1', '', 1592834634, '', 1592834654, 'name'),
(25, 2, '', '25 - 2', '', NULL, '', NULL, '2'),
(25, 3, '', '25 - 3', 'okay', 1592837214, 'issued', 1592837234, '3'),
(30, 1, '', '30 - 1', '', 1592836732, '', 1592836752, '3'),
(30, 2, '', '30 - 2', 'che', 1592837393, 'issued', 1592837413, NULL),
(30, 3, 'oldID', '30 - 3', '', NULL, '', NULL, NULL),
(30, 4, 'oldID', '30 - 4', '', NULL, '', NULL, NULL),
(30, 5, 'oldID', '30 - 5', '', NULL, '', NULL, NULL);

--
-- Triggers `copies`
--
DELIMITER $$
CREATE TRIGGER `insert_copyID` BEFORE INSERT ON `copies` FOR EACH ROW SET new.copyID = CONCAT(new.bookID, ' - ', new.copyNO)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_copyID` BEFORE UPDATE ON `copies` FOR EACH ROW SET new.copyID = CONCAT(new.bookID, ' - ', new.copyNO)
$$
DELIMITER ;

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
  `bookID` int(50) NOT NULL,
  `oldID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `copyID`, `user`, `stud_ID`, `action`, `time`, `bookID`, `oldID`) VALUES
(306, '30 - 4', 'admin', '-', 'add', 1592840402, 0, 'oldID'),
(307, '-', 'admin', '-', 'update', 1592840402, 0, 'oldID'),
(308, '-', 'admin', '-', 'update', 1592840419, 0, 'oldID'),
(309, '30 - 5', 'admin', '-', 'add', 1592840509, 30, 'oldID'),
(310, '-', 'admin', '-', 'update', 1592840509, 30, 'oldID'),
(311, '-', 'admin', '-', 'update', 1592858330, 30, 'oldID'),
(312, '-', 'admin', '-', 'update', 1592858374, 30, 'oldID');

-- --------------------------------------------------------

--
-- Table structure for table `issued`
--

CREATE TABLE `issued` (
  `id` int(11) NOT NULL,
  `bookID` int(50) NOT NULL,
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

INSERT INTO `issued` (`id`, `bookID`, `oldID`, `copyID`, `stud_ID`, `time`, `returnTime`, `star`) VALUES
(70, 22, '', '22 - 1', 'test', NULL, 1592834396, '4'),
(71, 25, '', '25 - 1', '', NULL, 1592834640, '3'),
(72, 0, '', '25 - 1', 'test', 1592833692, 1592834640, NULL),
(73, 0, '', '30 - 1', 'check', 1592833786, 1592834543, NULL),
(74, 0, '', '30 - 2', 'last', 1592833827, 1592834528, NULL),
(75, 0, '', '25 - 1', 'check', 1592834634, 1592834640, NULL),
(76, 0, '', '30 - 2', 'check', 1592836674, 1592837241, NULL),
(77, 0, '', '30 - 1', 'last', 1592836732, 1592837309, NULL),
(78, 25, '', '25 - 3', 'okay', 1592837214, NULL, NULL),
(79, 30, '', '30 - 2', 'last', 1592837249, 1592837308, NULL),
(80, 30, '', '30 - 2', 'okay', 1592837314, 1592837387, NULL),
(81, 30, '', '30 - 2', 'che', 1592837393, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main`
--

CREATE TABLE `main` (
  `bookID` int(11) NOT NULL,
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

INSERT INTO `main` (`bookID`, `title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`) VALUES
(21, 'Olympus', 'Devdutt Pattanaik', 3, 'Religion', 'Generalities', 'Philosophy and theory of religion', '', 'Random House India', '296', 'INR 448.62', 'http://books.google.com/books/content?id=QUWqDQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2016-09-20', '9789385990199 9385990195 ', 3),
(22, 'Matilda (Colour Edition)', 'Roald Dahl', 4, 'Language', 'English and Old English', 'English etymology, word origins', '', 'Penguin UK', '212', 'INR 450.76', 'http://books.google.com/books/content?id=P6D7DAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2016-09-13', '9780141378541 0141378549 ', 4),
(25, 'Programming in C', 'Pradip Dey,Manas Ghosh', 3, 'Religion', 'Natural theology', 'Creation', '', 'Oxford Higher Education', '547', '', 'http://books.google.com/books/content?id=p9X8ygAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2011', '0198065280 9780198065289 ', 4),
(30, 'check', 'sam Author', 5, 'Religion', 'Natural theology', 'Concepts of God', '', '', '', '', '', '', '12345678', 5);

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
  `bookID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`id`, `sem`, `branch`, `bookID`) VALUES
(1, 3, 'Comps', 21),
(2, 4, 'Comps', 21),
(3, 3, 'Comps', 30),
(4, 3, 'Comps', 22),
(5, 4, 'Comps', 25),
(6, 4, 'IT', 30),
(7, 4, 'IT', 25),
(8, 5, 'IT', 22),
(9, 5, 'Extc', 30),
(10, 7, 'Elec', 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `copies`
--
ALTER TABLE `copies`
  ADD PRIMARY KEY (`copyID`),
  ADD KEY `isbn` (`bookID`),
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
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`shelfID`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookID` (`bookID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `issued`
--
ALTER TABLE `issued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `main`
--
ALTER TABLE `main`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  ADD CONSTRAINT `copies_ibfk_2` FOREIGN KEY (`shelfID`) REFERENCES `shelf` (`shelfID`),
  ADD CONSTRAINT `copies_ibfk_3` FOREIGN KEY (`bookID`) REFERENCES `main` (`bookID`);

--
-- Constraints for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD CONSTRAINT `syllabus_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `main` (`bookID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
