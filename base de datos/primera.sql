-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-08-2022 a las 05:43:04
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbpolicia`
--
CREATE DATABASE IF NOT EXISTS `dbpolicia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbpolicia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--
-- Creación: 03-08-2022 a las 22:25:54
--

CREATE TABLE `enfermedad` (
  `enfermedad_id` int(11) NOT NULL,
  `policia_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `certificado` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moviles`
--
-- Creación: 03-08-2022 a las 22:09:05
--

CREATE TABLE `moviles` (
  `movil_id` int(11) NOT NULL,
  `nro_serie` int(11) NOT NULL,
  `tipo_movil` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `posesion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `moviles`
--

INSERT INTO `moviles` (`movil_id`, `nro_serie`, `tipo_movil`, `estado`, `posesion`) VALUES
(1, 17494, 'auto', 'bien', 1),
(2, 17400, 'camioneta', 'bien', 0),
(3, 17520, 'auto', 'radiado', 0),
(4, 17333, 'auto', 'radiado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `policias`
--
-- Creación: 02-07-2022 a las 14:36:18
--

CREATE TABLE `policias` (
  `policia_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `legajo` int(10) NOT NULL,
  `nivel_usuario` varchar(10) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `policias`
--

INSERT INTO `policias` (`policia_id`, `nombre`, `apellido`, `legajo`, `nivel_usuario`, `estado`) VALUES
(33, 'aaa', 'bbb', 111, 'noadmin', 'aceptado'),
(34, 'ccc', 'ddd', 222, 'noadmin', 'espera'),
(35, 'eee', 'fff', 333, 'admin', 'aceptado'),
(36, 'Joaquín Leonel', 'Roba', 112233, 'noadmin', 'espera'),
(37, 'Joaquín Leonel', 'Lopez', 112233, 'noadmin', 'espera'),
(38, 'Joaquín Leonel', 'Roba', 498257, 'noadmin', 'espera'),
(39, 'juan carlos', 'Roba', 498257, 'noadmin', 'espera'),
(40, 'juan carlos', 'Roba', 498257, 'noadmin', 'espera'),
(41, 'juan carlos', 'Roba', 498257, 'noadmin', 'espera'),
(42, 'juan carlos', 'Roba', 498257, 'noadmin', 'espera'),
(43, 'juan carlos', 'Roba', 498257, 'noadmin', 'espera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentismo`
--
-- Creación: 15-08-2022 a las 03:13:18
-- Última actualización: 15-08-2022 a las 03:39:15
--

CREATE TABLE `presentismo` (
  `presente_id` int(11) NOT NULL,
  `policia_id` int(11) NOT NULL,
  `movil_id` int(11) DEFAULT NULL,
  `funcion` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado_movil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `presentismo`
--

INSERT INTO `presentismo` (`presente_id`, `policia_id`, `movil_id`, `funcion`, `fecha`, `estado_movil`) VALUES
(9, 33, 2, 'movil', '2022-08-14 23:14:54', 'bueno'),
(10, 33, 2, 'movil', '2022-08-14 23:34:51', 'bueno'),
(11, 33, 2, 'movil', '2022-08-14 23:53:09', 'bueno'),
(12, 33, 2, '', '2022-08-14 23:59:40', 'bueno'),
(14, 33, 4, 'movil', '2022-08-15 00:00:55', 'bueno'),
(15, 33, 4, 'movil', '2022-08-15 00:01:22', 'bueno'),
(16, 33, 4, 'movil', '2022-08-15 00:03:17', 'bueno'),
(17, 33, 4, 'movil', '2022-08-15 00:03:58', 'bueno'),
(18, 33, 4, 'movil', '2022-08-15 00:04:11', 'bueno'),
(19, 33, 3, 'movil', '2022-08-15 00:06:47', 'bueno'),
(20, 33, 4, 'movil', '2022-08-15 00:06:50', 'bueno'),
(21, 33, 2, 'movil', '2022-08-15 00:06:52', 'bueno'),
(24, 33, NULL, 'movil', '2022-08-15 00:13:36', 'bueno'),
(25, 33, 3, 'movil', '2022-08-15 00:14:04', 'bueno'),
(29, 33, NULL, 'movil', '2022-08-15 00:15:15', 'bueno'),
(30, 33, NULL, 'movil', '2022-08-15 00:17:18', 'bueno'),
(31, 33, NULL, 'movil', '2022-08-15 00:17:47', 'bueno'),
(32, 33, NULL, 'movil', '2022-08-15 00:19:28', 'bueno'),
(33, 33, NULL, 'caminante', '2022-08-15 00:19:45', 'bueno'),
(34, 33, 4, 'movil', '2022-08-15 00:19:49', 'bueno'),
(35, 33, NULL, 'caminante', '2022-08-15 00:21:28', 'bueno'),
(36, 33, 2, 'caminante', '2022-08-15 00:30:22', 'bueno'),
(37, 33, 3, 'caminante', '2022-08-15 00:30:42', 'bueno'),
(38, 33, 2, 'movil', '2022-08-15 00:31:17', 'bueno'),
(39, 33, NULL, 'caminante', '2022-08-15 00:31:57', 'bueno'),
(40, 33, 4, 'movil', '2022-08-15 00:32:10', 'bueno'),
(41, 33, 2, 'movil', '2022-08-15 00:32:27', 'bueno'),
(42, 33, 2, '', '2022-08-15 00:34:39', 'bueno'),
(43, 33, 2, 'caminante', '2022-08-15 00:35:52', 'bueno'),
(44, 33, 3, 'acompañante', '2022-08-15 00:36:37', 'bueno'),
(45, 33, 4, 'acompañante', '2022-08-15 00:37:25', 'bueno'),
(46, 33, NULL, 'caminante', '2022-08-15 00:37:51', 'bueno'),
(47, 33, 3, 'acompañante', '2022-08-15 00:38:52', 'bueno'),
(48, 33, 2, 'chofer', '2022-08-15 00:39:05', 'bueno'),
(49, 33, NULL, 'caminante', '2022-08-15 00:39:15', 'bueno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--
-- Creación: 03-08-2022 a las 22:23:30
--

CREATE TABLE `vacaciones` (
  `vacaciones_id` int(11) NOT NULL,
  `policia_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`enfermedad_id`),
  ADD UNIQUE KEY `policia_id` (`policia_id`);

--
-- Indices de la tabla `moviles`
--
ALTER TABLE `moviles`
  ADD PRIMARY KEY (`movil_id`);

--
-- Indices de la tabla `policias`
--
ALTER TABLE `policias`
  ADD PRIMARY KEY (`policia_id`);

--
-- Indices de la tabla `presentismo`
--
ALTER TABLE `presentismo`
  ADD PRIMARY KEY (`presente_id`),
  ADD KEY `fk_policias_presentismo` (`policia_id`),
  ADD KEY `fk_moviles_presentismo` (`movil_id`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`vacaciones_id`),
  ADD UNIQUE KEY `policia_id` (`policia_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `enfermedad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `moviles`
--
ALTER TABLE `moviles`
  MODIFY `movil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `policias`
--
ALTER TABLE `policias`
  MODIFY `policia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `presentismo`
--
ALTER TABLE `presentismo`
  MODIFY `presente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `vacaciones_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD CONSTRAINT `enfermedad_ibfk_1` FOREIGN KEY (`policia_id`) REFERENCES `policias` (`policia_id`);

--
-- Filtros para la tabla `presentismo`
--
ALTER TABLE `presentismo`
  ADD CONSTRAINT `fk_moviles_presentismo` FOREIGN KEY (`movil_id`) REFERENCES `moviles` (`movil_id`),
  ADD CONSTRAINT `fk_policias_presentismo` FOREIGN KEY (`policia_id`) REFERENCES `policias` (`policia_id`);

--
-- Filtros para la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`policia_id`) REFERENCES `policias` (`policia_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
