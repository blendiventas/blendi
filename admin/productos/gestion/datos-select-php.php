<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(!isset($logs_sys)) {
    $logs_sys = new stdClass();
}

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if (!function_exists('calcular_coste_kgr')) {
    function calcular_coste_kgr($conn, $id_url, $tipo_producto_productos, $log)
    {
        $coste_elaborado = 0;
        if ($tipo_producto_productos == 1) {
            $result_productos_relacionados = $conn->query("SELECT id_producto_relacionado,cantidad 
                                                        FROM productos_relacionados_elaborados WHERE id_producto='" . $id_url . "'");
        } else if ($tipo_producto_productos == 2) {
            $result_productos_relacionados = $conn->query("SELECT id_relacionado AS id_producto_relacionado,cantidad_con as cantidad,cantidad_mitad,cantidad_sin,cantidad_doble 
                                                        FROM productos_relacionados WHERE id_producto='" . $id_url . "'");
        } else if ($tipo_producto_productos == 3 || $tipo_producto_productos == 4) {
            $result_productos_relacionados = $conn->query("SELECT id_relacionado AS id_producto_relacionado,cantidad 
                                                        FROM productos_relacionados_combo WHERE id_producto='" . $id_url . "' AND activo=1");
        }
        if ($conn->registros() >= 1) {
            foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                $result_productos = $conn->query("SELECT descripcion,tipo_producto,coste,peso_bruto,peso_neto FROM productos WHERE id='" . $valor_productos_relacionados['id_producto_relacionado'] . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    if ($result_productos[0]['tipo_producto'] == 0) {
                        if ($result_productos[0]['peso_neto'] > 0 && $result_productos[0]['peso_bruto'] > 0) {
                            $multiplicadoresPCR = json_decode('[ { "pct": 0, "multiplicador": 1 }, { "pct": 1, "multiplicador": 1.01 }, { "pct": 2, "multiplicador": 1.02 }, { "pct": 3, "multiplicador": 1.03 }, { "pct": 4, "multiplicador": 1.04 }, { "pct": 5, "multiplicador": 1.05 }, { "pct": 6, "multiplicador": 1.06 }, { "pct": 7, "multiplicador": 1.07 }, { "pct": 8, "multiplicador": 1.08 }, { "pct": 9, "multiplicador": 1.09 }, { "pct": 10, "multiplicador": 1.11 }, { "pct": 11, "multiplicador": 1.12 }, { "pct": 12, "multiplicador": 1.13 }, { "pct": 13, "multiplicador": 1.14 }, { "pct": 14, "multiplicador": 1.15 }, { "pct": 15, "multiplicador": 1.18 }, { "pct": 16, "multiplicador": 1.2 }, { "pct": 17, "multiplicador": 1.21 }, { "pct": 18, "multiplicador": 1.22 }, { "pct": 19, "multiplicador": 1.23 }, { "pct": 20, "multiplicador": 1.25 }, { "pct": 21, "multiplicador": 1.27 }, { "pct": 22, "multiplicador": 1.28 }, { "pct": 23, "multiplicador": 1.29 }, { "pct": 24, "multiplicador": 1.3 }, { "pct": 25, "multiplicador": 1.33 }, { "pct": 26, "multiplicador": 1.35 }, { "pct": 27, "multiplicador": 1.37 }, { "pct": 28, "multiplicador": 1.39 }, { "pct": 29, "multiplicador": 1.41 }, { "pct": 30, "multiplicador": 1.43 }, { "pct": 31, "multiplicador": 1.45 }, { "pct": 32, "multiplicador": 1.47 }, { "pct": 33, "multiplicador": 1.49 }, { "pct": 34, "multiplicador": 1.51 }, { "pct": 35, "multiplicador": 1.53 }, { "pct": 36, "multiplicador": 1.56 }, { "pct": 37, "multiplicador": 1.59 }, { "pct": 38, "multiplicador": 1.62 }, { "pct": 39, "multiplicador": 1.65 }, { "pct": 40, "multiplicador": 1.66 }, { "pct": 41, "multiplicador": 1.69 }, { "pct": 42, "multiplicador": 1.73 }, { "pct": 43, "multiplicador": 1.77 }, { "pct": 44, "multiplicador": 1.8 }, { "pct": 45, "multiplicador": 1.82 }, { "pct": 46, "multiplicador": 1.86 }, { "pct": 47, "multiplicador": 1.9 }, { "pct": 48, "multiplicador": 1.94 }, { "pct": 49, "multiplicador": 1.98 }, { "pct": 50, "multiplicador": 2 }, { "pct": 51, "multiplicador": 2.05 }, { "pct": 52, "multiplicador": 2.1 }, { "pct": 53, "multiplicador": 2.15 }, { "pct": 54, "multiplicador": 2.2 }, { "pct": 55, "multiplicador": 2.22 }, { "pct": 56, "multiplicador": 2.28 }, { "pct": 57, "multiplicador": 2.34 }, { "pct": 58, "multiplicador": 2.4 }, { "pct": 59, "multiplicador": 2.46 }, { "pct": 60, "multiplicador": 2.5 }, { "pct": 61, "multiplicador": 2.58 }, { "pct": 62, "multiplicador": 2.66 }, { "pct": 63, "multiplicador": 2.74 }, { "pct": 64, "multiplicador": 2.82 }, { "pct": 65, "multiplicador": 2.85 }, { "pct": 66, "multiplicador": 2.96 }, { "pct": 67, "multiplicador": 3.07 }, { "pct": 68, "multiplicador": 3.18 }, { "pct": 69, "multiplicador": 3.29 }, { "pct": 70, "multiplicador": 3.33 }, { "pct": 71, "multiplicador": 3.48 }, { "pct": 72, "multiplicador": 3.63 }, { "pct": 73, "multiplicador": 3.78 }, { "pct": 74, "multiplicador": 3.93 }, { "pct": 75, "multiplicador": 4 }, { "pct": 76, "multiplicador": 4.2 }, { "pct": 77, "multiplicador": 4.4 }, { "pct": 78, "multiplicador": 4.6 }, { "pct": 79, "multiplicador": 4.8 }, { "pct": 80, "multiplicador": 5 }, { "pct": 81, "multiplicador": 5.4 }, { "pct": 82, "multiplicador": 5.8 }, { "pct": 83, "multiplicador": 6.2 }, { "pct": 84, "multiplicador": 6.6 }, { "pct": 85, "multiplicador": 6.67 }, { "pct": 86, "multiplicador": 7.47 }, { "pct": 87, "multiplicador": 8.27 }, { "pct": 88, "multiplicador": 9.07 }, { "pct": 89, "multiplicador": 9.97 }, { "pct": 90, "multiplicador": 10 }, { "pct": 91, "multiplicador": 13 }, { "pct": 92, "multiplicador": 16 }, { "pct": 93, "multiplicador": 19 }, { "pct": 94, "multiplicador": 22 }, { "pct": 95, "multiplicador": 25 } ]');
                            $pct = 100 - $result_productos[0]['peso_neto'] / $result_productos[0]['peso_bruto'] * 100;
                            $coste_neto = 0;
                            if ($pct >= $multiplicadoresPCR[count($multiplicadoresPCR) - 1]->pct) {
                                $coste_neto = $multiplicadoresPCR[count($multiplicadoresPCR) - 1]->multiplicador * $result_productos[0]['coste'];
                            }
                            for ($i = 0; $i < count($multiplicadoresPCR) - 1; $i++) {
                                if ($pct >= $multiplicadoresPCR[$i]->pct && $pct <= $multiplicadoresPCR[$i + 1]->pct) {
                                    $coste_neto = $multiplicadoresPCR[$i]->multiplicador * $result_productos[0]['coste'];
                                }
                            }
                        } else {
                            $coste_neto = $result_productos[0]['coste'];
                        }
                        if ($log) {
                            $result_productos_costes = $conn->query("SELECT tiempo FROM productos_costes WHERE id_producto='" . $valor_productos_relacionados['id_producto_relacionado'] . "' LIMIT 1");
                            $tiempo = 1;
                            if ($conn->registros() == 1) {
                                if ($result_productos_costes[0]['tiempo'] > 0) {
                                    $tiempo = $result_productos_costes[0]['tiempo'];
                                }
                            }
                            $matriz_simple_composicion[$key_productos_relacionados] = stripslashes($result_productos[0]['descripcion'])." (producto normal)";
                            $matriz_coste_producto[$key_productos_relacionados] = $coste_neto;
                            $matriz_cantidad_producto[$key_productos_relacionados] = $valor_productos_relacionados['cantidad'];
                            if (!empty($result_productos[0]['peso_bruto']) && $result_productos[0]['peso_bruto'] > 0 && !empty($valor_productos_relacionados['cantidad'])) {
                                $pesoBruto = $valor_productos_relacionados['cantidad'] / $result_productos[0]['peso_bruto'];
                            } else {
                                $pesoBruto = 1;
                            }
                            $matriz_tiempo_composicion[$key_productos_relacionados] = ($tiempo * $pesoBruto) / 60; // En minutos
                        }
                        $coste_elaborado += $coste_neto * $valor_productos_relacionados['cantidad'];
                    } else {
                        if ($log) {
                            if($result_productos[0]['tipo_producto'] == 1) {
                                $matriz_complejo_composicion[$key_productos_relacionados] = stripslashes($result_productos[0]['descripcion'])." (producto elaborado)";
                            }else if($result_productos[0]['tipo_producto'] == 2) {
                                $matriz_complejo_composicion[$key_productos_relacionados] = stripslashes($result_productos[0]['descripcion'])." (producto compuesto)";
                            }else if($result_productos[0]['tipo_producto'] == 3 || $result_productos[0]['tipo_producto'] == 4) {
                                $matriz_complejo_composicion[$key_productos_relacionados] = stripslashes($result_productos[0]['descripcion'])." (producto combo)";
                            }
                        }
                        $result_productos_costes = $conn->query("SELECT cantidad_base, tiempo FROM productos_costes WHERE id_producto='" . $valor_productos_relacionados['id_producto_relacionado'] . "' LIMIT 1");
                        $peso = 1;
                        $tiempo = 1;
                        if ($conn->registros() == 1) {
                            if ($result_productos_costes[0]['cantidad_base'] > 0) {
                                $peso = $result_productos_costes[0]['cantidad_base'];
                            }
                            if ($result_productos_costes[0]['tiempo'] > 0) {
                                $tiempo = $result_productos_costes[0]['tiempo'];
                            }
                        }
                        $valores_devueltos = calcular_coste_kgr($conn, $valor_productos_relacionados['id_producto_relacionado'], $result_productos[0]['tipo_producto'], $log);
                        $matriz_hijos[$key_productos_relacionados] = $valores_devueltos;
                        $coste_total = $matriz_hijos[$key_productos_relacionados]['coste_elaborado'];
                        $coste_elaborado += ($coste_total / $peso) * $valor_productos_relacionados['cantidad'];
                        if ($log) {
                            $matriz_peso_composicion[$key_productos_relacionados] = $peso;
                            $matriz_cantidad_composicion[$key_productos_relacionados] = $valor_productos_relacionados['cantidad'];
                            $matriz_tiempo_composicion[$key_productos_relacionados] = $tiempo / 60; // En minutos
                            $matriz_coste_composicion[$key_productos_relacionados] = $coste_total;
                            $matriz_coste_kilo_composicion[$key_productos_relacionados] = $coste_total / $peso;
                            $matriz_coste_total_composicion[$key_productos_relacionados] = ($coste_total / $peso) * $valor_productos_relacionados['cantidad'];
                        }
                    }
                }
            }
        }
        if ($log) {
            $calculos = [
                'coste_elaborado' => $coste_elaborado,
                'matriz_simple_composicion' => $matriz_simple_composicion,
                'matriz_coste_producto' => $matriz_coste_producto,
                'matriz_cantidad_producto' => $matriz_cantidad_producto,
                'matriz_tiempo_producto' => $matriz_tiempo_composicion,
                'matriz_complejo_composicion' => $matriz_complejo_composicion,
                'matriz_peso_composicion' => $matriz_peso_composicion,
                'matriz_cantidad_composicion' => $matriz_cantidad_composicion,
                'matriz_coste_composicion' => $matriz_coste_composicion,
                'matriz_coste_kilo_composicion' => $matriz_coste_kilo_composicion,
                'matriz_coste_total_composicion' => $matriz_coste_total_composicion
            ];
        }else {
            $calculos = [
                'coste_elaborado' => $coste_elaborado
            ];
        }
        if ($matriz_hijos) {
            $calculos = array_merge($calculos, ['matriz_hijos' => $matriz_hijos]);
        }
        return $calculos;
    }
}
if (!function_exists('calcular_coste_personal')) {
    function calcular_coste_personal($conn, $id_url, $tipo_producto_productos, $tiempo, $peso_anterior, $cantidad_anterior)
    {
        $coste_segundos_empleado = (14.40 / 60) / 60; // 13 €/hora ---- 13/60 €/minuto ----  (13/60)/60 €/segundo
        $coste_personal = 0;
        if ($tiempo) {
            $coste_personal += $tiempo * $coste_segundos_empleado;
        } else {
            $result_productos_costes = $conn->query("SELECT cantidad_base, tiempo FROM productos_costes WHERE id_producto='" . $id_url . "'");
            if ($conn->registros() >= 1) {
                $coste_personal += $result_productos_costes[0]['tiempo'] * $coste_segundos_empleado;
            }
        }

        if ($tipo_producto_productos == 1) {
            $result_productos_relacionados = $conn->query("SELECT id_producto_relacionado,cantidad 
                                                        FROM productos_relacionados_elaborados WHERE id_producto='" . $id_url . "'");
        } else if ($tipo_producto_productos == 2) {
            $result_productos_relacionados = $conn->query("SELECT id_relacionado AS id_producto_relacionado,cantidad_con as cantidad,cantidad_mitad,cantidad_sin,cantidad_doble 
                                                        FROM productos_relacionados WHERE id_producto='" . $id_url . "'");
        } else if ($tipo_producto_productos == 3 || $tipo_producto_productos == 4) {
            $result_productos_relacionados = $conn->query("SELECT id_relacionado AS id_producto_relacionado,cantidad 
                                                        FROM productos_relacionados_combo WHERE id_producto='" . $id_url . "' AND activo=1");
        }
        if ($conn->registros() >= 1) {
            foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                $result_productos = $conn->query("SELECT descripcion,tipo_producto,coste,peso_bruto,peso_neto FROM productos WHERE id='" . $valor_productos_relacionados['id_producto_relacionado'] . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $result_productos_costes = $conn->query("SELECT cantidad_base, tiempo FROM productos_costes WHERE id_producto='" . $valor_productos_relacionados['id_producto_relacionado'] . "' LIMIT 1");
                    $peso = 0;
                    $tiempo = 0;
                    if ($conn->registros() == 1) {
                        if ($result_productos_costes[0]['cantidad_base'] > 0) {
                            $peso = $result_productos_costes[0]['cantidad_base'];
                        }
                        if ($result_productos[0]['tipo_producto'] == 0) {
                            $peso = $result_productos[0]['peso_bruto'];
                        }
                        if ($result_productos_costes[0]['tiempo'] > 0) {
                            $tiempo = $result_productos_costes[0]['tiempo'];
                        }
                    }

                    if (!empty($peso_anterior)) {
                        $peso = $peso_anterior;
                    }
                    $cantidad = $valor_productos_relacionados['cantidad'];
                    if (!empty($cantidad_anterior)) {
                        $cantidad = $cantidad * $cantidad_anterior;
                    }

                    if ($peso > 0 && $tiempo > 0) {
                        if ($result_productos[0]['tipo_producto'] == 0) {
                            $coste_personal += $coste_segundos_empleado * ($tiempo * ($cantidad / $peso));
                        } else {
                            $coste_personal += calcular_coste_personal($conn, $valor_productos_relacionados['id_producto_relacionado'], $result_productos[0]['tipo_producto'], $tiempo * ($cantidad / $peso), $peso, $cantidad / $peso);
                        }
                    }
                }
            }
        }
        return $coste_personal;
    }
}
if (!function_exists('agregar_stock_por_lote_y_producto')) {
    function agregar_stock_por_lote_y_producto($conn, $trazabilidad, $id_producto, $lote = null)
    {
        $result_productos = $conn->query("SELECT descripcion FROM productos 
                        WHERE id=" . $id_producto. " ORDER BY id DESC");
        if ($conn->registros() >= 1) {
            $descripcionProducto = $result_productos[0]['descripcion'];
        }

        $id_producto_trazado = false;
        foreach ($trazabilidad->id_producto_productos_sku_stock as $idProductoToCheck) {
            if ($idProductoToCheck == $id_producto) {
                $id_producto_trazado = true;
            }
        }

        $result_productos_sku_stock = $conn->query("SELECT dpss.*, l.nombre as nombre, l.apellido_1 as apellido_1, l.apellido_2 as apellido_2, l.razon_social as razon_social, l.razon_comercial as razon_comercial FROM documentos_" . date('Y') . "_productos_sku_stock dpss LEFT OUTER JOIN libradores l ON dpss.id_librador = l.id 
                        WHERE dpss.id_producto=" . $id_producto . " ORDER BY dpss.id DESC");
        if ($conn->registros() >= 1 && !$id_producto_trazado) {
            foreach ($result_productos_sku_stock as $key_productos_sku_stock => $valor_productos_sku_stock) {
                $trazabilidad->id_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id'];
                $trazabilidad->id_producto_productos_sku_stock[] = $id_producto;
                $trazabilidad->descripcion_producto_productos_sku_stock[] = $descripcionProducto;
                $trazabilidad->lote_documentos_productos_sku_stock[] = $valor_productos_sku_stock['lote'];
                $trazabilidad->caducidad_documentos_productos_sku_stock[] = $valor_productos_sku_stock['caducidad'];
                $trazabilidad->numero_serie_documentos_productos_sku_stock[] = $valor_productos_sku_stock['numero_serie'];
                $trazabilidad->tipo_documento_documentos_productos_sku_stock[] = $valor_productos_sku_stock['tipo_documento'];
                $trazabilidad->fecha_documentos_productos_sku_stock[] = $valor_productos_sku_stock['fecha'];
                $trazabilidad->id_documento_1_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_documento_1'];
                $trazabilidad->id_documento_2_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_documento_2'];
                $trazabilidad->tipo_librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['tipo_librador'];
                $trazabilidad->id_librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_librador'];
                if (empty($valor_productos_sku_stock['nombre'])) {
                    if ($valor_productos_sku_stock['razon_social']) {
                        $trazabilidad->librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['razon_social'];
                    } else if ($valor_productos_sku_stock['razon_comercial']) {
                        $trazabilidad->librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['razon_comercial'];
                    } else {
                        $trazabilidad->librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_librador'];
                    }
                } else {
                    $trazabilidad->librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['nombre'] . ' ' . $valor_productos_sku_stock['apellido_1'] . ' ' . $valor_productos_sku_stock['apellido_2'];
                }
                $trazabilidad->cantidad_documentos_productos_sku_stock[] = $valor_productos_sku_stock['cantidad'];
                $trazabilidad->id_unidades_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_unidades'];
                $trazabilidad->unidad_documentos_productos_sku_stock[] = stripslashes($valor_productos_sku_stock['unidad']);
                $trazabilidad->importe_documentos_productos_sku_stock[] = $valor_productos_sku_stock['importe'];
                $trazabilidad->fecha_alta_documentos_productos_sku_stock[] = $valor_productos_sku_stock['fecha_alta'];
                $trazabilidad->fecha_modificacion_documentos_productos_sku_stock[] = $valor_productos_sku_stock['fecha_modificacion'];

                $result_productos_sku_stock_enlace = $conn->query("SELECT dpss.id_producto AS id_producto FROM documentos_" . date('Y') . "_productos_sku_stock_enlace dpsse LEFT JOIN documentos_" . date('Y') . "_productos_sku_stock dpss ON dpss.id = dpsse.id_documentos_ps_stock_fin 
                        WHERE dpsse.id_documentos_ps_stock_inicio=" . $valor_productos_sku_stock['id'] . " ORDER BY dpss.id DESC");
                if ($conn->registros() >= 1) {
                    agregar_stock_por_lote_y_producto($conn, $trazabilidad, $result_productos_sku_stock_enlace[0]['id_producto'], $valor_productos_sku_stock['lote']);
                }
                $result_productos_sku_stock_enlace = $conn->query("SELECT dpss.id_producto AS id_producto FROM documentos_" . date('Y') . "_productos_sku_stock_enlace dpsse LEFT JOIN documentos_" . date('Y') . "_productos_sku_stock dpss ON dpss.id = dpsse.id_documentos_ps_stock_inicio 
                        WHERE dpsse.id_documentos_ps_stock_fin=" . $valor_productos_sku_stock['id'] . " ORDER BY dpss.id DESC");
                if ($conn->registros() >= 1) {
                    agregar_stock_por_lote_y_producto($conn, $trazabilidad, $result_productos_sku_stock_enlace[0]['id_producto'], $valor_productos_sku_stock['lote']);
                }
            }
        }
    }
}

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-filtrado":
            if (!isset($parametro_pagina)) {
                $parametro_pagina = 0;
            }
            if (!isset($parametro_resultados)) {
                $parametro_resultados = 10;
            }

            $whereBusqueda = '';
            if (isset($parametro_busqueda) && !empty($parametro_busqueda)) {
                $whereBusqueda .= " AND (descripcion LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }
            if (isset($parametro_filtro_habilitado)) {
                $whereBusqueda .= " AND activo = " . $parametro_filtro_habilitado . " ";
            }

            if (isset($id_tipo_productos_relacionados)) {
                if ($id_tipo_productos_relacionados == -1) {
                    $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos WHERE id_idioma=" . $id_idioma_sys . $whereBusqueda);
                    $resultsListadoFiltrado = $result[0]['number_results'];
                    $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,imagen,updated,activo FROM productos 
                        WHERE id_idioma=" . $id_idioma_sys . $whereBusqueda . " ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
                } else if ($id_tipo_productos_relacionados == "00") {
                    $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=0 AND producto_venta=0" . $whereBusqueda);
                    $resultsListadoFiltrado = $result[0]['number_results'];
                    $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,imagen,updated,activo FROM productos 
                            WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=0 AND producto_venta=0" . $whereBusqueda ." ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
                } else if ($id_tipo_productos_relacionados == "01") {
                    $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=0 AND producto_venta=1" . $whereBusqueda);
                    $resultsListadoFiltrado = $result[0]['number_results'];
                    $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,imagen,updated,activo FROM productos 
                            WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=0 AND producto_venta=1" . $whereBusqueda ." ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
                } else if ($id_tipo_productos_relacionados == "10") {
                    $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=1 AND producto_venta=0" . $whereBusqueda);
                    $resultsListadoFiltrado = $result[0]['number_results'];
                    $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,imagen,updated,activo FROM productos 
                            WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=1 AND producto_venta=0" . $whereBusqueda ." ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
                } else if ($id_tipo_productos_relacionados == "11") {
                    $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=1 AND producto_venta=1" . $whereBusqueda);
                    $resultsListadoFiltrado = $result[0]['number_results'];
                    $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,imagen,updated,activo FROM productos 
                            WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=1 AND producto_venta=1" . $whereBusqueda ." ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
                } else {
                    if ($id_tipo_productos_relacionados == 34) {
                        $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos WHERE id_idioma=" . $id_idioma_sys . " AND (tipo_producto=3 OR tipo_producto=4)" . $whereBusqueda);
                        $resultsListadoFiltrado = $result[0]['number_results'];
                        $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,imagen,updated,activo FROM productos 
                            WHERE id_idioma=" . $id_idioma_sys . " AND (tipo_producto=3 OR tipo_producto=4)" . $whereBusqueda ." ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
                    } else {
                        $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=" . $id_tipo_productos_relacionados . $whereBusqueda);
                        $resultsListadoFiltrado = $result[0]['number_results'];
                        $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,imagen,updated,activo FROM productos 
                            WHERE id_idioma=" . $id_idioma_sys . " AND tipo_producto=" . $id_tipo_productos_relacionados . $whereBusqueda ." ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
                    }
                }
            } else {
                $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos WHERE id_idioma=" . $id_idioma_sys . $whereBusqueda);
                $resultsListadoFiltrado = $result[0]['number_results'];
                $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,imagen,updated,activo FROM productos 
                    WHERE id_idioma=" . $id_idioma_sys . $whereBusqueda . " ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            }
            if ($conn->registros() == 0 && isset($parametro_busqueda) && !empty($parametro_busqueda)) { // Buscamos por código de barras en productos_sku
                $result_productos_sku = $conn->query("SELECT id_producto,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs 
                                            FROM productos_sku 
                                            WHERE codigo_barras='" . addslashes($parametro_busqueda) . "' OR referencia='" . addslashes($parametro_busqueda) . "'");
                if ($conn->registros() >= 1) {
                    $resultsListadoFiltrado = 1;
                    $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,imagen,updated,activo FROM productos 
                        WHERE id = " . $result_productos_sku[0]['id_producto'] . " AND id_idioma=" . $id_idioma_sys);
                }
            }
            if ($conn->registros() == 0) { // Buscamos por observaciones en documentos_XXXX_observaciones
                $subQuery = "SELECT id FROM productos_observaciones WHERE observacion like '%" . addslashes($parametro_busqueda) . "%'";
                $result_productos = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen, productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp, productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta FROM productos,productos_pvp WHERE productos.id in($subQuery) AND productos_pvp.id_producto in ($subQuery) GROUP BY productos.id");
            }
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result_productos as $key_productos => $valor_productos) {
                $matriz_id_producto_productos[$valor_productos['id']] = $valor_productos['id'];
                $matriz_descripcion_productos[$valor_productos['id']] = stripslashes($valor_productos['descripcion']);
                $matriz_tipo_productos[$valor_productos['id']] = $valor_productos['tipo_producto'];
                $matriz_producto_venta[$valor_productos['id']] = $valor_productos['producto_venta'];
                $matriz_imagen_productos[$valor_productos['id']] = stripslashes($valor_productos['imagen']);
                $matriz_updated_productos[$valor_productos['id']] = stripslashes($valor_productos['updated']);
                $matriz_activo_productos[$valor_productos['id']] = $valor_productos['activo'];
                $result_productos_categorias = $conn->query("SELECT id_categoria FROM productos_categorias 
                    WHERE id_producto=" . $valor_productos['id'] . " ORDER BY orden");
                foreach ($result_productos_categorias as $key_productos_categorias => $valor_productos_categorias) {
                    $matriz_id_categoria_productos_categorias[$valor_productos['id']][] = $valor_productos_categorias['id_categoria'];
                }
            }
            break;
        case "listado-filtrado-productos-relacionados":

            if ($tipo_producto_productos == 1) { // elaborado
                $result_productos_relacionados = $conn->query("SELECT * FROM productos_relacionados_elaborados 
                                                WHERE id_producto=" . $id_url . " ORDER BY orden");
                if ($conn->registros() >= 1) {
                    foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                        $matriz_id_productos_relacionados[] = $valor_productos_relacionados['id'];
                        $matriz_id_relacionado_productos_relacionados[] = $valor_productos_relacionados['id_producto_relacionado'];
                        $matriz_id_categoria_estadisticas_productos_relacionados[] = $valor_productos_relacionados['id_categoria_estadisticas'];
                        $matriz_fijo_productos_relacionados[] = $valor_productos_relacionados['fijo'];
                        $matriz_modelo_productos_relacionados[] = -1;
                        $matriz_cantidad_con_productos_relacionados[] = $valor_productos_relacionados['cantidad'];
                        $matriz_cantidad_mitad_productos_relacionados[] = 0;
                        $matriz_cantidad_sin_productos_relacionados[] = 0;
                        $matriz_cantidad_doble_productos_relacionados[] = 0;
                        $matriz_sumar_con_productos_relacionados[] = $valor_productos_relacionados['sumar'];
                        $matriz_sumar_mitad_productos_relacionados[] = 0;
                        $matriz_sumar_sin_productos_relacionados[] = 0;
                        $matriz_sumar_doble_productos_relacionados[] = 0;
                        $matriz_por_defecto_productos_relacionados[] = 0;
                        $matriz_mostrar_productos_relacionados[] = $valor_productos_relacionados['mostrar'];
                        $matriz_orden_productos_relacionados[] = $valor_productos_relacionados['orden'];
                        $matriz_id_unidad_productos_relacionados[] = $valor_productos_relacionados['id_unidad'];
                        $matriz_id_grupo_productos_relacionados[] = 0;
                    }
                }
            } else if ($tipo_producto_productos == 2) { // compuesto
                $result_productos_relacionados = $conn->query("SELECT * FROM productos_relacionados 
                                                WHERE id_producto=" . $id_url . " ORDER BY orden");
                if ($conn->registros() >= 1) {
                    foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                        $matriz_id_productos_relacionados[] = $valor_productos_relacionados['id'];
                        $matriz_id_relacionado_productos_relacionados[] = $valor_productos_relacionados['id_relacionado'];
                        $matriz_fijo_productos_relacionados[] = $valor_productos_relacionados['fijo'];
                        $matriz_cantidad_con_productos_relacionados[] = $valor_productos_relacionados['cantidad_con'];
                        $matriz_cantidad_mitad_productos_relacionados[] = $valor_productos_relacionados['cantidad_mitad'];
                        $matriz_cantidad_sin_productos_relacionados[] = $valor_productos_relacionados['cantidad_sin'];
                        $matriz_cantidad_doble_productos_relacionados[] = $valor_productos_relacionados['cantidad_doble'];
                        $matriz_sumar_con_productos_relacionados[] = $valor_productos_relacionados['sumar_con'];
                        $matriz_sumar_mitad_productos_relacionados[] = $valor_productos_relacionados['sumar_mitad'];
                        $matriz_sumar_sin_productos_relacionados[] = $valor_productos_relacionados['sumar_sin'];
                        $matriz_sumar_doble_productos_relacionados[] = $valor_productos_relacionados['sumar_doble'];
                        $matriz_por_defecto_productos_relacionados[] = $valor_productos_relacionados['por_defecto'];
                        $matriz_mostrar_productos_relacionados[] = $valor_productos_relacionados['mostrar'];
                        $matriz_orden_productos_relacionados[] = $valor_productos_relacionados['orden'];
                        $matriz_id_unidad_productos_relacionados[] = 0;
                        $matriz_id_grupo_productos_relacionados[] = $valor_productos_relacionados['id_grupo'];
                    }
                }
            } else if ($tipo_producto_productos == 3 or $tipo_producto_productos == 4) { // combo manual o automático
                $result_productos_relacionados = $conn->query("SELECT * FROM productos_relacionados_combo 
                                                WHERE id_producto=" . $id_url . " ORDER BY orden");
                if ($conn->registros() >= 1) {
                    foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                        $matriz_id_productos_relacionados[] = $valor_productos_relacionados['id'];
                        $matriz_id_relacionado_productos_relacionados[] = $valor_productos_relacionados['id_relacionado'];
                        $matriz_fijo_productos_relacionados[] = $valor_productos_relacionados['fijo'];
                        $matriz_cantidad_con_productos_relacionados[] = $valor_productos_relacionados['cantidad'];
                        $matriz_cantidad_mitad_productos_relacionados[] = 0;
                        $matriz_cantidad_sin_productos_relacionados[] = 0;
                        $matriz_cantidad_doble_productos_relacionados[] = 0;
                        $matriz_sumar_con_productos_relacionados[] = $valor_productos_relacionados['sumar'];
                        $matriz_sumar_mitad_productos_relacionados[] = 0;
                        $matriz_sumar_sin_productos_relacionados[] = 0;
                        $matriz_sumar_doble_productos_relacionados[] = 0;
                        $matriz_por_defecto_productos_relacionados[] = 0;
                        $matriz_mostrar_productos_relacionados[] = $valor_productos_relacionados['mostrar'];
                        $matriz_orden_productos_relacionados[] = $valor_productos_relacionados['orden'];
                        $matriz_id_unidad_productos_relacionados[] = 0;
                        $matriz_id_grupo_productos_relacionados[] = $valor_productos_relacionados['id_grupo'];
                        $matriz_activo_productos_relacionados[] = $valor_productos_relacionados['activo'];
                    }
                }
            }
            break;
        case "listado-filtrado-productos-embalajes":
            $result_productos_embalajes = $conn->query("SELECT * FROM productos_embalajes 
                                            WHERE id_producto=" . $id_url);
            if ($conn->registros() >= 1) {
                foreach ($result_productos_embalajes as $key_productos_embalajes => $valor_productos_embalajes) {
                    $matriz_id_productos_embalajes[] = $valor_productos_embalajes['id'];
                    $matriz_id_relacionado_productos_embalajes[] = $valor_productos_embalajes['id_producto_relacionado'];
                    $matriz_cantidad_productos_embalajes[] = $valor_productos_embalajes['cantidad'];
                    $matriz_sumar_productos_embalajes[] = $valor_productos_embalajes['sumar'];
                }
            }
            break;
        case "editar-ficha":
            if ($apartado_url == "" or $apartado_url == "null") {
                if (empty($id_url)) {
                    $id_productos = 0;
                    $id_idioma_productos = $id_idioma_sys;
                    $descripcion_productos = "";
                    $descripcion_url_productos = "";
                    $tipo_producto_productos = 0;
                    $producto_venta_productos = 1;
                    $id_iva_productos = 0;
                    $activo = 1;
                    $fecha_alta_productos = date("Y-m-d");
                    $fecha_modificacion_productos = date("Y-m-d");
                    $select_sys = "categorias";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/categorias/gestion/datos-select-php.php");
                    if (isset($matriz_id_categorias)) {
                        foreach ($matriz_id_categorias as $key_id_categorias => $valor_id_categorias) {
                            $matriz_id_categoria_productos_categorias[$valor_id_categorias] = -1;
                            $matriz_orden_productos_categorias[$valor_id_categorias] = "";
                            $matriz_fecha_alta_productos_categorias[$valor_id_categorias] = "";
                            $matriz_fecha_modificacion_productos_categorias[$valor_id_categorias] = "";
                        }
                        unset($matriz_id_categorias);
                        unset($matriz_descripcion_categorias);
                    }
                } else {
                    /*
                    CREATE TABLE `productos` (
                        `id` INT(11) NOT NULL AUTO_INCREMENT,
                        `id_idioma` INT(11) NOT NULL DEFAULT '0',
                        `descripcion` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
                        `tipo_producto` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'tipo_producto = 0 // normal\r\ntipo_producto = 1 // elaborado\r\ntipo_producto = 2 // compuesto\r\ntipo_producto = 3 // combo manual\r\ntipo_producto = 4 // combo automático',
                        `producto_venta` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '0 = producto interno\r\n1 = producto en venta',
                        `id_iva` INT(11) NOT NULL DEFAULT '0',
                        `peso_bruto` DOUBLE(15,3) NOT NULL DEFAULT '0.000',
                        `peso_neto` DOUBLE(15,3) NOT NULL DEFAULT '0.000',
                        `coste` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
                        `imagen` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                        `updated` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                        `alt` VARCHAR(60) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                        `tittle` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                        `activo` TINYINT(1) NOT NULL DEFAULT '1',
                        `fecha_alta` DATE NULL DEFAULT NULL,
                        `fecha_modificacion` DATE NULL DEFAULT NULL,
                    */
                    $result_productos = $conn->query("SELECT id,id_idioma,descripcion,tipo_producto,producto_venta,
                        id_iva,activo,fecha_alta,fecha_modificacion FROM productos 
                        WHERE id=" . $id_url . " LIMIT 1");
                    foreach ($result_productos as $key_productos => $valor_productos) {
                        $id_productos = $valor_productos['id'];
                        $id_idioma_productos = $valor_productos['id_idioma'];
                        $descripcion_productos = stripslashes($valor_productos['descripcion']);
                        $tipo_producto_productos = $valor_productos['tipo_producto'];
                        $producto_venta_productos = $valor_productos['producto_venta'];
                        $id_iva_productos = $valor_productos['id_iva'];
                        $activo = $valor_productos['activo'];
                        $fecha_alta_productos = $valor_productos['fecha_alta'];
                        $fecha_modificacion_productos = $valor_productos['fecha_modificacion'];
                        $result_productos_categorias = $conn->query("SELECT id,id_categoria,orden,fecha_alta,fecha_modificacion 
                        FROM productos_categorias 
                        WHERE id_producto=" . $id_url . " ORDER BY productos_categorias.orden");
                        foreach ($result_productos_categorias as $key_productos_categorias => $valor_productos_categorias) {
                            $matriz_id_categoria_productos_categorias[$valor_productos_categorias['id_categoria']] = $valor_productos_categorias['id_categoria'];
                            $matriz_orden_productos_categorias[$valor_productos_categorias['id_categoria']] = $valor_productos_categorias['orden'];
                            $matriz_fecha_alta_productos_categorias[$valor_productos_categorias['id_categoria']] = $valor_productos_categorias['fecha_alta'];
                            $matriz_fecha_modificacion_productos_categorias[$valor_productos_categorias['id_categoria']] = $valor_productos_categorias['fecha_modificacion'];
                        }
                    }
                    $result_productos_relacionados = $conn->query("SELECT id,id_categoria_elaborados FROM productos_costes WHERE id_producto=" . $id_url . " LIMIT 1");
                    $id_productos_elaborados = 0;
                    $id_categoria_elaborados_productos_elaborados = 0;
                    if ($conn->registros() == 1) {
                        $id_productos_elaborados = $result_productos_relacionados[0]['id'];
                        $id_categoria_elaborados_productos_elaborados = $result_productos_relacionados[0]['id_categoria_elaborados'];
                    }

                    $result = $conn->query("SELECT descripcion_url 
                                    FROM productos_web_datos 
                                    WHERE id_producto=" . $id_url . "  LIMIT 1");
                    $descripcion_url_productos = '';
                    if ($conn->registros() == 1) {
                        $descripcion_url_productos = stripslashes($result[0]['descripcion_url']);
                    }
                }
            } else if ($apartado_url == "unidades") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }

            } else if ($apartado_url == "composicion") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
                if (isset($tipo_producto_productos) && ($tipo_producto_productos == 1 || $tipo_producto_productos == 2)) {
                    $result = $conn->query("SELECT * FROM productos_costes WHERE id_producto=" . $id_url . " LIMIT 1");
                    $id_productos_elaborados = 0;
                    $cantidad_base_productos_elaborados = 0;
                    $id_unidades_base_productos_elaborados = 0;
                    $rentabilidad_productos_elaborados = 0;
                    $tiempo_productos_elaborados = 0;
                    $id_categoria_elaborados_productos_elaborados = 0;
                    if ($conn->registros() == 1) {
                        $id_productos_elaborados = $result[0]['id'];
                        $cantidad_base_productos_elaborados = $result[0]['cantidad_base'];
                        $id_unidades_base_productos_elaborados = $result[0]['id_unidades_base'];
                        $rentabilidad_productos_elaborados = $result[0]['rentabilidad'];
                        $tiempo_productos_elaborados = $result[0]['tiempo'];
                        $id_categoria_elaborados_productos_elaborados = $result[0]['id_categoria_elaborados'];
                    }
                }
            } else if ($apartado_url == "elaboracion") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "personalizacion") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "menu") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "complementarios") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }

                /* ................................................................ */

            } else if ($apartado_url == "propiedades") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "packs") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "pvp") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "imagen") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta,imagen,updated,alt,tittle FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                    $imagen_productos = stripslashes($result[0]['imagen']);
                    $updated_productos = stripslashes($result[0]['updated']);
                    $alt_productos = stripslashes($result[0]['alt']);
                    $tittle_productos = stripslashes($result[0]['tittle']);
                }
            } else if ($apartado_url == "referencias") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "web") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "proveedores") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "costes") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta,coste,peso_bruto,peso_neto FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                    $coste_productos = $result[0]['coste'];
                    $peso_bruto_productos = $result[0]['peso_bruto'];
                    $peso_neto_productos = $result[0]['peso_neto'];
                    $coste_neto = 0;
                    if ($peso_bruto_productos && $peso_neto_productos) {
                        $multiplicadoresPCR = json_decode('[ { "pct": 0, "multiplicador": 1 }, { "pct": 1, "multiplicador": 1.01 }, { "pct": 2, "multiplicador": 1.02 }, { "pct": 3, "multiplicador": 1.03 }, { "pct": 4, "multiplicador": 1.04 }, { "pct": 5, "multiplicador": 1.05 }, { "pct": 6, "multiplicador": 1.06 }, { "pct": 7, "multiplicador": 1.07 }, { "pct": 8, "multiplicador": 1.08 }, { "pct": 9, "multiplicador": 1.09 }, { "pct": 10, "multiplicador": 1.11 }, { "pct": 11, "multiplicador": 1.12 }, { "pct": 12, "multiplicador": 1.13 }, { "pct": 13, "multiplicador": 1.14 }, { "pct": 14, "multiplicador": 1.15 }, { "pct": 15, "multiplicador": 1.18 }, { "pct": 16, "multiplicador": 1.2 }, { "pct": 17, "multiplicador": 1.21 }, { "pct": 18, "multiplicador": 1.22 }, { "pct": 19, "multiplicador": 1.23 }, { "pct": 20, "multiplicador": 1.25 }, { "pct": 21, "multiplicador": 1.27 }, { "pct": 22, "multiplicador": 1.28 }, { "pct": 23, "multiplicador": 1.29 }, { "pct": 24, "multiplicador": 1.3 }, { "pct": 25, "multiplicador": 1.33 }, { "pct": 26, "multiplicador": 1.35 }, { "pct": 27, "multiplicador": 1.37 }, { "pct": 28, "multiplicador": 1.39 }, { "pct": 29, "multiplicador": 1.41 }, { "pct": 30, "multiplicador": 1.43 }, { "pct": 31, "multiplicador": 1.45 }, { "pct": 32, "multiplicador": 1.47 }, { "pct": 33, "multiplicador": 1.49 }, { "pct": 34, "multiplicador": 1.51 }, { "pct": 35, "multiplicador": 1.53 }, { "pct": 36, "multiplicador": 1.56 }, { "pct": 37, "multiplicador": 1.59 }, { "pct": 38, "multiplicador": 1.62 }, { "pct": 39, "multiplicador": 1.65 }, { "pct": 40, "multiplicador": 1.66 }, { "pct": 41, "multiplicador": 1.69 }, { "pct": 42, "multiplicador": 1.73 }, { "pct": 43, "multiplicador": 1.77 }, { "pct": 44, "multiplicador": 1.8 }, { "pct": 45, "multiplicador": 1.82 }, { "pct": 46, "multiplicador": 1.86 }, { "pct": 47, "multiplicador": 1.9 }, { "pct": 48, "multiplicador": 1.94 }, { "pct": 49, "multiplicador": 1.98 }, { "pct": 50, "multiplicador": 2 }, { "pct": 51, "multiplicador": 2.05 }, { "pct": 52, "multiplicador": 2.1 }, { "pct": 53, "multiplicador": 2.15 }, { "pct": 54, "multiplicador": 2.2 }, { "pct": 55, "multiplicador": 2.22 }, { "pct": 56, "multiplicador": 2.28 }, { "pct": 57, "multiplicador": 2.34 }, { "pct": 58, "multiplicador": 2.4 }, { "pct": 59, "multiplicador": 2.46 }, { "pct": 60, "multiplicador": 2.5 }, { "pct": 61, "multiplicador": 2.58 }, { "pct": 62, "multiplicador": 2.66 }, { "pct": 63, "multiplicador": 2.74 }, { "pct": 64, "multiplicador": 2.82 }, { "pct": 65, "multiplicador": 2.85 }, { "pct": 66, "multiplicador": 2.96 }, { "pct": 67, "multiplicador": 3.07 }, { "pct": 68, "multiplicador": 3.18 }, { "pct": 69, "multiplicador": 3.29 }, { "pct": 70, "multiplicador": 3.33 }, { "pct": 71, "multiplicador": 3.48 }, { "pct": 72, "multiplicador": 3.63 }, { "pct": 73, "multiplicador": 3.78 }, { "pct": 74, "multiplicador": 3.93 }, { "pct": 75, "multiplicador": 4 }, { "pct": 76, "multiplicador": 4.2 }, { "pct": 77, "multiplicador": 4.4 }, { "pct": 78, "multiplicador": 4.6 }, { "pct": 79, "multiplicador": 4.8 }, { "pct": 80, "multiplicador": 5 }, { "pct": 81, "multiplicador": 5.4 }, { "pct": 82, "multiplicador": 5.8 }, { "pct": 83, "multiplicador": 6.2 }, { "pct": 84, "multiplicador": 6.6 }, { "pct": 85, "multiplicador": 6.67 }, { "pct": 86, "multiplicador": 7.47 }, { "pct": 87, "multiplicador": 8.27 }, { "pct": 88, "multiplicador": 9.07 }, { "pct": 89, "multiplicador": 9.97 }, { "pct": 90, "multiplicador": 10 }, { "pct": 91, "multiplicador": 13 }, { "pct": 92, "multiplicador": 16 }, { "pct": 93, "multiplicador": 19 }, { "pct": 94, "multiplicador": 22 }, { "pct": 95, "multiplicador": 25 } ]');
                        $pct = 100 - $peso_neto_productos / $peso_bruto_productos * 100;
                        if ($pct >= $multiplicadoresPCR[count($multiplicadoresPCR) - 1]->pct) {
                            $coste_neto = $multiplicadoresPCR[count($multiplicadoresPCR) - 1]->multiplicador * $coste_productos;
                        }
                        for ($i = 0; $i < count($multiplicadoresPCR) - 1; $i++) {
                            if ($pct >= $multiplicadoresPCR[$i]->pct && $pct <= $multiplicadoresPCR[$i + 1]->pct) {
                                $coste_neto = $multiplicadoresPCR[$i]->multiplicador * $coste_productos;
                            }
                        }
                    }
                }
                $result_productos_relacionados = $conn->query("SELECT * FROM productos_costes WHERE id_producto=" . $id_url . " LIMIT 1");
                $id_productos_elaborados = 0;
                $cantidad_base_productos_elaborados = 0;
                $id_unidades_base_productos_elaborados = 0;
                $rentabilidad_productos_elaborados = 0;
                $tiempo_productos_elaborados = 0;
                $id_categoria_elaborados_productos_elaborados = 0;
                if ($conn->registros() == 1) {
                    $id_productos_elaborados = $result_productos_relacionados[0]['id'];
                    $cantidad_base_productos_elaborados = $result_productos_relacionados[0]['cantidad_base'];
                    $id_unidades_base_productos_elaborados = $result_productos_relacionados[0]['id_unidades_base'];
                    $rentabilidad_productos_elaborados = $result_productos_relacionados[0]['rentabilidad'];
                    $tiempo_productos_elaborados = $result_productos_relacionados[0]['tiempo'];
                    $id_categoria_elaborados_productos_elaborados = $result_productos_relacionados[0]['id_categoria_elaborados'];
                }
            } else if ($apartado_url == "stock") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "trazabilidad") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            } else if ($apartado_url == "otros") {
                $result = $conn->query("SELECT descripcion,tipo_producto,producto_venta FROM productos WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_productos = stripslashes($result[0]['descripcion']);
                    $tipo_producto_productos = $result[0]['tipo_producto'];
                    $producto_venta_productos = $result[0]['producto_venta'];
                }
            }
            break;
        case "descripcion-producto":
            $descripcion_productos = "";
            $result = $conn->query("SELECT descripcion FROM productos WHERE id=" . $id_url . " LIMIT 1");
            if ($conn->registros() == 1) {
                $descripcion_productos = stripslashes($result[0]['descripcion']);
            }
            break;
        case "datos-web":
            $id_productos_web_datos = 0;
            $descripcion_larga_productos = "";
            $descripcion_url_productos = "";
            $titulo_meta_productos = "";
            $descripcion_meta_productos = "";
            $id_productos_otros = 0;
            $tienda_productos = 1;
            $url_externa_productos = "";
            $gastos_productos = 0;
            $envio_gratis_productos = 0;
            $dias_entrega_productos = 0;
            $result = $conn->query("SELECT id,descripcion_larga,descripcion_url,titulo_meta,descripcion_meta 
                                    FROM productos_web_datos 
                                    WHERE id_producto=" . $id_producto_productos_web . " 
                                    AND id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_web . " 
                                    AND id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_web . " 
                                    AND id_packs=" . $id_packs_productos_web . " LIMIT 1");
            if ($conn->registros() == 1) {
                $id_productos_web_datos = $result[0]['id'];
                $descripcion_larga_productos = stripslashes($result[0]['descripcion_larga']);
                $descripcion_url_productos = stripslashes($result[0]['descripcion_url']);
                $titulo_meta_productos = stripslashes($result[0]['titulo_meta']);
                $descripcion_meta_productos = stripslashes($result[0]['descripcion_meta']);
            }
            $result = $conn->query("SELECT id,tienda,url_externa,gastos,envio_gratis,dias_entrega 
                                    FROM productos_otros 
                                    WHERE id_producto=" . $id_producto_productos_web . " 
                                    AND id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_web . " 
                                    AND id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_web . " 
                                    AND id_packs=" . $id_packs_productos_web . " LIMIT 1");
            if ($conn->registros() == 1) {
                $id_productos_otros = $result[0]['id'];
                $tienda_productos = $result[0]['tienda'];
                $url_externa_productos = stripslashes($result[0]['url_externa']);
                $gastos_productos = $result[0]['gastos'];
                $envio_gratis_productos = $result[0]['envio_gratis'];
                $dias_entrega_productos = $result[0]['dias_entrega'];
            }
            break;
        case "control-stock":
            $result = $conn->query("SELECT control_stock FROM productos_otros WHERE id_producto='" . $id_url . "' 
                                    AND id_productos_detalles_enlazado='0' AND id_productos_detalles_multiples='0' AND id_packs='0' LIMIT 1");
            if ($conn->registros() == 1) {
                $control_stock = $result[0]['control_stock'];
            }
            break;
        case "datos-stock":
            $result = $conn->query("SELECT id,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs,control_stock 
                                    FROM productos_otros 
                                    WHERE id_producto='" . $id_producto_productos . "' 
                                    AND id_productos_detalles_enlazado='" . $id_productos_detalles_enlazado_productos . "' 
                                    AND id_productos_detalles_multiples='" . $id_productos_detalles_multiples_productos . "' 
                                    AND id_packs='" . $id_packs_productos . "' LIMIT 1");
            if ($conn->registros() == 1) {
                $id_productos_otros = $result[0]['id'];
                $id_productos_detalles_enlazado = $result[0]['id_productos_detalles_enlazado'];
                $id_productos_detalles_multiples = $result[0]['id_productos_detalles_multiples'];
                $id_packs = $result[0]['id_packs'];
                $control_stock = $result[0]['control_stock'];
                $result_productos_sku = $conn->query("SELECT id,codigo_barras,referencia,fecha_alta,fecha_modificacion 
                                    FROM productos_sku 
                                    WHERE id_producto='" . $id_producto_productos . "' 
                                    AND id_productos_detalles_enlazado='" . $id_productos_detalles_enlazado_productos . "' 
                                    AND id_productos_detalles_multiples='" . $id_productos_detalles_multiples_productos . "' 
                                    AND id_packs='" . $id_packs_productos . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $id_productos_sku = $result_productos_sku[0]['id'];
                    $codigo_barras_productos_sku = $result_productos_sku[0]['codigo_barras'];
                    $referencia_productos_sku = $result_productos_sku[0]['referencia'];
                    $fecha_alta_productos_sku = $result_productos_sku[0]['fecha_alta'];
                    $fecha_modificacion_productos_sku = $result_productos_sku[0]['fecha_modificacion'];
                    $result_productos_sku_stock = $conn->query("SELECT * FROM documentos_" . date('Y') . "_productos_sku_stock 
                                WHERE id_productos_sku=" . $id_productos_sku . " ORDER BY id DESC");
                    if ($conn->registros() >= 1) {
                        foreach ($result_productos_sku_stock as $key_productos_sku_stock => $valor_productos_sku_stock) {
                            $id_productos_sku_stock[] = $valor_productos_sku_stock['id'];
                            $lote_productos_sku_stock[] = $valor_productos_sku_stock['lote'];
                            $caducidad_productos_sku_stock[] = $valor_productos_sku_stock['caducidad'];
                            $numero_serie_productos_sku_stock[] = $valor_productos_sku_stock['numero_serie'];
                            $tipo_documento_productos_sku_stock[] = $valor_productos_sku_stock['tipo_documento'];
                            $fecha_productos_sku_stock[] = $valor_productos_sku_stock['fecha'];
                            $id_documento_1_productos_sku_stock[] = $valor_productos_sku_stock['id_documento_1'];
                            $id_documento_2_productos_sku_stock[] = $valor_productos_sku_stock['id_documento_2'];
                            $tipo_librador_productos_sku_stock[] = $valor_productos_sku_stock['tipo_librador'];
                            $id_librador_productos_sku_stock[] = $valor_productos_sku_stock['id_librador'];
                            $cantidad_productos_sku_stock[] = $valor_productos_sku_stock['cantidad'];
                            $id_unidades_productos_sku_stock[] = $valor_productos_sku_stock['id_unidades'];
                            $unidad_productos_sku_stock[] = stripslashes($valor_productos_sku_stock['unidad']);
                            //if ($valor_productos_sku_stock['tipo_librador'] == "cli") {
                                $importe_productos_sku_stock[] = $valor_productos_sku_stock['importe'];
                            //} else {
                            //    $importe_productos_sku_stock[] = $valor_productos_sku_stock['coste'];
                            //}
                            //$fijo_productos_sku_stock_productos_sku_stock[] = $valor_productos_sku_stock['fijo'];
                            $fecha_alta_productos_sku_stock[] = $valor_productos_sku_stock['fecha_alta'];
                            $fecha_modificacion_productos_sku_stock[] = $valor_productos_sku_stock['fecha_modificacion'];
                        }
                    }
                }
            }
            break;
        case "stock-listado":
            $result_productos_sku_stock = $conn->query("SELECT dpss.*, l.nombre as nombre, l.apellido_1 as apellido_1, l.apellido_2 as apellido_2, l.razon_social as razon_social, l.razon_comercial as razon_comercial FROM documentos_" . date('Y') . "_productos_sku_stock dpss LEFT OUTER JOIN libradores l ON dpss.id_librador = l.id  
                        WHERE id_producto=" . $id_producto_productos . " ORDER BY id DESC");
            if ($conn->registros() >= 1) {
                foreach ($result_productos_sku_stock as $key_productos_sku_stock => $valor_productos_sku_stock) {
                    $id_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id'];
                    $lote_documentos_productos_sku_stock[] = $valor_productos_sku_stock['lote'];
                    $caducidad_documentos_productos_sku_stock[] = $valor_productos_sku_stock['caducidad'];
                    $numero_serie_documentos_productos_sku_stock[] = $valor_productos_sku_stock['numero_serie'];
                    $tipo_documento_documentos_productos_sku_stock[] = $valor_productos_sku_stock['tipo_documento'];
                    $fecha_documentos_productos_sku_stock[] = $valor_productos_sku_stock['fecha'];
                    $id_documento_1_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_documento_1'];
                    $id_documento_2_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_documento_2'];
                    $tipo_librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['tipo_librador'];
                    $id_librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_librador'];
                    if (empty($valor_productos_sku_stock['nombre'])) {
                        if ($valor_productos_sku_stock['razon_social']) {
                            $librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['razon_social'];
                        } else if ($valor_productos_sku_stock['razon_comercial']) {
                            $librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['razon_comercial'];
                        } else {
                            $librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_librador'];
                        }
                    } else {
                        $librador_documentos_productos_sku_stock[] = $valor_productos_sku_stock['nombre'] . ' ' . $valor_productos_sku_stock['apellido_1'] . ' ' . $valor_productos_sku_stock['apellido_2'];
                    }
                    $cantidad_documentos_productos_sku_stock[] = $valor_productos_sku_stock['cantidad'];
                    $id_unidades_documentos_productos_sku_stock[] = $valor_productos_sku_stock['id_unidades'];
                    $unidad_documentos_productos_sku_stock[] = stripslashes($valor_productos_sku_stock['unidad']);
                    //if ($valor_productos_sku_stock['tipo_librador'] == "cli") {
                        $importe_documentos_productos_sku_stock[] = $valor_productos_sku_stock['importe'];
                    //} else {
                    //    $importe_documentos_productos_sku_stock[] = $valor_productos_sku_stock['coste'];
                    //}
                    //$fijo_productos_sku_stock_documentos_productos_sku_stock[] = $valor_productos_sku_stock['fijo'];
                    $fecha_alta_documentos_productos_sku_stock[] = $valor_productos_sku_stock['fecha_alta'];
                    $fecha_modificacion_documentos_productos_sku_stock[] = $valor_productos_sku_stock['fecha_modificacion'];
                }
            }
            break;
        case "stock-listado-trazabilidad":
            $trazabilidad = new stdClass();
            $trazabilidad->id_documentos_productos_sku_stock = [];
            $trazabilidad->id_producto_productos_sku_stock = [];
            $trazabilidad->descripcion_producto_productos_sku_stock = [];
            $trazabilidad->lote_documentos_productos_sku_stock = [];
            $trazabilidad->caducidad_documentos_productos_sku_stock = [];
            $trazabilidad->numero_serie_documentos_productos_sku_stock = [];
            $trazabilidad->tipo_documento_documentos_productos_sku_stock = [];
            $trazabilidad->fecha_documentos_productos_sku_stock = [];
            $trazabilidad->id_documento_1_documentos_productos_sku_stock = [];
            $trazabilidad->id_documento_2_documentos_productos_sku_stock = [];
            $trazabilidad->tipo_librador_documentos_productos_sku_stock = [];
            $trazabilidad->id_librador_documentos_productos_sku_stock = [];
            $trazabilidad->librador_documentos_productos_sku_stock = [];
            $trazabilidad->cantidad_documentos_productos_sku_stock = [];
            $trazabilidad->id_unidades_documentos_productos_sku_stock = [];
            $trazabilidad->unidad_documentos_productos_sku_stock = [];
            $trazabilidad->importe_documentos_productos_sku_stock = [];
            $trazabilidad->fecha_alta_documentos_productos_sku_stock = [];
            $trazabilidad->fecha_modificacion_documentos_productos_sku_stock = [];

            agregar_stock_por_lote_y_producto($conn, $trazabilidad, $id_producto_productos);
            break;
        case "stock-elaboracion":
            $columnas = 0;
            /*
            $mostrar_lote = false;
            $mostrar_caducidad = false;
            $mostrar_numero_serie = false;
            $mostrar_codigo_barras = false;
            */
            $mostrar_lote = true;
            $mostrar_caducidad = true;
            $mostrar_numero_serie = false;
            $mostrar_codigo_barras = true;

            $result = $conn->query("SELECT lote,caducidad,numero_serie,codigo_barras FROM documentos_" . date('Y') . "_productos_sku_stock 
                        WHERE 
                        id_producto=" . $id_producto_productos . " AND tipo_documento='ela' AND 
                        (lote<>'' OR caducidad<>'0000-00-00' OR numero_serie<>'' OR codigo_barras<>'') LIMIT 1");
            if ($conn->registros() >= 1) {
                if($result[0]['lote'] != '') {
                    $mostrar_lote = true;
                    $columnas += 1;
                }
                if(!empty($result[0]['caducidad'])) {
                    $mostrar_caducidad = true;
                    $columnas += 1;
                }
                if(!empty($result['numero_serie'])) {
                    $mostrar_numero_serie = true;
                    $columnas += 1;
                }
                if(!empty($result['codigo_barras'])) {
                    $mostrar_codigo_barras = true;
                    $columnas += 1;
                }
            }
            if($columnas == 0) {
                $result_productos_relacionados_elaborados = $conn->query("SELECT id_producto,id_producto_relacionado FROM productos_relacionados_elaborados 
                            WHERE id_producto=" . $id_producto_productos . " ORDER BY id ASC");
                if ($conn->registros() >= 1) {
                    foreach ($result_productos_relacionados_elaborados as $key_productos_relacionados_elaborados => $valor_productos_relacionados_elaborados) {
                        $result_descripcion_articulo = $conn->query("SELECT lote,caducidad,numero_serie,codigo_barras FROM documentos_" . date('Y') . "_productos_sku_stock 
                            WHERE 
                            (id_producto=" . $valor_productos_relacionados_elaborados['id_producto_relacionado'] . " AND tipo_documento='tiq') AND 
                            (lote<>'' OR caducidad<>'0000-00-00' OR numero_serie<>'' OR codigo_barras<>'') LIMIT 1");
                        if (!empty($result_descripcion_articulo[0]['lote'])) {
                            $mostrar_lote = true;
                            $columnas += 1;
                        }
                        if (!empty($result_descripcion_articulo[0]['caducidad'])) {
                            $mostrar_caducidad = true;
                            $columnas += 1;
                        }
                        if (!empty($result_descripcion_articulo[0]['numero_serie'])) {
                            $mostrar_numero_serie = true;
                            $columnas += 1;
                        }
                        if (!empty($result_descripcion_articulo[0]['codigo_barras'])) {
                            $mostrar_codigo_barras = true;
                            $columnas += 1;
                        }
                    }
                }
            }

            if($mostrar_numero_serie == true) {
                $mostrar_lote = false;
                $mostrar_caducidad = false;
                $mostrar_codigo_barras = false;
            }
            break;
        case "stock-listado-elaboracion":
            $result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");

            $decimales_cantidades = $result_configuracion[0]['decimales_cantidades'];
            $decimales_importes = $result_configuracion[0]['decimales_importes'];

            $elaboraciones = [];
            $result_productos_sku_stock = $conn->query("SELECT * FROM documentos_" . date('Y') . "_productos_sku_stock 
                        WHERE id_producto=" . $id_producto_productos . " AND tipo_documento='ela' ORDER BY id DESC");
            if ($conn->registros() >= 1) {
                foreach ($result_productos_sku_stock as $key_productos_sku_stock => $valor_productos_sku_stock) {
                    $result_descripcion_articulo = $conn->query("SELECT descripcion FROM productos 
                        WHERE id=" . $valor_productos_sku_stock['id_producto'] . " LIMIT 1");
                    $datosElaboraciones = new stdClass();
                    $datosElaboraciones->id = $valor_productos_sku_stock['id'];
                    $datosElaboraciones->descripcion = stripslashes($result_descripcion_articulo[0]['descripcion']);
                    if($mostrar_lote) {
                        $datosElaboraciones->lote = stripslashes($valor_productos_sku_stock['lote']);
                    }
                    if($mostrar_caducidad) {
                        $datosElaboraciones->caducidad = $valor_productos_sku_stock['caducidad'];
                    }
                    if($mostrar_numero_serie) {
                        $datosElaboraciones->numero_serie = stripslashes($valor_productos_sku_stock['numero_serie']);
                    }
                    $datosElaboraciones->codigo_barras = stripslashes($valor_productos_sku_stock['codigo_barras']);
                    $datosElaboraciones->fecha = $valor_productos_sku_stock['fecha'];
                    $datosElaboraciones->cantidad = $valor_productos_sku_stock['cantidad'];

                    $result_productos_sku_stock_relacionados = $conn->query("SELECT * FROM documentos_" . date('Y') . "_productos_sku_stock 
                        WHERE tipo_documento='tiq' AND id_productos_sku=0 AND id_documento_1=" . $valor_productos_sku_stock['id_documento_1'] . " AND id_documento_2=" . $valor_productos_sku_stock['id_documento_2'] . " AND id_librador=0 ORDER BY id_producto ASC");
                    if ($conn->registros() >= 1) {
                        foreach ($result_productos_sku_stock_relacionados as $key_productos_sku_stock_relacionados => $valor_productos_sku_stock_relacionados) {
                            $result_descripcion_articulo = $conn->query("SELECT descripcion FROM productos 
                                WHERE id=" . $valor_productos_sku_stock_relacionados['id_producto'] . " LIMIT 1");
                            $lineaDatosElaboraciones = new stdClass();
                            $lineaDatosElaboraciones->id_linea = $valor_productos_sku_stock_relacionados['id'];
                            $lineaDatosElaboraciones->descripcion_linea = stripslashes($result_descripcion_articulo[0]['descripcion']);
                            if($mostrar_lote) {
                                $lineaDatosElaboraciones->lote_linea = stripslashes($valor_productos_sku_stock_relacionados['lote']);
                            }
                            if($mostrar_caducidad) {
                                $lineaDatosElaboraciones->caducidad_linea = $valor_productos_sku_stock_relacionados['caducidad'];
                            }
                            if($mostrar_numero_serie) {
                                $lineaDatosElaboraciones->numero_serie_linea = stripslashes($valor_productos_sku_stock_relacionados['numero_serie']);
                            }
                            if($mostrar_codigo_barras) {
                                $lineaDatosElaboraciones->codigo_barras_linea = stripslashes($valor_productos_sku_stock_relacionados['codigo_barras']);
                            }
                            /* $lineaDatosElaboraciones->fecha_linea = $valor_productos_sku_stock_relacionados['fecha']; */
                            $lineaDatosElaboraciones->cantidad_linea = $valor_productos_sku_stock_relacionados['cantidad'];

                            $datosElaboraciones->lineasDatos[] = $lineaDatosElaboraciones;
                        }
                    }
                    $elaboraciones[] = $datosElaboraciones;
                }
            }
            break;
        case "stock":
            /*
            $stock_productos_sku = 0;
            $stock_productos_sku_stock = 0;
            $stock_productos_sku_stock_entradas = 0;
            $stock_productos_sku_stock_salidas = 0;
            $result_productos_sku = $conn->query("SELECT id,codigo_barras,referencia,stock,fecha_alta,fecha_modificacion 
                                    FROM productos_sku 
                                    WHERE id_producto='" . $id_producto_productos . "' 
                                    AND id_productos_detalles_enlazado='" . $id_productos_detalles_enlazado_productos . "' 
                                    AND id_productos_detalles_multiples='" . $id_productos_detalles_multiples_productos . "' 
                                    AND id_packs='" . $id_packs_productos . "' LIMIT 1");
            if ($conn->registros() == 1) {
                $stock_productos_sku = $result_productos_sku[0]['stock'];
                $result_productos_sku_stock = $conn->query("SELECT SUM(cantidad) as stock FROM documentos_" . date("Y") . "_productos_sku_stock 
                                WHERE id_productos_sku=" . $result_productos_sku[0]['id'] . " AND tipo_librador='pro' GROUP BY lote,numero_serie");
                if ($conn->registros() == 1) {
                    $stock_productos_sku_stock_entradas = $result_productos_sku_stock[0]['stock'];
                }
                $result_productos_sku_stock = $conn->query("SELECT SUM(cantidad) as stock FROM documentos_" . date("Y") . "_productos_sku_stock 
                                WHERE id_productos_sku=" . $result_productos_sku[0]['id'] . " AND tipo_librador='cli' GROUP BY lote,numero_serie");
                if ($conn->registros() == 1) {
                    $stock_productos_sku_stock_salidas = $result_productos_sku_stock[0]['stock'];
                }
                $stock_productos_sku_stock = $stock_productos_sku_stock_entradas - $stock_productos_sku_stock_salidas;

                if ($stock_productos_sku_stock != $stock_productos_sku) {
                    $result_productos_sku = $conn->query("UPDATE productos_sku SET stock='" . $stock_productos_sku_stock . "' 
                                    WHERE id='" . $result_productos_sku[0]['id'] . "' LIMIT 1");
                }
            }
            */
            $result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");

            $decimales_cantidades = $result_configuracion[0]['decimales_cantidades'];
            $decimales_importes = $result_configuracion[0]['decimales_importes'];

            $querySql = "SELECT 
                            A.`lote` as lote,
                            A.`numero_serie` as numero_serie,
                            CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock`
                        FROM 
                            (SELECT id, lote, numero_serie, SUM(`cantidad`) as cantidad FROM `documentos_" . $ejercicio . "_productos_sku_stock` WHERE id_producto=" . $id_url . " AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN
                            (SELECT id, lote, numero_serie, SUM(`cantidad`) as cantidad_ventas FROM `documentos_" . $ejercicio . "_productos_sku_stock` WHERE id_producto=" . $id_url . " AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote
                        WHERE (`cantidad`-`cantidad_ventas` > 0 OR `cantidad_ventas` IS NULL);";
            $result_productos_sku_stock = $conn->query($querySql);
            $stock_lotes = false;
            $stock_numeros_serie = false;
            foreach ($result_productos_sku_stock as $key_result_productos_sku_stock => $value_result_productos_sku_stock) {
                $matriz_stock_lote[] = stripslashes($value_result_productos_sku_stock['lote']);
                $matriz_stock_numero_serie[] = stripslashes($value_result_productos_sku_stock['numero_serie']);
                if(!empty($value_result_productos_sku_stock['lote'])) {
                    $stock_lotes = true;
                }
                if(!empty($value_result_productos_sku_stock['numero_serie'])) {
                    $stock_numeros_serie = true;
                }
                $matriz_stock_stock[] = number_format($value_result_productos_sku_stock['stock'], $decimales_cantidades, ".", "");
            }
            break;
        case "stock-trazabilidad":
            $result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");

            $decimales_cantidades = $result_configuracion[0]['decimales_cantidades'];
            $decimales_importes = $result_configuracion[0]['decimales_importes'];

            $querySql = "SELECT 
                            A.`lote` as lote,
                            A.`numero_serie` as numero_serie,
                            CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock`
                        FROM 
                            (SELECT id, lote, numero_serie, SUM(`cantidad`) as cantidad FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $id_url . " AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN
                            (SELECT id, lote, numero_serie, SUM(`cantidad`) as cantidad_ventas FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $id_url . " AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote;";
            $result_productos_sku_stock = $conn->query($querySql);
            $stock_lotes = false;
            $stock_numeros_serie = false;
            foreach ($result_productos_sku_stock as $key_result_productos_sku_stock => $value_result_productos_sku_stock) {
                $matriz_stock_lote[] = stripslashes($value_result_productos_sku_stock['lote']);
                $matriz_stock_numero_serie[] = stripslashes($value_result_productos_sku_stock['numero_serie']);
                if(!empty($value_result_productos_sku_stock['lote'])) {
                    $stock_lotes = true;
                }
                if(!empty($value_result_productos_sku_stock['numero_serie'])) {
                    $stock_numeros_serie = true;
                }
                $matriz_stock_stock[] = number_format($value_result_productos_sku_stock['stock'], $decimales_cantidades, ".", "");
            }
            break;
        case "datos-referencias":
            $id_productos_referencias_datos = 0;
            $codigo_barras = "";
            $referencia = "";
            $fecha_alta = date("Y-m-d");
            $fecha_modificacion = date("Y-m-d");
            $result = $conn->query("SELECT id,codigo_barras,referencia,fecha_alta,fecha_modificacion 
                                    FROM productos_sku 
                                    WHERE id_producto=" . $id_producto_productos_referencias . " 
                                    AND id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_referencias . " 
                                    AND id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_referencias . " 
                                    AND id_packs=" . $id_packs_productos_referencias . " LIMIT 1");
            if ($conn->registros() == 1) {
                $id_productos_referencias_datos = $result[0]['id'];
                $codigo_barras = stripslashes($result[0]['codigo_barras']);
                $referencia = stripslashes($result[0]['referencia']);
                $fecha_alta = stripslashes($result[0]['fecha_alta']);
                $fecha_modificacion = stripslashes($result[0]['fecha_modificacion']);
            }
            break;
        case "datos-otros":
            $id_productos_otros_datos = 0;
            $disponibilidad_productos = "1";
            $fecha_modificacion_productos = date("Y-m-d");
            $enviar_productos = "0";
            $manual_productos = "1";
            $profesionales_productos = "0";
            $peso_productos = "0";
            $bultos_productos = "1";
            $aplicar_descuento_productos = "0";
            $descuento_maximo_productos = "0";
            $id_observaciones_productos = "0";
            $observacion_productos = "";
            $result = $conn->query("SELECT id,disponibilidad,fecha_modificacion,enviar,manual,profesionales,peso,bultos,aplicar_descuento,descuento_maximo 
                                    FROM productos_otros 
                                    WHERE id_producto=" . $id_producto_productos_otros . " 
                                    AND id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_otros . " 
                                    AND id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_otros . " 
                                    AND id_packs=" . $id_packs_productos_otros . " LIMIT 1");
            if ($conn->registros() == 1) {
                $id_productos_otros_datos = $result[0]['id'];
                $disponibilidad_productos = $result[0]['disponibilidad'];
                $fecha_modificacion_productos = stripslashes($result[0]['fecha_modificacion']);
                $enviar_productos = $result[0]['enviar'];
                $manual_productos = $result[0]['manual'];
                $profesionales_productos = $result[0]['profesionales'];
                $peso_productos = $result[0]['peso'];
                $bultos_productos = $result[0]['bultos'];
                $aplicar_descuento_productos = $result[0]['aplicar_descuento'];
                $descuento_maximo_productos = $result[0]['descuento_maximo'];
            }
            $result = $conn->query("SELECT id_observaciones 
                                    FROM productos_web_datos 
                                    WHERE id_producto=" . $id_producto_productos_otros . " 
                                    AND id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_otros . " 
                                    AND id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_otros . " 
                                    AND id_packs=" . $id_packs_productos_otros . " LIMIT 1");
            if ($conn->registros() == 1) {
                $id_observaciones_productos = $result[0]['id_observaciones'];
                /*
                CREATE TABLE `productos_observaciones` (
                    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `observacion` TEXT NOT NULL COLLATE 'utf8_spanish_ci',
                */
                $result = $conn->query("SELECT observacion 
                                    FROM productos_observaciones 
                                    WHERE id=" . $id_observaciones_productos . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $observacion_productos = nl2br(stripslashes($result[0]['observacion']));
                }
            }
            break;
        case "buscar-productos":
            $id_url_entrada = $id_url;
            if ($buscar_por == "descripcion") {
                $result_productos = $conn->query("SELECT id,descripcion,tipo_producto,producto_venta,activo FROM productos 
                    WHERE id_idioma=" . $id_idioma_sys . " AND descripcion LIKE '%" . $texto_buscar . "%' AND id<>" . $id_url . " ORDER BY descripcion LIMIT 10");
                foreach ($result_productos as $key_productos => $valor_productos) {
                    $descripciones_productos_encontrados[] = stripslashes($valor_productos['descripcion']);
                    $id_producto_productos_encontrados[] = $valor_productos["id"];
                    $id_enlazado_productos_encontrados[] = 0;
                    $id_multiple_productos_encontrados[] = 0;
                    $id_pack_productos_encontrados[] = 0;
                    $tipo_producto_productos_encontrados[] = $valor_productos["tipo_producto"];
                    $producto_venta_productos_encontrados[] = $valor_productos['producto_venta'];
                    $activo_productos_encontrados[] = $valor_productos["activo"];

                    $id_url = $valor_productos['id'];
                    $select_sys = "listado_relaciones_producto";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                    if (isset($matriz_productos_detalles_relacion_id)) {
                        foreach ($matriz_productos_detalles_relacion_id as $key_enlazado => $valor_enlazado) {
                            $id_productos_detalles_enlazado = $valor_enlazado;
                            $select_sys = "descripcion_enlazado";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                            $descripciones_productos_encontrados[] = stripslashes($valor_productos['descripcion']) . " (" . $descripcion_productos_detalles_enlazado . ")";
                            $id_producto_productos_encontrados[] = $valor_productos["id"];
                            $id_enlazado_productos_encontrados[] = $valor_enlazado;
                            $id_multiple_productos_encontrados[] = 0;
                            $id_pack_productos_encontrados[] = 0;
                            $activo_productos_encontrados[] = $matriz_productos_detalles_relacion_activo[$key_enlazado];
                        }
                        unset($matriz_productos_detalles_relacion_id);
                        unset($matriz_productos_detalles_relacion_id_atributo_principal);
                        unset($matriz_productos_detalles_relacion_id_dato_principal);
                        unset($matriz_productos_detalles_relacion_id_atributo_enlazado);
                        unset($matriz_productos_detalles_relacion_id_dato_enlazado);
                        unset($matriz_productos_detalles_relacion_activo);
                    }
                    $select_sys = "listado_atributos_multiples";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                    if (isset($matriz_productos_detalles_multiples_id)) {
                        foreach ($matriz_productos_detalles_multiples_id as $key_multiple => $valor_multiple) {
                            $id_productos_detalles_multiples = $valor_multiple;
                            $select_sys = "descripcion_multiple";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                            $descripciones_productos_encontrados[] = stripslashes($valor_productos['descripcion']) . " (" . $descripcion_productos_detalles_multiples . ")";
                            $id_producto_productos_encontrados[] = $valor_productos["id"];
                            $id_enlazado_productos_encontrados[] = 0;
                            $id_multiple_productos_encontrados[] = $valor_multiple;
                            $id_pack_productos_encontrados[] = 0;
                            $activo_productos_encontrados[] = $matriz_productos_detalles_multiples_activo[$key_multiple];
                        }
                        unset($matriz_productos_detalles_multiples_id);
                        unset($productos_detalles_multiples_id_atributo);
                        unset($matriz_productos_detalles_multiples_id_dato);
                        unset($matriz_productos_detalles_multiples_activo);
                    }
                    $select_sys = "listado-packs";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/packs/gestion/datos-select-php.php");
                    if (isset($matriz_id_productos_packs)) {
                        foreach ($matriz_id_productos_packs as $key_packs => $valor_packs) {
                            $id_packs = $valor_packs;
                            $select_sys = "descripcion-pack";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/packs/gestion/datos-select-php.php");
                            if (!empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_packs])) {
                                $id_productos_detalles_enlazado = $matriz_id_productos_detalles_enlazado_productos_packs[$key_packs];
                                $select_sys = "descripcion_enlazado";
                                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                                $descripcion_pack = stripslashes($valor_productos['descripcion']) . " " . $descripcion_pack . " (" . $descripcion_productos_detalles_enlazado . ")";
                            } else if (!empty($matriz_id_productos_detalles_multiple_productos_packs[$key_packs])) {
                                $id_productos_detalles_multiples = $matriz_id_productos_detalles_multiple_productos_packs[$key_packs];
                                $select_sys = "descripcion_multiple";
                                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                                $descripcion_pack = stripslashes($valor_productos['descripcion']) . " " . $descripcion_pack . " (" . $descripcion_productos_detalles_multiples . ")";
                            } else {
                                $descripcion_pack = stripslashes($valor_productos['descripcion']) . " " . $descripcion_pack;
                            }
                            $descripciones_productos_encontrados[] = $descripcion_pack;
                            $id_producto_productos_encontrados[] = $valor_productos["id"];
                            $id_enlazado_productos_encontrados[] = $matriz_id_productos_detalles_enlazado_productos_packs[$key_packs];
                            $id_multiple_productos_encontrados[] = $matriz_id_productos_detalles_multiple_productos_packs[$key_packs];
                            $id_pack_productos_encontrados[] = $valor_packs;
                            $activo_productos_encontrados[] = $matriz_activo_productos_packs[$key_packs];
                        }
                        unset($matriz_id_productos_packs);
                        unset($matriz_id_productos_detalles_enlazado_productos_packs);
                        unset($matriz_id_productos_detalles_multiple_productos_packs);
                        unset($matriz_cantidad_pack_productos_packs);
                        unset($matriz_activo_productos_packs);
                        unset($matriz_orden_productos_packs);
                        unset($matriz_fecha_alta_productos_packs);
                        unset($matriz_fecha_modificacion_productos_packs);
                    }
                }
            } else if ($buscar_por == "referencia") {
                $result_sku = $conn->query("SELECT id_producto,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs FROM productos_sku 
                    WHERE referencia='" . addslashes($texto_buscar) . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $result_productos = $conn->query("SELECT id,descripcion,activo FROM productos 
                        WHERE id=" . $result_sku[0]['id_producto'] . " LIMIT 1");
                    $descripciones_productos_encontrados[] = stripslashes($result_productos[0]['descripcion']);
                    $id_producto_productos_encontrados[] = $result_sku[0]['id_producto'];
                    $id_enlazado_productos_encontrados[] = $result_sku[0]['id_productos_detalles_enlazado'];
                    $id_multiple_productos_encontrados[] = $result_sku[0]['id_productos_detalles_multiples'];
                    $id_pack_productos_encontrados[] = $result_sku[0]['id_packs'];

                    $id_url = $result_sku[0]['id_producto'];
                    $select_sys = "listado_relaciones_producto";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                    if (isset($matriz_productos_detalles_relacion_id)) {
                        foreach ($matriz_productos_detalles_relacion_id as $key_enlazado => $valor_enlazado) {
                            $id_productos_detalles_enlazado = $valor_enlazado;
                            $select_sys = "descripcion_enlazado";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                            $descripciones_productos_encontrados[] = stripslashes($result_productos[0]['descripcion']) . " (" . $descripcion_productos_detalles_enlazado . ")";
                            $id_producto_productos_encontrados[] = $valor_productos["id"];
                            $id_enlazado_productos_encontrados[] = $valor_enlazado;
                            $id_multiple_productos_encontrados[] = 0;
                            $id_pack_productos_encontrados[] = 0;
                            $activo_productos_encontrados[] = $matriz_productos_detalles_relacion_activo[$key_enlazado];
                        }
                        unset($matriz_productos_detalles_relacion_id);
                        unset($matriz_productos_detalles_relacion_id_atributo_principal);
                        unset($matriz_productos_detalles_relacion_id_dato_principal);
                        unset($matriz_productos_detalles_relacion_id_atributo_enlazado);
                        unset($matriz_productos_detalles_relacion_id_dato_enlazado);
                        unset($matriz_productos_detalles_relacion_activo);
                    }
                    $select_sys = "listado_atributos_multiples";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                    if (isset($matriz_productos_detalles_multiples_id)) {
                        foreach ($matriz_productos_detalles_multiples_id as $key_multiple => $valor_multiple) {
                            $id_productos_detalles_multiples = $valor_multiple;
                            $select_sys = "descripcion_multiple";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                            $descripciones_productos_encontrados[] = stripslashes($result_productos[0]['descripcion']) . " (" . $descripcion_productos_detalles_multiples . ")";
                            $id_producto_productos_encontrados[] = $valor_productos["id"];
                            $id_enlazado_productos_encontrados[] = 0;
                            $id_multiple_productos_encontrados[] = $valor_multiple;
                            $id_pack_productos_encontrados[] = 0;
                            $activo_productos_encontrados[] = $matriz_productos_detalles_multiples_activo[$key_multiple];
                        }
                        unset($matriz_productos_detalles_multiples_id);
                        unset($productos_detalles_multiples_id_atributo);
                        unset($matriz_productos_detalles_multiples_id_dato);
                        unset($matriz_productos_detalles_multiples_activo);
                    }
                    $select_sys = "listado-packs";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/packs/gestion/datos-select-php.php");
                    if (isset($matriz_id_productos_packs)) {
                        foreach ($matriz_id_productos_packs as $key_packs => $valor_packs) {
                            $id_packs = $valor_packs;
                            $select_sys = "descripcion-pack";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/packs/gestion/datos-select-php.php");
                            if (!empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_packs])) {
                                $id_productos_detalles_enlazado = $matriz_id_productos_detalles_enlazado_productos_packs[$key_packs];
                                $select_sys = "descripcion_enlazado";
                                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                                $descripcion_pack = stripslashes($result_productos[0]['descripcion']) . " " . $descripcion_pack . " (" . $descripcion_productos_detalles_enlazado . ")";
                            } else if (!empty($matriz_id_productos_detalles_multiple_productos_packs[$key_packs])) {
                                $id_productos_detalles_multiples = $matriz_id_productos_detalles_multiple_productos_packs[$key_packs];
                                $select_sys = "descripcion_multiple";
                                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                                $descripcion_pack = stripslashes($result_productos[0]['descripcion']) . " " . $descripcion_pack . " (" . $descripcion_productos_detalles_multiples . ")";
                            } else {
                                $descripcion_pack = stripslashes($result_productos[0]['descripcion']) . " " . $descripcion_pack;
                            }
                            $descripciones_productos_encontrados[] = $descripcion_pack;
                            $id_producto_productos_encontrados[] = $valor_productos["id"];
                            $id_enlazado_productos_encontrados[] = $matriz_id_productos_detalles_enlazado_productos_packs[$key_packs];
                            $id_multiple_productos_encontrados[] = $matriz_id_productos_detalles_multiple_productos_packs[$key_packs];
                            $id_pack_productos_encontrados[] = $valor_packs;
                            $activo_productos_encontrados[] = $matriz_activo_productos_packs[$key_packs];
                        }
                        unset($matriz_id_productos_packs);
                        unset($matriz_id_productos_detalles_enlazado_productos_packs);
                        unset($matriz_id_productos_detalles_multiple_productos_packs);
                        unset($matriz_cantidad_pack_productos_packs);
                        unset($matriz_activo_productos_packs);
                        unset($matriz_orden_productos_packs);
                        unset($matriz_fecha_alta_productos_packs);
                        unset($matriz_fecha_modificacion_productos_packs);
                    }
                }
            } else if ($buscar_por == "codigo_barras") {
                $result_sku = $conn->query("SELECT id_producto,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs FROM productos_sku 
                    WHERE codigo_barras='" . addslashes($texto_buscar) . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $result_productos = $conn->query("SELECT id,descripcion,activo FROM productos 
                        WHERE id=" . $result_sku[0]['id_producto'] . " LIMIT 1");
                    $descripciones_productos_encontrados[] = stripslashes($result_productos[0]['descripcion']);
                    $id_producto_productos_encontrados[] = $result_sku[0]['id_producto'];
                    $id_enlazado_productos_encontrados[] = $result_sku[0]['id_productos_detalles_enlazado'];
                    $id_multiple_productos_encontrados[] = $result_sku[0]['id_productos_detalles_multiples'];
                    $id_pack_productos_encontrados[] = $result_sku[0]['id_packs'];

                    $id_url = $result_sku[0]['id_producto'];
                    $select_sys = "listado_relaciones_producto";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                    if (isset($matriz_productos_detalles_relacion_id)) {
                        foreach ($matriz_productos_detalles_relacion_id as $key_enlazado => $valor_enlazado) {
                            $id_productos_detalles_enlazado = $valor_enlazado;
                            $select_sys = "descripcion_enlazado";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                            $descripciones_productos_encontrados[] = stripslashes($result_productos[0]['descripcion']) . " (" . $descripcion_productos_detalles_enlazado . ")";
                            $id_producto_productos_encontrados[] = $valor_productos["id"];
                            $id_enlazado_productos_encontrados[] = $valor_enlazado;
                            $id_multiple_productos_encontrados[] = 0;
                            $id_pack_productos_encontrados[] = 0;
                            $activo_productos_encontrados[] = $matriz_productos_detalles_relacion_activo[$key_enlazado];
                        }
                        unset($matriz_productos_detalles_relacion_id);
                        unset($matriz_productos_detalles_relacion_id_atributo_principal);
                        unset($matriz_productos_detalles_relacion_id_dato_principal);
                        unset($matriz_productos_detalles_relacion_id_atributo_enlazado);
                        unset($matriz_productos_detalles_relacion_id_dato_enlazado);
                        unset($matriz_productos_detalles_relacion_activo);
                    }
                    $select_sys = "listado_atributos_multiples";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                    if (isset($matriz_productos_detalles_multiples_id)) {
                        foreach ($matriz_productos_detalles_multiples_id as $key_multiple => $valor_multiple) {
                            $id_productos_detalles_multiples = $valor_multiple;
                            $select_sys = "descripcion_multiple";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                            $descripciones_productos_encontrados[] = stripslashes($result_productos[0]['descripcion']) . " (" . $descripcion_productos_detalles_multiples . ")";
                            $id_producto_productos_encontrados[] = $valor_productos["id"];
                            $id_enlazado_productos_encontrados[] = 0;
                            $id_multiple_productos_encontrados[] = $valor_multiple;
                            $id_pack_productos_encontrados[] = 0;
                            $activo_productos_encontrados[] = $matriz_productos_detalles_multiples_activo[$key_multiple];
                        }
                        unset($matriz_productos_detalles_multiples_id);
                        unset($productos_detalles_multiples_id_atributo);
                        unset($matriz_productos_detalles_multiples_id_dato);
                        unset($matriz_productos_detalles_multiples_activo);
                    }
                    $select_sys = "listado-packs";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/packs/gestion/datos-select-php.php");
                    if (isset($matriz_id_productos_packs)) {
                        foreach ($matriz_id_productos_packs as $key_packs => $valor_packs) {
                            $id_packs = $valor_packs;
                            $select_sys = "descripcion-pack";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/packs/gestion/datos-select-php.php");
                            if (!empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_packs])) {
                                $id_productos_detalles_enlazado = $matriz_id_productos_detalles_enlazado_productos_packs[$key_packs];
                                $select_sys = "descripcion_enlazado";
                                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                                $descripcion_pack = stripslashes($result_productos[0]['descripcion']) . " " . $descripcion_pack . " (" . $descripcion_productos_detalles_enlazado . ")";
                            } else if (!empty($matriz_id_productos_detalles_multiple_productos_packs[$key_packs])) {
                                $id_productos_detalles_multiples = $matriz_id_productos_detalles_multiple_productos_packs[$key_packs];
                                $select_sys = "descripcion_multiple";
                                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                                $descripcion_pack = stripslashes($result_productos[0]['descripcion']) . " " . $descripcion_pack . " (" . $descripcion_productos_detalles_multiples . ")";
                            } else {
                                $descripcion_pack = stripslashes($result_productos[0]['descripcion']) . " " . $descripcion_pack;
                            }
                            $descripciones_productos_encontrados[] = $descripcion_pack;
                            $id_producto_productos_encontrados[] = $valor_productos["id"];
                            $id_enlazado_productos_encontrados[] = $matriz_id_productos_detalles_enlazado_productos_packs[$key_packs];
                            $id_multiple_productos_encontrados[] = $matriz_id_productos_detalles_multiple_productos_packs[$key_packs];
                            $id_pack_productos_encontrados[] = $valor_packs;
                            $activo_productos_encontrados[] = $matriz_activo_productos_packs[$key_packs];
                        }
                        unset($matriz_id_productos_packs);
                        unset($matriz_id_productos_detalles_enlazado_productos_packs);
                        unset($matriz_id_productos_detalles_multiple_productos_packs);
                        unset($matriz_cantidad_pack_productos_packs);
                        unset($matriz_activo_productos_packs);
                        unset($matriz_orden_productos_packs);
                        unset($matriz_fecha_alta_productos_packs);
                        unset($matriz_fecha_modificacion_productos_packs);
                    }
                }
            }
            $id_url = $id_url_entrada;
            break;
        case "unidades":
            $result_unidades = $conn->query("SELECT * FROM unidades ORDER BY unidad");
            foreach ($result_unidades as $key_unidades => $valor_unidades) {
                $id_unidades[$valor_unidades['id']] = $valor_unidades['id'];
                $unidad_unidades[$valor_unidades['id']] = $valor_unidades['unidad'];
                $abreviatura_unidades[$valor_unidades['id']] = $valor_unidades['abreviatura'];
            }
            $result_productos_unidades = $conn->query("SELECT * FROM productos_unidades WHERE id_producto='" . $id_url . "'");
            if ($conn->registros() >= 1) {
                foreach ($result_productos_unidades as $key_productos_unidades => $valor_productos_unidades) {
                    $id_productos_unidades[] = $valor_productos_unidades['id'];
                    $id_unidad_productos_unidades[] = $valor_productos_unidades['id_unidad'];
                    $id_producto_productos_unidades[] = $valor_productos_unidades['id_producto'];
                    $principal_productos_unidades[] = $valor_productos_unidades['principal'];
                    $conversion_principal_productos_unidades[] = $valor_productos_unidades['conversion_principal'];
                    $activo_productos_unidades[] = $valor_productos_unidades['activo'];
                    $fecha_alta_productos_unidades[] = $valor_productos_unidades['fecha_alta'];
                    $fecha_modificacion_productos_unidades[] = $valor_productos_unidades['fecha_modificacion'];
                }
            }
            break;
        case "calculo-costes-personal":
            $coste_personal = calcular_coste_personal($conn, $id_url, $tipo_producto_productos, false, false, false);
            break;
        case "calculo-costes":
            $coste_elaborado = calcular_coste_kgr($conn, $id_url, $tipo_producto_productos, true);
            break;
        case "calculo-costes-kgr":
            $result_productos_costes = $conn->query("SELECT cantidad_base FROM productos_costes WHERE id_producto='" . $id_url . "' LIMIT 1");
            $peso = 1;
            if ($conn->registros() == 1) {
                if ($result_productos_costes[0]['cantidad_base'] > 0) {
                    $peso = $result_productos_costes[0]['cantidad_base'];
                }
            }
            $peso = (float) $peso;
            $calcularCosteKgr = calcular_coste_kgr($conn, $id_url, $tipo_producto_productos, false);
            $calcularCosteKgr = (float) $calcularCosteKgr['coste_elaborado'];
            $coste_elaborado = $calcularCosteKgr / $peso;
            break;

        case "listado-titulos":
            $result_titulos = $conn->query("SELECT * FROM productos_titulos WHERE id_producto=" . $id_url . " ORDER BY orden ASC");
            $titulos_id = [];
            $titulos_descripcion = [];
            $titulos_modelo = [];
            $titulos_orden = [];
            if ($conn->registros() >= 1) {
                foreach ($result_titulos as $titulo) {
                    $titulos_id[] = $titulo['id'];
                    $titulos_descripcion[] = stripslashes($titulo['descripcion']);
                    $titulos_modelo[] = $titulo['modelo'];
                    $titulos_orden[] = $titulo['orden'];
                }
            }

            break;

        case "buscar-productos-personalizacion":
            $result_productos = $conn->query("SELECT id,descripcion FROM productos 
                    WHERE descripcion = '" . $texto_buscar . "' ORDER BY descripcion LIMIT 1");
            foreach ($result_productos as $key_productos => $valor_productos) {
                $descripciones_productos_personalizados[] = stripslashes($valor_productos['descripcion']);
                $ids_productos_personalizados[] = $valor_productos["id"];
            }
            $result_productos = $conn->query("SELECT id,descripcion FROM productos 
                    WHERE descripcion LIKE '%" . $texto_buscar . "%' AND descripcion <> '" . $texto_buscar . "' AND id<>" . $id_productos . " ORDER BY descripcion LIMIT 10");
            foreach ($result_productos as $key_productos => $valor_productos) {
                $descripciones_productos_personalizados[] = stripslashes($valor_productos['descripcion']);
                $ids_productos_personalizados[] = $valor_productos["id"];
            }

            if (isset($ajax_sys)) {
                echo json_encode([
                    'ids' => $ids_productos_personalizados,
                    'descripciones' => $descripciones_productos_personalizados
                ]);
            }

            break;

        case "buscar-lotes":
            $result_productos = $conn->query("SELECT lote FROM documentos_" . date('Y') . "_productos_sku_stock 
                    WHERE lote = '" . $texto_buscar . "' ORDER BY lote LIMIT 1");
            foreach ($result_productos as $key_productos => $valor_productos) {
                $lotes[] = stripslashes($valor_productos['lote']);
            }
            $result_productos = $conn->query("SELECT lote FROM documentos_" . date('Y') . "_productos_sku_stock 
                    WHERE lote LIKE '%" . $texto_buscar . "%' AND lote <> '" . $texto_buscar . "' ORDER BY lote LIMIT 10");
            foreach ($result_productos as $key_productos => $valor_productos) {
                $lotes[] = stripslashes($valor_productos['lote']);
            }

            if (isset($ajax_sys)) {
                echo json_encode([
                    'lotes' => $lotes
                ]);
            }

            break;

        case "buscar-numeros-serie":
            $result_productos = $conn->query("SELECT numero_serie FROM documentos_" . date('Y') . "_productos_sku_stock 
                    WHERE numero_serie = '" . $texto_buscar . "' ORDER BY numero_serie LIMIT 1");
            foreach ($result_productos as $key_productos => $valor_productos) {
                $numeros_serie[] = stripslashes($valor_productos['numero_serie']);
            }
            $result_productos = $conn->query("SELECT numero_serie FROM documentos_" . date('Y') . "_productos_sku_stock 
                    WHERE numero_serie LIKE '%" . $texto_buscar . "%' AND numero_serie <> '" . $texto_buscar . "' ORDER BY numero_serie LIMIT 10");
            foreach ($result_productos as $key_productos => $valor_productos) {
                $numeros_serie[] = stripslashes($valor_productos['numero_serie']);
            }

            if (isset($ajax_sys)) {
                echo json_encode([
                    'numeros_serie' => $numeros_serie
                ]);
            }

            break;

        case "listado-titulos-relacionados":
            $result_titulos = $conn->query("SELECT * FROM productos_titulos_relacionados WHERE id_productos_titulos=" . $titulo_id . " ORDER BY orden ASC");
            $titulos_relacionados_id = [];
            $titulos_relacionados_id_producto = [];
            $titulos_relacionados_descripcion = [];
            $titulos_relacionados_orden = [];
            if ($conn->registros() >= 1) {
                foreach ($result_titulos as $titulo) {
                    $defecto = 2;
                    $result_productos_relacionados = $conn->query("SELECT * FROM productos_relacionados WHERE id_producto='" . $id_url . "' AND id_relacionado = '" . $titulo['id_producto'] . "'");
                    if ($conn->registros() >= 1) {
                        $result_iva = $conn->query("SELECT pi.iva AS iva FROM productos p JOIN productos_iva pi ON p.id_iva = pi.id WHERE p.id = " . $titulo['id_producto']);
                        $iva_aplicar = 0;
                        if ($conn->registros() >= 1) {
                            $iva_aplicar = $result_iva[0]['iva'];
                        }

                        $defecto = (empty($result_productos_relacionados[0]['por_defecto']))? false : 2;
                        $result_incrementos_tarifas = $conn->query("SELECT * FROM productos_relacionados_incre WHERE id_producto_rel=" . $result_productos_relacionados[0]['id']);
                        foreach ($result_incrementos_tarifas as $key_incrementos_tarifas => $valor_incrementos_tarifas) {
                            $matriz_incrementos_productos_relacionados[$valor_incrementos_tarifas['id_tarifa']][$titulo['id_producto']] = $valor_incrementos_tarifas['sumar_con'];

                            if (isset($pvp_iva_incluido) && $pvp_iva_incluido == 0) {
                                $matriz_incrementos_productos_relacionados[$valor_incrementos_tarifas['id_tarifa']][$titulo['id_producto']] /= (1 + ($iva_aplicar / 100));
                            }
                        }
                    }

                    $titulos_relacionados_id[] = $titulo['id'];
                    $titulos_relacionados_id_producto[] = $titulo['id_producto'];
                    $titulos_relacionados_defecto[] = $defecto;
                    $titulos_relacionados_descripcion[] = stripslashes($titulo['descripcion']);
                    $titulos_relacionados_orden[] = $titulo['orden'];
                }
            }

            break;
    }
}