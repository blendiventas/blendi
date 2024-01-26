<?php
$result = $conn->query("ALTER TABLE `documentos_2022_2`
	ADD COLUMN `pvp_unidad_sin_incrementos` DOUBLE(15,5) NOT NULL DEFAULT '0.00000' AFTER `pvp_unidad`;");