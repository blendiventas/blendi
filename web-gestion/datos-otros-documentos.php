<?php
if (empty($apartado)) {
    $apartado = (empty($_POST['apartado']))? null : $_POST['apartado'];
}
if (empty($select_sys)) {
    $select_sys = (empty($_POST['opcion']))? 'abiertos' : $_POST['opcion'];
}
if (empty($id_librador)) {
    $id_librador = (empty($_POST['id_librador']))? '-1' : $_POST['id_librador'];
}
if (empty($fecha_desde)) {
    $fecha_desde = (empty($_POST['fecha_desde']))? date('Y-m-d') : $_POST['fecha_desde'];
}
if (empty($fecha_hasta)) {
    $fecha_hasta = (empty($_POST['fecha_hasta']))? date('Y-m-d') : $_POST['fecha_hasta'];
}
if (empty($hora_desde)) {
    $hora_desde = (empty($_POST['hora_desde']))? '00:00' : $_POST['hora_desde'];
}
if (empty($hora_hasta)) {
    $hora_hasta = (empty($_POST['hora_hasta']))? '23:59' : $_POST['hora_hasta'];
}
if (empty($parametro_pagina)) {
    $parametro_pagina = (empty($_POST['pagina']))? 0 : (int) $_POST['pagina'] - 1;
}
if (empty($parametro_resultados)) {
    $parametro_resultados = (empty($_POST['resultados']))? 10 : (int) $_POST['resultados'];
}

if (!empty($_POST['serie'])) {
    $serie = $_POST['serie'];
}
if (empty($descarga_url)) {
    $descarga_url = (empty($_POST['descarga_url']))? null : $_POST['descarga_url'];
}
$limite_registros = 100000;

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

if (!function_exists('anadirModalidadesUsuariosMetodos')) {
    function anadirModalidadesUsuariosMetodos($result_modalidades_pago, $result_usuarios, $result_metodos_pago, $key_terminales, $valor_bancos_cajas_id, &$datos_cierre_terminales) {
        foreach ($result_modalidades_pago as $key_modalidades_pago => $valor_modalidades_pago) {
            $modalidadAInsertar = new stdClass();
            $modalidadAInsertar->modalidad = stripslashes($valor_modalidades_pago['descripcion']);
            $modalidadAInsertar->importe= 0;
            $datos_cierre_terminales[$key_terminales]->bancos[$valor_bancos_cajas_id]->modalidades[$valor_modalidades_pago['id']] = $modalidadAInsertar;
            foreach ($result_usuarios as $key_usuarios => $valor_usuarios) {
                $usuarioAInsertar = new stdClass();
                $usuarioAInsertar->usuario = stripslashes($valor_usuarios['usuario']);
                $usuarioAInsertar->metodos = [];
                $usuarioAInsertar->importe = 0;
                $datos_cierre_terminales[$key_terminales]->bancos[$valor_bancos_cajas_id]->modalidades[$valor_modalidades_pago['id']]->usuarios[$valor_usuarios['id']] = $usuarioAInsertar;
                foreach ($result_metodos_pago as $key_metodos_pago => $valor_metodos_pago) {
                    $metodoAInsertar = new stdClass();
                    $metodoAInsertar->metodo = stripslashes($valor_metodos_pago['descripcion']);
                    $metodoAInsertar->importe = 0;
                    $datos_cierre_terminales[$key_terminales]->bancos[$valor_bancos_cajas_id]->modalidades[$valor_modalidades_pago['id']]->usuarios[$valor_usuarios['id']]->metodos[$valor_metodos_pago['id']] = $metodoAInsertar;
                }
            }
        }
    }
}

