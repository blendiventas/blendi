<?php
$result = $conn->query("ALTER TABLE `documentos_2023_1`
	ADD COLUMN `numero_registro` INT(11) NULL DEFAULT NULL AFTER `fecha_entrega_hasta`;");
