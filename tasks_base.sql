-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 16 2021 г., 17:40
-- Версия сервера: 10.3.22-MariaDB-log
-- Версия PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tasks_base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `as12_task`
--

CREATE TABLE `as12_task` (
  `task_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `text` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `as12_task`
--

INSERT INTO `as12_task` (`task_id`, `name`, `email`, `text`, `status`) VALUES
(1, 'Task1', 'task1@test.com', 'Task1Text', 1),
(2, 'Task2', 'task2@test.com', 'Task2Text', 1),
(3, 'Task3', 'task3@test.com', 'Task3Text', 0),
(4, 'Task4', 'task4@test.com', 'Task4ext', 0),
(5, 'test', 'test@email.com', 'asdasasddsadsa dsad sad as', 0),
(6, 'test123123123', 'test@email.com1', 'asda ss dasd ads ad as', 0),
(7, 'test123', 'test@email.com', 'asasd d sad asd sad sa', 0),
(8, 'test22', 'test22@email.com', 'Test22', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `as12_user`
--

CREATE TABLE `as12_user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `as12_user`
--

INSERT INTO `as12_user` (`user_id`, `login`, `password`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `as12_task`
--
ALTER TABLE `as12_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Индексы таблицы `as12_user`
--
ALTER TABLE `as12_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `as12_task`
--
ALTER TABLE `as12_task`
  MODIFY `task_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `as12_user`
--
ALTER TABLE `as12_user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
