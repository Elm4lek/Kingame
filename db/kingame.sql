-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 06, 2024 alle 14:04
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
-- Struttura della tabella `pm_borsa`
--

CREATE TABLE `pm_borsa` (
  `Trainer_ID` decimal(3,0) DEFAULT NULL,
  `Oggetto_ID` decimal(2,0) DEFAULT NULL,
  `Numero` decimal(3,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_img`
--

CREATE TABLE `pm_img` (
  `PM_img` decimal(4,0) NOT NULL,
  `Pokedex` decimal(3,0) DEFAULT NULL,
  `Tipo` tinyint(1) DEFAULT NULL,
  `Sprite_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_img_npc`
--

CREATE TABLE `pm_img_npc` (
  `NPC_IMG` decimal(2,0) NOT NULL,
  `NPC_ID` decimal(2,0) DEFAULT NULL,
  `Tipo` varchar(20) DEFAULT NULL,
  `NPC_url` varchar(100) DEFAULT NULL
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
-- Struttura della tabella `pm_npc`
--

CREATE TABLE `pm_npc` (
  `NPC_ID` decimal(2,0) NOT NULL,
  `Nome` varchar(20) DEFAULT NULL,
  `Descrizione` varchar(50) DEFAULT NULL,
  `Regione` varchar(10) DEFAULT NULL,
  `Dialogo1` varchar(100) DEFAULT NULL,
  `Dialogo2` varchar(100) DEFAULT NULL,
  `Dialogo3` varchar(100) DEFAULT NULL,
  `Dialogo4` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_oggetti`
--

CREATE TABLE `pm_oggetti` (
  `Oggetto_ID` decimal(2,0) NOT NULL,
  `Nome` varchar(20) DEFAULT NULL,
  `Tipo` varchar(15) DEFAULT NULL,
  `Prezzo` decimal(3,0) DEFAULT NULL,
  `Descrizione` varchar(50) DEFAULT NULL,
  `Sprite_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_squadra`
--

CREATE TABLE `pm_squadra` (
  `PM_ID` decimal(3,0) NOT NULL,
  `Trainer_ID` decimal(3,0) DEFAULT NULL,
  `Mossa1` decimal(4,0) DEFAULT NULL,
  `Mossa2` decimal(4,0) DEFAULT NULL,
  `Mossa3` decimal(4,0) DEFAULT NULL,
  `Mossa4` decimal(4,0) DEFAULT NULL,
  `Stato` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_tecniche`
--

CREATE TABLE `pm_tecniche` (
  `Pokedex` decimal(3,0) DEFAULT NULL,
  `MT` decimal(3,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_tipo`
--

CREATE TABLE `pm_tipo` (
  `Tipo` varchar(15) NOT NULL,
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
-- Struttura della tabella `pm_trainer`
--

CREATE TABLE `pm_trainer` (
  `Trainer_ID` decimal(3,0) NOT NULL,
  `Tipo` tinyint(1) DEFAULT NULL,
  `ID` decimal(3,0) DEFAULT NULL,
  `NPC_ID` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_user`
--

CREATE TABLE `pm_user` (
  `ID` decimal(3,0) NOT NULL,
  `Nome` varchar(25) DEFAULT NULL,
  `Livello` decimal(2,0) DEFAULT NULL,
  `Sprite_url` varchar(100) DEFAULT NULL,
  `Soldi` decimal(5,0) DEFAULT NULL
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
-- Indici per le tabelle `pm_img_npc`
--
ALTER TABLE `pm_img_npc`
  ADD PRIMARY KEY (`NPC_IMG`);

--
-- Indici per le tabelle `pm_mossa`
--
ALTER TABLE `pm_mossa`
  ADD PRIMARY KEY (`MT`);

--
-- Indici per le tabelle `pm_npc`
--
ALTER TABLE `pm_npc`
  ADD PRIMARY KEY (`NPC_ID`);

--
-- Indici per le tabelle `pm_oggetti`
--
ALTER TABLE `pm_oggetti`
  ADD PRIMARY KEY (`Oggetto_ID`);

--
-- Indici per le tabelle `pm_squadra`
--
ALTER TABLE `pm_squadra`
  ADD PRIMARY KEY (`PM_ID`);

--
-- Indici per le tabelle `pm_tipo`
--
ALTER TABLE `pm_tipo`
  ADD PRIMARY KEY (`Tipo`);

--
-- Indici per le tabelle `pm_trainer`
--
ALTER TABLE `pm_trainer`
  ADD PRIMARY KEY (`Trainer_ID`);

--
-- Indici per le tabelle `pm_user`
--
ALTER TABLE `pm_user`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`Pokedex`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
