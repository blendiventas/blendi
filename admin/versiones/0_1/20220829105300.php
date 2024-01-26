<?php
$result = $conn->query("CREATE TABLE `productos_relacionados_incre` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_producto_rel` INT(11) UNSIGNED NOT NULL DEFAULT '0',
    `id_tarifa` INT(11) UNSIGNED NOT NULL DEFAULT '0',
    `sumar_con` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
    `sumar_mitad` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
    `sumar_sin` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
    `sumar_doble` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
    PRIMARY KEY (`id`) USING BTREE,INDEX `indice` (`id_producto_rel`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");

$result = $conn->query("CREATE TABLE `productos_relacionados_combo_incre` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_producto_rel` INT(11) UNSIGNED NOT NULL DEFAULT '0',
    `id_tarifa` INT(11) UNSIGNED NOT NULL DEFAULT '0',
    `sumar` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
    PRIMARY KEY (`id`) USING BTREE,INDEX `indice` (`id_producto_rel`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");

$result = $conn->query("CREATE TABLE `productos_relacionados_elaborados_incre` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_producto_rel` INT(11) UNSIGNED NOT NULL DEFAULT '0',
    `id_tarifa` INT(11) UNSIGNED NOT NULL DEFAULT '0',
    `sumar` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
    PRIMARY KEY (`id`) USING BTREE,INDEX `indice` (`id_producto_rel`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");

$result = $conn->query("ALTER TABLE `productos_relacionados`
	DROP COLUMN `sumar_con`,
	DROP COLUMN `sumar_mitad`,
	DROP COLUMN `sumar_sin`,
	DROP COLUMN `sumar_doble`;");

$result = $conn->query("ALTER TABLE `productos_relacionados_combo` DROP COLUMN `sumar`;");

$result = $conn->query("ALTER TABLE `productos_relacionados_elaborados` DROP COLUMN `sumar`;");