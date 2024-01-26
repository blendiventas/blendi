<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_productos_iva = filter_input(INPUT_POST, 'id_productos_iva', FILTER_SANITIZE_NUMBER_INT);
$id_iva = filter_input(INPUT_POST, 'id_iva', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_productos_iva = filter_input(INPUT_POST, 'id_idioma_productos_iva', FILTER_SANITIZE_NUMBER_INT);
$iva_productos_iva = filter_input(INPUT_POST, 'iva_productos_iva', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$recargo_productos_iva = filter_input(INPUT_POST, 'recargo_productos_iva', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$prioritario_productos_iva = filter_input(INPUT_POST, 'prioritario_productos_iva', FILTER_SANITIZE_NUMBER_INT);
$activo_productos_iva = filter_input(INPUT_POST, 'activo_productos_iva', FILTER_SANITIZE_NUMBER_INT);
if ($id_iva) {
    $id_productos_iva = $id_iva;
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/iva/gestion/datos-update-php.php");