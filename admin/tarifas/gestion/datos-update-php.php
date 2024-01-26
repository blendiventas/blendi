<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result_tarifas = $conn->query("SELECT activa FROM tarifas WHERE id=" . $id_tarifas . " LIMIT 1");
            if ($result_tarifas[0]['activa'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result_tarifas = $conn->query("UPDATE tarifas SET activa=" . $valor_sys . " WHERE id=" . $id_tarifas . " LIMIT 1");
            $logs_sys .= "UPDATE tarifas SET activa=" . $valor_sys . " WHERE id=" . $id_tarifas . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_tarifas)) {
                if($prioritaria_tarifas == 1) {
                    $logs_sys .= "UPDATE tarifas SET prioritaria=0 WHERE prioritaria=1 LIMIT 1<br />";
                    $result_tarifas = $conn->query("UPDATE tarifas SET prioritaria=0 WHERE prioritaria=1 LIMIT 1");
                }
                $logs_sys .= "INSERT INTO tarifas VALUES(
                              NULL,
                              " . $id_idioma_tarifas . ",
                              '" . addslashes($descripcion_tarifas) . "',
                              " . $prioritaria_tarifas . ",
                              " . $activa_tarifas . ",
                              '" . addslashes($orden_tarifas) . "')<br />";
                $result_tarifas = $conn->query("INSERT INTO tarifas VALUES(
                              NULL,
                              " . $id_idioma_tarifas . ",
                              '" . addslashes($descripcion_tarifas) . "',
                              " . $prioritaria_tarifas . ",
                              " . $activa_tarifas . ",
                              '" . addslashes($orden_tarifas) . "')");

                $id_tarifas = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                if($prioritaria_tarifas == 1) {
                    $logs_sys .= "UPDATE tarifas SET prioritaria=0 WHERE prioritaria=1 LIMIT 1<br />";
                    $result_tarifas = $conn->query("UPDATE tarifas SET prioritaria=0 WHERE prioritaria=1 LIMIT 1");
                }
                $logs_sys .= "UPDATE tarifas SET 
                  id_idioma=" . $id_idioma_tarifas . ", 
                  descripcion='" . addslashes($descripcion_tarifas) . "', 
                  prioritaria=" . $prioritaria_tarifas . ", 
                  activa=" . $activa_tarifas . ",
                  orden='" . addslashes($orden_tarifas) . "' 
                  WHERE id=" . $id_tarifas . " LIMIT 1<br />";

                $result_tarifas = $conn->query("UPDATE tarifas SET 
                  id_idioma=" . $id_idioma_tarifas . ", 
                  descripcion='" . addslashes($descripcion_tarifas) . "', 
                  prioritaria=" . $prioritaria_tarifas . ", 
                  activa=" . $activa_tarifas . ",
                  orden='" . addslashes($orden_tarifas) . "' 
                  WHERE id=" . $id_tarifas . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_tarifas,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM tarifas WHERE id=" . $id_tarifas . " LIMIT 1<br />";
            $result_tarifas = $conn->query("DELETE FROM tarifas WHERE id=" . $id_tarifas . " LIMIT 1");
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