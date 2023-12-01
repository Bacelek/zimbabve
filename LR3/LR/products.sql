-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 29 2023 г., 18:29
-- Версия сервера: 5.6.51
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `products`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Jinbei'),
(2, 'Falcon'),
(3, 'FST');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `img_path` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `id_brand` int(11) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `img_path`, `name`, `id_brand`, `description`, `cost`) VALUES
(1, 'p1.jpg', 'Фон бумажный', 3, 'Бумажный фон , размер 2,72 х 11,0 метров.', 5990),
(2, 'p2.jpg', 'HD-200pro', 1, 'Профессиональный осветитель', 26029),
(3, 'p3.jpg', 'HD-601 500Дж', 1, 'Вспышка Jinbei HD-601', 37519),
(4, 'p4.jpg', 'DPE II-800', 1, 'Jinbei DPE II-800', 18499),
(5, 'p5.jpg', 'EF-300 Bi LED 2700K - 6500K', 1, 'Jinbeis EF-300Bi', 48509),
(6, 'p6.jpg', 'Лампа импульсная', 3, 'Лампа импульсная для студийной вспышки FST F-400', 4050),
(7, 'p7.jpg', 'Зарядное устройство', 1, 'Это зарядное устройство предназначено для зарядки аккумулятора Jinbei MARS-3 Li-ion Battery 2500mAh DC 14.8V.', 549),
(8, 'p8.jpg', 'DPE II-600', 1, 'Jinbei DPE II-600', 16899),
(9, 'p9.png', 'MSN-400 Pro HSS Уценка', 1, 'MSN 400 Pro HSS', 13799),
(10, 'p10.png', 'Eyes Phantom 800 HSS', 2, 'Вспышка студийная Falcon Eyes Phantom 800 HSS', 32070),
(11, 'p11.png', 'MSN-400 Pro HSS', 1, 'MSN 400 Pro HSS', 25999),
(12, 'p12.jpg', 'Eyes SS-150BJM', 2, 'Новая версия вспышек серии SS', 6990),
(13, 'p13.jpg', 'E-180', 3, 'FST E-180 – импульсная студийная вспышка с рефлектором мощностью 180 Дж.', 6500),
(14, 'p14.jpg', 'Eyes GT-280', 2, 'Falcon Eyes GT-280 предлагает владельцу уникальное сочетание характеристик, мобильности и привлекательной цены.', 31860),
(15, 'p15.jpg', 'Eyes Phantom 400 HSS', 2, 'Вспышка студийная Falcon Eyes Phantom 400 HSS', 27690);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `interests` text,
  `linkVK` varchar(255) DEFAULT NULL,
  `bloodType` varchar(255) DEFAULT NULL,
  `RHfactor` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `foreign_key_1` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
