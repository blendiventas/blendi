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

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM grupos_clientes WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM grupos_clientes WHERE id <> 0" . $whereBusqueda . " ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_grupos_clientes[] = $valor['id'];
                $matriz_descripcion_grupos_clientes[] = stripslashes($valor['descripcion']);
                $matriz_prioritario_grupos_clientes[] = $valor['prioritario'];
                $matriz_activo_grupos_clientes[] = $valor['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_grupos_clientes' => $matriz_id_grupos_clientes,
                    'descripcion_grupos_clientes' => $matriz_descripcion_grupos_clientes,
                    'prioritario_grupos_clientes' => $matriz_prioritario_grupos_clientes,
                    'activo_grupos_clientes' => $matriz_activo_grupos_clientes
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_grupos_clientes = 0;
                $descripcion_grupos_clientes = 0;
                $prioritario_grupos_clientes = 0;
                $activo_grupos_clientes = 1;
            }else {
                $result = $conn->query("SELECT * FROM grupos_clientes WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_grupos_clientes = $valor['id'];
                    $descripcion_grupos_clientes = stripslashes($valor['descripcion']);
                    $prioritario_grupos_clientes = $valor['prioritario'];
                    $activo_grupos_clientes = $valor['activo'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_grupos_clientes' => $id_grupos_clientes,
                    'descripcion_grupos_clientes' => $descripcion_grupos_clientes,
                    'prioritario_grupos_clientes' => $prioritario_grupos_clientes,
                    'activo_grupos_clientes' => $activo_grupos_clientes
                ]);
            }
            break;
    }
}