<?php
if($valor['tipo_producto'] == 2) {
    $result_productos_relacionados = $conn->query("SELECT pt.descripcion as descripcion_titulo, dpr.* FROM documentos_" . $ejercicio . "_productos_relacionados dpr LEFT OUTER JOIN productos_titulos_relacionados ptr ON dpr.id_titulo_relacionado = ptr.id LEFT OUTER JOIN productos_titulos pt ON ptr.id_productos_titulos = pt.id WHERE dpr.id_documentos_2='" . $valor['id'] . "'");
    foreach ($result_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
        $descripcionAAnadir = '';
        $cantidad_relacion = 1;
        $precio_unidad = null;
        if ($valor_productos_relacionados['por_defecto'] == 0) {
            $descripcionAAnadir = '- ' . $valor_productos_relacionados['descripcion_titulo'] . ' ';
            $cantidad_relacion = $valor_productos_relacionados['cantidad_con'];
            if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                $importe_sumar = $valor_productos_relacionados['sumar_con'] / (1 + ($valor['iva'] / 100));
                $precio_relacionado = number_format($valor['cantidad'] * $importe_sumar, 2, ',', '.');
                $precio_unidad = $importe_sumar;
            }else {
                $precio_relacionado = number_format($valor['cantidad'] * $valor_productos_relacionados['sumar_con'], 2, ',', '.');
                $precio_unidad = $valor_productos_relacionados['sumar_con'];
            }
        } elseif($valor_productos_relacionados['por_defecto'] == 1) {
            $descripcionAAnadir = '- Mitad ';
            $cantidad_relacion = $valor_productos_relacionados['cantidad_mitad'];
            if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                $importe_sumar = $valor_productos_relacionados['sumar_mitad'] / (1 + ($valor['iva'] / 100));
                $precio_relacionado = number_format($valor['cantidad'] * $importe_sumar, 2, ',', '.');
                $precio_unidad = $importe_sumar;
            }else {
                $precio_relacionado = number_format($valor['cantidad'] * $valor_productos_relacionados['sumar_mitad'], 2, ',', '.');
                $precio_unidad = $valor_productos_relacionados['sumar_mitad'];
            }
        } elseif($valor_productos_relacionados['por_defecto'] == 2) {
            $descripcionAAnadir = '- Sin ';
            $cantidad_relacion = $valor_productos_relacionados['cantidad_sin'];
            if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                $importe_sumar = $valor_productos_relacionados['sumar_sin'] / (1 + ($valor['iva'] / 100));
                $precio_relacionado = number_format($valor['cantidad'] * $importe_sumar, 2, ',', '.');
                $precio_unidad = $importe_sumar;
            }else {
                $precio_relacionado = number_format($valor['cantidad'] * $valor_productos_relacionados['sumar_sin'], 2, ',', '.');
                $precio_unidad = $valor_productos_relacionados['sumar_sin'];
            }
        } elseif($valor_productos_relacionados['por_defecto'] == 3) {
            $descripcionAAnadir = '- Doble ';
            $cantidad_relacion = $valor_productos_relacionados['cantidad_doble'];
            if($pvp_iva_incluido[0]['pvp_iva_incluido'] == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
                $importe_sumar = $valor_productos_relacionados['sumar_doble'] / (1 + ($valor['iva'] / 100));
                $precio_relacionado = number_format($valor['cantidad'] * $importe_sumar, 2, ',', '.');
                $precio_unidad = $importe_sumar;
            }else {
                $precio_relacionado = number_format($valor['cantidad'] * $valor_productos_relacionados['sumar_doble'], 2, ',', '.');
                $precio_unidad = $valor_productos_relacionados['sumar_doble'];
            }
        }
        if ($valor_productos_relacionados['modelo'] == 4) {
            continue;
        }

        $result_productos = $conn->query("SELECT descripcion,coste FROM productos WHERE id='" . $valor_productos_relacionados['id_relacionado'] . "' LIMIT 1");

        $id_documento_2[] = $valor['id'];
        $fecha[] = $valor['fecha'];
        $id_producto[] = $valor_productos_relacionados['id_relacionado'];
        $id_productos_detalles_enlazado[] = $valor_productos_relacionados['id_productos_detalles_enlazado'];
        $id_productos_detalles_multiples[] = $valor_productos_relacionados['id_productos_detalles_multiples'];
        $id_packs[] = $valor_productos_relacionados['id_packs'];
        $slug[] = '';
        $imagen_producto[] = '';

        $descripcion_producto[] = $descripcionAAnadir . stripslashes($valor_productos_relacionados['descripcion']) . ((empty($valor_productos_relacionados['observaciones']))? '' : ': ' . $valor_productos_relacionados['observaciones']);
        $detalles_producto[] = '';
        $descripcion_oferta[] = '';
        $codigo_barras_producto[] = '';
        $referencia_producto[] = '';
        $referencia_librador[] = '';
        $numero_serie_producto[] = '';
        $lote_producto[] = '';
        $caducidad_producto[] = '';
        $cantidad[] = number_format(($valor['cantidad'] * $cantidad_relacion), $decimales_cantidades, ".", "");
        $id_unidades[] = 0;
        $unidad[] = '';
        $coste[] = number_format($result_productos[0]['coste'], $decimales_importes, ".", "");
        $importe[] = number_format(($importe_sumar / (1 + ($result_iva[0]['iva'] / 100))), $decimales_importes, ".", "");
        $importe_fijo[] = '';
        $base_antes_descuento[] = '';
        $base_despues_descuento[] = '';
        $importe_descuento_base[] = '';
        $importe_descuento_total[] = '';
        $descuento_base[] = '';
        $descuento_total[] = '';
        $total_antes_descuento[] = '';
        if ($pvp_iva_incluido == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
            $pvp_unidad[] = number_format(($importe_sumar / (1 + ($result_iva[0]['iva'] / 100))), $decimales_importes, ".", "");
            $pvp_unidad_sin_incrementos[] = number_format(($importe_sumar / (1 + (($result_iva[0]['iva'] + $result_iva[0]['recargo']) / 100))), $decimales_importes, ".", "");
            $total_despues_descuento[] = number_format((($importe_sumar / (1 + ($result_iva[0]['iva'] / 100))) * ($valor['cantidad'] * $cantidad_relacion)), $decimales_importes, ".", "");
        }else {
            $pvp_unidad[] = number_format($importe_sumar, $decimales_importes, ".", "");
            $pvp_unidad_sin_incrementos[] = number_format($importe_sumar, $decimales_importes, ".", "");
            $total_despues_descuento[] = number_format(($importe_sumar * ($valor['cantidad'] * $cantidad_relacion)), $decimales_importes, ".", "");
        }

        $id_documento_anterior[] = '';
        $id_vendedor[] = '';
        $estado_2[] = '';
        $id_usuario[] = '';
        $orden[] = '';
        $hora[] = '';
        $id_terminal_2[] = '';
        $nota_producto[] = '';
    }
}
if($valor['tipo_producto'] == 3 || $valor['tipo_producto'] == 4) {
    $result_productos_relacionados_combo = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados_combo WHERE id_documentos_2='" . $valor['id'] . "'");
    foreach ($result_productos_relacionados_combo as $key_productos_relacionados => $valor_productos_relacionados) {
        if ($valor_productos_relacionados['sumar'] == 0) {
            continue;
        }
        $result_productos = $conn->query("SELECT descripcion,coste FROM productos WHERE id='" . $valor_productos_relacionados['id_relacionado'] . "' LIMIT 1");

        $id_documento_2[] = $valor['id'];
        $fecha[] = $valor['fecha'];
        $id_producto[] = $valor_productos_relacionados['id_relacionado'];
        $id_productos_detalles_enlazado[] = $valor_productos_relacionados['id_productos_detalles_enlazado'];
        $id_productos_detalles_multiples[] = $valor_productos_relacionados['id_productos_detalles_multiples'];
        $id_packs[] = $valor_productos_relacionados['id_packs'];
        $slug[] = '';
        $imagen_producto[] = '';

        $descripcion_producto[] = stripslashes($result_productos[0]['descripcion']);
        $detalles_producto[] = '';
        $descripcion_oferta[] = '';
        $codigo_barras_producto[] = '';
        $referencia_producto[] = '';
        $referencia_librador[] = '';
        $numero_serie[] = '';
        $lote[] = '';
        $caducidad[] = '';
        $cantidad[] = number_format(($valor_productos_relacionados['cantidad']), $decimales_cantidades, ".", "");
        $id_unidades[] = 0;
        $unidad[] = '';
        $coste[] = number_format($result_productos[0]['coste'], $decimales_importes, ".", "");
        $importe[] = number_format(($valor_productos_relacionados['sumar'] / (1 + ($result_iva[0]['iva'] / 100))), $decimales_importes, ".", "");
        $importe_fijo[] = '';
        $base_antes_descuento[] = '';
        $base_despues_descuento[] = '';
        $importe_descuento_base[] = '';
        $importe_descuento_total[] = '';
        $descuento_base[] = '';
        $descuento_total[] = '';
        $total_antes_descuento[] = '';
        if ($pvp_iva_incluido == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
            $pvp_unidad[] = number_format(($valor_productos_relacionados['sumar'] / (1 + ($result_iva[0]['iva'] / 100))), $decimales_importes, ".", "");
            $pvp_unidad_sin_incrementos[] = number_format(($valor_productos_relacionados['sumar'] / (1 + (($result_iva[0]['iva'] + $result_iva[0]['recargo']) / 100))), $decimales_importes, ".", "");
            $total_despues_descuento[] = number_format((($valor_productos_relacionados['sumar'] / (1 + ($result_iva[0]['iva'] / 100))) * ($valor_productos_relacionados['cantidad'])), $decimales_importes, ".", "");
        }else {
            $pvp_unidad[] = number_format($valor_productos_relacionados['sumar'], $decimales_importes, ".", "");
            $pvp_unidad_sin_incrementos[] = number_format($valor_productos_relacionados['sumar'], $decimales_importes, ".", "");
            $total_despues_descuento[] = number_format((($valor_productos_relacionados['sumar']) * ($valor_productos_relacionados['cantidad'])), $decimales_importes, ".", "");
        }

        $id_documento_anterior[] = '';
        $id_vendedor[] = '';
        $estado_2[] = '';
        $id_usuario[] = '';
        $orden[] = '';
        $hora[] = '';
        $id_terminal_2[] = '';
        $nota_producto[] = '';
    }
}
if($valor['tipo_producto'] == 1) {
    $result_productos_relacionados_elaborados = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_relacionados_elaborados WHERE id_documentos_2='" . $valor['id'] . "'");
    foreach ($result_productos_relacionados_elaborados as $key_productos_relacionados => $valor_productos_relacionados) {
        if ($valor_productos_relacionados['sumar'] == 0) {
            continue;
        }
        $result_productos = $conn->query("SELECT descripcion,coste FROM productos WHERE id='" . $valor_productos_relacionados['id_relacionado'] . "' LIMIT 1");

        $id_documento_2[] = $valor['id'];
        $fecha[] = $valor['fecha'];
        $id_producto[] = $valor_productos_relacionados['id_producto_relacionado'];
        $id_productos_detalles_enlazado[] = $valor_productos_relacionados['id_productos_detalles_enlazado'];
        $id_productos_detalles_multiples[] = $valor_productos_relacionados['id_productos_detalles_multiples'];
        $id_packs[] = $valor_productos_relacionados['id_packs'];
        $slug[] = '';
        $imagen_producto[] = '';

        $descripcion_producto[] = stripslashes($result_productos[0]['descripcion']);
        $detalles_producto[] = '';
        $descripcion_oferta[] = '';
        $codigo_barras_producto[] = '';
        $referencia_producto[] = '';
        $referencia_librador[] = '';
        $numero_serie[] = '';
        $lote[] = '';
        $caducidad[] = '';
        $cantidad[] = number_format(($valor['cantidad'] * $valor_productos_relacionados['cantidad']), $decimales_cantidades, ".", "");
        $id_unidades[] = 0;
        $unidad[] = '';
        $coste[] = number_format($result_productos[0]['coste'], $decimales_importes, ".", "");
        $importe[] = number_format(($valor_productos_relacionados['sumar'] / (1 + ($result_iva[0]['iva'] / 100))), $decimales_importes, ".", "");
        $importe_fijo[] = '';
        $base_antes_descuento[] = '';
        $base_despues_descuento[] = '';
        $importe_descuento_base[] = '';
        $importe_descuento_total[] = '';
        $descuento_base[] = '';
        $descuento_total[] = '';
        $total_antes_descuento[] = '';
        if ($pvp_iva_incluido == 0 && ($tipo_librador != 'pro' && $tipo_librador != 'cre')) {
            $pvp_unidad[] = number_format(($valor_productos_relacionados['sumar'] / (1 + ($result_iva[0]['iva'] / 100))), $decimales_importes, ".", "");
            $pvp_unidad_sin_incrementos[] = number_format(($valor_productos_relacionados['sumar'] / (1 + (($result_iva[0]['iva'] + $result_iva[0]['recargo']) / 100))), $decimales_importes, ".", "");
            $total_despues_descuento[] = number_format((($valor_productos_relacionados['sumar'] / (1 + ($result_iva[0]['iva'] / 100))) * ($valor['cantidad'] * $valor_productos_relacionados['cantidad'])), $decimales_importes, ".", "");
        } else {
            $pvp_unidad[] = number_format($valor_productos_relacionados['sumar'], $decimales_importes, ".", "");
            $pvp_unidad_sin_incrementos[] = number_format($valor_productos_relacionados['sumar'], $decimales_importes, ".", "");
            $total_despues_descuento[] = number_format((($valor_productos_relacionados['sumar']) * ($valor['cantidad'] * $valor_productos_relacionados['cantidad'])), $decimales_importes, ".", "");
        }

        $id_documento_anterior[] = '';
        $id_vendedor[] = '';
        $estado_2[] = '';
        $id_usuario[] = '';
        $orden[] = '';
        $hora[] = '';
        $id_terminal_2[] = '';
        $nota_producto[] = '';
    }
}