<?php
if($accion == "eliminar-producto") {
    $logs->delete = "(".$id_linea.")DELETE FROM documentos_".$ejercicio."_2 WHERE id=".$id_documento_2." LIMIT 1";

    if(($tipo_documento == 'tiq') && $tipo_librador != 'pro' && $tipo_librador != 'cre') {
        $editado = false;
        if ($id_linea) {
            $result = $conn->query("SELECT id_producto FROM documentos_" . $ejercicio . "_2 WHERE id=" . $id_documento_2 . " LIMIT 1");
            if (isset($result[0]) && $result[0]['id_producto'] == $id_producto) {
                $editado = true;

                $result = $conn->query("SELECT estado FROM documentos_enviar_terminales WHERE id_documento_2=" . $id_documento_2 . " LIMIT 1");
                if ($conn->registros() == 1) {
                    if ($result[0]['estado'] != '-1') {
                        $result = $conn->query("UPDATE documentos_enviar_terminales SET hora_entrada='" . date("Y-m-d H:i:s") . "', alertar = 1 WHERE id_documento_2=" . $id_documento_2);
                    }
                }
            }
        }
        if (!$editado) {
            $result = $conn->query("SELECT estado FROM documentos_enviar_terminales WHERE id_documento_2=" . $id_documento_2 . " LIMIT 1");
            if ($conn->registros() == 1) {
                if ($result[0]['estado'] == '-1') {
                    $result = $conn->query("DELETE FROM documentos_enviar_terminales WHERE id_documento_2=" . $id_documento_2);
                } else {
                    $result = $conn->query("UPDATE documentos_enviar_terminales SET hora_entrada='" . date("Y-m-d H:i:s") . "', estado = 3 WHERE id_documento_2=" . $id_documento_2);
                }
            }
        }
    }

    $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_2 WHERE id=" . $id_documento_2 . " LIMIT 1");
    $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_observaciones WHERE id_documentos_2=" . $id_documento_2 . " LIMIT 1");
    $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_iva WHERE id_documentos_2=" . $id_documento_2);
    $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_productos_costes WHERE id_documentos_2=" . $id_documento_2 . " LIMIT 1");
    $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_2=" . $id_documento_2);
    $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_productos_relacionados_elaborados WHERE id_documentos_2=" . $id_documento_2);
    $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_productos_relacionados_combo WHERE id_documentos_2=" . $id_documento_2);
    $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_productos_sku_stock WHERE id_documento_2=" . $id_documento_2);
}

