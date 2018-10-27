-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Out-2018 às 06:10
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
CREATE DATABASE IF NOT EXISTS `bond` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bond`;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `communities`
--

INSERT INTO `communities` (`id_community`, `community_name`, `r_date`, `profile_pic`, `community_description`, `members`) VALUES
(1, 'RPG', '2018-10-26 19:38:35', 'assets/img/default-community-icon.png', 'Clube do RPG', 0),
(2, 'Cruzeiro Esporte Clube', '2018-10-26 19:42:00', 'assets/img/cruzeiro.jpg', '...', 1),
(3, 'RolimÃ£ Racers', '2018-10-26 20:25:36', 'assets/img/default-community-icon.png', 'sla', 1),
(4, 'FORRÃ“', '2018-10-27 00:45:41', 'assets/img/default-community-icon.png', '.....', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `is_part_of`
--

INSERT INTO `is_part_of` (`id_is_part_of`, `user`, `community`, `r_date`) VALUES
(21, 3, 4, '2018-10-27 00:45:53'),
(22, 3, 3, '2018-10-27 00:46:01'),
(25, 3, 2, '2018-10-27 01:06:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  PRIMARY KEY (`id_like`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `first_name`, `last_name`, `birthday`, `profile_pic`, `passwd`, `r_date`, `gender`, `followers`, `following`, `stars`) VALUES
(3, 'mag', 'Carlos Magno', 'Nascimento', '2002-04-11', '	assets/img/default-user-icon.png	', '202cb962ac59075b964b07152d234b70', '2018-10-25 23:38:21', 'M', 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
