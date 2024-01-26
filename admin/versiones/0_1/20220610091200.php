<?php
$result = $conn->query("CREATE TABLE `metodos_pago` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
	`explicacion` TEXT NOT NULL COLLATE 'utf8_spanish_ci',
	`interface` VARCHAR(3) NOT NULL DEFAULT 'tpv' COLLATE 'utf8_spanish_ci',
	`prioritario` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`id_iva` INT(10) NOT NULL DEFAULT '0',
	`incremento_pvp` DOUBLE(4,2) NOT NULL DEFAULT '0.00',
	`incremento_por` DOUBLE(4,2) NOT NULL DEFAULT '0.00',
	`ruta` VARCHAR(200) NOT NULL COLLATE 'utf8_spanish_ci',
	`sistema` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
	`imagen` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
	`updated` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
	`orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
	`activo` TINYINT(1) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");

$result = $conn->query("CREATE TABLE `documentos_2022_recibos` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_documento` INT(11) NULL DEFAULT NULL,
	`tipo_documento` VARCHAR(3) NOT NULL COLLATE 'utf8_spanish_ci',
	`id_librador` INT(11) NULL DEFAULT NULL,
	`importe` DOUBLE(15,2) NULL DEFAULT NULL,
	`fecha` DATE NULL DEFAULT NULL,
	`vencimiento` DATE NULL DEFAULT NULL,
	`pagado` TINYINT(1) NOT NULL DEFAULT '0',
	`fecha_pago` DATE NULL DEFAULT NULL,
	`hora_pago` TIME NOT NULL,
	`id_banco_caja_ingreso` INT(10) NOT NULL DEFAULT '0',
	`id_metodo_pago` INT(10) NOT NULL DEFAULT '0',
	`id_modalidad_pago` INT(10) NOT NULL DEFAULT '0',
	`numero_efecto` INT(10) NOT NULL DEFAULT '1',
	`id_usuario_pago` INT(10) NULL DEFAULT NULL,
	`impreso` TINYINT(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");

$result = $conn->query("INSERT INTO `metodos_pago` VALUES (1, 'Efectivo', '', 'tpv', 1, 0, 0.00, 0.00, '', '', NULL, NULL, NULL, 1);");
$result = $conn->query("INSERT INTO `metodos_pago` VALUES (2, 'Targeta', '', 'tpv', 0, 0, 0.00, 0.00, '', '', NULL, NULL, NULL, 1);");
