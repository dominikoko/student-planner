-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Cze 2017, 20:19
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `finanse`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `baza`
--

CREATE TABLE `baza` (
  `id` int(11) NOT NULL,
  `rodzaj` text COLLATE utf8_polish_ci NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `kwota` int(11) NOT NULL,
  `data` text COLLATE utf8_polish_ci NOT NULL,
  `kategoria` text COLLATE utf8_polish_ci NOT NULL,
  `komentarz` text COLLATE utf8_polish_ci NOT NULL,
  `userId` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `baza`
--

INSERT INTO `baza` (`id`, `rodzaj`, `nazwa`, `kwota`, `data`, `kategoria`, `komentarz`, `userId`) VALUES
(21, 'WYDATEK', 'Kino', 50, '2017-06-15', 'Rozrywka', 'Noce i dnie', 10),
(22, 'WYDATEK', 'Skarpetki', 20, '2017-06-01', 'Ubrania', '', 10),
(24, 'WYDATEK', 'Bilet miesieczny', 50, '2017-06-14', 'Rachunki', 'za czerwiec', 10),
(25, 'DOCHOD', 'Praca', 500, '2017-06-10', 'praca', '', 10),
(26, 'DOCHOD', 'Stypedium socjalne', 500, '2017-06-20', 'stypendium', 'za czerwiec', 10),
(27, 'DOCHOD', 'Praca', 200, '', 'Premia', 'za dobre wyniki', 10),
(28, 'DOCHOD', 'Urodziny', 100, '2017-06-05', 'prezent', 'od babci', 10),
(29, 'WYDATEK', 'Rower', 800, '2017-06-09', 'Rachunki', '', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`) VALUES
(7, 'Tomasz', 'Kowalski', 'tomasz@gmail.com', 'admin123'),
(10, 'Aleksandra', 'Kowalska', 'olkowa@mail.com', 'cdaf11b5f7dc46a83267a787133b2447');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `baza`
--
ALTER TABLE `baza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserBaza` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `baza`
--
ALTER TABLE `baza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `baza`
--
ALTER TABLE `baza`
  ADD CONSTRAINT `FK_UserBaza` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
