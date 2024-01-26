<?php
$result = $conn->query("CREATE TABLE `categorias_terminales` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_categoria` INT(11) NOT NULL DEFAULT '0',
	`id_terminal` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `id_categoria` (`id_categoria`) USING BTREE
)
COLLATE='utf8_spanish_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=1
;");
