-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 17, 2024 alle 12:43
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

--
-- Dump dei dati per la tabella `pm_tipo`
--

INSERT INTO `pm_tipo` (`Tipo`, `DebolezzaNormale`, `DebolezzaFuoco`, `DebolezzaAcqua`, `DebolezzaErba`, `DebolezzaElettro`, `DebolezzaGhiaccio`, `DebolezzaLotta`, `DebolezzaVeleno`, `DebolezzaTerra`, `DebolezzaVolante`, `DebolezzaPsico`, `DebolezzaColeottero`, `DebolezzaRoccia`, `DebolezzaSpettro`, `DebolezzaDrago`, `DebolezzaBuio`, `DebolezzaAccaio`, `DebolezzaFolletto`) VALUES
('accaio', 1.0, 0.5, 0.5, 1.0, 0.5, 2.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 2.0, 1.0, 1.0, 1.0, 0.5, 2.0),
('acqua', 1.0, 2.0, 0.5, 0.5, 1.0, 1.0, 1.0, 1.0, 2.0, 1.0, 1.0, 1.0, 2.0, 1.0, 0.5, 1.0, 1.0, 1.0),
('buio', 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 0.5, 1.0, 1.0, 1.0, 2.0, 1.0, 1.0, 2.0, 1.0, 0.5, 1.0, 0.5),
('coleottero', 1.0, 0.5, 1.0, 2.0, 1.0, 1.0, 0.5, 0.5, 1.0, 0.5, 2.0, 1.0, 1.0, 0.5, 1.0, 2.0, 0.5, 0.5),
('drago', 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 2.0, 1.0, 0.5, 0.0),
('elettro', 1.0, 1.0, 2.0, 0.5, 0.5, 1.0, 1.0, 1.0, 0.0, 2.0, 1.0, 1.0, 1.0, 1.0, 0.5, 1.0, 1.0, 1.0),
('erba', 1.0, 0.5, 2.0, 0.5, 1.0, 1.0, 1.0, 0.5, 2.0, 0.5, 1.0, 0.5, 2.0, 1.0, 0.5, 1.0, 0.5, 1.0),
('folletto', 1.0, 0.5, 1.0, 1.0, 1.0, 1.0, 2.0, 0.5, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 2.0, 2.0, 0.5, 1.0),
('fuoco', 1.0, 0.5, 0.5, 2.0, 1.0, 2.0, 1.0, 1.0, 1.0, 1.0, 1.0, 2.0, 0.5, 1.0, 0.5, 1.0, 2.0, 1.0),
('ghiaccio', 1.0, 0.5, 0.5, 2.0, 1.0, 0.5, 1.0, 1.0, 2.0, 2.0, 1.0, 1.0, 1.0, 1.0, 2.0, 1.0, 0.5, 1.0),
('lotta', 2.0, 1.0, 1.0, 1.0, 1.0, 2.0, 1.0, 0.5, 1.0, 0.5, 0.5, 0.5, 2.0, 0.0, 1.0, 2.0, 2.0, 0.5),
('normale', 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 0.5, 0.0, 1.0, 1.0, 0.5, 1.0),
('psico', 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 2.0, 2.0, 1.0, 1.0, 0.5, 1.0, 1.0, 1.0, 1.0, 0.0, 0.5, 1.0),
('roccia', 1.0, 2.0, 1.0, 1.0, 1.0, 2.0, 0.5, 1.0, 0.5, 2.0, 1.0, 2.0, 1.0, 1.0, 1.0, 1.0, 0.5, 1.0),
('spettro', 0.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 2.0, 1.0, 1.0, 2.0, 1.0, 0.5, 1.0, 1.0),
('terra', 1.0, 2.0, 1.0, 0.5, 2.0, 1.0, 1.0, 2.0, 1.0, 0.0, 1.0, 0.5, 2.0, 1.0, 1.0, 1.0, 2.0, 1.0),
('veleno', 1.0, 1.0, 1.0, 2.0, 1.0, 1.0, 1.0, 0.5, 0.5, 1.0, 1.0, 1.0, 0.5, 0.5, 1.0, 1.0, 0.0, 2.0),
('volante', 1.0, 1.0, 1.0, 2.0, 0.5, 1.0, 2.0, 1.0, 1.0, 1.0, 1.0, 2.0, 0.5, 1.0, 1.0, 1.0, 0.5, 1.0);

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
  `Vel` decimal(3,0) DEFAULT NULL,
  `tipo1` varchar(20) NOT NULL,
  `tipo2` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `pokemon`
--

