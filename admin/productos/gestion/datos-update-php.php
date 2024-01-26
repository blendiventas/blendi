<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(!isset($logs_sys)) {
    $logs_sys = new stdClass();
}

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

function registroStock($datos, $decimales_cantidades, $decimales_importes, $id_producto_padre, $productos_anadidos, $recorrerRelacionados = false) {
    if (in_array($id_producto_padre . '-' . $datos['id_producto'], $productos_anadidos)) {
        return;
    }

    $productos_anadidos[] = $id_producto_padre . '-' . $datos['id_producto'];
    $id_producto_padre = $datos['id_producto'];

    $datos['id_productos_sku'] = (isset($datos['id_productos_sku']))? $datos['id_productos_sku'] : 0;
    $datos['lote_producto'] = (isset($datos['lote_producto']))? $datos['lote_producto'] : '';
    $datos['caducidad_producto'] = (isset($datos['caducidad_producto']))? $datos['caducidad_producto'] : '';
    $datos['numero_serie_producto'] = (isset($datos['numero_serie_producto']))? $datos['numero_serie_producto'] : '';
    $datos['sumar'] = (!isset($datos['sumar']))? 1 : $datos['sumar'];
    if(empty($datos['coste_producto_linea'])) {
        $result = $datos['conn']->query("SELECT coste FROM productos WHERE id = " . $datos['id_producto'] . " LIMIT 1");
        if ($datos['conn']->registros() == 1) {
            //$datos['coste_producto_linea'] = number_format(($result[0]['coste'] * $datos['cantidad']),$decimales_importes, ".", "");
            /* $datos['coste_producto_linea'] = number_format($result[0]['coste'],$decimales_importes, ".", ""); */
            $datos['coste_producto_linea'] = $result[0]['coste'];
        }
    }
    $datos['id_unidades'] = (isset($datos['id_unidades']))? $datos['id_unidades'] : 0;
    if(!empty($datos['id_unidades'])) {
        $result = $datos['conn']->query("SELECT abreviatura FROM unidades WHERE id = " . $datos['id_unidades'] . " LIMIT 1");
        if ($datos['conn']->registros() == 1) {
            $datos['unidad_producto'] = stripslashes($result[0]['abreviatura']);
        }
    }else {
        $datos['unidad_producto'] = (isset($datos['unidad_producto'])) ? $datos['unidad_producto'] : '';
    }
    if ($datos['sumar']) {
        $datos['importe'] = (isset($datos['importe']))? $datos['importe'] : 0;
    } else {
        $datos['importe'] = 0;
    }

    $result = $datos['conn']->query("INSERT INTO documentos_".$datos['ejercicio']."_productos_sku_stock VALUES(
       NULL,
       '".$datos['id_producto']."',
       '".$datos['id_productos_sku']."',
       '".$datos['lote_producto']."',
       '".$datos['caducidad_producto']."',
       '".$datos['numero_serie_producto']."',
       '',
       '".$datos['tipo_documento']."',
       '".date("Y-m-d")."',
       '".$datos['id_documento_1']."',
       '".$datos['id_documento_2']."',
       '".$datos['tipo_librador']."',
       '".$datos['id_librador']."',
       '".number_format($datos['coste_producto_linea'], $decimales_importes, ".", "")."',
       '".number_format($datos['cantidad'], $decimales_cantidades, ".", "")."',
       '".$datos['id_unidades']."',
       '".$datos['unidad_producto']."',
       '".number_format($datos['importe'], $decimales_importes, ".", "")."',
       '".date("Y-m-d")."',
       '".date("Y-m-d")."')");

    $id_productos_sku_stock_insert = $datos['conn']->id_insert();
    $codigo_barras = $id_productos_sku_stock_insert;
    if(strlen($codigo_barras) < 10) {
        $codigo_barras = str_repeat("0", 11 - strlen($codigo_barras)) . $codigo_barras;
    }
    $result_update_sku_stock = $datos['conn']->query("UPDATE documentos_".$datos['ejercicio']."_productos_sku_stock SET codigo_barras='" . addslashes($codigo_barras) . "' WHERE id=" . $id_productos_sku_stock_insert . " LIMIT 1");

    if ($recorrerRelacionados) {
        $productos_encontrados = [];
        $result = $datos['conn']->query("SELECT * FROM productos_relacionados WHERE id_producto = " . $datos['id_producto']);
        if($datos['conn']->registros() >= 1) {
            $productos_encontrados = $result;
        }
        $result = $datos['conn']->query("SELECT * FROM productos_relacionados_elaborados WHERE id_producto = " . $datos['id_producto']);
        if($datos['conn']->registros() >= 1) {
            $productos_encontrados = $result;
        }
        if($productos_encontrados) {
            $cantidad_producto_padre = $datos['cantidad'];
            for ($i = 0; $i < count($productos_encontrados); $i++) {
                if (isset($productos_encontrados[$i]['modelo']) && $productos_encontrados[$i]['modelo'] == 3) {
                    continue;
                }
                if (isset($productos_encontrados[$i]['por_defecto']) && $productos_encontrados[$i]['por_defecto'] == 2) {
                    continue;
                }
                if (isset($productos_encontrados[$i]['modelo'])) {
                    switch ($productos_encontrados[$i]['modelo']) {
                        case '0':
                        case '2':
                            $cantidad_por_defecto = $productos_encontrados[$i]['cantidad_con'];
                            break;
                        case '1':
                            if($productos_encontrados[$i]['por_defecto'] == 0) {
                                $cantidad_por_defecto = $productos_encontrados[$i]['cantidad_con'];
                            } else if ($productos_encontrados[$i]['por_defecto'] == 1) {
                                $cantidad_por_defecto = $productos_encontrados[$i]['cantidad_mitad'];
                            } else {
                                $cantidad_por_defecto = $productos_encontrados[$i]['cantidad_doble'];
                            }
                            break;
                        default:
                            $cantidad_por_defecto = 1;
                            break;
                    }
                    $datos['id_producto'] = $productos_encontrados[$i]['id_relacionado'];
                } else {
                    $cantidad_por_defecto = $productos_encontrados[$i]['cantidad'];
                    $datos['id_producto'] = $productos_encontrados[$i]['id_producto_relacionado'];
                }

                // Los productos relacionados no tienen lotes ni números de serie
                // o en todo caso se debería buscar pues no será el mismo que el producto principal
                $datos['lote_producto'] = "";
                $datos['caducidad_producto'] = "0000-00-00";
                $datos['numero_serie_producto'] = "";
                // También reseteamos el coste
                $datos['coste_producto_linea'] = 0;

                $datos['id_productos_detalles_enlazado'] = $productos_encontrados[$i]['id_productos_detalles_enlazado'];
                $datos['id_productos_detalles_multiples'] = $productos_encontrados[$i]['id_productos_detalles_multiples'];
                $datos['id_packs'] = $productos_encontrados[$i]['id_packs'];
                $datos['cantidad'] = $cantidad_producto_padre * $cantidad_por_defecto;
                if(isset($productos_encontrados[$i]['id_unidad'])) {
                    $datos['id_unidades'] = $productos_encontrados[$i]['id_unidad'];
                }
                registroStock($datos, $decimales_cantidades, $decimales_importes, $id_producto_padre, $productos_anadidos, true);
            }
        }
    }
}

