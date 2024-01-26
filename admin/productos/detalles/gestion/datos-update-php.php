<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(!isset($logs_sys)) {
    $logs_sys = new stdClass();
}

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "guardar":
            if(empty($id_productos_detalles_url)) {
                if(!empty($detalle_productos_detalles)) {
                    $result_insert = $conn->query("INSERT INTO productos_detalles VALUES(
                                    NULL,
                                    '".$id_idioma_productos_detalles."',
                                    '".addslashes($detalle_productos_detalles)."',
                                    '".addslashes($orden_productos_detalles)."',
                                    '".$activo_productos_detalles."')");

                    $id_productos_detalles_url = $conn->id_insert();

                    $resultado_sys = "INSERT";
                }else {
                    $id_productos_detalles_url = 0;
                    $resultado_sys = "INSERT ERROR descripcion";
                }
            }else {
                if(empty($apartado_url) OR $apartado_url == "null" OR $apartado_url == "propiedades") {
                    $logs_sys->Update = "UPDATE productos_detalles SET id_idioma='" . $id_idioma_productos_detalles . "',detalle='" . addslashes($detalle_productos_detalles) . "',orden='" . addslashes($orden_productos_detalles) . "',activo='" . $activo_productos_detalles . "' WHERE id=" . $id_productos_detalles_url . " LIMIT 1";
                    $result = $conn->query("UPDATE productos_detalles SET 
                        id_idioma='" . $id_idioma_productos_detalles . "',
                        detalle='" . addslashes($detalle_productos_detalles) . "',
                        orden='" . addslashes($orden_productos_detalles) . "',
                        activo='" . $activo_productos_detalles . "' 
                        WHERE id=" . $id_productos_detalles_url . " LIMIT 1");

                    $resultado_sys = "UPDATE";
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id_productos' => $id_url,
                    'id' => $id_productos_detalles_url,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
        case "eliminar":
            $logs_sys->Delete = "DELETE FROM productos_detalles WHERE id=" . $id_productos_detalles_url . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_detalles WHERE id=" . $id_productos_detalles_url . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id_productos' => $id_url,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
    }
}