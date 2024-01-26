<?php
$result = $conn->query("ALTER TABLE `productos_relacionados_combo` ADD COLUMN `activo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' AFTER `orden`;");