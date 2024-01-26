<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-filtrado":

            $result_iva = $conn->query("SELECT id,iva,recargo FROM productos_iva WHERE activo=1 ORDER BY iva");
            foreach ($result_iva as $key_iva => $valor_iva) {
                $base_iva[] = 0.00;
                $iva[] = $valor_iva['iva'];
                $importe_iva[] = 0.00;
                $recargo[] = $valor_iva['recargo'];
                $importe_recargo[] = 0.00;
                $base_documentos_1[] = [];
                $iva_documentos_1[] = [];
                $recargo_documentos_1[] = [];
                $base_total_documentos_1[] = 0;
                $iva_total_documentos_1[] = 0;
                $recargo_total_documentos_1[] = 0;
            }

            if (empty($ejercicio_url) || empty($mostrar_url) || empty($tipo_documento_url)) {
                break;
            }
            $trimestre_o_ejercicio = substr($mostrar_url,-2);
            $fecha_desde = $ejercicio_url . '-01-01';
            $fecha_hasta = $ejercicio_url . '-12-31';
            if ($trimestre_o_ejercicio == '1t') {
                $fecha_desde = $ejercicio_url . '-01-01';
                $fecha_hasta = $ejercicio_url . '-03-31';
            } else if($trimestre_o_ejercicio == '2t') {
                $fecha_desde = $ejercicio_url . '-04-01';
                $fecha_hasta = $ejercicio_url . '-06-30';
            } else if($trimestre_o_ejercicio == '3t') {
                $fecha_desde = $ejercicio_url . '-07-01';
                $fecha_hasta = $ejercicio_url . '-09-30';
            } else if($trimestre_o_ejercicio == '4t') {
                $fecha_desde = $ejercicio_url . '-10-01';
                $fecha_hasta = $ejercicio_url . '-12-31';
            } else if($trimestre_o_ejercicio == 'ej') {
                $fecha_desde = $ejercicio_url . '-01-01';
                $fecha_hasta = $ejercicio_url . '-12-31';

            }
            $tipo_librador = "(tipo_librador<>'pro' AND tipo_librador<>'cre')";
            if (substr($mostrar_url,0,13) == 'iva-soportado') {
                $tipo_librador = "(tipo_librador='pro' OR tipo_librador='cre')";
            } else if (substr($mostrar_url,0,15) == 'iva-repercutido') {
                $tipo_librador = "(tipo_librador<>'pro' AND tipo_librador<>'cre')";
            }

            $query = "SELECT * FROM documentos_" . $ejercicio_url . "_1 WHERE 
                                                tipo_documento='" . addslashes($tipo_documento_url) . "' AND 
                                                " . $tipo_librador . " AND 
                                                fecha_documento>='" . addslashes($fecha_desde) . "' AND 
                                                fecha_documento<='" . addslashes($fecha_hasta) . "' 
                                                ORDER BY numero_documento + 0 ASC";

            $total = 0;
            $result_documentos = $conn->query($query);
            if ($conn->registros() >= 1) {
                if ($vista_url == 'ticket') {
                    foreach ($result_documentos as $key_documentos => $valor_documentos) {
                        $resultados_obtenidos += 1;
                        $query = "SELECT nombre,apellido_1,apellido_2,razon_social,razon_comercial,nif FROM libradores WHERE 
                                                        id='" . $valor_documentos['id_librador'] . "' LIMIT 1";
                        $result_librador = $conn->query($query);
                        if ($conn->registros() >= 1) {
                            $nombre = '';
                            if (!empty($result_librador[0]['nombre'])) {
                                $nombre = $result_librador[0]['nombre'] . ' ' . $result_librador[0]['apellido_1'] . ' ' . $result_librador[0]['apellido_2'];

                                if (!empty($result_librador[0]['razon_comercial'])) {
                                    $nombre .= ' (' . $result_librador[0]['razon_comercial'] . ')';
                                } else if (!empty($result_librador[0]['razon_social'])) {
                                    $nombre .= ' (' . $result_librador[0]['razon_social'] . ')';
                                }
                            } else if (!empty($result_librador[0]['razon_comercial'])) {
                                $nombre = $result_librador[0]['razon_comercial'];
                            } else if (!empty($result_librador[0]['razon_social'])) {
                                $nombre = $result_librador[0]['razon_social'];
                            }
                            $nombre_documentos_1[] = $nombre;
                            $nif_documentos_1[] = $result_librador[0]['nif'];
                        } else {
                            $nombre_documentos_1[] = '';
                            $nif_documentos_1[] = '';
                        }

                        $decuento_pp = $valor_documentos['descuento_pp'];
                        $decuento_librador = $valor_documentos['descuento_librador'];

                        $numero_documento_documentos_1[] = $valor_documentos['numero_documento'];
                        $fecha_documentos_1[] = $valor_documentos['fecha_documento'];
                        $total_documentos_1[] = number_format($valor_documentos['total'], 2, ',', '.');
                        $total += (float) number_format($valor_documentos['total'], 2, '.', '');

                        foreach ($iva as $key_iva => $value_iva) {
                            $query = "SELECT SUM(base) AS base_iva, SUM(importe_recargo) AS importe_recargo FROM documentos_" . $ejercicio_url . "_iva WHERE 
                                                        id_documentos_1='" . $valor_documentos['id'] . "' AND iva = '" . $value_iva . "'";
                            $result_iva_documentos = $conn->query($query);
                            if ($conn->registros() >= 1) {
                                $base_iva = $result_iva_documentos[0]['base_iva'] - ($result_iva_documentos[0]['base_iva'] * ($decuento_pp/100)) - ($result_iva_documentos[0]['base_iva'] * ($decuento_librador/100));
                                $suma_iva = $base_iva * ($value_iva/100);
                                if ($result_iva_documentos[0]['importe_recargo'] != 0) {
                                    $suma_re = $base_iva * ($recargo[$key_iva]/100);
                                } else {
                                    $suma_re = 0;
                                }
                                $base_documentos_1[$key_iva][] = number_format($base_iva, 3, ',', '.');
                                $iva_documentos_1[$key_iva][] = number_format($suma_iva, 3, ',', '.');
                                $recargo_documentos_1[$key_iva][] = number_format($suma_re, 3, ',', '.');
                                $base_total_documentos_1[$key_iva] += (float) number_format($base_iva, 3, '.', '');
                                $iva_total_documentos_1[$key_iva] += (float) number_format($suma_iva, 3, '.', '');
                                $recargo_total_documentos_1[$key_iva] += (float) number_format($suma_re, 3, '.', '');
                            } else {
                                $base_documentos_1[$key_iva][] = 0;
                                $iva_documentos_1[$key_iva][] = 0;
                                $recargo_documentos_1[$key_iva][] = 0;
                            }
                        }
                    }
                } else if ($vista_url == 'diaria') {
                    $total_diario = 0;
                    $fecha_actual = '';
                    $primer_numero_actual = '';
                    $key_iva_actual = 0;
                    foreach ($result_documentos as $key_documentos => $valor_documentos) {
                        $resultados_obtenidos += 1;

                        if ($fecha_actual != $valor_documentos['fecha_documento']) {
                            // Nuevo día - Guardar datos día anterior
                            if (!empty($fecha_actual)) {
                                // No es el primer registro
                                $nombre_documentos_1[] = '-';
                                $nif_documentos_1[] = '-';
                                $numero_documento_documentos_1[] = $primer_numero_actual . ' - ' . $result_documentos[$key_documentos - 1]['numero_documento'];
                                $fecha_documentos_1[] = $fecha_actual;
                                $total_documentos_1[] = number_format($total_diario, 2, ',', '.');
                                $key_iva_actual += 1;
                            }
                            $fecha_actual = $valor_documentos['fecha_documento'];
                            $primer_numero_actual = $valor_documentos['numero_documento'];
                            $total_diario = 0;
                        }

                        $decuento_pp = $valor_documentos['descuento_pp'];
                        $decuento_librador = $valor_documentos['descuento_librador'];

                        $total += (float) number_format($valor_documentos['total'], 2, '.', '');
                        $total_diario += (float) number_format($valor_documentos['total'], 2, '.', '');

                        foreach ($iva as $key_iva => $value_iva) {
                            $query = "SELECT SUM(base) AS base_iva, SUM(importe_recargo) AS importe_recargo FROM documentos_" . $ejercicio_url . "_iva WHERE 
                                                        id_documentos_1='" . $valor_documentos['id'] . "' AND iva = '" . $value_iva . "'";
                            $result_iva_documentos = $conn->query($query);
                            if (empty($base_documentos_1[$key_iva][$key_iva_actual])) {
                                $base_documentos_1[$key_iva][$key_iva_actual] = 0;
                                $iva_documentos_1[$key_iva][$key_iva_actual] = 0;
                                $recargo_documentos_1[$key_iva][$key_iva_actual] = 0;
                            }
                            if ($conn->registros() >= 1) {
                                $base_iva = $result_iva_documentos[0]['base_iva'] - ($result_iva_documentos[0]['base_iva'] * ($decuento_pp/100)) - ($result_iva_documentos[0]['base_iva'] * ($decuento_librador/100));
                                $suma_iva = $base_iva * ($value_iva/100);
                                if ($result_iva_documentos[0]['importe_recargo'] != 0) {
                                    $suma_re = $base_iva * ($recargo[$key_iva]/100);
                                } else {
                                    $suma_re = 0;
                                }
                                $base_documentos_1[$key_iva][$key_iva_actual] += (float) number_format($base_iva, 3, '.', '');
                                $iva_documentos_1[$key_iva][$key_iva_actual] += (float) number_format($suma_iva, 3, '.', '');
                                $recargo_documentos_1[$key_iva][$key_iva_actual] += (float) number_format($suma_re, 3, '.', '');
                                $base_total_documentos_1[$key_iva] += (float) number_format($base_iva, 3, '.', '');
                                $iva_total_documentos_1[$key_iva] += (float) number_format($suma_iva, 3, '.', '');
                                $recargo_total_documentos_1[$key_iva] += (float) number_format($suma_re, 3, '.', '');
                            }
                        }
                    }
                }
            }

            $total = number_format($total, 3, ',', '.');
            foreach ($iva as $key_iva => $value_iva) {
                $base_total_documentos_1[$key_iva] = number_format($base_total_documentos_1[$key_iva], 3, ',', '.');
                $iva_total_documentos_1[$key_iva] = number_format($iva_total_documentos_1[$key_iva], 3, ',', '.');
                $recargo_total_documentos_1[$key_iva] = number_format($recargo_total_documentos_1[$key_iva], 3, ',', '.');
            }

            if (!empty($descarga_url) && $descarga_url == 'csv') {
                $return = 'Doc.;Fecha;Cliente;NIF';
                if (!empty($iva) && is_array($iva)) {
                    $return .= ';';
                    foreach ($iva as $key_iva => $value_iva) {
                        if ($key_iva != 0) {
                            $return .= ';';
                        }
                        $return .= 'Base ' . $value_iva . '%';
                    }
                    $return .= ';';
                    foreach ($iva as $key_iva => $value_iva) {
                        if ($key_iva != 0) {
                            $return .= ';';
                        }
                        $return .= 'IVA ' . $value_iva . '%';
                    }
                    $return .= ';';
                    foreach ($iva as $key_iva => $value_iva) {
                        if ($key_iva != 0) {
                            $return .= ';';
                        }
                        $return .= 'R.' . $recargo[$key_iva] . '%';
                    }
                }
                $return .= ';Total';

                foreach ($numero_documento_documentos_1 as $key => $valor) {
                    $return .= "\n";
                    $return .= $valor . ';' . $fecha_documentos_1[$key] . ';' . $nombre_documentos_1[$key] . ';' . $nif_documentos_1[$key];
                    if (!empty($iva) && is_array($iva)) {
                        $return .= ';';
                        foreach ($iva as $key_iva => $value_iva) {
                            if ($key_iva != 0) {
                                $return .= ';';
                            }
                            $return .= $base_documentos_1[$key_iva][$key] . '€';
                        }
                        $return .= ';';
                        foreach ($iva as $key_iva => $value_iva) {
                            if ($key_iva != 0) {
                                $return .= ';';
                            }
                            $return .= $iva_documentos_1[$key_iva][$key] . '€';
                        }
                        $return .= ';';
                        foreach ($iva as $key_iva => $value_iva) {
                            if ($key_iva != 0) {
                                $return .= ';';
                            }
                            $return .= $recargo_documentos_1[$key_iva][$key] . '€';
                        }
                    }
                    $return .= ';' . $total_documentos_1[$key] . '€';
                }

                $return .= "\n";
                $return .= 'Total;;;';
                if (!empty($iva) && is_array($iva)) {
                    $return .= ';';
                    foreach ($iva as $key_iva => $value_iva) {
                        if ($key_iva != 0) {
                            $return .= ';';
                        }
                        $return .= $base_total_documentos_1[$key_iva] . '€';
                    }
                    $return .= ';';
                    foreach ($iva as $key_iva => $value_iva) {
                        if ($key_iva != 0) {
                            $return .= ';';
                        }
                        $return .= $iva_total_documentos_1[$key_iva] . '€';
                    }
                    $return .= ';';
                    foreach ($iva as $key_iva => $value_iva) {
                        if ($key_iva != 0) {
                            $return .= ';';
                        }
                        $return .= $recargo_total_documentos_1[$key_iva] . '€';
                    }
                }
                $return .= ';' . $total . '€';

                header("Content-Type: text/csv");
                header("Content-Disposition: attachment; filename=listadoIVA-" . $ejercicio_url . "-" . $mostrar_url . ".csv");
                echo $return;
            }

            if (isset($ajax_sys)) {
                echo json_encode([
                    'numero_documento_documentos_1' => $numero_documento_documentos_1,
                    'nombre_documentos_1' => $nombre_documentos_1,
                    'nif_documentos_1' => $nif_documentos_1,
                    'fecha_documentos_1' => $fecha_documentos_1,
                    'total_documentos_1' => $total_documentos_1
                ]);
            }
            break;
    }
}