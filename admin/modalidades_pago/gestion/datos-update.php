<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_libradores_modalidades_pago = filter_input(INPUT_POST, 'id_libradores_modalidades_pago', FILTER_SANITIZE_NUMBER_INT);
$descripcion_libradores_modalidades_pago = filter_input(INPUT_POST, 'descripcion_libradores_modalidades_pago', FILTER_SANITIZE_STRING);
$explicacion_libradores_modalidades_pago = filter_input(INPUT_POST, 'explicacion_libradores_modalidades_pago', FILTER_SANITIZE_STRING);
$tienda_virtual_libradores_modalidades_pago = (filter_input(INPUT_POST, 'tienda_virtual_libradores_modalidades_pago') === 'on') ? true : false;
$defecto_libradores_modalidades_pago = (filter_input(INPUT_POST, 'defecto_libradores_modalidades_pago') === 'on') ? true : false;
$incremento_pvp_libradores_modalidades_pago = filter_input(INPUT_POST, 'incremento_pvp_libradores_modalidades_pago');
$incremento_por_libradores_modalidades_pago = filter_input(INPUT_POST, 'incremento_por_libradores_modalidades_pago');
$id_modalidades_pago_lineas = $_POST['id_modalidades_pago_lineas'];
$dias_modalidades_pago_lineas = $_POST['dias_modalidades_pago_lineas'];
$porcentaje_modalidades_pago_lineas = $_POST['porcentaje_modalidades_pago_lineas'];

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_pago/gestion/datos-update-php.php");