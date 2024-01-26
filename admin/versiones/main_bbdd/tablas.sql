-- --------------------------------------------------------
-- Host:                         www.tpv-e.es
-- Versión del servidor:         10.1.48-MariaDB-0+deb9u2 - Debian 9.13
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla tpv_e_0es.identificacion_accesos
CREATE TABLE IF NOT EXISTS `identificacion_accesos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_panel` int(11) NOT NULL DEFAULT '0',
  `sesion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `dia` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2196 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tpv_e_0es.identificacion_panel
CREATE TABLE IF NOT EXISTS `identificacion_panel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `empresa` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `sector` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `web_blendi` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `m-cocina` TINYINT NOT NULL DEFAULT 0,
  `dominio_ftp` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ftp` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password_ftp` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `dominio_base` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `base` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_base` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password_base` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `bloqueado` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `revisar_tablas` datetime DEFAULT NULL,
  UNIQUE KEY `id` (`id`) USING BTREE,
  UNIQUE KEY `empresa` (`empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tpv_e_0es.versiones
CREATE TABLE IF NOT EXISTS `versiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `text_md` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `version` (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
