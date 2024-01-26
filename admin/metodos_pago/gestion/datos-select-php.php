<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-filtrado":
            if (!isset($parametro_pagina)) {
                $parametro_pagina = 0;
            }
            if (!isset($parametro_resultados)) {
                $parametro_resultados = 10;
            }

            $whereBusqueda = '';
            if (isset($parametro_busqueda) && !empty($parametro_busqueda)) {
                $whereBusqueda .= " AND (descripcion LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }
            if (isset($parametro_filtro_habilitado)) {
                $whereBusqueda .= " AND activo = " . $parametro_filtro_habilitado . " ";
            }

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM metodos_pago WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM metodos_pago WHERE id <> 0" . $whereBusqueda . " ORDER BY orden,descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_metodos_pago[] = $valor['id'];
                $matriz_descripcion_metodos_pago[] = $valor['descripcion'];
                $matriz_explicacion_metodos_pago[] = $valor['explicacion'];
                $matriz_interface_metodos_pago[] = $valor['interface'];
                $matriz_prioritario_metodos_pago[] = $valor['prioritario'];
                $matriz_id_iva_metodos_pago[] = $valor['id_iva'];
                $matriz_incremento_pvp_metodos_pago[] = $valor['incremento_pvp'];
                $matriz_incremento_por_metodos_pago[] = $valor['incremento_por'];
                $matriz_ruta_metodos_pago[] = $valor['ruta'];
                $matriz_sistema_metodos_pago[] = $valor['sistema'];
                $matriz_imagen_metodos_pago[] = $valor['imagen'];
                $matriz_orden_metodos_pago[] = $valor['orden'];
                $matriz_activo_metodos_pago[] = $valor['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_metodos_pago' => $matriz_id_metodos_pago,
                    'descripcion_metodos_pago' => $matriz_descripcion_metodos_pago,
                    'explicacion_metodos_pago' => $matriz_explicacion_metodos_pago,
                    'interface_metodos_pago' => $matriz_interface_metodos_pago,
                    'prioritario_metodos_pago' => $matriz_prioritario_metodos_pago,
                    'id_iva_metodos_pago' => $matriz_id_iva_metodos_pago,
                    'incremento_pvp_metodos_pago' => $matriz_incremento_pvp_metodos_pago,
                    'incremento_por_metodos_pago' => $matriz_incremento_por_metodos_pago,
                    'ruta_metodos_pago' => $matriz_ruta_metodos_pago,
                    'sistema_metodos_pago' => $matriz_sistema_metodos_pago,
                    'imagen_metodos_pago' => $matriz_imagen_metodos_pago,
                    'orden_metodos_pago' => $matriz_orden_metodos_pago,
                    'activo_metodos_pago' => $matriz_activo_metodos_pago
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_metodos_pago = 0;
                $descripcion_metodos_pago = '';
                $explicacion_metodos_pago = '';
                $interface_metodos_pago = '';
                $prioritario_metodos_pago = 0;
                $id_iva_metodos_pago = 0;
                $incremento_pvp_metodos_pago = '';
                $incremento_por_metodos_pago = '';
                $ruta_metodos_pago = '';
                $sistema_metodos_pago = '';
                $imagen_metodos_pago = '';
                $orden_metodos_pago = '';
                $directo_metodos_pago = 0;
                $activo_metodos_pago = 0;
            }else {
                $result = $conn->query("SELECT * FROM metodos_pago WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_metodos_pago = $valor['id'];
                    $descripcion_metodos_pago = $valor['descripcion'];
                    $explicacion_metodos_pago = $valor['explicacion'];
                    $interface_metodos_pago = $valor['interface'];
                    $prioritario_metodos_pago = $valor['prioritario'];
                    $id_iva_metodos_pago = $valor['id_iva'];
                    $incremento_pvp_metodos_pago = $valor['incremento_pvp'];
                    $incremento_por_metodos_pago = $valor['incremento_por'];
                    $ruta_metodos_pago = $valor['ruta'];
                    $sistema_metodos_pago = $valor['sistema'];
                    $imagen_metodos_pago = $valor['imagen'];
                    $orden_metodos_pago = $valor['orden'];
                    $directo_metodos_pago = $valor['directo'];
                    $activo_metodos_pago = $valor['activo'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_metodos_pago' => $id_metodos_pago,
                    'descripcion_metodos_pago' => $descripcion_metodos_pago,
                    'explicacion_metodos_pago' => $explicacion_metodos_pago,
                    'interface_metodos_pago' => $interface_metodos_pago,
                    'prioritario_metodos_pago' => $prioritario_metodos_pago,
                    'id_iva_metodos_pago' => $id_iva_metodos_pago,
                    'incremento_pvp_metodos_pago' => $incremento_pvp_metodos_pago,
                    'incremento_por_metodos_pago' => $incremento_por_metodos_pago,
                    'ruta_metodos_pago' => $ruta_metodos_pago,
                    'sistema_metodos_pago' => $sistema_metodos_pago,
                    'imagen_metodos_pago' => $imagen_metodos_pago,
                    'orden_metodos_pago' => $orden_metodos_pago,
                    'directo_metodos_pag' => $directo_metodos_pago,
                    'activo_metodos_pag' => $activo_metodos_pago
                ]);
            }
            break;
    }
}