<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_grupos_clientes = filter_input(INPUT_POST, 'id_grupos_clientes', FILTER_SANITIZE_NUMBER_INT);

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/grupos_clientes/gestion/datos-select-php.php");