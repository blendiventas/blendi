<?php
header('Content-Type: application/json');
/*
formData.append("id_sesion", idSesion);
formData.append("ip", ip);
formData.append("so", so);
formData.append("idioma", idioma);
formData.append("id_idioma", id_idioma);
formData.append("id_usuario", idUsuario);
formData.append("ejercicio", ejercicio);
formData.append("id_documento_1", idDocumento1);
formData.append("decimales_cantidades", decimalesCantidades);
formData.append("decimales_importes", decimalesImportes);
*/
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$so_sys = filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING);
$idioma_sys = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$decimales_cantidades = $_POST['decimales_cantidades'];
$decimales_importes = $_POST['decimales_importes'];
$id_usuario_impresion = $_POST['id_usuario'];
$ejercicio = $_POST['ejercicio'];
$id_documento_1 = $_POST['id_documento_1'];

$id_panel = null;

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
if ($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
} else {
    throw new Exception("Acceso no permitido.");
}
unset($conn);

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$protocol = 'http://';

$host = $protocol . $_SERVER['HTTP_HOST'] . "/";

$raiz = $_SERVER['DOCUMENT_ROOT'] . '/enviar_mails/ficheros/' . $id_panel;
if ( !is_dir( $raiz ) ) {
    mkdir( $raiz );
}

try {
    require_once('fpdf/fpdf.php');
    require_once('fpdf/fpdi.php');

} catch (Exception $e) {
    echo $e->getMessage();
}

$nombre_archivo = $raiz . "/etiqueta_" . $id_documento_1 . ".pdf";
$nombre_pdf = "etiqueta_" . $id_documento_1 . ".pdf";

require("crear_etiqueta.php");

if (isset($ajax_sys)) {
    echo json_encode([
        'nombrePDF' => $nombre_pdf
    ]);
}