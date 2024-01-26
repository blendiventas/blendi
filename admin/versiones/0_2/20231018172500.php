<?php
$result = $conn->query("CREATE TABLE IF NOT EXISTS `libradores_productos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_librador` INT(11) NOT NULL DEFAULT '0',
	`id_producto` INT(11) NOT NULL DEFAULT '0',
	`coste_importe` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_spanish_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=1
;");