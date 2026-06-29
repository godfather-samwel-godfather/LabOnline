-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2026 at 10:38 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_labo`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `rebooked_from_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `laboratory_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `type` enum('lab_test','consultation') DEFAULT NULL,
  `sample_collection` enum('home','lab') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('pending','paid','approved','rejected','completed','cancelled') DEFAULT 'pending',
  `priority` enum('normal','urgent') NOT NULL DEFAULT 'normal',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rejection_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `rebooked_from_id`, `patient_id`, `doctor_id`, `laboratory_id`, `appointment_date`, `appointment_time`, `type`, `sample_collection`, `address`, `notes`, `status`, `priority`, `created_at`, `rejection_reason`) VALUES
(1, NULL, 19, 26, 2, '2026-06-16', '09:57:00', 'lab_test', 'lab', NULL, 'ineed malaria checkup by microscope instrument not other instrument because iknow microscope is high accurate than other method', 'completed', 'normal', '2026-06-15 13:00:21', NULL),
(2, NULL, 19, 20, 2, '2026-06-24', '19:45:00', 'lab_test', 'lab', NULL, 'ineed all measurement to be done by microscope instrument', 'completed', 'normal', '2026-06-24 11:48:28', NULL),
(3, NULL, 27, 20, 2, '2026-06-25', '20:30:00', 'lab_test', 'lab', NULL, 'please ineed to save time so idont need to waste time during labo test .', 'completed', 'normal', '2026-06-25 12:43:20', NULL),
(4, NULL, 19, 20, 2, '2026-06-25', '20:30:00', 'lab_test', 'lab', NULL, 'please ineet to conduct test verry fast', 'completed', 'normal', '2026-06-25 15:58:17', NULL),
(5, NULL, 27, 26, 2, '2026-06-25', '21:30:00', 'lab_test', 'lab', NULL, 'idont need to waste time just come conduct test and go please note this', 'completed', 'normal', '2026-06-25 16:32:13', NULL),
(6, NULL, 27, 20, 2, '2026-06-25', '23:12:00', 'lab_test', 'lab', NULL, 'ineed fasr service please', 'completed', 'normal', '2026-06-25 18:13:24', NULL),
(7, NULL, 19, 20, 2, '2026-06-25', '23:45:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-25 18:16:31', NULL),
(8, NULL, 27, 20, 2, '2026-06-26', '13:30:00', 'lab_test', 'lab', NULL, 'ineed to get fast service please', 'rejected', 'normal', '2026-06-26 09:02:19', 'failed try again to choose another time now booked full'),
(9, NULL, 27, 20, 2, '2026-06-26', '16:00:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'rejected', 'normal', '2026-06-26 12:18:49', 'patient has not paid yet'),
(10, NULL, 27, 26, 2, '2026-06-26', '16:24:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-26 12:23:06', NULL),
(11, NULL, 27, 20, 2, '2026-06-26', '16:30:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-26 12:27:41', NULL),
(12, NULL, 27, 20, 2, '2026-06-26', '17:00:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-26 12:41:07', NULL),
(13, NULL, 19, 26, 2, '2026-06-26', '18:40:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'rejected', 'normal', '2026-06-26 13:41:25', 'please reebok test choose another time'),
(14, NULL, 19, 26, 2, '2026-06-26', '19:00:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-26 13:43:48', NULL),
(15, NULL, 19, 26, 2, '2026-06-26', '19:45:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-26 14:44:10', NULL),
(16, NULL, 19, 26, 2, '2026-06-26', '19:50:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-26 14:49:13', NULL),
(17, 13, 19, 26, 2, '2026-06-26', '20:30:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-26 15:48:32', NULL),
(18, NULL, 19, 20, 2, '2026-06-26', '21:00:00', 'lab_test', 'lab', NULL, 'ineed my doctor to be carefull', 'rejected', 'normal', '2026-06-26 15:55:44', 'full booked time choose another time'),
(19, 18, 19, 20, 2, '2026-06-26', '22:00:00', 'lab_test', 'lab', NULL, 'ineed my doctor to be carefull', 'completed', 'normal', '2026-06-26 15:59:32', NULL),
(20, NULL, 19, 20, 2, '2026-06-26', '23:00:00', 'lab_test', 'lab', NULL, 'ineed my doctor to be carefull during test', 'rejected', 'normal', '2026-06-26 16:38:18', 'choose another time'),
(21, 20, 19, 20, 2, '2026-06-26', '23:30:00', 'lab_test', 'lab', NULL, 'ineed special chair and cool AC room', 'completed', 'normal', '2026-06-26 16:41:44', NULL),
(22, NULL, 19, 20, 2, '2026-06-27', '18:00:00', 'lab_test', 'lab', NULL, 'ineed fast service and carefull service', 'completed', 'normal', '2026-06-27 14:18:59', NULL),
(23, NULL, 19, 20, 2, '2026-06-28', '11:20:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'rejected', 'normal', '2026-06-28 07:20:24', 'choose another time'),
(24, 23, 19, 20, 2, '2026-06-28', '00:30:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-28 07:28:04', NULL),
(25, NULL, 19, 20, 2, '2026-06-28', '01:35:00', 'lab_test', 'lab', NULL, 'ineed carefully doctor', 'completed', 'normal', '2026-06-28 07:33:52', NULL),
(26, NULL, 19, 20, 2, '2026-06-28', '11:28:00', 'lab_test', 'lab', NULL, 'ineed fast service', 'completed', 'normal', '2026-06-28 08:22:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_history`
--

