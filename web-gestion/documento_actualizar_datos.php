<?php
$funcion_origen = (empty($_POST['funcion_origen']))? null : $_POST['funcion_origen'];

$result = $conn->query("SELECT * FROM datos_empresa LIMIT 1");
if($conn->registros() == 1) {
    $nombre_fiscal = stripslashes($result[0]['nombre_fiscal']);
    $nombre_comercial = stripslashes($result[0]['nombre_comercial']);
    $nif = stripslashes($result[0]['nif']);
    $direccion = stripslashes($result[0]['direccion']);
    $codigo_postal = stripslashes($result[0]['codigo_postal']);
    $poblacion = stripslashes($result[0]['poblacion']);
    $provincia = stripslashes($result[0]['provincia']);
    $tel1 = stripslashes($result[0]['tel1']);
    $tel2 = stripslashes($result[0]['tel2']);
    $movil = stripslashes($result[0]['movil']);
    $fax = stripslashes($result[0]['fax']);
    $email = stripslashes($result[0]['email']);
    $logo_empresa = "../images/datos_empresa/".stripslashes($result[0]['logo']);
    if(file_exists($logo_empresa)) {
        $logo = stripslashes($result[0]['logo']);
    }else {
        $logo = "";
    }
}

$result = $conn->query("SELECT * FROM documentos_".$ejercicio."_1 WHERE id=".$id_documento_1." LIMIT 1");
if($conn->registros() == 1) {
    $descuento_pp = $result[0]['descuento_pp'];
    $descuento_librador = $result[0]['descuento_librador'];

    $tipo_documento = $result[0]['tipo_documento'];
    $tipo_librador = $result[0]['tipo_librador'];
    $id_librador = $result[0]['id_librador'];
    $fecha_documento = $result[0]['fecha_documento'];
    $fecha_entrada = $result[0]['fecha_entrada'];
    $numero_documento = $result[0]['numero_documento'];
    $serie_documento = stripslashes($result[0]['serie_documento']);
    $modalidad_pago = stripslashes($result[0]['modalidad_pago']);
    $modalidad_envio = stripslashes($result[0]['modalidad_envio']);
    $modalidad_entrega = stripslashes($result[0]['modalidad_entrega']);
    $result_modalidades_pago = $conn->query("SELECT id FROM modalidades_pago WHERE descripcion='".stripslashes($result[0]['modalidad_pago'])."' LIMIT 1");
    if($conn->registros() == 1) {
        $id_modalidad_pago = stripslashes($result_modalidades_pago[0]['id']);
    }else {
        $id_modalidad_pago = 0;
    }
    $result_modalidades_envio = $conn->query("SELECT id FROM modalidades_envio WHERE descripcion='".stripslashes($result[0]['modalidad_envio'])."' LIMIT 1");
    if($conn->registros() == 1) {
        $id_modalidad_envio = stripslashes($result_modalidades_envio[0]['id']);
    }else {
        $id_modalidad_envio = 0;
    }
    $result_modalidades_entrega = $conn->query("SELECT id FROM modalidades_entrega WHERE descripcion='".stripslashes($result[0]['modalidad_entrega'])."' LIMIT 1");
    if($conn->registros() == 1) {
        $id_modalidad_entrega = stripslashes($result_modalidades_entrega[0]['id']);
    }else {
        $id_modalidad_entrega = 0;
    }
    $irpf = intval($result[0]['irpf']);
    $importe_irpf = $result[0]['importe_irpf'];
    $descuento_pp = $result[0]['descuento_pp'];
    $importe_descuento_pp = $result[0]['importe_descuento_pp'];
    $descuento_librador = $result[0]['descuento_librador'];
    $importe_descuento_librador = $result[0]['importe_descuento_librador'];
    $total = $result[0]['total'];
    $estado_1 = $result[0]['estado'];
    $id_usuario_documento = $result[0]['id_usuario'];
    $comensales = $result[0]['comensales'];
    $id_terminal_1 = $result[0]['id_terminal'];

    $result_usuario_documento = $conn->query("SELECT usuario FROM usuarios WHERE id=".$result[0]['id_usuario']." LIMIT 1");
    if($conn->registros() == 1) {
        $usuario_documento = stripslashes($result_usuario_documento[0]['usuario']);
    }else {
        $usuario_documento = "";
    }

    $result_nota_documento = $conn->query("SELECT * FROM documentos_".$ejercicio."_observaciones WHERE id_documentos_1=".$id_documento_1." AND id_documentos_2=0 LIMIT 1");
    if($conn->registros() == 1) {
        $nota_documento = nl2br(stripslashes($result_nota_documento[0]['observacion']));
    }else {
        $nota_documento = "";
    }
}

