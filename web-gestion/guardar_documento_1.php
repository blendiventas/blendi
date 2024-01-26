<?php
$estado_documento = 0;
$importe_sumar_recibo = 0;
if(!empty($id_documento_1)) {
    $result_1 = $conn->query("SELECT total,estado FROM documentos_".$ejercicio."_1 WHERE id='" . $id_documento_1 . "' LIMIT 1");
    $total_documento = $result_1[0]['total'];
    $estado_documento = $result_1[0]['estado'];
    if($estado_documento == 1) {
        $importe_sumar_recibo = $total - $total_documento;
    }
}
if(($tipo_documento == "fac" || $tipo_documento == "tiq") && $estado_documento == 0) {
    if(!empty($id_modalidad_pago)) {
        $logs->recibos = "SELECT dias,porcentaje FROM modalidades_pago_lineas WHERE id_forma_pago='" . $id_modalidad_pago . "' ORDER BY dias";
        $result_modalidades_pago_lineas = $conn->query("SELECT dias,porcentaje FROM modalidades_pago_lineas WHERE id_forma_pago='" . $id_modalidad_pago . "' ORDER BY dias");
        foreach ($result_modalidades_pago_lineas as $key_modalidades_pago_lineas => $valor_modalidades_pago_lineas) {
            if ($total != 0) {
                $suma_importe_recibos = ($total / 100) * $valor_modalidades_pago_lineas['porcentaje'];
            } else {
                $suma_importe_recibos = 0;
            }
            $importe_recibos[] = number_format($suma_importe_recibos, 2, ".", "");
            $fecha_recibo = date("d-m-Y", strtotime($fecha_documento . "+ " . $valor_modalidades_pago_lineas['dias'] . " days"));
            $dias_recibos[] = DateTime::createFromFormat('d-m-Y', $fecha_recibo)->format('Y-m-d');
        }
        if (isset($importe_recibos) && count($importe_recibos) > 1) {
            // INICIO Cuadramos los importes
            $suma_importe_recibos = 0;
            foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
                $suma_importe_recibos += $valor_importe_recibos;
            }
            $diferencia_importe_recibos = $total - $suma_importe_recibos;
            if (!empty($diferencia_importe_recibos)) {
                $importe_recibos[0] = $importe_recibos[0] + $diferencia_importe_recibos;
            }
            // FINAL Cuadramos los importes
        }
    }else {
        if ($total != 0) {
            $suma_importe_recibos = $total;
        } else {
            $suma_importe_recibos = 0;
        }
        $importe_recibos[] = number_format($suma_importe_recibos, 2, ".", "");
        $fecha_recibo = $fecha_documento;
        $dias_recibos[] = $fecha_recibo;
    }
}
if(empty($id_documento_1)) {
    if(($tipo_librador == "cli" OR $tipo_librador == "tak" OR $tipo_librador == "del" OR $tipo_librador == "mes") && empty($numero_documento)) {
        $conn->query("LOCK TABLES documentos_numeraciones WRITE");
        $result = $conn->query("SELECT id,numero FROM documentos_numeraciones WHERE 
                                                 tipo_documento='".$tipo_documento."' AND 
                                                 ejercicio='".$ejercicio."' AND 
                                                 serie='".$serie_documento."' LIMIT 1");
        $numero_documento = $result[0]['numero'] + 1;
        $result = $conn->query("UPDATE documentos_numeraciones SET numero='".$numero_documento."' WHERE id='".$result[0]['id']."' LIMIT 1");
        $conn->query("UNLOCK TABLES");
    }
    $datos .= "Número documento despues: ".$numero_documento."\r\n";

    $numero_registro = 'NULL';
    if (($tipo_librador == "pro" || $tipo_librador == "cre") && $tipo_documento == "fac") {
        $result = $conn->query("SELECT numero_registro FROM documentos_".$ejercicio."_1 WHERE 
                                                 numero_registro IS NOT NULL ORDER BY id DESC LIMIT 1");
        if ($conn->registros() > 0) {
            $numero_registro = $result[0]['numero_registro'] + 1;
        } else {
            $numero_registro = 1;
        }
    }

    $result = $conn->query("INSERT INTO documentos_".$ejercicio."_1 VALUES(
            NULL,
            '".$id_sesion."',
            '".$ip."',
            '".$so."',
            '".addslashes($tipo_documento)."',
            '".addslashes($interface)."',
            '".addslashes($tipo_librador)."',
            '".$id_librador."',
            '".$fecha_documento."',
            '".date('Y-m-d')."',
            '".$fecha_entrega_desde."',
            '".$fecha_entrega_hasta."',
            ".$numero_registro.",
            '".addslashes($numero_documento)."',
            '".addslashes($serie_documento)."',
            '".addslashes($modalidad_pago)."',
            '".addslashes($modalidad_envio)."',
            '".addslashes($modalidad_entrega)."',
            '".$irpf_librador."',
            '".number_format($importe_irpf, $decimales_importes,".", "")."',
            '".$descuento_pp."',
            '".number_format($importe_descuento_pp, $decimales_importes,".", "")."',
            '".$descuento_librador."',
            '".number_format($importe_descuento_librador, $decimales_importes,".", "")."',
            '".number_format($base_total, $decimales_importes,".", "")."',
            '".number_format($total, $decimales_importes,".", "")."',
            '".$estado."',
            '1',
            '".$entregado."',
            '".$id_usuario."',
            '".$comensales."',
            '".date("H:i:s")."',
            '00:00:00',
            '".$id_terminal."')");

    $id_documento_1 = $conn->id_insert();
    if (!isset($_SESSION[$id_sesion_js]))
    {
        $_SESSION[$id_sesion_js] = [];
    }
    $_SESSION[$id_sesion_js]["id_documento"] = $id_documento_1;

    $numero_efecto = 0;
    $logs->recibo = "INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(NULL,'" . $id_documento_1 . "','" . addslashes($tipo_documento) . "','" . $id_librador . "','" . $valor_importe_recibos . "','" . $fecha_documento . "','" . $dias_recibos[$key_importe_recibos] . "','0','','','0','0','" . $id_modalidad_pago . "','XXX','0','0','',NULL,'')";
    foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
        $logs->recibosEntra = "ENTRA A INSERT RECIBOS";
        $numero_efecto += 1;
        $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(
            NULL,
            '" . $id_documento_1 . "',
            '" . addslashes($tipo_documento) . "',
            '" . $id_librador . "',
            '" . $valor_importe_recibos . "',
            '" . $fecha_documento . "',
            '" . $dias_recibos[$key_importe_recibos] . "',
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
    }
}else{
    if($accion == "eliminar-producto") {
        $logs->update_1 = "UPDATE documentos_" . $ejercicio . "_1 SET 
                importe_irpf='" . number_format($importe_irpf, $decimales_importes,".", "") . "',
                importe_descuento_pp='" . number_format($importe_descuento_pp, $decimales_importes,".", "") . "',
                importe_descuento_librador='" . number_format($importe_descuento_librador, $decimales_importes,".", "") . "',
                base='" . number_format($base_total, $decimales_importes,".", "") . "',
                total='" . number_format($total, $decimales_importes,".", "") . "' 
                WHERE id=" . $id_documento_1 . " LIMIT 1";

        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_1 SET 
                importe_irpf='" . number_format($importe_irpf, $decimales_importes,".", "") . "',
                importe_descuento_pp='" . number_format($importe_descuento_pp, $decimales_importes,".", "") . "',
                importe_descuento_librador='" . number_format($importe_descuento_librador, $decimales_importes,".", "") . "',
                base='" . number_format($base_total, $decimales_importes,".", "") . "',
                total='" . number_format($total, $decimales_importes,".", "") . "' 
                WHERE id=" . $id_documento_1 . " LIMIT 1");
    }else {
        if(($tipo_librador == "cli" OR $tipo_librador == "tak" OR $tipo_librador == "del" OR $tipo_librador == "mes") && empty($numero_documento)) {
            $datos .= "ENTRA\r\n";
            $conn->query("LOCK TABLES documentos_numeraciones WRITE");
            $result = $conn->query("SELECT id,numero FROM documentos_numeraciones WHERE 
                                                 tipo_documento='".$tipo_documento."' AND 
                                                 ejercicio='".$ejercicio."' AND 
                                                 serie='".$serie_documento."' LIMIT 1");
            $numero_documento = $result[0]['numero'] + 1;
            $result = $conn->query("UPDATE documentos_numeraciones SET numero='".$numero_documento."' WHERE id='".$result[0]['id']."' LIMIT 1");
            $conn->query("UNLOCK TABLES");
        }else {
            $datos .= "NO ENTRA\r\n";
        }

        $comensalesSQL = ($comensales)? "comensales='" . $comensales . "'," : '';
        $logs->update_1 = "UPDATE documentos_" . $ejercicio . "_1 SET 
                id_librador='" . $id_librador . "',
                fecha_entrega_desde='" . $fecha_entrega_desde . "',
                fecha_entrega_hasta='" . $fecha_entrega_hasta . "',
                numero_documento='" . addslashes($numero_documento) . "',
                serie_documento='" . addslashes($serie_documento) . "',
                modalidad_pago='" . addslashes($modalidad_pago) . "',
                modalidad_envio='" . addslashes($modalidad_envio) . "',
                modalidad_entrega='" . addslashes($modalidad_entrega) . "',
                irpf='" . $irpf_librador . "',
                importe_irpf='" . number_format($importe_irpf, $decimales_importes,".", "") . "',
                importe_descuento_pp='" . number_format($importe_descuento_pp, $decimales_importes,".", "") . "',
                importe_descuento_librador='" . number_format($importe_descuento_librador, $decimales_importes,".", "") . "',
                base='" . number_format($base_total, $decimales_importes,".", "") . "',
                total='" . number_format($total, $decimales_importes,".", "") . "',
                id_usuario='" . $id_usuario . "',
                " . $comensalesSQL . "
                id_terminal='" . $id_terminal . "' 
                WHERE id=" . $id_documento_1 . " LIMIT 1";

        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_1 SET 
                id_librador='" . $id_librador . "',
                fecha_entrega_desde='" . $fecha_entrega_desde . "',
                fecha_entrega_hasta='" . $fecha_entrega_hasta . "',
                numero_documento='" . addslashes($numero_documento) . "',
                serie_documento='" . addslashes($serie_documento) . "',
                modalidad_pago='" . addslashes($modalidad_pago) . "',
                modalidad_envio='" . addslashes($modalidad_envio) . "',
                modalidad_entrega='" . addslashes($modalidad_entrega) . "',
                irpf='" . $irpf_librador . "',
                importe_irpf='" . number_format($importe_irpf, $decimales_importes,".", "") . "',
                importe_descuento_pp='" . number_format($importe_descuento_pp, $decimales_importes,".", "") . "',
                importe_descuento_librador='" . number_format($importe_descuento_librador, $decimales_importes,".", "") . "',
                base='" . number_format($base_total, $decimales_importes,".", "") . "',
                total='" . number_format($total, $decimales_importes,".", "") . "',
                id_usuario='" . $id_usuario . "',
                " . $comensalesSQL . "
                id_terminal='" . $id_terminal . "' 
                WHERE id=" . $id_documento_1 . " LIMIT 1");
    }
    if($tipo_documento == "fac" || $tipo_documento == "tiq") {
        $result = $conn->query("SELECT id FROM documentos_" . $ejercicio . "_recibos WHERE id_documento=" . $id_documento_1 . " AND pagado=0 ORDER BY numero_efecto DESC LIMIT 1");
        if ($conn->registros() == 1) {
            if (count($importe_recibos) > 0 && $estado_documento == 0) {
                foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
                    $result = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET 
                    importe='" . $valor_importe_recibos . "' 
                    WHERE id='" . $result[0]['id'] . "' LIMIT 1");
                }
            } else {
                if(!empty($importe_sumar_recibo)) {
                    $result = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET 
                    importe=importe + " . $importe_sumar_recibo . " 
                    WHERE id='" . $result[0]['id'] . "' LIMIT 1");
                }else {
                    $result = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET 
                    importe='" . $total . "' 
                    WHERE id='" . $result[0]['id'] . "' LIMIT 1");
                }
            }
        } else {
            $numero_efecto = 0;
            foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
                $logs->insert_recibo = "INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(NULL,'" . $id_documento_1 . "','" . addslashes($tipo_documento) . "','" . $id_librador . "','" . $valor_importe_recibos . "','" . $fecha_documento . "','" . $dias_recibos[$key_importe_recibos] . "','0','','','0','0','" . $id_modalidad_pago . "','" . $numero_efecto . "','0','0','',NULL,'')";
                $numero_efecto += 1;
                $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(
                    NULL,
                    '" . $id_documento_1 . "',
                    '" . addslashes($tipo_documento) . "',
                    '" . $id_librador . "',
                    '" . $valor_importe_recibos . "',
                    '" . $fecha_documento . "',
                    '" . $dias_recibos[$key_importe_recibos] . "',
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
            }
        }
    }
}
if(isset($importe_recibos)) {
    unset($importe_recibos);
    unset($dias_recibos);
}