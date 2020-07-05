-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2020 at 01:30 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
('admin1', '456', 'admin1', 'dummy'),
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
  `stud_ID` varchar(50) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL,
  `status` text DEFAULT NULL,
  `returnTime` bigint(20) DEFAULT NULL,
  `shelfID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `copies`
--

INSERT INTO `copies` (`bookID`, `copyNO`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`) VALUES
(1, 1, '', '1 - 1', NULL, NULL, '', NULL, NULL),
(1, 2, '', '1 - 2', NULL, NULL, '', NULL, 'shelf1'),
(1, 3, '', '1 - 3', NULL, NULL, '', NULL, NULL),
(2, 1, '', '2 - 1', NULL, 1593948092, '', 1593948112, 'shelf2'),
(2, 2, '', '2 - 2', '14482', 1593947994, 'issued', 1593948014, 'shelf1'),
(3, 1, '', '3 - 1', NULL, NULL, '', NULL, 'shelf2'),
(3, 2, '', '3 - 2', '14332', 1593948265, 'issued', 1593948285, 'shelf1'),
(3, 3, '', '3 - 3', NULL, NULL, '', NULL, 'shelf2'),
(3, 4, '', '3 - 4', NULL, 1593948271, '', 1593948291, NULL);

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
  `adminID` varchar(50) DEFAULT NULL,
  `studentID` varchar(50) DEFAULT NULL,
  `action` text NOT NULL,
  `time` bigint(20) NOT NULL,
  `bookID` int(50) NOT NULL,
  `oldID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES
(1, '1 - 1', 'manu21', NULL, 'add', 1593947705, 1, ''),
(2, '1 - 2', 'manu21', NULL, 'add', 1593947705, 1, ''),
(3, '1 - 3', 'manu21', NULL, 'add', 1593947705, 1, ''),
(4, '2 - 1', 'manu21', NULL, 'add', 1593947786, 2, ''),
(5, '2 - 2', 'manu21', NULL, 'add', 1593947786, 2, ''),
(6, '3 - 1', 'manu21', NULL, 'add', 1593947933, 3, ''),
(7, '3 - 2', 'manu21', NULL, 'add', 1593947933, 3, ''),
(8, '3 - 3', 'manu21', NULL, 'add', 1593947933, 3, ''),
(9, '3 - 4', 'manu21', NULL, 'add', 1593947933, 3, ''),
(10, '2 - 2', 'manu21', '14482', 'issue', 1593947994, 2, ''),
(11, '2 - 1', 'manu21', '14332', 'issue', 1593948092, 2, ''),
(12, '2 - 1', 'manu21', '14332', 'return', 1593948236, 2, ''),
(13, '3 - 2', 'manu21', '14332', 'issue', 1593948265, 3, ''),
(14, '3 - 4', 'manu21', '14482', 'issue', 1593948271, 3, ''),
(15, '3 - 4', 'manu21', '14482', 'return', 1593948273, 3, '');

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
  `star` varchar(1) DEFAULT NULL,
  `fine` varchar(50) NOT NULL,
  `due` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued`
--

INSERT INTO `issued` (`id`, `bookID`, `oldID`, `copyID`, `stud_ID`, `time`, `returnTime`, `star`, `fine`, `due`) VALUES
(1, 2, '', '2 - 2', '14482', 1593947994, NULL, NULL, '', 0),
(2, 2, '', '2 - 1', '14332', 1593948092, 1593948236, NULL, '', 0),
(3, 3, '', '3 - 2', '14332', 1593948265, NULL, NULL, '', 0),
(4, 3, '', '3 - 4', '14482', 1593948271, 1593948273, NULL, '', 0);

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
  `orgQuan` int(11) NOT NULL,
  `digital` tinyint(4) NOT NULL,
  `book` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`bookID`, `title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`, `digital`, `book`) VALUES
(1, 'Olympus', 'Devdutt Pattanaik', 3, 'Literature and rhetoric', 'American and Canadian literature', 'Fiction', 'history and criticism', 'Random House India', '296', 'INR 448.62', 'http://books.google.com/books/content?id=QUWqDQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2016-09-20', '9789385990199', 3, 0, 1),
(2, 'Sidney Sheldon’s The Silent Widow', 'Sidney Sheldon,Tilly Bagshawe', 2, 'Philosophy and Psychology', 'Epistemology, causation, humankind', 'Epistemology', '', 'HarperCollins', '448', 'INR 401.67', 'http://books.google.com/books/content?id=8hJCDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2018-06-14', '9780008229665', 2, 0, 1),
(3, 'Inferno', 'Dan Brown', 4, 'Literature and rhetoric', 'American and Canadian literature', 'Fiction', 'history and criticism', 'Random House', '619', '', 'http://books.google.com/books/content?id=y_uIAwAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2014', '9780552169585', 4, 0, 1);

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
('shelf1'),
('shelf2');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_ID` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `points` int(5) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_ID`, `name`, `email`, `mobile`, `points`) VALUES
('14332', 'shraddha', 'shraddha651@gmail.com', '8655266790', 100),
('14333', 'symmka', 'symmka.ng@gmail.com', '865659562', 100),
('14482', 'Manjunath Naik', 'manjunath2000@hotmail.com', '9322289496', 100);

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
  ADD KEY `shelfID` (`shelfID`),
  ADD KEY `stud_ID` (`stud_ID`);

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
  ADD PRIMARY KEY (`bookID`),
  ADD UNIQUE KEY `uni_book` (`title`,`author`,`isbn`) USING HASH;

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`shelfID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stud_ID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `issued`
--
ALTER TABLE `issued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `main`
--
ALTER TABLE `main`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `copies`
--
ALTER TABLE `copies`
  ADD CONSTRAINT `copies_ibfk_3` FOREIGN KEY (`bookID`) REFERENCES `main` (`bookID`),
  ADD CONSTRAINT `copies_ibfk_4` FOREIGN KEY (`shelfID`) REFERENCES `shelf` (`shelfID`),
  ADD CONSTRAINT `copies_ibfk_5` FOREIGN KEY (`stud_ID`) REFERENCES `students` (`stud_ID`);

--
-- Constraints for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD CONSTRAINT `syllabus_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `main` (`bookID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
