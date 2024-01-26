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
$nota = $_POST['nota'];
$id_banco_cobro = $_POST['id_banco_cobro'];
$importe_entregado = $_POST['importe_entregado'];
$numero_efecto = $_POST['numero_efecto'];
$decimales_cantidades = $_POST['decimales_cantidades'];
$decimales_importes = $_POST['decimales_importes'];
$numero_efecto += 1;
$crear_tiquet = $_POST['crear_tiquet']; // si es igual a 1, se debe crear un nuevo tiquet ya que el cobro viene de cobrar por productos
$productos_nuevo_tiquet = $_POST['productos_nuevo_tiquet'];
$productos_nuevo_tiquet_cantidad = $_POST['productos_nuevo_tiquet_cantidad'];

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

require("guardar_pago_datos_1.php");

$id_documento_1_inicial = $id_documento_1;
$numero_documento_inicial = $numero_documento;
$id_documento_1 = 0;
$numero_documento = 0;
require("guardar_documento_1.php");
$insert_inicial = true;
require("guardar_documento_libradores.php");
require("guardar_documento_libradores_envio.php");
$nuevo_id_documento_1 = $id_documento_1;
$nuevo_numero_documento = $numero_documento;

$productos_nuevo_tiquet = explode(',', $productos_nuevo_tiquet);
$productos_nuevo_tiquet_cantidad = explode(',', $productos_nuevo_tiquet_cantidad);
foreach ($productos_nuevo_tiquet as $key_nuevo_tiquet => $valor_nuevo_tiquet) {
    $result_2 = $conn->query("SELECT * FROM documentos_".$ejercicio."_2 WHERE id = " . $valor_nuevo_tiquet . " LIMIT 1");
    if($result_2[0]['cantidad'] == 1) {
        $conn->query("UPDATE documentos_" . $ejercicio . "_2 SET id_documentos_1 = " . $nuevo_id_documento_1 . " WHERE id = " . $valor_nuevo_tiquet . " LIMIT 1");
        $conn->query("UPDATE documentos_" . $ejercicio . "_iva SET id_documentos_1 = " . $nuevo_id_documento_1 . " WHERE id_documentos_2 = " . $valor_nuevo_tiquet . " LIMIT 1");
        $conn->query("UPDATE documentos_" . $ejercicio . "_observaciones SET id_documentos_1 = " . $nuevo_id_documento_1 . " WHERE id_documentos_2 = " . $valor_nuevo_tiquet . " LIMIT 1");
        $conn->query("UPDATE documentos_" . $ejercicio . "_productos_sku_stock SET id_documentos_1 = " . $nuevo_id_documento_1 . " WHERE id_documentos_2 = " . $valor_nuevo_tiquet);
    }else {
        require("guardar_pago_datos_2.php");
        // crear nuevos registros con cantidad 1 de cada producto
        // modificar las cantidades y totales si procede, de los registros originales a -1
        $accion = "insertar-producto";
        require("guardar_documento_2.php");
        // insertar los registros si procede en otras tablas
        if($tipo_producto == 2 && isset($id_productos_relacionados)) {
            // productos relacionados (solo es necesario crear los registros para el nuevo documento, no afectan las cantidades)
            foreach ($id_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados VALUES(
                    NULL,
                    '" . $id_productos_relacionados_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $id_documento_2 . "',
                    '" . $id_documentos_combo_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $id_productos_detalles_enlazado_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $id_productos_detalles_multiples_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $id_packs_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $id_relacionado_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $id_titulo_relacionado_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $descripcion_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $id_grupo_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $fijo_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $modelo_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $cantidad_con_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $cantidad_mitad_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $cantidad_sin_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $cantidad_doble_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $sumar_con_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $sumar_mitad_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $sumar_sin_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $sumar_doble_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $por_defecto_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $mostrar_productos_relacionados[$key_productos_relacionados] . "',
                    '" . $orden_productos_relacionados[$key_productos_relacionados] . "')");
            }
        }
        if($tipo_producto == 3 && isset($id_productos_relacionados_combo)) {
            // productos relacionados combo (solo es necesario crear los registros para el nuevo documento, no afectan las cantidades)
            foreach ($id_productos_relacionados_combo as $key_productos_relacionados_combo => $valor_productos_relacionados_combo) {
                $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados_combo VALUES(
                    NULL,
                    '" . $id_documento_2 . "',
                    '" . $id_productos_detalles_enlazado_productos_relacionados_combo[$key_productos_relacionados_combo] . "',
                    '" . $id_productos_detalles_multiples_productos_relacionados_combo[$key_productos_relacionados_combo] . "',
                    '" . $id_packs_productos_relacionados_combo[$key_productos_relacionados_combo] . "',
                    '" . $id_relacionado_productos_relacionados_combo[$key_productos_relacionados_combo] . "',
                    '" . $id_grupo_productos_relacionados_combo[$key_productos_relacionados_combo] . "',
                    '" . $fijo_productos_relacionados_combo[$key_productos_relacionados_combo] . "',
                    '" . $cantidad_productos_relacionados_combo[$key_productos_relacionados_combo] . "',
                    '" . $sumar_productos_relacionados_combo[$key_productos_relacionados_combo] . "',
                    '" . $mostrar_productos_relacionados_combo[$key_productos_relacionados_combo] . "',
                    '" . $orden_productos_relacionados_combo[$key_productos_relacionados_combo] . "')");
            }
        }
        if($tipo_producto == 1 && isset($id_productos_relacionados_elaborados)) {
            // productos relacionados elaborados (se deben tener en cuenta las cantidades)
            foreach ($id_productos_relacionados_elaborados as $key_productos_relacionados_elaborados => $valor_productos_relacionados_elaborados) {
                $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados_elaborados VALUES(
                NULL,
                '" . $id_documento_2 . "',
                '" . $id_productos_detalles_enlazado_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $id_productos_detalles_multiples_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $id_packs_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $id_categoria_estadisticas_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $id_producto_relacionado_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $fijo_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $cantidad_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $coste_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $id_unidad_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $sumar_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $mostrar_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "',
                '" . $orden_productos_relacionados_elaborados[$key_productos_relacionados_elaborados] . "')");
            }
        }
        // productos sku stock (se deben tener en cuenta las cantidades)
        foreach ($id_productos_sku_stock as $key_productos_sku_stock => $valor_productos_sku_stock) {
            $result_insert = $conn->query("INSERT INTO documentos_".$ejercicio."_productos_sku_stock VALUES(
                NULL,
                '".$id_producto_productos_sku_stock[$key_productos_sku_stock]."',
                '".$id_productos_sku_productos_sku_stock[$key_productos_sku_stock]."',
                '".$lote_productos_sku_stock[$key_productos_sku_stock]."',
                '".$caducidad_productos_sku_stock[$key_productos_sku_stock]."',
                '".$numero_serie_productos_sku_stock[$key_productos_sku_stock]."',
                '',
                '".$tipo_documento_productos_sku_stock[$key_productos_sku_stock]."',
                '".$fecha_productos_sku_stock[$key_productos_sku_stock]."',
                '".$nuevo_id_documento_1."',
                '".$id_documento_2."',
                '".$tipo_librador_productos_sku_stock[$key_productos_sku_stock]."',
                '".$id_librador_productos_sku_stock[$key_productos_sku_stock]."',
                '".$coste_productos_sku_stock[$key_productos_sku_stock]."',
                '".$cantidad_productos_sku_stock[$key_productos_sku_stock]."',
                '".$id_unidades_productos_sku_stock[$key_productos_sku_stock]."',
                '".$unidad_productos_sku_stock[$key_productos_sku_stock]."',
                '".$importe_productos_sku_stock[$key_productos_sku_stock]."',
                '".$fecha_alta_productos_sku_stock[$key_productos_sku_stock]."',
                '".$fecha_modificacion_productos_sku_stock[$key_productos_sku_stock]."')");

            $id_productos_sku_stock_insert = $conn->id_insert();
            $codigo_barras = $id_productos_sku_stock_insert;
            if(strlen($codigo_barras) < 10) {
                $codigo_barras = str_repeat("0", 11 - strlen($codigo_barras)) . $codigo_barras;
            }
            $result_update_sku_stock = $conn->query("UPDATE documentos_".$ejercicio."_productos_sku_stock SET codigo_barras='" . addslashes($codigo_barras) . "' WHERE id=" . $id_productos_sku_stock_insert . " LIMIT 1");
        }
        $id_documento_2 = $id_documento_2_original;
        require("guardar_documento_obs.php");
        $accion = "modificar-producto";
        $id_documento_1 = $id_documento_1_inicial;
        $numero_documento = $numero_documento_inicial;
        $cantidad = $cantidad_modificar;
        $base_antes_descuento = $base_antes_descuento_modificar;
        $importe_descuento_base = $importe_descuento_base_modificar;
        $base_despues_descuento = $base_despues_descuento_modificar;
        $importe_iva = $importe_iva_modificar;
        $importe_recargo = $importe_recargo_modificar;
        $importe_recargo = $importe_recargo_modificar;
        $total_linea = $total_linea_modificar;
        $descuento_total = $descuento_total_modificar;
        $importe_descuento_total = $importe_descuento_total_modificar;
        $total_despues_descuento = $total_despues_descuento_modificar;
        require("guardar_documento_2.php");
        // modificar cantidades y totales si procede de otras tablas
        // productos relacionados elaborados (se deben tener en cuenta las cantidades)
        foreach ($id_productos_relacionados_elaborados as $key_productos_relacionados_elaborados => $valor_productos_relacionados_elaborados) {
            $result_insert = $conn->query("UPDATE documentos_".$ejercicio."_productos_relacionados_elaborados SET 
                cantidad='".$cantidad_modificar_productos_relacionados_elaborados[$key_productos_relacionados_elaborados]."' 
                WHERE id=".$valor_productos_relacionados_elaborados." LIMIT 1");
        }
        // productos sku stock (se deben tener en cuenta las cantidades)
        foreach ($id_productos_sku_stock as $key_productos_sku_stock => $valor_productos_sku_stock) {
            $result_insert = $conn->query("UPDATE documentos_".$ejercicio."_productos_sku_stock SET 
                cantidad='".$cantidad_modificar_productos_sku_stock[$key_productos_sku_stock]."' 
                WHERE id=".$valor_productos_sku_stock." LIMIT 1");
        }
        // eliminar las matrices creadad en guardar_pago_datos_2.php
        if($tipo_producto == 2 && isset($id_productos_relacionados)) {
            unset($id_productos_relacionados);
            unset($id_productos_relacionados_productos_relacionados);
            unset($id_documentos_2_productos_relacionados);
            unset($id_documentos_combo_productos_relacionados);
            unset($id_productos_detalles_enlazado_productos_relacionados);
            unset($id_productos_detalles_multiples_productos_relacionados);
            unset($id_packs_productos_relacionados);
            unset($id_relacionado_productos_relacionados);
            unset($id_grupo_productos_relacionados);
            unset($fijo_productos_relacionados);
            unset($modelo_productos_relacionados);
            unset($cantidad_con_productos_relacionados);
            unset($cantidad_mitad_productos_relacionados);
            unset($cantidad_sin_productos_relacionados);
            unset($cantidad_doble_productos_relacionados);
            unset($sumar_con_productos_relacionados);
            unset($sumar_mitad_productos_relacionados);
            unset($sumar_sin_productos_relacionados);
            unset($sumar_doble_productos_relacionados);
            unset($por_defecto_productos_relacionados);
            unset($mostrar_productos_relacionados);
            unset($orden_productos_relacionados);
        }
        if($tipo_producto == 3 && isset($id_productos_relacionados_combo)) {
            unset($id_productos_relacionados_combo);
            unset($id_documentos_2_productos_relacionados_combo);
            unset($id_productos_detalles_enlazado_productos_relacionados_combo);
            unset($id_productos_detalles_multiples_productos_relacionados_combo);
            unset($id_packs_productos_relacionados_combo);
            unset($id_relacionado_productos_relacionados_combo);
            unset($id_grupo_productos_relacionados_combo);
            unset($fijo_productos_relacionados_combo);
            unset($cantidad_productos_relacionados_combo);
            unset($sumar_productos_relacionados_combo);
            unset($mostrar_productos_relacionados_combo);
            unset($orden_productos_relacionados_combo);
        }
        if($tipo_producto == 1 && isset($id_productos_relacionados_elaborados)) {
            unset($id_productos_relacionados_elaborados);
            unset($id_documentos_2_productos_relacionados_elaborados);
            unset($id_productos_detalles_enlazado_productos_relacionados_elaborados);
            unset($id_productos_detalles_multiples_productos_relacionados_elaborados);
            unset($id_packs_productos_relacionados_elaborados);
            unset($id_categoria_estadisticas_productos_relacionados_elaborados);
            unset($id_producto_relacionado_productos_relacionados_elaborados);
            unset($fijo_productos_relacionados_elaborados);
            unset($cantidad_productos_relacionados_elaborados);
            unset($cantidad_modificar_productos_relacionados_elaborados);
            unset($coste_productos_relacionados_elaborados);
            unset($id_unidad_productos_relacionados_elaborados);
            unset($sumar_productos_relacionados_elaborados);
            unset($mostrar_productos_relacionados_elaborados);
            unset($orden_productos_relacionados_elaborados);
        }
        unset($id_productos_sku_stock);
        unset($id_producto_productos_sku_stock);
        unset($id_productos_sku_productos_sku_stock);
        unset($lote_productos_sku_stock);
        unset($caducidad_productos_sku_stock);
        unset($numero_serie_productos_sku_stock);
        unset($tipo_documento_productos_sku_stock);
        unset($fecha_productos_sku_stock);
        unset($id_documento_1_productos_sku_stock);
        unset($id_documento_2_productos_sku_stock);
        unset($tipo_librador_productos_sku_stock);
        unset($id_librador_productos_sku_stock);
        unset($coste_productos_sku_stock);
        unset($cantidad_productos_sku_stock);
        unset($cantidad_modificar_productos_sku_stock);
        unset($id_unidades_productos_sku_stock);
        unset($unidad_productos_sku_stock);
        unset($importe_productos_sku_stock);
        unset($fecha_alta_productos_sku_stock);
        unset($fecha_modificacion_productos_sku_stock);

        $id_documento_1 = $nuevo_id_documento_1;
        $numero_documento = $nuevo_numero_documento;
    }
}
// recalculamos los totales del documento creado
$total = 0;
require("calcular_totales.php");
require("guardar_documento_1.php");
unset($base_totales_lineas);
unset($importe_iva_totales_lineas);
unset($importe_recargo_totales_lineas);

// recalculamos los totales del documento modificado
$id_documento_1 = $id_documento_1_inicial;
$numero_documento = $numero_documento_inicial;
$total = 0;
require("calcular_totales.php");
require("guardar_documento_1.php");
unset($base_totales_lineas);
unset($importe_iva_totales_lineas);
unset($importe_recargo_totales_lineas);

$result = $conn->query("UPDATE documentos_".$ejercicio."_recibos SET 
                        pagado=1,
                        fecha_pago='".date("Y-m-d")."',
                        hora_pago='".date("H:i:s")."',
                        documento_bancario='".addslashes($documento_bancario)."',
                        vencimiento_documento_bancario='".$vencimiento_documento_bancario."',
                        nota='".addslashes($nota)."',
                        id_banco_caja_ingreso='".$id_banco_cobro."',
                        id_metodo_pago='".$id_metodos_pago."',
                        id_usuario_pago='".$id_usuario."' 
                        WHERE id_documento = " . $nuevo_id_documento_1 . " AND numero_efecto='" . $numero_efecto . "' LIMIT 1");

$result = $conn->query("UPDATE documentos_".$ejercicio."_1 SET estado=2 WHERE id=" . $nuevo_id_documento_1 . " LIMIT 1");

$logs->resultado = "cobrado-parcial";
$logs->id_documento_1 = $nuevo_id_documento_1;
$logs->ejercicio = $ejercicio;

echo json_encode($logs);