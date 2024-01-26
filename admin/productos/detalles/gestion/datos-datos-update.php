<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_url = $_POST['id_productos'];
$id_productos_detalles_url = filter_input(INPUT_POST, 'id_productos_detalles', FILTER_SANITIZE_NUMBER_INT);
$id_productos_detalles_datos_url = filter_input(INPUT_POST, 'id_idioma_productos_detalles_datos', FILTER_SANITIZE_NUMBER_INT);
$detalle_productos_detalles_datos = filter_input(INPUT_POST, 'detalle_productos_detalles_datos', FILTER_SANITIZE_STRING);
$orden_productos_detalles_datos = filter_input(INPUT_POST, 'orden_productos_detalles_datos', FILTER_SANITIZE_STRING);
$activo_productos_detalles_datos = filter_input(INPUT_POST, 'activo_productos_detalles_datos', FILTER_SANITIZE_NUMBER_INT);

$id_productos_detalles_relacion_url = $_POST['id_productos_detalles_relacion'];
$id_productos_detalles_relacion_datos_url = $_POST['id_productos_detalles_relacion_datos'];
$id_detalle = $_POST['id_detalle'];
$id_datos = $_POST['id_datos'];
$atributos = $_POST['atributos'];

$id_atributo_principal = $_POST['id_atributo_principal'];
$id_atributo_enlazado = $_POST['id_atributo_enlazado'];
$atributos_principales = $_POST['atributos_principales'];
$atributos_enlazados = $_POST['atributos_enlazados'];

$id_atributo_multiple = $_POST['id_atributo_multiple'];
$atributos_multiples = $_POST['atributos_multiples'];

$id_atributo_unico = $_POST['id_atributo_unico'];
$atributo_unico = $_POST['atributo_unico'];
/*
CREATE TABLE `productos_detalles_datos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_productos_detalles` INT(11) NOT NULL DEFAULT '0',
	`detalle` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
	`orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
*/
$ajax_sys = true;

$logs_sys = new stdClass();

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-datos-update-php.php");