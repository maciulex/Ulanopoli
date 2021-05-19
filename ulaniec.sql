-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Maj 2021, 21:27
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
-- Baza danych: `ulaniec`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filds`
--

CREATE TABLE `filds` (
  `id` int(11) NOT NULL,
  `l1` int(11) NOT NULL,
  `l2` int(11) NOT NULL,
  `l3` int(11) NOT NULL,
  `l4` int(11) NOT NULL,
  `l5` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `filds`
--

INSERT INTO `filds` (`id`, `l1`, `l2`, `l3`, `l4`, `l5`, `name`) VALUES
(0, 0, 0, 0, 0, 0, 'Start'),
(1, 60000, 110000, 160000, 210000, 360000, 'Grenada'),
(2, 60000, 110000, 160000, 210000, 360000, 'Sewilla'),
(3, 60000, 110000, 160000, 210000, 360000, 'Madryt'),
(4, 25000, 50000, 100000, 200000, 0, 'Bali'),
(5, 100000, 150000, 200000, 250000, 400000, 'Hongkong'),
(6, 100000, 150000, 200000, 250000, 400000, 'Pekin'),
(7, 120000, 170000, 220000, 270000, 420000, 'Shanghaj'),
(8, 0, 0, 0, 0, 0, 'Bez ludna wyspa'),
(9, 140000, 240000, 340000, 440000, 690000, 'Wenecja'),
(10, 140000, 240000, 340000, 440000, 690000, 'Mediolan'),
(11, 160000, 260000, 360000, 460000, 710000, 'Rzym'),
(12, 0, 0, 0, 0, 0, 'Szansa'),
(13, 180000, 280000, 380000, 480000, 730000, 'Hamburg'),
(14, 25000, 50000, 100000, 200000, 0, 'Cypr'),
(15, 200000, 300000, 400000, 500000, 750000, 'Berlin'),
(16, 0, 0, 0, 0, 0, 'Mistrzostwa Świata'),
(17, 220000, 370000, 520000, 670000, 1045000, 'Londyn'),
(18, 25000, 50000, 100000, 200000, 0, 'Dubaj'),
(19, 240000, 390000, 540000, 690000, 1065000, 'Sydney'),
(20, 0, 0, 0, 0, 0, 'Szansa'),
(21, 260000, 410000, 560000, 710000, 1085000, 'Chicago'),
(22, 260000, 410000, 560000, 710000, 1085000, 'Las Vegas'),
(23, 280000, 430000, 580000, 730000, 1105000, 'Nowy Jork'),
(24, 0, 0, 0, 0, 0, 'Podróż'),
(25, 25000, 50000, 100000, 200000, 0, 'Nicea'),
(26, 300000, 500000, 700000, 900000, 1400000, 'Lyon'),
(27, 320000, 520000, 720000, 920000, 1420000, 'Paryż'),
(28, 0, 0, 0, 0, 0, 'Szansa'),
(29, 350000, 550000, 750000, 950000, 1450000, 'Kraków'),
(30, 0, 0, 0, 0, 0, 'Podatek'),
(31, 400000, 600000, 800000, 1000000, 1500000, 'Warszawa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game`
--