CREATE TABLE `appointment_history` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_history`
--

INSERT INTO `appointment_history` (`id`, `appointment_id`, `status`, `changed_by`, `notes`, `created_at`) VALUES
(1, 1, 'pending', 19, 'Appointment created by patient', '2026-06-15 13:00:21'),
(2, 1, 'approved', 21, 'Appointment approved by laboratory', '2026-06-17 13:05:07'),
(3, 1, 'completed', 21, 'Lab uploaded test result', '2026-06-17 13:09:42'),
(4, 2, 'pending', 19, 'Appointment created by patient', '2026-06-24 11:48:28'),
(5, 2, 'approved', 21, 'Appointment approved by laboratory', '2026-06-24 13:35:19'),
(6, 2, 'completed', 21, 'Lab uploaded test result', '2026-06-24 13:41:41'),
(7, 3, 'pending', 27, 'Appointment created by patient', '2026-06-25 12:43:20'),
(8, 3, 'approved', 21, 'Appointment approved by laboratory', '2026-06-25 12:46:34'),
(9, 3, 'completed', 21, 'Lab uploaded test result', '2026-06-25 12:52:19'),
(10, 4, 'pending', 19, 'Appointment created by patient', '2026-06-25 15:58:17'),
(11, 4, 'approved', 21, 'Appointment approved by laboratory', '2026-06-25 16:26:38'),
(12, 4, 'completed', 21, 'Lab uploaded test result', '2026-06-25 16:28:14'),
(13, 5, 'pending', 27, 'Appointment created by patient', '2026-06-25 16:32:13'),
(14, 5, 'approved', 21, 'Appointment approved by laboratory', '2026-06-25 17:29:13'),
(15, 5, 'completed', 21, 'Lab uploaded test result', '2026-06-25 17:30:14'),
(16, 6, 'pending', 27, 'Appointment created by patient', '2026-06-25 18:13:24'),
(17, 7, 'pending', 19, 'Appointment created by patient', '2026-06-25 18:16:31'),
(18, 7, 'approved', 21, 'Appointment approved by laboratory', '2026-06-25 18:18:42'),
(19, 7, 'completed', 21, 'Lab uploaded test result', '2026-06-25 18:19:21'),
(20, 6, 'approved', 21, 'Appointment approved by laboratory', '2026-06-25 18:30:02'),
(21, 6, 'completed', 21, 'Lab uploaded test result', '2026-06-25 18:30:24'),
(22, 8, 'pending', 27, 'Appointment created by patient', '2026-06-26 09:02:19'),
(23, 8, 'rejected', 21, 'failed try again to choose another time now booked full', '2026-06-26 10:52:04'),
(24, 9, 'pending', 27, 'Appointment created by patient', '2026-06-26 12:18:49'),
(25, 9, 'rejected', 21, 'patient has not paid yet', '2026-06-26 12:20:18'),
(26, 10, 'pending', 27, 'Appointment created by patient', '2026-06-26 12:23:06'),
(27, 10, 'approved', 21, 'Appointment approved by laboratory', '2026-06-26 12:23:48'),
(28, 10, 'completed', 21, 'Lab uploaded test result', '2026-06-26 12:24:34'),
(29, 11, 'pending', 27, 'Appointment created by patient', '2026-06-26 12:27:41'),
(30, 12, 'pending', 27, 'Appointment created by patient', '2026-06-26 12:41:07'),
(31, 11, 'approved', 21, 'Appointment approved by laboratory', '2026-06-26 13:40:17'),
(32, 12, 'approved', 21, 'Appointment approved by laboratory', '2026-06-26 13:40:19'),
(33, 13, 'pending', 19, 'Appointment created by patient', '2026-06-26 13:41:25'),
(34, 13, 'rejected', 21, 'please reebok test choose another time', '2026-06-26 13:42:22'),
(35, 14, 'pending', 19, 'Appointment created by patient', '2026-06-26 13:43:48'),
(36, 14, 'approved', 21, 'Appointment approved by laboratory', '2026-06-26 14:41:23'),
(37, 15, 'pending', 19, 'Appointment created by patient', '2026-06-26 14:44:10'),
(38, 15, 'approved', 21, 'Appointment approved by laboratory', '2026-06-26 14:44:46'),
(39, 11, 'completed', 21, 'Lab uploaded test result', '2026-06-26 14:47:01'),
(40, 12, 'completed', 21, 'Lab uploaded test result', '2026-06-26 14:47:17'),
(41, 14, 'completed', 21, 'Lab uploaded test result', '2026-06-26 14:47:33'),
(42, 15, 'completed', 21, 'Lab uploaded test result', '2026-06-26 14:47:47'),
(43, 16, 'pending', 19, 'Appointment created by patient', '2026-06-26 14:49:13'),
(44, 16, 'approved', 21, 'Appointment approved by laboratory', '2026-06-26 14:49:36'),
(45, 16, 'completed', 21, 'Lab uploaded test result', '2026-06-26 14:50:01'),
(46, 17, 'pending', 19, 'Appointment created by patient', '2026-06-26 15:48:32'),
(47, 17, 'approved', 21, 'Appointment approved by laboratory', '2026-06-26 15:49:30'),
(48, 17, 'completed', 21, 'Lab uploaded test result', '2026-06-26 15:50:51'),
(49, 18, 'pending', 19, 'Appointment created by patient', '2026-06-26 15:55:44'),
(50, 18, 'rejected', 21, 'full booked time choose another time', '2026-06-26 15:57:35'),
(51, 19, 'pending', 19, 'Appointment created by patient', '2026-06-26 15:59:32'),
(52, 19, 'approved', 21, 'Appointment approved by laboratory', '2026-06-26 15:59:57'),
(53, 19, 'completed', 21, 'Lab uploaded test result', '2026-06-26 16:00:53'),
(54, 20, 'pending', 19, 'Appointment created by patient', '2026-06-26 16:38:18'),
(55, 20, 'rejected', 21, 'choose another time', '2026-06-26 16:39:03'),
(56, 21, 'pending', 19, 'Appointment created by patient', '2026-06-26 16:41:44'),
(57, 21, 'approved', 21, 'Appointment approved by laboratory', '2026-06-26 16:42:57'),
(58, 21, 'completed', 21, 'Lab uploaded test result', '2026-06-26 16:43:16'),
(59, 22, 'pending', 19, 'Appointment created by patient', '2026-06-27 14:18:59'),
(60, 22, 'approved', 21, 'Appointment approved by laboratory', '2026-06-28 07:19:19'),
(61, 23, 'pending', 19, 'Appointment created by patient', '2026-06-28 07:20:24'),
(62, 23, 'rejected', 21, 'choose another time', '2026-06-28 07:26:40'),
(63, 24, 'pending', 19, 'Appointment created by patient', '2026-06-28 07:28:04'),
(64, 24, 'approved', 21, 'Appointment approved by laboratory', '2026-06-28 07:28:43'),
(65, 22, 'completed', 21, 'Lab uploaded test result', '2026-06-28 07:29:58'),
(66, 24, 'completed', 21, 'Lab uploaded test result', '2026-06-28 07:30:19'),
(67, 25, 'pending', 19, 'Appointment created by patient', '2026-06-28 07:33:52'),
(68, 26, 'pending', 19, 'Appointment created by patient', '2026-06-28 08:22:50'),
(69, 25, 'approved', 21, 'Appointment approved by laboratory', '2026-06-28 08:23:53'),
(70, 26, 'approved', 21, 'Appointment approved by laboratory', '2026-06-28 08:23:55'),
(71, 25, 'completed', 21, 'Lab uploaded test result', '2026-06-28 08:24:26'),
(72, 26, 'completed', 21, 'Lab uploaded test result', '2026-06-28 08:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_tests`
--

