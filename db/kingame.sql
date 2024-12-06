-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 06, 2024 alle 09:49
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kingame`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_img`
--

CREATE TABLE `pm_img` (
  `PM_img` decimal(3,0) NOT NULL,
  `Pokedex` decimal(3,0) DEFAULT NULL,
  `Tipo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_mossa`
--

CREATE TABLE `pm_mossa` (
  `MT` decimal(4,0) NOT NULL,
  `Nome` varchar(20) DEFAULT NULL,
  `Tipo` varchar(15) DEFAULT NULL,
  `Categoria` varchar(10) DEFAULT NULL,
  `Potenza` decimal(3,0) DEFAULT NULL,
  `PP` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_tipo`
--

CREATE TABLE `pm_tipo` (
  `Nome` varchar(15) NOT NULL,
  `DebolezzaNormale` decimal(2,1) DEFAULT NULL,
  `DebolezzaFuoco` decimal(2,1) DEFAULT NULL,
  `DebolezzaAcqua` decimal(2,1) DEFAULT NULL,
  `DebolezzaErba` decimal(2,1) DEFAULT NULL,
  `DebolezzaElettro` decimal(2,1) DEFAULT NULL,
  `DebolezzaGhiaccio` decimal(2,1) DEFAULT NULL,
  `DebolezzaLotta` decimal(2,1) DEFAULT NULL,
  `DebolezzaVeleno` decimal(2,1) DEFAULT NULL,
  `DebolezzaTerra` decimal(2,1) DEFAULT NULL,
  `DebolezzaVolante` decimal(2,1) DEFAULT NULL,
  `DebolezzaPsico` decimal(2,1) DEFAULT NULL,
  `DebolezzaColeottero` decimal(2,1) DEFAULT NULL,
  `DebolezzaRoccia` decimal(2,1) DEFAULT NULL,
  `DebolezzaSpettro` decimal(2,1) DEFAULT NULL,
  `DebolezzaDrago` decimal(2,1) DEFAULT NULL,
  `DebolezzaBuio` decimal(2,1) DEFAULT NULL,
  `DebolezzaAccaio` decimal(2,1) DEFAULT NULL,
  `DebolezzaFolletto` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pokemon`
--

CREATE TABLE `pokemon` (
  `Pokedex` decimal(3,0) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `PS` decimal(3,0) DEFAULT NULL,
  `Atk` decimal(3,0) DEFAULT NULL,
  `AtkSP` decimal(3,0) DEFAULT NULL,
  `Dif` decimal(3,0) DEFAULT NULL,
  `DifSP` decimal(3,0) DEFAULT NULL,
  `Vel` decimal(3,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `pm_img`
--
ALTER TABLE `pm_img`
  ADD PRIMARY KEY (`PM_img`);

--
-- Indici per le tabelle `pm_mossa`
--
ALTER TABLE `pm_mossa`
  ADD PRIMARY KEY (`MT`);

--
-- Indici per le tabelle `pm_tipo`
--
ALTER TABLE `pm_tipo`
  ADD PRIMARY KEY (`Nome`);

--
-- Indici per le tabelle `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`Pokedex`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
