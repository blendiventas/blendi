<?php
$result = $conn->query("CREATE TABLE `productos_embalajes` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_producto` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_producto_relacionado` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`cantidad` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
	`sumar` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `indice` (`id_producto`) USING BTREE
)
COLLATE='utf8_spanish_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=1;");