<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "detalles-ficha":
            $result = $conn->query("SELECT id,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs,
                                    id_relacionado,id_grupo,fijo,modelo,cantidad_con,cantidad_mitad,cantidad_sin,
                                    cantidad_doble,por_defecto,mostrar 
                                    FROM productos_relacionados WHERE id_producto=".$id_url." ORDER BY orden");
            foreach ($result as $key => $valor) {
                if(empty($valor['id_grupo'])) {
                    $matriz_grupo[] = "";
                }else {
                    $result_grupo = $conn->query("SELECT descripcion FROM productos_relacionados_grupos WHERE id=".$valor['id_grupo']." LIMIT 1");
                    if($conn->registros() == 1) {
                        $matriz_grupo[] = stripslashes($result_grupo[0]['descripcion']);
                    }else {
                        $matriz_grupo[] = "";
                    }
                }
                $result_producto_relacionado = $conn->query("SELECT descripcion,tipo_producto FROM productos WHERE id=".$valor['id_relacionado']." LIMIT 1");
                if($conn->registros() == 1) {
                    $matriz_descripcion_productos_relacionados[] = stripslashes($result_producto_relacionado[0]['descripcion']);
                    $matriz_tipo_producto_productos_relacionados[] = $result_producto_relacionado[0]['tipo_producto'];
                }else {
                    $matriz_descripcion_productos_relacionados[] = "Desconocido";
                    $matriz_tipo_producto_productos_relacionados[] = 0;
                }
                $matriz_id_productos_relacionados[] = $valor['id'];
                $matriz_id_enlazado_productos_relacionados[] = $valor['id_productos_detalles_enlazado'];
                $matriz_id_multiples_productos_relacionados[] = $valor['id_productos_detalles_multiples'];
                $matriz_id_packs_productos_relacionados[] = $valor['id_packs'];
                $matriz_id_relacionado_productos_relacionados[] = $valor['id_relacionado'];
                $matriz_id_grupo_productos_relacionados[] = $valor['id_grupo'];
                $matriz_fijo_importe_productos_relacionados[] = $valor['fijo'];
                $matriz_modelo_productos_relacionados[] = $valor['modelo'];
                $matriz_cantidad_con_productos_relacionados[] = $valor['cantidad_con'];
                $matriz_cantidad_mitad_productos_relacionados[] = $valor['cantidad_mitad'];
                $matriz_cantidad_sin_productos_relacionados[] = $valor['cantidad_sin'];
                $matriz_cantidad_doble_productos_relacionados[] = $valor['cantidad_doble'];
                $matriz_por_defecto_productos_relacionados[] = $valor['por_defecto'];
                $matriz_mostrar_productos_relacionados[] = $valor['mostrar'];

                $result_incrementos_tarifas = $conn->query("SELECT * FROM productos_relacionados_incre WHERE id_producto_rel=" . $valor['id']);
                foreach ($result_incrementos_tarifas as $key_incrementos_tarifas => $valor_incrementos_tarifas) {
                    $matriz_sumar_con_productos_relacionados[$valor_incrementos_tarifas['id_tarifa']][$valor['id']] = $valor_incrementos_tarifas['sumar_con'];
                    $matriz_sumar_mitad_productos_relacionados[$valor_incrementos_tarifas['id_tarifa']][$valor['id']] = $valor_incrementos_tarifas['sumar_mitad'];
                    $matriz_sumar_sin_productos_relacionados[$valor_incrementos_tarifas['id_tarifa']][$valor['id']] = $valor_incrementos_tarifas['sumar_sin'];
                    $matriz_sumar_doble_productos_relacionados[$valor_incrementos_tarifas['id_tarifa']][$valor['id']] = $valor_incrementos_tarifas['sumar_doble'];
                }

            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'grupo' => $matriz_grupo,
                    'descripcion_productos_relacionados' => $matriz_descripcion_productos_relacionados,
                    'id_productos_relacionados' => $matriz_id_productos_relacionados,
                    'id_relacionado_productos_relacionados' => $matriz_id_relacionado_productos_relacionados,
                    'id_grupo_productos_relacionados' => $matriz_id_grupo_productos_relacionados,
                    'fijo_importe_productos_relacionados' => $matriz_fijo_importe_productos_relacionados,
                    'modelo_productos_relacionados' => $matriz_modelo_productos_relacionados,
                    'cantidad_con_productos_relacionados' => $matriz_cantidad_con_productos_relacionados,
                    'cantidad_mitad_productos_relacionados' => $matriz_cantidad_mitad_productos_relacionados,
                    'cantidad_sin_productos_relacionados' => $matriz_cantidad_sin_productos_relacionados,
                    'cantidad_doble_productos_relacionados' => $matriz_cantidad_doble_productos_relacionados,
                    'sumar_con_productos_relacionados' => $matriz_sumar_con_productos_relacionados,
                    'sumar_mitad_productos_relacionados' => $matriz_sumar_mitad_productos_relacionados,
                    'sumar_sin_productos_relacionados' => $matriz_sumar_sin_productos_relacionados,
                    'sumar_doble_productos_relacionados' => $matriz_sumar_doble_productos_relacionados,
                    'por_defecto_productos_relacionados' => $matriz_por_defecto_productos_relacionados,
                    'mostrar_productos_relacionados' => $matriz_mostrar_productos_relacionados
                ]);
            }
            break;
        case "detalles-ficha-combo":
            $result = $conn->query("SELECT id,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs,
                                    id_relacionado,id_grupo,fijo,cantidad,mostrar,activo 
                                    FROM productos_relacionados_combo WHERE id_producto=".$id_url." ORDER BY orden");
            foreach ($result as $key => $valor) {
                if(empty($valor['id_grupo'])) {
                    $matriz_grupo[] = "";
                }else {
                    $result_grupo = $conn->query("SELECT descripcion FROM productos_relacionados_grupos WHERE id=".$valor['id_grupo']." LIMIT 1");
                    if($conn->registros() == 1) {
                        $matriz_grupo[] = stripslashes($result_grupo[0]['descripcion']);
                    }else {
                        $matriz_grupo[] = "";
                    }
                }
                $result_producto_relacionado = $conn->query("SELECT descripcion,tipo_producto FROM productos WHERE id=".$valor['id_relacionado']." LIMIT 1");
                if($conn->registros() == 1) {
                    $matriz_descripcion_productos_relacionados[] = stripslashes($result_producto_relacionado[0]['descripcion']);
                    $matriz_tipo_producto_productos_relacionados[] = $result_producto_relacionado[0]['tipo_producto'];
                }else {
                    $matriz_descripcion_productos_relacionados[] = "Desconocido";
                    $matriz_tipo_producto_productos_relacionados[] = 0;
                }
                $matriz_id_productos_relacionados[] = $valor['id'];
                $matriz_id_enlazado_productos_relacionados[] = $valor['id_productos_detalles_enlazado'];
                $matriz_id_multiples_productos_relacionados[] = $valor['id_productos_detalles_multiples'];
                $matriz_id_packs_productos_relacionados[] = $valor['id_packs'];
                $matriz_id_relacionado_productos_relacionados[] = $valor['id_relacionado'];
                $matriz_id_grupo_productos_relacionados[] = $valor['id_grupo'];
                $matriz_fijo_importe_productos_relacionados[] = $valor['fijo'];
                $matriz_cantidad_productos_relacionados[] = $valor['cantidad'];
                $matriz_mostrar_productos_relacionados[] = $valor['mostrar'];
                $matriz_activo_productos_relacionados[] = $valor['activo'];

                $result_incrementos_tarifas = $conn->query("SELECT * FROM productos_relacionados_combo_incre WHERE id_producto_rel=" . $valor['id']);
                foreach ($result_incrementos_tarifas as $key_incrementos_tarifas => $valor_incrementos_tarifas) {
                    $matriz_sumar_productos_relacionados[$valor_incrementos_tarifas['id_tarifa']][$valor['id']] = $valor_incrementos_tarifas['sumar'];
                }

            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'grupo' => $matriz_grupo,
                    'descripcion_productos_relacionados' => $matriz_descripcion_productos_relacionados,
                    'id_productos_relacionados' => $matriz_id_productos_relacionados,
                    'id_relacionado_productos_relacionados' => $matriz_id_relacionado_productos_relacionados,
                    'id_grupo_productos_relacionados' => $matriz_id_grupo_productos_relacionados,
                    'fijo_importe_productos_relacionados' => $matriz_fijo_importe_productos_relacionados,
                    'cantidad_productos_relacionados' => $matriz_cantidad_productos_relacionados,
                    'sumar_productos_relacionados' => $matriz_sumar_productos_relacionados,
                    'mostrar_productos_relacionados' => $matriz_mostrar_productos_relacionados
                ]);
            }
            break;
        case "detalles-ficha-elaborados":
            $result = $conn->query("SELECT id,id_productos_detalles_enlazado,id_productos_detalles_multiples,id_packs,id_categoria_estadisticas,
                                    id_producto_relacionado,fijo,cantidad,id_unidad,mostrar 
                                    FROM productos_relacionados_elaborados WHERE id_producto=".$id_url." ORDER BY orden");
            foreach ($result as $key => $valor) {
                if(empty($valor['id_grupo'])) {
                    $matriz_grupo[] = "";
                }else {
                    $result_grupo = $conn->query("SELECT descripcion FROM productos_relacionados_grupos WHERE id=".$valor['id_grupo']." LIMIT 1");
                    if($conn->registros() == 1) {
                        $matriz_grupo[] = stripslashes($result_grupo[0]['descripcion']);
                    }else {
                        $matriz_grupo[] = "";
                    }
                }
                $result_producto_relacionado = $conn->query("SELECT descripcion,tipo_producto FROM productos WHERE id=".$valor['id_producto_relacionado']." LIMIT 1");
                if($conn->registros() == 1) {
                    $matriz_descripcion_productos_relacionados[] = stripslashes($result_producto_relacionado[0]['descripcion']);
                    $matriz_tipo_producto_productos_relacionados[] = $result_producto_relacionado[0]['tipo_producto'];
                }else {
                    $matriz_descripcion_productos_relacionados[] = "Desconocido";
                    $matriz_tipo_producto_productos_relacionados[] = 0;
                }
                $matriz_id_productos_relacionados[] = $valor['id'];
                $matriz_id_enlazado_productos_relacionados[] = $valor['id_productos_detalles_enlazado'];
                $matriz_id_multiples_productos_relacionados[] = $valor['id_productos_detalles_multiples'];
                $matriz_id_packs_productos_relacionados[] = $valor['id_packs'];
                $matriz_id_categoria_estadisticas_productos_relacionados[] = $valor['id_categoria_estadisticas'];
                $matriz_id_producto_relacionado_productos_relacionados[] = $valor['id_producto_relacionado'];
                $matriz_fijo_importe_productos_relacionados[] = $valor['fijo'];
                $matriz_cantidad_productos_relacionados[] = $valor['cantidad'];
                $matriz_id_unidad_productos_relacionados[] = $valor['id_unidad'];
                $matriz_mostrar_productos_relacionados[] = $valor['mostrar'];

                $result_incrementos_tarifas = $conn->query("SELECT * FROM productos_relacionados_elaborados_incre WHERE id_producto_rel=" . $valor['id']);
                foreach ($result_incrementos_tarifas as $key_incrementos_tarifas => $valor_incrementos_tarifas) {
                    $matriz_sumar_productos_relacionados[$valor_incrementos_tarifas['id_tarifa']][$valor['id']] = $valor_incrementos_tarifas['sumar'];
                }

            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'grupo' => $matriz_grupo,
                    'descripcion_productos_relacionados' => $matriz_descripcion_productos_relacionados,
                    'id_productos_relacionados' => $matriz_id_productos_relacionados,
                    'id_enlazado_productos_relacionados' => $matriz_id_enlazado_productos_relacionados,
                    'id_multiples_productos_relacionados' => $matriz_id_multiples_productos_relacionados,
                    'id_producto_relacionado_productos_relacionados' => $matriz_id_producto_relacionado_productos_relacionados,
                    'id_packs' => $matriz_id_packs_productos_relacionados,
                    'id_categoria_estadisticas_productos_relacionados' => $matriz_id_categoria_estadisticas_productos_relacionados,
                    'fijo_importe_productos_relacionados' => $matriz_fijo_importe_productos_relacionados,
                    'cantidad_productos_relacionados' => $matriz_cantidad_productos_relacionados,
                    'id_unidad_productos_relacionados' => $matriz_id_unidad_productos_relacionados,
                    'sumar_productos_relacionados' => $matriz_sumar_productos_relacionados,
                    'mostrar_productos_relacionados' => $matriz_mostrar_productos_relacionados
                ]);
            }
            break;
    }
}