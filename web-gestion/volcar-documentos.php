<?php
header('Content-Type: application/json');
session_start();

$interface = (isset($_POST['interface_js']))? $_POST['interface_js'] : 'web';

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

if($interface == "tpv") {
    $id_sesion_sys = $_POST['id_sesion'];
    $ip_sys = $_POST['ip'];
    $id_idioma_sys = $_POST['id_idioma'];
    $idioma_sys = $_POST['idioma'];
    $ejercicio = $_POST['ejercicio'];

    // ESTE CODIGO ASEGURA QUE LA ID DEL PANEL ES LA DE LA SESION Y IP IDENTIFICADA.
    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");
    $result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel = $result[0]['id_panel'];
    } else {
        throw new Exception("Acceso no permitido.");
    }
    unset($conn);

    $tipoOrigen = $_POST['tipo_origen'];
    $tipoVolcado = $_POST['tipo_volcado'];
    $tipoLibrador = $_POST['tipo_librador'];
    $fecha = $_POST['fecha'];
    if ($tipoLibrador == 'cli') {
        $serie = $_POST['serie'];
    } else {
        $numeroDocumento = $_POST['numero_documento'];
    }

    $documentosAVolcar = json_decode($_POST['documentos_a_volcar']);
} else {
    // post: tienda
    $tienda = $_POST['tienda'];

    $idioma_sys = 'es/'; /* - */
    $id_idioma_sys = 4; /* - */
    $ejercicio = date('Y');
    $interface = 'web';

    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");

    $result = $conn->query("SELECT id,sector FROM identificacion_panel WHERE web_blendi='" . addslashes($tienda) . "' LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel = $result[0]['id'];
        $sector = $result[0]['sector'];
    } else {
        throw new Exception('Negocio no encontrado.');
    }
    unset($conn);

    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");

    $id_sesion_js = 'temp'; /* - */
    if(empty($_SESSION[$id_sesion_js]['id_documento'])){
        throw new Exception('Documento no encontrado.');
    } else {
        $id_documento_1 = $_SESSION[$id_sesion_js]['id_documento'];
    }

    $newDocumentoAVolcar = new stdClass();
    $newDocumentoAVolcar->id = $id_documento_1;
    $newDocumentoAVolcar->ejercicio = 'temp';
    $newDocumentoAVolcar->lineas = [];
    $result_documento_2 = $conn->query("SELECT * FROM documentos_" . $newDocumentoAVolcar->ejercicio . "_2 WHERE id_documentos_1 = " . $newDocumentoAVolcar->id);
    if ($conn->registros() >= 1) {
        foreach ($result_documento_2 as $linea_documento_2) {
            $newDocumentoAVolcar_linea = new stdClass();
            $newDocumentoAVolcar_linea->id = $linea_documento_2['id'];
            $newDocumentoAVolcar_linea->cantidad = $linea_documento_2['cantidad'];
            $newDocumentoAVolcar_linea->lote = '';
            $newDocumentoAVolcar_linea->caducidad = '';
            $newDocumentoAVolcar_linea->numero_serie = '';

            $newDocumentoAVolcar->lineas[] = $newDocumentoAVolcar_linea;
        }
    }

    $documentosAVolcar = [$newDocumentoAVolcar];
    $tipoOrigen = 'ped';
    $tipoVolcado = 'ped';
    $tipoLibrador = 'cli';
    $fecha = date('Y-m-d H:i:s');
    $serie = '-1';
}

