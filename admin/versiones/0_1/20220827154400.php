<?php
$result = $conn->query("ALTER TABLE `usuarios_permisos`
ADD COLUMN `categorias` TINYINT(1) NOT NULL DEFAULT '1' AFTER `productos`,
ADD COLUMN `detalles_productos` TINYINT(1) NOT NULL DEFAULT '1' AFTER `categorias_elaborados`,
ADD COLUMN `grupos` TINYINT(1) NOT NULL DEFAULT '1' AFTER `detalles_productos`,
DROP COLUMN `categorias`,
DROP COLUMN `detalles_productos`;");