<?php
$result = $conn->query("ALTER TABLE `usuarios_permisos`
ADD COLUMN `recepcion_pedidos` TINYINT(1) NOT NULL DEFAULT '1' AFTER `mas_vendidos_listados`,
ADD COLUMN `gestor` TINYINT(1) NOT NULL DEFAULT '1' AFTER `iconos`;");