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

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM categorias_elaborados WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM categorias_elaborados WHERE id <> 0" . $whereBusqueda . " ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_categorias_elaborados[] = $valor['id'];
                $matriz_descripcion_categorias_elaborados[] = $valor['descripcion'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_categorias_elaborados' => $matriz_id_categorias_elaborados,
                    'descripcion_categorias_elaborados' => $matriz_descripcion_categorias_elaborados
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_categorias_elaborados = 0;
                $descripcion_categorias_elaborados = '';
            }else {
                $result = $conn->query("SELECT * FROM categorias_elaborados WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_categorias_elaborados = $valor['id'];
                    $descripcion_categorias_elaborados = $valor['descripcion'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_categorias_elaborados' => $id_categorias_elaborados,
                    'descripcion_categorias_elaborados' => $descripcion_categorias_elaborados
                ]);
            }
            break;
    }
}