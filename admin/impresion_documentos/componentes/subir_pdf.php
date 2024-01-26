<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$ruta = filter_input(INPUT_POST, 'ruta', FILTER_SANITIZE_STRING);
$id_archivo = filter_input(INPUT_POST, 'id_archivo', FILTER_SANITIZE_NUMBER_INT);

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

$info_respuesta = "";

$destino = $_SERVER['DOCUMENT_ROOT'] . '/enviar_mails/ficheros/' . $id_panel_sys;
if ( !is_dir( $destino ) ) {
    mkdir( $destino );
}
$destino .= '/';
$tipoArchivo = explode("/", $_FILES["file"]["type"]);
$nombre_pdf = "modelos_impresion_" . $id_archivo . ".pdf";

if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 500000)) {
    if (($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES['file']['type'] == "application/pdf")
    ) {
        if(!move_uploaded_file($_FILES["file"]["tmp_name"], $destino . $nombre_pdf)) {
            $info_respuesta .= "No se ha podido subir el archivo.";
        }else {
            $info_respuesta .= "Se ha subido el archivo correctamente.";
        }
    } else {
        $info_respuesta .= "No se puede subir una imagen con ese formato.";
    }
} else {
    if ($_FILES['file']['name'] == !NULL) echo "La imagen es demasiado grande.";
}

echo json_encode([
    'info' => $info_respuesta
]);