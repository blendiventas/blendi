<?php
$result = $conn->query("ALTER TABLE `libradores_historico_correos`
	ADD COLUMN `mail` VARCHAR(255) NOT NULL DEFAULT '' AFTER `numero_documento`,
	ADD COLUMN `fecha_envio` DATETIME NULL DEFAULT NULL AFTER `mail`;");