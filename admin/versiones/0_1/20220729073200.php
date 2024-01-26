<?php
$result = $conn->query("ALTER TABLE `documentos_2022_1`
ADD COLUMN `entregado` TINYINT(1) NOT NULL DEFAULT '0' AFTER `estado`;");