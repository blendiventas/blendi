<?php
$result = $conn->query("ALTER TABLE `documentos_2022_productos_sku_stock`
	CHANGE COLUMN `coste` `coste` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `id_librador`,
	CHANGE COLUMN `importe` `importe` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `unidad`;");
$result = $conn->query("ALTER TABLE `documentos_2022_productos_relacionados_elaborados`
	CHANGE COLUMN `sumar` `sumar` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `id_unidad`;");
$result = $conn->query("ALTER TABLE `documentos_2022_productos_relacionados_combo`
	CHANGE COLUMN `sumar` `sumar` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `cantidad`;");
$result = $conn->query("ALTER TABLE `documentos_2022_productos_relacionados`
	CHANGE COLUMN `sumar_con` `sumar_con` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `cantidad_doble`,
	CHANGE COLUMN `sumar_mitad` `sumar_mitad` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `sumar_con`,
	CHANGE COLUMN `sumar_sin` `sumar_sin` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `sumar_mitad`,
	CHANGE COLUMN `sumar_doble` `sumar_doble` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `sumar_sin`;");
$result = $conn->query("ALTER TABLE `documentos_2022_productos_costes`
	CHANGE COLUMN `coste` `coste` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `tiempo`;");
$result = $conn->query("ALTER TABLE `documentos_2022_iva`
	CHANGE COLUMN `base` `base` DOUBLE(15,5) NULL DEFAULT NULL AFTER `id_documentos_2`,
	CHANGE COLUMN `importe_iva` `importe_iva` DOUBLE(15,5) NULL DEFAULT NULL AFTER `iva`,
	CHANGE COLUMN `importe_recargo` `importe_recargo` DOUBLE(15,5) NULL DEFAULT NULL AFTER `recargo`;");
$result = $conn->query("ALTER TABLE `documentos_2022_2`
	CHANGE COLUMN `coste` `coste` DOUBLE(15,5) NOT NULL AFTER `unidad`,
	CHANGE COLUMN `importe` `importe` DOUBLE(15,5) NOT NULL DEFAULT '0.0000' AFTER `coste`,
	CHANGE COLUMN `base_antes_descuento` `base_antes_descuento` DOUBLE(15,5) NOT NULL DEFAULT '0.0000' AFTER `fijo`,
	CHANGE COLUMN `importe_descuento_base` `importe_descuento_base` DOUBLE(15,5) NOT NULL DEFAULT '0.0000' AFTER `descuento_base`,
	CHANGE COLUMN `base_despues_descuento` `base_despues_descuento` DOUBLE(15,5) NOT NULL DEFAULT '0.0000' AFTER `importe_descuento_base`,
	CHANGE COLUMN `importe_iva` `importe_iva` DOUBLE(15,5) NOT NULL DEFAULT '0.0000' AFTER `iva`,
	CHANGE COLUMN `importe_recargo` `importe_recargo` DOUBLE(15,5) NOT NULL DEFAULT '0.0000' AFTER `recargo`;");
$result = $conn->query("ALTER TABLE `documentos_2022_2`
	CHANGE COLUMN `pvp_unidad` `pvp_unidad` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `importe_recargo`,
	CHANGE COLUMN `total_antes_descuento` `total_antes_descuento` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `pvp_unidad`,
	CHANGE COLUMN `importe_descuento_total` `importe_descuento_total` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `descuento_total`,
	CHANGE COLUMN `total_despues_descuento` `total_despues_descuento` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `importe_descuento_total`;");
$result = $conn->query("ALTER TABLE `documentos_2022_1`
	CHANGE COLUMN `importe_irpf` `importe_irpf` DOUBLE(15,5) NULL DEFAULT NULL AFTER `irpf`,
	CHANGE COLUMN `importe_descuento_pp` `importe_descuento_pp` DOUBLE(15,5) NULL DEFAULT NULL AFTER `descuento_pp`,
	CHANGE COLUMN `importe_descuento_librador` `importe_descuento_librador` DOUBLE(15,5) NULL DEFAULT NULL AFTER `descuento_librador`,
	CHANGE COLUMN `base` `base` DOUBLE(15,5) NULL DEFAULT NULL AFTER `importe_descuento_librador`,
	CHANGE COLUMN `total` `total` DOUBLE(15,5) NULL DEFAULT NULL AFTER `base`;");
$result = $conn->query("ALTER TABLE `productos`
	CHANGE COLUMN `coste` `coste` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `peso_neto`;");
$result = $conn->query("ALTER TABLE `productos_costes`
	CHANGE COLUMN `cantidad_base` `cantidad_base` DOUBLE(15,5) NULL DEFAULT NULL AFTER `id_producto`;");
$result = $conn->query("ALTER TABLE `productos_pvp`
	CHANGE COLUMN `pvp` `pvp` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `margen`,
	CHANGE COLUMN `pvp_oferta` `pvp_oferta` DOUBLE(15,5) NULL DEFAULT '0.00' AFTER `oferta_hasta`;");
$result = $conn->query("ALTER TABLE `productos_relacionados_combo_incre`
	CHANGE COLUMN `sumar` `sumar` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `id_tarifa`;");
$result = $conn->query("ALTER TABLE `productos_relacionados_elaborados_incre`
	CHANGE COLUMN `sumar` `sumar` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `id_tarifa`;");
$result = $conn->query("ALTER TABLE `productos_relacionados_incre`
	CHANGE COLUMN `sumar_con` `sumar_con` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `id_tarifa`,
	CHANGE COLUMN `sumar_mitad` `sumar_mitad` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `sumar_con`,
	CHANGE COLUMN `sumar_sin` `sumar_sin` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `sumar_mitad`,
	CHANGE COLUMN `sumar_doble` `sumar_doble` DOUBLE(15,5) NOT NULL DEFAULT '0.00' AFTER `sumar_sin`;");