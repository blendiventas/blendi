<?php
$result = $conn->query("CREATE TABLE IF NOT EXISTS `grupos_clientes` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL DEFAULT '',
  `prioritario` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");

$result = $conn->query("INSERT INTO `grupos_clientes` (`id`, `descripcion`, `prioritario`, `activo`) VALUES
(1, 'General', 1, 1);");