-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 09:10 AM
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
(53, 63314784, '2023-09-06 00:51:43'),
(54, 63310601, '2023-09-21 03:16:14'),
(55, 63310601, '2023-09-21 03:20:53'),
(56, 63310601, '2023-09-21 03:21:43'),
(57, 63310601, '2023-09-21 03:22:12'),
(58, 63314782, '2023-09-21 03:25:44'),
(59, 63314782, '2023-09-21 03:30:05'),
(60, 63310601, '2023-09-28 08:51:19'),
(61, 63310601, '2023-09-28 08:52:34'),
(62, 63310601, '2023-10-04 10:32:44'),
(63, 63310601, '2023-10-04 10:33:58'),
(64, 63310601, '2023-10-04 10:37:16'),
(65, 63310601, '2023-10-04 10:40:13'),
(66, 63310601, '2023-10-04 10:41:00'),
(67, 63310601, '2023-10-04 10:48:51'),
(68, 63310601, '2023-10-04 10:49:43'),
(69, 63310601, '2023-10-04 10:54:53'),
(70, 63310601, '2023-10-04 10:54:58'),
(71, 63310601, '2023-10-04 10:54:58'),
(72, 63310601, '2023-10-04 10:57:02'),
(73, 63310601, '2023-10-05 14:41:59'),
(74, 63310601, '2023-10-05 14:56:15'),
(75, 63310601, '2023-10-05 15:20:08'),
(76, 63310601, '2023-10-09 09:11:59'),
(77, 63310601, '2023-10-09 16:17:42'),
(78, 63310946, '2023-10-09 16:27:01'),
(79, 63310601, '2023-10-09 16:28:12'),
(80, 63310601, '2023-10-10 07:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `linelink`
--

CREATE TABLE `linelink` (
  `user_id` varchar(255) NOT NULL,
  `studentID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `linelink`
--

INSERT INTO `linelink` (`user_id`, `studentID`) VALUES
('U2b6b7f81cb9fdf95449321aa8c521e5e', 63310601),
('U0e637308a61196232e8d342414eefc73', 63310601);

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
-- Dumping data for table `usersline`
--

INSERT INTO `usersline` (`id`, `user_id`, `message_content`, `created_at_line`) VALUES
(35, 'U2b6b7f81cb9fdf95449321aa8c521e5e', '63310601', '2023-10-09 16:36:25'),
(36, 'U0e637308a61196232e8d342414eefc73', '63310601', '2023-10-09 16:36:54');

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
