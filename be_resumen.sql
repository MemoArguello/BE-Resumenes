-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2025 a las 18:40:01
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
-- Base de datos: `be_resumen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `n_carpeta` int(11) NOT NULL,
  `cliente_desde` date NOT NULL,
  `ruc` int(11) NOT NULL,
  `dv` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `nombre_fantasia` varchar(30) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `vencimiento` date NOT NULL,
  `obligacion` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `n_carpeta`, `cliente_desde`, `ruc`, `dv`, `nombre`, `nombre_fantasia`, `telefono`, `direccion`, `vencimiento`, `obligacion`, `estado`) VALUES
(9, 1, '2025-01-01', 2132133, 21, 'Luis Acosta', 'fantasy1', 2321321, 'direccion1', '2025-01-09', 0, 1),
(10, 2, '2025-01-02', 213123, 2, 'Juan Acosta', 'nombre3', 12345678, 'direccion2', '2025-01-15', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_obligacion`
--

CREATE TABLE `cliente_obligacion` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_obligacion` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente_obligacion`
--

INSERT INTO `cliente_obligacion` (`id`, `id_cliente`, `id_obligacion`, `estado`) VALUES
(1, 9, 2, 1),
(2, 9, 1, 1),
(3, 9, 1, 1),
(4, 9, 1, 1),
(5, 9, 3, 1),
(6, 9, 2, 1),
(7, 9, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `ruc` int(11) NOT NULL,
  `dv` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `razon_social` varchar(30) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obligacion`
--

CREATE TABLE `obligacion` (
  `id` int(11) NOT NULL,
  `n_oblig` varchar(30) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `obligacion`
--

INSERT INTO `obligacion` (`id`, `n_oblig`, `monto`, `estado`) VALUES
(1, 'obligacion', 50000.00, 0),
(2, 'IVA', 50000.00, 1),
(3, 'iva2', 50000.00, 1),
(4, 'IVA', 50000.00, 1),
(5, 'obligacion', 50000.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `rango` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rango`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `rol` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre`, `username`, `email`, `pass`, `rol`, `state`) VALUES
(1, 'Administrador', 'admin', 'admin@gmail.com', '$2y$10$AJbEww.4UXj6hhKnJT9/0e/V84GGPM0ApqFZXpeT8bKBya.QoFkke', 1, 1),
(2, 'Edgar Baez', 'edgar16', 'edgarbaes815@gmail.com', '$2y$10$leqYG1/9pG6sfcFYu9pjHuEvT628oha79boMF2k686kg39M51evRi', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obligacion` (`obligacion`);

--
-- Indices de la tabla `cliente_obligacion`
--
ALTER TABLE `cliente_obligacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`,`id_obligacion`),
  ADD KEY `obligacion` (`id_obligacion`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obligacion`
--
ALTER TABLE `obligacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente_obligacion`
--
ALTER TABLE `cliente_obligacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `obligacion`
--
ALTER TABLE `obligacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente_obligacion`
--
ALTER TABLE `cliente_obligacion`
  ADD CONSTRAINT `cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `obligacion` FOREIGN KEY (`id_obligacion`) REFERENCES `obligacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
