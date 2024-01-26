<?php
header('Content-Type: application/json');
$id_sesion = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$so = filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING);
$idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
$ejercicio = filter_input(INPUT_POST, 'ejercicio', FILTER_SANITIZE_NUMBER_INT);
$id_documento_1 = filter_input(INPUT_POST, 'id_documento_1', FILTER_SANITIZE_NUMBER_INT);
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
$id_accion = filter_input(INPUT_POST, 'id_accion', FILTER_SANITIZE_NUMBER_INT);
$fecha_accion = '';
if ($accion == 'fecha-cobro') {
    $fecha_accion = $_POST['fecha_accion'];
}
$numero_efecto = filter_input(INPUT_POST, 'numero_efecto', FILTER_SANITIZE_NUMBER_INT);

if(empty($ejercicio)) { $ejercicio = date("Y"); }

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion . "' ORDER BY id DESC LIMIT 1");
if ($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
} else {
    throw new Exception("Acceso no permitido.");
}
unset($conn);

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

if($accion == "banco") {
    $result = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET id_banco_caja_ingreso='" . $id_accion . "' WHERE id_documento='" . $id_documento_1 . "' AND numero_efecto='" . $numero_efecto . "' LIMIT 1");
}else if($accion == "metodo-cobro") {
    $result = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET id_metodo_pago='" . $id_accion . "' WHERE id_documento='" . $id_documento_1 . "' AND numero_efecto='" . $numero_efecto . "' LIMIT 1");
}else if($accion == "fecha-cobro") {
    $result = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET fecha_pago='" . $fecha_accion . "' WHERE id_documento='" . $id_documento_1 . "' AND numero_efecto='" . $numero_efecto . "' LIMIT 1");
}else if($accion == "usuario") {
    $result = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET id_usuario_pago='" . $id_accion . "' WHERE id_documento='" . $id_documento_1 . "' AND numero_efecto='" . $numero_efecto . "' LIMIT 1");
}