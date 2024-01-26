<?php
header('Content-Type: application/json');
session_start();

$id_sesion = $_POST['id_sesion'];
$id_sesion_js = $_POST['id_sesion_js'];
$ip = $_POST['ip'];
$so = $_POST['so'];
$idioma = $_POST['idioma'];
$id_usuario = $_POST['id_usuario'];
$ejercicio = $_POST['ejercicio'];
$id_documento_1 = $_POST['id_documento_1'];
if (!isset($_SESSION[$id_sesion_js])) {
    $_SESSION[$id_sesion_js] = [];
}
$_SESSION[$id_sesion_js]['ejercicio'] = $ejercicio;
$_SESSION[$id_sesion_js]['id_documento'] = $id_documento_1;
$comensales_guardar = $_POST['comensales_guardar'];

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

$result = $conn->query("UPDATE documentos_".$ejercicio."_1 SET 
                    comensales='".$comensales_guardar."', bloqueado=1 WHERE id = " . $id_documento_1 . " LIMIT 1");
