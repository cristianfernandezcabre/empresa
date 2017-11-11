-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2017 a las 03:53:50
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `inc_id` int(4) NOT NULL,
  `inc_fecha_incidencia` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inc_fecha_solucion` date NOT NULL,
  `usu_user` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_id` int(4) NOT NULL,
  `inc_descripcion` varchar(280) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`inc_id`, `inc_fecha_incidencia`, `inc_fecha_solucion`, `usu_user`, `rec_id`, `inc_descripcion`) VALUES
(1, '2017-11-08 00:00:00', '2017-11-10', 'aplans', 4, 'Silla rota'),
(2, '2017-11-10 00:00:00', '2017-11-11', 'ccardenas', 11, 'Portatil no carga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `rec_id` int(4) NOT NULL,
  `rec_nombre` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_estado` enum('Disponible','Reservado','Averiado') COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_tipo` enum('Aulas','Despachos/Salas','Material de trabajo') COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_desc` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`rec_id`, `rec_nombre`, `rec_estado`, `rec_tipo`, `rec_desc`) VALUES
(1, 'Aula 101', 'Disponible', 'Aulas', 'Aula teorica con proyetor'),
(2, 'Aula 102', 'Disponible', 'Aulas', 'Aula teorica'),
(3, 'Aula 103', 'Disponible', 'Aulas', 'Aula teorica con proyector'),
(4, 'Aula 104', 'Disponible', 'Aulas', 'Aula informatica'),
(5, 'Aula 105', 'Disponible', 'Aulas', 'Aula informatica'),
(6, 'Despacho 1', 'Disponible', 'Despachos/Salas', ''),
(7, 'Despacho 2', 'Disponible', 'Despachos/Salas', ''),
(8, 'Sala de reuniones', 'Disponible', 'Despachos/Salas', ''),
(9, 'Proyector Portatil', 'Disponible', 'Material de trabajo', ''),
(10, 'Carro de portatiles', 'Disponible', 'Material de trabajo', ''),
(11, 'Portatil 1', 'Disponible', 'Material de trabajo', ''),
(12, 'Portatil 2', 'Disponible', 'Material de trabajo', ''),
(13, 'Portatil 3', 'Disponible', 'Material de trabajo', ''),
(14, 'Movil 1', 'Disponible', 'Material de trabajo', ''),
(15, 'Movil 2', 'Disponible', 'Material de trabajo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `res_id` int(4) NOT NULL,
  `res_inicio` date NOT NULL,
  `res_fin` date NOT NULL,
  `usu_user` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_user` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_pwd` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_nombre` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_apellido` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_mail` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_telf` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_user`, `usu_pwd`, `usu_nombre`, `usu_apellido`, `usu_mail`, `usu_telf`) VALUES
('aplans', 'qwe123', 'Agnes', 'Plans', 'aplans@gmail.com', 982534865),
('ccardenas', 'qwe123', 'Carlos', 'Cárdenas', 'ccardenas@gmail.com', 937639127),
('cfernandez', 'qwe123', 'Cristian', 'Fernandez', 'cfernandez@gmail.com', 926345287),
('dmarin', 'qwe123', 'David', 'Marin', 'dmarin@gmail.com', 973428645),
('jmonforte', 'qwe123', 'Juanjo', 'Monforte', 'jmonforte@gmail.com', 932456721),
('sjimenez', 'qwe123', 'Sergio', 'Jimenez', 'sjimenez@gmail.com', 936452836);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`inc_id`),
  ADD KEY `FK_inc_usuario` (`usu_user`),
  ADD KEY `FK_inc_recurso` (`rec_id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `FK_usuario` (`usu_user`),
  ADD KEY `FK_recurso` (`rec_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_user`),
  ADD UNIQUE KEY `usu_mail` (`usu_mail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `inc_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `rec_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `res_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `FK_inc_recurso` FOREIGN KEY (`rec_id`) REFERENCES `recursos` (`rec_id`),
  ADD CONSTRAINT `FK_inc_usuario` FOREIGN KEY (`usu_user`) REFERENCES `usuarios` (`usu_user`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `FK_recurso` FOREIGN KEY (`rec_id`) REFERENCES `recursos` (`rec_id`),
  ADD CONSTRAINT `FK_usuario` FOREIGN KEY (`usu_user`) REFERENCES `usuarios` (`usu_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
