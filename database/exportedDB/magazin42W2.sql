-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 30 2022 г., 08:15
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `magazin42W2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `count` int NOT NULL DEFAULT '0',
  `summ` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `order_id`, `count`, `summ`, `created_at`, `updated_at`) VALUES
(1, 24, 1, 1, 429.00, '2022-11-22 07:55:45', '2022-11-22 07:55:45'),
(2, 25, 1, 1, 249.00, '2022-11-22 07:55:49', '2022-11-22 07:55:49'),
(3, 23, 2, 4, 996.00, '2022-11-22 07:58:03', '2022-11-22 08:11:02'),
(7, 24, 5, 10, 4290.00, '2022-11-22 10:11:15', '2022-11-22 10:11:26');

-- --------------------------------------------------------

--
-- Структура таблицы `categries`
--

CREATE TABLE `categries` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categries`
--

INSERT INTO `categries` (`id`, `title`, `created_at`, `updated_at`) VALUES
(2, 'DC', '2022-11-08 02:53:22', '2022-11-08 02:53:22'),
(3, 'Marvel', '2022-11-08 02:53:37', '2022-11-08 02:53:37');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_21_101334_create_categries_table', 1),
(6, '2022_10_21_101358_create_products_table', 1),
(7, '2022_10_21_101414_create_orders_table', 1),
(8, '2022_10_21_101434_create_carts_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `summ` double(8,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'новый',
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `summ`, `status`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 678.00, 'подтверждён', NULL, '2022-11-22 07:55:45', '2022-11-22 08:43:08'),
(2, 2, 996.00, 'подтверждён', NULL, '2022-11-22 07:58:03', '2022-11-22 08:45:44'),
(5, 2, 4290.00, 'подтверждён', NULL, '2022-11-22 10:11:15', '2022-11-22 10:12:19');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categry_id` bigint UNSIGNED NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` date DEFAULT NULL,
  `antagonist` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `categry_id`, `img`, `age`, `antagonist`, `price`, `count`, `created_at`, `updated_at`) VALUES
