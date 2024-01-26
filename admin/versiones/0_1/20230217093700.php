<?php
$result = $conn->query("ALTER TABLE `productos_relacionados`
	CHANGE COLUMN `modelo` `modelo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 - Con / Sin\r\n1 - Normal / Mitad / Sin / Doble\r\n2 - Input cantidad\r\n3 - Unico\r\n4 - No mostrar\r\n5 - Texto' AFTER `fijo`,
	ADD COLUMN `observacion` VARCHAR(100) NOT NULL DEFAULT '' AFTER `cantidad_doble`;
");
