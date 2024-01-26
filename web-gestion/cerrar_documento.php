<?php
session_start();

header('Content-Type: application/json');
$id_sesion = $_POST['id_sesion'];
$id_sesion_js = $_POST['id_sesion_js'];
$ip = $_POST['ip'];
$interface = $_POST['interface_js'];
$ejercicio = date('Y');

require($_SERVER['DOCUMENT_ROOT'] . "/assets/conn/ddbb.php");

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

$result = $conn->query("UPDATE documentos_enviar_terminales SET 
    estado=0, alertar=0 
    WHERE id_documento_1='" . $_SESSION[$id_sesion_js]['id_documento'] . "' AND estado = '-1'");

$result = $conn->query("UPDATE documentos_" . $ejercicio . "_1 SET bloqueado = 0  
    WHERE id='" . $_SESSION[$id_sesion_js]['id_documento'] . "'");

$result = $conn->query("SELECT numero_documento, id_usuario FROM documentos_" . $ejercicio . "_1 
    WHERE id='" . $_SESSION[$id_sesion_js]['id_documento'] . "'");

$numeroDocumento = (isset($result[0]))? $result[0]['numero_documento'] : '';
$id_usuario_sys = (isset($result[0]))? $result[0]['id_usuario'] : '';

$terminalesANotificar = [];
$result = $conn->query("SELECT ct.id_terminal as id_terminal FROM documentos_" . $ejercicio . "_1 d1 LEFT JOIN documentos_" . $ejercicio . "_2 d2 ON d1.id = d2.id_documentos_1 LEFT JOIN productos_categorias pc ON d2.id_producto = pc.id_producto LEFT JOIN categorias_terminales ct ON pc.id_categoria = ct.id_categoria 
    WHERE d1.id='" . $_SESSION[$id_sesion_js]['id_documento'] . "'
    GROUP BY ct.id_terminal");
if ($conn->registros() >= 1) {
    foreach ($result as $value_result) {
        $terminalesANotificar[] = $value_result['id_terminal'];
    }
}

unset($_SESSION[$id_sesion_js]['id_documento']);
if(isset($_SESSION[$id_sesion_js]['id_productos_relacionados_grupos'])) {
    unset($_SESSION[$id_sesion_js]['id_productos_relacionados_grupos']);
}
if(isset($_SESSION[$id_sesion_js]['id_librador'])) {
    unset($_SESSION[$id_sesion_js]['id_librador']);
}

$result_identificacion_accesos = $conn->query("UPDATE identificacion_accesos SET id_librador='".$id_librador."' 
                                                WHERE sesion='" . $id_sesion . "' LIMIT 1");

unset($conn);

$returnMessage = new stdClass();
$returnMessage->message = 'Pedido ' . $numeroDocumento . ' se ha modificado.';
$returnMessage->terminales = $terminalesANotificar;

echo json_encode($returnMessage);