if($accion == "insertar-producto") {
    $logs->insert_2 = "INSERT INTO documentos_".$ejercicio."_2 VALUES(NULL,'".$id_documento_1."','".$tipo_documento."','".$tipo_librador."','".$id_librador."','".addslashes($slug)."','".$tipo_producto."','".date("Y-m-d")."','".$fecha_entrega_desde."','".$fecha_entrega_hasta."','".$id_producto."','".$id_enlazado."','".$id_multiple."','".$id_pack."','".$id_productos_relacionados_grupos."','".addslashes($descripcion_productos_relacionados_grupos)."','".addslashes($imagen_producto)."','".addslashes($descripcion_producto)."','".addslashes($detalles_producto)."','".addslashes($descripcion_oferta)."','".addslashes($codigo_barras_producto)."','".addslashes($referencia_producto)."','".addslashes($referencia_librador)."','".addslashes($numero_serie_producto)."','".addslashes($lote_producto)."','".$caducidad_producto."','".$cantidad."','".$id_unidades."','".$unidad_producto."','".$coste_producto_linea."','".$importe."','".$importe_fijo."','".$base_antes_descuento."','".$descuento_base."','".$importe_descuento_base."','".$base_despues_descuento."','".$iva_aplicar."','".$importe_iva."','".$recargo_aplicar."','".$importe_recargo."','".$pvp_unidad."','".$pvp_unidad_sin_incrementos."','".$total_linea."','".$descuento_total."','".$importe_descuento_total."','".$total_despues_descuento."','".$id_documento_anterior."','".$id_vendedor."','".$estado."','".$id_usuario."','".$orden."','".date("H:i:s")."','".$id_terminal."')";

    if (empty($codigo_barras_producto) && !empty($id_producto) && ($tipo_documento == 'alb' || $tipo_documento == 'fac') && ($tipo_librador == 'pro' || $tipo_librador == 'cre')) {
        $result_productos_sku = $conn->query("SELECT id,codigo_barras 
                               FROM productos_sku WHERE 
                               id_producto=" . $id_producto . " LIMIT 1");
        if ($conn->registros() >= 1) {
            $codigo_barras_producto = stripslashes($result_productos_sku[0]['codigo_barras']);
            $id_productos_sku = $result_productos_sku[0]['id'];
        } else {
            $conn->query("INSERT INTO productos_sku VALUES(
                                NULL,
                                ".$id_producto.",
                                '0',
	                            '0',
	                            '0',
	                            '',
	                            '',
	                            '0.000',
                                '" . date('Y-m-d') . "',
	                            '" . date('Y-m-d') . "',
                );");
            $codigo_barras_producto = '';
            $id_productos_sku = $conn->id_insert();
        }

        if (empty($codigo_barras_producto)) {
            $codigo_barras_producto = str_repeat("0", 11 - strlen($id_productos_sku)) . $id_productos_sku;
            $conn->query("UPDATE productos_sku SET codigo_barras = '" . $codigo_barras_producto . "' WHERE id = " . $id_productos_sku . ";");
        }
    }

    $result = $conn->query("INSERT INTO documentos_".$ejercicio."_2 VALUES(
        NULL,
        '".$id_documento_1."',
        '".$tipo_documento."',
        '".$tipo_librador."',
        '".$id_librador."',
        '".addslashes($slug)."',
        '".$tipo_producto."',
        '".date("Y-m-d")."',
        '".$fecha_entrega_desde."',
        '".$fecha_entrega_hasta."',
        '".$id_producto."',
        '".$id_enlazado."',
        '".$id_multiple."',
        '".$id_pack."',
        '".$id_productos_relacionados_grupos."',
        '".addslashes($descripcion_productos_relacionados_grupos)."',
        '".addslashes($imagen_producto)."',
        '".addslashes($descripcion_producto)."',
        '".addslashes($detalles_producto)."',
        '".addslashes($descripcion_oferta)."',
        '".addslashes($codigo_barras_producto)."',
        '".addslashes($referencia_producto)."',
        '".addslashes($referencia_librador)."',
        '".addslashes($numero_serie_producto)."',
        '".addslashes($lote_producto)."',
        '".$caducidad_producto."',
        '".number_format($cantidad, 5,".", "")."',
        '".$id_unidades."',
        '".$unidad_producto."',
        '".number_format($coste_producto_linea, 5,".", "")."',
        '".number_format($importe, 5,".", "")."',
        '".number_format($importe_fijo, 5,".", "")."',
        '".number_format($base_antes_descuento, 5,".", "")."',
        '".$descuento_base."',
        '".number_format($importe_descuento_base, 5,".", "")."',
        '".number_format($base_despues_descuento, 5,".", "")."',
        '".$iva_aplicar."',
        '".number_format($importe_iva, 5,".", "")."',
        '".$recargo_aplicar."',
        '".number_format($importe_recargo, 5,".", "")."',
        '".number_format($pvp_unidad, $decimales_importes,".", "")."',
        '".number_format($pvp_unidad_sin_incrementos, 5,".", "")."',
        '".number_format($total_linea, $decimales_importes,".", "")."',
        '".$descuento_total."',
        '".number_format($importe_descuento_total, 5,".", "")."',
        '".number_format($total_despues_descuento, 5,".", "")."',
        '".$id_documento_anterior."',
        '".$id_vendedor."',
        '".$estado."',
        '".$id_usuario."',
        '".$orden."',
        '".date("H:i:s")."',
        '".$id_terminal."')");

    $id_documento_2 = $conn->id_insert();
    if(empty($id_documento_2_original)) {
        $id_documento_2_original = $id_documento_2;
    }

    $result = $conn->query("SELECT * FROM productos_costes WHERE id_producto='".$id_producto."' LIMIT 1");
    if($conn->registros() == 1) {
        $result_insert = $conn->query("INSERT INTO documentos_".$ejercicio."_productos_costes VALUES(
        NULL,
        '".$id_documento_2."',
        '".$result[0]['cantidad_base'] * $cantidad."',
        '".$result[0]['id_unidades_base']."',
        '".$result[0]['rentabilidad']."',
        '".$result[0]['id_categoria_elaborados']."',
        '".$result[0]['tiempo']."',
        '".$coste_producto_linea."')");
    }

    $result = $conn->query("INSERT INTO documentos_".$ejercicio."_iva VALUES(
        NULL,
        '".$id_documento_1."',
        '".$id_documento_2."',
        '".number_format($base_despues_descuento, $decimales_importes,".", "")."',
        '".$iva_aplicar."',
        '".number_format($importe_iva, $decimales_importes,".", "")."',
        '".$recargo_aplicar."',
        '".number_format($importe_recargo, $decimales_importes,".", "")."')");

    if(($tipo_documento == 'tiq') && $tipo_librador != 'pro' && $tipo_librador != 'cre') {
        $id_terminal_producto = 0;
        $result_terminal_producto = $conn->query("SELECT enviar FROM productos_otros WHERE id_producto='" . $id_producto . "' LIMIT 1");
        if ($conn->registros() == 1) {
            $id_terminal_producto = $result_terminal_producto[0]['enviar'];

            $result_datos_terminal_producto = $conn->query("SELECT * FROM documentos_enviar_terminales WHERE id_documento_1='".$id_documento_1."' AND id_documento_2='".$id_documento_2_original."' AND id_producto='" . $id_producto . "' LIMIT 1");
            if($conn->registros() == 1) {
                $result = $conn->query("UPDATE documentos_enviar_terminales SET 
                                    hora_entrada='" . date("Y-m-d H:i:s") . "',
                                    cantidad='" . number_format($cantidad, 5, ".", "") . "',
                                    id_documento_2 = ". $id_documento_2 . " 
                                    WHERE id='" . $result_datos_terminal_producto[0]['id'] . "' LIMIT 1");
            }else {
                $result = $conn->query("INSERT INTO documentos_enviar_terminales VALUES(
                                    NULL,
                                    '" . $id_documento_1 . "',
                                    '" . $id_documento_2 . "',
                                    0,
                                    '" . $id_producto . "',
                                    '" . number_format($cantidad, 5, ".", "") . "',
                                    '-1',
                                    '0',
                                    '" . date("Y-m-d H:i:s") . "',
                                    '0000-00-00 00:00:00',
                                    '0000-00-00 00:00:00',
                                    '" . $id_terminal_producto . "')");
            }
        }
    }

    if(!isset($valor_nuevo_tiquet)) {
        $datosRegistroStock = [];
        $datosRegistroStock['ejercicio'] = $ejercicio;
        $datosRegistroStock['tipo_documento'] = $tipo_documento;
        $datosRegistroStock['id_documento_1'] = $id_documento_1;
        $datosRegistroStock['id_documento_2'] = $id_documento_2;
        $datosRegistroStock['tipo_librador'] = $tipo_librador;
        $datosRegistroStock['id_librador'] = $id_librador;
        $datosRegistroStock['conn'] = $conn;
        $datosRegistroStock['id_producto'] = $id_producto;
        $datosRegistroStock['id_productos_detalles_enlazado'] = $id_enlazado;
        $datosRegistroStock['id_productos_detalles_multiples'] = $id_multiple;
        $datosRegistroStock['id_packs'] = $id_pack;
        $datosRegistroStock['id_productos_sku'] = $id_productos_sku;
        $datosRegistroStock['lote_producto'] = $lote_producto;
        $datosRegistroStock['caducidad_producto'] = $caducidad_producto;
        $datosRegistroStock['numero_serie_producto'] = $numero_serie_producto;
        $datosRegistroStock['codigo_barras'] = $codigo_barras_producto;
        $datosRegistroStock['coste_producto_linea'] = $coste_producto_linea;
        $datosRegistroStock['id_unidades'] = $id_unidades;
        $datosRegistroStock['unidad_producto'] = $unidad_producto;
        $datosRegistroStock['importe'] = $pvp_unidad_sin_incrementos / (1 + ($iva_aplicar / 100));
        $datosRegistroStock['cantidad'] = $cantidad;
        registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $id_producto, []);
        unset($datosRegistroStock['codigo_barras']);
    }
}else if($accion == "modificar-producto") {
    $logs->update_2 = "UPDATE documentos_".$ejercicio."_2 SET 
        fecha='".date("Y-m-d")."',
        id_producto='".$id_producto."',
        id_productos_detalles_enlazado='".$id_enlazado."',
        id_productos_detalles_multiples='".$id_multiple."',
        id_packs='".$id_pack."',
        cantidad='".number_format($cantidad, $decimales_cantidades,".", "")."',
        id_unidades='".$id_unidades."',
        unidad='".$unidad_producto."',
        coste='".number_format($coste_producto_linea, 5,".", "")."',
        importe='".number_format($importe, 5,".", "")."',
        fijo='".number_format($importe_fijo, 5,".", "")."',
        base_antes_descuento='".number_format($base_antes_descuento, 5,".", "")."',
        descuento_base='".$descuento_base."',
        importe_descuento_base='".number_format($importe_descuento_base, 5,".", "")."',
        base_despues_descuento='".number_format($base_despues_descuento, 5,".", "")."',
        iva='".$iva_aplicar."',
        importe_iva='".number_format($importe_iva, 5,".", "")."',
        recargo='".$recargo_aplicar."',
        importe_recargo='".number_format($importe_recargo, 5,".", "")."',
        pvp_unidad='".number_format($pvp_unidad, 5,".", "")."',
        pvp_unidad_sin_incrementos='".number_format($pvp_unidad_sin_incrementos, 5,".", "")."',
        total_antes_descuento='".number_format($total_linea, 5,".", "")."',
        descuento_total='".$descuento_total."',
        importe_descuento_total='".number_format($importe_descuento_total, 5,".", "")."',
        total_despues_descuento='".number_format($total_despues_descuento, 5,".", "")."',
        id_vendedor='".$id_vendedor."',
        estado='".$estado."',
        id_usuario='".$id_usuario."',
        orden='".$orden."',
        hora='".date("H:i:s")."',
        id_terminal='".$id_terminal."' 
        WHERE id='".$id_documento_2."' LIMIT 1";

    $result = $conn->query("UPDATE documentos_".$ejercicio."_2 SET 
        fecha='".date("Y-m-d")."',
        id_producto='".$id_producto."',
        id_productos_detalles_enlazado='".$id_enlazado."',
        id_productos_detalles_multiples='".$id_multiple."',
        id_packs='".$id_pack."',
            cantidad='".number_format($cantidad, $decimales_cantidades,".", "")."',
        id_unidades='".$id_unidades."',
        unidad='".$unidad_producto."',
        coste='".number_format($coste_producto_linea, 5,".", "")."',
        importe='".number_format($importe, 5,".", "")."',
        fijo='".number_format($importe_fijo, 5,".", "")."',
        base_antes_descuento='".number_format($base_antes_descuento, 5,".", "")."',
        descuento_base='".$descuento_base."',
        importe_descuento_base='".number_format($importe_descuento_base, 5,".", "")."',
        base_despues_descuento='".number_format($base_despues_descuento, 5,".", "")."',
        iva='".$iva_aplicar."',
        importe_iva='".number_format($importe_iva, 5,".", "")."',
        recargo='".$recargo_aplicar."',
        importe_recargo='".number_format($importe_recargo, 5,".", "")."',
        pvp_unidad='".number_format($pvp_unidad, 5,".", "")."',
        pvp_unidad_sin_incrementos='".number_format($pvp_unidad_sin_incrementos, 5,".", "")."',
        total_antes_descuento='".number_format($total_linea, 5,".", "")."',
        descuento_total='".$descuento_total."',
        importe_descuento_total='".number_format($importe_descuento_total, 5,".", "")."',
        total_despues_descuento='".number_format($total_despues_descuento, 5,".", "")."',
        id_vendedor='".$id_vendedor."',
        estado='".$estado."',
        id_usuario='".$id_usuario."',
        orden='".$orden."',
        hora='".date("H:i:s")."',
        id_terminal='".$id_terminal."' 
        WHERE id='".$id_documento_2."' LIMIT 1");

    $logs->update_3 = "UPDATE documentos_".$ejercicio."_iva SET 
        base='".number_format($base_despues_descuento, 5,".", "")."',
        iva='".$iva_aplicar."',
        importe_iva='".number_format($importe_iva, 5,".", "")."',
        recargo='".$recargo_aplicar."',
        importe_recargo='".number_format($importe_recargo, 5,".", "")."' 
        WHERE id_documentos_1='".$id_documento_1."' AND id_documentos_2='".$id_documento_2."' LIMIT 1";
    $result = $conn->query("UPDATE documentos_".$ejercicio."_iva SET 
        base='".number_format($base_despues_descuento, 5,".", "")."',
        iva='".$iva_aplicar."',
        importe_iva='".number_format($importe_iva, 5,".", "")."',
        recargo='".$recargo_aplicar."',
        importe_recargo='".number_format($importe_recargo, 5,".", "")."' 
        WHERE id_documentos_1='".$id_documento_1."' AND id_documentos_2='".$id_documento_2."' LIMIT 1");

    /*$logs->update_4 = "UPDATE documentos_".$ejercicio."_productos_sku_stock SET
                                       lote='".$lote_producto."',
                                       caducidad='".$caducidad_producto."',
                                       numero_serie='".$numero_serie_producto."',
                                       codigo_barras='".$codigo_barras_producto."',
                                       tipo_documento='".$tipo_documento."',
                                       tipo_librador='".$tipo_librador."',
                                       id_librador='".$id_librador."',
                                       coste='".number_format($coste_producto_linea, 5,".", "")."',
                                       cantidad='".number_format($cantidad, $decimales_cantidades,".", "")."',
                                       id_unidades='".$id_unidades."',
                                       unidad='".$unidad_producto."',
                                       importe='".number_format($importe, 5,".", "")."',
                                       fecha_modificacion='".date("Y-m-d")."' WHERE id_documento_2='".$id_documento_2."' LIMIT 1";
    $result = $conn->query("UPDATE documentos_".$ejercicio."_productos_sku_stock SET
                                       lote='".$lote_producto."',
                                       caducidad='".$caducidad_producto."',
                                       numero_serie='".$numero_serie_producto."',
                                       codigo_barras='".$codigo_barras_producto."',
                                       tipo_documento='".$tipo_documento."',
                                       tipo_librador='".$tipo_librador."',
                                       id_librador='".$id_librador."',
                                       coste='".number_format($coste_producto_linea, 5,".", "")."',
                                       cantidad='".number_format($cantidad, $decimales_cantidades,".", "")."',
                                       id_unidades='".$id_unidades."',
                                       unidad='".$unidad_producto."',
                                       importe='".number_format($importe, 5,".", "")."',
                                       fecha_modificacion='".date("Y-m-d")."' WHERE id_documento_2='".$id_documento_2."' LIMIT 1");*/
}

if($tipo_librador == "pro" || $tipo_librador == "cre") {
    $result = $conn->query("UPDATE productos SET 
        coste='" . number_format($coste_producto_linea, $decimales_importes,".", "") . "'  
        WHERE id='" . $id_producto . "' LIMIT 1");
}