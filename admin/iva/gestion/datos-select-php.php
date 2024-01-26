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
                $whereBusqueda .= " AND (iva LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }
            if (isset($parametro_filtro_habilitado)) {
                $whereBusqueda .= " AND activo = " . $parametro_filtro_habilitado . " ";
            }

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos_iva WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM productos_iva WHERE id <> 0" . $whereBusqueda . " ORDER BY iva,recargo LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_productos_iva[] = $valor['id'];
                $matriz_iva_productos_iva[] = $valor['iva'];
                $matriz_recargo_productos_iva[] = $valor['recargo'];
                $matriz_prioritario_productos_iva[] = $valor['prioritario'];
                $matriz_activo_productos_iva[] = $valor['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_productos_iva' => $matriz_id_productos_iva,
                    'iva_productos_iva' => $matriz_iva_productos_iva,
                    'recargo_productos_iva' => $matriz_recargo_productos_iva,
                    'prioritario_productos_iva' => $matriz_prioritario_productos_iva,
                    'activo_productos_iva' => $matriz_activo_productos_iva
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_productos_iva = 0;
                $iva_productos_iva = 0;
                $recargo_productos_iva = 0;
                $prioritario_productos_iva = 0;
                $activo_productos_iva = 1;
            }else {
                $result = $conn->query("SELECT * FROM productos_iva WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_productos_iva = $valor['id'];
                    $iva_productos_iva = $valor['iva'];
                    $recargo_productos_iva = $valor['recargo'];
                    $prioritario_productos_iva = $valor['prioritario'];
                    $activo_productos_iva = $valor['activo'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_productos_iva' => $id_productos_iva,
                    'iva_productos_iva' => $iva_productos_iva,
                    'recargo_productos_iva' => $recargo_productos_iva,
                    'prioritario_productos_iva' => $prioritario_productos_iva,
                    'activo_productos_iva' => $activo_productos_iva
                ]);
            }
            break;
    }
}