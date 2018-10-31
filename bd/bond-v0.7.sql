-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Out-2018 às 01:34
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

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
(20, 1, 4, 'quem Ã© bruno?', '2018-10-28 21:10:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `communities`
--

INSERT INTO `communities` (`id_community`, `community_name`, `r_date`, `profile_pic`, `community_description`, `members`) VALUES
(1, 'IF da DepressÃ£o', '2018-10-28 20:14:37', 'assets/upload/img/15407684775bd642dd7413d.jpg', '..', 2),
(2, 'RPG de Mesa', '2018-10-28 20:18:36', 'assets/upload/img/15407687165bd643cc33234.png', 'Comunidade para jogadores de rpg', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `follows`
--

CREATE TABLE IF NOT EXISTS `follows` (
  `id_follow` int(11) NOT NULL AUTO_INCREMENT,
  `follower` int(11) NOT NULL,
  `following` int(11) NOT NULL,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_follow`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `is_part_of`
--

INSERT INTO `is_part_of` (`id_is_part_of`, `user`, `community`, `r_date`) VALUES
(1, 1, 1, '2018-10-28 20:14:37'),
(2, 1, 2, '2018-10-28 20:18:36'),
(3, 2, 1, '2018-10-28 20:22:36'),
(4, 2, 2, '2018-10-28 20:22:48'),
(7, 3, 2, '2018-10-28 20:30:10'),
(8, 4, 2, '2018-10-28 21:05:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  PRIMARY KEY (`id_like`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `likes`
--

INSERT INTO `likes` (`id_like`, `user`, `post`) VALUES
(1, 1, 1),
(2, 1, 2),
(5, 2, 2),
(6, 2, 4),
(8, 1, 4),
(9, 3, 4),
(10, 3, 2),
(11, 3, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `community` int(11) DEFAULT NULL,
  `type` enum('like','comment','new_post','join','comment_another') NOT NULL,
  `acting_user` int(11) NOT NULL,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_notification`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `notifications`
--

INSERT INTO `notifications` (`id_notification`, `user`, `post`, `community`, `type`, `acting_user`, `r_date`) VALUES
(1, 2, 4, 2, 'comment', 4, '2018-10-28 21:05:55'),
(3, 3, 4, 2, 'comment_another', 4, '2018-10-28 21:05:55'),
(4, 2, 4, 2, 'comment', 1, '2018-10-28 21:10:15'),
(5, 3, 4, 2, 'comment_another', 1, '2018-10-28 21:10:15'),
(7, 2, 4, 2, 'comment', 1, '2018-10-28 21:10:47'),
(8, 3, 4, 2, 'comment_another', 1, '2018-10-28 21:10:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id_post`, `user`, `community`, `post_text`, `post_pic`, `r_date`, `likes`) VALUES
(1, 1, 1, 'Sejam todos bem vindos', NULL, '2018-10-28 20:14:49', 2),
(2, 1, 2, 'OlÃ¡, se alguÃ©m quiser jogar RPG fale comigo.', NULL, '2018-10-28 20:19:02', 3),
(4, 2, 2, 'OlÃ¡, sou novo aqui', NULL, '2018-10-28 20:23:18', 3),
(5, 3, 2, 'NÃ£o gostei da imagem de perfil', NULL, '2018-10-28 20:33:30', 0);

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
  `followers` int(11) DEFAULT '0',
  `following` int(11) DEFAULT '0',
  `stars` int(11) DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `first_name`, `last_name`, `birthday`, `profile_pic`, `passwd`, `r_date`, `gender`, `followers`, `following`, `stars`) VALUES
(1, 'mag', 'Carlos Magno', 'Nascimento', '2002-04-11', 'assets/upload/img/15407682645bd6420804b35.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 20:11:04', 'M', 0, 0, 5),
(2, 'joao', 'JoÃ£o', 'Pinto Grande', '1979-12-21', 'assets/upload/img/15407689215bd644996d0cd.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 20:22:01', 'M', 0, 0, 3),
(3, 'ana', 'Ana', 'Clara', '2000-01-31', 'assets/upload/img/15407692655bd645f1bc978.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 20:27:45', 'F', 0, 0, 0),
(4, 'bruno', 'Bruno', 'Barbosa', '1999-11-11', 'assets/upload/img/15407715005bd64eac4884e.jpg', '202cb962ac59075b964b07152d234b70', '2018-10-28 21:05:00', 'O', 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
