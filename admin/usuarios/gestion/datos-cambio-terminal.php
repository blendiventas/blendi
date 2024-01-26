<?php
session_start();
if (!isset($_SESSION["id_sesion"]))
{
    $_SESSION["id_sesion"] = session_id();
}

header('Content-Type: application/json');

$id_sesion_sys = $_SESSION["id_sesion"];
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_terminal = filter_input(INPUT_POST, 'id_terminal', FILTER_SANITIZE_NUMBER_INT);

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

$result_usuarios_accesos = $conn->query("SELECT * FROM usuarios_accesos WHERE sesion='" . $id_sesion_sys . "' AND activo=1 LIMIT 1");
if ($conn->registros() < 1) {
    if (isset($ajax_sys)) {
        echo json_encode([
            'error' => 'Acceso de usuario no encontrado'
        ]);
    }
    exit();
}
$id_usuario_sys = $result_usuarios_accesos[0]['id_usuario'];

$result_usuarios = $conn->query("SELECT id,terminal FROM usuarios WHERE id=" . $id_usuario_sys . " LIMIT 1");
if ($conn->registros() == 1) {
    if (empty($id_terminal)) {
        if ($result_usuarios[0]['terminal'] == -1) {
            $result = $conn->query("SELECT id FROM terminales WHERE activo=1 ORDER BY id ASC LIMIT 1");
            if($conn->registros() == 1) {
                $id_terminal = $result[0]['id'];
            }
        } else {
            $id_terminal = $result_usuarios[0]['terminal'];
        }
    }
    if($result_usuarios[0]['terminal'] != -1 && $result_usuarios[0]['terminal'] != $id_terminal) {
        if (isset($ajax_sys)) {
            echo json_encode([
                'error' => 'El usuario no tiene acceso a este terminal'
            ]);
        }
        exit();
    }
    $result = $conn->query("UPDATE usuarios_accesos SET activo=0 WHERE sesion='" . $id_sesion_sys . "' AND activo=1");
    $dia_sys = date("Y-m-d");
    $hora_sys = date("H:i:s");
    $result = $conn->query("INSERT INTO usuarios_accesos VALUES(
                                        NULL,
                                        " . $id_usuario_sys . ",
                                        '" . $id_sesion_sys . "',
                                        '" . addslashes($ip_sys) . "',
                                        '" . $dia_sys . "',
                                        '" . $hora_sys . "',
                                        '1',
                                        '" . $id_terminal . "')");
    $_SESSION['id_terminal'] = $id_terminal;
}
if (isset($ajax_sys)) {
    echo json_encode([
        'correcto' => true
    ]);
}
