<?php
switch ($select_sys) {
    case "productos-categorias":
        $producto_venta = "";
        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $producto_venta = " AND productos.producto_venta=1";
        }

        // Si es proveedor o creditor, no tienen tarifa.
        // Si es proveedor o creditor, se debe coger el precio de coste.
        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $condicion_productos = " productos.activo=1 AND productos.producto_venta=1 AND productos_pvp.id_tarifa=" . $id_tarifa_web;
            $sql = "SELECT SQL_CALC_FOUND_ROWS productos.tipo_producto, COUNT(productos.id) AS numero_packs, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos_categorias,productos,productos_pvp 
                                            WHERE productos_categorias.id_categoria=".$id_categoria_mostrar.$producto_venta." AND 
                                            productos.id=productos_categorias.id_producto AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto=productos_categorias.id_producto AND 
                                            productos_pvp.id_productos_detalles_enlazado=0 AND 
                                            productos_pvp.id_productos_detalles_multiples=0 AND 
                                            productos_pvp.id_packs=0 
                                            GROUP BY productos.id 
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final;
            $result_categorias = $conn->query($sql);
        }else {
            $condicion_productos = " productos.activo=1";
            $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS productos.tipo_producto, COUNT(productos.id) AS numero_packs, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos.coste 
                                            FROM productos_categorias,productos 
                                            WHERE productos_categorias.id_categoria=".$id_categoria_mostrar.$producto_venta." AND 
                                            productos.id=productos_categorias.id_producto AND 
                                            " . $condicion_productos . " 
                                            GROUP BY productos.id 
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final);
        }

        $productosEnLaCategoria = $conn->query("SELECT FOUND_ROWS();");
        $productosEnLaCategoria = $productosEnLaCategoria[0]["FOUND_ROWS()"];

        $productos_total = 0;

        if ($conn->registros() >= 1) {
            foreach ($result_categorias as $key_categorias => $valor_categorias) {
                $productos_total++;
                $result_productos_otros = $conn->query("SELECT url_externa,disponibilidad,profesionales,envio_gratis 
                           FROM productos_otros WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 AND 
                           disponibilidad<>0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $id_producto_mostrar[$productos_mostrados] = $valor_categorias['id_producto'];
                    $numero_packs[$productos_mostrados] = $valor_categorias['numero_packs'];
                    $tipo_producto_categorias[$productos_mostrados] = $valor_categorias['tipo_producto'];
                    $descripcion[$productos_mostrados] = stripslashes($valor_categorias['descripcion']);
                    $descripcion_categoria_producto[$productos_mostrados] = $path_components[$indice_componente];
                    $imagen[$productos_mostrados] = $valor_categorias['imagen'];
                    $updated[$productos_mostrados] = $valor_categorias['updated'];
                    $alt[$productos_mostrados] = stripslashes($valor_categorias['alt']);
                    $tittle[$productos_mostrados] = stripslashes($valor_categorias['tittle']);

                    $url_externa[$productos_mostrados] = stripslashes($result_productos_otros[0]['url_externa']);
                    $disponibilidad[$productos_mostrados] = $result_productos_otros[0]['disponibilidad'];
                    $profesionales[$productos_mostrados] = $result_productos_otros[0]['profesionales'];
                    $envio_gratis[$productos_mostrados] = $result_productos_otros[0]['envio_gratis'];

                    $result_iva = $conn->query("SELECT iva,recargo FROM productos_iva WHERE id='" . $valor_categorias['id_iva'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $iva[$productos_mostrados] = $result_iva[0]['iva'];
                        $recargo_sys[$productos_mostrados] = $result_iva[0]['recargo'];
                    }
                }

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           activo=1");
                if ($conn->registros() >= 1) {
                    foreach ($result_productos_packs as $key_productos_packs => $valor_productos_packs) {
                        $result_productos_otros = $conn->query("SELECT id FROM productos_otros WHERE 
                            id_producto=" . $valor_categorias['id_producto'] . " AND id_packs=" . $valor_productos_packs['id'] . " AND tienda=1 AND disponibilidad<>0 LIMIT 1");
                        if ($conn->registros() == 1) {
                            $packs_disponibles[$productos_mostrados] = true;
                            break;
                        }
                    }
                } else {
                    $packs_disponibles[$productos_mostrados] = false;
                }

                if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                    $pvp[$productos_mostrados] = $valor_categorias['pvp'];
                    $id_ofertas[$productos_mostrados] = $valor_categorias['id_ofertas'];
                    $oferta_desde[$productos_mostrados] = $valor_categorias['oferta_desde'];
                    $oferta_hasta[$productos_mostrados] = $valor_categorias['oferta_hasta'];
                    $pvp_oferta[$productos_mostrados] = $valor_categorias['pvp_oferta'];
                    if (!empty($valor_categorias['id_ofertas'])) {
                        $result_productos_web_datos = $conn->query("SELECT descripcion FROM ofertas WHERE 
                           id=" . $valor_categorias['id_ofertas'] . " LIMIT 1");
                        if ($conn->registros() == 1) {
                            $descripcion_ofertas[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion']);
                        }
                    }
                } else {
                    $coste[$productos_mostrados] = $valor_categorias['coste'];
                }

                if(isset($id_librador) && isset($valor_categorias['id_producto']) && isset($tipo_librador)) {
                    /* Obtener dato coste o importe por librador */
                    $result_coste_importe = $conn->query("SELECT coste_importe FROM libradores_productos 
                            WHERE id_librador='" . $id_librador . "' AND id_producto='" . $valor_categorias['id_producto'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        if (!empty($result_coste_importe[0]['coste_importe'])) {
                            if($tipo_librador == 'pro' || $tipo_librador == 'cre') {
                                $coste[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            }else {
                                $pvp[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            }
                        }
                    }
                    /* Final obtener dato coste o importe por librador */
                }

                $result_productos_web_datos = $conn->query("SELECT descripcion_larga,descripcion_url FROM productos_web_datos WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_larga[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_larga']);
                    $descripcion_url_mostrar[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_url']);
                }

                $querySql = "SELECT 
                            A.`lote` as lote,
                            A.`caducidad` as caducidad,
                            A.`coste` as coste,
                            CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock`
                        FROM 
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND lote <> '' AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad_ventas FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND lote <> '' AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote
                        WHERE (`cantidad`-`cantidad_ventas` > 0 OR `cantidad_ventas` IS NULL);";
                $result_productos_sku_stock = $conn->query($querySql);
                $disponibilidad = array_filter($result_productos_sku_stock, function($item) {
                    return $item['stock'] > 0;
                });
                $disponibilidadStock = array_shift($disponibilidad);
                $producto_stock[$productos_mostrados] = isset($disponibilidadStock['stock']) ? $disponibilidadStock['stock']  : 0 ;
                $producto_id[$productos_mostrados] = $valor_categorias['id_producto'];
                $numero_de_lotes_activos[$productos_mostrados] = $conn->registros();

                $result_productos_enlazados = $conn->query("SELECT id FROM productos_detalles_enlazado WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_enlazados[$productos_mostrados] = $conn->registros();

                $result_productos_multiples = $conn->query("SELECT id FROM productos_detalles_multiples WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_multiples[$productos_mostrados] = $conn->registros();

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_packs[$productos_mostrados] = $conn->registros();

                $productos_mostrados += 1;
            }
        }
        break;
    case "productos-buscar":
        if(empty($dato_buscar)) {
            break;
        }

        $producto_venta = "";
        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $producto_venta = " AND productos.producto_venta=1";
        }

        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $condicion_productos = " productos.activo=1 AND productos.producto_venta=1 AND productos_pvp.id_tarifa=" . $id_tarifa_web;
            $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos_web_datos,productos,productos_pvp 
                                            WHERE productos_web_datos.descripcion_url LIKE '%" . addslashes($dato_buscar) . "%' AND 
                                            productos.id=productos_web_datos.id_producto AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto=productos_web_datos.id_producto AND 
                                            productos_pvp.id_productos_detalles_enlazado=0 AND 
                                            productos_pvp.id_productos_detalles_multiples=0 AND 
                                            productos_pvp.id_packs=0  
                                            GROUP BY productos.id 
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final);

            $contenidoBusqueda = explode('-', $dato_buscar);
            if (count($contenidoBusqueda) == 2 && strlen($contenidoBusqueda[1]) == '11') {
                $backup_dato_buscar = $dato_buscar;
                $dato_buscar = $contenidoBusqueda[1];
                $cantidad_buscar = $contenidoBusqueda[0];
            }

            if ($conn->registros() == 0) { // Buscamos por código de barras en productos_sku
                $result_categorias = $conn->query("SELECT id_producto,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs 
                                            FROM productos_sku 
                                            WHERE codigo_barras='" . addslashes($dato_buscar) . "' OR referencia='" . addslashes($dato_buscar) . "'");
                if ($conn->registros() >= 1) {
                    $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos,productos_pvp 
                                            WHERE productos.id='" . $result_categorias[0]['id_producto'] . "' AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto='" . $result_categorias[0]['id_producto'] . "' AND 
                                            productos_pvp.id_productos_detalles_enlazado=0 AND 
                                            productos_pvp.id_productos_detalles_multiples=0 AND 
                                            productos_pvp.id_packs=0   
                                            GROUP BY productos.id 
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final);
                }
            }
            if ($conn->registros() == 0) { // Buscamos por código de barras en documentos_XXXX_productos_sku_stock
                $result_categorias = $conn->query("SELECT id_producto,lote FROM documentos_" . $ejercicio . "_productos_sku_stock 
                                            WHERE codigo_barras='" . addslashes($dato_buscar) . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $lote_encontrado_por_codigo_barras = stripslashes($result_categorias[0]['lote']);
                    $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos,productos_pvp   
                                            GROUP BY productos.id 
                                            WHERE productos.id='" . $result_categorias[0]['id_producto'] . "' AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto='" . $result_categorias[0]['id_producto'] . "' 
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final);
                }
            }
            if ($conn->registros() == 0) { // Buscamos por observaciones en documentos_XXXX_observaciones
                $subQuery = "SELECT id FROM productos_observaciones WHERE observacion like '%" . addslashes($dato_buscar) . "%'";
                $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen, productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp, productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta FROM productos,productos_pvp WHERE productos.id in($subQuery) AND {$condicion_productos} AND productos_pvp.id_producto in ($subQuery) GROUP BY productos.id ORDER BY {$orden} LIMIT {$cadena_limite_inicial},{$cadena_limite_final} ");
            }
        }else {
            $condicion_productos = " productos.activo=1";

            $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos_web_datos,productos,productos_pvp 
                                            WHERE productos_web_datos.descripcion_url LIKE '%" . addslashes($dato_buscar) . "%' AND 
                                            productos.id=productos_web_datos.id_producto AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto=productos_web_datos.id_producto  
                                            GROUP BY productos.id  
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final);

            $contenidoBusqueda = explode('-', $dato_buscar);
            if (count($contenidoBusqueda) == 2 && strlen($contenidoBusqueda[1]) == '11') {
                $backup_dato_buscar = $dato_buscar;
                $dato_buscar = $contenidoBusqueda[1];
                $cantidad_buscar = $contenidoBusqueda[0];
            }

            if ($conn->registros() == 0) { // Buscamos por código de barras en productos_sku
                $result_categorias = $conn->query("SELECT id_producto,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs 
                                            FROM productos_sku 
                                            WHERE codigo_barras='" . addslashes($dato_buscar) . "' OR referencia='" . addslashes($dato_buscar) . "'");
                if ($conn->registros() >= 1) {
                    $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, id AS id_producto,descripcion,imagen,updated,alt,tittle,id_iva, coste 
                                            FROM productos 
                                            WHERE productos.id='" . $result_categorias[0]['id_producto'] . "' AND 
                                            " . $condicion_productos . " 
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final);
                }
            }
            if ($conn->registros() == 0) { // Buscamos por código de barras en documentos_XXXX_productos_sku_stock
                $result_categorias = $conn->query("SELECT id_producto,lote FROM documentos_" . $ejercicio . "_productos_sku_stock 
                                            WHERE codigo_barras='" . addslashes($dato_buscar) . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $lote_encontrado_por_codigo_barras = stripslashes($result_categorias[0]['lote']);
                    $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, id AS id_producto,descripcion,imagen,updated,alt,tittle,id_iva, coste 
                                            FROM productos 
                                            WHERE productos.id='" . $result_categorias[0]['id_producto'] . "' AND 
                                            " . $condicion_productos . " 
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final);
                }
            }
        }

        if (isset($backup_dato_buscar)) {
            $dato_buscar = $backup_dato_buscar;
        }

        $productosEnLaCategoria = $conn->query("SELECT FOUND_ROWS();");
        $productosEnLaCategoria = $productosEnLaCategoria[0]["FOUND_ROWS()"];

        $productos_total = 0;

        if ($conn->registros() >= 1) {
            foreach ($result_categorias as $key_categorias => $valor_categorias) {
                $productos_total++;
                $result_primera_categoria = $conn->query("SELECT categorias.descripcion_url 
                           FROM categorias,productos_categorias WHERE 
                           productos_categorias.id_producto=" . $valor_categorias['id_producto'] . " AND 
                           productos_categorias.id_categoria=categorias.id LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_categoria_producto[$productos_mostrados] = $result_primera_categoria[0]['descripcion_url'];
                } else {
                    $descripcion_categoria_producto[$productos_mostrados] = $path_components[$indice_componente];
                }
                $result_productos_otros = $conn->query("SELECT url_externa,disponibilidad,profesionales,envio_gratis 
                           FROM productos_otros WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 AND 
                           disponibilidad<>0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $id_producto_mostrar[$productos_mostrados] = $valor_categorias['id_producto'];
                    $numero_packs[$productos_mostrados] = $valor_categorias['numero_packs'];
                    $tipo_producto_categorias[$productos_mostrados] = $valor_categorias['tipo_producto'];
                    $descripcion[$productos_mostrados] = stripslashes($valor_categorias['descripcion']);
                    $imagen[$productos_mostrados] = $valor_categorias['imagen'];
                    $updated[$productos_mostrados] = $valor_categorias['updated'];
                    $alt[$productos_mostrados] = stripslashes($valor_categorias['alt']);
                    $tittle[$productos_mostrados] = stripslashes($valor_categorias['tittle']);

                    $url_externa[$productos_mostrados] = stripslashes($result_productos_otros[0]['url_externa']);
                    $disponibilidad[$productos_mostrados] = $result_productos_otros[0]['disponibilidad'];
                    $profesionales[$productos_mostrados] = $result_productos_otros[0]['profesionales'];
                    $envio_gratis[$productos_mostrados] = $result_productos_otros[0]['envio_gratis'];

                    $result_iva = $conn->query("SELECT iva,recargo FROM productos_iva WHERE id='" . $valor_categorias['id_iva'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $iva[$productos_mostrados] = $result_iva[0]['iva'];
                        $recargo_sys[$productos_mostrados] = $result_iva[0]['recargo'];
                    }
                }

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           activo=1");
                if ($conn->registros() >= 1) {
                    foreach ($result_productos_packs as $key_productos_packs => $valor_productos_packs) {
                        $result_productos_otros = $conn->query("SELECT id FROM productos_otros WHERE 
                            id_producto=" . $valor_categorias['id_producto'] . " AND id_packs=" . $valor_productos_packs['id'] . " AND tienda=1 AND disponibilidad<>0 LIMIT 1");
                        if ($conn->registros() == 1) {
                            $packs_disponibles[$productos_mostrados] = true;
                            break;
                        }
                    }
                } else {
                    $packs_disponibles[$productos_mostrados] = false;
                }

                if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                    $pvp[$productos_mostrados] = $valor_categorias['pvp'];
                    $id_ofertas[$productos_mostrados] = $valor_categorias['id_ofertas'];
                    $oferta_desde[$productos_mostrados] = $valor_categorias['oferta_desde'];
                    $oferta_hasta[$productos_mostrados] = $valor_categorias['oferta_hasta'];
                    $pvp_oferta[$productos_mostrados] = $valor_categorias['pvp_oferta'];
                    if (!empty($valor_categorias['id_ofertas'])) {
                        $result_productos_web_datos = $conn->query("SELECT descripcion FROM ofertas WHERE 
                           id=" . $valor_categorias['id_ofertas'] . " LIMIT 1");
                        if ($conn->registros() == 1) {
                            $descripcion_ofertas[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion']);
                        }
                    }
                } else {
                    $coste[$productos_mostrados] = $valor_categorias['coste'];
                }

                if(isset($id_librador) && isset($valor_categorias['id_producto']) && isset($tipo_librador)) {
                    /* Obtener dato coste o importe por librador */
                    $result_coste_importe = $conn->query("SELECT coste_importe FROM libradores_productos 
                            WHERE id_librador='" . $id_librador . "' AND id_producto='" . $valor_categorias['id_producto'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        if (!empty($result_coste_importe[0]['coste_importe'])) {
                            if($tipo_librador == 'pro' || $tipo_librador == 'cre') {
                                $coste[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            }else {
                                $pvp[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            }
                        }
                    }
                    /* Final obtener dato coste o importe por librador */
                }

                $result_productos_web_datos = $conn->query("SELECT descripcion_larga,descripcion_url FROM productos_web_datos WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_larga[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_larga']);
                    $descripcion_url_mostrar[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_url']);
                }

                $querySql = "SELECT 
                            A.`lote` as lote,
                            A.`caducidad` as caducidad,
                            A.`coste` as coste,
                            CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock`
                        FROM 
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND lote <> '' AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad_ventas FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND lote <> '' AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote
                        WHERE (`cantidad`-`cantidad_ventas` > 0 OR `cantidad_ventas` IS NULL);";
                $result_productos_sku_stock = $conn->query($querySql);
                $producto_stock[$productos_mostrados] = isset($result_productos_sku_stock[0]['stock']) ? $result_productos_sku_stock[0]['stock'] : 0 ;
                $numero_de_lotes_activos[$productos_mostrados] = $conn->registros();

                $result_productos_enlazados = $conn->query("SELECT id FROM productos_detalles_enlazado WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_enlazados[$productos_mostrados] = $conn->registros();

                $result_productos_multiples = $conn->query("SELECT id FROM productos_detalles_multiples WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_multiples[$productos_mostrados] = $conn->registros();

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_packs[$productos_mostrados] = $conn->registros();

                $productos_mostrados += 1;
            }
        }
        break;
    case "buscar-producto":
        $id_producto = 0;
        $result_productos_web_datos = $conn->query("SELECT id_producto,titulo_meta,descripcion_meta 
                                FROM productos_web_datos WHERE 
                                descripcion_url='" . addslashes($path_components[$indice_componente + 1]) . "' AND 
                                id_productos_detalles_enlazado=0 AND 
                                id_productos_detalles_multiples=0 AND 
                                id_packs=0 LIMIT 1");
        if($conn->registros() == 1) {
            $id_producto = $result_productos_web_datos[0]['id_producto'];
            $descripcion_title = stripslashes($result_productos_web_datos[0]['titulo_meta']);
            $descripcion_meta = stripslashes($result_productos_web_datos[0]['descripcion_meta']);
        }
        break;
    case "producto_recuperado":
        $result_documentos_2 = $conn->query("SELECT descuento_base, descuento_total, lote, caducidad, numero_serie, slug, iva, cantidad, coste, pvp_unidad_sin_incrementos, orden, descripcion_producto 
                                FROM documentos_" . $ejercicio . "_2 WHERE 
                                id='" . $id_linea . "' LIMIT 1");
        if($conn->registros() == 1) {
            $cantidad_producto = number_format($result_documentos_2[0]['cantidad'], $decimales_cantidades, ".", "");
            $coste_producto_principal_sys = $result_documentos_2[0]['coste'];
            $pvp_producto_sys[0] = $result_documentos_2[0]['pvp_unidad_sin_incrementos'];
            $orden_producto = stripslashes($result_documentos_2[0]['orden']);
            $descripcion_recuperado = stripslashes($result_documentos_2[0]['descripcion_producto']);
            $lote_recuperado = stripslashes($result_documentos_2[0]['lote']);
            $caducidad_recuperado = $result_documentos_2[0]['caducidad'];
            $numero_serie_recuperado = stripslashes($result_documentos_2[0]['numero_serie']);
            $slug_recuperado = stripslashes($result_documentos_2[0]['slug']);
            $descuento_recuperado = $result_documentos_2[0]['descuento_base'];
            if (empty($descuento_recuperado) || $descuento_recuperado <= 0) {
                $descuento_recuperado = $result_documentos_2[0]['descuento_total'];
            }
            if (!empty($descuento_recuperado) || $descuento_recuperado > 0) {
                $pvp_producto_sys[0] = $pvp_producto_sys[0] / (1 - ($descuento_recuperado / 100));

                $descuento_recuperado_euro = $pvp_producto_sys[0] * ($descuento_recuperado / 100);
            } else {
                $descuento_recuperado_euro = 0;
            }
        }
        $result_documentos_observaciones = $conn->query("SELECT observacion 
                                FROM documentos_" . $ejercicio . "_observaciones WHERE 
                                id_documentos_2='" . $id_linea . "' AND id_documentos_combo = '0' LIMIT 1");
        if($conn->registros() == 1) {
            $nota_linea_producto = stripslashes($result_documentos_observaciones[0]['observacion']);
        }
        break;
    case "producto":
        $packs_disponibles = false;
        $result_producto = $conn->query("SELECT descripcion,tipo_producto,id_iva,coste,imagen,updated,alt,tittle FROM productos 
                            WHERE id='" . $id_producto_sys . "' AND id_idioma='".$id_idioma."' AND activo=1 LIMIT 1");
        if ($conn->registros() == 1) {
            $result_productos_otros = $conn->query("SELECT 
                            id_productos_detalles_enlazado,
                            id_productos_detalles_multiples,
                            id_packs,
                            control_stock,
                            disponibilidad,
                            profesionales,
                            peso,
                            bultos,
                            gastos,
                            envio_gratis,
                            dias_entrega,
                            aplicar_descuento,
                            descuento_maximo 
                            FROM productos_otros 
                            WHERE id_producto=" . $id_producto_sys . " AND tienda=1 AND disponibilidad<>0 
                            ORDER BY id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs");
            if ($conn->registros() >= 1) {
                $contador_sub_productos = 0;
                foreach ($result_productos_otros as $key_productos_otros => $valor_productos_otros) {

                    $id_producto = $id_producto_sys;
                    $id_enlazado = $valor_productos_otros['id_productos_detalles_enlazado'];
                    $id_multiple = $valor_productos_otros['id_productos_detalles_multiples'];
                    $id_pack = $valor_productos_otros['id_packs'];

                    if (!empty($id_enlazado)) {
                        $select_sys = "descripcion_enlazado";
                        require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-atributos.php");
                        $descripcion_atributos_producto[$contador_sub_productos] = $descripcion_enlazado;
                    }
                    if (!empty($id_multiple)) {
                        $select_sys = "descripcion_multiple";
                        require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-atributos.php");
                        $descripcion_atributos_producto[$contador_sub_productos] = $descripcion_multiples;
                    }
                    if (!empty($id_pack)) {
                        $result_productos_packs = $conn->query("SELECT cantidad_pack FROM productos_packs WHERE 
                                   id=" . $id_pack . " AND activo=1 LIMIT 1");
                        if ($conn->registros() == 1) {
                            $packs_disponibles = true;
                            $cantidad_packs_producto[$contador_sub_productos] = $result_productos_packs[0]['cantidad_pack'];
                            $entero = floor($cantidad_packs_producto[$contador_sub_productos]);
                            $decimal = $cantidad_packs_producto[$contador_sub_productos] - $entero;
                            if($decimal == 0) {
                                $cantidad_packs_producto[$contador_sub_productos] = $entero;
                            }
                            if(isset($descripcion_atributo[$contador_sub_productos])) {
                                $descripcion_atributos_producto[$contador_sub_productos] .= " Pack de " . $cantidad_packs_producto[$contador_sub_productos] . " unid.";
                            }else {
                                $descripcion_atributos_producto[$contador_sub_productos] = "Pack de " . $cantidad_packs_producto[$contador_sub_productos] . " unid.";
                            }
                        }
                    }

                    $id_enlazados_producto[$contador_sub_productos] = $id_enlazado;
                    $id_multiples_producto[$contador_sub_productos] = $id_multiple;
                    $id_packs_producto[$contador_sub_productos] = $id_pack;
                    $control_stock_producto[$contador_sub_productos] = $valor_productos_otros['control_stock'];
                    $disponibilidad_producto[$contador_sub_productos] = $valor_productos_otros['disponibilidad'];
                    $profesionales_producto[$contador_sub_productos] = $valor_productos_otros['profesionales'];
                    $peso_producto[$contador_sub_productos] = $valor_productos_otros['peso'];
                    $bultos_producto[$contador_sub_productos] = $valor_productos_otros['bultos'];
                    $gastos_producto[$contador_sub_productos] = $valor_productos_otros['gastos'];
                    $envio_gratis_producto[$contador_sub_productos] = $valor_productos_otros['envio_gratis'];
                    $dias_entrega_producto[$contador_sub_productos] = $valor_productos_otros['dias_entrega'];
                    $aplicar_descuento_producto[$contador_sub_productos] = $valor_productos_otros['aplicar_descuento'];
                    $descuento_maximo_producto[$contador_sub_productos] = $valor_productos_otros['descuento_maximo'];

                    $result_productos_sku = $conn->query("SELECT id,codigo_barras,referencia 
                               FROM productos_sku WHERE 
                               id_producto=" . $id_producto . " AND 
                               id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                               id_productos_detalles_multiples=" . $id_multiple . " AND 
                               id_packs=" . $id_pack . " LIMIT 1");
                    if ($conn->registros() == 1) {
                        $id_productos_sku[$contador_sub_productos] = $result_productos_sku[0]['id'];
                        $codigo_barras_producto[$contador_sub_productos] = stripslashes($result_productos_sku[0]['codigo_barras']);
                        $referencia_producto[$contador_sub_productos] = stripslashes($result_productos_sku[0]['referencia']);
                    }else {
                        $id_productos_sku[$contador_sub_productos] = 0;
                        $codigo_barras_producto[$contador_sub_productos] = "";
                        $referencia_producto[$contador_sub_productos]= "";
                    }

                    $result_productos_pvp = $conn->query("SELECT pvp,id_ofertas,oferta_desde,oferta_hasta,pvp_oferta 
                               FROM productos_pvp WHERE 
                               id_producto=" . $id_producto . " AND 
                               id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                               id_productos_detalles_multiples=" . $id_multiple . " AND 
                               id_packs=" . $id_pack . " AND id_tarifa=".$id_tarifa_web." LIMIT 1");
                    if ($conn->registros() == 1) {
                        $pvp_producto[$contador_sub_productos] = $result_productos_pvp[0]['pvp'];
                        $id_ofertas_producto[$contador_sub_productos] = $result_productos_pvp[0]['id_ofertas'];
                        $oferta_desde_producto[$contador_sub_productos] = $result_productos_pvp[0]['oferta_desde'];
                        $oferta_hasta_producto[$contador_sub_productos] = $result_productos_pvp[0]['oferta_hasta'];
                        $pvp_oferta_producto[$contador_sub_productos] = $result_productos_pvp[0]['pvp_oferta'];
                        if (!empty($result_productos_pvp[0]['id_ofertas'])) {
                            $result_ofertas = $conn->query("SELECT descripcion FROM ofertas WHERE 
                                                id=" . $result_productos_pvp[0]['id_ofertas'] . " LIMIT 1");
                            if ($conn->registros() == 1) {
                                $descripcion_ofertas_producto[$contador_sub_productos] = stripslashes($result_ofertas[0]['descripcion']);
                            }else {
                                $descripcion_ofertas_producto[$contador_sub_productos] = "";
                            }
                        }
                    }else {
                        $pvp_producto[$contador_sub_productos] = 0;
                    }

                    $result_images = $conn->query("SELECT imagen,updated,alt,tittle FROM productos_images 
                                WHERE id_producto=" . $id_producto . " AND 
                                id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                                id_productos_detalles_multiples=" . $id_multiple . " AND 
                                id_packs=" . $id_pack . " AND 
                                activo=1 ORDER BY orden");
                    foreach ($result_images as $key_images => $valor_images) {
                        $images_producto[$contador_sub_productos] = stripslashes($valor_images['imagen']);
                        $images_updated_producto[$contador_sub_productos] = stripslashes($valor_images['updated']);
                        $images_alt_producto[$contador_sub_productos] = stripslashes($valor_images['alt']);
                        $images_tittle_producto[$contador_sub_productos] = stripslashes($valor_images['tittle']);
                    }

                    $result_productos_web_datos = $conn->query("SELECT id_observaciones FROM productos_web_datos 
                                WHERE id_producto=" . $id_producto . " AND 
                                id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                                id_productos_detalles_multiples=" . $id_multiple . " AND 
                                id_packs=" . $id_pack . " LIMIT 1");
                    if($conn->registros() == 1) {
                        $id_observaciones = $result_productos_web_datos[0]['id_observaciones'];
                        if(!empty($id_observaciones)) {
                            $result_observaciones = $conn->query("SELECT observacion FROM productos_observaciones 
                                WHERE id='" . $id_observaciones . "' LIMIT 1");
                            if ($conn->registros() == 1) {
                                $observaciones_producto[$contador_sub_productos] = nl2br(stripslashes($result_observaciones[0]['observacion']));
                            }
                        }
                    }

                    if(isset($id_librador) && isset($id_producto)) {
                        /* Obtener dato coste o importe por librador */
                        $result_coste_importe = $conn->query("SELECT coste_importe FROM libradores_productos 
                            WHERE id_librador='" . $id_librador . "' AND id_producto='" . $id_producto . "' LIMIT 1");
                        if ($conn->registros() == 1) {
                            if (!empty($result_coste_importe[0]['coste_importe'])) {
                                $pvp_producto[$contador_sub_productos] = $result_coste_importe[0]['coste_importe'];
                            }
                        }
                        /* Final obtener dato coste o importe por librador */
                    }

                    $contador_sub_productos += 1;
                }
                
                $h1 = stripslashes($result_producto[0]['descripcion']);
                $descripcion_producto = stripslashes($result_producto[0]['descripcion']);
                $tipo_producto = $result_producto[0]['tipo_producto'];
                $id_iva_producto = $result_producto[0]['id_iva'];
                $coste_producto_principal = $result_producto[0]['coste'];
                $imagen_producto = stripslashes($result_producto[0]['imagen']);
                $updated_producto = stripslashes($result_producto[0]['updated']);
                $alt_producto = stripslashes($result_producto[0]['alt']);
                $tittle_producto = stripslashes($result_producto[0]['tittle']);

                if(isset($id_librador) && isset($id_producto)) {
                    /* Obtener dato coste o importe por librador */
                    $result_coste_importe = $conn->query("SELECT coste_importe FROM libradores_productos 
                            WHERE id_librador='" . $id_librador . "' AND id_producto='" . $id_producto . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        if (!empty($result_coste_importe[0]['coste_importe'])) {
                            $coste_producto_principal = $result_coste_importe[0]['coste_importe'];
                        }
                    }
                    /* Final obtener dato coste o importe por librador */
                }

                $result_unidades = $conn->query("SELECT id,id_unidad,principal,conversion_principal FROM productos_unidades 
                            WHERE id_producto='" . $id_producto . "' AND activo=1");
                if ($conn->registros() >= 1) {
                    foreach ($result_unidades as $key_unidades => $valor_unidades) {
                        $result_unidad = $conn->query("SELECT unidad FROM unidades 
                            WHERE id='" . $valor_unidades['id_unidad'] . "' LIMIT 1");
                        if ($conn->registros() == 1) {
                            $id_unidades[] = $valor_unidades['id'];
                            $id_unidad_productos[] = $valor_unidades['id_unidad'];
                            $unidad_producto[] = stripslashes($result_unidad[0]['unidad']);
                            $unidad_principal_producto[] = $valor_unidades['principal'];
                            $conversion_unidad_producto[] = $valor_unidades['conversion_principal'];
                        }
                    }
                }

                $result_iva = $conn->query("SELECT iva,recargo FROM productos_iva 
                            WHERE id='" . $id_iva_producto . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $iva_producto = $result_iva[0]['iva'];
                    $recargo_producto = $result_iva[0]['recargo'];
                }

                $contador_atributos_unicos = 0;
                $result_detalles_unicos = $conn->query("SELECT id_atributo,id_dato FROM productos_detalles_unicos 
                            WHERE id_producto='" . $id_producto . "' AND activo=1");
                foreach ($result_detalles_unicos as $key_detalles_unicos => $valor_detalles_unicos) {
                    $de_sys = $valor_detalles_unicos['id_atributo'];
                    $select_sys = "detalle-de";
                    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
                    $descripcion_atributos_unicos_producto[$contador_atributos_unicos] = "<strong>".$detalle_de_productos_detalles.":</strong> ";
                    $de_sys = $valor_detalles_unicos['id_dato'];
                    $select_sys = "dato-de";
                    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
                    $descripcion_atributos_unicos_producto[$contador_atributos_unicos] .= $dato_de_productos_detalles;
                    $contador_atributos_unicos += 1;
                }
                /*
                $select_sys = "producto-datos";
                require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");
                */
                $lote_producto_stock = [];
                $caducidad_producto_stock = [];
                $coste_producto_stock = [];
                $stock_producto_stock = [];
                $querySql = "SELECT 
                            A.`lote` as lote,
                            A.`caducidad` as caducidad,
                            A.`coste` as coste,
                            CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock`
                        FROM 
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $id_producto_sys . " AND lote <> '' AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad_ventas FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $id_producto_sys . " AND lote <> '' AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote
                        WHERE (`cantidad`-`cantidad_ventas` > 0 OR `cantidad_ventas` IS NULL);";
                $result_productos_sku_stock = $conn->query($querySql);
                $disponibilidad = array_filter($result_productos_sku_stock, function($item) {
                    return $item['stock'] > 0;
                });
                $disponibilidadStock = array_shift($disponibilidad);
                $producto_stock[0] = isset($disponibilidadStock['stock']) ? $disponibilidadStock['stock']  : 0 ;
                foreach ($result_productos_sku_stock as $key_result_productos_sku_stock => $value_result_productos_sku_stock) {
                    $lote_producto_stock[] = stripslashes($value_result_productos_sku_stock['lote']);
                    $caducidad_producto_stock[] = stripslashes($value_result_productos_sku_stock['caducidad']);
                    $coste_producto_stock[] = $value_result_productos_sku_stock['coste'];
                    $stock_producto_stock[] = number_format($value_result_productos_sku_stock['stock'], $decimales_cantidades, ".", "");
                }
            }
        }
        break;
    case "producto-datos":
        $lote_producto_stock = [];
        $caducidad_producto_stock = [];
        $coste_producto_stock = [];
        $stock_producto_stock = [];
        $querySql = "SELECT 
                A.`lote` as lote,
                A.`caducidad` as caducidad,
                A.`coste` as coste,
                CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock`
            FROM 
                (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $id_producto_sys . " AND lote <> '' AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN
                (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad_ventas FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $id_producto_sys . " AND lote <> '' AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote
            WHERE (`cantidad`-`cantidad_ventas` > 0 OR `cantidad_ventas` IS NULL);";
        $result_productos_sku_stock = $conn->query($querySql);
        foreach ($result_productos_sku_stock as $key_result_productos_sku_stock => $value_result_productos_sku_stock) {
            $lote_producto_stock[] = stripslashes($value_result_productos_sku_stock['lote']);
            $caducidad_producto_stock[] = stripslashes($value_result_productos_sku_stock['caducidad']);
            $coste_producto_stock[] = $value_result_productos_sku_stock['coste'];
            $stock_producto_stock[] = $value_result_productos_sku_stock['stock'];
        }

        $contador_sub_productos = 0;
        foreach ($result_productos_otros as $key_productos_otros => $valor_productos_otros) {

            $id_producto = $id_producto_sys;
            $id_enlazado = $valor_productos_otros['id_productos_detalles_enlazado'];
            $id_multiple = $valor_productos_otros['id_productos_detalles_multiples'];
            $id_pack = $valor_productos_otros['id_packs'];

            if (!empty($id_enlazado)) {
                $select_sys = "descripcion_enlazado";
                require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-atributos.php");
                $descripcion_atributos_producto[$contador_sub_productos] = $descripcion_enlazado;
            }
            if (!empty($id_multiple)) {
                $select_sys = "descripcion_multiple";
                require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-atributos.php");
                $descripcion_atributos_producto[$contador_sub_productos] = $descripcion_multiples;
            }
            if (!empty($id_pack)) {
                $result_productos_packs = $conn->query("SELECT cantidad_pack FROM productos_packs WHERE 
                                   id=" . $id_pack . " AND activo=1 LIMIT 1");
                if ($conn->registros() == 1) {
                    $packs_disponibles = true;
                    $cantidad_packs_producto[$contador_sub_productos] = $result_productos_packs[0]['cantidad_pack'];
                    $entero = floor($cantidad_packs_producto[$contador_sub_productos]);
                    $decimal = $cantidad_packs_producto[$contador_sub_productos] - $entero;
                    if($decimal == 0) {
                        $cantidad_packs_producto[$contador_sub_productos] = $entero;
                    }
                    if(isset($descripcion_atributo[$contador_sub_productos])) {
                        $descripcion_atributos_producto[$contador_sub_productos] .= " Pack de " . $cantidad_packs_producto[$contador_sub_productos] . " unid.";
                    }else {
                        $descripcion_atributos_producto[$contador_sub_productos] = "Pack de " . $cantidad_packs_producto[$contador_sub_productos] . " unid.";
                    }
                }
            }

            $id_enlazados_producto[$contador_sub_productos] = $id_enlazado;
            $id_multiples_producto[$contador_sub_productos] = $id_multiple;
            $id_packs_producto[$contador_sub_productos] = $id_pack;
            $control_stock_producto[$contador_sub_productos] = $valor_productos_otros['control_stock'];
            $disponibilidad_producto[$contador_sub_productos] = $valor_productos_otros['disponibilidad'];
            $profesionales_producto[$contador_sub_productos] = $valor_productos_otros['profesionales'];
            $peso_producto[$contador_sub_productos] = $valor_productos_otros['peso'];
            $bultos_producto[$contador_sub_productos] = $valor_productos_otros['bultos'];
            $gastos_producto[$contador_sub_productos] = $valor_productos_otros['gastos'];
            $envio_gratis_producto[$contador_sub_productos] = $valor_productos_otros['envio_gratis'];
            $dias_entrega_producto[$contador_sub_productos] = $valor_productos_otros['dias_entrega'];
            $aplicar_descuento_producto[$contador_sub_productos] = $valor_productos_otros['aplicar_descuento'];
            $descuento_maximo_producto[$contador_sub_productos] = $valor_productos_otros['descuento_maximo'];

            $result_productos_sku = $conn->query("SELECT id,codigo_barras,referencia 
                               FROM productos_sku WHERE 
                               id_producto=" . $id_producto . " AND 
                               id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                               id_productos_detalles_multiples=" . $id_multiple . " AND 
                               id_packs=" . $id_pack . " LIMIT 1");
            if ($conn->registros() == 1) {
                $id_productos_sku[$contador_sub_productos] = $result_productos_sku[0]['id'];
                $codigo_barras_producto[$contador_sub_productos] = stripslashes($result_productos_sku[0]['codigo_barras']);
                $referencia_producto[$contador_sub_productos] = stripslashes($result_productos_sku[0]['referencia']);
            }else {
                $id_productos_sku[$contador_sub_productos] = 0;
                $codigo_barras_producto[$contador_sub_productos] = "";
                $referencia_producto[$contador_sub_productos]= "";
            }

            $result_productos_pvp = $conn->query("SELECT pvp,id_ofertas,oferta_desde,oferta_hasta,pvp_oferta 
                               FROM productos_pvp WHERE 
                               id_producto=" . $id_producto . " AND 
                               id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                               id_productos_detalles_multiples=" . $id_multiple . " AND 
                               id_packs=" . $id_pack . " AND id_tarifa=".$id_tarifa_web." LIMIT 1");
            if ($conn->registros() == 1) {
                $pvp_producto[$contador_sub_productos] = $result_productos_pvp[0]['pvp'];
                $id_ofertas_producto[$contador_sub_productos] = $result_productos_pvp[0]['id_ofertas'];
                $oferta_desde_producto[$contador_sub_productos] = $result_productos_pvp[0]['oferta_desde'];
                $oferta_hasta_producto[$contador_sub_productos] = $result_productos_pvp[0]['oferta_hasta'];
                $pvp_oferta_producto[$contador_sub_productos] = $result_productos_pvp[0]['pvp_oferta'];
                if (!empty($result_productos_pvp[0]['id_ofertas'])) {
                    $result_ofertas = $conn->query("SELECT descripcion FROM ofertas WHERE 
                                                id=" . $result_productos_pvp[0]['id_ofertas'] . " LIMIT 1");
                    if ($conn->registros() == 1) {
                        $descripcion_ofertas_producto[$contador_sub_productos] = stripslashes($result_ofertas[0]['descripcion']);
                    }else {
                        $descripcion_ofertas_producto[$contador_sub_productos] = "";
                    }
                }
            }else {
                $pvp_producto[$contador_sub_productos] = 0;
            }

            $result_images = $conn->query("SELECT imagen,updated,alt,tittle FROM productos_images 
                                WHERE id_producto=" . $id_producto . " AND 
                                id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                                id_productos_detalles_multiples=" . $id_multiple . " AND 
                                id_packs=" . $id_pack . " AND 
                                activo=1 ORDER BY orden");
            foreach ($result_images as $key_images => $valor_images) {
                $images_producto[$contador_sub_productos] = stripslashes($valor_images['imagen']);
                $images_updated_producto[$contador_sub_productos] = stripslashes($valor_images['updated']);
                $images_alt_producto[$contador_sub_productos] = stripslashes($valor_images['alt']);
                $images_tittle_producto[$contador_sub_productos] = stripslashes($valor_images['tittle']);
            }

            $result_productos_web_datos = $conn->query("SELECT id_observaciones FROM productos_web_datos 
                                WHERE id_producto=" . $id_producto . " AND 
                                id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                                id_productos_detalles_multiples=" . $id_multiple . " AND 
                                id_packs=" . $id_pack . " LIMIT 1");
            if($conn->registros() == 1) {
                $id_observaciones = $result_productos_web_datos[0]['id_observaciones'];
                if(!empty($id_observaciones)) {
                    $result_observaciones = $conn->query("SELECT observacion FROM productos_observaciones 
                                WHERE id='" . $id_observaciones . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $observaciones_producto[$contador_sub_productos] = nl2br(stripslashes($result_observaciones[0]['observacion']));
                    }
                }
            }
            $contador_sub_productos += 1;
        }
        break;
    case "productos-relacionados-grupos":
        $result_productos_relacionados_grupos = $conn->query("SELECT id,descripcion FROM productos_relacionados_grupos 
                                WHERE id_idioma='" . $id_idioma . "' ORDER BY orden");
        foreach ($result_productos_relacionados_grupos as $key_productos_relacionados_grupos => $valor_productos_relacionados_grupos) {
            $id_productos_relacionados_grupos[] = $valor_productos_relacionados_grupos['id'];
            $grupos_productos_relacionados_grupos[] = stripslashes($valor_productos_relacionados_grupos['descripcion']);
        }
        break;
    case "descripcion-relacionado-grupos":
        $result_productos_relacionados_grupos = $conn->query("SELECT descripcion FROM productos_relacionados_grupos 
                                WHERE id='" . $_SESSION[$id_sesion_js]['id_productos_relacionados_grupos'] . "' LIMIT 1");
        if($conn->registros() == 1) {
            $orden = stripslashes($result_productos_relacionados_grupos[0]['descripcion']);
        }
        break;
    case "productos-grupos":
        $contador_grupos = 0;
        $result_productos_relacionados_grupos = $conn->query("SELECT id,descripcion FROM productos_relacionados_grupos 
                                WHERE id_idioma='" . $id_idioma . "' ORDER BY orden");
        foreach ($result_productos_relacionados_grupos as $key_productos_relacionados_grupos => $valor_productos_relacionados_grupos) {
            $result_productos_grupos = $conn->query("SELECT id 
                                FROM productos_relacionados_combo WHERE id_producto=" . $id_producto_sys . " AND 
                                id_grupo='".$valor_productos_relacionados_grupos['id']."' AND activo=1 LIMIT 1");
            if ($conn->registros() == 1) {
                $id_productos_relacionados_grupos[$contador_grupos] = $valor_productos_relacionados_grupos['id'];
                $grupos_productos_relacionados_grupos[$contador_grupos] = stripslashes($valor_productos_relacionados_grupos['descripcion']);
                $contador_grupos += 1;
            }
        }
        break;
    case "recuperar-productos-combo":
        $result_productos_combo = $conn->query("SELECT id,id_productos_detalles_enlazado,id_productos_detalles_multiples,
            id_packs,id_relacionado,id_grupo,fijo,cantidad,sumar,mostrar,orden 
            FROM documentos_" . $ejercicio . "_productos_relacionados_combo WHERE id_documentos_2=" . $id_linea . " ORDER BY orden");
        if ($conn->registros() >= 1) {
            foreach ($result_productos_combo as $key_productos_combo => $valor_productos_combo) {
                $id_recuperar_productos_combo[] = $valor_productos_combo['id'];
                $id_productos_detalles_enlazado_recuperar_productos_combo[] = $valor_productos_combo['id_productos_detalles_enlazado'];
                $id_productos_detalles_multiples_recuperar_productos_combo[] = $valor_productos_combo['id_productos_detalles_multiples'];
                $id_packs_recuperar_productos_combo[] = $valor_productos_combo['id_packs'];
                $id_relacionado_recuperar_productos_combo[] = $valor_productos_combo['id_relacionado'];
                $id_grupo_recuperar_productos_combo[] = $valor_productos_combo['id_grupo'];
                $fijo_recuperar_productos_combo[] = $valor_productos_combo['fijo'];
                $cantidad_recuperar_productos_combo[] = $valor_productos_combo['cantidad'];
                $sumar_recuperar_productos_combo[] = $valor_productos_combo['sumar'];
                $mostrar_recuperar_productos_combo[] = $valor_productos_combo['mostrar'];

                $result_observaciones = $conn->query("SELECT observacion
                    FROM documentos_" . $ejercicio . "_observaciones WHERE id_documentos_2=" . $id_linea . " AND id_documentos_combo = " . $valor_productos_combo['id'] . " LIMIT 1");
                if ($conn->registros() >= 1) {
                    $observacion_recuperar_productos_combo[] = stripslashes($result_observaciones[0]['observacion']);
                } else {
                    $observacion_recuperar_productos_combo[] = '';
                }
            }
        }
        break;
    case "recuperar-productos-relacionados-combo":
        $result_productos_relacionados = $conn->query("SELECT id,id_productos_relacionados,id_productos_detalles_enlazado,id_productos_detalles_multiples,
            id_packs,id_relacionado,descripcion,id_titulo_relacionado,id_grupo,fijo,modelo,cantidad_con,cantidad_mitad,cantidad_sin,
            cantidad_doble,sumar_con,sumar_mitad,sumar_sin,sumar_doble,observaciones,por_defecto,mostrar,orden 
            FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_combo=" . $id_documentos_combo . " ORDER BY orden");
        if ($conn->registros() >= 1) {
            foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                $id_productos_relacionados_combo[] = $valor_productos_relacionados['id'];
                $id_productos_relacionados_productos_relacionados_combo[] = $valor_productos_relacionados['id_productos_relacionados'];
                $id_productos_detalles_enlazado_productos_relacionados_combo[] = $valor_productos_relacionados['id_productos_detalles_enlazado'];
                $id_productos_detalles_multiples_productos_relacionados_combo[] = $valor_productos_relacionados['id_productos_detalles_multiples'];
                $id_packs_productos_relacionados_combo[] = $valor_productos_relacionados['id_packs'];
                $id_relacionado_productos_relacionados_combo[] = $valor_productos_relacionados['id_relacionado'];
                $id_titulo_relacionado_productos_relacionados_combo[] = $valor_productos_relacionados['id_titulo_relacionado'];
                $descripcion_productos_relacionados_combo[] = $valor_productos_relacionados['descripcion'];
                $id_grupo_productos_relacionados_combo[] = $valor_productos_relacionados['id_grupo'];
                $fijo_productos_relacionados_combo[] = $valor_productos_relacionados['fijo'];
                $modelo_productos_relacionados_combo[] = $valor_productos_relacionados['modelo'];
                $cantidad_con_productos_relacionados_combo[] = $valor_productos_relacionados['cantidad_con'];
                $cantidad_mitad_productos_relacionados_combo[] = $valor_productos_relacionados['cantidad_mitad'];
                $cantidad_sin_productos_relacionados_combo[] = $valor_productos_relacionados['cantidad_sin'];
                $cantidad_doble_productos_relacionados_combo[] = $valor_productos_relacionados['cantidad_doble'];
                $sumar_con_productos_relacionados_combo[] = $valor_productos_relacionados['sumar_con'];
                $sumar_mitad_productos_relacionados_combo[] = $valor_productos_relacionados['sumar_mitad'];
                $sumar_sin_productos_relacionados_combo[] = $valor_productos_relacionados['sumar_sin'];
                $sumar_doble_productos_relacionados_combo[] = $valor_productos_relacionados['sumar_doble'];
                $observaciones_productos_relacionados_combo[] = $valor_productos_relacionados['observaciones'];
                $por_defecto_productos_relacionados_combo[] = $valor_productos_relacionados['por_defecto'];
                $mostrar_productos_relacionados_combo[] = $valor_productos_relacionados['mostrar'];
                $orden_productos_relacionados_combo[] = $valor_productos_relacionados['orden'];
            }
        }
        break;
    case "productos-grupo":
        $result_productos_grupos = $conn->query("SELECT `id`,`id_producto`,`id_productos_detalles_enlazado`,
       `id_productos_detalles_multiples`,`id_packs`,`id_relacionado`,`id_grupo`,`fijo`,`cantidad`,`mostrar`
                            FROM productos_relacionados_combo WHERE id_producto=" . $id_producto_pral . " AND 
                            id_grupo='".$id_productos_relacionados_grupos[$contador_grupos_mostrados]."' AND activo=1 ORDER BY orden");
        if ($conn->registros() >= 1) {
            foreach ($result_productos_grupos as $key_productos_grupos => $valor_productos_grupos) {
                $id_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['id'];
                $id_producto_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['id_producto'];
                $id_productos_detalles_enlazado_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['id_productos_detalles_enlazado'];
                $id_productos_detalles_multiples_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['id_productos_detalles_multiples'];
                $id_packs_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['id_packs'];
                $id_relacionado_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['id_relacionado'];
                $id_grupo_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['id_grupo'];
                $fijo_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['fijo'];
                $cantidad_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['cantidad'];
                $mostrar_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['mostrar'];
                $result_productos_grupos_sumar = $conn->query("SELECT `sumar` FROM productos_relacionados_combo_incre 
                            WHERE id_producto_rel=" . $valor_productos_grupos['id'] . " AND id_tarifa='".$id_tarifa_web."' LIMIT 1");
                if($conn->registros() == 1) {
                    $sumar_producto_grupos[$contador_grupos_mostrados][] = $result_productos_grupos_sumar[0]['sumar'];
                }else {
                    $sumar_producto_grupos[$contador_grupos_mostrados][] = 0;
                }
            }
        }
        break;
    case "productos-relacionados":
        if ($id_linea_sys) {
            if(empty($id_grupo_relacionado_sys)) {
                $result_productos_relacionados = $conn->query("SELECT id,id_relacionado,descripcion,id_titulo_relacionado,fijo,modelo,cantidad_con,
                                cantidad_mitad,cantidad_sin,cantidad_doble,sumar_con,sumar_mitad,sumar_sin,sumar_doble,observaciones,por_defecto,mostrar 
                                FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_2=" . $id_linea_sys . " ORDER BY orden");
            }else {
                $result_productos_relacionados = $conn->query("SELECT id,id_relacionado,descripcion,id_titulo_relacionado,fijo,modelo,cantidad_con,
                                cantidad_mitad,cantidad_sin,cantidad_doble,sumar_con,sumar_mitad,sumar_sin,sumar_doble,observaciones,por_defecto,mostrar 
                                FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_2=" . $id_linea_sys . " AND 
                                id_grupo='".$id_grupo_relacionado_sys."' ORDER BY orden");
            }
            if ($conn->registros() >= 1) {
                foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                    $id_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['id'];
                    $id_relacionado_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['id_relacionado'];
                    $descripcion_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = stripslashes($valor_productos_relacionados['descripcion']);
                    $id_titulo_relacionado_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['id_titulo_relacionado'];
                    $id_grupo_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['id_grupo'];
                    $fijo_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['fijo'];
                    $modelo_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['modelo'];
                    $cantidad_con_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['cantidad_con'];
                    $cantidad_mitad_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['cantidad_mitad'];
                    $cantidad_sin_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['cantidad_sin'];
                    $cantidad_doble_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['cantidad_doble'];
                    $sumar_con_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['sumar_con'];
                    $sumar_mitad_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['sumar_mitad'];
                    $sumar_sin_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['sumar_sin'];
                    $sumar_doble_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['sumar_doble'];
                    $observaciones_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['observaciones'];
                    $por_defecto_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['por_defecto'];
                    $mostrar_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']] = $valor_productos_relacionados['mostrar'];
                }
            }
        }

        if(empty($id_grupo_relacionado_sys)) {
            $result_productos_relacionados = $conn
                ->query("SELECT pt.descripcion as titulo_descripcion, ptr.id as id_titulo_relacionado, CASE WHEN ptr.descripcion IS NULL OR ptr.descripcion = '' THEN pt.descripcion ELSE ptr.descripcion END AS descripcion, pt.modelo, pr.id, pr.id_producto, pr.id_productos_detalles_enlazado, pr.id_productos_detalles_multiples, pr.id_packs, pr.id_relacionado, pr.id_grupo, pr.fijo, pr.cantidad_con, pr.cantidad_mitad, pr.cantidad_sin, pr.cantidad_doble, IFNULL(pr.por_defecto, 2) AS por_defecto, IFNULL(pr.mostrar, 1) as mostrar, pr.orden 
                    FROM productos_titulos as pt
                    LEFT OUTER JOIN productos_titulos_relacionados as ptr ON pt.id = ptr.id_productos_titulos
                    LEFT OUTER JOIN productos_relacionados as pr ON pr.id_relacionado = ptr.id_producto AND pr.id_producto = pt.id_producto
                    WHERE pt.id_producto=" . $id_producto_relacionado_sys . " ORDER BY pt.orden ASC, pr.modelo DESC, pr.orden");
        }else {
            $result_productos_relacionados = $conn
                ->query("SELECT pt.descripcion as titulo_descripcion, ptr.id as id_titulo_relacionado, CASE WHEN ptr.descripcion IS NULL OR ptr.descripcion = '' THEN pt.descripcion ELSE ptr.descripcion END AS descripcion, pt.modelo, pr.id, pr.id_producto, pr.id_productos_detalles_enlazado, pr.id_productos_detalles_multiples, pr.id_packs, pr.id_relacionado, pr.id_grupo, pr.fijo, pr.cantidad_con, pr.cantidad_mitad, pr.cantidad_sin, pr.cantidad_doble, IFNULL(pr.por_defecto, 2) AS por_defecto, IFNULL(pr.mostrar, 1) as mostrar, pr.orden 
                    FROM productos_titulos as pt
                    LEFT OUTER JOIN productos_titulos_relacionados as ptr ON pt.id = ptr.id_productos_titulos
                    LEFT OUTER JOIN productos_relacionados as pr ON pr.id_relacionado = ptr.id_producto AND pr.id_producto = pt.id_producto  
                    WHERE pt.id_producto=" . $id_producto_relacionado_sys . " AND pr.id_grupo='".$id_grupo_relacionado_sys."' ORDER BY pt.orden ASC, pr.modelo DESC, pr.orden");
        }
        if ($conn->registros() >= 1) {
            foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                if (isset($id_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']])) {
                    $id_producto_relacionado[] = $valor_productos_relacionados['id'];
                    $id_relacionado_producto_relacionado[] = $id_relacionado_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $id_titulo_relacionado_producto_relacionado[] = $id_titulo_relacionado_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $descripcion_producto_relacionado[] = $descripcion_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $titulo_descripcion_producto_relacionado[] = stripslashes($valor_productos_relacionados['titulo_descripcion']);
                    $id_grupo_producto_relacionado[] = $id_grupo_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $fijo_producto_relacionado[] = $fijo_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $modelo_producto_relacionado[] = $modelo_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $cantidad_con_producto_relacionado[] = $cantidad_con_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $cantidad_mitad_producto_relacionado[] = $cantidad_mitad_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $cantidad_sin_producto_relacionado[] = $cantidad_sin_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $cantidad_doble_producto_relacionado[] = $cantidad_doble_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $sumar_con_producto_relacionado[] = $sumar_con_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $sumar_mitad_producto_relacionado[] = $sumar_mitad_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $sumar_sin_producto_relacionado[] = $sumar_sin_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $sumar_doble_producto_relacionado[] = $sumar_doble_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $observaciones_producto_relacionado[] = $observaciones_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $por_defecto_producto_relacionado[] = $por_defecto_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];
                    $mostrar_producto_relacionado[] = $mostrar_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']];

                    if ($valor_productos_relacionados['modelo'] == 3 && $valor_productos_relacionados['mostrar'] && isset($id_documentos_producto_relacionado[$valor_productos_relacionados['id_titulo_relacionado']])) {
                        $checked_unico_producto_relacionado[] = 1;
                    } else {
                        $checked_unico_producto_relacionado[] = 0;
                    }
                } else {
                    $id_producto_relacionado[] = $valor_productos_relacionados['id'];
                    $id_relacionado_producto_relacionado[] = $valor_productos_relacionados['id_relacionado'];
                    $id_titulo_relacionado_producto_relacionado[] = $valor_productos_relacionados['id_titulo_relacionado'];
                    $descripcion_producto_relacionado[] = stripslashes($valor_productos_relacionados['descripcion']);
                    $titulo_descripcion_producto_relacionado[] = stripslashes($valor_productos_relacionados['titulo_descripcion']);
                    $id_grupo_producto_relacionado[] = $valor_productos_relacionados['id_grupo'];
                    $fijo_producto_relacionado[] = $valor_productos_relacionados['fijo'];
                    $modelo_producto_relacionado[] = $valor_productos_relacionados['modelo'];
                    $observaciones_producto_relacionado[] = '';
                    $cantidad_con_producto_relacionado[] = $valor_productos_relacionados['cantidad_con'];
                    $cantidad_mitad_producto_relacionado[] = $valor_productos_relacionados['cantidad_mitad'];
                    $cantidad_sin_producto_relacionado[] = $valor_productos_relacionados['cantidad_sin'];
                    $cantidad_doble_producto_relacionado[] = $valor_productos_relacionados['cantidad_doble'];
                    if (!empty($id_linea_sys) && $id_linea_sys > 0) {
                        $por_defecto_producto_relacionado[] = 2;
                    } else {
                        $por_defecto_producto_relacionado[] = $valor_productos_relacionados['por_defecto'];
                    }
                    $mostrar_producto_relacionado[] = $valor_productos_relacionados['mostrar'];

                    if ($tipo_librador == 'pro' || $tipo_librador == 'cre') {
                        if ($valor_productos_relacionados['id_relacionado']) {
                            $result_producto_coste = $conn->query("SELECT coste FROM productos 
                            WHERE id=" . $valor_productos_relacionados['id_relacionado'] . " LIMIT 1");
                            if($conn->registros() == 1) {
                                $sumar_con_producto_relacionado[] = $result_producto_coste[0]['coste'];
                            } else {
                                $sumar_con_producto_relacionado[] = 0;
                            }
                        } else {
                            $sumar_con_producto_relacionado[] = 0;
                        }
                        $sumar_mitad_producto_relacionado[] = 0;
                        $sumar_sin_producto_relacionado[] = 0;
                        $sumar_doble_producto_relacionado[] = 0;
                    } else {
                        $result_productos_grupos_sumar = $conn->query("SELECT sumar_con,sumar_mitad,sumar_sin,sumar_doble FROM productos_relacionados_incre 
                            WHERE id_producto_rel=" . $valor_productos_relacionados['id'] . " AND id_tarifa='".$id_tarifa_web."' LIMIT 1");
                        if($conn->registros() == 1) {
                            $sumar_con_producto_relacionado[] = $result_productos_grupos_sumar[0]['sumar_con'];
                            $sumar_mitad_producto_relacionado[] = $result_productos_grupos_sumar[0]['sumar_mitad'];
                            $sumar_sin_producto_relacionado[] = $result_productos_grupos_sumar[0]['sumar_sin'];
                            $sumar_doble_producto_relacionado[] = $result_productos_grupos_sumar[0]['sumar_doble'];
                        }else {
                            $sumar_con_producto_relacionado[] = 0;
                            $sumar_mitad_producto_relacionado[] = 0;
                            $sumar_sin_producto_relacionado[] = 0;
                            $sumar_doble_producto_relacionado[] = 0;
                        }
                    }

                    if ($valor_productos_relacionados['modelo'] == 3 && !isset($id_documentos_producto_relacionado)) {
                        if ($valor_productos_relacionados['por_defecto'] == 0) {
                            $checked_unico_producto_relacionado[] = 1;
                        } else {
                            $checked_unico_producto_relacionado[] = 0;
                        }
                    } else {
                        $checked_unico_producto_relacionado[] = 0;
                    }
                }
            }
        }
        break;
    case "productos-embalajes":
        $sql = "SELECT pe.*, pp.pvp AS pvp FROM productos_embalajes pe JOIN productos_pvp pp ON pe.id_producto_relacionado = pp.id_producto && pp.id_tarifa = " . $id_tarifa_web . " WHERE 
                           pe.id_producto=" . $id_producto_sys;
        $result_productos = $conn->query($sql);
        if ($conn->registros() > 0) {
            foreach ($result_productos as $key_productos => $valor_productos) {
                $id_productos_embalajes[] = $valor_productos['id'];
                $id_producto_relacionado_productos_embalajes[] = stripslashes($valor_productos['id_producto_relacionado']);
                $cantidad_productos_embalajes[] = stripslashes($valor_productos['cantidad']);
                $sumar_productos_embalajes[] = stripslashes($valor_productos['sumar']);
                $pvp_productos_embalajes[] = stripslashes($valor_productos['pvp']);
            }
        }
        break;
    case "lineas-documento":
        $result = $conn->query("SELECT COUNT('id') AS registros FROM documentos_".$ejercicio."_2 WHERE id_documentos_1=".$id_documento_1);
        $lineas_documento = $result[0]['registros'];
        $documento_ok = true;
        if($lineas_documento == 0) {
            $result = $conn->query("SELECT id FROM documentos_".$ejercicio."_1 WHERE id=".$id_documento_1." LIMIT 1");
            if($conn->registros() == 0) {
                $documento_ok = false;
            }
        }
        break;
    case "buscar-opciones":
        $logs->resultado = "sin datos";
        $result_productos = $conn->query("SELECT id,descripcion,imagen,updated,alt,tittle FROM productos WHERE 
                           id_idioma=".$id_idioma." AND 
                           descripcion LIKE '%".addslashes($buscar_opcion)."%' AND 
                           activo=1 LIMIT 10");
        if ($conn->registros() > 0) {
            foreach ($result_productos as $key_productos => $valor_productos) {
                $id_encontradas[] = $valor_productos['id'];
                $opciones_encontradas[] = stripslashes($valor_productos['descripcion']);
                $imagen_encontradas[] = stripslashes($valor_productos['imagen']);
                $updated_encontradas[] = stripslashes($valor_productos['updated']);
                $alt_encontradas[] = stripslashes($valor_productos['alt']);
                $tittle_encontradas[] = stripslashes($valor_productos['tittle']);
            }
            $logs->id_encontradas = $id_encontradas;
            $logs->opciones_encontradas = $opciones_encontradas;
            $logs->imagen_encontradas = $imagen_encontradas;
            $logs->updated_encontradas = $updated_encontradas;
            $logs->alt_encontradas = $alt_encontradas;
            $logs->tittle_encontradas = $tittle_encontradas;
            $logs->resultado = "con datos";
        }
        break;
    case "productos-mas-vendidos":
        $result_mas_vendidos = $conn->query("SELECT COUNT(id_producto) as numero_ventas, id_producto 
                                            FROM documentos_" . $ejercicio . "_2 
                                            WHERE tipo_librador='".$tipo_librador."' 
                                            GROUP BY id_producto 
                                            ORDER BY numero_ventas DESC LIMIT 50");
        $producto_id_mas_vendidos = [];
        foreach ($result_mas_vendidos as $result_mas_vendido) {
            $producto_id_mas_vendidos[] = $result_mas_vendido['id_producto'];
        }

        $producto_venta = "";
        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $producto_venta = " AND productos.producto_venta=1";
        }

        // Si es proveedor o creditor, no tienen tarifa.
        // Si es proveedor o creditor, se debe coger el precio de coste.
        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $condicion_productos = " productos.activo=1 AND productos.producto_venta=1 AND productos_pvp.id_tarifa=" . $id_tarifa_web;

            if (count($producto_id_mas_vendidos) > 0) {
                $result_categorias = $conn->query("SELECT productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta,
                                            productos_categorias.id_categoria 
                                            FROM productos_categorias,productos,productos_pvp 
                                            WHERE productos.id IN (". join(',', $producto_id_mas_vendidos).") AND 
                                            productos.id=productos_categorias.id_producto AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto=productos_categorias.id_producto AND 
                                            productos_pvp.id_productos_detalles_enlazado=0 AND 
                                            productos_pvp.id_productos_detalles_multiples=0 AND 
                                            productos_pvp.id_packs=0 
                                            GROUP BY productos.id 
                                            ORDER BY ".$orden);
            } else {
                $result_categorias = [];
            }

        }else {
            $condicion_productos = " productos.activo=1";

            $result_categorias = $conn->query("SELECT productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos.coste,
                                            productos_categorias.id_categoria 
                                            FROM productos_categorias,productos 
                                            WHERE productos.id IN (". join(',', $producto_id_mas_vendidos).") AND 
                                            productos.id=productos_categorias.id_producto AND 
                                            " . $condicion_productos . " 
                                            GROUP BY productos.id  
                                            ORDER BY ".$orden);
        }

        $productos_total = 0;

        if ($conn->registros() >= 1) {
            foreach ($result_categorias as $key_categorias => $valor_categorias) {
                $productos_total++;
                $result_productos_otros = $conn->query("SELECT url_externa,disponibilidad,profesionales,envio_gratis 
                           FROM productos_otros WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 AND 
                           disponibilidad<>0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $result_categoria_producto = $conn->query("SELECT descripcion_url FROM categorias WHERE id='" . $valor_categorias['id_categoria'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $path_components[$indice_componente] = stripslashes($result_categoria_producto[0]['descripcion_url']);
                    }
                    $id_producto_mostrar[$productos_mostrados] = $valor_categorias['id_producto'];
                    $tipo_producto_categorias[$productos_mostrados] = $valor_categorias['tipo_producto'];
                    $descripcion[$productos_mostrados] = stripslashes($valor_categorias['descripcion']);
                    $descripcion_categoria_producto[$productos_mostrados] = $path_components[$indice_componente];
                    $imagen[$productos_mostrados] = $valor_categorias['imagen'];
                    $updated[$productos_mostrados] = $valor_categorias['updated'];
                    $alt[$productos_mostrados] = stripslashes($valor_categorias['alt']);
                    $tittle[$productos_mostrados] = stripslashes($valor_categorias['tittle']);

                    $url_externa[$productos_mostrados] = stripslashes($result_productos_otros[0]['url_externa']);
                    $disponibilidad[$productos_mostrados] = $result_productos_otros[0]['disponibilidad'];
                    $profesionales[$productos_mostrados] = $result_productos_otros[0]['profesionales'];
                    $envio_gratis[$productos_mostrados] = $result_productos_otros[0]['envio_gratis'];

                    $result_iva = $conn->query("SELECT iva,recargo FROM productos_iva WHERE id='" . $valor_categorias['id_iva'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $iva[$productos_mostrados] = $result_iva[0]['iva'];
                        $recargo_sys[$productos_mostrados] = $result_iva[0]['recargo'];
                    }
                }

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           activo=1");
                if ($conn->registros() >= 1) {
                    foreach ($result_productos_packs as $key_productos_packs => $valor_productos_packs) {
                        $result_productos_otros = $conn->query("SELECT id FROM productos_otros WHERE 
                            id_producto=" . $valor_categorias['id_producto'] . " AND id_packs=" . $valor_productos_packs['id'] . " AND tienda=1 AND disponibilidad<>0 LIMIT 1");
                        if ($conn->registros() == 1) {
                            $packs_disponibles[$productos_mostrados] = true;
                            break;
                        }
                    }
                } else {
                    $packs_disponibles[$productos_mostrados] = false;
                }

                if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                    $pvp[$productos_mostrados] = $valor_categorias['pvp'];
                    $id_ofertas[$productos_mostrados] = $valor_categorias['id_ofertas'];
                    $oferta_desde[$productos_mostrados] = $valor_categorias['oferta_desde'];
                    $oferta_hasta[$productos_mostrados] = $valor_categorias['oferta_hasta'];
                    $pvp_oferta[$productos_mostrados] = $valor_categorias['pvp_oferta'];
                    if (!empty($valor_categorias['id_ofertas'])) {
                        $result_productos_web_datos = $conn->query("SELECT descripcion FROM ofertas WHERE 
                           id=" . $valor_categorias['id_ofertas'] . " LIMIT 1");
                        if ($conn->registros() == 1) {
                            $descripcion_ofertas[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion']);
                        }
                    }
                } else {
                    $coste[$productos_mostrados] = $valor_categorias['coste'];
                }

                if(isset($id_librador) && isset($valor_categorias['id_producto']) && isset($tipo_librador)) {
                    /* Obtener dato coste o importe por librador */
                    $result_coste_importe = $conn->query("SELECT coste_importe FROM libradores_productos 
                            WHERE id_librador='" . $id_librador . "' AND id_producto='" . $valor_categorias['id_producto'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        if (!empty($result_coste_importe[0]['coste_importe'])) {
                            if($tipo_librador == 'pro' || $tipo_librador == 'cre') {
                                $coste[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            }else {
                                $pvp[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            }
                        }
                    }
                    /* Final obtener dato coste o importe por librador */
                }

                $result_productos_web_datos = $conn->query("SELECT descripcion_larga,descripcion_url FROM productos_web_datos WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_larga[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_larga']);
                    $descripcion_url_mostrar[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_url']);
                }

                $querySql = "SELECT 
                            A.`lote` as lote,
                            A.`caducidad` as caducidad,
                            A.`coste` as coste,
                            CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock`
                        FROM 
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND lote <> '' AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad_ventas FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND lote <> '' AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote
                        WHERE (`cantidad`-`cantidad_ventas` > 0 OR `cantidad_ventas` IS NULL);";
                $result_productos_sku_stock = $conn->query($querySql);
                $numero_de_lotes_activos[$productos_mostrados] = $conn->registros();

                $result_productos_enlazados = $conn->query("SELECT id FROM productos_detalles_enlazado WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_enlazados[$productos_mostrados] = $conn->registros();

                $result_productos_multiples = $conn->query("SELECT id FROM productos_detalles_multiples WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_multiples[$productos_mostrados] = $conn->registros();

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_packs[$productos_mostrados] = $conn->registros();

                $productos_mostrados += 1;
            }
        }
        break;
    case "web-productos-categorias":
        $producto_venta = "";
        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $producto_venta = " AND productos.producto_venta=1";
        }

        // Si es proveedor o creditor, no tienen tarifa.
        // Si es proveedor o creditor, se debe coger el precio de coste.
        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $condicion_productos = " productos.activo=1 AND productos.producto_venta=1 AND productos_pvp.id_tarifa=" . $id_tarifa_web;
            $sql = "SELECT SQL_CALC_FOUND_ROWS productos.tipo_producto, COUNT(productos.id) AS numero_packs, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos_categorias,productos,productos_pvp 
                                            WHERE productos_categorias.id_categoria=".$id_categoria_mostrar.$producto_venta." AND 
                                            productos.id=productos_categorias.id_producto AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto=productos_categorias.id_producto AND 
                                            productos_pvp.id_productos_detalles_enlazado=0 AND 
                                            productos_pvp.id_productos_detalles_multiples=0 AND 
                                            productos_pvp.id_packs=0 
                                            GROUP BY productos.id 
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final;
            $result_categorias = $conn->query($sql);
        }else {
            $condicion_productos = " productos.activo=1";
            $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS productos.tipo_producto, COUNT(productos.id) AS numero_packs, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos.coste 
                                            FROM productos_categorias,productos 
                                            WHERE productos_categorias.id_categoria=".$id_categoria_mostrar.$producto_venta." AND 
                                            productos.id=productos_categorias.id_producto AND 
                                            " . $condicion_productos . " 
                                            GROUP BY productos.id 
                                            ORDER BY ".$orden." LIMIT ".$cadena_limite_inicial.",".$cadena_limite_final);
        }

        $productosEnLaCategoria = $conn->query("SELECT FOUND_ROWS();");
        $productosEnLaCategoria = $productosEnLaCategoria[0]["FOUND_ROWS()"];

        $productos_total = 0;

        if ($conn->registros() >= 1) {
            foreach ($result_categorias as $key_categorias => $valor_categorias) {
                $productos_total++;
                $result_productos_otros = $conn->query("SELECT url_externa,disponibilidad,profesionales,envio_gratis 
                           FROM productos_otros WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 AND 
                           disponibilidad<>0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $id_producto_mostrar[$productos_mostrados] = $valor_categorias['id_producto'];
                    $numero_packs[$productos_mostrados] = $valor_categorias['numero_packs'];
                    $tipo_producto_categorias[$productos_mostrados] = $valor_categorias['tipo_producto'];
                    $descripcion[$productos_mostrados] = stripslashes($valor_categorias['descripcion']);
                    $descripcion_categoria_producto[$productos_mostrados] = $path_components[$indice_componente];
                    $imagen[$productos_mostrados] = $valor_categorias['imagen'];
                    $updated[$productos_mostrados] = $valor_categorias['updated'];
                    $alt[$productos_mostrados] = stripslashes($valor_categorias['alt']);
                    $tittle[$productos_mostrados] = stripslashes($valor_categorias['tittle']);

                    $url_externa[$productos_mostrados] = stripslashes($result_productos_otros[0]['url_externa']);
                    $disponibilidad[$productos_mostrados] = $result_productos_otros[0]['disponibilidad'];
                    $profesionales[$productos_mostrados] = $result_productos_otros[0]['profesionales'];
                    $envio_gratis[$productos_mostrados] = $result_productos_otros[0]['envio_gratis'];

                    $result_iva = $conn->query("SELECT iva,recargo FROM productos_iva WHERE id='" . $valor_categorias['id_iva'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $iva[$productos_mostrados] = $result_iva[0]['iva'];
                        $recargo_sys[$productos_mostrados] = $result_iva[0]['recargo'];
                    }
                }

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           activo=1");
                if ($conn->registros() >= 1) {
                    foreach ($result_productos_packs as $key_productos_packs => $valor_productos_packs) {
                        $result_productos_otros = $conn->query("SELECT id FROM productos_otros WHERE 
                            id_producto=" . $valor_categorias['id_producto'] . " AND id_packs=" . $valor_productos_packs['id'] . " AND tienda=1 AND disponibilidad<>0 LIMIT 1");
                        if ($conn->registros() == 1) {
                            $packs_disponibles[$productos_mostrados] = true;
                            break;
                        }
                    }
                } else {
                    $packs_disponibles[$productos_mostrados] = false;
                }

                if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                    $pvp[$productos_mostrados] = $valor_categorias['pvp'];
                    $id_ofertas[$productos_mostrados] = $valor_categorias['id_ofertas'];
                    $oferta_desde[$productos_mostrados] = $valor_categorias['oferta_desde'];
                    $oferta_hasta[$productos_mostrados] = $valor_categorias['oferta_hasta'];
                    $pvp_oferta[$productos_mostrados] = $valor_categorias['pvp_oferta'];
                    if (!empty($valor_categorias['id_ofertas'])) {
                        $result_productos_web_datos = $conn->query("SELECT descripcion FROM ofertas WHERE 
                           id=" . $valor_categorias['id_ofertas'] . " LIMIT 1");
                        if ($conn->registros() == 1) {
                            $descripcion_ofertas[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion']);
                        }
                    }
                } else {
                    $coste[$productos_mostrados] = $valor_categorias['coste'];
                }

                if(isset($id_librador) && isset($valor_categorias['id_producto']) && isset($tipo_librador)) {
                    /* Obtener dato coste o importe por librador */
                    $result_coste_importe = $conn->query("SELECT coste_importe FROM libradores_productos 
                            WHERE id_librador='" . $id_librador . "' AND id_producto='" . $valor_categorias['id_producto'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        if (!empty($result_coste_importe[0]['coste_importe'])) {
                            if($tipo_librador == 'pro' || $tipo_librador == 'cre') {
                                $coste[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            }else {
                                $pvp[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            }
                        }
                    }
                    /* Final obtener dato coste o importe por librador */
                }

                $result_productos_web_datos = $conn->query("SELECT descripcion_larga,descripcion_url FROM productos_web_datos WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_larga[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_larga']);
                    $descripcion_url_mostrar[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_url']);
                }

                $querySql = "SELECT 
                            A.`lote` as lote,
                            A.`caducidad` as caducidad,
                            A.`coste` as coste,
                            CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock`
                        FROM 
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad_ventas FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote
                        WHERE (`cantidad`-`cantidad_ventas` > 0 OR `cantidad_ventas` IS NULL);";
                $result_productos_sku_stock = $conn->query($querySql);
                $disponibilidad = array_filter($result_productos_sku_stock, function($item) {
                    return $item['stock'] > 0;
                });
                $disponibilidadStock = array_shift($disponibilidad);
                $producto_stock[$productos_mostrados] = isset($disponibilidadStock['stock']) ? $disponibilidadStock['stock']  : 0 ;
                $producto_id[$productos_mostrados] = $valor_categorias['id_producto'];
                $numero_de_lotes_activos[$productos_mostrados] = $conn->registros();

                $result_productos_enlazados = $conn->query("SELECT id FROM productos_detalles_enlazado WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_enlazados[$productos_mostrados] = $conn->registros();

                $result_productos_multiples = $conn->query("SELECT id FROM productos_detalles_multiples WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_multiples[$productos_mostrados] = $conn->registros();

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_packs[$productos_mostrados] = $conn->registros();

                $productos_mostrados += 1;
            }
        }
        break;
    case "web-producto":
        $id_idioma = $id_idioma ?? 4;
        $packs_disponibles = false;
        $result_producto = $conn->query("SELECT descripcion,tipo_producto,id_iva,coste,imagen,updated,alt,tittle FROM productos 
                            WHERE id='" . $id_producto_sys . "' AND id_idioma='".$id_idioma."' AND activo=1 LIMIT 1");
        if ($conn->registros() == 1) {
            $result_productos_otros = $conn->query("SELECT 
                            id_productos_detalles_enlazado,
                            id_productos_detalles_multiples,
                            id_packs,
                            control_stock,
                            disponibilidad,
                            profesionales,
                            peso,
                            bultos,
                            gastos,
                            envio_gratis,
                            dias_entrega,
                            aplicar_descuento,
                            descuento_maximo 
                            FROM productos_otros 
                            WHERE id_producto=" . $id_producto_sys . " AND tienda=1 AND disponibilidad<>0 
                            ORDER BY id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs");
            if ($conn->registros() >= 1) {
                $contador_sub_productos = 0;
                foreach ($result_productos_otros as $key_productos_otros => $valor_productos_otros) {

                    $id_producto = $id_producto_sys;
                    $id_enlazado = $valor_productos_otros['id_productos_detalles_enlazado'];
                    $id_multiple = $valor_productos_otros['id_productos_detalles_multiples'];
                    $id_pack = $valor_productos_otros['id_packs'];

                    if (!empty($id_enlazado)) {
                        $select_sys = "descripcion_enlazado";
                        require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-atributos.php");
                        $descripcion_atributos_producto[$contador_sub_productos] = $descripcion_enlazado;
                    }
                    if (!empty($id_multiple)) {
                        $select_sys = "descripcion_multiple";
                        require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-atributos.php");
                        $descripcion_atributos_producto[$contador_sub_productos] = $descripcion_multiples;
                    }
                    if (!empty($id_pack)) {
                        $result_productos_packs = $conn->query("SELECT cantidad_pack FROM productos_packs WHERE 
                                   id=" . $id_pack . " AND activo=1 LIMIT 1");
                        if ($conn->registros() == 1) {
                            $packs_disponibles = true;
                            $cantidad_packs_producto[$contador_sub_productos] = $result_productos_packs[0]['cantidad_pack'];
                            $entero = floor($cantidad_packs_producto[$contador_sub_productos]);
                            $decimal = $cantidad_packs_producto[$contador_sub_productos] - $entero;
                            if($decimal == 0) {
                                $cantidad_packs_producto[$contador_sub_productos] = $entero;
                            }
                            if(isset($descripcion_atributo[$contador_sub_productos])) {
                                $descripcion_atributos_producto[$contador_sub_productos] .= " Pack de " . $cantidad_packs_producto[$contador_sub_productos] . " unid.";
                            }else {
                                $descripcion_atributos_producto[$contador_sub_productos] = "Pack de " . $cantidad_packs_producto[$contador_sub_productos] . " unid.";
                            }
                        }
                    }

                    $id_enlazados_producto[$contador_sub_productos] = $id_enlazado;
                    $id_multiples_producto[$contador_sub_productos] = $id_multiple;
                    $id_packs_producto[$contador_sub_productos] = $id_pack;
                    $control_stock_producto[$contador_sub_productos] = $valor_productos_otros['control_stock'];
                    $disponibilidad_producto[$contador_sub_productos] = $valor_productos_otros['disponibilidad'];
                    $profesionales_producto[$contador_sub_productos] = $valor_productos_otros['profesionales'];
                    $peso_producto[$contador_sub_productos] = $valor_productos_otros['peso'];
                    $bultos_producto[$contador_sub_productos] = $valor_productos_otros['bultos'];
                    $gastos_producto[$contador_sub_productos] = $valor_productos_otros['gastos'];
                    $envio_gratis_producto[$contador_sub_productos] = $valor_productos_otros['envio_gratis'];
                    $dias_entrega_producto[$contador_sub_productos] = $valor_productos_otros['dias_entrega'];
                    $aplicar_descuento_producto[$contador_sub_productos] = $valor_productos_otros['aplicar_descuento'];
                    $descuento_maximo_producto[$contador_sub_productos] = $valor_productos_otros['descuento_maximo'];

                    $result_productos_sku = $conn->query("SELECT id,codigo_barras,referencia 
                               FROM productos_sku WHERE 
                               id_producto=" . $id_producto . " AND 
                               id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                               id_productos_detalles_multiples=" . $id_multiple . " AND 
                               id_packs=" . $id_pack . " LIMIT 1");
                    if ($conn->registros() == 1) {
                        $id_productos_sku[$contador_sub_productos] = $result_productos_sku[0]['id'];
                        $codigo_barras_producto[$contador_sub_productos] = stripslashes($result_productos_sku[0]['codigo_barras']);
                        $referencia_producto[$contador_sub_productos] = stripslashes($result_productos_sku[0]['referencia']);
                    }else {
                        $id_productos_sku[$contador_sub_productos] = 0;
                        $codigo_barras_producto[$contador_sub_productos] = "";
                        $referencia_producto[$contador_sub_productos]= "";
                    }

                    $result_productos_pvp = $conn->query("SELECT pvp,id_ofertas,oferta_desde,oferta_hasta,pvp_oferta 
                               FROM productos_pvp WHERE 
                               id_producto=" . $id_producto . " AND 
                               id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                               id_productos_detalles_multiples=" . $id_multiple . " AND 
                               id_packs=" . $id_pack . " AND id_tarifa=".$id_tarifa_web." LIMIT 1");
                    if ($conn->registros() == 1) {
                        $pvp_producto[$contador_sub_productos] = $result_productos_pvp[0]['pvp'];
                        $id_ofertas_producto[$contador_sub_productos] = $result_productos_pvp[0]['id_ofertas'];
                        $oferta_desde_producto[$contador_sub_productos] = $result_productos_pvp[0]['oferta_desde'];
                        $oferta_hasta_producto[$contador_sub_productos] = $result_productos_pvp[0]['oferta_hasta'];
                        $pvp_oferta_producto[$contador_sub_productos] = $result_productos_pvp[0]['pvp_oferta'];
                        if (!empty($result_productos_pvp[0]['id_ofertas'])) {
                            $result_ofertas = $conn->query("SELECT descripcion FROM ofertas WHERE 
                                                id=" . $result_productos_pvp[0]['id_ofertas'] . " LIMIT 1");
                            if ($conn->registros() == 1) {
                                $descripcion_ofertas_producto[$contador_sub_productos] = stripslashes($result_ofertas[0]['descripcion']);
                            }else {
                                $descripcion_ofertas_producto[$contador_sub_productos] = "";
                            }
                        }
                    }else {
                        $pvp_producto[$contador_sub_productos] = 0;
                    }

                    $result_images = $conn->query("SELECT imagen,updated,alt,tittle FROM productos_images 
                                WHERE id_producto=" . $id_producto . " AND 
                                id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                                id_productos_detalles_multiples=" . $id_multiple . " AND 
                                id_packs=" . $id_pack . " AND 
                                activo=1 ORDER BY orden");
                    foreach ($result_images as $key_images => $valor_images) {
                        $images_producto[$contador_sub_productos] = stripslashes($valor_images['imagen']);
                        $images_updated_producto[$contador_sub_productos] = stripslashes($valor_images['updated']);
                        $images_alt_producto[$contador_sub_productos] = stripslashes($valor_images['alt']);
                        $images_tittle_producto[$contador_sub_productos] = stripslashes($valor_images['tittle']);
                    }

                    $result_productos_web_datos = $conn->query("SELECT id_observaciones FROM productos_web_datos 
                                WHERE id_producto=" . $id_producto . " AND 
                                id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                                id_productos_detalles_multiples=" . $id_multiple . " AND 
                                id_packs=" . $id_pack . " LIMIT 1");
                    if($conn->registros() == 1) {
                        $id_observaciones = $result_productos_web_datos[0]['id_observaciones'];
                        if(!empty($id_observaciones)) {
                            $result_observaciones = $conn->query("SELECT observacion FROM productos_observaciones 
                                WHERE id='" . $id_observaciones . "' LIMIT 1");
                            if ($conn->registros() == 1) {
                                $observaciones_producto[$contador_sub_productos] = nl2br(stripslashes($result_observaciones[0]['observacion']));
                            }
                        }
                    }

                    if(isset($id_librador) && isset($id_producto)) {
                        /* Obtener dato coste o importe por librador */
                        $result_coste_importe = $conn->query("SELECT coste_importe FROM libradores_productos 
                            WHERE id_librador='" . $id_librador . "' AND id_producto='" . $id_producto . "' LIMIT 1");
                        if ($conn->registros() == 1) {
                            if (!empty($result_coste_importe[0]['coste_importe'])) {
                                $pvp_producto[$contador_sub_productos] = $result_coste_importe[0]['coste_importe'];
                            }
                        }
                        /* Final obtener dato coste o importe por librador */
                    }

                    $contador_sub_productos += 1;
                }

                $h1 = stripslashes($result_producto[0]['descripcion']);
                $descripcion_producto = stripslashes($result_producto[0]['descripcion']);
                $tipo_producto = $result_producto[0]['tipo_producto'];
                $id_iva_producto = $result_producto[0]['id_iva'];
                $coste_producto_principal = $result_producto[0]['coste'];
                $imagen_producto = stripslashes($result_producto[0]['imagen']);
                $updated_producto = stripslashes($result_producto[0]['updated']);
                $alt_producto = stripslashes($result_producto[0]['alt']);
                $tittle_producto = stripslashes($result_producto[0]['tittle']);

                if(isset($id_librador) && isset($id_producto)) {
                    /* Obtener dato coste o importe por librador */
                    $result_coste_importe = $conn->query("SELECT coste_importe FROM libradores_productos 
                            WHERE id_librador='" . $id_librador . "' AND id_producto='" . $id_producto . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        if (!empty($result_coste_importe[0]['coste_importe'])) {
                            $coste_producto_principal = $result_coste_importe[0]['coste_importe'];
                        }
                    }
                    /* Final obtener dato coste o importe por librador */
                }

                $result_unidades = $conn->query("SELECT id,id_unidad,principal,conversion_principal FROM productos_unidades 
                            WHERE id_producto='" . $id_producto . "' AND activo=1");
                if ($conn->registros() >= 1) {
                    foreach ($result_unidades as $key_unidades => $valor_unidades) {
                        $result_unidad = $conn->query("SELECT unidad FROM unidades 
                            WHERE id='" . $valor_unidades['id_unidad'] . "' LIMIT 1");
                        if ($conn->registros() == 1) {
                            $id_unidades[] = $valor_unidades['id'];
                            $id_unidad_productos[] = $valor_unidades['id_unidad'];
                            $unidad_producto[] = stripslashes($result_unidad[0]['unidad']);
                            $unidad_principal_producto[] = $valor_unidades['principal'];
                            $conversion_unidad_producto[] = $valor_unidades['conversion_principal'];
                        }
                    }
                }

                $result_iva = $conn->query("SELECT iva,recargo FROM productos_iva 
                            WHERE id='" . $id_iva_producto . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $iva_producto = $result_iva[0]['iva'];
                    $recargo_producto = $result_iva[0]['recargo'];
                }

                $contador_atributos_unicos = 0;
                $result_detalles_unicos = $conn->query("SELECT id_atributo,id_dato FROM productos_detalles_unicos 
                            WHERE id_producto='" . $id_producto . "' AND activo=1");
                foreach ($result_detalles_unicos as $key_detalles_unicos => $valor_detalles_unicos) {
                    $de_sys = $valor_detalles_unicos['id_atributo'];
                    $select_sys = "detalle-de";
                    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
                    $descripcion_atributos_unicos_producto[$contador_atributos_unicos] = "<strong>".$detalle_de_productos_detalles.":</strong> ";
                    $de_sys = $valor_detalles_unicos['id_dato'];
                    $select_sys = "dato-de";
                    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
                    $descripcion_atributos_unicos_producto[$contador_atributos_unicos] .= $dato_de_productos_detalles;
                    $contador_atributos_unicos += 1;
                }
                /*
                $select_sys = "producto-datos";
                require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");
                */
                $lote_producto_stock = [];
                $caducidad_producto_stock = [];
                $coste_producto_stock = [];
                $stock_producto_stock = [];
                $querySql = "SELECT 
                            A.`lote` as lote,
                            A.`caducidad` as caducidad,
                            A.`coste` as coste,
                            CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock`
                        FROM 
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $id_producto_sys . " AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN
                            (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad_ventas FROM `documentos_".$ejercicio."_productos_sku_stock` WHERE id_producto=" . $id_producto_sys . " AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote
                        WHERE (`cantidad`-`cantidad_ventas` > 0 OR `cantidad_ventas` IS NULL);";
                $result_productos_sku_stock = $conn->query($querySql);
                $disponibilidad = array_filter($result_productos_sku_stock, function($item) {
                    return $item['stock'] > 0;
                });
                $disponibilidadStock = array_shift($disponibilidad);
                $producto_stock[0] = isset($disponibilidadStock['stock']) ? $disponibilidadStock['stock']  : 0 ;
                foreach ($result_productos_sku_stock as $key_result_productos_sku_stock => $value_result_productos_sku_stock) {
                    $lote_producto_stock[] = stripslashes($value_result_productos_sku_stock['lote']);
                    $caducidad_producto_stock[] = stripslashes($value_result_productos_sku_stock['caducidad']);
                    $coste_producto_stock[] = $value_result_productos_sku_stock['coste'];
                    $stock_producto_stock[] = number_format($value_result_productos_sku_stock['stock'], $decimales_cantidades, ".", "");
                }
            }
        }
        break;
    case "web-productos-buscar":
        if (empty($dato_buscar)) {
            break;
        }

        $producto_venta = "";
        if ($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $producto_venta = " AND productos.producto_venta=1";
        }

        if ($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $condicion_productos = " productos.activo=1 AND productos.producto_venta=1 AND productos_pvp.id_tarifa=" . $id_tarifa_web;
            $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos_web_datos,productos,productos_pvp 
                                            WHERE productos_web_datos.descripcion_url LIKE '%" . addslashes($dato_buscar) . "%' AND 
                                            productos.id=productos_web_datos.id_producto AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto=productos_web_datos.id_producto AND 
                                            productos_pvp.id_productos_detalles_enlazado=0 AND 
                                            productos_pvp.id_productos_detalles_multiples=0 AND 
                                            productos_pvp.id_packs=0  
                                            GROUP BY productos.id 
                                            ORDER BY " . $orden . " LIMIT " . $cadena_limite_inicial . "," . $cadena_limite_final);

            $contenidoBusqueda = explode('-', $dato_buscar);
            if (count($contenidoBusqueda) == 2 && strlen($contenidoBusqueda[1]) == '11') {
                $backup_dato_buscar = $dato_buscar;
                $dato_buscar = $contenidoBusqueda[1];
                $cantidad_buscar = $contenidoBusqueda[0];
            }

            if ($conn->registros() == 0) { // Buscamos por código de barras en productos_sku
                $result_categorias = $conn->query("SELECT id_producto,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs 
                                            FROM productos_sku 
                                            WHERE codigo_barras='" . addslashes($dato_buscar) . "' OR referencia='" . addslashes($dato_buscar) . "'");
                if ($conn->registros() >= 1) {
                    $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos,productos_pvp 
                                            WHERE productos.id='" . $result_categorias[0]['id_producto'] . "' AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto='" . $result_categorias[0]['id_producto'] . "' AND 
                                            productos_pvp.id_productos_detalles_enlazado=0 AND 
                                            productos_pvp.id_productos_detalles_multiples=0 AND 
                                            productos_pvp.id_packs=0   
                                            GROUP BY productos.id 
                                            ORDER BY " . $orden . " LIMIT " . $cadena_limite_inicial . "," . $cadena_limite_final);
                }
            }
            if ($conn->registros() == 0) { // Buscamos por código de barras en documentos_XXXX_productos_sku_stock
                $result_categorias = $conn->query("SELECT id_producto,lote FROM documentos_" . $ejercicio . "_productos_sku_stock 
                                            WHERE codigo_barras='" . addslashes($dato_buscar) . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $lote_encontrado_por_codigo_barras = stripslashes($result_categorias[0]['lote']);
                    $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos,productos_pvp   
                                            GROUP BY productos.id 
                                            WHERE productos.id='" . $result_categorias[0]['id_producto'] . "' AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto='" . $result_categorias[0]['id_producto'] . "' 
                                            ORDER BY " . $orden . " LIMIT " . $cadena_limite_inicial . "," . $cadena_limite_final);
                }
            }
        } else {
            $condicion_productos = " productos.activo=1";

            $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, productos.id AS id_producto,productos.descripcion,productos.imagen,
                                            productos.updated,productos.alt,productos.tittle,productos.id_iva,productos_pvp.pvp,
                                            productos_pvp.id_ofertas,productos_pvp.oferta_desde,productos_pvp.oferta_hasta,productos_pvp.pvp_oferta 
                                            FROM productos_web_datos,productos,productos_pvp 
                                            WHERE productos_web_datos.descripcion_url LIKE '%" . addslashes($dato_buscar) . "%' AND 
                                            productos.id=productos_web_datos.id_producto AND 
                                            " . $condicion_productos . " AND 
                                            productos_pvp.id_producto=productos_web_datos.id_producto  
                                            GROUP BY productos.id  
                                            ORDER BY " . $orden . " LIMIT " . $cadena_limite_inicial . "," . $cadena_limite_final);

            $contenidoBusqueda = explode('-', $dato_buscar);
            if (count($contenidoBusqueda) == 2 && strlen($contenidoBusqueda[1]) == '11') {
                $backup_dato_buscar = $dato_buscar;
                $dato_buscar = $contenidoBusqueda[1];
                $cantidad_buscar = $contenidoBusqueda[0];
            }

            if ($conn->registros() == 0) { // Buscamos por código de barras en productos_sku
                $result_categorias = $conn->query("SELECT id_producto,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs 
                                            FROM productos_sku 
                                            WHERE codigo_barras='" . addslashes($dato_buscar) . "' OR referencia='" . addslashes($dato_buscar) . "'");
                if ($conn->registros() >= 1) {
                    $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, id AS id_producto,descripcion,imagen,updated,alt,tittle,id_iva, coste 
                                            FROM productos 
                                            WHERE productos.id='" . $result_categorias[0]['id_producto'] . "' AND 
                                            " . $condicion_productos . " 
                                            ORDER BY " . $orden . " LIMIT " . $cadena_limite_inicial . "," . $cadena_limite_final);
                }
            }
            if ($conn->registros() == 0) { // Buscamos por código de barras en documentos_XXXX_productos_sku_stock
                $result_categorias = $conn->query("SELECT id_producto,lote FROM documentos_" . $ejercicio . "_productos_sku_stock 
                                            WHERE codigo_barras='" . addslashes($dato_buscar) . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $lote_encontrado_por_codigo_barras = stripslashes($result_categorias[0]['lote']);
                    $result_categorias = $conn->query("SELECT SQL_CALC_FOUND_ROWS COUNT(productos.id) AS numero_packs, productos.tipo_producto, id AS id_producto,descripcion,imagen,updated,alt,tittle,id_iva, coste 
                                            FROM productos 
                                            WHERE productos.id='" . $result_categorias[0]['id_producto'] . "' AND 
                                            " . $condicion_productos . " 
                                            ORDER BY " . $orden . " LIMIT " . $cadena_limite_inicial . "," . $cadena_limite_final);
                }
            }
        }

        if (isset($backup_dato_buscar)) {
            $dato_buscar = $backup_dato_buscar;
        }

        $productosEnLaCategoria = $conn->query("SELECT FOUND_ROWS();");
        $productosEnLaCategoria = $productosEnLaCategoria[0]["FOUND_ROWS()"];

        $productos_total = 0;

        if ($conn->registros() >= 1) {
            foreach ($result_categorias as $key_categorias => $valor_categorias) {
                $productos_total++;
                $result_primera_categoria = $conn->query("SELECT categorias.descripcion_url 
                           FROM categorias,productos_categorias WHERE 
                           productos_categorias.id_producto=" . $valor_categorias['id_producto'] . " AND 
                           productos_categorias.id_categoria=categorias.id LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_categoria_producto[$productos_mostrados] = $result_primera_categoria[0]['descripcion_url'];
                } else {
                    $descripcion_categoria_producto[$productos_mostrados] = $path_components[$indice_componente];
                }
                $result_productos_otros = $conn->query("SELECT url_externa,disponibilidad,profesionales,envio_gratis 
                           FROM productos_otros WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 AND 
                           disponibilidad<>0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $id_producto_mostrar[$productos_mostrados] = $valor_categorias['id_producto'];
                    $numero_packs[$productos_mostrados] = $valor_categorias['numero_packs'];
                    $tipo_producto_categorias[$productos_mostrados] = $valor_categorias['tipo_producto'];
                    $descripcion[$productos_mostrados] = stripslashes($valor_categorias['descripcion']);
                    $imagen[$productos_mostrados] = $valor_categorias['imagen'];
                    $updated[$productos_mostrados] = $valor_categorias['updated'];
                    $alt[$productos_mostrados] = stripslashes($valor_categorias['alt']);
                    $tittle[$productos_mostrados] = stripslashes($valor_categorias['tittle']);

                    $url_externa[$productos_mostrados] = stripslashes($result_productos_otros[0]['url_externa']);
                    $disponibilidad[$productos_mostrados] = $result_productos_otros[0]['disponibilidad'];
                    $profesionales[$productos_mostrados] = $result_productos_otros[0]['profesionales'];
                    $envio_gratis[$productos_mostrados] = $result_productos_otros[0]['envio_gratis'];

                    $result_iva = $conn->query("SELECT iva,recargo FROM productos_iva WHERE id='" . $valor_categorias['id_iva'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $iva[$productos_mostrados] = $result_iva[0]['iva'];
                        $recargo_sys[$productos_mostrados] = $result_iva[0]['recargo'];
                    }
                }

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           activo=1");
                if ($conn->registros() >= 1) {
                    foreach ($result_productos_packs as $key_productos_packs => $valor_productos_packs) {
                        $result_productos_otros = $conn->query("SELECT id FROM productos_otros WHERE 
                            id_producto=" . $valor_categorias['id_producto'] . " AND id_packs=" . $valor_productos_packs['id'] . " AND tienda=1 AND disponibilidad<>0 LIMIT 1");
                        if ($conn->registros() == 1) {
                            $packs_disponibles[$productos_mostrados] = true;
                            break;
                        }
                    }
                } else {
                    $packs_disponibles[$productos_mostrados] = false;
                }

                if ($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                    $pvp[$productos_mostrados] = $valor_categorias['pvp'];
                    $id_ofertas[$productos_mostrados] = $valor_categorias['id_ofertas'];
                    $oferta_desde[$productos_mostrados] = $valor_categorias['oferta_desde'];
                    $oferta_hasta[$productos_mostrados] = $valor_categorias['oferta_hasta'];
                    $pvp_oferta[$productos_mostrados] = $valor_categorias['pvp_oferta'];
                    if (!empty($valor_categorias['id_ofertas'])) {
                        $result_productos_web_datos = $conn->query("SELECT descripcion FROM ofertas WHERE 
                           id=" . $valor_categorias['id_ofertas'] . " LIMIT 1");
                        if ($conn->registros() == 1) {
                            $descripcion_ofertas[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion']);
                        }
                    }
                } else {
                    $coste[$productos_mostrados] = $valor_categorias['coste'];
                }

                if (isset($id_librador) && isset($valor_categorias['id_producto']) && isset($tipo_librador)) {
                    /* Obtener dato coste o importe por librador */
                    $result_coste_importe = $conn->query("SELECT coste_importe FROM libradores_productos 
                            WHERE id_librador='" . $id_librador . "' AND id_producto='" . $valor_categorias['id_producto'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        if (!empty($result_coste_importe[0]['coste_importe'])) {
                            if ($tipo_librador == 'pro' || $tipo_librador == 'cre') {
                                $coste[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            } else {
                                $pvp[$productos_mostrados] = $result_coste_importe[0]['coste_importe'];
                            }
                        }
                    }
                    /* Final obtener dato coste o importe por librador */
                }

                $result_productos_web_datos = $conn->query("SELECT descripcion_larga,descripcion_url FROM productos_web_datos WHERE 
                           id_producto=" . $valor_categorias['id_producto'] . " AND 
                           id_productos_detalles_enlazado=0 AND 
                           id_productos_detalles_multiples=0 AND 
                           id_packs=0 LIMIT 1");
                if ($conn->registros() == 1) {
                    $descripcion_larga[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_larga']);
                    $descripcion_url_mostrar[$productos_mostrados] = stripslashes($result_productos_web_datos[0]['descripcion_url']);
                }

                $querySql = "SELECT A.`lote` as lote, A.`caducidad` as caducidad, A.`coste` as coste, CASE WHEN `cantidad`-`cantidad_ventas` is NULL THEN `cantidad` ELSE `cantidad`-`cantidad_ventas` END as `stock` FROM (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad FROM `documentos_" . $ejercicio . "_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND (tipo_librador = 'pro' OR tipo_librador = 'ela' OR tipo_librador = '') AND (tipo_documento = 'tra' OR tipo_documento = 'reg' OR tipo_documento = 'alb' OR tipo_documento = 'fac' OR tipo_documento = 'tiq') GROUP BY `lote`) as A LEFT OUTER JOIN (SELECT id, lote, caducidad, coste, SUM(`cantidad`) as cantidad_ventas FROM `documentos_" . $ejercicio . "_productos_sku_stock` WHERE id_producto=" . $valor_categorias['id_producto'] . " AND tipo_librador <> 'pro' AND tipo_librador <> 'ela' AND tipo_documento <> 'tra' AND tipo_documento <> 'reg' AND tipo_documento <> 'ped' AND tipo_documento <> 'pre' GROUP BY `lote`) AS B ON A.lote = B.lote WHERE (`cantidad`-`cantidad_ventas` > 0 OR `cantidad_ventas` IS NULL);";
                $result_productos_sku_stock = $conn->query($querySql);
                $disponibilidad = array_filter($result_productos_sku_stock, function($item) {
                    return $item['stock'] > 0;
                });
                $disponibilidadStock = array_shift($disponibilidad);
                $producto_stock[$productos_mostrados] = isset($disponibilidadStock['stock']) ? $disponibilidadStock['stock']  : 0 ;
                $numero_de_lotes_activos[$productos_mostrados] = $conn->registros();

                $result_productos_enlazados = $conn->query("SELECT id FROM productos_detalles_enlazado WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_enlazados[$productos_mostrados] = $conn->registros();

                $result_productos_multiples = $conn->query("SELECT id FROM productos_detalles_multiples WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_multiples[$productos_mostrados] = $conn->registros();

                $result_productos_packs = $conn->query("SELECT id FROM productos_packs WHERE id_producto=" . $valor_categorias['id_producto'] . " LIMIT 1");
                $tiene_packs[$productos_mostrados] = $conn->registros();

                $productos_mostrados += 1;
            }
        }
    break;
}