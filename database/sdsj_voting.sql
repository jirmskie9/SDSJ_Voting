-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 10:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdsj_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `activity_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_id`, `action`, `description`, `date_time`) VALUES
(1, 'Added Partylist', 'Admin added a Partylist', '2024-03-09 09:28:31'),
(2, 'Added Candidate', 'Admin add independent candidate', '2024-03-09 09:28:51'),
(3, 'Added Candidate', 'Admin add independent candidate', '2024-03-09 09:29:51'),
(4, 'Update Partylist', 'Admin updated a Partylist', '2024-04-09 13:48:58'),
(5, 'Deleted Partylist', 'Admin deleted a Partylist', '2024-04-09 13:49:06'),
(6, 'Added Partylist', 'Admin added a Partylist', '2024-04-09 13:50:43'),
(7, 'Deleted Candidate', 'Admin deleted a candidate', '2024-04-09 13:50:57'),
(8, 'Added Candidate', 'Admin add independent candidate', '2024-04-09 13:51:05'),
(9, 'Added Jano Gibz', 'Admin add independent candidate', '2024-04-09 14:02:33'),
(10, 'Deleted Cristy and Friends', 'Admin deleted a Partylist', '2024-04-09 14:03:10'),
(11, 'Deleted Enzo Manalo', 'Admin deleted a candidate', '2024-04-09 14:03:36'),
(12, 'Voting Stopped', 'The admin started the voting', '2024-04-09 14:06:57'),
(13, 'Voting Started', 'The admin started the voting', '2024-04-09 14:08:20'),
(14, 'Voting Stopped', 'The admin started the voting', '2024-04-09 14:08:29'),
(15, 'Confirmed Account', 'Admin confirmed account pending', '2024-04-09 14:17:36'),
(16, 'Added Cristy and Friends', 'Admin added a Partylist', '2024-04-09 14:20:04'),
(17, 'Voting Started', 'The admin started the voting', '2024-04-09 14:20:43'),
(18, 'Voting Stopped', 'The admin started the voting', '2024-04-09 14:37:29'),
(19, 'Voting Started', 'The admin started the voting', '2024-04-09 20:29:27'),
(20, 'Voting Stopped', 'The admin started the voting', '2024-04-09 20:41:47'),
(21, 'Added Jirmy Nacario', 'Admin add independent candidate', '2024-04-09 21:23:36'),
(22, 'Voting Started', 'The admin started the voting', '2024-04-09 21:27:53'),
(23, 'Voting Stopped', 'The admin started the voting', '2024-04-09 21:28:08'),
(24, 'Added Youth Partylist', 'Admin added a Partylist', '2024-04-10 10:57:22'),
(25, 'Voting Started', 'The admin started the voting', '2024-04-10 10:57:46'),
(26, 'Voting Stopped', 'The admin started the voting', '2024-04-10 11:00:21'),
(27, 'Voting Started', 'The admin started the voting', '2024-04-10 11:05:28'),
(28, 'Voting Stopped', 'The admin started the voting', '2024-04-10 11:05:32'),
(29, 'Voting Started', 'The admin started the voting', '2024-04-10 11:06:20'),
(30, 'Voting Stopped', 'The admin started the voting', '2024-04-10 11:09:39'),
(31, 'Voting Started', 'The admin started the voting', '2024-04-13 10:21:58'),
(32, 'Voting Stopped', 'The admin started the voting', '2024-04-13 10:31:40'),
(33, 'Voting Started', 'The admin started the voting', '2024-04-13 10:33:24'),
(34, 'Voting Stopped', 'The admin started the voting', '2024-04-13 10:33:28'),
(35, 'Voting Started', 'The admin started the voting', '2024-04-13 11:10:34'),
(36, 'Voting Stopped', 'The admin started the voting', '2024-04-13 11:10:38'),
(37, 'Voting Started', 'The admin started the voting', '2024-04-21 11:47:12'),
(38, 'Voting Stopped', 'The admin started the voting', '2025-04-01 11:48:53'),
(39, 'Voting Started', 'The admin started the voting', '2025-04-01 11:52:54'),
(40, 'Confirmed Account', 'Admin confirmed account pending', '2025-04-01 11:56:34'),
(41, 'Update Partylist', 'Admin updated a Partylist', '2025-04-01 12:00:21'),
(42, 'Update Partylist', 'Admin updated a Partylist', '2025-04-01 13:04:09'),
(43, 'Confirmed Account', 'Admin confirmed account pending', '2025-04-01 13:10:22'),
(44, 'Added Cristy and Friends 2', 'Admin added a Partylist', '2025-04-02 16:34:13'),
(45, 'Voting Stopped', 'The admin started the voting', '2025-04-02 16:35:34'),
(46, 'Voting Started', 'The admin started the voting', '2025-04-02 16:35:51'),
(47, 'Added salveo Barley', 'Admin add independent candidate', '2025-04-02 16:49:15'),
(48, 'Added Rosermare Geplani', 'Admin add independent candidate', '2025-04-02 16:51:39'),
(49, 'Added pedrina selection', 'Admin added a Partylist', '2025-04-02 17:02:56'),
(50, 'Added pedrina selection', 'Admin added a Partylist', '2025-04-02 17:10:36'),
(51, 'Added pedrina selection', 'Admin added a Partylist', '2025-04-02 17:13:04'),
(52, 'Added pedrina selection', 'Admin added a Partylist', '2025-04-02 17:17:16'),
(53, 'Added Jirmy Nacario', 'Admin add independent candidate', '2025-04-02 17:17:30'),
(54, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:22:46'),
(55, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:24:39'),
(56, 'Deleted pedrina selection', 'Admin deleted a Partylist', '2025-04-02 17:24:58'),
(57, 'Added pedrina selection', 'Admin added a Partylist', '2025-04-02 17:25:17'),
(58, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:25:25'),
(59, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:26:32'),
(60, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:27:48'),
(61, 'Added Cristy Selection', 'Admin added a Partylist', '2025-04-02 17:30:22'),
(62, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:30:55'),
(63, 'Added Jirmy Nacario', 'Admin add independent candidate', '2025-04-02 17:38:54'),
(64, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:41:06'),
(65, 'Added pedrina selection', 'Admin added a Partylist', '2025-04-02 17:43:19'),
(66, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:43:43'),
(67, 'Added pedrina selection', 'Admin added a Partylist', '2025-04-02 17:47:25'),
(68, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:47:44'),
(69, 'Update Partylist', 'Admin updated a Partylist', '2025-04-02 17:48:14'),
(70, 'Added Pito Pito', 'Admin add independent candidate', '2025-04-04 10:45:22'),
(71, 'Voting Stopped', 'The admin started the voting', '2025-04-04 10:58:37'),
(72, 'Voting Started', 'The admin started the voting', '2025-04-04 10:58:48'),
(73, 'Confirmed Account', 'Admin confirmed account pending', '2025-04-08 10:25:08'),
(74, 'Added Cristy and Friends 2', 'Admin added a Partylist', '2025-04-08 10:28:27'),
(75, 'Voting Stopped', 'The admin started the voting', '2025-04-08 10:30:14'),
(76, 'Voting Started', 'The admin started the voting', '2025-04-08 10:30:55'),
(77, 'Voting Stopped', 'The admin started the voting', '2025-04-15 11:03:00'),
(78, 'Voting Started', 'The admin started the voting', '2025-04-15 11:38:36'),
(79, 'Voting Stopped', 'The admin started the voting', '2025-04-15 11:39:45'),
(80, 'Added Clarks', 'Admin added a Partylist', '2025-04-16 12:00:04'),
(81, 'Voting Started', 'The admin started the voting', '2025-04-16 12:00:40'),
(82, 'Update Partylist', 'Admin updated a Partylist', '2025-04-16 12:16:36'),
(83, 'Update Partylist', 'Admin updated a Partylist', '2025-04-16 12:18:25'),
(84, 'Voting Stopped', 'The admin started the voting', '2025-04-23 10:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`id`, `name`, `description`, `date_time`) VALUES
(3, 'Mae Balaba', 'Has Logged in', '2024-04-09 20:28:56'),
(4, 'Mae Balaba', 'Has Logged in', '2024-04-09 20:29:36'),
(5, 'Mae Balaba', 'Has Logged in', '2024-04-09 20:32:18'),
(6, 'Mae Balaba', 'Has Logged in', '2024-04-09 20:34:00'),
(7, 'Kristina Abol', 'Has Logged in', '2024-04-09 20:35:35'),
(8, 'Kristina Abol', 'Has Logged in', '2024-04-09 20:36:17'),
(9, 'Kristina Abol', 'Has Logged in', '2024-04-09 20:39:45'),
(10, 'Kristina Abol', 'Has Logged in', '2024-04-09 21:28:52'),
(11, 'Mae Balaba', 'Has Logged in', '2024-04-10 10:57:59'),
(12, 'Mae Balaba', 'Has Logged in', '2024-04-10 11:07:46'),
(13, 'Kristina Abol', 'Has Logged in', '2024-04-10 11:09:03'),
(14, 'Mae Balaba', 'Has Logged in', '2024-04-13 10:23:04'),
(15, 'Mae Balaba', 'Has Logged in', '2024-04-13 10:27:45'),
(16, 'Kristina Abol', 'Has Logged in', '2024-04-21 11:46:58'),
(17, 'Kristina Abol', 'Has Logged in', '2024-04-21 11:47:21'),
(18, 'Kristina Abol', 'Has Logged in', '2024-04-21 11:52:47'),
(19, 'Kristina Abol', 'Has Logged in', '2024-11-12 08:16:05'),
(20, 'Kristina Abol', 'Has Logged in', '2024-11-12 08:24:42'),
(21, 'Mae Balaba', 'Has Logged in', '2024-11-12 08:25:29'),
(22, 'Kristina Abol', 'Has Logged in', '2024-11-12 14:48:07'),
(23, 'Kristina Abol', 'Has Logged in', '2024-11-12 14:51:20'),
(24, 'Kristina Abol', 'Has Logged in', '2024-11-12 14:56:44'),
(25, 'Kristina Abol', 'Has Logged in', '2024-11-12 15:07:18'),
(26, 'Kristina Abol', 'Has Logged in', '2024-11-12 15:10:08'),
(27, 'Kristina Abol', 'Has Logged in', '2024-11-17 21:54:48'),
(28, 'Kristina Abol', 'Has Logged in', '2024-11-18 20:58:15'),
(29, 'Kristina Abol', 'Has Logged in', '2024-11-18 21:05:02'),
(30, 'Kristina Abol', 'Has Logged in', '2024-11-18 21:09:25'),
(31, 'Kristina Abol', 'Has Logged in', '2024-11-18 21:35:03'),
(32, 'Jirmy Nacario', 'Has Logged in', '2024-12-17 20:05:48'),
(33, 'Jirmy Nacario', 'Has Logged in', '2024-12-17 20:12:14'),
(34, 'Jirmy Nacario', 'Has Logged in', '2024-12-17 20:13:08'),
(35, 'Jirmy Nacario', 'Has Logged in', '2024-12-17 20:14:31'),
(36, 'Jirmy Nacario', 'Has Logged in', '2024-12-17 20:19:18'),
(37, 'Jirmy Nacario', 'Has Logged in', '2024-12-17 20:36:15'),
(38, 'Jirmy Nacario', 'Has Logged in', '2024-12-17 20:56:14'),
(39, 'Jirmy Nacario', 'Has Logged in', '2025-03-31 21:06:31'),
(40, 'Jirmy Nacario', 'Has Logged in', '2025-03-31 22:16:59'),
(41, 'KK Abol', 'Has Logged in', '2025-04-01 11:34:01'),
(42, 'KK Abol', 'Has Logged in', '2025-04-01 11:35:39'),
(43, 'Jirmy Nacario', 'Has Logged in', '2025-04-01 12:02:25'),
(44, 'Jirmy Nacario', 'Has Logged in', '2025-04-01 13:00:08'),
(45, 'Jirmy Nacario', 'Has Logged in', '2025-04-01 13:04:32'),
(46, 'Jirmy Nacario', 'Has Logged in', '2025-04-01 13:11:30'),
(47, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 16:34:39'),
(48, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 16:36:02'),
(49, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 16:39:10'),
(50, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 16:50:28'),
(51, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 16:51:50'),
(52, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 17:17:49'),
(53, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 17:28:24'),
(54, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 17:31:12'),
(55, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 17:39:03'),
(56, 'Jirmy Nacario', 'Has Logged in', '2025-04-02 17:48:27'),
(57, 'Jirmy Nacario', 'Has Logged in', '2025-04-04 10:59:00'),
(58, 'Jirmy Nacario', 'Has Logged in', '2025-04-04 11:35:01'),
(59, 'Jirmy Nacario', 'Has Logged in', '2025-04-08 10:18:21'),
(60, 'Jirmy Nacario', 'Has Logged in', '2025-04-08 10:28:54'),
(61, 'Jirmy Nacario', 'Has Logged in', '2025-04-08 10:31:07'),
(62, 'Jirmy Nacario', 'Has Logged in', '2025-04-15 11:07:42'),
(63, 'Jirmy Nacario', 'Has Logged in', '2025-04-15 11:07:51'),
(64, 'Jirmy Nacario', 'Has Logged in', '2025-04-15 11:38:46'),
(65, 'Jirmy Nacario', 'Has Logged in', '2025-04-16 12:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `running_for` varchar(50) NOT NULL,
  `partylist` varchar(100) NOT NULL,
  `date_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `name`, `running_for`, `partylist`, `date_time`) VALUES
(3, 'Pito Pito', 'President', 'Independent', '2025-04-04 10:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `can_id` int(11) NOT NULL,
  `partylist` varchar(50) DEFAULT NULL,
  `pres` varchar(50) DEFAULT NULL,
  `vice` varchar(50) DEFAULT NULL,
  `sec` varchar(50) DEFAULT NULL,
  `trea` varchar(50) DEFAULT NULL,
  `aud` varchar(50) DEFAULT NULL,
  `pio1` varchar(50) DEFAULT NULL,
  `pio2` varchar(50) DEFAULT NULL,
  `pio3` varchar(50) DEFAULT NULL,
  `pio4` varchar(50) DEFAULT NULL,
  `po1` varchar(50) DEFAULT NULL,
  `po2` varchar(50) DEFAULT NULL,
  `po3` varchar(50) DEFAULT NULL,
  `g7_rep` varchar(50) DEFAULT NULL,
  `g8_rep` varchar(50) DEFAULT NULL,
  `g9_rep` varchar(50) DEFAULT NULL,
  `g10_rep` varchar(50) DEFAULT NULL,
  `g11_rep` varchar(50) DEFAULT NULL,
  `g11_strand` varchar(60) DEFAULT NULL,
  `g12_rep` varchar(50) DEFAULT NULL,
  `g12_strand` varchar(80) NOT NULL,
  `date_time` varchar(60) NOT NULL,
  `slogan` text NOT NULL,
  `projects` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`can_id`, `partylist`, `pres`, `vice`, `sec`, `trea`, `aud`, `pio1`, `pio2`, `pio3`, `pio4`, `po1`, `po2`, `po3`, `g7_rep`, `g8_rep`, `g9_rep`, `g10_rep`, `g11_rep`, `g11_strand`, `g12_rep`, `g12_strand`, `date_time`, `slogan`, `projects`) VALUES
(3, 'pedrina selection', 'Johnny Sins', 'John Wall', 'Stpehen curry', 'Michael Jordan', 'Ant Man', 'Derrick Rose', 'Paul George', 'Kevin Durant', 'Kevin Booker', 'Tracy Grady', 'Bech cheering', 'Dili Musali', 'LA Tenorio', 'Test lang', 'Ronaldo Carpio', 'Rodrigo Duterte', 'Inday Sar', NULL, 'Bbm bangag', '', '2025-04-02 17:47:25', 'Jack Suarez', NULL),
(4, 'Cristy and Friends 2', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', 'Johnny Eleen', NULL, 'Johnny Eleen', '', '2025-04-08 10:28:27', 'Johnny Eleen', 'Johnny Eleen'),
(5, 'Clarks', 'Clarks Manyak', 'Clarks Pisot', 'Clarks Steven', 'Clarks Steven', 'Clarks Steven', 'Clarks Steven', '', '', '', 'Clarks Steven', 'Clarks Steven', '', 'Clarks Steven', 'Clarks Steven', 'Clarks Steven', 'Clarks Steven', 'Clarks Steven', 'STEM', 'Clarks Steven', 'HUMSS', '2025-04-16 12:00:04', 'Bayot Pisot', 'Patuli ang mga bayot');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `email` varchar(255) NOT NULL,
  `attempts` int(11) DEFAULT 0,
  `last_attempt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`email`, `attempts`, `last_attempt`) VALUES
('', 1, '2024-12-17 19:42:33'),
('admin@gmail.com', 19, '2025-04-24 21:13:13'),
('arjie@gmail.com', 4, '2025-04-01 13:11:19'),
('jirmskie9@gmai.com', 1, '2025-04-08 10:28:42'),
('jirmskie9@gmail.com', 15, '2025-04-15 11:02:10'),
('jirmyskie@gmail.com', 1, '2025-04-02 17:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `pin`
--

CREATE TABLE `pin` (
  `pin_id` int(11) NOT NULL,
  `pin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pin`
--

INSERT INTO `pin` (`pin_id`, `pin`) VALUES
(1, 'd3b1fb02964aa64e257f9f26a31f72cf');

-- --------------------------------------------------------

--
-- Table structure for table `signal_db`
--

CREATE TABLE `signal_db` (
  `signal_id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signal_db`
--

INSERT INTO `signal_db` (`signal_id`, `description`) VALUES
(1, 'Waiting');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `lrn` varchar(200) NOT NULL,
  `name` varchar(80) NOT NULL,
  `year_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `lrn`, `name`, `year_level`) VALUES
(1, '130-0239-201', 'Jack Sparrow', '7'),
(2, '130-0239-202', 'John Doe', '9'),
(3, '130-0239-203', 'Mighty Jungle', '12'),
(4, '130-0239-204', 'Seven Eleven', '8'),
(5, '130-0239-205', 'Steve Kerr', '10'),
(6, '130-0239-206', 'Elen Adarna', '11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(25) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `grade` double NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `u_type` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `confirmation` varchar(30) NOT NULL,
  `otp` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `student_id`, `name`, `email`, `password`, `grade`, `birthday`, `u_type`, `status`, `confirmation`, `otp`) VALUES
(3, '0000-00000', 'Admin Here', 'admin@gmail.com', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 12, '2001-09-12', 'Admin', 'To Vote', 'Complete', 707494),
(4, '2022-11912', 'Mae Balaba', 'balabacristymae@gmail.com', '94a181ffe31cf8516e4fa4e3f5297bd7', 7, '2003-06-19', 'Admin', 'To Vote', 'Complete', 773983),
(5, '2023-67293', 'Elen Adarn', 'adarna@gmail.com', '5093186a2e133e6bf34d56f8b485076a', 9, '2006-03-16', 'Voter', 'To Vote', 'Verified', 561435),
(6, '2024-01234', 'Crisjay Nacario', 'nacariozeyn@gmail.com', '5093186a2e133e6bf34d56f8b485076a', 12, '2003-02-12', 'Voter', 'To Vote', 'Verified', 292875),
(7, '2021-02171', 'Test Lang', 'test@gmail.com', '94a181ffe31cf8516e4fa4e3f5297bd7', 9, '2002-02-12', 'Voter', 'To Vote', 'Pending', 342152),
(8, '2021-02173', 'Jirmy Nacario', 'jirmskie9@gmail.com', '94a181ffe31cf8516e4fa4e3f5297bd7', 12, '2002-07-09', 'Voter', 'To Vote', 'Complete', 676849),
(9, '2021-02932', 'KK Abol', 'kkabol@gmail.com', '94a181ffe31cf8516e4fa4e3f5297bd7', 9, '2012-06-12', 'Voter', 'To Vote', 'Complete', 741812),
(10, '2023-00880', 'Arjie Delasalas', 'delasalas@gmail.com', '94a181ffe31cf8516e4fa4e3f5297bd7', 10, '2007-06-12', 'Voter', 'To Vote', 'Complete', 208674),
(11, '2023-19238', 'Lolita Tablingon', 'jirmy09@gmail.com', '94a181ffe31cf8516e4fa4e3f5297bd7', 9, '2002-07-09', 'Voter', 'To Vote', 'Complete', 826169),
(12, '130-0239-206', 'Elen Adarna', 'elen@gmail.com', '94a181ffe31cf8516e4fa4e3f5297bd7', 8, '2002-07-09', 'Voter', 'To Vote', 'Verified', 696799);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `vote_name` varchar(100) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `voted_pres` varchar(100) NOT NULL,
  `voted_vice` varchar(100) NOT NULL,
  `voted_sec` varchar(100) NOT NULL,
  `voted_trea` varchar(100) NOT NULL,
  `voted_aud` varchar(100) NOT NULL,
  `voted_pio1` varchar(100) NOT NULL,
  `voted_pio2` varchar(100) NOT NULL,
  `voted_pio3` varchar(100) NOT NULL,
  `voted_pio4` varchar(100) NOT NULL,
  `voted_po1` varchar(100) NOT NULL,
  `voted_po2` varchar(100) NOT NULL,
  `voted_po3` varchar(100) NOT NULL,
  `voted_representative` varchar(100) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vote_counting`
--

CREATE TABLE `vote_counting` (
  `vote_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `partylist` varchar(100) NOT NULL,
  `count` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote_counting`
--

INSERT INTO `vote_counting` (`vote_id`, `name`, `position`, `partylist`, `count`) VALUES
(1, 'Johnny Sins', 'President', 'pedrina selection', 0),
(2, 'John Wall', 'Vice President', 'pedrina selection', 0),
(3, 'Stpehen curry', 'Secretary', 'pedrina selection', 0),
(4, 'Michael Jordan', 'Treasurer', 'pedrina selection', 0),
(5, 'Ant Man', 'Auditor', 'pedrina selection', 0),
(6, 'Derrick Rose', 'Public Information Officer', 'pedrina selection', 0),
(7, 'Paul George', 'Public Information Officer', 'pedrina selection', 0),
(8, 'Kevin Durant', 'Public Information Officer', 'pedrina selection', 0),
(9, 'Kevin Booker', 'Public Information Officer', 'pedrina selection', 0),
(10, 'Tracy Grady', 'Peace Officer', 'pedrina selection', 0),
(11, 'Bech cheering', 'Peace Officer', 'pedrina selection', 0),
(12, 'Dili Musali', 'Peace Officer', 'pedrina selection', 0),
(13, 'LA Tenorio', 'Grade 7 Representative', 'pedrina selection', 0),
(14, 'Test lang', 'Grade 8 Representative', 'pedrina selection', 0),
(15, 'Ronaldo Carpio', 'Grade 9 Representative', 'pedrina selection', 0),
(16, 'Rodrigo Duterte', 'Grade 10 Representative', 'pedrina selection', 0),
(17, 'Inday Sar', 'Grade 11 Representative', 'pedrina selection', 0),
(18, 'Bbm bangag', 'Grade 12 Representative', 'pedrina selection', 0),
(19, 'Pito Pito', 'President', 'Independent', 0),
(20, 'Johnny Eleen', 'President', 'Cristy and Friends 2', 0),
(21, 'Johnny Eleen', 'Vice President', 'Cristy and Friends 2', 0),
(22, 'Johnny Eleen', 'Secretary', 'Cristy and Friends 2', 0),
(23, 'Johnny Eleen', 'Treasurer', 'Cristy and Friends 2', 0),
(24, 'Johnny Eleen', 'Auditor', 'Cristy and Friends 2', 0),
(25, 'Johnny Eleen', 'Public Information Officer', 'Cristy and Friends 2', 0),
(26, 'Johnny Eleen', 'Public Information Officer', 'Cristy and Friends 2', 0),
(27, 'Johnny Eleen', 'Public Information Officer', 'Cristy and Friends 2', 0),
(28, 'Johnny Eleen', 'Public Information Officer', 'Cristy and Friends 2', 0),
(29, 'Johnny Eleen', 'Peace Officer', 'Cristy and Friends 2', 0),
(30, 'Johnny Eleen', 'Peace Officer', 'Cristy and Friends 2', 0),
(31, 'Johnny Eleen', 'Peace Officer', 'Cristy and Friends 2', 0),
(32, 'Johnny Eleen', 'Grade 7 Representative', 'Cristy and Friends 2', 0),
(33, 'Johnny Eleen', 'Grade 8 Representative', 'Cristy and Friends 2', 0),
(34, 'Johnny Eleen', 'Grade 9 Representative', 'Cristy and Friends 2', 0),
(35, 'Johnny Eleen', 'Grade 10 Representative', 'Cristy and Friends 2', 0),
(36, 'Johnny Eleen', 'Grade 11 Representative', 'Cristy and Friends 2', 0),
(37, 'Johnny Eleen', 'Grade 12 Representative', 'Cristy and Friends 2', 0),
(38, 'Clarks Manyak', 'President', 'Clarks', 0),
(39, 'Clarks Pisot', 'Vice President', 'Clarks', 0),
(40, 'Clarks Steven', 'Secretary', 'Clarks', 0),
(41, 'Clarks Steven', 'Treasurer', 'Clarks', 0),
(42, 'Clarks Steven', 'Auditor', 'Clarks', 0),
(43, 'Clarks Steven', 'Public Information Officer', 'Clarks', 0),
(44, '', 'Public Information Officer', 'Clarks', 0),
(45, '', 'Public Information Officer', 'Clarks', 0),
(46, '', 'Public Information Officer', 'Clarks', 0),
(47, 'Clarks Steven', 'Peace Officer', 'Clarks', 0),
(48, 'Clarks Steven', 'Peace Officer', 'Clarks', 0),
(49, '', 'Peace Officer', 'Clarks', 0),
(50, 'Clarks Steven', 'Grade 7 Representative', 'Clarks', 0),
(51, 'Clarks Steven', 'Grade 8 Representative', 'Clarks', 0),
(52, 'Clarks Steven', 'Grade 9 Representative', 'Clarks', 0),
(53, 'Clarks Steven', 'Grade 10 Representative', 'Clarks', 0),
(54, 'Clarks Steven', 'Grade 11 Representative', 'Clarks', 0),
(55, 'Clarks Steven', 'Grade 12 Representative', 'Clarks', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voting_activity`
--

CREATE TABLE `voting_activity` (
  `act_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting_activity`
--

INSERT INTO `voting_activity` (`act_id`, `name`, `description`, `date_time`) VALUES
(1, 'Kristina Abol', 'has Voted', '2024-03-09 09:37:43'),
(2, 'Mae Balaba', 'has Voted', '2024-04-09 14:22:40'),
(3, 'Kristina Abol', 'has Voted', '2024-04-09 20:40:22'),
(4, 'Mae Balaba', 'has Voted', '2024-04-10 11:08:25'),
(5, 'Kristina Abol', 'has Voted', '2024-04-10 11:09:19'),
(6, 'SXm9kBDYMmtOgnvGOLZ8guEISRK1NOgbJsi2++hPKQQ=', 'has Voted', '2024-04-13 10:29:26'),
(7, 'toy2TCkGQZ67b6DFAx6DkljvvYUVYyPKxjqNtxyBTMk=', 'has Voted', '2024-04-21 11:48:03'),
(8, '+xrONj3pubwevZrlO/3Q3AsF1TpGYR4/e0WfDdeHopM=', 'has Voted', '2024-11-18 21:09:56'),
(9, 'Njy1sNt00K6+I6dKYAdoO2pAht657OU2sZ/9fqANokM=', 'has Voted', '2025-04-01 11:47:15'),
(10, '3mdKyEbiLzu+xxxkwQ+oacOduyclBW1ms3oWvcSnDPk=', 'has Voted', '2025-04-01 13:05:27'),
(11, 'J0IctRERz8HovHDQd0LoZAujpviexRFug1O9ev0a2mY=', 'has Voted', '2025-04-02 16:58:45'),
(12, 'k5sk0E56SZ8D7Z8xtJWVtkChgVTXF6GhQc/ofqXc4PA=', 'has Voted', '2025-04-02 17:18:18'),
(13, 'FWMO2+D0X1as9KxyWXosrBbnSeph6eC4MDcQewxiUPw=', 'has Voted', '2025-04-02 17:48:53'),
(14, 'Zmlm5cv0G+gMKvV1bs+hpBpi84FZBFTCn9pKnkZxEuA=', 'has Voted', '2025-04-04 10:59:30'),
(15, 'qP+dOYitjHGdscnuwf8sKI5rwE+1T7WwuvHNNljCN3c=', 'has Voted', '2025-04-16 12:10:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`can_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pin`
--
ALTER TABLE `pin`
  ADD PRIMARY KEY (`pin_id`);

--
-- Indexes for table `signal_db`
--
ALTER TABLE `signal_db`
  ADD PRIMARY KEY (`signal_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `vote_counting`
--
ALTER TABLE `vote_counting`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `voting_activity`
--
ALTER TABLE `voting_activity`
  ADD PRIMARY KEY (`act_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `can_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pin`
--
ALTER TABLE `pin`
  MODIFY `pin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `signal_db`
--
ALTER TABLE `signal_db`
  MODIFY `signal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vote_counting`
--
ALTER TABLE `vote_counting`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `voting_activity`
--
ALTER TABLE `voting_activity`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
