<?php
$result = $conn->query("ALTER TABLE `usuarios_accesos`
ADD COLUMN `id_terminal` INT(10) NOT NULL DEFAULT 1 AFTER `activo`;");

$result = $conn->query("ALTER TABLE `terminales`
	ADD COLUMN `mostrar_todo` TINYINT(1) NOT NULL DEFAULT 0 AFTER `descripcion`;");

$result = $conn->query("CREATE TABLE `documentos_enviar_terminales` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_documento_1` INT(11) NOT NULL,
	`id_documento_2` INT(11) NOT NULL,
	`id_producto` INT(11) NOT NULL DEFAULT '0',
	`cantidad` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
	`cantidad_modificada` TINYINT(1) NOT NULL DEFAULT '0',
	`estado` TINYINT(1) NOT NULL DEFAULT '0',
	`alertar` TINYINT(1) NOT NULL DEFAULT '0',
	`hora` TIME NOT NULL,
	`id_terminal` INT(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`) USING BTREE,INDEX `id_documento` (`id_documento_1`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");