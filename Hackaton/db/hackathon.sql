SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE SCHEMA IF NOT EXISTS `hackathon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `hackathon`;

--
-- Baza de date: `hackathon`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `node`
--

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(2) NOT NULL,
  `taken` tinyint(1) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Salvarea datelor din tabel `node`
--

INSERT INTO `node` (`id`, `class`, `taken`, `parent`) VALUES
(1, '23', 1, NULL),
(2, '24', 1, 1),
(3, '25', 1, 2),
(4, '26', 1, 3),
(5, '27', 1, 4),
(6, '28', 1, 5),
(7, '29', 1, 6),
(8, '30', 1, 7),
(9, '30', 1, 7),
(10, '29', 1, 6),
(11, '30', 1, 10),
(12, '30', 1, 10),
(13, '28', 1, 5),
(14, '29', 1, 13),
(15, '30', 1, 14),
(16, '30', 1, 14),
(17, '29', 1, 13),
(18, '30', 1, 17),
(19, '30', 1, 17),
(20, '27', 1, 4),
(21, '28', 1, 20),
(22, '29', 1, 21),
(23, '30', 1, 22),
(24, '30', 1, 22),
(25, '29', 1, 21),
(26, '30', 1, 25),
(27, '30', 1, 25),
(28, '28', 1, 20),
(29, '29', 1, 28),
(30, '30', 1, 29),
(31, '30', 1, 29),
(32, '29', 1, 28),
(33, '30', 1, 32),
(34, '30', 1, 32),
(35, '26', 1, 3),
(36, '27', 1, 35),
(37, '28', 1, 36),
(38, '29', 1, 37),
(39, '30', 1, 38),
(40, '30', 1, 38),
(41, '29', 1, 37),
(42, '30', 1, 41),
(43, '30', 1, 41),
(44, '28', 1, 36),
(45, '29', 1, 44),
(46, '30', 1, 45),
(47, '30', 1, 45),
(48, '29', 1, 44),
(49, '30', 1, 48),
(50, '30', 1, 48),
(51, '27', 1, 35),
(52, '28', 1, 51),
(53, '29', 1, 52),
(54, '30', 1, 53),
(55, '30', 1, 53),
(56, '29', 1, 52),
(57, '30', 1, 56),
(58, '30', 1, 56),
(59, '28', 0, 51),
(60, '29', 0, 59),
(61, '30', 0, 60),
(62, '30', 0, 60),
(63, '29', 0, 59),
(64, '30', 0, 63),
(65, '30', 0, 63),
(66, '25', 1, 2),
(67, '26', 1, 66),
(68, '27', 1, 67),
(69, '28', 1, 68),
(70, '29', 1, 69),
(71, '30', 1, 70),
(72, '30', 1, 70),
(73, '29', 1, 69),
(74, '30', 1, 73),
(75, '30', 1, 73),
(76, '28', 1, 68),
(77, '29', 1, 76),
(78, '30', 1, 77),
(79, '30', 1, 77),
(80, '29', 1, 76),
(81, '30', 1, 80),
(82, '30', 1, 80),
(83, '27', 1, 67),
(84, '28', 1, 83),
(85, '29', 1, 84),
(86, '30', 1, 85),
(87, '30', 1, 85),
(88, '29', 1, 84),
(89, '30', 1, 88),
(90, '30', 1, 88),
(91, '28', 1, 83),
(92, '29', 1, 91),
(93, '30', 1, 92),
(94, '30', 1, 92),
(95, '29', 1, 91),
(96, '30', 1, 95),
(97, '30', 1, 95),
(98, '26', 1, 66),
(99, '27', 1, 98),
(100, '28', 1, 99),
(101, '29', 1, 100),
(102, '30', 1, 101),
(103, '30', 1, 101),
(104, '29', 1, 100),
(105, '30', 1, 104),
(106, '30', 1, 104),
(107, '28', 1, 99),
(108, '29', 1, 107),
(109, '30', 1, 108),
(110, '30', 1, 108),
(111, '29', 1, 107),
(112, '30', 1, 111),
(113, '30', 1, 111),
(114, '27', 1, 98),
(115, '28', 1, 114),
(116, '29', 1, 115),
(117, '30', 1, 116),
(118, '30', 1, 116),
(119, '29', 1, 115),
(120, '30', 1, 119),
(121, '30', 1, 119),
(122, '28', 1, 114),
(123, '29', 1, 122),
(124, '30', 1, 123),
(125, '30', 1, 123),
(126, '29', 1, 122),
(127, '30', 1, 126),
(128, '30', 1, 126);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'mircea', 'c68271a63ddbc431c307beb7d2918275');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `user_x_node`
--

CREATE TABLE IF NOT EXISTS `user_x_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `fk_node` int(11) NOT NULL,
  `lat` double NOT NULL,
  `long` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_x_node_user` (`fk_user`),
  KEY `fk_user_x_node_node` (`fk_node`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Salvarea datelor din tabel `user_x_node`
--

INSERT INTO `user_x_node` (`id`, `fk_user`, `fk_node`, `lat`, `long`) VALUES
(21, 1, 37, 44.4346225536518, 26.0465025901794),
(22, 1, 67, 44.4348064155097, 26.0543346405029),
(23, 1, 44, 44.4346225536518, 26.0465025901794),
(24, 1, 98, 44.4348064155097, 26.0543346405029),
(25, 1, 52, 44.4346225536518, 26.0465025901794);

--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `node`
--
ALTER TABLE `node`
  ADD CONSTRAINT `node_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `node` (`id`);

--
-- Restrictii pentru tabele `user_x_node`
--
ALTER TABLE `user_x_node`
  ADD CONSTRAINT `user_x_node_ibfk_2` FOREIGN KEY (`fk_node`) REFERENCES `node` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_x_node_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
