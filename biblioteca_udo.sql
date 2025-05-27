-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2025 a las 00:01:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca_udo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autors`
--

CREATE TABLE `autors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci_autor` varchar(8) NOT NULL,
  `nombre_autor` varchar(250) NOT NULL,
  `apellido_autor` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `autors`
--

INSERT INTO `autors` (`id`, `ci_autor`, `nombre_autor`, `apellido_autor`, `created_at`, `updated_at`) VALUES
(1, '12345678', 'Registro', 'De Autor', '2025-05-20 21:41:48', '2025-05-20 21:41:48'),
(2, '10101010', 'Juan Antonio', 'Perez', '2025-05-21 03:34:37', '2025-05-21 03:34:37'),
(3, '30040201', 'Gabriel', 'Perdomo', '2025-05-21 20:55:52', '2025-05-21 20:55:52'),
(5, '64985235', 'Artemio', 'Franchi', '2025-05-25 23:55:31', '2025-05-25 23:55:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor_ficha`
--

CREATE TABLE `autor_ficha` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ficha_id` bigint(20) UNSIGNED NOT NULL,
  `autor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `autor_ficha`
--

INSERT INTO `autor_ficha` (`id`, `ficha_id`, `autor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(17, 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Ingenieria en Sistemas', '2025-05-20 21:41:48', '2025-05-20 21:41:48'),
(2, 'Ingeniería Civil', '2025-05-21 23:25:07', '2025-05-21 23:25:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

CREATE TABLE `fichas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(900) NOT NULL,
  `fecha` date NOT NULL,
  `carrera_id` bigint(20) UNSIGNED NOT NULL,
  `resumen` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`id`, `titulo`, `fecha`, `carrera_id`, `resumen`, `created_at`, `updated_at`) VALUES
