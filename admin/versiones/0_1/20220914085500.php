<?php
$result = $conn->query("ALTER TABLE `productos_costes`
CHANGE COLUMN `tiempo` `tiempo` DOUBLE(9,2) NULL DEFAULT NULL AFTER `rentabilidad`;");

$result = $conn->query("CREATE TABLE `terminales` (
`id` INT(10) NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
	`activo` TINYINT(1) NOT NULL DEFAULT '1',
	`fecha_alta` DATE NULL DEFAULT NULL,
	`fecha_modificacion` DATE NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");

$result = $conn->query("INSERT INTO `terminales` VALUES (1, 'Terminal principal', 1, '2022-09-14', '2022-09-14');");