<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "guardar":
            if(empty($id_libradores_zonas)) {
                $logs_sys .= "INSERT INTO zonas VALUES(
                              NULL,
                              '" . $zona_libradores_zonas . "')<br />";
                $result = $conn->query("INSERT INTO zonas VALUES(
                              NULL,
                              '" . $zona_libradores_zonas . "')");
                $id_libradores_zonas = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE zonas SET 
                  zona='" . $zona_libradores_zonas . "'
                  WHERE id=" . $id_libradores_zonas . " LIMIT 1<br />";

                $result = $conn->query("UPDATE zonas SET 
                  zona='" . $zona_libradores_zonas . "' 
                  WHERE id=" . $id_libradores_zonas . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_libradores_zonas,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM zonas WHERE id=" . $id_libradores_zonas . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM zonas WHERE id=" . $id_libradores_zonas . " LIMIT 1");
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