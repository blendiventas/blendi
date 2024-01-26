<?php
$result = $conn->query("ALTER TABLE `modelos_impresion_1`
ADD COLUMN `serie` VARCHAR(5) NOT NULL AFTER `tipo_documento`;");