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

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM bancos_cajas WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT * FROM bancos_cajas WHERE id <> 0" . $whereBusqueda . " ORDER BY descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_bancos_cajas[] = $valor['id'];
                $matriz_descripcion[] = $valor['descripcion'];
                $matriz_activo_bancos_cajas[] = $valor['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_bancos_cajas' => $matriz_id_bancos_cajas,
                    'descripcion' => $matriz_descripcion,
                    'activo_bancos_cajas' => $matriz_activo_bancos_cajas
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_bancos_cajas = 0;
                $descripcion = '';
                $entidad = '';
                $agencia = '';
                $dc = '';
                $cuenta = '';
                $iban = '';
                $activo_bancos_cajas = 1;
            }else {
                $result = $conn->query("SELECT * FROM bancos_cajas WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_bancos_cajas = $valor['id'];
                    $descripcion = $valor['descripcion'];
                    $entidad = $valor['entidad'];
                    $agencia = $valor['agencia'];
                    $dc = $valor['dc'];
                    $cuenta = $valor['cuenta'];
                    $iban = $valor['iban'];
                    $activo_bancos_cajas = $valor['activo'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_bancos_cajas' => $id_bancos_cajas,
                    'descripcion' => $descripcion,
                    'entidad' => $entidad,
                    'agencia' => $agencia,
                    'dc' => $dc,
                    'cuenta' => $cuenta,
                    'iban' => $iban,
                    'activo_bancos_cajas' => $activo_bancos_cajas
                ]);
            }
            break;
    }
}