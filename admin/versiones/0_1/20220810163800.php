<?php
$result = $conn->query("ALTER TABLE `documentos_2022_2`
	CHANGE COLUMN `id_documento_anterior` `id_documento_2_anterior` INT(11) NOT NULL DEFAULT '0' AFTER `total_despues_descuento`;");
