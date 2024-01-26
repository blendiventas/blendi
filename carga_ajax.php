<?php
header('Content-Type: application/json');
$id_sesion = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$so = filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING);
$idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
$carga_ajax = filter_input(INPUT_POST, 'carga_ajax', FILTER_SANITIZE_STRING);
$descripcionURL = filter_input(INPUT_POST, 'descripcionURL', FILTER_SANITIZE_STRING);

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion . "' ORDER BY id DESC LIMIT 1");
if($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
}else {
    throw new Exception("Acceso no permitido.");
}
unset($conn);

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

if($carga_ajax == "productos-categorias") {
    $select_sys = "productos-categorias";
    //require("web-gestion/datos-productos.php");
    //require("productos.php");
    echo "DATOS DEVUELTOS";
}else {
    echo "";
}