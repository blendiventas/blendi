<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_url = $_POST['id_productos'];
$id_productos_detalles_url = filter_input(INPUT_POST, 'id_productos_detalles', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_productos_detalles = filter_input(INPUT_POST, 'id_idioma_productos_detalles', FILTER_SANITIZE_NUMBER_INT);
$apartado_url = filter_input(INPUT_POST, 'apartado', FILTER_SANITIZE_STRING);
$detalle_productos_detalles = filter_input(INPUT_POST, 'detalle_productos_detalles', FILTER_SANITIZE_STRING);
$id_enlace_productos_detalles = filter_input(INPUT_POST, 'id_enlace_productos_detalles', FILTER_SANITIZE_NUMBER_INT);
$orden_productos_detalles = filter_input(INPUT_POST, 'orden_productos_detalles', FILTER_SANITIZE_STRING);
$activo_productos_detalles = filter_input(INPUT_POST, 'activo_productos_detalles', FILTER_SANITIZE_NUMBER_INT);

$logs_sys = new stdClass();
/*
$logs_sys->id_sesion = $id_sesion_sys;
$logs_sys->IP = $ip_sys;
$logs_sys->Id_panel = $id_panel_sys;
$logs_sys->Id_idioma = $id_idioma_sys;
$logs_sys->Select = $select_sys;
$logs_sys->Id_producto = $id_url;
$logs_sys->Id_producto_detalle = $id_productos_detalles_url;
$logs_sys->Id_idioma_producto_detalle = $id_idioma_productos_detalles;
$logs_sys->Apartado = $apartado_url;
$logs_sys->Detalle_productos_detalles = $detalle_productos_detalles;
$logs_sys->Id_enlace_productos_detalles = $id_enlace_productos_detalles;
$logs_sys->Orden_productos_detalles = $orden_productos_detalles;
$logs_sys->Activo_productos_detalles = $activo_productos_detalles;
*/
$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-update-php.php");