<?php
$result = $conn->query("ALTER TABLE `libradores`
	ADD COLUMN `imagen_mesa` VARCHAR(100) NULL COLLATE 'utf8_spanish_ci' AFTER `id_banco_cobro`,
	ADD COLUMN `imagen_mesa_ocupada` VARCHAR(100) NULL AFTER `imagen_mesa`,
	ADD COLUMN `radio` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' AFTER `imagen_mesa_ocupada`,
	ADD COLUMN `comensales` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' AFTER `radio`,
	ADD COLUMN `ancho_pos` INT(10) NOT NULL DEFAULT 0 AFTER `comensales`,
	ADD COLUMN `alto_pos` INT(10) NOT NULL DEFAULT 0 AFTER `ancho_pos`,
	ADD COLUMN `ancho` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' AFTER `alto_pos`,
	ADD COLUMN `alto` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' AFTER `ancho`;
");