<?php
$result = $conn->query("ALTER TABLE `datos_configuracion_inicial`
	ADD COLUMN `porcentaje_datos_personales` INT(4) NULL DEFAULT '0' AFTER `plan`,
	ADD COLUMN `porcentaje_datos_facturacion` INT(4) NULL DEFAULT '0' AFTER `plan`,
	ADD COLUMN `porcentaje_usuarios` INT(4) NULL DEFAULT '0' AFTER `plan`,
	ADD COLUMN `porcentaje_carta` INT(4) NULL DEFAULT '0' AFTER `plan`;");