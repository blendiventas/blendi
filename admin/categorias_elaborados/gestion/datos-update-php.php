<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "guardar":
            if(empty($id_categorias_elaborados)) {
                $logs_sys .= "INSERT INTO categorias_elaborados VALUES(
                              NULL,
                              '" . $descripcion_categorias_elaborados . "')<br />";
                $result = $conn->query("INSERT INTO categorias_elaborados VALUES(
                              NULL,
                              '" . $descripcion_categorias_elaborados . "')");
                $id_categorias_elaborados = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE categorias_elaborados SET 
                  descripcion='" . $descripcion_categorias_elaborados . "' 
                  WHERE id=" . $id_categorias_elaborados . " LIMIT 1<br />";

                $result = $conn->query("UPDATE categorias_elaborados SET 
                  descripcion='" . $descripcion_categorias_elaborados . "' 
                  WHERE id=" . $id_categorias_elaborados . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_categorias_elaborados,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM categorias_elaborados WHERE id=" . $id_categorias_elaborados . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM categorias_elaborados WHERE id=" . $id_categorias_elaborados . " LIMIT 1");
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