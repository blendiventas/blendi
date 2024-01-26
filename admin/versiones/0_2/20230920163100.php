<?php
$result = $conn->query("ALTER TABLE `categorias`
	ADD COLUMN `id_grupo_clientes` INT(11) NULL DEFAULT NULL AFTER `mostrar_buscador`;");