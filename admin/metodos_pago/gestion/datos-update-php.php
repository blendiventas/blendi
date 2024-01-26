<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activo FROM metodos_pago WHERE id=" . $id_metodos_pago . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE metodos_pago SET activo=" . $valor_sys . " WHERE id=" . $id_metodos_pago . " LIMIT 1");
            $logs_sys .= "UPDATE metodos_pago SET activo=" . $valor_sys . " WHERE id=" . $id_metodos_pago . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_metodos_pago)) {
                if($prioritario_metodos_pago == 1) {
                    $logs_sys .= "UPDATE metodos_pago SET prioritario=0 WHERE prioritario=1 LIMIT 1<br />";
                    $result = $conn->query("UPDATE metodos_pago SET prioritario=0 WHERE prioritario=1 LIMIT 1");
                }
                $logs_sys .= "INSERT INTO metodos_pago VALUES(
                                NULL,
                                '" . $descripcion_metodos_pago . "',
                                '" . $explicacion_metodos_pago . "',
                                '" . $interface_metodos_pago . "',
                                " . $prioritario_metodos_pago . ",
                                " . $id_iva_metodos_pago . ",
                                '" . $incremento_pvp_metodos_pago . "',
                                '" . $incremento_por_metodos_pago . "',
                                '" . $ruta_metodos_pago . "',
                                '" . $sistema_metodos_pago . "',
                                '" . $imagen_metodos_pago . "',
                                '" . date('Y-m-d') . "',
                                '" . $orden_metodos_pago . "',
                                '" . $directo_metodos_pago . "',
                                " . $activo_metodos_pago . ")<br />";
                $result = $conn->query("INSERT INTO metodos_pago VALUES(
                                NULL,
                                '" . $descripcion_metodos_pago . "',
                                '" . $explicacion_metodos_pago . "',
                                '" . $interface_metodos_pago . "',
                                " . $prioritario_metodos_pago . ",
                                " . $id_iva_metodos_pago . ",
                                '" . $incremento_pvp_metodos_pago . "',
                                '" . $incremento_por_metodos_pago . "',
                                '" . $ruta_metodos_pago . "',
                                '" . $sistema_metodos_pago . "',
                                '" . $imagen_metodos_pago . "',
                                '" . date('Y-m-d') . "',
                                '" . $orden_metodos_pago . "',
                                '" . $directo_metodos_pago . "',
                              " . $activo_metodos_pago . ")");
                $id_metodos_pago = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                if($prioritario_metodos_pago == 1) {
                    $logs_sys .= "UPDATE metodos_pago SET prioritario=0 WHERE prioritario=1 LIMIT 1<br />";
                    $result = $conn->query("UPDATE metodos_pago SET prioritario=0 WHERE prioritario=1 LIMIT 1");
                }
                $logs_sys .= "UPDATE metodos_pago SET 
                    descripcion = '" . $descripcion_metodos_pago . "',
                    explicacion = '" . $explicacion_metodos_pago . "',
                    interface = '" . $interface_metodos_pago . "',
                    prioritario = " . $prioritario_metodos_pago . ",
                    id_iva = " . $id_iva_metodos_pago . ",
                    incremento_pvp = '" . $incremento_pvp_metodos_pago . "',
                    incremento_por = '" . $incremento_por_metodos_pago . "',
                    ruta = '" . $ruta_metodos_pago . "',
                    sistema = '" . $sistema_metodos_pago . "',
                    imagen = '" . $imagen_metodos_pago . "',
                    updated = '" . date('Y-m-d') . "',
                    orden = '" . $orden_metodos_pago . "',
                    directo = " . $directo_metodos_pago . ", 
                    activo = " . $activo_metodos_pago . " 
                  WHERE id=" . $id_metodos_pago . " LIMIT 1<br />";

                $result = $conn->query("UPDATE metodos_pago SET 
                    descripcion = '" . $descripcion_metodos_pago . "',
                    explicacion = '" . $explicacion_metodos_pago . "',
                    interface = '" . $interface_metodos_pago . "',
                    prioritario = " . $prioritario_metodos_pago . ",
                    id_iva = " . $id_iva_metodos_pago . ",
                    incremento_pvp = '" . $incremento_pvp_metodos_pago . "',
                    incremento_por = '" . $incremento_por_metodos_pago . "',
                    ruta = '" . $ruta_metodos_pago . "',
                    sistema = '" . $sistema_metodos_pago . "',
                    imagen = '" . $imagen_metodos_pago . "',
                    updated = '" . date('Y-m-d') . "',
                    orden = '" . $orden_metodos_pago . "',
                    directo = '" . $directo_metodos_pago . "',
                    activo = " . $activo_metodos_pago . " 
                  WHERE id=" . $id_metodos_pago . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_metodos_pago,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM metodos_pago WHERE id=" . $id_metodos_pago . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM metodos_pago WHERE id=" . $id_metodos_pago . " LIMIT 1");
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