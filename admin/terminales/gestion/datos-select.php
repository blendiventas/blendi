<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_terminal = filter_input(INPUT_POST, 'id_terminal', FILTER_SANITIZE_NUMBER_INT);

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/terminales/gestion/datos-select-php.php");