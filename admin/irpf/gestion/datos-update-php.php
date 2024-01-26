<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activo FROM irpf WHERE id=" . $id_productos_irpf . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE irpf SET activo=" . $valor_sys . " WHERE id=" . $id_productos_irpf . " LIMIT 1");
            $logs_sys .= "UPDATE irpf SET activo=" . $valor_sys . " WHERE id=" . $id_productos_irpf . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_productos_irpf)) {
                $logs_sys .= "INSERT INTO irpf VALUES(
                              NULL,
                              " . $irpf_productos_irpf . ",
                              " . $activo_productos_irpf . ")<br />";
                $result = $conn->query("INSERT INTO irpf VALUES(
                              NULL,
                              " . $irpf_productos_irpf . ",
                              " . $activo_productos_irpf . ")");
                $id_productos_irpf = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE irpf SET 
                  irpf=" . $irpf_productos_irpf . ", 
                  activo=" . $activo_productos_irpf . " 
                  WHERE id=" . $id_productos_irpf . " LIMIT 1<br />";

                $result = $conn->query("UPDATE irpf SET 
                  irpf=" . $irpf_productos_irpf . ", 
                  activo=" . $activo_productos_irpf . " 
                  WHERE id=" . $id_productos_irpf . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_productos_irpf,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM irpf WHERE id=" . $id_productos_irpf . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM irpf WHERE id=" . $id_productos_irpf . " LIMIT 1");
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