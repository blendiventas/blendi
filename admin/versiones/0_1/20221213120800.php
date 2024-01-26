<?php
$result = $conn->query("ALTER TABLE `productos_titulos`
	ADD COLUMN `orden` INT(11) NOT NULL DEFAULT '10' AFTER `descripcion`;");
$result = $conn->query("ALTER TABLE `productos_titulos_relacionados`
	ADD COLUMN `orden` INT(11) NOT NULL DEFAULT '10' AFTER `descripcion`;");
$result = $conn->query("ALTER TABLE `productos_titulos`
	CHANGE COLUMN `id_producto` `id_producto` INT(11) NULL DEFAULT NULL AFTER `id`;");
