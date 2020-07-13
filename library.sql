-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 03:40 PM
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
  `lname` text NOT NULL,
  `clearance` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`userID`, `password`, `fname`, `lname`, `clearance`) VALUES
('admin1', '456', 'admin1', 'dummy', 1),
('manu21', '123', 'Manu', 'Naik', 2);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `stud_ID` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `stud_ID`, `name`, `message`, `time`) VALUES
(1, 'a', 'a', 'message1', 1594401441),
(2, 'b', 'b', '2nd', 1594401493),
(3, '14332', 'shraddha', 'hello', 1594406881),
(4, 'xyz', 'xyz', 'heyyyyy', 1594407702),
(30, 'null ', 'shraddha ', 'hola', 1594473693),
(34, '14332', 'shraddha', 'helooooo', 1594473824),
(38, '14332', 'shraddha', 'good eve', 1594474114),
(41, 'null ', 'shraddha ', 'for widgets that always build the same way given a particular configuration and ambient state.', 1594474494);

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
(1, 2, '', '1 - 2', NULL, NULL, '', NULL, NULL),
(1, 3, '', '1 - 3', NULL, NULL, '', NULL, NULL),
(2, 1, '', '2 - 1', '14332', 1594634908, 'issued', 1595239708, NULL),
(2, 2, '', '2 - 2', '14482', 1594634844, 'issued', 1595239644, NULL),
(2, 3, '', '2 - 3', NULL, NULL, '', NULL, NULL),
(3, 1, '', '3 - 1', NULL, NULL, '', NULL, NULL),
(3, 2, '', '3 - 2', '14332', 1594634925, 'issued', 1595239725, NULL),
(3, 3, '', '3 - 3', NULL, NULL, '', NULL, NULL),
(3, 4, '', '3 - 4', NULL, NULL, '', NULL, NULL),
(4, 1, '', '4 - 1', NULL, NULL, '', NULL, NULL),
(4, 2, '', '4 - 2', NULL, NULL, '', NULL, NULL),
(5, 1, '', '5 - 1', '14482', 1594634982, 'issued', 1595239782, NULL);

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
(1, '1 - 1', 'manu21', NULL, 'add', 1594634404, 1, ''),
(2, '1 - 2', 'manu21', NULL, 'add', 1594634404, 1, ''),
(3, '1 - 3', 'manu21', NULL, 'add', 1594634404, 1, ''),
(4, '2 - 1', 'manu21', NULL, 'add', 1594634509, 2, ''),
(5, '2 - 2', 'manu21', NULL, 'add', 1594634509, 2, ''),
(6, '2 - 3', 'manu21', NULL, 'add', 1594634509, 2, ''),
(7, '3 - 1', 'manu21', NULL, 'add', 1594634555, 3, ''),
(8, '3 - 2', 'manu21', NULL, 'add', 1594634555, 3, ''),
(9, '3 - 3', 'manu21', NULL, 'add', 1594634555, 3, ''),
(10, '3 - 4', 'manu21', NULL, 'add', 1594634555, 3, ''),
(11, '4 - 1', 'manu21', NULL, 'add', 1594634587, 4, ''),
(12, '4 - 2', 'manu21', NULL, 'add', 1594634588, 4, ''),
(13, '5 - 1', 'manu21', NULL, 'add', 1594634619, 5, ''),
(14, '2 - 2', 'manu21', '14482', 'issue', 1594634844, 2, ''),
(15, '2 - 1', 'manu21', '14332', 'issue', 1594634908, 2, ''),
(16, '3 - 2', 'manu21', '14332', 'issue', 1594634925, 3, ''),
(17, '3 - 4', 'manu21', '14482', 'issue', 1594634933, 3, ''),
(18, '3 - 4', 'manu21', '14482', 'return', 1594634970, 3, ''),
(19, '5 - 1', 'manu21', '14482', 'issue', 1594634982, 5, '');

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
  `fine` varchar(50) DEFAULT NULL,
  `due` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued`
--

INSERT INTO `issued` (`id`, `bookID`, `oldID`, `copyID`, `stud_ID`, `time`, `returnTime`, `star`, `fine`, `due`) VALUES
(1, 2, '', '2 - 2', '14482', 1594634844, NULL, NULL, NULL, 0),
(2, 2, '', '2 - 1', '14332', 1594634908, NULL, NULL, NULL, 0),
(3, 3, '', '3 - 2', '14332', 1594634925, NULL, NULL, NULL, 0),
(4, 3, '', '3 - 4', '14482', 1594634933, 1594634970, NULL, '-14', 1),
(5, 5, '', '5 - 1', '14482', 1594634982, NULL, NULL, NULL, 0);

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
  `book` tinyint(4) NOT NULL,
  `digitalLink` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`bookID`, `title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`, `digital`, `book`, `digitalLink`) VALUES
(1, 'Olympus', 'Devdutt Pattanaik', 3, 'Literature and rhetoric', 'American and Canadian literature', 'Fiction', 'collections, short stories', 'Random House India', '296', 'INR 448.62', 'http://books.google.com/books/content?id=QUWqDQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2016-09-20', '9789385990199', 3, 0, 1, ''),
(2, 'Sidney Sheldon’s The Silent Widow', 'Sidney Sheldon,Tilly Bagshawe', 3, 'Literature and rhetoric', 'English and Old English literatures and other literatures commonly translated into English', 'Fiction', 'collections, short stories', 'HarperCollins', '448', 'INR 396.84', 'http://books.google.com/books/content?id=8hJCDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2018-06-14', '9780008229665', 3, 0, 1, ''),
(3, 'Inferno', 'Dan Brown', 4, 'Literature and rhetoric', 'American and Canadian literature', 'Fiction', 'collections, short stories', 'Random House', '619', '', 'http://books.google.com/books/content?id=y_uIAwAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2014', '9780552169585', 4, 0, 1, ''),
(4, 'Sa Re Ga Ma Pa', 'Jessica Foreman', 2, 'The Arts', 'Music', 'Vocal music', 'Secular forms', 'Independently Published', '', '', 'http://books.google.com/books/content?id=OR-UzQEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2020-05-28', '9798649351003', 2, 0, 0, ''),
(5, 'Python Data Science Handbook', 'Jake VanderPlas', 1, 'Generalities', 'Generalities and computer science', 'Special computer methods', 'Artificial intelligence', '\"O\'Reilly Media, Inc.\"', '548', 'INR 2513.4', 'http://books.google.com/books/content?id=6omNDQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2016-11-21', '9781491912133', 1, 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `sem_branch`
--

CREATE TABLE `sem_branch` (
  `sem_branchID` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sem_branch`
