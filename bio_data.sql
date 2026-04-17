-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 12:42 PM
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
-- Database: `bio_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `bio_info`
--

CREATE TABLE `bio_info` (
  `id` int(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `mobile` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `fatherName` varchar(255) NOT NULL,
  `languagesKnown` varchar(255) NOT NULL,
  `maritalStatus` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `picUpload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bio_info`
--

INSERT INTO `bio_info` (`id`, `lastName`, `firstName`, `middleName`, `suffix`, `mobile`, `email`, `province`, `city`, `barangay`, `street`, `dateOfBirth`, `gender`, `fatherName`, `languagesKnown`, `maritalStatus`, `religion`, `hobbies`, `picUpload`) VALUES
(80, 'Gascon', 'Dann', 'A', '', 2147483647, 'ezekielclarence6@gmail.com', 'Nueva Ecija', 'Jaen', 'Sapang', 'Purok 4', '2003-10-20', 'Male', 'John', 'English', 'Single', 'ROMAN CATHOLIC', 'Badminton', '69dd133f7f1ef-1776096063download.jpg'),
(81, 'Baby', 'Ai', 'Santos', '', 2147483647, 'daitodump@gmail.com', 'NUEVA ECIJA', 'Cabiao', 'San Fernando Sur', 'Purok 4', '2993-12-06', 'Male', 'John', 'English', 'Single', 'ROMAN CATHOLIC', 'Crocheting', '69dd16edceb00-1776097005baby.jpg'),
(82, 'Emata', 'Monica', 'Feje', '', 2147483647, 'daitodump@gmail.com', 'Nueva Ecija', 'Cabiao', 'San Fernando Sur', 'Purok 4', '2003-12-06', 'Female', 'John', 'English', 'Single', 'ROMAN CATHOLIC', 'Crocheting', '69dd193a2cd51-1776097594IMG_1622.JPG'),
(83, 'Samson', 'Jasmin', 'Fuertez', '', 2147483647, 'ezekielclarence6@gmail.com', 'Nueva Ecija', 'Cabiao', 'ENTABLADO', 'Purok 4', '2006-07-21', 'Female', 'John', 'English', 'Single', 'ROMAN CATHOLIC', 'Playing computer games and watching anime', '69dd19c5d0f6d-1776097733IMG_1367.JPG'),
(84, 'Samson', 'Jasmin', 'Fuertez', '', 2147483647, 'jasminsamson738@gmail.com', 'Nueva Ecija', 'Cabiao', 'Entablado', 'Entablado, Cabiao, Nueva Ecija', '2026-03-09', 'Female', 'Ronaldo Samson', 'Filipino', 'Single', 'Catholic', 'jogging', '69b8c1961a8a3-17737158627027606554_74586721485597_1773218360514.png'),
(85, 'Samson', 'Jasmin', 'Fuertez', '', 2147483647, 'jasminsamson738@gmail.com', 'Nueva Ecija', 'Cabiao', 'Entablado', 'Entablado, Cabiao, Nueva Ecija', '2026-03-09', 'Female', 'Ronaldo Samson', 'Filipino', 'Single', 'Catholic', 'jogging', '');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `eduId` int(255) NOT NULL,
  `personId` int(255) NOT NULL,
  `elementary` varchar(255) NOT NULL,
  `year1` date NOT NULL,
  `highschool` varchar(255) NOT NULL,
  `year2` date NOT NULL,
  `college` varchar(255) NOT NULL,
  `year3` date NOT NULL,
  `course` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`eduId`, `personId`, `elementary`, `year1`, `highschool`, `year2`, `college`, `year3`, `course`, `skills`) VALUES
(7, 17, 'EES', '2026-03-13', 'CNHS', '2026-03-27', 'NEUST', '2026-03-12', 'BSIT', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `employment`
--

CREATE TABLE `employment` (
  `empId` int(255) NOT NULL,
  `personId` int(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `dateOfJoining` date NOT NULL,
  `dateOfExit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment`
--

INSERT INTO `employment` (`empId`, `personId`, `company`, `position`, `dateOfJoining`, `dateOfExit`) VALUES
(7, 17, 'Luxx Lush', 'Organizer', '2026-01-29', '2026-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `temp_edu`
--

CREATE TABLE `temp_edu` (
  `eduId` int(255) NOT NULL,
  `personId` int(255) NOT NULL,
  `elementary` varchar(255) NOT NULL,
  `year1` date NOT NULL,
  `highschool` varchar(255) NOT NULL,
  `year2` date NOT NULL,
  `college` varchar(255) NOT NULL,
  `year3` date NOT NULL,
  `course` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_edu`
--

INSERT INTO `temp_edu` (`eduId`, `personId`, `elementary`, `year1`, `highschool`, `year2`, `college`, `year3`, `course`, `skills`) VALUES
(7, 17, 'EES', '2026-03-13', 'CNHS', '2026-03-27', 'NEUST', '2026-03-12', 'BSIT', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `temp_emp`
--

CREATE TABLE `temp_emp` (
  `empId` int(255) NOT NULL,
  `personId` int(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `dateOfJoining` date NOT NULL,
  `dateOfExit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_emp`
--

INSERT INTO `temp_emp` (`empId`, `personId`, `company`, `position`, `dateOfJoining`, `dateOfExit`) VALUES
(7, 17, 'Luxx Lush', 'Organizer', '2026-01-29', '2026-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `temp_person`
--

CREATE TABLE `temp_person` (
  `id` int(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `mobile` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `fatherName` varchar(255) NOT NULL,
  `languagesKnown` varchar(255) NOT NULL,
  `maritalStatus` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `picUpload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bio_info`
--
ALTER TABLE `bio_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`eduId`);

--
-- Indexes for table `employment`
--
ALTER TABLE `employment`
  ADD PRIMARY KEY (`empId`);

--
-- Indexes for table `temp_edu`
--
ALTER TABLE `temp_edu`
  ADD PRIMARY KEY (`eduId`);

--
-- Indexes for table `temp_emp`
--
ALTER TABLE `temp_emp`
  ADD PRIMARY KEY (`empId`);

--
-- Indexes for table `temp_person`
--
ALTER TABLE `temp_person`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bio_info`
--
ALTER TABLE `bio_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `eduId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employment`
--
ALTER TABLE `employment`
  MODIFY `empId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `temp_edu`
--
ALTER TABLE `temp_edu`
  MODIFY `eduId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `temp_emp`
--
ALTER TABLE `temp_emp`
  MODIFY `empId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `temp_person`
--
ALTER TABLE `temp_person`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
