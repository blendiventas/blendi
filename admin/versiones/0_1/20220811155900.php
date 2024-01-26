<?php
$result = $conn->query("CREATE TABLE `modelos_impresion_1` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
	`ancho` INT(10) NOT NULL,
	`alto` INT(10) NOT NULL,
	`interlineado` TINYINT(4) NOT NULL DEFAULT '5',
	`marcar_lineas` TINYINT(1) NOT NULL DEFAULT '0',
	`lineas_pagina` INT(10) NOT NULL DEFAULT '20',
	`tipo_documento` VARCHAR(3) NOT NULL COLLATE 'utf8_spanish_ci',
	`predeterminado` TINYINT(1) NOT NULL DEFAULT '0',
	`activo` TINYINT(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC;");

$result = $conn->query("CREATE TABLE `modelos_impresion_2` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`id_modelos_impresion_1` INT(10) NOT NULL,
	`zona` VARCHAR(20) NOT NULL COLLATE 'utf8_spanish_ci',
	`campo` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
	`inicio_ancho` INT(10) NOT NULL DEFAULT '0',
	`inicio_alto` INT(10) NOT NULL DEFAULT '0',
	`ancho` INT(10) NULL DEFAULT NULL,
	`alto` INT(10) NULL DEFAULT NULL,
	`col_r_letra` INT(3) NOT NULL DEFAULT '255',
	`col_g_letra` INT(3) NOT NULL DEFAULT '255',
	`col_b_letra` INT(3) NOT NULL DEFAULT '255',
	`border` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
	`grueso_borde` INT(2) NOT NULL DEFAULT '0',
	`col_r_borde` INT(3) NOT NULL DEFAULT '255',
	`col_g_borde` INT(3) NOT NULL DEFAULT '255',
	`col_b_borde` INT(3) NOT NULL DEFAULT '255',
	`alineacionmegagestio_cat_dades` VARCHAR(1) NOT NULL DEFAULT 'L' COLLATE 'utf8_spanish_ci',
	`fuente_letra` VARCHAR(50) NOT NULL DEFAULT 'Arial' COLLATE 'utf8_spanish_ci',
	`estilo_letra` VARCHAR(1) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
	`size_letra` VARCHAR(2) NOT NULL DEFAULT '10' COLLATE 'utf8_spanish_ci',
	`mostrar` TINYINT(1) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");