-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 31. čec 2020, 15:56
-- Verze serveru: 10.4.11-MariaDB
-- Verze PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `bozala`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `21_u8chlapci`
--

CREATE TABLE `21_u8chlapci` (
  `id_result` int(10) NOT NULL,
  `racer_id` int(10) NOT NULL,
  `b1z` varchar(10) DEFAULT NULL,
  `b1t` varchar(10) DEFAULT NULL,
  `b2z` varchar(10) DEFAULT NULL,
  `b2t` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `21_u8chlapci`
--

INSERT INTO `21_u8chlapci` (`id_result`, `racer_id`, `b1z`, `b1t`, `b2z`, `b2t`) VALUES
(1, 22, '1', '1', '1', '0'),
(2, 28, '1', '1', '1', '1'),
(3, 24, '0', '1', '0', '1');

-- --------------------------------------------------------

--
-- Struktura tabulky `21_u8divky`
--

CREATE TABLE `21_u8divky` (
  `id_result` int(10) NOT NULL,
  `racer_id` int(10) NOT NULL,
  `b1z` varchar(10) DEFAULT NULL,
  `b1t` varchar(10) DEFAULT NULL,
  `b2z` varchar(10) DEFAULT NULL,
  `b2t` varchar(10) DEFAULT NULL,
  `b3z` varchar(10) DEFAULT NULL,
  `b3t` varchar(10) DEFAULT NULL,
  `b4z` varchar(10) DEFAULT NULL,
  `b4t` varchar(10) DEFAULT NULL,
  `b5z` varchar(10) DEFAULT NULL,
  `b5t` varchar(10) DEFAULT NULL,
  `b6z` varchar(10) DEFAULT NULL,
  `b6t` varchar(10) DEFAULT NULL,
  `b7z` varchar(10) DEFAULT NULL,
  `b7t` varchar(10) DEFAULT NULL,
  `b8z` varchar(10) DEFAULT NULL,
  `b8t` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `21_u8divky`
--

INSERT INTO `21_u8divky` (`id_result`, `racer_id`, `b1z`, `b1t`, `b2z`, `b2t`, `b3z`, `b3t`, `b4z`, `b4t`, `b5z`, `b5t`, `b6z`, `b6t`, `b7z`, `b7t`, `b8z`, `b8t`) VALUES
(1, 26, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1'),
(4, 28, '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1'),
(5, 32, '1', '0', '1', '1', '0', '0', '0', '1', '1', '1', '0', '1', '1', '1', '1', '1'),
(6, 24, '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1'),
(7, 23, '1', '1', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '10', '0', '1'),
(8, 30, '1', '0', '1', '0', '1', '1', '1', '0', '0', '1', '1', '0', '0', '0', '1', '1'),
(9, 29, '1', '0', '1', '0', '0', '1', '1', '0', '0', '1', '1', '0', '0', '0', '1', '1'),
(10, 20, '1', '0', '1', '0', '0', '1', '1', '0', '0', '1', '1', '0', '0', '0', '1', '1');

-- --------------------------------------------------------

--
-- Struktura tabulky `21_u10chlapci`
--

CREATE TABLE `21_u10chlapci` (
  `id_result` int(10) NOT NULL,
  `racer_id` int(10) NOT NULL,
  `b1z` varchar(10) DEFAULT NULL,
  `b1t` varchar(10) DEFAULT NULL,
  `b2z` varchar(10) DEFAULT NULL,
  `b2t` varchar(10) DEFAULT NULL,
  `b3z` varchar(10) DEFAULT NULL,
  `b3t` varchar(10) DEFAULT NULL,
  `b4z` varchar(10) DEFAULT NULL,
  `b4t` varchar(10) DEFAULT NULL,
  `b5z` varchar(10) DEFAULT NULL,
  `b5t` varchar(10) DEFAULT NULL,
  `b6z` varchar(10) DEFAULT NULL,
  `b6t` varchar(10) DEFAULT NULL,
  `b7z` varchar(10) DEFAULT NULL,
  `b7t` varchar(10) DEFAULT NULL,
  `b8z` varchar(10) DEFAULT NULL,
  `b8t` varchar(10) DEFAULT NULL,
  `b9z` varchar(10) DEFAULT NULL,
  `b9t` varchar(10) DEFAULT NULL,
  `b10z` varchar(10) DEFAULT NULL,
  `b10t` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `21_u10chlapci`
--

INSERT INTO `21_u10chlapci` (`id_result`, `racer_id`, `b1z`, `b1t`, `b2z`, `b2t`, `b3z`, `b3t`, `b4z`, `b4t`, `b5z`, `b5t`, `b6z`, `b6t`, `b7z`, `b7t`, `b8z`, `b8t`, `b9z`, `b9t`, `b10z`, `b10t`) VALUES
(1, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `21_u10divky`
--

CREATE TABLE `21_u10divky` (
  `id_result` int(10) NOT NULL,
  `racer_id` int(10) NOT NULL,
  `b1z` varchar(10) DEFAULT NULL,
  `b1t` varchar(10) DEFAULT NULL,
  `b2z` varchar(10) DEFAULT NULL,
  `b2t` varchar(10) DEFAULT NULL,
  `b3z` varchar(10) DEFAULT NULL,
  `b3t` varchar(10) DEFAULT NULL,
  `b4z` varchar(10) DEFAULT NULL,
  `b4t` varchar(10) DEFAULT NULL,
  `b5z` varchar(10) DEFAULT NULL,
  `b5t` varchar(10) DEFAULT NULL,
  `b6z` varchar(10) DEFAULT NULL,
  `b6t` varchar(10) DEFAULT NULL,
  `b7z` varchar(10) DEFAULT NULL,
  `b7t` varchar(10) DEFAULT NULL,
  `b8z` varchar(10) DEFAULT NULL,
  `b8t` varchar(10) DEFAULT NULL,
  `b9z` varchar(10) DEFAULT NULL,
  `b9t` varchar(10) DEFAULT NULL,
  `b10z` varchar(10) DEFAULT NULL,
  `b10t` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `21_u12chlapci`
--

CREATE TABLE `21_u12chlapci` (
  `id_result` int(10) NOT NULL,
  `racer_id` int(10) NOT NULL,
  `b1z` varchar(10) DEFAULT NULL,
  `b1t` varchar(10) DEFAULT NULL,
  `b2z` varchar(10) DEFAULT NULL,
  `b2t` varchar(10) DEFAULT NULL,
  `b3z` varchar(10) DEFAULT NULL,
  `b3t` varchar(10) DEFAULT NULL,
  `b4z` varchar(10) DEFAULT NULL,
  `b4t` varchar(10) DEFAULT NULL,
  `b5z` varchar(10) DEFAULT NULL,
  `b5t` varchar(10) DEFAULT NULL,
  `b6z` varchar(10) DEFAULT NULL,
  `b6t` varchar(10) DEFAULT NULL,
  `b7z` varchar(10) DEFAULT NULL,
  `b7t` varchar(10) DEFAULT NULL,
  `b8z` varchar(10) DEFAULT NULL,
  `b8t` varchar(10) DEFAULT NULL,
  `b9z` varchar(10) DEFAULT NULL,
  `b9t` varchar(10) DEFAULT NULL,
  `b10z` varchar(10) DEFAULT NULL,
  `b10t` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `21_u12chlapci`
--

INSERT INTO `21_u12chlapci` (`id_result`, `racer_id`, `b1z`, `b1t`, `b2z`, `b2t`, `b3z`, `b3t`, `b4z`, `b4t`, `b5z`, `b5t`, `b6z`, `b6t`, `b7z`, `b7t`, `b8z`, `b8t`, `b9z`, `b9t`, `b10z`, `b10t`) VALUES
(1, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `21_u12divky`
--

CREATE TABLE `21_u12divky` (
  `id_result` int(10) NOT NULL,
  `racer_id` int(10) NOT NULL,
  `b1z` varchar(10) DEFAULT NULL,
  `b1t` varchar(10) DEFAULT NULL,
  `b2z` varchar(10) DEFAULT NULL,
  `b2t` varchar(10) DEFAULT NULL,
  `b3z` varchar(10) DEFAULT NULL,
  `b3t` varchar(10) DEFAULT NULL,
  `b4z` varchar(10) DEFAULT NULL,
  `b4t` varchar(10) DEFAULT NULL,
  `b5z` varchar(10) DEFAULT NULL,
  `b5t` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `user_id` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `last_mod` timestamp NULL DEFAULT current_timestamp(),
  `relase_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `article`
--

INSERT INTO `article` (`id_article`, `url`, `title`, `keywords`, `text`, `user_id`, `created`, `last_mod`, `relase_date`) VALUES
(1, 'kkk', 'kkk', 'kkk', '<p>kkksasdasd</p>', 33, '2020-07-30 17:11:28', '2020-07-30 17:11:28', NULL),
(5, 'nejlepsi', 'nejlepsi titulek je aspon trochu dlouhyssss', 'nejlpsi, tituleek', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vivamus porttitor turpis ac leo. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Aenean placerat. Fusce suscipit libero eget elit. Morbi im</p>', 33, '2020-07-30 18:32:26', '2020-07-31 09:36:41', NULL),
(7, 'nejlepsikkk', 'jkjjjj', 'jjjjj', '<p>klkasldkasmmklasmld</p>', 33, '2020-07-30 20:01:43', '2020-07-31 09:37:12', NULL),
(8, 'qasdadad-', 'Nejdelsi clanek na svete', 'clanek lsad', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed ac dolor sit amet purus malesuada congue. Nulla quis diam. Pellentesque sapien. Duis pulvinar. Integer pellentesque quam vel velit. Fusce consectetuer risus a nunc. Praesent in mauris eu tortor porttitor accumsan. In convallis. Aenean fermentum risus id tortor. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Praesent in mauris eu tortor porttitor accumsan. Etiam commodo dui eget wisi. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Aenean id metus id velit ullamcorper pulvinar. Aliquam ornare wisi eu metus. In dapibus augue non sapien. Aliquam erat volutpat. Morbi scelerisque luctus velit.</p>\n<p>Nullam faucibus mi quis velit. Praesent id justo in neque elementum ultrices. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Pellentesque arcu. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nam quis nulla. Donec quis nibh at felis congue commodo. Duis viverra diam non justo. Praesent vitae arcu tempor neque lacinia pretium.</p>\n<p>Fusce nibh. Nulla pulvinar eleifend sem. Morbi scelerisque luctus velit. Morbi leo mi, nonummy eget tristique non, rhoncus non leo. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Praesent dapibus. Duis viverra diam non justo. In rutrum. Aliquam erat volutpat. Praesent dapibus. Suspendisse nisl. Nullam feugiat, turpis at pulvinar vulputate, erat libero tristique tellus, nec bibendum odio risus sit amet ante. Integer tempor. Praesent in mauris eu tortor porttitor accumsan. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Curabitur sagittis hendrerit ante. Fusce tellus.</p>\n<p>Nulla non lectus sed nisl molestie malesuada. Morbi imperdiet, mauris ac auctor dictum, nisl ligula egestas nulla, et sollicitudin sem purus in lacus. Fusce wisi. Duis viverra diam non justo. Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo. Mauris tincidunt sem sed arcu. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Etiam posuere lacus quis dolor. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Aliquam erat volutpat. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Proin in tellus sit amet nibh dignissim sagittis. Aliquam id dolor. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero. Phasellus faucibus molestie nisl. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.</p>\n<p>Curabitur sagittis hendrerit ante. Aliquam id dolor. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Morbi leo mi, nonummy eget tristique non, rhoncus non leo. Nunc tincidunt ante vitae massa. Phasellus faucibus molestie nisl. Fusce tellus. Mauris metus. Donec vitae arcu. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>', 33, '2020-07-30 20:18:36', '2020-07-31 12:18:40', NULL),
(14, 'jsem-fakt-koktor', 'dsfsdffs', 'dsfsdfsd', '<p>sdfsdfsdfsdfsdf</p>', 33, '2020-07-31 09:02:33', '2020-07-31 12:19:05', NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `year_from` year(4) NOT NULL,
  `year_to` year(4) NOT NULL,
  `gender` enum('muž','žena','muž i žena','','') NOT NULL,
  `table_exist` tinyint(1) NOT NULL DEFAULT 0,
  `public_result` tinyint(1) NOT NULL DEFAULT 0,
  `result_system` varchar(30) DEFAULT NULL,
  `comp_type` varchar(30) DEFAULT NULL,
  `bonus_first_try` tinyint(1) DEFAULT NULL,
  `boulder_count` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `category`
--

INSERT INTO `category` (`id_category`, `comp_id`, `name`, `year_from`, `year_to`, `gender`, `table_exist`, `public_result`, `result_system`, `comp_type`, `bonus_first_try`, `boulder_count`) VALUES
(41, 21, 'U8 dívky', 2020, 2013, 'žena', 1, 1, 'amatérské', 'boulder', 0, 8),
(44, 21, 'U10 chlapci', 2013, 2012, 'muž', 1, 0, 'závodní', 'boulder', 0, 10),
(46, 23, 'vse', 2020, 1938, 'muž i žena', 0, 0, NULL, NULL, NULL, NULL),
(47, 21, 'U8 Chlapci', 2020, 2013, 'muž', 1, 1, 'amatérské', 'boulder', 0, 2),
(48, 21, 'U10 dívky', 2013, 2012, 'žena', 1, 0, 'amatérské', 'boulder', 0, 10),
(49, 21, 'U12 chlapci', 2011, 2010, 'muž', 1, 0, 'amatérské', 'boulder', 1, 10),
(50, 21, 'U12 dívky', 2011, 2010, 'žena', 1, 1, 'závodní', 'boulder', 0, 5),
(51, 24, '\\zddadsadda', 2016, 2012, 'muž', 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `comp`
--

CREATE TABLE `comp` (
  `id_comp` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comp_type` varchar(255) DEFAULT NULL,
  `comp_for` varchar(255) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `online_registration_start` datetime DEFAULT NULL,
  `online_registration_end` datetime DEFAULT NULL,
  `plan_url` varchar(255) DEFAULT NULL,
  `result_system` varchar(255) DEFAULT NULL,
  `boulder_count` int(10) DEFAULT NULL,
  `open_result` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `last_mod` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `comp`
--

INSERT INTO `comp` (`id_comp`, `user_id`, `name`, `comp_type`, `comp_for`, `start`, `end`, `online_registration_start`, `online_registration_end`, `plan_url`, `result_system`, `boulder_count`, `open_result`, `created`, `last_mod`) VALUES
(21, 33, 'BOZALA 2020', 'boulder', 'děti', '2020-07-17 13:40:00', '2020-07-31 00:08:00', '2020-07-04 10:38:00', '2020-07-17 00:00:00', 'http://localhost/nette-blog/www/pdf/BOZALA_2020_propozice.pdf', 'amatérské', 10, 1, '2020-07-11 08:38:03', '2020-07-27 14:22:15'),
(23, 33, 'registrace OK', 'rychlost', 'dospělé', '2020-07-31 09:00:00', '2020-07-31 18:00:00', '2020-07-04 20:00:00', '2020-07-31 17:19:00', 'http://localhost/nette-blog/www/pdf/registrace_OK_propozice.pdf', NULL, NULL, 0, '2020-07-16 16:06:05', '2020-07-30 11:20:49'),
(24, 33, 'eee', 'boulder', 'všechny', '2020-08-30 18:06:00', '2020-08-31 00:08:00', '2020-07-08 18:06:00', '2020-07-29 17:20:00', 'http://localhost/nette-blog/www/pdf/eee_propozice.pdf', NULL, NULL, 0, '2020-07-16 16:06:54', '2020-07-19 11:38:25');

-- --------------------------------------------------------

--
-- Struktura tabulky `prereg`
--

CREATE TABLE `prereg` (
  `id_prereg` int(10) NOT NULL,
  `comp_id` int(10) NOT NULL,
  `racer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `prereg`
--

INSERT INTO `prereg` (`id_prereg`, `comp_id`, `racer_id`) VALUES
(64, 21, 22),
(65, 23, 22),
(66, 21, 26),
(67, 23, 20),
(69, 23, 28),
(71, 21, 28),
(72, 23, 29),
(73, 21, 24),
(74, 23, 24),
(75, 23, 30),
(77, 21, 27),
(78, 23, 27),
(79, 23, 31),
(80, 21, 31),
(82, 21, 23),
(83, 23, 26),
(85, 21, 30),
(88, 23, 23),
(90, 23, 32),
(91, 21, 32),
(92, 21, 29),
(93, 21, 20);

-- --------------------------------------------------------

--
-- Struktura tabulky `racer`
--

CREATE TABLE `racer` (
  `id_racer` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `born` year(4) NOT NULL,
  `club` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_mod` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `racer`
--

INSERT INTO `racer` (`id_racer`, `user_id`, `first_name`, `last_name`, `born`, `club`, `gender`, `created`, `last_mod`) VALUES
(20, 33, 'Adama', 'Černohous', 2014, 'popopo', 'female', '2020-07-10 10:35:04', '2020-07-29 17:17:30'),
(22, 33, 'asddas', 'llklkkl', 2018, 'klklkl', 'male', '2020-07-10 11:42:46', '2020-07-18 10:57:23'),
(23, 33, 'popopo', 'popopo', 2016, 'popopo', 'female', '2020-07-11 10:34:10', '2020-07-29 15:38:02'),
(24, 33, 'asd', 'kllkk', 2018, 'Serenakasy', 'female', '2020-07-11 10:51:14', '2020-07-29 15:38:31'),
(26, 33, 'žena', 'popopo', 2014, 'lklklkkl', 'female', '2020-07-11 15:20:34', '2020-07-18 16:14:18'),
(27, 33, 'mrkev', 'mrkvovič', 2010, 'mrkvov', 'male', '2020-07-11 17:44:28', '2020-07-18 15:35:12'),
(28, 33, 'lololo', 'lololo', 2015, 'lololo', 'female', '2020-07-18 10:59:25', '2020-07-29 15:37:26'),
(29, 33, 'lololo1', 'lololo1', 2015, 'lololo1', 'female', '2020-07-18 10:59:54', '2020-07-29 17:16:56'),
(30, 33, '2012', '2012', 2018, '2012', 'female', '2020-07-18 11:23:42', '2020-07-29 17:16:45'),
(31, 42, 'Zbyšek', 'Černohous', 2010, 'popopo', 'male', '2020-07-18 15:36:32', '2020-07-18 15:36:32'),
(32, 33, 'Anna', 'Peichlova', 2015, 'sssss', 'female', '2020-07-29 11:59:07', '2020-07-29 12:00:02'),
(33, 43, 'lololo', 'lololo', 2012, 'popopo', 'female', '2020-07-30 11:18:45', '2020-07-30 11:19:09');

-- --------------------------------------------------------

--
-- Struktura tabulky `role`
--

CREATE TABLE `role` (
  `id_role` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `role`
--

INSERT INTO `role` (`id_role`, `name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `born` int(10) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 1,
  `last_mod` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id_user`, `first_name`, `last_name`, `passwd`, `email`, `born`, `role`, `last_mod`, `created`) VALUES
(33, 'Zbyšek', 'Černohous', '$2y$10$xJVe4UXqVtN4OPIx/EYH/.h3lxrYInY21yw62gi3mJ00wzyfiFp56', 'Zbysa.Cernohous@seznam.cz', 0, 2, NULL, '2020-06-29 10:29:13'),
(37, 'Zbyšek', 'Černohous', '$2y$10$IjvmIjvmIjvmIjvmIjvmIeuJSEKenn4mJIBURyWjOJn4DNhd4jtQG', 'c@c.cz', 0, 1, NULL, '2020-07-08 10:06:23'),
(38, 'Zbyšek', 'Černohous', '$2y$10$IjvmIjvmIjvmIjvmIjvmIeuJSEKenn4mJIBURyWjOJn4DNhd4jtQG', 'Zbysa.Cernohous@seznam.czss', 0, 1, NULL, '2020-07-09 18:41:31'),
(39, 'popopo', 'popopo', '$2y$10$IjvmIjvmIjvmIjvmIjvmIeuJSEKenn4mJIBURyWjOJn4DNhd4jtQG', 'popopo@p.p', 0, 1, NULL, '2020-07-11 10:33:42'),
(40, 'Zbyšek', 'Černohous', '$2y$10$IjvmIjvmIjvmIjvmIjvmIeuJSEKenn4mJIBURyWjOJn4DNhd4jtQG', 'Zbysa.Cernohous@seznam.czasads', 0, 1, NULL, '2020-07-11 12:20:58'),
(41, 'lololo', 'lololo', '$2y$10$IjvmIjvmIjvmIjvmIjvmIeQHv2nVs4ZgLrpcXNkfkj0oGhzE.LSD2', 'Zbysa.Cernohous@seznam.czaa', 0, 1, NULL, '2020-07-18 10:58:27'),
(42, 'lololo', 'lololo', '$2y$10$IjvmIjvmIjvmIjvmIjvmIeQHv2nVs4ZgLrpcXNkfkj0oGhzE.LSD2', 'Zbysa.Cernohous@seznam.czlololo', 0, 1, NULL, '2020-07-18 14:35:39'),
(43, 'lololo', 'lololo', '$2y$10$IjvmIjvmIjvmIjvmIjvmIeQHv2nVs4ZgLrpcXNkfkj0oGhzE.LSD2', 'lol@lol.cz', 0, 1, NULL, '2020-07-30 11:18:10');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `21_u8chlapci`
--
ALTER TABLE `21_u8chlapci`
  ADD PRIMARY KEY (`id_result`);

--
-- Klíče pro tabulku `21_u8divky`
--
ALTER TABLE `21_u8divky`
  ADD PRIMARY KEY (`id_result`);

--
-- Klíče pro tabulku `21_u10chlapci`
--
ALTER TABLE `21_u10chlapci`
  ADD PRIMARY KEY (`id_result`);

--
-- Klíče pro tabulku `21_u10divky`
--
ALTER TABLE `21_u10divky`
  ADD PRIMARY KEY (`id_result`);

--
-- Klíče pro tabulku `21_u12chlapci`
--
ALTER TABLE `21_u12chlapci`
  ADD PRIMARY KEY (`id_result`);

--
-- Klíče pro tabulku `21_u12divky`
--
ALTER TABLE `21_u12divky`
  ADD PRIMARY KEY (`id_result`);

--
-- Klíče pro tabulku `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`);

--
-- Klíče pro tabulku `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Klíče pro tabulku `comp`
--
ALTER TABLE `comp`
  ADD PRIMARY KEY (`id_comp`);

--
-- Klíče pro tabulku `prereg`
--
ALTER TABLE `prereg`
  ADD PRIMARY KEY (`id_prereg`);

--
-- Klíče pro tabulku `racer`
--
ALTER TABLE `racer`
  ADD PRIMARY KEY (`id_racer`);

--
-- Klíče pro tabulku `role`
--
ALTER TABLE `role`
  ADD UNIQUE KEY `user_id` (`id_role`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `21_u8chlapci`
--
ALTER TABLE `21_u8chlapci`
  MODIFY `id_result` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `21_u8divky`
--
ALTER TABLE `21_u8divky`
  MODIFY `id_result` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku `21_u10chlapci`
--
ALTER TABLE `21_u10chlapci`
  MODIFY `id_result` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `21_u10divky`
--
ALTER TABLE `21_u10divky`
  MODIFY `id_result` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `21_u12chlapci`
--
ALTER TABLE `21_u12chlapci`
  MODIFY `id_result` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `21_u12divky`
--
ALTER TABLE `21_u12divky`
  MODIFY `id_result` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pro tabulku `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pro tabulku `comp`
--
ALTER TABLE `comp`
  MODIFY `id_comp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pro tabulku `prereg`
--
ALTER TABLE `prereg`
  MODIFY `id_prereg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pro tabulku `racer`
--
ALTER TABLE `racer`
  MODIFY `id_racer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pro tabulku `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
