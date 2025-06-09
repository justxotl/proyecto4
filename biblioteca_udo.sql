-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2025 a las 04:32:08
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
(5, '26139303', 'Natasha Nazareth', 'Baca Vaccaro', '2025-06-06 14:48:50', '2025-06-06 14:48:50'),
(6, '24620484', 'Julián José', 'Díaz Piñango', '2025-06-06 14:48:50', '2025-06-07 04:07:53'),
(7, '30040201', 'Gabriel', 'Perdomo', '2025-06-09 00:41:13', '2025-06-09 00:41:13'),
(8, '28668715', 'Ricardo', 'Alvarez', '2025-06-09 00:44:58', '2025-06-09 00:44:58');

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
(17, 4, 5, NULL, NULL),
(18, 4, 6, NULL, NULL),
(23, 5, 7, NULL, NULL),
(24, 5, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:44:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:21:\"Ver Lista de Usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"Registrar Usuario\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:28:\"Exportar Reporte de Usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:27:\"Ver Información de Usuario\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:14:\"Editar Usuario\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:16:\"Eliminar Usuario\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:21:\"Ver Perfil de Usuario\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:20:\"Ver Lista de Autores\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"Registrar Autor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:27:\"Exportar Reporte de Autores\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"Editar Autor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:14:\"Eliminar Autor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:21:\"Ver Lista de Carreras\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:17:\"Registrar Carrera\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:28:\"Exportar Reporte de Carreras\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:14:\"Editar Carrera\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:16:\"Eliminar Carrera\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:19:\"Ver Lista de Fichas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:15:\"Registrar Ficha\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:26:\"Exportar Reporte de Fichas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:25:\"Ver Información de Ficha\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:32:\"Exportar Reporte de Ficha Única\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"Editar Ficha\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:14:\"Eliminar Ficha\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:23:\"Ver Lista de Préstamos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:19:\"Registrar Préstamo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:30:\"Exportar Reporte de Préstamos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:29:\"Ver Información de Préstamo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:30:\"Marcar Préstamo como Devuelto\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:16:\"Editar Préstamo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:18:\"Eliminar Préstamo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:18:\"Ver Lista de Roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:13:\"Registrar Rol\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:25:\"Exportar Reporte de Roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:10:\"Editar Rol\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:12:\"Eliminar Rol\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:22:\"Ver Lista de Respaldos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:14:\"Crear Respaldo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:18:\"Restaurar Respaldo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:36:\"Restaurar Respaldo desde Dispositivo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:18:\"Descargar Respaldo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:17:\"Eliminar Respaldo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:29:\"Ver Estadísticas del Sistema\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:24:\"Editar Perfil de Usuario\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:6:\"MASTER\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"ADMIN\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:4:\"USER\";s:1:\"c\";s:3:\"web\";}}}', 1749519296);

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
(3, 'Geología', '2025-06-06 14:38:34', '2025-06-06 14:38:34'),
(4, 'Ingeniería Geológica', '2025-06-06 14:38:48', '2025-06-06 14:38:48'),
(5, 'Ingeniería en Minas', '2025-06-06 14:38:59', '2025-06-06 14:38:59'),
(6, 'Ingeniería Industrial', '2025-06-06 14:39:10', '2025-06-06 14:39:10'),
(7, 'Ingeniería Civil', '2025-06-06 14:39:21', '2025-06-06 14:39:21');

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
(4, 'CARACTERIZACIÓN GEOLÓGICA Y ESTRUCTURAL DEL FUNDO VILLA RODEO, SECTOR PRADO DEL ESTE, PARROQUIA PANAPANA, MUNICIPIO ANGOSTURA DEL ORINOCO ESTADO BOLÍVAR, VENEZUELA', '2023-11-01', 4, 'El proyecto de investigación consiste en una caracterización geológica y estructural del\r\nfundo Villa Rodeo, Sector Prado del Este, parroquia Panapana, municipio Angostura\r\ndel Orinoco estado Bolívar, Venezuela. La estrategia adoptada es de nivel descriptivo,\r\ncon un diseño de investigación de campo y documental para la cual se utilizó una\r\nmetodología que incluye los aspectos siguientes:  la descripción de las características\r\nfísico - naturales del área, la identificación de las unidades geológicas y las estructuras\r\nde la zona mediante el levantamiento geológico de superficie, la clasificación de las\r\nestructuras geológicas asociadas a las rocas,  la descripción macroscópica de las rocas\r\naflorantes en el fundo Villa Rodeo, la clasificación de los suelos de acuerdo a las\r\nnormas ASTM-D-2487-00, la descripción de los sedimentos a través del levantamiento\r\nde columnas sedimentológicas, y la elaboración de un mapa geológico estructural\r\nbasado en el levantamiento geológico, usando AutoCAD 2012. Para el logro de los\r\nobjetivos se realizó el levantamiento de 2 columnas sedimentológicas con la apertura\r\nde 2 calicatas, donde se recolectaron (3) muestras de sedimentos; además de (9)\r\nmuestras de rocas. Entre los resultados más relevantes obtenidos tenemos en primer\r\nlugar; las características físico naturales donde se observó que en el fundo Villa Rodeo\r\nse encuentran grandes afloramientos y bloques dispersos de diferentes tamaños que\r\npresentan meteorización esferoidal a nivel de superficie, con  vegetación típica de\r\nsabana, y en menor proporción gramíneas. En la zona se identificaron dos unidades\r\ngeológicas bien definidas que son: Complejo de Imataca y Suelos Residuales. Las\r\nestructuras geológicas asociadas a los afloramientos rocosos son familias de diaclasas\r\ncon direcciones predominantes N40º-70ºW, N10ºE, y S10º-80ºW, las foliaciones con\r\ndirecciones N54°-68ºW con buzamiento 15°-25ºNE, y los Sills de cuarzo cuya\r\ndirección predominante es N12º-83ºW, con espesores promedio que van desde los 2\r\ncm hasta 4 cm. Macroscópicamente los afloramientos rocosos del fundo Villa Rodeo\r\nestán compuestos por rocas metamórficas, de las (9) muestras, se identificaron (3)\r\ncomo Gneis Granítico, (3) Gneis Feldespático, (2) Gneis y un (1) Gneis cuarzo\r\nfeldespático, de colores rosado, blanco y gris en su mayoría de textura de grano grueso\r\ny de grano fino a medio foliadas. Los suelos que conforman el área de estudio fueron\r\nclasificados como arenas mal graduadas de simbología (SP) y arenas limosas de\r\nsimbología (SP-SM) de partículas finas a medias. El análisis mediante las columnas\r\nsedimentológicas mostraron que en la primera columna se tiene dos estratos, donde en\r\nla base es de arena de grano muy fino a fino de color negro a marrón y en el tope arena\r\nde grano medio a fino con presencia de limo de color amarillo y con tonalidades de\r\ncolor blanco; en la segunda solo se tiene un solo estrato, de arena media limosa de color\r\nmarrón con presencia de tonos rojizos producto de la oxidación de hierro. En las 2\r\ncolumnas no se observaron estructuras sedimentarias pero si presencias de raíces. De\r\nacuerdo con el mapa geológico se encuentran los Suelos Residuales que abarca\r\nalrededor del 40% del área y las rocas del Complejo de Imataca que abarca más del\r\n58% del total del área.', '2025-06-06 14:48:50', '2025-06-06 14:48:50'),
(5, 'Trabajo de Prueba', '2025-06-08', 6, 'Resumen del trabajo de prueba.', '2025-06-09 00:44:58', '2025-06-09 02:21:52');

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
(7, '00000001', 'Administrador', 'De Sistema', 7, '2025-06-06 14:24:02', '2025-06-07 03:51:55'),
(8, '10573469', 'Carmen', 'Rondón', 8, '2025-06-06 14:34:11', '2025-06-06 14:34:11'),
(9, '00000002', 'Usuario', 'De Consulta', 9, '2025-06-06 15:12:30', '2025-06-07 03:52:12');

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
(11, '2025_05_20_155723_create_prestatarios_table', 1),
(12, '2025_05_20_163318_create_prestamos_table', 1);

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
(1, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 9);

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

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Ver Lista de Usuarios', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(2, 'Registrar Usuario', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(3, 'Exportar Reporte de Usuarios', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(4, 'Ver Información de Usuario', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(5, 'Editar Usuario', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(6, 'Eliminar Usuario', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(7, 'Ver Perfil de Usuario', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(8, 'Ver Lista de Autores', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(9, 'Registrar Autor', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(10, 'Exportar Reporte de Autores', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(11, 'Editar Autor', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(12, 'Eliminar Autor', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(13, 'Ver Lista de Carreras', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(14, 'Registrar Carrera', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(15, 'Exportar Reporte de Carreras', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(16, 'Editar Carrera', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(17, 'Eliminar Carrera', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(18, 'Ver Lista de Fichas', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(19, 'Registrar Ficha', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(20, 'Exportar Reporte de Fichas', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(21, 'Ver Información de Ficha', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(22, 'Exportar Reporte de Ficha Única', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(23, 'Editar Ficha', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(24, 'Eliminar Ficha', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(25, 'Ver Lista de Préstamos', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(26, 'Registrar Préstamo', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(27, 'Exportar Reporte de Préstamos', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(28, 'Ver Información de Préstamo', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(29, 'Marcar Préstamo como Devuelto', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(30, 'Editar Préstamo', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(31, 'Eliminar Préstamo', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(32, 'Ver Lista de Roles', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(33, 'Registrar Rol', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(34, 'Exportar Reporte de Roles', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(35, 'Editar Rol', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(36, 'Eliminar Rol', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(37, 'Ver Lista de Respaldos', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(38, 'Crear Respaldo', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(39, 'Restaurar Respaldo', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(40, 'Restaurar Respaldo desde Dispositivo', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(41, 'Descargar Respaldo', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(42, 'Eliminar Respaldo', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(43, 'Ver Estadísticas del Sistema', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(44, 'Editar Perfil de Usuario', 'web', '2025-06-07 03:53:05', '2025-06-07 03:53:05');

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
(4, 7, 'Nombre de la jefa', 'Carmen', 'Departamento', 'Biblioteca', '2025-06-06 14:27:13', '2025-06-09 00:36:05'),
(5, 8, 'Departamento', 'biblioteca', 'Jefa', 'rondon', '2025-06-06 14:37:12', '2025-06-09 00:33:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ficha_id` bigint(20) UNSIGNED NOT NULL,
  `prestatario_id` bigint(20) UNSIGNED NOT NULL,
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

INSERT INTO `prestamos` (`id`, `ficha_id`, `prestatario_id`, `fecha_prestamo`, `fecha_devolucion`, `fecha_entrega`, `estado`, `created_at`, `updated_at`) VALUES
(6, 4, 5, '2025-06-06', '2025-06-07', '2025-06-06', 'devuelto', '2025-06-06 14:53:23', '2025-06-06 15:03:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestatarios`
--

CREATE TABLE `prestatarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci_prestatario` varchar(8) NOT NULL,
  `nombre_prestatario` varchar(255) NOT NULL,
  `apellido_prestatario` varchar(255) NOT NULL,
  `tlf_prestatario` varchar(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prestatarios`
--

INSERT INTO `prestatarios` (`id`, `ci_prestatario`, `nombre_prestatario`, `apellido_prestatario`, `tlf_prestatario`, `created_at`, `updated_at`) VALUES
(5, '28668715', 'Ricardo', 'Álvarez', '04249086796', NULL, NULL);

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
(1, 'MASTER', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22'),
(2, 'ADMIN', 'web', '2025-06-03 20:03:22', '2025-06-06 01:27:31'),
(3, 'USER', 'web', '2025-06-03 20:03:22', '2025-06-03 20:03:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(18, 3),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(21, 3),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(44, 2);

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
('jLi9rbagrDzFT8hB7UXFnocVr6wGdbFmxXfboEWZ', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickJHbEZCVWY1SmswVkxjT2xNaE93bHVMRFc1enRYM0NQcExXTm1iVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9iaWJsaW8vcHVibGljL2xvZ2luIjt9fQ==', 1749436314);

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
(7, 'Administración', 'administracion@biblioteca.com', NULL, '$2y$12$5Ia6CR8elK4wv/9ZFE5H8OEfWvajI.a9RAr2ua1pcNpF19mWJXC9O', NULL, '2025-06-06 14:24:02', '2025-06-09 00:34:10'),
(8, 'CarmenRondon', 'carmen.rondon@udo.edu.ve', NULL, '$2y$12$SMgLIhMwh.D2hBc9.4bZ0uThXnzXc3cVFITWtui7f9nu3hhX7ikOq', NULL, '2025-06-06 14:34:11', '2025-06-06 14:34:11'),
(9, 'Consultas', 'consultas@biblioteca.com', NULL, '$2y$12$3dwMsW5t9Xq0d1b4GV5iBeSjYW6gOlbkj/tL5pgsEuS26uXmc/lvS', NULL, '2025-06-06 15:12:30', '2025-06-07 03:52:12');

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
  ADD KEY `prestamos_ficha_id_foreign` (`ficha_id`),
  ADD KEY `prestamos_prestatario_id_foreign` (`prestatario_id`);

--
-- Indices de la tabla `prestatarios`
--
ALTER TABLE `prestatarios`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `autor_ficha`
--
ALTER TABLE `autor_ficha`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `preguntas_user`
--
ALTER TABLE `preguntas_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `prestatarios`
--
ALTER TABLE `prestatarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `fichas_carrera_id_foreign` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `prestamos_ficha_id_foreign` FOREIGN KEY (`ficha_id`) REFERENCES `fichas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamos_prestatario_id_foreign` FOREIGN KEY (`prestatario_id`) REFERENCES `prestatarios` (`id`) ON UPDATE CASCADE;

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
