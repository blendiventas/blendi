<?php
$result = $conn->query("ALTER TABLE `documentos_2022_iva`
CHANGE COLUMN `base` `base` DOUBLE(15,4) NULL DEFAULT NULL AFTER `id_documentos_2`,
CHANGE COLUMN `importe_iva` `importe_iva` DOUBLE(15,4) NULL DEFAULT NULL AFTER `iva`,
CHANGE COLUMN `importe_recargo` `importe_recargo` DOUBLE(15,4) NULL DEFAULT NULL AFTER `recargo`;");
$result = $conn->query("ALTER TABLE `documentos_2022_2`
CHANGE COLUMN `coste` `coste` DOUBLE(15,4) NOT NULL AFTER `unidad`,
CHANGE COLUMN `importe` `importe` DOUBLE(15,4) NOT NULL DEFAULT '0.00' AFTER `coste`,
CHANGE COLUMN `base_antes_descuento` `base_antes_descuento` DOUBLE(15,4) NOT NULL DEFAULT '0.00' AFTER `fijo`,
CHANGE COLUMN `importe_descuento_base` `importe_descuento_base` DOUBLE(15,4) NOT NULL DEFAULT '0.00' AFTER `descuento_base`,
CHANGE COLUMN `base_despues_descuento` `base_despues_descuento` DOUBLE(15,4) NOT NULL DEFAULT '0.00' AFTER `importe_descuento_base`,
CHANGE COLUMN `importe_iva` `importe_iva` DOUBLE(15,4) NOT NULL DEFAULT '0.00' AFTER `iva`,
CHANGE COLUMN `importe_recargo` `importe_recargo` DOUBLE(15,4) NOT NULL DEFAULT '0.00' AFTER `recargo`,
CHANGE COLUMN `pvp_unidad` `pvp_unidad` DOUBLE(15,2) NOT NULL DEFAULT '0.00' AFTER `importe_recargo`;");