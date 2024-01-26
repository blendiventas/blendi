<?php
$result = $conn->query("ALTER TABLE `productos_titulos`
	ADD COLUMN `modelo` TINYINT(1) NOT NULL DEFAULT 3 AFTER `descripcion`;");
