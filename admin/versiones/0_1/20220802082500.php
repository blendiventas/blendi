<?php
$result = $conn->query("ALTER TABLE `configuracion`
ADD COLUMN `servicio_domicilio` TINYINT(1) NOT NULL DEFAULT 0 AFTER `id_librador_tak`;");