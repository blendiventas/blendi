<?php
$result = $conn->query("CREATE TABLE `productos_titulos_relacionados` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_productos_titulos` INT(11) NOT NULL,
	`id_producto` INT(11) DEFAULT NULL,
	`descripcion` VARCHAR(100) DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_spanish_ci'
ENGINE=MyISAM
;");
