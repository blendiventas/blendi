<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);

$softwareCompra = $_POST['software-compra'];
$softwarePlan = $_POST['software-plan'];
$terminalesAdicionales = $_POST['terminales-adicionales'];
$configSuscripcionIban = $_POST['config-suscripcion-iban'];

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if (!isset($_POST['software-compra']) || !isset($_POST['software-plan']) || !isset($_POST['config-suscripcion-iban']) || !isset($identificacion_acceso_sys) || $identificacion_acceso_sys !== true) {
    echo json_encode('ko');
    exit();
}

$result_datos_empresa = $conn->query("UPDATE datos_empresa SET 
    software_blendi='" . stripslashes($softwareCompra) . "',
    plan_blendi='" . stripslashes($softwarePlan) . "',
    iban='" . stripslashes($configSuscripcionIban) . "', 
    teminales_adicionales='" . stripslashes($terminalesAdicionales) . "' 
    WHERE id=1 LIMIT 1");

$result_datos_configuracion_inicial = $conn->query("UPDATE datos_configuracion_inicial SET 
    plan=1 
    WHERE id=1 LIMIT 1");

echo json_encode('ok');