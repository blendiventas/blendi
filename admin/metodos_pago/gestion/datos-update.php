<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_metodos_pago = filter_input(INPUT_POST, 'id_metodos_pago', FILTER_SANITIZE_NUMBER_INT);
$id_metodos_pago = filter_input(INPUT_POST, 'id_metodos_pago', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_metodos_pago = filter_input(INPUT_POST, 'id_idioma_metodos_pago', FILTER_SANITIZE_NUMBER_INT);
$descripcion_metodos_pago = $_POST['descripcion_metodos_pago'];
$explicacion_metodos_pago = $_POST['explicacion_metodos_pago'];
$interface_metodos_pago = $_POST['interface_metodos_pago'];
$prioritario_metodos_pago = $_POST['prioritario_metodos_pago'];
$id_iva_metodos_pago = $_POST['id_iva_metodos_pago'];
$incremento_pvp_metodos_pago = $_POST['incremento_pvp_metodos_pago'];
$incremento_por_metodos_pago = $_POST['incremento_por_metodos_pago'];
$ruta_metodos_pago = $_POST['ruta_metodos_pago'];
$sistema_metodos_pago = $_POST['sistema_metodos_pago'];
$imagen_metodos_pago = $_POST['imagen_metodos_pago'];
$orden_metodos_pago = $_POST['orden_metodos_pago'];
$directo_metodos_pago = $_POST['directo_metodos_pago'];
$activo_metodos_pago = $_POST['activo_metodos_pago'];

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/metodos_pago/gestion/datos-update-php.php");