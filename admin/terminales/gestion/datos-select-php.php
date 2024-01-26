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

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM terminales WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM terminales WHERE id <> 0" . $whereBusqueda . " ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_terminales[] = $valor['id'];
                $matriz_descripcion_terminales[] = stripslashes($valor['descripcion']);
                $matriz_activo_terminales[] = $valor['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_terminales' => $matriz_id_terminales,
                    'matriz_descripcion_terminales' => $matriz_descripcion_terminales,
                    'matriz_activa_terminales' => $matriz_activo_terminales
                ]);
            }
            break;
        case "listado-filtrado-activos":
            $result_terminales = $conn->query("SELECT * FROM terminales WHERE activo=1 ORDER BY descripcion");
            foreach ($result_terminales as $key_terminales => $valor_terminales) {
                $matriz_id_terminales[] = $valor_terminales['id'];
                $matriz_descripcion_terminales[] = stripslashes($valor_terminales['descripcion']);
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_terminales' => $matriz_id_terminales,
                    'matriz_descripcion_terminales' => $matriz_descripcion_terminales
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_terminal = 0;
                $descripcion_terminal = "";
                $mostrar_todo_terminal = 0;
                $activo_terminal = 1;
            }else {
                $result_terminales = $conn->query("SELECT * FROM terminales WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result_terminales as $key_terminales => $valor_terminales) {
                    $id_terminal = $valor_terminales['id'];
                    $descripcion_terminal = stripslashes($valor_terminales['descripcion']);
                    $mostrar_todo_terminal = $valor_terminales['mostrar_todo'];
                    $activo_terminal = $valor_terminales['activo'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_terminal' => $id_terminal,
                    'descripcion_terminal' => $descripcion_terminal,
                    'activo_terminal' => $activo_terminal
                ]);
            }
            break;
    }
}