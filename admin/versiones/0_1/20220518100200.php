<?php
$result = $conn->query("ALTER TABLE `datos_empresa` ADD COLUMN `logo` VARCHAR(150) NULL AFTER `iva_incluido`;");
$result = $conn->query("INSERT INTO `datos_empresa` (`nombre_fiscal`, `nombre_comercial`, `nif`, `direccion`, `codigo_postal`, `poblacion`, `provincia`, `tel1`, `tel2`, `movil`, `fax`, `email`, `logo`) VALUES ('Nombre fiscal', 'Nombre comercial', 'NIF', 'Dirección', 'Código postal', 'Población', 'Provincia', 'Teléfono 1', 'Teléfono 2', 'Móvil', 'Fax', 'E-mal', 'logo.gif');");
$result = $conn->query("ALTER TABLE `datos_empresa` ADD COLUMN `updated` VARCHAR(12) NOT NULL AFTER `logo`;");