switch ($select_sys) {
    case "buscar_documentos":
        if($interface == "tpv") {
            if($apartado == "global" && ($tipo_librador == "cli" OR $tipo_librador == "tak" OR $tipo_librador == "del" OR $tipo_librador == "mes")) {
                $query1 = "SELECT * FROM documentos_" . $ejercicio . "_1 WHERE 
                                                    tipo_documento='" . addslashes($tipo_documento) . "' AND 
                                                    tipo_librador<>'pro' AND tipo_librador<>'cre' 
                                                    ORDER BY CAST(numero_documento as SIGNED INTEGER) DESC LIMIT 100";
            }else {
                $query1 = "SELECT * FROM documentos_" . $ejercicio . "_1 WHERE 
                                                    tipo_documento='" . addslashes($tipo_documento) . "' AND 
                                                    tipo_librador='" . addslashes($tipo_librador) . "' 
                                                    ORDER BY numero_registro DESC LIMIT 100";
            }
            $result_documentos = $conn->query($query1);
        }else {
            $query1 = "SELECT * FROM documentos_".$ejercicio."_1 WHERE 
                                                    tipo_documento='" . addslashes($tipo_documento) . "' AND 
                                                    id_librador='".$id_librador."' ORDER BY CAST(numero_documento as SIGNED INTEGER) DESC LIMIT 100";
            $result_documentos = $conn->query($query1);
        }

        if ($conn->registros() >= 1) {
            foreach ($result_documentos as $key_documentos => $valor_documentos) {
                $ejercicios_documentos_1[] = $ejercicio;
                $id_documentos_1[] = $valor_documentos['id'];
                $id_librador_documentos_1[] = $valor_documentos['id_librador'];
                $bloqueado_documentos_1[] = $valor_documentos['bloqueado'];
                $modalidad_pago_array[] = $valor_documentos['modalidad_pago'];
                $fecha_documento_documentos_1[] = $valor_documentos['fecha_documento'];
                $numero_registro_documentos_1[] = (empty($valor_documentos['numero_registro']))? '' : $valor_documentos['numero_registro'];
                $numero_documento_documentos_1[] = $valor_documentos['numero_documento'];
                if (!empty($valor_documentos['serie_documento'])) {
                    $serie_documento_documentos_1[] = $valor_documentos['serie_documento'] . "/";
                } else {
                    $serie_documento_documentos_1[] = "";
                }
                $total_documentos_1[] = number_format($valor_documentos['total'],2, ",", ".");

                if ($valor_documentos['estado'] == 0) {
                    $estado_documentos_1[] = "Abierto";
                } else if ($valor_documentos['estado'] == 1) {
                    if ($tipo_documento == "fac" or $tipo_documento == "tiq") {
                        $estado_documentos_1[] = "Cobrado parcial";
                    } else {
                        $estado_documentos_1[] = "Volcado parcial";
                    }
                } else if ($valor_documentos['estado'] == 2) {
                    if ($tipo_documento == "fac" or $tipo_documento == "tiq") {
                        $estado_documentos_1[] = "Cobrado";
                    } else {
                        $estado_documentos_1[] = "Volcado";
                    }
                }

                $id_usuario_documentos_1[] = $valor_documentos['id_usuario'];
                $hora_documentos_1[] = $valor_documentos['hora'];

                $result_nota_documento = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_observaciones WHERE id_documentos_1=" . $valor_documentos['id'] . " 
                            AND id_documentos_2=0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $observacion_documentos_1[] = nl2br(stripslashes($result_nota_documento[0]['observacion']));
                } else {
                    $observacion_documentos_1[] = "";
                }

                $query = "SELECT nombre,apellido_1,apellido_2,razon_social,razon_comercial,activo FROM libradores WHERE 
                                                    id='".$valor_documentos['id_librador']."' LIMIT 1";
                $result_librador = $conn->query($query);

                if($conn->registros() == 1) {
                    if (!empty($result_librador[0]['nombre'])) {
                        $librador_documentos_1[] = stripslashes($result_librador[0]['nombre']) . " " . stripslashes($result_librador[0]['apellido_1']) . " " . stripslashes($result_librador[0]['apellido_2']);
                    } else {
                        $librador_documentos_1[] = stripslashes($result_librador[0]['razon_social']) . "(" . stripslashes($result_librador[0]['razon_comercial']) . ")";
                    }
                    $librador_activo[] = $result_librador[0]['activo'];
                }else {
                    $librador_documentos_1[] = "Sin datos.";
                    $librador_activo[] = 0;
                }
            }
        }
        if (!empty($descarga_url) && $descarga_url == 'csv') {
            $return = 'Número;Número registre;Cliente;Fecha;Hora;Total;Estado';

            foreach ($numero_documento_documentos_1 as $key => $valor) {
                $return .= "\n";
                $return .= $numero_documento_documentos_1[$key] . ';' . $numero_registro_documentos_1[$key] . ';' . $librador_documentos_1[$key] . ';' . $fecha_documento_documentos_1[$key] . ';' . $hora_documentos_1[$key] . ';' . $total_documentos_1[$key] . ';' . $estado_documentos_1[$key];
            }

            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=listado-" . $ejercicio . "-" . $select_sys . ".csv");
            echo $return;
            exit();
        } else {
            if (isset($ajax)) {
                echo json_encode([
                    'resultados' => 'global',
                    'mostrar' => '',
                    'ejercicios_documentos_1' => $ejercicios_documentos_1,
                    'id_documento' => $id_documentos_1,
                    'id_librador' => $id_librador_documentos_1,
                    'bloqueado' => $bloqueado_documentos_1,
                    'librador_activo' => $librador_activo,
                    'librador' => $librador_documentos_1,
                    'fecha_documento' => $fecha_documento_documentos_1,
                    'numero_registro' => $numero_registro_documentos_1,
                    'numero_documento' => $numero_documento_documentos_1,
                    'serie_documento' => $serie_documento_documentos_1,
                    'total' => $total_documentos_1,
                    'estado' => $estado_documentos_1,
                    'id_usuario' => $id_usuario_documentos_1,
                    'hora' => $hora_documentos_1,
                    'observacion_documento' => $observacion_documentos_1,
                    'modalidad_pago' => $modalidad_pago_array
                ]);
            }
        }
        break;
    case "abiertos":
        $ejercicio_inicial = intval(substr($fecha_desde,0,4));
        $ejercicio_final = intval(substr($fecha_hasta,0,4));

        for ($bucle_ejercicios = $ejercicio_inicial ; $bucle_ejercicios <= $ejercicio_final ; $bucle_ejercicios++)
        {
            if ($interface == "tpv") {
                if (!isset($parametro_pagina)) {
                    $parametro_pagina = 0;
                }
                if (!isset($parametro_resultados)) {
                    $parametro_resultados = 10;
                }

                $anadidoLimit = "";
                if (empty($descarga_url)) {
                    $anadidoLimit = " LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados;
                }

                $anadidoIdLibrador = '';
                if (isset($id_librador) && $id_librador != "-1") {
                    $anadidoIdLibrador = " AND id_librador='" . $id_librador . "' ";
                }
                $anadidoFechas = '';
                if (!empty($fecha_desde) && !empty($fecha_hasta) && !empty($hora_desde) && !empty($hora_hasta) ) {
                    $anadidoFechas = " AND " .
                        "fecha_documento>='" . addslashes($fecha_desde) . "' AND " .
                        "fecha_documento<='" . addslashes($fecha_hasta) . "' AND " .
                        "hora>='" . addslashes($hora_desde) . "' AND " .
                        "hora<='" . addslashes($hora_hasta) . "' ";
                }

                $tipoLibradorQuery = "tipo_librador<>'pro' AND tipo_librador<>'cre'";
                if ($apartado == "entregas" && ($tipo_librador == "cli" or $tipo_librador == "tak" or $tipo_librador == "del" or $tipo_librador == "mes")) {
                    $tipoLibradorQuery = "tipo_librador='del'";
                } else if ($apartado == "recogidas" && ($tipo_librador == "cli" or $tipo_librador == "tak" or $tipo_librador == "del" or $tipo_librador == "mes")) {
                    $tipoLibradorQuery = "tipo_librador='tak'";
                }

                $query = "SELECT COUNT(*) AS number_results FROM documentos_" . $bucle_ejercicios . "_1 WHERE 
                    " . $tipoLibradorQuery . " AND 
                    tipo_documento='" . addslashes($tipo_documento) . "' AND estado<>2 " . $anadidoIdLibrador . $anadidoFechas . "  
                    ORDER BY numero_registro DESC ";
                $result = $conn->query($query);
                $resultsListadoFiltrado = $result[0]['number_results'];
                $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
                $query = "SELECT * FROM documentos_" .$bucle_ejercicios . "_1 WHERE 
                    " . $tipoLibradorQuery . " AND 
                    tipo_documento='" . addslashes($tipo_documento) . "' AND estado<>2 " . $anadidoIdLibrador . $anadidoFechas . "  
                    ORDER BY numero_registro DESC " . $anadidoLimit;
                $result_documentos = $conn->query($query);
            } else {
                $query = "SELECT * FROM documentos_".$bucle_ejercicios."_1 WHERE 
                    tipo_documento='" . addslashes($tipo_documento) . "' AND estado<>2 AND id_librador='" . $id_librador . "' 
                    ORDER BY CAST(numero_documento as SIGNED INTEGER) DESC LIMIT 100";
                $result_documentos = $conn->query($query);
            }

            $resultados = $apartado;

            if ($apartado == "entregas") {
                $query = "SELECT d1.* FROM documentos_" . $bucle_ejercicios . "_1 d1 JOIN documentos_enviar_terminales det ON d1.id = det.id_documento_1 AND (det.estado = 0 OR det.estado = -1) WHERE d1.tipo_librador='del' AND 
                                                        d1.tipo_documento='" . addslashes($tipo_documento) . "' AND d1.estado<>2 AND d1.entregado=0   
                                                        GROUP BY d1.id ORDER BY d1.numero_documento ASC LIMIT 100";

                $queryCocinandose = "SELECT d1.* FROM documentos_" . $bucle_ejercicios . "_1 d1 JOIN documentos_enviar_terminales det ON d1.id = det.id_documento_1 AND det.estado = 1 WHERE d1.tipo_librador='del' AND 
                                                        d1.tipo_documento='" . addslashes($tipo_documento) . "' AND d1.estado<>2 AND d1.entregado=0  
                                                        GROUP BY d1.id ORDER BY d1.numero_documento ASC LIMIT 100";
                $result_cocinandose = $conn->query($queryCocinandose);

                $queryPendientePago = "SELECT d1.* FROM documentos_" . $bucle_ejercicios . "_1 d1 WHERE d1.tipo_librador='del' AND 
                                                        d1.tipo_documento='" . addslashes($tipo_documento) . "' AND d1.estado<>2 AND d1.entregado=0 AND d1.id NOT IN(SELECT det.id_documento_1 FROM documentos_enviar_terminales det WHERE det.id_documento_1 = d1.id)   
                                                        ORDER BY d1.numero_documento ASC LIMIT 100";
                $result_pendiente_pago = $conn->query($queryPendientePago);

                $queryEntregado = "SELECT d1.* FROM documentos_" . $bucle_ejercicios . "_1 d1 WHERE d1.tipo_librador='del' AND 
                                                        d1.tipo_documento='" . addslashes($tipo_documento) . "' AND d1.entregado=1 
                                                        ORDER BY d1.numero_documento ASC LIMIT 20";
                $result_entregado = $conn->query($queryEntregado);
            } else if ($apartado == "recogidas") {
                $query = "SELECT d1.* FROM documentos_" . $bucle_ejercicios . "_1 d1 JOIN documentos_enviar_terminales det ON d1.id = det.id_documento_1 AND (det.estado = 0 OR det.estado = -1) WHERE d1.tipo_librador='tak' AND 
                                                        d1.tipo_documento='" . addslashes($tipo_documento) . "' AND d1.estado<>2 AND d1.entregado=0  
                                                        GROUP BY d1.id ORDER BY d1.numero_documento ASC LIMIT 100";
                $queryCocinandose = "SELECT d1.* FROM documentos_" . $bucle_ejercicios . "_1 d1 JOIN documentos_enviar_terminales det ON d1.id = det.id_documento_1 AND det.estado = 1 WHERE d1.tipo_librador='tak' AND 
                                                        d1.tipo_documento='" . addslashes($tipo_documento) . "' AND d1.estado<>2 AND d1.entregado=0   
                                                        GROUP BY d1.id ORDER BY d1.numero_documento ASC LIMIT 100";
                $result_cocinandose = $conn->query($queryCocinandose);

                $queryPendientePago = "SELECT d1.* FROM documentos_" . $bucle_ejercicios . "_1 d1 WHERE d1.tipo_librador='tak' AND 
                                                        d1.tipo_documento='" . addslashes($tipo_documento) . "' AND d1.estado<>2 AND d1.entregado=0 AND d1.id NOT IN(SELECT det.id_documento_1 FROM documentos_enviar_terminales det WHERE det.id_documento_1 = d1.id)   
                                                        ORDER BY d1.numero_documento ASC LIMIT 100";
                $result_pendiente_pago = $conn->query($queryPendientePago);

                $queryEntregado = "SELECT d1.* FROM documentos_" . $bucle_ejercicios . "_1 d1 WHERE d1.tipo_librador='tak' AND 
                                                        d1.tipo_documento='" . addslashes($tipo_documento) . "' AND d1.entregado=1 
                                                        ORDER BY d1.numero_documento ASC LIMIT 20";
                $result_entregado = $conn->query($queryEntregado);
            }
            if ($conn->registros() >= 1) {
                foreach (
                    $result_documentos as $key_documentos => $valor_documentos
                ) {
                    $query = "SELECT nombre,apellido_1,apellido_2,razon_social,razon_comercial,activo FROM libradores WHERE 
                        id='".$valor_documentos['id_librador']."' LIMIT 1";
                    $result_librador = $conn->query($query);

                    $ejercicios_documentos_1[] = $bucle_ejercicios;
                    $id_documentos_1[] = $valor_documentos['id'];
                    $id_librador_documentos_1[]
                        = $valor_documentos['id_librador'];
                    $bloqueado_documentos_1[] = $valor_documentos['bloqueado'];
                    $modalidad_pago_array[]
                        = $valor_documentos['modalidad_pago'];

                    if (!empty($result_librador[0]['nombre'])) {
                        $librador_documentos_1[] = stripslashes(
                                $result_librador[0]['nombre']
                            )." ".stripslashes(
                                $result_librador[0]['apellido_1']
                            )." ".stripslashes(
                                $result_librador[0]['apellido_2']
                            );
                    } else {
                        $librador_documentos_1[] = stripslashes(
                                $result_librador[0]['razon_social']
                            )."(".stripslashes(
                                $result_librador[0]['razon_comercial']
                            ).")";
                    }
                    $librador_activo[] = $result_librador[0]['activo'];

                    $fecha_documento_documentos_1[]
                        = $valor_documentos['fecha_documento'];
                    $numero_registro_documentos_1[]
                        = (empty($valor_documentos['numero_registro'])) ? ''
                        : $valor_documentos['numero_registro'];
                    $numero_documento_documentos_1[]
                        = $valor_documentos['numero_documento'];
                    if (!empty($valor_documentos['serie_documento'])) {
                        $serie_documento_documentos_1[]
                            = $valor_documentos['serie_documento']."/";
                    } else {
                        $serie_documento_documentos_1[] = "";
                    }
                    $total_documentos_1[] = number_format(
                        $valor_documentos['total'],
                        2,
                        ",",
                        "."
                    );

                    if ($valor_documentos['estado'] == 0) {
                        $estado_documentos_1[] = "Abierto";
                    } else {
                        if ($valor_documentos['estado'] == 1) {
                            if ($tipo_documento == "fac" or $tipo_documento
                                == "tiq"
                            ) {
                                $estado_documentos_1[] = "Cobrado parcial";
                            } else {
                                $estado_documentos_1[] = "Volcado parcial";
                            }
                        } else {
                            if ($valor_documentos['estado'] == 2) {
                                if ($tipo_documento == "fac" or $tipo_documento
                                    == "tiq"
                                ) {
                                    $estado_documentos_1[] = "Cobrado";
                                } else {
                                    $estado_documentos_1[] = "Volcado";
                                }
                            }
                        }
                    }

                    $id_usuario_documentos_1[] = $valor_documentos['id_usuario'];
                    $hora_documentos_1[] = $valor_documentos['hora'];

                    if ($tipo_documento != "tiq") {
                        // Recogemos los datos de las lineas de los documentos, cantidades, descripciones... para poderlas volcar
                        $result_documentos_2 = $conn->query("SELECT id,descripcion_producto,detalles_producto,descripcion_oferta,
                                        referencia_producto,numero_serie,lote,cantidad,unidad,coste,importe,pvp_unidad,estado 
                                        FROM documentos_" . $bucle_ejercicios . "_2 
                                        WHERE id_documentos_1=" . $valor_documentos['id']);
                        foreach ($result_documentos_2 as $key_documentos_2 => $valor_documentos_2) {
                            $id_documentos_2[] = $valor_documentos_2['id'];
                            $id_documentos_2_1[] = $valor_documentos['id'];
                            $descripcion_producto_2[] = stripslashes($valor_documentos_2['descripcion_producto']);
                            $detalles_producto_2[] = stripslashes($valor_documentos_2['detalles_producto']);
                            $descripcion_oferta_2[] = stripslashes($valor_documentos_2['descripcion_oferta']);
                            $referencia_producto_2[] = stripslashes($valor_documentos_2['referencia_producto']);
                            $numero_serie_2[] = stripslashes($valor_documentos_2['numero_serie']);
                            $lote_2[] = stripslashes($valor_documentos_2['lote']);
                            $caducidad_2[] = stripslashes($valor_documentos_2['caducidad']);
                            $cantidad_2[] = $valor_documentos_2['cantidad'];
                            $unidad_2[] = stripslashes($valor_documentos_2['unidad']);
                            $coste_2[] = $valor_documentos_2['coste'];
                            $importe_2[] = $valor_documentos_2['importe'];
                            $pvp_unidad_2[] = $valor_documentos_2['pvp_unidad'];
                            if ($valor_documentos_2['estado'] == 0) {
                                $estado_lineas[] = 0;
                                $cantidad_2_volcada[] = 0;
                            } else if ($valor_documentos_2['estado'] == 1) {
                                if ($tipo_documento == "fac" or $tipo_documento == "tiq") {
                                    $estado_lineas[] = 1;
                                    $cantidad_2_volcada[] = 0;
                                } else {
                                    $estado_lineas[] = 1;
                                    // En $cantidad_2 tenemos la cantidad del documento a volcar
                                    // Obtenemos la cantidad o cantidades volcadas
                                    $result_documentos_2_anterior = $conn->query("SELECT SUM(cantidad) AS cantidad_volcada FROM documentos_" . $bucle_ejercicios . "_2 
                                            WHERE id_documento_2_anterior=" . $valor_documentos_2['id']);
                                    if ($result_documentos_2_anterior[0]['cantidad_volcada']) {
                                        $cantidad_2_volcada[] = $result_documentos_2_anterior[0]['cantidad_volcada'];
                                    } else {
                                        $cantidad_2_volcada[] = 0;
                                    }
                                }
                            } else if ($valor_documentos_2['estado'] == 2) {
                                if ($tipo_documento == "fac" or $tipo_documento == "tiq") {
                                    $estado_lineas[] = 2;
                                } else {
                                    $estado_lineas[] = 2;
                                }
                                $cantidad_2_volcada[] = 0;
                            }
                        }
                    }

                    $result_nota_documento = $conn->query(
                        "SELECT * FROM documentos_".$bucle_ejercicios
                        ."_observaciones WHERE id_documentos_1="
                        .$valor_documentos['id']." 
                            AND id_documentos_2=0 LIMIT 1"
                    );
                    if ($conn->registros() == 1) {
                        $observacion_documentos_1[] = nl2br(
                            stripslashes(
                                $result_nota_documento[0]['observacion']
                            )
                        );
                    } else {
                        $observacion_documentos_1[] = "";
                    }
                }
            }

            if (isset($result_cocinandose) && is_array($result_cocinandose)) {
                foreach ($result_cocinandose as $key_documentos => $valor_documentos) {

                    if ($resultados == "recogidas") {
                        $query = "SELECT nombre FROM documentos_" . $bucle_ejercicios . "_libradores WHERE  id_documentos_1='" . $valor_documentos['id'] . "' LIMIT 1";
                    }else {
                        $query = "SELECT nombre,apellido_1,apellido_2,razon_social,razon_comercial,activo FROM libradores WHERE 
                                                    id='" . $valor_documentos['id_librador'] . "' LIMIT 1";
                    }
                    $result_librador = $conn->query($query);

                    $ejercicios_documentos_1_cocinandose[] = $bucle_ejercicios;
                    $id_documentos_1_cocinandose[] = $valor_documentos['id'];
                    $id_librador_documentos_1_cocinandose[] = $valor_documentos['id_librador'];
                    $bloqueado_documentos_1[] = $valor_documentos['bloqueado'];
                    $modalidad_pago_array_cocinandose[] = $valor_documentos['modalidad_pago'];

                    if ($resultados == "recogidas") {
                        $librador_documentos_1_cocinandose[] = stripslashes($result_librador[0]['nombre']);
                        $librador_activo_cocinandose[] = 1;
                    }else {
                        if (!empty($result_librador[0]['nombre'])) {
                            $librador_documentos_1_cocinandose[] = stripslashes($result_librador[0]['nombre']) . " " . stripslashes($result_librador[0]['apellido_1']) . " " . stripslashes($result_librador[0]['apellido_2']);
                        } else {
                            $librador_documentos_1_cocinandose[] = stripslashes($result_librador[0]['razon_social']) . "(" . stripslashes($result_librador[0]['razon_comercial']) . ")";
                        }
                        $librador_activo_cocinandose[] = $result_librador[0]['activo'];
                    }

                    $fecha_documento_documentos_1_cocinandose[] = $valor_documentos['fecha_documento'];
                    $numero_registro_documentos_1_cocinandose[] = (empty($valor_documentos['numero_registro']))? '' : $valor_documentos['numero_registro'];
                    $numero_documento_documentos_1_cocinandose[] = $valor_documentos['numero_documento'];
                    if(!empty($valor_documentos['serie_documento'])) {
                        $serie_documento_documentos_1_cocinandose[] = $valor_documentos['serie_documento']."/";
                    }else {
                        $serie_documento_documentos_1_cocinandose[] = "";
                    }
                    $total_documentos_1_cocinandose[] = number_format($valor_documentos['total'],2, ",", ".");

                    if($valor_documentos['estado'] == 0) {
                        $estado_documentos_1_cocinandose[] = "Abierto";
                    }else if($valor_documentos['estado'] == 1) {
                        if($tipo_documento == "fac" OR $tipo_documento == "tiq") {
                            $estado_documentos_1_cocinandose[] = "Cobrado parcial";
                        }else {
                            $estado_documentos_1_cocinandose[] = "Volcado parcial";
                        }
                    }else if($valor_documentos['estado'] == 2) {
                        if($tipo_documento == "fac" OR $tipo_documento == "tiq") {
                            $estado_documentos_1_cocinandose[] = "Cobrado";
                        }else {
                            $estado_documentos_1_cocinandose[] = "Volcado";
                        }
                    }

                    $id_usuario_documentos_1_cocinandose[] = $valor_documentos['id_usuario'];
                    if ($resultados == "recogidas" || $resultados == "entregas") {
                        $hora_documentos_1_cocinandose[] = $valor_documentos['hora_entrega'];
                    }else {
                        $hora_documentos_1_cocinandose[] = $valor_documentos['hora'];
                    }

                    $result_nota_documento = $conn->query("SELECT * FROM documentos_".$bucle_ejercicios."_observaciones WHERE id_documentos_1=".$valor_documentos['id']." 
                        AND id_documentos_2=0 LIMIT 1");
                    if($conn->registros() == 1) {
                        $observacion_documentos_1_cocinandose[] = nl2br(stripslashes($result_nota_documento[0]['observacion']));
                    }else {
                        $observacion_documentos_1_cocinandose[] = "";
                    }
                }
            }

            if (isset($result_pendiente_pago) && is_array($result_pendiente_pago)) {
                foreach ($result_pendiente_pago as $key_documentos => $valor_documentos) {

                    if ($resultados == "recogidas") {
                        $query = "SELECT nombre FROM documentos_" . $bucle_ejercicios . "_libradores WHERE  id_documentos_1='" . $valor_documentos['id'] . "' LIMIT 1";
                    }else {
                        $query = "SELECT nombre,apellido_1,apellido_2,razon_social,razon_comercial,activo FROM libradores WHERE 
                                                    id='" . $valor_documentos['id_librador'] . "' LIMIT 1";
                    }
                    $result_librador = $conn->query($query);

                    $ejercicios_documentos_1_pendiente_pago[] = $bucle_ejercicios;
                    $id_documentos_1_pendiente_pago[] = $valor_documentos['id'];
                    $id_librador_documentos_1_pendiente_pago[] = $valor_documentos['id_librador'];
                    $bloqueado_documentos_1[] = $valor_documentos['bloqueado'];
                    $modalidad_pago_array_pendiente_pago[] = $valor_documentos['modalidad_pago'];

                    if ($resultados == "recogidas") {
                        $librador_documentos_1_pendiente_pago[] = stripslashes($result_librador[0]['nombre']);
                        $librador_activo_pendiente_pago[] = 1;
                    }else {
                        if (!empty($result_librador[0]['nombre'])) {
                            $librador_documentos_1_pendiente_pago[] = stripslashes($result_librador[0]['nombre']) . " " . stripslashes($result_librador[0]['apellido_1']) . " " . stripslashes($result_librador[0]['apellido_2']);
                        } else {
                            $librador_documentos_1_pendiente_pago[] = stripslashes($result_librador[0]['razon_social']) . "(" . stripslashes($result_librador[0]['razon_comercial']) . ")";
                        }
                        $librador_activo_pendiente_pago[] = $result_librador[0]['activo'];
                    }

                    $fecha_documento_documentos_1_pendiente_pago[] = $valor_documentos['fecha_documento'];
                    $numero_registro_documentos_1_pendiente_pago[] = (empty($valor_documentos['numero_registro']))? '' : $valor_documentos['numero_registro'];
                    $numero_documento_documentos_1_pendiente_pago[] = $valor_documentos['numero_documento'];
                    if(!empty($valor_documentos['serie_documento'])) {
                        $serie_documento_documentos_1_pendiente_pago[] = $valor_documentos['serie_documento']."/";
                    }else {
                        $serie_documento_documentos_1_pendiente_pago[] = "";
                    }
                    $total_documentos_1_pendiente_pago[] = number_format($valor_documentos['total'],2, ",", ".");

                    if($valor_documentos['estado'] == 0) {
                        $estado_documentos_1_pendiente_pago[] = "Abierto";
                    }else if($valor_documentos['estado'] == 1) {
                        if($tipo_documento == "fac" OR $tipo_documento == "tiq") {
                            $estado_documentos_1_pendiente_pago[] = "Cobrado parcial";
                        }else {
                            $estado_documentos_1_pendiente_pago[] = "Volcado parcial";
                        }
                    }else if($valor_documentos['estado'] == 2) {
                        if($tipo_documento == "fac" OR $tipo_documento == "tiq") {
                            $estado_documentos_1_pendiente_pago[] = "Cobrado";
                        }else {
                            $estado_documentos_1_pendiente_pago[] = "Volcado";
                        }
                    }

                    $id_usuario_documentos_1_pendiente_pago[] = $valor_documentos['id_usuario'];
                    if ($resultados == "recogidas" || $resultados == "entregas") {
                        $hora_documentos_1_pendiente_pago[] = $valor_documentos['hora_entrega'];
                    }else {
                        $hora_documentos_1_pendiente_pago[] = $valor_documentos['hora'];
                    }

                    $result_nota_documento = $conn->query("SELECT * FROM documentos_".$bucle_ejercicios."_observaciones WHERE id_documentos_1=".$valor_documentos['id']." 
                        AND id_documentos_2=0 LIMIT 1");
                    if($conn->registros() == 1) {
                        $observacion_documentos_1_pendiente_pago[] = nl2br(stripslashes($result_nota_documento[0]['observacion']));
                    }else {
                        $observacion_documentos_1_pendiente_pago[] = "";
                    }
                }
            }

            if (isset($result_entregado) && is_array($result_entregado)) {
                foreach ($result_entregado as $key_documentos => $valor_documentos) {

                    if ($resultados == "recogidas") {
                        $query = "SELECT nombre FROM documentos_" . $bucle_ejercicios . "_libradores WHERE  id_documentos_1='" . $valor_documentos['id'] . "' LIMIT 1";
                    }else {
                        $query = "SELECT nombre,apellido_1,apellido_2,razon_social,razon_comercial,activo FROM libradores WHERE 
                                                    id='" . $valor_documentos['id_librador'] . "' LIMIT 1";
                    }
                    $result_librador = $conn->query($query);

                    $ejercicios_documentos_1_entregado[] = $bucle_ejercicios;
                    $id_documentos_1_entregado[] = $valor_documentos['id'];
                    $id_librador_documentos_1_entregado[] = $valor_documentos['id_librador'];
                    $bloqueado_documentos_1[] = $valor_documentos['bloqueado'];
                    $modalidad_pago_array_entregado[] = $valor_documentos['modalidad_pago'];

                    if ($resultados == "recogidas") {
                        $librador_documentos_1_entregado[] = stripslashes($result_librador[0]['nombre']);
                        $librador_activo_entregado[] = 1;
                    }else {
                        if (!empty($result_librador[0]['nombre'])) {
                            $librador_documentos_1_entregado[] = stripslashes($result_librador[0]['nombre']) . " " . stripslashes($result_librador[0]['apellido_1']) . " " . stripslashes($result_librador[0]['apellido_2']);
                        } else {
                            $librador_documentos_1_entregado[] = stripslashes($result_librador[0]['razon_social']) . "(" . stripslashes($result_librador[0]['razon_comercial']) . ")";
                        }
                        $librador_activo_entregado[] = $result_librador[0]['activo'];
                    }

                    $fecha_documento_documentos_1_entregado[] = $valor_documentos['fecha_documento'];
                    $numero_registro_documentos_1_entregado[] = (empty($valor_documentos['numero_registro']))? '' : $valor_documentos['numero_registro'];
                    $numero_documento_documentos_1_entregado[] = $valor_documentos['numero_documento'];
                    if(!empty($valor_documentos['serie_documento'])) {
                        $serie_documento_documentos_1_entregado[] = $valor_documentos['serie_documento']."/";
                    }else {
                        $serie_documento_documentos_1_entregado[] = "";
                    }
                    $total_documentos_1_entregado[] = number_format($valor_documentos['total'],2, ",", ".");

                    if($valor_documentos['estado'] == 0) {
                        $estado_documentos_1_entregado[] = "Abierto";
                    }else if($valor_documentos['estado'] == 1) {
                        if($tipo_documento == "fac" OR $tipo_documento == "tiq") {
                            $estado_documentos_1_entregado[] = "Cobrado parcial";
                        }else {
                            $estado_documentos_1_entregado[] = "Volcado parcial";
                        }
                    }else if($valor_documentos['estado'] == 2) {
                        if($tipo_documento == "fac" OR $tipo_documento == "tiq") {
                            $estado_documentos_1_entregado[] = "Cobrado";
                        }else {
                            $estado_documentos_1_entregado[] = "Volcado";
                        }
                    }

                    $id_usuario_documentos_1_entregado[] = $valor_documentos['id_usuario'];
                    if ($resultados == "recogidas" || $resultados == "entregas") {
                        $hora_documentos_1_entregado[] = $valor_documentos['hora_entrega'];
                    }else {
                        $hora_documentos_1_entregado[] = $valor_documentos['hora'];
                    }

                    $result_nota_documento = $conn->query("SELECT * FROM documentos_".$bucle_ejercicios."_observaciones WHERE id_documentos_1=".$valor_documentos['id']." 
                        AND id_documentos_2=0 LIMIT 1");
                    if($conn->registros() == 1) {
                        $observacion_documentos_1_entregado[] = nl2br(stripslashes($result_nota_documento[0]['observacion']));
                    }else {
                        $observacion_documentos_1_entregado[] = "";
                    }
                }
            }
        }

        $result_series = $conn->query("SELECT * FROM documentos_numeraciones_series ORDER BY tipo_documento, serie");
        $id_series = [];
        $tipo_documento_series = [];
        $descripcion_series = [];
        if ($conn->registros() >= 1) {
            foreach ($result_series as $key_series => $valor_series) {
                $id_series[] = $valor_series['id'];
                $tipo_documento_series[] = $valor_series['tipo_documento'];
                $descripcion_series[] = stripslashes($valor_series['serie']);
            }
        }

        if (!empty($descarga_url) && $descarga_url == 'csv') {
            $return = 'Número;Número registre;Cliente;Fecha;Hora;Total;Estado';

            foreach ($numero_documento_documentos_1 as $key => $valor) {
                $return .= "\n";
                $return .= $numero_documento_documentos_1[$key] . ';' . $numero_registro_documentos_1[$key] . ';' . $librador_documentos_1[$key] . ';' . $fecha_documento_documentos_1[$key] . ';' . $hora_documentos_1[$key] . ';' . $total_documentos_1[$key] . ';' . $estado_documentos_1[$key];
            }

            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=listado-" . $ejercicio . "-" . $select_sys . ".csv");
            echo $return;
            exit();
        } else {
            if (isset($ajax)) {
                echo json_encode([
                    'mostrar' => '',
                    'ejercicios_documentos_1' => $ejercicios_documentos_1,
                    'id_documento' => $id_documentos_1,
                    'id_librador' => $id_librador_documentos_1,
                    'bloqueado' => $bloqueado_documentos_1,
                    'librador_activo' => $librador_activo,
                    'librador' => $librador_documentos_1,
                    'fecha_documento' => $fecha_documento_documentos_1,
                    'numero_registro' => $numero_registro_documentos_1,
                    'numero_documento' => $numero_documento_documentos_1,
                    'serie_documento' => $serie_documento_documentos_1,
                    'total' => $total_documentos_1,
                    'estado' => $estado_documentos_1,
                    'id_usuario' => $id_usuario_documentos_1,
                    'hora' => $hora_documentos_1,
                    'observacion_documento' => $observacion_documentos_1,
                    'modalidad_pago' => $modalidad_pago_array
                ]);
            }
        }
        break;
    case "fecha-hora":
        $resultados_obtenidos = 0;
        $ejercicio_inicial = intval(substr($fecha_desde,0,4));
        $ejercicio_final = intval(substr($fecha_hasta,0,4));
        $total_documentos_sumados = 0;
        for ($bucle_ejercicios = $ejercicio_inicial ; $bucle_ejercicios <= $ejercicio_final ; $bucle_ejercicios++) {
            if ($interface == "tpv") {
                if (!isset($parametro_pagina)) {
                    $parametro_pagina = 0;
                }
                if (!isset($parametro_resultados)) {
                    $parametro_resultados = 10;
                }
                $anadidoLimit = "";
                if (empty($descarga_url)) {
                    $anadidoLimit = " LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados;
                }

                $anadidoIdLibrador = '';
                if (isset($id_librador) && $id_librador != "-1") {
                    $anadidoIdLibrador = " AND id_librador='" . $id_librador . "' ";
                }
                $anadidoSerie = '';
                if (isset($serie) && $serie != "-2") {
                    if ($serie == "-1") {
                        $anadidoSerie = " AND serie_documento='' ";
                    } else {
                        $anadidoSerie = " AND serie_documento='" . $serie . "' ";
                    }
                }
                if (($apartado == "global" || $apartado == "entregas" || $apartado == "recogidas") && ($tipo_librador == "cli" or $tipo_librador == "tak" or $tipo_librador == "del" or $tipo_librador == "mes")) {
                    $tipoLibradorQuery = "tipo_librador<>'pro' AND tipo_librador<>'cre'";
                    if ($apartado == "entregas" && ($tipo_librador == "cli" or $tipo_librador == "tak" or $tipo_librador == "del" or $tipo_librador == "mes")) {
                        $tipoLibradorQuery = "tipo_librador='del'";
                    } else if ($apartado == "recogidas" && ($tipo_librador == "cli" or $tipo_librador == "tak" or $tipo_librador == "del" or $tipo_librador == "mes")) {
                        $tipoLibradorQuery = "tipo_librador='tak'";
                    }

                    $query_results
                        = "SELECT COUNT(*) AS number_results FROM documentos_"
                        .$bucle_ejercicios."_1 WHERE 
                                                            tipo_documento='"
                        .addslashes($tipo_documento)."' AND 
                                                           " . $tipoLibradorQuery . "  AND 
                                                            fecha_documento>='"
                        .addslashes($fecha_desde)."' AND 
                                                            fecha_documento<='"
                        .addslashes($fecha_hasta)."' AND 
                                                            hora>='".addslashes(
                            $hora_desde
                        )."' AND 
                                                            hora<='".addslashes(
                            $hora_hasta
                        )."' 
                                                            ".$anadidoIdLibrador
                        .$anadidoSerie."
                                                            ORDER BY CAST(numero_documento as SIGNED INTEGER) DESC ";
                    $query = "SELECT * FROM documentos_".$bucle_ejercicios."_1 WHERE 
                                                            tipo_documento='"
                        .addslashes($tipo_documento)."' AND 
                                                            tipo_librador<>'pro' AND tipo_librador<>'cre' AND 
                                                            fecha_documento>='"
                        .addslashes($fecha_desde)."' AND 
                                                            fecha_documento<='"
                        .addslashes($fecha_hasta)."' AND 
                                                            hora>='".addslashes(
                            $hora_desde
                        )."' AND 
                                                            hora<='".addslashes(
                            $hora_hasta
                        )."' 
                                                            ".$anadidoIdLibrador
                        .$anadidoSerie."
                                                            ORDER BY CAST(numero_documento as SIGNED INTEGER) DESC "
                        .$anadidoLimit;
                } else {
                    $query_results = "SELECT COUNT(*) AS number_results FROM documentos_" . $bucle_ejercicios . "_1 WHERE 
                                                            tipo_documento='" . addslashes($tipo_documento) . "' AND 
                                                            tipo_librador='" . addslashes($tipo_librador) . "' AND 
                                                            fecha_documento>='" . addslashes($fecha_desde) . "' AND 
                                                            fecha_documento<='" . addslashes($fecha_hasta) . "' AND 
                                                            hora>='" . addslashes($hora_desde) . "' AND 
                                                            hora<='" . addslashes($hora_hasta) . "' 
                                                            " . $anadidoIdLibrador . $anadidoSerie . "
                                                            ORDER BY numero_registro DESC ";
                    $query = "SELECT * FROM documentos_" . $bucle_ejercicios . "_1 WHERE 
                                                            tipo_documento='" . addslashes($tipo_documento) . "' AND 
                                                            tipo_librador='" . addslashes($tipo_librador) . "' AND 
                                                            fecha_documento>='" . addslashes($fecha_desde) . "' AND 
                                                            fecha_documento<='" . addslashes($fecha_hasta) . "' AND 
                                                            hora>='" . addslashes($hora_desde) . "' AND 
                                                            hora<='" . addslashes($hora_hasta) . "' 
                                                            " . $anadidoIdLibrador . $anadidoSerie . "
                                                            ORDER BY numero_registro DESC " . $anadidoLimit;
                }

                $result = $conn->query($query_results);
                $resultsListadoFiltrado = $result[0]['number_results'];
                $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
                $result_documentos = $conn->query($query);
            } else {
                $query_results = "SELECT COUNT(*) AS number_results FROM documentos_" . $bucle_ejercicios . "_1 WHERE 
                                                            tipo_documento='" . addslashes($tipo_documento) . "' AND 
                                                            fecha_documento>='" . addslashes($fecha_desde) . "' AND 
                                                            fecha_documento<='" . addslashes($fecha_hasta) . "' AND 
                                                            hora>='" . addslashes($hora_desde) . "' AND 
                                                            hora<='" . addslashes($hora_hasta) . "' AND 
                                                            id_librador='" . $id_librador . "' ORDER BY CAST(numero_documento as SIGNED INTEGER) DESC ";
                $query = "SELECT * FROM documentos_" . $bucle_ejercicios . "_1 WHERE 
                                                            tipo_documento='" . addslashes($tipo_documento) . "' AND 
                                                            fecha_documento>='" . addslashes($fecha_desde) . "' AND 
                                                            fecha_documento<='" . addslashes($fecha_hasta) . "' AND 
                                                            hora>='" . addslashes($hora_desde) . "' AND 
                                                            hora<='" . addslashes($hora_hasta) . "' AND 
                                                            id_librador='" . $id_librador . "' ORDER BY CAST(numero_documento as SIGNED INTEGER) DESC " . $anadidoLimit;

                $result = $conn->query($query_results);
                $resultsListadoFiltrado = $result[0]['number_results'];
                $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
                $result_documentos = $conn->query($query);
            }

            $query1 = $query;
            if ($conn->registros() >= 1) {
                foreach ($result_documentos as $key_documentos => $valor_documentos) {
                    $resultados_obtenidos += 1;
                    $query = "SELECT nombre,apellido_1,apellido_2,razon_social,razon_comercial,email,activo FROM libradores WHERE 
                                                            id='" . $valor_documentos['id_librador'] . "' LIMIT 1";
                    $result_librador = $conn->query($query);

                    $ejercicios_documentos_1[] = $bucle_ejercicios;
                    $id_documentos_1[] = $valor_documentos['id'];
                    $id_librador_documentos_1[] = $valor_documentos['id_librador'];
                    $bloqueado_documentos_1[] = $valor_documentos['bloqueado'];
                    $modalidad_pago_array[] = $valor_documentos['modalidad_pago'];

                    if (!empty($result_librador[0]['nombre'])) {
                        $librador_documentos_1[] = stripslashes($result_librador[0]['nombre']) . " " . stripslashes($result_librador[0]['apellido_1']) . " " . stripslashes($result_librador[0]['apellido_2']);
                    } else {
                        $librador_documentos_1[] = stripslashes($result_librador[0]['razon_social']) . "(" . stripslashes($result_librador[0]['razon_comercial']) . ")";
                    }
                    $librador_activo[] = $result_librador[0]['activo'];
                    $email_librador[] = stripslashes($result_librador[0]['email']);

                    $fecha_documento_documentos_1[] = $valor_documentos['fecha_documento'];
                    $numero_registro_documentos_1[] = (empty($valor_documentos['numero_registro']))? '' : $valor_documentos['numero_registro'];
                    $numero_documento_documentos_1[] = $valor_documentos['numero_documento'];
                    if (!empty($valor_documentos['serie_documento'])) {
                        $serie_documento_documentos_1[] = $valor_documentos['serie_documento'] . "/";
                    } else {
                        $serie_documento_documentos_1[] = "";
                    }
                    $total_documentos_1[] = number_format($valor_documentos['total'],2, ",", ".");
                    $total_documentos_sumados += $valor_documentos['total'];

                    if ($valor_documentos['estado'] == 0) {
                        $estado_documentos_1[] = "Abierto";
                    } else if ($valor_documentos['estado'] == 1) {
                        if ($tipo_documento == "fac" or $tipo_documento == "tiq") {
                            $estado_documentos_1[] = "Cobrado parcial";
                        } else {
                            $estado_documentos_1[] = "Volcado parcial";
                        }
                    } else if ($valor_documentos['estado'] == 2) {
                        if ($tipo_documento == "fac" or $tipo_documento == "tiq") {
                            $estado_documentos_1[] = "Cobrado";
                        } else {
                            $estado_documentos_1[] = "Volcado";
                        }
                    }

                    $id_usuario_documentos_1[] = $valor_documentos['id_usuario'];
                    $hora_documentos_1[] = $valor_documentos['hora'];

                    if ($tipo_documento != "tiq") {
                        // Recogemos los datos de las lineas de los documentos, cantidades, descripciones... para poderlas volcar
                        $result_documentos_2 = $conn->query("SELECT id,descripcion_producto,detalles_producto,descripcion_oferta,
                                        referencia_producto,numero_serie,lote,cantidad,unidad,coste,importe,pvp_unidad,estado 
                                        FROM documentos_" . $bucle_ejercicios . "_2 
                                        WHERE id_documentos_1=" . $valor_documentos['id']);
                        foreach ($result_documentos_2 as $key_documentos_2 => $valor_documentos_2) {
                            $id_documentos_2[] = $valor_documentos_2['id'];
                            $id_documentos_2_1[] = $valor_documentos['id'];
                            $descripcion_producto_2[] = stripslashes($valor_documentos_2['descripcion_producto']);
                            $detalles_producto_2[] = stripslashes($valor_documentos_2['detalles_producto']);
                            $descripcion_oferta_2[] = stripslashes($valor_documentos_2['descripcion_oferta']);
                            $referencia_producto_2[] = stripslashes($valor_documentos_2['referencia_producto']);
                            $numero_serie_2[] = stripslashes($valor_documentos_2['numero_serie']);
                            $lote_2[] = stripslashes($valor_documentos_2['lote']);
                            $caducidad_2[] = stripslashes($valor_documentos_2['caducidad']);
                            $cantidad_2[] = $valor_documentos_2['cantidad'];
                            $unidad_2[] = stripslashes($valor_documentos_2['unidad']);
                            $coste_2[] = $valor_documentos_2['coste'];
                            $importe_2[] = $valor_documentos_2['importe'];
                            $pvp_unidad_2[] = $valor_documentos_2['pvp_unidad'];
                            if ($valor_documentos_2['estado'] == 0) {
                                $estado_lineas[] = 0;
                                $cantidad_2_volcada[] = 0;
                            } else if ($valor_documentos_2['estado'] == 1) {
                                if ($tipo_documento == "fac" or $tipo_documento == "tiq") {
                                    $estado_lineas[] = 1;
                                    $cantidad_2_volcada[] = 0;
                                } else {
                                    $estado_lineas[] = 1;
                                    // En $cantidad_2 tenemos la cantidad del documento a volcar
                                    // Obtenemos la cantidad o cantidades volcadas
                                    $result_documentos_2_anterior = $conn->query("SELECT SUM(cantidad) AS cantidad_volcada FROM documentos_" . $bucle_ejercicios . "_2 
                                            WHERE id_documento_2_anterior=" . $valor_documentos_2['id']);
                                    if ($result_documentos_2_anterior[0]['cantidad_volcada']) {
                                        $cantidad_2_volcada[] = $result_documentos_2_anterior[0]['cantidad_volcada'];
                                    } else {
                                        $cantidad_2_volcada[] = 0;
                                    }
                                }
                            } else if ($valor_documentos_2['estado'] == 2) {
                                if ($tipo_documento == "fac" or $tipo_documento == "tiq") {
                                    $estado_lineas[] = 2;
                                } else {
                                    $estado_lineas[] = 2;
                                }
                                $cantidad_2_volcada[] = 0;
                            }
                        }
                    }

                    $result_nota_documento = $conn->query("SELECT * FROM documentos_" . $bucle_ejercicios . "_observaciones WHERE id_documentos_1=" . $valor_documentos['id'] . " 
                                AND id_documentos_2=0 LIMIT 1");
                    if ($conn->registros() == 1) {
                        $observacion_documentos_1[] = nl2br(stripslashes($result_nota_documento[0]['observacion']));
                    } else {
                        $observacion_documentos_1[] = "";
                    }
                }
            }
            if($resultados_obtenidos >= $limite_registros) {
                break;
            }
        }

        $result_series = $conn->query("SELECT * FROM documentos_numeraciones_series ORDER BY tipo_documento, serie");
        $id_series = [];
        $tipo_documento_series = [];
        $descripcion_series = [];
        if ($conn->registros() >= 1) {
            foreach ($result_series as $key_series => $valor_series) {
                $id_series[] = $valor_series['id'];
                $tipo_documento_series[] = $valor_series['tipo_documento'];
                $descripcion_series[] = stripslashes($valor_series['serie']);
            }
        }

        $select_sys = "obtener_modelos";
        if (isset($ajax)) {
            $last_ajax = $ajax;
            unset($ajax);
        }
        require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-documentos.php");
        if (isset($last_ajax)) {
            $ajax = $last_ajax;
        }

        if (!empty($descarga_url) && $descarga_url == 'csv') {
            $return = 'Número;Número registre;Cliente;Fecha;Hora;Total;Estado';

            foreach ($numero_documento_documentos_1 as $key => $valor) {
                $return .= "\n";
                $return .= $numero_documento_documentos_1[$key] . ';' . $numero_registro_documentos_1[$key] . ';' . $librador_documentos_1[$key] . ';' . $fecha_documento_documentos_1[$key] . ';' . $hora_documentos_1[$key] . ';' . $total_documentos_1[$key] . ';' . $estado_documentos_1[$key];
            }

            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=listado-" . $ejercicio . "-" . $select_sys . ".csv");
            echo $return;
            exit();
        } else {
            if (isset($ajax)) {
                echo json_encode([
                    'resultados' => 'global-fecha-hora',
                    'mostrar' => $mostrar,
                    'ejercicios_documentos_1' => $ejercicios_documentos_1,
                    'id_documento' => $id_documentos_1,
                    'id_librador' => $id_librador_documentos_1,
                    'bloqueado' => $bloqueado_documentos_1,
                    'librador' => $librador_documentos_1,
                    'librador_activo' => $librador_activo,
                    'email_librador' => $email_librador,
                    'fecha_documento' => $fecha_documento_documentos_1,
                    'numero_registro' => $numero_registro_documentos_1,
                    'numero_documento' => $numero_documento_documentos_1,
                    'serie_documento' => $serie_documento_documentos_1,
                    'total' => $total_documentos_1,
                    'total_suma' => number_format($total_documentos_sumados,2, ",", "."),
                    'estado' => $estado_documentos_1,
                    'id_usuario' => $id_usuario_documentos_1,
                    'hora' => $hora_documentos_1,
                    'id_documentos_2' => $id_documentos_2,
                    'id_documentos_2_1' => $id_documentos_2_1,
                    'descripcion_producto_2' => $descripcion_producto_2,
                    'detalles_producto_2' => $detalles_producto_2,
                    'descripcion_oferta_2' => $descripcion_oferta_2,
                    'referencia_producto_2' => $referencia_producto_2,
                    'numero_serie_2' => $numero_serie_2,
                    'lote_2' => $lote_2,
                    'caducidad_2' => $caducidad_2,
                    'cantidad_2' => $cantidad_2,
                    'cantidad_2_volcada' => $cantidad_2_volcada,
                    'unidad_2' => $unidad_2,
                    'coste_2' => $coste_2,
                    'pvp_unidad_2' => $pvp_unidad_2,
                    'observacion_documento' => $observacion_documentos_1,
                    'modalidad_pago' => $modalidad_pago_array,
                    'id_series' => $id_series,
                    'tipo_documento_series' => $tipo_documento_series,
                    'descripcion_series' => $descripcion_series,
                    'estado_lineas' => $estado_lineas,
                    'id_modelos_impresion_1' => $id_modelos_impresion_1,
                    'descripcion_modelos_impresion_1' => $descripcion_modelos_impresion_1,
                    'predeterminado_modelos_impresion_1' => $predeterminado_modelos_impresion_1
                ]);
            }
        }

        break;
    case "fecha-hora-iva":
        /* Opciones mostrar
            iva-1t
            iva-2t
            iva-3t
            iva-4t
            iva-ejercicio
        */

        break;
    case "fecha-hora-cierre-caja-extendido":

        break;
    case "fecha-hora-cierre-caja":
        $datos_cierre_terminales = [];

        $result_terminales = $conn->query("SELECT id,descripcion FROM terminales WHERE activo=1 ORDER BY descripcion");
        foreach ($result_terminales as $key_terminales => $valor_terminales) {
            $terminalGenerico = new stdClass();
            $terminalGenerico->terminal = stripslashes($valor_terminales['descripcion']);
            $terminalGenerico->bancos = [];
            $terminalGenerico->importe = 0;
            $datos_cierre_terminales[$valor_terminales['id']] =  $terminalGenerico;
        }

        $result_bancos_cajas = $conn->query("SELECT * FROM bancos_cajas ORDER BY descripcion");
        $result_modalidades_pago = $conn->query("SELECT * FROM modalidades_pago ORDER BY descripcion");
        $result_usuarios = $conn->query("SELECT id,usuario FROM usuarios ORDER BY usuario");
        $result_metodos_pago = $conn->query("SELECT * FROM metodos_pago ORDER BY descripcion");
        foreach ($datos_cierre_terminales as $key_terminales => $valor_terminales) {
            $bancoAInsertar = new stdClass();
            $bancoAInsertar->banco = 'Indefinido';
            $bancoAInsertar->modalidades = [];
            $datos_cierre_terminales[$key_terminales]->bancos[0] = $bancoAInsertar;
            anadirModalidadesUsuariosMetodos($result_modalidades_pago, $result_usuarios, $result_metodos_pago, $key_terminales, 0, $datos_cierre_terminales);
            foreach ($result_bancos_cajas as $key_bancos_cajas => $valor_bancos_cajas) {
                $bancoAInsertar = new stdClass();
                $bancoAInsertar->banco = stripslashes($valor_bancos_cajas['descripcion']);
                $bancoAInsertar->modalidades = [];
                $datos_cierre_terminales[$key_terminales]->bancos[$valor_bancos_cajas['id']] = $bancoAInsertar;
                anadirModalidadesUsuariosMetodos($result_modalidades_pago, $result_usuarios, $result_metodos_pago, $key_terminales, $valor_bancos_cajas['id'], $datos_cierre_terminales);
            }
        }

        $ejercicio_inicial = intval(substr($fecha_desde,0,4));
        $ejercicio_final = intval(substr($fecha_hasta,0,4));
        for ($bucle_ejercicios = $ejercicio_inicial ; $bucle_ejercicios <= $ejercicio_final ; $bucle_ejercicios++) {
            $query = "SELECT documentos_" . $bucle_ejercicios . "_recibos.importe,
                            documentos_" . $bucle_ejercicios . "_recibos.id_banco_caja_ingreso,
                            documentos_" . $bucle_ejercicios . "_recibos.id_metodo_pago,
                            documentos_" . $bucle_ejercicios . "_recibos.id_modalidad_pago,
                            documentos_" . $bucle_ejercicios . "_1.id_terminal, 
                            documentos_" . $bucle_ejercicios . "_recibos.id_usuario_pago 
                            FROM documentos_" . $bucle_ejercicios . "_1 JOIN documentos_" . $bucle_ejercicios . "_recibos ON documentos_" . $bucle_ejercicios . "_1.id=documentos_" . $bucle_ejercicios . "_recibos.id_documento   
                            WHERE 
                            documentos_" . $bucle_ejercicios . "_1.tipo_documento='" . addslashes($tipo_documento) . "' AND 
                            documentos_" . $bucle_ejercicios . "_1.tipo_librador<>'pro' AND tipo_librador<>'cre' AND  
                            documentos_" . $bucle_ejercicios . "_recibos.fecha_pago>='" . addslashes($fecha_desde) . "' AND 
                            documentos_" . $bucle_ejercicios . "_recibos.fecha_pago<='" . addslashes($fecha_hasta) . "' AND 
                            documentos_" . $bucle_ejercicios . "_recibos.hora_pago>='" . addslashes($hora_desde) . "' AND 
                            documentos_" . $bucle_ejercicios . "_recibos.hora_pago<='" . addslashes($hora_hasta) . "'  AND 
                            documentos_" . $bucle_ejercicios . "_recibos.pagado=1 
                            ORDER BY 
                            documentos_" . $bucle_ejercicios . "_recibos.fecha_pago ASC, 
                            documentos_" . $bucle_ejercicios . "_recibos.hora_pago ASC";
            $result_documentos = $conn->query($query);
            $query1 = $query;
            if ($conn->registros() >= 1) {
                foreach ($result_documentos as $key_documentos => $valor_documentos) {
                    if (!isset($datos_cierre_terminales[$valor_documentos['id_terminal']])) {
                        continue;
                    }
                    if (!isset($datos_cierre_terminales[$valor_documentos['id_terminal']]->bancos[$valor_documentos['id_banco_caja_ingreso']])) {
                        continue;
                    }
                    if (!isset($datos_cierre_terminales[$valor_documentos['id_terminal']]->bancos[$valor_documentos['id_banco_caja_ingreso']]->modalidades[$valor_documentos['id_modalidad_pago']])) {
                        continue;
                    }
                    if (!isset($datos_cierre_terminales[$valor_documentos['id_terminal']]->bancos[$valor_documentos['id_banco_caja_ingreso']]->modalidades[$valor_documentos['id_modalidad_pago']]->usuarios[$valor_documentos['id_usuario_pago']])) {
                        continue;
                    }
                    if (!isset($datos_cierre_terminales[$valor_documentos['id_terminal']]->bancos[$valor_documentos['id_banco_caja_ingreso']]->modalidades[$valor_documentos['id_modalidad_pago']]->usuarios[$valor_documentos['id_usuario_pago']]->metodos[$valor_documentos['id_metodo_pago']])) {
                        continue;
                    }
                    $datos_cierre_terminales[$valor_documentos['id_terminal']]->importe += $valor_documentos['importe'];
                    $datos_cierre_terminales[$valor_documentos['id_terminal']]->bancos[$valor_documentos['id_banco_caja_ingreso']]->modalidades[$valor_documentos['id_modalidad_pago']]->importe += $valor_documentos['importe'];
                    $datos_cierre_terminales[$valor_documentos['id_terminal']]->bancos[$valor_documentos['id_banco_caja_ingreso']]->modalidades[$valor_documentos['id_modalidad_pago']]->usuarios[$valor_documentos['id_usuario_pago']]->importe += $valor_documentos['importe'];
                    $datos_cierre_terminales[$valor_documentos['id_terminal']]->bancos[$valor_documentos['id_banco_caja_ingreso']]->modalidades[$valor_documentos['id_modalidad_pago']]->usuarios[$valor_documentos['id_usuario_pago']]->metodos[$valor_documentos['id_metodo_pago']]->importe += $valor_documentos['importe'];
                }
            }else {
                $modalidades_pago = "Sin datos.";
            }
        }
        if (isset($ajax)) {
            echo json_encode([
                'resultados' => 'fecha-hora-cierre-caja',
                'mostrar' => $mostrar,
                'datos_cierre' => $datos_cierre_terminales
            ]);
        }
        break;
    case "fecha-hora-cierre-caja-pagos":

        break;
}
unset($conn);