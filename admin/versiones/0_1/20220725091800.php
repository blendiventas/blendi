<?php
$result = $conn->query("ALTER TABLE `configuracion`
ADD COLUMN `color_letra_botones` VARCHAR(7) NOT NULL DEFAULT '#ffffff' COLLATE 'utf8_spanish_ci' AFTER `pvp_iva_incluido`,
ADD COLUMN `color_fondo_botones` VARCHAR(7) NOT NULL DEFAULT '#156772' COLLATE 'utf8_spanish_ci' AFTER `color_letra_botones`;");

$result = $conn->query("ALTER TABLE `configuracion`
	ADD COLUMN `tipo_menu_superior` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '0 - Norma\r\n1 - scroll' AFTER `color_fondo_botones`;");