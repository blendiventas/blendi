<?php
// documentos_2
$id_documento_2_original = $result_2[0]['id'];
$tipo_documento = $result_2[0]['tipo_documento'];
$tipo_librador = $result_2[0]['tipo_librador'];
$id_librador = $result_2[0]['id_librador'];
$slug = $result_2[0]['slug'];
$tipo_producto = $result_2[0]['tipo_producto'];
$fecha_entrega_desde = $result_2[0]['fecha_entrega_desde'];
$fecha_entrega_hasta = $result_2[0]['fecha_entrega_hasta'];
$id_producto = $result_2[0]['id_producto'];
$id_enlazado = $result_2[0]['id_productos_detalles_enlazado'];
$id_multiple = $result_2[0]['id_productos_detalles_multiples'];
$id_pack = $result_2[0]['id_packs'];
$id_productos_relacionados_grupos = $result_2[0]['id_productos_relacionados_grupos'];
$descripcion_productos_relacionados_grupos = stripslashes($result_2[0]['descripcion_productos_relacionados_grupos']);
$imagen_producto = stripslashes($result_2[0]['imagen_producto']);
$descripcion_producto = stripslashes($result_2[0]['descripcion_producto']);
$detalles_producto = stripslashes($result_2[0]['detalles_producto']);
$descripcion_oferta = stripslashes($result_2[0]['descripcion_oferta']);
$codigo_barras_producto = stripslashes($result_2[0]['codigo_barras_producto']);
$referencia_producto = stripslashes($result_2[0]['referencia_producto']);
$referencia_librador = stripslashes($result_2[0]['referencia_librador']);
$numero_serie = stripslashes($result_2[0]['numero_serie']);
$lote_producto = stripslashes($result_2[0]['lote']);
$caducidad = $result_2[0]['caducidad'];

$cantidad_original = $result_2[0]['cantidad']; // lo usamos para algumos calculos en otras tablas
$cantidad = $productos_nuevo_tiquet_cantidad[$key_nuevo_tiquet];
$cantidad_modificar = $result_2[0]['cantidad'] - $cantidad;
$id_unidades = $result_2[0]['id_unidades'];
$unidad_producto = $result_2[0]['unidad'];
$coste_producto_linea = $result_2[0]['coste'] * $cantidad;
$importe = $result_2[0]['importe'] * $cantidad;
$importe_fijo = $result_2[0]['fijo'];
$base_antes_descuento = $result_2[0]['importe'] * $cantidad;
$base_antes_descuento_modificar = $result_2[0]['importe'] * $cantidad_modificar;
$descuento_base = $result_2[0]['descuento_base'];

// calculos
$importe_descuento_base = $base_antes_descuento /100 * $descuento_base;
$base_despues_descuento = $base_antes_descuento - $importe_descuento_base;
$importe_iva = $base_despues_descuento / 100 * $result_2[0]['iva'];
$importe_recargo = 0;
if($result_2[0]['recargo'] != 0) {
    $importe_recargo = $base_despues_descuento / 100 * $result_2[0]['recargo'];
}
$total_linea = $base_despues_descuento + $importe_iva + $importe_recargo;
$descuento_total = 0;
$importe_descuento_total = 0;
$total_despues_descuento = $total_linea;
// datos a modificar
$importe_descuento_base_modificar = $base_antes_descuento_modificar /100 * $descuento_base;
$base_despues_descuento_modificar = $base_antes_descuento_modificar - $importe_descuento_base;
$importe_iva_modificar = $base_despues_descuento_modificar / 100 * $result_2[0]['iva'];
$importe_recargo_modificar = 0;
if($result_2[0]['recargo'] != 0) {
    $importe_recargo_modificar = $base_despues_descuento_modificar / 100 * $result_2[0]['recargo'];
}
$total_linea_modificar = $base_despues_descuento_modificar + $importe_iva_modificar + $importe_recargo_modificar;
$descuento_total_modificar = 0;
$importe_descuento_total_modificar = 0;
$total_despues_descuento_modificar = $total_linea_modificar;
// FIN calculos

$iva_aplicar = $result_2[0]['iva'];
$recargo_aplicar = $result_2[0]['recargo'];
$pvp_unidad = $result_2[0]['pvp_unidad'];
$pvp_unidad_sin_incrementos = $result_2[0]['pvp_unidad_sin_incrementos'];
$id_documento_anterior = $result_2[0]['id_documento_2_anterior'];
$id_vendedor = $result_2[0]['id_vendedor'];
$estado = $result_2[0]['estado'];
//$id_usuario = $result_2[0]['id_usuario'];
$orden = $result_2[0]['orden'];
$id_terminal = $result_2[0]['id_terminal'];

