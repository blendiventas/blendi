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

$query = "SELECT * FROM documentos_".$ejercicio."_1 WHERE  id='" . $id_documento_1 . "' LIMIT 1";
$pedidos = $conn->query($query);

$recargoLibrador = 0;
$irpf = 0;
$descuento_pp = 0;
$descuento_librador = 0;

$total = 0;
$suma = 0;
$descuentos = 0;
$subtotal = 0;
$impuestos = 0;
$recepcionDePedidos = [];
if ($conn->registros() > 0) {
    foreach ($pedidos as $pedido) {
        $total = floatval(number_format($pedido['total'], 2, '.', ''));
        $subtotal = number_format($pedido['base'], 2, ',', '.');

        $irpf = $pedido['irpf'];
        $descuento_pp = $pedido['descuento_pp'];
        $descuento_librador = $pedido['descuento_librador'];
        if (!empty($total) && !empty($descuentoLibrador)) {
            $total_sin_descuento = $total / ((100 - $descuentoLibrador) / 100);
            $descuento_librador_euro = (0 + ($descuentoLibrador / 100)) * $total_sin_descuento;
        } else {
            $total_sin_descuento = $total;
            $descuento_librador_euro = 0;
        }

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
        $recepcionDePedido->totalProductos = 0;
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

        $query_libradores2 = "SELECT recargo FROM libradores WHERE id='" . $pedido['id_librador'] . "' LIMIT 1";
        $libradores2 = $conn->query($query_libradores2);
        if (isset($libradores2[0]['recargo'])) {
            $recargoLibrador = $libradores2[0]['recargo'];
        }

        $result_iva = $conn->query("SELECT * FROM documentos_".$ejercicio."_iva WHERE id_documentos_1=".$pedido['id']);
        $lineasPedidoSkuStock = $conn->query("SELECT id_documento_2, lote, caducidad, numero_serie FROM documentos_".$ejercicio."_productos_sku_stock WHERE id_documento_1=".$pedido['id']." ORDER BY id");
        $lineasPedidoObservacion = $conn->query("SELECT id_documentos_2, observacion FROM documentos_".$ejercicio."_observaciones WHERE id_documentos_1=".$pedido['id']." AND id_documentos_combo = 0 ORDER BY id");

        $query_usuarios = "SELECT * FROM usuarios WHERE id='" . $pedido['id_usuario'] . "' LIMIT 1";
        $usuarios = $conn->query($query_usuarios);
        $recepcionDePedido->usuario = stripslashes($usuarios[0]['usuario']);

        $lineasPedido = $conn->query("SELECT * FROM documentos_".$ejercicio."_2 WHERE id_documentos_1=".$recepcionDePedido->id_documento_1." ORDER BY id");
        foreach ($lineasPedido as $lineaPedido) {
            $recepcionDePedido->totalProductos++;

            if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0) {
                $descuentos +=  $lineaPedido['importe_descuento_base']; // Descuento línea
                $descuentos +=
                    ($lineaPedido['base_antes_descuento'] / 100 * $pedido['descuento_pp']) +
                    ($lineaPedido['base_antes_descuento'] / 100 * $pedido['descuento_librador']); // Descuento documento total
                $suma += $lineaPedido['base_antes_descuento'];
            } else {
                $baseConIva = $lineaPedido['base_antes_descuento'] * (1 + ($lineaPedido['iva'] / 100));
                $descuentos +=  $lineaPedido['importe_descuento_total'];
                $descuentos +=
                    ($baseConIva / 100 * $pedido['descuento_pp']) +
                    ($baseConIva / 100 * $pedido['descuento_librador']); // Descuento documento total
                $suma += $baseConIva;
            }

            if($lineaPedido['tipo_producto'] == 2) {
                $result_productos_relacionados = $conn->query("SELECT pt.descripcion as descripcion_titulo, dpr.* FROM documentos_" . $ejercicio . "_productos_relacionados dpr LEFT OUTER JOIN productos_titulos_relacionados ptr ON dpr.id_titulo_relacionado = ptr.id LEFT OUTER JOIN productos_titulos pt ON ptr.id_productos_titulos = pt.id WHERE dpr.id_documentos_2='" . $lineaPedido['id'] . "'");
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
                    $lineaRecepcionDePedido->descripcion_producto = stripslashes($lineaPedido['descripcion_producto']);
                    $lineaRecepcionDePedido->observaciones = '';

                    if (is_array($result_iva)) {
                        foreach ($lineasPedidoObservacion as $keyLineaPedidoObservacion => $lineaPedidoObservacion) {
                            if ($lineaPedidoObservacion['id_documentos_2'] == $lineaRecepcionDePedido->id_documento_2) {
                                $lineaRecepcionDePedido->observaciones = preg_replace("[\n|\r|\n\r]", "", stripslashes($lineaPedidoObservacion['observacion']));
                                break;
                            }
                        }
                    }

                    if (is_array($result_iva)) {
                        foreach ($lineasPedidoSkuStock as $keyLineaPedidoSkuStock => $lineaPedidoSkuStock) {
                            if ($lineaPedidoSkuStock['id_documento_2'] == $lineaRecepcionDePedido->id_documento_2) {
                                if (!empty($lineaPedidoSkuStock['lote'])) {
                                    $lineaRecepcionDePedido->observaciones .= preg_replace("[\n|\r|\n\r]", "", '- ' . $lineaPedidoSkuStock['lote'] . ' ' . $lineaPedidoSkuStock['caducidad']);
                                }
                                if (!empty($lineaPedidoSkuStock['numero_serie'])) {
                                    $lineaRecepcionDePedido->observaciones .= preg_replace("[\n|\r|\n\r]", "", '- ' . $lineaPedidoSkuStock['numero_serie']);
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
                                $descripcionAAnadir = '- ' . $valor_productos_relacionados['descripcion_titulo'] . ' ';
                                $cantidad = $valor_productos_relacionados['cantidad_con'];
                                if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                    $importe_sumar = $valor_productos_relacionados['sumar_con'] / (1 + ($lineaPedido['iva'] / 100));
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $importe_sumar, 2, ',', '.');
                                    $precio_unidad = $importe_sumar;
                                }else {
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $valor_productos_relacionados['sumar_con'], 2, ',', '.');
                                    $precio_unidad = $valor_productos_relacionados['sumar_con'];
                                }
                            } elseif($valor_productos_relacionados['por_defecto'] == 1) {
                                $descripcionAAnadir = '- Mitad ';
                                $cantidad = $valor_productos_relacionados['cantidad_mitad'];
                                if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                    $importe_sumar = $valor_productos_relacionados['sumar_mitad'] / (1 + ($lineaPedido['iva'] / 100));
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $importe_sumar, 2, ',', '.');
                                    $precio_unidad = $importe_sumar;
                                }else {
                                    $precio_relacionado = number_format($lineaPedido['cantidad'] * $valor_productos_relacionados['sumar_mitad'], 2, ',', '.');
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
                            $lineaRecepcionDePedido->precio_unidad = number_format($precio_unidad, 2, ',', '.');
                            $lineaRecepcionDePedido->precio = $precio_relacionado;
                            $lineaRecepcionDePedido->descripcion_producto = $descripcionAAnadir . stripslashes($valor_productos_relacionados['descripcion']) . ((empty($valor_productos_relacionados['observaciones']))? '' : ': ' . $valor_productos_relacionados['observaciones']);
                            $lineaRecepcionDePedido->observaciones = '';

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
                                $lineaRecepcionDePedido->precio_unidad = number_format($valor_productos_relacionados['sumar'], 2, ',', '.');
                            }

                            $lineaRecepcionDePedido->descripcion_producto = stripslashes($valor_productos_relacionados['descripcion']);
                            $lineaRecepcionDePedido->observaciones = '';

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
                                $lineaRecepcionDePedido->precio_unidad = number_format($importe_sumar, $decimales_importes, ',', '.');
                            }else {
                                $lineaRecepcionDePedido->precio = number_format($valor_productos_relacionados['cantidad'] * $valor_productos_relacionados['sumar'], 2, ',', '.');
                                $lineaRecepcionDePedido->precio_unidad = number_format($valor_productos_relacionados['sumar'], 2, ',', '.');
                            }

                            $result_productos = $conn->query("SELECT descripcion, tipo_producto FROM productos WHERE id='" . $valor_productos_relacionados['id_relacionado'] . "' LIMIT 1");
                            $lineaRecepcionDePedido->descripcion_producto = stripslashes($result_productos[0]['descripcion']);
                            $lineaRecepcionDePedido->observaciones = '';

                            $lineaPedidoObservacion = $conn->query("SELECT observacion FROM documentos_".$ejercicio."_observaciones WHERE id_documentos_combo=".$valor_productos_relacionados['id']." ORDER BY id LIMIT 1");
                            if ($conn->registros() == 1) {
                                $lineaRecepcionDePedido->observaciones = preg_replace("[\n|\r|\n\r]", "", $lineaPedidoObservacion[0]['observacion']);
                            }

                            $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;

                            if($result_productos[0]['tipo_producto'] == 2) {
                                $result_combo_productos_relacionados = $conn->query("SELECT pt.descripcion as descripcion_titulo, dpr.* FROM documentos_" . $ejercicio . "_productos_relacionados dpr LEFT OUTER JOIN productos_titulos_relacionados ptr ON dpr.id_titulo_relacionado = ptr.id LEFT OUTER JOIN productos_titulos pt ON ptr.id_productos_titulos = pt.id WHERE id_documentos_2='" . $lineaPedido['id'] . "' AND id_documentos_combo ='" . $valor_productos_relacionados['id'] . "'");

                                foreach ($result_combo_productos_relacionados as $key_combo_productos_relacionados => $valor_combo_productos_relacionados) {
                                    $descripcionAAnadir = '';
                                    $cantidad = 1;
                                    $precio_unidad = null;
                                    if ($valor_combo_productos_relacionados['por_defecto'] == 0) {
                                        $descripcionAAnadir = '- ' . $valor_combo_productos_relacionados['descripcion_titulo'] . ' ';
                                        $cantidad = $valor_combo_productos_relacionados['cantidad_con'];
                                        if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                            $importe_sumar = $valor_combo_productos_relacionados['sumar_con'] / (1 + ($lineaPedido['iva'] / 100));
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $importe_sumar, 2, ',', '.');
                                            $precio_unidad = $importe_sumar;
                                        }else {
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $valor_combo_productos_relacionados['sumar_con'], 2, ',', '.');
                                            $precio_unidad = $valor_productos_relacionados['sumar_con'];
                                        }
                                    } elseif($valor_combo_productos_relacionados['por_defecto'] == 1) {
                                        $descripcionAAnadir = '- Mitad ';
                                        $cantidad = $valor_combo_productos_relacionados['cantidad_mitad'];
                                        if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                            $importe_sumar = $valor_combo_productos_relacionados['sumar_mitad'] / (1 + ($lineaPedido['iva'] / 100));
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $importe_sumar, 2, ',', '.');
                                            $precio_unidad = $importe_sumar;
                                        }else {
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $valor_combo_productos_relacionados['sumar_mitad'], 2, ',', '.');
                                            $precio_unidad = $valor_productos_relacionados['sumar_mitad'];
                                        }
                                    } elseif($valor_combo_productos_relacionados['por_defecto'] == 2) {
                                        $descripcionAAnadir = '- Sin ';
                                        $cantidad = $valor_combo_productos_relacionados['cantidad_sin'];
                                        if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                                            $importe_sumar = $valor_combo_productos_relacionados['sumar_sin'] / (1 + ($lineaPedido['iva'] / 100));
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $importe_sumar, 2, ',', '.');
                                            $precio_unidad = $importe_sumar;
                                        }else {
                                            $precio_relacionado = number_format($valor_productos_relacionados['cantidad'] * $valor_combo_productos_relacionados['sumar_sin'], 2, ',', '.');
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
                                    $lineaRecepcionDePedido->descripcion_producto = $descripcionAAnadir . stripslashes($valor_combo_productos_relacionados['descripcion']) . ((empty($valor_combo_productos_relacionados['observaciones']))? '' : ': ' . $valor_combo_productos_relacionados['observaciones']);
                                    $lineaRecepcionDePedido->observaciones = '';

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
    foreach ($base_iva as $key_base_iva => $base_iva_individual) {
        $base += $base_iva_individual;
        $impuestos += (number_format($base_iva_individual / 100 * $iva[$key_base_iva], 2, ".", ""));
        if ($recargoLibrador) {
            $impuestos += (number_format($base_iva_individual / 100 * $recargo[$key_base_iva], 2, ".", ""));
        }
        $importe_iva[$key_base_iva] = number_format($importe_iva[$key_base_iva], 2, ".", "");
        $importe_recargo[$key_base_iva] = number_format($importe_recargo[$key_base_iva], 2, ".", "");
    }
    if ($base + $impuestos > $total) {
        $base_iva[$key_base_iva] -= 0.01;
    }

    $impuestos = number_format($impuestos, 2, ',', '.');

    $suma = number_format($suma, 2, ',', '.');
    $descuentos = number_format($descuentos, 2, ',', '.');
}
?>
<div>
    <div class="py2 sm:overflow-y-auto" id="capa_cesta_productos">
        <?php
        foreach ($recepcionDePedido->productosPorGrupo as $productoPorGrupo) {
            if (count($productoPorGrupo->productos) > 0) {
                if ($productoPorGrupo->nombre) {
                    $contadorProductosEnElGrupo = 0;
                    foreach ($productoPorGrupo->productos as $producto) {
                        $contadorProductosEnElGrupo += $producto->cantidad;
                    }
                    ?>
                    <div class="text-gray-700 flex justify-start items-center text-xs font-bold px-4 mt-8">
                        <div><?php echo ucfirst($productoPorGrupo->nombre); ?></div>
                        <div class="grow"></div>
                        <div>(<?php echo $contadorProductosEnElGrupo; ?> Uds)</div>
                    </div>
                    <div class="border border-black my-2"></div>
                    <?php
                }
                foreach ($productoPorGrupo->productos as $key_producto => $producto) {
                    if ($key_producto != 0 && $producto->botones_acciones) {
                        ?>
                        <div class="border border-gray my-2"></div>
                        <?php
                    }
                    ?>
                    <div class="text-gray-700 bg-white flex justify-start items-start <?php echo ($producto->botones_acciones)? 'text-sm' : 'text-xs'; ?> px-4">
                        <div><?php echo $producto->cantidad; echo (!empty($producto->cantidad))? $producto->unidad . 'x' : ''; ?></div>
                        <div class="ml-5">
                            <span class="<?php echo ($producto->botones_acciones)? 'font-medium' : ''; ?>">
                                <?php echo $producto->descripcion_producto; ?>
                            </span>
                            <?php
                            if (!empty($producto->observaciones)) {
                                ?>
                                <div class="max-w-xs text-xs">
                                    <?php echo $producto->observaciones; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="grow"></div>
                        <div class="hidden lg:block">
                            <?php echo $producto->precio_unidad; ?> €
                        </div>
                        <div class="ml-5"><?php echo $producto->precio; ?> €</div>
                    </div>
                    <?php
                    if ($producto->botones_acciones) {
                        ?>
                        <div class="flex justify-center items-center text-gray-700 bg-white text-xs mt-2 px-4">
                                <div class="bg-blendi-600 dark:bg-blendidark-600 rounded-full" <?php echo 'onmouseover="this.style.cursor=\'pointer\'" onclick="detallesProductoModal(\'' . preg_replace("([^A-Za-z0-9 ])", "", $producto->descripcion_producto). '\', ' . $producto->id_producto . ', \'' . $producto->id_producto_relacionado . '\', \'' . $producto->tipo_producto . '\', ' . $producto->id_documento_2 . ', false, \'restar\', \'\');"'; ?>>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white dark:text-black"><path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" /></svg>
                                </div>
                                <div class="bg-blendi-600 dark:bg-blendidark-600 rounded-full ml-5" <?php echo 'onmouseover="this.style.cursor=\'pointer\'" onclick="detallesProductoModal(\'' .  preg_replace("([^A-Za-z0-9 ])", "", $producto->descripcion_producto). '\', ' . $producto->id_producto . ', \'' . $producto->id_producto_relacionado . '\', \'' . $producto->tipo_producto . '\', ' . $producto->id_documento_2 . ', false, \'sumar\', \'\');"'; ?>>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto text-white dark:text-black"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" /></svg>
                                </div>
                            <div class="grow"></div>
                                <?php
                                if (empty($producto->id_producto_relacionado) && ($producto->tipo_producto == 3 || $producto->tipo_producto == 4)) {
                                    ?>
                                    <div class="text-blendi-600 dark:text-black" onmouseover="this.style.cursor='pointer'" onclick="editarProducto(<?php echo $producto->id_documento_2; ?>, '<?php echo $producto->slug; ?>',0);">
                                    <?php
                                } else {
                                    ?>
                                    <div class="text-blendi-600 dark:text-black" onmouseover="this.style.cursor='pointer'" onclick="document.getElementById('botonOpenModalProducto').click(); detallesProductoModal('<?php echo  preg_replace("([^A-Za-z0-9 ])", "", $producto->descripcion_producto); ?>', <?php echo $producto->id_producto; ?>, '<?php echo $producto->id_producto_relacionado; ?>', '<?php echo $producto->tipo_producto; ?>', <?php echo $producto->id_documento_2; ?>, false, '', '');">
                                    <?php
                                }
                                ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                </div>
                            <?php
                            if ($recepcionDePedido->totalProductos > 1) {

                                    if (empty($producto->id_producto_relacionado)) {
                                        ?>
                                        <div class="text-blendi-600 dark:text-black ml-5" onmouseover="this.style.cursor='pointer'" onclick="eliminarProducto(<?php echo $producto->id_documento_2; ?>)">
                                        <?php
                                    } else {
                                        ?>
                                        <div class="text-blendi-600 dark:text-black ml-5" onmouseover="this.style.cursor='pointer'" onclick="detallesProductoModal('<?php echo  preg_replace("([^A-Za-z0-9 ])", "", $producto->descripcion_producto); ?>', <?php echo $producto->id_producto; ?>, '<?php echo $producto->id_producto_relacionado; ?>', '<?php echo $producto->tipo_producto; ?>', <?php echo $producto->id_documento_2; ?>, true, '', '');">
                                        <?php
                                    }
                                    ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                    </div>

                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
            }
        }
        if (!$recepcionDePedido->totalProductos) {
            ?>
            <div class="w-full flex items-center justify-center">
                <img src="/images/tiquetVacio.png" alt="Tíquet vacío" title="Tíquet vacío" />
            </div>
            <div class="w-full flex items-center justify-center">
                Todavía no has añadido ningún producto. Cuando lo hagas, ¡verás los productos aquí!
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="hidden sm:block">
    <div class="flex items-center py-1 px-3 mx-3 rounded-lg bg-gray-200 dark:text-white hidden" id="producto_anadido">
        <div class="text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="grow" id="producto_anadido_descripcion"></div>
        <div class="text-right" id="producto_anadido_editar"></div>
        <div class="text-right ml-4" id="producto_anadido_eliminar"></div>
    </div>
</div>
<div class="grid grid-cols-5 p-1 inset-x-0 mt-1 bottom-12 bg-gray-25 dark:bg-graydark-650 sm:absolute w-full text-center cursor-pointer" onclick="document.getElementById('buttonModalOtrosDatosDocumento').click()">
    <div>
        <div class="font-medium">Suma</div>
        <div><?php echo $suma; ?> €</div>
    </div>
    <div>
        <div class="font-medium">Desc.</div>
        <div><?php echo $descuentos; ?> €</div>
    </div>
    <div>
        <div class="font-medium">Subtotal</div>
        <div><?php echo $subtotal; ?> €</div>
    </div>
    <div>
        <div class="font-medium">Imp.</div>
        <div><?php echo $impuestos; ?> €</div>
    </div>
    <div>
        <div class="font-medium">Total</div>
        <div class="font-black"><?php echo number_format($total, 2, ",", "."); ?> €</div>
    </div>
</div>

<script type="text/javascript">
    (function() {
        window.tiquet = JSON.parse('<?php echo str_replace(["'"], ["\'"], json_encode($recepcionDePedidos)); ?>');
        <?php
        foreach ($indice as $key_iva => $indice_iva) {
            if ($base_iva[$key_iva] != 0) {
                ?>
                document.getElementById('capa_dato_base_<?php echo $indice_iva; ?>').innerHTML = '<?php echo $base_iva[$key_iva]; ?> €';
                document.getElementById('capa_dato_iva_<?php echo $indice_iva; ?>').innerHTML = '<?php echo $iva[$key_iva]; ?> %';
                document.getElementById('capa_dato_importe_iva_<?php echo $indice_iva; ?>').innerHTML = '<?php echo $importe_iva[$key_iva]; ?> €';
                document.getElementById('capa_dato_recargo_<?php echo $indice_iva; ?>').innerHTML = '<?php echo $recargo[$key_iva]; ?> %';
                document.getElementById('capa_dato_importe_recargo_<?php echo $indice_iva; ?>').innerHTML = '<?php echo $importe_recargo[$key_iva]; ?> €';
                <?php
            } else {
                ?>
                document.getElementById('capa_dato_base_<?php echo $indice_iva; ?>').innerHTML = '';
                document.getElementById('capa_dato_iva_<?php echo $indice_iva; ?>').innerHTML = '';
                document.getElementById('capa_dato_importe_iva_<?php echo $indice_iva; ?>').innerHTML = '';
                document.getElementById('capa_dato_recargo_<?php echo $indice_iva; ?>').innerHTML = '';
                document.getElementById('capa_dato_importe_recargo_<?php echo $indice_iva; ?>').innerHTML = '';
                <?php
            }
        }
        ?>

        let recargoCestaTotales = document.getElementById('check_recargo_descuento_cesta');
        let irpfCestaTotales = document.getElementById('irpf_descuento_cesta');
        let descuentoPPCestaTotales = document.getElementById('descuento_pp');
        let descuentoLibradorCestaTotales = document.getElementById('descuento_librador');
        let descuentoLibradorEuroCestaTotales = document.getElementById('descuento_librador_euro');
        let capaDatoDescuentoCestaTotales = document.getElementById('capa_dato_descuento');
        let capaDatoTotalCestaTotales = document.getElementById('capa_dato_total');

        if (recargoCestaTotales) {
            <?php
            if ($recargoLibrador) {
                ?>
                recargoCestaTotales.checked = true;
                <?php
            } else {
                ?>
                recargoCestaTotales.checked = false;
                <?php
            }
            ?>
        }
        if (irpfCestaTotales) {
            irpfCestaTotales.value = '<?php echo $irpf; ?>';
        }
        if (descuentoPPCestaTotales) {
            descuentoPPCestaTotales.value = '<?php echo $descuento_pp; ?>';
        }
        if (descuentoLibradorCestaTotales) {
            descuentoLibradorCestaTotales.value = '<?php echo number_format($descuento_librador, 2, '.', ''); ?>';
        }
        if (descuentoLibradorEuroCestaTotales) {
            descuentoLibradorEuroCestaTotales.value = '<?php echo number_format($descuento_librador_euro, 2, '.', ''); ?>';
        }
        if (capaDatoDescuentoCestaTotales) {
            capaDatoDescuentoCestaTotales.innerHTML = '<?php echo number_format($descuento_librador_euro, 2, ',', '.'); ?> €';
        }
        if (capaDatoTotalCestaTotales) {
            capaDatoTotalCestaTotales.innerHTML = '<?php echo $total; ?> €';
        }
        setCapaCestaProductosHeight();
    })();
</script>
