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
                $whereBusqueda .= " AND activa = " . $parametro_filtro_habilitado . " ";
            }

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM tarifas WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result_tarifas = $conn->query("SELECT * FROM tarifas WHERE id <> 0" . $whereBusqueda . " ORDER BY orden LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            foreach ($result_tarifas as $key_tarifas => $valor_tarifas) {
                $matriz_id_tarifas[] = $valor_tarifas['id'];
                $matriz_id_idioma_tarifas[] = $valor_tarifas['id_idioma'];
                $matriz_descripcion_tarifas[] = stripslashes($valor_tarifas['descripcion']);
                $matriz_prioritaria_tarifas[] = $valor_tarifas['prioritaria'];
                $matriz_activa_tarifas[] = $valor_tarifas['activa'];
                $matriz_orden_tarifas[] = $valor_tarifas['orden'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_tarifas' => $matriz_id_tarifas,
                    'matriz_id_idioma_tarifas' => $matriz_id_idioma_tarifas,
                    'matriz_descripcion_tarifas' => $matriz_descripcion_tarifas,
                    'matriz_prioritaria_tarifas' => $matriz_prioritaria_tarifas,
                    'matriz_activa_tarifas' => $matriz_activa_tarifas,
                    'matriz_orden_tarifas' => $matriz_orden_tarifas
                ]);
            }
            break;
        case "listado":
            $result_tarifas = $conn->query("SELECT * FROM tarifas WHERE activa = 1 ORDER BY orden");
            foreach ($result_tarifas as $key_tarifas => $valor_tarifas) {
                $matriz_id_tarifas[] = $valor_tarifas['id'];
                $matriz_id_idioma_tarifas[] = $valor_tarifas['id_idioma'];
                $matriz_descripcion_tarifas[] = stripslashes($valor_tarifas['descripcion']);
                $matriz_prioritaria_tarifas[] = $valor_tarifas['prioritaria'];
                $matriz_activa_tarifas[] = $valor_tarifas['activa'];
                $matriz_orden_tarifas[] = $valor_tarifas['orden'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_tarifas' => $matriz_id_tarifas,
                    'matriz_id_idioma_tarifas' => $matriz_id_idioma_tarifas,
                    'matriz_descripcion_tarifas' => $matriz_descripcion_tarifas,
                    'matriz_prioritaria_tarifas' => $matriz_prioritaria_tarifas,
                    'matriz_activa_tarifas' => $matriz_activa_tarifas,
                    'matriz_orden_tarifas' => $matriz_orden_tarifas
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_tarifas = 0;
                $iva_tarifas = 0;
                $recargo_tarifas = 0;
                $prioritario_tarifas = 0;
                $activo_tarifas = 1;

                $id_tarifas = 0;
                $id_idioma_tarifas = $id_idioma_sys;
                $descripcion_tarifas = "";
                $prioritaria_tarifas = 0;
                $activa_tarifas = 1;
                $orden_tarifas = "";
            }else {
                $result_tarifas = $conn->query("SELECT * FROM tarifas WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result_tarifas as $key_tarifas => $valor_tarifas) {
                    $id_tarifas = $valor_tarifas['id'];
                    $id_idioma_tarifas = $valor_tarifas['id_idioma'];
                    $descripcion_tarifas = stripslashes($valor_tarifas['descripcion']);
                    $prioritaria_tarifas = $valor_tarifas['prioritaria'];
                    $activa_tarifas = $valor_tarifas['activa'];
                    $orden_tarifas = stripslashes($valor_tarifas['orden']);
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_tarifas' => $id_tarifas,
                    'id_idioma_tarifas' => $id_idioma_tarifas,
                    'descripcion_tarifas' => $descripcion_tarifas,
                    'prioritaria_tarifas' => $prioritaria_tarifas,
                    'activa_tarifas' => $activa_tarifas,
                    'orden_tarifas' => $orden_tarifas
                ]);
            }
            break;
    }
}