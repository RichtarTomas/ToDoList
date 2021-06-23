-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 23. čen 2021, 11:47
-- Verze serveru: 10.4.14-MariaDB
-- Verze PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `todolist`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `list`
--

CREATE TABLE `list` (
  `id` int(11) NOT NULL,
  `datumZadani` date NOT NULL,
  `cinnost` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `datumUkonceni` date NOT NULL,
  `info` text COLLATE utf8_czech_ci NOT NULL,
  `login` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `splneno` char(3) COLLATE utf8_czech_ci NOT NULL DEFAULT 'NE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `list`
--

INSERT INTO `list` (`id`, `datumZadani`, `cinnost`, `datumUkonceni`, `info`, `login`, `splneno`) VALUES
(41, '2021-06-23', 'Uklidit', '2021-06-25', 'Vytřít, Umýt okna a vysát.', 'test', 'NE'),
(42, '2021-06-23', 'nakoupit', '2021-06-22', 'Jahody', 'test', 'ANO'),
(43, '2021-06-23', 'Jít na bazén', '2021-07-03', 'V Porubě od 11:00 do 13:00.', 'login', 'NE');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `login` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(60) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`login`, `heslo`) VALUES
('login', '955db0b81ef1989b4a4dfeae8061a9a6'),
('test', '955db0b81ef1989b4a4dfeae8061a9a6');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login` (`login`),
  ADD KEY `login_2` (`login`);

--
-- Klíče pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `list`
--
ALTER TABLE `list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`login`) REFERENCES `uzivatele` (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
