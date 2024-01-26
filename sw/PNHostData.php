<?php
session_start();

$id_sesion = session_id();
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} else {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
}
$ejercicio = date("Y");

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion . "' ORDER BY id DESC LIMIT 1");
if ($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
} else {
    throw new Exception("Acceso no permitido.");
}
$datos = $conn->query("SELECT dominio_base, base, usuario_base, password_base from identificacion_panel WHERE id=" . $id_panel . " AND bloqueado=0 LIMIT 1");

$bbddHost = $datos[0]['dominio_base'];
$bbddUser = $datos[0]['usuario_base'];
$bbddPass = $datos[0]['password_base'];
$bbddDB = $datos[0]['base'];

unset($conn);

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_usuario,dia,hora,id_terminal FROM usuarios_accesos WHERE sesion='" . $id_sesion . "' AND activo=1 LIMIT 1");
if ($conn->registros() == 1) {
    $id_usuario_sys = $result[0]['id_usuario'];
    $dia_sys = $result[0]['dia'];
    $hora_sys = $result[0]['hora'];
    $id_terminal_sys = $result[0]['id_terminal'];
} else {
    throw new Exception("Acceso no permitido.");
}
