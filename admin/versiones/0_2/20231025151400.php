<?php
$result = $conn->query("CREATE TABLE IF NOT EXISTS `listado_notificaciones_stock` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`id_librador` INT DEFAULT NULL,
	`id_producto` INT DEFAULT NULL,
	`email` VARCHAR(255) DEFAULT NULL,
	`notificado` BOOLEAN NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_spanish_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=1
;");