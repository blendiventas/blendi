<?php
$result = $conn->query("ALTER TABLE `documentos_2022_productos_sku_stock`
	ADD COLUMN `codigo_barras` VARCHAR(20) NULL DEFAULT '' AFTER `numero_serie`;");