CREATE TABLE `game` (
  `gameID` int(11) NOT NULL,
  `serverName` varchar(20) DEFAULT NULL,
  `gamePasscode` varchar(20) DEFAULT NULL,
  `gameStatus` int(11) DEFAULT NULL,
  `activePlayer` int(11) DEFAULT NULL,
  `baseMoney` int(11) DEFAULT NULL,
  `maxPlayers` tinyint(4) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `timeForTour` int(11) DEFAULT NULL,
  `tour` int(11) DEFAULT NULL,
  `eventCode` int(11) DEFAULT NULL,
  `logs` mediumtext DEFAULT NULL,
  `players` varchar(255) DEFAULT NULL,
  `startTime` varchar(255) DEFAULT NULL,
  `whosTour` int(1) DEFAULT NULL,
  `fildsNfo` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `money` varchar(255) DEFAULT NULL,
  `cards` varchar(255) DEFAULT NULL,
  `trowed` tinytext DEFAULT NULL,
  `movesCodes` tinytext NOT NULL,
  `islands` tinytext NOT NULL,
  `wealth` tinytext NOT NULL,
  `championsFild` int(11) DEFAULT NULL,
  `bancruit` varchar(255) DEFAULT NULL,
  `winner` varchar(100) DEFAULT NULL,
  `rounds` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `game`
--

INSERT INTO `game` (`gameID`, `serverName`, `gamePasscode`, `gameStatus`, `activePlayer`, `baseMoney`, `maxPlayers`, `time`, `timeForTour`, `tour`, `eventCode`, `logs`, `players`, `startTime`, `whosTour`, `fildsNfo`, `place`, `money`, `cards`, `trowed`, `movesCodes`, `islands`, `wealth`, `championsFild`, `bancruit`, `winner`, `rounds`) VALUES
(74, 'dsa', NULL, 2, 2, 2000000, 2, 60, 30, 26, 0, '<hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 1, 3</span><span>Gracz(dupa2) wylądował na polu innego gracza(dupa).</span><span>Koszt: 110000</span><span>Saldo gracza: 152150, przed: 262150</span><span>Saldo właściciela pola: 926750, przed: 816750</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 26</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 270000</span><span>Pieniądze: 1086750</span><span>Powodzenie!</span><span>Saldo po operacji: 816750, Majątek po operacji: 2751750</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 1, 2</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 3</span><span>Gracz(dupa2) wylądował na polu innego gracza(dupa).</span><span>Koszt: 90000</span><span>Saldo gracza: 262150, przed: 352150</span><span>Saldo właściciela pola: 1086750, przed: 996750</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 25</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 4, 1</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 996750, przed operacją: 796750</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 1, 4</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 377150, przed operacją: 177150</span><span>Gracz płaci podatek do czynszu.</span><span>Gracz(dupa2) wylądował na polu innego gracza(dupa).</span><span>Koszt: 25000</span><span>Saldo gracza: 352150, przed: 377150</span><span>Saldo właściciela pola: 796750, przed: 771750</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 24</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 3</span><span>Gracz wylądował na polu podatku!</span><span>Opłata wynosi 5% majątku (128250)</span><span>Saldo przed operacją: 900000, po operacji: 771750</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 1, 2</span><span>Gracz wylądował na polu podatku!</span><span>Opłata wynosi 5% majątku (194850)</span><span>Saldo przed operacją: 372000, po operacji: 177150</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 23</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><span>Gracz sprzedaje pola: Warszawa, Grenada o wartości: 1210000</span><span>Saldo przed operacją: -310000 Saldo po operacji: 900000<span><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 4</span><span>Gracz(dupa) wylądował na polu innego gracza(dupa2).</span><span>Koszt: 355000</span><span>Saldo gracza: -310000, przed: 45000</span><span>Saldo właściciela pola: 372000, przed: 17000</span><span class=\"L_SellMessage\">Gracz musi sprzedać pola ponieważ jest na minusie (-310000)!</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 1</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 22</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 3</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 4, 3</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 21</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 250000</span><span>Pieniądze: 295000</span><span>Powodzenie!</span><span>Saldo po operacji: 45000, Majątek po operacji: 2920000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 1</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 295000, przed operacją: 95000</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 4, 3</span><span>Gracz Wylądował na polu Mistrzostw świata!</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 20</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 3</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 440000</span><span>Pieniądze: 457000</span><span>Powodzenie!</span><span>Saldo po operacji: 17000, Majątek po operacji: 3542000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 4, 2</span></div><span>Gracz kontynuuje turę</span><div class=\"L_BuyFilds\"><p>Gracz próbuje ulepszyć pole</p><span>Cena: 360000</span><span>Pieniądze: 607000</span><span>Powodzenie!</span><span>Saldo po operacji: 457000, Majątek po operacji: 3542000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 2, 2</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 607000, przed operacją: 407000</span></div><span>Gracz kontynuuje turę</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 4, 4</span><span>Gracz wylądował na polu podatku!</span><span>Opłata wynosi 5% majątku (168000)</span><span>Saldo przed operacją: 575000, po operacji: 407000</span></div><span>Gracz kontynuuje turę</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 5</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 19</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><span>Gracz sprzedaje pola: Wenecja o wartości: 140000</span><span>Saldo przed operacją: -45000 Saldo po operacji: 95000<span><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 4</span><span>Gracz(dupa) wylądował na polu innego gracza(dupa2).</span><span>Koszt: 355000</span><span>Saldo gracza: -45000, przed: 310000</span><span>Saldo właściciela pola: 575000, przed: 220000</span><span class=\"L_SellMessage\">Gracz musi sprzedać pola ponieważ jest na minusie (-45000)!</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 2</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 18</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 5</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><span>Gracz sprzedaje pola: Pekin o wartości: 250000</span><span>Saldo przed operacją: -30000 Saldo po operacji: 220000<span><div class=\"L_MakeMove\"><span>Rzut kostkami: 2, 5</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 220000, przed operacją: 20000</span><span>Gracz płaci podatek do czynszu.</span><span>Gracz(dupa2) wylądował na polu innego gracza(dupa).</span><span>Koszt: 250000</span><span>Saldo gracza: -30000, przed: 220000</span><span>Saldo właściciela pola: 310000, przed: 60000</span><span class=\"L_SellMessage\">Gracz musi sprzedać pola ponieważ jest na minusie (-30000)!</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 17</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 1, 5</span></div><span>Gracz kontynuuje turę</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 210000</span><span>Pieniądze: 270000</span><span>Powodzenie!</span><span>Saldo po operacji: 60000, Majątek po operacji: 2825000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 6</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 270000, przed operacją: 70000</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 4</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 16</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 5</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 4</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 15</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 140000</span><span>Pieniądze: 210000</span><span>Powodzenie!</span><span>Saldo po operacji: 70000, Majątek po operacji: 2625000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 2</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 160000</span><span>Pieniądze: 180000</span><span>Powodzenie!</span><span>Saldo po operacji: 20000, Majątek po operacji: 3055000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 2, 3</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 14</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 5</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 315000, przed operacją: 115000</span><span>Gracz(dupa) wylądował na polu innego gracza(dupa2).</span><span>Koszt: 105000</span><span>Saldo gracza: 210000, przed: 315000</span><span>Saldo właściciela pola: 180000, przed: 75000</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 1</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 13</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 2, 3</span><span>Gracz używa zniżki studenckiej.</span><span>Gracz(dupa) wylądował na polu innego gracza(dupa2).</span><span>Koszt: 25000</span><span>Saldo gracza: 115000, przed: 140000</span><span>Saldo właściciela pola: 75000, przed: 50000</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 210000</span><span>Pieniądze: 260000</span><span>Powodzenie!</span><span>Saldo po operacji: 50000, Majątek po operacji: 2925000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 4</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 260000, przed operacją: 60000</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 12</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 4</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 580000</span><span>Pieniądze: 640000</span><span>Powodzenie!</span><span>Saldo po operacji: 60000, Majątek po operacji: 2725000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 3</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 11</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><span>Gracz sprzedaje pola: Grenada o wartości: 210000</span><span>Saldo przed operacją: -70000 Saldo po operacji: 140000<span><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 6</span><span>Gracz(dupa) wylądował na polu innego gracza(dupa2).</span><span>Koszt: 220000</span><span>Saldo gracza: -70000, przed: 150000</span><span>Saldo właściciela pola: 640000, przed: 420000</span><span class=\"L_SellMessage\">Gracz musi sprzedać pola ponieważ jest na minusie (-70000)!</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić wyspę</p><span>Cena: 100000</span><span>Pieniądze: 520000</span><span>Powodzenie!</span><span>Saldo po operacji: 420000</span><span>Liczba wysp: 3</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 5</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 10</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 210000</span><span>Pieniądze: 360000</span><span>Powodzenie!</span><span>Saldo po operacji: 150000, Majątek po operacji: 2775000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 4, 3</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 360000, przed operacją: 160000</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 250000</span><span>Pieniądze: 770000</span><span>Powodzenie!</span><span>Saldo po operacji: 520000, Majątek po operacji: 2505000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 2</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 770000, przed operacją: 570000</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 9</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 6</span><span>Gracz(dupa) wylądował na polu innego gracza(dupa2).</span><span>Koszt: 25000</span><span>Saldo gracza: 160000, przed: 185000</span><span>Saldo właściciela pola: 570000, przed: 545000</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 2, 6</span><span>Gracz wylądował na polu podatku!</span><span>Opłata wynosi 5% majątku (120000)</span><span>Saldo przed operacją: 665000, po operacji: 545000</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 8</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_BuyFilds\">Gracz kupił mistrzostwa świata na polu o numerze: 32</div><div class=\"L_BuyFilds\">Gracz kupuje Mistrzostwa świata!</div><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 3</span><span>Gracz Wylądował na polu Mistrzostw świata!</span></div><span>Gracz kontynuuje turę</span><div class=\"L_BuyFilds\">Gracz używa karty by wyjść na wolność!</div><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 5</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 235000, przed operacją: 35000</span><span>Gracz trafił na Bezludna wyspę!</span><span>Może zapłacić 200k, poczekać 3 tury lub użyć karty jeżeli ma.</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 710000</span><span>Pieniądze: 1375000</span><span>Powodzenie!</span><span>Saldo po operacji: 665000, Majątek po operacji: 2400000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 1</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 7</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 4</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 2</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 6</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 240000</span><span>Pieniądze: 275000</span><span>Powodzenie!</span><span>Saldo po operacji: 35000, Majątek po operacji: 2450000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 1</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje ulepszyć pole</p><span>Cena: 440000</span><span>Pieniądze: 1675000</span><span>Powodzenie!</span><span>Saldo po operacji: 1375000, Majątek po operacji: 2400000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 4, 1</span></div><span>Gracz kontynuuje turę</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 1, 1</span><span>Gracz(dupa2) wylądował na polu innego gracza(dupa).</span><span>Koszt: 125000</span><span>Saldo gracza: 1675000, przed: 1800000</span><span>Saldo właściciela pola: 275000, przed: 150000</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 5</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 4</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 210000</span><span>Pieniądze: 2010000</span><span>Powodzenie!</span><span>Saldo po operacji: 1800000, Majątek po operacji: 2225000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 3</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 2010000, przed operacją: 1810000</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 4</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 250000</span><span>Pieniądze: 400000</span><span>Powodzenie!</span><span>Saldo po operacji: 150000, Majątek po operacji: 2325000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 4, 1</span><span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: 400000, przed operacją: 200000</span></div><span>Gracz kontynuuje turę</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 1000000</span><span>Pieniądze: 1200000</span><span>Powodzenie!</span><span>Saldo po operacji: 200000, Majątek po operacji: 2125000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 3</span></div><span>Gracz kontynuuje turę</span><div class=\"L_MakeMove\"><span>Rzut kostkami: 4, 4</span><span>Gracz(dupa) wylądował na polu innego gracza(dupa2).</span><span>Koszt: 25000</span><span>Saldo gracza: 1200000, przed: 1225000</span><span>Saldo właściciela pola: 1810000, przed: 1785000</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić wyspę</p><span>Cena: 50000</span><span>Pieniądze: 1835000</span><span>Powodzenie!</span><span>Saldo po operacji: 1785000</span><span>Liczba wysp: 2</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 3, 4</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 3</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 220000</span><span>Pieniądze: 1445000</span><span>Powodzenie!</span><span>Saldo po operacji: 1225000, Majątek po operacji: 2150000</span></div><div class=\"L_BuyFilds\">Gracz kupił podróż na pole o numerze: 18Gracz otrzymuje 200k za przekroczenie startu.</div><div class=\"L_BuyFilds\">Gracz kupuje Podróż!</div><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 3</span><span>Gracz Wylądował na polu Podróży!</span></div><span>Gracz kontynuuje turę</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 500000</span><span>Pieniądze: 1795000</span><span>Powodzenie!</span><span>Saldo po operacji: 1295000, Majątek po operacji: 2000000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 1, 1</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić wyspę</p><span>Cena: 25000</span><span>Pieniądze: 1860000</span><span>Powodzenie!</span><span>Saldo po operacji: 1835000</span><span>Liczba wysp: 1</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 2, 6</span></div><hr class=\"L_tourHrEnd\"><span>Tura: 2</span><hr class=\"L_tourHrEnd\"><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa2</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 180000</span><span>Pieniądze: 1975000</span><span>Powodzenie!</span><span>Saldo po operacji: 1795000, Majątek po operacji: 2000000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 5, 4</span></div><span>Gracz kontynuuje turę</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić wyspę</p><span>Cena: 25000</span><span>Pieniądze: 2000000</span><span>Powodzenie!</span><span>Saldo po operacji: 1975000</span><span>Liczba wysp: 1</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 2, 2</span></div><hr class=\"L_tourHrNext\"><span>Tura gracza: dupa</span><div class=\"L_BuyFilds\"><p>Gracz próbuje kupić puste pole</p><span>Cena: 140000</span><span>Pieniądze: 2000000</span><span>Powodzenie!</span><span>Saldo po operacji: 1860000, Majątek po operacji: 2000000</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 6, 4</span></div><div class=\"L_MakeMove\"><span>Rzut kostkami: 0, 0</span></div>', '9:8:0:0', '14:33:11', 6, '0:0:1;0:0:1;1:3:1;1:4:1;2:0:1;2:3:1;2:3:1;2:3:1;0:0:1;1:3:1;1:3:1;1:0:1;0:0:1;2:0:1;1:2:1;2:3:1;0:0:1;2:0:1;1:2:1;2:0:1;0:0:1;0:0:1;1:3:1;1:2:1;0:0:1;1:2:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1.5', '17:7:0:0', '152150:926750:2000000:2000000', '0:   0ax1:0:0', NULL, '0:0:0:0', '3:1:0:0', '3677150:2861750:2000000:2000000', 31, '0:0:0:0', '1:Z konstruował 3 monopole.', '6:8:0:0'),
(75, '131', NULL, 1, 2, 2000000, 2, 60, 45, 1, 1, '<div class=\"L_MakeMove\"><span>Rzut kostkami: 1, 1</span></div>', '8:9:0:0', '15:11:20', 0, '0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1', '2:0:0:0', '2000000:2000000:2000000:2000000', '0:0:0:0', '11', '0:0:0:0', '0:0:0:0', '2000000:2000000:2000000:2000000', NULL, '0:0:0:0', NULL, '0:0:0:0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `passcode` varchar(255) NOT NULL,
  `theme` int(1) DEFAULT NULL,
  `inGame` int(11) DEFAULT NULL,
  `statistic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `nickname`, `mail`, `passcode`, `theme`, `inGame`, `statistic`) VALUES
(7, 'dadada', 'maciej.sikora@onet.pl', '$2y$10$hD9Icz/sDd3ioH/pKrmqOOq6C.RzVGddTZ8s.yRVWro4VuBfacDxq', 0, 0, '1.1;0:1.2;0:1.3;0:0;0:0;0:0;0'),
(8, 'dupa', 'dupa@wp.pl', '$2y$10$VvpXIto1OUSzFDl4IIn82eALjrsqKvVlg2bVycQnNYqCyatnURf2C', 0, 75, '1.3;33:0;0:0;0:1.2;12:0;0:1.1;0'),
(9, 'dupa2', 'dupa2@wp.pl', '$2y$10$mC5Ylrqz0hWDpQIAFK1GG.3pXsVnoUmh4aMu34FWybmUESHSRqwlq', 0, 75, '1.2;0:1.3;0:0;0:1.1;0:0;0:0;0'),
(10, 'dupa3', 'dupa3@dupa.com', '$2y$10$UV8Uac1owk1xNzEKA7zF9uzFmOB0z7PMNJsXnE/9OsXOEvLqFHj4q', 0, 0, '1.1;0:1.2;0:1.3;0:0;0:0;0:0;0');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `filds`
--
ALTER TABLE `filds`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gameID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `filds`
--
ALTER TABLE `filds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT dla tabeli `game`
--
ALTER TABLE `game`
  MODIFY `gameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
