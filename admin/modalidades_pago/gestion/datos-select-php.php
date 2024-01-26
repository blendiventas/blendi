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

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM modalidades_pago WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM modalidades_pago WHERE id <> 0" . $whereBusqueda . " ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_libradores_modalidades_pago[] = $valor['id'];
                $matriz_descripcion_libradores_modalidades_pago[] = $valor['descripcion'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_libradores_modalidades_pago' => $matriz_id_libradores_modalidades_pago,
                    'descripcion_libradores_modalidades_pago' => $matriz_descripcion_libradores_modalidades_pago,
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_libradores_modalidades_pago = 0;
                $descripcion_libradores_modalidades_pago = '';
                $explicacion_libradores_modalidades_pago = '';
                $tienda_virtual_libradores_modalidades_pago = 0;
                $defecto_libradores_modalidades_pago = 0;
                $incremento_pvp_libradores_modalidades_pago = 0;
                $incremento_por_libradores_modalidades_pago = 0;
                $lineas_modalidades_pago = array();
            }else {
                $result = $conn->query("SELECT * FROM modalidades_pago WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_libradores_modalidades_pago = $valor['id'];
                    $descripcion_libradores_modalidades_pago = $valor['descripcion'];
                    $explicacion_libradores_modalidades_pago = $valor['explicacion'];
                    $tienda_virtual_libradores_modalidades_pago = $valor['tienda_virtual'];
                    $defecto_libradores_modalidades_pago = $valor['defecto'];
                    $incremento_pvp_libradores_modalidades_pago = $valor['incremento_pvp'];
                    $incremento_por_libradores_modalidades_pago = $valor['incremento_por'];
                }
                $lineas_modalidades_pago = $conn->query("SELECT * FROM modalidades_pago_lineas WHERE id_forma_pago=" . $id_libradores_modalidades_pago_url);
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_libradores_modalidades_pago' => $id_libradores_modalidades_pago,
                    'descripcion_libradores_modalidades_pago' => $descripcion_libradores_modalidades_pago,
                    'explicacion_libradores_modalidades_pago' => $explicacion_libradores_modalidades_pago,
                    'tienda_virtual_libradores_modalidades_pago' => $tienda_virtual_libradores_modalidades_pago,
                    'defecto_libradores_modalidades_pago' => $defecto_libradores_modalidades_pago,
                    'incremento_pvp_libradores_modalidades_pago' => $incremento_pvp_libradores_modalidades_pago,
                    'incremento_por_libradores_modalidades_pago' => $incremento_por_libradores_modalidades_pago,
                ]);
            }
            break;
    }
}