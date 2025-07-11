-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2025 at 05:00 PM
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
-- Database: `excellens`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `prog_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `ccode` varchar(255) NOT NULL,
  `ctitle` varchar(255) NOT NULL,
  `units` int(255) NOT NULL,
  `year_id` int(255) NOT NULL,
  `sem_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `deptid` int(255) NOT NULL,
  `deptname` varchar(255) NOT NULL,
  `deptnick` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptid`, `deptname`, `deptnick`) VALUES
(2, 'COLLEGE OF INFORMATICS AND COMPUTING SCIENCES', 'CICS');

-- --------------------------------------------------------

--
-- Table structure for table `pending_accounts`
--

CREATE TABLE `pending_accounts` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('Dean','Chairperson','Faculty Member') NOT NULL,
  `date_requested` datetime DEFAULT current_timestamp(),
  `is_approved` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_accounts`
--

INSERT INTO `pending_accounts` (`id`, `full_name`, `email`, `role`, `date_requested`, `is_approved`) VALUES
(3, 'CARPENA KARL ANTHONY', '22-74776@g.batstate-u.edu.ph', 'Faculty Member', '2025-06-21 21:33:41', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `progid` int(255) NOT NULL,
  `progname` varchar(255) NOT NULL,
  `progyear` int(255) NOT NULL,
  `deptid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`progid`, `progname`, `progyear`, `deptid`) VALUES
(3, 'Bachelor of Science in Information Technology', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semid` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semid`, `semester`) VALUES
(1, 'FIRST SEMESTER'),
(2, 'SECOND SEMESTER');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `track_id` int(11) NOT NULL,
  `trackname` varchar(255) NOT NULL,
  `programid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `year_id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`year_id`, `year`) VALUES
(1, 'FIRST YEAR'),
(2, 'SECOND YEAR'),
(3, 'THIRD YEAR'),
(4, 'MIDTERM'),
(5, 'FOURTH YEAR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `yearfk` (`year_id`),
  ADD KEY `semfk` (`sem_id`),
  ADD KEY `progid` (`prog_id`),
  ADD KEY `deptid` (`dept_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`deptid`);

--
-- Indexes for table `pending_accounts`
--
ALTER TABLE `pending_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`progid`),
  ADD KEY `deptid` (`deptid`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semid`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`track_id`),
  ADD KEY `program` (`programid`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `deptid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pending_accounts`
--
ALTER TABLE `pending_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `progid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `deptid` FOREIGN KEY (`dept_id`) REFERENCES `department` (`deptid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `progid` FOREIGN KEY (`prog_id`) REFERENCES `program` (`progid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `semfk` FOREIGN KEY (`sem_id`) REFERENCES `semesters` (`semid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yearfk` FOREIGN KEY (`year_id`) REFERENCES `years` (`year_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`deptid`) REFERENCES `department` (`deptid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `track`
--
ALTER TABLE `track`
  ADD CONSTRAINT `program` FOREIGN KEY (`programid`) REFERENCES `program` (`progid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
