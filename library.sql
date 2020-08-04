-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2020 at 05:49 PM
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
  `password` varchar(50) NOT NULL DEFAULT 'adminPass',
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `clearance` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`userID`, `password`, `fname`, `lname`, `clearance`) VALUES
('admin1', '456', 'admin1', 'dummy', 1),
('manu21', '123', 'Manu', 'Naik', 3);

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
(41, 'null ', 'shraddha ', 'for widgets that always build the same way given a particular configuration and ambient state.', 1594474494),
(42, 'manu21', 'Manu', 'hola amigo', 1595605350),
(43, 'manu21', 'Manu', 'adios', 1595619018),
(44, '14482 ', 'Manjunath Naik ', 'hi amit', 1596349600),
(45, '14482 ', 'Manjunath Naik ', '..igkuh', 1596349612),
(46, '14482 ', 'Manjunath Naik ', '..igkuh', 1596349615);

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
  `shelfID` varchar(50) DEFAULT NULL,
  `purchaseTime` bigint(20) DEFAULT NULL,
  `purchaseSource` text NOT NULL,
  `price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `copies`
--

INSERT INTO `copies` (`bookID`, `copyNO`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`, `purchaseTime`, `purchaseSource`, `price`) VALUES
(1, 1, '32', '1 - 1', NULL, NULL, '', NULL, 'programming', 1596182760, 'XYZ Book Depot', 'INR 200'),
(1, 2, '33', '1 - 2', NULL, NULL, '', NULL, 'programming', 1596182760, 'XYZ Book Depot', 'INR 200'),
(1, 4, '35', '1 - 4', NULL, NULL, '', NULL, 'programming', 1596182760, 'XYZ Book Depot', 'INR 200'),
(1, 5, '36', '1 - 5', '14482', 1596185621, 'issued', 1596790421, 'programming', 1596182760, 'XYZ Book Depot', 'INR 200'),
(1, 6, '37', '1 - 6', NULL, NULL, '', NULL, NULL, 1596182760, 'XYZ Book Depot', 'INR 200'),
(1, 7, '38', '1 - 7', NULL, NULL, '', NULL, NULL, 1596182760, 'XYZ Book Depot', 'INR 200'),
(10, 1, '', '10 - 1', NULL, NULL, '', NULL, 'programming', 1595752260, 'XYZ Book Depot', 'INR 224.77'),
(10, 2, '', '10 - 2', '78945', 1596255985, 'issued', 1596860785, 'programming', 1595752260, 'XYZ Book Depot', 'INR 224.77'),
(10, 3, '', '10 - 3', NULL, NULL, '', NULL, NULL, 1595752260, 'XYZ Book Depot', 'INR 224.77'),
(10, 5, '', '10 - 5', NULL, NULL, '', NULL, NULL, 1595752260, 'XYZ Book Depot', 'INR 224.77'),
(11, 1, '', '11 - 1', NULL, NULL, '', NULL, NULL, 1595838780, '', 'INR 220'),
(11, 2, '', '11 - 2', NULL, NULL, '', NULL, NULL, 1595838780, '', 'INR 220'),
(11, 3, '', '11 - 3', NULL, NULL, '', NULL, NULL, 1595838780, '', 'INR 220'),
(11, 4, '', '11 - 4', NULL, NULL, '', NULL, NULL, 1595838780, '', 'INR 220'),
(11, 5, '', '11 - 5', NULL, NULL, '', NULL, NULL, 0, '', ''),
(11, 6, '', '11 - 6', NULL, NULL, '', NULL, NULL, 0, '', ''),
(12, 1, '', '12 - 1', NULL, NULL, '', NULL, 'programming', 1595493300, 'XYZ Book Depot', 'INR 318'),
(12, 2, '', '12 - 2', NULL, NULL, '', NULL, 'programming', 1595493300, 'XYZ Book Depot', 'INR 318'),
(12, 3, '', '12 - 3', NULL, NULL, '', NULL, 'programming', 1595493300, 'XYZ Book Depot', 'INR 318'),
(12, 4, '', '12 - 4', NULL, NULL, '', NULL, NULL, 1595493300, 'XYZ Book Depot', 'INR 318'),
(12, 5, '', '12 - 5', NULL, NULL, '', NULL, NULL, 1595493300, 'XYZ Book Depot', 'INR 318'),
(12, 6, '', '12 - 6', NULL, NULL, '', NULL, NULL, 1595493300, 'XYZ Book Depot', 'INR 318'),
(13, 1, '', '13 - 1', NULL, NULL, '', NULL, NULL, 1596184860, 'ABC Book Depot', 'INR 446'),
(13, 2, '', '13 - 2', NULL, NULL, '', NULL, NULL, 1596184860, 'ABC Book Depot', 'INR 446'),
(13, 3, '', '13 - 3', '14332', 1596256146, 'issued', 1596860946, NULL, 1596184860, 'ABC Book Depot', 'INR 446'),
(13, 4, '', '13 - 4', NULL, NULL, '', NULL, NULL, 1596184860, 'ABC Book Depot', 'INR 446'),
(13, 5, '', '13 - 5', NULL, NULL, '', NULL, NULL, 1596184860, 'ABC Book Depot', 'INR 446'),
(13, 6, '', '13 - 6', NULL, NULL, '', NULL, NULL, 1596184860, 'ABC Book Depot', 'INR 446'),
(14, 1, '', '14 - 1', NULL, NULL, '', NULL, NULL, 1595666640, 'XYZ Book Depot', 'INR 200'),
(14, 2, '', '14 - 2', NULL, NULL, '', NULL, NULL, 1595666640, 'XYZ Book Depot', 'INR 200'),
(14, 3, '', '14 - 3', NULL, NULL, '', NULL, NULL, 1595666640, 'XYZ Book Depot', 'INR 200'),
(14, 4, '', '14 - 4', NULL, NULL, '', NULL, NULL, 1595666640, 'XYZ Book Depot', 'INR 200'),
(14, 5, '', '14 - 5', NULL, NULL, '', NULL, NULL, 1595666640, 'XYZ Book Depot', 'INR 200'),
(14, 6, '', '14 - 6', NULL, NULL, '', NULL, NULL, 1595666640, 'XYZ Book Depot', 'INR 200'),
(14, 7, '', '14 - 7', '14396', 1596256291, 'issued', 1596861091, NULL, 1595666640, 'XYZ Book Depot', 'INR 200'),
(15, 1, '4', '15 - 1', NULL, NULL, '', NULL, 'programming', 0, 'XYZ Book Depot', 'INR 3174.2'),
(15, 10, '', '15 - 10', NULL, NULL, '', NULL, 'programming', 0, 'XYZ Book Depot', 'INR 3174.2'),
(15, 2, '5', '15 - 2', NULL, NULL, '', NULL, 'programming', 0, 'XYZ Book Depot', 'INR 3174.2'),
(15, 3, '6', '15 - 3', NULL, NULL, '', NULL, 'programming', 0, 'XYZ Book Depot', 'INR 3174.2'),
(15, 4, '', '15 - 4', NULL, NULL, '', NULL, NULL, 0, 'XYZ Book Depot', 'INR 3174.2'),
(15, 5, '', '15 - 5', NULL, NULL, '', NULL, NULL, 0, 'XYZ Book Depot', 'INR 3174.2'),
(15, 6, '', '15 - 6', NULL, NULL, '', NULL, NULL, 0, 'XYZ Book Depot', 'INR 3174.2'),
(15, 7, '', '15 - 7', NULL, NULL, '', NULL, NULL, 0, 'XYZ Book Depot', 'INR 3174.2'),
(15, 8, '', '15 - 8', NULL, NULL, '', NULL, NULL, 0, 'XYZ Book Depot', 'INR 3174.2'),
(15, 9, '', '15 - 9', NULL, NULL, '', NULL, NULL, 0, 'XYZ Book Depot', 'INR 3174.2'),
(16, 1, '', '16 - 1', NULL, NULL, '', NULL, NULL, 1596254100, 'ABC Book Depot', 'INR 3251.55'),
(16, 2, '', '16 - 2', '87907', 1596255954, 'issued', 1597465554, NULL, 1596254100, 'ABC Book Depot', 'INR 3251.55'),
(16, 3, '', '16 - 3', NULL, NULL, '', NULL, NULL, 1596254100, 'ABC Book Depot', 'INR 3251.55'),
(16, 4, '', '16 - 4', NULL, NULL, '', NULL, NULL, 1596254100, 'ABC Book Depot', 'INR 3251.55'),
(16, 5, '', '16 - 5', NULL, NULL, '', NULL, NULL, 1596254100, 'ABC Book Depot', 'INR 3251.55'),
(16, 6, '', '16 - 6', NULL, NULL, '', NULL, NULL, 1596254100, 'ABC Book Depot', 'INR 3251.55'),
(17, 1, '', '17 - 1', NULL, NULL, '', NULL, 'applied sciences', 1596255300, 'XYZ Book Depot', 'INR 448.62'),
(17, 2, '', '17 - 2', NULL, NULL, '', NULL, 'applied sciences', 1596255300, 'XYZ Book Depot', 'INR 448.62'),
(17, 3, '', '17 - 3', NULL, NULL, '', NULL, 'applied sciences', 1596255300, 'XYZ Book Depot', 'INR 448.62'),
(17, 4, '', '17 - 4', NULL, NULL, '', NULL, 'applied sciences', 1596255300, 'XYZ Book Depot', 'INR 448.62'),
(17, 5, '', '17 - 5', NULL, NULL, '', NULL, 'applied sciences', 1596255300, 'XYZ Book Depot', 'INR 448.62'),
(17, 6, '', '17 - 6', NULL, NULL, '', NULL, 'applied sciences', 1596255300, 'XYZ Book Depot', 'INR 448.62'),
(2, 1, '40', '2 - 1', NULL, NULL, '', NULL, NULL, 1595318940, 'XYZ Book Depot', 'INR 100'),
(2, 2, '41', '2 - 2', NULL, NULL, '', NULL, NULL, 1595318940, 'XYZ Book Depot', 'INR 100'),
(2, 3, '42', '2 - 3', NULL, NULL, '', NULL, NULL, 1595318940, 'XYZ Book Depot', 'INR 100'),
(2, 4, '43', '2 - 4', NULL, NULL, '', NULL, NULL, 1595318940, 'XYZ Book Depot', 'INR 100'),
(3, 1, '1', '3 - 1', NULL, NULL, '', NULL, 'applied sciences', 1595491860, 'ABC Book Depot', 'INR 448.62'),
(3, 2, '2', '3 - 2', NULL, NULL, '', NULL, 'applied sciences', 1595491860, 'ABC Book Depot', 'INR 448.62'),
(3, 3, '3', '3 - 3', NULL, NULL, '', NULL, 'applied sciences', 1595491860, 'ABC Book Depot', 'INR 448.62'),
(3, 4, '4', '3 - 4', NULL, NULL, '', NULL, 'applied sciences', 1595491860, 'ABC Book Depot', 'INR 448.62'),
(3, 5, '5', '3 - 5', NULL, NULL, '', NULL, 'applied sciences', 1595491860, 'ABC Book Depot', 'INR 448.62'),
(3, 6, '6', '3 - 6', NULL, NULL, '', NULL, 'applied sciences', 1595491860, 'ABC Book Depot', 'INR 448.62'),
(3, 7, '7', '3 - 7', NULL, NULL, '', NULL, 'applied sciences', 1595491860, 'ABC Book Depot', 'INR 448.62'),
(3, 8, '8', '3 - 8', NULL, NULL, '', NULL, 'applied sciences', 1595491860, 'ABC Book Depot', 'INR 448.62'),
(4, 1, '', '4 - 1', NULL, NULL, '', NULL, 'applied sciences', 1595405580, 'XYZ Book Depot', 'INR 432'),
(4, 2, '', '4 - 2', NULL, NULL, '', NULL, 'applied sciences', 1595405580, 'XYZ Book Depot', 'INR 432'),
(4, 3, '', '4 - 3', NULL, NULL, '', NULL, 'applied sciences', 1595405580, 'XYZ Book Depot', 'INR 432'),
(4, 4, '', '4 - 4', NULL, NULL, '', NULL, 'applied sciences', 1595405580, 'XYZ Book Depot', 'INR 432'),
(4, 5, '', '4 - 5', NULL, NULL, '', NULL, 'applied sciences', 1595405580, 'XYZ Book Depot', 'INR 432'),
(4, 6, '', '4 - 6', NULL, NULL, '', NULL, 'applied sciences', 1595405580, 'XYZ Book Depot', 'INR 432'),
(4, 7, '', '4 - 7', NULL, NULL, '', NULL, 'applied sciences', 0, '', ''),
(4, 8, '', '4 - 8', NULL, NULL, '', NULL, 'applied sciences', 0, '', ''),
(5, 1, '', '5 - 1', NULL, NULL, '', NULL, 'applied sciences', 1596097080, 'XYZ Book Depot', 'INR 224.77'),
(5, 2, '', '5 - 2', NULL, NULL, '', NULL, 'applied sciences', 1596097080, 'XYZ Book Depot', 'INR 224.77'),
(5, 3, '', '5 - 3', NULL, NULL, '', NULL, 'applied sciences', 1596097080, 'XYZ Book Depot', 'INR 224.77'),
(5, 4, '', '5 - 4', NULL, NULL, '', NULL, 'applied sciences', 1596097080, 'XYZ Book Depot', 'INR 224.77'),
(5, 5, '', '5 - 5', NULL, NULL, '', NULL, 'applied sciences', 1596097080, 'XYZ Book Depot', 'INR 224.77'),
(5, 6, '', '5 - 6', NULL, NULL, '', NULL, 'applied sciences', 1596097080, 'XYZ Book Depot', 'INR 224.77'),
(5, 7, '', '5 - 7', NULL, NULL, '', NULL, 'applied sciences', 1596097080, 'XYZ Book Depot', 'INR 224.77'),
(6, 1, '', '6 - 1', NULL, NULL, '', NULL, NULL, 1594110000, 'ABC Book Depot', 'INR 356.53'),
(6, 2, '', '6 - 2', '14396', 1596183732, 'issued', 1596788532, NULL, 1594110000, 'ABC Book Depot', 'INR 356.53'),
(6, 3, '', '6 - 3', NULL, NULL, '', NULL, NULL, 1594110000, 'ABC Book Depot', 'INR 356.53'),
(6, 4, '', '6 - 4', NULL, NULL, '', NULL, NULL, 1594110000, 'ABC Book Depot', 'INR 356.53'),
(6, 5, '', '6 - 5', NULL, NULL, '', NULL, NULL, 1594110000, 'ABC Book Depot', 'INR 356.53'),
(6, 6, '', '6 - 6', NULL, NULL, '', NULL, NULL, 1594110000, 'ABC Book Depot', 'INR 356.53'),
(6, 7, '', '6 - 7', NULL, NULL, '', NULL, NULL, 1594110000, 'ABC Book Depot', 'INR 356.53'),
(6, 8, '', '6 - 8', NULL, NULL, '', NULL, NULL, 1594110000, 'ABC Book Depot', 'INR 356.53'),
(6, 9, '', '6 - 9', NULL, NULL, '', NULL, NULL, 1594110000, 'ABC Book Depot', 'INR 356.53'),
(7, 1, '', '7 - 1', NULL, NULL, '', NULL, NULL, 1595579100, 'XYZ Book Depot', 'INR 7187.38'),
(7, 2, '', '7 - 2', NULL, NULL, '', NULL, NULL, 1595579100, 'XYZ Book Depot', 'INR 7187.38'),
(7, 3, '', '7 - 3', NULL, NULL, '', NULL, NULL, 1595579100, 'XYZ Book Depot', 'INR 7187.38'),
(7, 4, '', '7 - 4', NULL, NULL, '', NULL, NULL, 1595579100, 'XYZ Book Depot', 'INR 7187.38'),
(7, 5, '', '7 - 5', NULL, NULL, '', NULL, NULL, 1595579100, 'XYZ Book Depot', 'INR 7187.38'),
(7, 6, '', '7 - 6', NULL, NULL, '', NULL, NULL, 1595579100, 'XYZ Book Depot', 'INR 7187.38'),
(7, 7, '', '7 - 7', NULL, NULL, '', NULL, NULL, 1595579100, 'XYZ Book Depot', 'INR 7187.38'),
(8, 1, '', '8 - 1', NULL, NULL, '', NULL, 'applied sciences', 0, 'ABC Book Depot', 'INR 350'),
(8, 2, '', '8 - 2', NULL, NULL, '', NULL, 'applied sciences', 0, 'ABC Book Depot', 'INR 350'),
(8, 3, '', '8 - 3', NULL, NULL, '', NULL, 'applied sciences', 0, 'ABC Book Depot', 'INR 350'),
(8, 4, '', '8 - 4', NULL, NULL, '', NULL, 'applied sciences', 0, 'ABC Book Depot', 'INR 350'),
(8, 5, '', '8 - 5', NULL, NULL, '', NULL, 'applied sciences', 0, 'ABC Book Depot', 'INR 350'),
(9, 1, '', '9 - 1', NULL, NULL, '', NULL, 'programming', 1594628880, 'XYZ Book Depot', 'INR 440'),
(9, 10, '', '9 - 10', NULL, NULL, '', NULL, 'programming', 1594628880, 'XYZ Book Depot', 'INR 440'),
(9, 2, '', '9 - 2', NULL, NULL, '', NULL, 'programming', 1594628880, 'XYZ Book Depot', 'INR 440'),
(9, 3, '', '9 - 3', NULL, NULL, '', NULL, 'programming', 1594628880, 'XYZ Book Depot', 'INR 440'),
(9, 4, '', '9 - 4', NULL, NULL, '', NULL, NULL, 1594628880, 'XYZ Book Depot', 'INR 440'),
(9, 5, '', '9 - 5', NULL, NULL, '', NULL, NULL, 1594628880, 'XYZ Book Depot', 'INR 440'),
(9, 6, '', '9 - 6', NULL, NULL, '', NULL, NULL, 1594628880, 'XYZ Book Depot', 'INR 440'),
(9, 7, '', '9 - 7', NULL, NULL, '', NULL, NULL, 1594628880, 'XYZ Book Depot', 'INR 440'),
(9, 8, '', '9 - 8', NULL, NULL, '', NULL, NULL, 1594628880, 'XYZ Book Depot', 'INR 440'),
(9, 9, '', '9 - 9', NULL, NULL, '', NULL, NULL, 1594628880, 'XYZ Book Depot', 'INR 440');

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
(1, '1 - 1', 'manu21', NULL, 'add', 1596182902, 1, '32'),
(2, '1 - 2', 'manu21', NULL, 'add', 1596182902, 1, '33'),
(3, '1 - 3', 'manu21', NULL, 'add', 1596182902, 1, '34'),
(4, '1 - 4', 'manu21', NULL, 'add', 1596182902, 1, '35'),
(5, '1 - 5', 'manu21', NULL, 'add', 1596182902, 1, '36'),
(6, '1 - 6', 'manu21', NULL, 'add', 1596182902, 1, '37'),
(7, '1 - 7', 'manu21', NULL, 'add', 1596182902, 1, '38'),
(8, '2 - 1', 'manu21', NULL, 'add', 1596183001, 2, '40'),
(9, '2 - 2', 'manu21', NULL, 'add', 1596183001, 2, '41'),
(10, '2 - 3', 'manu21', NULL, 'add', 1596183001, 2, '42'),
(11, '2 - 4', 'manu21', NULL, 'add', 1596183001, 2, '43'),
(12, '3 - 1', 'manu21', NULL, 'add', 1596183123, 3, '1'),
(13, '3 - 2', 'manu21', NULL, 'add', 1596183124, 3, '2'),
(14, '3 - 3', 'manu21', NULL, 'add', 1596183124, 3, '3'),
(15, '3 - 4', 'manu21', NULL, 'add', 1596183124, 3, '4'),
(16, '3 - 5', 'manu21', NULL, 'add', 1596183124, 3, '5'),
(17, '3 - 6', 'manu21', NULL, 'add', 1596183124, 3, '6'),
(18, '3 - 7', 'manu21', NULL, 'add', 1596183124, 3, '7'),
(19, '3 - 8', 'manu21', NULL, 'add', 1596183124, 3, '8'),
(20, '4 - 1', 'manu21', NULL, 'add', 1596183257, 4, ''),
(21, '4 - 2', 'manu21', NULL, 'add', 1596183257, 4, ''),
(22, '4 - 3', 'manu21', NULL, 'add', 1596183257, 4, ''),
(23, '4 - 4', 'manu21', NULL, 'add', 1596183257, 4, ''),
(24, '4 - 5', 'manu21', NULL, 'add', 1596183257, 4, ''),
(25, '4 - 6', 'manu21', NULL, 'add', 1596183257, 4, ''),
(26, '1 - 2', 'manu21', '12345', 'issue', 1596183333, 1, '33'),
(27, '1 - 3', 'manu21', NULL, 'delete', 1596183401, 1, '34'),
(28, '4 - 7', 'manu21', NULL, 'add', 1596183445, 4, ''),
(29, '4 - 8', 'manu21', NULL, 'add', 1596183445, 4, ''),
(30, '5 - 1', 'manu21', NULL, 'add', 1596183506, 5, ''),
(31, '5 - 2', 'manu21', NULL, 'add', 1596183506, 5, ''),
(32, '5 - 3', 'manu21', NULL, 'add', 1596183506, 5, ''),
(33, '5 - 4', 'manu21', NULL, 'add', 1596183506, 5, ''),
(34, '5 - 5', 'manu21', NULL, 'add', 1596183506, 5, ''),
(35, '5 - 6', 'manu21', NULL, 'add', 1596183506, 5, ''),
(36, '5 - 7', 'manu21', NULL, 'add', 1596183506, 5, ''),
(37, '6 - 1', 'manu21', NULL, 'add', 1596183655, 6, ''),
(38, '6 - 2', 'manu21', NULL, 'add', 1596183655, 6, ''),
(39, '6 - 3', 'manu21', NULL, 'add', 1596183655, 6, ''),
(40, '6 - 4', 'manu21', NULL, 'add', 1596183655, 6, ''),
(41, '6 - 5', 'manu21', NULL, 'add', 1596183655, 6, ''),
(42, '6 - 6', 'manu21', NULL, 'add', 1596183655, 6, ''),
(43, '6 - 7', 'manu21', NULL, 'add', 1596183655, 6, ''),
(44, '6 - 8', 'manu21', NULL, 'add', 1596183655, 6, ''),
(45, '6 - 9', 'manu21', NULL, 'add', 1596183655, 6, ''),
(46, '6 - 2', 'manu21', '14396', 'issue', 1596183732, 6, ''),
(47, '7 - 1', 'manu21', NULL, 'add', 1596183924, 7, ''),
(48, '7 - 2', 'manu21', NULL, 'add', 1596183924, 7, ''),
(49, '7 - 3', 'manu21', NULL, 'add', 1596183924, 7, ''),
(50, '7 - 4', 'manu21', NULL, 'add', 1596183924, 7, ''),
(51, '7 - 5', 'manu21', NULL, 'add', 1596183924, 7, ''),
(52, '7 - 6', 'manu21', NULL, 'add', 1596183924, 7, ''),
(53, '7 - 7', 'manu21', NULL, 'add', 1596183924, 7, ''),
(54, '8 - 1', 'manu21', NULL, 'add', 1596184057, 8, ''),
(55, '8 - 2', 'manu21', NULL, 'add', 1596184057, 8, ''),
(56, '8 - 3', 'manu21', NULL, 'add', 1596184057, 8, ''),
(57, '8 - 4', 'manu21', NULL, 'add', 1596184057, 8, ''),
(58, '8 - 5', 'manu21', NULL, 'add', 1596184057, 8, ''),
(59, '9 - 1', 'manu21', NULL, 'add', 1596184144, 9, ''),
(60, '9 - 2', 'manu21', NULL, 'add', 1596184144, 9, ''),
(61, '9 - 3', 'manu21', NULL, 'add', 1596184144, 9, ''),
(62, '9 - 4', 'manu21', NULL, 'add', 1596184144, 9, ''),
(63, '9 - 5', 'manu21', NULL, 'add', 1596184144, 9, ''),
(64, '9 - 6', 'manu21', NULL, 'add', 1596184144, 9, ''),
(65, '9 - 7', 'manu21', NULL, 'add', 1596184144, 9, ''),
(66, '9 - 8', 'manu21', NULL, 'add', 1596184144, 9, ''),
(67, '9 - 9', 'manu21', NULL, 'add', 1596184144, 9, ''),
(68, '9 - 10', 'manu21', NULL, 'add', 1596184144, 9, ''),
(69, '10 - 1', 'manu21', NULL, 'add', 1596184317, 10, ''),
(70, '10 - 2', 'manu21', NULL, 'add', 1596184317, 10, ''),
(71, '10 - 3', 'manu21', NULL, 'add', 1596184317, 10, ''),
(72, '10 - 4', 'manu21', NULL, 'add', 1596184317, 10, ''),
(73, '10 - 5', 'manu21', NULL, 'add', 1596184317, 10, ''),
(74, '11 - 1', 'manu21', NULL, 'add', 1596184389, 11, ''),
(75, '11 - 2', 'manu21', NULL, 'add', 1596184389, 11, ''),
(76, '11 - 3', 'manu21', NULL, 'add', 1596184389, 11, ''),
(77, '11 - 4', 'manu21', NULL, 'add', 1596184389, 11, ''),
(78, '12 - 1', 'manu21', NULL, 'add', 1596184563, 12, ''),
(79, '12 - 2', 'manu21', NULL, 'add', 1596184563, 12, ''),
(80, '12 - 3', 'manu21', NULL, 'add', 1596184563, 12, ''),
(81, '12 - 4', 'manu21', NULL, 'add', 1596184563, 12, ''),
(82, '12 - 5', 'manu21', NULL, 'add', 1596184563, 12, ''),
(83, '12 - 6', 'manu21', NULL, 'add', 1596184563, 12, ''),
(84, '13 - 1', 'manu21', NULL, 'add', 1596184935, 13, ''),
(85, '13 - 2', 'manu21', NULL, 'add', 1596184935, 13, ''),
(86, '13 - 3', 'manu21', NULL, 'add', 1596184935, 13, ''),
(87, '13 - 4', 'manu21', NULL, 'add', 1596184935, 13, ''),
(88, '13 - 5', 'manu21', NULL, 'add', 1596184935, 13, ''),
(89, '13 - 6', 'manu21', NULL, 'add', 1596184935, 13, ''),
(90, '14 - 1', 'manu21', NULL, 'add', 1596185099, 14, ''),
(91, '14 - 2', 'manu21', NULL, 'add', 1596185099, 14, ''),
(92, '14 - 3', 'manu21', NULL, 'add', 1596185099, 14, ''),
(93, '14 - 4', 'manu21', NULL, 'add', 1596185099, 14, ''),
(94, '14 - 5', 'manu21', NULL, 'add', 1596185099, 14, ''),
(95, '14 - 6', 'manu21', NULL, 'add', 1596185099, 14, ''),
(96, '14 - 7', 'manu21', NULL, 'add', 1596185099, 14, ''),
(97, '15 - 1', 'manu21', NULL, 'add', 1596185190, 15, '4'),
(98, '15 - 2', 'manu21', NULL, 'add', 1596185190, 15, '5'),
(99, '15 - 3', 'manu21', NULL, 'add', 1596185190, 15, '6'),
(100, '15 - 4', 'manu21', NULL, 'add', 1596185190, 15, ''),
(101, '15 - 5', 'manu21', NULL, 'add', 1596185190, 15, ''),
(102, '15 - 6', 'manu21', NULL, 'add', 1596185190, 15, ''),
(103, '15 - 7', 'manu21', NULL, 'add', 1596185190, 15, ''),
(104, '15 - 8', 'manu21', NULL, 'add', 1596185190, 15, ''),
(105, '15 - 9', 'manu21', NULL, 'add', 1596185190, 15, ''),
(106, '15 - 10', 'manu21', NULL, 'add', 1596185190, 15, ''),
(107, '12 - 3', 'manu21', '14333', 'issue', 1596185414, 12, ''),
(108, '10 - 4', 'manu21', NULL, 'delete', 1596185453, 10, ''),
(109, '10 - 1', 'manu21', '78945', 'issue', 1596185470, 10, ''),
(110, '12 - 3', 'manu21', '14333', 'return', 1596185585, 12, ''),
(111, '1 - 5', 'manu21', '14482', 'issue', 1596185621, 1, '36'),
(112, '16 - 1', 'manu21', NULL, 'add', 1596254172, 16, ''),
(113, '16 - 2', 'manu21', NULL, 'add', 1596254172, 16, ''),
(114, '16 - 3', 'manu21', NULL, 'add', 1596254172, 16, ''),
(115, '16 - 4', 'manu21', NULL, 'add', 1596254174, 16, ''),
(116, '16 - 5', 'manu21', NULL, 'add', 1596254174, 16, ''),
(117, '16 - 6', 'manu21', NULL, 'add', 1596254174, 16, ''),
(118, '17 - 1', 'manu21', NULL, 'add', 1596255353, 17, ''),
(119, '17 - 2', 'manu21', NULL, 'add', 1596255353, 17, ''),
(120, '17 - 3', 'manu21', NULL, 'add', 1596255353, 17, ''),
(121, '17 - 4', 'manu21', NULL, 'add', 1596255353, 17, ''),
(122, '17 - 5', 'manu21', NULL, 'add', 1596255353, 17, ''),
(123, '17 - 6', 'manu21', NULL, 'add', 1596255353, 17, ''),
(124, '16 - 2', 'manu21', '87907', 'issue', 1596255954, 16, ''),
(125, '10 - 2', 'manu21', '78945', 'issue', 1596255987, 10, ''),
(126, '10 - 1', 'manu21', '78945', 'return', 1596256077, 10, ''),
(127, '13 - 3', 'manu21', '14332', 'issue', 1596256147, 13, ''),
(128, '14 - 7', 'manu21', '14396', 'issue', 1596256291, 14, ''),
(129, '1 - 2', 'manu21', '12345', 'return', 1596256387, 1, '33'),
(130, '11 - 5', 'manu21', NULL, 'add', 1596367143, 11, ''),
(131, '-', 'manu21', NULL, 'update', 1596367143, 11, ''),
(132, '11 - 6', 'manu21', NULL, 'add', 1596367238, 11, '');

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
(1, 1, '33', '1 - 2', '12345', 1596183333, 1596256387, NULL, '15', 1),
(2, 6, '', '6 - 2', '14396', 1596183732, NULL, NULL, NULL, 0),
(3, 12, '', '12 - 3', '14333', 1596185414, 1596185585, NULL, '34', 1),
(4, 10, '', '10 - 1', '78945', 1596185470, 1596256076, NULL, '26', 1),
(5, 1, '36', '1 - 5', '14482', 1596185621, NULL, NULL, NULL, 0),
(6, 16, '', '16 - 2', '87907', 1596255954, NULL, NULL, NULL, 0),
(7, 10, '', '10 - 2', '78945', 1596255985, NULL, NULL, NULL, 0),
(8, 13, '', '13 - 3', '14332', 1596256146, NULL, NULL, NULL, 0),
(9, 14, '', '14 - 7', '14396', 1596256291, NULL, NULL, NULL, 0);

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
  `imgLink` text NOT NULL,
  `date_of_publication` text NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `orgQuan` int(11) NOT NULL,
  `digital` tinyint(4) NOT NULL,
  `book` tinyint(4) NOT NULL,
  `digitalLink` text NOT NULL,
  `receiptLink` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`bookID`, `title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`, `digital`, `book`, `digitalLink`, `receiptLink`) VALUES
