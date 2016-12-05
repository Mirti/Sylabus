-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Gru 2016, 13:20
-- Wersja serwera: 10.1.19-MariaDB
-- Wersja PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sylabusy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `efekt`
--

CREATE TABLE `efekt` (
  `efekt_id` int(11) NOT NULL,
  `kod` varchar(10) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `efekt`
--

INSERT INTO `efekt` (`efekt_id`, `kod`, `opis`) VALUES
(1, 'EK_01', 'Efekt1'),
(2, 'EK_02', 'Efekt 2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prowadzacy`
--

CREATE TABLE `prowadzacy` (
  `prowadzacy_id` int(11) NOT NULL,
  `imie` varchar(15) NOT NULL,
  `nazwisko` varchar(15) NOT NULL,
  `stopien` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `www` varchar(25) NOT NULL,
  `login` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `prowadzacy`
--

INSERT INTO `prowadzacy` (`prowadzacy_id`, `imie`, `nazwisko`, `stopien`, `email`, `telefon`, `www`, `login`, `password`) VALUES
(1, 'Wiesław', 'Paja', 'dr', 'wpaja@ur.edu.pl', '123324', 'wpaja.pl', 'wpaja', 'paja'),
(2, 'Piotr', 'Lasek', 'dr', 'plasek@ur.edu.pl', '213124213', 'lasek.pl', 'plasek', 'lasek'),
(3, 'Zbigniew', 'Suraj', 'prof.', 'zsuraj@ur.edu.pl', '23123124123', 'www.suraj.pl', 'zsuraj', 'suraj'),
(4, 'Andrzej', 'Nowak', 'dr. ', 'anowak@o2.pl', '21312323', 'anowak.pl', 'anowak', 'nowak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiot`
--

CREATE TABLE `przedmiot` (
  `przedmiot_id` int(11) NOT NULL,
  `nazwa` varchar(35) NOT NULL,
  `rocznik_id` int(11) DEFAULT NULL,
  `semestr` int(11) NOT NULL,
  `ECTS` int(11) NOT NULL,
  `liczba_godzin` int(11) NOT NULL,
  `sposob_zaliczenia` set('egzamin','ocena','zaliczenie','') NOT NULL,
  `typ_zajec` set('wykład','labolatorium','ćwiczenia','seminarium') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `przedmiot`
--

INSERT INTO `przedmiot` (`przedmiot_id`, `nazwa`, `rocznik_id`, `semestr`, `ECTS`, `liczba_godzin`, `sposob_zaliczenia`, `typ_zajec`) VALUES
(1, 'Tworzenie GUI', 1, 7, 4, 30, 'egzamin', 'wykład'),
(2, 'Uprawa świń', 2, 3, 33, 22, 'zaliczenie', 'labolatorium');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiot_efekt`
--

CREATE TABLE `przedmiot_efekt` (
  `przedmiot_id` int(11) DEFAULT NULL,
  `efekt_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `przedmiot_efekt`
--

INSERT INTO `przedmiot_efekt` (`przedmiot_id`, `efekt_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiot_prowadzacy`
--

CREATE TABLE `przedmiot_prowadzacy` (
  `przedmiot_id` int(11) DEFAULT NULL,
  `prowadzacy_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `przedmiot_prowadzacy`
--

INSERT INTO `przedmiot_prowadzacy` (`przedmiot_id`, `prowadzacy_id`) VALUES
(1, 2),
(1, 4),
(2, 4),
(1, 3),
(1, 2),
(1, 4),
(2, 2),
(1, 4),
(2, 1),
(2, 4),
(2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rocznik`
--

CREATE TABLE `rocznik` (
  `rocznik_id` int(11) NOT NULL,
  `kierunek` varchar(35) NOT NULL,
  `rok` set('I','II','III','IV','V') NOT NULL,
  `tryb` set('stacjonarne','niestacjonarne','','') NOT NULL,
  `wydzial_id` int(11) DEFAULT NULL,
  `opiekun` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `rocznik`
--

INSERT INTO `rocznik` (`rocznik_id`, `kierunek`, `rok`, `tryb`, `wydzial_id`, `opiekun`) VALUES
(1, 'Informatyka', 'III', 'stacjonarne', 1, 'dr. Katarzyna Garwol'),
(2, 'Rolnictwo', 'II', 'niestacjonarne', 2, 'dr. Andrzej Nowak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydzial`
--

CREATE TABLE `wydzial` (
  `wydzial_id` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `wydzial`
--

INSERT INTO `wydzial` (`wydzial_id`, `nazwa`) VALUES
(1, 'Matematyczno-Przyrodniczy'),
(2, 'Biologiczno-Rolniczy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wymaganie`
--

CREATE TABLE `wymaganie` (
  `wymaganie_id` int(11) NOT NULL,
  `nazwa` text NOT NULL,
  `sposob_sprawdzenia` set('kolokwium','odpowiedź_ustna','projekt','referat','inne') NOT NULL,
  `przedmiot_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `efekt`
--
ALTER TABLE `efekt`
  ADD PRIMARY KEY (`efekt_id`);

--
-- Indexes for table `prowadzacy`
--
ALTER TABLE `prowadzacy`
  ADD PRIMARY KEY (`prowadzacy_id`);

--
-- Indexes for table `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD PRIMARY KEY (`przedmiot_id`),
  ADD KEY `rocznik_id` (`rocznik_id`);

--
-- Indexes for table `przedmiot_efekt`
--
ALTER TABLE `przedmiot_efekt`
  ADD KEY `przedmiot_id` (`przedmiot_id`,`efekt_id`),
  ADD KEY `przedmiot_efekt_ibfk_2` (`efekt_id`);

--
-- Indexes for table `przedmiot_prowadzacy`
--
ALTER TABLE `przedmiot_prowadzacy`
  ADD KEY `przedmiot_id` (`przedmiot_id`),
  ADD KEY `prowadzacy_id` (`prowadzacy_id`);

--
-- Indexes for table `rocznik`
--
ALTER TABLE `rocznik`
  ADD PRIMARY KEY (`rocznik_id`),
  ADD KEY `rocznik_id` (`rocznik_id`),
  ADD KEY `wydzial_id` (`wydzial_id`),
  ADD KEY `rocznik_id_2` (`rocznik_id`);

--
-- Indexes for table `wydzial`
--
ALTER TABLE `wydzial`
  ADD PRIMARY KEY (`wydzial_id`);

--
-- Indexes for table `wymaganie`
--
ALTER TABLE `wymaganie`
  ADD PRIMARY KEY (`wymaganie_id`),
  ADD KEY `przedmiot_id` (`przedmiot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `efekt`
--
ALTER TABLE `efekt`
  MODIFY `efekt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `prowadzacy`
--
ALTER TABLE `prowadzacy`
  MODIFY `prowadzacy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  MODIFY `przedmiot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `rocznik`
--
ALTER TABLE `rocznik`
  MODIFY `rocznik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `wydzial`
--
ALTER TABLE `wydzial`
  MODIFY `wydzial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `wymaganie`
--
ALTER TABLE `wymaganie`
  MODIFY `wymaganie_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD CONSTRAINT `przedmiot_ibfk_1` FOREIGN KEY (`rocznik_id`) REFERENCES `rocznik` (`rocznik_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `przedmiot_efekt`
--
ALTER TABLE `przedmiot_efekt`
  ADD CONSTRAINT `przedmiot_efekt_ibfk_1` FOREIGN KEY (`przedmiot_id`) REFERENCES `przedmiot` (`przedmiot_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `przedmiot_efekt_ibfk_2` FOREIGN KEY (`efekt_id`) REFERENCES `efekt` (`efekt_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `przedmiot_prowadzacy`
--
ALTER TABLE `przedmiot_prowadzacy`
  ADD CONSTRAINT `przedmiot_prowadzacy_ibfk_1` FOREIGN KEY (`przedmiot_id`) REFERENCES `przedmiot` (`przedmiot_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `przedmiot_prowadzacy_ibfk_2` FOREIGN KEY (`prowadzacy_id`) REFERENCES `prowadzacy` (`prowadzacy_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `rocznik`
--
ALTER TABLE `rocznik`
  ADD CONSTRAINT `rocznik_ibfk_1` FOREIGN KEY (`wydzial_id`) REFERENCES `wydzial` (`wydzial_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `wymaganie`
--
ALTER TABLE `wymaganie`
  ADD CONSTRAINT `wymaganie_ibfk_1` FOREIGN KEY (`przedmiot_id`) REFERENCES `przedmiot` (`przedmiot_id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
