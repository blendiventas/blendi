<?php
$result = $conn->query("CREATE TABLE `datos_empresa` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
	`nombre_fiscal` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
	`nombre_comercial` VARCHAR(60) NOT NULL COLLATE 'utf8_spanish_ci',
	`nif` VARCHAR(15) NOT NULL COLLATE 'utf8_spanish_ci',
	`direccion` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
	`codigo_postal` VARCHAR(5) NOT NULL COLLATE 'utf8_spanish_ci',
	`poblacion` VARCHAR(75) NOT NULL COLLATE 'utf8_spanish_ci',
	`provincia` VARCHAR(75) NOT NULL COLLATE 'utf8_spanish_ci',
	`tel1` VARCHAR(15) NOT NULL COLLATE 'utf8_spanish_ci',
	`tel2` VARCHAR(15) NOT NULL COLLATE 'utf8_spanish_ci',
	`movil` VARCHAR(15) NOT NULL COLLATE 'utf8_spanish_ci',
	`fax` VARCHAR(15) NOT NULL COLLATE 'utf8_spanish_ci',
	`email` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
	`tarifas` TINYINT(4) NOT NULL DEFAULT '1',
	`iva_incluido` TINYINT(4) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`) USING BTREE) COLLATE='utf8_spanish_ci' ENGINE=MyISAM AUTO_INCREMENT=1;");