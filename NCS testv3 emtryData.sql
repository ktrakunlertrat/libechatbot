-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 12:39 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `linelink`
--

CREATE TABLE `linelink` (
  `user_id` varchar(255) NOT NULL,
  `studentID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(10, 63310601, 'นายเขมชาติ', 'ตระกูลเลิศรัตน์'),
(17, 63310946, 'ชฎาพร', 'ถาบู้');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, '63314784', '123456', 'admin'),
(2, '63310601', '12345', 'admin'),
(3, 'teacher', '12345', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `usersline`
--

CREATE TABLE `usersline` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `message_content` text DEFAULT NULL,
  `created_at_line` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `users`
--
ALTER TABLE `users`
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
  MODIFY `idchecklist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `scanneddata`
--
ALTER TABLE `scanneddata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usersline`
--
ALTER TABLE `usersline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
