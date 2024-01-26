<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "guardar":
            if(empty($id_modalidades_envio)) {
                $logs_sys .= "INSERT INTO modalidades_envio VALUES(
                                NULL,
                                '" . $descripcion_modalidades_envio . "',
                                '" . $explicacion_modalidades_envio . "',
                                " . $id_iva_modalidades_envio . ",
                                '" . $incremento_pvp_modalidades_envio . "')<br />";
                $result = $conn->query("INSERT INTO modalidades_envio VALUES(
                                NULL,
                                '" . $descripcion_modalidades_envio . "',
                                '" . $explicacion_modalidades_envio . "',
                                " . $id_iva_modalidades_envio . ",
                                '" . $incremento_pvp_modalidades_envio . "')");
                $id_modalidades_envio = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE modalidades_envio SET 
                    descripcion = '" . $descripcion_modalidades_envio . "',
                    explicacion = '" . $explicacion_modalidades_envio . "',
                    id_iva = '" . $id_iva_modalidades_envio . "',
                    incremento_pvp = '" . $incremento_pvp_modalidades_envio . "' 
                  WHERE id=" . $id_modalidades_envio . " LIMIT 1<br />";

                $result = $conn->query("UPDATE modalidades_envio SET 
                    descripcion = '" . $descripcion_modalidades_envio . "',
                    explicacion = '" . $explicacion_modalidades_envio . "',
                    id_iva = '" . $id_iva_modalidades_envio . "',
                    incremento_pvp = '" . $incremento_pvp_modalidades_envio . "' 
                  WHERE id=" . $id_modalidades_envio . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_modalidades_envio,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "guardar-zona":
            if(empty($id_modalidades_envio_zonas)) {
                $logs_sys .= "INSERT INTO modalidades_envio_zonas VALUES(
                                NULL,
                                '" . $id_modalidad_envio_modalidades_envio_zonas . "',
                                '" . $id_zona_modalidades_envio_zonas . "',
                                '" . $incremento_pvp_modalidades_envio_zonas . "',
                                '" . $incremento_por_kilo_modalidades_envio_zonas . "',
                                '" . $volumen_maximo_bulto_modalidades_envio_zonas . "')<br />";
                $result = $conn->query("INSERT INTO modalidades_envio_zonas VALUES(
                                NULL,
                                '" . $id_modalidad_envio_modalidades_envio_zonas . "',
                                '" . $id_zona_modalidades_envio_zonas . "',
                                '" . $incremento_pvp_modalidades_envio_zonas . "',
                                '" . $incremento_por_kilo_modalidades_envio_zonas . "',
                                '" . $volumen_maximo_bulto_modalidades_envio_zonas . "')");
                $id_modalidades_envio_zonas = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE modalidades_envio_zonas SET 
                    id_modalidad_envio = '" . $id_modalidad_envio_modalidades_envio_zonas . "',
                    id_zona = '" . $id_zona_modalidades_envio_zonas . "',
                    incremento_pvp = '" . $incremento_pvp_modalidades_envio_zonas . "',
                    incremento_por_kilo = '" . $incremento_por_kilo_modalidades_envio_zonas . "',
                    volumen_maximo_bulto = '" . $volumen_maximo_bulto_modalidades_envio_zonas . "' 
                  WHERE id=" . $id_modalidades_envio_zonas . " LIMIT 1<br />";

                $result = $conn->query("UPDATE modalidades_envio_zonas SET 
                    id_modalidad_envio = '" . $id_modalidad_envio_modalidades_envio_zonas . "',
                    id_zona = '" . $id_zona_modalidades_envio_zonas . "',
                    incremento_pvp = '" . $incremento_pvp_modalidades_envio_zonas . "',
                    incremento_por_kilo = '" . $incremento_por_kilo_modalidades_envio_zonas . "',
                    volumen_maximo_bulto = '" . $volumen_maximo_bulto_modalidades_envio_zonas . "' 
                  WHERE id=" . $id_modalidades_envio_zonas . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }

            $result = $conn->query("DELETE FROM modalidades_envio_zonas_franjas WHERE id_modalidad_envio_zona = " . $id_modalidades_envio_zonas);
            foreach ($franjas_incremento_pvp_modalidades_envio_zonas as $key_franja => $franja_incremento_pvp_modalidades_envio_zonas) {
                if ($franja_incremento_pvp_modalidades_envio_zonas > 0) {
                    $result = $conn->query("INSERT INTO modalidades_envio_zonas_franjas VALUES(NULL, " . $id_modalidades_envio_zonas . ", '" . $franja_incremento_pvp_modalidades_envio_zonas . "', '" . $franjas_volumen_desde_modalidades_envio_zonas[$key_franja] . "', '" . $franjas_volumen_hasta_modalidades_envio_zonas[$key_franja] . "')");
                }
            }
            
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_modalidades_envio_zonas,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar-zona":
            $logs_sys .= "DELETE FROM modalidades_envio_zonas WHERE id=" . $id_modalidades_envio_zonas . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM modalidades_envio_zonas WHERE id=" . $id_modalidades_envio_zonas . " LIMIT 1");
            $resultado_sys = "DELETE";
            $result = $conn->query("DELETE FROM modalidades_envio_zonas_franjas WHERE id_modalidad_envio_zona = " . $id_modalidades_envio_zonas);
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM modalidades_envio WHERE id=" . $id_modalidades_envio . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM modalidades_envio WHERE id=" . $id_modalidades_envio . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
    }
}