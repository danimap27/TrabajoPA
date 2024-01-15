-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2024 a las 10:37:33
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
-- Base de datos: `sist_gest_tick_sop`
--
CREATE DATABASE IF NOT EXISTS `sist_gest_tick_sop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sist_gest_tick_sop`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agente`
--

CREATE TABLE `agente` (
  `idAgente` int(8) NOT NULL,
  `nombreAgente` varchar(255) NOT NULL,
  `apellidosAgente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agente`
--

INSERT INTO `agente` (`idAgente`, `nombreAgente`, `apellidosAgente`) VALUES
(2, 'agenteuno', 'agente uno'),
(3, 'agentedos', 'agente dos'),
(4, 'agentetres', 'agente tres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(8) NOT NULL,
  `nombreCliente` varchar(255) NOT NULL,
  `apellidoCliente` varchar(255) NOT NULL,
  `id_agente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombreCliente`, `apellidoCliente`, `id_agente`) VALUES
(4, 'clienteuno', 'cliente uno', 2),
(5, 'clientedos', 'cliente dos', 3),
(6, 'clientetres', 'cliente tres', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(5) NOT NULL,
  `nombreTicket` varchar(50) NOT NULL,
  `descripcionTicket` text NOT NULL,
  `prioridad` text NOT NULL,
  `estado` text NOT NULL,
  `fk_idCliente` int(8) NOT NULL,
  `fechaRegistro` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`idTicket`, `nombreTicket`, `descripcionTicket`, `prioridad`, `estado`, `fk_idCliente`, `fechaRegistro`) VALUES
(16, 'Ticket de Ejemplo 1', 'Descripción del Ticket 1', 'Alta', 'Abierto', 4, '2024-01-15'),
(17, 'Ticket de Ejemplo 2', 'Descripción del Ticket 2', 'Media', 'En Proceso', 5, '2024-01-16'),
(18, 'Ticket de Ejemplo 3', 'Descripción del Ticket 3', 'Baja', 'Cerrado', 6, '2024-01-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasenia_hash` varchar(255) NOT NULL,
  `tipo` enum('cliente','administrador','agente') NOT NULL,
  `idCorrespondiente` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `correo`, `contrasenia_hash`, `tipo`, `idCorrespondiente`) VALUES
(18, 'admin@admin.com', '$2y$10$8CHjng9PJVWtE2/0UWgcVudDLey8mVoafhnys0YK7lPU0WwMsHEeG', 'administrador', NULL),
(21, 'agente1@agente.com', '$2y$10$ZnPMOUZSXamw7Fgd15QfAu.2Q9/N.ejZWkRP.4axq6LmX5SpakuJa', 'agente', NULL),
(22, 'agente2@agente.com', '$2y$10$WTgL3NP8V6Lntk6JyCZVZe1xCA5q5o78k9rTEFapQQPO/LERzWK06', 'agente', NULL),
(23, 'agente3@agente.com', '$2y$10$Ht.PzWiyUI5u/XQSmeMk5uuqFHc2KNCcnq8WdopZw3FTOpJ/18GPW', 'agente', NULL),
(24, 'cliente1@cliente.com', '$2y$10$Y6Vlr2wpFZ.14a7vDeTYQOd2CtYsm3UxfQwXqpt.4E9R72bhfs8dy', 'cliente', NULL),
(25, 'cliente2@cliente.com', '$2y$10$pvFtaCDPYUZTtifCfxYSe.Rk/eMIyWMWo0pI0.WOdfpwVVH0d1eVW', 'cliente', NULL),
(26, 'cliente3@cliente.com', '$2y$10$pPEzJRrbA91YBXIfhKSbROfqChsIsiK2tsWjKS/8n5atExq4v9Rtm', 'cliente', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`idAgente`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `id_agente` (`id_agente`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `fk_usuario` (`fk_idCliente`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `idCorrespondiente` (`idCorrespondiente`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agente`
--
ALTER TABLE `agente`
  MODIFY `idAgente` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idTicket` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`fk_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idCorrespondiente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idCorrespondiente`) REFERENCES `agente` (`idAgente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
