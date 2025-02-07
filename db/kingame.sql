-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 07, 2025 alle 09:47
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
-- Struttura della tabella `giochi`
--

CREATE TABLE `giochi` (
  `ID` int(1) NOT NULL,
  `Gioco` varchar(20) NOT NULL,
  `Numero_Gioatori` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_borsa`
--

CREATE TABLE `pm_borsa` (
  `Trainer_ID` decimal(3,0) NOT NULL,
  `Oggetto_ID` decimal(2,0) NOT NULL,
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
  `Tipo` varchar(15) DEFAULT NULL,
  `Categoria` varchar(10) DEFAULT NULL,
  `Potenza` decimal(3,0) DEFAULT NULL,
  `PP` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `pm_mossa`
--

INSERT INTO `pm_mossa` (`MT`, `Tipo`, `Categoria`, `Potenza`, `PP`) VALUES
('MT001', 'normale', 'fisico', 40, 35),
('MT002', 'lotta', 'fisico', 50, 25),
('MT003', 'normale', 'fisico', 30, 10),
('MT004', 'normale', 'fisico', 18, 15),
('MT005', 'normale', 'fisico', 80, 20),
('MT006', 'normale', 'fisico', 40, 20),
('MT007', 'fuoco', 'fisico', 75, 15),
('MT008', 'ghiaccio', 'fisico', 75, 15),
('MT009', 'elettro', 'fisico', 75, 15),
('MT010', 'normale', 'fisico', 40, 35),
('MT011', 'normale', 'fisico', 55, 30),
('MT012', 'normale', 'fisico', 999, 5),
('MT013', 'normale', 'speciale', 80, 10),
('MT014', 'normale', 'stato', 0, 20),
('MT015', 'normale', 'fisico', 50, 30),
('MT016', 'volante', 'speciale', 40, 35),
('MT017', 'volante', 'fisico', 60, 35),
('MT018', 'normale', 'stato', 0, 20),
('MT019', 'volante', 'fisico', 90, 15),
('MT020', 'normale', 'fisico', 15, 20),
('MT021', 'normale', 'fisico', 80, 20),
('MT022', 'erba', 'fisico', 45, 25),
('MT023', 'normale', 'fisico', 65, 20),
('MT024', 'lotta', 'fisico', 60, 30),
('MT025', 'normale', 'fisico', 120, 5),
('MT026', 'lotta', 'fisico', 100, 10),
('MT027', 'lotta', 'fisico', 60, 15),
('MT028', 'terra', 'stato', 0, 15),
('MT029', 'normale', 'fisico', 70, 15),
('MT030', 'normale', 'fisico', 65, 25),
('MT031', 'normale', 'fisico', 15, 20),
('MT032', 'normale', 'fisico', 999, 5),
('MT033', 'normale', 'fisico', 40, 35),
('MT034', 'normale', 'fisico', 85, 15),
('MT035', 'normale', 'fisico', 15, 20),
('MT036', 'normale', 'fisico', 90, 20),
('MT037', 'normale', 'fisico', 120, 10),
('MT038', 'normale', 'fisico', 120, 15),
('MT039', 'normale', 'stato', 0, 30),
('MT040', 'veleno', 'fisico', 15, 35),
('MT041', 'coleottero', 'fisico', 25, 20),
('MT042', 'coleottero', 'fisico', 25, 20),
('MT043', 'normale', 'stato', 0, 30),
('MT044', 'buio', 'fisico', 60, 25),
('MT045', 'normale', 'stato', 0, 40),
('MT046', 'normale', 'stato', 0, 20),
('MT047', 'normale', 'stato', 0, 15),
('MT048', 'normale', 'stato', 0, 20),
('MT049', 'normale', 'speciale', 20, 20),
('MT050', 'normale', 'stato', 0, 20),
('MT051', 'veleno', 'speciale', 40, 30),
('MT052', 'fuoco', 'speciale', 40, 25),
('MT053', 'fuoco', 'speciale', 90, 15),
('MT054', 'ghiaccio', 'stato', 0, 30),
('MT055', 'acqua', 'speciale', 40, 25),
('MT056', 'acqua', 'speciale', 110, 5),
('MT057', 'acqua', 'speciale', 90, 15),
('MT058', 'ghiaccio', 'speciale', 90, 10),
('MT059', 'ghiaccio', 'speciale', 110, 5),
('MT060', 'psico', 'speciale', 65, 20),
('MT061', 'acqua', 'speciale', 65, 20),
('MT062', 'ghiaccio', 'speciale', 65, 20),
('MT063', 'normale', 'speciale', 150, 5),
('MT064', 'volante', 'fisico', 35, 35),
('MT065', 'volante', 'fisico', 80, 20),
('MT066', 'lotta', 'fisico', 80, 20),
('MT067', 'lotta', 'fisico', 80, 20),
('MT068', 'lotta', 'fisico', 0, 20),
('MT069', 'lotta', 'fisico', 50, 20),
('MT070', 'normale', 'fisico', 80, 15),
('MT071', 'erba', 'speciale', 20, 25),
('MT072', 'erba', 'speciale', 40, 15),
('MT073', 'erba', 'stato', 0, 10),
('MT074', 'normale', 'stato', 0, 20),
('MT075', 'erba', 'fisico', 55, 25),
('MT076', 'erba', 'speciale', 120, 10),
('MT077', 'veleno', 'stato', 0, 35),
('MT078', 'erba', 'stato', 0, 30),
('MT079', 'erba', 'stato', 0, 15),
('MT080', 'erba', 'speciale', 120, 10),
('MT081', 'coleottero', 'stato', 0, 40),
('MT082', 'drago', 'speciale', 40, 10),
('MT083', 'fuoco', 'speciale', 35, 15),
('MT084', 'elettro', 'speciale', 40, 30),
('MT085', 'elettro', 'speciale', 90, 15),
('MT086', 'elettro', 'stato', 0, 20),
('MT087', 'elettro', 'speciale', 110, 10),
('MT088', 'roccia', 'fisico', 50, 15),
('MT089', 'terra', 'fisico', 100, 10),
('MT090', 'terra', 'fisico', 999, 5),
('MT091', 'terra', 'fisico', 80, 10),
('MT092', 'veleno', 'stato', 0, 10),
('MT093', 'psico', 'speciale', 50, 25),
('MT094', 'psico', 'speciale', 90, 10),
('MT095', 'psico', 'stato', 0, 20),
('MT096', 'psico', 'stato', 0, 40),
('MT097', 'psico', 'stato', 0, 30),
('MT098', 'normale', 'fisico', 40, 30),
('MT099', 'normale', 'fisico', 20, 20),
('MT100', 'psico', 'stato', 0, 20),
('MT101', 'spettro', 'speciale', 50, 15),
('MT102', 'normale', 'stato', 0, 10),
('MT103', 'normale', 'stato', 0, 40),
('MT104', 'normale', 'stato', 0, 15),
('MT105', 'normale', 'stato', 0, 10),
('MT106', 'normale', 'stato', 0, 30),
('MT107', 'normale', 'stato', 0, 10),
('MT108', 'normale', 'stato', 0, 20),
('MT109', 'spettro', 'stato', 0, 10),
('MT110', 'acqua', 'stato', 0, 40),
('MT111', 'normale', 'stato', 0, 40),
('MT112', 'psico', 'stato', 0, 20),
('MT113', 'psico', 'stato', 0, 30),
('MT114', 'ghiaccio', 'stato', 0, 30),
('MT115', 'psico', 'stato', 0, 20),
('MT116', 'normale', 'stato', 0, 30),
('MT118', 'normale', 'stato', 0, 10),
('MT119', 'volante', 'stato', 0, 20),
('MT120', 'normale', 'fisico', 200, 5),
('MT121', 'normale', 'fisico', 100, 10),
('MT122', 'spettro', 'fisico', 30, 30),
('MT123', 'veleno', 'speciale', 30, 20),
('MT124', 'veleno', 'speciale', 65, 20),
('MT125', 'terra', 'fisico', 65, 20),
('MT126', 'fuoco', 'speciale', 110, 5),
('MT127', 'acqua', 'fisico', 80, 15),
('MT128', 'acqua', 'fisico', 35, 15),
('MT129', 'normale', 'speciale', 60, 20),
('MT130', 'normale', 'fisico', 130, 10),
('MT131', 'normale', 'fisico', 20, 15),
('MT132', 'normale', 'fisico', 10, 35),
('MT133', 'psico', 'stato', 0, 20),
('MT134', 'psico', 'stato', 0, 15),
('MT135', 'normale', 'stato', 0, 10),
('MT136', 'lotta', 'fisico', 130, 10),
('MT137', 'normale', 'stato', 0, 30),
('MT138', 'psico', 'speciale', 100, 15),
('MT139', 'veleno', 'stato', 0, 40),
('MT140', 'normale', 'fisico', 15, 20),
('MT141', 'coleottero', 'fisico', 80, 10),
('MT142', 'normale', 'stato', 0, 10),
('MT143', 'volante', 'fisico', 140, 5),
('MT144', 'normale', 'stato', 0, 10),
('MT145', 'acqua', 'speciale', 40, 30),
('MT146', 'normale', 'fisico', 70, 10),
('MT147', 'erba', 'stato', 0, 15),
('MT148', 'normale', 'stato', 0, 20),
('MT149', 'psico', 'speciale', 55, 15),
('MT150', 'normale', 'stato', 0, 40),
('MT151', 'veleno', 'stato', 0, 20),
('MT152', 'acqua', 'fisico', 100, 10),
('MT153', 'normale', 'fisico', 250, 5),
('MT154', 'normale', 'fisico', 90, 15),
('MT155', 'terra', 'fisico', 50, 10),
('MT156', 'psico', 'stato', 0, 10),
('MT157', 'roccia', 'fisico', 75, 10),
('MT158', 'normale', 'fisico', 80, 15),
('MT159', 'normale', 'stato', 0, 30),
('MT160', 'normale', 'stato', 0, 30),
('MT161', 'normale', 'speciale', 80, 10),
('MT162', 'normale', 'fisico', 0, 10),
('MT163', 'normale', 'fisico', 70, 20),
('MT164', 'normale', 'stato', 0, 10),
('MT166', 'normale', 'stato', 0, 1),
('MT167', 'lotta', 'fisico', 60, 10),
('MT168', 'buio', 'fisico', 60, 25),
('MT169', 'coleottero', 'stato', 0, 10),
('MT170', 'normale', 'stato', 0, 5),
('MT171', 'spettro', 'stato', 0, 15),
('MT172', 'fuoco', 'fisico', 60, 25),
('MT173', 'normale', 'speciale', 50, 15),
('MT174', 'spettro', 'stato', 0, 10),
('MT175', 'normale', 'fisico', 0, 15);

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
  `Dialogo4` varchar(100) DEFAULT NULL,
  `Trainer_ID` decimal(3,0) NOT NULL
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
  `Mossa1` varchar(5) DEFAULT NULL,
  `Mossa2` varchar(5) DEFAULT NULL,
  `Mossa3` varchar(5) DEFAULT NULL,
  `Mossa4` varchar(5) DEFAULT NULL,
  `Stato` tinyint(1) DEFAULT NULL,
  `Pokedex` decimal(3,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_tecniche`
--

CREATE TABLE `pm_tecniche` (
  `Pokedex` decimal(3,0) NOT NULL,
  `MT` varchar(5) NOT NULL
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
('null', 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0),
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
  `Tipo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `pm_user`
--

CREATE TABLE `pm_user` (
  `ID` varchar(20) NOT NULL,
  `Nome` varchar(25) DEFAULT NULL,
  `Livello` decimal(2,0) DEFAULT NULL,
  `Sprite_url` varchar(100) DEFAULT NULL,
  `Soldi` decimal(5,0) DEFAULT NULL,
  `Trainer_ID` decimal(3,0) NOT NULL
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
  `tipo2` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `pokemon`
--

INSERT INTO `pokemon` (`Pokedex`, `nome`, `PS`, `Atk`, `AtkSP`, `Dif`, `DifSP`, `Vel`, `tipo1`, `tipo2`) VALUES
(1, 'bulbasaur', 152, 111, 128, 111, 128, 106, 'erba ', 'veleno'),
(2, 'ivysaur', 167, 125, 145, 126, 145, 123, 'erba ', 'veleno'),
(3, 'venusaur', 187, 147, 167, 148, 167, 145, 'erba ', 'veleno'),
(4, 'charmander', 146, 114, 123, 104, 112, 128, 'fuoco', 'null'),
(5, 'charmeleon', 165, 127, 145, 121, 128, 145, 'fuoco', 'null'),
(6, 'charizard', 185, 149, 177, 143, 150, 167, 'fuoco', 'volante'),
(7, 'squirtle', 151, 110, 112, 128, 127, 104, 'acqua', 'null'),
(8, 'wartortle', 166, 126, 128, 145, 145, 121, 'acqua', 'null'),
(9, 'blastoise', 186, 148, 150, 167, 172, 143, 'acqua', 'null'),
(10, 'caterpie', 152, 90, 79, 95, 79, 106, 'coleottero', 'null'),
(11, 'metapod', 157, 79, 84, 117, 84, 90, 'coleottero', 'null'),
(12, 'butterfree', 167, 106, 156, 112, 145, 114, 'coleottero', 'volante'),
(13, 'weedle', 147, 95, 79, 90, 79, 112, 'coleottero', 'veleno'),
(14, 'kakuna', 152, 84, 84, 112, 84, 95, 'coleottero', 'veleno'),
(15, 'beedrill', 172, 156, 106, 101, 145, 139, 'coleottero', 'veleno'),
(16, 'pidgey', 147, 106, 95, 101, 95, 118, 'normale', 'volante'),
(17, 'pidgeotto', 170, 123, 112, 117, 112, 135, 'normale', 'volante'),
(18, 'pidgeot', 190, 145, 134, 139, 134, 168, 'normale', 'volante'),
(19, 'rattata', 137, 118, 84, 95, 95, 136, 'normale', 'null'),
(20, 'raticate', 162, 146, 112, 123, 134, 163, 'normale', 'null'),
(21, 'spearow', 147, 123, 91, 90, 91, 134, 'normale', 'volante'),
(22, 'fearow', 172, 156, 124, 128, 124, 167, 'normale', 'volante'),
(23, 'ekans', 142, 123, 101, 105, 116, 117, 'veleno', 'null'),
(24, 'arbok', 167, 161, 128, 133, 144, 145, 'veleno', 'null'),
(25, 'pikachu', 142, 117, 112, 101, 112, 156, 'elettro', 'null'),
(26, 'raichu', 167, 156, 156, 117, 145, 178, 'elettro', 'null'),
(27, 'sandshrew', 157, 139, 79, 150, 90, 101, 'terra', 'null'),
(28, 'sandlsash', 182, 167, 106, 178, 117, 128, 'terra', 'null'),
(29, 'nidoran♀', 162, 108, 101, 114, 101, 102, 'veleno', 'null'),
(30, 'nidorina', 177, 125, 117, 130, 117, 118, 'veleno', 'null'),
(31, 'nidoqueen', 197, 158, 139, 152, 150, 140, 'veleno', 'terra'),
(32, 'nidoran♂', 153, 119, 101, 101, 101, 112, 'veleno', 'null'),
(33, 'nidorino', 168, 136, 117, 119, 117, 128, 'veleno', 'null'),
(34, 'nidoking', 188, 169, 150, 141, 139, 150, 'veleno', 'terra'),
(35, 'clefairy', 177, 106, 123, 110, 128, 95, 'folletto', 'null'),
(36, 'clefable', 202, 134, 161, 137, 156, 123, 'folletto', 'null'),
(37, 'vulpix', 145, 102, 112, 101, 128, 128, 'fuoco', 'null'),
(38, 'ninetales', 180, 140, 146, 139, 167, 167, 'fuoco', 'null'),
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
(50, 'diglett', 117, 117, 95, 84, 106, 161, 'terra', 'null'),
(51, 'dugtrio', 142, 167, 112, 112, 134, 189, 'terra', 'null'),
(52, 'meowth', 147, 106, 101, 95, 101, 156, 'normale', 'null'),
(53, 'persian', 172, 134, 128, 123, 128, 183, 'normale', 'buio'),
(54, 'psyduck', 157, 114, 128, 110, 112, 117, 'acqua', 'null'),
(55, 'golduck', 187, 147, 161, 143, 145, 150, 'acqua', 'null'),
(56, 'mankey', 147, 145, 95, 95, 106, 134, 'lotta', 'null'),
(57, 'primeape', 172, 172, 123, 123, 134, 161, 'lotta', 'null'),
(58, 'growlithe', 162, 134, 134, 106, 112, 123, 'fuoco', 'null'),
(59, 'arcanine', 197, 178, 167, 145, 145, 161, 'fuoco', 'null'),
(60, 'poliwag', 147, 112, 101, 101, 101, 156, 'acqua', 'null'),
(61, 'poliwhirl', 172, 128, 112, 128, 112, 156, 'acqua', 'null'),
(62, 'poliwrath', 197, 161, 134, 161, 156, 134, 'acqua', 'lotta'),
(63, 'abra', 132, 79, 172, 73, 117, 156, 'psico', 'null'),
(64, 'kadabra', 147, 95, 189, 90, 134, 172, 'psico', 'null'),
(65, 'alakazam', 165, 112, 205, 106, 161, 189, 'psico', 'null'),
(66, 'machop', 177, 145, 95, 112, 95, 95, 'lotta', 'null'),
(67, 'machoke', 187, 167, 112, 134, 123, 106, 'lotta', 'null'),
(68, 'machamp', 197, 200, 128, 145, 150, 117, 'lotta', 'null'),
(69, 'bellsprout', 157, 139, 134, 95, 90, 101, 'erba', 'veleno'),
(70, 'weepinbell', 172, 156, 150, 112, 106, 117, 'erba', 'veleno'),
(71, 'victreebel', 187, 172, 167, 128, 134, 134, 'erba', 'veleno'),
(72, 'tentacool', 147, 101, 112, 95, 167, 134, 'acqua', 'veleno'),
(73, 'tentacruel', 187, 134, 145, 128, 189, 167, 'acqua', 'veleno'),
(74, 'geodude', 147, 145, 90, 167, 90, 79, 'roccia', 'terra'),
(75, 'graveler', 162, 161, 106, 183, 106, 95, 'roccia', 'terra'),
(76, 'golem', 187, 189, 117, 200, 128, 106, 'roccia', 'terra'),
(77, 'ponyta', 157, 150, 128, 117, 128, 156, 'fuoco', 'null'),
(78, 'rapidash', 172, 167, 145, 134, 145, 172, 'fuoco', 'null'),
(79, 'slowpoke', 197, 128, 101, 128, 101, 73, 'acqua', 'psico'),
(80, 'slowbro', 202, 139, 167, 178, 145, 90, 'acqua', 'psico'),
(81, 'magnemite', 132, 95, 161, 134, 117, 106, 'elettro', 'acciaio'),
(82, 'magneton', 157, 123, 189, 161, 134, 134, 'elettro', 'acciaio'),
(83, 'farfetch-d', 159, 156, 121, 117, 125, 123, 'normale', 'volante'),
(84, 'doduo', 142, 150, 95, 106, 95, 139, 'normale', 'volante'),
(85, 'dodrio', 167, 178, 123, 134, 123, 178, 'normale', 'volante'),
(86, 'seel', 172, 106, 106, 117, 134, 106, 'acqua', 'null'),
(87, 'dwegong', 197, 134, 134, 145, 161, 134, 'acqua', 'ghiaccio'),
(88, 'grimer', 187, 145, 101, 112, 112, 84, 'veleno', 'null'),
(89, 'muk', 212, 172, 128, 139, 167, 112, 'veleno', 'null'),
(90, 'shellder', 137, 128, 106, 167, 84, 101, 'acqua', 'null'),
(91, 'cloyster', 157, 161, 150, 255, 106, 134, 'acqua', 'ghiaccio'),
(92, 'gastly', 137, 95, 167, 90, 95, 145, 'spettro', 'veleno'),
(93, 'haunter', 152, 112, 183, 106, 117, 161, 'spettro', 'veleno'),
(94, 'gengar', 167, 128, 200, 123, 139, 178, 'spettro', 'veleno'),
(95, 'onix', 142, 106, 90, 233, 106, 134, 'roccia', 'terra'),
(96, 'drowzee', 167, 110, 104, 106, 156, 103, 'psico', 'null'),
(97, 'hypno', 192, 137, 137, 134, 183, 130, 'psico', 'null'),
(98, 'krabby', 137, 172, 84, 156, 84, 112, 'acqua', 'null'),
(99, 'kingler', 162, 200, 112, 183, 112, 139, 'acqua', 'null'),
(100, 'voltorb', 147, 90, 117, 112, 117, 167, 'elettro', 'null'),
(101, 'electrode', 167, 112, 145, 134, 145, 222, 'elettro', 'null'),
(102, 'exeggcute', 167, 101, 123, 145, 206, 101, 'erba', 'psico'),
(103, 'exeggutor', 202, 161, 194, 150, 139, 117, 'erba', 'psico'),
(104, 'cubone', 157, 112, 101, 161, 112, 95, 'terra', 'null'),
(105, 'marowak', 167, 145, 112, 178, 145, 106, 'terra', 'null'),
(106, 'hitmonlee', 157, 189, 95, 115, 178, 152, 'lotta', 'null'),
(107, 'hitmonchan', 157, 172, 95, 144, 178, 140, 'lotta', 'null'),
(108, 'lickitung', 197, 117, 123, 139, 139, 90, 'normale', 'null'),
(109, 'koffing', 147, 128, 123, 161, 106, 95, 'veleno', 'null'),
(110, 'weezing', 172, 156, 150, 189, 134, 123, 'veleno', 'null'),
(111, 'rhyhorn', 187, 150, 90, 161, 90, 84, 'terra', 'roccia'),
(112, 'rhydon', 212, 200, 106, 189, 106, 101, 'terra', 'roccia'),
(113, 'chansey', 357, 62, 95, 62, 172, 112, 'normale', 'null'),
(114, 'tangela', 172, 117, 167, 183, 101, 123, 'erba', 'null'),
(115, 'kangaskhan', 212, 161, 101, 145, 145, 156, 'normale', 'null'),
(116, 'horsea', 137, 101, 134, 134, 84, 123, 'acqua', 'null'),
(117, 'seadra', 162, 128, 161, 161, 106, 150, 'acqua', 'null'),
(118, 'goldeen', 152, 130, 95, 123, 112, 126, 'acqua', 'null'),
(119, 'seaking', 187, 158, 128, 128, 145, 132, 'acqua', 'null'),
(120, 'staryu', 137, 106, 134, 117, 117, 150, 'acqua', 'null'),
(121, 'starmie', 167, 139, 167, 150, 150, 183, 'acqua', 'psico'),
(122, 'mr. mime', 147, 106, 167, 128, 189, 156, 'psico', 'folletto'),
(123, 'scyther', 177, 178, 117, 145, 145, 172, 'coleottero', 'volante'),
(124, 'jynx', 172, 112, 183, 95, 161, 161, 'ghiaccio', 'psico'),
(125, 'electabuzz', 172, 148, 161, 119, 150, 172, 'elettro', 'null'),
(126, 'magmar', 172, 161, 167, 119, 150, 159, 'fuoco', 'null'),
(127, 'pinsir', 172, 194, 117, 167, 134, 150, 'coleottero', 'null'),
(128, 'tauros', 182, 167, 101, 161, 134, 178, 'normale', 'null'),
(129, 'magikarp', 127, 68, 73, 117, 79, 145, 'acqua', 'null'),
(130, 'gyarados', 202, 194, 123, 144, 167, 146, 'acqua', 'volante'),
(131, 'lapras', 237, 150, 150, 145, 161, 123, 'acqua', 'ghiaccio'),
(132, 'ditto', 155, 110, 110, 110, 110, 110, 'normale', 'null'),
(133, 'eevee', 162, 117, 106, 112, 128, 117, 'normale', 'null'),
(134, 'vaporeon', 237, 128, 178, 123, 161, 128, 'acqua', 'null'),
(135, 'jolteon', 172, 128, 178, 123, 161, 200, 'elettro', 'null'),
(136, 'flareon', 172, 200, 161, 123, 178, 128, 'fuoco', 'null'),
(137, 'porygon', 172, 123, 150, 134, 139, 101, 'normale', 'null'),
(138, 'omanyte', 142, 101, 156, 167, 117, 95, 'roccia', 'acqua'),
(139, 'omastar', 177, 123, 183, 194, 134, 117, 'roccia', 'acqua'),
(140, 'kabuto', 137, 145, 117, 156, 106, 117, 'roccia', 'acqua'),
(141, 'kabutops', 167, 183, 128, 172, 134, 145, 'roccia', 'acqua'),
(142, 'aerodactyl', 187, 172, 123, 128, 139, 200, 'roccia', 'volante'),
(143, 'snorlax', 267, 178, 128, 128, 178, 90, 'normale', 'null'),
(144, 'articuno', 197, 150, 161, 167, 194, 150, 'ghiaccio', 'volante'),
(145, 'zapdos', 197, 156, 194, 150, 156, 167, 'elettro', 'volante'),
(146, 'moltres', 197, 167, 194, 156, 150, 156, 'fuoco', 'volante'),
(147, 'dratini', 148, 127, 112, 106, 112, 112, 'drago', 'null'),
(148, 'dragonair', 168, 149, 134, 128, 134, 134, 'drago', 'null'),
(149, 'dragonite', 198, 204, 167, 161, 167, 145, 'drago', 'volante'),
(150, 'mewtwo', 213, 178, 226, 156, 156, 200, 'psico', 'null'),
(151, 'mew', 207, 167, 167, 167, 167, 167, 'psico', 'null'),
(152, 'chikorita', 152, 111, 111, 128, 128, 106, 'erba', 'null'),
(153, 'bayleef', 167, 125, 126, 145, 145, 123, 'erba', 'null'),
(154, 'meganium', 187, 147, 148, 167, 167, 145, 'erba', 'null'),
(155, 'cyndaquil', 146, 114, 123, 104, 112, 128, 'fuoco', 'null'),
(156, 'quilava', 165, 127, 145, 121, 128, 145, 'fuoco', 'null'),
(157, 'typhlosion', 185, 149, 177, 143, 150, 167, 'fuoco', 'null'),
(158, 'totodile', 157, 128, 105, 127, 110, 104, 'acqua', 'null'),
(159, 'croconaw', 172, 145, 122, 145, 126, 121, 'acqua', 'null'),
(160, 'feraligatr', 192, 172, 144, 167, 148, 143, 'acqua', 'null'),
(161, 'sentret', 142, 107, 95, 94, 106, 79, 'normale', 'null'),
(162, 'furret', 192, 140, 106, 127, 117, 156, 'normale', 'null'),
(163, 'hoothoot', 167, 90, 96, 90, 118, 112, 'normale', 'volante'),
(164, 'noctowl', 207, 112, 151, 112, 162, 134, 'normale', 'volante'),
(165, 'ledyba', 147, 79, 101, 90, 145, 117, 'coleottero', 'volante'),
(166, 'ledian', 162, 95, 117, 112, 178, 150, 'coleottero', 'volante'),
(167, 'spinarak', 147, 123, 101, 101, 101, 90, 'coleottero', 'veleno'),
(168, 'ariados', 177, 156, 123, 134, 134, 101, 'coleottero', 'veleno'),
(169, 'crobat', 192, 156, 134, 145, 145, 200, 'veleno', 'volante'),
(170, 'chinchou', 182, 99, 118, 99, 118, 130, 'acqua', 'elettro'),
(171, 'lanturn', 232, 121, 140, 121, 140, 130, 'acqua', 'elettro'),
(172, 'pichu', 127, 101, 95, 73, 95, 123, 'elettro', 'null'),
(173, 'cleffa', 157, 84, 106, 88, 117, 73, 'folletto', 'null'),
(174, 'igglybuff', 197, 90, 101, 73, 79, 73, 'normale', 'folletto'),
(175, 'togepi', 142, 79, 101, 128, 128, 79, 'folletto', 'null'),
(176, 'togetic', 162, 101, 145, 150, 172, 101, 'folletto', 'volante'),
(177, 'natu', 147, 112, 134, 106, 106, 134, 'psico', 'volante'),
(178, 'xatu', 172, 139, 161, 134, 134, 161, 'psico', 'volante'),
(179, 'mareep', 162, 101, 128, 101, 106, 95, 'elettro', 'null'),
(180, 'flaaffy', 177, 117, 145, 117, 123, 106, 'elettro', 'null'),
(181, 'ampharos', 197, 139, 183, 150, 156, 117, 'elettro', 'null'),
(182, 'bellossom', 182, 145, 156, 161, 167, 112, 'erba', 'null'),
(183, 'marill', 177, 79, 79, 112, 112, 101, 'acqua', 'folletto'),
(184, 'azumarill', 207, 112, 123, 145, 145, 112, 'acqua', 'folletto'),
(185, 'sudowoodo', 177, 167, 90, 183, 128, 90, 'roccia', 'null'),
(186, 'politoed', 197, 139, 156, 139, 167, 134, 'acqua', 'null'),
(187, 'hoppip', 142, 95, 95, 101, 117, 112, 'erba', 'volante'),
(188, 'skiploom', 162, 106, 106, 112, 128, 145, 'erba', 'volante'),
(189, 'jumpluff', 182, 117, 117, 134, 161, 178, 'erba', 'volante'),
(190, 'aipom', 162, 134, 101, 117, 117, 150, 'normale', 'null'),
(191, 'sunkern', 137, 90, 90, 90, 90, 90, 'erba', 'null'),
(192, 'sunflora', 182, 139, 172, 117, 150, 90, 'erba', 'null'),
(193, 'yanma', 172, 128, 139, 106, 106, 161, 'coleottero', 'volante'),
(194, 'wooper', 162, 106, 84, 106, 84, 73, 'acqua', 'terra'),
(195, 'quagsire', 202, 150, 128, 150, 128, 95, 'acqua', 'terra'),
(196, 'espeon', 172, 128, 200, 123, 161, 178, 'psico', 'null'),
(197, 'umbreon', 202, 128, 123, 178, 200, 128, 'buio', 'null'),
(198, 'murkrow', 167, 150, 150, 103, 103, 157, 'buio', 'volante'),
(199, 'slowking', 202, 139, 167, 145, 178, 90, 'acqua', 'psico'),
(200, 'misdreavus', 167, 123, 150, 123, 150, 150, 'spettro', 'null'),
(201, 'unown', 155, 126, 136, 110, 110, 110, 'psico', 'null'),
(202, 'wobbuffet', 297, 93, 93, 121, 121, 93, 'psico', 'null'),
(203, 'girafarig', 177, 145, 156, 128, 128, 150, 'normale', 'psico'),
(204, 'pineco', 157, 128, 95, 156, 95, 73, 'coleottero', 'null'),
(205, 'forretress', 182, 156, 123, 211, 123, 101, 'coleottero', 'acciaio'),
(206, 'dunsparce', 207, 134, 128, 134, 128, 106, 'normale', 'null'),
(207, 'giglar', 172, 139, 95, 172, 128, 150, 'terra', 'volante'),
(208, 'steelix', 182, 150, 117, 277, 128, 90, 'acciaio', 'terra'),
(209, 'snubbull', 167, 145, 101, 112, 101, 90, 'folletto', 'null'),
(210, 'granbull', 197, 189, 123, 139, 123, 106, 'folletto', 'null'),
(211, 'qwilfish', 172, 161, 117, 150, 117, 150, 'acqua', 'veleno'),
(212, 'scizor', 177, 200, 117, 167, 145, 128, 'coleottero', 'acciaio'),
(213, 'shuckle', 127, 68, 68, 310, 310, 62, 'coleottero', 'roccia'),
(214, 'heracross', 187, 194, 101, 139, 161, 150, 'coleottero', 'lotta'),
(215, 'sneasel', 162, 161, 95, 117, 139, 183, 'buio', 'ghiaccio'),
(216, 'teddiursa', 167, 145, 112, 112, 112, 101, 'normale', 'null'),
(217, 'ursaring', 197, 200, 139, 139, 139, 117, 'normale', 'null'),
(218, 'slugma', 147, 101, 134, 101, 101, 79, 'fuoco', 'null'),
(219, 'magcargo', 167, 112, 156, 189, 145, 90, 'fuoco', 'roccia'),
(220, 'swinub', 157, 112, 90, 101, 90, 112, 'ghiaccio', 'terra'),
(221, 'piloswine', 207, 167, 123, 145, 123, 112, 'ghiaccio', 'terra'),
(222, 'corsola', 172, 117, 128, 161, 161, 95, 'acqua', 'roccia'),
(223, 'remoraid', 142, 128, 128, 95, 95, 128, 'acqua', 'null'),
(224, 'octillery', 182, 172, 172, 139, 139, 106, 'acqua', 'null'),
(225, 'delibird', 152, 117, 128, 106, 106, 139, 'ghiaccio', 'volante'),
(226, 'mantine', 192, 101, 145, 134, 211, 134, 'acqua', 'volante'),
(227, 'skarmory', 172, 145, 101, 211, 134, 134, 'acciaio', 'volante'),
(228, 'houndur', 152, 123, 145, 90, 112, 128, 'buio', 'fuoco'),
(229, 'houndoom', 182, 156, 178, 112, 145, 161, 'buio', 'fuoco'),
(230, 'kingdra', 182, 161, 161, 161, 161, 150, 'acqua', 'null'),
(231, 'phanpy', 197, 123, 101, 123, 101, 101, 'terra', 'null'),
(232, 'donphan', 197, 189, 123, 189, 123, 112, 'terra', 'null'),
(233, 'porygon2', 192, 145, 172, 156, 161, 123, 'normale', 'null'),
(234, 'stantler', 180, 161, 150, 125, 128, 150, 'normale', 'null'),
(235, 'smeargle', 162, 79, 79, 95, 106, 139, 'normale', 'null'),
(236, 'tyrogue', 142, 95, 95, 95, 95, 95, 'lotta', 'null'),
(237, 'hitmontop', 157, 161, 95, 161, 178, 134, 'lotta', 'null'),
(238, 'smoochum', 152, 90, 150, 73, 128, 128, 'ghiaccio', 'psico'),
(239, 'elekid', 152, 126, 128, 97, 117, 161, 'elettro', 'null'),
(240, 'magby', 152, 139, 134, 97, 117, 148, 'fuoco', 'null'),
(241, 'miltank', 202, 145, 101, 172, 134, 167, 'normale', 'null'),
(242, 'blissey', 362, 68, 139, 68, 205, 117, 'normale', 'null'),
(243, 'raikou', 197, 150, 183, 139, 167, 183, 'elettro', 'null'),
(244, 'entei', 222, 183, 156, 150, 139, 167, 'fuoco', 'null'),
(245, 'suicune', 207, 139, 156, 183, 183, 150, 'acqua', 'null'),
(246, 'larvitar', 157, 127, 106, 112, 112, 102, 'roccia', 'terra'),
(247, 'pupitar', 177, 149, 128, 134, 134, 113, 'roccia', 'terra'),
(248, 'tyranitar', 207, 204, 161, 178, 167, 124, 'roccia', 'buio'),
(249, 'lugia', 213, 156, 156, 200, 226, 178, 'psico', 'volante'),
(250, 'ho-oh', 213, 200, 178, 156, 226, 156, 'fuoco', 'volante'),
(251, 'celebi', 207, 167, 167, 167, 167, 167, 'psico', 'erba'),
(252, 'treecko', 147, 106, 128, 95, 117, 134, 'erba', 'null'),
(253, 'grovyle', 157, 128, 150, 106, 128, 161, 'erba', 'null'),
(254, 'sceptile', 177, 150, 172, 128, 150, 189, 'erba', 'null'),
(255, 'torchic', 152, 123, 134, 101, 112, 106, 'fuoco', 'null'),
(256, 'combusken', 167, 150, 150, 123, 123, 117, 'fuoco', 'lotta'),
(257, 'blaziken', 187, 189, 178, 134, 134, 145, 'fuoco', 'lotta'),
(258, 'mudkip', 157, 134, 112, 112, 112, 101, 'acqua', 'null'),
(259, 'marshtomp', 177, 150, 123, 134, 134, 112, 'acqua', 'terra'),
(260, 'swampert', 207, 178, 150, 156, 156, 123, 'acqua', 'terra'),
(261, 'poochyena', 142, 117, 90, 95, 90, 95, 'buio', 'null'),
(262, 'mightyena', 177, 156, 123, 134, 123, 134, 'buio', 'null'),
(263, 'zigzagoon', 145, 90, 90, 102, 102, 123, 'normale', 'null'),
(264, 'linoone', 185, 134, 112, 124, 124, 167, 'normale', 'null'),
(265, 'wurmple', 152, 106, 79, 95, 90, 79, 'coleottero', 'null'),
(266, 'silcoon', 157, 95, 84, 117, 84, 73, 'coleottero', 'null'),
(267, 'beautifly', 167, 134, 167, 112, 112, 128, 'coleottero', 'volante'),
(268, 'cascoon', 157, 95, 84, 117, 84, 73, 'coleottero', 'null'),
(269, 'dustox', 167, 112, 112, 134, 156, 128, 'coleottero', 'veleno'),
(270, 'lotad', 147, 90, 101, 90, 112, 90, 'acqua', 'erba'),
(271, 'lombre', 167, 112, 123, 112, 134, 112, 'acqua', 'erba'),
(272, 'ludicolo', 187, 134, 156, 134, 167, 134, 'acqua', 'erba'),
(273, 'seedot', 147, 101, 90, 112, 90, 90, 'erba', 'null'),
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
(285, 'shroomish', 167, 101, 101, 123, 123, 95, 'erba', 'null'),
(286, 'breloom', 167, 200, 123, 145, 123, 134, 'erba', 'lotta'),
(287, 'slakoth', 167, 123, 95, 123, 95, 90, 'normale', 'null'),
(288, 'vigoroth', 187, 145, 117, 145, 117, 156, 'normale', 'null'),
(289, 'slaking', 257, 233, 161, 167, 128, 167, 'normale', 'null'),
(290, 'nincada', 138, 206, 90, 156, 90, 101, 'coleottero', 'terra'),
(291, 'ninjask', 168, 156, 112, 106, 112, 233, 'coleottero', 'volante'),
(292, 'shedinja', 1, 156, 90, 106, 90, 101, 'coleottero', 'spettro'),
(293, 'whismur', 171, 113, 113, 82, 82, 88, 'normale', 'null'),
(294, 'loudred', 191, 135, 135, 104, 104, 110, 'normale', 'null'),
(295, 'exploud', 211, 157, 157, 126, 137, 132, 'normale', 'null'),
(296, 'makuhita', 179, 123, 79, 90, 90, 84, 'lotta', 'null'),
(297, 'hariyama', 251, 189, 101, 123, 123, 112, 'lotta', 'null'),
(298, 'azurill', 157, 79, 79, 101, 101, 79, 'normale', 'folletto'),
(299, 'nosepass', 137, 106, 106, 205, 156, 90, 'roccia', 'null'),
(300, 'skitty', 157, 106, 95, 106, 95, 112, 'normale', 'null'),
(301, 'delcatty', 177, 128, 117, 128, 117, 156, 'normale', 'null'),
(302, 'sableye', 157, 139, 128, 139, 128, 112, 'buio', 'spettro'),
(303, 'mawile', 157, 150, 117, 150, 117, 112, 'acciaio', 'folletto'),
(304, 'aron', 157, 134, 101, 167, 101, 90, 'acciaio', 'roccia'),
(305, 'lairon', 167, 156, 112, 221, 112, 101, 'acciaio', 'roccia'),
(306, 'aggron', 177, 178, 123, 255, 123, 112, 'acciaio', 'roccia'),
(307, 'meditite', 137, 101, 101, 117, 117, 123, 'lotta', 'psico'),
(308, 'medicham', 167, 123, 123, 139, 139, 145, 'lotta', 'psico'),
(309, 'electrike', 147, 106, 128, 101, 101, 128, 'elettro', 'null'),
(310, 'manectric', 177, 139, 172, 123, 123, 172, 'elettro', 'null'),
(311, 'plusle', 167, 112, 150, 101, 139, 161, 'elettro', 'null'),
(312, 'minun', 167, 101, 139, 112, 150, 161, 'elettro', 'null'),
(313, 'volbeat', 172, 137, 108, 139, 150, 150, 'coleottero', 'null'),
(314, 'illumise', 172, 108, 137, 139, 150, 150, 'coleottero', 'null'),
(315, 'roselia', 157, 123, 167, 106, 145, 128, 'erba', 'veleno'),
(316, 'gulpin', 177, 104, 104, 115, 115, 101, 'veleno', 'null'),
(317, 'swalot', 207, 137, 137, 148, 148, 117, 'veleno', 'null'),
(318, 'carvanah', 152, 156, 128, 79, 79, 128, 'acqua', 'buio'),
(319, 'sharpedo', 177, 189, 161, 101, 101, 161, 'acqua', 'buio'),
(320, 'wailmer', 237, 134, 134, 95, 95, 123, 'acqua', 'null'),
(321, 'wailord', 277, 156, 156, 106, 106, 123, 'acqua', 'null'),
(322, 'numel', 167, 123, 128, 101, 106, 95, 'fuoco', 'terra'),
(323, 'camerupt', 177, 167, 172, 134, 139, 101, 'fuoco', 'terra'),
(324, 'torkoal', 177, 150, 150, 211, 134, 79, 'fuoco', 'null'),
(325, 'spoink', 167, 84, 134, 96, 145, 123, 'psico', 'null'),
(326, 'grumpig', 187, 106, 156, 128, 178, 145, 'psico', 'null'),
(327, 'spinda', 167, 123, 123, 123, 123, 123, 'normale', 'null'),
(328, 'trapinch', 152, 167, 106, 106, 106, 68, 'terra', 'null'),
(329, 'vibrava', 157, 134, 112, 112, 112, 134, 'terra', 'drago'),
(330, 'flygon', 187, 167, 145, 145, 145, 167, 'terra', 'drago'),
(331, 'cacnea', 157, 150, 150, 101, 101, 95, 'erba', 'null'),
(332, 'cacturne', 177, 183, 183, 123, 123, 117, 'erba', 'buio'),
(333, 'swablu', 152, 101, 101, 123, 139, 112, 'normale', 'volante'),
(334, 'altaria', 182, 134, 134, 156, 172, 145, 'drago', 'volante'),
(335, 'zangoose', 180, 183, 123, 123, 123, 156, 'normale', 'null'),
(336, 'seviper', 180, 167, 167, 123, 123, 128, 'veleno', 'null'),
(337, 'lunatone', 197, 117, 161, 127, 150, 134, 'roccia', 'psico'),
(338, 'solrock', 197, 161, 117, 150, 128, 134, 'roccia', 'psico'),
(339, 'barboach', 157, 110, 107, 104, 102, 123, 'acqua', 'terra'),
(340, 'whiscash', 217, 143, 140, 137, 135, 123, 'acqua', 'terra'),
(341, 'corphish', 150, 145, 112, 128, 95, 95, 'acqua', 'null'),
(342, 'crawdaunt', 170, 189, 156, 150, 117, 117, 'acqua', 'buio'),
(343, 'baltoy', 147, 101, 101, 117, 134, 117, 'terra', 'psico'),
(344, 'claydol', 167, 134, 134, 172, 189, 139, 'terra', 'psico'),
(345, 'lileep', 173, 102, 124, 141, 152, 82, 'roccia', 'erba'),
(346, 'cradily', 193, 146, 146, 163, 174, 104, 'roccia', 'erba'),
(347, 'anorith', 152, 161, 101, 112, 112, 139, 'roccia', 'coleottero'),
(348, 'armaldo', 182, 194, 134, 167, 145, 106, 'roccia', 'coleottero'),
(349, 'feebas', 127, 73, 68, 79, 117, 145, 'acqua', 'null'),
(350, 'milotic', 202, 123, 167, 144, 194, 146, 'acqua', 'null'),
(351, 'castform', 177, 134, 134, 134, 134, 134, 'normale', 'null'),
(352, 'kecleon', 167, 156, 123, 134, 189, 101, 'normale', 'null'),
(353, 'shuppet', 151, 139, 126, 95, 93, 106, 'spettro', 'null'),
(354, 'banette', 171, 183, 148, 128, 126, 128, 'spettro', 'null'),
(355, 'duskull', 127, 101, 90, 156, 156, 84, 'spettro', 'null'),
(356, 'dusclops', 147, 134, 123, 200, 200, 84, 'spettro', 'null'),
(357, 'tropius', 206, 132, 136, 148, 152, 113, 'erba', 'volante'),
(358, 'chimecho', 182, 112, 161, 145, 156, 128, 'psico', 'null'),
(359, 'absol', 172, 200, 123, 123, 139, 139, 'buio', 'null'),
(360, 'wynaut', 202, 82, 82, 110, 110, 82, 'psico', 'null'),
(361, 'snorunt', 157, 112, 112, 112, 112, 112, 'ghiaccio', 'null'),
(362, 'glalie', 187, 145, 145, 145, 145, 145, 'ghiaccio', 'null'),
(363, 'spheal', 177, 101, 117, 112, 112, 84, 'ghiaccio', 'acqua'),
(364, 'sealeo', 197, 123, 139, 134, 134, 106, 'ghiaccio', 'acqua'),
(365, 'walrein', 217, 145, 161, 156, 156, 128, 'ghiaccio', 'acqua'),
(366, 'clamperl', 142, 127, 138, 150, 117, 92, 'acqua', 'null'),
(367, 'huntail', 162, 171, 160, 172, 139, 114, 'acqua', 'null'),
(368, 'gorebyss', 162, 149, 182, 172, 139, 114, 'acqua', 'null'),
(369, 'relicanth', 207, 156, 106, 200, 128, 117, 'acqua', 'roccia'),
(370, 'luvdisc', 150, 90, 101, 117, 128, 163, 'acqua', 'null'),
(371, 'bagon', 152, 139, 101, 123, 90, 112, 'drago', 'null'),
(372, 'shelgon', 172, 161, 123, 167, 112, 112, 'drago', 'null'),
(373, 'salamence', 202, 205, 178, 145, 145, 167, 'drago', 'null'),
(374, 'beldum', 147, 117, 95, 145, 123, 90, 'acciaio', 'psico'),
(375, 'metang', 167, 139, 117, 167, 145, 112, 'acciaio', 'psico'),
(376, 'metagross', 187, 205, 161, 200, 156, 134, 'acciaio', 'psico'),
(377, 'regirock', 187, 167, 112, 277, 167, 112, 'roccia', 'null'),
(378, 'regice', 187, 112, 167, 167, 277, 112, 'ghiaccio', 'null'),
(379, 'registeel', 187, 139, 139, 222, 222, 112, 'acciaio', 'null'),
(380, 'latias', 187, 145, 178, 156, 200, 178, 'drago', 'psico'),
(381, 'latios', 187, 156, 200, 145, 178, 178, 'drago', 'psico'),
(382, 'kyogre', 207, 167, 222, 156, 211, 156, 'acqua', 'null'),
(383, 'groudon', 207, 222, 167, 211, 156, 156, 'terra', 'fuoco'),
(384, 'rayquaza', 212, 222, 222, 156, 156, 161, 'drago', 'volante'),
(385, 'jirachi', 207, 167, 167, 167, 167, 167, 'acciaio', 'psico'),
(386, 'deoxys', 157, 222, 222, 112, 112, 222, 'psico', 'null'),
(387, 'turtwig', 162, 132, 106, 127, 117, 91, 'erba', 'null'),
(388, 'grotle', 182, 155, 117, 150, 128, 96, 'erba', 'null'),
(389, 'torterra', 202, 177, 139, 172, 15, 118, 'erba', 'terra'),
(390, 'chimchar', 151, 121, 121, 105, 105, 124, 'fuoco', 'null'),
(391, 'monferno', 171, 143, 143, 114, 114, 146, 'fuoco', 'lotta'),
(392, 'infernape', 183, 171, 171, 135, 135, 176, 'fuoco', 'lotta'),
(393, 'piplup', 160, 113, 124, 115, 118, 101, 'acqua', 'null'),
(394, 'prinplup', 171, 129, 146, 132, 140, 112, 'acqua', 'null'),
(395, 'empleon', 191, 151, 179, 154, 168, 123, 'acqua', 'acciaio'),
(396, 'starly', 147, 117, 90, 90, 90, 123, 'normale', 'volante'),
(397, 'staravia', 162, 139, 101, 112, 101, 145, 'normale', 'volante'),
(398, 'staraptor', 192, 189, 112, 134, 123, 167, 'normale', 'volante'),
(399, 'bidoof', 999, 999, 999, 999, 999, 999, 'normale', 'null'),
(400, 'bibarel', 186, 150, 117, 123, 123, 135, 'normale', 'acqua'),
(401, 'kricketot', 144, 84, 84, 102, 102, 84, 'coleottero', 'null'),
(402, 'kricketune', 184, 150, 117, 113, 113, 128, 'coleottero', 'null'),
(403, 'shinx', 152, 128, 101, 94, 94, 106, 'elettro', 'null'),
(404, 'luxio', 167, 150, 123, 111, 111, 123, 'elettro', 'null'),
(405, 'luxray', 187, 189, 161, 144, 144, 134, 'elettro', 'null'),
(406, 'budew', 147, 90, 112, 95, 134, 117, 'erba', 'veleno'),
(407, 'roserade', 167, 134, 194, 128, 172, 156, 'erba', 'veleno'),
(408, 'cranidos', 174, 194, 90, 101, 90, 121, 'roccia', 'null'),
(409, 'rampardos', 204, 238, 128, 123, 112, 121, 'roccia', 'null'),
(410, 'shieldon', 137, 103, 103, 187, 154, 90, 'roccia', 'acciaio'),
(411, 'bastiodon', 167, 114, 108, 242, 209, 90, 'roccia', 'acciaio'),
(412, 'burmy', 147, 89, 89, 106, 106, 96, 'coleottero', 'null'),
(413, 'wormadam', 167, 122, 144, 150, 172, 96, 'coleottero', 'erba'),
(414, 'mothim', 177, 160, 160, 112, 112, 129, 'coleottero', 'volante'),
(415, 'combee', 137, 90, 90, 103, 103, 134, 'coleottero', 'volante'),
(416, 'vespiquen', 177, 145, 145, 169, 169, 101, 'coleottero', 'volante'),
(417, 'pachirisu', 167, 106, 106, 134, 156, 161, 'elettro', 'null'),
(418, 'buizel', 162, 128, 123, 95, 90, 150, 'acqua', 'null'),
(419, 'floatzel', 192, 172, 150, 117, 112, 183, 'acqua', 'null'),
(420, 'cherubi', 152, 95, 125, 106, 115, 95, 'erba', 'null'),
(421, 'cherrim', 177, 123, 152, 134, 143, 150, 'erba', 'null'),
(422, 'shellos', 183, 110, 119, 110, 125, 94, 'acqua', 'null'),
(423, 'gastrodom', 218, 148, 158, 132, 147, 100, 'acqua', 'terra'),
(424, 'ambipom', 182, 167, 123, 129, 129, 183, 'normale', 'null'),
(425, 'drifloon', 197, 112, 123, 94, 105, 134, 'spettro', 'volante'),
(426, 'drifblim', 257, 145, 156, 105, 116, 145, 'spettro', 'volante'),
(427, 'buneary', 162, 129, 105, 105, 118, 150, 'normale', 'null'),
(428, 'lopunny', 172, 140, 116, 149, 162, 172, 'normale', 'null'),
(429, 'mismagius', 167, 123, 172, 123, 172, 172, 'spettro', 'null'),
(430, 'honchkrow', 207, 194, 172, 114, 114, 135, 'buio', 'volante'),
(431, 'glameow', 156, 117, 103, 103, 97, 150, 'normale', 'null'),
(432, 'purugly', 178, 147, 127, 127, 122, 180, 'normale', 'null'),
(433, 'chingling', 152, 90, 128, 112, 112, 106, 'psico', 'null'),
(434, 'stunky', 170, 126, 102, 108, 102, 138, 'veleno', 'buio'),
(435, 'skuntank', 210, 159, 135, 130, 124, 149, 'veleno', 'buio'),
(436, 'bronzor', 164, 83, 83, 151, 151, 82, 'acciaio', 'psico'),
(437, 'bronzong', 174, 155, 144, 184, 184, 93, 'acciaio', 'psico'),
(438, 'bonsly', 157, 145, 68, 161, 106, 68, 'roccia', 'null'),
(439, 'mime jr.', 127, 84, 134, 106, 156, 123, 'psico', 'folletto'),
(440, 'happiny', 207, 62, 73, 62, 128, 90, 'normale', 'null'),
(441, 'chatot', 183, 128, 158, 106, 103, 157, 'normale', 'volante'),
(442, 'spiritomb', 157, 158, 158, 176, 176, 95, 'spettro', 'buio'),
(443, 'gible', 165, 134, 101, 106, 106, 103, 'drago', 'terra'),
(444, 'gabite', 175, 156, 112, 128, 117, 147, 'drago', 'terra'),
(445, 'garchomp', 215, 200, 145, 161, 150, 169, 'drago', 'terra'),
(446, 'munchlax', 242, 150, 101, 101, 150, 62, 'normale', 'null'),
(447, 'riolu', 147, 134, 95, 101, 101, 123, 'lotta', 'null'),
(448, 'lucario', 177, 178, 183, 134, 134, 156, 'lotta', 'acciaio'),
(449, 'hippopotas', 175, 136, 99, 143, 103, 92, 'terra', 'null'),
(450, 'hippowdon', 215, 180, 132, 187, 136, 108, 'terra', 'null'),
(451, 'skorupi', 147, 112, 90, 156, 117, 128, 'veleno', 'coleottero'),
(452, 'drapion', 177, 156, 123, 178, 139, 161, 'veleno', 'buio'),
(453, 'croagunk', 155, 124, 124, 101, 101, 112, 'veleno', 'lotta'),
(454, 'toxicroak', 190, 173, 151, 128, 128, 150, 'veleno', 'lotta'),
(455, 'carnivine', 181, 167, 156, 136, 136, 107, 'erba', 'null'),
(456, 'finneon', 156, 111, 111, 118, 124, 129, 'acqua', 'null'),
(457, 'lumineon', 176, 133, 133, 140, 151, 157, 'acqua', 'null'),
(458, 'mantyke', 152, 79, 123, 112, 189, 112, 'acqua', 'null'),
(459, 'snover', 167, 125, 125, 112, 123, 101, 'erba', 'ghiaccio'),
(460, 'abomasnow', 197, 158, 158, 139, 150, 123, 'erba', 'ghiaccio'),
(461, 'weavile', 177, 189, 106, 128, 150, 194, 'buio', 'ghiaccio'),
(462, 'magnezone', 177, 134, 200, 183, 156, 123, 'elettro', 'acciaio'),
(463, 'lickilicky', 217, 150, 145, 161, 161, 112, 'normale', 'null'),
(464, 'rhyperior', 222, 211, 117, 200, 117, 101, 'terra', 'roccia'),
(465, 'tangrowth', 207, 167, 178, 194, 112, 112, 'erba', 'null'),
(466, 'electivire', 182, 192, 161, 130, 150, 161, 'elettro', 'null'),
(467, 'magmortar', 182, 161, 194, 130, 161, 148, 'fuoco', 'null'),
(468, 'togekiss', 192, 112, 189, 161, 183, 145, 'folletto', 'volante'),
(469, 'yanmega', 193, 140, 184, 151, 118, 161, 'coleottero', 'volante'),
(470, 'leafeon', 172, 178, 123, 200, 128, 161, 'erba', 'null'),
(471, 'glaceon', 172, 123, 200, 178, 161, 128, 'ghiaccio', 'null'),
(472, 'gliscor', 182, 161, 106, 194, 139, 161, 'terra', 'volante'),
(473, 'mamoswine', 217, 200, 134, 145, 123, 145, 'ghiaccio', 'terra'),
(474, 'porygon-Z', 192, 145, 205, 134, 139, 156, 'normale', 'null'),
(475, 'gallade', 175, 194, 128, 128, 183, 145, 'psico', 'lotta'),
(476, 'probopass', 167, 117, 139, 216, 222, 101, 'roccia', 'acciaio'),
(477, 'dusknoir', 152, 167, 128, 205, 205, 106, 'spettro', 'null'),
(478, 'froslass', 177, 145, 145, 134, 134, 178, 'ghiaccio', 'spettro'),
(479, 'rotom', 157, 112, 161, 141, 141, 157, 'elettro', 'spettro'),
(480, 'uxie', 182, 139, 139, 200, 200, 161, 'psico', 'null'),
(481, 'mesprit', 187, 172, 172, 172, 172, 145, 'psico', 'null'),
(482, 'azelf', 182, 194, 194, 134, 134, 183, 'psico', 'null'),
(483, 'dialga', 207, 189, 222, 189, 167, 156, 'drago', 'acciaio'),
(484, 'palkia', 197, 189, 222, 167, 189, 167, 'acqua', 'drago'),
(485, 'heatran', 198, 156, 200, 173, 173, 141, 'fuoco', 'acciaio'),
(486, 'regigigas', 217, 233, 145, 178, 178, 167, 'normale', 'null'),
(487, 'giratina', 257, 167, 167, 189, 189, 156, 'spettro', 'drago'),
(488, 'cresselia', 227, 135, 139, 178, 189, 150, 'psico', 'null'),
(489, 'phione', 187, 145, 145, 145, 145, 145, 'acqua', 'null'),
(490, 'manaphy', 207, 167, 167, 167, 167, 167, 'acqua', 'null'),
(491, 'darkrai', 177, 156, 205, 156, 156, 194, 'buio', 'null'),
(492, 'shaymin', 207, 167, 167, 167, 167, 167, 'erba', 'null'),
(493, 'arceus', 227, 189, 189, 189, 189, 189, 'normale', 'null');

-- --------------------------------------------------------

--
-- Struttura della tabella `sessione`
--

CREATE TABLE `sessione` (
  `User` varchar(20) NOT NULL,
  `Stanza` int(4) NOT NULL,
  `Punteggio` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `stanze`
--

CREATE TABLE `stanze` (
  `Id` int(4) NOT NULL,
  `Gioco` int(1) NOT NULL,
  `Data` date NOT NULL,
  `Stato` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `UserName` varchar(20) NOT NULL,
  `NickName` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` varchar(6) NOT NULL,
  `StatoId` int(3) NOT NULL,
  `StanzaId` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `giochi`
--
ALTER TABLE `giochi`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `pm_borsa`
--
ALTER TABLE `pm_borsa`
  ADD PRIMARY KEY (`Trainer_ID`,`Oggetto_ID`),
  ADD KEY `Oggetto_ID` (`Oggetto_ID`);

--
-- Indici per le tabelle `pm_img`
--
ALTER TABLE `pm_img`
  ADD PRIMARY KEY (`PM_img`),
  ADD KEY `Pokedex` (`Pokedex`);

--
-- Indici per le tabelle `pm_img_npc`
--
ALTER TABLE `pm_img_npc`
  ADD PRIMARY KEY (`NPC_IMG`),
  ADD KEY `NPC_ID` (`NPC_ID`);

--
-- Indici per le tabelle `pm_mossa`
--
ALTER TABLE `pm_mossa`
  ADD PRIMARY KEY (`MT`),
  ADD KEY `Tipo` (`Tipo`);

--
-- Indici per le tabelle `pm_npc`
--
ALTER TABLE `pm_npc`
  ADD PRIMARY KEY (`NPC_ID`),
  ADD KEY `Trainer_ID` (`Trainer_ID`);

--
-- Indici per le tabelle `pm_oggetti`
--
ALTER TABLE `pm_oggetti`
  ADD PRIMARY KEY (`Oggetto_ID`);

--
-- Indici per le tabelle `pm_squadra`
--
ALTER TABLE `pm_squadra`
  ADD PRIMARY KEY (`PM_ID`),
  ADD KEY `Pokedex` (`Pokedex`),
  ADD KEY `Mossa1` (`Mossa1`),
  ADD KEY `Mossa2` (`Mossa2`),
  ADD KEY `Mossa3` (`Mossa3`),
  ADD KEY `Mossa4` (`Mossa4`),
  ADD KEY `Trainer_ID` (`Trainer_ID`);

--
-- Indici per le tabelle `pm_tecniche`
--
ALTER TABLE `pm_tecniche`
  ADD PRIMARY KEY (`Pokedex`,`MT`),
  ADD KEY `MT` (`MT`);

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Trainer_ID` (`Trainer_ID`);

--
-- Indici per le tabelle `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`Pokedex`),
  ADD KEY `tipo1` (`tipo1`),
  ADD KEY `tipo2` (`tipo2`);

--
-- Indici per le tabelle `sessione`
--
ALTER TABLE `sessione`
  ADD PRIMARY KEY (`User`,`Stanza`),
  ADD KEY `Stanza` (`Stanza`);

--
-- Indici per le tabelle `stanze`
--
ALTER TABLE `stanze`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Gioco` (`Gioco`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`UserName`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `pm_borsa`
--
ALTER TABLE `pm_borsa`
  ADD CONSTRAINT `pm_borsa_ibfk_1` FOREIGN KEY (`Trainer_ID`) REFERENCES `pm_trainer` (`Trainer_ID`),
  ADD CONSTRAINT `pm_borsa_ibfk_2` FOREIGN KEY (`Oggetto_ID`) REFERENCES `pm_oggetti` (`Oggetto_ID`);

--
-- Limiti per la tabella `pm_img`
--
ALTER TABLE `pm_img`
  ADD CONSTRAINT `pm_img_ibfk_1` FOREIGN KEY (`Pokedex`) REFERENCES `pokemon` (`Pokedex`);

--
-- Limiti per la tabella `pm_img_npc`
--
ALTER TABLE `pm_img_npc`
  ADD CONSTRAINT `pm_img_npc_ibfk_1` FOREIGN KEY (`NPC_ID`) REFERENCES `pm_npc` (`NPC_ID`);

--
-- Limiti per la tabella `pm_mossa`
--
ALTER TABLE `pm_mossa`
  ADD CONSTRAINT `pm_mossa_ibfk_1` FOREIGN KEY (`Tipo`) REFERENCES `pm_tipo` (`Tipo`);

--
-- Limiti per la tabella `pm_npc`
--
ALTER TABLE `pm_npc`
  ADD CONSTRAINT `pm_npc_ibfk_1` FOREIGN KEY (`Trainer_ID`) REFERENCES `pm_trainer` (`Trainer_ID`);

--
-- Limiti per la tabella `pm_squadra`
--
ALTER TABLE `pm_squadra`
  ADD CONSTRAINT `pm_squadra_ibfk_1` FOREIGN KEY (`Pokedex`) REFERENCES `pokemon` (`Pokedex`),
  ADD CONSTRAINT `pm_squadra_ibfk_2` FOREIGN KEY (`Mossa1`) REFERENCES `pm_mossa` (`MT`),
  ADD CONSTRAINT `pm_squadra_ibfk_3` FOREIGN KEY (`Mossa2`) REFERENCES `pm_mossa` (`MT`),
  ADD CONSTRAINT `pm_squadra_ibfk_4` FOREIGN KEY (`Mossa3`) REFERENCES `pm_mossa` (`MT`),
  ADD CONSTRAINT `pm_squadra_ibfk_5` FOREIGN KEY (`Mossa4`) REFERENCES `pm_mossa` (`MT`),
  ADD CONSTRAINT `pm_squadra_ibfk_6` FOREIGN KEY (`Trainer_ID`) REFERENCES `pm_trainer` (`Trainer_ID`);

--
-- Limiti per la tabella `pm_tecniche`
--
ALTER TABLE `pm_tecniche`
  ADD CONSTRAINT `pm_tecniche_ibfk_1` FOREIGN KEY (`MT`) REFERENCES `pm_mossa` (`MT`),
  ADD CONSTRAINT `pm_tecniche_ibfk_2` FOREIGN KEY (`Pokedex`) REFERENCES `pokemon` (`Pokedex`);

--
-- Limiti per la tabella `pm_user`
--
ALTER TABLE `pm_user`
  ADD CONSTRAINT `pm_user_ibfk_1` FOREIGN KEY (`Trainer_ID`) REFERENCES `pm_trainer` (`Trainer_ID`),
  ADD CONSTRAINT `pm_user_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `utenti` (`UserName`);

--
-- Limiti per la tabella `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `pokemon_ibfk_1` FOREIGN KEY (`tipo1`) REFERENCES `pm_tipo` (`Tipo`),
  ADD CONSTRAINT `pokemon_ibfk_2` FOREIGN KEY (`tipo2`) REFERENCES `pm_tipo` (`Tipo`);

--
-- Limiti per la tabella `sessione`
--
ALTER TABLE `sessione`
  ADD CONSTRAINT `sessione_ibfk_1` FOREIGN KEY (`User`) REFERENCES `utenti` (`UserName`),
  ADD CONSTRAINT `sessione_ibfk_2` FOREIGN KEY (`Stanza`) REFERENCES `stanze` (`Id`);

--
-- Limiti per la tabella `stanze`
--
ALTER TABLE `stanze`
  ADD CONSTRAINT `stanze_ibfk_1` FOREIGN KEY (`Gioco`) REFERENCES `giochi` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
