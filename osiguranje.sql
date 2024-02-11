-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2024 at 06:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osiguranje`
--

-- --------------------------------------------------------

--
-- Table structure for table `dodatni_osiguranik`
--

CREATE TABLE `dodatni_osiguranik` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) DEFAULT NULL,
  `prezime` varchar(255) DEFAULT NULL,
  `datum_rodjenja` date DEFAULT NULL,
  `broj_pasosa` varchar(50) DEFAULT NULL,
  `id_polise` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dodatni_osiguranik`
--

INSERT INTO `dodatni_osiguranik` (`id`, `ime`, `prezime`, `datum_rodjenja`, `broj_pasosa`, `id_polise`) VALUES
(1, 'Nemanja', 'Djosic', '2013-06-15', '777333321', 2),
(2, 'Uros', 'Djosic', '2023-09-06', '631423734', 2);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) DEFAULT NULL,
  `prezime` varchar(255) DEFAULT NULL,
  `datum_rodjenja` date DEFAULT NULL,
  `broj_pasosa` varchar(50) DEFAULT NULL,
  `telefon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `lozinka` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `datum_rodjenja`, `broj_pasosa`, `telefon`, `email`, `lozinka`) VALUES
(1, 'Dejan', 'Djosic', '1999-09-27', '111444555', '0607150870', 'ddjosic@gmail.com', '814397871c4e045fd0c65583681dc64145293769'),
(2, 'Admin', 'Admin', '1999-09-27', '000000000', '+381607150870', 'admin@gmail.com', '6667e6dcd617bcd85bbcf1461546e6239804b02c');

-- --------------------------------------------------------

--
-- Table structure for table `polisa`
--

CREATE TABLE `polisa` (
  `id` int(11) NOT NULL,
  `datum_kreiranja` date NOT NULL,
  `nosilac_ime` varchar(60) NOT NULL,
  `nosilac_prezime` varchar(60) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `broj_pasosa` varchar(60) NOT NULL,
  `telefon` varchar(60) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `datum_putovanja_od` date NOT NULL,
  `datum_putovanja_do` date NOT NULL,
  `broj_dana` int(11) NOT NULL,
  `vrsta_polise` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polisa`
--

INSERT INTO `polisa` (`id`, `datum_kreiranja`, `nosilac_ime`, `nosilac_prezime`, `datum_rodjenja`, `broj_pasosa`, `telefon`, `email`, `datum_putovanja_od`, `datum_putovanja_do`, `broj_dana`, `vrsta_polise`) VALUES
(1, '2024-02-11', 'Dejan', 'Djosic', '1999-09-27', '999333444', '', 'ddjosic@gmail.com', '2024-02-12', '2024-02-20', 8, 'individualno'),
(2, '2024-02-11', 'Dejan', 'Djosic', '1999-09-27', '111444555', '0607150870', 'ddjosic@gmail.com', '2024-02-13', '2024-02-21', 8, 'grupno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dodatni_osiguranik`
--
ALTER TABLE `dodatni_osiguranik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_polise` (`id_polise`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polisa`
--
ALTER TABLE `polisa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dodatni_osiguranik`
--
ALTER TABLE `dodatni_osiguranik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `polisa`
--
ALTER TABLE `polisa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dodatni_osiguranik`
--
ALTER TABLE `dodatni_osiguranik`
  ADD CONSTRAINT `dodatni_osiguranik_ibfk_1` FOREIGN KEY (`id_polise`) REFERENCES `polisa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
