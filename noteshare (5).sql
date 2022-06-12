-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Cze 2021, 22:24
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `noteshare`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `textarea_content` text NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `zeszyt_id` int(11) NOT NULL DEFAULT 1,
  `code` varchar(12) NOT NULL,
  `original_user_id` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `przypomnienie` date DEFAULT '2121-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `notes`
--

INSERT INTO `notes` (`id`, `textarea_content`, `name`, `zeszyt_id`, `code`, `original_user_id`, `image`, `przypomnienie`) VALUES
(164, '', 'Nowa Notatka', 1, 'C0qPonY1', 12, '', '2100-01-01'),
(165, '', 'Nowa Notatka', 1, 'ECKU4q0m', 12, '', '2100-01-01'),
(166, '', 'Nowa Notatka', 2, 'Wej6Ul6B', 12, '', '2100-01-01'),
(167, '', 'Nowa Notatka', 1, 'FgRu9SFG', 12, '', '2100-01-01'),
(168, '', 'Notatka 1', 3, 'lKxZoc1M', 12, '', '2100-01-01'),
(169, '', 'Notatka 2', 4, 'RSXHuxGE', 12, '', '2100-01-01'),
(170, '', 'Notatka 3', 5, 'FxxBVlbd', 12, '', '2100-01-01'),
(171, '', 'Notatka bez zeszytu', 1, 'MkAZKWhB', 12, '', '2021-01-06'),
(172, '', 'Nowa Notatka', 3, 'lgXtPU8G', 13, '', '2100-01-01'),
(173, '', 'Nowa Notatka', 6, 'qIjXyfav', 13, '', '2100-01-01');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `note_access`
--

CREATE TABLE `note_access` (
  `id_note` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `note_access`
--

INSERT INTO `note_access` (`id_note`, `id_user`) VALUES
(168, 12),
(169, 12),
(170, 12),
(171, 12),
(172, 13),
(173, 13);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uploadedimage`
--

CREATE TABLE `uploadedimage` (
  `id` int(11) NOT NULL,
  `imagename` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(12, 'admin', 'qwerty123', 'admin@admin.admin'),
(13, 'tester1', 'tester123', 'tester@test.test1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zeszyty`
--

CREATE TABLE `zeszyty` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zeszyty`
--

INSERT INTO `zeszyty` (`id`, `nazwa`) VALUES
(1, 'wszystkie_notatki'),
(2, ''),
(3, 'Zeszyt 1'),
(4, 'Zeszyt 2'),
(5, 'Zeszyt 3'),
(6, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zeszyty_access`
--

CREATE TABLE `zeszyty_access` (
  `id_zeszytu` int(11) NOT NULL,
  `id_usera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zeszyty_access`
--

INSERT INTO `zeszyty_access` (`id_zeszytu`, `id_usera`) VALUES
(3, 12),
(4, 12),
(5, 12),
(6, 13);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `original_user_id` (`original_user_id`),
  ADD KEY `zeszyt_id` (`zeszyt_id`);

--
-- Indeksy dla tabeli `note_access`
--
ALTER TABLE `note_access`
  ADD KEY `id_note` (`id_note`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `uploadedimage`
--
ALTER TABLE `uploadedimage`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zeszyty`
--
ALTER TABLE `zeszyty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zeszyty_access`
--
ALTER TABLE `zeszyty_access`
  ADD KEY `id_usera` (`id_usera`),
  ADD KEY `id_zeszytu` (`id_zeszytu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT dla tabeli `uploadedimage`
--
ALTER TABLE `uploadedimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `zeszyty`
--
ALTER TABLE `zeszyty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`original_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`zeszyt_id`) REFERENCES `zeszyty` (`id`);

--
-- Ograniczenia dla tabeli `note_access`
--
ALTER TABLE `note_access`
  ADD CONSTRAINT `note_access_ibfk_1` FOREIGN KEY (`id_note`) REFERENCES `notes` (`id`),
  ADD CONSTRAINT `note_access_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `zeszyty_access`
--
ALTER TABLE `zeszyty_access`
  ADD CONSTRAINT `zeszyty_access_ibfk_1` FOREIGN KEY (`id_usera`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `zeszyty_access_ibfk_2` FOREIGN KEY (`id_zeszytu`) REFERENCES `zeszyty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
