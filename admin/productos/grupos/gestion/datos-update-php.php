<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(!isset($logs_sys)) {
    $logs_sys = new stdClass();
}

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        /*
        CREATE TABLE `productos_relacionados_grupos` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_idioma` INT(11) UNSIGNED NOT NULL DEFAULT '0',
            `descripcion` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        */
        case "guardar":
            if(empty($id_productos_grupos_url)) {
                if(!empty($descripcion_productos_grupos)) {
                    $logs_sys->Insert = "INSERT INTO productos_relacionados_grupos VALUES(NULL,'".$id_idioma_productos_grupos."','".addslashes($descripcion_productos_grupos)."','".addslashes($orden_productos_grupos)."')";
                    $result_insert = $conn->query("INSERT INTO productos_relacionados_grupos VALUES(
                                    NULL,
                                    '".$id_idioma_productos_grupos."',
                                    '".addslashes($descripcion_productos_grupos)."',
                                    '".addslashes($orden_productos_grupos)."')");

                    $id_productos_grupos_url = $conn->id_insert();

                    $resultado_sys = "INSERT";
                }else {
                    $id_productos_grupos_url = 0;
                    $resultado_sys = "INSERT ERROR descripcion";
                }
            }else {
                $logs_sys->Update = "UPDATE productos_relacionados_grupos SET id_idioma='" . $id_idioma_productos_grupos . "',descripcion='" . addslashes($descripcion_productos_grupos) . "',orden='" . addslashes($orden_productos_grupos) . "' WHERE id=" . $id_productos_grupos_url . " LIMIT 1";
                $result = $conn->query("UPDATE productos_relacionados_grupos SET 
                    id_idioma='" . $id_idioma_productos_grupos . "',
                    descripcion='" . addslashes($descripcion_productos_grupos) . "',
                    orden='" . addslashes($orden_productos_grupos) . "' 
                    WHERE id=" . $id_productos_grupos_url . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id_productos' => $id_url,
                    'id' => $id_productos_grupos_url,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
        case "eliminar":
            $logs_sys->Delete = "DELETE FROM productos_relacionados_grupos WHERE id=" . $id_productos_grupos_url . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_relacionados_grupos WHERE id=" . $id_productos_grupos_url . " LIMIT 1");
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