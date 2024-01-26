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
                $whereBusqueda .= " AND (zona LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM zonas WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM zonas WHERE id <> 0" . $whereBusqueda . " ORDER BY zona LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_libradores_zonas[] = $valor['id'];
                $matriz_zona_libradores_zonas[] = $valor['zona'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_libradores_zonas' => $matriz_id_libradores_zonas,
                    'zona_libradores_zonas' => $matriz_zona_libradores_zonas,
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_libradores_zonas = 0;
                $zona_libradores_zonas = '';
            }else {
                $result = $conn->query("SELECT * FROM zonas WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_libradores_zonas = $valor['id'];
                    $zona_libradores_zonas = $valor['zona'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_libradores_zonas' => $id_libradores_zonas,
                    'zona_libradores_zonas' => $zona_libradores_zonas,
                ]);
            }
            break;
    }
}