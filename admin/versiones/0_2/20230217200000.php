<?php
$result = $conn->query("ALTER TABLE `documentos_2023_productos_relacionados`
	ADD COLUMN `observaciones` VARCHAR(100) NOT NULL DEFAULT '' AFTER `sumar_doble`;");
