-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Трв 17 2018 р., 20:08
-- Версія сервера: 5.6.38
-- Версія PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `project`
--

-- --------------------------------------------------------

--
-- Структура таблиці `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `history`
--

INSERT INTO `history` (`id`, `userid`, `text`) VALUES
(11, 1, 'Покупка услуги №2'),
(12, 1, 'Покупка услуги №1'),
(13, 1, 'Покупка услуги №1');

-- --------------------------------------------------------

--
-- Структура таблиці `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `reviews`
--

INSERT INTO `reviews` (`id`, `userid`, `text`) VALUES
(3, 1, 'Все отлично!'),
(4, 1, 'Всем рекомендую');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `ip` text NOT NULL,
  `protected` int(11) NOT NULL,
  `referral` int(11) NOT NULL,
  `balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `ip`, `protected`, `referral`, `balance`) VALUES
(1, 'test@i.ua', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, 20),
(2, 'test2@i.ua', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 1, 0);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблиці `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
