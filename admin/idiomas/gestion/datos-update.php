<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_idiomas = filter_input(INPUT_POST, 'id_idiomas', FILTER_SANITIZE_NUMBER_INT);
$idioma_idiomas = filter_input(INPUT_POST, 'idioma_idiomas', FILTER_SANITIZE_STRING);
$bandera_idiomas = filter_input(INPUT_POST, 'bandera_idiomas', FILTER_SANITIZE_STRING);
$lang_idiomas = filter_input(INPUT_POST, 'lang_idiomas', FILTER_SANITIZE_STRING);
$locale_idiomas = filter_input(INPUT_POST, 'locale_idiomas', FILTER_SANITIZE_STRING);
$activo_idiomas = filter_input(INPUT_POST, 'activo_idiomas', FILTER_SANITIZE_NUMBER_INT);
$principal_idiomas = filter_input(INPUT_POST, 'principal_idiomas', FILTER_SANITIZE_NUMBER_INT);

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/idiomas/gestion/datos-update-php.php");