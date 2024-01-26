<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "guardar":
            if(empty($id_libradores_modalidades_pago)) {
                $logs_sys .= "INSERT INTO modalidades_pago VALUES(
                              NULL,
                              '" . $descripcion_libradores_modalidades_pago . "',
                              '" . $explicacion_libradores_modalidades_pago . "',
                              '" . $tienda_virtual_libradores_modalidades_pago . "',
                              '" . $defecto_libradores_modalidades_pago . "',
                              0,
                              '" . $incremento_pvp_libradores_modalidades_pago . "',
                              '" . $incremento_por_libradores_modalidades_pago . "')<br />";
                $result = $conn->query("INSERT INTO modalidades_pago VALUES(
                              NULL,
                              '" . $descripcion_libradores_modalidades_pago . "',
                              '" . $explicacion_libradores_modalidades_pago . "',
                              '" . $tienda_virtual_libradores_modalidades_pago . "',
                              '" . $defecto_libradores_modalidades_pago . "',
                              0,
                              '" . $incremento_pvp_libradores_modalidades_pago . "',
                              '" . $incremento_por_libradores_modalidades_pago . "')");
                $id_libradores_modalidades_pago = $conn->id_insert();
                foreach ($id_modalidades_pago_lineas as $key_id_modalidades_pago_lineas => $id_modalidades_pago_linea) {
                    if (empty($key_id_modalidades_pago_lineas)) {
                        continue;
                    }
                    $logs_sys .= "INSERT INTO modalidades_pago_lineas VALUES(
                              NULL,
                              " . $id_libradores_modalidades_pago . ",
                              " . $dias_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . ",
                              " . $porcentaje_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . ")<br />";
                    $result = $conn->query("INSERT INTO modalidades_pago_lineas VALUES(
                              NULL,
                              " . $id_libradores_modalidades_pago . ",
                              " . $dias_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . ",
                              " . $porcentaje_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . ")");
                }
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE modalidades_pago SET 
                  descripcion='" . $descripcion_libradores_modalidades_pago . "',
                  explicacion='" . $explicacion_libradores_modalidades_pago . "',
                  tienda_virtual='" . $tienda_virtual_libradores_modalidades_pago . "',
                  defecto='" . $defecto_libradores_modalidades_pago . "',
                  incremento_pvp='" . $incremento_pvp_libradores_modalidades_pago . "',
                  incremento_por='" . $incremento_por_libradores_modalidades_pago . "' 
                  WHERE id=" . $id_libradores_modalidades_pago . " LIMIT 1<br />";

                $result = $conn->query("UPDATE modalidades_pago SET 
                  descripcion='" . $descripcion_libradores_modalidades_pago . "', 
                  explicacion='" . $explicacion_libradores_modalidades_pago . "',
                  tienda_virtual='" . $tienda_virtual_libradores_modalidades_pago . "',
                  defecto='" . $defecto_libradores_modalidades_pago . "',
                  incremento_pvp='" . $incremento_pvp_libradores_modalidades_pago . "',
                  incremento_por='" . $incremento_por_libradores_modalidades_pago . "' 
                  WHERE id=" . $id_libradores_modalidades_pago . " LIMIT 1");

                $ids_modalidades_pago_update = '';
                foreach ($id_modalidades_pago_lineas as $key_id_modalidades_pago_lineas => $id_modalidades_pago_linea) {
                    if (empty($key_id_modalidades_pago_lineas)) {
                        continue;
                    }
                    if (!empty($id_modalidades_pago_linea)) {
                        if (empty($ids_modalidades_pago_update)) {
                            $ids_modalidades_pago_update .= $id_modalidades_pago_linea;
                        } else {
                            $ids_modalidades_pago_update .= ',' . $id_modalidades_pago_linea;
                        }
                    }
                }

                $logs_sys .= "DELETE FROM modalidades_pago_lineas WHERE id_forma_pago = " . $id_libradores_modalidades_pago . " AND id NOT IN(" . $ids_modalidades_pago_update . ")<br />";
                $result = $conn->query("DELETE FROM modalidades_pago_lineas WHERE id_forma_pago = " . $id_libradores_modalidades_pago . " AND id NOT IN(" . $ids_modalidades_pago_update . ")");

                foreach ($id_modalidades_pago_lineas as $key_id_modalidades_pago_lineas => $id_modalidades_pago_linea) {
                    if (empty($key_id_modalidades_pago_lineas)) {
                        continue;
                    }
                    if (empty($id_modalidades_pago_linea)) {
                        $logs_sys .= "INSERT INTO modalidades_pago_lineas VALUES(
                              NULL,
                              " . $id_libradores_modalidades_pago . ",
                              " . $dias_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . ",
                              " . $porcentaje_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . ")<br />";
                        $result = $conn->query("INSERT INTO modalidades_pago_lineas VALUES(
                              NULL,
                              " . $id_libradores_modalidades_pago . ",
                              " . $dias_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . ",
                              " . $porcentaje_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . ")");
                    } else {
                        $logs_sys .= "UPDATE modalidades_pago_lineas SET 
                          dias='" . $dias_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . "',
                          porcentaje='" . $porcentaje_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . "'
                          WHERE id=" . $id_modalidades_pago_linea . " LIMIT 1<br />";

                                $result = $conn->query("UPDATE modalidades_pago_lineas SET 
                          dias='" . $dias_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . "', 
                          porcentaje='" . $porcentaje_modalidades_pago_lineas[$key_id_modalidades_pago_lineas] . "'
                          WHERE id=" . $id_modalidades_pago_linea . " LIMIT 1");
                    }
                }

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_libradores_modalidades_pago,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM modalidades_pago WHERE id=" . $id_libradores_modalidades_pago . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM modalidades_pago WHERE id=" . $id_libradores_modalidades_pago . " LIMIT 1");

            $logs_sys .= "DELETE FROM modalidades_pago_lineas WHERE id_forma_pago = " . $id_libradores_modalidades_pago . "<br />";
            $result = $conn->query("DELETE FROM modalidades_pago_lineas WHERE id_forma_pago = " . $id_libradores_modalidades_pago);

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