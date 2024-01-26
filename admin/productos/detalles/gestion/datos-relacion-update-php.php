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
            foreach ($id_productos_detalles as $key_productos_detalles => $valor_productos_detalles) {
                if(empty($id_observaciones_productos_detalles_relacion[$key_productos_detalles]) && !empty($observaciones_productos_detalles_relacion[$key_productos_detalles])) {
                    $logs_sys->Insert_observacion = "INSERT INTO productos_observaciones VALUES(NULL, '".addslashes($observaciones_productos_detalles_relacion[$key_productos_detalles])."')";
                    $result = $conn->query("INSERT INTO productos_observaciones VALUES(NULL, '".addslashes($observaciones_productos_detalles_relacion[$key_productos_detalles])."')");
                    $id_observaciones_productos_detalles_relacion[$key_productos_detalles] = $conn->id_insert();
                }elseif(!empty($id_observaciones_productos_detalles_relacion[$key_productos_detalles])) {
                    $logs_sys->Update_observacion = "UPDATE productos_observaciones SET observacion='" . addslashes($observaciones_productos_detalles_relacion[$key_productos_detalles]) . "' WHERE id=" . $id_observaciones_productos_detalles_relacion[$key_productos_detalles] . " LIMIT 1";
                    $result = $conn->query("UPDATE productos_observaciones SET observacion='" . addslashes($observaciones_productos_detalles_relacion[$key_productos_detalles]) . "' WHERE id=" . $id_observaciones_productos_detalles_relacion[$key_productos_detalles] . " LIMIT 1");
                }
                if (empty($id_productos_detalles_relacion[$key_productos_detalles])) {
                    /*
                        CREATE TABLE `productos_detalles_enlazado` (
                            `id` INT(11) NOT NULL AUTO_INCREMENT,
                            `id_producto` INT(11) NOT NULL DEFAULT '0',
                            ELIMINADO `id_productos_detalles` INT(11) NOT NULL DEFAULT '0',
                            `id_detalles_datos` INT(11) NOT NULL DEFAULT '0',
                            `detalle_libre` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                            `id_observaciones` INT(11) NOT NULL DEFAULT '0',
                            `fecha_modificacion` DATE NULL DEFAULT NULL,

                        $id_productos_detalles ARRAY
                        $detalle_productos_detalles ARRAY
                        id_productos_detalles_datos
                        $id_productos_detalles_relacion ARRAY
                        $detalle_libre_productos_detalles_relacion ARRAY
                        $id_observaciones_productos_detalles_relacion ARRAY
                        $observaciones_productos_detalles_relacion ARRAY
                    */
                    $logs_sys->Insert_productos_detalles_datos = "INSERT INTO productos_detalles_enlazado VALUES(
                                    NULL,
                                    '" . $id_productos . "',
                                    '" . $id_productos_detalles_datos[$key_productos_detalles] . "',
                                    '" . addslashes($detalle_libre_productos_detalles_relacion[$key_productos_detalles]) . "',
                                    '" . $id_observaciones_productos_detalles_relacion[$key_productos_detalles] . "',
                                    '" . date("Y-m-d") . "')";
                    $result_insert = $conn->query("INSERT INTO productos_detalles_enlazado VALUES(
                                    NULL,
                                    '" . $id_productos . "',
                                    '" . $id_productos_detalles_datos[$key_productos_detalles] . "',
                                    '" . addslashes($detalle_libre_productos_detalles_relacion[$key_productos_detalles]) . "',
                                    '" . $id_observaciones_productos_detalles_relacion[$key_productos_detalles] . "',
                                    '" . date("Y-m-d") . "')");
                } else {
                    /*
                        CREATE TABLE `productos_detalles_enlazado` (
                            `id` INT(11) NOT NULL AUTO_INCREMENT,
                            `id_producto` INT(11) NOT NULL DEFAULT '0',
                            ELIMINADO `id_productos_detalles` INT(11) NOT NULL DEFAULT '0',
                            `id_detalles_datos` INT(11) NOT NULL DEFAULT '0',
                            `detalle_libre` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                            `id_observaciones` INT(11) NOT NULL DEFAULT '0',
                            `fecha_modificacion` DATE NULL DEFAULT NULL,

                        $id_productos_detalles ARRAY
                        $detalle_productos_detalles ARRAY
                        $id_productos_detalles_relacion ARRAY
                        $detalle_libre_productos_detalles_relacion ARRAY
                        $id_observaciones_productos_detalles_relacion ARRAY
                        $observaciones_productos_detalles_relacion ARRAY
                    */
                    $logs_sys->Update_productos_detalles_datos = "UPDATE productos_detalles_enlazado SET 
                        id_detalles_datos='" . $id_productos_detalles_datos[$key_productos_detalles] . "',
                        detalle_libre='" . addslashes($detalle_libre_productos_detalles_relacion[$key_productos_detalles]) . "',
                        id_observaciones='" . $id_observaciones_productos_detalles_relacion[$key_productos_detalles] . "',
                        fecha_modificacion='" . date("Y-m-d") . "' 
                        WHERE id=" . $id_productos_detalles_relacion[$key_productos_detalles] . " LIMIT 1";
                    $result = $conn->query("UPDATE productos_detalles_enlazado SET 
                        id_detalles_datos='" . $id_productos_detalles_datos[$key_productos_detalles] . "',
                        detalle_libre='" . addslashes($detalle_libre_productos_detalles_relacion[$key_productos_detalles]) . "',
                        id_observaciones='" . $id_observaciones_productos_detalles_relacion[$key_productos_detalles] . "',
                        fecha_modificacion='" . date("Y-m-d") . "' 
                        WHERE id=" . $id_productos_detalles_relacion[$key_productos_detalles] . " LIMIT 1");
                }
                if (isset($ajax_sys)) {
                    /*
                    echo json_encode([
                        'logs' => $logs_sys,
                        'resultado' => $resultado_sys,
                        'apartado' => $apartado_url
                    ]);
                    */
                }
            }
            break;
    }
}