<?php

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$id_sesion = $_POST['id_sesion'];
$ip = $_POST['ip'];
$accion = $_POST['accion'];

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion . "' ORDER BY id DESC LIMIT 1");
if ($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
} else {
    throw new Exception("Acceso no permitido.");
}
unset($conn);

$id_documento_1 = $_POST['id_documento_1'];
$id_documento_2 = $_POST['id_documento_2'];
$id_producto_relacionado = $_POST['id_producto_relacionado'];
$estado = $_POST['estado'];

$condicion = " WHERE id_documento_1 = " . $id_documento_1 . " AND id_documento_2 = " . $id_documento_2;
if ($id_producto_relacionado && $id_producto_relacionado != 'undefined' && $id_producto_relacionado != 'false') {
    $condicion .= " AND id_documentos_combo = " . $id_producto_relacionado;
}

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

if ($accion == 'setVisto') {
    if ($estado && $estado == 'true') {
        $fechaVisto = date('Y-m-d H:i:s');
    } else {
        $fechaVisto = '0000-00-00 00:00:00';
    }

    $result = $conn->query("UPDATE documentos_enviar_terminales SET hora_visto = '" . $fechaVisto . "'" . $condicion);
}
if ($accion == 'setCocinando') {
    if ($estado && $estado == 'true') {
        $estadoAModificar = 1;
        $result = $conn->query("UPDATE documentos_enviar_terminales SET estado = " . $estadoAModificar . $condicion);
    }
}
if ($accion == 'setHecho') {
    if ($estado && $estado == 'true') {
        $estadoAModificar = 2;
        $result = $conn->query("UPDATE documentos_enviar_terminales SET estado = " . $estadoAModificar . $condicion);
    }
}
if ($accion == 'setPendiente') {
    if ($estado && $estado == 'true') {
        $estadoAModificar = 0;
        $result = $conn->query("UPDATE documentos_enviar_terminales SET estado = " . $estadoAModificar . $condicion);
    }
}
if ($accion == 'setPrioritario') {
    if ($estado && $estado == 'true') {
        $estadoAModificar = 3;
        $result = $conn->query("UPDATE documentos_enviar_terminales SET alertar = " . $estadoAModificar . $condicion);
    }
}
if ($accion == 'resetAlertar') {
    $result = $conn->query("UPDATE documentos_enviar_terminales SET alertar = 0" . $condicion);
}

unset($conn);
