-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 08:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'admin', '$2y$10$QSDI4BWQfbtOt7DhcDGXJek/NWJZHewqZIGyi2b2XYoMbeFSTtP2W', 'Admin', 'Admin', '', '2024-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `Abbr` varchar(10) NOT NULL,
  `Logo` varchar(150) NOT NULL,
  `party_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `firstname`, `lastname`, `photo`, `Abbr`, `Logo`, `party_name`) VALUES
(1, 1, 'Cyril', 'Ramaphosa', 'Prime_Minister_Sunak_met_with_President_Ramaphosa_of_South_Africa_in_Number_10_-_2022_(cropped).jpg', 'ANC', 'African_National_Congress.png', 'African National Congress'),
(2, 1, 'John', 'Steenhuisen', 'John_Steenhuisen_2024.jpg', 'DA', 'Democratic_Alliance_(SA)_logo.png', 'Democratic Alliance'),
(3, 1, 'Jacob', 'Zuma', 'Jacob_Zuma,_29_November_2017_(cropped).jpg', 'MK', 'Logo_of_the_uMkhonto_we_Sizwe.png', 'uMkhonto weSizwe'),
(4, 1, 'Julius', 'Malema', 'julius-malema-1500-800.jpg', 'EFF', 'Logo_of_the_Economic_Freedom_Fighters.svg.png', 'Economic Freedom Fighters'),
(5, 1, 'Velenkosini', 'Hlabisa', 'Hon-velenkosini-hlabisa_(crop).jpg', 'IFP', 'Inkatha_Freedom_Party_logo.svg.png', 'Inkatha Freedom Party'),
(6, 1, 'Gayton', 'McKenzie', 'Gayton_McKenzie_Minister_of_Sport,_Arts_and_Culture_Mailable_DSC_9733.jpg', 'PA', 'Logo_of_Patriotic_Alliance_(South_Africa).png', 'Patriotic Alliance'),
(7, 2, 'Cyril', 'Ramaphosa', 'Prime_Minister_Sunak_met_with_President_Ramaphosa_of_South_Africa_in_Number_10_-_2022_(cropped).jpg', 'ANC', 'African_National_Congress.png', 'African National Congress'),
(8, 2, 'John', 'Steenhuisen', 'John_Steenhuisen_2024.jpg', 'DA', 'Democratic_Alliance_(SA)_logo.png', 'Democratic Alliance'),
(9, 2, 'Jacob', 'Zuma', 'Jacob_Zuma,_29_November_2017_(cropped).jpg', 'MK', 'Logo_of_the_uMkhonto_we_Sizwe.png', 'uMkhonto weSizwe'),
(10, 2, 'Julius', 'Malema', 'julius-malema-1500-800.jpg', 'EFF', 'Logo_of_the_Economic_Freedom_Fighters.svg.png', 'Economic Freedom Fighters'),
(11, 2, 'Velenkosini', 'Hlabisa', 'Hon-velenkosini-hlabisa_(crop).jpg', 'IFP', 'Inkatha_Freedom_Party_logo.svg.png', 'Inkatha Freedom Party'),
(12, 2, 'Gayton', 'McKenzie', 'Gayton_McKenzie_Minister_of_Sport,_Arts_and_Culture_Mailable_DSC_9733.jpg', 'PA', 'Logo_of_Patriotic_Alliance_(South_Africa).png', 'Patriotic Alliance');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `max_vote` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `description`, `max_vote`, `priority`) VALUES
(1, 'Provincial', 2, 1),
(2, 'National', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `Idnumber` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(15) NOT NULL,
  `candidate_id` int(15) NOT NULL,
  `position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
