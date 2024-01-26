<?php
header('Content-Type: application/json');

$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$margen = filter_input(INPUT_POST, 'margen', FILTER_SANITIZE_NUMBER_INT);
if($select_sys == 'eliminar-margen-izquierda' || $select_sys == 'insertar-linea') {
    $id_comedor = filter_input(INPUT_POST, 'id_comedor', FILTER_SANITIZE_NUMBER_INT);
}
if ($select_sys == 'insertar-linea' || $select_sys == 'guardar-linea' || $select_sys == 'eliminar-linea') {
    $id_linea = filter_input(INPUT_POST, 'id_linea', FILTER_SANITIZE_NUMBER_INT);
    $ancho_pos_linea = filter_input(INPUT_POST, 'ancho_pos_linea', FILTER_SANITIZE_NUMBER_INT);
    $alto_pos_linea = filter_input(INPUT_POST, 'alto_pos_linea', FILTER_SANITIZE_NUMBER_INT);
    $ancho_linea = filter_input(INPUT_POST, 'ancho_linea', FILTER_SANITIZE_NUMBER_INT);
    $alto_linea = filter_input(INPUT_POST, 'alto_linea', FILTER_SANITIZE_NUMBER_INT);
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT'] . "/admin/mesas/gestion/datos-update-php.php");