(1, 'Titulo 1', '2023-10-01', 1, 'Resumen de la ficha 1', '2025-05-20 21:41:48', '2025-05-20 21:41:48'),
(2, 'Ejemplo #2', '2025-05-08', 1, 'Ejemplo #2', '2025-05-21 03:35:09', '2025-05-21 03:35:09'),
(3, 'Heladería', '2025-05-08', 2, 'Otro Trabajo', '2025-05-21 20:55:52', '2025-05-26 02:28:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infopers`
--

CREATE TABLE `infopers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci_us` varchar(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `infopers`
--

INSERT INTO `infopers` (`id`, `ci_us`, `nombre`, `apellido`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '12345678', 'Test', 'User', 1, '2025-05-20 21:41:48', '2025-05-20 21:41:48'),
(3, '87654321', 'Administrador', 'Administrante', 3, '2025-05-27 22:00:19', '2025-05-27 22:00:19'),
(4, '12121212', 'Usuario', 'Usuario', 4, '2025-05-27 22:01:07', '2025-05-27 22:01:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_18_173034_create_infopers_table', 1),
(5, '2025_04_05_181743_create_carreras_table', 1),
(6, '2025_04_06_181744_create_fichas_table', 1),
(7, '2025_04_06_183353_create_autors_table', 1),
(8, '2025_04_13_191831_create_autor_ficha_table', 1),
(9, '2025_05_06_224752_create_preguntas_user_table', 1),
(10, '2025_05_07_201809_create_permission_tables', 1),
(11, '2025_05_20_163318_create_prestamos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_user`
--

CREATE TABLE `preguntas_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pregunta_uno` varchar(255) NOT NULL,
  `respuesta_uno` varchar(255) NOT NULL,
  `pregunta_dos` varchar(255) NOT NULL,
  `respuesta_dos` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas_user`
--

INSERT INTO `preguntas_user` (`id`, `user_id`, `pregunta_uno`, `respuesta_uno`, `pregunta_dos`, `respuesta_dos`, `created_at`, `updated_at`) VALUES
(1, 1, '¿Cuál es tu color favorito?', 'Azul', '¿Cuál es tu animal favorito?', 'Gato', '2025-05-20 21:41:48', '2025-05-22 20:17:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ficha_id` bigint(20) UNSIGNED NOT NULL,
  `ci_prestatario` varchar(8) NOT NULL,
  `nombre_prestatario` varchar(255) NOT NULL,
  `apellido_prestatario` varchar(255) NOT NULL,
  `tlf_prestatario` varchar(255) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `estado` enum('prestado','devuelto') NOT NULL DEFAULT 'prestado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `ficha_id`, `ci_prestatario`, `nombre_prestatario`, `apellido_prestatario`, `tlf_prestatario`, `fecha_prestamo`, `fecha_devolucion`, `fecha_entrega`, `estado`, `created_at`, `updated_at`) VALUES
(2, 2, '15092192', 'Gilberto', 'Torrealba', '04129287626', '2025-05-02', '2025-05-14', '2025-05-21', 'devuelto', '2025-05-21 03:35:58', '2025-05-21 04:16:50'),
(5, 1, '28668715', 'Ricardo Agustín', 'Álvarez Blanco', '04249086796', '2025-05-17', '2025-05-21', '2025-05-21', 'devuelto', '2025-05-21 04:38:32', '2025-05-21 04:38:36'),
(10, 2, '32019283', 'Antonio', 'Camargo', '04249182947', '2025-05-14', '2025-05-23', '2025-05-22', 'devuelto', '2025-05-22 18:55:09', '2025-05-22 18:55:14'),
(11, 2, '28668715', 'Ricardo Agustín', 'Álvarez Blanco', '04249086796', '2025-05-02', '2025-05-09', '2025-05-25', 'devuelto', '2025-05-25 22:10:32', '2025-05-25 22:26:50'),
(12, 1, '28668715', 'Raúl', 'Torrealba', '04222224444', '2025-05-24', '2025-05-31', '2025-05-27', 'devuelto', '2025-05-25 22:27:15', '2025-05-27 21:23:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'web', '2025-05-20 21:41:48', '2025-05-20 21:41:48'),
(3, 'MASTER', 'web', '2025-05-27 21:52:17', '2025-05-27 21:52:17'),
(4, 'USER', 'web', '2025-05-27 21:56:19', '2025-05-27 21:56:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UvkY5ZrcM2xu323BGP8McK5sa9AkVsZtJjoGQxgi', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYnVyZmJXVkNYOFFxZEw4azhZVGdleUdIbGw3R0hkaVdsSHBubXlhaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9iaWJsaW8vcHVibGljL2FkbWluL3VzdWFyaW9zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NDgzODA5ODE7fX0=', 1748383268);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'MASTER', 'test@example.com', '2025-05-20 21:41:48', '$2y$12$SBUriDgZYL7xGkfhrNt6fev2x/WvyqcX0Ju1Q5oBI59BKetBWbWn2', 'gLshbemXK6tk6eN5vEeBdboi72koAgEGUQkxavb5ZbcHeGQbPrbaOoNmFn2k', '2025-05-20 21:41:48', '2025-05-27 21:52:04'),
(3, 'ADMIN', 'admin@admin.com', NULL, '$2y$12$44BT/GoJTJWJpR/OD1IqveQTlCttugyrPX.hBkinehApR5zRsuyw6', NULL, '2025-05-27 22:00:19', '2025-05-27 22:00:19'),
(4, 'USER', 'user@user.com', NULL, '$2y$12$rqQFIvk5WFF27L1X97xMdu0D5abqkP45LQR4WEGMngA9MxKABT.ga', NULL, '2025-05-27 22:01:07', '2025-05-27 22:01:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autors`
--
ALTER TABLE `autors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `autors_ci_autor_unique` (`ci_autor`);

--
-- Indices de la tabla `autor_ficha`
--
ALTER TABLE `autor_ficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor_ficha_ficha_id_foreign` (`ficha_id`),
  ADD KEY `autor_ficha_autor_id_foreign` (`autor_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fichas_carrera_id_foreign` (`carrera_id`);

--
-- Indices de la tabla `infopers`
--
ALTER TABLE `infopers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `infopers_ci_us_unique` (`ci_us`),
  ADD KEY `infopers_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `preguntas_user`
--
ALTER TABLE `preguntas_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `preguntas_user_user_id_unique` (`user_id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestamos_ficha_id_foreign` (`ficha_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autors`
--
ALTER TABLE `autors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `autor_ficha`
--
ALTER TABLE `autor_ficha`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `infopers`
--
ALTER TABLE `infopers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas_user`
--
ALTER TABLE `preguntas_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autor_ficha`
--
ALTER TABLE `autor_ficha`
  ADD CONSTRAINT `autor_ficha_autor_id_foreign` FOREIGN KEY (`autor_id`) REFERENCES `autors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `autor_ficha_ficha_id_foreign` FOREIGN KEY (`ficha_id`) REFERENCES `fichas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fichas_carrera_id_foreign` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `infopers`
--
ALTER TABLE `infopers`
  ADD CONSTRAINT `infopers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `preguntas_user`
--
ALTER TABLE `preguntas_user`
  ADD CONSTRAINT `preguntas_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ficha_id_foreign` FOREIGN KEY (`ficha_id`) REFERENCES `fichas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
