<?php
$result = $conn->query("ALTER TABLE `documentos_2023_recibos`
	ADD COLUMN `documento_bancario` VARCHAR(15) NOT NULL DEFAULT '' AFTER `impreso`,
	ADD COLUMN `vencimiento_documento_bancario` DATE NULL DEFAULT NULL AFTER `documento_bancario`,
	ADD COLUMN `nota` VARCHAR(255) NOT NULL DEFAULT '' AFTER `vencimiento_documento_bancario`;
");
