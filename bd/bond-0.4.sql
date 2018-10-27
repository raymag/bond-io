-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Out-2018 às 22:00
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `communities`
--

INSERT INTO `communities` (`id_community`, `community_name`, `r_date`, `profile_pic`, `community_description`, `members`) VALUES
(1, 'RPG', '2018-10-26 19:38:35', 'assets/img/default-community-icon.png', 'Clube do RPG', 2),
(2, 'Cruzeiro Esporte Clube', '2018-10-26 19:42:00', 'assets/img/cruzeiro.jpg', '...', 1),
(3, 'RolimÃ£ Racers', '2018-10-26 20:25:36', 'assets/img/default-community-icon.png', 'sla', 0),
(4, 'FORRÃ“', '2018-10-27 00:45:41', 'assets/img/default-community-icon.png', '.....', 1),
(5, 'Doadores de Sangue', '2018-10-27 08:23:37', 'assets/img/default-community-icon.png', 'Comidade para quem doa e necessita de sangue', 2),
(6, 'MÃºsicos e Musicista', '2018-10-27 08:47:54', 'assets/img/default-community-icon.png', 'Comunidade para mÃºsicos', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `is_part_of`
--

INSERT INTO `is_part_of` (`id_is_part_of`, `user`, `community`, `r_date`) VALUES
(26, 3, 5, '2018-10-27 08:23:50'),
(31, 4, 1, '2018-10-27 11:13:34'),
(37, 3, 2, '2018-10-27 14:36:17'),
(38, 3, 1, '2018-10-27 14:36:30'),
(39, 4, 5, '2018-10-27 14:59:54'),
(41, 3, 4, '2018-10-27 15:23:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  PRIMARY KEY (`id_like`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `likes`
--

INSERT INTO `likes` (`id_like`, `user`, `post`) VALUES
(3, 3, 19),
(4, 3, 18),
(5, 3, 17),
(6, 4, 19),
(7, 4, 17),
(8, 4, 16),
(9, 4, 15);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id_post`, `user`, `community`, `post_text`, `post_pic`, `r_date`, `likes`) VALUES
(1, 3, 2, 'kkkkkkkkkkkkkkkk', NULL, '2018-10-27 09:04:27', 0),
(2, 3, 2, 'kkkkkkkkkkkkkkkk', NULL, '2018-10-27 09:32:18', 0),
(3, 3, 2, 'kkkkkkkkkkkkkkkk', NULL, '2018-10-27 09:32:32', 0),
(4, 3, 2, 'Um dia chego lÃ¡!', NULL, '2018-10-27 09:45:49', 0),
(6, 4, 2, 'Foi!', NULL, '2018-10-27 09:49:24', 0),
(7, 4, 2, 'AGORA', NULL, '2018-10-27 13:07:25', 0),
(8, 3, 2, 'Likes & Deslikes em Funcionamento!!', NULL, '2018-10-27 13:19:17', 0),
(15, 3, 1, 'ItÃ¡lico', NULL, '2018-10-27 14:36:50', 1),
(16, 3, 5, 'quero doar sangue!', NULL, '2018-10-27 14:57:47', 1),
(17, 3, 1, 'Quero jogar', NULL, '2018-10-27 14:58:03', 2),
(18, 3, 2, 'PRIMEIRO!!', NULL, '2018-10-27 14:59:00', 1),
(19, 4, 5, 'Eu tambÃ©m', NULL, '2018-10-27 15:00:00', 2);

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
(3, 'mag', 'Carlos Magno', 'Nascimento', '2002-04-11', '	assets/img/default-user-icon.png	', '202cb962ac59075b964b07152d234b70', '2018-10-25 23:38:21', 'M', 0, 0, 5),
(4, 'ryan', 'Ryan', 'Marcos', '2002-05-29', 'assets/img/default-user-icon.png', '202cb962ac59075b964b07152d234b70', '2018-10-27 08:45:23', 'M', 0, 0, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
