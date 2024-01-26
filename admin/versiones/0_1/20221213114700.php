<?php
$result = $conn->query("CREATE TABLE `productos_titulos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_producto` INT(11) NOT NULL,
	`descripcion` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_spanish_ci'
ENGINE=MyISAM
;");