if (!count($documentosAVolcar)) {
    throw new Exception('No hay documentos a volcar.');
}

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$lastIdLibrador = null;
$libradoresVolcados = [];
foreach ($documentosAVolcar as $documentoAVolcar) {
    $result_origen_documento_1 = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_1 WHERE id = " . $documentoAVolcar->id . " LIMIT 1");

    if ($conn->registros() >= 1 && count($documentoAVolcar->lineas)) {
        // En los proveedores y creditores se volcan documentos de un librador en un librador
        if ($lastIdLibrador && ($tipoLibrador == 'pro' || $tipoLibrador == 'cre')) {
            continue;
        }
        // Todos los documentos del mismo librador se vuelcan en un único documento
        if (in_array($result_origen_documento_1[0]['id_librador'], $libradoresVolcados)) {
            continue;
        }
        $lastIdLibrador = $result_origen_documento_1[0]['id_librador'];
        $libradoresVolcados[] = $result_origen_documento_1[0]['id_librador'];
        if ($tipoLibrador == 'cli') {
            if ($serie == '-1') {
                $serie_documento = '';
            } else {
                $result = $conn->query("SELECT serie FROM documentos_numeraciones_series WHERE id='".$serie."' LIMIT 1");
                $serie_documento = stripslashes($result[0]['serie']);
            }

            $conn->query("LOCK TABLES documentos_numeraciones WRITE");
            $result = $conn->query("SELECT id,numero FROM documentos_numeraciones WHERE 
                                                 tipo_documento='".addslashes($tipoVolcado)."' AND 
                                                 ejercicio='".$ejercicio."' AND 
                                                 serie='".$serie_documento."' LIMIT 1");
            $numeroDocumento = $result[0]['numero'] + 1;
            $result = $conn->query("UPDATE documentos_numeraciones SET numero='".$numeroDocumento."' WHERE id='".$result[0]['id']."' LIMIT 1");
            $conn->query("UNLOCK TABLES");
        } else {
            $serie_documento = '';
        }

        $numero_registro = 'NULL';
        if (($tipoLibrador == "pro" || $tipoLibrador == "cre") && $tipoVolcado == "fac") {
            $result = $conn->query("SELECT numero_registro FROM documentos_".$ejercicio."_1 WHERE 
                                                 numero_registro IS NOT NULL ORDER BY id DESC LIMIT 1");
            if ($conn->registros() > 0) {
                $numero_registro = $result[0]['numero_registro'] + 1;
            } else {
                $numero_registro = 1;
            }
        }

        $conn->query("INSERT INTO documentos_" . $ejercicio . "_1 VALUES(
            NULL,
            '" . $result_origen_documento_1[0]['id_sesion'] . "',
            '" . $result_origen_documento_1[0]['ip'] . "',
            '" . $result_origen_documento_1[0]['so'] . "',
            '" . addslashes($tipoVolcado) . "',
            '" . $result_origen_documento_1[0]['procedencia'] . "',
            '" . $result_origen_documento_1[0]['tipo_librador'] . "',
            '" . $result_origen_documento_1[0]['id_librador'] . "',
            '" . $fecha . "',
            '" . date('Y-m-d') . "',
            '" . $result_origen_documento_1[0]['fecha_entrega_desde'] . "',
            '" . $result_origen_documento_1[0]['fecha_entrega_hasta'] . "',
            ".$numero_registro.",
            '" . $numeroDocumento . "',
            '" . $serie_documento . "',
            '" . $result_origen_documento_1[0]['modalidad_pago'] . "',
            '" . $result_origen_documento_1[0]['modalidad_envio'] . "',
            '" . $result_origen_documento_1[0]['modalidad_entrega'] . "',
            '" . $result_origen_documento_1[0]['irpf'] . "',
            '" . $result_origen_documento_1[0]['importe_irpf'] . "',
            '" . $result_origen_documento_1[0]['descuento_pp'] . "',
            '" . $result_origen_documento_1[0]['importe_descuento_pp'] . "',
            '" . $result_origen_documento_1[0]['descuento_librador'] . "',
            '" . $result_origen_documento_1[0]['importe_descuento_librador'] . "',
            '" . $result_origen_documento_1[0]['base'] . "',
            '" . $result_origen_documento_1[0]['total'] . "',
            '0',
            '0',
            '0',
            '" . $result_origen_documento_1[0]['id_usuario'] . "',
            '" . $result_origen_documento_1[0]['comensales'] . "',
            '" . date('H:i:s') . "',
            '" . $result_origen_documento_1[0]['hora_entrega'] . "',
            '" . $result_origen_documento_1[0]['id_terminal'] . "'
        );");

        $id_documentos_1 = $conn->id_insert();

        foreach ($documentosAVolcar as $documentoAVolcar_lineas) {
            $result_origen_documento_1_lineas = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_1 WHERE id = " . $documentoAVolcar_lineas->id . " LIMIT 1");

            if ($conn->registros() >= 1 && count($documentoAVolcar_lineas->lineas)) {
                if ($lastIdLibrador != $result_origen_documento_1_lineas[0]['id_librador']) {
                    continue;
                }
                foreach ($documentoAVolcar_lineas->lineas as $linea) {
                    $result_origen_documento_2 = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_2 WHERE id = " . $linea->id . " LIMIT 1");

                    if ($conn->registros() >= 1) {
                        $importe_insertar = $result_origen_documento_2[0]['importe'];
                        if(isset($linea->coste)) {
                            $coste_insertar = addslashes($linea->coste);
                        }else if(!empty($result_origen_documento_2[0]['coste'])) {
                            $coste_insertar = $result_origen_documento_2[0]['coste'];
                        }

                        if ($tipoLibrador == "pro" || $tipoLibrador == "cre") {
                            if(isset($linea->coste)) {
                                $importe_insertar = $coste_insertar;
                            } else {
                                $importe_insertar = $result_origen_documento_2[0]['importe'];
                            }
                        } else {
                            if(isset($linea->importe)) {
                                $importe_insertar = addslashes($linea->importe);
                            } else {
                                $importe_insertar = $result_origen_documento_2[0]['importe'];
                            }
                        }

                        if(isset($linea->lote) && !empty($linea->lote)) {
                            $lote_insertar = addslashes($linea->lote);
                        }else if(!empty($result_origen_documento_2[0]['lote'])) {
                            $lote_insertar = $result_origen_documento_2[0]['lote'];
                        }
                        if(isset($linea->caducidad) && !empty($linea->caducidad)) {
                            $caducidad_insertar = addslashes($linea->numero_serie);
                        }else if(!empty($result_origen_documento_2[0]['caducidad'])) {
                            $caducidad_insertar = $result_origen_documento_2[0]['numero_serie'];
                        }
                        if(isset($linea->numero_serie) && !empty($linea->numero_serie)) {
                            $numero_serie_insertar = addslashes($linea->numero_serie);
                        }else if(!empty($result_origen_documento_2[0]['numero_serie'])) {
                            $numero_serie_insertar = $result_origen_documento_2[0]['numero_serie'];
                        }
                        $cambioDeSigno = 1;
                        if (-$result_origen_documento_2[0]['cantidad'] == $linea->cantidad) {
                            $cambioDeSigno = -1;
                        }

                        $iva_producto = $result_origen_documento_2[0]['iva'];
                        $recargo_producto = $result_origen_documento_2[0]['recargo'];
                        $pvp_iva_incluido = false;
                        $pvp_unidad_sin_incrementos = $importe_insertar;
                        $pvp_unidad = $importe_insertar;
                        $pvp_linea = $importe_insertar;
                        $cantidad = $linea->cantidad;
                        $descuento_base = $result_origen_documento_2[0]['descuento_base'];
                        require 'calcular_totales_linea.php';

                        $conn->query("INSERT INTO documentos_" . $ejercicio . "_2 VALUES(
                    NULL,
                    '" . $id_documentos_1 . "',
                    '" . addslashes($tipoVolcado) . "',
	                '" . $result_origen_documento_2[0]['tipo_librador'] . "',
	                '" . $result_origen_documento_2[0]['id_librador'] . "',
	                '" . $result_origen_documento_2[0]['slug'] . "',
	                '" . $result_origen_documento_2[0]['tipo_producto'] . "',
	                '" . $fecha . "',
	                '" . $result_origen_documento_2[0]['fecha_entrega_desde'] . "',
	                '" . $result_origen_documento_2[0]['fecha_entrega_hasta'] . "',
	                '" . $result_origen_documento_2[0]['id_producto'] . "',
	                '" . $result_origen_documento_2[0]['id_productos_detalles_enlazado'] . "',
	                '" . $result_origen_documento_2[0]['id_productos_detalles_multiples'] . "',
	                '" . $result_origen_documento_2[0]['id_packs'] . "',
	                '" . $result_origen_documento_2[0]['id_productos_relacionados_grupos'] . "',
	                '" . addslashes($result_origen_documento_2[0]['descripcion_productos_relacionados_grupos']) . "',
	                '" . $result_origen_documento_2[0]['imagen_producto'] . "',
	                '" . addslashes($result_origen_documento_2[0]['descripcion_producto']) . "',
	                '" . addslashes($result_origen_documento_2[0]['detalles_producto']) . "',
	                '" . addslashes($result_origen_documento_2[0]['descripcion_oferta']) . "',
	                '" . $result_origen_documento_2[0]['codigo_barras_producto'] . "',
	                '" . $result_origen_documento_2[0]['referencia_producto'] . "',
	                '" . $result_origen_documento_2[0]['referencia_librador'] . "',
	                '" . $numero_serie_insertar . "',
	                '" . $lote_insertar . "',
	                '" . $caducidad_insertar . "',
	                '" . $linea->cantidad . "',
	                '" . $result_origen_documento_2[0]['id_unidades'] . "',
	                '" . $result_origen_documento_2[0]['unidad'] . "',
	                '" . $coste_insertar . "',
	                '" . $importe_insertar . "',
	                '" . $result_origen_documento_2[0]['fijo'] . "',
	                '" . $base_antes_descuento . "',
	                '" . $descuento_base  . "',
	                '" . $importe_descuento_base . "',
	                '" . $base_despues_descuento . "',
	                '" . $result_origen_documento_2[0]['iva'] . "',
	                '" . $importe_iva . "',
	                '" . $result_origen_documento_2[0]['recargo'] . "',
	                '" . $importe_recargo . "',
	                '" . $pvp_unidad . "',
	                '" . $pvp_unidad_sin_incrementos . "',
	                '" . $total_linea . "',
	                '" . $descuento_total . "',
	                '" . $importe_descuento_total . "',
	                '" . $total_despues_descuento . "',
	                '" . $result_origen_documento_2[0]['id'] . "',
	                '" . $result_origen_documento_2[0]['id_vendedor'] . "',
	                '0',
	                '" . $result_origen_documento_2[0]['id_usuario'] . "',
	                '" . $result_origen_documento_2[0]['orden'] . "',
	                '" . $result_origen_documento_2[0]['hora'] . "',
	                '" . $result_origen_documento_2[0]['id_terminal'] . "');");

                        $id_documentos_2 = $conn->id_insert();

                        $estado_linea = 1;
                        $result_documentos_2_anterior = $conn->query("SELECT SUM(cantidad) AS cantidad_volcada FROM documentos_".$documentoAVolcar->ejercicio."_2 
                                    WHERE id_documento_2_anterior=".$result_origen_documento_2[0]['id']);
                        if($result_origen_documento_2[0]['cantidad'] <= $result_documentos_2_anterior[0]['cantidad_volcada']) {
                            $estado_linea = 2;
                        }
                        $result_update_documento_2 = $conn->query("UPDATE documentos_" . $documentoAVolcar->ejercicio . "_2 SET estado=" . $estado_linea . " WHERE id = " . $linea->id . " LIMIT 1");

                    } else {
                        continue;
                    }

                    $result_origen_productos_costes = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_productos_costes WHERE id_documentos_2 = " . $linea->id . " LIMIT 1");

                    if ($conn->registros() >= 1) {
                        $cantidadBase = $result_origen_productos_costes[0]['cantidad_base'] / $result_origen_documento_2[0]['cantidad'];
                        $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_costes VALUES(
                    NULL,
                    '" . $id_documentos_2 . "',
                    '" . $cantidadBase * $linea->cantidad . "',
                    '" . $result_origen_productos_costes[0]['id_unidades_base'] . "',
                    '" . $result_origen_productos_costes[0]['rentabilidad'] . "',
                    '" . $result_origen_productos_costes[0]['id_categoria_elaborados'] . "',
                    '" . $result_origen_productos_costes[0]['tiempo'] . "',
                    '" . $coste_insertar . "')");
                    }

                    $result_origen_iva = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_iva WHERE id_documentos_2 = " . $linea->id . " LIMIT 1");

                    if ($conn->registros() >= 1) {
                        $result = $conn->query("INSERT INTO documentos_".$ejercicio."_iva VALUES(
                NULL,
                '" . $id_documentos_1 . "',
                '" . $id_documentos_2 . "',
                '" . $base_despues_descuento . "',
                '" . $result_origen_iva[0]['iva'] . "',
                '" . $importe_iva . "',
                '" . $result_origen_iva[0]['recargo'] . "',
                '" . $importe_recargo . "' ) ");
                    }

                    $result_origen_observaciones = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_observaciones WHERE id_documentos_2 = " . $linea->id . " AND id_documentos_combo = 0 LIMIT 1");

                    if ($conn->registros() >= 1) {
                        $conn->query("INSERT INTO documentos_" . $ejercicio . "_observaciones VALUES(
                    NULL,
                    '" . $id_documentos_1 . "',
                    '" . $id_documentos_2 . "',
                    '" . $result_origen_observaciones[0]['id_documentos_combo'] . "',
                    '" . addslashes($result_origen_observaciones[0]['observacion']) . "')");
                    }

                    $result_origen_productos_relacionados = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_productos_relacionados WHERE id_documentos_2 = " . $linea->id . " AND id_documentos_combo = 0");

                    if ($conn->registros() >= 1) {
                        foreach ($result_origen_productos_relacionados as $result_origen_productos_relacionado) {
                            $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados VALUES(
                        NULL,
                        '" . $result_origen_productos_relacionado['id_productos_relacionados'] . "',
                        '" . $id_documentos_2 . "',
                        0,
                        '" . $result_origen_productos_relacionado['id_productos_detalles_enlazado'] . "',
                        '" . $result_origen_productos_relacionado['id_productos_detalles_multiples'] . "',
                        '" . $result_origen_productos_relacionado['id_packs'] . "',
                        '" . $result_origen_productos_relacionado['id_relacionado'] . "',
                        '" . $result_origen_productos_relacionado['id_titulo_relacionado'] . "',
                        '" . addslashes($result_origen_productos_relacionado['descripcion']) . "',
                        '" . $result_origen_productos_relacionado['id_grupo'] . "',
                        '" . $result_origen_productos_relacionado['fijo'] . "',
                        '" . $result_origen_productos_relacionado['modelo'] . "',
                        '" . $result_origen_productos_relacionado['cantidad_con'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado['cantidad_mitad'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado['cantidad_sin'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado['cantidad_doble'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado['sumar_con'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado['sumar_mitad'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado['sumar_sin'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado['sumar_doble'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado['observacion'] . "',
                        '" . $result_origen_productos_relacionado['por_defecto'] . "',
                        '" . $result_origen_productos_relacionado['mostrar'] . "',
                        '" . $result_origen_productos_relacionado['orden'] . "')");
                        }
                    }

                    $result_origen_productos_relacionados_combo = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_productos_relacionados_combo WHERE id_documentos_2 = " . $linea->id);

                    if ($conn->registros() >= 1) {
                        foreach ($result_origen_productos_relacionados_combo as $result_origen_productos_relacionado_combo) {
                            $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados_combo VALUES(
                        NULL,
                        '" . $id_documentos_2 . "',
                        '" . $result_origen_productos_relacionado_combo['id_productos_detalles_enlazado'] . "',
                        '" . $result_origen_productos_relacionado_combo['id_productos_detalles_multiples'] . "',
                        '" . $result_origen_productos_relacionado_combo['id_packs'] . "',
                        '" . $result_origen_productos_relacionado_combo['id_relacionado'] . "',
                        '" . $result_origen_productos_relacionado_combo['id_grupo'] . "',
                        '" . $result_origen_productos_relacionado_combo['fijo'] . "',
                        '" . $result_origen_productos_relacionado_combo['cantidad'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado_combo['sumar'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionado_combo['mostrar'] . "',
                        '" . $result_origen_productos_relacionado_combo['orden'] . "')");

                            $id_combo = $conn->id_insert();

                            $result_origen_productos_relacionados = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_productos_relacionados WHERE id_documentos_2 = " . $linea->id . " AND id_documentos_combo = " . $result_origen_productos_relacionado_combo['id']);

                            if ($conn->registros() >= 1) {
                                foreach ($result_origen_productos_relacionados as $result_origen_productos_relacionado) {
                                    $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados VALUES(
                                NULL,
                                '" . $result_origen_productos_relacionado['id_productos_relacionados'] . "',
                                '" . $id_documentos_2 . "',
                                " . $id_combo . ",
                                '" . $result_origen_productos_relacionado['id_productos_detalles_enlazado'] . "',
                                '" . $result_origen_productos_relacionado['id_productos_detalles_multiples'] . "',
                                '" . $result_origen_productos_relacionado['id_packs'] . "',
                                '" . $result_origen_productos_relacionado['id_relacionado'] . "',
                                '" . $result_origen_productos_relacionado['id_titulo_relacionado'] . "',
                                '" . addslashes($result_origen_productos_relacionado['descripcion']) . "',
                                '" . $result_origen_productos_relacionado['id_grupo'] . "',
                                '" . $result_origen_productos_relacionado['fijo'] . "',
                                '" . $result_origen_productos_relacionado['modelo'] . "',
                                '" . $result_origen_productos_relacionado['cantidad_con'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                                '" . $result_origen_productos_relacionado['cantidad_mitad'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                                '" . $result_origen_productos_relacionado['cantidad_sin'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                                '" . $result_origen_productos_relacionado['cantidad_doble'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                                '" . $result_origen_productos_relacionado['sumar_con'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                                '" . $result_origen_productos_relacionado['sumar_mitad'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                                '" . $result_origen_productos_relacionado['sumar_sin'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                                '" . $result_origen_productos_relacionado['sumar_doble'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                                '" . addslashes($result_origen_productos_relacionado['observacion']) . "',
                                '" . $result_origen_productos_relacionado['por_defecto'] . "',
                                '" . $result_origen_productos_relacionado['mostrar'] . "',
                                '" . $result_origen_productos_relacionado['orden'] . "')");
                                }
                            }

                            $result_origen_observaciones = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_observaciones WHERE id_documentos_2 = " . $linea->id . " AND id_documentos_combo = " . $result_origen_productos_relacionado_combo['id'] . " LIMIT 1");

                            if ($conn->registros() >= 1) {
                                $conn->query("INSERT INTO documentos_" . $ejercicio . "_observaciones VALUES(
                            NULL,
                            '" . $id_documentos_1 . "',
                            '" . $id_documentos_2 . "',
                            '" . $id_combo . "',
                            '" . addslashes($result_origen_observaciones[0]['observacion']) . "')");
                            }
                        }
                    }

                    $result_origen_productos_relacionados_elaborados = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_productos_relacionados_elaborados WHERE id_documentos_2 = " . $linea->id);

                    if ($conn->registros() >= 1) {
                        foreach ($result_origen_productos_relacionados_elaborados as $result_origen_productos_relacionados_elaborado) {
                            $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados_elaborados VALUES(
                        NULL,
                        '" . $id_documentos_2 . "',
                        '" . $result_origen_productos_relacionados_elaborado['id_productos_detalles_enlazado'] . "',
                        '" . $result_origen_productos_relacionados_elaborado['id_productos_detalles_multiples'] . "',
                        '" . $result_origen_productos_relacionados_elaborado['id_packs'] . "',
                        '" . $result_origen_productos_relacionados_elaborado['id_categoria_estadisticas'] . "',
                        '" . $result_origen_productos_relacionados_elaborado['id_producto_relacionado'] . "',
                        '" . $result_origen_productos_relacionados_elaborado['fijo'] . "',
                        '" . $result_origen_productos_relacionados_elaborado['cantidad'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionados_elaborado['coste'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionados_elaborado['id_unidad'] . "',
                        '" . $result_origen_productos_relacionados_elaborado['sumar'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad . "',
                        '" . $result_origen_productos_relacionados_elaborado['mostrar'] . "',
                        '" . $result_origen_productos_relacionados_elaborado['orden'] . "')");
                        }
                    }

                    $result_origen_productos_sku_stock = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_productos_sku_stock WHERE id_documento_2 = " . $linea->id);

                    if ($conn->registros() >= 1) {
                        foreach ($result_origen_productos_sku_stock as $result_origen_producto_sku_stock) {
                            /*
                             * TODO
                             * Cuando se duplica el stock se debe restar la cantidad del anterior documento.
                             * También se tiene que tener en cuenta que puede variar el lote, caducidad o número de serie. Esto viene por parámetro.
                             * También es posible que una linea de stock se convierta en 2 o más debido a entregas parciales.
                             * También es posible que una linea de stock se convierta en 2 o más debido a diferentes lotes o números de serie.
                             */
                            $cantidadNuevoStock = $linea->cantidad;
                            $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_sku_stock VALUES(
                        NULL,
                        '" . $result_origen_producto_sku_stock['id_producto'] ."',
                        '" . $result_origen_producto_sku_stock['id_productos_sku'] ."',
                        '" . $linea->lote ."',
                        '" . $linea->caducidad ."',
                        '" . $linea->numero_serie ."',
                        '" . $result_origen_producto_sku_stock['codigo_barras'] ."',
                        '" . addslashes($tipoVolcado) ."',
                        '" . $fecha ."',
                        '" . $id_documentos_1 ."',
                        '" . $id_documentos_2 ."',
                        '" . $result_origen_producto_sku_stock['tipo_librador'] ."',
                        '" . $result_origen_producto_sku_stock['id_librador'] ."',
                        '" . $result_origen_producto_sku_stock['coste'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad ."',
                        '" . $cantidadNuevoStock ."',
                        '" . $result_origen_producto_sku_stock['id_unidades'] ."',
                        '" . $result_origen_producto_sku_stock['unidad'] ."',
                        '" . $result_origen_producto_sku_stock['importe'] / $result_origen_documento_2[0]['cantidad'] * $linea->cantidad ."',
                        '" . date("Y-m-d") ."',
                        '" . date("Y-m-d") ."')");

                            $conn->query("UPDATE documentos_" . $ejercicio . "_productos_sku_stock SET cantidad = '" . ($result_origen_producto_sku_stock['cantidad'] - $cantidadNuevoStock) . "' WHERE id = " . $result_origen_producto_sku_stock['id'] . ";");
                        }
                    }
                }
            }
        }

        $result_origen_libradores = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_libradores WHERE id_documentos_1 = " . $documentoAVolcar->id . " LIMIT 1");

        if ($conn->registros() >= 1) {
            $conn->query("INSERT INTO documentos_" . $ejercicio . "_libradores VALUES(
                    NULL,
                    '" . $id_documentos_1 . "',
                    '" . $result_origen_libradores[0]['codigo_librador'] . "',
                    '" . addslashes($result_origen_libradores[0]['nombre']) . "',
                    '" . addslashes($result_origen_libradores[0]['apellido_1']) . "',
                    '" . addslashes($result_origen_libradores[0]['apellido_2']) . "',
                    '" . addslashes($result_origen_libradores[0]['razon_social']) . "',
                    '" . addslashes($result_origen_libradores[0]['razon_comercial']) . "',
                    '" . addslashes($result_origen_libradores[0]['nif']) . "',
                    '" . addslashes($result_origen_libradores[0]['direccion']) . "',
                    '" . addslashes($result_origen_libradores[0]['numero']) . "',
                    '" . addslashes($result_origen_libradores[0]['escalera']) . "',
                    '" . addslashes($result_origen_libradores[0]['piso']) . "',
                    '" . addslashes($result_origen_libradores[0]['puerta']) . "',
                    '" . addslashes($result_origen_libradores[0]['localidad']) . "',
                    '" . addslashes($result_origen_libradores[0]['codigo_postal']) . "',
                    '" . addslashes($result_origen_libradores[0]['provincia']) . "',
                    '" . addslashes($result_origen_libradores[0]['telefono_1']) . "',
                    '" . addslashes($result_origen_libradores[0]['telefono_2']) . "',
                    '" . addslashes($result_origen_libradores[0]['fax']) . "',
                    '" . addslashes($result_origen_libradores[0]['mobil']) . "',
                    '" . addslashes($result_origen_libradores[0]['email']) . "',
                    '" . addslashes($result_origen_libradores[0]['persona_contacto']) . "',
                    '" . addslashes($result_origen_libradores[0]['banco']) . "',
                    '" . addslashes($result_origen_libradores[0]['entidad']) . "',
                    '" . addslashes($result_origen_libradores[0]['agencia']) . "',
                    '" . addslashes($result_origen_libradores[0]['dc']) . "',
                    '" . addslashes($result_origen_libradores[0]['cuenta']) . "',
                    '" . addslashes($result_origen_libradores[0]['iban']) . "',
                    '" . addslashes($result_origen_libradores[0]['id_tarifa_web']) . "',
                    '" . addslashes($result_origen_libradores[0]['id_tarifa_tpv']) . "')");
        }

        $result_origen_libradores_envio = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_libradores_envio WHERE id_documentos_1 = " . $documentoAVolcar->id . " LIMIT 1");

        if ($conn->registros() >= 1) {
            $conn->query("INSERT INTO documentos_" . $ejercicio . "_libradores_envio VALUES(
                    NULL,
                    '" . $id_documentos_1 . "',
                    '" . $fecha . "',
                    '" . addslashes($result_origen_libradores_envio[0]['fecha_envio']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['fecha_entrega']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['id_librador']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['nombre']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['apellido_1']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['apellido_2']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['razon_social']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['razon_comercial']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['direccion']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['numero']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['escalera']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['piso']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['puerta']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['localidad']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['codigo_postal']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['provincia']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['zona']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['telefono_1']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['telefono_2']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['mobil']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['persona_contacto']) . "',
                    '" . addslashes($result_origen_libradores_envio[0]['observaciones']) . "')");
        }

        $result_origen_observaciones = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_observaciones WHERE id_documentos_1 = " . $documentoAVolcar->id . " AND id_documentos_2 = 0 LIMIT 1");

        if ($conn->registros() >= 1) {
            $conn->query("INSERT INTO documentos_" . $ejercicio . "_observaciones VALUES(
                    NULL,
                    '" . $id_documentos_1 . "',
                    '0',
                    '" . $result_origen_observaciones[0]['id_documentos_combo'] . "',
                    '" . $result_origen_observaciones[0]['observacion'] . "')");
        }

        $id_documento_1 = $id_documentos_1;

        foreach ($documentosAVolcar as $documentoAVolcar_estados) {
            $result_origen_documento_1_estados = $conn->query("SELECT * FROM documentos_" . $documentoAVolcar->ejercicio . "_1 WHERE id = " . $documentoAVolcar_estados->id . " LIMIT 1");

            if ($conn->registros() >= 1 && count($documentoAVolcar_estados->lineas)) {
                if ($lastIdLibrador != $result_origen_documento_1_estados[0]['id_librador']) {
                    continue;
                }
                $estados_documento[0] = false;
                $estados_documento[1] = false;
                $estados_documento[2] = false;
                $result_origen_documento_2 = $conn->query("SELECT estado FROM documentos_" . $documentoAVolcar->ejercicio . "_2 WHERE id_documentos_1 = " . $documentoAVolcar_estados->id);
                foreach ($result_origen_documento_2 as $key_origen_documento_2 => $valor_origen_documento_2) {
                    if ($valor_origen_documento_2['estado'] == 0) {
                        $estados_documento[0] = true;
                    } else if ($valor_origen_documento_2['estado'] == 1) {
                        $estados_documento[1] = true;
                    } else if ($valor_origen_documento_2['estado'] == 2) {
                        $estados_documento[2] = true;
                    }
                }
                if ($estados_documento[0] && !$estados_documento[1] && !$estados_documento[2]) {
                    $estado_documento = 0;
                } else {
                    $estado_documento = 1;
                }
                if (!$estados_documento[0] && !$estados_documento[1] && $estados_documento[2]) {
                    $estado_documento = 2;
                }
                $conn->query("UPDATE documentos_" . $documentoAVolcar->ejercicio . "_1 SET estado = '" . $estado_documento . "' WHERE id = " . $documentoAVolcar_estados->id . " LIMIT 1");
            }
        }

        $descuento_pp = $result_origen_documento_1[0]['descuento_pp'];
        $descuento_librador = $result_origen_documento_1[0]['descuento_librador'];
        $total = 0;
        $datos = '';
        require ('calcular_totales.php');
        $conn->query("UPDATE documentos_" . $ejercicio . "_1 SET total = '" . $total . "', base = '" . $base_total . "', importe_descuento_librador = '" . $importe_descuento_librador . "', importe_descuento_pp = '" . $importe_descuento_pp . "', importe_irpf = '" . $importe_irpf . "' WHERE id = " . $id_documentos_1 . " LIMIT 1");

        if ($tipoVolcado == 'fac') {
            // Insertar recibo/s
            $result_modalidades_pago = $conn->query("SELECT id FROM modalidades_pago WHERE descripcion='".$result_origen_documento_1[0]['modalidad_pago']."' LIMIT 1");
            $result_modalidades_pago_lineas = $conn->query("SELECT dias,porcentaje FROM modalidades_pago_lineas WHERE id_forma_pago='".$result_modalidades_pago[0]['id']."' ORDER BY dias");
            $importe_recibos = [];
            $dias_recibos = [];
            foreach ($result_modalidades_pago_lineas as $key_modalidades_pago_lineas => $valor_modalidades_pago_lineas) {
                if($total != 0) {
                    $suma_importe_recibos = ($total / 100) * $valor_modalidades_pago_lineas['porcentaje'];
                }else {
                    $suma_importe_recibos = 0;
                }
                $importe_recibos[] = number_format($suma_importe_recibos, 2, ".", "");
                $fecha_recibo = date("d-m-Y",strtotime($fecha."+ " . $valor_modalidades_pago_lineas['dias'] . " days"));
                $dias_recibos[]= DateTime::createFromFormat('d-m-Y', $fecha_recibo)->format('Y-m-d');
            }
            if(isset($importe_recibos) && count($importe_recibos) > 1) {
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

            $numero_efecto = 0;
            foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
                $numero_efecto += 1;
                $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(
                    NULL,
                    '" . $id_documentos_1 . "',
                    '" . addslashes($tipoVolcado) . "',
                    '" . $result_origen_documento_1[0]['id_librador'] . "',
                    '" . $valor_importe_recibos . "',
                    '" . $fecha . "',
                    '" . $dias_recibos[$key_importe_recibos] . "',
                    '0',
                    '',
                    '',
                    '0',
                    '0',
                    '" . $result_origen_documento_1[0]['modalidad_pago'] . "',
                    '" . $numero_efecto . "',
                    '0',
                    '0',
                    '',
                    NULL,
                    '')");
            }
            unset($importe_recibos);
            unset($dias_recibos);
        }
    }
}

if (isset($tienda)) {
    unset($_SESSION[$id_sesion_js]['id_documento']);
}

echo json_encode([
    'mensaje' => 'Documento/s volcado/s.',
    'id_documentos_1' => (isset($id_documentos_1))? $id_documentos_1 : ''
]);