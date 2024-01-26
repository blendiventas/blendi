<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "comedores":
            $result = $conn->query("SELECT * FROM comedores ORDER BY orden");
            foreach ($result as $key => $valor) {
                $id_comedores[] = $valor['id'];
                $descripcion_comedores[] = stripslashes($valor['descripcion']);
                $principal_comedores[] = $valor['principal'];
                $activo_comedores[] = $valor['activo'];
                $fecha_alta_comedores[] = $valor['fecha_alta'];
                $fecha_modificacion_comedores[] = $valor['fecha_modificacion'];
            }
            break;
        case "mostrar-mesas":
            $ancho_pos_minimo_iniciado = false;
            $ancho_capa_mesas = 10;
            $alto_capa_mesas = 10;
            $result = $conn->query("SELECT * FROM libradores WHERE tipo='mes' AND id_comedores='" . $id_comedor . "'");
            foreach ($result as $key => $valor) {
                $matriz_id_mesas[] = $valor['id'];
                $matriz_descripcion_mesas[] = stripslashes($valor['nombre']);
                $matriz_activo_mesas[] = $valor['activo'];
                $matriz_image_mesa_mesas[] = stripslashes($valor['imagen_mesa']);
                $matriz_imagen_mesa_ocupada[] = stripslashes($valor['imagen_mesa_ocupada']);
                $matriz_radio_mesas[] = $valor['radio'];
                $matriz_ancho_pos_mesas[] = $valor['ancho_pos'];
                $matriz_alto_pos_mesas[] = $valor['alto_pos'];
                $matriz_ancho_mesas[] = $valor['ancho'];
                $matriz_alto_mesas[] = $valor['alto'];
                if($valor['ancho_pos'] + $valor['ancho'] > $ancho_capa_mesas) {
                    $ancho_capa_mesas = $valor['ancho_pos'] + ($valor['ancho'] * 2);
                }
                if($valor['alto_pos'] + $valor['alto'] > $alto_capa_mesas) {
                    $alto_capa_mesas = $valor['alto_pos'] + ($valor['alto'] * 2);
                }
                if($ancho_pos_minimo_iniciado == false) {
                    $ancho_pos_minimo_iniciado = true;
                    $ancho_pos_minimo_iniciado = $valor['ancho_pos'];
                }else {
                    if($valor['ancho_pos'] < $ancho_pos_minimo_iniciado) {
                        $ancho_pos_minimo_iniciado = $valor['ancho_pos'];
                    }
                }
            }
            break;
        case "mostrar-lineas":
            if (!isset($ancho_pos_minimo_iniciado)) {
                $ancho_pos_minimo_iniciado = false;
            }
            if (!isset($ancho_capa_mesas)) {
                $ancho_capa_mesas = 10;
            }
            if (!isset($alto_capa_mesas)) {
                $alto_capa_mesas = 10;
            }
            $result = $conn->query("SELECT * FROM libradores_lineas WHERE id_comedores='" . $id_comedor . "'");
            foreach ($result as $key => $valor) {
                $matriz_id_lineas[] = $valor['id'];
                $matriz_ancho_pos_lineas[] = $valor['ancho_pos'];
                $matriz_alto_pos_lineas[] = $valor['alto_pos'];
                $matriz_ancho_lineas[] = $valor['ancho'];
                $matriz_alto_lineas[] = $valor['alto'];
                if($valor['ancho_pos'] + $valor['ancho'] > $ancho_capa_mesas) {
                    $ancho_capa_mesas = $valor['ancho_pos'] + ($valor['ancho'] * 2);
                }
                if($valor['alto_pos'] + $valor['alto'] > $alto_capa_mesas) {
                    $alto_capa_mesas = $valor['alto_pos'] + ($valor['alto'] * 2);
                }
                if($ancho_pos_minimo_iniciado == false) {
                    $ancho_pos_minimo_iniciado = true;
                    $ancho_pos_minimo_iniciado = $valor['ancho_pos'];
                }else {
                    if($valor['ancho_pos'] < $ancho_pos_minimo_iniciado) {
                        $ancho_pos_minimo_iniciado = $valor['ancho_pos'];
                    }
                }
            }
            break;
    }
}