function traspasarElaboradosACompuestos($id_productos, $conn) {
    $result = $conn->query("SELECT * FROM productos_relacionados_elaborados WHERE id_producto=" . $id_productos);
    $valoresAInsertar = [];
    if($conn->registros() >= 1) {
        foreach ($result as $key_productos_relacionados_elaborados => $valor_productos_relacionados_elaborados) {
            $valoresAInsertar[$key_productos_relacionados_elaborados]['id_productos_detalles_enlazado'] = $valor_productos_relacionados_elaborados['id_productos_detalles_enlazado'];
            $valoresAInsertar[$key_productos_relacionados_elaborados]['id_productos_detalles_multiples'] = $valor_productos_relacionados_elaborados['id_productos_detalles_multiples'];
            $valoresAInsertar[$key_productos_relacionados_elaborados]['id_packs'] = $valor_productos_relacionados_elaborados['id_packs'];
            $valoresAInsertar[$key_productos_relacionados_elaborados]['id_relacionado'] = $valor_productos_relacionados_elaborados['id_producto_relacionado'];
            $valoresAInsertar[$key_productos_relacionados_elaborados]['id_grupo'] = 0;
            $valoresAInsertar[$key_productos_relacionados_elaborados]['fijo'] = 0;
            $valoresAInsertar[$key_productos_relacionados_elaborados]['modelo'] = 4;
            $valoresAInsertar[$key_productos_relacionados_elaborados]['cantidad_con'] = $valor_productos_relacionados_elaborados['cantidad'];
            $valoresAInsertar[$key_productos_relacionados_elaborados]['cantidad_mitad'] = 0;
            $valoresAInsertar[$key_productos_relacionados_elaborados]['cantidad_sin'] = 0;
            $valoresAInsertar[$key_productos_relacionados_elaborados]['cantidad_doble'] = 0;
            /*for ($bucle_incrementos_tarifas = 0; $bucle_incrementos_tarifas < $incrementos_tarifas; $bucle_incrementos_tarifas++) {
                $sumar_incremento_tarifa = 0;
                $result_sumar_tarifas = $conn->query("SELECT sumar FROM productos_relacionados_elaborados_incre
                                    WHERE id_producto_rel=" . $valor_productos_relacionados_elaborados['id'] . " AND id_tarifa='" . $id_tarifas[$bucle_incrementos_tarifas] . "' LIMIT 1");

                if ($conn->registros() == 1) {
                    $sumar_incremento_tarifa = $result_sumar_tarifas[0]['sumar'];
                }
                $valoresAInsertar[0]['id_tarifa'][] = $id_tarifas[$bucle_incrementos_tarifas];
                $valoresAInsertar[$key_productos_relacionados_elaborados]['sumar_con'][] = $sumar_incremento_tarifa;
                $valoresAInsertar[$key_productos_relacionados_elaborados]['sumar_mitad'][] = 0;
                $valoresAInsertar[$key_productos_relacionados_elaborados]['sumar_sin'][] = 0;
                $valoresAInsertar[$key_productos_relacionados_elaborados]['sumar_doble'][] = 0;
            }*/
            $valoresAInsertar[$key_productos_relacionados_elaborados]['por_defecto'] = 0;
            $valoresAInsertar[$key_productos_relacionados_elaborados]['mostrar'] = 0;
            $valoresAInsertar[$key_productos_relacionados_elaborados]['orden'] = $valor_productos_relacionados_elaborados['orden'];
        }

        $result = $conn->query("DELETE FROM productos_relacionados_elaborados WHERE id_producto=" . $id_productos);
    }

    foreach ($valoresAInsertar as $valorAInsertar) {
        $result = $conn->query("INSERT INTO productos_relacionados VALUES(
                              NULL,
                              '" . $id_productos . "',
                              '" . $valorAInsertar['id_productos_detalles_enlazado'] . "',
                              '" . $valorAInsertar['id_productos_detalles_multiples'] . "',
                              '" . $valorAInsertar['id_packs'] . "',
                              '" . $valorAInsertar['id_relacionado'] . "',
                              '" . $valorAInsertar['id_grupo'] . "',
                              '" . $valorAInsertar['fijo'] . "',
                              '" . $valorAInsertar['modelo'] . "',
                              '" . $valorAInsertar['cantidad_con'] . "',
                              '" . $valorAInsertar['cantidad_mitad'] . "',
                              '" . $valorAInsertar['cantidad_sin'] . "',
                              '" . $valorAInsertar['cantidad_doble'] . "',
                              '',
                              '" . $valorAInsertar['por_defecto'] . "',
                              '" . $valorAInsertar['mostrar'] . "',
                              '" . $valorAInsertar['orden'] . "')");

        /*$new_id_productos_relacionados = $conn->id_insert();

        foreach ($valorAInsertar['id_tarifa'] as $key_valoresAInsertar => $valor_valoresAInsertar) {
            $result = $conn->query("INSERT INTO productos_relacionados_incre VALUES(
                              NULL,
                              '" . $new_id_productos_relacionados . "',
                              '" . $valoresAInsertar['id_tarifa'][$key_valoresAInsertar] . "',
                              '" . $valorAInsertar['sumar_con'][$key_valoresAInsertar] . "',
                              '" . $valorAInsertar['sumar_mitad'][$key_valoresAInsertar] . "',
                              '" . $valorAInsertar['sumar_sin'][$key_valoresAInsertar] . "',
                              '" . $valorAInsertar['sumar_doble'][$key_valoresAInsertar] . "')");
        }*/
    }

    $result = $conn->query("UPDATE productos SET 
                                  tipo_producto='2' 
                                  WHERE id=".$id_productos." LIMIT 1");
}

function eliminarRelacionados($id_titulo, $conn) {
    $result_titulo = $conn->query("SELECT * FROM productos_titulos WHERE id=" . $id_titulo . " ORDER BY orden ASC");
    if ($conn->registros() >= 1) {
        $id_producto = $result_titulo[0]['id_producto'];
        $result_titulos = $conn->query("SELECT * FROM productos_titulos_relacionados WHERE id_productos_titulos=" . $id_titulo . " ORDER BY orden ASC");
        if ($conn->registros() >= 1) {
            foreach ($result_titulos as $titulo) {
                $result_productos_relacionados = $conn->query("SELECT * FROM productos_relacionados WHERE id_producto=" . $id_producto ." AND id_relacionado=" . $titulo['id_producto']);
                if ($conn->registros() >= 1) {
                    $query = "DELETE FROM productos_relacionados_incre WHERE id_producto_rel=" . $result_productos_relacionados[0]['id'];;
                    $result = $conn->query($query);
                }

                $query = "DELETE FROM productos_relacionados WHERE id_producto=" . $id_producto ." AND id_relacionado=" . $titulo['id_producto'];
                $result = $conn->query($query);
            }
            $query = "DELETE FROM productos_titulos_relacionados WHERE id_productos_titulos=" . $id_titulo;
            $result = $conn->query($query);
        }
    }
}

function slugify($text, string $divider = '-')
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activo FROM productos WHERE id=" . $id_productos . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_w = 1;
            } else {
                $valor_w = 0;
            }
            $result = $conn->query("UPDATE productos SET activo=" . $valor_w . " WHERE id=" . $id_productos . " LIMIT 1");
            $logs_sys->estado = "UPDATE productos SET activo=" . $valor_w . " WHERE id=" . $id_productos . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_w
                ]);
            }
            break;
        case "estado-enlazado":
            $result = $conn->query("SELECT activo FROM productos_detalles_enlazado WHERE id=" . $id_productos_enlazados . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_w = 1;
            } else {
                $valor_w = 0;
            }
            $result = $conn->query("UPDATE productos_detalles_enlazado SET activo=" . $valor_w . " WHERE id=" . $id_productos_enlazados . " LIMIT 1");
            $logs_sys->estado = "UPDATE productos_detalles_enlazado SET activo=" . $valor_w . " WHERE id=" . $id_productos_enlazados . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_w
                ]);
            }
            break;
        case "guardar":
            $logs_sys->Id_productos = $id_productos;
            if(empty($id_productos)) {
                if(!empty($descripcion_productos)) {
                    $logs_sys->Insert_productos = "INSERT INTO productos VALUES(
                                    NULL,
                                    '".$id_idioma_productos."',
                                    '".addslashes($descripcion_productos)."',
                                    '".$tipo_producto_productos."',
                                    '".$producto_venta_productos."',
                                    '".$id_iva_productos."',
                                    0,
                                    0,
                                    0,
                                    '',
                                    '',
                                    '',
                                    '',
                                    '".$activo."',
                                    '".date("Y-m-d")."',
                                    '".date("Y-m-d")."')<br />";
                    $result = $conn->query("INSERT INTO productos VALUES(
                                    NULL,
                                    '".$id_idioma_productos."',
                                    '".addslashes($descripcion_productos)."',
                                    '".$tipo_producto_productos."',
                                    '".$producto_venta_productos."',
                                    '".$id_iva_productos."',
                                    0,
                                    0,
                                    0,
                                    '',
                                    '',
                                    '',
                                    '',
                                    '".$activo."',
                                    '".date("Y-m-d")."',
                                    '".date("Y-m-d")."')");

                    $id_productos = $conn->id_insert();

                    $result = $conn->query("INSERT INTO productos_otros VALUES(
                            NULL,
                            '".$id_productos."',
                            '0',
                            '0',
                            '0',
                            '".$control_stock."',
                            '1',
                            '',
                            '1',
                            '".date("Y-m-d")."',
                            '".$enviar_productos."',
                            '1',
                            '0',
                            '0',
                            '1',
                            '0',
                            '0',
                            '0',
                            '0',
                            '0')");

                    $descripcion_url = slugify($descripcion_productos) . '_' . $id_productos;
                    $result = $conn->query("INSERT INTO productos_web_datos VALUES(
                            NULL,
                            '".$id_productos."',
                            '0',
                            '0',
                            '0',
                            '".addslashes($descripcion_productos)."',
                            '".addslashes($descripcion_url)."',
                            '".addslashes($descripcion_productos)."',
                            '".addslashes($descripcion_productos)."',
                            '0',
                            '".date("Y-m-d")."',
                            '".date("Y-m-d")."')");

                    foreach ($id_categoria_productos_categorias as $key_categorias => $valor_categorias) {
                        $result = $conn->query("INSERT INTO productos_categorias VALUES(
                                    NULL,
                                    '" . $valor_categorias . "',
                                    '" . $id_productos . "',
                                    '" . addslashes($orden_productos_categorias[$key_categorias]) . "',
                                    '" . date("Y-m-d") . "',
                                    '" . date("Y-m-d") . "')");
                    }
                    /*
                    $result = $conn->query("INSERT INTO productos_unidades VALUES(
                                NULL,
                                '" . $id_unidades . "',
                                '" . $id_productos . "',
                                '1',
                                '1',
                                '1',
                                '" . date("Y-m-d") . "',
                                '" . date("Y-m-d") . "')");
                    */
                    $result = $conn->query("INSERT INTO productos_unidades VALUES(
                                NULL,
                                '0',
                                '" . $id_productos . "',
                                '1',
                                '1',
                                '1',
                                '" . date("Y-m-d") . "',
                                '" . date("Y-m-d") . "')");
                    /*
                    CREATE TABLE `productos_costes` (
                        `id` INT(11) NOT NULL AUTO_INCREMENT,
                        `id_producto` INT(11) NOT NULL,
                        `cantidad_base` DOUBLE(9,3) NULL DEFAULT NULL,
                        `id_unidades_base` INT(11) NULL DEFAULT NULL,
                        `rentabilidad` DOUBLE(9,3) NULL DEFAULT NULL,
                        `tiempo` INT(10) NULL DEFAULT NULL,
                        `id_categoria_elaborados` INT(11) NULL DEFAULT NULL,
                    */
                    $result = $conn->query("INSERT INTO productos_costes VALUES(
                                NULL,
                                '" . $id_productos . "',
                                '0',
                                '" . $id_unidades . "',
                                '0',
                                '0',
                                '" . $id_categoria_elaborados_productos_elaborados . "')");

                    $select_sys = "guardar-base";
                    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/pvp/gestion/datos-update-php.php");
                    $resultado_sys = "INSERT";
                }else {
                    $id_productos = 0;
                    $resultado_sys = "INSERT ERROR descripcion";
                }
            }else {
                if(empty($apartado_url) OR $apartado_url == "null") {
                    $logs_sys->Update_basico1 = "UPDATE productos SET id_idioma='".$id_idioma_productos."',descripcion='".addslashes($descripcion_productos)."',tipo_producto='".$tipo_producto_productos."',producto_venta='".$producto_venta_productos."',id_iva='".$id_iva_productos."' WHERE id=".$id_productos." LIMIT 1<br />";
                    $result = $conn->query("UPDATE productos SET 
                                    id_idioma='".$id_idioma_productos."',
                                    descripcion='".addslashes($descripcion_productos)."',
                                    tipo_producto='".$tipo_producto_productos."',
                                    producto_venta='".$producto_venta_productos."',
                                    id_iva='".$id_iva_productos."',
                                    activo='".$activo."' WHERE id=".$id_productos." LIMIT 1");

                    $result = $conn->query("UPDATE productos_otros SET control_stock='".$control_stock."' WHERE id=".$id_productos);

                    if (!empty($descripcion_url_productos)) {
                        $descripcion_url = slugify($descripcion_url_productos);
                    } else {
                        $descripcion_url = slugify($descripcion_productos);
                    }
                    $result = $conn->query("UPDATE productos_web_datos SET 
                            descripcion_url='".addslashes($descripcion_url)."',
                            fecha_modificacion='".date("Y-m-d")."' 
                            WHERE id_producto=".$id_productos);

                    $result_productos_categorias = $conn->query("SELECT id,id_categoria FROM productos_categorias WHERE id_producto=".$id_productos);
                    foreach ($result_productos_categorias as $key_productos_categorias => $valor_productos_categorias) {
                        $existe = false;
                        foreach ($id_categoria_productos_categorias as $key_categorias => $valor_categorias) {
                            if($valor_productos_categorias['id_categoria'] == $valor_categorias) {
                                $existe = true;
                            }
                        }
                        if(!$existe) {
                            $logs_sys->Update_basico2 = "DELETE FROM productos_categorias WHERE id=".$valor_productos_categorias['id']." LIMIT 1<br />";
                            $result = $conn->query("DELETE FROM productos_categorias WHERE id=".$valor_productos_categorias['id']." LIMIT 1");
                        }
                    }
                    foreach ($id_categoria_productos_categorias as $key_categorias => $valor_categorias) {
                        $result_productos_categorias = $conn->query("SELECT id FROM productos_categorias 
                            WHERE id_categoria=" . $valor_categorias . " AND id_producto=".$id_productos." LIMIT 1");
                        if($conn->registros() == 1) {
                            $logs_sys->Update_basico7 = "UPDATE productos_categorias SET descripcion_larga='" . addslashes($descripcion_larga_productos_categorias[$key_categorias]) . "',descripcion_url='" . addslashes($descripcion_url_productos_categorias[$key_categorias]) . "',titulo_meta='" . addslashes($titulo_meta_productos_categorias[$key_categorias]) . "',descripcion_meta='" . addslashes($descripcion_meta_productos_categorias[$key_categorias]) . "',orden='" . addslashes($orden_productos_categorias[$key_categorias]) . "',id_observaciones='" . $id_observaciones_productos_categorias[$key_categorias] . "',activo='" . $activo_productos_categorias[$key_categorias] . "',fecha_modificacion='" . date("Y-m-d") . "' WHERE id=".$result_productos_categorias[0]['id']." LIMIT 1<br />";
                            $result = $conn->query("UPDATE productos_categorias SET 
                                    orden='" . addslashes($orden_productos_categorias[$key_categorias]) . "',
                                    activo='" . $activo_productos_categorias[$key_categorias] . "',
                                    fecha_modificacion='" . date("Y-m-d") . "' WHERE id=".$result_productos_categorias[0]['id']." LIMIT 1");
                        }else {
                            $logs_sys->Update_basico8 = "INSERT INTO productos_categorias VALUES(NULL,'" . $valor_categorias . "','" . $id_productos . "','" . addslashes($descripcion_larga_productos_categorias[$key_categorias]) . "','" . addslashes($descripcion_url_productos_categorias[$key_categorias]) . "','" . addslashes($titulo_meta_productos_categorias[$key_categorias]) . "','" . addslashes($descripcion_meta_productos_categorias[$key_categorias]) . "','" . addslashes($orden_productos_categorias[$key_categorias]) . "','" . $id_observaciones_productos_categorias[$key_categorias] . "','" . $activo_productos_categorias[$key_categorias] . "','" . date("Y-m-d") . "','" . date("Y-m-d") . "')<br />";
                            $result = $conn->query("INSERT INTO productos_categorias VALUES(
                                    NULL,
                                    '" . $valor_categorias . "',
                                    '" . $id_productos . "',
                                    '" . addslashes($orden_productos_categorias[$key_categorias]) . "',
                                    '" . date("Y-m-d") . "',
                                    '" . date("Y-m-d") . "')");
                        }
                    }

                    /* $id_productos_unidades = filter_input(INPUT_POST, 'id_productos_unidades', FILTER_SANITIZE_NUMBER_INT); */
                    /*
                    $id_unidades = filter_input(INPUT_POST, 'id_unidades', FILTER_SANITIZE_NUMBER_INT);
                    $result = $conn->query("SELECT id FROM  productos_unidades WHERE id_producto=".$id_productos." AND principal=1 LIMIT 1");
                    if($conn->registros() == 1) {
                        $result = $conn->query("UPDATE productos_unidades SET 
                                    id_unidad='" . $id_unidades . "',
                                    activo='1',
                                    fecha_modificacion='" . date("Y-m-d") . "' WHERE id=".$result[0]['id']." LIMIT 1)");
                    }else {
                        $result = $conn->query("INSERT INTO productos_unidades VALUES(
                                    NULL,
                                    '" . $id_unidades . "',
                                    '" . $id_productos . "',
                                    '1',
                                    '1',
                                    '1',
                                    '" . date("Y-m-d") . "',
                                    '" . date("Y-m-d") . "')");
                    }
                    */
                    /*
                    CREATE TABLE `productos_costes` (
                        `id` INT(11) NOT NULL AUTO_INCREMENT,
                        `id_producto` INT(11) NOT NULL,
                        `cantidad_base` DOUBLE(9,3) NULL DEFAULT NULL,
                        `id_unidades_base` INT(11) NULL DEFAULT NULL,
                        `rentabilidad` DOUBLE(9,3) NULL DEFAULT NULL,
                        `tiempo` INT(10) NULL DEFAULT NULL,
                        `id_categoria_elaborados` INT(11) NULL DEFAULT NULL,
                    */
                    $result = $conn->query("UPDATE productos_costes SET 
                                id_categoria_elaborados='" . $id_categoria_elaborados_productos_elaborados . "' 
                                WHERE id_producto='" . $id_productos . "' LIMIT 1");

                    $select_sys = "guardar-base";
                    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/pvp/gestion/datos-update-php.php");
                    $resultado_sys = "UPDATE";
                }elseif($apartado_url == "costes") {
                    $logs_sys->update_costes = "UPDATE productos SET coste='" . $coste . "', peso_bruto='" . $peso_bruto . "', peso_neto='" . $peso_neto . "' WHERE id=" . $id_productos . " LIMIT 1<br />";
                    $result = $conn->query("UPDATE productos SET 
                        coste='" . $coste . "',
                        peso_bruto='" . $peso_bruto . "',
                        peso_neto='" . $peso_neto . "' 
                        WHERE id=" . $id_productos . " LIMIT 1");
                    $resultado_sys = "UPDATE";
                }elseif($apartado_url == "propiedades") {
                    $result = $conn->query("SELECT disponibilidad FROM productos WHERE id=" . $id_productos . " LIMIT 1");
                    if ($result[0]['disponibilidad'] != $disponibilidad_productos) {
                        $logs_sys->Update_disponibilidad_propiedades = "UPDATE productos SET fecha_disponibilidad ='" . date("Y-m-d") . "' WHERE id=" . $id_productos . " LIMIT 1<br />";
                        $result = $conn->query("UPDATE productos SET 
                            fecha_disponibilidad ='" . date("Y-m-d") . "' 
                            WHERE id=" . $id_productos . " LIMIT 1");
                    }
                    $logs_sys->Update_propiedades = "UPDATE productos SET tipo_producto='" . $tipo_producto_productos . "',producto_venta='".$producto_venta_productos."',disponibilidad='" . $disponibilidad_productos . "',fecha_modificacion='" . date("Y-m-d") . "' WHERE id=" . $id_productos . " LIMIT 1<br />";
                    $result = $conn->query("UPDATE productos SET 
                        tipo_producto='" . $tipo_producto_productos . "',
                        producto_venta='".$producto_venta_productos."',
                        fecha_modificacion='" . date("Y-m-d") . "' 
                        WHERE id=" . $id_productos . " LIMIT 1");

                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-update-php.php");
                    $resultado_sys = "UPDATE";
                }elseif($apartado_url == "imagen") {
                    $logs_sys->Update_imagen = "UPDATE productos SET alt='" . addslashes($alt_productos) . "', tittle='" . addslashes($tittle_productos) . "' WHERE id=" . $id_productos . " LIMIT 1<br />";
                    $result = $conn->query("UPDATE productos SET 
                      alt='" . addslashes($alt_productos) . "', 
                      tittle='" . addslashes($tittle_productos) . "' 
                      WHERE id=" . $id_productos . " LIMIT 1");
                    $resultado_sys = "UPDATE";
                }elseif($apartado_url == "web") {
                    $descripcion_url_productos = slugify($descripcion_url_productos);
                    if(empty($id_productos_web_datos)) {
                        $descripcion_url_productos .= '_' . $id_productos;
                        $logs_sys->Insert_web = "INSERT INTO productos_web_datos VALUES(NULL,'".$id_productos."',`id_productos_detalles_enlazado` INT(11) NOT NULL DEFAULT '0',`id_productos_detalles_multiples` INT(11) NOT NULL DEFAULT '0',`id_packs` INT(11) NOT NULL DEFAULT '0','".addslashes($descripcion_larga_productos)."','".addslashes($descripcion_url_productos)."','".addslashes($titulo_meta_productos)."','".addslashes($descripcion_meta_productos)."','0','".date("Y-m-d")."','".date("Y-m-d")."')<br />";
                        $result = $conn->query("INSERT INTO productos_web_datos VALUES(
                            NULL,
                            '".$id_productos."',
                            '".$id_enlazado."',
                            '".$id_multiple."',
                            '".$id_pack."',
                            '".addslashes($descripcion_larga_productos)."',
                            '".addslashes($descripcion_url_productos)."',
                            '".addslashes($titulo_meta_productos)."',
                            '".addslashes($descripcion_meta_productos)."',
                            '0',
                            '".date("Y-m-d")."',
                            '".date("Y-m-d")."')");
                        $resultado_sys = "INSERT";
                    }else {
                        $logs_sys->Update_web = "UPDATE productos_web_datos SET descripcion_larga='".addslashes($descripcion_larga_productos)."',descripcion_url='".addslashes($descripcion_url_productos)."',titulo_meta='".addslashes($titulo_meta_productos)."',descripcion_meta='".addslashes($descripcion_meta_productos)."',fecha_modificacion='".date("Y-m-d")."' WHERE id=" . $id_productos_web_datos . " LIMIT 1<br />";
                        $result = $conn->query("UPDATE productos_web_datos SET 
                        descripcion_larga='".addslashes($descripcion_larga_productos)."',
                        descripcion_url='".addslashes($descripcion_url_productos)."',
                        titulo_meta='".addslashes($titulo_meta_productos)."',
                        descripcion_meta='".addslashes($descripcion_meta_productos)."',
                        fecha_modificacion='".date("Y-m-d")."' 
                        WHERE id=" . $id_productos_web_datos . " LIMIT 1");
                        $resultado_sys = "UPDATE";
                    }
                    if(empty($id_productos_otros)) {
                        $logs_sys->Insert_web = "INSERT INTO productos_otros VALUES(NULL,'".$id_productos."','".$id_enlazado."','".$id_multiple."','".$id_pack."','0','0','".$tienda_productos."','".addslashes($url_externa_productos)."','0','".date("Y-m-d")."','0','0','0','0','1','".$gastos_productos."','".$envio_gratis_productos."','".$dias_entrega."','0','0')<br />";
                        $result = $conn->query("INSERT INTO productos_otros VALUES(
                            NULL,
                            '".$id_productos."',
                            '".$id_enlazado."',
                            '".$id_multiple."',
                            '".$id_pack."',
                            '0',
                            '".$tienda_productos."',
                            '".addslashes($url_externa_productos)."',
                            '1',
                            '".date("Y-m-d")."',
                            '0',
                            '1',
                            '0',
                            '0',
                            '1',
                            '".$gastos_productos."',
                            '".$envio_gratis_productos."',
                            '".$dias_entrega."',
                            '0',
                            '0')");
                        $resultado_sys = "INSERT";
                    }else {
                        $logs_sys->Update_web = "UPDATE productos_otros SET tienda='".$tienda_productos."',url_externa='".addslashes($url_externa_productos)."',fecha_modificacion='".date("Y-m-d")."',gastos='".$gastos_productos."',envio_gratis='".$envio_gratis_productos."',dias_entrega='".$dias_entrega."' WHERE id=" . $id_productos_otros . " LIMIT 1<br />";
                        $result = $conn->query("UPDATE productos_otros SET 
                        tienda='".$tienda_productos."',
                        url_externa='".addslashes($url_externa_productos)."',
                        fecha_modificacion='".date("Y-m-d")."',
                        gastos='".$gastos_productos."',
                        envio_gratis='".$envio_gratis_productos."',
                        dias_entrega='".$dias_entrega."' 
                        WHERE id=" . $id_productos_otros . " LIMIT 1");
                        $resultado_sys = "UPDATE";
                    }
                }elseif($apartado_url == "referencias") {
                    if(empty($id_productos_referencia_datos)) {
                        $logs_sys->Insert_referencia = "INSERT INTO productos_sku VALUES(NULL,'".$id_productos."','".$id_enlazado."','".$id_multiple."','".$id_pack."','".addslashes($codigo_barras)."','".addslashes($referencia)."','0','".date("Y-m-d")."','".date("Y-m-d")."')<br />";
                        $result = $conn->query("INSERT INTO productos_sku VALUES(
                            NULL,
                            '".$id_productos."',
                            '".$id_enlazado."',
                            '".$id_multiple."',
                            '".$id_pack."',
                            '".addslashes($codigo_barras)."',
                            '".addslashes($referencia)."',
                            '0',
                            '".date("Y-m-d")."',
                            '".date("Y-m-d")."')");
                        $resultado_sys = "INSERT";
                    }else {
                        $logs_sys->Update_referencia = "UPDATE productos_sku SET codigo_barras='".addslashes($codigo_barras)."',referencia='".addslashes($referencia)."',fecha_modificacion='".date("Y-m-d")."' WHERE id=" . $id_productos_referencia_datos . " LIMIT 1<br />";
                        $result = $conn->query("UPDATE productos_sku SET 
                        codigo_barras='".addslashes($codigo_barras)."',
                        referencia='".addslashes($referencia)."',
                        fecha_modificacion='".date("Y-m-d")."' 
                        WHERE id=" . $id_productos_referencia_datos . " LIMIT 1");
                        $resultado_sys = "UPDATE";
                    }
                }elseif($apartado_url == "otros") {
                    $logs_sys->valor1 = "Id_productos_otros_datos: ".$id_productos_otros_datos;
                    if(empty($id_productos_otros_datos)) {
                        $logs_sys->Insert_otros = "INSERT INTO productos_otros VALUES(NULL,'".$id_productos."','".$id_enlazado."','".$id_multiple."','".$id_pack."','0','0','1','','".$disponibilidad_productos."','".date("Y-m-d")."','".$enviar_productos."','".$manual_productos."','".$profesionales_productos."','".$peso_productos."','".$bultos_productos."','0','0','".$aplicar_descuento_productos."','".$descuento_maximo_productos."')<br />";
                        $result = $conn->query("INSERT INTO productos_otros VALUES(
                            NULL,
                            '".$id_productos."',
                            '".$id_enlazado."',
                            '".$id_multiple."',
                            '".$id_pack."',
                            '0',
                            '1',
                            '',
                            '".$disponibilidad_productos."',
                            '".date("Y-m-d")."',
                            '".$enviar_productos."',
                            '".$manual_productos."',
                            '".$profesionales_productos."',
                            '".$peso_productos."',
                            '".$bultos_productos."',
                            '0',
                            '0',
                            '0',
                            '".$aplicar_descuento_productos."',
                            '".$descuento_maximo_productos."')");

                        if(!empty($observacion_productos)) {
                            $result = $conn->query("INSERT INTO productos_observaciones VALUES(NULL,'" . addslashes($observacion_productos) . "')");
                        }
                        $resultado_sys = "INSERT";
                    }else {
                        //$logs_sys->Update_otros = "UPDATE productos_otros SET disponibilidad='" . $disponibilidad_productos . "', fecha_modificacion='" . date("Y-m-d") . "', enviar='" . $enviar_productos . "', manual='" . $manual_productos . "', profesionales='" . $profesionales_productos . "', peso='" . $peso_productos . "', bultos='" . $bultos_productos . "', aplicar_descuento='" . $aplicar_descuento_productos . "', descuento_maximo='" . $descuento_maximo_productos . "' WHERE id=" . $id_productos_otros_datos . " LIMIT 1<br />";
                        $result = $conn->query("UPDATE productos_otros SET 
                          disponibilidad='" . $disponibilidad_productos . "', 
                          fecha_modificacion='" . date("Y-m-d") . "', 
                          enviar='" . $enviar_productos . "', 
                          manual='" . $manual_productos . "', 
                          profesionales='" . $profesionales_productos . "', 
                          peso='" . $peso_productos . "', 
                          bultos='" . $bultos_productos . "', 
                          aplicar_descuento='" . $aplicar_descuento_productos . "', 
                          descuento_maximo='" . $descuento_maximo_productos . "' 
                          WHERE id=" . $id_productos_otros_datos . " LIMIT 1");

                        /*
                        $id_observaciones_productos
                        $observacion_productos
                            CREATE TABLE `productos_observaciones` (
                                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                                `observacion` TEXT NOT NULL COLLATE 'utf8_spanish_ci',
                        */
                        if(empty($id_observaciones_productos)) {
                            if(!empty($observacion_productos)) {
                                /*
                                CREATE TABLE `productos_web_datos` (
                                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                                    `id_producto` INT(11) NOT NULL DEFAULT '0',
                                    `id_productos_detalles_enlazado` INT(11) NOT NULL DEFAULT '0',
                                    `id_productos_detalles_multiples` INT(11) NOT NULL DEFAULT '0',
                                    `id_packs` INT(11) NOT NULL DEFAULT '0',
                                    `id_observaciones` INT(11) NOT NULL DEFAULT '0',
                                    `fecha_alta` DATE NULL DEFAULT NULL,
                                    `fecha_modificacion` DATE NULL DEFAULT NULL,
                                */
                                $logs_sys->insert_obs = "INSERT INTO productos_observaciones VALUES(NULL,'" . addslashes($observacion_productos) . "')<br />";
                                $result = $conn->query("INSERT INTO productos_observaciones VALUES(NULL,'" . addslashes($observacion_productos) . "')");
                                $id_observaciones_productos = $conn->id_insert();
                                $logs_sys->update_obs1 = "UPDATE productos_web_datos SET id_observaciones=".$id_observaciones_productos."<br />";
                                $logs_sys->update_obs2 = "WHERE id_producto='".$id_productos."' AND id_productos_detalles_enlazado='".$id_enlazado."' AND id_productos_detalles_multiples='".$id_multiple."' AND id_packs='".$id_pack."' LIMIT 1<br />";
                                $result = $conn->query("UPDATE productos_web_datos SET id_observaciones=".$id_observaciones_productos." 
                                        WHERE id_producto='".$id_productos."' AND 
                                        id_productos_detalles_enlazado='".$id_enlazado."' AND 
                                        id_productos_detalles_multiples='".$id_multiple."' AND 
                                        id_packs='".$id_pack."' LIMIT 1");
                            }
                        }else {
                            if(!empty($observacion_productos)) {
                                $logs_sys->update_obs = "UPDATE productos_observaciones SET observacion='".addslashes($observacion_productos)."' WHERE id=".$id_observaciones_productos." LIMIT 1<br />";
                                $result = $conn->query("UPDATE productos_observaciones SET observacion='".addslashes($observacion_productos)."' 
                                            WHERE id=".$id_observaciones_productos." LIMIT 1");
                            }else {
                                $logs_sys->update_obs = "UPDATE productos_web_datos SET id_observaciones=0 WHERE id_producto='".$id_productos."' AND id_productos_detalles_enlazado='".$id_enlazado."' AND id_productos_detalles_multiples='".$id_multiple."' AND id_packs='".$id_pack."' LIMIT 1<br />";
                                $logs_sys->delete_obs = "DELETE FROM productos_observaciones WHERE id=".$id_observaciones_productos." LIMIT 1<br />";
                                $result = $conn->query("UPDATE productos_web_datos SET id_observaciones=0 
                                        WHERE id_producto='".$id_productos."' AND 
                                        id_productos_detalles_enlazado='".$id_enlazado."' AND 
                                        id_productos_detalles_multiples='".$id_multiple."' AND 
                                        id_packs='".$id_pack."' LIMIT 1");
                                $result = $conn->query("DELETE FROM productos_observaciones WHERE id=".$id_observaciones_productos." LIMIT 1");
                            }
                        }
                        $resultado_sys = "UPDATE";
                    }
                }elseif($apartado_url == "control_stock") {
                    if(empty($id_productos)) {
                        $result = $conn->query("INSERT INTO productos_otros VALUES(
                            NULL,
                            '".$id_productos."',
                            '".$id_enlazado."',
                            '".$id_multiple."',
                            '".$id_pack."',
                            '".$control_stock."',
                            '1',
                            '',
                            '1',
                            '".date("Y-m-d")."',
                            '0',
                            '1',
                            '0',
                            '0',
                            '1',
                            '0',
                            '0',
                            '0',
                            '0',
                            '0')");
                        $resultado_sys = "INSERT";
                    }else {
                        $result = $conn->query("UPDATE productos_otros SET 
                          control_stock='" . $control_stock . "' 
                          WHERE id_producto=" . $id_productos . " LIMIT 1");
                        $resultado_sys = "UPDATE";
                    }
                    $apartado_url = "stock";
                }elseif($apartado_url == "stock" || $apartado_url == "elaboracion") {
                    $logs_sys->valor1 = "idProductoProductosSku: ".$idProductoProductosSku;
                    if(empty($id_productos_otros)) {
                        $result = $conn->query("INSERT INTO productos_otros VALUES(
                            NULL,
                            '".$id_productos."',
                            '".$id_enlazado."',
                            '".$id_multiple."',
                            '".$id_pack."',
                            '1',
                            '1',
                            '" . $control_stock . "',
                            '1',
                            '".date("Y-m-d")."',
                            '0',
                            '1',
                            '0',
                            '0',
                            '1',
                            '0',
                            '0',
                            '0',
                            '0',
                            '0')");
                        $resultado_sys = "INSERT";
                    }else {
                        $logs_sys->valor1 = "UPDATE productos_otros SET control_stock='1' WHERE id=" . $id_productos_otros . " LIMIT 1";
                        $result = $conn->query("UPDATE productos_otros SET 
                          control_stock='1' 
                          WHERE id=" . $id_productos_otros . " LIMIT 1");
                        $resultado_sys = "UPDATE";
                    }

                    if(empty($idProductoProductosSku)) {
                        /*
                        CREATE TABLE `productos_sku` (
                            `id` INT(11) NOT NULL AUTO_INCREMENT,
                            `id_producto` INT(11) NOT NULL DEFAULT '0',
                            `id_productos_detalles_enlazado` INT(11) NOT NULL DEFAULT '0',
                            `id_productos_detalles_multiples` INT(11) NOT NULL DEFAULT '0',
                            `id_packs` INT(11) NOT NULL DEFAULT '0',
                            `codigo_barras` VARCHAR(20) NULL DEFAULT '' COLLATE 'utf8_spanish_ci',
                            `referencia` VARCHAR(20) NULL DEFAULT '' COLLATE 'utf8_spanish_ci',
                            `fecha_alta` DATE NULL DEFAULT NULL,
                            `fecha_modificacion` DATE NULL DEFAULT NULL,
                        */
                        $result = $conn->query("INSERT INTO productos_sku VALUES(
                        NULL,
                        '".$id_productos."',
                        '".$id_enlazado."',
                        '".$id_multiple."',
                        '".$id_pack."',
                        '',
                        '',
                        '0',
                        '".date("Y-m-d")."',
                        '".date("Y-m-d")."')");

                        $idProductoProductosSku = $conn->id_insert();
                    }

                    if ($apartado_url == "elaboracion") {
                        $result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");

                        $decimales_cantidades = $result_configuracion[0]['decimales_cantidades'];
                        $decimales_importes = $result_configuracion[0]['decimales_importes'];

                        $idElaboracion = date('mdHis');

                        $datosRegistroStock = [];
                        $datosRegistroStock['ejercicio'] = date('Y');
                        $datosRegistroStock['tipo_documento'] = 'ela';
                        $datosRegistroStock['id_documento_1'] = $idElaboracion;
                        $datosRegistroStock['id_documento_2'] = $idElaboracion;
                        $datosRegistroStock['tipo_librador'] = $tipo_librador;
                        $datosRegistroStock['id_librador'] = $id_librador;
                        $datosRegistroStock['conn'] = $conn;
                        $datosRegistroStock['id_producto'] = $id_productos;
                        $datosRegistroStock['id_productos_detalles_enlazado'] = '';
                        $datosRegistroStock['id_productos_detalles_multiples'] = '';
                        $datosRegistroStock['id_packs'] = '';
                        $datosRegistroStock['id_productos_sku'] = $idProductoProductosSku;
                        $datosRegistroStock['lote_producto'] = addslashes($lote);
                        $datosRegistroStock['caducidad_producto'] = $caducidad;
                        $datosRegistroStock['numero_serie_producto'] = addslashes($numero_serie);
                        $datosRegistroStock['coste_producto_linea'] = '';
                        $datosRegistroStock['id_unidades'] = $id_unidades;
                        $datosRegistroStock['unidad_producto'] = $unidad;
                        $datosRegistroStock['importe'] = 0;
                        $datosRegistroStock['cantidad'] = $cantidad;
                        registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $id_productos, []);

                        $result_elaborados = $conn->query("SELECT * FROM productos_relacionados_elaborados WHERE id_producto='".$id_productos."'");
                        for ($i = 0; $i < count($result_elaborados); $i++) {
                            $datosRegistroStock = [];
                            $datosRegistroStock['ejercicio'] = date('Y');
                            $datosRegistroStock['tipo_documento'] = 'tiq';
                            $datosRegistroStock['id_documento_1'] = $idElaboracion;
                            $datosRegistroStock['id_documento_2'] = $idElaboracion;
                            $datosRegistroStock['tipo_librador'] = 'cli';
                            $datosRegistroStock['id_librador'] = $id_librador;
                            $datosRegistroStock['conn'] = $conn;
                            $datosRegistroStock['id_productos_detalles_enlazado'] = $result_elaborados[$i]['id_productos_detalles_enlazado'];
                            $datosRegistroStock['id_productos_detalles_multiples'] = $result_elaborados[$i]['id_productos_detalles_multiples'];
                            $datosRegistroStock['id_packs'] = $result_elaborados[$i]['id_packs'];
                            $datosRegistroStock['id_unidades'] = $result_elaborados[$i]['id_unidad'];
                            $datosRegistroStock['id_producto'] = $result_elaborados[$i]['id_producto_relacionado'];
                            $datosRegistroStock['cantidad'] = $result_elaborados[$i]['cantidad'] * $cantidad;
                            $datosRegistroStock['importe'] = 0;
                            $datosRegistroStock['coste_producto_linea'] = 0;
                            $datosRegistroStock['lote_producto'] = '';
                            $datosRegistroStock['caducidad_producto'] = '';
                            $datosRegistroStock['numero_serie_producto'] = '';
                            registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $result_elaborados[$i]['id_producto_relacionado'], [], true);
                        }
                    } else {
                        if ($producto_traspasar && $cantidad < 0) {
                            $tipo_documento = 'tra';
                        }

                        $result = $conn->query("INSERT INTO documentos_".date('Y')."_productos_sku_stock VALUES(
                            NULL,
                            '".$id_productos."',
                            '".$idProductoProductosSku."',
                            '".addslashes($lote)."',
                            '".$caducidad."',
                            '".addslashes($numero_serie)."',
                            '',
                            '".$tipo_documento."',
                            '".$fecha."',
                            '".$id_documento_1."',
                            '".$id_documento_2."',
                            '".$tipo_librador."',
                            '".$id_librador."',
                            '0',
                            '".$cantidad."',
                            '".$id_unidades."',
                            '".$unidad."',
                            '".$importe."',
                            '".date("Y-m-d")."',
                            '".date("Y-m-d")."')");

                        $id_productos_sku_stock_inicio = $conn->id_insert();
                        $codigo_barras = $id_productos_sku_stock_inicio;
                        if(strlen($codigo_barras) < 10) {
                            $codigo_barras = str_repeat("0", 11 - strlen($codigo_barras)) . $codigo_barras;
                        }
                        $result_update_sku_stock = $conn->query("UPDATE documentos_".date('Y')."_productos_sku_stock SET codigo_barras='" . addslashes($codigo_barras) . "' WHERE id=" . $id_productos_sku_stock_inicio . " LIMIT 1");

                        // Si se tiene que traspasar el stock a otro producto
                        if ($producto_traspasar && $cantidad < 0) {
                            $result = $conn->query("SELECT id FROM productos_otros WHERE id_producto = " . $producto_traspasar . " LIMIT 1");

                            if($conn->registros() >= 1) {
                                $id_productos_otros_traspasar = $result[0]['id'];
                                $result = $conn->query("UPDATE productos_otros SET
                                  control_stock='1'
                                  WHERE id=" . $id_productos_otros_traspasar . " LIMIT 1");
                            } else {
                                $result = $conn->query("INSERT INTO productos_otros VALUES(
                                    NULL,
                                    '".$producto_traspasar."',
                                    '',
                                    '',
                                    '',
                                    '1',
                                    '1',
                                    '" . $control_stock . "',
                                    '1',
                                    '".date("Y-m-d")."',
                                    '0',
                                    '1',
                                    '0',
                                    '0',
                                    '1',
                                    '0',
                                    '0',
                                    '0',
                                    '0',
                                    '0')");
                                $id_productos_otros_traspasar = $conn->id_insert();
                            }

                            $result = $conn->query("SELECT id FROM productos_sku WHERE id_producto = " . $producto_traspasar . " LIMIT 1");
                            if($conn->registros() >= 1) {
                                $idProductoProductosSku_traspasar = $result[0]['id'];
                            } else {
                                $result = $conn->query("INSERT INTO productos_sku VALUES(
                                    NULL,
                                    '".$id_productos."',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '0',
                                    '".date("Y-m-d")."',
                                    '".date("Y-m-d")."')");

                                $idProductoProductosSku_traspasar = $conn->id_insert();
                            }

                            $result = $conn->query("INSERT INTO documentos_".date('Y')."_productos_sku_stock VALUES(
                                NULL,
                                '".$producto_traspasar."',
                                '".$idProductoProductosSku_traspasar."',
                                '".addslashes($lote)."',
                                '".$caducidad."',
                                '".addslashes($numero_serie)."',
                                '',
                                '".$tipo_documento."',
                                '".$fecha."',
                                '".$id_documento_1."',
                                '".$id_documento_2."',
                                '".$tipo_librador."',
                                '".$id_librador."',
                                '0',
                                '".abs($cantidad)."',
                                '".$id_unidades."',
                                '".$unidad."',
                                '".$importe."',
                                '".date("Y-m-d")."',
                                '".date("Y-m-d")."')");

                            $id_productos_sku_stock_fin = $conn->id_insert();
                            $codigo_barras = $id_productos_sku_stock_fin;
                            if(strlen($codigo_barras) < 10) {
                                $codigo_barras = str_repeat("0", 11 - strlen($codigo_barras)) . $codigo_barras;
                            }
                            $result_update_sku_stock = $conn->query("UPDATE documentos_".date('Y')."_productos_sku_stock SET codigo_barras='" . addslashes($codigo_barras) . "' WHERE id=" . $id_productos_sku_stock_fin . " LIMIT 1");

                            $result = $conn->query("INSERT INTO documentos_".date('Y')."_productos_sku_stock_enlace VALUES(
                                NULL,
                                '".$id_productos_sku_stock_inicio."',
                                '".$id_productos_sku_stock_fin."')");
                        }
                    }

                    $resultado_sys = "INSERT";

                    /*
                    Si es un elaborado, compuesto o combo, se deben actualizar sus relacionados
                    */
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_productos,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
        case "subir-imagen":
            $matriz_logs_sys[] = "UPDATE productos SET imagen='" . addslashes($nombre_sys . "-" . $hora_sys . $extension_sys) . "', updated='" . $updated_sys . "' WHERE id=" . $id_sys . " LIMIT 1";
            $result = $conn->query("UPDATE productos SET imagen='" . addslashes($nombre_sys . "-" . $hora_sys . $extension_sys) . "', updated='" . $updated_sys . "' WHERE id=" . $id_sys . " LIMIT 1");
            break;
        case "eliminar-imagen":
            $updated_sys = date("y-m-d").date("H:m:s");
            $updated_sys = str_replace("-","",$updated_sys);
            $updated_sys = str_replace(":","",$updated_sys);

            $logs_sys->Update_eliminar_imagen = "UPDATE productos SET 
              imagen='', 
              updated='" . $updated_sys . "' 
              WHERE id=" . $id_productos . " LIMIT 1<br />";

            $result = $conn->query("UPDATE productos SET 
              imagen='', 
              updated='" . $updated_sys . "' 
              WHERE id=" . $id_productos . " LIMIT 1");

            $resultado_sys = "UPDATE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_productos,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
        case "eliminar":
            $logs_sys->Delete = "DELETE FROM productos WHERE id=" . $id_productos . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos WHERE id=" . $id_productos . " LIMIT 1");
            $result = $conn->query("DELETE FROM productos_categorias WHERE id_producto=" . $id_productos);
            $result = $conn->query("DELETE FROM productos_detalles_enlazado WHERE id_producto=" . $id_productos);
            $result = $conn->query("DELETE FROM productos_detalles_multiples WHERE id_producto=" . $id_productos);
            $result = $conn->query("DELETE FROM productos_detalles_unicos WHERE id_producto=" . $id_productos);
            $result = $conn->query("DELETE FROM productos_images WHERE id_producto=" . $id_productos);
            $result = $conn->query("DELETE FROM productos_otros WHERE id_producto=" . $id_productos);
            $result = $conn->query("DELETE FROM productos_packs WHERE id_producto=" . $id_productos);
            $result = $conn->query("DELETE FROM productos_pvp WHERE id_producto=" . $id_productos);
            $result = $conn->query("DELETE FROM productos_costes WHERE id_producto=" . $id_productos);

            $result_productos_relacionados = $conn->query("SELECT id FROM productos_relacionados WHERE id_producto=" . $id_productos);
            if($conn->registros() >= 1) {
                foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
                    $result = $conn->query("DELETE FROM productos_relacionados_incre WHERE id_producto_rel=" . $valor_productos_relacionados['id']);
                }
            }
            $result = $conn->query("DELETE FROM productos_relacionados WHERE id_producto=" . $id_productos);

            $result_productos_relacionados_combo = $conn->query("SELECT id FROM productos_relacionados_combo WHERE id_producto=" . $id_productos);
            if($conn->registros() >= 1) {
                foreach ($result_productos_relacionados_combo as $key_productos_relacionados_combo => $valor_productos_relacionados_combo) {
                    $result = $conn->query("DELETE FROM productos_relacionados_combo_incre WHERE id_producto_rel=" . $valor_productos_relacionados_combo['id']);
                }
            }
            $result = $conn->query("DELETE FROM productos_relacionados_combo WHERE id_producto=" . $id_productos);

            $result_productos_relacionados_elaborados = $conn->query("SELECT id FROM productos_relacionados_elaborados WHERE id_producto=" . $id_productos);
            if($conn->registros() >= 1) {
                foreach ($result_productos_relacionados_elaborados as $key_productos_relacionados_elaborados => $valor_productos_relacionados_elaborados) {
                    $result = $conn->query("DELETE FROM productos_relacionados_elaborados_incre WHERE id_producto_rel=" . $valor_productos_relacionados_elaborados['id']);
                }
            }
            $result = $conn->query("DELETE FROM productos_relacionados_elaborados WHERE id_producto=" . $id_productos);

            $result_productos_titulos = $conn->query("SELECT id FROM productos_titulos WHERE id_producto=" . $id_productos);
            if($conn->registros() >= 1) {
                foreach ($result_productos_titulos as $key_productos_titulos => $valor_productos_titulos) {
                    $result = $conn->query("DELETE FROM productos_titulos_relacionados WHERE id_productos_titulos=" . $valor_productos_titulos['id']);
                }
            }
            $result = $conn->query("DELETE FROM productos_titulos WHERE id_producto=" . $id_productos);

            $result_productos_sku = $conn->query("SELECT id FROM productos_sku WHERE id_producto=" . $id_productos);
            if($conn->registros() >= 1) {
                foreach ($result_productos_sku as $key_productos_sku => $valor_productos_sku) {
                    $result = $conn->query("DELETE FROM documentos_".date('Y')."_productos_sku_stock WHERE id_productos_sku=" . $valor_productos_sku['id']);
                }
            }
            $result = $conn->query("DELETE FROM productos_sku WHERE id_producto=" . $id_productos);
            $result = $conn->query("DELETE FROM productos_unidades WHERE id_producto=" . $id_productos);

            $result_web_datos = $conn->query("SELECT id_observaciones FROM productos_web_datos WHERE id_producto=" . $id_productos);
            if($conn->registros() >= 1) {
                foreach ($result_web_datos as $key_productos_web_datos => $valor_productos_web_datos) {
                    $result = $conn->query("DELETE FROM productos_observaciones WHERE id=" . $valor_productos_web_datos['id_observaciones']);
                }
            }
            $result = $conn->query("DELETE FROM productos_web_datos WHERE id_producto=" . $id_productos);

            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "guardar-composicion":
            $tipoDeProductoAInsertar = $tipo_producto;
            switch ($tipo_producto) {
                case "1":
                    if ($modelo == 4) {
                        $valoresAInsertar[0]['id_productos_detalles_enlazado'] = 0;
                        $valoresAInsertar[0]['id_productos_detalles_multiples'] = 0;
                        $valoresAInsertar[0]['id_packs'] = 0;
                        $valoresAInsertar[0]['id_categoria_estadisticas'] = 0;
                        $valoresAInsertar[0]['id_producto_relacionado'] = $id_producto_relacionado;
                        $valoresAInsertar[0]['fijo'] = $fijo;
                        $valoresAInsertar[0]['cantidad'] = $cantidad_con;
                        $valoresAInsertar[0]['id_unidad'] = $id_unidad;
                        for ($bucle_incrementos_tarifas = 0 ; $bucle_incrementos_tarifas < $incrementos_tarifas ; $bucle_incrementos_tarifas++) {
                            $valoresAInsertar[0]['id_tarifa'][] = $id_tarifas[$bucle_incrementos_tarifas];
                            $valoresAInsertar[0]['sumar'][] = $sumar_con[$bucle_incrementos_tarifas];
                        }
                        $valoresAInsertar[0]['mostrar'] = $mostrar;
                        $valoresAInsertar[0]['orden'] = '';
                    } else {
                        $tipoDeProductoAInsertar = 2;
                        $result = $conn->query("SELECT * FROM productos_relacionados_elaborados WHERE id_producto=" . $id_productos);
                        if($conn->registros() >= 1) {
                            $id_tabla_relacionado = 0;
                            foreach ($result as $key_productos_relacionados_elaborados => $valor_productos_relacionados_elaborados) {
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['id_productos_detalles_enlazado'] = $valor_productos_relacionados_elaborados['id_productos_detalles_enlazado'];
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['id_productos_detalles_multiples'] = $valor_productos_relacionados_elaborados['id_productos_detalles_multiples'];
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['id_packs'] = $valor_productos_relacionados_elaborados['id_packs'];
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['id_relacionado'] = $valor_productos_relacionados_elaborados['id_producto_relacionado'];
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['id_grupo'] = 0;
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['fijo'] = 0;
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['modelo'] = 4;
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['cantidad_con'] = $valor_productos_relacionados_elaborados['cantidad'];
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['cantidad_mitad'] = 0;
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['cantidad_sin'] = 0;
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['cantidad_doble'] = 0;
                                for ($bucle_incrementos_tarifas = 0 ; $bucle_incrementos_tarifas < $incrementos_tarifas ; $bucle_incrementos_tarifas++) {
                                    $sumar_incremento_tarifa = 0;
                                    $result_sumar_tarifas = $conn->query("SELECT sumar FROM productos_relacionados_elaborados_incre 
                                            WHERE id_producto_rel=" . $valor_productos_relacionados_elaborados['id'] . " AND id_tarifa='" . $id_tarifas[$bucle_incrementos_tarifas] . "' LIMIT 1");

                                    if($conn->registros() == 1) {
                                        $sumar_incremento_tarifa = $result_sumar_tarifas[0]['sumar'];
                                    }
                                    $valoresAInsertar[0]['id_tarifa'][] = $id_tarifas[$bucle_incrementos_tarifas];
                                    $valoresAInsertar[$key_productos_relacionados_elaborados]['sumar_con'][] = $sumar_incremento_tarifa;
                                    $valoresAInsertar[$key_productos_relacionados_elaborados]['sumar_mitad'][] = 0;
                                    $valoresAInsertar[$key_productos_relacionados_elaborados]['sumar_sin'][] = 0;
                                    $valoresAInsertar[$key_productos_relacionados_elaborados]['sumar_doble'][] = 0;
                                }
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['por_defecto'] = 0;
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['mostrar'] = 0;
                                $valoresAInsertar[$key_productos_relacionados_elaborados]['orden'] = $valor_productos_relacionados_elaborados['orden'];
                            }
                            $key_producto_nuevo = count($valoresAInsertar);
                            $valoresAInsertar[$key_producto_nuevo]['id_productos_detalles_enlazado'] = 0;
                            $valoresAInsertar[$key_producto_nuevo]['id_productos_detalles_multiples'] = 0;
                            $valoresAInsertar[$key_producto_nuevo]['id_packs'] = 0;
                            $valoresAInsertar[$key_producto_nuevo]['id_relacionado'] = $id_producto_relacionado;
                            $valoresAInsertar[$key_producto_nuevo]['id_grupo'] = 0;
                            $valoresAInsertar[$key_producto_nuevo]['fijo'] = $fijo;
                            $valoresAInsertar[$key_producto_nuevo]['modelo'] = $modelo;
                            $valoresAInsertar[$key_producto_nuevo]['cantidad_con'] = $cantidad_con;
                            $valoresAInsertar[$key_producto_nuevo]['cantidad_mitad'] = 0;
                            $valoresAInsertar[$key_producto_nuevo]['cantidad_sin'] = 0;
                            $valoresAInsertar[$key_producto_nuevo]['cantidad_doble'] = 0;
                            for ($bucle_incrementos_tarifas = 0 ; $bucle_incrementos_tarifas < $incrementos_tarifas ; $bucle_incrementos_tarifas++) {
                                $valoresAInsertar[$key_producto_nuevo]['id_tarifa'][] = $id_tarifas[$bucle_incrementos_tarifas];
                                $valoresAInsertar[$key_producto_nuevo]['sumar_con'][] = $sumar_con[$bucle_incrementos_tarifas];
                                $valoresAInsertar[$key_producto_nuevo]['sumar_mitad'][] = 0;
                                $valoresAInsertar[$key_producto_nuevo]['sumar_sin'][] = 0;
                                $valoresAInsertar[$key_producto_nuevo]['sumar_doble'][] = 0;
                            }
                            $valoresAInsertar[$key_producto_nuevo]['por_defecto'] = 0;
                            $valoresAInsertar[$key_producto_nuevo]['mostrar'] = $mostrar;
                            $valoresAInsertar[$key_producto_nuevo]['orden'] = '';

                            $result = $conn->query("DELETE FROM productos_relacionados_elaborados WHERE id_producto=" . $id_productos);
                        }
                    }
                    break;
                case "2":
                    $valoresAInsertar[0]['id_productos_detalles_enlazado'] = 0;
                    $valoresAInsertar[0]['id_productos_detalles_multiples'] = 0;
                    $valoresAInsertar[0]['id_packs'] = 0;
                    $valoresAInsertar[0]['id_relacionado'] = $id_producto_relacionado;
                    $valoresAInsertar[0]['id_grupo'] = 0;
                    $valoresAInsertar[0]['fijo'] = $fijo;
                    $valoresAInsertar[0]['modelo'] = $modelo;
                    $valoresAInsertar[0]['cantidad_con'] = $cantidad_con;
                    $valoresAInsertar[0]['cantidad_mitad'] = $cantidad_mitad;
                    $valoresAInsertar[0]['cantidad_sin'] = $cantidad_sin;
                    $valoresAInsertar[0]['cantidad_doble'] = $cantidad_doble;
                    for ($bucle_incrementos_tarifas = 0 ; $bucle_incrementos_tarifas < $incrementos_tarifas ; $bucle_incrementos_tarifas++) {
                        $valoresAInsertar[0]['id_tarifa'][] = $id_tarifas[$bucle_incrementos_tarifas];
                        $valoresAInsertar[0]['sumar_con'][] = $sumar_con[$bucle_incrementos_tarifas];
                        $valoresAInsertar[0]['sumar_mitad'][] = $sumar_mitad[$bucle_incrementos_tarifas];
                        $valoresAInsertar[0]['sumar_sin'][] = $sumar_sin[$bucle_incrementos_tarifas];
                        $valoresAInsertar[0]['sumar_doble'][] = $sumar_doble[$bucle_incrementos_tarifas];
                    }
                    $valoresAInsertar[0]['por_defecto'] = $por_defecto;
                    $valoresAInsertar[0]['mostrar'] = $mostrar;
                    $valoresAInsertar[0]['orden'] = '';

                    break;
                case "3":
                case "4":
                    $valoresAInsertar[0]['id_productos_detalles_enlazado'] = 0;
                    $valoresAInsertar[0]['id_productos_detalles_multiples'] = 0;
                    $valoresAInsertar[0]['id_packs'] = 0;
                    $valoresAInsertar[0]['id_relacionado'] = $id_producto_relacionado;
                    $valoresAInsertar[0]['id_grupo'] = $id_grupo;
                    $valoresAInsertar[0]['fijo'] = $fijo;
                    $valoresAInsertar[0]['cantidad'] = $cantidad_con;
                    for ($bucle_incrementos_tarifas = 0 ; $bucle_incrementos_tarifas < $incrementos_tarifas ; $bucle_incrementos_tarifas++) {
                        $valoresAInsertar[0]['id_tarifa'][] = $id_tarifas[$bucle_incrementos_tarifas];
                        $valoresAInsertar[0]['sumar'][] = $sumar_con[$bucle_incrementos_tarifas];
                    }
                    $valoresAInsertar[0]['mostrar'] = $mostrar;
                    $valoresAInsertar[0]['orden'] = '';
                    $valoresAInsertar[0]['activo'] = $activo;
                    break;
                case "0":
                default:
                    if ($modelo == 0 || $modelo == 1 || $modelo == 2 || $modelo == 3) {
                        $tipoDeProductoAInsertar = 2;
                        $valoresAInsertar[0]['id_productos_detalles_enlazado'] = 0;
                        $valoresAInsertar[0]['id_productos_detalles_multiples'] = 0;
                        $valoresAInsertar[0]['id_packs'] = 0;
                        $valoresAInsertar[0]['id_relacionado'] = $id_producto_relacionado;
                        $valoresAInsertar[0]['id_grupo'] = 0;
                        $valoresAInsertar[0]['fijo'] = $fijo;
                        $valoresAInsertar[0]['modelo'] = $modelo;
                        $valoresAInsertar[0]['cantidad_con'] = $cantidad_con;
                        $valoresAInsertar[0]['cantidad_mitad'] = $cantidad_mitad;
                        $valoresAInsertar[0]['cantidad_sin'] = $cantidad_sin;
                        $valoresAInsertar[0]['cantidad_doble'] = $cantidad_doble;
                        for ($bucle_incrementos_tarifas = 0 ; $bucle_incrementos_tarifas < $incrementos_tarifas ; $bucle_incrementos_tarifas++) {
                            $valoresAInsertar[0]['id_tarifa'][] = $id_tarifas[$bucle_incrementos_tarifas];
                            $valoresAInsertar[0]['sumar_con'][] = $sumar_con[$bucle_incrementos_tarifas];
                            $valoresAInsertar[0]['sumar_mitad'][] = $sumar_mitad[$bucle_incrementos_tarifas];
                            $valoresAInsertar[0]['sumar_sin'][] = $sumar_sin[$bucle_incrementos_tarifas];
                            $valoresAInsertar[0]['sumar_doble'][] = $sumar_doble[$bucle_incrementos_tarifas];
                        }
                        $valoresAInsertar[0]['por_defecto'] = $por_defecto;
                        $valoresAInsertar[0]['mostrar'] = $mostrar;
                        $valoresAInsertar[0]['orden'] = '';
                    }else if ($modelo == 4) {
                        $tipoDeProductoAInsertar = 1;
                        $valoresAInsertar[0]['id_productos_detalles_enlazado'] = 0;
                        $valoresAInsertar[0]['id_productos_detalles_multiples'] = 0;
                        $valoresAInsertar[0]['id_packs'] = 0;
                        $valoresAInsertar[0]['id_categoria_estadisticas'] = 0;
                        $valoresAInsertar[0]['id_producto_relacionado'] = $id_producto_relacionado;
                        $valoresAInsertar[0]['fijo'] = $fijo;
                        $valoresAInsertar[0]['cantidad'] = $cantidad_con;
                        $valoresAInsertar[0]['id_unidad'] = $id_unidad;
                        for ($bucle_incrementos_tarifas = 0 ; $bucle_incrementos_tarifas < $incrementos_tarifas ; $bucle_incrementos_tarifas++) {
                            $valoresAInsertar[0]['id_tarifa'][] = $id_tarifas[$bucle_incrementos_tarifas];
                            $valoresAInsertar[0]['sumar'][] = $sumar_con[$bucle_incrementos_tarifas];
                        }
                        $valoresAInsertar[0]['mostrar'] = $mostrar;
                        $valoresAInsertar[0]['orden'] = '';
                    }else if ($modelo == 5) {
                        $tipoDeProductoAInsertar = 3;
                        $valoresAInsertar[0]['id_productos_detalles_enlazado'] = 0;
                        $valoresAInsertar[0]['id_productos_detalles_multiples'] = 0;
                        $valoresAInsertar[0]['id_packs'] = 0;
                        $valoresAInsertar[0]['id_relacionado'] = $id_producto_relacionado;
                        $valoresAInsertar[0]['id_grupo'] = $id_grupo;
                        $valoresAInsertar[0]['fijo'] = $fijo;
                        $valoresAInsertar[0]['cantidad'] = $cantidad_con;
                        for ($bucle_incrementos_tarifas = 0 ; $bucle_incrementos_tarifas < $incrementos_tarifas ; $bucle_incrementos_tarifas++) {
                            $valoresAInsertar[0]['id_tarifa'][] = $id_tarifas[$bucle_incrementos_tarifas];
                            $valoresAInsertar[0]['sumar'][] = $sumar_con[$bucle_incrementos_tarifas];
                        }
                        $valoresAInsertar[0]['mostrar'] = $mostrar;
                        $valoresAInsertar[0]['orden'] = '';
                        $valoresAInsertar[0]['activo'] = $activo;
                    }
                    break;
            }

            foreach ($valoresAInsertar as $valorAInsertar) {
                switch ($tipoDeProductoAInsertar) {
                    case "1":
                        if (empty($id_tabla_relacionado)) {
                            $id_unidad = $valorAInsertar['id_unidad'];
                            if (!$id_unidad) {
                                $result_productos_unidades = $conn->query("SELECT id_unidad FROM productos_unidades WHERE id_producto='" . $id_productos."' AND principal = 1");
                                if($conn->registros() >= 1) {
                                    $id_unidad = $result_productos_unidades[0]['id_unidad'];
                                }
                            }

                            $result = $conn->query("INSERT INTO productos_relacionados_elaborados VALUES(
                                          NULL,
                                          '".$id_productos."',
                                          '".$valorAInsertar['id_productos_detalles_enlazado']."',
                                          '".$valorAInsertar['id_productos_detalles_multiples']."',
                                          '".$valorAInsertar['id_packs']."',
                                          '".$valorAInsertar['id_categoria_estadisticas']."',
                                          '".$valorAInsertar['id_producto_relacionado']."',
                                          '".$valorAInsertar['fijo']."',
                                          '".$valorAInsertar['cantidad']."',
                                          '".$id_unidad."',
                                          '".$valorAInsertar['mostrar']."',
                                          '".$valorAInsertar['orden']."')");

                            $new_id_productos_relacionados_elaborados = $conn->id_insert();

                            foreach ($valorAInsertar['id_tarifa'] AS $key_valoresAInsertar => $valor_valoresAInsertar) {
                                $result = $conn->query("INSERT INTO productos_relacionados_elaborados_incre VALUES(
                                          NULL,
                                          '" . $new_id_productos_relacionados_elaborados . "',
                                          '" . $valorAInsertar['id_tarifa'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar'][$key_valoresAInsertar] . "')");
                            }
                        } else {
                            $result = $conn->query("UPDATE productos_relacionados_elaborados SET 
                                          id_producto = '".$id_productos."',
                                          id_productos_detalles_enlazado = '".$valorAInsertar['id_productos_detalles_enlazado']."',
                                          id_productos_detalles_multiples = '".$valorAInsertar['id_productos_detalles_multiples']."',
                                          id_packs = '".$valorAInsertar['id_packs']."',
                                          id_categoria_estadisticas = '".$valorAInsertar['id_categoria_estadisticas']."',
                                          id_producto_relacionado = '".$valorAInsertar['id_producto_relacionado']."',
                                          fijo = '".$valorAInsertar['fijo']."',
                                          cantidad = '".$valorAInsertar['cantidad']."',
                                          id_unidad = '".$valorAInsertar['id_unidad']."',
                                          mostrar = '".$valorAInsertar['mostrar']."',
                                          orden = '".$valorAInsertar['orden']."'
                                      WHERE id = " . $id_tabla_relacionado . " LIMIT 1");

                            foreach ($valorAInsertar['id_tarifa'] AS $key_valoresAInsertar => $valor_valoresAInsertar) {
                                $result = $conn->query("SELECT id FROM productos_relacionados_elaborados_incre WHERE 
                                          id_producto_rel='" . $id_tabla_relacionado . "' AND 
                                          id_tarifa='" . $valorAInsertar['id_tarifa'][$key_valoresAInsertar] . "' LIMIT 1");

                                if($conn->registros() == 1) {
                                    $result = $conn->query("UPDATE productos_relacionados_elaborados_incre SET 
                                                  sumar='" . $valorAInsertar['sumar'][$key_valoresAInsertar] . "' WHERE 
                                                  id='" . $result[0]['id'] . "' LIMIT 1");
                                }else {
                                    $result = $conn->query("INSERT INTO productos_relacionados_elaborados_incre VALUES(
                                          NULL,
                                          '" . $id_tabla_relacionado . "',
                                          '" . $valorAInsertar['id_tarifa'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar'][$key_valoresAInsertar] . "')");
                                }
                            }
                        }
                        break;
                    case "2":
                        if (empty($id_tabla_relacionado)) {
                            $result = $conn->query("INSERT INTO productos_relacionados VALUES(
                                          NULL,
                                          '".$id_productos."',
                                          '".$valorAInsertar['id_productos_detalles_enlazado']."',
                                          '".$valorAInsertar['id_productos_detalles_multiples']."',
                                          '".$valorAInsertar['id_packs']."',
                                          '".$valorAInsertar['id_relacionado']."',
                                          '".$valorAInsertar['id_grupo']."',
                                          '".$valorAInsertar['fijo']."',
                                          '".$valorAInsertar['modelo']."',
                                          '".$valorAInsertar['cantidad_con']."',
                                          '".$valorAInsertar['cantidad_mitad']."',
                                          '".$valorAInsertar['cantidad_sin']."',
                                          '".$valorAInsertar['cantidad_doble']."',
                                          '',
                                          '".$valorAInsertar['por_defecto']."',
                                          '".$valorAInsertar['mostrar']."',
                                          '".$valorAInsertar['orden']."')");

                            $new_id_productos_relacionados = $conn->id_insert();

                            foreach ($valorAInsertar['id_tarifa'] AS $key_valoresAInsertar => $valor_valoresAInsertar) {
                                $result = $conn->query("INSERT INTO productos_relacionados_incre VALUES(
                                          NULL,
                                          '" . $new_id_productos_relacionados . "',
                                          '" . $valoresAInsertar['id_tarifa'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar_con'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar_mitad'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar_sin'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar_doble'][$key_valoresAInsertar] . "')");
                            }
                        } else {
                            $result = $conn->query("UPDATE productos_relacionados SET 
                                  id_grupo='".$valorAInsertar['id_grupo']."',
                                  fijo='".$valorAInsertar['fijo']."',
                                  modelo='".$valorAInsertar['modelo']."',
                                  cantidad_con='".$valorAInsertar['cantidad_con']."',
                                  cantidad_mitad='".$valorAInsertar['cantidad_mitad']."',
                                  cantidad_sin='".$valorAInsertar['cantidad_sin']."',
                                  cantidad_doble='".$valorAInsertar['cantidad_doble']."',
                                  por_defecto='".$valorAInsertar['por_defecto']."',
                                  mostrar='".$valorAInsertar['mostrar']."',
                                  orden='".$valorAInsertar['orden']."' 
                                  WHERE id=".$id_tabla_relacionado." LIMIT 1");

                            foreach ($valorAInsertar['id_tarifa'] AS $key_valoresAInsertar => $valor_valoresAInsertar) {
                                $result = $conn->query("SELECT id FROM productos_relacionados_incre WHERE 
                                          id_producto_rel='" . $id_tabla_relacionado . "' AND 
                                          id_tarifa='" . $valorAInsertar['id_tarifa'][$key_valoresAInsertar] . "' LIMIT 1");

                                if($conn->registros() == 1) {
                                    $result = $conn->query("UPDATE productos_relacionados_incre SET 
                                                  sumar_con='" . $valorAInsertar['sumar_con'][$key_valoresAInsertar] . "', 
                                                  sumar_mitad='" . $valorAInsertar['sumar_mitad'][$key_valoresAInsertar] . "', 
                                                  sumar_sin='" . $valorAInsertar['sumar_sin'][$key_valoresAInsertar] . "', 
                                                  sumar_doble='" . $valorAInsertar['sumar_doble'][$key_valoresAInsertar] . "' 
                                                  WHERE id='" . $result[0]['id'] . "' LIMIT 1");
                                }else {
                                    $result = $conn->query("INSERT INTO productos_relacionados_incre VALUES(
                                          NULL,
                                          '" . $id_tabla_relacionado . "',
                                          '" . $valorAInsertar['id_tarifa'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar_con'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar_mitad'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar_sin'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar_doble'][$key_valoresAInsertar] . "')");
                                }
                            }
                        }
                        break;
                    case "3":
                    case "4":
                    default:
                        if (empty($id_tabla_relacionado)) {
                            $result = $conn->query("INSERT INTO productos_relacionados_combo VALUES(
                                          NULL,
                                          '".$id_productos."',
                                          '".$valorAInsertar['id_productos_detalles_enlazado']."',
                                          '".$valorAInsertar['id_productos_detalles_multiples']."',
                                          '".$valorAInsertar['id_packs']."',
                                          '".$valorAInsertar['id_relacionado']."',
                                          '".$valorAInsertar['id_grupo']."',
                                          '".$valorAInsertar['fijo']."',
                                          '".$valorAInsertar['cantidad']."',
                                          '".$valorAInsertar['mostrar']."',
                                          '".$valorAInsertar['orden']."',
                                          '".$valorAInsertar['activo']."')");

                            $new_id_productos_relacionados_combo = $conn->id_insert();

                            foreach ($valorAInsertar['id_tarifa'] AS $key_valoresAInsertar => $valor_valoresAInsertar) {
                                $result = $conn->query("INSERT INTO productos_relacionados_combo_incre VALUES(
                                          NULL,
                                          '" . $new_id_productos_relacionados_combo . "',
                                          '" . $valorAInsertar['id_tarifa'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar'][$key_valoresAInsertar] . "')");
                            }
                        } else {
                            $result = $conn->query("UPDATE productos_relacionados_combo SET 
                                  id_grupo='".$valorAInsertar['id_grupo']."',
                                  fijo='".$valorAInsertar['fijo']."',
                                  cantidad='".$valorAInsertar['cantidad']."',
                                  mostrar='".$valorAInsertar['mostrar']."',
                                  activo='".$valorAInsertar['activo']."' 
                                  WHERE id=".$id_tabla_relacionado." LIMIT 1");

                            foreach ($valorAInsertar['id_tarifa'] AS $key_valoresAInsertar => $valor_valoresAInsertar) {
                                $result = $conn->query("SELECT id FROM productos_relacionados_combo_incre WHERE 
                                          id_producto_rel='" . $id_tabla_relacionado . "' AND 
                                          id_tarifa='" . $valorAInsertar['id_tarifa'][$key_valoresAInsertar] . "' LIMIT 1");

                                if($conn->registros() == 1) {
                                    $result = $conn->query("UPDATE productos_relacionados_combo_incre SET 
                                                  sumar='" . $valorAInsertar['sumar'][$key_valoresAInsertar] . "' WHERE 
                                                  id='" . $result[0]['id'] . "' LIMIT 1");
                                }else {
                                    $result = $conn->query("INSERT INTO productos_relacionados_combo_incre VALUES(
                                          NULL,
                                          '" . $id_tabla_relacionado . "',
                                          '" . $valorAInsertar['id_tarifa'][$key_valoresAInsertar] . "',
                                          '" . $valorAInsertar['sumar'][$key_valoresAInsertar] . "')");
                                }
                            }
                        }
                        break;
                }
                /*

                AQUI SE DEBEN OBTENER LOS VALORES PARA LOS CAMPOS peso_bruto y coste DE LA TABLA productos

                */
            }

            if ($tipoDeProductoAInsertar != $tipo_producto) {
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

                AQUI SE DEBEN ACTUALIZAR LOS CAMPOS peso_bruto y coste DE LA TABLA productos

                */
                $result = $conn->query("UPDATE productos SET 
                                  tipo_producto='".$tipoDeProductoAInsertar."' 
                                  WHERE id=".$id_productos." LIMIT 1");
            }
            /*
            if ($tipo_producto == 0 && $tipoDeProductoAInsertar == 1) {
                $result = $conn->query("INSERT INTO productos_costes VALUES(
                                  NULL,
                                  ".$id_productos.",
                                  '0',
                                  '0',
                                  '0',
                                  '0',
                                  '0')");
            }
            */
            $resultado_sys = true;

            if (isset($ajax_sys)) {
                echo json_encode([
                    'id' => $id_productos,
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "guardar-embalaje":
            if($id_tabla_relacionado > 0) {
                $result = $conn->query("UPDATE productos_embalajes SET cantidad='".$cantidad."',sumar='".$sumar."' WHERE id=".$id_tabla_relacionado." LIMIT 1");
            }else {
                $result = $conn->query("INSERT INTO productos_embalajes VALUES(
                                  NULL,
                                  ".$id_productos.",
                                  ".$id_producto_relacionado.",
                                  ".$cantidad.",
                                  ".$sumar.")");
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id' => $id_productos,
                    'resultado' => "ok"
                ]);
            }
            break;
        case "guardar-titulo":
            if($id_titulo > 0) {
                $query = "UPDATE productos_titulos SET descripcion='".addslashes($descripcion)."', modelo=".$modelo.", orden=".$orden." WHERE id=".$id_titulo." LIMIT 1";
            }else {
                $query = "INSERT INTO productos_titulos VALUES(
                                  NULL,
                                  ".$id_producto.",
                                  '".addslashes($descripcion)."',
                                  ".$modelo.",
                                  ".$orden.")";
                $id_titulo = $conn->id_insert();
            }
            $result = $conn->query($query);

            if ($tipo_producto == 1) {
                traspasarElaboradosACompuestos($id_producto, $conn);
            } else if ($tipo_producto != 2) {
                $result = $conn->query("UPDATE productos SET 
                                  tipo_producto='2' 
                                  WHERE id=".$id_producto." LIMIT 1");
            }

            eliminarRelacionados($id_titulo, $conn);
            if (is_array($relacionadosDescripciones)) {
                foreach($relacionadosDescripciones as $keyRelacionado => $relacionadoDescripcion) {
                    $id_producto_relacionado = (isset($idProductoRelacionado[$keyRelacionado]))? $idProductoRelacionado[$keyRelacionado] : '';
                    $query = "INSERT INTO productos_titulos_relacionados VALUES(
                                  NULL,
                                  " . $id_titulo . ",
                                  " . $id_producto_relacionado . ",
                                  '" . addslashes($relacionadoDescripcion) . "',
                                  " . (10 * ($keyRelacionado + 1)) . ")";
                    $result = $conn->query($query);

                    if (!$id_producto || !$id_producto_relacionado) {
                        continue;
                    }
                    $porDefecto = (isset($relacionadosDefecto[$keyRelacionado]) && $relacionadosDefecto[$keyRelacionado] != 'false' && !empty($relacionadosDefecto[$keyRelacionado]))? 0: 2;
                    $query = "INSERT INTO productos_relacionados VALUES(
                                      NULL,
                                      " . $id_producto . ",
                                      0,
                                      0,
                                      0,
                                      " . $id_producto_relacionado . ",
                                      0,
                                      0,
                                      " . $modelo . ",
                                      1,
                                      0,
                                      0,
                                      0,
                                      '',
                                      " . $porDefecto . ",
                                      1,
                                      " . (10 * ($keyRelacionado + 1)) . ")";
                    $result = $conn->query($query);
                    $idProductosRelacionados = $conn->id_insert();
                    if (!$idProductosRelacionados) {
                        continue;
                    }
                    foreach ($tarifas as $key_tarifa => $id_tarifa) {
                        if (!isset($sumarCon[$keyRelacionado]) || !isset($sumarCon[$keyRelacionado][$key_tarifa])) {
                            continue;
                        }
                        $query = "INSERT INTO productos_relacionados_incre VALUES(
                              NULL,
                              " . $idProductosRelacionados . ",
                              " . $id_tarifa . ",
                              " . $sumarCon[$keyRelacionado][$key_tarifa] . ",
                              0,
                              0,
                              0)";
                        $result = $conn->query($query);
                    }
                }
            }

            if (isset($ajax_sys)) {
                echo json_encode([
                    'resultado' => "ok"
                ]);
            }
            break;
        case "eliminar-titulo":
            eliminarRelacionados($id_titulo, $conn);

            $query = "DELETE FROM productos_titulos WHERE id=".$id_titulo." LIMIT 1";
            $result = $conn->query($query);
            if (isset($ajax_sys)) {
                echo json_encode([
                    'resultado' => "ok"
                ]);
            }
            break;
        case "guardar-elaborado":
            $logs_sys->Insert_elaborado1 = "id_producto_relacionado='".$id_productos_elaborados."'";
            $logs_sys->Insert_elaborado2 = "id_producto='".$id_productos."'";

            $total_cantidad = 0;
            $rentabilidad_productos_elaborados = 0;
            if($tipo_producto == 1) {
                $logs_sys->select1 = "SELECT cantidad,id_unidad FROM productos_relacionados_elaborados WHERE id_producto=" . $id_productos;
                $result_productos_relacionados_elaborados = $conn->query("SELECT cantidad,id_unidad 
                                        FROM productos_relacionados_elaborados WHERE id_producto=" . $id_productos);
                foreach ($result_productos_relacionados_elaborados as $key_productos_relacionados_elaborados => $valor_productos_relacionados_elaborados) {
                    if ($valor_productos_relacionados_elaborados['id_unidad'] != $id_unidades_base_productos_elaborados) {
                        $logs_sys->select2 = "SELECT conversion_principal FROM productos_unidades WHERE id_unidad=" . $id_unidades_base_productos_elaborados . " AND id_producto=" . $id_productos . " LIMIT 1";
                        $result_productos_unidades = $conn->query("SELECT conversion_principal 
                                        FROM productos_unidades WHERE id_unidad=" . $id_unidades_base_productos_elaborados . " AND id_producto=" . $id_productos . " LIMIT 1");
                        $total_cantidad += $valor_productos_relacionados_elaborados['cantidad'] * $result_productos_unidades[0]['conversion_principal'];
                    } else {
                        $total_cantidad += $valor_productos_relacionados_elaborados['cantidad'];
                    }
                }
                if ($total_cantidad != 0) {
                    $rentabilidad_productos_elaborados = $cantidad_base_productos_elaborados / $total_cantidad * 100;
                    $logs_sys->calculo = $rentabilidad_productos_elaborados . " = " . $cantidad_base_productos_elaborados . " / " . $total_cantidad . " * 100";
                }
            }
            if (empty($id_productos_elaborados)) {
                /*
                $logs_sys->insert = "INSERT INTO productos_costes VALUES(
                                          NULL,
                                          ".$id_productos.",
                                          ".$cantidad_base_productos_elaborados.",
                                          ".$id_unidades_base_productos_elaborados.",
                                          ".$rentabilidad_productos_elaborados.",
                                          ".$tiempo_productos_elaborados.",
                                          ".$id_categoria_elaborados_productos_elaborados.")";
                $result = $conn->query("INSERT INTO productos_costes VALUES(
                                          NULL,
                                          ".$id_productos.",
                                          ".$cantidad_base_productos_elaborados.",
                                          ".$id_unidades_base_productos_elaborados.",
                                          ".$rentabilidad_productos_elaborados.",
                                          ".$tiempo_productos_elaborados.",
                                          ".$id_categoria_elaborados_productos_elaborados.")");
                */
                $resultado_sys = "NO SE HA ENCONTRADO productos_costes";
            } else {
                $logs_sys->updat1 = "UPDATE productos_costes SET ";
                $logs_sys->updat2 = "cantidad_base='".$cantidad_base_productos_elaborados."',";
                $logs_sys->updat3 = "id_unidades_base='".$id_unidades_base_productos_elaborados."',";
                $logs_sys->updat4 = "rentabilidad=".$rentabilidad_productos_elaborados.",";
                $logs_sys->updat5 = "tiempo='".$tiempo_productos_elaborados."',";
                $logs_sys->updat7 = "WHERE id='" . $id_productos_elaborados . "' LIMIT 1";
                /*
                $result = $conn->query("UPDATE productos_costes SET 
                                          id_producto='".$id_productos."',
                                          cantidad_base='".$cantidad_base_productos_elaborados."',
                                          id_unidades_base='".$id_unidades_base_productos_elaborados."',
                                          rentabilidad=".$rentabilidad_productos_elaborados.",
                                          tiempo='".$tiempo_productos_elaborados."',
                                          id_categoria_elaborados='".$id_categoria_elaborados_productos_elaborados."' 
                                      WHERE id='" . $id_productos_elaborados . "' LIMIT 1");
                */
                $result = $conn->query("UPDATE productos_costes SET 
                                          cantidad_base='".$cantidad_base_productos_elaborados."',
                                          id_unidades_base='".$id_unidades_base_productos_elaborados."',
                                          rentabilidad=".$rentabilidad_productos_elaborados.",
                                          tiempo='".$tiempo_productos_elaborados."' 
                                      WHERE id='" . $id_productos_elaborados . "' LIMIT 1");
                $resultado_sys = "UPDATE ELABORADO";
            }

            if (isset($ajax_sys)) {
                echo json_encode([
                    'id' => $id_productos,
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar-relacionado-elaborados":
            $logs_sys->Delete_compuesto = "DELETE FROM productos_relacionados_elaborados WHERE id=".$id_producto_relacionado_elaborado." LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_relacionados_elaborados WHERE id=".$id_producto_relacionado_elaborado." LIMIT 1");
            $resultado_sys = "DELETE RELACIONADO ELABORADOS";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar-relacionado":
            $logs_sys->Delete_compuesto = "DELETE FROM productos_relacionados WHERE id=".$id_producto_relacionado." LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_relacionados WHERE id=".$id_producto_relacionado." LIMIT 1");
            $resultado_sys = "DELETE RELACIONADO";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar-embalaje":
            $logs_sys->Delete_embalaje = "DELETE FROM productos_embalajes WHERE id=".$id_producto_relacionado." LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_embalajes WHERE id=".$id_producto_relacionado." LIMIT 1");
            $resultado_sys = "DELETE EMBALAJE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar-relacionado-combo":
            $logs_sys->Delete_compuesto = "DELETE FROM productos_relacionados_combo WHERE id=".$id_producto_relacionado." LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_relacionados_combo WHERE id=".$id_producto_relacionado." LIMIT 1");
            $resultado_sys = "DELETE RELACIONADO";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "guardar-unidades":
            /*
            CREATE TABLE `productos_unidades` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_unidad` INT(11) NOT NULL DEFAULT '0',
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `principal` TINYINT(1) NOT NULL DEFAULT '0',
                `conversion_principal` DOUBLE(15,5) NOT NULL DEFAULT '1.00000',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
                `fecha_alta` DATE NULL DEFAULT NULL,
                `fecha_modificacion` DATE NULL DEFAULT NULL,
            */
            if($principal == 1) {
                $result = $conn->query("UPDATE productos_unidades SET principal='0' WHERE id_producto='".$id_productos."'");
            }
            if($id_productos_unidades == 0) {
                $logs_sys->Insert_unidad = "INSERT INTO productos_unidades VALUES(NULL,'".$id_unidades."','".$id_productos."','".$principal."','".$conversion."','".$activo."','".date("Y-m-d")."','".date("Y-m-d")."')<br />";
                $result = $conn->query("INSERT INTO productos_unidades VALUES(
                                            NULL,
                                            '".$id_unidades."',
                                            '".$id_productos."',
                                            '".$principal."',
                                            '".$conversion."',
                                            '".$activo."',
                                            '".date("Y-m-d")."',
                                            '".date("Y-m-d")."')");
                $resultado_sys = "INSERT UNIDAD";
                if (isset($ajax_sys)) {
                    echo json_encode([
                        'logs' => $logs_sys,
                        'resultado' => $resultado_sys
                    ]);
                }
            }else {
                $logs_sys->Update_unidad = "UPDATE productos_unidades SET id_unidad='".$id_unidades."',principal='".$principal."',conversion_principal='".$conversion."',activo='".$activo."',fecha_modificacion='".date("Y-m-d")."' WHERE id='".$id_productos_unidades."' LIMIT 1<br />";
                $result = $conn->query("UPDATE productos_unidades SET 
                                            id_unidad='".$id_unidades."',
                                            principal='".$principal."',
                                            conversion_principal='".$conversion."',
                                            activo='".$activo."',
                                            fecha_modificacion='".date("Y-m-d")."' WHERE id='".$id_productos_unidades."' LIMIT 1");
                $resultado_sys = "UPDATE UNIDAD";
                if (isset($ajax_sys)) {
                    echo json_encode([
                        'logs' => $logs_sys,
                        'resultado' => $resultado_sys
                    ]);
                }
            }
            break;
        case "eliminar-unidades":
            $id_productos_unidades = filter_input(INPUT_POST, 'id_productos_unidades', FILTER_SANITIZE_NUMBER_INT);
            $id_unidades = filter_input(INPUT_POST, 'id_unidades', FILTER_SANITIZE_NUMBER_INT);
            $conversion = $_POST['conversion'];
            $principal = filter_input(INPUT_POST, 'principal', FILTER_SANITIZE_NUMBER_INT);
            $activo = filter_input(INPUT_POST, 'activo', FILTER_SANITIZE_NUMBER_INT);

            $logs_sys->Delete_compuesto = "DELETE FROM productos_unidades WHERE id=".$id_productos_unidades." LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_unidades WHERE id=".$id_productos_unidades." LIMIT 1");
            $resultado_sys = "DELETE UNIDAD";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "guardarLoteElaboracion":
            if ($totalCantidadLineaElaboracion - $cantidadLineaElaboracion != 0) {
                $nuevaCantidad = $totalCantidadLineaElaboracion - $cantidadLineaElaboracion;
                $sql = "SELECT * FROM documentos_" . date('Y') . "_productos_sku_stock WHERE id=" . $id_linea_elaborado . " LIMIT 1";
                $result = $conn->query($sql);
                $conn->query("INSERT INTO documentos_" . date('Y') . "_productos_sku_stock VALUES(
                        NULL,
                        '" . $result[0]['id_producto'] ."',
                        '" . $result[0]['id_productos_sku'] ."',
                        '" . $result[0]['lote'] ."',
                        '" . $result[0]['caducidad'] ."',
                        '" . $result[0]['numero_serie'] ."',
                        '" . $result[0]['codigo_barras'] ."',
                        '" . $result[0]['tipo_documento'] ."',
                        '" . $result[0]['fecha'] ."',
                        '" . $result[0]['id_documento_1'] ."',
                        '" . $result[0]['id_documento_2'] ."',
                        '" . $result[0]['tipo_librador'] ."',
                        '" . $result[0]['id_librador'] ."',
                        '" . $result[0]['coste'] ."',
                        '" . number_format($nuevaCantidad, 5, ".", "") ."',
                        '" . $result[0]['id_unidades'] ."',
                        '" . $result[0]['unidad'] ."',
                        '" . $result[0]['importe'] ."',
                        '" . $result[0]['fecha_alta'] ."',
                        '" . $result[0]['fecha_modificacion'] ."')");
            }
            $sql = "UPDATE documentos_" . date('Y') . "_productos_sku_stock SET lote='" . addslashes($loteLineaElaboracion) . "', caducidad='" . addslashes($caducidadLineaElaboracion) . "', numero_serie='" . addslashes($numero_serieLineaElaboracion) . "', cantidad='" . number_format($cantidadLineaElaboracion, 5, ".", "") . "' WHERE id=" . $id_linea_elaborado . " LIMIT 1";
            echo $sql;
            $result = $conn->query($sql);
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys
                ]);
            }
            break;
        case "guardar-pack":
            if(empty($id_productos_packs)) {
                $error = "0";
                if (empty($cantidad_pack)) {
                    $error = "1";
                }
                if ($error == 0) {
                    if (!isset($pack_producto_enlazado) && !isset($pack_producto_multiple)) {
                        $logs_sys->info1 = "sin";
                        $result_select = $conn->query("SELECT id FROM productos_packs WHERE 
                            id_producto='" . $pack_producto . "' AND 
                            id_productos_detalles_enlazado=0 AND 
                            id_productos_detalles_multiples=0 AND
                            cantidad_pack=" . $cantidad_pack . " LIMIT 1");
                        if ($conn->registros() == 1) {
                            $logs_sys->info1 .= "UP";
                            $result_update = $conn->query("UPDATE productos_packs SET 
                                cantidad_pack='" . $cantidad_pack . "',
                                activo='" . $activo . "', 
                                orden='" . addslashes($orden_productos_packs) . "',
                                fecha_modificacion='" . date("Y-m-d") . "' 
                                WHERE id=" . $result_select[0]['id'] . " LIMIT 1");
                            $resultado_sys = "UPDATE";
                        } else {
                            $logs_sys->info1 .= "IN";
                            $result_insert = $conn->query("INSERT INTO productos_packs VALUES( 
                               NULL,
                               '" . $pack_producto . "',
                               '0',
                               '0',
                               '" . $cantidad_pack . "',
                               '" . $activo. "',
                               '" . $orden_productos_packs. "',
                               '" . date("Y-m-d") . "',
                               '" . date("Y-m-d") . "')");
                            $resultado_sys = "INSERT pack";
                            $id_packs = $conn->id_insert();

                            $result = $conn->query("INSERT INTO productos_otros VALUES(
                                NULL,
                                '".$pack_producto."',
                                '0',
                                '0',
                                '".$id_packs."',
                                '0',
                                '1',
                                '',
                                '1',
                                '".date("Y-m-d")."',
                                '0',
                                '1',
                                '0',
                                '0',
                                '1',
                                '0',
                                '0',
                                '0',
                                '0',
                                '0')");

                            $id_producto = $pack_producto;
                            $id_detalles_enlazado = 0;
                            $id_detalles_multiples = 0;
                            $select_sys = "copiar-pvp";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/pvp/gestion/datos-update-php.php");
                        }
                    } else if (isset($pack_producto_enlazado) && !isset($pack_producto_multiple)) {
                        $logs_sys->info2 = "E";
                        foreach ($pack_producto_enlazado as $key_producto_enlazado => $valor_producto_enlazado) {
                            $logs_sys->info2 .= "1(".$valor_producto_enlazado.")";
                            $result_select = $conn->query("SELECT id FROM productos_packs WHERE 
                                id_producto='" . $pack_producto . "' AND 
                                id_productos_detalles_enlazado='" . $valor_producto_enlazado . "' AND 
                                id_productos_detalles_multiples=0 AND
                                cantidad_pack=" . $cantidad_pack . " LIMIT 1");
                            if ($conn->registros() == 1) {
                                $logs_sys->info2 .= "UP";
                                $result_update = $conn->query("UPDATE productos_packs SET 
                                    cantidad_pack='" . $cantidad_pack . "',
                                    activo='" . $activo . "', 
                                    orden='" . addslashes($orden_productos_packs) . "',
                                    fecha_modificacion='" . date("Y-m-d") . "' 
                                    WHERE id=" . $result_select[0]['id'] . " LIMIT 1");
                                $resultado_sys = "UPDATE";
                            } else {
                                $logs_sys->info2 .= "IN";
                                $result_insert = $conn->query("INSERT INTO productos_packs VALUES( 
                                   NULL,
                                   '" . $pack_producto . "',
                                   '" . $valor_producto_enlazado . "',
                                   '0',
                                   '" . $cantidad_pack . "',
                                   '" . $activo . "',
                                   '" . addslashes($orden_productos_packs) . "',
                                   '" . date("Y-m-d") . "',
                                   '" . date("Y-m-d") . "')");
                                $resultado_sys = "INSERT pack";
                                $id_packs = $conn->id_insert();

                                $result = $conn->query("INSERT INTO productos_otros VALUES(
                                    NULL,
                                    '".$pack_producto."',
                                    '" . $valor_producto_enlazado . "',
                                    '0',
                                    '".$id_packs."',
                                    '0',
                                    '1',
                                    '',
                                    '1',
                                    '".date("Y-m-d")."',
                                    '0',
                                    '1',
                                    '0',
                                    '0',
                                    '1',
                                    '0',
                                    '0',
                                    '0',
                                    '0',
                                    '0')");

                                $id_producto = $pack_producto;
                                $id_detalles_enlazado = $valor_producto_enlazado;
                                $id_detalles_multiples = 0;
                                $select_sys = "copiar-pvp";
                                $logs_sys->info2 .= "A";
                                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/pvp/gestion/datos-update-php.php");
                                $logs_sys->info2 .= "B";
                            }
                        }
                    } else if (!isset($pack_producto_enlazado) && isset($pack_producto_multiple)) {
                        $logs_sys->info3 = "1";
                        foreach ($pack_producto_multiple as $key_producto_multiple => $valor_producto_multiple) {
                            $result_select = $conn->query("SELECT id FROM productos_packs WHERE 
                                id_producto='" . $pack_producto . "' AND 
                                id_productos_detalles_enlazado='0' AND 
                                id_productos_detalles_multiples='" . $valor_producto_multiple . "' AND
                                cantidad_pack=" . $cantidad_pack . " LIMIT 1");
                            if ($conn->registros() == 1) {
                                $logs_sys->info3 .= "UP";
                                $result_update = $conn->query("UPDATE productos_packs SET 
                                    cantidad_pack='" . $cantidad_pack . "',
                                    activo='" . $activo . "', 
                                    orden='" . addslashes($orden_productos_packs) . "',
                                    fecha_modificacion='" . date("Y-m-d") . "' 
                                    WHERE id=" . $result_select[0]['id'] . " LIMIT 1");
                                $resultado_sys = "UPDATE";
                            } else {
                                $logs_sys->info3 .= "IN";
                                $result_insert = $conn->query("INSERT INTO productos_packs VALUES( 
                                   NULL,
                                   '" . $pack_producto . "',
                                   '0',
                                   '" . $valor_producto_multiple . "',
                                   '" . $cantidad_pack . "',
                                   '" . $activo . "',
                                   '" . addslashes($orden_productos_packs) . "',
                                   '" . date("Y-m-d") . "',
                                   '" . date("Y-m-d") . "')");
                                $resultado_sys = "INSERT pack";
                                $id_packs = $conn->id_insert();

                                $result = $conn->query("INSERT INTO productos_otros VALUES(
                                    NULL,
                                    '".$pack_producto."',
                                    '0',
                                    '" . $valor_producto_multiple . "',
                                    '".$id_packs."',
                                    '0',
                                    '1',
                                    '',
                                    '1',
                                    '".date("Y-m-d")."',
                                    '0',
                                    '1',
                                    '0',
                                    '0',
                                    '1',
                                    '0',
                                    '0',
                                    '0',
                                    '0',
                                    '0')");

                                $id_producto = $pack_producto;
                                $id_detalles_enlazado = 0;
                                $id_detalles_multiples = $valor_producto_multiple;
                                $select_sys = "copiar-pvp";
                                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/pvp/gestion/datos-update-php.php");
                            }
                        }
                    }
                } else {
                    $resultado_sys = "INSERT ERROR unidades del pack";
                }
            }else {
                /*
                CREATE TABLE `productos_packs` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `id_producto` INT(11) NOT NULL DEFAULT '0',
                    `id_productos_detalles_enlazado` INT(11) NOT NULL DEFAULT '0',
                    `id_productos_detalles_multiples` INT(11) NOT NULL DEFAULT '0',
                    `cantidad_pack` DOUBLE(7,2) NULL DEFAULT NULL,
                    `activo` TINYINT(1) NOT NULL DEFAULT '1',
                    `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                    `fecha_alta` DATE NULL DEFAULT NULL,
                    `fecha_modificacion` DATE NULL DEFAULT NULL,

                $id_productos_packs = $_POST['id_productos_packs'];
                $cantidad_pack = $_POST['cantidad_pack'];
                $activo = $_POST['activo'];
                $orden_productos_packs = $_POST['orden_productos_packs'];
                */
                $logs_sys->update = "UPDATE productos_packs SET cantidad_pack='" . $cantidad_pack . "',activo='" . $activo . "',orden='" . $orden_productos_packs . "',fecha_modificacion='" . date("Y-m-d") . "' WHERE id=" . $id_productos_packs . " LIMIT 1<br />";
                $result = $conn->query("UPDATE productos_packs SET 
                               cantidad_pack='" . $cantidad_pack . "', 
                               activo='" . $activo . "', 
                               orden='" . $orden_productos_packs . "', 
                               fecha_modificacion='" . date("Y-m-d") . "' 
                               WHERE id=" . $id_productos_packs . " LIMIT 1");
                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_productos,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
        case "eliminar-pack":
            /*
            $id_productos_packs = $_POST['id_productos_packs'];
            $cantidad_pack = $_POST['cantidad_pack'];
            $activo = $_POST['activo'];
            $orden_productos_packs = $_POST['orden_productos_packs'];
            CREATE TABLE `productos_packs` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `id_productos_detalles_enlazado` INT(11) NOT NULL DEFAULT '0',
                `id_productos_detalles_multiples` INT(11) NOT NULL DEFAULT '0',
                `cantidad_pack` DOUBLE(7,2) NULL DEFAULT NULL,
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
                `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                `fecha_alta` DATE NULL DEFAULT NULL,
                `fecha_modificacion` DATE NULL DEFAULT NULL,
            CREATE TABLE `productos_detalles_enlazado` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_principal` INT(11) NOT NULL DEFAULT '0',
                `id_dato_principal` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_enlazado` INT(11) NOT NULL DEFAULT '0',
                `id_dato_enlazado` INT(11) NOT NULL DEFAULT '0',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
                `fecha_alta` DATE NOT NULL,
                `fecha_modificacion` DATE NOT NULL,
            */
            $logs_sys->Delete = "DELETE FROM productos_packs WHERE id=" . $id_productos_packs . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_packs WHERE id=" . $id_productos_packs . " LIMIT 1");
            $result = $conn->query("DELETE FROM productos_pvp WHERE id_packs=" . $id_productos_packs);
            $result = $conn->query("DELETE FROM productos_otros WHERE id_packs=" . $id_productos_packs);
            $resultado_sys = "DELETE-PACK";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_productos,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
    }
}