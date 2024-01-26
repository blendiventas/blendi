<?php
$result = $conn->query("ALTER TABLE `usuarios_permisos`
CHANGE COLUMN `facturas__creditores` `facturas_creditores` TINYINT(1) NOT NULL DEFAULT '1' AFTER `albaranes_creditores`;");