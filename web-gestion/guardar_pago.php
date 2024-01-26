<?php
header('Content-Type: application/json');
session_start();

$id_sesion = $_POST['id_sesion'];
$ip = $_POST['ip'];
$so = $_POST['so'];
$idioma = $_POST['idioma'];
$id_usuario = $_POST['id_usuario'];
$ejercicio = $_POST['ejercicio'];
$id_documento_1 = $_POST['id_documento_1'];
$id_metodos_pago = $_POST['id_metodos_pago'];
$importe_cobrar = $_POST['importe_cobrar'];
$documento_bancario = $_POST['documento_bancario'];
$vencimiento_documento_bancario = $_POST['vencimiento_documento_bancario'];
$fecha_pago = $_POST['fecha_pago'];
if (empty($fecha_pago)) {
    $fecha_pago = date("Y-m-d");
}
$nota = $_POST['nota'];
$id_banco_cobro = $_POST['id_banco_cobro'];
$importe_entregado = $_POST['importe_entregado'];
$numero_efecto = $_POST['numero_efecto'];
$numero_efecto += 1;

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

if($importe_cobrar > $importe_entregado) {
    $importe_restante = $importe_cobrar - $importe_entregado;
    $result = $conn->query("UPDATE documentos_".$ejercicio."_recibos SET 
                        importe='".$importe_entregado."',
                        pagado=1,
                        fecha_pago='".$fecha_pago."',
                        hora_pago='".date("H:i:s")."',
                        documento_bancario='".addslashes($documento_bancario)."',
                        vencimiento_documento_bancario='".$vencimiento_documento_bancario."',
                        nota='".addslashes($nota)."',
                        id_banco_caja_ingreso='".$id_banco_cobro."',
                        id_metodo_pago='".$id_metodos_pago."',
                        id_usuario_pago='".$id_usuario."' 
                        WHERE id_documento = " . $id_documento_1 . " AND numero_efecto='" . $numero_efecto . "' LIMIT 1");

    $result = $conn->query("SELECT tipo_documento,id_librador,fecha,vencimiento,id_modalidad_pago,numero_efecto 
                            FROM documentos_".$ejercicio."_recibos 
                            WHERE id_documento = " . $id_documento_1 . " ORDER BY numero_efecto DESC LIMIT 1");
    $tipo_documento = $result[0]['tipo_documento'];
    $id_librador = $result[0]['id_librador'];
    $fecha = $result[0]['fecha'];
    $vencimiento = $result[0]['vencimiento'];
    $id_modalidad_pago = $result[0]['id_modalidad_pago'];
    $numero_efecto = $result[0]['numero_efecto'] +  1;
    $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(
            NULL,
            '" . $id_documento_1 . "',
            '" . addslashes($tipo_documento) . "',
            '" . $id_librador . "',
            '" . $importe_restante . "',
            '" . $fecha . "',
            '" . $vencimiento . "',
            '0',
            '',
            '',
            '0',
            '0',
            '" . $id_modalidad_pago . "',
            '" . $numero_efecto . "',
            '0',
            '0',
            '',
            NULL,
            '')");

}else {
    $result = $conn->query("UPDATE documentos_".$ejercicio."_recibos SET 
                        pagado=1,
                        fecha_pago='".$fecha_pago."',
                        hora_pago='".date("H:i:s")."',
                        documento_bancario='".addslashes($documento_bancario)."',
                        vencimiento_documento_bancario='".$vencimiento_documento_bancario."',
                        nota='".addslashes($nota)."',
                        id_banco_caja_ingreso='".$id_banco_cobro."',
                        id_metodo_pago='".$id_metodos_pago."',
                        id_usuario_pago='".$id_usuario."' 
                        WHERE id_documento = " . $id_documento_1 . " AND numero_efecto='" . $numero_efecto . "' LIMIT 1");
}
//echo "SELECT id FROM documentos_".$ejercicio."_recibos WHERE id_documento = " . $id_documento_1 . " AND pagado='0' LIMIT 1";
$result = $conn->query("SELECT id FROM documentos_".$ejercicio."_recibos WHERE id_documento = " . $id_documento_1 . " AND pagado='0' LIMIT 1");
if($conn->registros() == 1) {
    //echo "UPDATE documentos_".$ejercicio."_1 SET estado=1 WHERE id=" . $id_documento_1 . " LIMIT 1";
    $result = $conn->query("UPDATE documentos_".$ejercicio."_1 SET estado=1 WHERE id=" . $id_documento_1 . " LIMIT 1");
    $logs->resultado = "cobrado-parcial";
}else {
    //echo "UPDATE documentos_".$ejercicio."_1 SET estado=2 WHERE id=" . $id_documento_1 . " LIMIT 1";
    $result = $conn->query("UPDATE documentos_".$ejercicio."_1 SET estado=2, entregado=1 WHERE id=" . $id_documento_1 . " LIMIT 1");
    $logs->resultado = "cobrado-total";
}

$logs->id_documento_1 = $id_documento_1;
$logs->ejercicio = $ejercicio;

echo json_encode($logs);