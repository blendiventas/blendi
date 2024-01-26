<?php
$result = $conn->query("ALTER TABLE `configuracion`
ADD COLUMN `id_librador_tak` INT(11) NOT NULL DEFAULT '0' AFTER `id_librador`;");

$result = $conn->query("ALTER TABLE `documentos_2022_1`
	ADD COLUMN `hora_entrega` TIME NOT NULL DEFAULT '00:00:00' AFTER `hora`;");