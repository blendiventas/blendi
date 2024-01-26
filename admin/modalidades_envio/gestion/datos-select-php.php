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

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM modalidades_envio WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM modalidades_envio WHERE id <> 0" . $whereBusqueda . " ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_modalidades_envio[] = $valor['id'];
                $matriz_descripcion_modalidades_envio[] = $valor['descripcion'];
                $matriz_explicacion_modalidades_envio[] = $valor['explicacion'];
                $id_iva_modalidades_envio[] = $valor['id_iva'];
                $incremento_pvp_modalidades_envio[] = $valor['incremento_pvp'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_modalidades_envio' => $matriz_id_modalidades_envio,
                    'descripcion_modalidades_envio' => $matriz_descripcion_modalidades_envio,
                    'explicacion_modalidades_envio' => $matriz_explicacion_modalidades_envio,
                    'id_iva_modalidades_envio' => $id_iva_modalidades_envio,
                    'incremento_pvp_modalidades_envio' => $incremento_pvp_modalidades_envio
                ]);
            }
            break;

        case "listado-zonas":
            $result_modalidades_envio_zonas = $conn->query("SELECT mez.*, z.zona FROM modalidades_envio_zonas mez JOIN zonas z ON mez.id_zona = z.id WHERE mez.id_modalidad_envio=" . $id_url . " ORDER BY mez.id_zona ASC");
            $modalidades_envio_zonas_id = [];
            $modalidades_envio_zonas_id_zona = [];
            $modalidades_envio_zonas_zona = [];
            $modalidades_envio_zonas_incremento_pvp = [];
            $modalidades_envio_zonas_incremento_por_kilo = [];
            $modalidades_envio_zonas_volumen_maximo_bulto = [];
            if ($conn->registros() >= 1) {
                foreach ($result_modalidades_envio_zonas as $modalidades_envio_zonas) {
                    $modalidades_envio_zonas_id[] = $modalidades_envio_zonas['id'];
                    $modalidades_envio_zonas_id_zona[] = $modalidades_envio_zonas['id_zona'];
                    $modalidades_envio_zonas_zona[] = stripslashes($modalidades_envio_zonas['zona']);
                    $modalidades_envio_zonas_incremento_pvp[] = $modalidades_envio_zonas['incremento_pvp'];
                    $modalidades_envio_zonas_incremento_por_kilo[] = $modalidades_envio_zonas['incremento_por_kilo'];
                    $modalidades_envio_zonas_volumen_maximo_bulto[] = $modalidades_envio_zonas['volumen_maximo_bulto'];
                }
            }

            break;

        case "listado-zonas-franjas":
            $result_modalidades_envio_zonas_franjas = $conn->query("SELECT * FROM modalidades_envio_zonas_franjas WHERE id_modalidad_envio_zona=" . $modalidad_envio_zona_id . " ORDER BY volumen_desde ASC");
            $modalidades_envio_zonas_franjas_id = [];
            $modalidades_envio_zonas_franjas_id_modalidad_envio_zona = [];
            $modalidades_envio_zonas_franjas_incremento_pvp = [];
            $modalidades_envio_zonas_franjas_volumen_desde = [];
            $modalidades_envio_zonas_franjas_volumen_hasta = [];
            if ($conn->registros() >= 1) {
                foreach ($result_modalidades_envio_zonas_franjas as $modalidades_envio_zonas_franjas) {
                    $modalidades_envio_zonas_franjas_id[] = $modalidades_envio_zonas_franjas['id'];
                    $modalidades_envio_zonas_franjas_id_modalidad_envio_zona[] = $modalidades_envio_zonas_franjas['id_modalidad_envio_zona'];
                    $modalidades_envio_zonas_franjas_incremento_pvp[] = $modalidades_envio_zonas_franjas['incremento_pvp'];
                    $modalidades_envio_zonas_franjas_volumen_desde[] = $modalidades_envio_zonas_franjas['volumen_desde'];
                    $modalidades_envio_zonas_franjas_volumen_hasta[] = $modalidades_envio_zonas_franjas['volumen_hasta'];
                }
            }

            break;

        case "editar-ficha":
            if(empty($id_url)) {
                $id_modalidades_envio = 0;
                $descripcion_modalidades_envio = '';
                $explicacion_modalidades_envio = '';
                $id_iva_modalidades_envio = '';
                $incremento_pvp_modalidades_envio = '';
            }else {
                $result = $conn->query("SELECT * FROM modalidades_envio WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_modalidades_envio = $valor['id'];
                    $descripcion_modalidades_envio = $valor['descripcion'];
                    $explicacion_modalidades_envio = $valor['explicacion'];
                    $id_iva_modalidades_envio = $valor['id_iva'];
                    $incremento_pvp_modalidades_envio = $valor['incremento_pvp'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_modalidades_envio' => $id_modalidades_envio,
                    'descripcion_modalidades_envio' => $descripcion_modalidades_envio,
                    'explicacion_modalidades_envio' => $explicacion_modalidades_envio,
                    'id_iva_modalidades_envio' => $id_iva_modalidades_envio,
                    'incremento_pvp_modalidades_envio' => $incremento_pvp_modalidades_envio
                ]);
            }
            break;
    }
}