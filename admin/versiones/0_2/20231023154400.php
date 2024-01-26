<?php
$result = $conn->query("ALTER TABLE `documentos_temp_1`
	ADD COLUMN `bloqueado` TINYINT(4) NULL DEFAULT NULL AFTER `estado`;");