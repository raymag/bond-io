-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Nov-2018 às 22:33
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
-- Database: `magno_bond`
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

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
(37, 2, 8, 'Vlw!', '2018-10-31 22:20:18'),
(38, 1, 2, 'show', '2018-11-02 22:03:10'),
(39, 1, 7, 'Eu nÃ£o', '2018-11-02 22:15:01'),
(40, 4, 13, '.', '2018-11-02 23:37:56'),
(41, 4, 13, '..', '2018-11-02 23:40:58'),
(42, 4, 13, 'Kkkk', '2018-11-02 23:41:18'),
(43, 6, 9, 'Que isso? kk', '2018-11-02 23:42:33'),
(44, 6, 9, '.', '2018-11-02 23:52:06'),
(45, 6, 9, '..', '2018-11-02 23:52:31'),
(46, 6, 9, 'x', '2018-11-02 23:53:24'),
(47, 1, 9, 'Q', '2018-11-02 23:53:49'),
(48, 6, 9, 'x', '2018-11-02 23:56:11'),
(49, 6, 9, '.\r\n', '2018-11-02 23:56:27'),
(50, 6, 9, '....', '2018-11-02 23:56:37'),
(51, 1, 9, 'Para com isso, poar', '2018-11-02 23:57:19'),
(52, 6, 9, 'eu n', '2018-11-02 23:57:52'),
(53, 3, 1, 'pq fala tu?', '2018-11-02 23:58:48'),
(54, 3, 1, 'eim', '2018-11-03 00:01:08'),
(55, 3, 1, 'Responde!', '2018-11-03 00:05:18'),
(56, 5, 1, 'Eu nÃ£o', '2018-11-03 00:05:52'),
(57, 3, 9, '.', '2018-11-03 15:22:57'),
(58, 3, 9, '.', '2018-11-03 15:25:38'),
(59, 3, 4, 'NinguÃ©m sabe', '2018-11-04 14:21:02'),
(60, 3, 4, 'E ele tbm n diz\r\n', '2018-11-04 14:21:40'),
(61, 3, 4, '.', '2018-11-04 19:02:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `communities`
--

INSERT INTO `communities` (`id_community`, `community_name`, `r_date`, `profile_pic`, `community_description`, `members`) VALUES
(1, 'IF da DepressÃ£o', '2018-10-28 20:14:37', 'assets/upload/img/15410347965bda532c9f924.jpg', '..', 3),
(2, 'RPG de Mesa', '2018-10-28 20:18:36', 'assets/upload/img/15410349165bda53a4ebc41.jpg', 'Comunidade para jogadores de rpg', 4),
(3, 'Esparta', '2018-10-31 21:54:08', 'assets/upload/img/15410336485bda4eb079834.jpg', 'THIS IS SPARTA!!', 2),
(4, 'Skatistas', '2018-10-31 22:17:48', 'assets/upload/img/15410350855bda544de74f6.jpg', 'Comunidade para Skatistas ao redor do globo', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `follows`
--

CREATE TABLE IF NOT EXISTS `follows` (
  `id_follows` int(11) NOT NULL AUTO_INCREMENT,
  `follower` int(11) NOT NULL,
  `following` int(11) NOT NULL,
  PRIMARY KEY (`id_follows`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `follows`
--

INSERT INTO `follows` (`id_follows`, `follower`, `following`) VALUES
(17, 5, 1),
(18, 1, 5),
(19, 4, 1),
(21, 3, 1),
(23, 3, 6),
(24, 1, 3),
(26, 2, 1),
(29, 6, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `is_part_of`
--

INSERT INTO `is_part_of` (`id_is_part_of`, `user`, `community`, `r_date`) VALUES
(2, 1, 2, '2018-10-28 20:18:36'),
(4, 2, 2, '2018-10-28 20:22:48'),
(7, 3, 2, '2018-10-28 20:30:10'),
(8, 4, 2, '2018-10-28 21:05:45'),
(9, 3, 1, '2018-10-28 22:26:19'),
(10, 1, 1, '2018-10-31 21:48:55'),
(16, 5, 3, '2018-10-31 22:03:03'),
(18, 3, 4, '2018-10-31 22:18:17'),
(19, 2, 4, '2018-10-31 22:20:08'),
(20, 1, 3, '2018-10-31 22:26:27'),
(21, 6, 4, '2018-11-02 20:26:44'),
(23, 2, 1, '2018-11-04 19:27:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  PRIMARY KEY (`id_like`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

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
(18, 5, 7),
(56, 4, 13),
(57, 6, 9),
(58, 6, 1),
(59, 6, 2),
(60, 1, 9);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
-- Estrutura da tabela `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `msg_text` text,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `seen` enum('y','n') DEFAULT 'n',
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`id_message`, `sender`, `receiver`, `msg_text`, `r_date`, `seen`) VALUES
(164, 3, 1, 'see post', '2018-11-03 15:44:58', 'y'),
(165, 3, 1, 'see profile', '2018-11-03 15:46:00', 'y'),
(166, 3, 1, 'profile?', '2018-11-03 15:46:23', 'y'),
(167, 3, 1, 'update community pic', '2018-11-03 15:47:55', 'y'),
(168, 3, 1, 'update prof pic?', '2018-11-03 15:48:51', 'y'),
(169, 1, 5, 'fala rapaz', '2018-11-03 16:39:16', 'y'),
(170, 5, 1, 'fala tu', '2018-11-03 16:39:31', 'y'),
(171, 5, 1, 'llll', '2018-11-03 16:45:44', 'y'),
(172, 5, 1, 'llll', '2018-11-03 16:46:25', 'y'),
(173, 5, 1, 'llll', '2018-11-03 16:46:35', 'y'),
(174, 5, 1, 'qqq', '2018-11-03 16:47:12', 'y'),
(175, 5, 1, 'qqq', '2018-11-03 16:47:39', 'y'),
(176, 5, 1, 'qqq', '2018-11-03 16:48:10', 'y'),
(177, 3, 1, 'Oii', '2018-11-03 16:48:35', 'y'),
(178, 1, 3, 'Ohayou Gosaimasu', '2018-11-03 16:48:54', 'y'),
(179, 3, 1, 'Ohayou gosaimasu? Que isso?', '2018-11-03 16:49:05', 'y'),
(180, 1, 3, 'Ã‰ meio que um olÃ¡ em japonÃªs', '2018-11-03 16:49:20', 'y'),
(181, 1, 3, 'SÃ³ digo isso pq gosto da sonoridade', '2018-11-03 16:49:35', 'y'),
(182, 3, 1, 'hm...', '2018-11-03 16:49:39', 'y'),
(183, 3, 1, 'testando...', '2018-11-04 14:20:08', 'n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `community` int(11) DEFAULT NULL,
  `type` enum('like','comment','new_post','join','comment_another','comment_own','following_you') NOT NULL,
  `acting_user` int(11) NOT NULL,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `seen` enum('y','n') DEFAULT 'n',
  PRIMARY KEY (`id_notification`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

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
(44, 1, 5, 2, 'comment_own', 3, '2018-10-31 22:19:01', 'y'),
(45, 2, 5, 2, 'comment_own', 3, '2018-10-31 22:19:01', 'y'),
(46, 4, 5, 2, 'comment_own', 3, '2018-10-31 22:19:01', 'y'),
(47, 5, 5, 2, 'comment_own', 3, '2018-10-31 22:19:01', 'y'),
(48, 3, 5, 2, 'comment', 2, '2018-10-31 22:19:21', 'y'),
(49, 1, 5, 2, 'comment_another', 2, '2018-10-31 22:19:21', 'y'),
(50, 3, 8, 4, 'comment', 2, '2018-10-31 22:20:18', 'y'),
(51, 2, 2, 2, 'comment_own', 1, '2018-11-02 22:03:10', 'y'),
(52, 3, 2, 2, 'comment_own', 1, '2018-11-02 22:03:10', 'y'),
(53, 4, 2, 2, 'comment_own', 1, '2018-11-02 22:03:10', 'y'),
(54, 5, 2, 2, 'comment_own', 1, '2018-11-02 22:03:11', 'y'),
(55, 5, 7, 3, 'comment', 1, '2018-11-02 22:15:01', 'y'),
(56, 3, 12, 1, 'like', 1, '2018-11-02 22:55:46', 'y'),
(57, 3, 12, 1, 'like', 1, '2018-11-02 22:55:50', 'y'),
(58, 3, 12, 1, 'like', 1, '2018-11-02 22:56:13', 'y'),
(59, 3, 8, 4, 'like', 6, '2018-11-02 22:59:36', 'y'),
(60, 3, 8, 4, 'like', 6, '2018-11-02 23:00:15', 'y'),
(61, 3, 8, 4, 'like', 6, '2018-11-02 23:00:36', 'y'),
(62, 3, 8, 4, 'like', 6, '2018-11-02 23:00:36', 'y'),
(63, 3, 8, 4, 'like', 6, '2018-11-02 23:00:37', 'y'),
(64, 3, 8, 4, 'like', 6, '2018-11-02 23:01:06', 'y'),
(65, 3, 8, 4, 'like', 6, '2018-11-02 23:01:07', 'y'),
(66, 3, 8, 4, 'like', 6, '2018-11-02 23:01:07', 'y'),
(67, 3, 8, 4, 'like', 6, '2018-11-02 23:01:08', 'y'),
(68, 3, 8, 4, 'like', 6, '2018-11-02 23:02:15', 'y'),
(69, 3, 8, 4, 'like', 6, '2018-11-02 23:03:12', 'y'),
(70, 3, 8, 4, 'like', 6, '2018-11-02 23:03:13', 'y'),
(71, 3, 8, 4, 'like', 6, '2018-11-02 23:03:13', 'y'),
(72, 3, 8, 4, 'like', 6, '2018-11-02 23:03:13', 'y'),
(73, 3, 8, 4, 'like', 6, '2018-11-02 23:03:44', 'y'),
(74, 3, 8, 4, 'like', 6, '2018-11-02 23:05:54', 'y'),
(75, 3, 8, 4, 'like', 6, '2018-11-02 23:06:06', 'y'),
(76, 3, 8, 4, 'like', 6, '2018-11-02 23:06:20', 'y'),
(77, 3, 8, 4, 'like', 6, '2018-11-02 23:06:22', 'y'),
(78, 3, 8, 4, 'like', 6, '2018-11-02 23:06:23', 'y'),
(79, 3, 8, 4, 'like', 6, '2018-11-02 23:06:24', 'y'),
(80, 3, 8, 4, 'like', 6, '2018-11-02 23:08:35', 'y'),
(81, 3, 8, 4, 'like', 6, '2018-11-02 23:08:36', 'y'),
(82, 3, 8, 4, 'like', 6, '2018-11-02 23:08:37', 'y'),
(83, 3, 8, 4, 'like', 6, '2018-11-02 23:08:37', 'y'),
(84, 3, 8, 4, 'like', 6, '2018-11-02 23:08:38', 'y'),
(85, 3, 8, 4, 'like', 6, '2018-11-02 23:08:38', 'y'),
(86, 3, 8, 4, 'like', 6, '2018-11-02 23:08:40', 'y'),
(87, 3, 8, 4, 'like', 6, '2018-11-02 23:08:59', 'y'),
(88, 3, 8, 4, 'like', 6, '2018-11-02 23:15:44', 'y'),
(89, 3, 8, 4, 'like', 6, '2018-11-02 23:16:05', 'y'),
(90, 3, 12, 1, 'like', 6, '2018-11-02 23:20:27', 'y'),
(91, 6, 13, 4, 'like', 4, '2018-11-02 23:33:56', 'y'),
(92, 6, 13, 4, 'like', 4, '2018-11-02 23:36:22', 'y'),
(93, 6, 13, 4, 'comment', 4, '2018-11-02 23:37:56', 'y'),
(94, 6, 13, 4, 'comment', 4, '2018-11-02 23:40:58', 'y'),
(95, 6, 13, 4, 'comment', 4, '2018-11-02 23:41:18', 'y'),
(96, 1, 9, 3, 'like', 6, '2018-11-02 23:42:23', 'y'),
(97, 1, 9, 3, 'comment', 6, '2018-11-02 23:42:33', 'y'),
(98, 1, 1, 1, 'like', 6, '2018-11-02 23:44:41', 'y'),
(99, 1, 2, 2, 'like', 6, '2018-11-02 23:44:44', 'y'),
(100, 1, 9, 3, 'comment', 6, '2018-11-02 23:52:06', 'y'),
(101, 1, 9, 3, 'comment', 6, '2018-11-02 23:52:31', 'y'),
(102, 1, 9, 3, 'comment', 6, '2018-11-02 23:53:24', 'y'),
(103, 2, 9, 3, 'comment_own', 1, '2018-11-02 23:53:50', 'y'),
(104, 3, 9, 3, 'comment_own', 1, '2018-11-02 23:53:50', 'y'),
(105, 4, 9, 3, 'comment_own', 1, '2018-11-02 23:53:50', 'y'),
(106, 5, 9, 3, 'comment_own', 1, '2018-11-02 23:53:50', 'y'),
(107, 6, 9, 3, 'comment_own', 1, '2018-11-02 23:53:50', 'y'),
(108, 1, 9, 3, 'comment', 6, '2018-11-02 23:56:11', 'y'),
(109, 1, 9, 3, 'comment', 6, '2018-11-02 23:56:27', 'y'),
(110, 1, 9, 3, 'comment', 6, '2018-11-02 23:56:37', 'y'),
(111, 2, 9, 3, 'comment_own', 1, '2018-11-02 23:57:19', 'y'),
(112, 3, 9, 3, 'comment_own', 1, '2018-11-02 23:57:19', 'y'),
(113, 4, 9, 3, 'comment_own', 1, '2018-11-02 23:57:19', 'y'),
(114, 5, 9, 3, 'comment_own', 1, '2018-11-02 23:57:19', 'y'),
(115, 6, 9, 3, 'comment_own', 1, '2018-11-02 23:57:19', 'y'),
(116, 1, 9, 3, 'comment', 6, '2018-11-02 23:57:52', 'y'),
(117, 1, 1, 1, 'comment', 3, '2018-11-02 23:58:48', 'y'),
(118, 2, 1, 1, 'comment_another', 3, '2018-11-02 23:58:48', 'y'),
(119, 5, 1, 1, 'comment_another', 3, '2018-11-02 23:58:48', 'y'),
(120, 1, 1, 1, 'comment', 3, '2018-11-03 00:01:08', 'y'),
(121, 2, 1, 1, 'comment_another', 3, '2018-11-03 00:01:08', 'y'),
(122, 5, 1, 1, 'comment_another', 3, '2018-11-03 00:01:08', 'y'),
(123, 1, 1, 1, 'comment', 3, '2018-11-03 00:05:18', 'y'),
(124, 2, 1, 1, 'comment_another', 3, '2018-11-03 00:05:18', 'y'),
(125, 5, 1, 1, 'comment_another', 3, '2018-11-03 00:05:18', 'y'),
(126, 1, 1, 1, 'comment', 5, '2018-11-03 00:05:52', 'y'),
(127, 3, 1, 1, 'comment_another', 5, '2018-11-03 00:05:52', 'y'),
(128, 2, 1, 1, 'comment_another', 5, '2018-11-03 00:05:52', 'y'),
(129, 1, 9, 3, 'comment', 3, '2018-11-03 15:22:57', 'y'),
(130, 6, 9, 3, 'comment_another', 3, '2018-11-03 15:22:57', 'y'),
(131, 1, 9, 3, 'comment', 3, '2018-11-03 15:25:38', 'y'),
(132, 6, 9, 3, 'comment_another', 3, '2018-11-03 15:25:38', 'y'),
(133, 2, 4, 2, 'comment', 3, '2018-11-04 14:21:02', 'y'),
(134, 1, 4, 2, 'comment_another', 3, '2018-11-04 14:21:02', 'y'),
(135, 4, 4, 2, 'comment_another', 3, '2018-11-04 14:21:02', 'y'),
(136, 2, 4, 2, 'comment', 3, '2018-11-04 14:21:41', 'y'),
(137, 1, 4, 2, 'comment_another', 3, '2018-11-04 14:21:41', 'y'),
(138, 4, 4, 2, 'comment_another', 3, '2018-11-04 14:21:41', 'y'),
(139, 6, 13, 4, 'like', 2, '2018-11-04 14:55:02', 'y'),
(140, 2, 4, 2, 'comment', 3, '2018-11-04 19:02:18', 'y'),
(141, 1, 4, 2, 'comment_another', 3, '2018-11-04 19:02:18', 'y'),
(142, 4, 4, 2, 'comment_another', 3, '2018-11-04 19:02:19', 'n'),
(144, 6, NULL, NULL, 'following_you', 2, '2018-11-04 19:13:31', 'y'),
(145, 2, NULL, NULL, 'following_you', 6, '2018-11-04 19:13:43', 'y');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id_post`, `user`, `community`, `post_text`, `post_pic`, `r_date`, `likes`) VALUES
(1, 1, 1, 'Sejam todos bem vindos', NULL, '2018-10-28 20:14:49', 4),
(2, 1, 2, 'OlÃ¡, se alguÃ©m quiser jogar RPG fale comigo.', NULL, '2018-10-28 20:19:02', 5),
(4, 2, 2, 'OlÃ¡, sou novo aqui', NULL, '2018-10-28 20:23:18', 3),
(5, 3, 2, 'NÃ£o gostei da imagem de perfil', NULL, '2018-10-28 20:33:30', 1),
(6, 3, 1, 'Iae', NULL, '2018-10-28 22:26:25', 1),
(7, 5, 3, 'LET\'S DO IT! WARRIORS!', NULL, '2018-10-31 22:01:49', 1),
(8, 3, 4, 'Sejam todos bem vindos!', NULL, '2018-10-31 22:18:37', 0),
(9, 1, 3, 'toma vergonha', NULL, '2018-10-31 22:26:41', 2),
(12, 3, 1, '.', NULL, '2018-11-02 20:27:44', 2),
(13, 6, 4, 'xxxxxxxxxxxx', NULL, '2018-11-02 23:31:05', 1);

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
  `followers` int(11) DEFAULT '0',
  `following` int(11) DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `first_name`, `last_name`, `birthday`, `profile_pic`, `passwd`, `r_date`, `gender`, `stars`, `followers`, `following`) VALUES
(1, 'mag', 'Carlos Magno', 'Nascimento', '2002-04-11', 'assets/upload/img/15410324805bda4a203daaa.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 20:11:04', 'M', 11, 4, 2),
(2, 'joao', 'JoÃ£o', 'Pinto Grande', '1979-12-21', 'assets/upload/img/15410325555bda4a6b337b0.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 20:22:01', 'M', 3, 1, 1),
(3, 'ana', 'Ana', 'Clara', '2000-01-31', 'assets/upload/img/15410324085bda49d8957e8.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 20:27:45', 'F', 22, 1, 2),
(4, 'bruno', 'Bruno', 'Barbosa', '1999-11-11', 'assets/upload/img/15410325115bda4a3f8621d.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 21:05:00', 'O', 0, 0, 1),
(5, 'carlito', 'Carlito', 'Gladiador', '2000-09-27', 'assets/upload/img/15410327155bda4b0b70ef0.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-31 21:37:13', 'M', 1, 1, 1),
(6, 'vei', 'Domingos', 'Nascimento', '1967-07-27', 'assets/img/default-user-icon.png', '8527eff385be84416fa9409d7239030f', '2018-11-02 20:26:19', 'M', 1, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
