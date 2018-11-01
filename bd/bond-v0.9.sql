-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Nov-2018 às 02:51
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bond`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comment`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comments`
--

INSERT INTO `comments` (`id_comment`, `user`, `post`, `comment_text`, `r_date`) VALUES
(1, 1, 1, 'Sigam as regras \"Ã©ticas\" e tenham um bom dia!', '2018-10-28 20:15:24'),
(2, 1, 1, 'Se alguÃ©m quiser jogar rpg me chama!', '2018-10-28 20:20:26'),
(3, 2, 2, 'Pode ser, vocÃª tem grupo?', '2018-10-28 20:23:30'),
(4, 2, 2, 'Se tiver me fala', '2018-10-28 20:25:01'),
(5, 1, 4, 'Seja bem vindo entÃ£o', '2018-10-28 20:25:24'),
(6, 1, 2, 'Tenho nÃ£o, mas tenho interesse em jogar', '2018-10-28 20:26:00'),
(7, 3, 4, 'OlÃ¡, tambÃ©m sou', '2018-10-28 20:28:35'),
(8, 3, 4, 'Pq vc usa essa foto de perfil?', '2018-10-28 20:29:04'),
(9, 3, 2, 'Eu tenho', '2018-10-28 20:29:29'),
(10, 2, 4, 'Pq eu quero', '2018-10-28 20:33:59'),
(11, 3, 4, ' aposto q joga de bÃ¡rbaro e anÃ£o!', '2018-10-28 20:41:11'),
(12, 2, 4, 'afs', '2018-10-28 20:41:33'),
(13, 1, 4, 'poxa', '2018-10-28 20:45:46'),
(14, 3, 4, 'poxa nada', '2018-10-28 20:55:19'),
(15, 1, 4, '.', '2018-10-28 20:58:41'),
(16, 3, 4, 'blz', '2018-10-28 21:00:16'),
(17, 1, 4, 'x', '2018-10-28 21:02:22'),
(18, 4, 4, '.', '2018-10-28 21:05:55'),
(19, 1, 4, 'quem Ã© bruno?', '2018-10-28 21:10:15'),
(20, 1, 4, 'quem Ã© bruno?', '2018-10-28 21:10:47'),
(21, 1, 5, 'NÃ£o dÃ¡ pra trocar', '2018-10-28 22:02:07'),
(22, 3, 5, 'ah', '2018-10-28 22:02:38'),
(23, 3, 2, 'Podemos entrar?', '2018-10-28 22:12:27'),
(24, 1, 2, 'Digo, podemos entrar no seu grupo, Ana?', '2018-10-28 22:13:19'),
(25, 3, 2, 'Claro', '2018-10-28 22:15:05'),
(26, 3, 1, 'Vlw ^ ^', '2018-10-28 22:26:34'),
(27, 3, 1, 'RPG atÃ© aqui? kk', '2018-10-28 22:29:13'),
(28, 2, 6, '.', '2018-10-28 22:29:44'),
(29, 2, 1, '.', '2018-10-28 22:30:16'),
(30, 3, 1, '.Â²', '2018-10-28 22:31:20'),
(31, 1, 6, 'x', '2018-10-31 20:32:52'),
(32, 5, 1, 'fala tu', '2018-10-31 21:39:04'),
(33, 1, 5, 'Agora dÃ¡, troquei', '2018-10-31 22:15:39'),
(34, 1, 5, 'Se nÃ£o gostar novamente, Ã© problema teu', '2018-10-31 22:15:55'),
(35, 3, 5, 'afs', '2018-10-31 22:19:00'),
(36, 2, 5, 'kkkkkkkkk', '2018-10-31 22:19:21'),
(37, 2, 8, 'Vlw!', '2018-10-31 22:20:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `communities`
--

CREATE TABLE IF NOT EXISTS `communities` (
  `id_community` int(11) NOT NULL AUTO_INCREMENT,
  `community_name` varchar(100) NOT NULL,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(200) DEFAULT 'assets/img/default-community-icon.png',
  `community_description` varchar(500) DEFAULT NULL,
  `members` int(11) DEFAULT '0',
  PRIMARY KEY (`id_community`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `communities`
--

INSERT INTO `communities` (`id_community`, `community_name`, `r_date`, `profile_pic`, `community_description`, `members`) VALUES
(1, 'IF da DepressÃ£o', '2018-10-28 20:14:37', 'assets/upload/img/15410347965bda532c9f924.jpg', '..', 3),
(2, 'RPG de Mesa', '2018-10-28 20:18:36', 'assets/upload/img/15410349165bda53a4ebc41.jpg', 'Comunidade para jogadores de rpg', 4),
(3, 'Esparta', '2018-10-31 21:54:08', 'assets/upload/img/15410336485bda4eb079834.jpg', 'THIS IS SPARTA!!', 2),
(4, 'Skatistas', '2018-10-31 22:17:48', 'assets/upload/img/15410350855bda544de74f6.jpg', 'Comunidade para Skatistas ao redor do globo', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `is_part_of`
--

CREATE TABLE IF NOT EXISTS `is_part_of` (
  `id_is_part_of` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `community` int(11) NOT NULL,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_is_part_of`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `is_part_of`
