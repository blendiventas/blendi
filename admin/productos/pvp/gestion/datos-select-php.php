<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "detalles-ficha":
            if(empty($id_url)) {
                $matriz_id_productos_pvp[] = 0;
                $matriz_id_tarifa_productos_pvp[] = 0;
                $matriz_margen_productos_pvp[] = 0.00;
                $matriz_pvp_productos_pvp[] = 0.00;
                $matriz_id_ofertas_productos_pvp[] = 0;
                $matriz_oferta_desde_productos_pvp[] = "";
                $matriz_oferta_hasta_productos_pvp[] = "";
                $matriz_pvp_oferta_productos_pvp[] = 0.00;
            }else {
                $result = $conn->query("SELECT * FROM productos_pvp WHERE id_producto=" . $id_url." 
                                            AND id_productos_detalles_enlazado=0 
                                            AND id_productos_detalles_multiples=0 
                                            AND id_packs=0");
                foreach ($result as $key => $valor) {
                    $matriz_id_productos_pvp[] = $valor['id'];
                    $matriz_id_tarifa_productos_pvp[] = $valor['id_tarifa'];
                    $matriz_margen_productos_pvp[] = $valor['margen'];
                    $matriz_pvp_productos_pvp[] = $valor['pvp'];
                    $matriz_id_ofertas_productos_pvp[] = $valor['id_ofertas'];
                    $matriz_oferta_desde_productos_pvp[] = $valor['oferta_desde'];
                    $matriz_oferta_hasta_productos_pvp[] = $valor['oferta_hasta'];
                    $matriz_pvp_oferta_productos_pvp[] = $valor['pvp_oferta'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_productos_pvp' => $matriz_id_productos_pvp,
                    'matriz_id_tarifa_productos_pvp' => $matriz_id_tarifa_productos_pvp,
                    'matriz_margen_productos_pvp' => $matriz_margen_productos_pvp,
                    'matriz_pvp_productos_pvp' => $matriz_pvp_productos_pvp,
                    'matriz_id_ofertas_productos_pvp' => $matriz_id_ofertas_productos_pvp,
                    'matriz_oferta_desde_productos_pvp' => $matriz_oferta_desde_productos_pvp,
                    'matriz_oferta_hasta_productos_pvp' => $matriz_oferta_hasta_productos_pvp,
                    'matriz_pvp_oferta_productos_pvp' => $matriz_pvp_oferta_productos_pvp
                ]);
            }
            break;
        case "detalles-ficha-tarifa":
            $result_productos_pvp = $conn->query("SELECT * FROM productos_pvp WHERE 
                              id_producto=" . $id_producto_productos_pvp . " AND 
                              id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_pvp . " AND 
                              id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_pvp . " AND 
                              id_packs=" . $id_packs_productos_pvp . " AND 
                              id_tarifa=" . $valor_id_tarifas . " LIMIT 1");
            foreach ($result_productos_pvp as $key_productos_pvp => $valor_productos_pvp) {
                $id_productos_pvp = $valor_productos_pvp['id'];
                $id_tarifa_productos_pvp = $valor_productos_pvp['id_tarifa'];
                $margen_productos_pvp = $valor_productos_pvp['margen'];
                $pvp_productos_pvp = $valor_productos_pvp['pvp'];
                $id_ofertas_productos_pvp = $valor_productos_pvp['id_ofertas'];
                $oferta_desde_productos_pvp = $valor_productos_pvp['oferta_desde'];
                $oferta_hasta_productos_pvp = $valor_productos_pvp['oferta_hasta'];
                $pvp_oferta_productos_pvp = $valor_productos_pvp['pvp_oferta'];
                if (isset($pvp_iva_incluido) && $pvp_iva_incluido == 0) {
                    $result_iva = $conn->query("SELECT pi.iva AS iva FROM productos p JOIN productos_iva pi ON p.id_iva = pi.id WHERE p.id = " . $id_producto_productos_pvp);
                    $iva_aplicar = 0;
                    if ($conn->registros() >= 1) {
                        $iva_aplicar = $result_iva[0]['iva'];
                    }

                    $pvp_productos_pvp /= (1 + ($iva_aplicar / 100));
                    $pvp_oferta_productos_pvp /= (1 + ($iva_aplicar / 100));
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_productos_pvp' => $id_productos_pvp,
                    'id_tarifa_productos_pvp' => $id_tarifa_productos_pvp,
                    'margen_productos_pvp' => $margen_productos_pvp,
                    'pvp_productos_pvp' => $pvp_productos_pvp,
                    'id_ofertas_productos_pvp' => $id_ofertas_productos_pvp,
                    'oferta_desde_productos_pvp' => $oferta_desde_productos_pvp,
                    'oferta_hasta_productos_pvp' => $oferta_hasta_productos_pvp,
                    'pvp_oferta_productos_pvp' => $pvp_oferta_productos_pvp
                ]);
            }
            break;
    }
}