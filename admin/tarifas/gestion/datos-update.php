<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_tarifas = filter_input(INPUT_POST, 'id_tarifas', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_tarifas = filter_input(INPUT_POST, 'id_idioma_tarifas', FILTER_SANITIZE_NUMBER_INT);
$descripcion_tarifas = filter_input(INPUT_POST, 'descripcion_tarifas', FILTER_SANITIZE_STRING);
$prioritaria_tarifas = filter_input(INPUT_POST, 'prioritaria_tarifas', FILTER_SANITIZE_NUMBER_INT);
$activa_tarifas = filter_input(INPUT_POST, 'activa_tarifas', FILTER_SANITIZE_NUMBER_INT);
$orden_tarifas = filter_input(INPUT_POST, 'orden_tarifas', FILTER_SANITIZE_STRING);

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/gestion/datos-update-php.php");