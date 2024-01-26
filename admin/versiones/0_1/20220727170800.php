<?php
$result = $conn->query("ALTER TABLE `configuracion`
ADD COLUMN `filas_menu` TINYINT(1) NOT NULL DEFAULT '2' AFTER `tipo_menu_superior`,
ADD COLUMN `decimales_cantidades` TINYINT(1) NOT NULL DEFAULT '2' AFTER `filas_menu`;");