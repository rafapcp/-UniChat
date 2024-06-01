-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 24/05/2024 às 03:45
-- Versão do servidor: 10.5.20-MariaDB
-- Versão do PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id22212873_unichat`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chats`
--

INSERT INTO `chats` (`chat_id`, `from_id`, `to_id`, `message`, `opened`, `created_at`) VALUES
(1, 2, 1, 'Opa\n', 1, '2024-05-07 08:00:46'),
(2, 1, 2, 'Tranquilo??\n', 1, '2024-05-07 08:01:26'),
(3, 2, 1, 'Fala comigo\n', 1, '2024-05-07 08:01:45'),
(4, 1, 2, 'PArtiu?\n\n', 1, '2024-05-07 08:01:53'),
(5, 2, 1, 's2\n', 1, '2024-05-07 08:02:03'),
(6, 1, 2, 'boa\n', 1, '2024-05-09 09:13:12'),
(7, 1, 3, 'Opa\n', 1, '2024-05-09 11:23:31'),
(8, 1, 3, 'Tranquilo\n', 1, '2024-05-09 11:23:40'),
(9, 3, 1, 'Oi andre', 1, '2024-05-09 11:23:58'),
(10, 1, 2, 'Macaco\n\n', 1, '2024-05-09 13:47:18'),
(11, 1, 2, 'Seu porra\n', 1, '2024-05-09 13:47:40'),
(12, 1, 2, 'Vagabundo!!!\n', 1, '2024-05-13 20:53:48'),
(13, 2, 1, 'Viado!!!!!!!!!!!', 1, '2024-05-13 20:54:06'),
(14, 1, 3, ' Bom dia', 1, '2024-05-14 09:23:59'),
(15, 3, 5, 'Boa', 1, '2024-05-14 11:09:44'),
(16, 1, 3, 'Boa tarde', 1, '2024-05-14 12:25:02'),
(17, 3, 2, 'Opa\n', 1, '2024-05-16 09:16:13'),
(18, 4, 1, 'Opa\n', 1, '2024-05-20 14:15:17'),
(19, 6, 4, 'fala, meu patrão', 1, '2024-05-21 01:39:15'),
(20, 7, 4, 'salve', 1, '2024-05-21 12:17:18'),
(21, 8, 4, 'Saulin saulin, vamos tirar tu daí emmm\n', 1, '2024-05-21 12:20:55'),
(26, 9, 4, 'Oi', 1, '2024-05-21 12:31:55'),
(27, 10, 6, 'Oi rs', 0, '2024-05-21 12:32:40'),
(28, 10, 6, 'gostoso\n', 0, '2024-05-21 12:35:00'),
(29, 10, 6, 'sdds\n', 0, '2024-05-21 12:35:07'),
(30, 10, 6, 'fiu fiu', 0, '2024-05-21 12:35:14'),
(31, 11, 5, 'slv\n', 1, '2024-05-24 03:34:34'),
(32, 5, 11, 'Slv\n', 1, '2024-05-24 03:34:43'),
(33, 11, 5, 'me mama?\n', 1, '2024-05-24 03:35:03'),
(34, 1, 4, 'Ei\n', 0, '2024-05-24 03:43:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `user_1`, `user_2`) VALUES
(1, 2, 1),
(2, 1, 3),
(3, 3, 5),
(4, 3, 2),
(5, 4, 1),
(6, 6, 4),
(7, 7, 4),
(8, 8, 4),
(9, 9, 4),
(10, 10, 6),
(11, 11, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `p_p` varchar(255) DEFAULT 'user-default.png',
  `last_seen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `p_p`, `last_seen`) VALUES
(1, 'Andre', 'dede', '$2y$10$uOej9F3vJ5zqUqFxtFxeSuYa7DrT2Rk8LBOCloHgQIAHJEJHeh4Jq', 'dede.jpeg', '2024-05-24 03:43:27'),
(2, 'Rafael', 'Rafuxo', '$2y$10$zB5q4KnOEYuuIg9rYaQuPu0YgmNwqzE2vJ3Uvj70UMne9zZRm6qQ.', 'Rafuxo.jpg', '2024-05-16 09:16:26'),
(3, 'Jean', 'jean', '$2y$10$b4JQNNzZC/eWWRTerFnoC.SMH138TZFcU0TaLtOf7VC/ur3yeYDLG', 'jean.jpeg', '2024-05-16 09:16:15'),
(4, 'saulo', 'saulo', '$2y$10$zDxYHI3l.fh7Ilu2V563juj7M7tCEa3OygJxw..enQOQJ.kU7jLHS', 'saulo.jpg', '2024-05-24 03:31:27'),
(5, 'Gabriel', 'Gabs', '$2y$10$4MkU1KT5Jvivs0LfwEaJvOzFxceGpEf7hESsMo6KnTbD7cbj0V5Y6', 'Gabs.jpg', '2024-05-24 03:42:43'),
(6, 'Samuel De Lucas Silva ', 'SamuelGia38', '$2y$10$98WQJO5YSjlogju0WbufWe.LtNFPXfeEymVxMPKk6bzfiYslZD5Q2', 'user-default.png', '2024-05-21 01:40:11'),
(8, 'Denzel', 'dpsilva', '$2y$10$Te//yjQXYH5mssThN2Wl3empmxct32fK.VU.BeYw/zat2BWZS3MBG', 'user-default.png', '2024-05-21 12:22:22'),
(9, 'Valdimir', 'Val', '$2y$10$Npijme7wwDslikD/BcdP8u8Gs5eF2zcCUeyPgeH6DZYVGZ9i.w4DW', 'user-default.png', '2024-05-21 12:33:25'),
(11, 'pcpzin', 'pcp', '$2y$10$zmQ4ofyvyAdJC8l.qaNZluQUwSddMRKPqLkC5vHhO1e32kqhvrM2i', 'user-default.png', '2024-05-24 03:41:47');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Índices de tabela `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
