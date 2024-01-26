<?php
header('Content-Type: application/json');
$id_sesion = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$so = filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING);
$id_idioma = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
$select_sys = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
$ejercicio = filter_input(INPUT_POST, 'ejercicio', FILTER_SANITIZE_NUMBER_INT);
$interface = $_POST['interface_js'];
if($interface == "web") {
    $id_panel = $_POST['id_panel'];
}
$id_documento_1 = filter_input(INPUT_POST, 'id_documento_1', FILTER_SANITIZE_NUMBER_INT);
$id_producto = filter_input(INPUT_POST, 'id_producto', FILTER_SANITIZE_NUMBER_INT);
$id_enlazado = filter_input(INPUT_POST, 'id_enlazado', FILTER_SANITIZE_NUMBER_INT);
$id_multiple = filter_input(INPUT_POST, 'id_multiple', FILTER_SANITIZE_NUMBER_INT);
$id_pack = filter_input(INPUT_POST, 'id_pack', FILTER_SANITIZE_NUMBER_INT);
$buscar_opcion = filter_input(INPUT_POST, 'buscar_opcion', FILTER_SANITIZE_STRING);

$logs = new stdClass();

if(!empty($id_documento_1)) {
    if (empty($ejercicio)) {
        $ejercicio = date("Y");
    }

    $datos = "";
    foreach ($_POST as $key => $valor) {
        $datos .= $key . ": " . $valor . "<br />";
    }

    $ajax = true;

    $logs->datos = $datos;

    require($_SERVER['DOCUMENT_ROOT'] . "/assets/conn/ddbb.php");

    if($interface == "tpv") {
        $conn = new db(0);
        $conn->query("SET NAMES 'utf8'");
        $result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion . "' ORDER BY id DESC LIMIT 1");
        if ($conn->registros() == 1) {
            $id_panel = $result[0]['id_panel'];
        } else {
            throw new Exception("Acceso no permitido.");
        }
        unset($conn);
    }

    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");

    $select_sys = "lineas-documento";
    require("datos-productos.php");

    $logs->numeroProductos = $lineas_documento;
    if($documento_ok == true) {
        $logs->documento_ok = 1;
    }else {
        $logs->documento_ok = 0;
    }

}else {
    $logs->numeroProductos = 0;
    $logs->documento_ok = 1;
}

echo json_encode($logs);