INSERT INTO `pokemon` (`Pokedex`, `nome`, `PS`, `Atk`, `AtkSP`, `Dif`, `DifSP`, `Vel`, `tipo1`, `tipo2`) VALUES
(1, 'bulbasaur', 152, 111, 128, 111, 128, 106, 'erba ', 'veleno'),
(2, 'ivysaur', 167, 125, 145, 126, 145, 123, 'erba ', 'veleno'),
(3, 'venusaur', 187, 147, 167, 148, 167, 145, 'erba ', 'veleno'),
(4, 'charmander', 146, 114, 123, 104, 112, 128, 'fuoco', NULL),
(5, 'charmeleon', 165, 127, 145, 121, 128, 145, 'fuoco', NULL),
(6, 'charizard', 185, 149, 177, 143, 150, 167, 'fuoco', 'volante'),
(7, 'squirtle', 151, 110, 112, 128, 127, 104, 'acqua', NULL),
(8, 'wartortle', 166, 126, 128, 145, 145, 121, 'acqua', NULL),
(9, 'blastoise', 186, 148, 150, 167, 172, 143, 'acqua', NULL),
(10, 'caterpie', 152, 90, 79, 95, 79, 106, 'coleottero', NULL),
(11, 'metapod', 157, 79, 84, 117, 84, 90, 'coleottero', NULL),
(12, 'butterfree', 167, 106, 156, 112, 145, 114, 'coleottero', 'volante'),
(13, 'weedle', 147, 95, 79, 90, 79, 112, 'coleottero', 'veleno'),
(14, 'kakuna', 152, 84, 84, 112, 84, 95, 'coleottero', 'veleno'),
(15, 'beedrill', 172, 156, 106, 101, 145, 139, 'coleottero', 'veleno'),
(16, 'pidgey', 147, 106, 95, 101, 95, 118, 'normale', 'volante'),
(17, 'pidgeotto', 170, 123, 112, 117, 112, 135, 'normale', 'volante'),
(18, 'pidgeot', 190, 145, 134, 139, 134, 168, 'normale', 'volante'),
(19, 'rattata', 137, 118, 84, 95, 95, 136, 'normale', NULL),
(20, 'raticate', 162, 146, 112, 123, 134, 163, 'normale', NULL),
(21, 'spearow', 147, 123, 91, 90, 91, 134, 'normale', 'volante'),
(22, 'fearow', 172, 156, 124, 128, 124, 167, 'normale', 'volante'),
(23, 'ekans', 142, 123, 101, 105, 116, 117, 'veleno', NULL),
(24, 'arbok', 167, 161, 128, 133, 144, 145, 'veleno', NULL),
(25, 'pikachu', 142, 117, 112, 101, 112, 156, 'elettro', NULL),
(26, 'raichu', 167, 156, 156, 117, 145, 178, 'elettro', NULL),
(27, 'sandshrew', 157, 139, 79, 150, 90, 101, 'terra', NULL),
(28, 'sandlsash', 182, 167, 106, 178, 117, 128, 'terra', NULL),
(29, 'nidoran♀', 162, 108, 101, 114, 101, 102, 'veleno', NULL),
(30, 'nidorina', 177, 125, 117, 130, 117, 118, 'veleno', NULL),
(31, 'nidoqueen', 197, 158, 139, 152, 150, 140, 'veleno', 'terra'),
(32, 'nidoran♂', 153, 119, 101, 101, 101, 112, 'veleno', NULL),
(33, 'nidorino', 168, 136, 117, 119, 117, 128, 'veleno', NULL),
(34, 'nidoking', 188, 169, 150, 141, 139, 150, 'veleno', 'terra'),
(35, 'clefairy', 177, 106, 123, 110, 128, 95, 'folletto', NULL),
(36, 'clefable', 202, 134, 161, 137, 156, 123, 'folletto', NULL),
(37, 'vulpix', 145, 102, 112, 101, 128, 128, 'fuoco', NULL),
(38, 'ninetales', 180, 140, 146, 139, 167, 167, 'fuoco', NULL),
(39, 'jigglypuff', 222, 106, 106, 79, 84, 79, 'normale', 'folletto'),
(40, 'wigglytuff', 247, 134, 150, 106, 112, 106, 'normale', 'folletto'),
(41, 'zubat', 147, 106, 90, 95, 101, 117, 'veleno', 'volante'),
(42, 'golbat', 182, 145, 128, 134, 139, 156, 'veleno', 'volante'),
(43, 'oddish', 152, 112, 139, 117, 128, 90, 'erba ', 'veleno'),
(44, 'gloom', 167, 128, 150, 134, 139, 101, 'erba ', 'veleno'),
(45, 'vileplume', 182, 145, 178, 150, 156, 112, 'erba ', 'veleno'),
(46, 'paras', 142, 134, 106, 117, 117, 84, 'coleottero', 'erba'),
(47, 'parasect', 167, 161, 123, 145, 145, 90, 'coleottero', 'erba'),
(48, 'venonat', 167, 117, 101, 112, 117, 106, 'coleottero', 'veleno'),
(49, 'venomoth', 177, 128, 156, 123, 139, 166, 'coleottero', 'veleno'),
(50, 'diglett', 117, 117, 95, 84, 106, 161, 'terra', NULL),
(51, 'dugtrio', 142, 167, 112, 112, 134, 189, 'terra', NULL),
(52, 'meowth', 147, 106, 101, 95, 101, 156, 'normale', NULL),
(53, 'persian', 172, 134, 128, 123, 128, 183, 'normale', 'buio'),
(54, 'psyduck', 157, 114, 128, 110, 112, 117, 'acqua', NULL),
(55, 'golduck', 187, 147, 161, 143, 145, 150, 'acqua', NULL),
(56, 'mankey', 147, 145, 95, 95, 106, 134, 'lotta', NULL),
(57, 'primeape', 172, 172, 123, 123, 134, 161, 'lotta', NULL);

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