$result_libradores = $conn->query("SELECT * FROM documentos_".$ejercicio."_libradores WHERE id_documentos_1='".$id_documento_1."' LIMIT 1");
if($conn->registros() == 1) {
    $nombre_librador = stripslashes($result_libradores[0]['nombre']);
    $apellido_1_librador = stripslashes($result_libradores[0]['apellido_1']);
    $apellido_2_librador = stripslashes($result_libradores[0]['apellido_2']);
    $razon_social_librador = stripslashes($result_libradores[0]['razon_social']);
    $nif_librador = stripslashes($result_libradores[0]['nif']);
    $direccion_librador = stripslashes($result_libradores[0]['direccion']);
    $numero_librador = stripslashes($result_libradores[0]['numero']);
    $escalera_librador = stripslashes($result_libradores[0]['escalera']);
    $piso_librador = stripslashes($result_libradores[0]['piso']);
    $puerta_librador = stripslashes($result_libradores[0]['puerta']);
    $codigo_postal_librador = stripslashes($result_libradores[0]['codigo_postal']);
    $localidad_librador = stripslashes($result_libradores[0]['localidad']);
    $provincia_librador = stripslashes($result_libradores[0]['provincia']);
    $telefono_1_librador = stripslashes($result_libradores[0]['telefono_1']);
    $telefono_2_librador = stripslashes($result_libradores[0]['telefono_2']);
    $movil_librador = stripslashes($result_libradores[0]['movil']);
    $email_librador = stripslashes($result_libradores[0]['email']);
    $persona_contacto_librador = stripslashes($result_libradores[0]['persona_contacto']);
}

$result_iva = $conn->query("SELECT id,iva,recargo FROM productos_iva WHERE activo=1 ORDER BY iva");
foreach ($result_iva as $key_iva => $valor_iva) {
    $indice[] = $valor_iva['id'];
    $base_iva[] = 0.00;
    $iva[] = $valor_iva['iva'];
    $importe_iva[] = 0.00;
    $recargo[] = $valor_iva['recargo'];
    $importe_recargo[] = 0.00;
}

$result_configuracion = $conn->query("SELECT pvp_iva_incluido FROM configuracion");
$pvp_iva_incluido = 0;
if ($conn->registros() >= 1) {
    $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
}

$sub_orden = [];
$sub_cantidad = [];
$orden_descripcion_cantidades = [];
$orden_cantidades = [];

