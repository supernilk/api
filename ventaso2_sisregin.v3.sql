-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla ventaso2_sisregin.enterprise: 2 rows
DELETE FROM `enterprise`;
/*!40000 ALTER TABLE `enterprise` DISABLE KEYS */;
INSERT INTO `enterprise` (`dni`, `nu_tipo_entidad_doc`, `in_clasificacion_tipo_ent_doc`, `Website`) VALUES
	('J-403961441', 7, 'RIF', 'Ventasonlinevip.com'),
	('890500514-9', 6, 'NIT', '');
/*!40000 ALTER TABLE `enterprise` ENABLE KEYS */;

-- Volcando datos para la tabla ventaso2_sisregin.entidad: ~13 rows (aproximadamente)
DELETE FROM `entidad`;
INSERT INTO `entidad` (`nu_entidad`, `in_clasificacion_ent`, `descripcion`, `dni_enterprise`, `nu_tipo_entidad_doc_ent`, `in_clasificacion_tipo_ent_doc_ent`) VALUES
	(1, 'PER', 'Persona', 'J-403961441', 7, 'RIF'),
	(2, 'DOC', 'Documento', 'J-403961441', 7, 'RIF'),
	(3, 'STA', 'Estatus', 'J-403961441', 7, 'RIF'),
	(4, 'PNT', 'Persona Natural', 'J-403961441', 7, 'RIF'),
	(5, 'PJR', 'Persona Juridica', 'J-403961441', 7, 'RIF'),
	(6, 'TDC', 'Tipo de documento', 'J-403961441', 7, 'RIF'),
	(7, 'PRF', 'Perfil de Usuario', 'J-403961441', 7, 'RIF'),
	(8, 'CNT', 'Centro de Inventario', 'J-403961441', 7, 'RIF'),
	(9, 'ALM', 'Almacen de Inventario', 'J-403961441', 7, 'RIF'),
	(10, 'CND', 'Condicion de articulo', 'J-403961441', 7, 'RIF'),
	(11, 'LOC', 'Locacion de Inventario', 'J-403961441', 7, 'RIF'),
	(12, 'UMB', 'Unidad de Medida', 'J-403961441', 7, 'RIF'),
	(13, 'SET', 'Seteado', 'J-403961441', 7, 'RIF');

-- Volcando datos para la tabla ventaso2_sisregin.licencias: ~3 rows (aproximadamente)
DELETE FROM `licencias`;
INSERT INTO `licencias` (`id`, `nu_tipo_ent_doc`, `in_clasificacion_tipo_ent_doc`, `dni`, `password`, `emailuser`, `nu_tipo_entidad_sta`, `in_clasificacion_tipo_ent_sta`) VALUES
	(1, 3, 'CDV', 'V23166229', 'V23166229', 'tonytarco@hotmail.com', 2, 'INC'),
	(2, 1, 'CDC', 'C123456', 'C123456', 'jtorres@gmail.com', 1, 'ACT'),
	(3, 3, 'CDC', 'C123', 'S123456', 'gtoledo@consultoriaeconomicasas.com', 1, 'ACT');

-- Volcando datos para la tabla ventaso2_sisregin.persona: 4 rows
DELETE FROM `persona`;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`dni`, `nu_tipo_entidad_doc`, `in_clasificacion_tipo_ent_doc`, `nombre`, `apellido`, `telefono`, `direccion`, `email`) VALUES
	('V23166229', 3, 'CDV', 'Tony Richard', 'Tarco Tineo', '3207609961', 'calle 21 #105A05 BogotÃ¡ ', 'tonytarco@hotmail.com'),
	('J-403961441', 7, 'RIF', 'Xtreme Thecnology', 'Electronics C.A', 'no dio', 'no dio', 'no dio'),
	('C123456', 1, 'CDC', 'Jorge', 'Torres', '3155315361', 'no dio', 'jtorres@gmail.com'),
	('C123', 1, 'CDC', 'G', 'Toledo', NULL, NULL, 'gtoledo@consultoriaeconomicasas.com');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando datos para la tabla ventaso2_sisregin.tipo_entidad: 171 rows
