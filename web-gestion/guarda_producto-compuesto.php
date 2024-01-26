<?php
/*
CREATE TABLE `documentos_2022_productos_relacionados` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_documentos_2` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_productos_detalles_enlazado` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_productos_detalles_multiples` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_packs` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_relacionado` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_grupo` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`fijo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`modelo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 - Con / Sin\r\n1 - Normal / Mitad / Sin / Doble\r\n2 - Input cantidad\r\n3 - Unico',
	`cantidad_con` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
	`cantidad_mitad` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
	`cantidad_sin` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
	`cantidad_doble` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
	`sumar_con` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
	`sumar_mitad` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
	`sumar_sin` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
	`sumar_doble` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
	`por_defecto` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0-con\r\n1-mitad\r\n2-sin\r\n3-doble',
	`mostrar` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
PRIMARY KEY (`id`) USING BTREE,INDEX `indice` (`id_documentos_2`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;
*/

if (!isset($id_producto_anadir)) {
    $id_producto_anadir = $id_producto;
}
$cantidad_stock = $cantidad;
if (!isset($id_documentos_combo)) {
    $id_documentos_combo = 0;
} else {
    $cantidad_stock = 1;
}
$result = $conn
    ->query("SELECT pt.descripcion as titulo_descripcion, ptr.id as id_titulo_relacionado, CASE WHEN ptr.descripcion IS NULL OR ptr.descripcion = '' THEN pt.descripcion ELSE ptr.descripcion END AS descripcion, pt.modelo, pr.id, pr.id_producto, pr.id_productos_detalles_enlazado, pr.id_productos_detalles_multiples, pr.id_packs, pr.id_relacionado, pr.id_grupo, pr.fijo, pr.cantidad_con, pr.cantidad_mitad, pr.cantidad_sin, pr.cantidad_doble, IFNULL(pr.por_defecto, 2) AS por_defecto, IFNULL(pr.mostrar, 1) as mostrar, pr.orden
    FROM productos_titulos as pt
    LEFT OUTER JOIN productos_titulos_relacionados as ptr ON pt.id = ptr.id_productos_titulos
    LEFT OUTER JOIN productos_relacionados as pr ON pr.id_relacionado = ptr.id_producto AND pr.id_producto = pt.id_producto
    WHERE pt.id_producto = " . $id_producto_anadir . " ORDER BY pt.orden ASC, pr.modelo DESC, pr.orden");

if($conn->registros() >= 1) {
    // Modelo único (3)
    if (isset($_POST['0_opcion_' . $elemento])) {
        for ($i = 0; $i < count($result); $i++) {
            if ((!empty($result[$i]['id']) && $result[$i]['id'] == $_POST['0_opcion_' . $elemento]) || (empty($result[$i]['id']) && $result[$i]['id_titulo_relacionado'] == $_POST['0_opcion_' . $elemento])) {
                $sumar_con = 0;
                $sumar_mitad = 0;
                $sumar_sin = 0;
                $sumar_doble = 0;
                if ($tipo_librador == 'pro' || $tipo_librador == 'cre') {
                    if ($result[$i]['id_relacionado']) {
                        $result_producto_coste = $conn->query("SELECT coste FROM productos 
                            WHERE id=" . $result[$i]['id_relacionado'] . " LIMIT 1");
                        if($conn->registros() == 1) {
                            $sumar_con = $result_producto_coste[0]['coste'];
                        }
                    }
                } else {
                    $result_incre = $conn->query("SELECT * FROM productos_relacionados_incre WHERE id_producto_rel = " . $result[$i]['id'] . " AND id_tarifa = " . $id_tarifa_web . " LIMIT 1");
                    if($conn->registros() >= 1) {
                        $sumar_con = $result_incre[0]['sumar_con'];
                        $sumar_mitad = $result_incre[0]['sumar_mitad'];
                        $sumar_sin = $result_incre[0]['sumar_sin'];
                        $sumar_doble = $result_incre[0]['sumar_doble'];
                    }
                }

                $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados VALUES(
                NULL,
                '" . $result[$i]['id'] . "',
                '" . $id_documento_2 . "',
                '" . $id_documentos_combo . "',
                '" . $result[$i]['id_productos_detalles_enlazado'] . "',
                '" . $result[$i]['id_productos_detalles_multiples'] . "',
                '" . $result[$i]['id_packs'] . "',
                '" . $result[$i]['id_relacionado'] . "',
                '" . $result[$i]['id_titulo_relacionado'] . "',
                '" . $result[$i]['descripcion'] . "',
                '" . $result[$i]['id_grupo'] . "',
                '" . $result[$i]['fijo'] . "',
                '" . $result[$i]['modelo'] . "',
                '" . $result[$i]['cantidad_con'] . "',
                '" . $result[$i]['cantidad_mitad'] . "',
                '" . $result[$i]['cantidad_sin'] . "',
                '" . $result[$i]['cantidad_doble'] . "',
                '" . $sumar_con . "',
                '" . $sumar_mitad . "',
                '" . $sumar_sin . "',
                '" . $sumar_doble . "',
                '',
                '0', 
                '" . $result[$i]['mostrar'] . "',
                '" . $result[$i]['orden'] . "')");

                $datosRegistroStock['id_productos_detalles_enlazado'] = $result[$i]['id_productos_detalles_enlazado'];
                $datosRegistroStock['id_productos_detalles_multiples'] = $result[$i]['id_productos_detalles_multiples'];
                $datosRegistroStock['id_packs'] = $result[$i]['id_packs'];
                $datosRegistroStock['id_producto'] = $result[$i]['id_relacionado'];
                $datosRegistroStock['coste_producto_linea'] = 0;
                $datosRegistroStock['lote_producto'] = "";
                $datosRegistroStock['caducidad_producto'] = "0000-00-00";
                $datosRegistroStock['numero_serie_producto'] = "";
                $datosRegistroStock['importe'] = $sumar_con / (1 + ($iva_aplicar / 100));
                $datosRegistroStock['cantidad'] = $result[$i]['cantidad_con'] * $cantidad_stock;
                registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $id_producto_anadir, [], true);
            }
        }
    }

    // Modelo no mostrar (4)
    for ($i = 0; $i < count($result); $i++) {
        if ($result[$i]['mostrar'] == 0) {
            $sumar_con = 0;
            $sumar_mitad = 0;
            $sumar_sin = 0;
            $sumar_doble = 0;
            if ($tipo_librador == 'pro' || $tipo_librador == 'cre') {
                if ($result[$i]['id_relacionado']) {
                    $result_producto_coste = $conn->query("SELECT coste FROM productos 
                            WHERE id=" . $result[$i]['id_relacionado'] . " LIMIT 1");
                    if($conn->registros() == 1) {
                        $sumar_con = $result_producto_coste[0]['coste'];
                    }
                }
            } else {
                $result_incre = $conn->query("SELECT * FROM productos_relacionados_incre WHERE id_producto_rel = " . $result[$i]['id'] . " AND id_tarifa = " . $id_tarifa_web . " LIMIT 1");
                if($conn->registros() >= 1) {
                    $sumar_con = $result_incre[0]['sumar_con'];
                    $sumar_mitad = $result_incre[0]['sumar_mitad'];
                    $sumar_sin = $result_incre[0]['sumar_sin'];
                    $sumar_doble = $result_incre[0]['sumar_doble'];
                }
            }

            $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados VALUES(
                NULL,
                '" . $result[$i]['id'] . "',
                '" . $id_documento_2 . "',
                '" . $id_documentos_combo . "',
                '" . $result[$i]['id_productos_detalles_enlazado'] . "',
                '" . $result[$i]['id_productos_detalles_multiples'] . "',
                '" . $result[$i]['id_packs'] . "',
                '" . $result[$i]['id_relacionado'] . "',
                '" . $result[$i]['id_titulo_relacionado'] . "',
                '" . $result[$i]['descripcion'] . "',
                '" . $result[$i]['id_grupo'] . "',
                '" . $result[$i]['fijo'] . "',
                '" . $result[$i]['modelo'] . "',
                '" . $result[$i]['cantidad_con'] . "',
                '" . $result[$i]['cantidad_mitad'] . "',
                '" . $result[$i]['cantidad_sin'] . "',
                '" . $result[$i]['cantidad_doble'] . "',
                '" . $sumar_con . "',
                '" . $sumar_mitad . "',
                '" . $sumar_sin . "',
                '" . $sumar_doble . "',
                '',
                '" . $result[$i]['por_defecto'] . "',
                '" . $result[$i]['mostrar'] . "',
                '" . $result[$i]['orden'] . "')");

            $datosRegistroStock['id_productos_detalles_enlazado'] = $result[$i]['id_productos_detalles_enlazado'];
            $datosRegistroStock['id_productos_detalles_multiples'] = $result[$i]['id_productos_detalles_multiples'];
            $datosRegistroStock['id_packs'] = $result[$i]['id_packs'];
            $datosRegistroStock['id_producto'] = $result[$i]['id_relacionado'];
            $datosRegistroStock['importe'] = 0;
            $datosRegistroStock['coste_producto_linea'] = 0;
            $datosRegistroStock['lote_producto'] = "";
            $datosRegistroStock['caducidad_producto'] = "0000-00-00";
            $datosRegistroStock['numero_serie_producto'] = "";
            $datosRegistroStock['cantidad'] = $result[$i]['cantidad_con'] * $cantidad_stock;
            registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $id_producto_anadir, [], true);
        }
    }

    // Modelos switch y texto (0, 5)
    for ($i = 0; $i < count($result); $i++) {
        $sumar_con = 0;
        $sumar_mitad = 0;
        $sumar_sin = 0;
        $sumar_doble = 0;
        if ($tipo_librador == 'pro' || $tipo_librador == 'cre') {
            if ($result[$i]['id_relacionado']) {
                $result_producto_coste = $conn->query("SELECT coste FROM productos 
                            WHERE id=" . $result[$i]['id_relacionado'] . " LIMIT 1");
                if($conn->registros() == 1) {
                    $sumar_con = $result_producto_coste[0]['coste'];
                }
            }
        } else {
            $result_incre = $conn->query("SELECT * FROM productos_relacionados_incre WHERE id_producto_rel = " . $result[$i]['id'] . " AND id_tarifa = " . $id_tarifa_web . " LIMIT 1");
            if($conn->registros() >= 1) {
                $sumar_con = $result_incre[0]['sumar_con'];
                $sumar_mitad = $result_incre[0]['sumar_mitad'];
                $sumar_sin = $result_incre[0]['sumar_sin'];
                $sumar_doble = $result_incre[0]['sumar_doble'];
            }
        }

        if ($result[$i]['mostrar'] != 0 && ($result[$i]['modelo'] == 0 || $result[$i]['modelo'] == 1)) {

            $opcionEscojida = 0;
            if (isset($_POST[$i . '_opciones_' . $elemento])) {
                $opciones = $_POST[$i . '_opciones_' . $elemento];
            } else {
                $opciones = null;
            }

            if ($opciones == 'con') {
                $opcionEscojida = 0;
                $datosRegistroStock['cantidad'] = $result[$i]['cantidad_con'] * $cantidad_stock;
                $datosRegistroStock['importe'] = $sumar_con / (1 + ($iva_aplicar / 100));
            } elseif($opciones == 'mitad') {
                $opcionEscojida = 1;
                $datosRegistroStock['cantidad'] = $result[$i]['cantidad_mitad'] * $cantidad_stock;
                $datosRegistroStock['importe'] = $sumar_mitad / (1 + ($iva_aplicar / 100));
            } elseif($opciones == 'sin' || empty($opciones)) {
                $opcionEscojida = 2;
                $datosRegistroStock['importe'] = $sumar_sin / (1 + ($iva_aplicar / 100));
            } elseif($opciones == 'doble') {
                $datosRegistroStock['cantidad'] = $result[$i]['cantidad_doble'] * $cantidad_stock;
                $opcionEscojida = 3;
                $datosRegistroStock['importe'] = $sumar_doble / (1 + ($iva_aplicar / 100));
            }
            if ($opcionEscojida != 2) {

                $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados VALUES(
                NULL,
                '" . $result[$i]['id'] . "',
                '" . $id_documento_2 . "',
                '" . $id_documentos_combo . "',
                '" . $result[$i]['id_productos_detalles_enlazado'] . "',
                '" . $result[$i]['id_productos_detalles_multiples'] . "',
                '" . $result[$i]['id_packs'] . "',
                '" . $result[$i]['id_relacionado'] . "',
                '" . $result[$i]['id_titulo_relacionado'] . "',
                '" . $result[$i]['descripcion'] . "',
                '" . $result[$i]['id_grupo'] . "',
                '" . $result[$i]['fijo'] . "',
                '" . $result[$i]['modelo'] . "',
                '" . $result[$i]['cantidad_con'] . "',
                '" . $result[$i]['cantidad_mitad'] . "',
                '" . $result[$i]['cantidad_sin'] . "',
                '" . $result[$i]['cantidad_doble'] . "',
                '" . $sumar_con . "',
                '" . $sumar_mitad . "',
                '" . $sumar_sin . "',
                '" . $sumar_doble . "',
                '',
                '" . $opcionEscojida . "',
                '" . $result[$i]['mostrar'] . "',
                '" . $result[$i]['orden'] . "')");

                $datosRegistroStock['id_producto'] = $result[$i]['id_relacionado'];
                $datosRegistroStock['id_productos_detalles_enlazado'] = $result[$i]['id_productos_detalles_enlazado'];
                $datosRegistroStock['id_productos_detalles_multiples'] = $result[$i]['id_productos_detalles_multiples'];
                $datosRegistroStock['id_packs'] = $result[$i]['id_packs'];
                $datosRegistroStock['coste_producto_linea'] = 0;
                $datosRegistroStock['lote_producto'] = "";
                $datosRegistroStock['caducidad_producto'] = "0000-00-00";
                $datosRegistroStock['numero_serie_producto'] = "";
                registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $id_producto_anadir, [], true);
            }
        }
        if ($result[$i]['mostrar'] != 0 && $result[$i]['modelo'] == 2 && isset($_POST[$i . '_cantidad_' . $elemento])) {

            $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados VALUES(
            NULL,
            '" . $result[$i]['id'] . "',
            '" . $id_documento_2 . "',
            '" . $id_documentos_combo . "',
            '" . $result[$i]['id_productos_detalles_enlazado'] . "',
            '" . $result[$i]['id_productos_detalles_multiples'] . "',
            '" . $result[$i]['id_packs'] . "',
            '" . $result[$i]['id_relacionado'] . "',
            '" . $result[$i]['id_titulo_relacionado'] . "',
            '" . $result[$i]['descripcion'] . "',
            '" . $result[$i]['id_grupo'] . "',
            '" . $result[$i]['fijo'] . "',
            '" . $result[$i]['modelo'] . "',
            '" . $_POST[$i . '_cantidad_' . $elemento] . "',
            '" . $result[$i]['cantidad_mitad'] . "',
            '" . $result[$i]['cantidad_sin'] . "',
            '" . $result[$i]['cantidad_doble'] . "',
            '" . $sumar_con . "',
            '" . $sumar_mitad . "',
            '" . $sumar_sin . "',
            '" . $sumar_doble . "',
            '',
            '0',
            '" . $result[$i]['mostrar'] . "',
            '" . $result[$i]['orden'] . "')");

            $datosRegistroStock['id_productos_detalles_enlazado'] = $result[$i]['id_productos_detalles_enlazado'];
            $datosRegistroStock['id_productos_detalles_multiples'] = $result[$i]['id_productos_detalles_multiples'];
            $datosRegistroStock['id_packs'] = $result[$i]['id_packs'];
            $datosRegistroStock['id_producto'] = $result[$i]['id_relacionado'];
            $datosRegistroStock['cantidad'] = $_POST[$i . '_cantidad_' . $elemento] * $cantidad_stock;
            $datosRegistroStock['importe'] = $sumar_con / (1 + ($iva_aplicar / 100));
            $datosRegistroStock['coste_producto_linea'] = 0;
            $datosRegistroStock['lote_producto'] = "";
            $datosRegistroStock['caducidad_producto'] = "0000-00-00";
            $datosRegistroStock['numero_serie_producto'] = "";
            registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $id_producto_anadir, [], true);
        }
        if ($result[$i]['modelo'] == 5 && isset($_POST[$i . '_opciones_' . $elemento]) && !empty($_POST[$i . '_opciones_' . $elemento])) {

            $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados VALUES(
            NULL,
            '" . $result[$i]['id'] . "',
            '" . $id_documento_2 . "',
            '" . $id_documentos_combo . "',
            '" . $result[$i]['id_productos_detalles_enlazado'] . "',
            '" . $result[$i]['id_productos_detalles_multiples'] . "',
            '" . $result[$i]['id_packs'] . "',
            '" . $result[$i]['id_relacionado'] . "',
            '" . $result[$i]['id_titulo_relacionado'] . "',
            '" . $result[$i]['descripcion'] . "',
            '" . $result[$i]['id_grupo'] . "',
            '" . $result[$i]['fijo'] . "',
            '" . $result[$i]['modelo'] . "',
            '1',
            '" . $result[$i]['cantidad_mitad'] . "',
            '" . $result[$i]['cantidad_sin'] . "',
            '" . $result[$i]['cantidad_doble'] . "',
            '" . $sumar_con . "',
            '" . $sumar_mitad . "',
            '" . $sumar_sin . "',
            '" . $sumar_doble . "',
            '" . $_POST[$i . '_opciones_' . $elemento] . "',
            '0',
            '" . $result[$i]['mostrar'] . "',
            '" . $result[$i]['orden'] . "')");

            $datosRegistroStock['id_productos_detalles_enlazado'] = $result[$i]['id_productos_detalles_enlazado'];
            $datosRegistroStock['id_productos_detalles_multiples'] = $result[$i]['id_productos_detalles_multiples'];
            $datosRegistroStock['id_packs'] = $result[$i]['id_packs'];
            $datosRegistroStock['id_producto'] = $result[$i]['id_relacionado'];
            $datosRegistroStock['cantidad'] = $_POST[$i . '_cantidad_' . $elemento] * $cantidad_stock;
            $datosRegistroStock['importe'] = $sumar_con / (1 + ($iva_aplicar / 100));
            $datosRegistroStock['coste_producto_linea'] = 0;
            $datosRegistroStock['lote_producto'] = "";
            $datosRegistroStock['caducidad_producto'] = "0000-00-00";
            $datosRegistroStock['numero_serie_producto'] = "";
            registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $id_producto_anadir, [], true);
        }
    }
}