--

INSERT INTO `sem_branch` (`sem_branchID`, `sem`, `branch`) VALUES
(1, 1, 'comps'),
(2, 2, 'comps'),
(3, 3, 'comps'),
(4, 4, 'comps'),
(5, 1, 'extc'),
(6, 2, 'extc'),
(7, 3, 'extc'),
(8, 4, 'extc');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `parameter` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`parameter`, `value`) VALUES
('dueFine', '2'),
('duePoint', '5'),
('issueNum', '2'),
('issuePeriod', '7'),
('issuePoint', '5'),
('reserveNum', '2'),
('reservePeriod', '2'),
('returnPoint', '5');

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
  `points` int(5) NOT NULL DEFAULT 100,
  `block` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_ID`, `name`, `email`, `mobile`, `points`, `block`) VALUES
('14332', 'shraddha', 'shraddha651@gmail.com', '8655266790', 110, 0),
('14333', 'symmka', 'symmka.ng@gmail.com', '865659562', 100, 0),
('14482', 'Manjunath Naik', 'manjunath2000@hotmail.com', '9322289496', 545, 0);

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `id` int(11) NOT NULL,
  `sem_branchID` int(11) NOT NULL,
  `bookID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`id`, `sem_branchID`, `bookID`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sem_branch`
--
ALTER TABLE `sem_branch`
  ADD PRIMARY KEY (`sem_branchID`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`parameter`);

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
  ADD UNIQUE KEY `sem_branchID` (`sem_branchID`),
  ADD KEY `bookID` (`bookID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `issued`
--
ALTER TABLE `issued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `main`
--
ALTER TABLE `main`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sem_branch`
--
ALTER TABLE `sem_branch`
  MODIFY `sem_branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `copies`
--
ALTER TABLE `copies`
  ADD CONSTRAINT `copies_ibfk_5` FOREIGN KEY (`stud_ID`) REFERENCES `students` (`stud_ID`),
  ADD CONSTRAINT `copies_ibfk_6` FOREIGN KEY (`shelfID`) REFERENCES `shelf` (`shelfID`) ON DELETE SET NULL,
  ADD CONSTRAINT `copies_ibfk_7` FOREIGN KEY (`bookID`) REFERENCES `main` (`bookID`) ON DELETE CASCADE;

--
-- Constraints for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD CONSTRAINT `syllabus_ibfk_2` FOREIGN KEY (`sem_branchID`) REFERENCES `sem_branch` (`sem_branchID`) ON DELETE CASCADE,
  ADD CONSTRAINT `syllabus_ibfk_3` FOREIGN KEY (`bookID`) REFERENCES `main` (`bookID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
