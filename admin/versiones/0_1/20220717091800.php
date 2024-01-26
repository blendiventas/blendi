<?php
$result = $conn->query("ALTER TABLE `usuarios_permisos`
ADD COLUMN `usuarios` TINYINT(1) NOT NULL DEFAULT '1' AFTER `tarifas`;");