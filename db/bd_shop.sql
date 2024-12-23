-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Дек 21 2024 г., 21:13
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bd_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int NOT NULL COMMENT 'ID',
  `name` varchar(90) NOT NULL COMMENT 'Наименование',
  `amount` int NOT NULL COMMENT 'Количество',
  `price` int NOT NULL COMMENT 'Цена',
  `img` varchar(100) DEFAULT NULL COMMENT 'Фото товара'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Товары';

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `amount`, `price`, `img`) VALUES
(1, 'СЬЕСС Шампунь мужской (1 л)\r\n', 295, 445, 'public/img/imageID1.jpg'),
(2, 'MIXIT Шампунь для волос и бальзам - кондиционер', 132, 370, 'public/img/imageID2.jpg'),
(3, 'ARKO Men Гель для бритья Sensitive, 200 мл', 89, 293, 'public/img/imageID3.jpg'),
(4, 'Порошок стиральный автомат Tide Lenor 3 кг', 55, 396, 'public/img/imageID4.jpg'),
(5, 'Порошок стиральный Автомат Tide Альпийская свежесть 6 кг', 76, 700, 'public/img/imageID5.jpg'),
(6, 'Порошок стиральный Автомат Tide Color, 100 стирок, 15 кг', 34, 1551, 'public/img/imageID6.jpg'),
(7, 'Порошок стиральный Автомат Ariel Горный родник 3 кг', 69, 449, 'public/img/imageID7.jpg'),
(8, 'Сухой корм для домашних кошек Мираторг, 2,6 кг', 76, 1105, 'public/img/imageID8.jpg'),
(9, 'Влажный корм для кошек Мираторг с говядиной, 24 шт', 47, 668, 'public/img/imageID9.jpg'),
(10, 'FAIRY Средство для мытья посуды Нежные руки 4.05л', 378, 634, 'public/img/imageID10.jpg'),
(11, 'Средство для мытья посуды Mama Ultimate лимон 5 л. ', 129, 706, 'public/img/imageID11.jpg'),
(12, 'Средство Dany для мытья посуды 3 литра', 64, 352, 'public/img/imageID12.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL COMMENT 'ID',
  `lastName` varchar(60) NOT NULL COMMENT 'Фамилия',
  `firstName` varchar(60) NOT NULL COMMENT 'Имя',
  `sureName` varchar(70) NOT NULL COMMENT 'Отчество',
  `email` varchar(90) NOT NULL COMMENT 'Почта',
  `orderName` varchar(128) NOT NULL COMMENT 'Заказ',
  `amount` int NOT NULL COMMENT 'Количество',
  `userID` int NOT NULL COMMENT 'ID пользователя',
  `address` varchar(90) NOT NULL COMMENT 'Адрес',
  `date` date NOT NULL COMMENT 'Дата',
  `status` varchar(28) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Новое' COMMENT 'Статус'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `lastName`, `firstName`, `sureName`, `email`, `orderName`, `amount`, `userID`, `address`, `date`, `status`) VALUES
(2, 'sklad', 'sklad', 'sklad', 'sklad@gmail.com', 'MIXIT Шампунь для волос и бальзам - кондиционер', 3, 3, 'Москва', '2024-12-18', 'Одобрен'),
(3, 'Сидр', 'Андрей', 'Андреевич', 'andr@gmail.com', 'СЬЕСС Шампунь мужской (1 л)', 3, 7, 'г. Севастополь', '2024-12-21', 'Выполнен'),
(4, 'sklad', 'sklad', 'sklad', 'sklad@gmail.com', 'MIXIT Шампунь для волос и бальзам - кондиционер', 7, 3, 'г. Москва', '2024-12-21', 'Отклонен'),
(6, 'sklad', 'sklad', 'sklad', 'sklad@gmail.com', 'Влажный корм для кошек Мираторг с говядиной, 24 шт', 3, 3, 'г. Феодосия', '2024-12-21', 'Новое'),
(7, 'Сидр', 'Андрей', 'Андреевич', 'andr@gmail.com', 'Средство Dany для мытья посуды 3 литра', 3, 7, 'пгт. Приморский', '2024-12-21', 'Новое');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL COMMENT 'ID',
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Логин',
  `password` varchar(128) NOT NULL COMMENT 'Пароль',
  `firstName` varchar(45) NOT NULL COMMENT 'Имя',
  `lastName` varchar(60) NOT NULL COMMENT 'Фамилия',
  `surName` varchar(60) NOT NULL COMMENT 'Отчество',
  `phone` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Телефон',
  `email` varchar(90) NOT NULL COMMENT 'Почта',
  `type` varchar(16) NOT NULL DEFAULT 'User' COMMENT 'Тип'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstName`, `lastName`, `surName`, `phone`, `email`, `type`) VALUES
(1, 'ivan', '$2y$10$BPY8zIvjpd4LVX7E.936POZONeK8uLLb/MDuOIPzlNVsXtDQj7gL6', 'Ivan', 'Ivanov', 'Ivanovich', '+79786784527', 'ivan@gmail.com', 'User'),
(2, 'Admin', '$2y$10$HkrASDID/NK9MYifupO3HeoNn10S8P.9YrzL30eqfrCC5dowmbkDK', 'Max', 'Maximov', 'Maximovich', '+79786909090', 'maxi@gmail.com', 'Admin'),
(3, 'sklad', '$2y$10$6aqW0SMgqjw3JnApqcVMeeg./JQ/6waqggrWUUNYkmhEzTjDHbHte', 'sklad', 'sklad', 'sklad', '+79789009090', 'sklad@gmail.com', 'Admin'),
(4, 'test', '1234', 'Test', 'Test', 'Test', '+79786909090', 'test@gmail.com', 'User'),
(5, 'TEst22', '$2y$10$YltVHzaVUoFQfJRPTbhdH.AJB/.dMadLP4zIM9PUjso/4UdqC6om2', 'TEst', 'TEst', 'TEst', '+79786909090', 'TEst', 'User'),
(6, 'Test33', '$2y$10$eJsgmIEHimKw/3cdmCXt2OeSysW7yZV0k4Pqjirm/9fWDBx7AeKEK', 'Test', 'Test', 'Test', '+79786909090', 'test@gmail.com', 'User'),
(7, 'sidr', '$2y$10$XQil9y2WQgWz5Gu7x9dpOu10dsWsU2Mmh93P7m7QR1PojKX0HHECa', 'Андрей', 'Сидр', 'Андреевич', '+79786909090', 'andr@gmail.com', 'User');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
