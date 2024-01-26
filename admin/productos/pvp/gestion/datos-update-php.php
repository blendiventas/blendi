<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(!isset($logs_sys)) {
    $logs_sys = new stdClass();
}

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "guardar-base":
            $logs_sys->select = "";
            $logs_sys->pvp = "";
            foreach ($id_tarifas as $key => $valor) {
                $logs_sys->select .= "(".$valor.")";
                $result_productos_pvp = $conn->query("SELECT id FROM productos_pvp WHERE 
                                       id_producto='" . $id_productos . "' AND 
                                       id_productos_detalles_enlazado=0 AND 
                                       id_productos_detalles_multiples=0 AND 
                                       id_packs=0 AND id_tarifa='".$valor."' LIMIT 1");

                if ($conn->registros() == 0) {
                    //$logs_sys->pvp1 = "INSERT INTO productos_pvp VALUES(NULL,'" . $id_productos . "','0','0','0','" . $id_tarifas[$key] . "','" . $margen_productos_pvp[$key] . "','" . $pvp_productos_pvp[$key] . "','" . date("Y-m-d") . "',0,'','',0.00)";
                    $result = $conn->query("INSERT INTO productos_pvp VALUES(
                                          NULL,
                                          '" . $id_productos . "',
                                          '0',
                                          '0',
                                          '0',
                                          '" . $id_tarifas[$key] . "',
                                          '" . $margen_productos_pvp[$key] . "',
                                          '" . $pvp_productos_pvp[$key] . "',
                                          '" . date("Y-m-d") . "',
                                          0,
                                          '',
                                          '',
                                          0.00)");
                    $id_productos_pvp = $conn->id_insert();
                    $resultado_sys = "INSERT";
                } else {
                    //$logs_sys->pvp .= "UPDATE productos_pvp SET margen='" . $margen_productos_pvp[$key] . "',pvp='" . $pvp_productos_pvp[$key] . "',fecha_modificacion='" . date("Y-m-d") . "',id_ofertas='" . $id_ofertas_productos_pvp . "',oferta_desde='" . $oferta_desde_productos_pvp . "',oferta_hasta='" . $oferta_hasta_productos_pvp . "',pvp_oferta='" . $pvp_oferta_productos_pvp . "' WHERE id=" . $result_productos_pvp[0]['id'] . " LIMIT 1<br />";
                    $result = $conn->query("UPDATE productos_pvp SET 
                                margen='" . $margen_productos_pvp[$key] . "', 
                                pvp='" . $pvp_productos_pvp[$key] . "', 
                                fecha_modificacion='" . date("Y-m-d") . "', 
                                id_ofertas='" . $id_ofertas_productos_pvp . "', 
                                oferta_desde='" . $oferta_desde_productos_pvp . "', 
                                oferta_hasta='" . $oferta_hasta_productos_pvp . "', 
                                pvp_oferta='" . $pvp_oferta_productos_pvp . "' 
                              WHERE id=" . $result_productos_pvp[0]['id'] . " LIMIT 1");

                    $resultado_sys = "UPDATE";
                }
            }
            break;
        case "guardar-pvp":
            /*
            CREATE TABLE `productos_pvp` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `id_productos_detalles_enlazado` INT(11) NOT NULL DEFAULT '0',
                `id_productos_detalles_multiples` INT(11) NOT NULL DEFAULT '0',
                `id_packs` INT(11) NOT NULL DEFAULT '0',
                `id_tarifa` INT(11) NOT NULL DEFAULT '0',
                `margen` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
                `pvp` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
                `fecha_modificacion` DATE NULL DEFAULT NULL,
                `id_ofertas` INT(11) NOT NULL DEFAULT '0',
                `oferta_desde` DATE NULL DEFAULT NULL,
                `oferta_hasta` DATE NULL DEFAULT NULL,
                `pvp_oferta` DOUBLE(15,5) NULL DEFAULT '0.00000',

            $id_productos_pvp
            $id_producto
            $id_detalles_enlazado
            $id_detalles_multiples
            $id_packs
            $id_tarifas

            $margen
            $pvp

            $id_ofertas
            $oferta_desde
            $oferta_hasta
            $pvp_oferta
            */
            if (empty($id_productos_pvp)) {
                $logs_sys->pvp1 = "INSERT INTO productos_pvp VALUES(NULL,'" . $id_producto . "','" . $id_detalles_enlazado . "','" . $id_detalles_multiples . "','" . $id_packs . "','" . $id_tarifas . "','" . $margen . "','" . $pvp . "','" . date("Y-m-d") . "','" . $id_ofertas . "','" . $oferta_desde . "','" . $oferta_hasta . "','" . $pvp_oferta . "')";
                $result = $conn->query("INSERT INTO productos_pvp VALUES(
                                      NULL,
                                      '" . $id_producto . "',
                                      '" . $id_detalles_enlazado . "',
                                      '" . $id_detalles_multiples . "',
                                      '" . $id_packs . "',
                                      '" . $id_tarifas . "',
                                      '" . $margen . "',
                                      '" . $pvp . "',
                                      '" . date("Y-m-d") . "',
                                      '" . $id_ofertas . "',
                                      '" . $oferta_desde . "',
                                      '" . $oferta_hasta . "',
                                      '" . $pvp_oferta . "')");
                $id_productos_pvp = $conn->id_insert();
                $resultado_sys = "INSERT";
            } else {
                $logs_sys->pvp2 = "UPDATE productos_pvp SET 
                            margen='" . $margen . "', 
                            pvp='" . $pvp . "', 
                            fecha_modificacion='".date("Y-m-d")."', 
                            id_ofertas='" . $id_ofertas . "', 
                            oferta_desde='" . $oferta_desde . "', 
                            oferta_hasta='" . $oferta_hasta . "', 
                            pvp_oferta='" . $pvp_oferta . "' 
                          WHERE id=" . $id_productos_pvp . " LIMIT 1<br />";
                $result = $conn->query("UPDATE productos_pvp SET 
                            margen='" . $margen . "', 
                            pvp='" . $pvp . "', 
                            fecha_modificacion='".date("Y-m-d")."', 
                            id_ofertas='" . $id_ofertas . "', 
                            oferta_desde='" . $oferta_desde . "', 
                            oferta_hasta='" . $oferta_hasta . "', 
                            pvp_oferta='" . $pvp_oferta . "' 
                          WHERE id=" . $id_productos_pvp . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_producto,
                    'apartado' => "pvp",
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "copiar-pvp":
            unset($ajax_sys);
            $id_url = $id_producto;
            $select_sys = "detalles-ficha";
            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/pvp/gestion/datos-select-php.php");
            if(isset($matriz_id_productos_pvp)) {
                foreach ($matriz_id_tarifa_productos_pvp as $key_id_tarifa_productos_pvp => $valor_id_tarifa_productos_pvp) {
                    if(empty($cantidad_pack)) {
                        $pvp_copiar = $matriz_pvp_productos_pvp[$key_id_tarifa_productos_pvp];
                    }else {
                        $pvp_copiar = $matriz_pvp_productos_pvp[$key_id_tarifa_productos_pvp] * $cantidad_pack;
                    }
                    $logs_sys->insertPVP = "";
                    $result = $conn->query("INSERT INTO productos_pvp VALUES(
                                      NULL,
                                      '" . $id_producto . "',
                                      '" . $id_detalles_enlazado . "',
                                      '" . $id_detalles_multiples . "',
                                      '" . $id_packs . "',
                                      '" . $valor_id_tarifa_productos_pvp . "',
                                      '" . $matriz_margen_productos_pvp[$key_id_tarifa_productos_pvp] . "',
                                      '" . $pvp_copiar . "',
                                      '" . date("Y-m-d") . "',
                                      '0',
                                      '0000-00-00',
                                      '0000-00-00',
                                      '0.00')");
                }
                unset($matriz_id_productos_pvp);
                unset($matriz_id_tarifa_productos_pvp);
                unset($matriz_margen_productos_pvp);
                unset($matriz_pvp_productos_pvp);
                unset($matriz_id_ofertas_productos_pvp);
                unset($matriz_oferta_desde_productos_pvp);
                unset($matriz_oferta_hasta_productos_pvp);
                unset($matriz_pvp_oferta_productos_pvp);
            }
            $ajax_sys = true;
            break;
    }
}