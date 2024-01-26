<?php
$result = $conn->query("ALTER TABLE `configuracion`
ADD COLUMN `decimales_importes` TINYINT(1) NOT NULL DEFAULT '3' AFTER `decimales_cantidades`;");