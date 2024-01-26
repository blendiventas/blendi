<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$result_iva = $conn->query("SELECT id,iva,recargo FROM productos_iva WHERE activo=1 ORDER BY iva");
foreach ($result_iva as $key_iva => $valor_iva) {
    $indice[] = $valor_iva['id'];
    $base_iva[] = 0.00;
    $iva[] = $valor_iva['iva'];
    $importe_iva[] = 0.00;
    $recargo[] = $valor_iva['recargo'];
    $importe_recargo[] = 0.00;
}

/*
CREATE TABLE `configuracion` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_librador` INT(11) NOT NULL DEFAULT '0',
	`id_librador_tak` INT(11) NOT NULL DEFAULT '0',
	`servicio_domicilio` TINYINT(1) NOT NULL DEFAULT '0',
	`pvp_iva_incluido` TINYINT(1) NOT NULL DEFAULT '0',
	`mostrar_precios_tpv` TINYINT(1) NOT NULL DEFAULT '1',
	`mostrar_mas_vendidos` TINYINT(1) NOT NULL DEFAULT '1',
	`color_letra_botones` VARCHAR(7) NOT NULL DEFAULT '#ffffff' COLLATE 'utf8_spanish_ci',
	`color_fondo_botones` VARCHAR(7) NOT NULL DEFAULT '#156772' COLLATE 'utf8_spanish_ci',
	`tipo_menu_superior` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 - Norma\r\n1 - scroll',
	`filas_menu` TINYINT(1) NOT NULL DEFAULT '2',
	`decimales_cantidades` TINYINT(1) NOT NULL DEFAULT '2',
	`decimales_importes` TINYINT(1) NOT NULL DEFAULT '3',
	`fecha_modificacion` DATE NULL DEFAULT NULL,
*/
$query = "SELECT pvp_iva_incluido FROM configuracion LIMIT 1";
$pvp_iva_incluido = $conn->query($query);


$query = "SELECT * FROM productos_relacionados_grupos ORDER BY orden ASC";
$grupos = $conn->query($query);

$query = "SELECT * FROM documentos_".$ejercicio."_1 WHERE id='" . $id_documento_1 . "' LIMIT 1";
$pedidos = $conn->query($query);

