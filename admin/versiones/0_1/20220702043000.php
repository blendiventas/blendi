<?php
$result = $conn->query("ALTER TABLE `categorias` ADD COLUMN `color` VARCHAR(7) NOT NULL DEFAULT '#ffffff' AFTER `texto_titulo`;");
$result = $conn->query("ALTER TABLE `categorias`
	CHANGE COLUMN `color` `color_fondo` VARCHAR(7) NOT NULL DEFAULT '#156772' COLLATE 'utf8_spanish_ci' AFTER `texto_titulo`,
	ADD COLUMN `color_letra` VARCHAR(7) NOT NULL DEFAULT '#ffffff' COLLATE 'utf8_spanish_ci' AFTER `color_fondo`;");
$result = $conn->query("UPDATE categorias SET color_fondo='#156772', color_letra='#ffffff';");