<?php
session_start();

header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$id_sesion_js = filter_input(INPUT_POST, 'id_sesion_js', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$so_sys = filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$interface = trim($_POST['interface_js']);
$id_documento_1 = trim($_POST['id_documento']);
$ejercicio = trim($_POST['ejercicio']);
if (empty($_POST['select'])) {
    $select_sys = 'obtener_info_volcados';
} else {
    $select_sys = trim($_POST['select']);
}

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

if($interface == "tpv") {
    // ESTE CODIGO ASEGURA QUE LA ID DEL PANEL ES LA DE LA SESION Y IP IDENTIFICADA.
    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");

    $result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel = $result[0]['id_panel'];
    } else {
        throw new Exception("Acceso no permitido.");
    }
    unset($conn);
} else {
    throw new Exception("Acceso no permitido.");
}

$ajax = true;

require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-documentos.php");