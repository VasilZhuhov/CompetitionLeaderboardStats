-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2020 at 05:12 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `competitionTracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `parserId` int(6) UNSIGNED DEFAULT NULL,
  `startTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `competition_participants`
--

CREATE TABLE `competition_participants` (
  `id` int(6) UNSIGNED NOT NULL,
  `competitionId` int(6) UNSIGNED DEFAULT NULL,
  `participantId` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `competition_tasks`
--

CREATE TABLE `competition_tasks` (
  `id` int(6) UNSIGNED NOT NULL,
  `competitionParticipantId` int(6) UNSIGNED DEFAULT NULL,
  `taskId` int(6) UNSIGNED DEFAULT NULL,
  `score` int(6) UNSIGNED DEFAULT NULL,
  `timeTaken` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parsers`
--

CREATE TABLE `parsers` (
  `id` int(6) UNSIGNED NOT NULL,
  `ownerId` int(6) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `namePath` varchar(100) DEFAULT NULL,
  `scorePath` varchar(100) DEFAULT NULL,
  `rankPath` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `score` double(20,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `maxScore` int(6) UNSIGNED DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parserId` (`parserId`);

--
-- Indexes for table `competition_participants`
--
ALTER TABLE `competition_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competitionId` (`competitionId`),
  ADD KEY `participantId` (`participantId`);

--
-- Indexes for table `competition_tasks`
--
ALTER TABLE `competition_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competitionParticipantId` (`competitionParticipantId`),
  ADD KEY `taskId` (`taskId`);

--
-- Indexes for table `parsers`
--
ALTER TABLE `parsers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `competition_participants`
--
ALTER TABLE `competition_participants`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `competition_tasks`
--
ALTER TABLE `competition_tasks`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parsers`
--
ALTER TABLE `parsers`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `competitions`
--
ALTER TABLE `competitions`
  ADD CONSTRAINT `competitions_ibfk_1` FOREIGN KEY (`parserId`) REFERENCES `parsers` (`id`);

--
-- Constraints for table `competition_participants`
--
ALTER TABLE `competition_participants`
  ADD CONSTRAINT `competition_participants_ibfk_1` FOREIGN KEY (`competitionId`) REFERENCES `competitions` (`id`),
  ADD CONSTRAINT `competition_participants_ibfk_2` FOREIGN KEY (`participantId`) REFERENCES `participants` (`id`);

--
-- Constraints for table `competition_tasks`
--
ALTER TABLE `competition_tasks`
  ADD CONSTRAINT `competition_tasks_ibfk_1` FOREIGN KEY (`competitionParticipantId`) REFERENCES `competition_participants` (`id`),
  ADD CONSTRAINT `competition_tasks_ibfk_2` FOREIGN KEY (`taskId`) REFERENCES `tasks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
