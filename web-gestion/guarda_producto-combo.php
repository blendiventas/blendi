<?php
$cantidad = 1;

if (isset($_POST['total_productos_anadidos'])) {
    $total_productos_anadidos = $_POST['total_productos_anadidos'];

    $result_productos_relacionados_grupos = $conn->query("SELECT id,descripcion FROM productos_relacionados_grupos 
    WHERE id_idioma='" . $id_idioma . "' ORDER BY orden");
    $contador_grupos_mostrados = 0;
    foreach ($result_productos_relacionados_grupos as $key_productos_relacionados_grupos => $valor_productos_relacionados_grupos) {
        $id_grupo = $valor_productos_relacionados_grupos['id'];
        $result_productos_grupos = $conn->query("SELECT * FROM productos_relacionados_combo WHERE id_producto=" . $id_producto . " AND 
        id_grupo='".$id_grupo."' AND activo=1 ORDER BY orden");
        foreach ($result_productos_grupos as $key_productos_grupos => $valor_productos_grupos) {
            for ($iCombo = 1; $iCombo <= $total_productos_anadidos; $iCombo++) {
                if (
                    isset($_POST['id_relacionado_combo_producto_grupos_' . $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo]) &&
                    isset($_POST['cantidad_relacionado_combo_producto_grupos_' . $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo])
                ) {
                    if (
                        !empty($_POST['id_documentos_combo_' . $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo]) &&
                        empty($_POST['modificado_documentos_combo_' . $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo])
                    ) {
                        continue;
                    }
                    $id_documentos_combo_original = '-1';
                    if (!empty($_POST['id_documentos_combo_' . $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo])) {
                        $id_documentos_combo = $_POST['id_documentos_combo_' . $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo];
                        $id_documentos_combo_original = $id_documentos_combo;
                        $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_observaciones WHERE id_documentos_2=" . $id_documento_2 . " AND id_documentos_combo=" . $id_documentos_combo . " LIMIT 1");
                        $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_productos_relacionados WHERE id_documentos_2=" . $id_documento_2 . " AND id_documentos_combo=" . $id_documentos_combo);
                        $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_productos_relacionados_combo WHERE id_documentos_2=" . $id_documento_2 . " AND id=" . $id_documentos_combo);
                        $datosRegistroStock = [];
                        $datosRegistroStock['ejercicio'] = $ejercicio;
                        $datosRegistroStock['id_documento_1'] = $id_documento_1;
                        $datosRegistroStock['id_documento_2'] = $id_documento_2;
                        $datosRegistroStock['id_producto'] = $result_productos_grupos[$key_productos_grupos]['id_relacionado'];
                        $datosRegistroStock['conn'] = $conn;
                        eliminarRegistroStock($datosRegistroStock, $result_productos_grupos[$key_productos_grupos]['id_relacionado'], [], true);
                        if (
                            $_POST['modificado_documentos_combo_' . $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo] == 2 &&
                            $tipo_documento == 'tiq' && $tipo_librador != 'pro' && $tipo_librador != 'cre'
                        ) {
                            $result = $conn->query("SELECT estado FROM documentos_enviar_terminales WHERE id_documento_2=" . $id_documento_2 . " AND id_documentos_combo=" . $id_documentos_combo . " LIMIT 1");
                            if ($conn->registros() == 1) {
                                if ($result[0]['estado'] == '-1') {
                                    $result = $conn->query("DELETE FROM documentos_enviar_terminales WHERE id_documento_2=" . $id_documento_2 . " AND id_documentos_combo=" . $id_documentos_combo);
                                } else {
                                    $result = $conn->query("UPDATE documentos_enviar_terminales SET hora_entrada='" . date("Y-m-d H:i:s") . "', estado = 3 WHERE id_documento_2=" . $id_documento_2 . " AND id_documentos_combo=" . $id_documentos_combo);
                                }
                            }
                            continue;
                        }
                    }
                    $cantidad = $_POST['cantidad_relacionado_combo_producto_grupos_' . $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo];
                    $elemento = $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo;
                    $idGrupo = (isset($_POST['grupos_producto-grupos-opciones_' . $elemento]))? $_POST['grupos_producto-grupos-opciones_' . $elemento] : $result_productos_grupos[$key_productos_grupos]['id_grupo'];

                    $result_incre = $conn->query("SELECT * FROM productos_relacionados_combo_incre WHERE id_producto_rel=".$result_productos_grupos[$key_productos_grupos]['id'] . " AND id_tarifa = " . $id_tarifa_web . " LIMIT 1");
                    $sumar = 0;
                    if($conn->registros() >= 1) {
                        $sumar = $result_incre[0]['sumar'];
                    }

                    $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados_combo VALUES(
                        NULL,
                        '" . $id_documento_2 . "',
                        '" . $result_productos_grupos[$key_productos_grupos]['id_productos_detalles_enlazado'] . "',
                        '" . $result_productos_grupos[$key_productos_grupos]['id_productos_detalles_multiples'] . "',
                        '" . $result_productos_grupos[$key_productos_grupos]['id_packs'] . "',
                        '" . $result_productos_grupos[$key_productos_grupos]['id_relacionado'] . "',
                        '" . $idGrupo . "',
                        '" . $result_productos_grupos[$key_productos_grupos]['fijo'] . "',
                        '" . $result_productos_grupos[$key_productos_grupos]['cantidad'] * $cantidad . "',
                        '" . $sumar . "',
                        '" . $result_productos_grupos[$key_productos_grupos]['mostrar'] . "',
                        '" . $result_productos_grupos[$key_productos_grupos]['orden'] . "')");
                    $id_documentos_combo = $conn->id_insert();

                    if(
                        ($tipo_documento == 'tiq') && $tipo_librador != 'pro' && $tipo_librador != 'cre' &&
                        $_POST['modificado_documentos_combo_' . $contador_grupos_mostrados . '_' . $key_productos_grupos . '_' . $iCombo] != 2
                    ) {
                        $id_terminal_producto = 0;
                        $result_terminal_producto = $conn->query("SELECT enviar FROM productos_otros WHERE id_producto='" . $id_producto . "' LIMIT 1");
                        if ($conn->registros() == 1) {
                            $id_terminal_producto = $result_terminal_producto[0]['enviar'];

                            $result_datos_terminal_producto = $conn->query("SELECT * FROM documentos_enviar_terminales WHERE id_documento_1='".$id_documento_1."' AND id_documento_2='".$id_documento_2_original."' AND id_documentos_combo = '" . $id_documentos_combo_original . "' AND id_producto='" . $result_productos_grupos[$key_productos_grupos]['id_relacionado'] . "' LIMIT 1");
                            if($conn->registros() == 1) {
                                $cambioAlertar = '';
                                if ($result_datos_terminal_producto[0]['estado'] != '-1') {
                                    $cambioAlertar = 'alertar = 1, ';
                                }
                                $result = $conn->query("UPDATE documentos_enviar_terminales SET 
                                    " . $cambioAlertar . "
                                    hora_entrada='" . date("Y-m-d H:i:s") . "',
                                    cantidad='" . number_format($result_productos_grupos[$key_productos_grupos]['cantidad'] * $cantidad, 5, ".", "") . "',
                                    id_documento_2 = ". $id_documento_2 . ", 
                                    id_documentos_combo = " . $id_documentos_combo . "
                                    WHERE id='" . $result_datos_terminal_producto[0]['id'] . "' LIMIT 1");
                            }else {
                                $result = $conn->query("INSERT INTO documentos_enviar_terminales VALUES(
                                    NULL,
                                    '" . $id_documento_1 . "',
                                    '" . $id_documento_2 . "',
                                    '" . $id_documentos_combo . "',
                                    '" . $result_productos_grupos[$key_productos_grupos]['id_relacionado'] . "',
                                    '" . number_format($result_productos_grupos[$key_productos_grupos]['cantidad'] * $cantidad, 5, ".", "") . "',
                                    '-1',
                                    '0',
                                    '" . date("Y-m-d H:i:s") . "',
                                    '0000-00-00 00:00:00',
                                    '0000-00-00 00:00:00',
                                    '" . $id_terminal_producto . "')");
                            }
                        }
                    }

                    $datosRegistroStock = [];
                    $datosRegistroStock['ejercicio'] = $ejercicio;
                    $datosRegistroStock['tipo_documento'] = $tipo_documento;
                    $datosRegistroStock['id_documento_1'] = $id_documento_1;
                    $datosRegistroStock['id_documento_2'] = $id_documento_2;
                    $datosRegistroStock['tipo_librador'] = $tipo_librador;
                    $datosRegistroStock['id_librador'] = $id_librador;
                    $datosRegistroStock['conn'] = $conn;
                    $datosRegistroStock['id_productos_detalles_enlazado'] = $result_productos_grupos[$key_productos_grupos]['id_productos_detalles_enlazado'];
                    $datosRegistroStock['id_productos_detalles_multiples'] = $result_productos_grupos[$key_productos_grupos]['id_productos_detalles_multiples'];
                    $datosRegistroStock['id_packs'] = $result_productos_grupos[$key_productos_grupos]['id_packs'];
                    $datosRegistroStock['id_producto'] = $result_productos_grupos[$key_productos_grupos]['id_relacionado'];
                    $datosRegistroStock['cantidad'] = $result_productos_grupos[$key_productos_grupos]['cantidad'] * $cantidad;
                    $datosRegistroStock['importe'] = $sumar / (1 + ($iva_aplicar / 100));
                    $datosRegistroStock['coste_producto_linea'] = 0;
                    $datosRegistroStock['lote_producto'] = "";
                    $datosRegistroStock['caducidad_producto'] = "0000-00-00";
                    $datosRegistroStock['numero_serie_producto'] = "";
                    registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $result_productos_grupos[$key_productos_grupos]['id_relacionado'], []);

                    $id_producto_anadir = $result_productos_grupos[$key_productos_grupos]['id_relacionado'];
                    require("guarda_producto-compuesto.php");
                    require("guarda_producto-elaborado.php");
                    if ($_POST['nota-linea-' . $elemento]) {
                        $observacion = $_POST['nota-linea-' . $elemento];
                        require("guardar_documento_obs.php");
                    }
                    $cantidad = 1;
                }
            }
        }
        if (count($result_productos_grupos)) {
            $contador_grupos_mostrados++;
        }
    }
}