<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "guardar":
            if(empty($id_metodos_pago_bans)) {
                $logs_sys .= "INSERT INTO metodos_pago_bans VALUES(
                                NULL,
                                '" . $id_metodo_pago_metodos_pago_bans . "',
                                '" . $correo_metodos_pago_bans . "')<br />";
                $result = $conn->query("INSERT INTO metodos_pago_bans VALUES(
                                NULL,
                                '" . $id_metodo_pago_metodos_pago_bans . "',
                                '" . $correo_metodos_pago_bans . "')");
                $id_metodos_pago_bans = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE metodos_pago_bans SET 
                    id_metodo_pago = '" . $id_metodo_pago_metodos_pago_bans . "',
                    correo = '" . $correo_metodos_pago_bans . "' 
                  WHERE id=" . $id_metodos_pago_bans . " LIMIT 1<br />";

                $result = $conn->query("UPDATE metodos_pago_bans SET 
                    id_metodo_pago = '" . $id_metodo_pago_metodos_pago_bans . "',
                    correo = '" . $correo_metodos_pago_bans . "' 
                  WHERE id=" . $id_metodos_pago_bans . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_metodos_pago_bans,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM metodos_pago_bans WHERE id=" . $id_metodos_pago_bans . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM metodos_pago_bans WHERE id=" . $id_metodos_pago_bans . " LIMIT 1");
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