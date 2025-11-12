-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Pritësi (host): 127.0.0.1
-- Koha e gjenerimit: Nën 12, 2025 në 11:27 MD
-- Versioni i serverit: 10.4.32-MariaDB
-- PHP Versioni: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databaza: `gamee`
--

-- --------------------------------------------------------

--
-- Struktura e tabelës për tabelën `loja`
--

CREATE TABLE `loja` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `emer` varchar(200) NOT NULL,
  `mbiemer` varchar(200) NOT NULL,
  `shtet` varchar(200) NOT NULL,
  `qytet` varchar(200) NOT NULL,
  `kafsh` varchar(200) NOT NULL,
  `send` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zbraz të dhënat për tabelën `loja`
--

INSERT INTO `loja` (`id`, `user_id`, `emer`, `mbiemer`, `shtet`, `qytet`, `kafsh`, `send`) VALUES
(12, 8, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf'),
(13, 8, 'iuhj', 'iujk', 'hgj', 'hjn', 'hj', 'kjh'),
(14, 6, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf'),
(15, 9, 'moli', 'moli', 'moli', 'moli', 'moli', 'moli'),
(16, 9, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf'),
(17, 9, 'oo', 'oo', 'oo', 'oo', 'oo', 'oo');

-- --------------------------------------------------------

--
-- Struktura e tabelës për tabelën `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `username` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = regular user, 1 = admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zbraz të dhënat për tabelën `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `surname`, `email`, `password`, `is_admin`) VALUES
(6, 'sara', 'sara', 'sara', 'sara@sara.com', 'sarasara', 1),
(7, 'dulla', 'dulla', 'simnica', 'dulla@outlook.com', 'dulla1234', 0),
(8, 'saraaa', 'saraa', 'saraa', 'sarah@sara.com', 'saraa123', 0),
(9, 'moli', 'moli', 'moli', 'moli@moli.com', 'molimoli', 0);

--
-- Indekset për tabelat e hedhura
--

--
-- Indekset për tabelë `loja`
--
ALTER TABLE `loja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_loja_user` (`user_id`);

--
-- Indekset për tabelë `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT për tabelat e hedhura
--

--
-- AUTO_INCREMENT për tabelë `loja`
--
ALTER TABLE `loja`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT për tabelë `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Detyrimet për tabelat e hedhura
--

--
-- Detyrimet për tabelën `loja`
--
ALTER TABLE `loja`
  ADD CONSTRAINT `fk_loja_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
