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
                $whereBusqueda .= " AND (mpb.correo LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM metodos_pago_bans WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT mpb.*, mp.descripcion AS descripcion FROM metodos_pago_bans mpb JOIN metodos_pago mp ON mpb.id_metodo_pago = mp.id WHERE mpb.id <> 0" . $whereBusqueda . " ORDER BY correo LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_metodos_pago_bans[] = $valor['id'];
                $matriz_id_metodo_pago_metodos_pago_bans[] = $valor['id_metodo_pago'];
                $matriz_descripcion_metodos_pago_bans[] = $valor['descripcion'];
                $matriz_correo_metodos_pago_bans[] = $valor['correo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_metodos_pago_bans' => $matriz_id_metodos_pago_bans,
                    'id_metodo_pago_metodos_pago_bans' => $matriz_id_metodo_pago_metodos_pago_bans,
                    'descripcion_metodos_pago_bans' => $matriz_descripcion_metodos_pago_bans,
                    'correo_metodos_pago_bans' => $matriz_correo_metodos_pago_bans
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_metodos_pago_bans = 0;
                $id_metodo_pago_metodos_pago_bans = 0;
                $correo_metodos_pago_bans = '';
            }else {
                $result = $conn->query("SELECT * FROM metodos_pago_bans WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_metodos_pago_bans = $valor['id'];
                    $id_metodo_pago_metodos_pago_bans = $valor['id_metodo_pago'];
                    $correo_metodos_pago_bans = $valor['correo'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_metodos_pago_bans' => $id_metodos_pago_bans,
                    'id_metodo_pago_metodos_pago_bans' => $id_metodo_pago_metodos_pago_bans,
                    'correo_metodos_pago_bans' => $correo_metodos_pago_bans
                ]);
            }
            break;
    }
}