DELETE FROM `tipo_entidad`;
/*!40000 ALTER TABLE `tipo_entidad` DISABLE KEYS */;
INSERT INTO `tipo_entidad` (`nu_tipo_entidad`, `in_clasificacion_tipo_ent`, `nu_entidad`, `in_clasificacion_ent`, `descripcion`, `dni_enterprise`, `nu_tipo_entidad_doc_ent`, `in_clasificacion_tipo_ent_doc_ent`) VALUES
	(1, 'CLI', 1, 'PER', 'Cliente', 'J-403961441', 7, 'RIF'),
	(2, 'USR', 1, 'PER', 'Usuario', 'J-403961441', 7, 'RIF'),
	(1, 'CDC', 2, 'PNT', 'Cedula Ciudadania', 'J-403961441', 7, 'RIF'),
	(2, 'CDE', 2, 'PNT', 'Cedula Extranjeria', 'J-403961441', 7, 'RIF'),
	(3, 'CDV', 2, 'PNT', 'Cedula Venezolana', 'J-403961441', 7, 'RIF'),
	(4, 'PSP', 2, 'PNT', 'Pasaporte', 'J-403961441', 7, 'RIF'),
	(5, 'RUT', 2, 'PJR', 'RUT', 'J-403961441', 7, 'RIF'),
	(6, 'NIT', 2, 'PJR', 'RUT', 'J-403961441', 7, 'RIF'),
	(7, 'RIF', 2, 'PJR', 'RIF', 'J-403961441', 7, 'RIF'),
	(1, 'MNS', 7, 'PRF', 'Administrador de Sistema', 'J-403961442', 7, 'RIF'),
	(2, 'GGB', 7, 'PRF', 'Gerente General', 'J-403961441', 7, 'RIF'),
	(3, 'ANI', 7, 'PRF', 'Analista de Inventario', 'J-403961441', 7, 'RIF'),
	(0, 'CN0', 8, 'CNT', '', 'J-403961441', 7, 'RIF'),
	(1, 'CN1', 8, 'CNT', '1A3D', 'J-403961441', 7, 'RIF'),
	(2, 'CN2', 8, 'CNT', '1A3P', 'J-403961441', 7, 'RIF'),
	(3, 'CN3', 8, 'CNT', '1A6P', 'J-403961441', 7, 'RIF'),
	(4, 'CN4', 8, 'CNT', '1A7P', 'J-403961441', 7, 'RIF'),
	(5, 'CN5', 8, 'CNT', '1A8D', 'J-403961441', 7, 'RIF'),
	(6, 'CN6', 8, 'CNT', '1A8P', 'J-403961441', 7, 'RIF'),
	(7, 'CN7', 8, 'CNT', '1A9D', 'J-403961441', 7, 'RIF'),
	(8, 'CN8', 8, 'CNT', '1A9P', 'J-403961441', 7, 'RIF'),
	(9, 'CN9', 8, 'CNT', '1AFD', 'J-403961441', 7, 'RIF'),
	(10, 'CM0', 8, 'CNT', '1AFP', 'J-403961441', 7, 'RIF'),
	(11, 'CM1', 8, 'CNT', '1AID', 'J-403961441', 7, 'RIF'),
	(12, 'CM2', 8, 'CNT', '1AIP', 'J-403961441', 7, 'RIF'),
	(13, 'CM3', 8, 'CNT', '1AJD', 'J-403961441', 7, 'RIF'),
	(14, 'CM4', 8, 'CNT', '1AJP', 'J-403961441', 7, 'RIF'),
	(15, 'CM5', 8, 'CNT', '1ALD', 'J-403961442', 7, 'RIF'),
	(16, 'CM6', 8, 'CNT', '1ANP', 'J-403961443', 7, 'RIF'),
	(17, 'CM7', 8, 'CNT', '1AUD', 'J-403961444', 7, 'RIF'),
	(18, 'CM8', 8, 'CNT', '1AVD', 'J-403961445', 7, 'RIF'),
	(19, 'CM9', 8, 'CNT', '1AXD', 'J-403961446', 7, 'RIF'),
	(20, 'CO0', 8, 'CNT', '1AXP', 'J-403961447', 7, 'RIF'),
	(21, 'CO1', 8, 'CNT', '1BME', 'J-403961448', 7, 'RIF'),
	(22, 'CO2', 8, 'CNT', '1BSD', 'J-403961449', 7, 'RIF'),
	(23, 'CO3', 8, 'CNT', '1BSP', 'J-403961450', 7, 'RIF'),
	(24, 'CO4', 8, 'CNT', '1BTD', 'J-403961451', 7, 'RIF'),
	(25, 'CO5', 8, 'CNT', '1BVD', 'J-403961452', 7, 'RIF'),
	(26, 'CO6', 8, 'CNT', '1BVG', 'J-403961453', 7, 'RIF'),
	(27, 'CO7', 8, 'CNT', '1BWD', 'J-403961454', 7, 'RIF'),
	(28, 'CO8', 8, 'CNT', '1DYD', 'J-403961455', 7, 'RIF'),
	(29, 'CO9', 8, 'CNT', '1DYP', 'J-403961456', 7, 'RIF'),
	(30, 'CP0', 8, 'CNT', '1EAP', 'J-403961457', 7, 'RIF'),
	(31, 'CP1', 8, 'CNT', '1EFP', 'J-403961458', 7, 'RIF'),
	(32, 'CP2', 8, 'CNT', '1FBD', 'J-403961459', 7, 'RIF'),
	(33, 'CP3', 8, 'CNT', '1FBE', 'J-403961460', 7, 'RIF'),
	(34, 'CP4', 8, 'CNT', '1FBG', 'J-403961461', 7, 'RIF'),
	(35, 'CP5', 8, 'CNT', '1FGE', 'J-403961462', 7, 'RIF'),
	(36, 'CP6', 8, 'CNT', '1FYD', 'J-403961463', 7, 'RIF'),
	(37, 'CP7', 8, 'CNT', '1GBP', 'J-403961464', 7, 'RIF'),
	(38, 'CP8', 8, 'CNT', '1GUP', 'J-403961465', 7, 'RIF'),
	(39, 'CP9', 8, 'CNT', '1GVP', 'J-403961466', 7, 'RIF'),
	(40, 'CQ0', 8, 'CNT', '1HBE', 'J-403961467', 7, 'RIF'),
	(41, 'CQ1', 8, 'CNT', '1HCP', 'J-403961468', 7, 'RIF'),
	(42, 'CQ2', 8, 'CNT', '1HDE', 'J-403961469', 7, 'RIF'),
	(43, 'CQ3', 8, 'CNT', '1HFD', 'J-403961470', 7, 'RIF'),
	(44, 'CQ4', 8, 'CNT', '1HFP', 'J-403961471', 7, 'RIF'),
	(45, 'CQ5', 8, 'CNT', '1HGP', 'J-403961472', 7, 'RIF'),
	(46, 'CQ6', 8, 'CNT', '1HLD', 'J-403961473', 7, 'RIF'),
	(47, 'CQ7', 8, 'CNT', '1HMD', 'J-403961474', 7, 'RIF'),
	(48, 'CQ8', 8, 'CNT', '1HOD', 'J-403961475', 7, 'RIF'),
	(49, 'CQ9', 8, 'CNT', '1HOP', 'J-403961476', 7, 'RIF'),
	(50, 'CR0', 8, 'CNT', '1HQD', 'J-403961477', 7, 'RIF'),
	(51, 'CR1', 8, 'CNT', '1HRD', 'J-403961478', 7, 'RIF'),
	(52, 'CR2', 8, 'CNT', '1JAD', 'J-403961479', 7, 'RIF'),
	(53, 'CR3', 8, 'CNT', '1JAP', 'J-403961480', 7, 'RIF'),
	(54, 'CR4', 8, 'CNT', '1JBP', 'J-403961481', 7, 'RIF'),
	(0, 'AL0', 9, 'ALM', '', 'J-403961441', 7, 'RIF'),
	(1, 'AL1', 9, 'ALM', '1000', 'J-403961441', 7, 'RIF'),
	(3, 'AL3', 9, 'ALM', '3000', 'J-403961441', 7, 'RIF'),
	(4, 'AL4', 9, 'ALM', '4000', 'J-403961441', 7, 'RIF'),
	(5, 'AL5', 9, 'ALM', '4100', 'J-403961441', 7, 'RIF'),
	(6, 'AL6', 9, 'ALM', '5000', 'J-403961441', 7, 'RIF'),
	(7, 'AL7', 9, 'ALM', '6000', 'J-403961441', 7, 'RIF'),
	(8, 'AL8', 9, 'ALM', '6001', 'J-403961441', 7, 'RIF'),
	(9, 'AL9', 9, 'ALM', '6002', 'J-403961441', 7, 'RIF'),
	(10, 'AK1', 9, 'ALM', '7000', 'J-403961441', 7, 'RIF'),
	(11, 'AK2', 9, 'ALM', '9000', 'J-403961441', 7, 'RIF'),
	(12, 'AK3', 9, 'ALM', '9100', 'J-403961441', 7, 'RIF'),
	(1, 'CN1', 10, 'CND', 'NOVALORA', 'J-403961441', 7, 'RIF'),
	(2, 'CN2', 10, 'CND', 'NUEVO', 'J-403961441', 7, 'RIF'),
	(3, 'CN3', 10, 'CND', 'USADO', 'J-403961441', 7, 'RIF'),
	(4, 'CN4', 10, 'CND', 'INSPECCI', 'J-403961441', 7, 'RIF'),
	(5, 'CN5', 10, 'CND', 'REPARAR', 'J-403961441', 7, 'RIF'),
	(6, 'CN6', 10, 'CND', 'REPARADO', 'J-403961441', 7, 'RIF'),
	(1, 'B01', 11, 'LOC', 'B01', 'J-403961441', 7, 'RIF'),
	(2, 'B02', 11, 'LOC', 'B02', 'J-403961441', 7, 'RIF'),
	(3, 'B03', 11, 'LOC', 'B03', 'J-403961441', 7, 'RIF'),
	(4, 'B04', 11, 'LOC', 'B04', 'J-403961441', 7, 'RIF'),
	(5, 'B05', 11, 'LOC', 'B05', 'J-403961441', 7, 'RIF'),
	(6, 'C01', 11, 'LOC', 'B06', 'J-403961441', 7, 'RIF'),
	(7, 'C02', 11, 'LOC', 'B07', 'J-403961441', 7, 'RIF'),
	(8, 'C03', 11, 'LOC', 'B08', 'J-403961441', 7, 'RIF'),
	(9, 'C04', 11, 'LOC', 'B09', 'J-403961441', 7, 'RIF'),
	(10, 'C05', 11, 'LOC', 'B10', 'J-403961441', 7, 'RIF'),
	(11, 'C06', 11, 'LOC', 'B11', 'J-403961441', 7, 'RIF'),
	(12, 'C07', 11, 'LOC', 'B12', 'J-403961441', 7, 'RIF'),
	(13, 'C08', 11, 'LOC', 'B13', 'J-403961441', 7, 'RIF'),
	(14, 'C09', 11, 'LOC', 'B14', 'J-403961441', 7, 'RIF'),
	(15, 'C10', 11, 'LOC', 'B15', 'J-403961441', 7, 'RIF'),
	(16, 'C11', 11, 'LOC', 'C01', 'J-403961441', 7, 'RIF'),
	(17, 'C12', 11, 'LOC', 'C02', 'J-403961441', 7, 'RIF'),
	(18, 'C13', 11, 'LOC', 'C03', 'J-403961441', 7, 'RIF'),
	(19, 'C14', 11, 'LOC', 'C04', 'J-403961441', 7, 'RIF'),
	(20, 'C15', 11, 'LOC', 'C05', 'J-403961441', 7, 'RIF'),
	(21, 'C16', 11, 'LOC', 'C06', 'J-403961441', 7, 'RIF'),
	(22, 'C17', 11, 'LOC', 'C07', 'J-403961441', 7, 'RIF'),
	(23, 'C18', 11, 'LOC', 'C08', 'J-403961441', 7, 'RIF'),
	(24, 'C19', 11, 'LOC', 'C09', 'J-403961441', 7, 'RIF'),
	(25, 'C20', 11, 'LOC', 'C10', 'J-403961441', 7, 'RIF'),
	(26, 'C21', 11, 'LOC', 'C11', 'J-403961441', 7, 'RIF'),
	(27, 'C22', 11, 'LOC', 'C12', 'J-403961441', 7, 'RIF'),
	(28, 'C23', 11, 'LOC', 'C13', 'J-403961441', 7, 'RIF'),
	(29, 'C24', 11, 'LOC', 'C14', 'J-403961441', 7, 'RIF'),
	(30, 'C25', 11, 'LOC', 'C15', 'J-403961441', 7, 'RIF'),
	(31, 'C26', 11, 'LOC', 'C16', 'J-403961441', 7, 'RIF'),
	(32, 'C27', 11, 'LOC', 'C17', 'J-403961441', 7, 'RIF'),
	(33, 'C28', 11, 'LOC', 'C18', 'J-403961441', 7, 'RIF'),
	(34, 'C29', 11, 'LOC', 'C19', 'J-403961441', 7, 'RIF'),
	(35, 'C30', 11, 'LOC', 'C20', 'J-403961441', 7, 'RIF'),
	(36, 'C31', 11, 'LOC', 'C21', 'J-403961441', 7, 'RIF'),
	(37, 'C32', 11, 'LOC', 'C22', 'J-403961441', 7, 'RIF'),
	(38, 'C33', 11, 'LOC', 'C23', 'J-403961441', 7, 'RIF'),
	(39, 'C34', 11, 'LOC', 'C24', 'J-403961441', 7, 'RIF'),
	(40, 'C35', 11, 'LOC', 'C25', 'J-403961441', 7, 'RIF'),
	(41, 'C36', 11, 'LOC', 'C26', 'J-403961441', 7, 'RIF'),
	(42, 'C37', 11, 'LOC', 'C27', 'J-403961441', 7, 'RIF'),
	(43, 'C38', 11, 'LOC', 'C28', 'J-403961441', 7, 'RIF'),
	(44, 'C39', 11, 'LOC', 'C29', 'J-403961441', 7, 'RIF'),
	(45, 'C40', 11, 'LOC', 'C30', 'J-403961441', 7, 'RIF'),
	(46, 'C41', 11, 'LOC', 'C31', 'J-403961441', 7, 'RIF'),
	(47, 'C42', 11, 'LOC', 'C32', 'J-403961441', 7, 'RIF'),
	(48, 'C43', 11, 'LOC', 'C33', 'J-403961441', 7, 'RIF'),
	(49, 'C44', 11, 'LOC', 'C34', 'J-403961441', 7, 'RIF'),
	(50, 'C45', 11, 'LOC', 'C35', 'J-403961441', 7, 'RIF'),
	(51, 'C46', 11, 'LOC', 'C36', 'J-403961441', 7, 'RIF'),
	(52, 'C47', 11, 'LOC', 'C37', 'J-403961441', 7, 'RIF'),
	(53, 'C48', 11, 'LOC', 'C38', 'J-403961441', 7, 'RIF'),
	(54, 'C49', 11, 'LOC', 'C39', 'J-403961441', 7, 'RIF'),
	(55, 'C50', 11, 'LOC', 'C40', 'J-403961441', 7, 'RIF'),
	(56, 'C51', 11, 'LOC', 'P01', 'J-403961441', 7, 'RIF'),
	(57, 'C52', 11, 'LOC', 'P02', 'J-403961441', 7, 'RIF'),
	(58, 'C53', 11, 'LOC', 'P03', 'J-403961441', 7, 'RIF'),
	(59, 'C54', 11, 'LOC', 'P04', 'J-403961441', 7, 'RIF'),
	(60, 'C55', 11, 'LOC', 'P05', 'J-403961441', 7, 'RIF'),
	(61, 'C56', 11, 'LOC', 'P06', 'J-403961441', 7, 'RIF'),
	(62, 'C57', 11, 'LOC', 'P07', 'J-403961441', 7, 'RIF'),
	(63, 'C58', 11, 'LOC', 'P08', 'J-403961441', 7, 'RIF'),
	(64, 'C59', 11, 'LOC', 'P09', 'J-403961441', 7, 'RIF'),
	(65, 'C60', 11, 'LOC', 'P10', 'J-403961441', 7, 'RIF'),
	(66, 'P01', 11, 'LOC', 'P11', 'J-403961441', 7, 'RIF'),
	(67, 'P02', 11, 'LOC', 'P12', 'J-403961441', 7, 'RIF'),
	(68, 'P03', 11, 'LOC', 'P13', 'J-403961441', 7, 'RIF'),
	(69, 'P04', 11, 'LOC', 'P14', 'J-403961441', 7, 'RIF'),
	(70, 'P05', 11, 'LOC', 'P15', 'J-403961441', 7, 'RIF'),
	(1, 'UM1', 12, 'UMB', 'UN', 'J-403961441', 7, 'RIF'),
	(2, 'UM2', 12, 'UMB', 'M', 'J-403961441', 7, 'RIF'),
	(3, 'UM3', 12, 'UMB', 'L', 'J-403961441', 7, 'RIF'),
	(4, 'UM4', 12, 'UMB', 'FT', 'J-403961441', 7, 'RIF'),
	(5, 'UM5', 12, 'UMB', 'GAL', 'J-403961441', 7, 'RIF'),
	(6, 'UM6', 12, 'UMB', 'PAA', 'J-403961441', 7, 'RIF'),
	(7, 'UM7', 12, 'UMB', 'M3', 'J-403961441', 7, 'RIF'),
	(8, 'UM8', 12, 'UMB', 'KG', 'J-403961441', 7, 'RIF'),
	(9, 'UM9', 12, 'UMB', 'M2', 'J-403961441', 7, 'RIF'),
	(10, 'UN1', 12, 'UMB', 'ROL', 'J-403961441', 7, 'RIF'),
	(11, 'UN2', 12, 'UMB', 'LB', 'J-403961441', 7, 'RIF'),
	(12, 'UN3', 12, 'UMB', 'G', 'J-403961441', 7, 'RIF'),
	(1, 'POS', 13, 'SET', 'Sesion Activa', 'J-403961441', 7, 'RIF'),
	(2, 'NEG', 13, 'SET', 'Sesion Inactiva', 'J-403961441', 7, 'RIF'),
	(1, 'ACT', 3, 'STA', 'Activo', 'J-403961441', 7, 'RIF'),
	(2, 'INC', 3, 'STA', 'Inactivo', 'J-403961441', 7, 'RIF');