$result_2 = $conn->query("SELECT * FROM documentos_".$ejercicio."_2 WHERE id_documentos_1=".$id_documento_1." ORDER BY id");
if($conn->registros() >= 1) {
    foreach ($result_2 as $key => $valor) {
        $result_iva = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_iva WHERE id_documentos_2='" . $valor['id'] . "' LIMIT 1");

        if ($funcion_origen == "actualizarCesta") {
            /*
             * Valores de funcion_origen:
                    actualizarCesta
                    productosCobro
                    datosCobrar
                    imprimirDocumento
            */
            require("documento_actualizar_relacionados.php");
        }

        $id_documento_2[] = $valor['id'];
        $fecha[] = $valor['fecha'];
        $id_producto[] = $valor['id_producto'];
        $id_productos_detalles_enlazado[] = $valor['id_productos_detalles_enlazado'];
        $id_productos_detalles_multiples[] = $valor['id_productos_detalles_multiples'];
        $id_packs[] = $valor['id_packs'];
        $slug[] = stripslashes($valor['slug']);
        $tipo_producto[] = $valor['tipo_producto'];

        if(strpos($valor['imagen_producto'], "www.")) {
            $url_imagen = $valor['imagen_producto'];
        }else {
            $url_imagen = $_SERVER['HTTP_HOST']."/images/productos/" . $id_panel . "/" .$valor['imagen_producto'];
        }
        $imagen_producto[] = $url_imagen;

        $descripcion_producto[] = stripslashes($valor['descripcion_producto']);
        $detalles_producto[] = stripslashes($valor['detalles_producto']);
        $descripcion_oferta[] = stripslashes($valor['descripcion_oferta']);
        $codigo_barras_producto[] = stripslashes($valor['codigo_barras_producto']);
        $referencia_producto[] = stripslashes($valor['referencia_producto']);
        $referencia_librador[] = stripslashes($valor['referencia_librador']);
        $numero_serie_producto[] = stripslashes($valor['numero_serie']);
        $lote_producto[] = stripslashes($valor['lote']);
        $caducidad_producto[] = $valor['caducidad'];
        $cantidad[] = number_format($valor['cantidad'], $decimales_cantidades, ".", "");
        $id_unidades[] = $valor['id_unidades'];
        $unidad[] = $valor['unidad'];
        $coste[] = number_format($valor['coste'], $decimales_importes, ".", "");
        $importe[] = number_format($valor['importe'], $decimales_importes, ".", "");
        $importe_fijo[] = number_format($valor['importe_fijo'], $decimales_importes, ".", "");
        $base_antes_descuento[] = number_format($valor['base_antes_descuento'], $decimales_importes, ".", "");
        $base_despues_descuento[] = number_format($valor['base_despues_descuento'], $decimales_importes, ".", "");
        $importe_descuento_base[] = number_format($valor['importe_descuento_base'], $decimales_importes, ".", "");
        $importe_descuento_total[] = number_format($valor['importe_descuento_total'], $decimales_importes, ".", "");
        $descuento_base[] = $valor['descuento_base'];
        $descuento_total[] = $valor['descuento_total'];
        if ($pvp_iva_incluido) {
            $pvp_unidad[] = $valor['pvp_unidad'];
            $pvp_unidad_sin_incrementos[] = number_format($valor['pvp_unidad_sin_incrementos'], $decimales_importes, ".", "");
            $total_antes_descuento[] = number_format($valor['total_antes_descuento'], 2, ".", "");
            $total_despues_descuento[] = number_format($valor['total_despues_descuento'], 2, ".", "");
        } else {
            $pvp_unidad[] = ($valor['pvp_unidad'] / (1 + ($valor['iva'] / 100)));
            $pvp_unidad_sin_incrementos[] = number_format(($valor['pvp_unidad_sin_incrementos'] / (1 + (($valor['iva'] + $valor['recargo']) / 100))), $decimales_importes, ".", "");
            $total_antes_descuento[] = number_format(($valor['total_antes_descuento'] / (1 + ($valor['iva'] / 100))), 2, ".", "");
            $total_despues_descuento[] = number_format(($valor['total_despues_descuento'] / (1 + ($valor['iva'] / 100))), 2, ".", "");
        }

        $id_documento_anterior[] = $valor['id_documento_2_anterior'];
        if (!empty($valor['id_documento_2_anterior'])) {
            $result_documento_anterior = $conn->query("SELECT d1.numero_documento, d1.tipo_documento FROM documentos_".$ejercicio."_2 d2 JOIN documentos_".$ejercicio."_1 d1 ON d2.id_documentos_1 = d1.id WHERE d2.id=".$valor['id_documento_2_anterior']." LIMIT 1");
            if($conn->registros() == 1) {
                $numero_documento_anterior[] = nl2br(stripslashes($result_documento_anterior[0]['numero_documento']));
                $tipo_documento_anterior[] = nl2br(stripslashes($result_documento_anterior[0]['tipo_documento']));
            }else {
                $numero_documento_anterior[] = "";
                $tipo_documento_anterior[] = "";
            }
        } else {
            $numero_documento_anterior[] = "";
            $tipo_documento_anterior[] = "";
        }

        $id_vendedor[] = $valor['id_vendedor'];
        $estado_2[] = $valor['estado'];
        $id_usuario[] = $valor['id_usuario'];
        $orden[] = $valor['orden'];
        $hora[] = $valor['hora'];
        $id_terminal_2[] = $valor['id_terminal'];

        if ($funcion_origen == "imprimirDocumento") {
            /*
             * Valores de funcion_origen:
                    actualizarCesta
                    productosCobro
                    datosCobrar
                    imprimirDocumento
            */
            require("documento_actualizar_relacionados.php");
        }

        //$result_iva = $conn->query("SELECT * FROM documentos_".$ejercicio."_iva WHERE id_documentos_1=".$id_documento_1." AND id_documentos_2=".$valor['id']);
        if (is_array($result_iva)) {
            foreach ($result_iva as $key_iva => $valor_iva) {
                if ($valor_iva['id_documentos_2'] == $valor['id']) {
                    foreach ($iva as $key_iva_matriz => $valor_iva_matriz) {
                        if($valor_iva['iva'] == $valor_iva_matriz) {
                            $base_linea = number_format($valor_iva['base'], 2, ".", "");
                            if($descuento_pp != 0) {
                                $base_linea = number_format($base_linea - ($valor_iva['base'] / 100 * $descuento_pp), 2, ".", "");
                            }
                            if($descuento_librador != 0) {
                                $base_linea = number_format($base_linea - ($valor_iva['base'] / 100 * $descuento_librador), 2, ".", "");
                            }
                            $importe_iva_a_sumar = number_format(($base_linea / 100 * $valor_iva["iva"]), 2, ".", "");
                            $importe_recargo_a_sumar = number_format(($base_linea / 100 * $valor_iva["recargo"]), 2, ".", "");

                            if ($base_linea + $importe_iva_a_sumar + $importe_recargo_a_sumar > $valor['total_despues_descuento']) {
                                $base_linea -= 0.01;
                            }

                            $base_iva[$key_iva_matriz] += $base_linea;
                            $importe_iva[$key_iva_matriz] = ($importe_iva[$key_iva_matriz] + $importe_iva_a_sumar);
                            $importe_recargo[$key_iva_matriz] = ($importe_recargo[$key_iva_matriz] + $importe_recargo_a_sumar);
                        }
                    }
                }
            }
        }

        $result_nota_producto = $conn->query("SELECT * FROM documentos_".$ejercicio."_observaciones WHERE id_documentos_2=".$valor['id']." AND id_documentos_combo = 0 LIMIT 1");
        if($conn->registros() == 1) {
            $nota_producto[] = nl2br(stripslashes($result_nota_producto[0]['observacion']));
        }else {
            $nota_producto[] = "";
        }

        $result_combo = $conn->query("SELECT id_grupo,cantidad FROM documentos_".$ejercicio."_productos_relacionados_combo WHERE id_documentos_2=".$valor['id']." ORDER BY id_grupo");
        if($conn->registros() >= 1) {
            foreach ($result_combo as $key_combo => $valor_combo) {
                $result_grupos = $conn->query("SELECT descripcion FROM productos_relacionados_grupos WHERE id=".$valor_combo['id_grupo']." LIMIT 1");
                if($conn->registros() == 1) {
                    $sub_orden[] = stripslashes($result_grupos[0]['descripcion']);
                    $sub_cantidad[] = $valor_combo['cantidad'];
                }
            }
        }
    }
    $base = 0;
    $impuestos = 0;
    foreach ($base_iva as $key_base_iva => $base_iva_individual) {
        $base += $base_iva_individual;
        $impuestos += (number_format($base_iva_individual / 100 * $iva[$key_base_iva], 2, ".", ""));
        if ($recargoLibrador) {
            $impuestos += (number_format($base_iva_individual / 100 * $recargo[$key_base_iva], 2, ".", ""));
        }
    }
    if ($base + $impuestos > $total) {
        $base_iva[$key_base_iva] -= 0.01;
    }

    foreach ($orden as $key_orden => $valor_orden) {
        if(empty($valor_orden)) {
            continue;
        }
        if(!isset($orden_descripcion_cantidades)) {
            $orden_descripcion_cantidades[] = $valor_orden;
            $orden_cantidades[] = $cantidad[$key_orden];
        }else {
            $clave = array_search($valor_orden, $orden_descripcion_cantidades);
            if($clave !== false) {
                $orden_cantidades[$clave] += $cantidad[$key_orden];
            }else {
                $orden_descripcion_cantidades[] = $valor_orden;
                $orden_cantidades[] = $cantidad[$key_orden];
            }
        }
    }
    foreach ($sub_orden as $key_sub_orden => $valor_sub_orden) {
        if (empty($valor_sub_orden)) {
            continue;
        }
        if (!isset($orden_descripcion_cantidades)) {
            $orden_descripcion_cantidades[] = $valor_sub_orden;
            $orden_cantidades[] = $sub_cantidad[$key_sub_orden];
        } else {
            $clave = array_search($valor_sub_orden, $orden_descripcion_cantidades);
            if ($clave !== false) {
                $orden_cantidades[$clave] += $sub_cantidad[$key_sub_orden];
            } else {
                $orden_descripcion_cantidades[] = $valor_sub_orden;
                $orden_cantidades[] = $sub_cantidad[$key_sub_orden];
            }
        }
    }
}

