-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2023 a las 19:00:08
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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

DROP TABLE IF EXISTS `agente`;
CREATE TABLE IF NOT EXISTS `agente` (
  `idAgente` int(8) NOT NULL AUTO_INCREMENT,
  `nombreAgente` varchar(255) NOT NULL,
  `apellidosAgente` varchar(255) NOT NULL,
  `clave` text NOT NULL,
  PRIMARY KEY (`idAgente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(8) NOT NULL AUTO_INCREMENT,
  `nombreCliente` varchar(255) NOT NULL,
  `apellidoCliente` varchar(255) NOT NULL,
  `codigoPostal` varchar(5) NOT NULL,
  `clave` text NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` int(5) NOT NULL AUTO_INCREMENT,
  `nombreTicket` varchar(50) NOT NULL,
  `descripcionTicket` text NOT NULL,
  `prioridad` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fk_idCliente` int(8) NOT NULL,
  `fk_idAgente` int(8) NOT NULL,
  `fechaRegistro` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_agente` FOREIGN KEY (`fk_idAgente`) REFERENCES `agente` (`idAgente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`fk_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
