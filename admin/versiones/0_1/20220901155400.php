<?php
$result = $conn->query("ALTER TABLE `configuracion`
ADD COLUMN `mostrar_precios_tpv` TINYINT(1) NOT NULL DEFAULT '1' AFTER `pvp_iva_incluido`;");