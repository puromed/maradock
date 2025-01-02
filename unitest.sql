-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 02, 2025 at 03:43 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unitest`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `course` varchar(80) NOT NULL,
  `year` int DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL,
  `student_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `full_name`, `course`, `year`, `profile_picture`, `phone`, `date_of_birth`, `address`, `city`, `enrollment_date`, `student_id`) VALUES
(1, 8, 'one', 'systemIM', 2, 'public/uploads/676188ec56145_wallhaven-2kwlex_1366x768.png', '0167455678', '2003-08-12', 'no.9, jalan baru buat', 'Jenjarom', NULL, '2024346675'),
(2, 9, 'Rodriguez', 'Information Record', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 14, 'Mohammad Arif Azri Bin Ariff', 'systemIM', 2, 'public/uploads/676190125294e_POSTER A&B.png', '0134566781', '2004-12-15', 'no.8, jalan saja-saja', 'Shah Alam', '2024-12-17', '2024123456');

-- --------------------------------------------------------

--
-- Table structure for table `student_groups`
--

CREATE TABLE `student_groups` (
  `student_id` int NOT NULL,
  `subject_group_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_groups`
--

INSERT INTO `student_groups` (`student_id`, `subject_group_id`) VALUES
(8, 1),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `instructor_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `instructor_name`) VALUES
(1, 'IMS566', 'Rizal Bin Kamaruzzaman'),
(2, 'IMS560', 'Gary Lineker'),
(3, 'IMS511', 'Irfan bin Idris');

-- --------------------------------------------------------

--
-- Table structure for table `subject_groups`
--

CREATE TABLE `subject_groups` (
  `id` int NOT NULL,
  `subject_id` int NOT NULL,
  `group_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subject_groups`
--

INSERT INTO `subject_groups` (`id`, `subject_id`, `group_name`) VALUES
(1, 2, 'CDIM2624A'),
(2, 2, 'CDIM2624B'),
(3, 1, 'CDIM2624A');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text,
  `status` varchar(20) DEFAULT 'open',
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `student_id`, `category`, `subject`, `description`, `status`, `attachment`, `created_at`) VALUES
(1, 8, 'technical', 'problems', 'hahaha', 'closed', NULL, '2024-11-16 15:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(6, 'aaa@gmail.com', 'test1', '$2y$10$yn9O48s/5aFCm0tPCLFv2.iTU2iXXQFsm9ztgNo.LUNSaHez1mnca'),
(8, 'hello@gmail.com', 'unkindled', '$2y$10$MpNbQOsvuC7j41EIxdzN2OmYjMrK.vj8scezF43k8wc7/npOrvAXG'),
(9, 'test@example.com', 'test', '$2y$10$TjrjjvYs235rBn5K1CJDtO1tj5l8JkAZgxHMhDlIqC6T6xvlaTf8a'),
(14, 'yolo334@gmail.com', 'puro', '$2y$10$NUXCk/tNETaoDM/A9bRzbuxgwrdmNy5uMYGTzd1Px.J6leiJaiqfe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `student_groups`
--
ALTER TABLE `student_groups`
  ADD PRIMARY KEY (`student_id`,`subject_group_id`),
  ADD KEY `subject_group_id` (`subject_group_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `subject_groups`
--
ALTER TABLE `subject_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_groups`
--
ALTER TABLE `subject_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_groups`
--
ALTER TABLE `student_groups`
  ADD CONSTRAINT `student_groups_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`user_id`),
  ADD CONSTRAINT `student_groups_ibfk_2` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`);

--
-- Constraints for table `subject_groups`
--
ALTER TABLE `subject_groups`
  ADD CONSTRAINT `subject_groups_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
