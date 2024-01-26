<?php
header('Content-Type: application/json');

$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_comedores = filter_input(INPUT_POST, 'id_comedores', FILTER_SANITIZE_NUMBER_INT);

if ($select_sys == 'guardar-descripcion') {
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
}else if ($select_sys == 'guardar-principal') {
    $principal_comedores = filter_input(INPUT_POST, 'principal_comedores', FILTER_SANITIZE_NUMBER_INT);
}else if ($select_sys == 'guardar-activo') {
    $activo_comedores = filter_input(INPUT_POST, 'activo_comedores', FILTER_SANITIZE_NUMBER_INT);
}else if ($select_sys == 'guardar-completo' || $select_sys == 'eliminar') {
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $activo = filter_input(INPUT_POST, 'activo', FILTER_SANITIZE_STRING);
    $orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_STRING);
    $principal = filter_input(INPUT_POST, 'principal', FILTER_SANITIZE_STRING);
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT'] . "/admin/mesas/comedores/gestion/datos-update-php.php");