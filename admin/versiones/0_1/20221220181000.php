<?php
$result = $conn->query("ALTER TABLE `documentos_2022_productos_relacionados`
	ADD COLUMN `id_titulo_relacionado` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `id_relacionado`,
	ADD COLUMN `descripcion` VARCHAR(250) NOT NULL DEFAULT '' AFTER `id_titulo_relacionado`;");
