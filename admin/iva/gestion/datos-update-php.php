<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activo FROM productos_iva WHERE id=" . $id_productos_iva . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE productos_iva SET activo=" . $valor_sys . " WHERE id=" . $id_productos_iva . " LIMIT 1");
            $logs_sys .= "UPDATE productos_iva SET activo=" . $valor_sys . " WHERE id=" . $id_productos_iva . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_productos_iva)) {
                if($prioritario_productos_iva == 1) {
                    $logs_sys .= "UPDATE productos_iva SET prioritario=0 WHERE prioritario=1 LIMIT 1<br />";
                    $result = $conn->query("UPDATE productos_iva SET prioritario=0 WHERE prioritario=1 LIMIT 1");
                }
                $logs_sys .= "INSERT INTO productos_iva VALUES(
                              NULL,
                              " . $iva_productos_iva . ",
                              " . $recargo_productos_iva . ",
                              " . $prioritario_productos_iva . ",
                              " . $activo_productos_iva . ")<br />";
                $result = $conn->query("INSERT INTO productos_iva VALUES(
                              NULL,
                              " . $iva_productos_iva . ",
                              " . $recargo_productos_iva . ",
                              " . $prioritario_productos_iva . ",
                              " . $activo_productos_iva . ")");
                $id_productos_iva = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                if($prioritario_productos_iva == 1) {
                    $logs_sys .= "UPDATE productos_iva SET prioritario=0 WHERE prioritario=1 LIMIT 1<br />";
                    $result = $conn->query("UPDATE productos_iva SET prioritario=0 WHERE prioritario=1 LIMIT 1");
                }
                $logs_sys .= "UPDATE productos_iva SET 
                  iva=" . $iva_productos_iva . ", 
                  recargo='" . $recargo_productos_iva . "', 
                  prioritario=" . $prioritario_productos_iva . ", 
                  activo=" . $activo_productos_iva . " 
                  WHERE id=" . $id_productos_iva . " LIMIT 1<br />";

                $result = $conn->query("UPDATE productos_iva SET 
                  iva=" . $iva_productos_iva . ", 
                  recargo='" . $recargo_productos_iva . "', 
                  prioritario=" . $prioritario_productos_iva . ", 
                  activo=" . $activo_productos_iva . " 
                  WHERE id=" . $id_productos_iva . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_productos_iva,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM productos_iva WHERE id=" . $id_productos_iva . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_iva WHERE id=" . $id_productos_iva . " LIMIT 1");
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