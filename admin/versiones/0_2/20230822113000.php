<?php
$result = $conn->query("CREATE TABLE IF NOT EXISTS `modalidades_envio_zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modalidad_envio` int(11) NOT NULL DEFAULT '0',
  `id_zona` int(11) NOT NULL DEFAULT '0',
  `incremento_pvp` DOUBLE(4,2) NOT NULL DEFAULT 0,
  `incremento_por_kilo` DOUBLE(4,2) NOT NULL DEFAULT 0,
  `volumen_maximo_bulto` DOUBLE(4,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

$result = $conn->query("CREATE TABLE IF NOT EXISTS `modalidades_envio_zonas_franjas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modalidad_envio_zona` int(11) NOT NULL DEFAULT '0',
  `incremento_pvp` DOUBLE(4,2) NOT NULL DEFAULT 0,
  `volumen_desde` DOUBLE(4,2) NOT NULL DEFAULT 0,
  `volumen_hasta` DOUBLE(4,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");