if($result[0]['tipo_documento'] == "fac" OR $result[0]['tipo_documento'] == "tiq") {
    $result_recibos = $conn->query("SELECT * FROM documentos_".$ejercicio."_recibos WHERE id_documento=".$id_documento_1." ORDER BY numero_efecto");
    if($conn->registros() >= 1) {
        foreach ($result_recibos as $key_recibos => $valor_recibos) {
            $result_metodos_pago = $conn->query("SELECT descripcion FROM metodos_pago WHERE id=".$valor_recibos['id_metodo_pago']." LIMIT 1");
            if($conn->registros() == 1) {
                $metodos_pago[] = stripslashes($result_metodos_pago[0]['descripcion']);
            }
            $id_recibos[] = $valor_recibos['id'];
            $importe_recibos[] = $valor_recibos['importe'];
            $fecha_recibos[] = $valor_recibos['fecha'];
            $vencimiento_recibos[] = $valor_recibos['vencimiento'];
            $pagado_recibos[] = $valor_recibos['pagado'];
            $fecha_pago_recibos[] = $valor_recibos['fecha_pago'];
            $id_banco_caja_ingreso_recibos[] = $valor_recibos['id_banco_caja_ingreso'];
            $id_metodo_pago_recibos[] = $valor_recibos['id_metodo_pago'];
            $id_modalidad_pago_recibos[] = $valor_recibos['id_modalidad_pago'];
            $numero_efecto_recibos[] = $valor_recibos['numero_efecto'];
            $id_usuario_pago_recibos[] = $valor_recibos['id_usuario_pago'];
            $impreso_recibos[] = $valor_recibos['impreso'];
            $documento_bancario[] = stripslashes($valor_recibos['documento_bancario']);
            $vencimiento_documento_bancario[] = $valor_recibos['vencimiento_documento_bancario'];
            $nota[] = stripslashes($valor_recibos['nota']);
        }

        $result_otros = $conn->query("SELECT id,descripcion,iban FROM bancos_cajas WHERE activo=1 ORDER BY descripcion");
        foreach ($result_otros as $key_otros => $valor_otros) {
            $id_bancos_cajas_ingreso_recibos[] = $valor_otros['id'];
            $bancos_cajas_ingreso_recibos[] = stripslashes($valor_otros['descripcion']);
            $iban_bancos_cajas_ingreso_recibos[] = stripslashes($valor_otros['iban']);
        }
        $result_otros = $conn->query("SELECT id,descripcion FROM metodos_pago WHERE activo=1 ORDER BY orden,descripcion");
        foreach ($result_otros as $key_otros => $valor_otros) {
            $id_metodos_pago_recibos[] = $valor_otros['id'];
            $metodos_pago_recibos[] = stripslashes($valor_otros['descripcion']);
        }
        $result_otros = $conn->query("SELECT id,usuario FROM usuarios WHERE bloqueo=0 ORDER BY usuario");
        foreach ($result_otros as $key_otros => $valor_otros) {
            $id_usuarios_pago_recibos[] = $valor_otros['id'];
            $usuarios_pago_recibos[] = stripslashes($valor_otros['usuario']);
        }
    }
}