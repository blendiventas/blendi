<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

switch ($select_sys) {
    case "obtener_metodos_envio_html":
        if (empty($id_zona)) {
            $id_zona = 0;
        }
        $select_sys = "obtener_metodos_envio";
        require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-checkout.php");
        foreach ($id_modalidades_envio as $key_modalidad_envio => $id_modalidad_envio) {
            $incremento_pvp = $incremento_pvp_modalidades_envio[$key_modalidad_envio];
            if ($incremento_pvp_zona_modalidades_envio[$key_modalidad_envio]) {
                $incremento_pvp = $incremento_pvp_zona_modalidades_envio[$key_modalidad_envio];
            }
            if ($incremento_pvp_zona_peso_modalidades_envio[$key_modalidad_envio]) {
                $incremento_pvp = $incremento_pvp_zona_peso_modalidades_envio[$key_modalidad_envio];
            }
            ?>
            <div class="flex mb-3 font-bold font-heading text-gray-600">
                <input class="mr-5 mt-1" type="radio" name="modalidad_envio" id="modalidad_envio_<?php echo $key_modalidad_envio; ?>" data-precio="<?php echo $incremento_pvp; ?>" value="<?php echo $id_modalidad_envio; ?>" onclick="actualizarModalidadEnvio(<?php echo $key_modalidad_envio; ?>)">
                <div class="grow"><?php echo $descripcion_modalidades_envio[$key_modalidad_envio]; ?></div>
                <span>
                    <?php
                    echo number_format($incremento_pvp, 2, ',', '.');
                    ?>€
                </span>
            </div>
            <div class="mb-5">
                <?php echo $explicacion_modalidades_envio[$key_modalidad_envio]; ?>
            </div>
            <?php
        }
        unset($id_modalidades_envio);
        unset($descripcion_modalidades_envio);
        unset($explicacion_modalidades_envio);
        unset($id_iva_modalidades_envio);
        unset($incremento_pvp_modalidades_envio);
        break;
    case "obtener_metodos_envio":
        $query = "SELECT me.*, mez.id AS id_mez, mez.incremento_pvp AS incremento_pvp_zona, mez.incremento_por_kilo AS incremento_por_kilo_zona, mez.volumen_maximo_bulto FROM modalidades_envio me LEFT OUTER JOIN modalidades_envio_zonas mez ON me.id = mez.id_modalidad_envio AND mez.id_zona = '" . $id_zona . "' GROUP BY me.id ORDER BY me.incremento_pvp";
        $result_modalidades_envio = $conn->query($query);

        $id_modalidades_envio = [];
        $descripcion_modalidades_envio = [];
        $explicacion_modalidades_envio = [];
        $id_iva_modalidades_envio = [];
        $incremento_pvp_modalidades_envio = [];
        $incremento_pvp_zona_modalidades_envio = [];
        $incremento_por_kilo_modalidades_envio = [];
        $volumen_maximo_bulto_modalidades_envio = [];
        $incremento_pvp_zona_peso_modalidades_envio = [];
        if ($conn->registros() > 0) {
            foreach ($result_modalidades_envio as $modalidad_envio_value) {
                $id_modalidades_envio[] = $modalidad_envio_value['id'];
                $descripcion_modalidades_envio[] = $modalidad_envio_value['descripcion'];
                $explicacion_modalidades_envio[] = $modalidad_envio_value['explicacion'];
                $id_iva_modalidades_envio[] = $modalidad_envio_value['id_iva'];

                $incremento_pvp_modalidades_envio[] = $modalidad_envio_value['incremento_pvp']; // PVP Modalidad envío

                $incremento_pvp_zona_modalidades_envio[] = $modalidad_envio_value['incremento_pvp_zona']; // PVP Modalidad envío por zona

                $incremento_por_kilo_modalidades_envio[] = $modalidad_envio_value['incremento_por_kilo_zona'];
                $volumen_maximo_bulto_modalidades_envio[] = $modalidad_envio_value['volumen_maximo_bulto'];

                // PVP Modalidad envío por zona y peso
                $peso_total = 0;
                $result_franjas = $conn->query("SELECT * FROM modalidades_envio_zonas_franjas WHERE id_modalidad_envio_zona = " . $modalidad_envio_value['id_mez'] . " ORDER BY volumen_hasta");
                if ($conn->registros() > 0 && $id_documento_1) {
                    $result_producto_peso = $conn->query("SELECT p.peso_bruto, d2.cantidad FROM productos p JOIN documentos_temp_2 d2 ON p.id = d2.id_producto WHERE d2.id_documentos_1 = " . $id_documento_1);

                    if ($conn->registros() > 0) {
                        foreach ($result_producto_peso as $producto_peso) {
                            $peso_total += $producto_peso['cantidad'] * floatval($producto_peso['peso_bruto']);
                        }

                        if ($peso_total <= 0) {
                            $incremento_pvp_zona_peso_modalidades_envio[] = 0;
                        }
                    } else {
                        $incremento_pvp_zona_peso_modalidades_envio[] = 0;
                    }
                } else {
                    $incremento_pvp_zona_peso_modalidades_envio[] = 0;
                }

                if ($peso_total > 0) {
                    $incremento_pvp_mez_franjas = [];
                    $volumen_desde_mez_franjas = [];
                    $volumen_hasta_mez_franjas = [];
                    foreach ($result_franjas as $franja) {
                        $incremento_pvp_mez_franjas[] = $franja['incremento_pvp'];
                        $volumen_desde_mez_franjas[] = $franja['volumen_desde'];
                        $volumen_hasta_mez_franjas[] = $franja['volumen_hasta'];
                    }

                    $incremento_pvp_peso = 0;
                    $key_franja_maxima = count($volumen_hasta_mez_franjas) - 1;
                    while ($peso_total > 0) {
                        $peso_por_kilo = 0;
                        if ($peso_total > $modalidad_envio_value['volumen_maximo_bulto']) {
                            $incremento_pvp_peso += $incremento_pvp_mez_franjas[$key_franja_maxima];
                            $peso_por_kilo = $modalidad_envio_value['volumen_maximo_bulto'] - $volumen_hasta_mez_franjas[$key_franja_maxima];
                            $incremento_pvp_peso += $peso_por_kilo * $modalidad_envio_value['incremento_por_kilo_zona'];
                            $peso_total -= $modalidad_envio_value['volumen_maximo_bulto'];
                        } else {
                            if ($peso_total > $volumen_hasta_mez_franjas[$key_franja_maxima]) {
                                $incremento_pvp_peso += $incremento_pvp_mez_franjas[$key_franja_maxima];
                                $peso_por_kilo = $peso_total - $volumen_hasta_mez_franjas[$key_franja_maxima];
                                $incremento_pvp_peso += $peso_por_kilo * $modalidad_envio_value['incremento_por_kilo_zona'];
                            } else {
                                $key_franja_aplicar = $key_franja_maxima;
                                foreach ($incremento_pvp_mez_franjas as $key_franja => $incremento_pvp_mez_franja) {
                                    if ($peso_total >= $volumen_desde_mez_franjas[$key_franja] && $peso_total < $volumen_hasta_mez_franjas[$key_franja]) {
                                        $key_franja_aplicar = $key_franja;
                                        break;
                                    }
                                }
                                $incremento_pvp_peso += $incremento_pvp_mez_franjas[$key_franja_aplicar];
                            }

                            $peso_total = 0;
                        }
                    }

                    $incremento_pvp_zona_peso_modalidades_envio[] = $incremento_pvp_peso;
                }
                // FIN PVP Modalidad envío por zona y peso

            }
        }
        if (isset($ajax) && $ajax == true) {
            echo json_encode([
                'id_modalidades_envio' => $id_modalidades_envio,
                'descripcion_modalidades_envio' => $descripcion_modalidades_envio,
                'explicacion_modalidades_envio' => $explicacion_modalidades_envio,
                'id_iva_modalidades_envio' => $id_iva_modalidades_envio,
                'incremento_pvp_modalidades_envio' => $incremento_pvp_modalidades_envio
            ]);
        }
        break;
    case "obtener_metodos_entrega":
        $query = "SELECT * FROM modalidades_entrega";
        $result_modalidades_entrega = $conn->query($query);

        $id_modalidades_entrega = [];
        $descripcion_modalidades_entrega = [];
        $explicacion_modalidades_entrega = [];
        if ($conn->registros() > 0) {
            foreach ($result_modalidades_entrega as $modalidad_entrega) {
                $id_modalidades_entrega[] = $modalidad_entrega['id'];
                $descripcion_modalidades_entrega[] = $modalidad_entrega['descripcion'];
                $explicacion_modalidades_entrega[] = $modalidad_entrega['explicacion'];
            }
        }
        if (isset($ajax)) {
            echo json_encode([
                'id_modalidades_entrega' => $id_modalidades_entrega,
                'descripcion_modalidades_entrega' => $descripcion_modalidades_entrega,
                'explicacion_modalidades_entrega' => $explicacion_modalidades_entrega
            ]);
        }
        break;
    case "obtener_metodos_pago":
        $query = "SELECT * FROM metodos_pago WHERE interface = 'web' AND activo = 1 ORDER BY orden";
        $result_metodos_pago = $conn->query($query);

        $id_metodos_pago = [];
        $descripcion_metodos_pago = [];
        $explicacion_metodos_pago = [];
        $id_iva_metodos_pago = [];
        $incremento_pvp_metodos_pago = [];
        if ($conn->registros() > 0) {
            foreach ($result_metodos_pago as $metodo_pago) {
                $id_metodos_pago[] = $metodo_pago['id'];
                $descripcion_metodos_pago[] = $metodo_pago['descripcion'];
                $explicacion_metodos_pago[] = $metodo_pago['explicacion'];
                $id_iva_metodos_pago[] = $metodo_pago['id_iva'];
                $incremento_pvp_metodos_pago[] = $metodo_pago['incremento_pvp'];
                $incremento_por_metodos_pago[] = $metodo_pago['incremento_por'];
                $imagen_metodos_pago[] = $metodo_pago['imagen'];
            }
        }
        if (isset($ajax)) {
            echo json_encode([
                'id_metodos_pago' => $id_metodos_pago,
                'descripcion_metodos_pago' => $descripcion_metodos_pago,
                'explicacion_metodos_pago' => $explicacion_metodos_pago,
                'id_iva_metodos_pago' => $id_iva_metodos_pago,
                'incremento_pvp_metodos_pago' => $incremento_pvp_metodos_pago,
                'incremento_por_metodos_pago' => $incremento_por_metodos_pago,
                'imagen_metodos_pago' => $imagen_metodos_pago
            ]);
        }
        break;
    case "obtener_metodos_pago_bans":
        $query = "SELECT * FROM metodos_pago_bans WHERE correo = '" . $correo . "'";
        $result_metodos_pago_bans = $conn->query($query);

        $id_metodos_pago_bans = [];
        $correo_metodos_pago_bans = [];
        $id_metodo_pago_metodos_pago_bans = [];
        if ($conn->registros() > 0) {
            foreach ($result_metodos_pago_bans as $metodo_pago) {
                $id_metodos_pago_bans[] = $metodo_pago['id'];
                $correo_metodos_pago_bans[] = $metodo_pago['correo'];
                $id_metodo_pago_metodos_pago_bans[] = $metodo_pago['id_metodo_pago'];
            }
        }
        if (isset($ajax)) {
            echo json_encode([
                'id_metodos_pago_bans' => $id_metodos_pago_bans,
                'correo_metodos_pago_bans' => $correo_metodos_pago_bans,
                'id_metodo_pago_metodos_pago_bans' => $id_metodo_pago_metodos_pago_bans
            ]);
        }
        break;
}
unset($conn);