<?php
$result = $conn->query("CREATE TABLE `libradores_lineas` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`ancho_pos` INT(10) NOT NULL DEFAULT '0',
	`alto_pos` INT(10) NOT NULL DEFAULT '0',
	`ancho` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`alto` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_spanish_ci'
ENGINE=MyISAM
AUTO_INCREMENT=1;");
