<?php
$result = $conn->query("CREATE TABLE `documentos_2023_productos_sku_stock_enlace` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_documentos_ps_stock_inicio` INT(11) NOT NULL DEFAULT '0',
	`id_documentos_ps_stock_fin` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_spanish_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=1;");
