<?php
$result = $conn->query("ALTER TABLE `datos_empresa` 
ADD COLUMN `software_blendi` TINYINT(4) NULL DEFAULT NULL AFTER `iva_incluido`,
ADD COLUMN `plan_blendi` TINYINT(4) NULL DEFAULT NULL AFTER `software_blendi`;");

$result = $conn->query("ALTER TABLE `datos_empresa` 
ADD COLUMN `iban` VARCHAR(50) NULL DEFAULT NULL AFTER `plan_blendi`,
ADD COLUMN `fecha_inicio_plan` DATETIME NULL DEFAULT NULL AFTER `iban`;");