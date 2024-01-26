<?php
switch ($select_sys) {
    case "detalle-de":
        $result = $conn->query("SELECT detalle FROM productos_detalles WHERE id=" . $de_sys . " LIMIT 1");
        if ($conn->registros() == 1) {
            $detalle_de_productos_detalles = stripslashes($result[0]['detalle']);
        }
        if (isset($ajax)) {
            echo json_encode([
                'logs' => $matriz_logs_sys,
                'detalle_de_productos_detalles' => $detalle_de_productos_detalles
            ]);
        }
        break;
    case "dato-de":
        $result = $conn->query("SELECT detalle FROM productos_detalles_datos WHERE id=" . $de_sys . " LIMIT 1");
        if ($conn->registros() == 1) {
            $dato_de_productos_detalles = stripslashes($result[0]['detalle']);
        }
        if (isset($ajax)) {
            echo json_encode([
                'logs' => $matriz_logs_sys,
                'dato_de_productos_detalles' => $dato_de_productos_detalles
            ]);
        }
        break;
    case "descripcion_enlazado":
        $descripcion_enlazado = "";
        $result_productos_detalles_relacion = $conn->query("SELECT * FROM productos_detalles_enlazado WHERE id=" . $id_enlazado." LIMIT 1");
        if($conn->registros() == 1) {
            $de_sys = $result_productos_detalles_relacion[0]['id_atributo_principal'];
            $select_sys = "detalle-de";
            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
            $descripcion_enlazado = $detalle_de_productos_detalles.": ";
            $de_sys = $result_productos_detalles_relacion[0]['id_dato_principal'];
            $select_sys = "dato-de";
            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
            $descripcion_enlazado .= $dato_de_productos_detalles;
            $de_sys = $result_productos_detalles_relacion[0]['id_atributo_enlazado'];
            $select_sys = "detalle-de";
            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
            $descripcion_enlazado .= " / ".$detalle_de_productos_detalles.": ";
            $de_sys = $result_productos_detalles_relacion[0]['id_dato_enlazado'];
            $select_sys = "dato-de";
            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
            $descripcion_enlazado .= $dato_de_productos_detalles;
        }
        break;
    case "descripcion_multiple":
        $descripcion_multiples = "";
        $result_productos_detalles_relacion = $conn->query("SELECT * FROM productos_detalles_multiples WHERE id=" . $id_multiple." LIMIT 1");
        if($conn->registros() == 1) {
            $de_sys = $result_productos_detalles_relacion[0]['id_atributo'];
            $select_sys = "detalle-de";
            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
            $descripcion_multiples = $detalle_de_productos_detalles.": ";
            $de_sys = $result_productos_detalles_relacion[0]['id_dato'];
            $select_sys = "dato-de";
            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
            $descripcion_multiples .= $dato_de_productos_detalles;
        }
        break;
    case "datos-enlazados":
        $result_productos_detalles_relacion = $conn->query("SELECT * FROM productos_detalles_enlazado WHERE id_producto=" . $id_producto_sys." ORDER BY id");
        if($conn->registros() >= 1) {
            foreach ($result_productos_detalles_relacion as $key_productos_detalles_relacion => $valor_productos_detalles_relacion) {
                $matriz_productos_detalles_relacion_id[] = $valor_productos_detalles_relacion['id'];
                $matriz_productos_detalles_relacion_id_atributo_principal[] = $valor_productos_detalles_relacion['id_atributo_principal'];
                $matriz_productos_detalles_relacion_id_dato_principal[] = $valor_productos_detalles_relacion['id_dato_principal'];
                $matriz_productos_detalles_relacion_id_atributo_enlazado[] = $valor_productos_detalles_relacion['id_atributo_enlazado'];
                $matriz_productos_detalles_relacion_id_dato_enlazado[] = $valor_productos_detalles_relacion['id_dato_enlazado'];
                $matriz_productos_detalles_relacion_activo[] = $valor_productos_detalles_relacion['activo'];
            }

            if(empty($id_productos_detalles_url)) {
                $result_productos_detalles = $conn->query("SELECT id,detalle FROM productos_detalles WHERE id_idioma=" . $id_idioma . " AND activo=1 ORDER BY orden");
            }else {
                $result_productos_detalles = $conn->query("SELECT id,detalle FROM productos_detalles WHERE id_idioma=" . $id_idioma . " AND id<>'" . $id_productos_detalles_url . "' AND activo=1 ORDER BY orden");
            }
            foreach ($result_productos_detalles as $key_productos_detalles => $valor_productos_detalles) {
                $matriz_id_productos_detalles[] = $valor_productos_detalles['id'];
                $matriz_detalle_productos_detalles[] = stripslashes($valor_productos_detalles['detalle']);
            }
            if(isset($matriz_id_productos_detalles)) {
                foreach ($matriz_id_productos_detalles as $key_productos_detalles => $valor_productos_detalles) {
                    $atributos_disponibles[$valor_productos_detalles] = $matriz_detalle_productos_detalles[$key_productos_detalles];
                    $id_productos_detalles_url = $valor_productos_detalles;
                    $result_productos_detalles_datos = $conn->query("SELECT id,detalle,orden,activo FROM productos_detalles_datos WHERE id_productos_detalles=" . $id_productos_detalles_url . " ORDER BY orden");
                    foreach ($result_productos_detalles_datos as $key_productos_detalles_datos => $valor_productos_detalles_datos) {
                        $matriz_id_productos_detalles_datos[] = $valor_productos_detalles_datos['id'];
                        $matriz_detalle_productos_detalles_datos[] = stripslashes($valor_productos_detalles_datos['detalle']);
                        $matriz_orden_productos_detalles_datos[] = stripslashes($valor_productos_detalles_datos['orden']);
                        $matriz_activo_productos_detalles_datos[] = $valor_productos_detalles_datos['activo'];
                    }
                    if(isset($matriz_id_productos_detalles_datos)) {
                        foreach ($matriz_id_productos_detalles_datos as $key_productos_detalles_datos => $valor_productos_detalles_datos) {
                            $datos_atributos_disponibles[$valor_productos_detalles][$valor_productos_detalles_datos] = $matriz_detalle_productos_detalles_datos[$key_productos_detalles_datos];
                        }
                        unset($matriz_id_productos_detalles_datos);
                        unset($matriz_detalle_productos_detalles_datos);
                        unset($matriz_orden_productos_detalles_datos);
                        unset($matriz_activo_productos_detalles_datos);
                    }
                }
                unset($matriz_id_productos_detalles);
                unset($matriz_detalle_productos_detalles);
            }

            foreach ($matriz_productos_detalles_relacion_id as $Key_productos_detalles_relacion_id => $valor_productos_detalles_relacion_id) {
                $matriz_id[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = $valor_productos_detalles_relacion_id;
                $id_atributo_vertical = $matriz_productos_detalles_relacion_id_atributo_principal[$Key_productos_detalles_relacion_id];
                $atributo_vertical = $atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_principal[$Key_productos_detalles_relacion_id]];
                $matriz_vertical_datos[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]] = $datos_atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]];
                $id_atributo_horizontal = $matriz_productos_detalles_relacion_id_atributo_enlazado[$Key_productos_detalles_relacion_id];
                $atributo_horizontal = $atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_enlazado[$Key_productos_detalles_relacion_id]];
                $matriz_horizontal_datos[$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = $datos_atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_enlazado[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]];
                if($valor_productos_detalles_relacion_id == $id_enlazados_producto_sys[$key] OR $id_enlazados_producto_sys[$key] == 0) {
                    $matriz_activo[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = $matriz_productos_detalles_relacion_activo[$Key_productos_detalles_relacion_id];
                }else {
                    $matriz_activo[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = 0;
                }
            }
        }
        break;
    case "datos-enlazados-pvp":
        $result_pvp = $conn->query("SELECT pvp,id_ofertas,oferta_desde,oferta_hasta,pvp_oferta FROM productos_pvp WHERE 
                                    id_producto=" . $id_producto_sys." AND 
                                    id_productos_detalles_enlazado=" . $matriz_id[$Key_vertical_datos][$Key_horizontal_datos]." AND 
                                    id_productos_detalles_multiples=" . $id_multiples_producto_sys[$key]." AND 
                                    id_packs=" . $id_packs_producto_sys[$key]." AND 
                                    id_tarifa=" . $id_tarifa_web." LIMIT 1");
        if($conn->registros() == 1) {
            if($profesionales_producto_sys[$key] == 1) {
                $pvp_atributos[$indice_atributos] = "Consultar ".$etiqueta_pvp;
            }
            $descripcion_oferta_atributos[$indice_atributos] = "";
            $pvp_atributos[$indice_atributos] = $result_pvp[0]['pvp'];
            if(!empty($result_pvp[0]['id_ofertas'])) {
                $result_oferta = $conn->query("SELECT descripcion FROM ofertas WHERE 
                                    id=" . $result_pvp[0]['id_ofertas']." AND activo=1 LIMIT 1");
                if($conn->registros() == 1) {
                    $descripcion_oferta_atributos[$indice_atributos] = stripslashes($result_pvp[0]['descripcion']);
                    if ($result_pvp[0]['oferta_desde'] >= date("Y-m-d") && $result_pvp[0]['oferta_hasta'] <= date("Y-m-d")) {
                        $pvp_atributos[$indice_atributos] = $result_pvp[0]['pvp_oferta'];
                    }
                }
            }
        }
        break;
    case "datos-multiples":
        $result_productos_detalles_multiples = $conn->query("SELECT id,id_atributo,id_dato,activo FROM productos_detalles_multiples WHERE id_producto=" . $id_producto_sys." ORDER BY id");
        if($conn->registros() >= 1) {
            foreach ($result_productos_detalles_multiples as $key_productos_detalles_multiples => $valor_productos_detalles_multiples) {
                $matriz_productos_detalles_multiples_id[] = $valor_productos_detalles_multiples['id'];
                $productos_detalles_multiples_id_atributo = $valor_productos_detalles_multiples['id_atributo'];
                $matriz_productos_detalles_multiples_id_dato[] = $valor_productos_detalles_multiples['id_dato'];
                if($valor_productos_detalles_multiples['id'] == $id_multiples_producto_sys[$key] OR $id_multiples_producto_sys[$key] == 0) {
                    $matriz_productos_detalles_multiples_activo[] = $valor_productos_detalles_multiples['activo'];
                }else {
                    $matriz_productos_detalles_multiples_activo[] = 0;
                }
            }

            if(empty($id_productos_detalles_url)) {
                $result_productos_detalles = $conn->query("SELECT id,detalle FROM productos_detalles WHERE id_idioma=" . $id_idioma . " AND activo=1 ORDER BY orden");
            }else {
                $result_productos_detalles = $conn->query("SELECT id,detalle FROM productos_detalles WHERE id_idioma=" . $id_idioma . " AND id<>'" . $id_productos_detalles_url . "' AND activo=1 ORDER BY orden");
            }
            foreach ($result_productos_detalles as $key_productos_detalles => $valor_productos_detalles) {
                $matriz_id_productos_detalles[] = $valor_productos_detalles['id'];
                $matriz_detalle_productos_detalles[] = stripslashes($valor_productos_detalles['detalle']);
            }
            if(isset($matriz_id_productos_detalles)) {
                foreach ($matriz_id_productos_detalles as $key_productos_detalles => $valor_productos_detalles) {
                    $atributos_disponibles[$valor_productos_detalles] = $matriz_detalle_productos_detalles[$key_productos_detalles];
                    $id_productos_detalles_url = $valor_productos_detalles;
                    $result_productos_detalles_datos = $conn->query("SELECT id,detalle,orden,activo FROM productos_detalles_datos WHERE id_productos_detalles=" . $id_productos_detalles_url . " ORDER BY orden");
                    foreach ($result_productos_detalles_datos as $key_productos_detalles_datos => $valor_productos_detalles_datos) {
                        $matriz_id_productos_detalles_datos[] = $valor_productos_detalles_datos['id'];
                        $matriz_detalle_productos_detalles_datos[] = stripslashes($valor_productos_detalles_datos['detalle']);
                        $matriz_orden_productos_detalles_datos[] = stripslashes($valor_productos_detalles_datos['orden']);
                        $matriz_activo_productos_detalles_datos[] = $valor_productos_detalles_datos['activo'];
                    }
                    if(isset($matriz_id_productos_detalles_datos)) {
                        foreach ($matriz_id_productos_detalles_datos as $key_productos_detalles_datos => $valor_productos_detalles_datos) {
                            $datos_atributos_disponibles[$valor_productos_detalles][$valor_productos_detalles_datos] = $matriz_detalle_productos_detalles_datos[$key_productos_detalles_datos];
                        }
                        unset($matriz_id_productos_detalles_datos);
                        unset($matriz_detalle_productos_detalles_datos);
                        unset($matriz_orden_productos_detalles_datos);
                        unset($matriz_activo_productos_detalles_datos);
                    }
                }
                unset($matriz_id_productos_detalles);
                unset($matriz_detalle_productos_detalles);
            }
        }
        break;
    case "datos-multiples-pvp":
        $result_pvp = $conn->query("SELECT pvp,id_ofertas,oferta_desde,oferta_hasta,pvp_oferta FROM productos_pvp WHERE 
                                id_producto=" . $id_producto_sys." AND 
                                id_productos_detalles_enlazado=" . $id_enlazados_producto_sys[$key]." AND 
                                id_productos_detalles_multiples=" . $matriz_productos_detalles_multiples_id[$contador_id_productos_detalles_multiples]." AND 
                                id_packs=" . $id_packs_producto_sys[$key]." AND 
                                id_tarifa=" . $id_tarifa_web." LIMIT 1");
        if($conn->registros() == 1) {
            if($profesionales_producto_sys[$key] == 1) {
                $pvp_atributos[$indice_atributos] = "Consultar ".$etiqueta_pvp;
            }
            $descripcion_oferta_atributos[$indice_atributos] = "";
            $pvp_atributos[$indice_atributos] = $result_pvp[0]['pvp'];
            if(!empty($result_pvp[0]['id_ofertas'])) {
                $result_oferta = $conn->query("SELECT descripcion FROM ofertas WHERE 
                                                            id=" . $result_pvp[0]['id_ofertas']." AND activo=1 LIMIT 1");
                if($conn->registros() == 1) {
                    $descripcion_oferta_atributos[$indice_atributos] = stripslashes($result_pvp[0]['descripcion']);
                    if ($result_pvp[0]['oferta_desde'] >= date("Y-m-d") && $result_pvp[0]['oferta_hasta'] <= date("Y-m-d")) {
                        $pvp_atributos[$indice_atributos] = $result_pvp[0]['pvp_oferta'];
                    }
                }
            }
        }
        break;
}