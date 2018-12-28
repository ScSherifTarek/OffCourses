-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2018 at 01:26 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `offcourcesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `academy`
--

CREATE TABLE `academy` (
  `id` int(11) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `profile_image_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `academy_has_instructors`
--

CREATE TABLE `academy_has_instructors` (
  `academy_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `describtion` varchar(300) NOT NULL,
  `academy_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_has_instructor`
--

CREATE TABLE `course_has_instructor` (
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `academy_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `phone_no` varchar(45) DEFAULT NULL,
  `previous_experience` varchar(200) DEFAULT NULL,
  `profile_image_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `email`, `first_name`, `last_name`, `password`, `phone_no`, `previous_experience`, `profile_image_url`) VALUES
(40, 'usamaeltmsah@yahoo.com', 'Usama', 'Fouad', '4f9f3aebeb41d37af9220ab9a4053247', NULL, NULL, NULL),
(43, 'usamaeltmsa@yahoo.com', 'Usama', 'Fouad', 'a25094795b76d7d407404c52983f1694', NULL, NULL, NULL),
(45, 'usamaeltmsh@yahoo.com', 'usama', 'fouad', 'a25094795b76d7d407404c52983f1694', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academy`
--
ALTER TABLE `academy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `academy_has_instructors`
--
ALTER TABLE `academy_has_instructors`
  ADD KEY `academy_has_instructors_fk0` (`academy_id`),
  ADD KEY `academy_has_instructors_fk1` (`instructor_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_fk0` (`academy_id`);

--
-- Indexes for table `course_has_instructor`
--
ALTER TABLE `course_has_instructor`
  ADD KEY `course_has_instructor_fk0` (`instructor_id`),
  ADD KEY `course_has_instructor_fk1` (`course_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_fk0` (`course_id`),
  ADD KEY `image_fk1` (`academy_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academy`
--
ALTER TABLE `academy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academy_has_instructors`
--
ALTER TABLE `academy_has_instructors`
  ADD CONSTRAINT `academy_has_instructors_fk0` FOREIGN KEY (`academy_id`) REFERENCES `academy` (`id`),
  ADD CONSTRAINT `academy_has_instructors_fk1` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_fk0` FOREIGN KEY (`academy_id`) REFERENCES `academy` (`id`);

--
-- Constraints for table `course_has_instructor`
--
ALTER TABLE `course_has_instructor`
  ADD CONSTRAINT `course_has_instructor_fk0` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`),
  ADD CONSTRAINT `course_has_instructor_fk1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_fk0` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `image_fk1` FOREIGN KEY (`academy_id`) REFERENCES `academy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
