<?php
$result = $conn->query("ALTER TABLE `usuarios_permisos`
ADD COLUMN `mesas` TINYINT(1) NOT NULL DEFAULT '1' AFTER `tiquets_clientes`;");