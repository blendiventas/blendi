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
                $whereBusqueda .= " AND (irpf LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }
            if (isset($parametro_filtro_habilitado)) {
                $whereBusqueda .= " AND activo = " . $parametro_filtro_habilitado . " ";
            }

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM irpf WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM irpf WHERE id <> 0" . $whereBusqueda . " ORDER BY irpf LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_productos_irpf[] = $valor['id'];
                $matriz_irpf_productos_irpf[] = $valor['irpf'];
                $matriz_activo_productos_irpf[] = $valor['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_productos_irpf' => $matriz_id_productos_irpf,
                    'irpf_productos_irpf' => $matriz_irpf_productos_irpf,
                    'activo_productos_irpf' => $matriz_activo_productos_irpf
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_productos_irpf = 0;
                $irpf_productos_irpf = 0;
                $activo_productos_irpf = 1;
            }else {
                $result = $conn->query("SELECT * FROM irpf WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_productos_irpf = $valor['id'];
                    $irpf_productos_irpf = $valor['irpf'];
                    $activo_productos_irpf = $valor['activo'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_productos_irpf' => $id_productos_irpf,
                    'irpf_productos_irpf' => $irpf_productos_irpf,
                    'activo_productos_irpf' => $activo_productos_irpf
                ]);
            }
            break;
    }
}