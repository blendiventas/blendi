<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result_modelos = $conn->query("SELECT activo FROM modelos_impresion_1 WHERE id=" . $id_modelos . " LIMIT 1");
            $valor_sys = $result_modelos[0]['activo'];

            $result_modelos = $conn->query("UPDATE modelos_impresion_1 SET activo=" . $valor_sys . " WHERE id=" . $id_modelos . " LIMIT 1");
            $logs_sys .= "UPDATE modelos_impresion_1 SET activo=" . $valor_sys . " WHERE id=" . $id_modelos . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if($predeterminado_modelos == 1) {
                $result_modelos = $conn->query("UPDATE modelos_impresion_1 SET predeterminado='0' 
                          WHERE tipo_documento=" . $tipo_documento_modelos);
            }
            if(empty($id_modelos)) {
                $logs_sys .= "INSERT INTO modelos_impresion_1 VALUES(
                              NULL,
                              '" . addslashes($descripcion_modelos) . "',
                              " . $ancho_modelos . ",
                              " . $alto_modelos . ",
                              " . $interlineado_modelos . ",
                              " . $marcar_lineas_modelos . ",
                              " . $lineas_pagina_modelos . ",
                              '" . $tipo_documento_modelos . "',
                              '" . $serie_modelos . "',
                              " . $activo_modelos . ",
                              '" . $predeterminado_modelos . "')";
                $result_modelos = $conn->query("INSERT INTO modelos_impresion_1 VALUES(
                              NULL,
                              '" . addslashes($descripcion_modelos) . "',
                              " . $ancho_modelos . ",
                              " . $alto_modelos . ",
                              " . $interlineado_modelos . ",
                              " . $marcar_lineas_modelos . ",
                              " . $lineas_pagina_modelos . ",
                              '" . $tipo_documento_modelos . "',
                              '" . $serie_modelos . "',
                              " . $activo_modelos . ",
                              '" . $predeterminado_modelos . "')");

                $id_modelos = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE modelos_impresion_1 SET  
                  descripcion='" . addslashes($descripcion_modelos) . "', 
                  ancho='" . $ancho_modelos . "', 
                  alto='".$alto_modelos."',
                  interlineado='".$interlineado_modelos."',
                  marcar_lineas='".$marcar_lineas_modelos."',
                  lineas_pagina='".$lineas_pagina_modelos."',
                  tipo_documento='".$tipo_documento_modelos."',
                  serie='" . $serie_modelos . "',
                  predeterminado='".$predeterminado_modelos."',
                  activo='".$activo_modelos."' 
                  WHERE id=" . $id_modelos . " LIMIT 1";
                $result_modelos = $conn->query("UPDATE modelos_impresion_1 SET  
                  descripcion='" . addslashes($descripcion_modelos) . "', 
                  ancho='" . $ancho_modelos . "', 
                  alto='".$alto_modelos."',
                  interlineado='".$interlineado_modelos."',
                  marcar_lineas='".$marcar_lineas_modelos."',
                  lineas_pagina='".$lineas_pagina_modelos."',
                  tipo_documento='".$tipo_documento_modelos."',
                  serie='" . $serie_modelos . "',
                  predeterminado='".$predeterminado_modelos."',
                  activo='".$activo_modelos."' 
                  WHERE id=" . $id_modelos . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_modelos,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "UPDATE modelos_impresion_1 SET activo=0 WHERE id=" . $id_modelos . " LIMIT 1";
            $result_modelos = $conn->query("UPDATE modelos_impresion_1 SET activo=0 WHERE id=" . $id_modelos . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_modelos,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "guardar-linea":
            if(empty($id_lineas_modelos)) {
                $logs_sys .= "INSERT INTO modelos_impresion_2 VALUES(
                              NULL,
                              '" . $id_modelos . "',
                              '" . addslashes($zona_modelos) . "',
                              '" . addslashes($campo_modelos) . "',
                              '" . $inicio_ancho_lineas_modelos . "',
                              '" . $inicio_alto_lineas_modelos . "',
                              '" . $ancho_lineas_modelos . "',
                              '" . $alto_lineas_modelos . "',
                              '" . $color_letra_r_lineas_modelos . "',
                              '" . $color_letra_g_lineas_modelos . "',
                              '" . $color_letra_b_lineas_modelos . "',
                              '" . $border_lineas_modelos . "',
                              '" . $grueso_borde_lineas_modelos . "',
                              '" . $color_borde_r_lineas_modelos . "',
                              '" . $color_borde_g_lineas_modelos . "',
                              '" . $color_borde_b_lineas_modelos . "',
                              '" . $alineacion_lineas_modelos . "',
                              '" . $fuente_letra_lineas_modelos . "',
                              '" . $estilo_letra_lineas_modelos . "',
                              '" . $size_letra_lineas_modelos . "',
                              '" . $mostrar_lineas_modelos . "')";
                $result_modelos = $conn->query("INSERT INTO modelos_impresion_2 VALUES(
                              NULL,
                              '" . $id_modelos . "',
                              '" . addslashes($zona_modelos) . "',
                              '" . addslashes($campo_modelos) . "',
                              '" . $inicio_ancho_lineas_modelos . "',
                              '" . $inicio_alto_lineas_modelos . "',
                              '" . $ancho_lineas_modelos . "',
                              '" . $alto_lineas_modelos . "',
                              '" . $color_letra_r_lineas_modelos . "',
                              '" . $color_letra_g_lineas_modelos . "',
                              '" . $color_letra_b_lineas_modelos . "',
                              '" . $border_lineas_modelos . "',
                              '" . $grueso_borde_lineas_modelos . "',
                              '" . $color_borde_r_lineas_modelos . "',
                              '" . $color_borde_g_lineas_modelos . "',
                              '" . $color_borde_b_lineas_modelos . "',
                              '" . $alineacion_lineas_modelos . "',
                              '" . $fuente_letra_lineas_modelos . "',
                              '" . $estilo_letra_lineas_modelos . "',
                              '" . $size_letra_lineas_modelos . "',
                              '" . $mostrar_lineas_modelos . "')");

                $id_lineas_modelos = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE modelos_impresion_2 SET
                    inicio_ancho = '" . $inicio_ancho_lineas_modelos . "',
                    inicio_alto = '" . $inicio_alto_lineas_modelos . "',
                    ancho = '" . $ancho_lineas_modelos . "',
                    alto = '" .$alto_lineas_modelos  . "',
                    col_r_letra = '" . $color_letra_r_lineas_modelos . "',
                    col_g_letra = '" . $color_letra_g_lineas_modelos . "',
                    col_b_letra = '" . $color_letra_b_lineas_modelos . "',
                    border = '" . $border_lineas_modelos . "',
                    grueso_borde = '" . $grueso_borde_lineas_modelos . "',
                    col_r_borde = '" . $color_borde_r_lineas_modelos . "',
                    col_g_borde = '" . $color_borde_g_lineas_modelos . "',
                    col_b_borde = '" . $color_borde_b_lineas_modelos . "',
                    alineacion = '" . $alineacion_lineas_modelos . "',
                    fuente_letra = '" . $fuente_letra_lineas_modelos . "',
                    estilo_letra = '" . $estilo_letra_lineas_modelos . "',
                    size_letra = '" . $size_letra_lineas_modelos . "',
                    mostrar = '" . $mostrar_lineas_modelos . "' 
                    WHERE id=" . $id_lineas_modelos . " LIMIT 1";
                $result_modelos = $conn->query("UPDATE modelos_impresion_2 SET
                    inicio_ancho = '" . $inicio_ancho_lineas_modelos . "',
                    inicio_alto = '" . $inicio_alto_lineas_modelos . "',
                    ancho = '" . $ancho_lineas_modelos . "',
                    alto = '" .$alto_lineas_modelos  . "',
                    col_r_letra = '" . $color_letra_r_lineas_modelos . "',
                    col_g_letra = '" . $color_letra_g_lineas_modelos . "',
                    col_b_letra = '" . $color_letra_b_lineas_modelos . "',
                    border = '" . $border_lineas_modelos . "',
                    grueso_borde = '" . $grueso_borde_lineas_modelos . "',
                    col_r_borde = '" . $color_borde_r_lineas_modelos . "',
                    col_g_borde = '" . $color_borde_g_lineas_modelos . "',
                    col_b_borde = '" . $color_borde_b_lineas_modelos . "',
                    alineacion = '" . $alineacion_lineas_modelos . "',
                    fuente_letra = '" . $fuente_letra_lineas_modelos . "',
                    estilo_letra = '" . $estilo_letra_lineas_modelos . "',
                    size_letra = '" . $size_letra_lineas_modelos . "',
                    mostrar = '" . $mostrar_lineas_modelos . "' 
                    WHERE id=" . $id_lineas_modelos . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_modelos,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar-linea":
            $logs_sys .= "UPDATE modelos_impresion_2 SET mostrar=0 WHERE id=" . $id_lineas_modelos . " LIMIT 1";
            $result_modelos = $conn->query("UPDATE modelos_impresion_2 SET mostrar=0 WHERE id=" . $id_lineas_modelos . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_modelos,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
    }
}