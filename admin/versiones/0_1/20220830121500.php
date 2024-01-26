<?php
$result = $conn->query("ALTER TABLE `configuracion`
ADD COLUMN `mostrar_mas_vendidos` TINYINT(1) NOT NULL DEFAULT '1' AFTER `pvp_iva_incluido`;");