--

INSERT INTO `is_part_of` (`id_is_part_of`, `user`, `community`, `r_date`) VALUES
(2, 1, 2, '2018-10-28 20:18:36'),
(3, 2, 1, '2018-10-28 20:22:36'),
(4, 2, 2, '2018-10-28 20:22:48'),
(7, 3, 2, '2018-10-28 20:30:10'),
(8, 4, 2, '2018-10-28 21:05:45'),
(9, 3, 1, '2018-10-28 22:26:19'),
(10, 1, 1, '2018-10-31 21:48:55'),
(16, 5, 3, '2018-10-31 22:03:03'),
(18, 3, 4, '2018-10-31 22:18:17'),
(19, 2, 4, '2018-10-31 22:20:08'),
(20, 1, 3, '2018-10-31 22:26:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  PRIMARY KEY (`id_like`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `likes`
--

INSERT INTO `likes` (`id_like`, `user`, `post`) VALUES
(1, 1, 1),
(2, 1, 2),
(5, 2, 2),
(6, 2, 4),
(8, 1, 4),
(10, 3, 2),
(11, 3, 1),
(12, 1, 5),
(14, 3, 4),
(15, 2, 6),
(16, 5, 2),
(17, 5, 1),
(18, 5, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manages`
--

CREATE TABLE IF NOT EXISTS `manages` (
  `id_manage` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `community` int(11) NOT NULL,
  `role` enum('owner','admin') DEFAULT 'owner',
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_manage`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `manages`
--

INSERT INTO `manages` (`id_manage`, `user`, `community`, `role`, `r_date`) VALUES
(1, 5, 3, 'owner', '2018-10-31 21:54:08'),
(2, 1, 1, 'owner', '2018-10-31 22:12:48'),
(3, 1, 2, 'owner', '2018-10-31 22:14:07'),
(4, 3, 4, 'owner', '2018-10-31 22:17:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `community` int(11) DEFAULT NULL,
  `type` enum('like','comment','new_post','join','comment_another','comment_own') NOT NULL,
  `acting_user` int(11) NOT NULL,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `seen` enum('y','n') DEFAULT 'n',
  PRIMARY KEY (`id_notification`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `notifications`
--

INSERT INTO `notifications` (`id_notification`, `user`, `post`, `community`, `type`, `acting_user`, `r_date`, `seen`) VALUES
(3, 3, 4, 2, 'comment_another', 4, '2018-10-28 21:05:55', 'y'),
(5, 3, 4, 2, 'comment_another', 1, '2018-10-28 21:10:15', 'y'),
(8, 3, 4, 2, 'comment_another', 1, '2018-10-28 21:10:47', 'y'),
(10, 3, 5, 2, 'like', 1, '2018-10-28 22:01:40', 'y'),
(11, 3, 5, 2, 'comment', 1, '2018-10-28 22:02:07', 'y'),
(13, 4, 5, 2, 'comment_another', 1, '2018-10-28 22:02:08', 'y'),
(14, 1, 2, 2, 'comment', 3, '2018-10-28 22:12:27', 'y'),
(16, 4, 2, 2, 'comment_another', 3, '2018-10-28 22:12:27', 'y'),
(18, 3, 2, 2, 'comment_own', 1, '2018-10-28 22:13:20', 'y'),
(19, 4, 2, 2, 'comment_own', 1, '2018-10-28 22:13:20', 'y'),
(20, 1, 2, 2, 'comment', 3, '2018-10-28 22:15:05', 'y'),
(22, 4, 2, 2, 'comment_another', 3, '2018-10-28 22:15:05', 'y'),
(25, 1, 1, 1, 'comment', 3, '2018-10-28 22:26:34', 'y'),
(27, 4, 1, 1, 'comment_another', 3, '2018-10-28 22:26:34', 'y'),
(28, 1, 1, 1, 'comment', 3, '2018-10-28 22:29:13', 'y'),
(29, 3, 6, 1, 'like', 2, '2018-10-28 22:29:35', 'y'),
(30, 3, 6, 1, 'comment', 2, '2018-10-28 22:29:44', 'y'),
(31, 1, 1, 1, 'comment', 2, '2018-10-28 22:30:16', 'y'),
(32, 3, 1, 1, 'comment_another', 2, '2018-10-28 22:30:16', 'y'),
(33, 1, 1, 1, 'comment', 3, '2018-10-28 22:31:20', 'y'),
(34, 2, 1, 1, 'comment_another', 3, '2018-10-28 22:31:20', 'y'),
(35, 3, 6, 1, 'comment', 1, '2018-10-31 20:32:52', 'y'),
(36, 2, 6, 1, 'comment_another', 1, '2018-10-31 20:32:52', 'y'),
(37, 1, 2, 2, 'like', 5, '2018-10-31 21:38:53', 'y'),
(38, 1, 1, 1, 'like', 5, '2018-10-31 21:38:55', 'y'),
(39, 1, 1, 1, 'comment', 5, '2018-10-31 21:39:04', 'y'),
(40, 3, 1, 1, 'comment_another', 5, '2018-10-31 21:39:04', 'y'),
(41, 2, 1, 1, 'comment_another', 5, '2018-10-31 21:39:04', 'y'),
(42, 3, 5, 2, 'comment', 1, '2018-10-31 22:15:39', 'y'),
(43, 3, 5, 2, 'comment', 1, '2018-10-31 22:15:55', 'y'),
(44, 1, 5, 2, 'comment_own', 3, '2018-10-31 22:19:01', 'n'),
(45, 2, 5, 2, 'comment_own', 3, '2018-10-31 22:19:01', 'n'),
(46, 4, 5, 2, 'comment_own', 3, '2018-10-31 22:19:01', 'n'),
(47, 5, 5, 2, 'comment_own', 3, '2018-10-31 22:19:01', 'n'),
(48, 3, 5, 2, 'comment', 2, '2018-10-31 22:19:21', 'n'),
(49, 1, 5, 2, 'comment_another', 2, '2018-10-31 22:19:21', 'n'),
(50, 3, 8, 4, 'comment', 2, '2018-10-31 22:20:18', 'n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `community` int(11) NOT NULL,
  `post_text` text NOT NULL,
  `post_pic` varchar(200) DEFAULT NULL,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `likes` int(11) DEFAULT '0',
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id_post`, `user`, `community`, `post_text`, `post_pic`, `r_date`, `likes`) VALUES
(1, 1, 1, 'Sejam todos bem vindos', NULL, '2018-10-28 20:14:49', 3),
(2, 1, 2, 'OlÃ¡, se alguÃ©m quiser jogar RPG fale comigo.', NULL, '2018-10-28 20:19:02', 4),
(4, 2, 2, 'OlÃ¡, sou novo aqui', NULL, '2018-10-28 20:23:18', 3),
(5, 3, 2, 'NÃ£o gostei da imagem de perfil', NULL, '2018-10-28 20:33:30', 1),
(6, 3, 1, 'Iae', NULL, '2018-10-28 22:26:25', 1),
(7, 5, 3, 'LET\'S DO IT! WARRIORS!', NULL, '2018-10-31 22:01:49', 1),
(8, 3, 4, 'Sejam todos bem vindos!', NULL, '2018-10-31 22:18:37', 0),
(9, 1, 3, 'toma vergonha', NULL, '2018-10-31 22:26:41', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `birthday` date NOT NULL,
  `profile_pic` varchar(200) DEFAULT 'assets/img/default-user-icon.png',
  `passwd` varchar(32) NOT NULL,
  `r_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` enum('M','F','O') DEFAULT NULL,
  `stars` int(11) DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `first_name`, `last_name`, `birthday`, `profile_pic`, `passwd`, `r_date`, `gender`, `stars`) VALUES
(1, 'mag', 'Carlos Magno', 'Nascimento', '2002-04-11', 'assets/upload/img/15410324805bda4a203daaa.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 20:11:04', 'M', 7),
(2, 'joao', 'JoÃ£o', 'Pinto Grande', '1979-12-21', 'assets/upload/img/15410325555bda4a6b337b0.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 20:22:01', 'M', 3),
(3, 'ana', 'Ana', 'Clara', '2000-01-31', 'assets/upload/img/15410324085bda49d8957e8.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 20:27:45', 'F', 2),
(4, 'bruno', 'Bruno', 'Barbosa', '1999-11-11', 'assets/upload/img/15410325115bda4a3f8621d.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 21:05:00', 'O', 0),
(5, 'carlito', 'Carlito', 'Gladiador', '2000-09-27', 'assets/upload/img/15410327155bda4b0b70ef0.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-31 21:37:13', 'M', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
