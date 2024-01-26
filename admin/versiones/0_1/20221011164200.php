<?php
$result = $conn->query("CREATE TABLE `comedores` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `descripcion` VARCHAR(60) NOT NULL DEFAULT '' COLLATE 'utf8_spanish_ci',
    `principal` TINYINT(1) NOT NULL DEFAULT '0',
    `activo` TINYINT(1) NOT NULL DEFAULT '1',
    `fecha_alta` DATE NULL DEFAULT NULL,
    `fecha_modificacion` DATE NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM;");

$result = $conn->query("ALTER TABLE `libradores`
	ADD COLUMN `id_comedores` INT(10) UNSIGNED NOT NULL DEFAULT 0 AFTER `radio`;");

$result = $conn->query("ALTER TABLE `libradores_lineas`
	ADD COLUMN `id_comedores` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `id`;");


$result = $conn->query("SELECT id FROM libradores WHERE tipo='mes' LIMIT 1");
if($conn->registros() == 1) {
    $result = $conn->query("INSERT INTO comedores VALUES(1,'Principal',1,1,'" . date("Y-m-d") . "','" . date("Y-m-d") . "')");
    $result = $conn->query("UPDATE libradores SET id_comedores=1 WHERE tipo='mes'");
    $result = $conn->query("UPDATE libradores_lineas SET id_comedores=1");
}