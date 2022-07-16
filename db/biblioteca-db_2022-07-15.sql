-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 16, 2022 alle 16:42
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struttura della tabella `assegnazioni`
--

CREATE TABLE `assegnazioni` (
  `isbn` double NOT NULL,
  `matricola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE `libri` (
  `titolo` varchar(50) NOT NULL,
  `autore` varchar(50) NOT NULL,
  `editore` varchar(50) NOT NULL,
  `giacenza` int(11) NOT NULL DEFAULT 0,
  `isbn` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`titolo`, `autore`, `editore`, `giacenza`, `isbn`) VALUES
('Il mago di Oz', 'Baum', 'Mondadori', 0, 1111111111111),
('Il dottor Zivago', 'Pasternak', 'Feltrinelli', 0, 2222222222222),
('Sherlock Holmes', 'Conan Doyle', 'I Mammut', 0, 3333333333333),
('1984', 'Orwell', 'De Agostini', 0, 4444444444444),
('Morte a Venezia', 'Mann', 'Adelphi', 0, 5555555555555),
('L\'origine delle specie', 'Darwin', 'Feltrinelli', 0, 6666666666666),
('Delitto e castigo', 'Dostoevskij', 'Lattes', 0, 7777777777777),
('Guerra e pace', 'Tolstoj', 'Adelphi', 0, 8888888888888),
('Il Conte di Montecristo', 'Dumas', 'Mondadori', 0, 9999999999999);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `matricola` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `genere` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`matricola`, `email`, `password`, `nome`, `cognome`, `genere`) VALUES
(1122334, 'mattia.scarrone@edu.unito.it', 'dbc3ede8cf726a5f892a7808f647aa3e', 'Mattia', 'Scarrone', 'M'),
(1234567, 'marco.altamura@edu.unito.it', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Altamura', 'M'),
(9876543, 'alessia.varetto@edu.unito.it', '6332e88a4c7dba6f7743d3a7a0c6ea2c', 'Alessia', 'Varetto', 'F');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `assegnazioni`
--
ALTER TABLE `assegnazioni`
  ADD PRIMARY KEY (`isbn`,`matricola`);

--
-- Indici per le tabelle `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`isbn`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`matricola`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
