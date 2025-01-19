-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 19, 2025 alle 16:07
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

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
  `MT` varchar(5) NOT NULL,
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
  `DebolezzaAcciaio` decimal(2,1) DEFAULT NULL,
  `DebolezzaFolletto` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `pm_tipo`
--

INSERT INTO `pm_tipo` (`Tipo`, `DebolezzaNormale`, `DebolezzaFuoco`, `DebolezzaAcqua`, `DebolezzaErba`, `DebolezzaElettro`, `DebolezzaGhiaccio`, `DebolezzaLotta`, `DebolezzaVeleno`, `DebolezzaTerra`, `DebolezzaVolante`, `DebolezzaPsico`, `DebolezzaColeottero`, `DebolezzaRoccia`, `DebolezzaSpettro`, `DebolezzaDrago`, `DebolezzaBuio`, `DebolezzaAcciaio`, `DebolezzaFolletto`) VALUES
('acciaio', 1.0, 0.5, 0.5, 1.0, 0.5, 2.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 2.0, 1.0, 1.0, 1.0, 0.5, 2.0),
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
(57, 'primeape', 172, 172, 123, 123, 134, 161, 'lotta', NULL),
(58, 'growlithe', 162, 134, 134, 106, 112, 123, 'fuoco', NULL),
(59, 'arcanine', 197, 178, 167, 145, 145, 161, 'fuoco', NULL),
(60, 'poliwag', 147, 112, 101, 101, 101, 156, 'acqua', NULL),
(61, 'poliwhirl', 172, 128, 112, 128, 112, 156, 'acqua', NULL),
(62, 'poliwrath', 197, 161, 134, 161, 156, 134, 'acqua', 'lotta'),
(63, 'abra', 132, 79, 172, 73, 117, 156, 'psico', NULL),
(64, 'kadabra', 147, 95, 189, 90, 134, 172, 'psico', NULL),
(65, 'alakazam', 165, 112, 205, 106, 161, 189, 'psico', NULL),
(66, 'machop', 177, 145, 95, 112, 95, 95, 'lotta', NULL),
(67, 'machoke', 187, 167, 112, 134, 123, 106, 'lotta', NULL),
(68, 'machamp', 197, 200, 128, 145, 150, 117, 'lotta', NULL),
(69, 'bellsprout', 157, 139, 134, 95, 90, 101, 'erba', 'veleno'),
(70, 'weepinbell', 172, 156, 150, 112, 106, 117, 'erba', 'veleno'),
(71, 'victreebel', 187, 172, 167, 128, 134, 134, 'erba', 'veleno'),
(72, 'tentacool', 147, 101, 112, 95, 167, 134, 'acqua', 'veleno'),
(73, 'tentacruel', 187, 134, 145, 128, 189, 167, 'acqua', 'veleno'),
(74, 'geodude', 147, 145, 90, 167, 90, 79, 'roccia', 'terra'),
(75, 'graveler', 162, 161, 106, 183, 106, 95, 'roccia', 'terra'),
(76, 'golem', 187, 189, 117, 200, 128, 106, 'roccia', 'terra'),
(77, 'ponyta', 157, 150, 128, 117, 128, 156, 'fuoco', NULL),
(78, 'rapidash', 172, 167, 145, 134, 145, 172, 'fuoco', NULL),
(79, 'slowpoke', 197, 128, 101, 128, 101, 73, 'acqua', 'psico'),
(80, 'slowbro', 202, 139, 167, 178, 145, 90, 'acqua', 'psico'),
(81, 'magnemite', 132, 95, 161, 134, 117, 106, 'elettro', 'acciaio'),
(82, 'magneton', 157, 123, 189, 161, 134, 134, 'elettro', 'acciaio'),
(83, 'farfetch-d', 159, 156, 121, 117, 125, 123, 'normale', 'volante'),
(84, 'doduo', 142, 150, 95, 106, 95, 139, 'normale', 'volante'),
(85, 'dodrio', 167, 178, 123, 134, 123, 178, 'normale', 'volante'),
(86, 'seel', 172, 106, 106, 117, 134, 106, 'acqua', NULL),
(87, 'dwegong', 197, 134, 134, 145, 161, 134, 'acqua', 'ghiaccio'),
(88, 'grimer', 187, 145, 101, 112, 112, 84, 'veleno', NULL),
(89, 'muk', 212, 172, 128, 139, 167, 112, 'veleno', NULL),
(90, 'shellder', 137, 128, 106, 167, 84, 101, 'acqua', NULL),
(91, 'cloyster', 157, 161, 150, 255, 106, 134, 'acqua', 'ghiaccio'),
(92, 'gastly', 137, 95, 167, 90, 95, 145, 'spettro', 'veleno'),
(93, 'haunter', 152, 112, 183, 106, 117, 161, 'spettro', 'piplup'),
(94, 'gengar', 167, 128, 200, 123, 139, 178, 'spettro', 'veleno'),
(95, 'onix', 142, 106, 90, 233, 106, 134, 'roccia', 'terra'),
(96, 'drowzee', 167, 110, 104, 106, 156, 103, 'psico', NULL),
(97, 'hypno', 192, 137, 137, 134, 183, 130, 'psico', NULL),
(98, 'krabby', 137, 172, 84, 156, 84, 112, 'acqua', NULL),
(99, 'kingler', 162, 200, 112, 183, 112, 139, 'acqua', NULL),
(100, 'voltorb', 147, 90, 117, 112, 117, 167, 'elettro', NULL),
(101, 'electrode', 167, 112, 145, 134, 145, 222, 'elettro', NULL),
(102, 'exeggcute', 167, 101, 123, 145, 206, 101, 'erba', 'psico'),
(103, 'exeggutor', 202, 161, 194, 150, 139, 117, 'erba', 'psico'),
(104, 'cubone', 157, 112, 101, 161, 112, 95, 'terra', NULL),
(105, 'marowak', 167, 145, 112, 178, 145, 106, 'terra', NULL),
(106, 'hitmonlee', 157, 189, 95, 115, 178, 152, 'lotta', NULL),
(107, 'hitmonchan', 157, 172, 95, 144, 178, 140, 'lotta', NULL),
(108, 'lickitung', 197, 117, 123, 139, 139, 90, 'normale', NULL),
(109, 'koffing', 147, 128, 123, 161, 106, 95, 'veleno', NULL),
(110, 'weezing', 172, 156, 150, 189, 134, 123, 'veleno', NULL),
(111, 'rhyhorn', 187, 150, 90, 161, 90, 84, 'terra', 'roccia'),
(112, 'rhydon', 212, 200, 106, 189, 106, 101, 'terra', 'roccia'),
(113, 'chansey', 357, 62, 95, 62, 172, 112, 'normale', NULL),
(114, 'tangela', 172, 117, 167, 183, 101, 123, 'erba', NULL),
(115, 'kangaskhan', 212, 161, 101, 145, 145, 156, 'normale', NULL),
(116, 'horsea', 137, 101, 134, 134, 84, 123, 'acqua', NULL),
(117, 'seadra', 162, 128, 161, 161, 106, 150, 'acqua', NULL),
(118, 'goldeen', 152, 130, 95, 123, 112, 126, 'acqua', NULL),
(119, 'seaking', 187, 158, 128, 128, 145, 132, 'acqua', NULL),
(120, 'staryu', 137, 106, 134, 117, 117, 150, 'acqua', NULL),
(121, 'starmie', 167, 139, 167, 150, 150, 183, 'acqua', 'psico'),
(122, 'mr. mime', 147, 106, 167, 128, 189, 156, 'psico', 'folletto'),
(123, 'scyther', 177, 178, 117, 145, 145, 172, 'coleottero', 'volante'),
(124, 'jynx', 172, 112, 183, 95, 161, 161, 'ghiaccio', 'psico'),
(125, 'electabuzz', 172, 148, 161, 119, 150, 172, 'elettro', NULL),
(126, 'magmar', 172, 161, 167, 119, 150, 159, 'fuoco', NULL),
(127, 'pinsir', 172, 194, 117, 167, 134, 150, 'coleottero', NULL),
(128, 'tauros', 182, 167, 101, 161, 134, 178, 'normale', NULL),
(129, 'magikarp', 127, 68, 73, 117, 79, 145, 'acqua', NULL),
(130, 'gyarados', 202, 194, 123, 144, 167, 146, 'acqua', 'volante'),
(131, 'lapras', 237, 150, 150, 145, 161, 123, 'acqua', 'ghiaccio'),
(132, 'ditto', 155, 110, 110, 110, 110, 110, 'normale', NULL),
(133, 'eevee', 162, 117, 106, 112, 128, 117, 'normale', NULL),
(134, 'vaporeon', 237, 128, 178, 123, 161, 128, 'acqua', NULL),
(135, 'jolteon', 172, 128, 178, 123, 161, 200, 'elettro', NULL),
(136, 'flareon', 172, 200, 161, 123, 178, 128, 'fuoco', NULL),
(137, 'porygon', 172, 123, 150, 134, 139, 101, 'normale', NULL),
(138, 'omanyte', 142, 101, 156, 167, 117, 95, 'roccia', 'acqua'),
(139, 'omastar', 177, 123, 183, 194, 134, 117, 'roccia', 'acqua'),
(140, 'kabuto', 137, 145, 117, 156, 106, 117, 'roccia', 'acqua'),
(141, 'kabutops', 167, 183, 128, 172, 134, 145, 'roccia', 'acqua'),
(142, 'aerodactyl', 187, 172, 123, 128, 139, 200, 'roccia', 'volante'),
(143, 'snorlax', 267, 178, 128, 128, 178, 90, 'normale', NULL),
(144, 'articuno', 197, 150, 161, 167, 194, 150, 'ghiaccio', 'volante'),
(145, 'zapdos', 197, 156, 194, 150, 156, 167, 'elettro', 'volante'),
(146, 'moltres', 197, 167, 194, 156, 150, 156, 'fuoco', 'volante'),
(147, 'dratini', 148, 127, 112, 106, 112, 112, 'drago', NULL),
(148, 'dragonair', 168, 149, 134, 128, 134, 134, 'drago', NULL),
(149, 'dragonite', 198, 204, 167, 161, 167, 145, 'drago', 'volante'),
(150, 'mewtwo', 213, 178, 226, 156, 156, 200, 'psico', NULL),
(151, 'mew', 207, 167, 167, 167, 167, 167, 'psico', NULL),
(152, 'chikorita', 152, 111, 111, 128, 128, 106, 'erba', NULL),
(153, 'bayleef', 167, 125, 126, 145, 145, 123, 'erba', NULL),
(154, 'meganium', 187, 147, 148, 167, 167, 145, 'erba', NULL),
(155, 'cyndaquil', 146, 114, 123, 104, 112, 128, 'fuoco', NULL),
(156, 'quilava', 165, 127, 145, 121, 128, 145, 'fuoco', NULL),
(157, 'typhlosion', 185, 149, 177, 143, 150, 167, 'fuoco', NULL),
(158, 'totodile', 157, 128, 105, 127, 110, 104, 'acqua', NULL),
(159, 'croconaw', 172, 145, 122, 145, 126, 121, 'acqua', NULL),
(160, 'feraligatr', 192, 172, 144, 167, 148, 143, 'acqua', NULL),
(161, 'sentret', 142, 107, 95, 94, 106, 79, 'normale', NULL),
(162, 'furret', 192, 140, 106, 127, 117, 156, 'normale', NULL),
(163, 'hoothoot', 167, 90, 96, 90, 118, 112, 'normale', 'volante'),
(164, 'noctowl', 207, 112, 151, 112, 162, 134, 'normale', 'volante'),
(165, 'ledyba', 147, 79, 101, 90, 145, 117, 'coleottero', 'volante'),
(166, 'ledian', 162, 95, 117, 112, 178, 150, 'coleottero', 'volante'),
(167, 'spinarak', 147, 123, 101, 101, 101, 90, 'coleottero', 'veleno'),
(168, 'ariados', 177, 156, 123, 134, 134, 101, 'coleottero', 'veleno'),
(169, 'crobat', 192, 156, 134, 145, 145, 200, 'veleno', 'volante'),
(170, 'chinchou', 182, 99, 118, 99, 118, 130, 'acqua', 'elettro'),
(171, 'lanturn', 232, 121, 140, 121, 140, 130, 'acqua', 'elettro'),
(172, 'pichu', 127, 101, 95, 73, 95, 123, 'elettro', NULL),
(173, 'cleffa', 157, 84, 106, 88, 117, 73, 'folletto', NULL),
(174, 'igglybuff', 197, 90, 101, 73, 79, 73, 'normale', 'folletto'),
(175, 'togepi', 142, 79, 101, 128, 128, 79, 'folletto', NULL),
(176, 'togetic', 162, 101, 145, 150, 172, 101, 'folletto', 'volante'),
(177, 'natu', 147, 112, 134, 106, 106, 134, 'psico', 'volante'),
(178, 'xatu', 172, 139, 161, 134, 134, 161, 'psico', 'volante'),
(179, 'mareep', 162, 101, 128, 101, 106, 95, 'elettro', NULL),
(180, 'flaaffy', 177, 117, 145, 117, 123, 106, 'elettro', NULL),
(181, 'ampharos', 197, 139, 183, 150, 156, 117, 'elettro', NULL),
(182, 'bellossom', 182, 145, 156, 161, 167, 112, 'erba', NULL),
(183, 'marill', 177, 79, 79, 112, 112, 101, 'acqua', 'folletto'),
(184, 'azumarill', 207, 112, 123, 145, 145, 112, 'acqua', 'folletto'),
(185, 'sudowoodo', 177, 167, 90, 183, 128, 90, 'roccia', NULL),
(186, 'politoed', 197, 139, 156, 139, 167, 134, 'acqua', NULL),
(187, 'hoppip', 142, 95, 95, 101, 117, 112, 'erba', 'volante'),
(188, 'skiploom', 162, 106, 106, 112, 128, 145, 'erba', 'volante'),
(189, 'jumpluff', 182, 117, 117, 134, 161, 178, 'erba', 'volante'),
(190, 'aipom', 162, 134, 101, 117, 117, 150, 'normale', NULL),
(191, 'sunkern', 137, 90, 90, 90, 90, 90, 'erba', NULL),
(192, 'sunflora', 182, 139, 172, 117, 150, 90, 'erba', NULL),
(193, 'yanma', 172, 128, 139, 106, 106, 161, 'coleottero', 'volante'),
(194, 'wooper', 162, 106, 84, 106, 84, 73, 'acqua', 'terra'),
(195, 'quagsire', 202, 150, 128, 150, 128, 95, 'acqua', 'terra'),
(196, 'espeon', 172, 128, 200, 123, 161, 178, 'psico', NULL),
(197, 'umbreon', 202, 128, 123, 178, 200, 128, 'buio', NULL),
(198, 'murkrow', 167, 150, 150, 103, 103, 157, 'buio', 'volante'),
(199, 'slowking', 202, 139, 167, 145, 178, 90, 'acqua', 'psico'),
(200, 'misdreavus', 167, 123, 150, 123, 150, 150, 'spettro', NULL),
(201, 'unown', 155, 126, 136, 110, 110, 110, 'psico', NULL),
(202, 'wobbuffet', 297, 93, 93, 121, 121, 93, 'psico', NULL),
(203, 'girafarig', 177, 145, 156, 128, 128, 150, 'normale', 'psico'),
(204, 'pineco', 157, 128, 95, 156, 95, 73, 'coleottero', NULL),
(205, 'forretress', 182, 156, 123, 211, 123, 101, 'coleottero', 'acciaio'),
(206, 'dunsparce', 207, 134, 128, 134, 128, 106, 'normale', NULL),
(207, 'giglar', 172, 139, 95, 172, 128, 150, 'terra', 'volante'),
(208, 'steelix', 182, 150, 117, 277, 128, 90, 'acciaio', 'terra'),
(209, 'snubbull', 167, 145, 101, 112, 101, 90, 'folletto', NULL),
(210, 'granbull', 197, 189, 123, 139, 123, 106, 'folletto', NULL),
(211, 'qwilfish', 172, 161, 117, 150, 117, 150, 'acqua', 'veleno'),
(212, 'scizor', 177, 200, 117, 167, 145, 128, 'coleottero', 'acciaio'),
(213, 'shuckle', 127, 68, 68, 310, 310, 62, 'coleottero', 'roccia'),
(214, 'heracross', 187, 194, 101, 139, 161, 150, 'coleottero', 'lotta'),
(215, 'sneasel', 162, 161, 95, 117, 139, 183, 'buio', 'ghiaccio'),
(216, 'teddiursa', 167, 145, 112, 112, 112, 101, 'normale', NULL),
(217, 'ursaring', 197, 200, 139, 139, 139, 117, 'normale', NULL),
(218, 'slugma', 147, 101, 134, 101, 101, 79, 'fuoco', NULL),
(219, 'magcargo', 167, 112, 156, 189, 145, 90, 'fuoco', 'roccia'),
(220, 'swinub', 157, 112, 90, 101, 90, 112, 'ghiaccio', 'terra'),
(221, 'piloswine', 207, 167, 123, 145, 123, 112, 'ghiaccio', 'terra'),
(222, 'corsola', 172, 117, 128, 161, 161, 95, 'acqua', 'roccia'),
(223, 'remoraid', 142, 128, 128, 95, 95, 128, 'acqua', NULL),
(224, 'octillery', 182, 172, 172, 139, 139, 106, 'acqua', NULL),
(225, 'delibird', 152, 117, 128, 106, 106, 139, 'ghiaccio', 'volante'),
(226, 'mantine', 192, 101, 145, 134, 211, 134, 'acqua', 'volante'),
(227, 'skarmory', 172, 145, 101, 211, 134, 134, 'acciaio', 'volante'),
(228, 'houndur', 152, 123, 145, 90, 112, 128, 'buio', 'fuoco'),
(229, 'houndoom', 182, 156, 178, 112, 145, 161, 'buio', 'fuoco'),
(230, 'kingdra', 182, 161, 161, 161, 161, 150, 'acqua', NULL),
(231, 'phanpy', 197, 123, 101, 123, 101, 101, 'terra', NULL),
(232, 'donphan', 197, 189, 123, 189, 123, 112, 'terra', NULL),
(233, 'porygon2', 192, 145, 172, 156, 161, 123, 'normale', NULL),
(234, 'stantler', 180, 161, 150, 125, 128, 150, 'normale', NULL),
(235, 'smeargle', 162, 79, 79, 95, 106, 139, 'normale', NULL),
(236, 'tyrogue', 142, 95, 95, 95, 95, 95, 'lotta', NULL),
(237, 'hitmontop', 157, 161, 95, 161, 178, 134, 'lotta', NULL),
(238, 'smoochum', 152, 90, 150, 73, 128, 128, 'ghiaccio', 'psico'),
(239, 'elekid', 152, 126, 128, 97, 117, 161, 'elettro', NULL),
(240, 'magby', 152, 139, 134, 97, 117, 148, 'fuoco', NULL),
(241, 'miltank', 202, 145, 101, 172, 134, 167, 'normale', NULL),
(242, 'blissey', 362, 68, 139, 68, 205, 117, 'normale', NULL),
(243, 'raikou', 197, 150, 183, 139, 167, 183, 'elettro', NULL),
(244, 'entei', 222, 183, 156, 150, 139, 167, 'fuoco', NULL),
(245, 'suicune', 207, 139, 156, 183, 183, 150, 'acqua', NULL),
(246, 'larvitar', 157, 127, 106, 112, 112, 102, 'roccia', 'terra'),
(247, 'pupitar', 177, 149, 128, 134, 134, 113, 'roccia', 'terra'),
(248, 'tyranitar', 207, 204, 161, 178, 167, 124, 'roccia', 'buio'),
(249, 'lugia', 213, 156, 156, 200, 226, 178, 'psico', 'volante'),
(250, 'ho-oh', 213, 200, 178, 156, 226, 156, 'fuoco', 'volante'),
(251, 'celebi', 207, 167, 167, 167, 167, 167, 'psico', 'erba'),
(252, 'treecko', 147, 106, 128, 95, 117, 134, 'erba', NULL),
(253, 'grovyle', 157, 128, 150, 106, 128, 161, 'erba', NULL),
(254, 'sceptile', 177, 150, 172, 128, 150, 189, 'erba', NULL),
(255, 'torchic', 152, 123, 134, 101, 112, 106, 'fuoco', NULL),
(256, 'combusken', 167, 150, 150, 123, 123, 117, 'fuoco', 'lotta'),
(257, 'blaziken', 187, 189, 178, 134, 134, 145, 'fuoco', 'lotta'),
(258, 'mudkip', 157, 134, 112, 112, 112, 101, 'acqua', NULL),
(259, 'marshtomp', 177, 150, 123, 134, 134, 112, 'acqua', 'terra'),
(260, 'swampert', 207, 178, 150, 156, 156, 123, 'acqua', 'terra'),
(261, 'poochyena', 142, 117, 90, 95, 90, 95, 'buio', NULL),
(262, 'mightyena', 177, 156, 123, 134, 123, 134, 'buio', NULL),
(263, 'zigzagoon', 145, 90, 90, 102, 102, 123, 'normale', NULL),
(264, 'linoone', 185, 134, 112, 124, 124, 167, 'normale', NULL),
(265, 'wurmple', 152, 106, 79, 95, 90, 79, 'coleottero', NULL),
(266, 'silcoon', 157, 95, 84, 117, 84, 73, 'coleottero', NULL),
(267, 'beautifly', 167, 134, 167, 112, 112, 128, 'coleottero', 'volante'),
(268, 'cascoon', 157, 95, 84, 117, 84, 73, 'coleottero', NULL),
(269, 'dustox', 167, 112, 112, 134, 156, 128, 'coleottero', 'veleno'),
(270, 'lotad', 147, 90, 101, 90, 112, 90, 'acqua', 'erba'),
(271, 'lombre', 167, 112, 123, 112, 134, 112, 'acqua', 'erba'),
(272, 'ludicolo', 187, 134, 156, 134, 167, 134, 'acqua', 'erba'),
(273, 'seedot', 147, 101, 90, 112, 90, 90, 'erba', NULL),
(274, 'nuzleaf', 177, 134, 123, 101, 101, 123, 'erba', 'buio'),
(275, 'shiftry', 197, 167, 156, 123, 123, 145, 'erba', 'buio'),
(276, 'taillow', 147, 117, 90, 90, 90, 150, 'normale', 'volante'),
(277, 'swellow', 167, 150, 139, 123, 112, 194, 'normale', 'volante'),
(278, 'wingull', 147, 90, 117, 90, 90, 150, 'acqua', 'volante'),
(279, 'pelipper', 167, 112, 161, 167, 134, 128, 'acqua', 'volante'),
(280, 'ralts', 135, 84, 106, 84, 95, 101, 'psico', 'folletto'),
(281, 'kirlia', 145, 95, 128, 95, 117, 112, 'psico', 'folletto'),
(282, 'gardevoir', 175, 128, 194, 128, 183, 145, 'psico', 'folletto'),
(283, 'surskit', 147, 90, 112, 92, 114, 128, 'coleottero', 'acqua'),
(284, 'masquerain', 177, 123, 167, 125, 147, 145, 'coleottero', 'volante'),
(285, 'shroomish', 167, 101, 101, 123, 123, 95, 'erba', NULL),
(286, 'breloom', 167, 200, 123, 145, 123, 134, 'erba', 'lotta'),
(287, 'slakoth', 167, 123, 95, 123, 95, 90, 'normale', NULL),
(288, 'vigoroth', 187, 145, 117, 145, 117, 156, 'normale', NULL),
(289, 'slaking', 257, 233, 161, 167, 128, 167, 'normale', NULL),
(290, 'nincada', 138, 206, 90, 156, 90, 101, 'coleottero', 'terra'),
(291, 'ninjask', 168, 156, 112, 106, 112, 233, 'coleottero', 'volante'),
(292, 'shedinja', 1, 156, 90, 106, 90, 101, 'coleottero', 'spettro'),
(293, 'whismur', 171, 113, 113, 82, 82, 88, 'normale', NULL),
(294, 'loudred', 191, 135, 135, 104, 104, 110, 'normale', NULL),
(295, 'exploud', 211, 157, 157, 126, 137, 132, 'normale', NULL),
(296, 'makuhita', 179, 123, 79, 90, 90, 84, 'lotta', NULL),
(297, 'hariyama', 251, 189, 101, 123, 123, 112, 'lotta', NULL),
(298, 'azurill', 157, 79, 79, 101, 101, 79, 'normale', 'folletto'),
(299, 'nosepass', 137, 106, 106, 205, 156, 90, 'roccia', NULL),
(300, 'skitty', 157, 106, 95, 106, 95, 112, 'normale', NULL),
(301, 'delcatty', 177, 128, 117, 128, 117, 156, 'normale', NULL),
(302, 'sableye', 157, 139, 128, 139, 128, 112, 'buio', 'spettro'),
(303, 'mawile', 157, 150, 117, 150, 117, 112, 'acciaio', 'folletto'),
(304, 'aron', 157, 134, 101, 167, 101, 90, 'acciaio', 'roccia'),
(305, 'lairon', 167, 156, 112, 221, 112, 101, 'acciaio', 'roccia'),
(306, 'aggron', 177, 178, 123, 255, 123, 112, 'acciaio', 'roccia'),
(307, 'meditite', 137, 101, 101, 117, 117, 123, 'lotta', 'psico'),
(308, 'medicham', 167, 123, 123, 139, 139, 145, 'lotta', 'psico'),
(309, 'electrike', 147, 106, 128, 101, 101, 128, 'elettro', NULL),
(310, 'manectric', 177, 139, 172, 123, 123, 172, 'elettro', NULL),
(311, 'plusle', 167, 112, 150, 101, 139, 161, 'elettro', NULL),
(312, 'minun', 167, 101, 139, 112, 150, 161, 'elettro', NULL),
(313, 'volbeat', 172, 137, 108, 139, 150, 150, 'coleottero', NULL),
(314, 'illumise', 172, 108, 137, 139, 150, 150, 'coleottero', NULL),
(315, 'roselia', 157, 123, 167, 106, 145, 128, 'erba', 'veleno'),
(316, 'gulpin', 177, 104, 104, 115, 115, 101, 'veleno', NULL),
(317, 'swalot', 207, 137, 137, 148, 148, 117, 'veleno', NULL),
(318, 'carvanah', 152, 156, 128, 79, 79, 128, 'acqua', 'buio'),
(319, 'sharpedo', 177, 189, 161, 101, 101, 161, 'acqua', 'buio'),
(320, 'wailmer', 237, 134, 134, 95, 95, 123, 'acqua', NULL),
(321, 'wailord', 277, 156, 156, 106, 106, 123, 'acqua', NULL),
(322, 'numel', 167, 123, 128, 101, 106, 95, 'fuoco', 'terra'),
(323, 'camerupt', 177, 167, 172, 134, 139, 101, 'fuoco', 'terra'),
(324, 'torkoal', 177, 150, 150, 211, 134, 79, 'fuoco', NULL);

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
