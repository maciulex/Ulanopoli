-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Lip 2021, 09:47
-- Wersja serwera: 10.4.19-MariaDB
-- Wersja PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `statki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) NOT NULL,
  `readyFleets` text NOT NULL DEFAULT ';',
  `gameShips` text NOT NULL DEFAULT '5;1;;4;1;;3;2;;2;1',
  `privacy` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `players` tinyint(4) DEFAULT 0,
  `timeout` tinyint(4) NOT NULL,
  `playersNicks` varchar(100) DEFAULT ';',
  `gameStart` double DEFAULT NULL,
  `lastAction` double DEFAULT NULL,
  `whosTour` int(11) NOT NULL DEFAULT 0,
  `shipsP1` text DEFAULT NULL,
  `shipsP2` text DEFAULT NULL,
  `logs` text DEFAULT NULL,
  `gameEnd` varchar(255) NOT NULL,
  `score` varchar(101) NOT NULL DEFAULT '0;0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `passcode` text NOT NULL,
  `inGame` int(11) NOT NULL DEFAULT 0,
  `authCode` text DEFAULT NULL,
  `authDate` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `descryption` text NOT NULL DEFAULT 'Gracz nie ma własnego opisu',
  `avatar` text NOT NULL,
  `Sgames` int(11) DEFAULT 0,
  `SgamesWin` int(11) DEFAULT 0,
  `SgamesLose` int(11) DEFAULT 0,
  `SgamesAbound` int(11) NOT NULL DEFAULT 0,
  `SgamesEarlyEnd` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
