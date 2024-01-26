<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "guardar":
            if(empty($id_modalidades_entrega)) {
                $logs_sys .= "INSERT INTO modalidades_entrega VALUES(
                                NULL,
                                '" . $descripcion_modalidades_entrega . "',
                                '" . $explicacion_modalidades_entrega . "')<br />";
                $result = $conn->query("INSERT INTO modalidades_entrega VALUES(
                                NULL,
                                '" . $descripcion_modalidades_entrega . "',
                                '" . $explicacion_modalidades_entrega . "')");
                $id_modalidades_entrega = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE modalidades_entrega SET 
                    descripcion = '" . $descripcion_modalidades_entrega . "',
                    explicacion = '" . $explicacion_modalidades_entrega . "'
                  WHERE id=" . $id_modalidades_entrega . " LIMIT 1<br />";

                $result = $conn->query("UPDATE modalidades_entrega SET 
                    descripcion = '" . $descripcion_modalidades_entrega . "',
                    explicacion = '" . $explicacion_modalidades_entrega . "'
                  WHERE id=" . $id_modalidades_entrega . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_modalidades_entrega,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM modalidades_entrega WHERE id=" . $id_modalidades_entrega . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM modalidades_entrega WHERE id=" . $id_modalidades_entrega . " LIMIT 1");
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