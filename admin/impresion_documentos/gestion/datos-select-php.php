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

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM modelos_impresion_1 WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result_modelos = $conn->query("SELECT id,descripcion,tipo_documento,activo FROM modelos_impresion_1 WHERE id <> 0" . $whereBusqueda . " ORDER BY tipo_documento, descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            foreach ($result_modelos as $key_modelos => $valor_modelos) {
                $matriz_id_modelos[] = $valor_modelos['id'];
                $matriz_descripcion_modelos[] = stripslashes($valor_modelos['descripcion']);
                $matriz_tipo_documento_modelos[] = $valor_modelos['tipo_documento'];
                $matriz_activo_modelos[] = $valor_modelos['activo'];
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_modelos = 0;
                $descripcion_modelos = "";
                $ancho_modelos = 210;
                $alto_modelos = 297;
                $interlineado_modelos = 5;
                $marcar_lineas_modelos = 0;
                $lineas_pagina_modelos = 25;
                $tipo_documento_modelos = "fac";
                $serie_modelos = "";
                $predeterminado_modelos = 0;
                $activo_modelos = 1;

                $id_lineas_modelos = [];
                $zona_lineas_modelos = [];
                $campo_lineas_modelos = [];
                $inicio_ancho_lineas_modelos = [];
                $inicio_alto_lineas_modelos = [];
                $ancho_lineas_modelos = [];
                $alto_lineas_modelos = [];
                $col_r_letra_lineas_modelos = [];
                $col_g_letra_lineas_modelos = [];
                $col_b_letra_lineas_modelos = [];
                $border_lineas_modelos = [];
                $grueso_borde_lineas_modelos = [];
                $col_r_borde_lineas_modelos = [];
                $col_g_borde_lineas_modelos = [];
                $col_b_borde_lineas_modelos = [];
                $alineacion_lineas_modelos = [];
                $fuente_letra_lineas_modelos = [];
                $estilo_letra_lineas_modelos = [];
                $size_letra_lineas_modelos = [];
                $mostrar_lineas_modelos = [];
            }else {
                $result_modelos_1 = $conn->query("SELECT * FROM modelos_impresion_1 WHERE id=" . $id_url . " LIMIT 1");
                if($conn->registros() == 1) {
                    foreach ($result_modelos_1 as $key_modelos_1 => $valor_modelos_1) {
                        echo "Descripcion: ".stripslashes($valor_modelos_1['descripcion'])."<br />";
                        $descripcion_modelos = stripslashes($valor_modelos_1['descripcion']);
                        $ancho_modelos = $valor_modelos_1['ancho'];
                        $alto_modelos = $valor_modelos_1['alto'];
                        $interlineado_modelos = $valor_modelos_1['interlineado'];
                        $marcar_lineas_modelos = $valor_modelos_1['marcar_lineas'];
                        $lineas_pagina_modelos = $valor_modelos_1['lineas_pagina'];
                        $tipo_documento_modelos = $valor_modelos_1['tipo_documento'];
                        $serie_modelos = $valor_modelos_1['serie'];
                        $predeterminado_modelos = $valor_modelos_1['predeterminado'];
                        $activo_modelos = $valor_modelos_1['activo'];
                    }

                    $result_modelos_2 = $conn->query("SELECT * FROM modelos_impresion_2 WHERE id_modelos_impresion_1=" . $id_url . " ORDER BY zona, inicio_ancho, inicio_alto");
                    foreach ($result_modelos_2 as $key_modelos_2 => $valor_modelos_2) {
                        $id_lineas_modelos[] = $valor_modelos_2['id'];
                        $zona_lineas_modelos[] = $valor_modelos_2['zona'];
                        $campo_lineas_modelos[] = $valor_modelos_2['campo'];
                        $inicio_ancho_lineas_modelos[] = $valor_modelos_2['inicio_ancho'];
                        $inicio_alto_lineas_modelos[] = $valor_modelos_2['inicio_alto'];
                        $ancho_lineas_modelos[] = $valor_modelos_2['ancho'];
                        $alto_lineas_modelos[] = $valor_modelos_2['alto'];
                        $col_r_letra_lineas_modelos[] = $valor_modelos_2['col_r_letra'];
                        $col_g_letra_lineas_modelos[] = $valor_modelos_2['col_g_letra'];
                        $col_b_letra_lineas_modelos[] = $valor_modelos_2['col_b_letra'];
                        $border_lineas_modelos[] = $valor_modelos_2['border'];
                        $grueso_borde_lineas_modelos[] = $valor_modelos_2['grueso_borde'];
                        $col_r_borde_lineas_modelos[] = $valor_modelos_2['col_r_borde'];
                        $col_g_borde_lineas_modelos[] = $valor_modelos_2['col_g_borde'];
                        $col_b_borde_lineas_modelos[] = $valor_modelos_2['col_b_borde'];
                        $alineacion_lineas_modelos[] = $valor_modelos_2['alineacion'];
                        $fuente_letra_lineas_modelos[] = $valor_modelos_2['fuente_letra'];
                        $estilo_letra_lineas_modelos[] = $valor_modelos_2['estilo_letra'];
                        $size_letra_lineas_modelos[] = $valor_modelos_2['size_letra'];
                        $mostrar_lineas_modelos[] = $valor_modelos_2['mostrar'];
                    }
                }
            }

            $result_series = $conn->query("SELECT * FROM documentos_numeraciones_series WHERE tipo_documento='" . $tipo_documento_modelos . "' ORDER BY serie");
            if($conn->registros() >= 1) {
                foreach ($result_series as $key_series => $valor_series) {
                    $series[] = stripslashes($valor_series['serie']);
                }
            }
            break;
    }
}