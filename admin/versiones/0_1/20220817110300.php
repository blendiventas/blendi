<?php
$result = $conn->query("ALTER TABLE `modelos_impresion_2`
CHANGE COLUMN `alineacionmegagestio_cat_dades` `alineacion` VARCHAR(1) NOT NULL DEFAULT 'L' COLLATE 'utf8_spanish_ci' AFTER `col_b_borde`;");

$result = $conn->query("ALTER TABLE `usuarios_permisos`
	ADD COLUMN `impresion_documentos` TINYINT(1) NOT NULL DEFAULT '1' AFTER `datos_empresa`;");