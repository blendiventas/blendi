<?php
$result = $conn->query("ALTER TABLE `libradores`
	ADD COLUMN `id_grupo_clientes` INT(11) NULL DEFAULT NULL AFTER `tipo`;");