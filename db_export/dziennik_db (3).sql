-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Cze 13, 2023 at 07:49 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dziennik_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktywnosc`
--

CREATE TABLE `aktywnosc` (
  `id` int(11) NOT NULL,
  `kartkowka` double NOT NULL,
  `sprawdzian` double NOT NULL,
  `odpowiedz` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `class`
--

CREATE TABLE `class` (
  `id` int(11) UNSIGNED NOT NULL,
  `class` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logs`
--

CREATE TABLE `logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address_ip` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `status`, `address_ip`, `created_at`) VALUES
(20, 1, 0, '127.0.0.1', '2023-06-10 13:46:36'),
(21, 1, 0, '127.0.0.1', '2023-06-10 13:56:35'),
(22, 1, 0, '127.0.0.1', '2023-06-10 14:23:23'),
(23, 2, 0, '127.0.0.1', '2023-06-10 14:28:34'),
(24, 4, 1, '127.0.0.1', '2023-06-12 18:15:12'),
(25, 4, 1, '127.0.0.1', '2023-06-12 18:36:40'),
(26, 4, 1, '127.0.0.1', '2023-06-13 18:01:51');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `aktywnosc_id` int(11) NOT NULL,
  `ocena` double DEFAULT NULL,
  `data_wystawienia` datetime DEFAULT NULL,
  `data_modyfikacji` datetime DEFAULT NULL,
  `avg` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(4) NOT NULL,
  `role` enum('uczen','nauczyciel','administrator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'uczen'),
(2, 'nauczyciel'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT 1,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `class_id`, `email`, `role_id`, `firstName`, `lastName`, `birthday`, `password`, `logo`, `created_at`) VALUES
(1, 2, 'marcin@wp.pl', 1, 'Marcin', 'Kuras', '2001-07-15', 'marcin123', '123', '2023-06-10 13:30:41'),
(2, 8, 'piotr@wp.pl', 3, 'Piotr', 'Kowalski', '2001-07-15', 'piotr123', '', '2023-06-10 14:28:06'),
(4, 8, 'bak@wp.pl', 3, 'Marek', 'Bąk', '2001-01-01', '$argon2id$v=19$m=65536,t=4,p=1$NVE5SG1rSHYzYmQ3QjVGUA$fGXMMpXaL11ScaTekFn/SDCS+nltRqd3oVPm50Nymnw', '', '2023-06-12 18:14:51');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aktywnosc`
--
ALTER TABLE `aktywnosc`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_aktywnosc_id` (`aktywnosc_id`),
  ADD KEY `fk_oceny_user_id` (`user_id`),
  ADD KEY `idx_oceny_role_id` (`role_id`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktywnosc`
--
ALTER TABLE `aktywnosc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `oceny`
--
ALTER TABLE `oceny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `fk_oceny_aktywnosc_id` FOREIGN KEY (`aktywnosc_id`) REFERENCES `aktywnosc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_oceny_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_oceny_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
