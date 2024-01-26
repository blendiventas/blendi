<?php
$result = $conn->query("ALTER TABLE `productos`
CHANGE COLUMN `imagen` `imagen` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci' AFTER `coste`;");

$result = $conn->query("ALTER TABLE `productos_images`
	CHANGE COLUMN `imagen` `imagen` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci' AFTER `id_packs`;");