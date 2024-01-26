<?php
$result = $conn->query("CREATE TABLE `datos_configuracion_inicial` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
	`step1` TINYINT(4) NOT NULL DEFAULT '0',
	`step2` TINYINT(4) NOT NULL DEFAULT '0',
	`step3` TINYINT(4) NOT NULL DEFAULT '0',
	`step4` TINYINT(4) NOT NULL DEFAULT '0',
	`plan` TINYINT(4) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`) USING BTREE) COLLATE='utf8_spanish_ci' ENGINE=MyISAM AUTO_INCREMENT=1;");
$result = $conn->query("INSERT INTO datos_configuracion_inicial VALUES(NULL, 0, 0, 0, 0, 0);");