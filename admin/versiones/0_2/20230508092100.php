<?php
$result = $conn->query("ALTER TABLE `usuarios`
	ADD COLUMN `dark` TINYINT(4) NOT NULL DEFAULT '0' AFTER `bloqueo`;");
