<?php
/*
CREATE TABLE `modalidades_envio` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(45) NOT NULL COLLATE 'utf8_spanish_ci',
	`explicacion` TEXT NOT NULL COLLATE 'utf8_spanish_ci',
CREATE TABLE `modalidades_entrega` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
	`explicacion` TEXT NOT NULL COLLATE 'utf8_spanish_ci',
CREATE TABLE `modalidades_pago` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
	`explicacion` TEXT NOT NULL COLLATE 'utf8_spanish_ci',
	`tienda_virtual` TINYINT(1) NOT NULL DEFAULT '0',
	`defecto` TINYINT(1) NOT NULL DEFAULT '0',
	`id_iva` INT(10) NOT NULL DEFAULT '0',
	`incremento_pvp` DOUBLE(4,2) NOT NULL DEFAULT '0.00',
	`incremento_por` DOUBLE(4,2) NOT NULL DEFAULT '0.00',
*/
/*
echo "SELECT descripcion FROM modalidades_envio WHERE id='".$id_modalidades_envio."' LIMIT 1<br />";
echo "SELECT descripcion FROM modalidades_entrega WHERE id='".$id_modalidades_entrega."' LIMIT 1<br />";
echo "SELECT descripcion,id_iva,incremento_pvp,incremento_por FROM modalidades_pago WHERE id='".$id_modalidades_pago."' LIMIT 1<br />";
*/
/*
$result_modalidades_envio = $conn->query("SELECT descripcion FROM modalidades_envio WHERE id='".$id_modalidades_envio."' LIMIT 1");
if($conn->registros() == 1) {
    $modalidad_envio = stripslashes($result_modalidades_envio[0]['descripcion']);
}
$result_modalidades_entrega = $conn->query("SELECT descripcion FROM modalidades_entrega WHERE id='".$id_modalidades_entrega."' LIMIT 1");
if($conn->registros() == 1) {
    $modalidad_entrega = stripslashes($result_modalidades_entrega[0]['descripcion']);
}
$result_modalidades_pago = $conn->query("SELECT descripcion,id_iva,incremento_pvp,incremento_por FROM modalidades_pago WHERE id='".$id_modalidades_pago."' LIMIT 1");
if($conn->registros() == 1) {
    $modalidad_pago = stripslashes($result_modalidades_pago[0]['descripcion']);
    $id_iva_modalidades_pago = $result_modalidades_pago[0]['id_iva'];
    $incremento_pvp_modalidades_pago = $result_modalidades_pago[0]['incremento_pvp'];
    $incremento_por_modalidades_pago = $result_modalidades_pago[0]['incremento_por'];
}
*/
$result_modalidades_envio = $conn->query("SELECT * FROM modalidades_envio ORDER BY descripcion");
foreach ($result_modalidades_envio as $key_modalidades_envio => $valor_modalidades_envio) {
    $matriz_id_modalidades_envio[] = $valor_modalidades_envio['id'];
    $matriz_descripcion_modalidades_envio[] = stripslashes($valor_modalidades_envio['descripcion']);
    $matriz_explicacion_modalidades_envio[] = stripslashes($valor_modalidades_envio['explicacion']);
}
$result_modalidades_entrega = $conn->query("SELECT * FROM modalidades_entrega ORDER BY descripcion");
if($conn->registros() >= 1) {
    foreach ($result_modalidades_entrega as $key_modalidades_entrega => $valor_modalidades_entrega) {
        $matriz_id_modalidades_entrega[] = $valor_modalidades_entrega['id'];
        $matriz_descripcion_modalidades_entrega[] = stripslashes($valor_modalidades_entrega['descripcion']);
        $matriz_explicacion_modalidades_entrega[] = stripslashes($valor_modalidades_entrega['explicacion']);
    }
}
$result_modalidades_pago = $conn->query("SELECT id,descripcion,explicacion,id_iva,incremento_pvp,incremento_por FROM modalidades_pago ORDER BY descripcion");
if($conn->registros() >= 1) {
    foreach ($result_modalidades_pago as $key_modalidades_pago => $valor_modalidades_pago) {
        $matriz_id_modalidades_pago[] = $valor_modalidades_pago['id'];
        $matriz_descripcion_modalidades_pago[] = stripslashes($valor_modalidades_pago['descripcion']);
        $matriz_explicacion_modalidades_pago[] = stripslashes($valor_modalidades_pago['explicacion']);
        $matriz_defecto_modalidades_pago[] = $valor_modalidades_pago['defecto'];
        $matriz_id_iva_modalidades_pago[] = $valor_modalidades_pago['id_iva'];
        $matriz_incremento_pvp_modalidades_pago[] = $valor_modalidades_pago['incremento_pvp'];
        $matriz_incremento_por_modalidades_pago[] = $valor_modalidades_pago['incremento_por'];
    }
}