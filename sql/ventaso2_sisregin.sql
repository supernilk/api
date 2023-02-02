-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-02-2023 a las 14:52:00
-- Versión del servidor: 5.7.23-23
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ventaso2_sisregin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterprise`
--

CREATE TABLE `enterprise` (
  `dni` varchar(15) DEFAULT NULL,
  `nu_tipo_entidad_doc` int(8) DEFAULT NULL,
  `in_clasificacion_tipo_ent_doc` varchar(3) DEFAULT NULL,
  `Website` varchar(90) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enterprise`
--

INSERT INTO `enterprise` (`dni`, `nu_tipo_entidad_doc`, `in_clasificacion_tipo_ent_doc`, `Website`) VALUES
('1', 7, 'RIF', 'Ventasonlinevip.com'),
('2', 6, 'NIT', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE `entidad` (
  `nu_entidad` int(8) NOT NULL,
  `in_clasificacion_ent` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dni_enterprise` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nu_tipo_entidad_doc_ent` int(8) NOT NULL,
  `in_clasificacion_tipo_ent_doc_ent` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`nu_entidad`, `in_clasificacion_ent`, `descripcion`, `dni_enterprise`, `nu_tipo_entidad_doc_ent`, `in_clasificacion_tipo_ent_doc_ent`) VALUES
(1, 'PER', 'Persona', '1', 7, 'RIF'),
(2, 'DOC', 'Documento', '1', 7, 'RIF'),
(3, 'STA', 'Estatus', '1', 7, 'RIF'),
(4, 'PNT', 'Persona Natural', '1', 7, 'RIF'),
(5, 'PJR', 'Persona Juridica', '1', 7, 'RIF'),
(6, 'TDC', 'Tipo de documento', '1', 7, 'RIF'),
(7, 'PRF', 'Perfil de Usuario', '1', 7, 'RIF'),
(8, 'CNT', 'Centro de Inventario', '1', 7, 'RIF'),
(9, 'ALM', 'Almacen de Inventario', '1', 7, 'RIF'),
(10, 'CND', 'Condicion de articulo', '1', 7, 'RIF'),
(11, 'LOC', 'Locacion de Inventario', '1', 7, 'RIF'),
(12, 'UMB', 'Unidad de Medida', '1', 7, 'RIF'),
(13, 'SET', 'Seteado', '1', 7, 'RIF'),
(14, 'PRY', 'Proyecto', '1', 7, 'RIF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencias`
--

CREATE TABLE `licencias` (
  `id` int(11) NOT NULL,
  `dni` text NOT NULL,
  `nu_tipo_ent_doc` int(8) NOT NULL,
  `in_clasificacion_tipo_ent_doc` varchar(3) NOT NULL,
  `password` text NOT NULL,
  `emailuser` text NOT NULL,
  `nu_tipo_entidad_sta` int(8) NOT NULL,
  `in_clasificacion_tipo_ent_sta` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `licencias`
--

INSERT INTO `licencias` (`id`, `dni`, `nu_tipo_ent_doc`, `in_clasificacion_tipo_ent_doc`, `password`, `emailuser`, `nu_tipo_entidad_sta`, `in_clasificacion_tipo_ent_sta`) VALUES
(1, 'V23166229', 3, 'CDV', 'V23166229', 'tonytarco@hotmail.com', 2, 'INC'),
(2, 'C123456', 1, 'CDC', 'C123456', 'jtorres@gmail.com', 1, 'ACT'),
(3, 'C123', 3, 'CDC', 'S123456', 'gtoledo@consultoriaeconomicasas.com', 1, 'ACT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `dni` varchar(15) DEFAULT NULL,
  `nu_tipo_entidad_doc` int(8) DEFAULT NULL,
  `in_clasificacion_tipo_ent_doc` varchar(3) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` varchar(18) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `dni`, `nu_tipo_entidad_doc`, `in_clasificacion_tipo_ent_doc`, `nombre`, `apellido`, `telefono`, `direccion`, `email`) VALUES
(1, 'V23166229', 3, 'CDV', 'Tony Richard', 'Tarco Tineo', '3207609961', 'calle 21 #105A05 Bogotá ', 'tonytarco@hotmail.com'),
(2, 'J-403961441', 7, 'RIF', 'Xtreme Thecnology', 'Electronics C.A', 'no dio', 'no dio', 'no dio'),
(3, 'C123456', 1, 'CDC', 'Jorge', 'Torres', '3155315361', 'no dio', 'jtorres@gmail.com'),
(4, 'C123', 1, 'CDC', 'G', 'Toledo', NULL, NULL, 'gtoledo@consultoriaeconomicasas.com'),
(8, '0', 1, 'CDC', 'miNombre', 'miApellido', '', '', 'miCorreo'),
(7, '0', 1, 'CDC', 'miNombre', 'miApellido', '', '', 'miCorreo'),
(9, '0', 1, 'CDC', 'miNombre', 'miApellido', '', '', 'miCorreo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_entidad`
--

CREATE TABLE `tipo_entidad` (
  `nu_tipo_entidad` int(8) DEFAULT NULL,
  `in_clasificacion_tipo_ent` varchar(3) DEFAULT NULL,
  `nu_entidad` int(8) DEFAULT NULL,
  `in_clasificacion_ent` varchar(3) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `dni_enterprise` varchar(15) DEFAULT NULL,
  `nu_tipo_entidad_doc_ent` int(8) DEFAULT NULL,
  `in_clasificacion_tipo_ent_doc_ent` varchar(3) DEFAULT NULL,
  `nu_tipo_entidad_sta` int(8) NOT NULL,
  `in_clasificacion_tipo_ent_sta` varchar(3) NOT NULL,
  `nu_tipo_entidad_pry` int(8) NOT NULL,
  `in_clasificacion_tipo_ent_pry` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_entidad`
--

INSERT INTO `tipo_entidad` (`nu_tipo_entidad`, `in_clasificacion_tipo_ent`, `nu_entidad`, `in_clasificacion_ent`, `descripcion`, `dni_enterprise`, `nu_tipo_entidad_doc_ent`, `in_clasificacion_tipo_ent_doc_ent`, `nu_tipo_entidad_sta`, `in_clasificacion_tipo_ent_sta`, `nu_tipo_entidad_pry`, `in_clasificacion_tipo_ent_pry`) VALUES
(1, 'CLI', 1, 'PER', 'Cliente', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(2, 'USR', 1, 'PER', 'Usuario', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(1, 'CDC', 2, 'PNT', 'Cedula Ciudadania', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(2, 'CDE', 2, 'PNT', 'Cedula Extranjeria', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(3, 'CDV', 2, 'PNT', 'Cedula Venezolana', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(4, 'PSP', 2, 'PNT', 'Pasaporte', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(5, 'RUT', 2, 'PJR', 'RUT', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(6, 'NIT', 2, 'PJR', 'RUT', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(7, 'RIF', 2, 'PJR', 'RIF', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(1, 'MNS', 7, 'PRF', 'SuperAdmin', '', 0, '', 1, 'ACT', 0, ''),
(2, 'GGB', 7, 'PRF', 'UserAdmin', '', 0, '', 1, 'ACT', 0, ''),
(3, 'ANI', 7, 'PRF', 'Analista de Inventario', '', 0, '', 1, 'ACT', 0, ''),
(0, 'CN0', 8, 'CNT', '', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(1, 'CN1', 8, 'CNT', '1A3D', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(2, 'CN2', 8, 'CNT', '1A3P', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(3, 'CN3', 8, 'CNT', '1A6P', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(4, 'CN4', 8, 'CNT', '1A7P', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(5, 'CN5', 8, 'CNT', 'PRUEBA', '1', 7, 'RIF', 2, 'INC', 3, 'TER'),
(6, 'CN6', 8, 'CNT', '1A8P', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(7, 'CN7', 8, 'CNT', '1A9D', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(8, 'CN8', 8, 'CNT', '1A9P', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(9, 'CN9', 8, 'CNT', '1AFD', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(10, 'CM0', 8, 'CNT', '1AFP', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(11, 'CM1', 8, 'CNT', '1AID', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(12, 'CM2', 8, 'CNT', '1AIP', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(13, 'CM3', 8, 'CNT', '1AJD', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(14, 'CM4', 8, 'CNT', '1AJP', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(15, 'CM5', 8, 'CNT', '1ALD', 'J-403961442', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(16, 'CM6', 8, 'CNT', '1ANP', 'J-403961443', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(17, 'CM7', 8, 'CNT', '1AUD', 'J-403961444', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(18, 'CM8', 8, 'CNT', '1AVD', 'J-403961445', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(19, 'CM9', 8, 'CNT', '1AXD', 'J-403961446', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(20, 'CO0', 8, 'CNT', '1AXP', 'J-403961447', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(21, 'CO1', 8, 'CNT', '1BME', 'J-403961448', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(22, 'CO2', 8, 'CNT', '1BSD', 'J-403961449', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(23, 'CO3', 8, 'CNT', '1BSP', 'J-403961450', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(24, 'CO4', 8, 'CNT', '1BTD', 'J-403961451', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(25, 'CO5', 8, 'CNT', '1BVD', 'J-403961452', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(26, 'CO6', 8, 'CNT', '1BVG', 'J-403961453', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(27, 'CO7', 8, 'CNT', '1BWD', 'J-403961454', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(28, 'CO8', 8, 'CNT', '1DYD', 'J-403961455', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(29, 'CO9', 8, 'CNT', '1DYP', 'J-403961456', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(30, 'CP0', 8, 'CNT', '1EAP', 'J-403961457', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(31, 'CP1', 8, 'CNT', '1EFP', 'J-403961458', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(32, 'CP2', 8, 'CNT', '1FBD', 'J-403961459', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(33, 'CP3', 8, 'CNT', '1FBE', 'J-403961460', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(34, 'CP4', 8, 'CNT', '1FBG', 'J-403961461', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(35, 'CP5', 8, 'CNT', '1FGE', 'J-403961462', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(36, 'CP6', 8, 'CNT', '1FYD', 'J-403961463', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(37, 'CP7', 8, 'CNT', '1GBP', 'J-403961464', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(38, 'CP8', 8, 'CNT', '1GUP', 'J-403961465', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(39, 'CP9', 8, 'CNT', '1GVP', 'J-403961466', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(40, 'CQ0', 8, 'CNT', '1HBE', 'J-403961467', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(41, 'CQ1', 8, 'CNT', '1HCP', 'J-403961468', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(42, 'CQ2', 8, 'CNT', '1HDE', 'J-403961469', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(43, 'CQ3', 8, 'CNT', '1HFD', 'J-403961470', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(44, 'CQ4', 8, 'CNT', '1HFP', 'J-403961471', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(45, 'CQ5', 8, 'CNT', '1HGP', 'J-403961472', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(46, 'CQ6', 8, 'CNT', '1HLD', 'J-403961473', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(47, 'CQ7', 8, 'CNT', '1HMD', 'J-403961474', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(48, 'CQ8', 8, 'CNT', '1HOD', 'J-403961475', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(49, 'CQ9', 8, 'CNT', '1HOP', 'J-403961476', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(50, 'CR0', 8, 'CNT', '1HQD', 'J-403961477', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(51, 'CR1', 8, 'CNT', '1HRD', 'J-403961478', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(52, 'CR2', 8, 'CNT', '1JAD', 'J-403961479', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(53, 'CR3', 8, 'CNT', '1JAP', 'J-403961480', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(54, 'CR4', 8, 'CNT', '1JBP', 'J-403961481', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(0, 'AL0', 9, 'ALM', '', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(1, 'AL1', 9, 'ALM', '1000', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(3, 'AL3', 9, 'ALM', '3000', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(4, 'AL4', 9, 'ALM', '4000', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(5, 'AL5', 9, 'ALM', '4100', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(6, 'AL6', 9, 'ALM', '5000', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(7, 'AL7', 9, 'ALM', '6000', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(8, 'AL8', 9, 'ALM', '6001', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(9, 'AL9', 9, 'ALM', '6002', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(10, 'AK1', 9, 'ALM', '7000', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(11, 'AK2', 9, 'ALM', '9000', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(12, 'AK3', 9, 'ALM', '9100', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(1, 'CN1', 10, 'CND', 'NOVALORA', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(2, 'CN2', 10, 'CND', 'NUEVO', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(3, 'CN3', 10, 'CND', 'USADO', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(4, 'CN4', 10, 'CND', 'INSPECCI', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(5, 'CN5', 10, 'CND', 'REPARAR', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(6, 'CN6', 10, 'CND', 'REPARADO', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(1, 'B01', 11, 'LOC', 'B01', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(2, 'B02', 11, 'LOC', 'B02', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(3, 'B03', 11, 'LOC', 'B03', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(4, 'B04', 11, 'LOC', 'B04', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(5, 'B05', 11, 'LOC', 'B05', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(6, 'C01', 11, 'LOC', 'B06', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(7, 'C02', 11, 'LOC', 'B07', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(8, 'C03', 11, 'LOC', 'B08', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(9, 'C04', 11, 'LOC', 'B09', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(10, 'C05', 11, 'LOC', 'B10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(11, 'C06', 11, 'LOC', 'B11', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(12, 'C07', 11, 'LOC', 'B12', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(13, 'C08', 11, 'LOC', 'B13', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(14, 'C09', 11, 'LOC', 'B14', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(15, 'C10', 11, 'LOC', 'B15', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(16, 'C11', 11, 'LOC', 'C01', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(17, 'C12', 11, 'LOC', 'C02', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(18, 'C13', 11, 'LOC', 'C03', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(19, 'C14', 11, 'LOC', 'C04', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(20, 'C15', 11, 'LOC', 'C05', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(21, 'C16', 11, 'LOC', 'C06', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(22, 'C17', 11, 'LOC', 'C07', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(23, 'C18', 11, 'LOC', 'C08', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(24, 'C19', 11, 'LOC', 'C09', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(25, 'C20', 11, 'LOC', 'C10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(26, 'C21', 11, 'LOC', 'C11', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(27, 'C22', 11, 'LOC', 'C12', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(28, 'C23', 11, 'LOC', 'C13', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(29, 'C24', 11, 'LOC', 'C14', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(30, 'C25', 11, 'LOC', 'C15', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(31, 'C26', 11, 'LOC', 'C16', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(32, 'C27', 11, 'LOC', 'C17', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(33, 'C28', 11, 'LOC', 'C18', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(34, 'C29', 11, 'LOC', 'C19', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(35, 'C30', 11, 'LOC', 'C20', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(36, 'C31', 11, 'LOC', 'C21', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(37, 'C32', 11, 'LOC', 'C22', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(38, 'C33', 11, 'LOC', 'C23', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(39, 'C34', 11, 'LOC', 'C24', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(40, 'C35', 11, 'LOC', 'C25', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(41, 'C36', 11, 'LOC', 'C26', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(42, 'C37', 11, 'LOC', 'C27', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(43, 'C38', 11, 'LOC', 'C28', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(44, 'C39', 11, 'LOC', 'C29', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(45, 'C40', 11, 'LOC', 'C30', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(46, 'C41', 11, 'LOC', 'C31', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(47, 'C42', 11, 'LOC', 'C32', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(48, 'C43', 11, 'LOC', 'C33', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(49, 'C44', 11, 'LOC', 'C34', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(50, 'C45', 11, 'LOC', 'C35', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(51, 'C46', 11, 'LOC', 'C36', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(52, 'C47', 11, 'LOC', 'C37', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(53, 'C48', 11, 'LOC', 'C38', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(54, 'C49', 11, 'LOC', 'C39', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(55, 'C50', 11, 'LOC', 'C40', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(56, 'C51', 11, 'LOC', 'P01', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(57, 'C52', 11, 'LOC', 'P02', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(58, 'C53', 11, 'LOC', 'P03', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(59, 'C54', 11, 'LOC', 'P04', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(60, 'C55', 11, 'LOC', 'P05', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(61, 'C56', 11, 'LOC', 'P06', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(62, 'C57', 11, 'LOC', 'P07', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(63, 'C58', 11, 'LOC', 'P08', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(64, 'C59', 11, 'LOC', 'P09', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(65, 'C60', 11, 'LOC', 'P10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(66, 'P01', 11, 'LOC', 'P11', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(67, 'P02', 11, 'LOC', 'P12', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(68, 'P03', 11, 'LOC', 'P13', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(69, 'P04', 11, 'LOC', 'P14', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(70, 'P05', 11, 'LOC', 'P15', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(1, 'UM1', 12, 'UMB', 'UN', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(2, 'UM2', 12, 'UMB', 'M', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(3, 'UM3', 12, 'UMB', 'L', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(4, 'UM4', 12, 'UMB', 'FT', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(5, 'UM5', 12, 'UMB', 'GAL', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(6, 'UM6', 12, 'UMB', 'PAA', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(7, 'UM7', 12, 'UMB', 'M3', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(8, 'UM8', 12, 'UMB', 'KG', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(9, 'UM9', 12, 'UMB', 'M2', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(10, 'UN1', 12, 'UMB', 'ROL', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(11, 'UN2', 12, 'UMB', 'LB', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(12, 'UN3', 12, 'UMB', 'G', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(1, 'POS', 13, 'SET', 'Sesion Activa', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(2, 'NEG', 13, 'SET', 'Sesion Inactiva', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(1, 'ACT', 3, 'STA', 'Activo', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(2, 'INC', 3, 'STA', 'Inactivo', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(71, 'LOC', 9, 'LOC', 'Rabano', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(72, 'LOC', 11, 'LOC', '', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(73, 'LOC', 11, 'LOC', 'A10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(74, 'LOC', 11, 'LOC', 'A10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(75, 'LOC', 11, 'LOC', 'A10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(1, 'PRM', 14, 'PRY', 'Primero', '1', 6, 'NIT', 1, 'ACT', 0, ''),
(76, 'LOC', 11, 'LOC', 'A10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(77, 'LOC', 0, 'LOC', 'A10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(1, 'PRM', 14, 'PRY', 'Primer', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(2, 'SEC', 14, 'PRY', 'Segundo', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(3, 'TER', 14, 'PRY', 'Tercer', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(4, 'CUA', 14, 'PRY', 'Cuarto', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(78, 'LOC', 7, 'LOC', 'A10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(79, 'LOC', 7, 'LOC', 'A10', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(80, 'LOC', 7, 'LOC', 'A101', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(81, 'LOC', 11, 'LOC', 'sNILK', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(82, 'LOC', 11, 'LOC', 'sNILK', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(83, 'LOC', 11, 'LOC', 'sNILK', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(84, 'LOC', 11, 'LOC', 'sNILK', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(85, 'LOC', 11, 'LOC', 'sNILK', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(86, 'LOC', 11, 'LOC', 'sNILK', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(1, '', 11, '', 'test', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(2, '', 11, '', 'test', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(3, '', 11, '', 'test', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(87, 'LOC', 11, 'LOC', 'test', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(2, 'SEC', 14, 'PRY', 'Segundo', '1', 6, 'NIT', 1, 'ACT', 0, ''),
(3, 'TER', 14, 'PRY', 'Tercero', '1', 6, 'NIT', 1, 'ACT', 0, ''),
(4, 'CUA', 14, 'PRY', 'Cuarto', '1', 6, 'NIT', 1, 'ACT', 0, ''),
(1, 'CN1', 8, 'CNT', '1A3D', '1', 6, 'NIT', 1, 'ACT', 1, 'PRM'),
(4, '', 11, '', 'test2', '1', 7, 'RIF', 1, 'ACT', 0, ''),
(88, 'LOC', 11, 'LOC', 'test2', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(89, 'LOC', 11, 'LOC', 'test2', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(90, 'LOC', 11, 'LOC', 'test2', '1', 7, 'RIF', 1, 'ACT', 1, 'PRM'),
(2, 'LOC', 11, 'LOC', 'test3', '1', 6, 'NIT', 1, 'ACT', 1, 'PRM'),
(1, 'LOC', 11, 'LOC', 'test2', '1', 6, 'NIT', 2, 'INC', 1, 'PRM'),
(3, 'LOC', 11, 'LOC', 'Test con PRY', '1', 6, 'NIT', 2, 'INC', 2, 'SEC'),
(2, 'CNT', 8, 'CNT', 'DESCRIPCION ACTUALIZADA', '1', 6, 'NIT', 1, 'ACT', 2, 'SEC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_Usuario` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT '',
  `token` varchar(70) COLLATE utf8mb4_spanish_ci DEFAULT '',
  `fechaTope` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `token`
--

INSERT INTO `token` (`ID`, `ID_Usuario`, `token`, `fechaTope`) VALUES
(45, '1', '175b02836eb06f7ddc10e494c8c680c757cdb81d94b5071811008cce2c32cb47', '1675457724'),
(46, '3', 'e1f0c9991f7078f3a50ab0aafd923308a0beb7df469968bac4325215514b6031', '1675715583'),
(48, '2', 'b832f68b67d4289234148e6c1b7dc96701cc7e21c9c22b93b9e5e3abb4a1c027', '1675813253');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `dni` varchar(15) NOT NULL,
  `nu_tipo_entidad_doc` int(8) NOT NULL,
  `in_clasificacion_tipo_ent_doc` varchar(3) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(12) DEFAULT NULL,
  `emailuser` varchar(60) NOT NULL,
  `nu_tipo_entidad_prf` int(8) DEFAULT NULL,
  `in_clasificacion_tipo_ent_prf` varchar(3) DEFAULT NULL,
  `nu_tipo_entidad_sta` int(8) DEFAULT NULL,
  `in_clasificacion_tipo_ent_sta` varchar(3) DEFAULT NULL,
  `nu_tipo_entidad_set` int(8) DEFAULT NULL,
  `in_clasificacion_tipo_ent_set` varchar(3) DEFAULT NULL,
  `dni_enterprise` varchar(15) DEFAULT NULL,
  `nu_tipo_entidad_doc_ent` int(8) DEFAULT NULL,
  `in_clasificacion_tipo_ent_doc_ent` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `dni`, `nu_tipo_entidad_doc`, `in_clasificacion_tipo_ent_doc`, `username`, `password`, `emailuser`, `nu_tipo_entidad_prf`, `in_clasificacion_tipo_ent_prf`, `nu_tipo_entidad_sta`, `in_clasificacion_tipo_ent_sta`, `nu_tipo_entidad_set`, `in_clasificacion_tipo_ent_set`, `dni_enterprise`, `nu_tipo_entidad_doc_ent`, `in_clasificacion_tipo_ent_doc_ent`) VALUES
(1, 'V23166229', 3, 'CDV', 'TTARCO', 'V23166229', 'tonytarco@hotmail.com', 2, 'GGB', 2, 'INC', 2, 'NEG', '1', 7, 'RIF'),
(2, 'C123456', 1, 'CDC', 'JTORRES', 'C123456', 'jtorres@gmail.com', 1, 'MNS', 2, 'INC', 2, 'NEG', '1', 7, 'RIF'),
(3, 'C123', 1, 'CDC', 'GTOLEDO', 'S123456', 'gtoledo@consultoriaeconomicasas.com', 3, 'ANI', 2, 'INC', 2, 'NEG', '1', 7, 'RIF'),
(5, '0', 1, 'CDC', 'miUsuarioNombre', 'miContracena', 'miCorreoUsuario', 3, 'ANI', 2, 'INC', 2, 'NEG', '1', 7, 'RIF');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`dni`,`nu_tipo_entidad_doc`,`in_clasificacion_tipo_ent_doc`,`emailuser`),
  ADD UNIQUE KEY `ID_Usuario` (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `licencias`
--
ALTER TABLE `licencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