// observaciones
$result_observaciones = $conn->query("SELECT * FROM documentos_".$ejercicio."_observaciones WHERE id_documentos_2 = " . $valor_nuevo_tiquet . " LIMIT 1");
if($conn->registros() == 1) {
    $id_documentos_combo = $result_observaciones[0]['id_documentos_combo'];
    $observacion = stripslashes($result_observaciones[0]['observacion']);
}

if($tipo_producto == 2) {
    // productos relacionados (solo es necesario crear los registros para el nuevo documento, no afectan las cantidades)
    $result_productos_relacionados = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_2 = " . $valor_nuevo_tiquet);
    if ($conn->registros() >= 1) {
        foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
            $id_productos_relacionados[] = $valor_productos_relacionados['id'];
            $id_productos_relacionados_productos_relacionados[] = $valor_productos_relacionados['id_productos_relacionados'];
            $id_documentos_2_productos_relacionados[] = $valor_productos_relacionados['id_documentos_2'];
            $id_documentos_combo_productos_relacionados[] = $valor_productos_relacionados['id_documentos_combo'];
            $id_productos_detalles_enlazado_productos_relacionados[] = $valor_productos_relacionados['id_productos_detalles_enlazado'];
            $id_productos_detalles_multiples_productos_relacionados[] = $valor_productos_relacionados['id_productos_detalles_multiples'];
            $id_packs_productos_relacionados[] = $valor_productos_relacionados['id_packs'];
            $id_relacionado_productos_relacionados[] = $valor_productos_relacionados['id_relacionado'];
            $id_titulo_relacionado_productos_relacionados[] = $valor_productos_relacionados['id_titulo_relacionado'];
            $descripcion_productos_relacionados[] = $valor_productos_relacionados['descripcion'];
            $id_grupo_productos_relacionados[] = $valor_productos_relacionados['id_grupo'];
            $fijo_productos_relacionados[] = $valor_productos_relacionados['fijo'];
            $modelo_productos_relacionados[] = $valor_productos_relacionados['modelo'];
            $cantidad_con_productos_relacionados[] = $valor_productos_relacionados['cantidad_con'];
            $cantidad_mitad_productos_relacionados[] = $valor_productos_relacionados['cantidad_mitad'];
            $cantidad_sin_productos_relacionados[] = $valor_productos_relacionados['cantidad_sin'];
            $cantidad_doble_productos_relacionados[] = $valor_productos_relacionados['cantidad_doble'];
            $sumar_con_productos_relacionados[] = $valor_productos_relacionados['sumar_con'];
            $sumar_mitad_productos_relacionados[] = $valor_productos_relacionados['sumar_mitad'];
            $sumar_sin_productos_relacionados[] = $valor_productos_relacionados['sumar_sin'];
            $sumar_doble_productos_relacionados[] = $valor_productos_relacionados['sumar_doble'];
            $por_defecto_productos_relacionados[] = $valor_productos_relacionados['por_defecto'];
            $mostrar_productos_relacionados[] = $valor_productos_relacionados['mostrar'];
            $orden_productos_relacionados[] = $valor_productos_relacionados['orden'];
        }
    }
}
if($tipo_producto == 3) {
    // productos relacionados combo (solo es necesario crear los registros para el nuevo documento, no afectan las cantidades)
    $result_productos_relacionados_combo = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados_combo WHERE id_documentos_2 = " . $valor_nuevo_tiquet);
    if ($conn->registros() >= 1) {
        foreach ($result_productos_relacionados_combo as $key_productos_relacionados_combo => $valor_productos_relacionados_combo) {
            $id_productos_relacionados_combo[] = $valor_productos_relacionados_combo['id'];
            $id_documentos_2_productos_relacionados_combo[] = $valor_productos_relacionados_combo['id_documentos_2'];
            $id_productos_detalles_enlazado_productos_relacionados_combo[] = $valor_productos_relacionados_combo['id_productos_detalles_enlazado'];
            $id_productos_detalles_multiples_productos_relacionados_combo[] = $valor_productos_relacionados_combo['id_productos_detalles_multiples'];
            $id_packs_productos_relacionados_combo[] = $valor_productos_relacionados_combo['id_packs'];
            $id_relacionado_productos_relacionados_combo[] = $valor_productos_relacionados_combo['id_relacionado'];
            $id_grupo_productos_relacionados_combo[] = $valor_productos_relacionados_combo['id_grupo'];
            $fijo_productos_relacionados_combo[] = $valor_productos_relacionados_combo['fijo'];
            $cantidad_productos_relacionados_combo[] = $valor_productos_relacionados_combo['cantidad'];
            $sumar_productos_relacionados_combo[] = $valor_productos_relacionados_combo['sumar'];
            $mostrar_productos_relacionados_combo[] = $valor_productos_relacionados_combo['mostrar'];
            $orden_productos_relacionados_combo[] = $valor_productos_relacionados_combo['orden'];
        }
    }
}
if($tipo_producto == 1) {
    // productos relacionados elaborados (se deben tener en cuenta las cantidades)
    $result_productos_relacionados_elaborados = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados_elaborados WHERE id_documentos_2 = " . $valor_nuevo_tiquet);
    if ($conn->registros() >= 1) {
        foreach ($result_productos_relacionados_elaborados as $key_productos_relacionados_elaborados => $valor_productos_relacionados_elaborados) {
            $id_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['id'];
            $id_documentos_2_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['id_documentos_2'];
            $id_productos_detalles_enlazado_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['id_productos_detalles_enlazado'];
            $id_productos_detalles_multiples_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['id_productos_detalles_multiples'];
            $id_packs_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['id_packs'];
            $id_categoria_estadisticas_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['id_categoria_estadisticas'];
            $id_producto_relacionado_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['id_producto_relacionado'];
            $fijo_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['fijo'];
            $cantidad_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['cantidad'] / $cantidad_original;
            $cantidad_modificar_productos_relacionados_elaborados[] = ($valor_productos_relacionados_elaborados['cantidad'] / $cantidad_original) * $cantidad_modificar;
            $coste_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['coste'];
            $id_unidad_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['id_unidad'];
            $sumar_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['sumar'];
            $mostrar_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['mostrar'];
            $orden_productos_relacionados_elaborados[] = $valor_productos_relacionados_elaborados['orden'];
        }
    }
}
// productos sku stock (se deben tener en cuenta las cantidades)
$result_productos_sku_stock = $conn->query("SELECT * FROM documentos_".$ejercicio."_productos_sku_stock WHERE id_documento_2 = " . $valor_nuevo_tiquet);
if($conn->registros() >= 1) {
    foreach ($result_productos_sku_stock as $key_productos_sku_stock => $valor_productos_sku_stock) {
        $id_productos_sku_stock[] = $valor_productos_sku_stock['id'];
        $id_producto_productos_sku_stock[] = $valor_productos_sku_stock['id_producto'];
        $id_productos_sku_productos_sku_stock[] = $valor_productos_sku_stock['id_productos_sku'];
        $lote_productos_sku_stock[] = $valor_productos_sku_stock['lote'];
        $caducidad_productos_sku_stock[] = $valor_productos_sku_stock['caducidad'];
        $numero_serie_productos_sku_stock[] = $valor_productos_sku_stock['numero_serie'];
        $tipo_documento_productos_sku_stock[] = $valor_productos_sku_stock['tipo_documento'];
        $fecha_productos_sku_stock[] = $valor_productos_sku_stock['fecha'];
        $id_documento_1_productos_sku_stock[] = $valor_productos_sku_stock['id_documento_1'];
        $id_documento_2_productos_sku_stock[] = $valor_productos_sku_stock['id_documento_2'];
        $tipo_librador_productos_sku_stock[] = $valor_productos_sku_stock['tipo_librador'];
        $id_librador_productos_sku_stock[] = $valor_productos_sku_stock['id_librador'];
        $coste_productos_sku_stock[] = $valor_productos_sku_stock['coste'];
        $cantidad_productos_sku_stock[] = $valor_productos_sku_stock['cantidad'] / $cantidad_original;
        $cantidad_modificar_productos_sku_stock[] = ($valor_productos_sku_stock['cantidad'] / $cantidad_original) * $cantidad_modificar;
        $id_unidades_productos_sku_stock[] = $valor_productos_sku_stock['id_unidades'];
        $unidad_productos_sku_stock[] = $valor_productos_sku_stock['unidad'];
        $importe_productos_sku_stock[] = $valor_productos_sku_stock['importe'];
        $fecha_alta_productos_sku_stock[] = $valor_productos_sku_stock['fecha_alta'];
        $fecha_modificacion_productos_sku_stock[] = $valor_productos_sku_stock['fecha_modificacion'];
    }
}