<?php
$result = $conn->query("ALTER TABLE `metodos_pago`
	ADD COLUMN `directo` TINYINT(1) NOT NULL DEFAULT '0' AFTER `orden`;");
