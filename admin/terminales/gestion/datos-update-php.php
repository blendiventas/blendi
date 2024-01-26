<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result_terminales = $conn->query("SELECT activo FROM terminales WHERE id=" . $id_terminal . " LIMIT 1");
            if ($result_terminales[0]['activo'] == 1) {
                $valor_sys = 0;
            } else {
                $valor_sys = 1;
            }
            $result_terminales = $conn->query("UPDATE terminales SET activo=" . $valor_sys . " WHERE id=" . $id_terminal . " LIMIT 1");
            $logs_sys .= "UPDATE terminales SET activo=" . $valor_sys . " WHERE id=" . $id_terminal . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_terminal)) {
                $logs_sys .= "";
                $result_terminales = $conn->query("INSERT INTO terminales VALUES(
                              NULL,
                              '" . addslashes($descripcion_terminal) . "',
                              '" . $mostrar_todo_terminal . "',
                              '" . $activo_terminal . "',
                              '" . date("Y-m-d") . "',
                              '" . date("Y-m-d") . "')");

                $id_terminal = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE terminales SET 
                  descripcion='" . addslashes($descripcion_terminal) . "', 
                  mostrar_todo='" . $mostrar_todo_terminal . "', 
                  activo='" . $activo_terminal . "',
                  fecha_modificacion='" . date("Y-m-d") . "' 
                  WHERE id=" . $id_terminal . " LIMIT 1";

                $result_terminales = $conn->query("UPDATE terminales SET 
                  descripcion='" . addslashes($descripcion_terminal) . "', 
                  mostrar_todo='" . $mostrar_todo_terminal . "', 
                  activo='" . $activo_terminal . "',
                  fecha_modificacion='" . date("Y-m-d") . "' 
                  WHERE id=" . $id_terminal . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_terminal,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM terminales WHERE id=" . $id_terminal . " LIMIT 1<br />";
            $result_terminales = $conn->query("DELETE FROM terminales WHERE id=" . $id_terminal . " LIMIT 1");
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