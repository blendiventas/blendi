<?php

/**
 * Estados productos:
 * · -1 Pidiendo -> No se muestra en cocina
 * · 0 Pendiente ->
 * · 1 Preparándose -> Si hay uno del grupo, este preparándose
 * · 2 Hecho -> Si todos del grupo, este hecho
 * · 3 Cancelado
 *
 * Alertas productos:
 * · 0 Nada
 * · 1 Editado
 * · 2 Nuevo
 * · 3 Prioritario
 *
 * $producto->estado . ' | ' . $producto->alertar . ' | ' .
 *
 * Estados grupos:
 * · 0 Pendiente -> Si no hay ningún producto en estado 1 en el grupo
 * · 1 Preparándose -> Si hay un producto en estado 1 en el grupo
 * · 2 Hecho -> Si todos los productos del grupo están en estado 2
 *
 * $productoPorGrupo->estado
 *
 */

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");
$query = "SELECT * FROM productos_relacionados_grupos ORDER BY orden ASC";
$grupos = $conn->query($query);

if ($tiquet_individual) {
    $query = "SELECT d1.* FROM documentos_enviar_terminales det JOIN documentos_".$ejercicio."_1 d1 ON det.id_documento_1 = d1.id 
        WHERE det.id_documento_1 = " . $tiquet_individual . " 
        GROUP BY det.id_documento_1 
        ORDER BY hora_entrada ASC";
} else {
    $nowMinusTwoDays = new DateTime();
    $nowMinusTwoDays->modify('-2 days');
    $query = "SELECT d1.* FROM documentos_enviar_terminales det JOIN documentos_".$ejercicio."_1 d1 ON det.id_documento_1 = d1.id 
        WHERE det.estado <> -1 AND d1.fecha_documento > '" . $nowMinusTwoDays->format('Y-m-d') . "' 
        GROUP BY det.id_documento_1 
        ORDER BY hora_entrada ASC";
}

$pedidos = $conn->query($query);
$funcion_origen = 'imprimirDocumento';

