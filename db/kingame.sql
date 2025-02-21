-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 21, 2025 alle 09:48
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
-- Struttura della tabella `nazioni`
--

CREATE TABLE `nazioni` (
  `ISO` varchar(2) NOT NULL,
  `Nome_Nazione` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `nazioni`
--

INSERT INTO `nazioni` (`ISO`, `Nome_Nazione`) VALUES
('AF', ' Afghanistan'),
('AL', 'Albania'),
('DZ', 'Algeria'),
('AD', 'Andorra'),
('AO', 'Angola'),
('	A', 'Anguilla'),
('AQ', 'Antartide'),
('AG', 'Antigua e Barbuda'),
('SA', 'Arabia Saudita'),
('AR', 'Argentina'),
('AM', 'Armenia'),
('AW', 'Aruba'),
('AU', 'Australia'),
('AT', 'Austria'),
('AZ', 'Azerbaigian'),
('BS', 'Bahamas'),
('BH', 'Bahrein'),
('BD', 'Bangladesh'),
('BB', 'Barbados'),
('BE', 'Belgio'),
('BZ', 'Belize'),
('BJ', 'Benin'),
('BM', 'Bermuda'),
('BT', 'Bhutan'),
('BY', 'Bielorussia'),
('MM', 'Birmania'),
('BO', 'Bolivia'),
('BA', 'Bosnia ed Erzegovina'),
('BW', 'Botswana'),
('BR', 'Brasile'),
('BN', 'Brunei'),
('BG', 'Bulgaria'),
('BF', 'Burkina Faso'),
('BI', 'Burundi'),
('KH', 'Cambogia'),
('CM', 'Camerun'),
('CA', 'Canada'),
('CV', 'Capo Verde'),
('TD', 'Ciad'),
('CL', 'Cile'),
('CN', 'Cina'),
('CY', 'Cipro'),
('VA', 'Città del Vaticano'),
('CO', 'Colombia'),
('KM', 'Comore'),
('KP', 'Corea del Nord'),
('KR', 'Corea del Sud'),
('CI', 'Costa d\'Avorio'),
('CR', 'Costa Rica'),
('HR', 'Croazia'),
('CU', 'Cuba'),
('CW', 'Curaçao'),
('DK', 'Danimarca'),
('DM', 'Dominica'),
('EC', 'Ecuador'),
('EG', 'Egitto'),
('SV', 'El Salvador'),
('AE', 'Emirati Arabi Uniti'),
('ER', 'Eritrea'),
('EE', 'Estonia'),
('ET', 'Etiopia'),
('FJ', 'Figi'),
('PH', 'Filippine'),
('FI', 'Finlandia'),
('FR', 'Francia'),
('GA', 'Gabon'),
('GM', 'Gambia'),
('GE', 'Georgia'),
('GS', 'Georgia del Sud e Isole Sandwich Australi'),
('DE', 'Germania'),
('GH', 'Ghana'),
('JM', 'Giamaica'),
('JP', 'Giappone'),
('GI', 'Gibilterra'),
('DJ', 'Gibuti');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `nazioni`
--
ALTER TABLE `nazioni`
  ADD PRIMARY KEY (`ISO`),
  ADD UNIQUE KEY `Nome_Nazione` (`Nome_Nazione`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
