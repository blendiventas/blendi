<?php
header('Content-Type: application/json');
session_start();

$id_sesion = $_POST['id_sesion'];
$ip = $_POST['ip'];
$id_det = $_POST['id_det'];

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

$logs = new stdClass();

$result_datos_terminal_producto = $conn->query("DELETE FROM documentos_enviar_terminales WHERE id='" . $id_det . "'");