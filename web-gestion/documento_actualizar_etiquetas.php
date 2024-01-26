<?php
header('Content-Type: application/json');
$id_sesion = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$so = filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING);
$idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
$ejercicio = filter_input(INPUT_POST, 'ejercicio', FILTER_SANITIZE_NUMBER_INT);
$id_documento_1 = filter_input(INPUT_POST, 'id_documento_1', FILTER_SANITIZE_NUMBER_INT);

if(empty($ejercicio)) { $ejercicio = date("Y"); }

$datos = "";
foreach ($_POST as $key => $valor) {
    $datos .= $key.": ".$valor."<br />";
}

$logs = new stdClass();

$logs->datos = $datos;

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

$logs->selec1 = "SELECT * FROM documentos_".$ejercicio."_1 WHERE id=".$id_documento_1." LIMIT 1";
$result = $conn->query("SELECT id,id_librador,fecha_documento FROM documentos_".$ejercicio."_1 WHERE id=".$id_documento_1." LIMIT 1");
if($conn->registros() == 1) {
    $id_documento = $result[0]['id'];
    $id_librador = $result[0]['id_librador'];
    $fecha_documento = $result[0]['fecha_documento'];
}

$result_libradores = $conn->query("SELECT nombre,apellido_1,apellido_2,razon_social FROM documentos_".$ejercicio."_libradores WHERE id_documentos_1='".$id_documento_1."' LIMIT 1");
if($conn->registros() == 1) {
    $nombre_librador = stripslashes($result_libradores[0]['nombre']);
    $apellido_1_librador = stripslashes($result_libradores[0]['apellido_1']);
    $apellido_2_librador = stripslashes($result_libradores[0]['apellido_2']);
    $razon_social_librador = stripslashes($result_libradores[0]['razon_social']);
}

$tarifa = 0;
$result_tarifas = $conn->query("SELECT id FROM tarifas WHERE prioritaria='1' LIMIT 1");
if($conn->registros() == 1) {
    $tarifa = $result_tarifas[0]['id'];
}

