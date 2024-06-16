-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 01 2024 г., 20:56
-- Версия сервера: 5.7.33-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `спортивный клуб`
--

-- --------------------------------------------------------

--
-- Структура таблицы `captcha`
--

CREATE TABLE `captcha` (
  `id_cap` int(2) NOT NULL,
  `url_cap` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_cap` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `captcha`
--

INSERT INTO `captcha` (`id_cap`, `url_cap`, `text_cap`) VALUES
(1, 'https://captcha.com/images/captcha/botdetect3-captcha-neon.jpg', 'D4TSH'),
(2, 'https://captcha.com/images/captcha/botdetect3-captcha-caughtinthenet.jpg', 'UXP4D'),
(3, 'https://captcha.com/images/captcha/botdetect3-captcha-caughtinthenet2.jpg', 'PADTC');

-- --------------------------------------------------------

--
-- Структура таблицы `клиенты`
--

CREATE TABLE `клиенты` (
  `Код_клиента` int(11) NOT NULL,
  `ФИО` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Дата_рождения` date DEFAULT NULL,
  `Телефон` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Код_тарифа` int(11) DEFAULT NULL,
  `Логин` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Пароль` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Дата_регистрации` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `клиенты`
--

INSERT INTO `клиенты` (`Код_клиента`, `ФИО`, `Дата_рождения`, `Телефон`, `Код_тарифа`, `Логин`, `Пароль`, `Дата_регистрации`) VALUES
(1, 'Иванова Анна Петровна', '1995-05-15', '+79101234567', NULL, 'login1', 'pas1', '2024-05-07'),
(2, 'Смирнов Игорь Владимирович', '1990-10-20', '+79102345678', NULL, 'login2', 'pas2', '2024-05-08'),
(3, 'Козлова Елена Сергеевна', '1988-03-07', '+79103456789', NULL, 'login3', 'pas3', '2024-05-08'),
(4, 'ыфвыфвв', '2024-05-08', '23122', NULL, 'user1', 'ladawest', '2024-05-25');

-- --------------------------------------------------------

--
-- Структура таблицы `планирование`
--

CREATE TABLE `планирование` (
  `Код_записи` int(11) NOT NULL,
  `Код_клиента` int(11) DEFAULT NULL,
  `Код_тренировки` int(11) DEFAULT NULL,
  `Дата` date DEFAULT NULL,
  `Отметка_о_посещении` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `планирование`
--

INSERT INTO `планирование` (`Код_записи`, `Код_клиента`, `Код_тренировки`, `Дата`, `Отметка_о_посещении`) VALUES
(1, 1, 1, '2024-03-17', 1),
(2, 2, 2, '2024-03-17', 0),
(3, 3, 3, '2024-03-17', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `покупка`
--

CREATE TABLE `покупка` (
  `Код_корзины` int(11) NOT NULL,
  `Код_тренировки` int(11) DEFAULT NULL,
  `Пользователь` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Дата добавления тренировки в корзину` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `покупка`
--

INSERT INTO `покупка` (`Код_корзины`, `Код_тренировки`, `Пользователь`, `Дата добавления тренировки в корзину`) VALUES
(1, 1, 'login1', '2024-05-25 10:26:40'),
(2, 2, 'login1', '2024-05-25 10:26:40');

-- --------------------------------------------------------

--
-- Структура таблицы `адреса`
--

CREATE TABLE `адреса` (
  `Код_адреса` int(11) NOT NULL,
  `Почта` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `График` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Адрес` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Телефон` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `адреса`
--

INSERT INTO `адреса` (`Код_адреса`, `Почта`, `График`, `Адрес`, `Телефон`) VALUES
(1, 'support@example.com', 'Пн-Сб 10:00-20:00', 'Санкт-Петербург, ул. Северная, д. 456', '+0987654321'),
(2, 'sales@example.com', 'Пн-Пт 8:30-17:30', 'Санкт-Петербург, наб. Речной, д. 789', '+1357924680'),
(3, 'contact@example.com', 'Пн-Ср 11:00-19:00', 'Санкт-Петербург, пер. Центральный, д. 321', '+2468135790'),
(4, 'service@example.com', 'Пн-Пт 9:30-18:30', 'Санкт-Петербург, просп. Главный, д. 654', '+3698521470'),
(5, 'billing@example.com', 'Пн-Сб 9:00-17:00', 'Санкт-Петербург, ул. Южная, д. 987', '+9876543210');

-- --------------------------------------------------------

--
-- Структура таблицы `галерея`
--

CREATE TABLE `галерея` (
  `Код_картинки` int(11) NOT NULL,
  `Ссылка` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `галерея`
--

INSERT INTO `галерея` (`Код_картинки`, `Ссылка`) VALUES
(1, 'https://259506.selcdn.ru/sites-static/site533845/4f25578d-f373-436e-8088-b4eda41c91d9/4f25578d-f373-436e-8088-b4eda41c91d9-561696.jpeg'),
(2, 'https://259506.selcdn.ru/sites-static/site533845/8dee5705-4ff0-4b3a-93a7-cbdb4de442e6/8dee5705-4ff0-4b3a-93a7-cbdb4de442e6-561691.jpeg'),
(3, 'https://259506.selcdn.ru/sites-static/site533845/6fcf9dac-3762-46c7-98fa-87a90abefa5f/6fcf9dac-3762-46c7-98fa-87a90abefa5f-561684.jpeg'),
(4, 'https://259506.selcdn.ru/sites-static/site533845/e189927d-1ebc-4fd3-8a03-897cc1969d23/e189927d-1ebc-4fd3-8a03-897cc1969d23-561683.jpeg'),
(5, 'https://259506.selcdn.ru/sites-static/site533845/45d6f414-03ac-4e4e-a011-8df39ac56243/45d6f414-03ac-4e4e-a011-8df39ac56243-561670.jpeg'),
(6, 'https://259506.selcdn.ru/sites-static/site533845/b34b46df-f7b5-48bb-8391-705caf144d36/b34b46df-f7b5-48bb-8391-705caf144d36-561715.jpeg'),
(7, 'https://259506.selcdn.ru/sites-static/site533845/8896c5cf-f89e-426f-8ef8-b9b90b3d78fa/8896c5cf-f89e-426f-8ef8-b9b90b3d78fa-849303.jpeg'),
(1, 'https://259506.selcdn.ru/sites-static/site533845/4f25578d-f373-436e-8088-b4eda41c91d9/4f25578d-f373-436e-8088-b4eda41c91d9-561696.jpeg'),
(2, 'https://259506.selcdn.ru/sites-static/site533845/8dee5705-4ff0-4b3a-93a7-cbdb4de442e6/8dee5705-4ff0-4b3a-93a7-cbdb4de442e6-561691.jpeg'),
(3, 'https://259506.selcdn.ru/sites-static/site533845/6fcf9dac-3762-46c7-98fa-87a90abefa5f/6fcf9dac-3762-46c7-98fa-87a90abefa5f-561684.jpeg'),
(4, 'https://259506.selcdn.ru/sites-static/site533845/e189927d-1ebc-4fd3-8a03-897cc1969d23/e189927d-1ebc-4fd3-8a03-897cc1969d23-561683.jpeg'),
(5, 'https://259506.selcdn.ru/sites-static/site533845/45d6f414-03ac-4e4e-a011-8df39ac56243/45d6f414-03ac-4e4e-a011-8df39ac56243-561670.jpeg'),
(6, 'https://259506.selcdn.ru/sites-static/site533845/b34b46df-f7b5-48bb-8391-705caf144d36/b34b46df-f7b5-48bb-8391-705caf144d36-561715.jpeg'),
(7, 'https://259506.selcdn.ru/sites-static/site533845/8896c5cf-f89e-426f-8ef8-b9b90b3d78fa/8896c5cf-f89e-426f-8ef8-b9b90b3d78fa-849303.jpeg'),
(1, 'https://259506.selcdn.ru/sites-static/site533845/4f25578d-f373-436e-8088-b4eda41c91d9/4f25578d-f373-436e-8088-b4eda41c91d9-561696.jpeg'),
(2, 'https://259506.selcdn.ru/sites-static/site533845/8dee5705-4ff0-4b3a-93a7-cbdb4de442e6/8dee5705-4ff0-4b3a-93a7-cbdb4de442e6-561691.jpeg'),
(3, 'https://259506.selcdn.ru/sites-static/site533845/6fcf9dac-3762-46c7-98fa-87a90abefa5f/6fcf9dac-3762-46c7-98fa-87a90abefa5f-561684.jpeg'),
(4, 'https://259506.selcdn.ru/sites-static/site533845/e189927d-1ebc-4fd3-8a03-897cc1969d23/e189927d-1ebc-4fd3-8a03-897cc1969d23-561683.jpeg'),
(5, 'https://259506.selcdn.ru/sites-static/site533845/45d6f414-03ac-4e4e-a011-8df39ac56243/45d6f414-03ac-4e4e-a011-8df39ac56243-561670.jpeg'),
(6, 'https://259506.selcdn.ru/sites-static/site533845/b34b46df-f7b5-48bb-8391-705caf144d36/b34b46df-f7b5-48bb-8391-705caf144d36-561715.jpeg'),
(7, 'https://259506.selcdn.ru/sites-static/site533845/8896c5cf-f89e-426f-8ef8-b9b90b3d78fa/8896c5cf-f89e-426f-8ef8-b9b90b3d78fa-849303.jpeg'),
(1, 'https://259506.selcdn.ru/sites-static/site533845/4f25578d-f373-436e-8088-b4eda41c91d9/4f25578d-f373-436e-8088-b4eda41c91d9-561696.jpeg'),
(2, 'https://259506.selcdn.ru/sites-static/site533845/8dee5705-4ff0-4b3a-93a7-cbdb4de442e6/8dee5705-4ff0-4b3a-93a7-cbdb4de442e6-561691.jpeg'),
(3, 'https://259506.selcdn.ru/sites-static/site533845/6fcf9dac-3762-46c7-98fa-87a90abefa5f/6fcf9dac-3762-46c7-98fa-87a90abefa5f-561684.jpeg'),
(4, 'https://259506.selcdn.ru/sites-static/site533845/e189927d-1ebc-4fd3-8a03-897cc1969d23/e189927d-1ebc-4fd3-8a03-897cc1969d23-561683.jpeg'),
(5, 'https://259506.selcdn.ru/sites-static/site533845/45d6f414-03ac-4e4e-a011-8df39ac56243/45d6f414-03ac-4e4e-a011-8df39ac56243-561670.jpeg'),
(6, 'https://259506.selcdn.ru/sites-static/site533845/b34b46df-f7b5-48bb-8391-705caf144d36/b34b46df-f7b5-48bb-8391-705caf144d36-561715.jpeg'),
(7, 'https://259506.selcdn.ru/sites-static/site533845/8896c5cf-f89e-426f-8ef8-b9b90b3d78fa/8896c5cf-f89e-426f-8ef8-b9b90b3d78fa-849303.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `новости`
--

CREATE TABLE `новости` (
  `Код_новости` int(11) NOT NULL,
  `Заголовок` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Текст` text COLLATE utf8mb4_unicode_ci,
  `Ссылка` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `новости`
--

INSERT INTO `новости` (`Код_новости`, `Заголовок`, `Текст`, `Ссылка`) VALUES
(1, 'Новый рекорд в мировом футболе: команда \"Галактика\" побила исторический рекорд', 'Вв захватывающем матче команда \"Галактика\" достигла новой высоты, побив исторический рекорд в мировом футболе. Их неудержимый дух и уникальная командная работа заставляют зрителей мечтать и вдохновляют молодое поколение спортсменов.', 'https://www.youtube.com/embed/5nA7RY9sASU'),
(3, 'Подъем новой звезды: юная теннисистка с поразительным талантом', 'Мир тенниса встречает новую звезду – юную талантливую игроку, чьи невероятные навыки и страсть к игре оставляют за собой след в сердцах болельщиков. Ее стремление к совершенству и преданность спорту делают ее вдохновением для многих.', 'https://www.youtube.com/embed/6ApDvzJpm3Y'),
(4, 'павпааппа', 'пкппапкауап', 'пкпкппп');

-- --------------------------------------------------------

--
-- Структура таблицы `расписание_тренировок`
--

CREATE TABLE `расписание_тренировок` (
  `Код_тренировки` int(11) NOT NULL,
  `Название_тренировки` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `День_недели` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Время_начала` time DEFAULT NULL,
  `Продолжительность` int(11) DEFAULT NULL,
  `Код_сотрудника` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `расписание_тренировок`
--

INSERT INTO `расписание_тренировок` (`Код_тренировки`, `Название_тренировки`, `День_недели`, `Время_начала`, `Продолжительность`, `Код_сотрудника`) VALUES
(1, 'Кардио', 'Понедельник', '09:00:00', 60, 1),
(2, 'Силовая тренировка', 'Среда', '18:00:00', 90, 1),
(3, 'Степ-аэробика', 'Пятница', '17:30:00', 60, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `сотрудники`
--

CREATE TABLE `сотрудники` (
  `Код_сотрудника` int(11) NOT NULL,
  `ФИО` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Должность` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Зарплата` decimal(10,2) DEFAULT NULL,
  `Логин` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Пароль` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `сотрудники`
--

INSERT INTO `сотрудники` (`Код_сотрудника`, `ФИО`, `Должность`, `Зарплата`, `Логин`, `Пароль`) VALUES
(1, 'Петров Алексей Николаевич', 'Тренер', '1500.00', 'log1', 'pas1'),
(2, 'Сидорова Мария Ивановна', 'Администратор', '1200.00', 'log2', 'pas2'),
(3, 'Кузнецов Игорь Павлович', 'Массажист', '1300.00', 'log3', 'pas3');

-- --------------------------------------------------------

--
-- Структура таблицы `тарифные_планы`
--

CREATE TABLE `тарифные_планы` (
  `Название_тарифа` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Описание` text COLLATE utf8mb4_unicode_ci,
  `Стоимость` decimal(10,2) DEFAULT NULL,
  `Код_тарифа` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `тарифные_планы`
--

INSERT INTO `тарифные_планы` (`Название_тарифа`, `Описание`, `Стоимость`, `Код_тарифа`) VALUES
('Базовый', 'Доступ к залу и тренировкам', '5000.00', 1),
('Продвинутый', 'Дополнительно доступ к тренажерам и персональному тренеру', '8000.00', 2),
('VIP', 'Полный доступ ко всем услугам клуба', '12000.00', 3),
('апыцпвакпца', 'апап', '1212.00', 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `клиенты`
--
ALTER TABLE `клиенты`
  ADD PRIMARY KEY (`Код_клиента`),
  ADD KEY `FK_Клиенты_Тарифные_планы` (`Код_тарифа`);

--
-- Индексы таблицы `планирование`
--
ALTER TABLE `планирование`
  ADD PRIMARY KEY (`Код_записи`),
  ADD KEY `FK_Планирование_Клиенты` (`Код_клиента`),
  ADD KEY `FK_Планирование_Расписание_тренировок` (`Код_тренировки`);

--
-- Индексы таблицы `покупка`
--
ALTER TABLE `покупка`
  ADD PRIMARY KEY (`Код_корзины`);

--
-- Индексы таблицы `новости`
--
ALTER TABLE `новости`
  ADD PRIMARY KEY (`Код_новости`);

--
-- Индексы таблицы `расписание_тренировок`
--
ALTER TABLE `расписание_тренировок`
  ADD PRIMARY KEY (`Код_тренировки`),
  ADD KEY `FK_Расписание_тренировок_Сотрудники` (`Код_сотрудника`);

--
-- Индексы таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  ADD PRIMARY KEY (`Код_сотрудника`);

--
-- Индексы таблицы `тарифные_планы`
--
ALTER TABLE `тарифные_планы`
  ADD PRIMARY KEY (`Код_тарифа`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `клиенты`
--
ALTER TABLE `клиенты`
  MODIFY `Код_клиента` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `покупка`
--
ALTER TABLE `покупка`
  MODIFY `Код_корзины` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `новости`
--
ALTER TABLE `новости`
  MODIFY `Код_новости` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `тарифные_планы`
--
ALTER TABLE `тарифные_планы`
  MODIFY `Код_тарифа` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `клиенты`
--
ALTER TABLE `клиенты`
  ADD CONSTRAINT `FK_Клиенты_Тарифные_планы` FOREIGN KEY (`Код_тарифа`) REFERENCES `тарифные_планы` (`Код_тарифа`);

--
-- Ограничения внешнего ключа таблицы `планирование`
--
ALTER TABLE `планирование`
  ADD CONSTRAINT `FK_Планирование_Клиенты` FOREIGN KEY (`Код_клиента`) REFERENCES `клиенты` (`Код_клиента`),
  ADD CONSTRAINT `FK_Планирование_Расписание_тренировок` FOREIGN KEY (`Код_тренировки`) REFERENCES `расписание_тренировок` (`Код_тренировки`);

--
-- Ограничения внешнего ключа таблицы `расписание_тренировок`
--
ALTER TABLE `расписание_тренировок`
  ADD CONSTRAINT `FK_Расписание_тренировок_Сотрудники` FOREIGN KEY (`Код_сотрудника`) REFERENCES `сотрудники` (`Код_сотрудника`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
