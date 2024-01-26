<?php
header('Content-Type: application/json');

$id_sesion = $_POST['id_sesion'];
$ip = $_POST['ip'];
$so = $_POST['so'];
$idioma = $_POST['idioma'];
$id_idioma = $_POST['id_idioma'];
$interface_js = $_POST['interface_js'];
if(isset($_POST['id_panel'])) {
    $id_panel = $_POST['id_panel'];
}
$tipo_librador = $_POST['tipo_librador'];
$id_documento = $_POST['id_documento'];
$ejercicio_documentos = $_POST['ejercicio_documentos'];

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

$result_select_2 = $conn->query("SELECT id FROM documentos_".$ejercicio_documentos."_2 WHERE id_documentos_1 = " . $id_documento);
if($conn->registros() >= 1) {
    foreach ($result_select_2 as $key_select_2 => $valor_select_2) {
        $id_documentos_2 = $valor_select_2['id'];
        $result = $conn->query("DELETE FROM documentos_" . $ejercicio_documentos . "_productos_costes WHERE id_documentos_2 = " . $id_documentos_2);
        $result = $conn->query("DELETE FROM documentos_" . $ejercicio_documentos . "_productos_relacionados WHERE id_documentos_2 = " . $id_documentos_2);
        $result = $conn->query("DELETE FROM documentos_" . $ejercicio_documentos . "_productos_relacionados_combo WHERE id_documentos_2 = " . $id_documentos_2);
        $result = $conn->query("DELETE FROM documentos_" . $ejercicio_documentos . "_productos_relacionados_elaborados WHERE id_documentos_2 = " . $id_documentos_2);
    }
}
$result = $conn->query("DELETE FROM documentos_".$ejercicio_documentos."_1 WHERE id = " . $id_documento . " LIMIT 1");
$result = $conn->query("DELETE FROM documentos_".$ejercicio_documentos."_2 WHERE id_documentos_1 = " . $id_documento);
$result = $conn->query("DELETE FROM documentos_".$ejercicio_documentos."_iva WHERE id_documentos_1 = " . $id_documento);
$result = $conn->query("DELETE FROM documentos_".$ejercicio_documentos."_libradores WHERE id_documentos_1 = " . $id_documento . " LIMIT 1");
$result = $conn->query("DELETE FROM documentos_".$ejercicio_documentos."_libradores_envio WHERE id_documentos_1 = " . $id_documento . " LIMIT 1");
$result = $conn->query("DELETE FROM documentos_".$ejercicio_documentos."_observaciones WHERE id_documentos_1 = " . $id_documento);
$result = $conn->query("DELETE FROM documentos_".$ejercicio_documentos."_productos_sku_stock WHERE id_documento_1 = " . $id_documento);
$result = $conn->query("DELETE FROM documentos_".$ejercicio_documentos."_recibos WHERE id_documento = " . $id_documento);