$logs->selec2_2 = "SELECT * FROM documentos_".$ejercicio."_2 WHERE id_documentos_1=".$id_documento_1." ORDER BY id";
$result_2 = $conn->query("SELECT * FROM documentos_".$ejercicio."_2 WHERE id_documentos_1=".$id_documento_1." ORDER BY id");
if($conn->registros() >= 1) {
    foreach ($result_2 as $key => $valor) {
        $id_documento_2[] = $valor['id'];
        $id_producto[] = $valor['id_producto'];
        $id_productos_detalles_enlazado[] = $valor['id_productos_detalles_enlazado'];
        $id_productos_detalles_multiples[] = $valor['id_productos_detalles_multiples'];
        $id_packs[] = $valor['id_packs'];
        $imagen_producto[] = $valor['imagen_producto'];
        $descripcion_producto[] = stripslashes($valor['descripcion_producto']);
        $detalles_producto[] = stripslashes($valor['detalles_producto']);
        $descripcion_oferta[] = stripslashes($valor['descripcion_oferta']);
        $codigo_barras_producto[] = stripslashes($valor['codigo_barras_producto']);
        $referencia_producto[] = stripslashes($valor['referencia_producto']);
        $numero_serie[] = stripslashes($valor['numero_serie']);
        $lote[] = stripslashes($valor['lote']);
        $caducidad[] = $valor['caducidad'];
        $cantidad[] = $valor['cantidad'];
        $unidad[] = $valor['unidad'];
        $logs->selec3 = "SELECT pvp,id_ofertas,oferta_desde,oferta_hasta,pvp_oferta FROM productos_pvp WHERE id_producto='".$valor['id_producto']."' AND id_productos_detalles_enlazado='".$valor['id_productos_detalles_enlazado']."' AND id_productos_detalles_multiples='".$valor['id_productos_detalles_multiples']."' AND id_packs='".$valor['id_packs']."' AND id_tarifa='".$tarifa."' LIMIT 1";
        $result_productos = $conn->query("SELECT pvp,id_ofertas,oferta_desde,oferta_hasta,pvp_oferta FROM productos_pvp WHERE 
                                    id_producto='".$valor['id_producto']."' AND 
                                    id_productos_detalles_enlazado='".$valor['id_productos_detalles_enlazado']."' AND 
                                    id_productos_detalles_multiples='".$valor['id_productos_detalles_multiples']."' AND 
                                    id_packs='".$valor['id_packs']."' AND 
                                    id_tarifa='".$tarifa."' LIMIT 1");
        if($conn->registros() == 1) {
            if(!empty($result_productos[0]['id_ofertas'])) {
                $result_ofertas = $conn->query("SELECT descripcion FROM ofertas WHERE id='" . $result_productos[0]['id_ofertas'] . "' AND activo=1 LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_ofertas[] = stripslashes($result_ofertas[0]['descripcion']);
                }else {
                    $descripcion_ofertas[] = "";
                }
            }else {
                $descripcion_ofertas[] = "";
            }
            $pvp[] = $result_productos[0]['pvp'];
            $id_ofertas[] = $result_productos[0]['id_ofertas'];
            $oferta_desde[] = $result_productos[0]['oferta_desde'];
            $oferta_hasta[] = $result_productos[0]['oferta_hasta'];
            $pvp_oferta[] = $result_productos[0]['pvp_oferta'];
        }

        $logs->selec2_2_1 = "SELECT codigo_barras FROM documentos_".$ejercicio."_productos_sku_stock WHERE id_documento_2=".$valor['id']." AND id_producto=".$valor['id_producto']." LIMIT 1";
        $result_2_2_1 = $conn->query("SELECT codigo_barras FROM documentos_".$ejercicio."_productos_sku_stock WHERE id_documento_2=".$valor['id']." AND id_producto=".$valor['id_producto']." LIMIT 1");
        if($conn->registros() == 1) {
            foreach ($result_2_2_1 as $key_2_2_1 => $valor_2_2_1) {
                $codigo_barras[] = $valor_2_2_1['codigo_barras'];
            }
        } else {
            $codigo_barras[] = '';
        }
    }
}

if(isset($id_documento_2)) {
    $logs->lineas = true;
    $logs->id_documento = $id_documento;
    $logs->id_librador = $id_librador;
    $logs->fecha_documento = $fecha_documento;
    $logs->nombre_librador = $nombre_librador;
    $logs->apellido_1_librador = $apellido_1_librador;
    $logs->apellido_2_librador = $apellido_2_librador;
    $logs->razon_social_librador = $razon_social_librador;
    $logs->id_documento_2 = $id_documento_2;
    $logs->id_producto = $id_producto;
    $logs->id_productos_detalles_enlazado = $id_productos_detalles_enlazado;
    $logs->id_productos_detalles_multiples = $id_productos_detalles_multiples;
    $logs->id_packs = $id_packs;
    $logs->imagen_producto = $imagen_producto;
    $logs->descripcion_producto = $descripcion_producto;
    $logs->detalles_producto = $detalles_producto;
    $logs->descripcion_oferta = $descripcion_oferta;
    $logs->codigo_barras_producto = $codigo_barras_producto;
    $logs->referencia_producto = $referencia_producto;
    $logs->numero_serie = $numero_serie;
    $logs->codigo_barras = $codigo_barras;
    $logs->lote = $lote;
    $logs->caducidad = $caducidad;
    $logs->cantidad = $cantidad;
    $logs->unidad = $unidad;
    $logs->descripcion_ofertas = $descripcion_ofertas;
    $logs->pvp = $pvp;
    $logs->oferta_desde = $oferta_desde;
    $logs->oferta_hasta = $oferta_hasta;
    $logs->pvp_oferta = $pvp_oferta;
}else {
    $logs->lineas = false;
}

echo json_encode($logs);