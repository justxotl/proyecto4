-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2025 a las 23:40:55
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
(1, '12345678', 'Autor', 'Autor', '2025-04-14 00:05:30', '2025-04-14 00:05:30'),
(2, '11111111', 'Nuevo', 'Nuevo', '2025-04-14 00:06:47', '2025-05-14 21:41:12'),
(3, '22222222', 'José', 'José', '2025-04-14 00:06:47', '2025-05-14 21:41:29'),
(4, '54545454', 'Juan', 'Rivas', '2025-04-14 01:08:46', '2025-05-14 21:41:50'),
(5, '34957861', 'Antonio', 'Perez', '2025-04-14 01:15:58', '2025-05-10 02:05:58'),
(6, '76948521', 'Manuel', 'Gonzalez', '2025-04-14 01:40:20', '2025-05-14 21:44:07'),
(7, '14798652', 'Pedro', 'Pérez', '2025-04-14 01:40:20', '2025-05-14 21:43:46'),
(9, '30040201', 'Gabriel', 'Perdomo', '2025-05-13 00:46:15', '2025-05-13 00:46:15'),
(10, '28668715', 'Alvarez', 'Ricardo', '2025-05-14 01:15:59', '2025-05-14 01:15:59'),
(11, '2222222', 'José', 'José', '2025-05-15 00:15:53', '2025-05-15 00:15:53'),
(12, '28736583', 'RAUL', 'SANCHEZ', '2025-05-15 03:23:44', '2025-05-15 03:23:44');

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
(38, 5, 6, NULL, NULL),
(39, 5, 7, NULL, NULL),
(40, 7, 5, NULL, NULL),
(46, 8, 6, NULL, NULL),
(47, 10, 9, NULL, NULL),
(48, 11, 6, NULL, NULL),
(52, 12, 6, NULL, NULL),
(53, 12, 1, NULL, NULL),
(54, 13, 6, NULL, NULL),
(55, 13, 1, NULL, NULL),
(56, 13, 2, NULL, NULL),
(57, 9, 6, NULL, NULL),
(58, 14, 3, NULL, NULL),
(59, 14, 10, NULL, NULL),
(60, 15, 10, NULL, NULL),
(61, 15, 9, NULL, NULL),
(65, 2, 1, NULL, NULL),
(66, 2, 11, NULL, NULL),
(67, 2, 4, NULL, NULL),
(68, 16, 12, NULL, NULL),
(69, 16, 4, NULL, NULL),
(70, 1, 4, NULL, NULL),
(71, 17, 2, NULL, NULL),
(72, 18, 10, NULL, NULL),
(73, 19, 9, NULL, NULL);

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
(1, 'Ingenieria de Sistemas', '2025-04-14 00:05:30', '2025-04-14 00:05:30'),
(3, 'Matemáticas Aplicadas', '2025-04-14 02:21:35', '2025-05-10 02:04:24'),
(4, 'Geociencias', '2025-04-30 03:11:57', '2025-05-10 02:04:06'),
(5, 'Ejemplo de Respaldo', '2025-05-11 01:25:39', '2025-05-11 01:25:39'),
(6, 'Tabla', '2025-05-12 01:49:34', '2025-05-12 01:49:34'),
(7, 'Otra Carrera Más', '2025-05-12 02:27:06', '2025-05-12 02:27:06'),
(8, 'Ingeniería Industrial', '2025-05-13 00:17:07', '2025-05-13 00:17:07'),
(9, 'Ludopatía General', '2025-05-13 00:45:54', '2025-05-13 00:45:54'),
(10, 'gané', '2025-05-15 03:24:55', '2025-05-15 03:24:55');

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
  `titulo` varchar(800) NOT NULL,
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
(1, 'asdaklñjsdaljsdk', '2025-01-01', 4, 'asldkuajsldkjasldkajsdlakjsd', '2025-04-14 00:06:47', '2025-04-30 03:12:08'),
(2, 'Agarrando', '2025-04-02', 3, 'AGARRATE', '2025-04-14 01:08:46', '2025-05-15 03:14:38'),
(5, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', '2025-04-08', 1, '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', '2025-04-14 01:40:20', '2025-05-09 23:42:58'),
(7, 'lorem ipsum', '2025-05-02', 3, '\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"', '2025-05-10 02:08:30', '2025-05-10 02:08:30'),
(8, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '2025-05-01', 3, '\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"', '2025-05-10 02:16:17', '2025-05-12 21:32:09'),
(9, 'prueba', '2024-10-09', 6, 'prueba de resumen', '2025-05-12 02:35:50', '2025-05-12 02:35:50'),
(10, 'Ahorro de diamantes profesional.', '2020-09-15', 9, '¿Cómo ahorrar diamantes sin caer en la desesperación?, cinco pasos que te salvarán la vida.', '2025-05-13 00:48:40', '2025-05-13 00:48:40'),
(11, 'Título del Trabajo de Grado de Ingeniería en Sistema', '2025-05-06', 6, 'ad', '2025-05-13 04:32:14', '2025-05-13 04:32:14'),
(12, 'A ver si inserta', '2025-05-13', 5, 'al diablo', '2025-05-13 04:34:16', '2025-05-13 04:34:16'),
(13, 'Nueva Esta', '2022-10-02', 7, 'Manual Técnico', '2025-05-13 04:38:31', '2025-05-13 04:38:31'),
(14, 'Prueba y error', '2025-05-13', 8, 'Resumen', '2025-05-14 01:15:59', '2025-05-14 01:15:59'),
(15, 'Titulo de Ejemplo', '2021-11-21', 5, 'Historia de los Ejemplos', '2025-05-14 21:46:14', '2025-05-14 21:46:14'),
(16, 'VAMOS', '2024-03-30', 4, 'POR FAVOR', '2025-05-15 03:23:44', '2025-05-15 03:23:44'),
(17, 'nuevo', '2023-12-02', 5, 'resumen', '2025-05-15 04:38:26', '2025-05-15 04:38:26'),
(18, 'big brain', '2025-05-15', 1, 'big brain', '2025-05-15 04:45:10', '2025-05-15 04:45:10'),
(19, 'Heladería Kreisel Supra', '2023-06-14', 10, 'Hace helados de verdad en solo minutos', '2025-05-16 21:08:58', '2025-05-16 21:08:58');

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
(1, '12345678', 'Test', 'User', 1, '2025-04-14 00:05:30', '2025-04-14 00:05:30'),
(2, '30000000', 'Administrador', 'Administrante', 2, '2025-05-07 17:20:48', '2025-05-07 17:20:48'),
(3, '46587646', 'Hermenejildo', 'Ochoa', 3, '2025-05-08 02:05:37', '2025-05-08 02:05:37'),
(4, '32649785', 'gladys', 'parra', 4, '2025-05-08 02:24:47', '2025-05-08 02:24:47'),
(5, '30040201', 'Gabriel', 'Perdomo', 5, '2025-05-13 00:44:01', '2025-05-13 00:44:01');

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
(9, '2025_05_06_224752_create_preguntas_user_table', 2),
(10, '2025_05_06_232935_update_preguntas_user_nullable', 3),
(11, '2025_05_07_201809_create_permission_tables', 4),
(12, '2025_05_07_215939_remove_rol_column_from_users_table', 5),
(13, '2025_05_09_221358_update_titulo_length_in_fichas_table', 6);

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
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 3);

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
  `pregunta_uno` varchar(255) DEFAULT NULL,
  `respuesta_uno` varchar(255) DEFAULT NULL,
  `pregunta_dos` varchar(255) DEFAULT NULL,
  `respuesta_dos` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas_user`
--

INSERT INTO `preguntas_user` (`id`, `user_id`, `pregunta_uno`, `respuesta_uno`, `pregunta_dos`, `respuesta_dos`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, '2025-05-07 03:31:19', '2025-05-11 03:33:24'),
(3, 2, 'agua', 'agua', 'regia', 'pesada', '2025-05-07 17:34:08', '2025-05-15 03:26:01'),
(4, 4, NULL, NULL, NULL, NULL, '2025-05-08 02:55:17', '2025-05-08 02:55:17'),
(5, 3, 'guacala', 'no', 'se', 'se', '2025-05-08 02:55:35', '2025-05-11 03:48:01'),
(6, 5, 'Cuál es el apodo de Escanor', 'El Papocho', 'Decepción Total', 'Galan', '2025-05-13 00:52:33', '2025-05-13 00:52:33');

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
(1, 'MASTER', 'web', '2025-05-08 01:25:45', '2025-05-08 01:25:45'),
(2, 'ADMIN', 'web', '2025-05-08 01:27:23', '2025-05-08 01:27:23'),
(4, 'USER', 'web', '2025-05-08 01:28:20', '2025-05-08 01:28:20');

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
('csualJ4kM6XatGFIg2s56AX7rOOYLMhBRlJxDGHK', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0N0emZoUlh5QjdCcnUwVTZRYUk3eUo1b3ZCcTNmVk9tSllERXRobiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9iaWJsaW8vcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747712559),
('e0FqrY8fYgKRkDJTfYP3Iczl8pM5Itgxb1SXcPAS', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWERTWjVxTHVUbG96eXVQY0JIQlRHTWhGdzZSMkZlOVVRVkZCMmFQNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9iaWJsaW8vcHVibGljL2FkbWluL3BlcmZpbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ3NzcwMzc0O319', 1747777128),
('Ym8EbKAromB403EudAvQv1maH1FIXZq608nmzkEV', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGYxZUNNQk0wbTB2dmlZMVRxdGhsOFppb2ZIdW5rR3hPakpvT1hNZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9iaWJsaW8vcHVibGljL2xvZ2luIjt9fQ==', 1747535804);

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
(1, 'User', 'test@ejemplo.com', '2025-04-14 00:05:30', '$2y$12$f7./EB9P9cQ0bKSDb.qKhOCWD69.ZDW6sw5lfskRLmKk.sCiAVy/y', 'lcVHX8BORsVKgitKhYGop17CJed7XvHHMkqsg2soBHwut7jyvCUoO4l0JQLX', '2025-04-14 00:05:30', '2025-05-11 03:33:24'),
(2, 'admin', 'admin@admin.com', NULL, '$2y$12$4JBE2zyimnbKX3mzlmbPB.Ha20JY/yQwEPdrwgCyAsIoQOJXQ1WEK', NULL, '2025-05-07 17:20:48', '2025-05-15 03:26:31'),
(3, 'Hermenejildo', 'ochoa@gmail.com', NULL, '$2y$12$VZ7yq7zIuGe87gB5Dql16ucQPiJ5Pnwcn9dC7zG2esBAfXH59gt/u', NULL, '2025-05-08 02:05:37', '2025-05-08 02:05:37'),
(4, 'gladys', 'gladys@gmail.com', NULL, '$2y$12$z85yvnG81ZRsgL/ZZ3DhC.A5c0bD6D00u0XbNoOCIU2zXQ7fk2CX6', NULL, '2025-05-08 02:24:46', '2025-05-08 02:24:46'),
(5, 'nolose', 'noloseqwq@gmail.com', NULL, '$2y$12$IIKPypKpeD/gJYhgSPXCK.iHOUBngcgRQ9hZHVW9d8RlHU2U5HrO6', NULL, '2025-05-13 00:44:00', '2025-05-13 00:53:37');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `autor_ficha`
--
ALTER TABLE `autor_ficha`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `infopers`
--
ALTER TABLE `infopers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas_user`
--
ALTER TABLE `preguntas_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