(3, 'Человек паук', 3, '/storage/public/img/eSbQbl9iJyZdTBFlv9he9ibwbu7LB6tvLOu58wRj.jpg', '2013-01-10', 'Злодеи', 299.00, 53, '2022-11-09 02:21:23', '2022-11-09 02:21:23'),
(4, 'Человек паук - вечная юность', 3, '/storage/public/img/wtDjwaQvRVYpZBMlPQRDHXtBhOTg5ohjfklNQzZp.jpg', '2006-02-23', 'Злодеи', 199.00, 231, '2022-11-09 02:31:43', '2022-11-09 02:31:43'),
(5, 'Бэтмен', 2, '/storage/public/img/oWTgplODmYxDKvEbV70tnEEw5U0FGntn4v4iZIEC.jpg', '2011-02-10', 'Джокер', 349.00, 125, '2022-11-09 02:58:19', '2022-11-09 02:58:19'),
(6, 'Бэтмен который смеётся', 2, '/storage/public/img/Vy5sBJvbWP5RS6L3HyfYsy7C84bNdTuxiYz0mpcR.jpg', '2012-02-23', 'Бэтмен', 349.00, 213, '2022-11-09 03:00:21', '2022-11-09 03:00:21'),
(7, 'Мстители', 3, '/storage/public/img/kfBuUK4wz4K3mY8BP6tixSop2qp0XhiZu9PkWuV5.jpg', '2004-07-03', 'Злодеи', 299.00, 132, '2022-11-09 03:04:52', '2022-11-09 03:04:52'),
(10, 'Amazing Spider Man', 3, '/storage/public/img/8IuSL9BC2jDr3FCo07oeJLYojplmQMcjhjjahJGR.jpg', '2011-02-21', NULL, 439.50, 23, '2022-11-11 09:12:41', '2022-11-11 09:12:41'),
(16, 'Бэтмен перерождение (2016)', 2, '/storage/public/img/wMheFT0Uoq5TH8PizXELuB6pAN7pmkJEdE8r9zYH.jpg', '2016-01-31', NULL, 459.50, 42, '2022-11-12 06:57:30', '2022-11-12 06:57:30'),
(17, 'Batman', 2, '/storage/public/img/00n6ocsQPEismwY7HBTZ44aa6eDWpOo8v5UH9H5w.jpg', '2014-06-26', NULL, 349.99, 23, '2022-11-12 06:59:08', '2022-11-12 06:59:08'),
(18, 'Avengers - earth\'s mightiest heroes', 3, '/storage/public/img/sB1IoBP3wpDUsdOaD7DYfb5VDe6JsxCjuCIR0hc9.jpg', NULL, NULL, 324.90, 12, '2022-11-12 07:03:33', '2022-11-12 07:03:33'),
(19, 'Avengers', 3, '/storage/public/img/SeHmMXXB5nmRqAV4i0MIaTbkGsy6yCF7FyglWgNx.jpg', NULL, NULL, 499.00, 17, '2022-11-12 07:04:05', '2022-11-12 07:04:05'),
(20, 'Мстители - перчатка бесконечности', 3, '/storage/public/img/HOyXL4BD8TDtiZgLDBqPEtPMZzAx0GZIeGrxmpq7.jpg', NULL, NULL, 299.00, 42, '2022-11-12 07:04:56', '2022-11-12 07:04:56'),
(21, 'Spider-Man', 3, '/storage/public/img/4f8vPTUPScm1CcG6qQoHmDEnyuz0hCxEkyr1yPdl.jpg', NULL, NULL, 399.50, 13, '2022-11-12 07:05:59', '2022-11-12 07:05:59'),
(22, 'Detective Comics: 80 Years of Batman Deluxe Edition', 2, '/storage/public/img/UpetdbwDsDCP6RqCRnGPvw2EWjfClBIKfT9iJ2wC.jpg', NULL, NULL, 349.00, 124, '2022-11-12 08:11:20', '2022-11-12 08:11:20'),
(23, 'Secret Origin: The Story of DC Comics', 2, '/storage/public/img/CyzRK27UI9aAR9fdnuDG4BZBw5jyZEb2Fc3TxBiN.jpg', NULL, NULL, 249.00, 48, '2022-11-12 08:12:54', '2022-11-22 08:45:44'),
(24, 'Superman: Secret Origin Deluxe Edition', 2, '/storage/public/img/StrORdGPsATYKVBCqJmI8PtieCMr3JVoLiel2wZo.jpg', NULL, NULL, 429.00, 12, '2022-11-12 08:13:56', '2022-11-22 10:13:08'),
(25, 'DC COMICS: Generaciones', 2, '/storage/public/img/eKJ7UDuFsrfcccl0OrtCT1mzzO6mE7vg0ovVSRYh.jpg', NULL, NULL, 249.00, 141, '2022-11-12 08:16:35', '2022-11-22 08:43:08'),
(33, 'Паукогеддон', 3, '/storage/public/img/5Wn5wuf6rJrqtxmmRjrgASNE2Zx5Aa91AgUgWwD6.jpg', '2019-01-11', NULL, 229.90, 134, '2022-11-30 01:48:05', '2022-11-30 01:48:05');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Иван', 'Иванов', 'Иванович', 'ivan', 'ivan222@fgd.fd', 'e10adc3949ba59abbe56e057f20f883e', 'user', NULL, '2022-11-02 02:34:04', '2022-11-02 02:34:04'),
(2, 'Виктор', 'Викторов', 'Викторович', 'admin', 'email@sdf.copm', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL, '2022-11-08 02:51:33', '2022-11-08 02:51:33');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_order_id_foreign` (`order_id`);

--
-- Индексы таблицы `categries`
--
ALTER TABLE `categries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categries_title_unique` (`title`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_categry_id_foreign` (`categry_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_login_unique` (`login`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `categries`
--
ALTER TABLE `categries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_categry_id_foreign` FOREIGN KEY (`categry_id`) REFERENCES `categries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
