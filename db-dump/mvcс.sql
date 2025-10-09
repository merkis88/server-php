-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 09 2025 г., 19:15
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `price`, `isbn`, `description`, `image`) VALUES
(1, 'Лес', 'Светлана Тюльбашева', '2024', 855.00, '193-28342-834897', 'Две москвички заблудились в карельском лесу. В заброшенный деревенский дом заселилась одна дружная, но очень странная семья. &quot;Лес&quot; - это идеально сконструированный хоррор про ужасы, которые таятся и в дикой глуши, и в самых обычных людях - и неизвестно ещё, какие из них страшнее.', '1746976453_Forest.jpg'),
(2, 'Хребты безумия', 'Говард Филлипс Лавкрафт', '2025', 689.00, '978-5-17-099120-4', 'При жизни этот писатель не опубликовал ни одной книги, после смерти став кумиром как массового читателя, так и искушенного эстета, и неиссякаемым источником вдохновения для кино- и игровой индустрии; его называли «Эдгаром По ХХ века», гениальным безумцем и адептом тайных знаний; его творчество уникально настолько, что потребовало выделения в отдельный поджанр; им восхищались Роберт Говард и Клайв Баркер, Хорхе Луис Борхес и Айрис Мёрдок; Один из самых влиятельных мифотворцев современности, человек, оказавший влияние не только на литературу, но и на массовую культуру в целом, создатель «Некрономикона» и «Мифов Ктулху» — Говард Филлипс Лавкрафт.', '1746976609_Lavkraft.jpg'),
(3, 'Токсичный', 'Николь Бланшар', '2025', 643.00, '978-5-17-173110-6', 'Грэйсин Кингсли был просто еще одним пациентом. Преступником.  Как тюремная медсестра, я знала правила: делай свою работу, не вмешивайся в происходящее и никогда не позволяй заключенному проникнуть себе в душу.  Я нарушила все три.  Моя страсть, моя одержимость, моя зависимость. Я рисковала своей жизнью, чтобы мы могли быть вместе. Я думала, что помочь ему сбежать из тюрьмы будет самой трудной частью.  Оказывается, когда влюбляешься в злодея, ты тоже переходишь на сторону зла', '1747119933_skull.jpg'),
(4, 'выаываыва', 'цукцукцукцукцу', 'цйуйцуйцу', 0.00, 'йцуйцуйцу', 'ыаываываыва', '1747123143_Vector 154 (1).png');

-- --------------------------------------------------------

--
-- Структура таблицы `issueds`
--

CREATE TABLE `issueds` (
  `id` int(11) NOT NULL,
  `issuedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `returnDate` datetime DEFAULT NULL,
  `readerID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `isReturned` tinyint(1) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `issueds`
--

INSERT INTO `issueds` (`id`, `issuedDate`, `returnDate`, `readerID`, `bookID`, `isReturned`, `userID`) VALUES
(1, '2025-05-13 08:57:24', '2025-05-13 09:00:37', 3, 2, 1, NULL),
(2, '2025-05-13 08:58:22', NULL, 4, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `readers`
--

CREATE TABLE `readers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `patronymic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `readers`
--

INSERT INTO `readers` (`id`, `firstName`, `lastName`, `address`, `phone`, `patronymic`) VALUES
(1, 'Иван', 'Иванов ', 'ул. Тутуева', '8', 'Иванович'),
(2, 'Виктор', 'Смирнов', 'ул. Пушкина д31', 'Витёк228', 'Александрович'),
(3, 'Евкакий', 'Филантропов', 'ул. Кутузова', '89666728891', 'Аганасьевич'),
(4, 'Алексей', 'Базанов', 'ул. Пермь', '1', 'Александрович'),
(5, 'Имя', 'Фамилия', 'ул. Кутузова', '89527879127', 'Отчество');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `patronymic` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roleID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `api_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `patronymic`, `phone`, `login`, `password`, `roleID`, `name`, `api_token`) VALUES
(14, 'Виктор', 'Гой', 'Ярославович', '9765465469', 'goy', '202cb962ac59075b964b07152d234b70', 2, '', NULL),
(16, 'Игнат', 'Картошкин', 'Анатольевич', '89527879127', 'login', '202cb962ac59075b964b07152d234b70', 2, '', NULL),
(18, 'Admin', 'Adminov', NULL, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Администратор', 'e92da1dc01d2e5edf5be423f4c57bf6345cff237d2c8a5a72c4c952b11d26b67'),
(19, 'Иван', 'Иванов', 'Иванович', '88888888888', 'iv', '8068c76c7376bc08e2836ab26359d4a4', 2, '', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `issueds`
--
ALTER TABLE `issueds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reader` (`readerID`),
  ADD KEY `fk_book` (`bookID`),
  ADD KEY `userID` (`userID`);

--
-- Индексы таблицы `readers`
--
ALTER TABLE `readers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `issueds`
--
ALTER TABLE `issueds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `readers`
--
ALTER TABLE `readers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `issueds`
--
ALTER TABLE `issueds`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`bookID`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reader` FOREIGN KEY (`readerID`) REFERENCES `readers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issueds_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