(1, 'Introduction to Data Structures in C', 'Kamthane', 6, 'Technology (Applied sciences)', 'General technology', 'Technology (Applied sciences)', '', 'Pearson Education India', '484', 'http://books.google.com/books/content?id=HHfP4M_SW6AC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2007', '9788131713921', 7, 0, 1, '', ''),
(2, 'Textbook of Environmental Studies for Undergraduat', 'Erach Bharucha', 4, 'Social Sciences', 'Economics', 'Land economics', 'Natural resources and energy', 'Universities Press', '289', 'http://books.google.com/books/content?id=cRSpyn1zwlgC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2005-11', '9788173715402', 4, 0, 1, '', ''),
(3, 'Engineering Mechanics', 'Sharma D. P.', 8, 'Technology (Applied sciences)', 'Engineering and allied operations', 'Applied physics', 'Machine engineering', 'Pearson Education India', '624', 'http://books.google.com/books/content?id=Ras1wqwuxT0C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2010', '9788131732229', 8, 0, 1, '', ''),
(4, 'Engineering Drawing', 'undefined', 8, 'Technology (Applied sciences)', 'General technology', 'Special topics', 'Technical drawing', 'McGraw-Hill Education', '660', 'http://books.google.com/books/content?id=VRf-AwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2014', '9781259062889', 8, 0, 1, '', ''),
(5, 'Applied Chemistry', 'V. M. Balsaraf,A.V. Pawar,P.A. Mane', 7, 'Technology (Applied sciences)', 'Chemical engineering', 'Chemical engineering', '', 'I. K. International Pvt Ltd', '232', 'http://books.google.com/books/content?id=nwAAlf02KJ4C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2010-08-01', '9789380578552', 7, 0, 1, '', ''),
(6, 'Applied Mathematics 1', 'Abhimanyu Singh', 9, 'Natural sciences and mathematics', 'Mathematics', 'Analysis', 'Analytic geometries', 'Ane Books Pvt Ltd', '516', 'http://books.google.com/books/content?id=jkoAEijiPm0C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2010-01-01', '9789380156323', 9, 0, 1, '', ''),
(7, 'Foundations of Analog and Digital Electronic Circu', 'Anant Agarwal,Jeffrey Lang', 7, 'Technology (Applied sciences)', 'Engineering and allied operations', 'Applied physics', 'Heat engineering and prime movers', 'Elsevier', '1008', 'http://books.google.com/books/content?id=lGgP7FDEv3AC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2005-07-01', '9780080506814', 7, 0, 1, '', ''),
(8, 'Discrete Mathematics', 'Oscar Levin', 5, 'Natural sciences and mathematics', 'Mathematics', 'Algebra and number theory', 'Arithmetic', 'undefined', '408', 'http://books.google.com/books/content?id=YTAWwQEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2018-12-31', '9781792901690', 5, 0, 1, '', ''),
(9, 'Programming Python', 'Mark Lutz', 10, 'Generalities', 'Generalities and computer science', 'Computer programming, programs, data', 'Programming', '\"O\'Reilly Media, Inc.\"', '1255', 'http://books.google.com/books/content?id=c8pV-TzyfBUC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2001', '9780596000851', 10, 0, 1, '', ''),
(10, 'Java NIO \\c Ron Hitchens', 'Ron Hitchens', 4, 'Generalities', 'Generalities and computer science', 'Computer programming, programs, data', 'Programming', '\"O\'Reilly Media, Inc.\"', '282', 'http://books.google.com/books/content?id=z7TQ8NSooS4C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2002-08-27', '9780596002886', 5, 0, 1, '', ''),
(11, 'Communication Skills, Second Edition', 'Sanjay Kumar,Pushp Lata', 6, 'Language', 'English and Old English', 'Standard English usage', '', '', '616', 'http://books.google.com/books/content?id=6BwcswEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '', '9780199457069', 6, 0, 1, '', ''),
(12, 'Computer Graphics, C Version', 'Donald Hearn', 6, 'Generalities', 'Generalities and computer science', 'Special computer methods', 'Computer graphics', 'Pearson Education India', '652', 'http://books.google.com/books/content?id=dvrTIelDhJUC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '1997', '9788177587654', 6, 0, 1, '', ''),
(13, 'Operating Systems', 'William Stallings', 6, 'Generalities', 'Generalities and computer science', 'Computer programming, programs, data', 'Systems programming and programs', 'Prentice Hall', '822', 'http://books.google.com/books/content?id=dBQFXs5NPEYC&printsec=frontcover&img=1&zoom=1&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2009', '9780136006329', 6, 0, 1, '', ''),
(14, 'The Essentials of Computer Organization and Archit', 'Linda Null,Pennsylvania State University Linda Null,Julia Lobur', 7, 'Generalities', 'Generalities and computer science', 'Data processing, Computer science', 'Systems analysis and design, computer architecture', 'Jones & Bartlett Publishers', '900', 'http://books.google.com/books/content?id=3kQoAwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2014-02-01', '9781284033151', 7, 0, 1, '', ''),
(15, 'Learning Web Design', 'Jennifer Robbins', 10, 'Generalities', 'Generalities and computer science', 'Computer programming, programs, data', 'Programming', '\"O\'Reilly Media, Inc.\"', '808', 'http://books.google.com/books/content?id=UMFeDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2018-05-11', '9781491960158', 10, 0, 1, '', ''),
(16, 'An Introduction to the Analysis of Algorithms', 'Robert Sedgewick,Philippe Flajolet', 6, 'Natural sciences and mathematics', 'Mathematics', 'General topics', 'Mathematical (Symbolic) logic', 'Addison-Wesley', '604', 'http://books.google.com/books/content?id=P3tCB8Q7mA8C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2013-01-18', '9780133373486', 6, 0, 1, '', ''),
(17, 'A Textbook Of Applied Physics', 'A.K. Jha', 6, 'Natural sciences and mathematics', 'Physics', 'Physics', 'Theories and mathematical physics', 'I. K. International Pvt Ltd', '395', 'http://books.google.com/books/content?id=tizVedH4SA0C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2009-01-01', '9789380026770', 6, 0, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `notify_me`
--

CREATE TABLE `notify_me` (
  `id` int(11) NOT NULL,
  `bookID` text NOT NULL,
  `stud_ID` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notify_me`
--

INSERT INTO `notify_me` (`id`, `bookID`, `stud_ID`) VALUES
(1, '1', '14332'),
(2, '2', '14554'),
(3, '3', '14332'),
(7, '2', '14333');

-- --------------------------------------------------------

--
-- Table structure for table `request_list`
--

CREATE TABLE `request_list` (
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `userID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_list`
--

INSERT INTO `request_list` (`title`, `author`, `isbn`, `userID`) VALUES
('Food and Agriculture Organization of the United Na', '', '9789253036219', '14482'),
('HPI: Dedicated to Hi-Pee - Canine Paranormal Inves', 'Paul Dale Roberts & Deanna Jaxine Stinson', '9780359440962', '14482'),
('Juan Ramón Jiménez', '', '9780395623657', '14482'),
('Naupangte Kam Sungpan Phatna Apiangsak Hi', 'Rev Thang San Mung', '', '14482'),
('Olympus', 'Devdutt Pattanaik', '9789385990199', '14482'),
('Olympus PEN E-PL1 For Dummies', 'Julie Adair King', '9780470920701', '14482'),
('Sara B. Savage', '', '9780715140512', '14482');

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
(1, 1, 'Computer'),
(2, 1, 'Electronics'),
(3, 1, 'IT'),
(4, 1, 'EXTC'),
(5, 2, 'Computer'),
(6, 2, 'Electronics'),
(7, 2, 'IT'),
(8, 2, 'EXTC'),
(9, 5, 'Computer'),
(12, 3, 'EXTC'),
(13, 3, 'Electronics'),
(14, 1, 'Computer'),
(15, 2, 'Computer'),
(16, 3, 'Computer'),
(17, 1, 'Computer'),
(18, 2, 'Computer'),
(19, 3, 'Computer'),
(20, 4, 'Computer');

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
('addBookAccess', '2'),
('bookSemBranchAccess', '2'),
('bookShelfAccess', '2'),
('dueFine', '2'),
('duePoint', '5'),
('HeavyDamageBookStudent', '75'),
('HeavyDamageBookTeacher', '30'),
('issueAccess', '1'),
('issueNum', '2'),
('issuePeriod', '7'),
('issuePoint', '5'),
('LightDamageBookStudent', '25'),
('LightDamageBookTeacher', '10'),
('LostBookStudent', '100'),
('LostBookTeacher', '50'),
('MediumDamageBookStudent', '50'),
('MediumDamageBookTeacher', '20'),
('ratingPoint', '3'),
('reserveNum', '2'),
('reservePeriod', '2'),
('returnAccess', '1'),
('returnPoint', '5'),
('semBranchModifyAccess', '2'),
('settingsAccess', '2'),
('settingsAdminAccess ', '3'),
('shelfModifyAccess', '2'),
('teacherDueFine', '1'),
('teacherDuePoint', '2'),
('teacherIssueNum', '4'),
('teacherIssuePeriod', '14'),
('teacherIssuePoint', '10'),
('teacherRatingpoint', '3'),
('teacherReserveNum', '4'),
('teacherReservePeriod', '4'),
('teacherReturnPoint', '10'),
('updateBookAccess', '2'),
('UPIaddress', '');

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
('applied sciences'),
('programming');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_ID` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT 'symmka',
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `points` int(5) NOT NULL DEFAULT 100,
  `block` tinyint(4) NOT NULL DEFAULT 0,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_ID`, `password`, `name`, `email`, `mobile`, `points`, `block`, `type`) VALUES
('12345', 'symmka', 'kaushik', 'kaushik.satra@sakec.ac.in', '1234567890', 68, 0, 'student'),
('14324', 'symmka', 'amit', 'amit.ramani@sakec.ac.in', '8596741230', 100, 0, 'student'),
('14332', 'symmka', 'shraddha', 'shraddha651@gmail.com', '8655266790', 115, 0, 'student'),
('14333', 'symmka', 'symmka', 'symmka.ng@gmail.com', '865659562', 42, 0, 'teacher'),
('14396', 'symmka', 'yousha', 'yousha.gharpure@sakec.ac.in', '9619699095', 110, 0, 'student'),
('14482', 'symmka', 'Manjunath Naik', 'manjunath2000@hotmail.com', '9322289496', 85, 0, 'student'),
('14578', 'symmka', 'uday', 'uday.bhave@sakec.ac.in', '9876543210', 100, 0, 'teacher'),
('78945', 'symmka', 'mugdha', 'mugdha.basak@sakec.ac.in', '7418529630', 45, 0, 'student'),
('87907', 'symmka', 'deepshikha', 'deepshikha.chaturvedi@sakec.ac.in', '6541239870', 110, 0, 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `sem_branchID` int(11) NOT NULL,
  `bookID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`sem_branchID`, `bookID`) VALUES
(1, 2),
(1, 5),
(1, 6),
(2, 3),
(2, 6),
(3, 1),
(3, 5),
(3, 6),
(4, 5),
(4, 6),
(5, 3),
(5, 4),
(5, 11),
(6, 4),
(6, 11),
(7, 8),
(7, 16),
(8, 4),
(8, 7),
(8, 11),
(9, 15),
(12, 2),
(12, 7),
(13, 6),
(13, 7),
(13, 8),
(16, 7),
(16, 10),
(17, 3),
(17, 5),
(17, 6),
(18, 4),
(18, 11),
(19, 6),
(19, 7),
(19, 8),
(19, 10),
(20, 9),
(20, 12),
(20, 13),
(20, 14);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `day` varchar(10) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`day`, `start`, `end`, `comment`) VALUES
('Friday', '09:00:00', '17:00:00', 'Break 1-2 PM'),
('Monday', '09:00:00', '17:00:00', 'Break 1-2 PM'),
('Saturday', '00:00:00', '00:00:00', ''),
('Sunday', '00:00:00', '00:00:00', ''),
('Thursday', '09:00:00', '17:00:00', 'Break 1-2 PM'),
('Tuesday', '09:00:00', '17:00:00', 'Break 1-2 PM'),
('Wednesday', '09:00:00', '17:00:00', 'Break 1-2 PM');

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
-- Indexes for table `notify_me`
--
ALTER TABLE `notify_me`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_list`
--
ALTER TABLE `request_list`
  ADD PRIMARY KEY (`title`,`author`,`isbn`,`userID`);

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
  ADD PRIMARY KEY (`sem_branchID`,`bookID`),
  ADD KEY `bookID` (`bookID`),
  ADD KEY `sem_branchID` (`sem_branchID`) USING BTREE;

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`day`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `issued`
--
ALTER TABLE `issued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `main`
--
ALTER TABLE `main`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notify_me`
--
ALTER TABLE `notify_me`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sem_branch`
--
ALTER TABLE `sem_branch`
  MODIFY `sem_branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
