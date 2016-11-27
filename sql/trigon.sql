-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 27 2016 г., 16:28
-- Версия сервера: 5.7.14
-- Версия PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `trigon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'hello123');

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `tel` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id_client`, `first_name`, `last_name`, `email`, `tel`) VALUES
(1, 'Svitlana', 'Osadchyieva', 'osv@icloud.com', '380500372371'),
(2, 'Anatolii', 'Yamburenko', 'ay@icloud.com', '380500372371'),
(3, 'Svitlana', 'Osadchyieva', 'osv@icloud.com', '380500372371'),
(4, 'Anatolii', 'Yamburenko', 'ay@icloud.com', '380500372371'),
(5, 'sveta', 'sveta', 'sveta', 'sveta'),
(6, 'sveta', 'sveta', 'sveta', 'sveta'),
(7, 'Jiol', 'Pop', 'uierow@wef.com', '108409128490'),
(8, 'hello', 'pqweopq', 'ewfii@wef.wqwe', '18237871298'),
(9, 'hello', 'pqweopq', 'ewfii@wef.wqwe', '18237871298'),
(10, 'hello', 'pqweopq', 'ewfii@wef.wqwe', '18237871298'),
(11, 'jioq', 'qweqw', 'iqwe@wef.www', '7128937981'),
(12, 'jioq', 'qweqw', 'iqwe@wef.www', '7128937981'),
(13, 'jioq', 'qweqw', 'iqwe@wef.www', '7128937981'),
(14, 'jioq', 'qweqw', 'iqwe@wef.www', '7128937981'),
(58, 'werwer', 'wer', 'we7f@qwd.q', '124124'),
(59, 'opipoi', 'fiuefh', 'wuefiu@wef.ww', '123123'),
(60, 'wfwef', 'wefw', 'io9@wf.w', '124124'),
(61, 'ethe', 'wef', 'io8@wf.w', '124124'),
(62, '87487', 'kjkj', 'jkjk', 'kjk'),
(63, 'kpklkl', 'lkl', 'lkl', 'lkl');

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE `language` (
  `id_lang` int(11) NOT NULL,
  `lang` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id_lang`, `lang`) VALUES
(1, 'anglais'),
(2, 'italien'),
(3, 'francais'),
(4, 'allenand');

-- --------------------------------------------------------

--
-- Структура таблицы `qoute`
--

CREATE TABLE `qoute` (
  `id_qoute` int(11) NOT NULL,
  `lang_from` int(11) NOT NULL,
  `lang_to` int(11) NOT NULL,
  `doc_description` varchar(500) DEFAULT NULL,
  `doc` varchar(100) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `qoute_type` enum('qoute','ordre') DEFAULT NULL,
  `status_work` enum('open','resolved') DEFAULT NULL,
  `status_pay` enum('payed','unpayed','not_required') DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  `doc_type` enum('oral','techn','liter') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `qoute`
--

INSERT INTO `qoute` (`id_qoute`, `lang_from`, `lang_to`, `doc_description`, `doc`, `price`, `time`, `qoute_type`, `status_work`, `status_pay`, `id_client`, `doc_type`) VALUES
(15, 1, 3, 'wef', '', 1, 6, 'qoute', 'resolved', 'payed', 61, 'oral'),
(14, 1, 2, 'wfew', 'files/(2)', NULL, NULL, 'qoute', NULL, NULL, 60, 'oral'),
(13, 2, 1, 'wqrwqrqwr', 'files/(2)', NULL, NULL, 'qoute', NULL, NULL, 59, 'oral'),
(12, 2, 1, 'dfwf', 'files/CV_Anastasiia_Zakharova.docx', 0, 0, 'qoute', 'resolved', 'payed', 58, 'liter'),
(11, 2, 1, 'qwfqf', 'files/Kharytonova_Yamburenko_Transactions-Vols.docx', 0, 0, 'qoute', 'open', 'unpayed', 58, 'liter'),
(16, 1, 1, 'r6r67r7r77r7', '', NULL, NULL, 'qoute', NULL, NULL, 62, 'oral'),
(17, 1, 1, 'lkk', 'files/lab_4_fikt_per.doc', NULL, NULL, 'ordre', NULL, NULL, 63, 'oral');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Индексы таблицы `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id_lang`);

--
-- Индексы таблицы `qoute`
--
ALTER TABLE `qoute`
  ADD PRIMARY KEY (`id_qoute`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `lang_from` (`lang_from`),
  ADD KEY `lang_to` (`lang_to`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT для таблицы `language`
--
ALTER TABLE `language`
  MODIFY `id_lang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `qoute`
--
ALTER TABLE `qoute`
  MODIFY `id_qoute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
