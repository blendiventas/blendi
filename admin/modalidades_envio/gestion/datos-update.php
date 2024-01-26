<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_modalidades_envio = filter_input(INPUT_POST, 'id_modalidades_envio', FILTER_SANITIZE_NUMBER_INT);
$id_modalidades_envio = filter_input(INPUT_POST, 'id_modalidades_envio', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_modalidades_envio = filter_input(INPUT_POST, 'id_idioma_modalidades_envio', FILTER_SANITIZE_NUMBER_INT);
$descripcion_modalidades_envio = $_POST['descripcion_modalidades_envio'];
$explicacion_modalidades_envio = $_POST['explicacion_modalidades_envio'];
$id_iva_modalidades_envio = $_POST['id_iva_modalidades_envio'];
$incremento_pvp_modalidades_envio = $_POST['incremento_pvp_modalidades_envio'];

if ($select_sys == 'guardar-zona') {
    $id_modalidades_envio_zonas = $_POST['id'];
    $id_modalidad_envio_modalidades_envio_zonas = $_POST['id_modalidad_envio'];
    $id_zona_modalidades_envio_zonas = $_POST['id_zona'];
    $incremento_pvp_modalidades_envio_zonas = $_POST['incremento_pvp'];
    $incremento_por_kilo_modalidades_envio_zonas = $_POST['incremento_por_kilo'];
    $volumen_maximo_bulto_modalidades_envio_zonas = $_POST['volumen_maximo_bulto'];
    $franjas_incremento_pvp_modalidades_envio_zonas = explode(',', $_POST['franjas_incremento_pvp']);
    $franjas_volumen_desde_modalidades_envio_zonas = explode(',', $_POST['franjas_volumen_desde']);
    $franjas_volumen_hasta_modalidades_envio_zonas = explode(',', $_POST['franjas_volumen_hasta']);
}
if ($select_sys == 'eliminar-zona') {
    $id_modalidades_envio_zonas = $_POST['id'];
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_envio/gestion/datos-update-php.php");