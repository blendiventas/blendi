<?php
$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
if($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
}else {
    throw new Exception("Acceso no permitido.");
}
unset($conn);

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$logs = new stdClass();

switch ($select_sys) {
    case "numero-efectos":
        $result_recibos = $conn->query("SELECT COUNT(id) AS numero_recibos FROM documentos_".$ejercicio."_recibos WHERE id_documento=".$id_documento);
        $numero_recibos = $result_recibos[0]['numero_recibos'];

        if (isset($ajax)) {
            echo json_encode([
                'numero_recibos' => $numero_recibos
            ]);
        }
        break;
}
unset($conn);