$recepcionDePedidos = [];
if ($conn->registros() > 0) {
    foreach ($pedidos as $pedido) {
        $productosInsertados = 0;
        $productosPorGrupos = [];
        $productosPorGrupo = new stdClass();
        $productosPorGrupo->nombre = '';
        $productosPorGrupo->estado = 2;
        $productosPorGrupo->productos = [];
        $productosPorGrupos[] = $productosPorGrupo;
        foreach ($grupos as $grupo) {
            $productosPorGrupo = new stdClass();
            $productosPorGrupo->id = $grupo['id'];
            $productosPorGrupo->nombre = stripslashes($grupo['descripcion']);
            $productosPorGrupo->estado = 2;
            $productosPorGrupo->productos = [];

            $productosPorGrupos[] = $productosPorGrupo;
        }

        $recepcionDePedido = new stdClass();
        $recepcionDePedido->id_documento_1 = $pedido['id'];
        $recepcionDePedido->numero_documento = $pedido['numero_documento'];
        $recepcionDePedido->comensales = $pedido['comensales'];
        $recepcionDePedido->tipo_librador = $pedido['tipo_librador'];
        $recepcionDePedido->fecha_hora = $pedido['fecha_documento']." ".$pedido['hora'];
        $recepcionDePedido->productosPorGrupo = $productosPorGrupos;
        $recepcionDePedido->numero_productos = 0;

        $query_ultimo_producto = "SELECT hora_entrada FROM documentos_enviar_terminales WHERE id_documento_1='" . $pedido['id'] . "' ORDER BY hora_entrada DESC LIMIT 1";
        $ultimo_producto = $conn->query($query_ultimo_producto);
        if ($conn->registros() == 1) {
            $recepcionDePedido->fecha_ultima_modificacion = $ultimo_producto[0]['hora_entrada'];
        } else {
            $recepcionDePedido->fecha_ultima_modificacion = null;
        }

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

        $query_usuarios = "SELECT * FROM usuarios WHERE id='" . $pedido['id_usuario'] . "' LIMIT 1";
        $usuarios = $conn->query($query_usuarios);
        $recepcionDePedido->usuario = stripslashes($usuarios[0]['usuario']);

        if ($tiquet_individual) {
            $lineasPedido = $conn->query("SELECT det.id as id_det, d2.id_producto as id_producto, d2.slug as slug, d2.tipo_producto as tipo_producto, d2.orden as orden, d2.id as id, d2.cantidad as cantidad, p.descripcion as descripcion_producto, det.hora_visto as hora_visto, det.estado as estado, det.alertar as alertar FROM documentos_enviar_terminales det LEFT OUTER JOIN productos p ON det.id_producto = p.id LEFT OUTER JOIN documentos_".$ejercicio."_2 d2 ON d2.id = det.id_documento_2 AND d2.id_documentos_1 = det.id_documento_1 WHERE det.id_documento_1=".$recepcionDePedido->id_documento_1." AND det.id_documentos_combo = 0 ORDER BY d2.id");
        } else {
            $lineasPedido = $conn->query("SELECT det.id as id_det, d2.id_producto as id_producto, d2.slug as slug, d2.tipo_producto as tipo_producto, d2.orden as orden, d2.id as id, d2.cantidad as cantidad, p.descripcion as descripcion_producto, det.hora_visto as hora_visto, det.estado as estado, det.alertar as alertar FROM documentos_enviar_terminales det LEFT OUTER JOIN productos p ON det.id_producto = p.id LEFT OUTER JOIN documentos_".$ejercicio."_2 d2 ON d2.id = det.id_documento_2 AND d2.id_documentos_1 = det.id_documento_1 WHERE det.id_documento_1=".$recepcionDePedido->id_documento_1." AND det.estado <> -1 AND det.id_documentos_combo = 0 ORDER BY d2.id");
        }
        foreach ($lineasPedido as $lineaPedido) {
            $recepcionDePedido->numero_productos++;
            if($lineaPedido['tipo_producto'] == 2) {
                $result_productos_relacionados = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_2='" . $lineaPedido['id'] . "'");
            }
            if($lineaPedido['tipo_producto'] == 3) {
                $result_productos_relacionados_combo = $conn->query("SELECT det.id as id_det, det.id_producto as id_producto, p.tipo_producto as tipo_producto, dc.id_grupo as id_grupo, dc.orden as orden, dc.id as id, det.cantidad as cantidad, p.descripcion as descripcion_producto, det.hora_visto as hora_visto, det.estado as estado, det.alertar as alertar FROM documentos_enviar_terminales det LEFT OUTER JOIN productos p ON det.id_producto = p.id LEFT OUTER JOIN documentos_" . $ejercicio . "_productos_relacionados_combo dc ON dc.id_documentos_2 = det.id_documento_2 AND dc.id = det.id_documentos_combo WHERE det.id_documento_2='" . $lineaPedido['id'] . "' AND det.id_documentos_combo <> 0");
            }
            if($lineaPedido['tipo_producto'] == 1) {
                $result_productos_relacionados_elaborados = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados_elaborados WHERE id_documentos_2='" . $lineaPedido['id'] . "'");
            }
            if (isset($terminales_de_acceso) && !$tiquet_individual && $terminales_de_acceso != -1) {
                $result_terminales = $conn->query("SELECT ct.id_terminal as id_terminal FROM productos_categorias pc LEFT JOIN categorias_terminales ct ON pc.id_categoria = ct.id_categoria WHERE pc.id_producto = " . $lineaPedido['id_producto'] . ";");
                if ($conn->registros() == 0) {
                    continue;
                }
                $esUnProductoDelTerminalDeAcceso = false;
                foreach ($result_terminales as $terminal) {
                    if ($terminal['id_terminal'] == $terminales_de_acceso) {
                        $esUnProductoDelTerminalDeAcceso = true;
                    }
                }
                if (!$esUnProductoDelTerminalDeAcceso) {
                    continue;
                }
            }
            foreach ($recepcionDePedido->productosPorGrupo as $recepcionProductosPorGrupo) {
                if ($recepcionProductosPorGrupo->nombre == $lineaPedido['orden']) {
                    $lineaRecepcionDePedido = new stdClass();
                    $lineaRecepcionDePedido->id_documento_2 = $lineaPedido['id'];
                    $lineaRecepcionDePedido->id_det = $lineaPedido['id_det'];
                    $lineaRecepcionDePedido->id_producto_relacionado = null;
                    $lineaRecepcionDePedido->cantidad = number_format($lineaPedido['cantidad'], $decimales_cantidades, ',', '.');
                    $lineaRecepcionDePedido->tipo_producto = $lineaPedido['tipo_producto'];
                    $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                    $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
                    $lineaRecepcionDePedido->descripcion_producto = stripslashes($lineaPedido['descripcion_producto']);
                    $lineaRecepcionDePedido->hora_visto = $lineaPedido['hora_visto'];
                    $lineaRecepcionDePedido->estado = $lineaPedido['estado'];
                    if ($lineaRecepcionDePedido->estado == 0 && $recepcionProductosPorGrupo->estado == 2) {
                        $recepcionProductosPorGrupo->estado = 0;
                    } else if ($lineaRecepcionDePedido->estado == 1) {
                        $recepcionProductosPorGrupo->estado = 1;
                    }
                    $lineaRecepcionDePedido->alertar = $lineaPedido['alertar'];
                    $lineaRecepcionDePedido->observaciones = '';

                    $lineaPedidoObservacion = $conn->query("SELECT observacion FROM documentos_".$ejercicio."_observaciones WHERE id_documentos_2=".$lineaPedido['id']." AND id_documentos_combo = 0 ORDER BY id LIMIT 1");
                    if ($conn->registros() == 1) {
                        $lineaRecepcionDePedido->observaciones = $lineaPedidoObservacion[0]['observacion'];
                    }

                    $productosInsertados++;
                    $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;

                    if($lineaPedido['tipo_producto'] == 2) {
                        foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                            $descripcionAAnadir = '';
                            $cantidad = 1;
                            if ($valor_productos_relacionados['por_defecto'] == 0) {
                                $descripcionAAnadir = '- ';
                                $cantidad = $valor_productos_relacionados['cantidad_con'];
                            } elseif($valor_productos_relacionados['por_defecto'] == 1) {
                                $descripcionAAnadir = '- Mitad ';
                                $cantidad = $valor_productos_relacionados['cantidad_mitad'];
                            } elseif($valor_productos_relacionados['por_defecto'] == 2) {
                                $descripcionAAnadir = '- Sin ';
                                $cantidad = $valor_productos_relacionados['cantidad_sin'];
                            } elseif($valor_productos_relacionados['por_defecto'] == 3) {
                                $descripcionAAnadir = '- Doble ';
                                $cantidad = $valor_productos_relacionados['cantidad_doble'];
                            }
                            if ($valor_productos_relacionados['modelo'] == 4) {
                                continue;
                            }

                            $lineaRecepcionDePedido = new stdClass();
                            $lineaRecepcionDePedido->id_documento_2 = $lineaPedido['id'];
                            $lineaRecepcionDePedido->id_producto_relacionado = $valor_productos_relacionados['id_relacionado'];
                            $lineaRecepcionDePedido->cantidad = '';
                            $lineaRecepcionDePedido->tipo_producto = 0;
                            $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                            $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
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
                            $lineaRecepcionDePedido->id_producto_relacionado = $valor_productos_relacionados['id'];
                            $lineaRecepcionDePedido->cantidad = number_format($valor_productos_relacionados['cantidad'], $decimales_cantidades, ',', '.');
                            $lineaRecepcionDePedido->tipo_producto = 0;
                            $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                            $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
                            $lineaRecepcionDePedido->descripcion_producto = stripslashes($valor_productos_relacionados['descripcion']);
                            $lineaRecepcionDePedido->observaciones = '';

                            $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;
                        }
                    }
                }

                if($lineaPedido['tipo_producto'] == 3) {
                    foreach ($result_productos_relacionados_combo as $key_productos_relacionados => $valor_productos_relacionados) {
                        if ($recepcionProductosPorGrupo->id == $valor_productos_relacionados['id_grupo']) {
                            if (isset($terminales_de_acceso) && !$tiquet_individual && $terminales_de_acceso != -1) {
                                $result_terminales = $conn->query("SELECT ct.id_terminal as id_terminal FROM productos_categorias pc LEFT JOIN categorias_terminales ct ON pc.id_categoria = ct.id_categoria WHERE pc.id_producto = " . $valor_productos_relacionados['id_producto'] . ";");
                                if ($conn->registros() == 0) {
                                    continue;
                                }
                                $esUnProductoDelTerminalDeAcceso = false;
                                foreach ($result_terminales as $terminal) {
                                    if ($terminal['id_terminal'] == $terminales_de_acceso) {
                                        $esUnProductoDelTerminalDeAcceso = true;
                                    }
                                }
                                if (!$esUnProductoDelTerminalDeAcceso) {
                                    continue;
                                }
                            }

                            $lineaRecepcionDePedido = new stdClass();
                            $lineaRecepcionDePedido->id_documento_2 = $lineaPedido['id'];
                            $lineaRecepcionDePedido->id_det = $lineaPedido['id_det'];
                            $lineaRecepcionDePedido->id_producto_relacionado = $valor_productos_relacionados['id'];
                            $lineaRecepcionDePedido->cantidad = number_format($valor_productos_relacionados['cantidad'], $decimales_cantidades, ',', '.');
                            $lineaRecepcionDePedido->tipo_producto = $valor_productos_relacionados['tipo_producto'];
                            $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                            $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
                            $lineaRecepcionDePedido->descripcion_producto = stripslashes($valor_productos_relacionados['descripcion_producto']);
                            $lineaRecepcionDePedido->hora_visto = $valor_productos_relacionados['hora_visto'];
                            $lineaRecepcionDePedido->estado = stripslashes($valor_productos_relacionados['estado']);
                            if ($lineaRecepcionDePedido->estado == 0 && $recepcionProductosPorGrupo->estado == 2) {
                                $recepcionProductosPorGrupo->estado = 0;
                            } else if ($lineaRecepcionDePedido->estado == 1) {
                                $recepcionProductosPorGrupo->estado = 1;
                            }
                            $lineaRecepcionDePedido->alertar = stripslashes($valor_productos_relacionados['alertar']);
                            $lineaRecepcionDePedido->observaciones = '';

                            $lineaPedidoObservacion = $conn->query("SELECT observacion FROM documentos_".$ejercicio."_observaciones WHERE id_documentos_combo=".$valor_productos_relacionados['id']." ORDER BY id LIMIT 1");
                            if ($conn->registros() == 1) {
                                $lineaRecepcionDePedido->observaciones = $lineaPedidoObservacion[0]['observacion'];
                            }

                            $productosInsertados++;
                            $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;

                            if($valor_productos_relacionados['tipo_producto'] == 2) {
                                $result_productos_relacionados = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_2='" . $lineaPedido['id'] . "' AND id_documentos_combo = '" . $valor_productos_relacionados['id'] . "'");

                                foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                                    $descripcionAAnadir = '';
                                    $cantidad = 1;
                                    if ($valor_productos_relacionados['por_defecto'] == 0) {
                                        $descripcionAAnadir = '- ';
                                        $cantidad = $valor_productos_relacionados['cantidad_con'];
                                    } elseif($valor_productos_relacionados['por_defecto'] == 1) {
                                        $descripcionAAnadir = '- Mitad ';
                                        $cantidad = $valor_productos_relacionados['cantidad_mitad'];
                                    } elseif($valor_productos_relacionados['por_defecto'] == 2) {
                                        $descripcionAAnadir = '- Sin ';
                                        $cantidad = $valor_productos_relacionados['cantidad_sin'];
                                    } elseif($valor_productos_relacionados['por_defecto'] == 3) {
                                        $descripcionAAnadir = '- Doble ';
                                        $cantidad = $valor_productos_relacionados['cantidad_doble'];
                                    }
                                    if ($valor_productos_relacionados['modelo'] == 4) {
                                        continue;
                                    }

                                    $lineaRecepcionDePedido = new stdClass();
                                    $lineaRecepcionDePedido->id_documento_2 = $lineaPedido['id'];
                                    $lineaRecepcionDePedido->id_producto_relacionado = $valor_productos_relacionados['id_relacionado'];
                                    $lineaRecepcionDePedido->cantidad = '';
                                    $lineaRecepcionDePedido->tipo_producto = 0;
                                    $lineaRecepcionDePedido->slug = $lineaPedido['slug'];
                                    $lineaRecepcionDePedido->id_producto = $lineaPedido['id_producto'];
                                    $lineaRecepcionDePedido->descripcion_producto = $descripcionAAnadir . stripslashes($valor_productos_relacionados['descripcion']) . ((empty($valor_productos_relacionados['observaciones']))? '' : ': ' . $valor_productos_relacionados['observaciones']);
                                    $lineaRecepcionDePedido->observaciones = '';

                                    $recepcionProductosPorGrupo->productos[] = $lineaRecepcionDePedido;
                                }
                            }
                        }
                    }
                }
            }
        }

        if (!empty($productosInsertados)) {
            $recepcionDePedidos[] = $recepcionDePedido;
        }
    }
}
function ordenarPedidoPorUltimaModificacion($a, $b)
{
    $a = new DateTime($a->fecha_ultima_modificacion);
    $b = new DateTime($b->fecha_ultima_modificacion);
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
}

$a = array(3, 2, 5, 6, 1);

usort($recepcionDePedidos, "ordenarPedidoPorUltimaModificacion");