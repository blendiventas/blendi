<?php

/*
-- --------------------------------------------------------
-- Host:                         www.?????com
-- Versión del servidor:         10.1.48-MariaDB-0+deb9u2 - Debian 9.13
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------
*/
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
/*!40101 SET NAMES utf8 */
/*!50503 SET NAMES utf8mb4 */
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */

/* -- Volcando estructura para tabla bancos_cajas */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `bancos_cajas` (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `descripcion` varchar(35) COLLATE utf8_spanish_ci DEFAULT NULL,
        `entidad` varchar(4) COLLATE utf8_spanish_ci DEFAULT NULL,
        `agencia` varchar(4) COLLATE utf8_spanish_ci DEFAULT NULL,
        `dc` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
        `cuenta` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
        `iban` varchar(24) COLLATE utf8_spanish_ci DEFAULT NULL,
        `activo` tinyint(1) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`) USING BTREE, UNIQUE KEY `empresa` (`cuenta`) USING BTREE
    ) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla bancos_cajas: 1 rows */
    /*!40000 ALTER TABLE `bancos_cajas` DISABLE KEYS */
$result = $conn->query("INSERT INTO `bancos_cajas` (`id`, `descripcion`, `entidad`, `agencia`, `dc`, `cuenta`, `iban`, `activo`) VALUES
(1, 'Caja', '', '', '', '', '', 1);");
/*!40000 ALTER TABLE `bancos_cajas` ENABLE KEYS */

/* -- Volcando estructura para tabla categorias */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `categorias` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_idioma` int(11) unsigned NOT NULL DEFAULT '0',
  `descripcion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_url` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `titulo_meta` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_meta` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `updated` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alt` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tittle` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `texto_inicio` text COLLATE utf8_spanish_ci,
  `de` int(11) DEFAULT '0',
  `activa` tinyint(4) DEFAULT '0',
  `orden` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `inicio` tinyint(1) NOT NULL DEFAULT '0',
  `orden_inicio` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `mostrar_buscador` tinyint(1) NOT NULL DEFAULT '0',
  `link` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `link_externo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `texto_titulo` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");

/* -- Volcando datos para la tabla categorias: 0 rows */
    /*!40000 ALTER TABLE `categorias` DISABLE KEYS */
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */

/* -- Volcando estructura para tabla categorias_elaborados */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `categorias_elaborados` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla categorias_elaborados: 0 rows */
    /*!40000 ALTER TABLE `categorias_elaborados` DISABLE KEYS */
/*!40000 ALTER TABLE `categorias_elaborados` ENABLE KEYS */

/* -- Volcando estructura para tabla configuracion */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `configuracion` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_librador` int(11) NOT NULL DEFAULT '0',
  `pvp_iva_incluido` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla configuracion: 1 rows */
    /*!40000 ALTER TABLE `configuracion` DISABLE KEYS */
$result = $conn->query("INSERT INTO `configuracion` (`id`, `id_librador`, `pvp_iva_incluido`, `fecha_modificacion`) VALUES
(1, 1, 1, '2022-02-14');");
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */

/* -- Volcando estructura para tabla descuentos */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `descuentos` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desde` double(15,2) NOT NULL DEFAULT '0.00',
  `hasta` double(15,2) NOT NULL DEFAULT '0.00',
  `descuento` double(7,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla descuentos: 4 rows */
    /*!40000 ALTER TABLE `descuentos` DISABLE KEYS */
$result = $conn->query("INSERT INTO `descuentos` (`id`, `desde`, `hasta`, `descuento`) VALUES
(1, 100.00, 200.00, 5.00),
	(2, 201.00, 300.00, 10.00),
	(3, 301.00, 500.00, 15.00),
	(4, 501.00, 90000000.00, 20.00);");
/*!40000 ALTER TABLE `descuentos` ENABLE KEYS */

/* -- Volcando estructura para tabla diccionario */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `diccionario` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_idioma` int(11) DEFAULT '0',
  `apartado` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `texto` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `traduccion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `indice` (`id_idioma`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla diccionario: 30 rows */
    /*!40000 ALTER TABLE `diccionario` DISABLE KEYS */
$result = $conn->query("INSERT INTO `diccionario` (`id`, `id_idioma`, `apartado`, `texto`, `traduccion`) VALUES
(1, 4, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(2, 4, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(3, 4, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES'),
	(5, 1, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(6, 1, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(7, 1, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES'),
	(8, 2, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(9, 2, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(10, 2, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES'),
	(11, 3, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(12, 3, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(13, 3, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES'),
	(14, 5, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(15, 5, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(16, 5, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES'),
	(17, 6, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(18, 6, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(19, 6, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES'),
	(20, 7, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(21, 7, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(22, 7, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES'),
	(23, 8, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(24, 8, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(25, 8, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES'),
	(26, 9, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(27, 9, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(28, 9, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES'),
	(29, 10, 'SEO', 'descripcion_title', 'Cuida tu musica, tus discos de vinilo, CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(30, 10, 'SEO', 'descripcion_meta', 'Cuida tu musica, tus discos de vinilo, tus fundas para discos,CD, Gramofono, agujas tocadiscos en CUIDATUMUSICA'),
	(31, 10, 'SEO', 'h1', 'LA WEB PARA COLECCIONISTAS Y PROFESIONALES');");
/*!40000 ALTER TABLE `diccionario` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_1 */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_1` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sesion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `so` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_documento` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `procedencia` varchar(3) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'tpv',
  `tipo_librador` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_librador` int(11) DEFAULT NULL,
  `fecha_documento` date DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_entrega_desde` date DEFAULT NULL,
  `fecha_entrega_hasta` date DEFAULT NULL,
  `numero_documento` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `serie_documento` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `modalidad_pago` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `modalidad_envio` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `modalidad_entrega` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `irpf` double(7,2) DEFAULT NULL,
  `importe_irpf` double(15,2) DEFAULT NULL,
  `descuento_pp` double(7,2) DEFAULT NULL,
  `importe_descuento_pp` double(15,2) DEFAULT NULL,
  `descuento_librador` double(7,2) DEFAULT NULL,
  `importe_descuento_librador` double(15,2) DEFAULT NULL,
  `base` double(15,2) DEFAULT NULL,
  `total` double(15,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `id_usuario` int(10) DEFAULT NULL,
  `comensales` smallint(5) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_terminal` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_2022_1: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_1` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_1` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_2 */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_2` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_documentos_1` int(11) NOT NULL,
  `tipo_documento` varchar(3) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `tipo_librador` varchar(3) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `id_librador` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(250) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `tipo_producto` tinyint(1) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  `fecha_entrega_desde` date NOT NULL,
  `fecha_entrega_hasta` date NOT NULL,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) NOT NULL DEFAULT '0',
  `id_packs` int(11) NOT NULL DEFAULT '0',
  `id_productos_relacionados_grupos` int(11) NOT NULL,
  `descripcion_productos_relacionados_grupos` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `imagen_producto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_producto` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `detalles_producto` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_oferta` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_barras_producto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `referencia_producto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `referencia_librador` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `numero_serie` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `lote` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `caducidad` date NOT NULL,
  `cantidad` double(15,5) NOT NULL DEFAULT '0.00000',
  `id_unidades` int(11) NOT NULL DEFAULT '0',
  `unidad` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `coste` double(15,2) NOT NULL,
  `importe` double(15,2) NOT NULL DEFAULT '0.00',
  `fijo` tinyint(1) NOT NULL DEFAULT '0',
  `base_antes_descuento` double(15,2) NOT NULL DEFAULT '0.00',
  `descuento_base` double(7,2) NOT NULL DEFAULT '0.00',
  `importe_descuento_base` double(15,2) NOT NULL DEFAULT '0.00',
  `base_despues_descuento` double(15,2) NOT NULL DEFAULT '0.00',
  `iva` double(7,2) NOT NULL DEFAULT '0.00',
  `importe_iva` double(15,2) NOT NULL DEFAULT '0.00',
  `recargo` double(7,2) NOT NULL DEFAULT '0.00',
  `importe_recargo` double(15,2) NOT NULL DEFAULT '0.00',
  `pvp_unidad` double(15,2) NOT NULL DEFAULT '0.00',
  `total_antes_descuento` double(15,2) NOT NULL DEFAULT '0.00',
  `descuento_total` double(7,2) NOT NULL DEFAULT '0.00',
  `importe_descuento_total` double(15,2) NOT NULL DEFAULT '0.00',
  `total_despues_descuento` double(15,2) NOT NULL DEFAULT '0.00',
  `id_documento_anterior` int(11) NOT NULL DEFAULT '0',
  `id_vendedor` int(11) NOT NULL DEFAULT '0',
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `id_usuario` int(10) NOT NULL DEFAULT '0',
  `orden` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `hora` time NOT NULL,
  `id_terminal` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_documento` (`id_documentos_1`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_2022_2: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_2` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_2` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_iva */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_iva` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_documentos_1` int(11) DEFAULT NULL,
  `id_documentos_2` int(11) DEFAULT NULL,
  `base` double(15,2) DEFAULT NULL,
  `iva` double(7,2) DEFAULT NULL,
  `importe_iva` double(15,2) DEFAULT NULL,
  `recargo` double(7,2) DEFAULT NULL,
  `importe_recargo` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_2022_iva: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_iva` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_iva` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_libradores */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_libradores` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_documentos_1` int(11) DEFAULT NULL,
  `codigo_librador` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `apellido_1` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `apellido_2` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `razon_social` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `razon_comercial` varchar(75) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `nif` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `direccion` varchar(90) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `numero` varchar(7) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `escalera` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `piso` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `puerta` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `localidad` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `codigo_postal` varchar(7) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `provincia` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `telefono_1` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `telefono_2` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `fax` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `mobil` varchar(11) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `persona_contacto` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `banco` varchar(35) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `entidad` varchar(4) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `agencia` varchar(4) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `dc` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `cuenta` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `iban` varchar(24) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `id_tarifa_web` int(11) DEFAULT '0',
  `id_tarifa_tpv` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");

/* -- Volcando datos para la tabla documentos_2022_libradores: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_libradores` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_libradores` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_libradores_envio */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_libradores_envio` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_documentos_1` int(11) DEFAULT NULL,
  `fecha_documento` date DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `id_librador` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `apellido_1` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `apellido_2` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `razon_social` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `razon_comercial` varchar(75) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `direccion` varchar(90) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `numero` varchar(7) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `escalera` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `piso` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `puerta` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `localidad` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `codigo_postal` varchar(7) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `provincia` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `zona` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `telefono_1` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `telefono_2` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `mobil` varchar(11) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `persona_contacto` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `observaciones` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");

/* -- Volcando datos para la tabla documentos_2022_libradores_envio: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_libradores_envio` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_libradores_envio` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_observaciones */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_observaciones` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_documentos_1` int(11) NOT NULL,
  `id_documentos_2` int(11) NOT NULL,
  `id_documentos_combo` int(11) NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");

/* -- Volcando datos para la tabla documentos_2022_observaciones: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_observaciones` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_observaciones` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_productos_costes */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_productos_costes` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_documentos_2` int(11) NOT NULL,
  `cantidad_base` double(9,3) DEFAULT NULL,
  `id_unidades_base` int(11) DEFAULT NULL,
  `rentabilidad` double(9,3) DEFAULT NULL,
  `id_categoria_elaborados` int(11) DEFAULT NULL,
  `tiempo` int(10) DEFAULT NULL,
  `coste` double(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_2022_productos_costes: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_productos_costes` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_productos_costes` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_productos_relacionados */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_productos_relacionados` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_productos_relacionados` int(11) unsigned NOT NULL DEFAULT '0',
  `id_documentos_2` int(11) unsigned NOT NULL DEFAULT '0',
  `id_documentos_combo` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) unsigned NOT NULL DEFAULT '0',
  `id_packs` int(11) unsigned NOT NULL DEFAULT '0',
  `id_relacionado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_grupo` int(11) unsigned NOT NULL DEFAULT '0',
  `fijo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `modelo` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 - Con / Sin\r\n1 - Normal / Mitad / Sin / Doble\r\n2 - Input cantidad\r\n3 - Unico',
  `cantidad_con` double(15,5) NOT NULL DEFAULT '0.00000',
  `cantidad_mitad` double(15,5) NOT NULL DEFAULT '0.00000',
  `cantidad_sin` double(15,5) NOT NULL DEFAULT '0.00000',
  `cantidad_doble` double(15,5) NOT NULL DEFAULT '0.00000',
  `sumar_con` double(15,2) NOT NULL DEFAULT '0.00',
  `sumar_mitad` double(15,2) NOT NULL DEFAULT '0.00',
  `sumar_sin` double(15,2) NOT NULL DEFAULT '0.00',
  `sumar_doble` double(15,2) NOT NULL DEFAULT '0.00',
  `por_defecto` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-con\r\n1-mitad\r\n2-sin\r\n3-doble',
  `mostrar` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `indice` (`id_documentos_2`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_2022_productos_relacionados: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_productos_relacionados` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_productos_relacionados` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_productos_relacionados_combo */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_productos_relacionados_combo` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_documentos_2` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) unsigned NOT NULL DEFAULT '0',
  `id_packs` int(11) unsigned NOT NULL DEFAULT '0',
  `id_relacionado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_grupo` int(11) unsigned NOT NULL DEFAULT '0',
  `fijo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `cantidad` double(15,5) NOT NULL DEFAULT '0.00000',
  `sumar` double(15,2) NOT NULL DEFAULT '0.00',
  `mostrar` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `indice` (`id_documentos_2`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_2022_productos_relacionados_combo: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_productos_relacionados_combo` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_productos_relacionados_combo` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_productos_relacionados_elaborados */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_productos_relacionados_elaborados` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_documentos_2` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) unsigned NOT NULL DEFAULT '0',
  `id_packs` int(11) unsigned NOT NULL DEFAULT '0',
  `id_categoria_estadisticas` int(11) unsigned NOT NULL DEFAULT '0',
  `id_producto_relacionado` int(11) unsigned NOT NULL DEFAULT '0',
  `fijo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `cantidad` double(15,5) NOT NULL DEFAULT '0.00000',
  `coste` double NOT NULL DEFAULT '0',
  `id_unidad` int(11) unsigned NOT NULL DEFAULT '0',
  `sumar` double(15,2) NOT NULL DEFAULT '0.00',
  `mostrar` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `indice` (`id_documentos_2`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_2022_productos_relacionados_elaborados: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_productos_relacionados_elaborados` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_productos_relacionados_elaborados` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_2022_productos_sku_stock */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_2022_productos_sku_stock` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_productos_sku` int(11) NOT NULL DEFAULT '0',
  `lote` varchar(20) COLLATE utf8_spanish_ci DEFAULT '',
  `caducidad` date DEFAULT NULL,
  `numero_serie` varchar(20) COLLATE utf8_spanish_ci DEFAULT '',
  `tipo_documento` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'ela = elaboración\r\npre = presupuesto\r\nped = pedido\r\nalb = albarán\r\nfac = factura\r\ntiq = tiquet',
  `fecha` date DEFAULT NULL,
  `id_documento_1` int(11) NOT NULL DEFAULT '0',
  `id_documento_2` int(11) NOT NULL DEFAULT '0',
  `tipo_librador` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_librador` int(11) DEFAULT '0',
  `coste` double(15,2) NOT NULL DEFAULT '0.00',
  `cantidad` double(15,5) NOT NULL DEFAULT '0.00000',
  `id_unidades` int(11) NOT NULL DEFAULT '0',
  `unidad` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `importe` double(15,2) NOT NULL DEFAULT '0.00',
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `lote` (`lote`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_2022_productos_sku_stock: 0 rows */
    /*!40000 ALTER TABLE `documentos_2022_productos_sku_stock` DISABLE KEYS */
/*!40000 ALTER TABLE `documentos_2022_productos_sku_stock` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_numeraciones */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_numeraciones` (
`id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ejercicio` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `consecutivo` tinyint(1) NOT NULL DEFAULT '0',
  `serie` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `numero` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_numeraciones: 5 rows */
    /*!40000 ALTER TABLE `documentos_numeraciones` DISABLE KEYS */
$result = $conn->query("INSERT INTO `documentos_numeraciones` (`id`, `tipo_documento`, `ejercicio`, `consecutivo`, `serie`, `numero`) VALUES
(1, 'pre', '2022', 1, '', 0),
	(2, 'ped', '2022', 1, '', 0),
	(3, 'alb', '2022', 1, '', 0),
	(4, 'fac', '2022', 1, '', 0),
	(5, 'tiq', '2022', 1, '', 0);");
/*!40000 ALTER TABLE `documentos_numeraciones` ENABLE KEYS */

/* -- Volcando estructura para tabla documentos_numeraciones_series */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `documentos_numeraciones_series` (
`id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `serie` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla documentos_numeraciones_series: 1 rows */
    /*!40000 ALTER TABLE `documentos_numeraciones_series` DISABLE KEYS */
$result = $conn->query("INSERT INTO `documentos_numeraciones_series` (`id`, `tipo_documento`, `serie`, `comentario`) VALUES
(1, 'fac', 'ABONO', 'Abonos de facturas emitidas');");
/*!40000 ALTER TABLE `documentos_numeraciones_series` ENABLE KEYS */

/* -- Volcando estructura para tabla identificacion_accesos */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `identificacion_accesos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_librador` int(11) NOT NULL DEFAULT '0',
  `tipo_librador` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_documento` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `sesion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla identificacion_accesos: 0 rows */
    /*!40000 ALTER TABLE `identificacion_accesos` DISABLE KEYS */
/*!40000 ALTER TABLE `identificacion_accesos` ENABLE KEYS */

/* -- Volcando estructura para tabla idiomas */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `idiomas` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `idioma` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `bandera` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `updated` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `lang` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `locale` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `principal` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla idiomas: 10 rows */
    /*!40000 ALTER TABLE `idiomas` DISABLE KEYS */
$result = $conn->query("INSERT INTO `idiomas` (`id`, `idioma`, `bandera`, `updated`, `lang`, `locale`, `activo`, `principal`) VALUES
(1, 'Alemán', 'aleman.png', '210821090828', 'de', 'de-DE', 0, 0),
	(2, 'Aragonés', 'aragones.png', '210821090828', 'an', 'an-ES', 0, 0),
	(3, 'Catalán', 'catala-220125160131.png', '210821090828', 'ca', 'ca-ES', 0, 0),
	(4, 'Español', 'castellano.png', '210821090828', 'es', 'es-ES', 1, 1),
	(5, 'Francés', 'frances.png', '210821090828', 'fr', 'fr-FR', 0, 0),
	(6, 'Gallego', 'gallego.png', '210821090828', 'gl', 'gl-ES', 0, 0),
	(7, 'Inglés', 'ingles.png', '210821090828', 'en', 'en-GB', 0, 0),
	(8, 'Italiano', 'italiano.png', '210821090828', 'it', 'it-IT', 0, 0),
	(9, 'Portugués', 'portugues.png', '210821090828', 'pt', 'pt-PT', 0, 0),
	(10, 'Vascuence', 'vascuence.png', '210821090828', 'eu', 'eu-ES', 0, 0);");
/*!40000 ALTER TABLE `idiomas` ENABLE KEYS */

/* -- Volcando estructura para tabla irpf */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `irpf` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `irpf` double(7,2) NOT NULL DEFAULT '0.00',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla irpf: 0 rows */
    /*!40000 ALTER TABLE `irpf` DISABLE KEYS */
/*!40000 ALTER TABLE `irpf` ENABLE KEYS */

/* -- Volcando estructura para tabla libradores */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `libradores` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codigo_librador` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `tipo` varchar(3) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'cli',
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `apellido_1` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `apellido_2` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `razon_social` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `razon_comercial` varchar(75) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `nif` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `direccion` varchar(90) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `numero` varchar(7) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `escalera` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `piso` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `puerta` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `localidad` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `codigo_postal` varchar(7) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `provincia` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `id_zona` int(11) NOT NULL DEFAULT '0',
  `telefono_1` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `telefono_2` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `fax` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `mobil` varchar(11) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `password_acceso` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `id_categoria_sms` int(11) NOT NULL DEFAULT '0',
  `id_categoria_email` int(11) NOT NULL DEFAULT '0',
  `persona_contacto` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `banco` varchar(35) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `entidad` varchar(4) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `agencia` varchar(4) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `dc` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `cuenta` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `iban` varchar(24) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `sexo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `fecha_nacimiento` date DEFAULT NULL,
  `observaciones` text COLLATE utf8_spanish_ci,
  `id_modalidades_envio` int(10) unsigned NOT NULL DEFAULT '0',
  `id_modalidades_entrega` int(10) unsigned NOT NULL DEFAULT '0',
  `id_modalidades_pago` int(10) unsigned NOT NULL DEFAULT '0',
  `plazo_entrega` int(10) unsigned NOT NULL DEFAULT '0',
  `id_iva` int(11) NOT NULL DEFAULT '0',
  `recargo` tinyint(1) NOT NULL DEFAULT '0',
  `id_irpf` int(11) NOT NULL DEFAULT '0',
  `dia_pago_1` int(10) DEFAULT '0',
  `dia_pago_2` int(10) DEFAULT '0',
  `descuento_pp` double(7,2) DEFAULT '0.00',
  `descuento_librador` double(7,2) DEFAULT '0.00',
  `id_tarifa_web` int(11) DEFAULT '0',
  `id_tarifa_tpv` int(11) DEFAULT '0',
  `procedencia` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `id_cliente_origen` int(11) NOT NULL DEFAULT '0',
  `id_vendedor` int(11) NOT NULL DEFAULT '0',
  `id_nivel_comisiones` int(11) unsigned NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `id_banco_cobro` int(11) NOT NULL DEFAULT '0',
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");

/* -- Volcando datos para la tabla libradores: 1 rows */
    /*!40000 ALTER TABLE `libradores` DISABLE KEYS */
$result = $conn->query("INSERT INTO `libradores` (`id`, `codigo_librador`, `tipo`, `nombre`, `apellido_1`, `apellido_2`, `razon_social`, `razon_comercial`, `nif`, `direccion`, `numero`, `escalera`, `piso`, `puerta`, `localidad`, `codigo_postal`, `provincia`, `id_zona`, `telefono_1`, `telefono_2`, `fax`, `mobil`, `email`, `password_acceso`, `id_categoria_sms`, `id_categoria_email`, `persona_contacto`, `banco`, `entidad`, `agencia`, `dc`, `cuenta`, `iban`, `sexo`, `fecha_nacimiento`, `observaciones`, `id_modalidades_envio`, `id_modalidades_entrega`, `id_modalidades_pago`, `plazo_entrega`, `id_iva`, `recargo`, `id_irpf`, `dia_pago_1`, `dia_pago_2`, `descuento_pp`, `descuento_librador`, `id_tarifa_web`, `id_tarifa_tpv`, `procedencia`, `id_cliente_origen`, `id_vendedor`, `id_nivel_comisiones`, `activo`, `id_banco_cobro`, `fecha_alta`, `fecha_modificacion`) VALUES
(1, '', 'cli', '', '', '', 'Ventas', 'Ventas', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', 0, '0000-00-00', '', 0, 0, 1, 0, -1, 0, 3, 0, 0, 0.00, 0.00, 1, 2, '', 0, 0, 0, 1, 0, '2022-02-14', '2022-05-16');");
/*!40000 ALTER TABLE `libradores` ENABLE KEYS */

/* -- Volcando estructura para tabla libradores_envio */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `libradores_envio` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_librador` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `apellido_1` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `apellido_2` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `razon_social` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `razon_comercial` varchar(75) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `direccion` varchar(90) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `numero` varchar(7) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `escalera` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `piso` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `puerta` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `localidad` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `codigo_postal` varchar(7) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `provincia` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `id_zona` int(11) NOT NULL DEFAULT '0',
  `telefono_1` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `telefono_2` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `mobil` varchar(11) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `persona_contacto` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `observaciones` text COLLATE utf8_spanish_ci,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");

/* -- Volcando datos para la tabla libradores_envio: 0 rows */
    /*!40000 ALTER TABLE `libradores_envio` DISABLE KEYS */
/*!40000 ALTER TABLE `libradores_envio` ENABLE KEYS */

/* -- Volcando estructura para tabla modalidades_entrega */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `modalidades_entrega` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `explicacion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla modalidades_entrega: 2 rows */
    /*!40000 ALTER TABLE `modalidades_entrega` DISABLE KEYS */
$result = $conn->query("INSERT INTO `modalidades_entrega` (`id`, `descripcion`, `explicacion`) VALUES
(1, 'Entrega en tienda', ''),
	(2, 'Envio a domicilio', '');");
/*!40000 ALTER TABLE `modalidades_entrega` ENABLE KEYS */

/* -- Volcando estructura para tabla modalidades_envio */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `modalidades_envio` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `explicacion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla modalidades_envio: 3 rows */
    /*!40000 ALTER TABLE `modalidades_envio` DISABLE KEYS */
$result = $conn->query("INSERT INTO `modalidades_envio` (`id`, `descripcion`, `explicacion`) VALUES
(1, 'PREMIER', ''),
	(2, 'Económico', ''),
	(3, 'Express', '');");
/*!40000 ALTER TABLE `modalidades_envio` ENABLE KEYS */

/* -- Volcando estructura para tabla modalidades_pago */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `modalidades_pago` (
`id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `explicacion` text COLLATE utf8_spanish_ci NOT NULL,
  `tienda_virtual` tinyint(1) NOT NULL DEFAULT '0',
  `defecto` tinyint(1) NOT NULL DEFAULT '0',
  `id_iva` int(10) NOT NULL DEFAULT '0',
  `incremento_pvp` double(4,2) NOT NULL DEFAULT '0.00',
  `incremento_por` double(4,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla modalidades_pago: 1 rows */
    /*!40000 ALTER TABLE `modalidades_pago` DISABLE KEYS */
$result = $conn->query("INSERT INTO `modalidades_pago` (`id`, `descripcion`, `explicacion`, `tienda_virtual`, `defecto`, `id_iva`, `incremento_pvp`, `incremento_por`) VALUES
(1, 'Contado', '-', 1, 0, 1, 0.00, 3.00);");
/*!40000 ALTER TABLE `modalidades_pago` ENABLE KEYS */

/* -- Volcando estructura para tabla modalidades_pago_lineas */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `modalidades_pago_lineas` (
`id` int(10) NOT NULL AUTO_INCREMENT,
  `id_forma_pago` int(10) NOT NULL DEFAULT '0',
  `dias` int(10) NOT NULL DEFAULT '0',
  `porcentaje` double(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla modalidades_pago_lineas: 1 rows */
    /*!40000 ALTER TABLE `modalidades_pago_lineas` DISABLE KEYS */
$result = $conn->query("INSERT INTO `modalidades_pago_lineas` (`id`, `id_forma_pago`, `dias`, `porcentaje`) VALUES
(1, 1, 0, 100.00);");
/*!40000 ALTER TABLE `modalidades_pago_lineas` ENABLE KEYS */

/* -- Volcando estructura para tabla ofertas */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `ofertas` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_idioma` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla ofertas: 0 rows */
    /*!40000 ALTER TABLE `ofertas` DISABLE KEYS */
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */

/* -- Volcando estructura para tabla productos */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_idioma` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_producto` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'tipo_producto = 0 // normal\r\ntipo_producto = 1 // elaborado\r\ntipo_producto = 2 // compuesto\r\ntipo_producto = 3 // combo manual\r\ntipo_producto = 4 // combo automático',
  `producto_venta` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '0 = producto interno\r\n1 = producto en venta',
  `id_iva` int(11) NOT NULL DEFAULT '0',
  `peso_bruto` double(15,3) NOT NULL DEFAULT '0.000',
  `peso_neto` double(15,3) NOT NULL DEFAULT '0.000',
  `coste` double(15,2) NOT NULL DEFAULT '0.00',
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `updated` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alt` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tittle` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos: 0 rows */
    /*!40000 ALTER TABLE `productos` DISABLE KEYS */
/*!40000 ALTER TABLE `productos` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_categorias */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_categorias` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL DEFAULT '0',
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_categoria` (`id_categoria`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_categorias: 0 rows */
    /*!40000 ALTER TABLE `productos_categorias` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_categorias` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_costes */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_costes` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad_base` double(9,3) DEFAULT NULL,
  `id_unidades_base` int(11) DEFAULT NULL,
  `rentabilidad` double(9,3) DEFAULT NULL,
  `tiempo` int(10) DEFAULT NULL,
  `id_categoria_elaborados` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_costes: 0 rows */
    /*!40000 ALTER TABLE `productos_costes` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_costes` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_detalles */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_detalles` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_idioma` int(11) NOT NULL DEFAULT '0',
  `detalle` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_detalles: 0 rows */
    /*!40000 ALTER TABLE `productos_detalles` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_detalles` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_detalles_datos */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_detalles_datos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_productos_detalles` int(11) NOT NULL DEFAULT '0',
  `detalle` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_productos_detalles` (`id_productos_detalles`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_detalles_datos: 0 rows */
    /*!40000 ALTER TABLE `productos_detalles_datos` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_detalles_datos` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_detalles_enlazado */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_detalles_enlazado` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_atributo_principal` int(11) NOT NULL DEFAULT '0',
  `id_dato_principal` int(11) NOT NULL DEFAULT '0',
  `id_atributo_enlazado` int(11) NOT NULL DEFAULT '0',
  `id_dato_enlazado` int(11) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_alta` date NOT NULL,
  `fecha_modificacion` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_producto` (`id_producto`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_detalles_enlazado: 0 rows */
    /*!40000 ALTER TABLE `productos_detalles_enlazado` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_detalles_enlazado` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_detalles_multiples */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_detalles_multiples` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_atributo` int(11) NOT NULL DEFAULT '0',
  `id_dato` int(11) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_alta` date NOT NULL,
  `fecha_modificacion` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_producto` (`id_producto`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_detalles_multiples: 0 rows */
    /*!40000 ALTER TABLE `productos_detalles_multiples` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_detalles_multiples` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_detalles_unicos */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_detalles_unicos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_atributo` int(11) NOT NULL DEFAULT '0',
  `id_dato` int(11) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_alta` date NOT NULL,
  `fecha_modificacion` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_producto` (`id_producto`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_detalles_unicos: 0 rows */
    /*!40000 ALTER TABLE `productos_detalles_unicos` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_detalles_unicos` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_images */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_images` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) DEFAULT '0',
  `id_productos_detalles_multiples` int(11) DEFAULT '0',
  `id_packs` int(11) DEFAULT '0',
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `updated` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alt` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tittle` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_images: 0 rows */
    /*!40000 ALTER TABLE `productos_images` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_images` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_iva */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_iva` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `iva` double(7,2) NOT NULL DEFAULT '0.00',
  `recargo` double(7,2) NOT NULL DEFAULT '0.00',
  `prioritario` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_iva: 4 rows */
    /*!40000 ALTER TABLE `productos_iva` DISABLE KEYS */
$result = $conn->query("INSERT INTO `productos_iva` (`id`, `iva`, `recargo`, `prioritario`, `activo`) VALUES
(1, 21.00, 5.40, 1, 1),
	(3, 0.00, 0.00, 0, 1),
	(2, 4.00, 0.50, 0, 1),
	(4, 10.00, 1.50, 0, 1);");
/*!40000 ALTER TABLE `productos_iva` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_observaciones */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_observaciones` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_observaciones: 0 rows */
    /*!40000 ALTER TABLE `productos_observaciones` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_observaciones` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_otros */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_otros` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) NOT NULL DEFAULT '0',
  `id_packs` int(11) NOT NULL DEFAULT '0',
  `control_stock` tinyint(1) NOT NULL DEFAULT '0',
  `tienda` tinyint(1) NOT NULL DEFAULT '0',
  `url_externa` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `disponibilidad` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_modificacion` date DEFAULT NULL,
  `enviar` int(11) NOT NULL DEFAULT '0',
  `manual` tinyint(1) NOT NULL DEFAULT '0',
  `profesionales` tinyint(1) NOT NULL DEFAULT '0',
  `peso` double(15,5) DEFAULT '0.00000',
  `bultos` double(15,5) DEFAULT '0.00000',
  `gastos` double(15,2) DEFAULT '0.00',
  `envio_gratis` tinyint(1) NOT NULL DEFAULT '0',
  `dias_entrega` int(11) NOT NULL DEFAULT '0',
  `aplicar_descuento` tinyint(1) NOT NULL DEFAULT '0',
  `descuento_maximo` double(15,5) DEFAULT '0.00000',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_otros: 0 rows */
    /*!40000 ALTER TABLE `productos_otros` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_otros` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_packs */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_packs` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) NOT NULL DEFAULT '0',
  `cantidad_pack` double(7,2) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_producto` (`id_producto`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_packs: 0 rows */
    /*!40000 ALTER TABLE `productos_packs` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_packs` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_pvp */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_pvp` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) NOT NULL DEFAULT '0',
  `id_packs` int(11) NOT NULL DEFAULT '0',
  `id_tarifa` int(11) NOT NULL DEFAULT '0',
  `margen` double(15,5) NOT NULL DEFAULT '0.00000',
  `pvp` double(15,2) NOT NULL DEFAULT '0.00',
  `fecha_modificacion` date DEFAULT NULL,
  `id_ofertas` int(11) NOT NULL DEFAULT '0',
  `oferta_desde` date DEFAULT NULL,
  `oferta_hasta` date DEFAULT NULL,
  `pvp_oferta` double(15,2) DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_producto` (`id_producto`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_pvp: 0 rows */
    /*!40000 ALTER TABLE `productos_pvp` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_pvp` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_relacionados */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_relacionados` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) unsigned NOT NULL DEFAULT '0',
  `id_packs` int(11) unsigned NOT NULL DEFAULT '0',
  `id_relacionado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_grupo` int(11) unsigned NOT NULL DEFAULT '0',
  `fijo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `modelo` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 - Con / Sin\r\n1 - Normal / Mitad / Sin / Doble\r\n2 - Input cantidad\r\n3 - Unico',
  `cantidad_con` double(15,5) NOT NULL DEFAULT '0.00000',
  `cantidad_mitad` double(15,5) NOT NULL DEFAULT '0.00000',
  `cantidad_sin` double(15,5) NOT NULL DEFAULT '0.00000',
  `cantidad_doble` double(15,5) NOT NULL DEFAULT '0.00000',
  `sumar_con` double(15,2) NOT NULL DEFAULT '0.00',
  `sumar_mitad` double(15,2) NOT NULL DEFAULT '0.00',
  `sumar_sin` double(15,2) NOT NULL DEFAULT '0.00',
  `sumar_doble` double(15,2) NOT NULL DEFAULT '0.00',
  `por_defecto` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-con\r\n1-mitad\r\n2-sin\r\n3-doble',
  `mostrar` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `indice` (`id_producto`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_relacionados: 0 rows */
    /*!40000 ALTER TABLE `productos_relacionados` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_relacionados` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_relacionados_combo */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_relacionados_combo` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) unsigned NOT NULL DEFAULT '0',
  `id_packs` int(11) unsigned NOT NULL DEFAULT '0',
  `id_relacionado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_grupo` int(11) unsigned NOT NULL DEFAULT '0',
  `fijo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `cantidad` double(15,5) NOT NULL DEFAULT '0.00000',
  `sumar` double(15,2) NOT NULL DEFAULT '0.00',
  `mostrar` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `indice` (`id_producto`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_relacionados_combo: 0 rows */
    /*!40000 ALTER TABLE `productos_relacionados_combo` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_relacionados_combo` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_relacionados_elaborados */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_relacionados_elaborados` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) unsigned NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) unsigned NOT NULL DEFAULT '0',
  `id_packs` int(11) unsigned NOT NULL DEFAULT '0',
  `id_categoria_estadisticas` int(11) unsigned NOT NULL DEFAULT '0',
  `id_producto_relacionado` int(11) unsigned NOT NULL DEFAULT '0',
  `fijo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `cantidad` double(15,5) NOT NULL DEFAULT '0.00000',
  `id_unidad` int(11) unsigned NOT NULL DEFAULT '0',
  `sumar` double(15,2) NOT NULL DEFAULT '0.00',
  `mostrar` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `indice` (`id_producto`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_relacionados_elaborados: 0 rows */
    /*!40000 ALTER TABLE `productos_relacionados_elaborados` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_relacionados_elaborados` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_relacionados_grupos */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_relacionados_grupos` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_idioma` int(11) unsigned NOT NULL DEFAULT '0',
  `descripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_relacionados_grupos: 0 rows */
    /*!40000 ALTER TABLE `productos_relacionados_grupos` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_relacionados_grupos` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_sku */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_sku` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) NOT NULL DEFAULT '0',
  `id_packs` int(11) NOT NULL DEFAULT '0',
  `codigo_barras` varchar(20) COLLATE utf8_spanish_ci DEFAULT '',
  `referencia` varchar(20) COLLATE utf8_spanish_ci DEFAULT '',
  `stock` double(10,3) NOT NULL DEFAULT '0.000',
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `codigo_barras` (`codigo_barras`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_sku: 0 rows */
    /*!40000 ALTER TABLE `productos_sku` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_sku` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_unidades */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_unidades` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_unidad` int(11) NOT NULL DEFAULT '0',
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  `conversion_principal` double(15,5) NOT NULL DEFAULT '1.00000',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_unidades: 0 rows */
    /*!40000 ALTER TABLE `productos_unidades` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_unidades` ENABLE KEYS */

/* -- Volcando estructura para tabla productos_web_datos */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `productos_web_datos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_enlazado` int(11) NOT NULL DEFAULT '0',
  `id_productos_detalles_multiples` int(11) NOT NULL DEFAULT '0',
  `id_packs` int(11) NOT NULL DEFAULT '0',
  `descripcion_larga` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_url` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `titulo_meta` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_meta` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_observaciones` int(11) NOT NULL DEFAULT '0',
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_producto` (`id_producto`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla productos_web_datos: 0 rows */
    /*!40000 ALTER TABLE `productos_web_datos` DISABLE KEYS */
/*!40000 ALTER TABLE `productos_web_datos` ENABLE KEYS */

/* -- Volcando estructura para tabla rebuts_compte */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `rebuts_compte` (
`codi` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` int(10) DEFAULT NULL,
  `descripcio` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `import` double(15,5) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_client` int(10) DEFAULT NULL,
  `codi_compte_ingres` int(10) DEFAULT NULL,
  `modalitat_cobro` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `usuari` int(10) DEFAULT NULL,
  `caixa` int(10) DEFAULT NULL,
  PRIMARY KEY (`codi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla rebuts_compte: 0 rows */
    /*!40000 ALTER TABLE `rebuts_compte` DISABLE KEYS */
/*!40000 ALTER TABLE `rebuts_compte` ENABLE KEYS */

/* -- Volcando estructura para tabla tarifas */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `tarifas` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_idioma` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `prioritaria` tinyint(4) NOT NULL DEFAULT '0',
  `activa` tinyint(4) NOT NULL DEFAULT '1',
  `orden` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla tarifas: 2 rows */
    /*!40000 ALTER TABLE `tarifas` DISABLE KEYS */
$result = $conn->query("INSERT INTO `tarifas` (`id`, `id_idioma`, `descripcion`, `prioritaria`, `activa`, `orden`) VALUES
(1, 4, 'Online', 0, 1, '1'),
	(2, 4, 'Tienda física', 1, 1, '2');");
/*!40000 ALTER TABLE `tarifas` ENABLE KEYS */

/* -- Volcando estructura para tabla unidades */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `unidades` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `abreviatura` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla unidades: 3 rows */
    /*!40000 ALTER TABLE `unidades` DISABLE KEYS */
$result = $conn->query("INSERT INTO `unidades` (`id`, `unidad`, `abreviatura`) VALUES
(1, 'unidad', 'unid.'),
	(2, 'kilo', 'Kgr.'),
	(3, 'litro', 'ltr.');");
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */

/* -- Volcando estructura para tabla usuarios */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `terminal` int(11) NOT NULL DEFAULT '-1',
  `id_empresa` int(11) NOT NULL DEFAULT '-1',
  `id_idioma` int(11) NOT NULL DEFAULT '1',
  `bloqueo` tinyint(4) NOT NULL DEFAULT '0',
  `id_comercial` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla usuarios: 2 rows */
    /*!40000 ALTER TABLE `usuarios` DISABLE KEYS */
$result = $conn->query("INSERT INTO `usuarios` (`id`, `usuario`, `password`, `terminal`, `id_empresa`, `id_idioma`, `bloqueo`, `id_comercial`) VALUES
(1, 'Administrador', '1234', -1, -1, 4, 0, 0);");
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */

/* -- Volcando estructura para tabla usuarios_accesos */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `usuarios_accesos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `sesion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `dia` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla usuarios_accesos: 0 rows */
    /*!40000 ALTER TABLE `usuarios_accesos` DISABLE KEYS */
/*!40000 ALTER TABLE `usuarios_accesos` ENABLE KEYS */

/* -- Volcando estructura para tabla usuarios_historico */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `usuarios_historico` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL,
  `error_password` tinyint(1) NOT NULL DEFAULT '0',
  `sesion` varchar(200) CHARACTER SET latin1 NOT NULL,
  `password` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla usuarios_historico: 0 rows */
    /*!40000 ALTER TABLE `usuarios_historico` DISABLE KEYS */
/*!40000 ALTER TABLE `usuarios_historico` ENABLE KEYS */

/* -- Volcando estructura para tabla valoracion_empresas */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `valoracion_empresas` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `valoracion` tinyint(3) unsigned NOT NULL,
  `validar` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla valoracion_empresas: 0 rows */
    /*!40000 ALTER TABLE `valoracion_empresas` DISABLE KEYS */
/*!40000 ALTER TABLE `valoracion_empresas` ENABLE KEYS */

/* -- Volcando estructura para tabla valoracion_productos */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `valoracion_productos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `valoracion` tinyint(3) unsigned NOT NULL,
  `validar` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla valoracion_productos: 0 rows */
    /*!40000 ALTER TABLE `valoracion_productos` DISABLE KEYS */
/*!40000 ALTER TABLE `valoracion_productos` ENABLE KEYS */

/* -- Volcando estructura para tabla zonas */
$result = $conn->query("CREATE TABLE IF NOT EXISTS `zonas` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

/* -- Volcando datos para la tabla zonas: 4 rows */
    /*!40000 ALTER TABLE `zonas` DISABLE KEYS */
$result = $conn->query("INSERT INTO `zonas` (`id`, `zona`) VALUES
(1, 'ESPAÑA PENINSULAR'),
	(2, 'ISLAS BALEARES'),
	(3, 'ISLAS CANARIAS, CEUTA Y MELILLA'),
	(4, 'PORTUGAL');");
/*!40000 ALTER TABLE `zonas` ENABLE KEYS */

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */
