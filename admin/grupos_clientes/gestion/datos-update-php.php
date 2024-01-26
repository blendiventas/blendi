<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activo FROM grupos_clientes WHERE id=" . $id_grupos_clientes . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE grupos_clientes SET activo=" . $valor_sys . " WHERE id=" . $id_grupos_clientes . " LIMIT 1");
            $logs_sys .= "UPDATE grupos_clientes SET activo=" . $valor_sys . " WHERE id=" . $id_grupos_clientes . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_grupos_clientes)) {
                if($prioritario_grupos_clientes == 1) {
                    $logs_sys .= "UPDATE grupos_clientes SET prioritario=0 WHERE prioritario=1 LIMIT 1<br />";
                    $result = $conn->query("UPDATE grupos_clientes SET prioritario=0 WHERE prioritario=1 LIMIT 1");
                }
                $logs_sys .= "INSERT INTO grupos_clientes VALUES(
                              NULL,
                              '" . addslashes($descripcion_grupos_clientes) . "',
                              " . $prioritario_grupos_clientes . ",
                              " . $activo_grupos_clientes . ")<br />";
                $result = $conn->query("INSERT INTO grupos_clientes VALUES(
                              NULL,
                              '" . addslashes($descripcion_grupos_clientes) . "',
                              " . $prioritario_grupos_clientes . ",
                              " . $activo_grupos_clientes . ")");
                $id_grupos_clientes = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                if($prioritario_grupos_clientes == 1) {
                    $logs_sys .= "UPDATE grupos_clientes SET prioritario=0 WHERE prioritario=1 LIMIT 1<br />";
                    $result = $conn->query("UPDATE grupos_clientes SET prioritario=0 WHERE prioritario=1 LIMIT 1");
                }
                $logs_sys .= "UPDATE grupos_clientes SET 
                  descripcion='" . addslashes($descripcion_grupos_clientes) . "', 
                  prioritario=" . $prioritario_grupos_clientes . ", 
                  activo=" . $activo_grupos_clientes . " 
                  WHERE id=" . $id_grupos_clientes . " LIMIT 1<br />";

                $result = $conn->query("UPDATE grupos_clientes SET 
                  descripcion='" . addslashes($descripcion_grupos_clientes) . "', 
                  prioritario=" . $prioritario_grupos_clientes . ", 
                  activo=" . $activo_grupos_clientes . " 
                  WHERE id=" . $id_grupos_clientes . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_grupos_clientes,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM grupos_clientes WHERE id=" . $id_grupos_clientes . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM grupos_clientes WHERE id=" . $id_grupos_clientes . " LIMIT 1");
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