$total = 0;
$recepcionDePedidos = [];
$cantidadArticulos = 0;
if ($conn->registros() > 0) {
    foreach ($pedidos as $pedido) {
        $total = number_format($pedido['total'], 2, ',', '.');
        $productosPorGrupos = [];
        $productosPorGrupo = new stdClass();
        $productosPorGrupo->nombre = '';
        $productosPorGrupo->productos = [];
        $productosPorGrupos[] = $productosPorGrupo;
        foreach ($grupos as $grupo) {
            $productosPorGrupo = new stdClass();
            $productosPorGrupo->id = $grupo['id'];
            $productosPorGrupo->nombre = stripslashes($grupo['descripcion']);
            $productosPorGrupo->productos = [];

            $productosPorGrupos[] = $productosPorGrupo;
        }

        $recepcionDePedido = new stdClass();
        $recepcionDePedido->id_documento_1 = $pedido['id'];
        $recepcionDePedido->numero_documento = $pedido['numero_documento'];
        $recepcionDePedido->comensales = $pedido['comensales'];
        $recepcionDePedido->fecha_hora = $pedido['fecha_documento']." ".$pedido['hora'];
        $recepcionDePedido->productosPorGrupo = $productosPorGrupos;

        $query_libradores = "SELECT * FROM documentos_".$ejercicio."_libradores WHERE id_documentos_1='" . $pedido['id'] . "' LIMIT 1";
        $libradores = $conn->query($query_libradores);
        $nombre_librador = '';
        if (!empty($libradores[0]['nombre'])) {
            $nombre_librador = stripslashes($libradores[0]['nombre']);
        }
        if (!empty($libradores[0]['razon_social'])) {
            $nombre_librador = stripslashes($libradores[0]['razon_social']);
        }
        if (!empty($libradores[0]['razon_comercial'])) {
            $nombre_librador = stripslashes($libradores[0]['razon_comercial']);
        }
        $recepcionDePedido->librador = $nombre_librador;

        $result_iva = $conn->query("SELECT * FROM documentos_".$ejercicio."_iva WHERE id_documentos_1=".$pedido['id']);
        $lineasPedidoSkuStock = $conn->query("SELECT id_documento_2, lote, caducidad, numero_serie FROM documentos_".$ejercicio."_productos_sku_stock WHERE id_documento_1=".$pedido['id']." ORDER BY id");
        $lineasPedidoObservacion = $conn->query("SELECT id_documentos_2, observacion FROM documentos_".$ejercicio."_observaciones WHERE id_documentos_1=".$pedido['id']." AND id_documentos_combo = 0 ORDER BY id");

        $query_usuarios = "SELECT * FROM usuarios WHERE id='" . $pedido['id_usuario'] . "' LIMIT 1";
        $usuarios = $conn->query($query_usuarios);
        $recepcionDePedido->usuario = stripslashes($usuarios[0]['usuario']);

        $lineasPedido = $conn->query("SELECT * FROM documentos_".$ejercicio."_2 WHERE id_documentos_1=".$recepcionDePedido->id_documento_1." ORDER BY id");
        $cantidadArticulos = count($lineasPedido);
        foreach ($lineasPedido as $lineaPedido) {
            if($lineaPedido['tipo_producto'] == 2) {
                $result_productos_relacionados = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_2='" . $lineaPedido['id'] . "'");
            }
            if($lineaPedido['tipo_producto'] == 3) {
                $result_productos_relacionados_combo = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados_combo WHERE id_documentos_2='" . $lineaPedido['id'] . "' ORDER BY id");
            }
            foreach ($recepcionDePedido->productosPorGrupo as $recepcionProductosPorGrupo) {
                if ($recepcionProductosPorGrupo->nombre == $lineaPedido['orden'] || (empty($recepcionProductosPorGrupo->nombre) && empty($lineaPedido['orden']))) {
                    $lineaRecepcionDePedido = new stdClass();
                    $lineaRecepcionDePedido->id_documento_2 = $lineaPedido['id'];
                    $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
                    $lineaRecepcionDePedido->tipo_producto = $lineaPedido['tipo_producto'];
                    $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                    $lineaRecepcionDePedido->botones_acciones = true;
                    $lineaRecepcionDePedido->id_producto_relacionado = null;
                    $lineaRecepcionDePedido->cantidad = number_format($lineaPedido['cantidad'], $decimales_cantidades, ',', '.');
                    $lineaRecepcionDePedido->unidad = $lineaPedido['unidad'];
                    if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0) {
                        $precio_unidad_sin_incrementos = $lineaPedido['pvp_unidad_sin_incrementos'] / (1 + (($lineaPedido['iva'] + $lineaPedido['recargo']) / 100));
                    }else {
                        $precio_unidad_sin_incrementos = $lineaPedido['pvp_unidad_sin_incrementos'];
                    }
                    $lineaRecepcionDePedido->precio_unidad = number_format($precio_unidad_sin_incrementos, 2, ',', '.');
                    $precio_linea_sin_incrementos = $precio_unidad_sin_incrementos * $lineaPedido['cantidad'];
                    $lineaRecepcionDePedido->precio = number_format($precio_linea_sin_incrementos, 2, ',', '.');
                    $extension_descripcion = '';
                    if ($lineaPedido['id_packs']) {
                        $result_packs = $conn->query("SELECT * FROM productos_packs WHERE id='" . $lineaPedido['id_packs'] . "'");
                        if ($conn->registros() > 0) {
                            if ($result_packs[0]['cantidad_pack'] > 1) {
                                $extension_descripcion = ' ' . number_format($result_packs[0]['cantidad_pack'], 0) . ' unidades';
                            } else {
                                $extension_descripcion = ' ' . number_format($result_packs[0]['cantidad_pack'], 0) . ' unidad';
                            }

                        }
                    }
                    $lineaRecepcionDePedido->descripcion_producto = stripslashes($lineaPedido['descripcion_producto']) . $extension_descripcion;
                    $lineaRecepcionDePedido->observaciones = '';

                    $result_productos = $conn->query("SELECT imagen FROM productos WHERE id='" . $lineaPedido['id_producto'] . "' LIMIT 1");
                    $lineaRecepcionDePedido->imagen = $result_productos[0]['imagen'];

                    if (is_array($result_iva)) {
                        foreach ($lineasPedidoObservacion as $keyLineaPedidoObservacion => $lineaPedidoObservacion) {
                            if ($lineaPedidoObservacion['id_documentos_2'] == $lineaRecepcionDePedido->id_documento_2) {
                                $lineaRecepcionDePedido->observaciones = stripslashes($lineaPedidoObservacion['observacion']);
                                break;
                            }
                        }
                    }

                    if (is_array($result_iva)) {
                        foreach ($lineasPedidoSkuStock as $keyLineaPedidoSkuStock => $lineaPedidoSkuStock) {
                            if ($lineaPedidoSkuStock['id_documento_2'] == $lineaRecepcionDePedido->id_documento_2) {
                                if (!empty($lineaPedidoSkuStock['lote'])) {
                                    $lineaRecepcionDePedido->observaciones .= '- ' . $lineaPedidoSkuStock['lote'] . ' ' . $lineaPedidoSkuStock['caducidad'];
                                }
                                if (!empty($lineaPedidoSkuStock['numero_serie'])) {
                                    $lineaRecepcionDePedido->observaciones .= '- ' . $lineaPedidoSkuStock['numero_serie'];
                                }
                                break;
                            }
                        }
                    }

                    $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;

                    if($lineaPedido['tipo_producto'] == 2) {
                        foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                            $descripcionAAnadir = '';
                            $cantidad = 1;
                            $precio_unidad = null;
                            if ($valor_productos_relacionados['por_defecto'] == 0) {
                                $descripcionAAnadir = '- ';
                                $cantidad = $valor_productos_relacionados['cantidad_con'];
                                if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                    $importe_sumar = $valor_productos_relacionados['sumar_con'] / (1 + ($lineaPedido['iva'] / 100));
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $importe_sumar, $decimales_importes, ',', '.');
                                    $precio_unidad = $importe_sumar;
                                }else {
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $valor_productos_relacionados['sumar_con'], $decimales_importes, ',', '.');
                                    $precio_unidad = $valor_productos_relacionados['sumar_con'];
                                }
                            } elseif($valor_productos_relacionados['por_defecto'] == 1) {
                                $descripcionAAnadir = '- Mitad ';
                                $cantidad = $valor_productos_relacionados['cantidad_mitad'];
                                if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                    $importe_sumar = $valor_productos_relacionados['sumar_mitad'] / (1 + ($lineaPedido['iva'] / 100));
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $importe_sumar, $decimales_importes, ',', '.');
                                    $precio_unidad = $importe_sumar;
                                }else {
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $valor_productos_relacionados['sumar_mitad'], $decimales_importes, ',', '.');
                                    $precio_unidad = $valor_productos_relacionados['sumar_mitad'];
                                }
                            } elseif($valor_productos_relacionados['por_defecto'] == 2) {
                                $descripcionAAnadir = '- Sin ';
                                $cantidad = $valor_productos_relacionados['cantidad_sin'];
                                if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                    $importe_sumar = $valor_productos_relacionados['sumar_sin'] / (1 + ($lineaPedido['iva'] / 100));
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $importe_sumar, 2, ',', '.');
                                    $precio_unidad = $importe_sumar;
                                }else {
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $valor_productos_relacionados['sumar_sin'], 2, ',', '.');
                                    $precio_unidad = $valor_productos_relacionados['sumar_sin'];
                                }
                            } elseif($valor_productos_relacionados['por_defecto'] == 3) {
                                $descripcionAAnadir = '- Doble ';
                                $cantidad = $valor_productos_relacionados['cantidad_doble'];
                                if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                    $importe_sumar = $valor_productos_relacionados['sumar_doble'] / (1 + ($lineaPedido['iva'] / 100));
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $importe_sumar, 2, ',', '.');
                                    $precio_unidad = $importe_sumar;
                                }else {
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $valor_productos_relacionados['sumar_doble'], 2, ',', '.');
                                    $precio_unidad = $valor_productos_relacionados['sumar_doble'];
                                }
                            }
                            if ($valor_productos_relacionados['modelo'] == 4) {
                                continue;
                            }

                            $lineaRecepcionDePedido = new stdClass();
                            $lineaRecepcionDePedido->id_documento_2 = $lineaPedido['id'];
                            $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
                            $lineaRecepcionDePedido->tipo_producto = $lineaPedido['tipo_producto'];
                            $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                            $lineaRecepcionDePedido->botones_acciones = false;
                            $lineaRecepcionDePedido->id_producto_relacionado = $valor_productos_relacionados['id_relacionado'];
                            $lineaRecepcionDePedido->cantidad = '';
                            $lineaRecepcionDePedido->unidad = '';
                            $lineaRecepcionDePedido->precio_unidad = number_format($precio_unidad, $decimales_importes, ',', '.');
                            $lineaRecepcionDePedido->precio = $precio_relacionado;
                            $lineaRecepcionDePedido->descripcion_producto = $descripcionAAnadir . stripslashes($valor_productos_relacionados['descripcion']);
                            $lineaRecepcionDePedido->observaciones = '';
                            $lineaRecepcionDePedido->imagen = '';

                            $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;
                        }
                    }

                    if($lineaPedido['tipo_producto'] == 1) {
                        $result_productos_relacionados_elaborados = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados_elaborados WHERE id_documentos_2='" . $lineaRecepcionDePedido->id_documento_2 . "'");
                        foreach ($result_productos_relacionados_elaborados as $key_productos_relacionados => $valor_productos_relacionados) {
                            if ($valor_productos_relacionados['sumar'] == 0) {
                                continue;
                            }

                            $lineaRecepcionDePedido = new stdClass();
                            $lineaRecepcionDePedido->id_documento_2 = $lineaPedido['id'];
                            $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
                            $lineaRecepcionDePedido->tipo_producto = $lineaPedido['tipo_producto'];
                            $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                            $lineaRecepcionDePedido->botones_acciones = true;
                            $lineaRecepcionDePedido->id_producto_relacionado = $valor_productos_relacionados['id'];
                            $lineaRecepcionDePedido->cantidad = number_format($valor_productos_relacionados['cantidad'], $decimales_cantidades, ',', '.');
                            $lineaRecepcionDePedido->unidad = $lineaPedido['unidad'];
                            if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                $importe_sumar = $valor_productos_relacionados['sumar'] / (1 + ($lineaPedido['iva'] / 100));
                                $lineaRecepcionDePedido->precio = number_format($valor_productos_relacionados['cantidad'] * $importe_sumar, 2, ',', '.');
                                $lineaRecepcionDePedido->precio_unidad = number_format($importe_sumar, $decimales_importes, ',', '.');
                            }else {
                                $lineaRecepcionDePedido->precio = number_format($valor_productos_relacionados['cantidad'] * $valor_productos_relacionados['sumar'], 2, ',', '.');
                                $lineaRecepcionDePedido->precio_unidad = number_format($valor_productos_relacionados['sumar'], $decimales_importes, ',', '.');
                            }

                            $lineaRecepcionDePedido->descripcion_producto = stripslashes($valor_productos_relacionados['descripcion']);
                            $lineaRecepcionDePedido->observaciones = '';
                            $lineaRecepcionDePedido->imagen = '';

                            $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;
                        }
                    }

                    if (is_array($result_iva)) {
                        foreach ($result_iva as $key_iva => $valor_iva) {
                            if ($valor_iva['id_documentos_2'] == $lineaRecepcionDePedido->id_documento_2) {
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

                                        if ($base_linea + $importe_iva_a_sumar + $importe_recargo_a_sumar > $lineaPedido['total_despues_descuento']) {
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
                }

                if($lineaPedido['tipo_producto'] == 3) {
                    foreach ($result_productos_relacionados_combo as $key_productos_relacionados => $valor_productos_relacionados) {
                        if ($recepcionProductosPorGrupo->id == $valor_productos_relacionados['id_grupo']) {
                            $lineaRecepcionDePedido = new stdClass();
                            $lineaRecepcionDePedido->id_documento_2 = $lineaPedido['id'];
                            $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
                            $lineaRecepcionDePedido->tipo_producto = $lineaPedido['tipo_producto'];
                            $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                            $lineaRecepcionDePedido->botones_acciones = true;
                            $lineaRecepcionDePedido->id_producto_relacionado = $valor_productos_relacionados['id'];
                            $lineaRecepcionDePedido->cantidad = number_format($valor_productos_relacionados['cantidad'], $decimales_cantidades, ',', '.');
                            $lineaRecepcionDePedido->unidad = $lineaPedido['unidad'];
                            if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                $importe_sumar = $valor_productos_relacionados['sumar'] / (1 + ($lineaPedido['iva'] / 100));
                                $lineaRecepcionDePedido->precio = number_format($valor_productos_relacionados['cantidad'] * $importe_sumar, 2, ',', '.');
                                $lineaRecepcionDePedido->precio_unidad = number_format($importe_sumar, 2, ',', '.');
                            }else {
                                $lineaRecepcionDePedido->precio = number_format($valor_productos_relacionados['cantidad'] * $valor_productos_relacionados['sumar'], 2, ',', '.');
                                $lineaRecepcionDePedido->precio_unidad = number_format($valor_productos_relacionados['sumar'], 2, ',', '.');
                            }

                            $result_productos = $conn->query("SELECT descripcion, tipo_producto, imagen FROM productos WHERE id='" . $valor_productos_relacionados['id_relacionado'] . "' LIMIT 1");
                            $lineaRecepcionDePedido->descripcion_producto = stripslashes($result_productos[0]['descripcion']);
                            $lineaRecepcionDePedido->observaciones = '';
                            $lineaRecepcionDePedido->imagen = $result_productos[0]['imagen'];

                            $lineaPedidoObservacion = $conn->query("SELECT observacion FROM documentos_".$ejercicio."_observaciones WHERE id_documentos_combo=".$valor_productos_relacionados['id']." ORDER BY id LIMIT 1");
                            if ($conn->registros() == 1) {
                                $lineaRecepcionDePedido->observaciones = $lineaPedidoObservacion[0]['observacion'];
                            }

                            $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;

                            if($result_productos[0]['tipo_producto'] == 2) {
                                $result_combo_productos_relacionados = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_2='" . $lineaPedido['id'] . "' AND id_documentos_combo ='" . $valor_productos_relacionados['id'] . "'");

                                foreach ($result_combo_productos_relacionados as $key_combo_productos_relacionados => $valor_combo_productos_relacionados) {
                                    $descripcionAAnadir = '';
                                    $cantidad = 1;
                                    $precio_unidad = null;
                                    if ($valor_combo_productos_relacionados['por_defecto'] == 0) {
                                        $descripcionAAnadir = '- ';
                                        $cantidad = $valor_combo_productos_relacionados['cantidad_con'];
                                        if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                            $importe_sumar = $valor_combo_productos_relacionados['sumar_con'] / (1 + ($lineaPedido['iva'] / 100));
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $importe_sumar, $decimales_importes, ',', '.');
                                            $precio_unidad = $importe_sumar;
                                        }else {
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $valor_combo_productos_relacionados['sumar_con'], $decimales_importes, ',', '.');
                                            $precio_unidad = $valor_productos_relacionados['sumar_con'];
                                        }
                                    } elseif($valor_combo_productos_relacionados['por_defecto'] == 1) {
                                        $descripcionAAnadir = '- Mitad ';
                                        $cantidad = $valor_combo_productos_relacionados['cantidad_mitad'];
                                        if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                            $importe_sumar = $valor_combo_productos_relacionados['sumar_mitad'] / (1 + ($lineaPedido['iva'] / 100));
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $importe_sumar, $decimales_importes, ',', '.');
                                            $precio_unidad = $importe_sumar;
                                        }else {
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $valor_combo_productos_relacionados['sumar_mitad'], $decimales_importes, ',', '.');
                                            $precio_unidad = $valor_productos_relacionados['sumar_mitad'];
                                        }
                                    } elseif($valor_combo_productos_relacionados['por_defecto'] == 2) {
                                        $descripcionAAnadir = '- Sin ';
                                        $cantidad = $valor_combo_productos_relacionados['cantidad_sin'];
                                        if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                            $importe_sumar = $valor_combo_productos_relacionados['sumar_sin'] / (1 + ($lineaPedido['iva'] / 100));
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $importe_sumar, $decimales_importes, ',', '.');
                                            $precio_unidad = $importe_sumar;
                                        }else {
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $valor_combo_productos_relacionados['sumar_sin'], $decimales_importes, ',', '.');
                                            $precio_unidad = $valor_productos_relacionados['sumar_sin'];
                                        }
                                    } elseif($valor_combo_productos_relacionados['por_defecto'] == 3) {
                                        $descripcionAAnadir = '- Doble ';
                                        $cantidad = $valor_combo_productos_relacionados['cantidad_doble'];
                                        if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                            $importe_sumar = $valor_combo_productos_relacionados['sumar_doble'] / (1 + ($lineaPedido['iva'] / 100));
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $importe_sumar, 2, ',', '.');
                                            $precio_unidad = $importe_sumar;
                                        }else {
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $valor_combo_productos_relacionados['sumar_doble'], 2, ',', '.');
                                            $precio_unidad = $valor_productos_relacionados['sumar_doble'];
                                        }
                                    }
                                    if ($valor_combo_productos_relacionados['modelo'] == 4) {
                                        continue;
                                    }

                                    $lineaRecepcionDePedido = new stdClass();
                                    $lineaRecepcionDePedido->id_documento_2 = $lineaPedido['id'];
                                    $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
                                    $lineaRecepcionDePedido->tipo_producto = $lineaPedido['tipo_producto'];
                                    $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                                    $lineaRecepcionDePedido->botones_acciones = false;
                                    $lineaRecepcionDePedido->id_producto_relacionado = $valor_combo_productos_relacionados['id_relacionado'];
                                    $lineaRecepcionDePedido->cantidad = '';
                                    $lineaRecepcionDePedido->precio = $precio_relacionado;
                                    $lineaRecepcionDePedido->precio_unidad = number_format($precio_unidad, 2, ',', '.');
                                    $lineaRecepcionDePedido->descripcion_producto = $descripcionAAnadir . stripslashes($valor_combo_productos_relacionados['descripcion']);
                                    $lineaRecepcionDePedido->observaciones = '';
                                    $lineaRecepcionDePedido->imagen = '';

                                    $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;
                                }
                            }
                        }
                    }
                }
            }
        }

        $recepcionDePedidos[] = $recepcionDePedido;
    }

    $base = 0;
    foreach ($base_iva as $base_iva_individual) {
        $base += $base_iva_individual;
    }
}
?>
<div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
<div class="z-50 fixed top-0 right-0 bottom-0 w-full max-w-2xl p-10 overflow-y-scroll bg-white">
    <div class="flex mb-10 justify-between">
        <h3 class="text-3xl font-bold font-heading">Tu carrito</h3>
        <button onclick="document.getElementById('carrito').classList.add('hidden')">
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="12.0234" y="3.53906" width="2" height="12" transform="rotate(45 12.0234 3.53906)" fill="#161616"></rect><rect x="13.4297" y="12.0254" width="2" height="12" transform="rotate(135 13.4297 12.0254)" fill="#161616"></rect></svg>
        </button>
    </div>
    <div id="carrito_datos_generales">
        <div class="mb-10">
            <?php
            foreach ($recepcionDePedido->productosPorGrupo as $productoPorGrupo) {
                if (count($productoPorGrupo->productos) > 0) {
                    if ($productoPorGrupo->nombre) {
                        $contadorProductosEnElGrupo = 0;
                        foreach ($productoPorGrupo->productos as $producto) {
                            $contadorProductosEnElGrupo += $producto->cantidad;
                        }
                    }
                    foreach ($productoPorGrupo->productos as $key_producto => $producto) {
                        ?>
                        <!-- start product -->
                        <div class="flex flex-wrap -mx-4 mb-3 items-center justify-between">
                            <div class="w-full sm:w-4/5 px-2">
                                <div class="flex flex-wrap w-full">
                                    <div class="w-full lg:w-1/5">
                                        <div class="flex items-center justify-center">
                                            <img class="h-full object-contain" src="<?php echo $producto->imagen; ?>" alt="<?php echo $producto->descripcion_producto; ?>">
                                        </div>
                                    </div>
                                    <div class="w-full flex items-center px-2 lg:w-4/5">
                                        <h3 class="text-sm font-bold"><?php echo $producto->cantidad . ' ' . $producto->unidad; ?>x <?php echo $producto->descripcion_producto; ?></h3>
                                        <?php
                                        if ($producto->observaciones) {
                                            ?>
                                            <p class="mb-4 text-gray-500"><?php echo $producto->observaciones; ?></p>
                                            <?php
                                        }
                                        ?>
                                        <!--<div class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md quantity-inputs">
                                            <button class="py-2 hover:text-gray-700">
                                                <svg width="12" height="2" viewBox="0 0 12 2" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.35"><rect x="12" width="2" height="12" transform="rotate(90 12 0)" fill="currentColor"></rect></g></svg>
                                            </button>
                                            <input class="w-12 m-0 px-2 py-4 text-center md:text-right border-0 focus:ring-transparent focus:outline-none rounded-md" type="number" placeholder="1">
                                            <button class="py-2 hover:text-gray-700">
                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.35"><rect x="5" width="2" height="12" fill="currentColor"></rect><rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="currentColor"></rect></g></svg>
                                            </button>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="w-full sm:w-1/5 px-2">
                                <p class="text-right text-sm font-bold"><?php echo $producto->precio; ?> €</p>
                            </div>
                        </div>
                        <!-- end product -->
                        <?php
                    }
                }
            }
            ?>
        </div>
        <div class="mb-2 py-3 px-10 bg-gray-100 rounded-full">
            <div class="flex justify-between">
                <span class="text-base md:text-sm font-bold">Total productos</span>
                <span class="grow text-base text-right md:text-sm font-bold total-price"><?php echo $total; ?></span>
                <span class="text-base text-right md:text-sm font-bold ">&nbsp;€</span>
            </div>
        </div>
        <div class="mb-2 py-3 px-10 bg-gray-100 rounded-full">
            <div class="flex justify-between">
                <span class="text-base md:text-sm font-bold">Envío</span>
                <span class="grow text-base text-right md:text-sm font-bold total-price-envio">0</span>
                <span class="text-base text-right md:text-sm font-bold ">&nbsp;€</span>
            </div>
        </div>
        <div class="mb-2 py-3 px-10 bg-gray-100 rounded-full">
            <div class="flex justify-between">
                <span class="text-base md:text-sm font-bold">Método de pago</span>
                <span class="grow text-base text-right md:text-sm font-bold total-price-pago">0</span>
                <span class="text-base text-right md:text-sm font-bold ">&nbsp;€</span>
            </div>
        </div>
        <div class="mb-6 py-3 px-10 bg-gray-100 rounded-full">
            <div class="flex justify-between">
                <span class="text-base md:text-sm font-bold">Total cesta</span>
                <span class="grow text-base text-right md:text-sm font-bold total-price-cesta"><?php echo $total; ?></span>
                <span class="text-base text-right md:text-sm font-bold ">&nbsp;€</span>
            </div>
        </div>
    </div>
    <a class="block py-4 bg-orange-300 hover:bg-orange-400 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200" href="#" onclick="procederAlCheckout()">Terminar pedido</a>
    <a class="block py-4 mt-2 bg-gray-300 hover:bg-gray-400 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200" href="#" onclick="document.getElementById('carrito').classList.add('hidden')">Continuar comprando</a>
</div>
<script type="text/javascript">
    (function() {
        modificarCantidadArticulos(<?php echo $cantidadArticulos; ?>);
    })();
</script>
