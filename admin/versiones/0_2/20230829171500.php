<?php
$result = $conn->query("ALTER TABLE `comedores`
ADD COLUMN `orden` VARCHAR(50) NOT NULL DEFAULT '' AFTER `activo`;");