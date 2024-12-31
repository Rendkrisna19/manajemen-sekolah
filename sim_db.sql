-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 05:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_guru`
--

CREATE TABLE `absensi_guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `status` enum('Pending','Confirmed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi_guru`
--

INSERT INTO `absensi_guru` (`id`, `nama`, `tanggal`, `jam`, `status`) VALUES
(4, 'Zaki', '2024-12-24', '15:09:34', 'Confirmed'),
(11, 'Agus', '2024-12-25', '15:52:59', 'Confirmed'),
(12, 'Rendy', '2024-12-25', '15:53:54', 'Confirmed'),
(15, 'Agus', '2024-12-25', '16:27:40', 'Confirmed'),
(16, 'Riski', '2024-12-25', '16:30:09', 'Confirmed'),
(18, 'Zaki', '2024-12-30', '18:31:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `name`, `hours`) VALUES
(1, 'Matematika', 3),
(2, 'Bahasa Indonesia', 2),
(3, 'Fisika', 2),
(4, 'Kimia', 3),
(5, 'Biologi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `class`, `created_at`) VALUES
(3, 'Michael Brown', '11A', '2024-12-23 10:57:01'),
(4, 'Emily Davis', '11B', '2024-12-23 10:57:01'),
(5, 'Redy', '10B', '2024-12-23 11:03:16'),
(6, 'Rahma', '11A', '2024-12-25 14:31:57'),
(8, 'Bob Smi', '10A', '2024-12-25 14:35:19'),
(9, 'Charlie Brown', '10A', '2024-12-25 14:35:19'),
(10, 'Daisy Green', '10A', '2024-12-25 14:35:19'),
(11, 'Ethan White', '10A', '2024-12-25 14:35:19'),
(12, 'Fiona Black', '10A', '2024-12-25 14:35:19'),
(13, 'George Carter', '10A', '2024-12-25 14:35:19'),
(14, 'Hannah Lee', '10A', '2024-12-25 14:35:19'),
(15, 'Ian Davis', '10A', '2024-12-25 14:35:19'),
(16, 'Jenny Adams', '10A', '2024-12-25 14:35:19'),
(17, 'Kevin Hall', '11A', '2024-12-25 14:36:13'),
(18, 'Laura Scott', '11A', '2024-12-25 14:36:13'),
(19, 'Mason Young', '11A', '2024-12-25 14:36:13'),
(20, 'Nina Clark', '11A', '2024-12-25 14:36:13'),
(21, 'Olivia Turner', '11A', '2024-12-25 14:36:13'),
(22, 'Peter Harris', '11A', '2024-12-25 14:36:13'),
(23, 'Quinn Walker', '11A', '2024-12-25 14:36:13'),
(24, 'Ruby King', '11A', '2024-12-25 14:36:13'),
(25, 'Samuel Hill', '11A', '2024-12-25 14:36:13'),
(26, 'Tina Baker', '11A', '2024-12-25 14:36:13'),
(27, 'Uma Collins', '12A', '2024-12-25 14:37:17'),
(28, 'Victor Murphy', '12A', '2024-12-25 14:37:17'),
(29, 'Wendy Foster', '12A', '2024-12-25 14:37:17'),
(30, 'Xander Price', '12A', '2024-12-25 14:37:17'),
(31, 'Yara Morgan', '12A', '2024-12-25 14:37:17'),
(32, 'Zachary Brooks', '12A', '2024-12-25 14:37:17'),
(33, 'Alan Reed', '12A', '2024-12-25 14:37:17'),
(34, 'Betty Ross', '12A', '2024-12-25 14:37:17'),
(37, 'Rehan Karna', '10A', '2024-12-25 15:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `subject`) VALUES
(5, 'Rendy Krisna', ''),
(6, 'Zaki', 'Seni Budaya'),
(7, 'Riski', 'Bahasa Indonesia'),
(8, 'Agus', 'Olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Rendy', 'muhammadrendykrisna@gmail.com', '$2y$10$90cX9e4o/4EXOq/yShFfI.vdkl6G4j8IwpdSkHO3eKcVG9tV7D74m'),
(3, 'Randy', 'rendikrisna01@gmail.com', '$2y$10$SDc2BxOcL5hXqT7SQKdbOu0v8m7kG14DYnxTT.tK96Yl087h7UDfC'),
(4, 'Karna', 'rendy@gmail.com', '$2y$10$YlwyQSZtHFBBKSj7Bs/ZGugdudFnQwOpwWTxV07qIOwdwylQssX4S');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
