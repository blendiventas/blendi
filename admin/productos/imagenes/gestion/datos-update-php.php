<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(!isset($logs_sys)) {
    $logs_sys = new stdClass();
}

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activo FROM productos_images WHERE id=" . $id_productos_images . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE productos_images SET activo=" . $valor_sys . " WHERE id=" . $id_productos_images . " LIMIT 1");
            $logs_sys->estado = "UPDATE productos_images SET activo=" . $valor_sys . " WHERE id=" . $id_productos_images . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_productos_images)) {
                $logs_sys->insert = "INSERT INTO productos_images VALUES(NULL,'" . $id_productos . "','" . $id_enlazado . "','" . $id_multiple . "','" . $id_pack . "','','','" . addslashes($alt_productos_images) . "','" . addslashes($tittle_productos_images) . "','" . $activo_productos_images . "','" . addslashes($orden_productos_images) . "')";
                $result = $conn->query("INSERT INTO productos_images VALUES(
                              NULL,
                              '" . $id_productos . "',
                              '" . $id_enlazado . "',
                              '" . $id_multiple . "',
                              '" . $id_pack . "',
                              '',
                              '',
                              '" . addslashes($alt_productos_images) . "',
                              '" . addslashes($tittle_productos_images) . "',
                              '" . $activo_productos_images . "',
                              '" . addslashes($orden_productos_images) . "')");
                $id_productos_images = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys->update = "UPDATE productos_images SET alt='" . addslashes($alt_productos_images) . "',tittle='" . addslashes($tittle_productos_images) . "',orden='" . addslashes($orden_productos_images) . "',activo='" . $activo_productos_images . "' WHERE id=" . $id_productos_images . " LIMIT 1";
                $result = $conn->query("UPDATE productos_images SET 
                  alt='" . addslashes($alt_productos_images) . "', 
                  tittle='" . addslashes($tittle_productos_images) . "', 
                  orden='" . addslashes($orden_productos_images) . "', 
                  activo='" . $activo_productos_images . "' 
                  WHERE id=" . $id_productos_images . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                $logs_sys->accion = $select_sys;
                $logs_sys->id_productos_images = $id_productos_images;
                $logs_sys->id_productos = $id_productos;
                $logs_sys->id_enlazado = $id_enlazado;
                $logs_sys->id_multiple = $id_multiple;
                $logs_sys->id_pack = $id_pack;
                $logs_sys->id_ancla = $id_ancla;
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_productos,
                    'id_images' => $id_productos_images,
                    'att_enl' => $id_enlazado,
                    'att_mult' => $id_multiple,
                    'pack' => $id_pack,
                    'ancla' => $id_ancla,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
        case "subir-imagen":
            if(empty($id_sys)) {
                $matriz_logs_sys[] = "INSERT INTO productos_images VALUES(NULL,'".$id_productos."','0','0','0','" . addslashes($nombre_sys . "-" . $hora_sys . $extension_sys) . "','" . $updated_sys . "','','','','1')";
                $result = $conn->query("INSERT INTO productos_images VALUES(
                                    NULL,
                                    '".$id_productos."',
                                    '".$id_enlazado."',
                                    '".$id_multiple."',
                                    '".$id_pack."',
                                    '" . addslashes($nombre_sys . "-" . $hora_sys . $extension_sys) . "',
                                    '" . $updated_sys . "',
                                    '',
                                    '',
                                    '',
                                    '1')");
            }else {
                $result = $conn->query("UPDATE productos_images SET imagen='" . addslashes($nombre_sys . "-" . $hora_sys . $extension_sys) . "', updated='" . $updated_sys . "' WHERE id=" . $id_sys . " LIMIT 1");
            }
            break;
        case "eliminar-imagen":
            $updated_sys = date("y-m-d").date("H:m:s");
            $updated_sys = str_replace("-","",$updated_sys);
            $updated_sys = str_replace(":","",$updated_sys);

            $logs_sys->eliminarImagen = "UPDATE productos_images SET imagen='', updated='" . $updated_sys . "' WHERE id=" . $id_productos_images . " LIMIT 1";

            $result = $conn->query("UPDATE productos_images SET 
              imagen='', 
              updated='" . $updated_sys . "' 
              WHERE id=" . $id_productos_images . " LIMIT 1");

            $resultado_sys = "UPDATE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_productos_images,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
        case "eliminar":
            $logs_sys->eliminar = "DELETE FROM productos_images WHERE id=" . $id_productos_images . " LIMIT 1";
            $result = $conn->query("DELETE FROM productos_images WHERE id=" . $id_productos_images . " LIMIT 1");
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