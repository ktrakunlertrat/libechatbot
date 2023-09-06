-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2023 at 12:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklistdata`
--

CREATE TABLE `checklistdata` (
  `idchecklist` int(11) NOT NULL,
  `studentID` int(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklistdata`
--

INSERT INTO `checklistdata` (`idchecklist`, `studentID`, `created_at`) VALUES
(28, 63314784, '2023-08-10 10:41:03'),
(30, 63314784, '2023-08-10 10:41:50'),
(31, 63314784, '2023-08-10 11:22:01'),
(32, 63314784, '2023-08-14 21:14:43'),
(33, 63314784, '2023-08-15 06:01:33'),
(37, 63314784, '2023-08-15 06:40:20'),
(38, 63314784, '2023-08-15 06:42:48'),
(39, 63314784, '2023-08-15 06:42:53'),
(40, 63314784, '2023-08-15 06:44:46'),
(41, 63314784, '2023-08-15 06:50:40'),
(42, 63314784, '2023-08-16 22:28:41'),
(43, 63314784, '2023-08-16 22:48:38'),
(44, 63314784, '2023-08-16 22:52:55'),
(45, 63314784, '2023-08-16 23:21:58'),
(46, 63314784, '2023-08-16 23:24:01'),
(47, 63314784, '2023-08-16 23:24:08'),
(48, 63310601, '2023-08-17 17:15:48'),
(49, 63310601, '2023-08-17 17:16:24'),
(50, 63314784, '2023-08-17 17:16:37'),
(51, 63314784, '2023-09-06 00:47:42'),
(52, 63314784, '2023-09-06 00:48:38'),
(53, 63314784, '2023-09-06 00:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `linelink`
--

CREATE TABLE `linelink` (
  `user_id` varchar(255) NOT NULL,
  `studentID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `linelink`
--

INSERT INTO `linelink` (`user_id`, `studentID`) VALUES
('Ubc1a08a01162fc2a60b5fd11e34691d5', '63314784'),
('Uea49568d95372578a27082ad832e114d', '63310601');

-- --------------------------------------------------------

--
-- Table structure for table `scanneddata`
--

CREATE TABLE `scanneddata` (
  `id` int(11) NOT NULL,
  `valueofscan` int(11) NOT NULL,
  `scan_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `studentID` int(8) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studentID`, `firstName`, `lastName`) VALUES
(6, 63314784, 'เหมียวๆ ทดสอบแก้ไข', 'มุแง้ว'),
(7, 63314782, 'เหมียวๆ', 'มุแง้ว'),
(10, 63310601, 'นายเขมชาติ', 'ตระกูลเลิศรัตน์');

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `after_delete_students` AFTER DELETE ON `students` FOR EACH ROW BEGIN
    -- ลบข้อมูลในตาราง checklistdata ที่มี studentID ตรงกับข้อมูลที่ถูกลบใน students
    DELETE FROM checklistdata
    WHERE studentID = OLD.studentID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_students` AFTER UPDATE ON `students` FOR EACH ROW BEGIN
    -- อัพเดตข้อมูลในตาราง checklistdata ที่มี studentID ตรงกับข้อมูลที่อัพเดตใน students
    UPDATE checklistdata
    SET studentID = NEW.studentID
    WHERE studentID = OLD.studentID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, '63314784', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `usersline`
--

CREATE TABLE `usersline` (
  `id` int(11) NOT NULL,
  `user_id` text DEFAULT NULL,
  `message_content` text DEFAULT NULL,
  `created_at_line` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersline`
--

INSERT INTO `usersline` (`id`, `user_id`, `message_content`, `created_at_line`) VALUES
(3, 'Ubc1a08a01162fc2a60b5fd11e34691d5', 'ทดสอบบ', '2023-08-10 15:23:41'),
(4, 'Uea49568d95372578a27082ad832e114d', 'Hi', '2023-08-10 15:26:38'),
(5, 'Ubc1a08a01162fc2a60b5fd11e34691d5', 'เทส', '2023-08-14 20:10:33'),
(6, 'Ubc1a08a01162fc2a60b5fd11e34691d5', '63314784', '2023-08-14 20:10:41'),
(16, 'Uea49568d95372578a27082ad832e114d', '63310601', '2023-08-17 17:16:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklistdata`
--
ALTER TABLE `checklistdata`
  ADD PRIMARY KEY (`idchecklist`);

--
-- Indexes for table `scanneddata`
--
ALTER TABLE `scanneddata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `valueofscan` (`valueofscan`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentID` (`studentID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersline`
--
ALTER TABLE `usersline`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklistdata`
--
ALTER TABLE `checklistdata`
  MODIFY `idchecklist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `scanneddata`
--
ALTER TABLE `scanneddata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usersline`
--
ALTER TABLE `usersline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