CREATE TABLE `appointment_tests` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_tests`
--

INSERT INTO `appointment_tests` (`id`, `appointment_id`, `test_id`) VALUES
(1, 1, 3),
(2, 2, 4),
(3, 3, 5),
(4, 4, 4),
(5, 5, 6),
(6, 6, 8),
(7, 7, 12),
(8, 8, 6),
(9, 9, 8),
(10, 10, 9),
(11, 11, 6),
(12, 12, 6),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 10),
(19, 19, 10),
(20, 20, 8),
(21, 21, 8),
(22, 22, 2),
(23, 23, 12),
(24, 24, 12),
(25, 25, 8),
(26, 26, 4);

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `action_type` varchar(50) DEFAULT NULL,
  `old_data` text DEFAULT NULL,
  `new_data` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `reply` text DEFAULT NULL,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`, `status`, `reply`, `replied_at`, `created_at`) VALUES
(1, 'godfather samwel', 'godfathersamwel1997@gmail.com', 'naomba kujua jinsi ya kufanya appointment', 'naomba kufahamu ili niweze kufanya booking ya online medical laboratory test and delivery of results ninafanyaje nafuata steps zipi', 'replied', 'sawa asante kwa kuchagua huduma zetu sasa nenda kwenye dashboard ya patient chagua booking page kama umesha login na kama ni new user fanya kwanza registration', '2026-06-17 21:26:04', '2026-06-17 18:38:14'),
(3, 'abdallah sudi', 'abdallahkiwele71@gmail.com', 'naomba kujua vipimo mnavyo vitoa', 'je ni aina gani ya vipimo mnavyo vitoa na bei yake nataka kujua naomba nisaidie kunijibu hili', 'replied', 'register first', '2026-06-18 10:17:44', '2026-06-18 09:24:01'),
(4, 'scholar robert mushi', 'scholarhobi@gmail.com', 'muda wa kupokea majibu yangu baada ya vipimo je sio mwingi?', 'naomba mnielekeze jinsi ya kuchagua vipimo na kujua vinatumia muda gani adi kufanikiwa kupokea majibu', 'replied', 'asante kwa kuchagua huduma zetu , huduma zetu ni zaharaka na uhakika hivyo hutopoteza muda kupokea huduma yako.', '2026-06-18 09:29:19', '2026-06-18 09:27:05'),
(5, 'bornaventure james', 'bornavee12@gmail.com', 'huduma ya booking inafanyikaje', 'naomba kueleweshwa hii huduma naipataje kutoka kwenye website yenu', 'pending', NULL, NULL, '2026-06-18 10:54:51'),
(6, 'Brison mwanga', 'brison100@gmail.com', 'naitaj huduma ya booking ikoje', 'naweza kupata maelekezo jinsi ya kufanya booking', 'replied', 'asante kwa kuchagua huduma zetu ,kama ni mtumiaji mpya fanya registration kwanza ndipo uweze kulogin ndani ya account yako na ufanye booking asante kwa kuchagua huduma zetu', '2026-06-18 11:23:38', '2026-06-18 11:07:31'),
(7, 'Annastazia wandwi mgesi', 'Anniemgesi1002@gmail.com', 'sorry ineed to Do pregnancy Test please instruct me how to get it harryup', 'my name ia annastazia wandwi mgesi  please ifeel like ihave pregnancy since istarted to conduct sex with my boyfriend so ineed to chech pregnancy help me how get this  service', 'pending', NULL, NULL, '2026-06-25 11:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `license_number` varchar(100) DEFAULT NULL,
  `hospital_name` varchar(150) DEFAULT NULL,
  `doctor_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `specialization`, `license_number`, `hospital_name`, `doctor_address`) VALUES
(5, 20, 'pediatrician', 'MD-2026-TZ', 'MOHAS', 'Malamba-RD'),
(6, 25, 'blood system', 'MD-2027-TZ', 'MUHIMBILI', 'Kinondoni road'),
(7, 26, 'blood system', 'MD-006-2026-TZ', 'MIKOCHEN B HOSPITAL', 'mikocheni Rd');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_referrals`
--

CREATE TABLE `doctor_referrals` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `referred_to` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laboratories`
--

CREATE TABLE `laboratories` (
  `id` int(11) NOT NULL,
  `labo_name` varchar(100) NOT NULL,
  `labo_address` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `available_tests` text DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laboratories`
--

INSERT INTO `laboratories` (`id`, `labo_name`, `labo_address`, `location`, `available_tests`, `user_id`) VALUES
(2, 'Aga Khan Laboratory', 'Plot 123, uhuru street', 'Dar es salaam, uhuru', 'Blood test, malaria test, urine test, HIV test', 21);

-- --------------------------------------------------------

--
-- Table structure for table `lab_staff`
--

CREATE TABLE `lab_staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lab_tests`
--

CREATE TABLE `lab_tests` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `test_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_tests`
--

INSERT INTO `lab_tests` (`id`, `category_id`, `test_name`, `description`, `price`, `duration`, `is_active`) VALUES
(1, 1, 'Full Blood Count', 'CBC panel', '25000.00', '24h', 1),
(2, 1, 'Hemoglobin', 'Hb level', '15000.00', '6h', 1),
(3, 2, 'Malaria Rapid Test', 'Malaria screening', '10000.00', '2h', 1),
(4, 3, 'Urinalysis', 'Urine routine', '12000.00', '12h', 1),
(5, 4, 'HIV Screening', 'HIV test', '20000.00', '24h', 1),
(6, 1, 'Blood sugar', 'Blood glucose screening', '15000.00', '4h', 1),
(7, 5, 'Pregnancy Test', 'Detection of Pregnancy hormone in in urine sample', '8000.00', '2h', 1),
(8, 1, 'Blood Group Test', 'Identification of blood group type and Rh factor', '10000.00', '1h', 1),
(9, 6, 'Kidney Function Test', 'Assessment of kidney performance using blood sample analysis', '40000.00', '24h', 1),
(10, 6, 'Liver Function Test (LFT)', 'Test to evaluate  liver health and function', '45000.00', '24h', 1),
(11, 6, 'Cholesterol Test', 'Measurement of cholesterol level in blood', '20000.00', '4h', 0),
(12, 2, 'stool Examination', 'Analysis of stool sample to detect parasites and infections', '150000.00', '6h', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `patient_address` text NOT NULL,
  `blood_group` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `user_id`, `gender`, `dob`, `patient_address`, `blood_group`) VALUES
(2, 19, 'male', '1997-07-27', 'mbweni', 'B+'),
(3, 24, 'male', '2006-02-04', 'mbweni', 'O+'),
(4, 27, 'male', '2009-06-01', 'Dodoma town', 'B+');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `reference_payment_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `appointment_id`, `reference_payment_id`, `amount`, `payment_method`, `payment_status`, `transaction_id`, `created_at`) VALUES
(1, 2, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782307531', '2026-06-24 13:25:31'),
(2, 3, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782391452', '2026-06-25 12:44:12'),
(3, 4, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782403641', '2026-06-25 16:07:21'),
(4, 5, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782408532', '2026-06-25 17:28:52'),
(5, 7, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782411410', '2026-06-25 18:16:50'),
(6, 6, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782412130', '2026-06-25 18:28:50'),
(7, 8, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782464551', '2026-06-26 09:02:31'),
(8, 10, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782476599', '2026-06-26 12:23:19'),
(9, 11, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782481166', '2026-06-26 13:39:26'),
(10, 12, NULL, '50000.00', 'Simulation', 'paid', 'TXN-1782481200', '2026-06-26 13:40:00'),
(11, 13, NULL, '50000.00', NULL, 'paid', NULL, '2026-06-26 13:41:25'),
(12, 14, 11, '50000.00', NULL, 'pending', NULL, '2026-06-26 13:43:48'),
(13, 15, 11, '50000.00', NULL, 'paid', NULL, '2026-06-26 14:44:10'),
(14, 16, 11, '50000.00', NULL, 'paid', NULL, '2026-06-26 14:49:13'),
(15, 17, 11, '50000.00', NULL, 'paid', NULL, '2026-06-26 15:48:32'),
(16, 18, NULL, '50000.00', NULL, 'paid', NULL, '2026-06-26 15:55:44'),
(17, 19, 16, '50000.00', NULL, 'paid', NULL, '2026-06-26 15:59:32'),
(18, 20, NULL, '50000.00', NULL, 'paid', NULL, '2026-06-26 16:38:18'),
(19, 21, 18, '50000.00', NULL, 'paid', NULL, '2026-06-26 16:41:44'),
(20, 22, NULL, '50000.00', NULL, 'paid', NULL, '2026-06-27 14:18:59'),
(21, 23, NULL, '50000.00', NULL, 'paid', NULL, '2026-06-28 07:20:24'),
(22, 24, 21, '50000.00', NULL, 'paid', NULL, '2026-06-28 07:28:04'),
(23, 25, NULL, '50000.00', NULL, 'paid', NULL, '2026-06-28 07:33:52'),
(24, 26, NULL, '50000.00', NULL, 'paid', 'TXN001', '2026-06-28 08:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `medication` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `result_details`
--

CREATE TABLE `result_details` (
  `id` int(11) NOT NULL,
  `result_id` int(11) DEFAULT NULL,
  `parameter_name` varchar(100) DEFAULT NULL,
  `parameter_value` varchar(100) DEFAULT NULL,
  `normal_range` varchar(100) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sample_collections`
--

CREATE TABLE `sample_collections` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `collector_id` int(11) DEFAULT NULL,
  `collection_date` date DEFAULT NULL,
  `collection_time` time DEFAULT NULL,
  `status` enum('pending','collected','delivered') DEFAULT 'pending',
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('open','closed') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test_categories`
--

CREATE TABLE `test_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_categories`
--

INSERT INTO `test_categories` (`id`, `category_name`) VALUES
(1, 'Hematology'),
(2, 'Microbiology'),
(3, 'Urinalysis'),
(4, 'Serology'),
(5, 'Immunology'),
(6, 'Chemistry');

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `result_file` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` enum('pending','uploaded','reviewed') DEFAULT 'pending',
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_results`
--

INSERT INTO `test_results` (`id`, `appointment_id`, `uploaded_by`, `result_file`, `remarks`, `status`, `uploaded_at`) VALUES
(1, 1, 21, 'assets/uploads/results/1781701782_6a329c96e6403.jpg', 'karibu godfather umeonekana uko salama malaria huna . kwa maelekezo zaid wasiliana na doctor maria smwel godfather ili akupe muongozo zaid. asante kwa kuchagua huduma zetu tunakupenda sana karibu.', 'uploaded', '2026-06-17 13:09:42'),
(2, 2, 21, 'assets/uploads/results/1782308501_6a3bde9569d7f.jpg', 'you dont have malaria it seem that you are normal so thank you for choose us', 'uploaded', '2026-06-24 13:41:41'),
(3, 3, 21, 'assets/uploads/results/1782391939_6a3d2483968a7.jpg', 'ooh so sorry your results shows me you have HIV/AID, please prepare for dosage ,', 'uploaded', '2026-06-25 12:52:19'),
(4, 4, 21, 'assets/uploads/results/1782404894_6a3d571e3a149.jpg', 'you dont have any problem pure  colorless urine', 'uploaded', '2026-06-25 16:28:14'),
(5, 5, 21, 'assets/uploads/results/1782408614_6a3d65a6ee62d.jpg', 'you are safe', 'uploaded', '2026-06-25 17:30:14'),
(6, 7, 21, 'assets/uploads/results/1782411561_6a3d7129a2489.jpg', 'you are safe', 'uploaded', '2026-06-25 18:19:21'),
(7, 6, 21, 'assets/uploads/results/1782412224_6a3d73c06d9f6.jpg', 'you are safe', 'uploaded', '2026-06-25 18:30:24'),
(8, 10, 21, 'assets/uploads/results/1782476674_6a3e6f821e856.jpg', 'you are safe', 'uploaded', '2026-06-26 12:24:34'),
(9, 11, 21, 'assets/uploads/results/1782485221_6a3e90e5b051d.jpg', 'safe', 'uploaded', '2026-06-26 14:47:01'),
(10, 12, 21, 'assets/uploads/results/1782485237_6a3e90f54ec6b.jpg', 'safe', 'uploaded', '2026-06-26 14:47:17'),
(11, 14, 21, 'assets/uploads/results/1782485253_6a3e910524df4.jpg', 'safe', 'uploaded', '2026-06-26 14:47:33'),
(12, 15, 21, 'assets/uploads/results/1782485267_6a3e9113c6665.jpg', 'safe', 'uploaded', '2026-06-26 14:47:47'),
(13, 16, 21, 'assets/uploads/results/1782485401_6a3e9199b802e.jpg', 'safe', 'uploaded', '2026-06-26 14:50:01'),
(14, 17, 21, 'assets/uploads/results/1782489051_6a3e9fdba5b1a.jpg', 'safe', 'uploaded', '2026-06-26 15:50:51'),
(15, 19, 21, 'assets/uploads/results/1782489653_6a3ea235a2e69.jpg', 'safe', 'uploaded', '2026-06-26 16:00:53'),
(16, 21, 21, 'assets/uploads/results/1782492196_6a3eac24d73e7.jpg', 'safe', 'uploaded', '2026-06-26 16:43:16'),
(17, 22, 21, 'assets/uploads/results/1782631798_6a40cd768b509.jpg', 'you are safe', 'uploaded', '2026-06-28 07:29:58'),
(18, 24, 21, 'assets/uploads/results/1782631819_6a40cd8b14cc1.jpg', 'safe', 'uploaded', '2026-06-28 07:30:19'),
(19, 25, 21, 'assets/uploads/results/1782635066_6a40da3a985bc.jpg', 'safe', 'uploaded', '2026-06-28 08:24:26'),
(20, 26, 21, 'assets/uploads/results/1782635081_6a40da497fbf0.jpg', 'safe', 'uploaded', '2026-06-28 08:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','doctor','patient','labo') NOT NULL,
  `profile_image` varchar(255) NOT NULL DEFAULT 'assets/images/default.jpg',
  `status` enum('pending','active','inactive','blocked') DEFAULT 'pending',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone_number`, `password`, `role`, `profile_image`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(19, 'godfather samwel godfather', 'godfathersamwel1997@gmail.com', '0683296637', '$2y$10$0UApuVon7qwMk11qZ8Tbg.3qXmxPIRufsjbrn4t8gq722qRKz9hoi', 'patient', '1778227676_69fd99dc66acf.jpg', 'active', '2026-06-28 08:24:50', '2026-05-08 08:07:56', '2026-06-28 08:24:50'),
(20, 'maria samwel godfather', 'mariasamwel2000@gmail.com', '0692937952', '$2y$10$nBwwoj/ZQOekv9ZG82vHLeWfpWij2Y80VLbdmTgbqGF1FOVyYsE2S', 'doctor', '1778231812_69fdaa046ed95.jpg', 'active', '2026-06-18 18:59:08', '2026-05-08 09:16:52', '2026-06-18 18:59:08'),
(21, 'joan samwel godfather', 'joansamwel2005@gmail.com', '0698415860', '$2y$10$8zgYQvxrMYHIoMeRfLSms.wJF9vlfyjspUFWa6kYcOZZSmdtjY9bS', 'labo', '1778232402_69fdac5219d7e.jpg', 'active', '2026-06-28 08:23:43', '2026-05-08 09:26:42', '2026-06-28 08:23:43'),
(23, 'System Admin', 'admin@onlinelabo.com', '0749738920', '$2y$10$vSdymUdP/76HnVPu2zMYtuRJOrd9n0b8ReZxL1AQD64Os09bXRUs2', 'admin', 'assets/images/default.jpg', 'active', '2026-06-26 18:38:39', '2026-05-08 12:08:11', '2026-06-26 18:38:39'),
(24, 'emmanuel', 'jeffliquidator@gmail.com', '0748923926', '$2y$10$tKF73XUYE3uZpTSKiCUhJOI1TtZg1lE3fxkPxGf.9576vVbMMwhOO', 'patient', '1778656996_6a0426e4e0608.jpg', 'blocked', NULL, '2026-05-13 07:23:16', '2026-06-15 13:14:31'),
(25, 'Edwin Mwaluko Chuga', 'edwinchuga25@gmail.com', '0778957400', '$2y$10$6QdgOe7c3E9uZkPh5r7t8u9bH41GMrQ5bjxZK2WfIiTxAoZ/bbbmi', 'doctor', '1778678901_6a047c758e91c.jpg', 'inactive', NULL, '2026-05-13 13:28:21', '2026-06-15 13:35:06'),
(26, 'Geovin Machwa', 'geovinmachwa41@gmail.com', '0752398941', '$2y$10$A2dwWhmmteU9mu/fXaUb6uQwNQcOzoJgk1j6f6MqAgBDKwVdN/Bp6', 'doctor', '1781525269_6a2feb15566cc.jpg', 'active', '2026-06-15 12:13:50', '2026-06-15 12:07:49', '2026-06-15 12:13:50'),
(27, 'Edward chrispo mafuru', 'ediechrispo2009@gmail.com', '0653835580', '$2y$10$nwXFXiIRRAUjLRAmfor9cOKe6QeYnFez/fz8x3GzoUtFbmh1lwj5.', 'patient', '1782390967_6a3d20b70cd01.jpg', 'active', '2026-06-26 13:39:54', '2026-06-25 12:36:07', '2026-06-26 13:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_token` varchar(255) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `device_info` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `laboratory_id` (`laboratory_id`);

--
-- Indexes for table `appointment_history`
--
ALTER TABLE `appointment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `changed_by` (`changed_by`);

--
-- Indexes for table `appointment_tests`
--
ALTER TABLE `appointment_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `license_no` (`license_number`),
  ADD KEY `doctors_ibfk_1` (`user_id`);

--
-- Indexes for table `doctor_referrals`
--
ALTER TABLE `doctor_referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `laboratories`
--
ALTER TABLE `laboratories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lab_user` (`user_id`);

--
-- Indexes for table `lab_staff`
--
ALTER TABLE `lab_staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `lab_tests`
--
ALTER TABLE `lab_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_ibfk_1` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `result_details`
--
ALTER TABLE `result_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `result_id` (`result_id`);

--
-- Indexes for table `sample_collections`
--
ALTER TABLE `sample_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `collector_id` (`collector_id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_categories`
--
ALTER TABLE `test_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `appointment_history`
--
ALTER TABLE `appointment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `appointment_tests`
--
ALTER TABLE `appointment_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctor_referrals`
--
ALTER TABLE `doctor_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratories`
--
ALTER TABLE `laboratories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lab_staff`
--
ALTER TABLE `lab_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_tests`
--
ALTER TABLE `lab_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `result_details`
--
ALTER TABLE `result_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sample_collections`
--
ALTER TABLE `sample_collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_categories`
--
ALTER TABLE `test_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_lab` FOREIGN KEY (`laboratory_id`) REFERENCES `laboratories` (`id`);

--
-- Constraints for table `appointment_history`
--
ALTER TABLE `appointment_history`
  ADD CONSTRAINT `appointment_history_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `appointment_history_ibfk_2` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `appointment_tests`
--
ALTER TABLE `appointment_tests`
  ADD CONSTRAINT `appointment_tests_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `appointment_tests_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `lab_tests` (`id`);

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_referrals`
--
ALTER TABLE `doctor_referrals`
  ADD CONSTRAINT `doctor_referrals_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `doctor_referrals_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD CONSTRAINT `email_verifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `laboratories`
--
ALTER TABLE `laboratories`
  ADD CONSTRAINT `fk_lab_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lab_staff`
--
ALTER TABLE `lab_staff`
  ADD CONSTRAINT `lab_staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `lab_tests`
--
ALTER TABLE `lab_tests`
  ADD CONSTRAINT `lab_tests_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `test_categories` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `result_details`
--
ALTER TABLE `result_details`
  ADD CONSTRAINT `result_details_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `test_results` (`id`);

--
-- Constraints for table `sample_collections`
--
ALTER TABLE `sample_collections`
  ADD CONSTRAINT `sample_collections_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `sample_collections_ibfk_2` FOREIGN KEY (`collector_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `support_tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `test_results`
--
ALTER TABLE `test_results`
  ADD CONSTRAINT `test_results_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `test_results_ibfk_2` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