/*!40000 ALTER TABLE `tipo_entidad` ENABLE KEYS */;

-- Volcando datos para la tabla ventaso2_sisregin.token: ~1 rows (aproximadamente)
DELETE FROM `token`;
INSERT INTO `token` (`ID`, `ID_Usuario`, `token`, `fechaTope`) VALUES
	(1, '1', '73b82ece748866749d66411d908585ae4192b967', '3135453468468446846');

-- Volcando datos para la tabla ventaso2_sisregin.usuario: 3 rows
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`ID_Usurio`, `dni`, `nu_tipo_entidad_doc`, `in_clasificacion_tipo_ent_doc`, `username`, `password`, `emailuser`, `nu_tipo_entidad_prf`, `in_clasificacion_tipo_ent_prf`, `nu_tipo_entidad_sta`, `in_clasificacion_tipo_ent_sta`, `nu_tipo_entidad_set`, `in_clasificacion_tipo_ent_set`, `dni_enterprise`, `nu_tipo_entidad_doc_ent`, `in_clasificacion_tipo_ent_doc_ent`) VALUES
	(1, 'V23166229', 3, 'CDV', 'TTARCO', 'V23166229', 'tonytarco@hotmail.com', 1, 'MNS', 2, 'INC', 2, 'NEG', 'J-403961441', 7, 'RIF'),
	(2, 'C123456', 1, 'CDC', 'JTORRES', 'C123456', 'jtorres@gmail.com', 3, 'ANI', 2, 'INC', 2, 'NEG', 'J-403961441', 7, 'RIF'),
	(3, 'C123', 1, 'CDC', 'GTOLEDO', 'S123456', 'gtoledo@consultoriaeconomicasas.com', 3, 'ANI', 2, 'INC', 2, 'NEG', 'J-403961441', 7, 'RIF');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
ventaso2_sisreginventaso2_sisregin